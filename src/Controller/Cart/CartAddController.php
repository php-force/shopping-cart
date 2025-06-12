<?php
namespace App\Controller\Cart;

use App\Service\CartServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartAddController extends AbstractController
{
    #[Route('/add/{id}', name: 'cart_add')]
    public function add(int $id, CartServiceInterface $cartService): Response
    {
        $cartService->add($id);
        return $this->redirectToRoute('cart_index');
    }
}