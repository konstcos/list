<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Links\Repositories\LinkRepository;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $oldLinks = DB::table('links')->whereNull('deleted_at')->get();

        if ($oldLinks->count() > 0) {
            $linkRepository = new LinkRepository();
            foreach ($oldLinks as $oldLink) {
                $linkRepository->createOrUpdateLink($oldLink->user_id, $oldLink->link);
            }
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
