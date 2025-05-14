<?php

namespace Taxonomy\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Taxonomy\UseCase\TagUseCase;

class TagsController extends BaseController
{
    public function userTags(Request $request, TagUseCase $useCase): JsonResponse
    {
        $userId = $request->user()->id;
        $result = $useCase->receiveAllUserTags($userId);

        return response()->json([
            'status' => $result['status'],
            'info' => $result['info'],
            'data' => $result['data'],
        ]);
    }

    public function createOrUpdateTag(Request $request, TagUseCase $useCase): JsonResponse
    {
        $userId = $request->user()->id;
        $tagId = $request->id;
        $slug = $request->slug;
        $title = $request->title;
        $color = $request->color ?? '';
        $description = $request->description ?? '';
        $result = $useCase->createOrUpdateTag($userId, $slug, $title, $description, $color, $tagId);

        return response()->json(
            [
                'status' => 'success',
                'message' => $result
            ]
        );
    }

    public function deleteTag(Request $request, TagUseCase $useCase): JsonResponse
    {

        $userId = $request->user()->id;
        $tagId = $request->tagId;
        $result = $useCase->deleteTag($userId, $tagId);

        return response()->json(
            [
                'status' => $result['status'],
                'info' => $result['info'],
                'data' => $result['data'],
            ]
        );
    }

    public function receiveTags(Request $request, TagUseCase $useCase): JsonResponse
    {

        $result = $useCase->receiveTags();

        return response()->json(
            [
                'status' => $result['status'],
                'info' => $result['info'],
                'data' => $result['data'],
            ]
        );
    }

    public function bindMaterialToTag(Request $request, TagUseCase $useCase): JsonResponse
    {

//        $materialId = (int)$request->material_id;
//        $tagId = (int)$request->tag_id;
//
//        $categories = array_values(array_filter($categories, function ($item) {
//            return is_int($item) && $item !== 0;
//        }));
//
//        $data = [
//            'materialId' => $materialId,
//            'tag' => $tagId,
//
//        ];
//
//        $result = $useCase->bindMaterialToTag($data);
//
//        return response()->json(
//            [
//                'status' => $result['status'],
//                'info' => $result['info'],
//                'data' => $result['data'],
//            ]
//        );
    }

}
