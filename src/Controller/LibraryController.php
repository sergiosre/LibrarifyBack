<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    // private $logger;

    // public function __construct(LoggerInterface $logger)
    // {
    //     $this->logger = $logger;
    // }

    /**
     * @Route("/books", name="book_get")
     */
    public function list(Request $request, BookRepository $bookRepository)
    {
        $title = $request->get('title');
        $books = $bookRepository->findAll();
        $booksAsArray  = [];
        foreach ($books as $book) {
            $booksAsArray[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'image' => $book->getImage()
            ];
        }
        $response = new JsonResponse();
        $response->setData([
            'success' => true,
            'data' => $booksAsArray
        ]);

        return $response;
    }

    /**
     * @Route("/book/create", name="create_book")
     */
    public function createBook(Request $request, EntityManagerInterface $entityManager)
    {
        $book = new Book();
        $response = new JsonResponse();

        $title = $request->get('title', null);
        if (empty($title)) {
            $response->setData([
                'success' => false,
                'error' => 'Title cannot be empty',
                'data' => null
            ]);

            return $response;
        }
        $book->setTitle($title);
        $entityManager->persist($book);
        $entityManager->flush();
        $response->setData([
            'success' => true,
            'data' => [
                [
                    'id' => $book->getId(),
                    'title' => $book->getTitle()
                ],
            ]
        ]);

        return $response;
    }
}
