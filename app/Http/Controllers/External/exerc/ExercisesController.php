<?php

namespace App\Http\Controllers\External\exerc;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\exerc\AssignmentBlocks;
use App\Models\exerc\BookPairs;
use App\Models\exerc\AssignmentsTraining;
use App\Models\exerc\ChapterConnections;
use App\Models\exerc\Chapters;
use App\Models\exerc\TasksBlocks;
use App\Models\exerc\TasksCheck;
use App\Models\exerc\Textbooks;
use App\Models\exerc\Workbooks;
use Illuminate\Support\Facades\Auth;

use DB;
use Carbon\Carbon;

class ExercisesController extends Controller
{
    // подгрузка данных из бд + генеративный алгоритм

    /* описание обрабатываемой информации в бд (data flow)

    * подготовка данных для интерфейса генерации
    -
    * генерация

    */


    /*////////////////////////////////////////////////*/
    // приветные функции
    /*////////////////////////////////////////////////*/
    private function get($var)
    {   //TODO
        /* подгрузка существующих сгенерированных и сохраненных задач

        SELECT  ch.chapter_name, bl.id_assignment_block, bl.block_name, tr.assignment_text
        FROM exerc_chapters as ch
        LEFT JOIN exerc_assignment_blocks as bl on bl.id_chapter=ch.id_chapter
        LEFT JOIN exerc_assignments_training as tr on tr.id_assignment_block=bl.id_assignment_block
        where ch.id_pair = 1 and bl.id_chapter is not NULL

        */

        return [];
    }
    private function SaveCopyOfWordsToSignsDispersion()
    {   // является единственной ответственной точкой входа для контента
        /*
        * данная функция существует лишь для ого чтобы не изменять PK в таблице srd_surd_cross_words
        * для того чтобы не пришлось перебирать всю кодобазу всего лишь для
        * внедрения инкремента и связи значений с таблицей exerc_chapters_connections
        */
        // опустошение тек значений таблицы

        // копирование информации (~ 35к значений на апрель 2020)

        return [];
    }
    private function AccessTypeIndeteficator(){
        /*
        * 0 - не зарегистрированный пользователь
        * 1 - зарегистрированный пользователь
        * 2 - админ
        */
        return (Auth::check() ? (Auth::user()->hasRole('admin') ? 2 : 1) : 0 );
    }


    /*////////////////////////////////////////////////*/
    // публичные функции
    /*////////////////////////////////////////////////*/
    public function index(Request $request)
    {
        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('is_visible', true)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->get(['id_pair','pair_name', 'exerc_pairs.updated_at', 'textbook_name', 'workbook_name']);

        return view('layouts.exerc.index', ['curData' => $req, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function gen(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        // TODO
        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('is_visible', true)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->get(['id_pair','pair_name', 'exerc_pairs.updated_at', 'textbook_name', 'workbook_name']);

        return view('layouts.exerc.gen', ['curData' => $req, 'PrefabPos' => $prefab, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function apidoc(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        // TODO
        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('is_visible', true)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->get(['id_pair','pair_name', 'exerc_pairs.updated_at', 'textbook_name', 'workbook_name']);

        return view('layouts.exerc.apidoc', ['curData' => $req, 'PrefabPos' => $prefab, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function text_list(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        // подгрузка всех доступных учебников + инфа по ним

        $req = DB::table('exerc_pairs')->where('is_visible', true)
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
        ->get(['id_pair as uid', DB::raw('CONCAT(textbook_name ," | ", pair_name) as name'), 'exerc_textbooks.created_at', 'exerc_textbooks.updated_at']);
        $name = 'рабочая тетрадь';
        $links = [
        'new' => route('text_change'),
        'change_base' => route('text_change'),
        'read_base' => route('text_read'),
        'id_name' => 'id_pair',
    ];
    return view('layouts.exerc.data_list', ['curData' => $req, 'PrefabPos' => $prefab, 'rowType' => $name, 'linksMass'=>$links, 'auth_user' => $this->AccessTypeIndeteficator() ]);
    }

    public function text_change(Request $request)
    {
        $pre_pair = ($request->has('id_pair') ? $request->input('id_pair') : -1);

        //
        // подгрузка списка тем по выбранной паре
        $chapters_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->get(['id_chapter', 'chapter_name']);
        // сборка списка подгружаемых тем
        $chapters = [];
        foreach ($chapters_raw as $row) {
            $chapters[$row->id_chapter]['name'] = $row->chapter_name;
        }
        // подгрузка списка тем и информации по жестам и словам по выбранной паре
        $chapters_words_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->join('exerc_chapters_connections', 'exerc_chapters.id_chapter', '=', 'exerc_chapters_connections.id_chapter')
        ->join('exerc_word_sign_connections as d', 'exerc_chapters_connections.id_dispersion', '=', 'd.id')
        ->join('srd_surd_words as w', 'd.id_word', '=', 'w.id_word')
        ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
        ->get(['chapter_name', 'jest', 'word', 'exerc_chapters.id_chapter', 'd.id_word', 'd.id_jest']);
        // добавление в структуру словарь
        foreach ($chapters_words_raw as $row) {
            $chapters[$row->id_chapter]['name'] = $row->chapter_name;
            $chapters[$row->id_chapter]['signs'][$row->id_jest]['name'] = $row->jest;
            $chapters[$row->id_chapter]['signs'][$row->id_jest]['words'][$row->id_word] = $row->word;
        }
        // подгрузка списка тем и информации по упражнениям по выбранной паре
        $chapters_exerc_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->join('exerc_assignment_blocks', 'exerc_chapters.id_chapter', '=', 'exerc_assignment_blocks.id_chapter')
        ->join('exerc_assignments_training', 'exerc_assignment_blocks.id_assignment_block', '=', 'exerc_assignments_training.id_assignment_block')
        ->get(['exerc_chapters.id_chapter', 'exerc_assignment_blocks.id_assignment_block as block_id', 'block_name', 'exerc_assignments_training.id_assignment_training', 'assignment_text']);
        // добавление в структуру упражнений
        foreach ($chapters_exerc_raw as $row) {
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['name'] = $row->block_name;
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['list'][$row->id_assignment_training] = $row->assignment_text;
        }




        $req = [
            'name'=>DB::table('exerc_pairs')->where('id_pair', '=', $pre_pair)
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->value('textbook_name'),
            'chapters'=> $chapters

        ];

        $meta = [
            'type'=>'Учебник',
            'pair_id'=>$pre_pair,
            'ch_name_lnk'=> route('api.exerc.workbook.chname'),
            'id_name'=>'id_workbook',
        ];

        return view('layouts.exerc.book_change', ['curData' => $req, 'meta'=>$meta, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function text_read(Request $request)
    {

            $pre_pair = ($request->has('id_pair') ? $request->input('id_pair') : -1);

        //
        // подгрузка списка тем по выбранной паре
        $chapters_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->get(['id_chapter', 'chapter_name']);
        // сборка списка подгружаемых тем
        $chapters = [];
        foreach ($chapters_raw as $row) {
            $chapters[$row->id_chapter]['name'] = $row->chapter_name;
        }
        // подгрузка списка тем и информации по жестам и словам по выбранной паре
        $chapters_words_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->join('exerc_chapters_connections', 'exerc_chapters.id_chapter', '=', 'exerc_chapters_connections.id_chapter')
        ->join('exerc_word_sign_connections as d', 'exerc_chapters_connections.id_dispersion', '=', 'd.id')
        ->join('srd_surd_words as w', 'd.id_word', '=', 'w.id_word')
        ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
        ->get(['chapter_name', 'jest', 'word', 'exerc_chapters.id_chapter', 'd.id_word', 'd.id_jest']);
        // добавление в структуру словарь
        foreach ($chapters_words_raw as $row) {
            $chapters[$row->id_chapter]['name'] = $row->chapter_name;
            $chapters[$row->id_chapter]['signs'][$row->id_jest]['name'] = $row->jest;
            $chapters[$row->id_chapter]['signs'][$row->id_jest]['words'][$row->id_word] = $row->word;
        }
        // подгрузка списка тем и информации по упражнениям по выбранной паре
        $chapters_exerc_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->join('exerc_assignment_blocks', 'exerc_chapters.id_chapter', '=', 'exerc_assignment_blocks.id_chapter')
        ->join('exerc_assignments_training', 'exerc_assignment_blocks.id_assignment_block', '=', 'exerc_assignments_training.id_assignment_block')
        ->get(['exerc_chapters.id_chapter', 'exerc_assignment_blocks.id_assignment_block as block_id', 'block_name', 'exerc_assignments_training.id_assignment_training', 'assignment_text']);
        // добавление в структуру упражнений
        foreach ($chapters_exerc_raw as $row) {
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['name'] = $row->block_name;
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['list'][$row->id_assignment_training] = $row->assignment_text;
        }




        $req = [
            'name'=>DB::table('exerc_pairs')->where('id_pair', '=', $pre_pair)
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->value('textbook_name'),
            'chapters'=> $chapters

        ];


        return view('layouts.exerc.book_read', ['curData' => $req, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }


    public function work_list(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('is_visible', true)
        ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
        // DB::table('exerc_workbooks')
            // ->get()
            ->get(['id_pair as uid', DB::raw('CONCAT(workbook_name ," | ", pair_name) as name'), 'exerc_workbooks.created_at', 'exerc_workbooks.updated_at']);
        $name = 'учебник';
        $links = [
            'new' => route('work_change'),
            'change_base' => route('work_change'),
            'read_base' => route('work_read'),
            'id_name' => 'id_pair',
        ];
        return view('layouts.exerc.data_list', ['curData' => $req, 'PrefabPos' => $prefab, 'rowType' => $name, 'linksMass'=>$links, 'auth_user' => $this->AccessTypeIndeteficator() ]);
    }

    public function work_change(Request $request)
    {
        $pre_pair = ($request->has('id_pair') ? $request->input('id_pair') : -1);

        //
        // подгрузка списка тем по выбранной паре
        $chapters_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->get(['id_chapter', 'chapter_name']);
        // сборка списка подгружаемых тем
        $chapters = [];
        foreach ($chapters_raw as $row) {
            $chapters[$row->id_chapter]['name'] = $row->chapter_name;
        }
        // подгрузка списка тем и информации по упражнениям по выбранной паре
        $chapters_exerc_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->join('exerc_tasks_blocks', 'exerc_chapters.id_chapter', '=', 'exerc_tasks_blocks.id_chapter')
        ->join('exerc_tasks_check', 'exerc_tasks_blocks.id_task_block', '=', 'exerc_tasks_check.id_task_block')
        ->get(['exerc_chapters.id_chapter', 'exerc_tasks_blocks.id_task_block as block_id', 'block_name', 'exerc_tasks_check.id_task_check', 'task_text']);
        // добавление в структуру упражнений
        foreach ($chapters_exerc_raw as $row) {
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['name'] = $row->block_name;
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['list'][$row->id_task_check] = $row->task_text;
        }




        $req = [
            'name'=>DB::table('exerc_pairs')->where('id_pair', '=', $pre_pair)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->value('workbook_name'),
            'chapters'=> $chapters

        ];

        $meta = [
            'type'=>'Рабочая тетрадь',
            'pair_id'=>$pre_pair,
            'ch_name_lnk'=> route('api.exerc.textbook.chname'),
            'id_name'=>'id_textbook',
        ];

        return view('layouts.exerc.book_change', ['curData' => $req, 'meta'=>$meta, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function work_read(Request $request)
    {

        $pre_pair = ($request->has('id_pair') ? $request->input('id_pair') : -1);

        //
        // подгрузка списка тем по выбранной паре
        $chapters_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->get(['id_chapter', 'chapter_name']);
        // сборка списка подгружаемых тем
        $chapters = [];
        foreach ($chapters_raw as $row) {
            $chapters[$row->id_chapter]['name'] = $row->chapter_name;
        }
        // подгрузка списка тем и информации по упражнениям по выбранной паре
        $chapters_exerc_raw = DB::table('exerc_chapters')->where('id_pair', '=', $pre_pair)->orderBy('num')
        ->join('exerc_tasks_blocks', 'exerc_chapters.id_chapter', '=', 'exerc_tasks_blocks.id_chapter')
        ->join('exerc_tasks_check', 'exerc_tasks_blocks.id_task_block', '=', 'exerc_tasks_check.id_task_block')
        ->get(['exerc_chapters.id_chapter', 'exerc_tasks_blocks.id_task_block as block_id', 'block_name', 'exerc_tasks_check.id_task_check', 'task_text']);
        // добавление в структуру упражнений
        foreach ($chapters_exerc_raw as $row) {
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['name'] = $row->block_name;
            $chapters[$row->id_chapter]['exerc'][$row->block_id]['list'][$row->id_task_check] = $row->task_text;
        }




        $req = [
            'name'=>DB::table('exerc_pairs')->where('id_pair', '=', $pre_pair)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->value('workbook_name'),
            'chapters'=> $chapters

        ];


        return view('layouts.exerc.book_read', ['curData' => $req, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function pair_list(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        // TODO
        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('is_visible', true)
        ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
        ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
        ->get(['id_pair as uid', 'pair_name as name', 'exerc_pairs.created_at', 'exerc_pairs.updated_at', 'textbook_name', 'exerc_pairs.id_textbook', 'workbook_name', 'exerc_pairs.id_workbook']);

        $name = 'пара';

        $links = [
        'new' => route('pair_change'),
        'read_base' => route('pair_change'),
        'change_base' => route('pair_change'),
        'id_name' => 'id_pair',
        'spec_pair' => [
            'look_w'=> route('work_read'),
            'ch_w'=> route('work_change'),
            'look_t'=> route('text_read'),
            'ch_t'=> route('text_change'),
        ],
    ];
    return view('layouts.exerc.data_list', ['curData' => $req, 'PrefabPos' => $prefab, 'rowType' => $name, 'linksMass'=>$links, 'auth_user' => $this->AccessTypeIndeteficator() ]);
    }

    public function pair_change(Request $request)
    {
        // префаб параметров при редиректе

        $id_pair = ($request->has('id_pair') ? $request->input('id_pair') : -1);

        //
        if ($request->has('new')) {
            // создание новой пары
            $tmpname_pair = 'временное наименование пары';
            $tmpname_work = 'временное наименование учебника';
            $tmpname_text = 'временное наименование рабочей тетради';

            $id_pair = DB::table('exerc_pairs')->insertGetId(
                [
                    'pair_name' => $tmpname_pair,
                    'id_workbook' => DB::table('exerc_workbooks')->insertGetId(['workbook_name' => $tmpname_work, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]),
                    'id_textbook' => DB::table('exerc_textbooks')->insertGetId(['textbook_name' => $tmpname_text, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]),
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now(),
                 ]
            );
        }
        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('id_pair', $id_pair)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->first();
            // ['id_pair', 'exerc_pairs.updated_at', 'textbook_name', 'workbook_name']

        return view('layouts.exerc.pair_change', ['curData' => $req, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function pair_fav(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        // подгрузка избранных пар
        $req = DB::table('exerc_pairs')->where('is_favorite', true)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->get(['id_pair','pair_name', 'exerc_pairs.updated_at', 'textbook_name', 'exerc_pairs.id_textbook', 'workbook_name', 'exerc_pairs.id_workbook']);

        return view('layouts.exerc.pair_fav', ['curData' => $req, 'PrefabPos' => $prefab, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function set_basic(Request $request)
    {
        $codename = 'basic';
        //
        // загрузка информации о общих настройках
        $req = DB::table('exerc_settings')->where('codename', $codename)->get();

        if (count($req) == 0){
            // вшитые настройки по умолчанию
            DB::table('exerc_settings')->insert([
                ['codename'=>$codename, "setings_name"=>'поддержка системы избранных пар', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableFav', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'показ списка учебников', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableTextbookList', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'показ списка рабочих тетрадей', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableWorkbookList', 'value'=> true]) ],
            ]);
           $req = DB::table('exerc_settings')->where('codename', $codename)->get();
        }

        return view('layouts.exerc.settings', ['curData' => $req, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function set_api(Request $request)
    {
        $codename = 'api';
        //
        // загрузка информации о общих настройках
        $req = DB::table('exerc_settings')->where('codename', $codename)->get();

        if (count($req) == 0){
            // вшитые настройки по умолчанию
            DB::table('exerc_settings')->insert([
                ['codename'=>$codename, "setings_name"=>'доступ к списку учебников', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAPIText', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'доступ к списку тетрадей', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAPIWork', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'доступ к списку пар', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAPIPair', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'доступ к темам', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAPIChapter', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'доступ к упражнениям для обучения', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAPIAssign', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'доступ к упражнениям для проверки', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAPITask', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'выдавать дату и время создания', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAPIDatetime', 'value'=> true]) ],
            ]);
           $req = DB::table('exerc_settings')->where('codename', $codename)->get();
        }

        return view('layouts.exerc.settings', ['curData' => $req, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function set_gen(Request $request)
    {
        $codename = 'gen';
        //
        // загрузка информации о общих настройках
        $req = DB::table('exerc_settings')->where('codename', $codename)->get();

        if (count($req) == 0){
            // вшитые настройки по умолчанию
            DB::table('exerc_settings')->insert([
                ['codename'=>$codename, "setings_name"=>'минимальная длина предложения', 'value'=>json_encode (['type'=>'number', 'index'=>'numMinLen', 'value'=> 3]) ],
                ['codename'=>$codename, "setings_name"=>'максимальная длина предложения', 'value'=>json_encode (['type'=>'number', 'index'=>'numMaxLen', 'value'=> 10]) ],
                ['codename'=>$codename, "setings_name"=>'количество блоков упражнений для учебника', 'value'=>json_encode (['type'=>'number', 'index'=>'numAssignBlockAmount', 'value'=> 5]) ],
                ['codename'=>$codename, "setings_name"=>'шаблон наименования блоков упражнений для учебника', 'value'=>json_encode (['type'=>'text', 'index'=>'numAssignBlockName', 'value'=> 'index)']) ],
                ['codename'=>$codename, "setings_name"=>'количество предложений в каждом блоке упражнений для учебника', 'value'=>json_encode (['type'=>'number', 'index'=>'numAssignBlockSize', 'value'=> 5]) ],
                ['codename'=>$codename, "setings_name"=>'добавлять ссылки на слова в упражнения для учебника', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableAssignLinks', 'value'=> true]) ],
                ['codename'=>$codename, "setings_name"=>'количество блоков упражнений для рабочей тетради', 'value'=>json_encode (['type'=>'number', 'index'=>'numTaskBlockAmount', 'value'=> 5]) ],
                ['codename'=>$codename, "setings_name"=>'шаблон наименования блоков упражнений для рабочей тетради', 'value'=>json_encode (['type'=>'text', 'index'=>'numTaskBlockName', 'value'=> 'index)']) ],
                ['codename'=>$codename, "setings_name"=>'количество предложений в каждом блоке упражнений для рабочей тетради', 'value'=>json_encode (['type'=>'number', 'index'=>'numTaskBlockSize', 'value'=> 5]) ],
                ['codename'=>$codename, "setings_name"=>'учитывать полное покрытие вокобуляра при создании упражнений', 'value'=>json_encode (['type'=>'checkbox', 'index'=>'enableVocFullfill', 'value'=> true]) ],
            ]);
           $req = DB::table('exerc_settings')->where('codename', $codename)->get();
        }

        return view('layouts.exerc.settings', ['curData' => $req, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function chapt_pos(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        // TODO
        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('is_visible', true)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->get(['id_pair','pair_name', 'exerc_pairs.updated_at', 'textbook_name', 'workbook_name']);

        return view('layouts.exerc.chapter_pos', ['curData' => $req, 'PrefabPos' => $prefab, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function chapt_pos_stat(Request $request)
    {
        $id_pair = ($request->has('id_pair') ? $request->input('id_pair') : -1);
        //
        // подгрузка статистики

        $tmp_get_connections1 = DB::table('exerc_chapters_connections')->where('id_chapter', '=', $id_pair)
        ->join('exerc_word_sign_connections as d', 'exerc_chapters_connections.id_dispersion', '=', 'd.id');
        $tmp_get_connections2 = clone $tmp_get_connections1;
        $tmp_get_connections3 = clone $tmp_get_connections1;
        $tmp_get_connections4 = clone $tmp_get_connections1;
        $req = [
            [
                'name'=>'количество жестов',
                'data'=>$tmp_get_connections1->groupBy('d.id_jest')->count()
            ],
            [
                'name'=>'количество слов',
                'data'=>
                $tmp_get_connections2->count()
            ],
            [
                'name'=>'список недооформленных жестов жестов',
                'data'=>$tmp_get_connections3
                ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
                ->groupBy('j.id_jest')
                ->where('nedooformleno', true)
                ->get(['j.id_jest as id', 'j.jest as text'])
            ],
            [
                'name'=>'список непроверенных жестов жестов',
                'data'=>$tmp_get_connections4
                ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
                ->groupBy('j.id_jest')
                ->where('admin_checked', true)
                ->get(['j.id_jest as id', 'j.jest as text'])
            ],
        ];
        return view('layouts.exerc.chapter_stat', ['curData' => $req, 'name'=>'', 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function chapt_fill(Request $request)
    {
        // префаб параметров при редиректе
        $prefab = [
            'pre_pair' => ($request->has('id_pair') ? $request->input('id_pair') : -1),
            'pre_chapter' => ($request->has('id_chapter') ? $request->input('id_chapter') : -1)
        ];
        // return $prefab;
        //
        if ($request->has('new')) {
            // создание новой пары
            $tmpname_chapter = 'временное наименование темы';

            $prefab['pre_chapter'] = DB::table('exerc_chapters')->insertGetId(
                [
                    'chapter_name' => $tmpname_chapter,
                    'id_pair' => $prefab['pre_pair'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                 ]
            );
        }

        // подгрузка всех доступных пар + инфа по ним
        $req = DB::table('exerc_pairs')->where('is_visible', true)
            ->join('exerc_workbooks', 'exerc_pairs.id_workbook', '=', 'exerc_workbooks.id_workbook')
            ->join('exerc_textbooks', 'exerc_pairs.id_textbook', '=', 'exerc_textbooks.id_textbook')
            ->get(['id_pair','pair_name', 'exerc_pairs.updated_at', 'textbook_name', 'workbook_name']);

        return view('layouts.exerc.chapter_fill', ['curData' => $req, 'PrefabPos' => $prefab, 'auth_user' => $this->AccessTypeIndeteficator()]);
    }

    public function chapt_fill_stat(Request $request)
    {
        $id_chapter = ($request->has('id_chapter') ? $request->input('id_chapter') : -1);
        //
        // подгрузка статистики

        $tmp_get_connections1 = DB::table('exerc_chapters_connections')->where('id_chapter', '=', $id_chapter)
        ->join('exerc_word_sign_connections as d', 'exerc_chapters_connections.id_dispersion', '=', 'd.id');
        $tmp_get_connections2 = clone $tmp_get_connections1;
        $tmp_get_connections3 = clone $tmp_get_connections1;
        $tmp_get_connections4 = clone $tmp_get_connections1;
        $req = [
            [
                'name'=>'количество жестов',
                'data'=>$tmp_get_connections1->groupBy('d.id_jest')->count()
            ],
            [
                'name'=>'количество слов',
                'data'=>
                $tmp_get_connections2->count()
            ],
            [
                'name'=>'список недооформленных жестов жестов',
                'data'=>$tmp_get_connections3
                ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
                ->groupBy('j.id_jest')
                ->where('nedooformleno', true)
                ->get(['j.id_jest as id', 'j.jest as text'])
            ],
            [
                'name'=>'список непроверенных жестов жестов',
                'data'=>$tmp_get_connections4
                ->join('srd_surd_jest as j', 'd.id_jest', '=', 'j.id_jest')
                ->groupBy('j.id_jest')
                ->where('admin_checked', true)
                ->get(['j.id_jest as id', 'j.jest as text'])
            ],
        ];

        return view('layouts.exerc.chapter_stat', ['curData' => $req, 'name'=>'','auth_user' => $this->AccessTypeIndeteficator()]);
    }
}
