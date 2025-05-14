<?php

namespace Taxonomy\Repositories;

use Taxonomy\Models\CategoryMaterial;
use Taxonomy\Models\TaxonomyTag;


class TagRepository
{


    /**
     * Получение всех тэгов пользователя с полными данными
     *
     * @param int $userId
     * @return array
     */
    public function receiveAllTags(int $userId): array
    {
        $tags = [];
        $userTags = TaxonomyTag::query()
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        foreach ($userTags as $userTag) {
            $tags[] = $userTags;
        }

        return $tags;
    }

    /**
     * Получение пользовательских тэгов с минимум данных
     * @return array
     */
    public function receiveTags(): array
    {
        $tags = [];
        $userTags = TaxonomyTag::query()
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        foreach ($userTags as $userTag) {
            $tags[] = [
                'id' => $userTag['id'],
                'title' => $userTag['title'],
                'color' => $userTag['color'],
//                'description' => $userTag['description'],
//                'created_at' => $userTag['created_at'],
//                'updated_at' => $userTag['updated_at'],
            ];
        }

        return $tags;
    }

    public function createOrUpdateTag(int $userId, string $slug, string $title, string $description, string $color, int $tagId=null): mixed
    {
        $tag = null;
        if ($tagId) {
            $tag = TaxonomyTag::query()->find($tagId);
        }

        if (!$tag) {
            $tag = new TaxonomyTag();
            $tag->user_id = $userId;
            $tag->slug = $slug;
        }

        $tag->title = $title;
        $tag->description = $description;
        $tag->color = $color;
        $tag->save();

        return $tag;
    }

    public function deleteTag(int $userId, int $tagId): mixed
    {
        $tag = TaxonomyTag::query()->find($tagId);

        if ($tag) {
            $tag->delete();
        }

        return true;
    }

    public function clearAllMaterialTags($materialId): bool
    {
//        CategoryMaterial::query()
//            ->where('material_id', $materialId)
//            ->delete();
        return true;
    }

    public function bindMaterialToTag(int $materialId, int $tagId): bool
    {
//        $checkIfCategoryExists = CategoryMaterial::query()
//            ->withTrashed()
//            ->where('material_id', $materialId)
//            ->where('category_id', $categoryId)
//            ->first();
//
//        if ($checkIfCategoryExists) {
//            $checkIfCategoryExists->is_primary = $isPrimary;
//            $checkIfCategoryExists->deleted_at = null;
//            $checkIfCategoryExists->save();
//        } else {
//            CategoryMaterial::query()
//                ->create([
//                    'category_id' => $categoryId,
//                    'material_id' => $materialId,
//                    'is_primary' => $isPrimary,
//                ]);
//        }

        return true;
    }


}
