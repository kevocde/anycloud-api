<?php

namespace App\Domain;

/**
 * Clase de representación para las entidades CloudType
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int cloudTypeId Identificador único
 * @property string name Nombre del tipo de nube
 */
final class CloudType extends BaseEntity implements IEloquentService
{
    public $cloudTypeId;
    public $name;

    public static function getEloquentClass(): string
    {
        return \App\Entities\CloudType::class;
    }
}
