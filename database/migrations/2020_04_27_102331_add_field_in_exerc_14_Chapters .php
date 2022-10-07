<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  AddFieldInExerc14Chapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exerc_chapters', function (Blueprint $table) {
            $table->integer('num')->default(1)->comment('номер темы');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exerc_chapters', function (Blueprint $table) {
            $table->dropColumn('num');
        });
    }
}
