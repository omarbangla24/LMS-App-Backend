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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_no');
            $table->rememberToken();
            $table->timestamps();
            $table->string('token');
            $table->string('address');
            $table->string('usertype');
            $table->integer('age');
            $table->string('profile_image_path');
            $table->integer('otp');
            $table->string('ref_code');
            $table->string('professions_id');
            $table->string('bkash_mobile');
            $table->string('trans_id');
            $table->string('trans_date');
            $table->string('amount');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
