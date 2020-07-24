<?php

namespace App\Http\Controllers\Country;
use App\Models\CountryModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class Country extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countryList= CountryModel::paginate(10);
        return response()->json($countryList,200);
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
        $rules=[
            'name'=>'required|min:3',
            'iso'=>'required|min:2|max:3'
        ];
        $validator=Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $country=CountryModel::create($req->all());
        return response()->json($country,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country=CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["msg"=>'Record is not available'],404);
        }
        return response()->json($country,200);
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
        $country=CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["msg"=>'Record is not available'],404);
        }
        $country->update($req->all());
        return response()->json($country,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country=CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["msg"=>'Record is not available'],404);
        }
        $country->delete();
        return response()->json(null,200);
    }
}
