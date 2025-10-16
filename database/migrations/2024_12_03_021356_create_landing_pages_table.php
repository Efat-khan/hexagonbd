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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('logo_image')->nullable();
            $table->string('web_title')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('wp_link')->nullable();
            $table->string('in_link')->nullable();
            $table->string('x_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('about_title')->nullable();
            $table->text('about_sort_description')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();
            $table->text('who_we_are_text')->nullable();
            $table->string('who_we_are_image')->nullable();
            $table->binary('show_slogan')->default(0);
            $table->string('slogan')->nullable();
            $table->integer('employees_number')->nullable();
            $table->integer('office_number')->nullable();
            $table->string('office_time_text')->nullable();
            $table->integer('warehouse_number')->nullable();
            $table->integer('successful_project_number')->nullable();
            $table->integer('satisfied_client_percentage_number')->nullable();
            $table->integer('awards_own_number')->nullable();
            $table->string('video_link')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->text('gps_location')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('copyright_link')->nullable();
            $table->string('developer_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};
