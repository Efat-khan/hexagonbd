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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('tel_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('designation')->nullable();
            $table->string('image')->nullable();
            $table->string('qualification')->nullable();
            $table->text('description')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('ln_link')->nullable();
            $table->string('wp_link')->nullable();
            $table->integer('order')->nullable();
            $table->enum('member_type',['team', 'management'])->default('team');
            $table->enum('status',['active', 'block'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
