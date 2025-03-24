<?php

namespace Links\Repositories;

use Illuminate\Support\Facades\DB;
use Links\Models\Link;


class LinkRepository
{


    public function receiveAllUserLinks(int $userId): array
    {
        $links = [];
        $userLinks = DB::table('links')
            ->select(
                'links.id',
                'links.user_id',
                'links.link',
                'links.created_at',
                'links.updated_at',
                'links.deleted_at',
            )
            ->where('links.user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->whereNull('deleted_at')
            ->get()
            ->toArray();

        foreach ($userLinks as $userLink) {
            $links[] = $userLink;
        }

        return $links;
    }

    public function createOrUpdateLink(int $userId, string $url, int $linkId=null): mixed
    {
        $link = null;
        if ($linkId) {
            $link = Link::where('user_id', $userId)->find($linkId);
        }

//        $link = Link::where('user_id', $userId)
//            ->where('link', $url)
//            ->first();

        if (!$link) {
            $link = new Link();
            $link->user_id = $userId;
        }

        $link->link = $url;
        $link->save();

        return $link;
    }

    public function deleteLink(int $userId, int $linkId): mixed
    {
        $link = Link::where('user_id', $userId)->find($linkId);

        if ($link) {
            $link->delete();
        }

        return true;
    }

}
