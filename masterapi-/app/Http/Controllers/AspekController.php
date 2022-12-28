<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspek;
use Log;

class AspekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveData (Request $request){

        $Aspek = new Aspek();
        $Aspek->id = $request->input('id');
        $Aspek->name = $request->input('name');
        $Aspek->save();

        return response()->json([
            'status' =>true,
            'message' => 'sucess',            
        ], 200);
    }

    public function getData (Request $request, $id){

        $AspekDetails = Aspek::where('id', $id)->first();
        if(isset($AspekDetails)) {
            return response()->json([
                'status' =>true,
                'message' => 'sucess',
                'employee'     => $AspekDetails,
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t find a registered employee',                
            ], 400);
        }
    }

    public function loadAll (Request $request){

        $loadData = Aspek::get();
        if(isset($loadData)) {
            return response()->json([
                'status' => true,
                'message' => 'sucess',
                'data'   => array(
                'Aspek'     => $loadData,
                            )
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t find a registered employees',                
            ], 400);
        }
    }

    public function updateData (Request $request, $id){

        $newAspek = Aspek::where('id', $id)
        ->update(['name' => $request->input('name')]);     
        if(isset($newAspek)) {
            return response()->json([
                'status' => true,
                'message' => 'Sucess',
                'isUpdated' => $newAspek
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t update the Akses',                
            ], 400);
        }
    }

    public function delete (Request $request, $id){

        $delete = Aspek::where('id', $id)->delete();
        if(isset($delete)) {
            return response()->json([
                'status' => true,
                'message' => 'sucess',
                'isDeleted'     => $delete,
            ], 200);
        } else {
            return response()->json([
                'status' =>false,
                'message' => 'can \'t delete the akses',               
            ], 400);
        }
    }
}
