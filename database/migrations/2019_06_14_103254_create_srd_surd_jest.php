<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSrdSurdJest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * Если очень захочется можно переписать комментарии к колонкам таблицы
         * Для этого можно использовать метод comment у объекта колонны
         * ----
         * Так же в этой миграции создаются только базовые поля, без связей,
         * поля с FK создаются в другой миграции для более удобного редактирования БД
         */
        Schema::create('srd_surd_jest', function (Blueprint $table) {
            $table->bigIncrements('id_jest');
            // Индексация поля jest необходима для оптимизации поиска по БД
            $table->string('jest', 256)->index('jest_name_index');
            $table->longText('description')->nullable();
            $table->text('etymology')->nullable();
            $table->enum('paradigm_root', ['неопределено', 'корень', 'ветвь', 'не входит в кусты'])->nullable();
            $table->enum('obraz_root', ['неопределено', 'корень', 'ветвь', 'не входит в кусты'])->nullable();
            $table->boolean('hand_double')->nullable();
            $table->text('context_in')->nullable();
            $table->text('context_off')->nullable();
            $table->text('note')->nullable();
            // Статусы
            $table->boolean('state')->default(0);
            $table->boolean('admin_checked')->default(0);
            $table->boolean('nedooformleno')->default(1);
            $table->boolean('deviant')->default(0);
            // Даты created_at и updated_at (аналоги в старой БД: created и edited)
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
        Schema::dropIfExists('srd_surd_jest');
    }
}
