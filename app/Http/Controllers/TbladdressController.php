<?php

namespace App\Http\Controllers;

use App\Models\tbladdress;
use Illuminate\Http\Request;
use DB;

class TbladdressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    //load province(ncr only)
    public function load_province(Request $request)
    {
        $data = DB::table('refprovince')
                ->where('provCode','0155')
                ->get();

        return json_encode(array('statusCode'=>200,'data'=>$data));
    }
    //load city base on province
    public function onselect_province_load_city(Request $request)
    {
    $provcode=$request->id;
    $data = DB::table('refcitymun')
        ->where('provCode',$provcode)
        ->get();
    return json_encode(array('statusCode'=>200,'data'=>$data));
    }
    //load brgy base on city
    public function onselect_city_load_brgy(Request $request)
    {
    $citycode=$request->id;
    $data = DB::table('refbrgy')
        ->where('citymunCode',$citycode)
        ->get();
    return json_encode(array('statusCode'=>200,'data'=>$data));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function onupdate_load_address()
    {
        $loadprovincedata = DB::table('refprovince')->where('provCode','0155')
                          ->get();
        $loadcitydata = DB::table('refcitymun')->where('provCode','0155')
                        ->get();
        $loadbrgydata  = DB::table('refbrgy')->where('provCode','0155')
                        ->get(); 

        return json_encode(array('statusCode'=>200,'province'=>$loadprovincedata,'city'=>$loadcitydata,'brgy'=>$loadbrgydata));                 
    }

    public function loadbrgy(Request $request){
        
        $citycode=$request->id;
        $data = DB::table('refbrgy')->where('citymunCode', 'like', '%' . $citycode . '%')->get();

        return response()->json(['status'=>1, 'data'=>$data, 'id'=>$citycode]);
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
     * @param  \App\Models\tbladdress  $tbladdress
     * @return \Illuminate\Http\Response
     */
    public function show(tbladdress $tbladdress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tbladdress  $tbladdress
     * @return \Illuminate\Http\Response
     */
    public function edit(tbladdress $tbladdress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tbladdress  $tbladdress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tbladdress $tbladdress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tbladdress  $tbladdress
     * @return \Illuminate\Http\Response
     */
    public function destroy(tbladdress $tbladdress)
    {
        //
    }
}
