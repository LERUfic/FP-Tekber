<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;
use App\Jadwal;
use App\Mymk;

class ApiController extends Controller
{
    public function getUser(Request $r){
        $status = User::where('username','=',$r->input('username'))
                    ->where('password','=',$r->input('password'))
                    ->get();
        return response()->json([
            'message' => 'Success',
            'result' => $status
        ],200);
    }

    public function insertNewUser(Request $r){
        if($r->input('password') != $r->input('repassword')){
            return response()->json([
                'message' => 'error'
            ],400);
        }
        $user = new User;
        $user->username = $r->input('username');
        $user->password = $r->input('password');
        $user->name = $r->input('name');
        $user->role = $r->input('role');

        $user->save();

        return response()->json([
            'message' => 'Insert Done'
        ],200);
    }

    public function insertNewMK(Request $r){
        $user = new Jadwal;
        $user->id_dosen = $r->input('username');
        $user->time_start = $r->input('startmk');
        $user->time_end = $r->input('endmk');
        $user->matakuliah = $r->input('name');

        $user->save();

        return response()->json([
            'message' => 'Insert Done'
        ],200);
    }

    public function joinMhs(Request $r){
        $user = new Mymk;
        $user->matkul_id = $r->input('matkul_id');
        $user->mhs_id = $r->input('mhs_id');

        $user->save();

        return response()->json([
            'message' => 'Insert Done'
        ],200);
    }

}
