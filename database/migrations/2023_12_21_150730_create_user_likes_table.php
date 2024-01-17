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
        Schema::create('user_likes', function (Blueprint $table) {
            $table->id();
            $table->boolean('like')->default(true);
            $table->timestamps();
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->unsignedBigInteger('reaction_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('reaction_id')->references('id')->on('reactions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_likes');
    }
};
