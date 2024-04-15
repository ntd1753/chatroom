<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\MessageNotifyEvent;
use App\Models\Room;
use App\Models\Notification;
use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;


class chatCotroller extends Controller
{
    public  function showRoom($id){
        $messages = Room::where('id', '=', $id)->get()[0]->message;
        $room=Room::find($id);
        $roomUser=Room::where('id', '=', $id)->get()[0];
        $user=$roomUser->user->push($roomUser->owner);
        return view('content.showChat', ['message' => $messages, 'room' => $room, 'user' => $user]);
    }
    function sendMess(Request $request){
        $input = $request->all();
        $roomName = Room::find($input['chatRoomId'])->name;
        $mess =Message::create([
            'chatRoomId' => $input['chatRoomId'],
            'content' => $input['content'],
            'type' => $input['type'],
            'userId' => Auth::user()->id,
        ]);
        $room = Room::with('user')->findOrFail($input['chatRoomId']);
        $users = $room->user;
        $notification = new Notification([
            'user_id'=> Auth::user()->id,
            'type' => 'new_message',
            'data' => json_encode(['roomName' => $roomName, 'from' => $mess->userId])
        ]);
        $notification->save();
        // Thêm chủ sở hữu vào danh sách nếu chưa có
        if(!$users->contains($room->owner_id)) {
            $users->push($room->owner);
        }
        foreach ($users as $member) {
            if ($member->id !== Auth::user()->id) {
                $notification->users()->attach($member->id);
            }
        }

        event(new MessageSent($request->all(),$input['chatRoomId']));
        event(new MessageNotifyEvent($mess,$roomName));

        return response()->json($mess, 200);
    }


    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $chatRoomId = $request->input('chatRoomId');
            // Đặt tên cho file ảnh dựa trên một tiêu chí nhất định, ví dụ: timestamp và original filename
            $filename = time() . '_' . $image->getClientOriginalName();
            // Lưu ảnh với tên file mới vào thư mục storage/app/public/images
            $path = $image->storeAs('public/images', $filename);

            // Chuyển đổi đường dẫn lưu trữ cho phù hợp khi trả về client
            $publicPath = 'storage/images/' . $filename;

            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            $mess = Message::create([
                'chatRoomId' => $chatRoomId,
                'content' => $publicPath,
                'type' => 'image',
                'userId' => Auth::user()->id,
            ]);
            return response()->json(['message' => 'Ảnh đã được tải lên thành công', 'path' => $publicPath, 'content' => $mess]);
        }

        return response()->json(['message' => 'Tải ảnh lên không thành công'], 500);
    }

}
