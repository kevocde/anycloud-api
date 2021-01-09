<?php

namespace App\Domain;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

/**
 * Clase de representación para las entidades Entity
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int entityId Identificador único
 * @property int driverId Identificador del driver asociado
 * @property int parentEntityId Identificador del la entidad padre (directorio padre)
 * @property string type Tipo de entidad, F para archivo y D para directorio
 * @property string originalName Nombre original de la entidad
 * @property string alias Alias de la entidad
 *
 * @method static Entity createFrom(\App\Entities\Entity $model)
 * @method \App\Entities\Entity getModel()
 * @method static Entity findOrFail(int $id)
 */
final class Entity extends BaseEntity implements IEloquentService
{
    const TYPE_FILE = 'F';
    const TYPE_DIRECTORY = 'D';

    /**
     * @var static Representa el tamaño máximo por el cual se partirá el archivo 32 kBytes
     */
    const FILE_PART_SIZE = 1024*128;

    public $entityId;
    public $driverId;
    public $parentEntityId;
    public $type;
    public $originalName;
    public $alias;
    public $entityParts = [];

    public static function getEloquentClass(): string
    {
        return \App\Entities\Entity::class;
    }

    /**
     * Retorna el listado de todos los recursos a partir del modelo relacionado
     * @param Driver $driver
     * @param string|null $entities
     * @param null $perPage
     * @return LengthAwarePaginator
     *
     * @throws Throwable
     */
    public static function listAllByDriver(Driver $driver, $entities = null, $perPage = null): LengthAwarePaginator
    {
        $perPage = $perPage ?? self::PER_PAGE;

        $entityIds = explode('/', $entities);
        $lastEntity = empty($entities) ? null : Entity::findOrFail(end($entityIds));

        $items = \App\Entities\Entity::where([
            'driver_id' => $driver->driverId
        ]);

        if (empty($lastEntity)) $items->whereNull('parent_entity_id');
        else $items->where('parent_entity_id', $lastEntity->entityId);

        return $items->paginate($perPage);
    }

    public static function getValidatorStore(Request $request, Driver $driver, Entity $entity = null): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make(
            $request->all(),
            [
                'type' => ['required', Rule::in([Entity::TYPE_FILE, Entity::TYPE_DIRECTORY])],
                'original_name' => ['required', function ($attribute, $value, $fail) use ($request, $driver, $entity) {
                    unset($attribute, $value);

                    $count = \App\Entities\Entity::where([
                            'driver_id' => $driver->driverId,
                            'parent_entity_id' => ($entity) ? $entity->entityId : null,
                            'original_name' => $request->post('original_name')
                        ])
                        ->count()
                    ;
                    if ($count > 0) $fail('Ya existe un archivo con este nombre.');
                }],
                'alias' => 'max:100',
                'payload' => 'file'
            ]
        );
    }

    /**
     * @param Request $request
     * @param Driver $driver
     * @param Entity|null $parentEntity
     * @return Entity
     *
     * @throws Throwable
     */
    public static function createEntity(Request $request, Driver $driver, Entity $parentEntity = null): Entity
    {
        $entityModel = new \App\Entities\Entity([
            'driver_id' => $driver->driverId,
            'parent_entity_id' => $parentEntity ? $parentEntity->driverId : null,
            'type' => $request->post('type', Entity::TYPE_DIRECTORY),
            'original_name' => $request->post('original_name'),
            'alias' => $request->post('alias')
        ]);
        $entityModel->save();

        $entity = Entity::createFrom($entityModel);
        if ($entity->type === Entity::TYPE_FILE) $entity->uploadFile($request->file('payload'));

        return $entity;
    }

    /**
     * Realiza el almacenado de un archivo de una entidad determinada
     * @param UploadedFile $file
     * @return bool
     *
     * @throws Throwable
     */
    public function uploadFile(UploadedFile $file): bool
    {
        $tempPathsFile = $this->uploadTempFile($file);
        foreach ($tempPathsFile as $path) {
            foreach (\App\Entities\Cloud::all() as $cloud) {
                $cloud = Cloud::createFrom($cloud);
                EntityPart::createEntityPart($cloud, $this, $path);
            }
        }
        $this->deleteTempFiles($tempPathsFile);

        return true;
    }

    /**
     * Crea los archivos temporales en el servidor a partir de un archivo pasado
     * @param UploadedFile $file
     * @return array
     */
    private function uploadTempFile(UploadedFile $file): array
    {
        $FILE_PATH = $file->getRealPath();

        $partsNames = [];
        $size = filesize($FILE_PATH);
        $parts = floor($size/Entity::FILE_PART_SIZE);
        $sizePerFile = $size/$parts;

        $source = fopen($FILE_PATH, 'r');
        for ($i = 0; $i < $parts; $i ++) {
            $tmpPath = 'temp/' . str_replace('.' . $file->extension(), '', $file->hashName()) . '-' . ($i+1) . '.part';
            $dest = fopen(Storage::disk()->path($tmpPath), 'w');
            $initPos = $i*$sizePerFile;
            stream_copy_to_stream($source, $dest, $sizePerFile, $initPos);
            fclose($dest);
            $partsNames[] = $tmpPath;
        }
        fclose($source);

        return $partsNames;
    }

    /**
     * Elimina los archivos temporales creados a partir de los paths
     * @param array $paths
     * @return bool
     */
    private function deleteTempFiles(array $paths): bool
    {
        foreach ($paths as $path) unlink(Storage::disk()->path($path));

        return true;
    }
}
