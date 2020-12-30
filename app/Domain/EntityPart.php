<?php

namespace App\Domain;

final class EntityPart
{
    private $entityPartId;
    private $name;
    private $path;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $model;

    public function __construct(string $name, string $path, Cloud $cloud, Entity $entity)
    {
    }

    public function cloud(): Cloud
    {}

    public function entity(): Entity
    {}
}
