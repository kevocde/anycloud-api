<?php

namespace App\Domain;

/**
 * Permite realizar las tareas de administración de los Drivers y sus respectivos archivos
 * @package App\Domain
 * @author Kevin Guzmán <kevocde@gmail.com>
 * @version 0.0.0
 */
final class Dashboard
{
    private $drivers;

    public static function listFilesOfDriver(Driver $driver)
    {}

    public static function listDrivers(): array
    {}

    public static function createFile(Driver $driver, $fileContent): bool
    {
        return true;
    }

    public static function updateFile(Entity $entity, $fileContent): bool
    {
        return true;
    }

    public static function deleteFile(Entity $entity): bool
    {
        return true;
    }
}
