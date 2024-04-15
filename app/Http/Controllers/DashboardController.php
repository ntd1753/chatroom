<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomUser;
use App\Models\UserQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $queue = UserQueue::where('ownerId','=', Auth::user()->id)->where('status','=','0')->get();
        return view('content.dashboard', ['queue' => $queue]);
    }
    public function approveUser(Request $request){
        $queue = UserQueue::where('id','=', $request['queueId'])->get()[0];
        if ($request['status']==1){
        $roomUser = new RoomUser();
        $roomUser->room_id=$queue['roomId'];
        $roomUser->user_id=$queue['userId'];
        $roomUser->save();
        $queue['status']='1';
        $queue->save();
        return response()->json(["message" => $queue], 200);}
        else{
            $queue['status']='1';
            $queue->save();
            return response()->json(["message" => 'refuse'], 200);}
    }
}
