<?php
namespace App\Repository;

interface ProductRepositoryInterface
{
    public function findByIds(array $ids): array;
}