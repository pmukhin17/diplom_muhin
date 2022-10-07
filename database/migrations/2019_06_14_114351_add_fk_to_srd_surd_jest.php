<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkToSrdSurdJest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('srd_surd_jest', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jest_paradigm')->nullable();
            $table->unsignedBigInteger('id_jest_obraz')->nullable();
            $table->unsignedBigInteger('id_style')->nullable();
            $table->unsignedBigInteger('id_vid')->nullable();
            $table->unsignedBigInteger('id_dialect')->nullable();
            $table->unsignedBigInteger('id_actual')->nullable();
            $table->unsignedBigInteger('id_move')->nullable();
            $table->unsignedBigInteger('id_tema')->nullable();
            $table->unsignedBigInteger('id_conf_begin')->nullable();
            $table->unsignedBigInteger('id_conf_end')->nullable();
            $table->unsignedBigInteger('id_conf_offhand_begin')->nullable();
            $table->unsignedBigInteger('id_conf_offhand_end')->nullable();

            $table->foreign('id_jest_paradigm')->references('id_jest')->on('srd_surd_jest');
            $table->foreign('id_jest_obraz')->references('id_jest')->on('srd_surd_jest');
            $table->foreign('id_style')->references('id_style')->on('srd_surd_style');
            $table->foreign('id_vid')->references('id_vid')->on('srd_surd_vid');
            $table->foreign('id_dialect')->references('id_dialect')->on('srd_surd_dialect');
            $table->foreign('id_actual')->references('id_actual')->on('srd_surd_actual');
            $table->foreign('id_move')->references('id_move')->on('srd_surd_move');
            $table->foreign('id_tema')->references('id_tema')->on('srd_surd_tema');
            $table->foreign('id_conf_begin')->references('id_conf')->on('srd_surd_conf');
            $table->foreign('id_conf_end')->references('id_conf')->on('srd_surd_conf');
            $table->foreign('id_conf_offhand_begin')->references('id_conf')->on('srd_surd_conf');
            $table->foreign('id_conf_offhand_end')->references('id_conf')->on('srd_surd_conf');
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
            $table->dropForeign('srd_surd_jest_id_jest_paradigm_foreign');
            $table->dropForeign('srd_surd_jest_id_jest_obraz_foreign');
            $table->dropForeign('srd_surd_jest_id_style_foreign');
            $table->dropForeign('srd_surd_jest_id_vid_foreign');
            $table->dropForeign('srd_surd_jest_id_dialect_foreign');
            $table->dropForeign('srd_surd_jest_id_actual_foreign');
            $table->dropForeign('srd_surd_jest_id_move_foreign');
            $table->dropForeign('srd_surd_jest_id_tema_foreign');
            $table->dropForeign('srd_surd_jest_id_conf_begin_foreign');
            $table->dropForeign('srd_surd_jest_id_conf_end_foreign');
            $table->dropForeign('srd_surd_jest_id_conf_offhand_begin_foreign');
            $table->dropForeign('srd_surd_jest_id_conf_offhand_end_foreign');

            $table->dropColumn('id_jest_paradigm');
            $table->dropColumn('id_jest_obraz');
            $table->dropColumn('id_style');
            $table->dropColumn('id_vid');
            $table->dropColumn('id_dialect');
            $table->dropColumn('id_actual');
            $table->dropColumn('id_move');
            $table->dropColumn('id_tema');
            $table->dropColumn('id_conf_begin');
            $table->dropColumn('id_conf_end');
            $table->dropColumn('id_conf_offhand_begin');
            $table->dropColumn('id_conf_offhand_end');
           });
    }
}
