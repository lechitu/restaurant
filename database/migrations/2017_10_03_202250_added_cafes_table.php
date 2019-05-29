<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedCafesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cafes', function( Blueprint $table ){
        $table->increments('id');
        $table->string('name');
        $table->text('address');
        $table->string('city');
        $table->string('zip');
        $table->decimal('latitude', 12, 8)->nullable();
        $table->decimal('longitude', 12, 8)->nullable();
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
        Schema::dropIfExists('cafes');
    }
}
