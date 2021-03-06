<?php

namespace App\Domain;

/**
 * Clase de representación para las entidades Cloud
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int cloudId Identificador único
 *
 * @method static Cloud createFrom(\App\Entities\Cloud $model)
 */
final class Cloud extends BaseEntity implements IEloquentService
{
    public $cloudId;

    public static function getEloquentClass(): string
    {
        return \App\Entities\Cloud::class;
    }
}
