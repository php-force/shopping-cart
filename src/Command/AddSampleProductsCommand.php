<?php
namespace App\Command;

use App\Entity\Product;
use App\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'db:add-products')]
class AddSampleProductsCommand extends Command
{

    public function __construct(private ProductRepositoryInterface $productRepository)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $products = [
            ['name' => 'Laptop', 'price' => 999.99],
            ['name' => 'Phone', 'price' => 499.99],
            ['name' => 'Headphones', 'price' => 99.99],
        ];

        foreach ($products as $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setPrice($data['price']);
            $this->productRepository->save($product);
        }
        $output->writeln('Sample products added successfully!');

        return Command::SUCCESS;
    }
}
