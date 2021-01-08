<?php

namespace App\Http\Controllers\Api;

use App\Domain\Driver;
use App\Domain\Entity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param \App\Entities\Driver $driver
     * @param string|null $entities
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function index(\App\Entities\Driver $driver, $entities = null): JsonResponse
    {
        $driver = Driver::createFrom($driver);
        $entityIds = explode('/', $entities);
        $lastEntity = empty($entities) ? null : Entity::findOrFail(end($entityIds));

        return Entity::listAllByDriver($driver, $lastEntity);
    }

    /**
     * @param Request $request
     * @param \App\Entities\Driver $driver
     * @param string|null $entities
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function store(Request $request, \App\Entities\Driver $driver, $entities = null): JsonResponse
    {
        $driver = Driver::createFrom($driver);
        $entityIds = explode('/', $entities);
        $lastEntity = empty($entities) ? null : Entity::findOrFail(end($entityIds));

        return Entity::createEntity($request, $driver, $lastEntity);
    }
}
