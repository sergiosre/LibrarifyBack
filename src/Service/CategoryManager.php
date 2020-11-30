<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Se encarga de gestionar la entidad libro
 */
class CategoryManager
{
    private $em;
    private $categoryRepository;

    public function __construct(EntityManagerInterface $em, CategoryRepository $categoryRepository)
    {
        $this->em = $em;
        $this->categoryRepository = $categoryRepository;
    }

    public function find(int $id): ?Category
    {
        return $this->categoryRepository->find($id);
    }

    public function  create(): Category
    {
        $category = new Category();
        return $category;
    }

    public function save(Category $category): Category
    {
        $this->em->persist($category);
        $this->em->flush();
        return $category;
    }

    public function refresh(Category $category): Category
    {
        $this->em->refresh($category);
        return $category;
    }
}
