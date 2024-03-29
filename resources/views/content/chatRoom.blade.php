@extends("layouts.chatLayout")
@section("content")
    <div id="chat_content" class="grid grid-cols-2 gap-1 h-full">
        <!-- column 2-->
        <div class="col-span-1 h-full bg-[#202441] text-white text-base w-full pl-12 pr-12 py-8">
            <div class="font-bold text-3xl flex justify-between">
                <div class="flex justify-start items-center gap-4">
                    <i class="fa-solid fa-users"></i>
                    <p> Chat Room</p>
                </div>
                <div class="flex justify-end items-center gap-4">
                    <button type="button" onclick="openModal('searchRoomModal')" class="text-white hover:text-orange-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" onclick="openModal('addNewRoomFormModal')" class="text-white hover:text-orange-400">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

            </div>
            <div class="w-ful pl-4 mt-12">
                <p class="font-semibold">My rooms</p>
                <div class="w-full" id="rooms_list">
                    @foreach($rooms as $room)
                        <div  class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative" onclick="renderRoomInfo({{$room->id}})">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                                    </div>
                                    <p class="font-bold">{{$room->name}}</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p> {{$room->description}}</p>
                            </div>
                            <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4">
                                <p class="text-gray-400">2 min ago</p>
                                @include('components.countNotification', ['number' => 1])
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- column 3 -->
        <div class="col-span-1 w-full h-full bg-[#212540] items-center room_info_{{\Illuminate\Support\Facades\Auth::user()->id}}" id="room_${item.id}" >

        </div>


    </div>
    @include('components.modals.roomFormModal')
    @include('components.modals.searchRoomModal')
    <!-- Import CDN jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Call Ajax handle -->
    <script>
        var listRoom= [];
        $.ajax({
            url: '{{route('room.info')}}',
            type: 'GET',
            dataType:'json',
            success: function(response){
                //console.log(response);

                response.forEach((item)=>{
                    let ownerData = {
                        id: item.owner_id,
                        name: item.owner_name
                    };
                    // Thêm đối tượng ownerData vào mảng user của từng phòng
                    item.user.push(ownerData);
                    let roomData = {
                        id: item.id,
                        user: item.user,
                    };
                    listRoom.push(roomData);
                    let roomUrlTemplate="{{ route('room.show', ['id' => 'ROOM_ID_PLACEHOLDER']) }}"
                    let roomUrl = roomUrlTemplate.replace('ROOM_ID_PLACEHOLDER', item.id);
                    let html='';
                    html +=`
                    <div class="col-span-1 w-full h-full bg-[#212540] items-center hidden room_info_{{\Illuminate\Support\Facades\Auth::user()->id}}" id="room_${item.id}">
                        <div class="w-full bg-[#262948] hover:bg-[#4289f3] min-h-35	relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4 px-5 py-5">
                                    <div class="w-12 h-12 rounded-full">
                                        @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                    </div>
                    <div>
                        <p class="font-bold text-lg	text-white">${item.name}</p>
                                        <p class=" text-xs	text-white">${item.user.length +1} thành viên</p>
                                    </div>

                                    <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4 ">
                                        <a href="${roomUrl}">
                                        <div class="hover:text-red-500 text-white">
                                            <i class="fa-solid fa-comment-dots fa-2xl"></i>
                                        </div></a>
                                        <a href="#">
                                        <div class="items-center gap-4 py-2 hover:text-red-500 text-white">
                                            <i class="fa-solid fa-right-from-bracket fa-2xl" ></i>
                                        </div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full  min-h-35  px-4 py-3 min-h-10">
                            <div class="relative">
                                <input class="w-full min-h-6 rounded-lg" id="search_input_room_${item.id}" onkeyup="searchUserInRoom(${item.id})">
                                    <div class="absolute right-0 top-0"><i class="fa-solid fa-magnifying-glass" ></i></div>
                            </div>
                        </div>

                    `;

                    item.user.forEach((element)=>{
                        html +=`<div class="w-8/9 bg-blue-300-400 max-h-screen overflow-auto px-2 py-1 bg-[#212540]" id="room_${item.id}_user_${element.id}">

                            <div href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                                <div class="col-span-1">
                                    <div class="flex justify-start items-center gap-4">
                                        <div class="w-8 h-8 rounded-full">
                                            @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                        </div>
                        <p class="font-bold text-lg text-white">${element.name}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    });
                    let htmlEnd =`</div>`;
                    html= html +htmlEnd;
                    //console.log(html);
                    $('#chat_content').append(html);
                });


            },
            error: function(error){
                console.log(error);
            }
        });

        $(document).ready(function() {
            $('.tox-statusbar').css('display', 'none');
            // Bắt sự kiện submit form
            $('#createRoomForm').submit(function(e) {
                e.preventDefault();
                console.log("Form submit!")
                $.ajax({
                    type: 'POST',
                    url: '{{ route("room.store") }}', // Găn route
                    data: $(this).serialize(), // Dữ liệu form
                    success: function(response) {
                        // Handle the success response
                        console.log(response);
                        // Modifine response
                        if (response.icon === null){
                            response.icon = '/images/avatar.jpg';
                        }
                        if (response.description == null){
                            response.description = '';
                        }
                        let html = '';
                        html +=
                            `<a href="#" class="w-full bg-[#262948] hover:bg-[#4289f3] py-3 px-4 my-4 rounded-lg grid grid-cols-3 gap-2 relative">
                            <div class="col-span-1">
                                <div class="flex justify-start items-center gap-4">
                                    <div class="w-8 h-8 rounded-full">
                                        <img src="${response.icon}" alt="avatar" class="w-full h-full rounded-full border-2 border-red-500" />
                                    </div>
                                    <p class="font-bold">${response.name}</p>
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p>${response.description}</p>
                            </div>
                        </a>`;

                        // Add to top of room list
                        $('#rooms_list').prepend(html);

                        closeModal('addNewRoomFormModal');

                    },
                    error: function(error) {
                        // Handle the error response
                        console.log(error);
                        closeModal('addNewRoomFormModal');
                    },
                });

                $('#createRoomForm')[0].reset();

            });

        });
        function renderRoomInfo(id){
            let newRoom= document.getElementById('room_'+id);
            let listRoomHidden=document.getElementsByClassName(`room_info_{{\Illuminate\Support\Facades\Auth::user()->id}}`);
            let arrayRoomHidden = Array.from(listRoomHidden);
            arrayRoomHidden.forEach((item)=>{item.classList.add('hidden');})
            newRoom.classList.remove('hidden');

        }
        function searchUserInRoom(roomId){
            let input = document.getElementById('search_input_room_'+roomId).value;
            for (let i = 0; i < listRoom.length; i++) {
                if (listRoom[i].id === roomId) {
                    listRoom[i].user.forEach((item) =>{
                        if(item.name.indexOf(input) !== -1){
                            console.log(item.name);
                        }
                    })

                    break; // Kết thúc vòng lặp khi tìm thấy phòng mong muốn
                }
            }
        }
    </script>
@endsection
