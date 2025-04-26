<?php

namespace Taxonomy\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Taxonomy\UseCase\CategoryUseCase;

class CategoryController extends BaseController
{
    public function userCategories(Request $request, CategoryUseCase $useCase): JsonResponse
    {
        $userId = $request->user()->id;
        $result = $useCase->receiveAllUserCategories($userId);

        return response()->json([
            'status' => $result['status'],
            'info' => $result['info'],
            'data' => $result['data'],
        ]);
    }

    public function linkDetail(Request $request, CategoryUseCase $useCase): JsonResponse
    {
        $linkId = $request->link_id;

        return response()->json(
            [
                'status' => 'success',
                'info' => 'okey',
                'data' => [
                    'link' => $linkId
                ]
            ]
        );
    }

    public function createOrUpdateCategory(Request $request, CategoryUseCase $useCase): JsonResponse
    {
        $userId = $request->user()->id;
        $categoryId = $request->id;
        $slug = $request->slug;
        $title = $request->title;
        $description = $request->description ?? '';
        $result = $useCase->createOrUpdateCategory($userId, $slug, $title, $description, $categoryId);

        return response()->json(
            [
                'status' => 'success',
                'message' => $result
            ]
        );
    }

    public function deleteCategory(Request $request, CategoryUseCase $useCase): JsonResponse
    {

        $userId = $request->user()->id;
        $categoryId = $request->category_id;
        $result = $useCase->deleteCategory($userId, $categoryId);

        return response()->json(
            [
                'status' => $result['status'],
                'info' => $result['info'],
                'data' => $result['data'],
            ]
        );
    }

    public function receiveCategories(Request $request, CategoryUseCase $useCase): JsonResponse
    {

        $result = $useCase->receiveCategories();

        return response()->json(
            [
                'status' => $result['status'],
                'info' => $result['info'],
                'data' => $result['data'],
            ]
        );
    }

    public function bindMaterialToCategories(Request $request, CategoryUseCase $useCase): JsonResponse
    {

        $materialId = (int)$request->material_id;
        $primaryCategoryId = (int)$request->primary_id;

        $categories = [
            (int)$request->category1_id,
            (int)$request->category2_id,
            (int)$request->category3_id,
        ];

        $categories = array_values(array_filter($categories, function ($item) {
            return is_int($item) && $item !== 0;
        }));

        $data = [
            'materialId' => $materialId,
            'primaryId' => $primaryCategoryId,
            'categories' => $categories,

        ];

        $result = $useCase->bindMaterialToCategories($data);

        return response()->json(
            [
                'status' => $result['status'],
                'info' => $result['info'],
                'data' => $result['data'],
            ]
        );
    }

}
