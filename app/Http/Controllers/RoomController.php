<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rooms = Room::where('owner_id','=', Auth::user()->id)->get();
        return view('content.chatRoom', ['rooms' => $rooms]);
    }

    public function storeRoom(Request $request): JsonResponse
    {
        $input = $request->all();

        // TODO: Create a new room
        $room = Room::create([
            'name' => $input['room_name'],
            'icon' => $input['room_icon'],
            'description' => $input['room_description'],
            'owner_id' => Auth::user()->id
        ]);

        return response()->json($room, 200);
    }

    public function search(Request $request){
        $search_room_name = $request->input('search_room_name');
        if ($search_room_name != ""){
            $query = "";
            for($i=0;$i<strlen($search_room_name);$i++){
                $query = $query.'%'.$search_room_name[$i];
            }
            $rooms = Room::where('name', 'like', $query.'%')->get();
        } else {
            $rooms = Room::where('owner_id','=', Auth::user()->id)->get();
        }
        return response()->json($rooms, 200);
    }
}
