<?php
namespace App\Controller\Cart;

use App\Service\CartServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartClearController extends AbstractController
{
    #[Route('/clear', name: 'cart_clear')]
    public function clear(CartServiceInterface $cartService): Response
    {
        $cartService->clear();
        return $this->redirectToRoute('cart_index');
    }
}