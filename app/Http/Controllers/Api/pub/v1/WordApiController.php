<?php

namespace App\Http\Controllers\Api\pub\v1;

use App\Models\Surdo\Jest;
use App\Models\Surdo\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WordApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * Получает все слова
     * Если есть параметр 'search', то возвращает, подходящие
     * под эту строку, слова
     *
     * @param Request $request
     * @return Word[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = [
            'deviant' => $request->input('deviant') == 'true' ? 1 : 0,
            'admin_checked' => 1
        ];
        $search = $request->input('search');

        return Word::search($search)->ofFilter($filter)
            ->limit(2000)->with('jests:nedooformleno')
            ->orderBy('word')->get(['id_word', 'word']);
    }

    /**
     * Возвращает все слова для определенного жеста
     *
     * @param Request $request
     * @return mixed
     */
    public function wordsForJest(Request $request)
    {
        $filter = [
            'id_jest' => $request->input('id_jest'),
            'deviantWords' => $request->input('deviantWords') == 'true' ? 1 : 0
        ];

        return Jest::findOrFail($filter['id_jest'])
            ->words()
            ->whereIn('deviant', [$filter['deviantWords'], 0])
            ->orderBy('word')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Возвращает количество слов в базе данных
     * @return mixed
     */
    public function countWords()
    {
        if (!Auth::user()->hasPermission("browse_statistics"))
            return Word::count();
    }
}
