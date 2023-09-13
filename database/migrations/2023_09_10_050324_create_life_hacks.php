<?php

use App\Models\LifeHacksCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('life_hacks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(LifeHacksCategory::class);
            $table->string('life_hacks_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('life_hacks');
    }
};
