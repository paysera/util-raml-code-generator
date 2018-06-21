<?php

namespace Vendor\Test\CategoryApiBundle\Controller;

use Vendor\Test\CategoryApiBundle\Entity as Entities;
use Symfony\Component\HttpFoundation\Response;
use Vendor\Test\CategoryApiBundle\Service\CategoryManager;
use Vendor\Test\CategoryApiBundle\CategoryPermissions;
use Paysera\Bundle\SecurityBundle\Service\AuthorizationChecker;
use Doctrine\ORM\EntityManager;

class CategoryApiController
{
    private $authorizationChecker;
    private $entityManager;
    private $categoryManager;
    
    public function __construct(
        CategoryManager $categoryManager,
        AuthorizationChecker $authorizationChecker,
        EntityManager $entityManager
    ) {
        $this->categoryManager = $categoryManager;
        $this->authorizationChecker = $authorizationChecker;
        $this->entityManager = $entityManager;
    }

    /**
     * Enable category
     * PUT /categories/{id}/enable
     *
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function enableCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::ENABLE_CATEGORY);
        $result = $this->categoryManager->enableCategory($category);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Disable category
     * PUT /categories/{id}/disable
     *
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function disableCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::DISABLE_CATEGORY);
        $result = $this->categoryManager->disableCategory($category);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Update category
     * PUT /categories/{id}
     *
     * @param Entities\Category $originalCategory
     * @param Entities\Category $updatedCategory
     * @return Entities\Category
     */
    public function updateCategory(Entities\Category $originalCategory, Entities\Category $updatedCategory)
    {
        $this->authorizationChecker->check(CategoryPermissions::UPDATE_CATEGORY);
        $result = $this->categoryManager->updateCategory($originalCategory, $updatedCategory);
        $this->entityManager->flush();
        return $result;
    }
    /**
     * Delete category
     * DELETE /categories/{id}
     *
     * @param Entities\Category $category
     * @return null
     */
    public function deleteCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::DELETE_CATEGORY);
        $this->categoryManager->deleteCategory($category);
        $this->entityManager->flush();
        return null;
    }
    /**
     * Standard SQL-style Result filtering
     * GET /categories
     *
     * @param Entities\CategoryFilter $categoryFilter
     * @return Response
     */
    public function getCategories(Entities\CategoryFilter $categoryFilter)
    {
        $this->authorizationChecker->check(CategoryPermissions::GET_CATEGORIES);
        return $this->categoryManager->getCategories($categoryFilter);
    }
    /**
     * Create category
     * POST /categories
     *
     * @param Entities\Category $category
     * @return Entities\Category
     */
    public function createCategory(Entities\Category $category)
    {
        $this->authorizationChecker->check(CategoryPermissions::CREATE_CATEGORY);
        $result = $this->categoryManager->createCategory($category);
        $this->entityManager->flush();
        return $result;
    }
}
