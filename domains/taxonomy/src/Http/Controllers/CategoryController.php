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


}
