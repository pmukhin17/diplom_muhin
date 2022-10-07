<?php

namespace App\Http\Controllers\Api\pub\v1;

use App\Http\Requests\StoreConfigNotationRequest;
use App\Models\Surdo\ConfigNotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;

class HnsConfigNotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ConfigNotation::get());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreConfigNotationRequest $request
     * @return void
     */
    public function store(StoreConfigNotationRequest $request)
    {
        $data = [];
        if ($request->file('file')) {
            $file = Storage::putFile('hns/config_notation', $request->file('file'));
            $data['pic'] = $file ?: null;
        }
        $data['config_notation'] = $request->input('name');

        $model = new ConfigNotation($data);
        $model->save();

        return response('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO: описать метод show
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
        // TODO: описать метод update
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO: описать метод destroy
    }
}
