<?php

namespace App\Http\Controllers\Api;

use App\Domain\EntityPart;
use App\Entities\Driver;
use App\Entities\Entity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Clase EntityPartController para el manejo de las solicitudes al api partes de entidades
 * @package App\Http\Controllers\Api
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 */
class EntityPartController extends Controller
{
    /**
     * Display a listing of the resource
     * @param Request $request
     * @param Entity $entity
     * @return LengthAwarePaginator
     */
    public function index(Request $request, Driver $driver, Entity $entity): LengthAwarePaginator
    {
        unset($driver);
        return EntityPart::listAllByEntity($entity, $request->get('per-page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, int $id): Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        //
    }
}
