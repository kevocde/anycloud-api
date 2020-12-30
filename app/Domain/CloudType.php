<?php

namespace App\Domain;

/**
 * Permite administrar el tipo de nube
 * @package App\Domain
 * @author Kevin Guzmán <kevocde@gmail.com>
 * @version 0.0.0
 */
final class CloudType
{
    private $cloudTypeId;
    private $name;
    private $createdAt;
    private $updatedAt;
    private $deletedAt;
    private $model;

    public function __construct($name, array $clouds = null)
    {
    }

    public function clouds(): array
    {}
}
