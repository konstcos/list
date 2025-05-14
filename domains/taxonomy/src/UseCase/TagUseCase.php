<?php

namespace Taxonomy\UseCase;

use Taxonomy\Repositories\TagRepository;

class TagUseCase
{

    private TagRepository $tagRepository;


    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    public function receiveAllUserTags(int $userId): array
    {

        try {
            $tags = $this->tagRepository->receiveAllTags($userId);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error getting user tags',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'user tags',
            'data' => [
                'tags' => $tags,
            ],
        ];
    }


    public function createOrUpdateTag(int $userId, string $slug, string $title, string $description, string $color, int $tagId=null): array
    {

        try {
            $result = $this->tagRepository->createOrUpdateTag($userId, $slug, $title, $description, $color, $tagId);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error getting user tags',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'create or update user tags',
            'data' => [],
        ];
    }

    public function deleteTag(int $userId, int $tagId): array
    {

        try {
            $result = $this->tagRepository->deleteTag($userId, $tagId);
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error deleting tag',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'delete tag successfully',
            'data' => [
            ],
        ];
    }


    public function bindMaterialToTag($data): array
    {
        $materialId = $data['materialId'];
        $tag = $data['tag'];

//        try {
//            $this->tagRepository->clearAllMaterialCategories($materialId);
//
//            foreach ($categories as $categoryId) {
//                $this->tagRepository->bindMaterialToCategories($materialId, $categoryId, $categoryId == $primaryCategoryId);
//            }
//
//        } catch (\Exception $e) {
//            return [
//                'status' => 'fail',
//                'info' => 'error while binding material to categories',
//                'data' => [
//                    'error' => $e->getMessage(),
//                ],
//            ];
//        }

        return [
            'status' => 'success',
            'info' => 'bind material to tag successfully',
            'data' => [
            ],
        ];
    }


    public function receiveTags(): array
    {

        try {
            $tags = $this->tagRepository->receiveTags();
        } catch (\Exception $e) {
            return [
                'status' => 'fail',
                'info' => 'error deleting tags',
                'data' => [
                    'error' => $e->getMessage(),
                ],
            ];
        }

        return [
            'status' => 'success',
            'info' => 'receive tags successfully',
            'data' => [
                'categories' => $tags,
            ],
        ];
    }

}
