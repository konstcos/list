<?php

namespace Links\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Links\UseCase\LinkUseCase;

class LinkController extends BaseController
{
    public function userLinks(Request $request, LinkUseCase $useCase): JsonResponse
    {
        $userId = $request->user()->id;
        $result = $useCase->receiveAllUserLinks($userId);

        return response()->json([
            'status' => $result['status'],
            'info' => $result['info'],
            'data' => $result['data'],
        ]);
    }


    public function createOrUpdateLink(Request $request, LinkUseCase $useCase): JsonResponse
    {
        $userId = $request->user()->id;
        $link = $request->link;
        $result = $useCase->createOrUpdateLink($userId, $link);

        return response()->json(
            [
                'status' => 'success',
                'message' => $result
            ]
        );
    }

    public function deleteLink(Request $request): JsonResponse
    {

        return response()->json(
            [
                'message' => 'User links'
            ]
        );
    }


}
