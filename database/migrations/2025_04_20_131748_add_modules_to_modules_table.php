<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Core\Models\Module;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Module::query()->create([
            'slug' => 'links',
            'name' => 'Links',
            'description' => 'This is the module where various links will be stored and processed.',
        ]);
        Module::query()->create([
            'slug' => 'notes',
            'name' => 'Notes',
            'description' => 'This is the module where various notes will be stored and processed.',
        ]);
        Module::query()->create([
            'slug' => 'articles',
            'name' => 'Articles',
            'description' => 'This is the module where various articles will be stored and processed.',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modules', function (Blueprint $table) {
            Module::query()->where('slug', 'links')->delete();
            Module::query()->where('slug', 'notes')->delete();
            Module::query()->where('slug', 'articles')->delete();
        });
    }
};
