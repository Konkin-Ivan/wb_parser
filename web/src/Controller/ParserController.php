<?php

namespace App\Controller;


use App\Parser\DataProcessor;
use App\Parser\RemoteDataFetcher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ParserController extends AbstractController
{
    #[Route('/parser', name: 'parser')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $dataFetcher = new RemoteDataFetcher();
        $dataArray = $dataFetcher->fetchData();

        $dataProcessor = new DataProcessor($entityManager);
        $result = $dataProcessor->processData($dataArray);

        return $this->render('parser/index.html.twig', [
            'controller_name' => 'HomeController',
            'result' => $result
        ]);
    }
}
