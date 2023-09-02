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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_no')->nullable()->after('password');
        $table->string('token')->nullable();
        $table->string('address')->nullable();
        $table->string('usertype')->nullable();
        $table->integer('age')->nullable();
        $table->string('profile_image_path')->nullable();
        $table->integer('otp')->nullable();
        $table->string('ref_code')->nullable();
        $table->string('professions_id')->nullable();
        $table->string('bkash_mobile')->nullable();
        $table->string('trans_id')->nullable();
        $table->string('trans_date')->nullable();
        $table->string('amount')->nullable();
        $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
