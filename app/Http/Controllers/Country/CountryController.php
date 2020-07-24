<?php

namespace App\Http\Controllers\Country;
use App\Models\CountryModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
class CountryController extends Controller
{
    //
    public function country(){
        return response()->json(CountryModel::get(),200);
    }
    public function countryByID($id){
        $country=CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["msg"=>'Record is not available'],404);
        }
        return response()->json($country,200);

    }
    public function countrySave(Request $req){
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
    public function countryUpdate(Request $req ,$id){
        $country=CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["msg"=>'Record is not available'],404);
        }
        $country->update($req->all());
        return response()->json($country,200);
    }
    public function countryDelete(Request $req ,$id){
        $country=CountryModel::find($id);
        if(is_null($country)){
            return response()->json(["msg"=>'Record is not available'],404);
        }
        $country->delete();
        return response()->json(null,200);
    }
}
