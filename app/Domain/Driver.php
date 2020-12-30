<?php

namespace App\Domain;

/**
 * Permite administrar los drivers y sus respectivas entidades
 * @package App\Domain
 * @author Kevin Guzmán <kevocde@gmail.com>
 * @version 0.0.0
 */
final class Driver
{
    private $driverId;
    private $name;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $model;

    public function __construct(string $name, array $entities = null)
    {
    }

    public function entities(): array
    {}
}
