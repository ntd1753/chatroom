<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Notification;
use App\Models\Room;
use App\Models\RoomUser;
use App\Models\User;
use App\Models\Message;
use App\Models\UserQueue;
use App\Notifications\MessageNontification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rooms = Room::where('owner_id','=', Auth::user()->id)->get();
        $roomAble =User::where('id','=',Auth::user()->id)->get()[0]->rooms;
        foreach ($roomAble as $item){
            $rooms->push($item);
        }
//        echo "<pre>";
//        print_r($rooms[4]->user);
//        echo  "</pre>";
 //       exit();
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

        $user = Auth::user();

        $user ? $owner_room_ids = $user->myRooms->pluck('id') : $owner_room_ids = [];
        $joined_room_ids = $user->rooms->pluck('id'); // [1,2,3]
        // concat joined_room_ids with owner_room_ids
        $joined_room_ids = $joined_room_ids->merge($owner_room_ids);
        if ($search_room_name != ""){
            $query = "";
            for($i=0;$i<strlen($search_room_name);$i++){
                $query = $query.'%'.$search_room_name[$i];
            }
            $rooms = Room::whereNotIn('id', $joined_room_ids)->where('name', 'like', $query.'%')->get();
        } else {
            $rooms = Room::whereNotIn('id', $joined_room_ids)->get();
        }
        return response()->json($rooms, 200);
    }
    public function join(Request $request): JsonResponse
    {
        $input = $request->all();
        $user = Auth::user();
        $room = Room::find($input['room_id']);
        $queue = new UserQueue();
        $queue->roomId=$input['room_id'];
        $queue->userId=$user->id;
        $queue->status='0';
        $queue->save();
//        if($user && $room){
//            $room->user()->attach($user->id);
//        }
        $message = "You have joined the room";

        return response()->json(["message" => $message, "room" => $room], 200);
    }
    public function roomInfo(){
        $room = Room::where('owner_id','=', Auth::user()->id)->with('user')->get()->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'owner_id' =>$room->owner->id,
                'owner_name' => $room ->owner->name,
                'user' => $room->user->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                    ];
                }),
            ];
        });

        $roomAble =User::where('id','=',Auth::user()->id)->get()[0]->rooms->map(function ($room) {
            return [
                'id' => $room->id,
                'name' => $room->name,
                'owner_id' =>$room->owner->id,
                'owner_name' => $room ->owner->name,
                'user' => $room->user->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        // Thêm bất kỳ trường nào khác bạn cần từ người dùng
                    ];
                }),
            ];
        });

        //dd($roomAble);
        //exit();
        if(!empty($room)){
            foreach ($roomAble as $item){
                $room ->push($item);
            }
        } else $room = $roomAble;

        return response()->json($room, 200);
    }
    public function getMessageNontify() {
        $user = Auth::user();
        $notifications = $user->notifications()->wherePivot('read_at', null)->with('sender')->get();
        return response()->json($notifications, 200);
    }

}
