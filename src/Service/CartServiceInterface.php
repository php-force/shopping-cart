<?php
namespace App\Service;

interface CartServiceInterface
{
    public function add(int $productId, int $quantity = 1): void;
    public function remove(int $productId): void;
    public function clear(): void;
    public function getCart(): array;
    public function getCartWithDetails(): array;
}