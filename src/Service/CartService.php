<?php
namespace App\Service;

use App\Repository\ProductRepositoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService implements CartServiceInterface
{
    public function __construct(
        private RequestStack $requestStack,
        private ProductRepositoryInterface $productRepository
    ) {
    }

    public function add(int $productId, int $quantity = 1): void
    {
        $cart = $this->getCart();
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
            ];
        }
        $this->requestStack->getSession()->set('cart', $cart);
    }

    public function remove(int $productId): void
    {
        $cart = $this->getCart();
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            $this->requestStack->getSession()->set('cart', $cart);
        }
    }

    public function clear(): void
    {
        $this->requestStack->getSession()->remove('cart');
    }

    public function getCart(): array
    {
        return $this->requestStack->getSession()->get('cart', []);
    }

    public function getCartWithDetails(): array
    {
        $cart = $this->getCart();
        $products = $this->productRepository->findByIds(array_keys($cart));
        $total = 0.0;
        foreach ($products as $product) {
            if (isset($cart[$product->getId()])) {
                $total += $product->getPrice() * $cart[$product->getId()]['quantity'];
            }
        }
        return [
            'cart' => $cart,
            'products' => $products,
            'total' => $total,
        ];
    }
}