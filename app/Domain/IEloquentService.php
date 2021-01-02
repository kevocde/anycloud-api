<?php

namespace App\Domain;

/**
 * Interface para proveer el servicio de integración con los modelos Eloquent
 * @package App\Domain
 * @author kevocde <kevocde@gmail.com>
 * @version 0.0.0
 */
interface IEloquentService
{
    /**
     * Retorna la referencia completa de la clase eloquent para la entidad
     * @return string
     */
    static function getEloquentClass(): string;
}
