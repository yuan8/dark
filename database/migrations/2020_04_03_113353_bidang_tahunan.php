<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BidangTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
      {
          //

           Schema::create('urusan_tahunan', function (Blueprint $table) {
              $table->bigIncrements('id');
              $table->string('kode');
              $table->bigInteger('id_urusan')->unsigned();
              $table->integer('tahun');
              $table->unique(['id_urusan','tahun']);;
              $table->timestamps();
              $table->unique(['kode','tahun']);
              $table->unique(['kode','id_urusan','tahun']);
              $table->foreign('id_urusan')
              ->references('id')->on('master_urusan')
              ->onDelete('cascade')->onUpdate('cascade');
          });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
          //
          Schema::dropIfExists('urusan_tahunan');
      }
}
