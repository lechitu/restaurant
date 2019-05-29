<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovedUnnecessaryColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cafes', function( Blueprint $table ){
          $table->dropColumn('name');
          $table->dropColumn('restaurant');
          $table->dropColumn('website');
          $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('cafes', function( Blueprint $table ){
        $table->string('name')->after('id');
        $table->integer('restaurant')->after('longitude');
        $table->text('website')->after('restaurant');
        $table->text('description')->after('website');
      });
    }
}
