<?php

namespace App\Http\Controllers\Api;

use App\Domain\Driver;
use App\Domain\Entity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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

        return response()->json([
            'type' => 'success',
            'message' => '',
            'payload' => Entity::listAllByDriver($driver, $entities)
        ]);
    }

    /**
     * @param Request $request
     * @param Driver $driver
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
        $validator = Entity::getValidatorStore($request, $driver, $lastEntity);

        if ($validator->fails()) {
            $response = response()->json([
                'type' => 'error',
                'message' => 'Ah ocurrido un error al intentar crear la entidad.',
                'errors' => $validator->getMessageBag()
            ], 400);
        } else {
            $response = response()->json([
                'type' => 'success',
                'message' => 'Se ha creado la entidad correctamente',
                'payload' => Entity::createEntity($request, $driver, $lastEntity)->getModel()
            ], 201);
        }

        return $response;
    }
}
