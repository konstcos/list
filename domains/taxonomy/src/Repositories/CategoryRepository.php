<?php

namespace Taxonomy\Repositories;

use Illuminate\Support\Facades\DB;
use Taxonomy\Models\TaxonomyCategory;


class CategoryRepository
{


    public function receiveAllUserCategories(int $userId): array
    {
        $categories = [];
        $userCategories = TaxonomyCategory::query()
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        foreach ($userCategories as $userCategory) {
            $categories[] = $userCategory;
        }

        return $categories;
    }

    public function createOrUpdateCategory(int $userId, string $slug, string $title, string $description, int $categoryId=null): mixed
    {
        $category = null;
        if ($categoryId) {
            $category = TaxonomyCategory::where('user_id', $userId)->find($categoryId);
        }

        if (!$category) {
            $category = new TaxonomyCategory();
            $category->user_id = $userId;
            $category->slug = $slug;
        }

        $category->title = $title;
        $category->description = $description;
        $category->save();

        return $category;
    }

    public function deleteCategory(int $userId, int $categoryId): mixed
    {
        $link = TaxonomyCategory::where('user_id', $userId)->find($categoryId);

        if ($link) {
            $link->delete();
        }

        return true;
    }

}
