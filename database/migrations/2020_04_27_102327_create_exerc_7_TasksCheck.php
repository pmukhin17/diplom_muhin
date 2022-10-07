<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc7TasksCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {



        // TasksCheck
        Schema::create('exerc_tasks_check', function (Blueprint $table) {
            $table->bigIncrements('id_task_check')->comment('id упражнения для рабочей тетради');

            $table->unsignedBigInteger('id_task_block')->comment('ссылка на id блока упражнений для рабочей тетради');
            $table->foreign('id_task_block')->references('id_task_block')->on('exerc_tasks_blocks')->onDelete('cascade');

            $table->string('task_text', 255)->comment('текст упражнения');
        });
        DB::statement("ALTER TABLE exerc_tasks_check comment 'таблица, хранящая в себе список упражнений для рабочей тетради, имеет связь с таблицей exerc_tasks_blocks по FK'");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_tasks_check');

    }
}
