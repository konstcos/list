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


    public function createOrUpdateLink(int $userId, string $link, int $linkId=null): array
    {

        if (! filter_var($link, FILTER_VALIDATE_URL)) {
            return [
                'status' => 'fail',
                'info' => 'wrong_url_format',
                'data' => [
                    'error' => 'wrong url format',
                ],
            ];
        }

        $checkIsLinkExists = $this->linkRepository->isLinkExists($userId, $link);
        if ($checkIsLinkExists) {
            return [
                'status' => 'fail',
                'info' => 'link_already_exists',
                'data' => [
                    'error' => 'link already exists',
                ],
            ];
        }

        try {
            $result = $this->linkRepository->createOrUpdateLink($userId, $link, $linkId);
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
            'data' => [],
        ];
    }

    public function deleteLink(int $userId, int $linkId): array
    {

        try {
            $result = $this->linkRepository->deleteLink($userId, $linkId);
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
            'info' => 'delete link successfully',
            'data' => [
            ],
        ];
    }

}
