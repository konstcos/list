<?php

namespace Taxonomy\UseCase;

use Taxonomy\Repositories\CategoryRepository;

class CategoryUseCase
{

    private CategoryRepository $categoryRepository;


    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function receiveAllUserCategories(int $userId): array
    {

        $categories = [];
        try {
            $categories = $this->categoryRepository->receiveAllUserCategories($userId);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error getting user links',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'user categories',
            'data' => [
                'categories' => $categories,
            ],
        ];
    }


    public function createOrUpdateCategory(int $userId, string $slug, string $title, string $description, int $categoryId=null): array
    {

        try {
            $result = $this->categoryRepository->createOrUpdateCategory($userId, $slug, $title, $description, $categoryId);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error getting user links',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'create or update user categories',
            'data' => [],
        ];
    }

    public function deleteCategory(int $userId, int $categoryId): array
    {

        try {
            $result = $this->categoryRepository->deleteCategory($userId, $categoryId);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error deleting category',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'delete category successfully',
            'data' => [
            ],
        ];
    }


    public function bindMaterialToCategories($data): array
    {
        $materialId = $data['materialId'];
        $primaryCategoryId = $data['primaryId'];
        $categories = $data['categories'];
        logger('cat', [
            'categories' => $categories,
        ]);
        if (count($categories) > 0 && $primaryCategoryId === 0) {
            $primaryCategoryId = $categories[0];
        }


        try {
            $this->categoryRepository->clearAllMaterialCategories($materialId);

            foreach ($categories as $categoryId) {
                $this->categoryRepository->bindMaterialToCategories($materialId, $categoryId, $categoryId == $primaryCategoryId);
            }

        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error while binding material to categories',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'bind material to categories successfully',
            'data' => [
            ],
        ];
    }


    public function receiveCategories(): array
    {

        try {
            $categories = $this->categoryRepository->receiveCategories();
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error deleting categories',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'receive category successfully',
            'data' => [
                'categories' => $categories,
            ],
        ];
    }

}
