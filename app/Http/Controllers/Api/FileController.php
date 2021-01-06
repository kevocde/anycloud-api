<?php

namespace App\Http\Controllers\Api;

use App\Domain\Entity;
use App\Entities\Driver;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @param Driver $driver
     * @param string $entities
     * @return Response
     *
     * @throws Throwable
     */
    public function index(Request $request, Driver $driver, $entities = ''): Response
    {
        unset($request, $driver);

        $entities = explode('/', $entities);
        $lastEntity = Entity::findOrFail(end($entities));

        if ($lastEntity->type == Entity::TYPE_DIRECTORY) {

        }
    }
}
