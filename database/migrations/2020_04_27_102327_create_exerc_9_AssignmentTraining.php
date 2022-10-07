<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerc9AssignmentTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        // AssignmentTraining
        Schema::create('exerc_assignments_training', function (Blueprint $table) {
            $table->bigIncrements('id_assignment_training')->comment('id упражнения для учебника');

            $table->unsignedBigInteger('id_assignment_block')->comment('ссылка на id блока упражнений для учебника');
            $table->foreign('id_assignment_block')->references('id_assignment_block')->on('exerc_assignment_blocks')->onDelete('cascade');

            $table->string('assignment_text', 255)->comment('текст упражнения');
        });
        DB::statement("ALTER TABLE exerc_assignments_training comment 'таблица, хранящая в себе список упражнений для учебника, имеет связь с таблицей exerc_assignment_blocks по FK'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('exerc_assignments_training');

    }
}
