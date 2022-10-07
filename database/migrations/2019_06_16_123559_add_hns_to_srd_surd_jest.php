<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHnsToSrdSurdJest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('srd_surd_jest', function (Blueprint $table) {
            $table->string('notation_formula')->nullable();
            $table->unsignedBigInteger('id_location')->nullable();
            $table->unsignedBigInteger('id_orient')->nullable();
            $table->unsignedBigInteger('id_sym_marker')->nullable();
            
            $table->foreign('id_location')->references('id_location')->on('srd_hns_location');
            $table->foreign('id_orient')->references('id_orientation')->on('srd_hns_orientation');
            $table->foreign('id_sym_marker')->references('id_sym_marker')->on('srd_hns_sym_marker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('srd_surd_jest', function (Blueprint $table) {
            $table->dropForeign('srd_surd_jest_id_location_foreign');
            $table->dropForeign('srd_surd_jest_id_orient_foreign');
            $table->dropForeign('srd_surd_jest_id_sym_marker_foreign');

            $table->dropColumn('notation_formula');
            $table->dropColumn('id_location');
            $table->dropColumn('id_orient');
            $table->dropColumn('id_sym_marker');
        });
    }
}
