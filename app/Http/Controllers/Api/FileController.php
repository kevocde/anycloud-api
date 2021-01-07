<?php

namespace App\Http\Controllers\Api;

use App\Domain\Driver;
use App\Domain\Entity;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

/**
 * Clase FileController para la gestión de las solicitudes de los archivos
 * @package App\Http\Controllers\Api
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 */
class FileController extends BaseController
{
    /**
     * @param Request $request
     * @param \App\Entities\Driver $driver
     * @param string $entities
     * @return LengthAwarePaginator
     *
     * @throws Throwable
     */
    public function index(Request $request, \App\Entities\Driver $driver, $entities = null): LengthAwarePaginator
    {
        $return = null;
        unset($request);
        $driver = Driver::createFrom($driver);
        $entityIds = explode('/', $entities);

        $lastEntity = empty($entities) ? null : Entity::findOrFail(end($entityIds));

        return Entity::listAllByDriver($driver, $lastEntity);
    }
}
