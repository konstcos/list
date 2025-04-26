<?php

namespace Taxonomy\Repositories;

use Illuminate\Support\Facades\DB;
use Taxonomy\Models\CategoryMaterial;
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

    public function receiveCategories(): array
    {
        $categories = [];
        $userCategories = TaxonomyCategory::query()
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        foreach ($userCategories as $userCategory) {
            $categories[] = [
                'id' => $userCategory['id'],
                'title' => $userCategory['title'],
//                'description' => $userCategory['description'],
//                'created_at' => $userCategory['created_at'],
//                'updated_at' => $userCategory['updated_at'],
//                'deleted_at' => $userCategory['deleted_at'],
            ];
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

    public function clearAllMaterialCategories($materialId): void
    {
        CategoryMaterial::query()
            ->where('material_id', $materialId)
            ->delete();
    }

    public function bindMaterialToCategories(int $materialId, int $categoryId, bool $isPrimary = false): bool
    {
        $checkIfCategoryExists = CategoryMaterial::query()
            ->withTrashed()
            ->where('material_id', $materialId)
            ->where('category_id', $categoryId)
            ->first();

        if ($checkIfCategoryExists) {
            $checkIfCategoryExists->is_primary = $isPrimary;
            $checkIfCategoryExists->deleted_at = null;
            $checkIfCategoryExists->save();
        } else {
            CategoryMaterial::query()
                ->create([
                    'category_id' => $categoryId,
                    'material_id' => $materialId,
                    'is_primary' => $isPrimary,
                ]);
        }

        return true;
    }


}
