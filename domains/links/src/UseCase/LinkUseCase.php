<?php

namespace Links\UseCase;

use Links\Repositories\LinkRepository;

class LinkUseCase
{

    private LinkRepository $linkRepository;


    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }


    public function receiveAllUserLinks(int $userId): array
    {

        try {
            $links = $this->linkRepository->receiveAllUserLinks($userId);
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
            'info' => 'user links',
            'data' => [
                'links' => $links,
            ],
        ];
    }


    public function createOrUpdateLink(int $userId, string $link): array
    {

        try {
            $result = $this->linkRepository->createOrUpdateLink($userId, $link);
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
            'info' => 'user links',
            'data' => [
                'links' => $links,
            ],
        ];
    }

}
