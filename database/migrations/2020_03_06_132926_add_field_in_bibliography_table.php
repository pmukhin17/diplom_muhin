<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInBibliographyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('srd_surd_bibliography', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bibliography_type')->nullable();
            $table->foreign('id_bibliography_type')->references('id_bibliography_type')->on('srd_surd_bibliography_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('srd_surd_bibliography', function (Blueprint $table) {
            $table->dropColumn('id_bibliography_type');
        });
    }
}
