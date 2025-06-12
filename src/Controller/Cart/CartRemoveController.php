<?php
namespace App\Controller\Cart;

use App\Service\CartServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cart')]
class CartRemoveController extends AbstractController
{
    #[Route('/remove/{id}', name: 'cart_remove')]
    public function remove(int $id, CartServiceInterface $cartService): Response
    {
        $cartService->remove($id);
        return $this->redirectToRoute('cart_index');
    }
}