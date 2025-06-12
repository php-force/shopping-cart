<?php
namespace App\Controller\Cart;

use App\Service\CartServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartIndexController extends AbstractController
{
    #[Route('/', name: 'cart_index')]
    public function index(CartServiceInterface $cartService): Response
    {
        $cartData = $cartService->getCartWithDetails();
        return $this->render('cart/index.html.twig', [
            'cart' => $cartData['cart'],
            'products' => $cartData['products'],
            'total' => $cartData['total'],
        ]);
    }
}