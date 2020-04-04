<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubBidangTahunan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
      {
          //

           Schema::create('sub_urusan_tahunan', function (Blueprint $table) {
              $table->bigIncrements('id');
              $table->string('kode');
              $table->bigInteger('id_urusan')->unsigned();
              $table->bigInteger('id_sub_urusan')->unsigned();
              $table->integer('tahun');
              $table->unique(['id_urusan','id_sub_urusan','tahun']);;
              $table->timestamps();
              $table->unique(['kode','tahun']);
              $table->unique(['kode','id_sub_urusan','tahun']);
              $table->foreign('id_urusan')
              ->references('id')->on('master_urusan')
              ->onDelete('cascade')->onUpdate('cascade');
              $table->foreign('id_sub_urusan')
              ->references('id')->on('master_sub_urusan')
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
          Schema::dropIfExists('sub_urusan_tahunan');
      }
}
