<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // la FK non è unique perché è una relazione One-to-Many (un utente può creare più post)
            $table->unsignedBigInteger('category_id');  // FK per collegamento con tabella Categories
            $table->string('title', 100);
            $table->string('image', 250)->nullable();
            $table->text('content');
            $table->string('slug', 105)->unique();
            $table->timestamps();

            // Definizione delle FK per user e category
            $table->foreign('user_id', 'category_id')
                ->references('id', 'id')
                ->on('users', 'categories')
                // ->onDelete('SET NULL');
                ;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
