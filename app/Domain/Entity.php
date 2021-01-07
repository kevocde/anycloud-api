<?php

namespace App\Domain;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
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

    public $entityId;
    public $driverId;
    public $parentEntityId;
    public $type;
    public $originalName;
    public $alias;

    public static function getEloquentClass(): string
    {
        return \App\Entities\Entity::class;
    }

    /**
     * Retorna el listado de todos los recursos a partir del modelo relacionado
     * @param Driver $driver
     * @param Entity|null $parentEntity
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public static function listAllByDriver(Driver $driver, Entity $parentEntity = null, int $perPage = null): LengthAwarePaginator
    {
        $perPage = $perPage ?? self::PER_PAGE;
        $items = call_user_func_array([Entity::getEloquentClass(), 'where'], ['driver_id', $driver->driverId]);

        if (empty($parentEntity)) $items->whereNull('parent_entity_id');
        else $items->where('parent_entity_id', $parentEntity->entityId);


        return $items->paginate($perPage);
    }

    public static function validateEntityRequest(Request $request): bool
    {
        return true;
    }

    /**
     * @param Request $request
     * @param Driver $driver
     * @param Entity|null $parentEntity
     * @return Response
     *
     * @throws Throwable
     */
    public static function createEntity(Request $request, Driver $driver, Entity $parentEntity = null): Response
    {
        if (Entity::validateEntityRequest($request)) {
            $modelInstance = new \App\Entities\Entity([
                'driver_id' => $driver->driverId,
                'parent_entity_id' => $parentEntity ? $parentEntity->entityId : null,
                'type' => $request->post('type', 'D'),
                'original_name' => $request->post('original_name'),
                'alias' => null
            ]);
            $modelInstance->save();
            $entity = Entity::createFrom($modelInstance);

            return response($entity->getModel());
        }
    }
}
