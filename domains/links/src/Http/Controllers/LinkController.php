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

    public function linkDetail(Request $request, LinkUseCase $useCase): JsonResponse
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

    public function createOrUpdateLink(Request $request, LinkUseCase $useCase): JsonResponse
    {
        $userId = $request->user()->id;
        $linkId = $request->id;
        $link = $request->link;
        $result = $useCase->createOrUpdateLink($userId, $link, $linkId);

        return response()->json(
            [
                'status' => 'success',
                'message' => $result
            ]
        );
    }

    public function deleteLink(Request $request, LinkUseCase $useCase): JsonResponse
    {

        $userId = $request->user()->id;
        $linkId = $request->link_id;
        $result = $useCase->deleteLink($userId, $linkId);

        return response()->json(
            [
                'status' => $result['status'],
                'info' => $result['info'],
                'data' => $result['data'],
            ]
        );
    }


}
