<?php
namespace App\Repository;

use App\Entity\Product;

interface ProductRepositoryInterface
{
    public function findByIds(array $ids): array;
    public function save(Product $product): void;
}