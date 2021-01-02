<?php

namespace App\Domain;

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
}
