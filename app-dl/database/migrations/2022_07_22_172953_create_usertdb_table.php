<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsertdbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('usertdb')) {
            Schema::create('usertdb', function (Blueprint $table) {
                $table->unsignedBigInteger('id');
                $table->string('urltoken', 128);
                $table->string('mail', 516);
                $table->timestamps();
                $table->softDeletes();
                $table->tinyInteger('flag');
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
            Schema::dropIfExists('usertdb');
        }
}
