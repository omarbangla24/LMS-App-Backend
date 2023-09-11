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
        Schema::create('life_hacks_categories', function (Blueprint $table) {
            $table->id();
            $table->string('life_cat_title');
            $table->string('life_cat_img');
            $table->boolean("is_premium");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('life_hacks_categories');
    }
};
