<?php

namespace Links\Repositories;

use Illuminate\Support\Facades\DB;
use Links\Models\Link;
use Core\Models\Material;
use Illuminate\Support\Str;


class LinkRepository
{

    private int $moduleId = 1;

    public function receiveAllUserLinks(int $userId): array
    {
        $links = [];
        $userLinks = Material::query()
            ->where('module_id', $this->moduleId)
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->get();

        foreach ($userLinks as $userLink) {
            $links[] = [
                'id' => $userLink->id,
                'user_id' => $userLink->user_id,
                'link' => $userLink->short_content,
                'created_at' => $userLink->created_at,
                'updated_at' => $userLink->updated_at,
                'deleted_at' => $userLink->deleted_at,
            ];
        }

        return $links;
    }

    public function isLinkExists(int $userId, string $url): bool
    {
        return $checkIsLinkExists = Material::query()
            ->where('module_id', $this->moduleId)
            ->where('user_id', $userId)
            ->where('short_content', $url)
            ->exists();

    }

    public function createOrUpdateLink(int $userId, string $url, int $linkId=null): mixed
    {
        $link = null;
        if ($linkId) {
            $link = Material::query()
                ->where('module_id', $this->moduleId)
                ->where('user_id', $userId)
                ->find($linkId);
        }

        if (!$link) {
            $parsed = parse_url($url);
            $base = ($parsed['host'] ?? '') . ($parsed['path'] ?? '');
            $slug = Str::slug($base);

            $original = $slug;
            $i = 1;
            while (Material::query()->withTrashed()->where('slug', $slug)->exists()) {
                $i++;
                $slug = "{$i}-{$original}";
            }

            $link = Material::query()
                ->create([
                    'user_id' => $userId,
                    'module_id' => $this->moduleId,
                    'slug' => $slug,
            ]);
        }

        $link->short_content = $url;
        $link->save();

        return $link;
    }

    public function deleteLink(int $userId, int $linkId): mixed
    {
        $link = Material::query()
            ->where('module_id', $this->moduleId)
            ->where('user_id', $userId)
            ->find($linkId);

        if ($link) {
            $link->delete();
        }

        return true;
    }

}
