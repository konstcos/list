<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id();

            $table->ulid()->unique();
            $table->unsignedBigInteger('user_id')->constrained('users');
            $table->unsignedBigInteger('module_id')->constrained('modules');
            $table->string('title')->nullable();
            $table->string('slug')->unique(); // уникальное название материала, если нужно, может использоваться в линках, например для чпу
            $table->text('short_content')->nullable(); // поле с типом TEXT в случае заметок тут будет текст заметки, в случае со статьей - краткое содержание статьи, если линк - оригинальный линк как есть, без разбивки на части и т.д.
            $table->integer('parts_count')->default(0);
            $table->integer('position')->default(0);
            $table->boolean('is_archive')->default(false);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
