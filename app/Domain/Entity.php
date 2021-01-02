<?php

namespace App\Domain;

/**
 * Clase de representación para las entidades Entity
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int entityId
 * @property int driverId
 * @property int parentEntityId
 * @property string type
 * @property string originalName
 * @property string alias
 */
final class Entity extends BaseEntity implements IEloquentService
{
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
}
