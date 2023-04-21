<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function get_data(Request $request){

        $code = $request->get('code');
        $patient_identification = $request->get('patient_identification');

        $result = Result::where('code', $code)
            ->where('estatus', 1)
            ->where('patient_identification', $patient_identification)
            ->with([
                    'resuls_details' => function($q){
                        return $q->where('estatus', 1);
                    }, 
                    'file'])
            ->first();


        return response()->json($result, 200);

    }
}
