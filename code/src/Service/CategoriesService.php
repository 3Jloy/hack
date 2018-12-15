<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoriesService implements ApplicationServiceInterface
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function invoke(Request $request)
    {
        $categories = $this->categoryRepository->findAll();
        $responseArray = array_map(function (Category $category) {
            return ['id' => $category->id(), 'title' => $category->title()];
        }, $categories);

        return new BaseResponse($responseArray);
    }
}