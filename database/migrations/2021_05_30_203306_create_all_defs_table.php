<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllDefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_defs', function (Blueprint $table) {
            $table->integer('id_term')->unsigned()->comment('id понятия');
            $table->string('article')->comment('Заголовок словарной статьи');
            $table->text('definition')->comment('Определение');
            $table->text('lit_pr')->comment('Литературный пример')->nullable();
            $table->text('lit_ist')->comment('Источник литературного примера')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_defs');
    }
}
