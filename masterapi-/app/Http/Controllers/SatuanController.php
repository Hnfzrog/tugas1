<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;
use Log;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newData(Request $request)
    {
        $Satuan = new Satuan();
        $Satuan->name = $request->input('name');
        $Satuan->satuan = $request->input('satuan');
        $Satuan->save();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil ditambahkan',
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $getAll = Satuan::get();
        if(isset($getAll)) {
            return response()->json([
                'status' => true,
                'message' => 'success',
                'data' => array(
                    'Satuan' => $getAll
                )
                ], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getById($id)
    {
        $SatuanDetail = Satuan::where('id', $id)->first();
        if(isset($SatuanDetail)){
            return response()->json([
                'status' => true,
                'satuan' => $SatuanDetail
            ], 200);
        }else{
            return response()->json([
                'status'=>false,
                'message' => 'data tidak ditemukan'
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSatuan(Request $request, $id)
    {
        $newSatuan = Satuan::where('id', $id);
        $newSatuan->update($request->all());
        if(isset($newSatuan)) {
            return response()->json([
                'status' => true,
                'message' => 'Data sudah diupdate',
                'isUpdated' => $newSatuan
            ], 200);
        }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak bisa update'
                ], 400);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSatuan(Request $request,$id)
    {
        $deleteData = Satuan::where('id', $id)->delete();
        if(isset($deleteData)){
        return response()->json([
            'status' =>true,
            'message' => 'Data telah dihapus',
            'isDeleted' => $deleteData
        ], 200)  ;
        }else{
            return repsonse()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ], 400);
        }
    }
}
