<?php

namespace App\Controller;


use App\Application\Service\BrandService;
use App\Application\Service\FeedbackRecordService;
use App\Application\Service\FeedbackService;
use App\Application\Service\ProductService;
use App\Application\Service\VolumeService;
use App\Infrastructure\Parser\DataProcessor;
use App\Infrastructure\Parser\RemoteDataFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ParserController extends AbstractController
{
    #[Route('/parser', name: 'parser')]
    public function index(
        VolumeService $volumeService,
        FeedbackService $feedbackService,
        BrandService $brandService,
        ProductService $productService,
        FeedbackRecordService $feedbackRecordService
    ): Response
    {
        $dataFetcher = new RemoteDataFetcher();
        $dataArray = $dataFetcher->fetchData();

        $dataProcessor = new DataProcessor(
            $volumeService,
            $feedbackService,
            $brandService,
            $productService,
            $feedbackRecordService
        );

        $result = $dataProcessor->processData($dataArray);

        return $this->render('parser/index.html.twig', [
            'controller_name' => 'HomeController',
            'result' => $result
        ]);
    }
}
