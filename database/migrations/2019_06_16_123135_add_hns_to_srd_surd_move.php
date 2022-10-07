<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHnsToSrdSurdMove extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('srd_surd_move', function (Blueprint $table) {
            $table->unsignedBigInteger('id_movement')->nullable();
            $table->unsignedBigInteger('id_move_diacritics')->nullable();
            $table->string('pic', 128)->nullable();

            $table->foreign('id_movement')->references('id_movement')->on('srd_hns_move_not');
            $table->foreign('id_move_diacritics')->references('id_move_diacritics')->on('srd_hns_move_diacritics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('srd_surd_move', function (Blueprint $table) {
            $table->dropForeign('srd_surd_move_id_movement_foreign');
            $table->dropForeign('srd_surd_move_id_move_diacritics_foreign');

            $table->dropColumn('id_movement');
            $table->dropColumn('id_move_diacritics');
            $table->dropColumn('pic', 128);
        });
    }
}
