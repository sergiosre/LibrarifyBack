<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{

    /**
     * @Route("/library/list", name="library_list")
     */
    public function list()
    { 
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => 1,
                    'title' => 'Harry Potter'
                ],
                [
                    'id' => 1,
                    'title' => 'El Señor de los Anillos'
                ]
            ]
        ]);

        return $response;
    }
}
