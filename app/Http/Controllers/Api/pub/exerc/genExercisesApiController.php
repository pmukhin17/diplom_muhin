<?php

namespace App\Http\Controllers\Api\pub\exerc;

use App\Models\exerc\AssignmentBlocks;
use App\Models\exerc\BookPairs;
use App\Models\exerc\AssignmentsTraining;
use App\Models\exerc\ChapterConnections;
use App\Models\exerc\Chapters;
use App\Models\exerc\TasksBlocks;
use App\Models\exerc\TasksCheck;
use App\Models\exerc\Textbooks;
use App\Models\exerc\Workbooks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Carbon\Carbon;

use App\Http\Controllers\Api\pub\exerc\generator\gen;

class genExercisesApiController extends Controller
{
    /**
     * обновляет сразу набор записей в выбранной таблице
     * @src https://github.com/laravel/ideas/issues/575#issuecomment-626531732
     *
     * @param Request $request
     * @return mixed
     */

    private function updateMultiple( $table, $id_name, $values)
    {
        $ids = [];
        $params = [];
        $columnsGroups = [];
        $queryStart = "UPDATE {$table} SET";
        $columnsNames = array_keys(array_values($values)[0]);
        foreach ($columnsNames as $columnName) {
            $cases = [];
            $columnGroup = " " . $columnName . " = CASE ". $id_name ." ";
            foreach ($values as $id => $newData) {
                $cases[] = "WHEN {$id} then ?";
                $params[] = $newData[$columnName];
                $ids[$id] = "0";
            }
            $cases = implode(' ', $cases);
            $columnsGroups[] = $columnGroup . "{$cases} END";
        }
        $ids = implode(',', array_keys($ids));
        $columnsGroups = implode(',', $columnsGroups);
        $params[] = Carbon::now();
        $queryEnd = ", updated_at = ? WHERE ". $id_name ." in ({$ids})";
        return DB::update($queryStart . $columnsGroups . $queryEnd, $params);
    }

    public function chapters(Request $request)
    {

        $filter = [
            'id_pair' => $request->input('id_pair'),
        ];

        return Chapters::orderBy('num')
            ->where('id_pair', '=', $filter['id_pair'])
            ->get();
    }


    /**
     * Возвращает все упражнения (обучение в разрезе блоков + проверка в разрезе блоков) по полученной теме
     *
     * @param Request $request
     * @return mixed
     */
    public function exercises(Request $request)
    {
        $id_chapter = $request->input('id_chapter');

        $ret = [
            'assignments' => DB::table('exerc_assignment_blocks')
                ->where('id_chapter', '=', $id_chapter)
                ->join('exerc_assignments_training', 'exerc_assignment_blocks.id_assignment_block', '=', 'exerc_assignments_training.id_assignment_block')
                ->get(),

            'tasks' => DB::table('exerc_tasks_blocks')
                ->where('id_chapter', '=', $id_chapter)
                ->join('exerc_tasks_check', 'exerc_tasks_blocks.id_task_block', '=', 'exerc_tasks_check.id_task_block')
                ->get(),

        ];

        return $ret;
    }

    /**
     * генерация и валидация упражнений
     *
     * @param Request $request
     * @return mixed
     */
    public function gen(Request $request)
    {
        $id_chapter = $request->input('id_chapter');
        // TODO
        // $ret = [
        //     'assignments' => json_decode('{"1":{"name":"проанализируйте перевод на жесты","key":1,"lines":{"1":"Правитель третьего мира почивает<br>[Царь][Москва][отдых]","2":"Биссектриса будет равна пятнадцати<br>[биссектриса][прямо][=][15]","3":"Где сорочка и трусики?","4":"Доброе утро! Это солёные галеты и бульон.","5":"Гражданин! Это не мой тесак!","6":"Дядька милиционер был сосредоточен."}},"2":{"name":"проанализируйте перевод на жесты","key":2,"lines":{"7":"Бабуля немало Трудится.","8":"Хорош на сегодня бастовать.","9":"Захватывающее совещание было!","10":"Снимать одежду.","11":"Действительно, будь по вашему, аккуратней стройте."}}}'),

        //     'tasks' => json_decode('{"1":{"name":"1)","key":1,"lines":{"1":"Бабка два дня назад старалась.","2":"Биссектриса будет равна пятнадцати","3":"Где сорочка и трусики?","4":"Доброго здоровьица! Это солёные галеты к первому.","5":"Дядька из компетентных органов был внимателен."}},"2":{"name":"2)","key":2,"lines":{"6":"Забавное совещание было!","7":"Имеется огромное количество фонарей.","8":"Импераор московский передохнул.","9":"Конечно, договорились, водите аккуратнее.","10":"Мужик! это не мой тесак"}},"3":{"name":"3)","key":3,"lines":{"11":"Снимать одежду.","12":"Строим без участия одиннадцати юнцов.","13":"Третьего дня тётки закончили стройку.","14":"Хорош на сегодня бунтовать."}}}'),

        // ];

        $generator = new gen($id_chapter);

        $generator->prepare();
        $ret = $generator->gen();

        return $ret;
    }


    /**
     * сохранение одобренных клиентом упражнений
     *
     * @param Request $request
     * @return mixed
     */
    public function saveNewExerc(Request $request)
    { // TODO

        $cur_chapter = ($request->has('id_chapter') ? $request->input('id_chapter') : -1);
        $cur_data = $request->input('exerc');

        if ($request->has('id_chapter') && $request->has('exerc')) {
            return "200";
        } else return "400";
    }


    /**
     * репликация связей в таблицу с автоинкрементом
     *
     * @param Request $request
     * @return string
     */
    public function syncWordSignConnections(Request $request)
    {
        $hasErors = false;
        $chunk_size = $request->has('chunk_size') ? $request->input('chunk_size') : 1000;

        DB::table('exerc_word_sign_connections')->delete();

        DB::table('srd_surd_cross_words')->orderBy('id_jest')->chunk($chunk_size, function ($rows) {
            $inserts = [];
            foreach ($rows as $row) {

                $inserts[] = [
                    'id_word' => $row->{'id_word'},
                    'id_jest' => $row->{'id_jest'}
                ];
            }
            // print(json_encode($inserts));
            try {
                DB::table('exerc_word_sign_connections')->insert($inserts);
            } catch (\Exception $e) {
                $hasErors = true;
            }
        });

        return ("200" . " " . ($hasErors ? 'true' : 'false'));
    }

    /**
     * изменение наименование темы
     *
     * @param Request $request
     * @return string
     */
    public function changeChapterName(Request $request)
    {
        $id_chapter = $request->input('id_chapter');
        $chapter_name = $request->input('chapter_name');

        $affected = DB::table('exerc_chapters')->where('id_chapter', $id_chapter)->update(['chapter_name' => $chapter_name, 'updated_at' => Carbon::now()]);

        return ("200 ");
    }


    /**
     * вывод особо построенного результата по id жеста с указанием всех связанных слов и id связей между жестом и словом
     *
     * @param Request $request
     * @return mixed
     */
    public function getRelatedWords(Request $request)
    {
        $id_sign = $request->input('id_sign');

        $ret = [
            'sign' => DB::table('srd_surd_jest')
                ->where('id_jest', '=', $id_sign)->get(['jest', 'etymology', 'context_in', 'context_off']),
            'words' => DB::table('exerc_word_sign_connections')
                ->where('id_jest', '=', $id_sign)
                ->join('srd_surd_words', 'exerc_word_sign_connections.id_word', '=', 'srd_surd_words.id_word')
                ->orderBy('word', 'asc')
                ->get(['id as id_dispersion', 'word', DB::raw('FALSE as is_checked')])
        ];

        return $ret;
    }

    /**
     * сохранение нового набора связей для отдельной темы
     *
     * @param Request $request
     * @return mixed
     */
    public function getChapterSigns(Request $request)
    {
        $id_chapter = $request->input('id_chapter');

        // подгрузка всех доступных связей для жестов появляющихся в теме

        $basis = DB::table('srd_surd_jest as j')->whereIn('j.id_jest', function ($query) use ($id_chapter) {
            $query->select('tmp_d.id_jest')->from('exerc_chapters_connections')
                ->where('id_chapter', '=', $id_chapter)
                ->join('exerc_word_sign_connections as tmp_d', 'exerc_chapters_connections.id_dispersion', '=', 'tmp_d.id')
                ->groupBy('tmp_d.id_jest');
        })
            ->join('exerc_word_sign_connections as d', 'j.id_jest', '=', 'd.id_jest')
            ->join('srd_surd_words as w', 'd.id_word', '=', 'w.id_word')
            ->orderBy('w.word', 'asc')
            ->orderBy('id_dispersion', 'asc')
            ->get(['j.context_in', 'j.context_off', 'j.etymology', 'j.jest', 'w.word', 'd.id as id_dispersion', 'j.id_jest']);

        $sub_ret = [];
        foreach ($basis as $row) {
            $sub_ret[$row->id_jest]['sign'][0] = [
                'context_in' => $row->context_in,
                'context_off' => $row->context_off,
                'etymology' => $row->etymology,
                'jest' => $row->jest
            ];
            $sub_ret[$row->id_jest]['words'][$row->id_dispersion] = [
                'id_dispersion' => $row->id_dispersion,
                'is_checked' => 0,
                'word' => $row->word,
            ];
        }


        // подгрузка подтверденных связей жест-слово
        $raw_data = DB::table('exerc_chapters_connections')->where('id_chapter', '=', $id_chapter)
            ->join('exerc_word_sign_connections as d', 'exerc_chapters_connections.id_dispersion', '=', 'd.id')
            ->join('srd_surd_words as w', 'd.id_word', '=', 'w.id_word')
            ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
            ->get(['j.context_in', 'j.context_off', 'j.etymology', 'j.jest', 'w.word', 'd.id as id_dispersion', 'j.id_jest']);

        foreach ($raw_data as $row) {
            $sub_ret[$row->id_jest]['words'][$row->id_dispersion] = [
                'id_dispersion' => $row->id_dispersion,
                'is_checked' => 1,
                'word' => $row->word,
            ];
        }



        // удаление подпорок и приведение в нормальный вид итогового json
        $ret = [];
        foreach ($sub_ret as $row) {
            $tmp_words = [];
            foreach ($row['words'] as $value) {
                array_push($tmp_words, $value);
            };
            $row['words'] = $tmp_words;
            array_push($ret, $row);
        }
        // return $raw_data;
        return $ret;
    }

    /**
     * изменение наименования учебника по его ID
     *
     * @param Request $request
     * @return mixed
     */

    public function setWorkbookName(Request $request)
    {
        $id_workbook = $request->input('id_workbook');
        $workbook_name = $request->input('workbook_name');

        $affected = DB::table('exerc_workbooks')
            ->where('id_workbook', $id_workbook)
            ->update(['workbook_name' => $workbook_name, 'updated_at' => Carbon::now()]);


        if ($affected)
            return '200';
        else
            return abort(418, 'nothing to update');
    }
    /**
     * изменение наименования рабочей тетради по его ID
     *
     * @param Request $request
     * @return mixed
     */

    public function setTextbookName(Request $request)
    {
        $id_textbook = $request->input('id_textbook');
        $textbook_name = $request->input('textbook_name');

        $affected = DB::table('exerc_textbooks')
            ->where('id_textbook', $id_textbook)
            ->update(['textbook_name' => $textbook_name, 'updated_at' => Carbon::now()]);


        if ($affected)
            return '200';
        else
            return abort(418, 'nothing to update');
    }

    /**
     * снятие флага принадлежности к списку избранного отдельной пары
     *
     * @param Request $request
     * @return mixed
     */
    public function setPairUnFav(Request $request)
    {
        $id_pair = $request->input('id_pair');

        $affected = DB::table('exerc_pairs')
            ->where('id_pair', $id_pair)
            ->update(['is_favorite' => false]);


        if ($affected)
            return '200';
        else
            return abort(418, 'nothing to update');
    }

    /**
     * изменение отображаемого порядка тем
     *
     * на вход некая структура содержащая только изменившие положение номера,
     * на выходе сигнал о том произошли ли изменения
     *
     * @param Request $request
     * @return mixed
     */
    public function updChaptersPos(Request $request)
    {
        // $id_pair = $request->input('id_pair');
        //
        $ch_num = json_decode($request->input('ch_num'));

        $toApply = [];
        foreach ($ch_num as $row) {
            // array_push($toApply,[
            //     $row->id => ['num'=>$row->new_num]
            // ]);

            $toApply[$row->id] = ['num'=>$row->new_num, 'updated_at' => Carbon::now()];

        }
        $affected = $this->updateMultiple('exerc_chapters', 'id_chapter', $toApply);

        if ($affected)
            return '200';
        else
            return abort(418, 'nothing to update');
    }
/**
     * изменение значения настроек
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setSettings(Request $request)
    {
        // $id_pair = $request->input('id_pair');
        //
        $sett_id = $request->input('sett_id');
        $value = $request->input('value');


        $affected = DB::table('exerc_settings')
        ->where('id', $sett_id)
        ->update(['value' => $value]);

        if ($affected)
            return '200';
        else
            return abort(418, 'nothing to update');
    }

    /**
     * удалить пару из бд
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function delPair(Request $request)
    {
        $id_pair = $request->input('id_pair');

        $affected = DB::table('exerc_pairs')->where('id_pair',  $id_pair)->delete();

        if ($affected)
            return '200';
        else
            return abort(418, 'nothing were deleted');
    }

    /**
     * сохранить пару
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function savePair(Request $request)
    {
        $id_pair = $request->input('id_pair');

        $is_favorite = $request->input('is_favorite');
        $is_visible = $request->input('is_visible');
        $pair_name = $request->input('pair_name');


        $affected = DB::table('exerc_pairs')
            ->where('id_pair', $id_pair)
            ->update([
                'is_favorite' => $is_favorite,
                'is_visible' => $is_visible,
                'pair_name' => $pair_name,
            ]);

        if ($affected)
            return '200';
        else
            return abort(418, 'nothing to update');
    }

    /**
     * сохранение нового набора связей для отдельной темы
     *
     * @param Request $request
     * @return mixed
     */
    public function changeChapterSigns(Request $request)
    {
        $id_chapter = $request->input('id_chapter');
        $connections_list = $request->input('connections_list');

        $pac = [];
        foreach ($connections_list as $value) {
            array_push($pac, ['id_chapter' => $id_chapter, 'id_dispersion' => $value]);
        }
        if (count($pac) > 0) { // удалить текущие записи привязанные к теме
            DB::table('exerc_chapters_connections')->where('id_chapter', '=', $id_chapter)->delete();

            // сохранить новые записи
            $created = DB::table('exerc_chapters_connections')->insert($pac);
        } else
            return '400';

        return '200';
    }
}
