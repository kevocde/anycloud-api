<?php

namespace App\Domain;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Clase de representación para las entidades Driver
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int driverId Identificador único
 * @property string name Nombre del driver
 */
final class Driver extends BaseEntity implements IEloquentService
{
    public $driverId;
    public $name;

    public static function getEloquentClass(): string
    {
        return \App\Entities\Driver::class;
    }
}
