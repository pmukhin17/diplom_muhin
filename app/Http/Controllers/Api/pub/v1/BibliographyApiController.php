<?php

namespace App\Http\Controllers\Api\pub\v1;

use App\Models\Surdo\Bibliography;
use App\Models\Surdo\BibliographyType;
use App\Models\Surdo\JestBibliography;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BibliographyApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bibliography_type = $request->input('bibliography_type');

        return Bibliography::search($search)->with('bibliography_type')->where('id_bibliography_type', $bibliography_type)->limit(30)
            ->orderBy('bibliography')->get();
    }


    public function update_b(Request $request){
        $id_jest = $request->input('id_jest');
        $bibliographies = $request->input('bibliographies');
        $bibliographies_search = JestBibliography::search($id_jest)->get('id_bibliography');
        if ($bibliographies) {
            $mas_1 = array();
            for ($i = 0; $i < count($bibliographies_search); ++$i) {
                array_push($mas_1, strval($bibliographies_search[$i]->id_bibliography)); // индексы библиогр в БД
            }
            $diff_1 = array();
            $diff_2 = array();
            $diff_1 = array_diff($mas_1, $bibliographies);
            $diff_2 = array_diff($bibliographies, $mas_1);

            $result_key_1 = array_keys($diff_1);
            $result_value_1 = array();
            for ($i = 0; $i < count($result_key_1); ++$i) {
                array_push($result_value_1, $diff_1[$result_key_1[$i]]);
            }

            $result_key_2 = array_keys($diff_2);
            $result_value_2 = array();
            for ($i = 0; $i < count($result_key_2); ++$i) {
                array_push($result_value_2, $diff_2[$result_key_2[$i]]);
            }

            for($i = 0; $i < count($result_value_1); ++$i){
                JestBibliography::query()->where('id_bibliography', '=', $result_value_1[$i])->delete();
            }
            for($i = 0; $i <count($result_value_2); ++$i){
                JestBibliography::query()->updateOrCreate(['id_bibliography' => $result_value_2[$i], 'id_jest' => $id_jest]);
            }

        }
        else{
            JestBibliography::query()->where('id_jest', '=', $id_jest)->delete();
        }

        return 0;
    }

    /**
     * Получаем список типов библиографий
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBibliographyType()
    {
        return BibliographyType::query()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
