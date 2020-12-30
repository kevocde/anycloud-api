<?php

namespace App\Domain;

/**
 * Permite realizar acciones directamente en la nube según el tipo
 * @package App\Domain
 * @author Kevin Guzmán <kevocde@gmail.com>
 * @version 0.0.0
 */
final class Cloud
{
    private $cloudId;
    private $name;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $model;

    public function __construct(CloudType $cloudType, array $entityParts = null)
    {
    }

    public function cloudType(): CloudType
    {}

    public function entityParts(): array
    {}
}
