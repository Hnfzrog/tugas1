<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SatuanController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
                'idUser' => 'required',
                'name' => 'required',
                'aspek' => 'required'
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $satuan = Satuan::create($request->all());
        return $this->success($satuan);
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
    // public function saveSatuan($id)
    //     {
    //         {
    //             $keterangan = "";
    //             $satuan = Satuan::where('user_id', Auth::user()->id)->first();
    //             if ($satuan == null) {
    //                 $satuan = Satuan::create([
    //                     'user_id' => Auth::user()->id,
    //                     'latitude' => $request->latitude,
    //                     'longitude' => $request->longitude,
    //                 ]);
    //             } else {

    //                 Presensi::whereDate('tanggal', '=', date('Y-m-d'))->update($data);

    //             }
    //             $presensi = Presensi::whereDate('tanggal', '=', date('Y-m-d'))
    //                     ->first();
            
    //             return response()->json([
    //                 'success' => true,
    //                 'data' => $presensi,
    //                 'message' => 'Sukses simpan'
    //             ]);
    //         }
    //     }
    public function saveSatuan($id) 
    {
        // $satuan = Satuan::where('idUser', Auth::user()->id)->get();
        // if ($satuan == null) {
        //     $satuan = Satuan::create([
        //         'idUser' => $request->id,
        //         'name' => $request->name,
        //         'aspek' => $request->aspek,
        //     ]);
        //     return $this->success('Add data', $satuan);
        // } else {
        //     $satuan->update($request->all());
        // }
        return $this->success($satuan);
    }

    public function cekSatuan($id)
    {
        $user = User::with('Cohhhh')->find($id);

        return response()->json([
            'message' => 'succes',
            'data' => $satuan
        ]);
    }

    public function success($data, $message = "success") {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function error($message) {
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);
    }
}
