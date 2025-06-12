<?php
namespace App\Command;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'db:add-products')]
class AddSampleProductsCommand extends Command
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
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
            $this->em->persist($product);
        }

        $this->em->flush();
        $output->writeln('Sample products added successfully!');

        return Command::SUCCESS;
    }
}
