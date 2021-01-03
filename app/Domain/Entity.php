<?php

namespace App\Domain;

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
}
