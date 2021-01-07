<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Clase de representación para las entidades Driver
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 *
 * @property int driverId Identificador único
 * @property string name Nombre del driver
 *
 * @method static Driver createFrom(\App\Entities\Driver $model)
 * @method \App\Entities\Driver getModel()
 * @method static Driver findOrFail(int $id)
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
