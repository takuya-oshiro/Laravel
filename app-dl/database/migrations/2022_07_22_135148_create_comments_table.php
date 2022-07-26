<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
              $table->id();
              $table->unsignedBigInteger('post_id');
              $table->unsignedBigInteger('user_id');
              $table->string('comment', 191);
              $table->timestamps();
              $table->softDeletes();
      
              $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
              $table->foreign('post_id')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('CASCADE');
            });
          }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
