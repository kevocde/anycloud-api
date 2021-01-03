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
    const PER_PAGE = 20;

    public $driverId;
    public $name;

    public static function getEloquentClass(): string
    {
        return \App\Entities\Driver::class;
    }

    /**
     * Retorna el listado de todos los drivers
     * @param int|null $perPage
     * @return LengthAwarePaginator
     */
    public static function listAll(int $perPage = null): LengthAwarePaginator
    {
        $perPage = $perPage ?? self::PER_PAGE;
        return call_user_func_array([self::getEloquentClass(), 'paginate'], [$perPage]);
    }
}
