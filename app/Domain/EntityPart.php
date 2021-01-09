<?php

namespace App\Domain;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Clase de representación para las entidades EntityPart
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int entityPartId
 * @property int cloudId
 * @property int entityId
 * @property string name
 * @property string path
 */
final class EntityPart extends BaseEntity implements IEloquentService
{
    public $entityPartId;
    public $cloudId;
    public $entityId;
    public $name;
    public $path;

    public static function getEloquentClass(): string
    {
        return \App\Entities\EntityPart::class;
    }

    /**
     * Retorna el listado de todos los recursos a partir del modelo relacionado
     * @param Entity $entity
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public static function listAllByEntity(Entity $entity, int $perPage = null): LengthAwarePaginator
    {
        $perPage = $perPage ?? self::PER_PAGE;
        $items = call_user_func_array([EntityPart::getEloquentClass(), 'where'], ['entity_id', $entity->entityId]);
        return $items->paginate($perPage);
    }

    public static function createEntityPart(Cloud $cloud, Entity $entity, string $tempPathFile): \App\Entities\EntityPart
    {
        $name = explode('/', $tempPathFile);
        $instance = new \App\Entities\EntityPart([
            'cloud_id' => $cloud->cloudId,
            'entity_id' => $entity->entityId,
            'name' => end($name),
            'path' => $tempPathFile
        ]);
        $instance->save();

        return $instance;
    }
}
