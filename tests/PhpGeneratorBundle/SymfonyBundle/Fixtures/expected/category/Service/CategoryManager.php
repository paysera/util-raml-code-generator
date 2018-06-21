<?php

namespace Vendor\Test\CategoryApiBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Vendor\Test\CategoryApiBundle\Entity as Entities;
use Vendor\Test\CategoryApiBundle\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;

class CategoryManager
{
    private $categoryRepository;
    private $entityManager;

    public function __construct(
        CategoryRepository $categoryRepository,
        EntityManager $entityManager
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function enableCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function disableCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function updateCategory(Entities\Category $originalCategory, Entities\Category $updatedCategory)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @return null
     */
    public function deleteCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\CategoryFilter $categoryFilter
     * @return Response
     */
    public function getCategories(Entities\CategoryFilter $categoryFilter)
    {
        //TODO: generated_code
    }
    /**
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function createCategory(Entities\Category $category)
    {
        //TODO: generated_code
    }
}
