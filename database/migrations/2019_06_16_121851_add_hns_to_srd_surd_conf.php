<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHnsToSrdSurdConf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('srd_surd_conf', function (Blueprint $table) {
            $table->unsignedBigInteger('id_config_notation')->nullable();
            $table->unsignedBigInteger('id_thumbmode')->nullable();
            $table->unsignedBigInteger('id_fingersmode')->nullable();
            $table->unsignedBigInteger('id_finger_collide1')->nullable();
            $table->unsignedBigInteger('id_finger_collide2')->nullable();
            $table->unsignedBigInteger('id_finger_collide3')->nullable();
            $table->string('pic', 128)->nullable();

            $table->foreign('id_config_notation')
                ->references('id_config_notation')->on('srd_hns_config_notation');
            $table->foreign('id_thumbmode')
                ->references('id_thumbmode')->on('srd_hns_thumbmode');
            $table->foreign('id_fingersmode')
                ->references('id_fingersmode')->on('srd_hns_fingersmode');
            $table->foreign('id_finger_collide1')
                ->references('id_fingercollide')->on('srd_hns_fingercollide');
            $table->foreign('id_finger_collide2')
                ->references('id_fingercollide')->on('srd_hns_fingercollide');
            $table->foreign('id_finger_collide3')
                ->references('id_fingercollide')->on('srd_hns_fingercollide');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('srd_surd_conf', function (Blueprint $table) {
            $table->dropForeign('srd_surd_conf_id_config_notation_foreign');
            $table->dropForeign('srd_surd_conf_id_thumbmode_foreign');
            $table->dropForeign('srd_surd_conf_id_fingersmode_foreign');
            $table->dropForeign('srd_surd_conf_id_finger_collide1_foreign');
            $table->dropForeign('srd_surd_conf_id_finger_collide2_foreign');
            $table->dropForeign('srd_surd_conf_id_finger_collide3_foreign');

            $table->dropColumn('id_config_notation');
            $table->dropColumn('id_thumbmode');
            $table->dropColumn('id_fingersmode');
            $table->dropColumn('id_finger_collide1');
            $table->dropColumn('id_finger_collide2');
            $table->dropColumn('id_finger_collide3');
            $table->dropColumn('pic');
        });
    }
}
