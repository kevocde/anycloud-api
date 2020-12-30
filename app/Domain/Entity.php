<?php

namespace App\Domain;

/**
 * Permite administrar y realizar acciones sobre las carpetas y archivos
 * @package App\Domain
 * @author Kevin Guzmán <kevocde@gmail.com>
 * @version 0.0.0
 */
final class Entity
{
    private $entityId;
    private $type;
    private $originalName;
    private $alias;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $model;

    public function __construct(string $type, string $originalName, Driver $driver, string $alias = null, array $entityParts = null)
    {
    }

    public function entityParts(): array
    {}

    public function driver(): Driver
    {}

    public function parentEntity(): Entity
    {}

    public function childEntities(): array
    {}

    public function fragmentEntity(): bool
    {}

    public function desfragmentEntity(): string
    {}

    public function update(): bool
    {}

    public function delete(): bool
    {}
}
