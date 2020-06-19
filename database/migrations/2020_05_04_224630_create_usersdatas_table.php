<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersdatas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('role_taxonomy');
            $table->string('profile_image');
            $table->string('contacts');
            $table->string('series_access');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usersdatas');
    }
}
