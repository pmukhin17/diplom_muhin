<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldInExerc11ChaptersConnections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exerc_chapters_connections', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dispersion')->nullable()->comment('ссылка на id связи жеста с его переводом');
            $table->foreign('id_dispersion')->references('id')->on('exerc_word_sign_connections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exerc_chapters_connections', function (Blueprint $table) {
            $table->dropColumn('id_dispersion');
        });
    }
}
