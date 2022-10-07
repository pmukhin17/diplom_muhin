<?php


namespace App\Http\Controllers\Api\pub\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surdo\Senses;
use App\Models\Surdo\Synsets;
use App\Models\Surdo\JestConcept;

class ConceptApiController extends Controller
{
    public function index(Request $request)
    {
        //
    }

    public function load_syn(Request $request)
    {
        $id_jest = $request->input('id_jest');
        $find_syn = array();
        $find_syn = JestConcept::search($id_jest)->orderBy('synset_id')->get('synset_id');
        $syn_count = count($find_syn);
        $find_search = array();
        for($i = 0; $i < $syn_count; ++$i){
            $search_syn = Synsets::search($find_syn[$i]->synset_id)->orderBy('ruthes_name')->get(['synset_id', 'ruthes_name']);
            array_push($find_search,$search_syn);
        }
        return $find_search;
    }

    public function create_jestsyn(Request $request){
        $select_synsets = $request->input('select_synsets');
        $id_jest = $request->input('id_jest');
        $syn_search = JestConcept::search($id_jest)->get('synset_id');
        $result = array();
        $result_value = array();
        if ($select_synsets){
            if (count($syn_search) > count($select_synsets)){
                $mas_1 = array();
                for($i = 0; $i < count($syn_search); ++$i){
                    array_push($mas_1,strval($syn_search[$i]->synset_id));
                }
                $result = array_diff($mas_1, $select_synsets);
                $result_key = array_keys ( $result );
                for($i = 0; $i < count($result_key); ++$i){
                    array_push($result_value,$result[$result_key[$i]]);
                }
            }
            for($i = 0; $i < count($result_value); ++$i){
                JestConcept::query()->where('synset_id', '=', $result_value[$i])->delete();
            }
            $synsets_count = count($select_synsets);
            for($i = 0; $i < $synsets_count; ++$i){
                JestConcept::query()->updateOrCreate(['synset_id' => $select_synsets[$i], 'id_jest' => $id_jest]);
            }
        }
        else{
            JestConcept::query()->where('id_jest', '=', $id_jest )->delete();
        }


    }

    public function search_syn(Request $request)
    {
        $synset_id = $request->input('synset_id');
        $search_count = count($synset_id);
        $find_search = array();

        for($i = 0; $i < $search_count; ++$i){
            $search_sen = Synsets::search($synset_id[$i])->orderBy('ruthes_name')->get(['synset_id', 'ruthes_name']);
            array_push($find_search,$search_sen);
        }

        return $find_search;
    }

    public function search_id(Request $request)
    {
        $search = $request->input('search');
        $search_count = count($search);
        $find_search = array();
        for($i = 0; $i < $search_count; ++$i){
            $search_now = Senses::search($search[$i])->orderBy('sense_name')->get('synset_id');
            array_push($find_search,$search_now);
        }
        return $find_search;
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
}
