@extends("layouts.chatLayout")
@section("content")
    <style>
        .group:hover .group-hover\:block {
            display: block;
        }
        .hover\:w-64:hover {
            width: 45%;
        }
    </style>
    <div id="chat_content" class="h-screen relative">
        <div id="room-title" class="w-full">
            <div class="w-full bg-[#262948] hover:bg-[#4289f3] min-h-35	relative">
                <div class="col-span-1">
                    <div class="flex justify-start items-center gap-4 px-5 py-5">
                        <div class="w-12 h-12 rounded-full">
                            @include('components.avatar', ['avatar_path' => $room->icon ?? 'images/avatar.jpg'])
                        </div>
                        <div>
                            <p class="font-bold text-lg	text-white">{{$room->name}}</p>
                        </div>
                        <div class="absolute top-0 right-0 text-sm mr-2 mt-1  flex justify-end items-center gap-4 ">

                            <div class="items-center gap-4 py-2 hover:text-red-500 text-white">
                                <i class="fa-solid fa-right-from-bracket fa-2xl" ></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <div id="list-message" class="bg-[#212540] h-5/6 p-4 flex-1 overflow-y-scroll relative">
            @foreach($message as $item)
                @if(Auth()->user()->id != $item->userId)
                    @if($item ->type == 'text')
                       <div class="flex flex-row justify-start">
                           <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
                               <img class="shadow-md rounded-full w-full h-full object-cover" src="https://randomuser.me/api/portraits/women/33.jpg" alt="">
                           </div>
                           <div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
                               <div class="flex items-center group">
                                   <p class="px-6 py-3 rounded-t-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200">
                                       {!! $item -> content !!}</p>
                                   <button type="button" class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2">
                                       <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                           <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
                                                    M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
                                                    C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"></path>
                                       </svg>
                                   </button>
                               </div>
                           </div>
                       </div>
                    @else
                       <div class="h-min-10 bg-blue-300 max-w-40 rounded-lg ">
                           <img  class="rounded-lg " src="{!! $item->content !!}">
                       </div>
                    @endif
               @else
                   <div class="flex flex-row justify-end">
                       <div class="messages text-sm text-white grid grid-flow-row gap-2">
                           <div class="flex items-center flex-row-reverse group">

                   @if($item ->type == 'text')
                                   <p class="px-6 py-3 rounded-lg bg-blue-700 max-w-xs lg:max-w-md">
                                       {{$item->content}}</p>

                   @else
                       <div class="flex flex-row justify-start">
                           <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
                               <img class="shadow-md rounded-full w-full h-full object-cover"
                                    src="{!! $item->content !!}"
                                    alt=""
                               />
                           </div>
                       </div>
                   @endif
                       <button type="button" class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2">
                           <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                               <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
                                             M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
                                            C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                           </svg>
                       </button>
                           </div>
                       </div>
                   </div>
                @endif
            @endforeach
                <div class="absolute none bottom-0 bg-white overflow-y-scroll min-w-20" id="tag-user-box"></div>
       </div>
        <div class="relative">
            <div class="h-1/12 chat-footer flex-none bg-[#212540]">
                <div class="flex flex-row items-center p-4">
                    <button type="button" class="flex flex-shrink-0 focus:outline-none mx-2 block text-blue-600 hover:text-blue-700 w-6 h-6">
                        <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                            <path d="M11,13 L8,10 L2,16 L11,16 L18,16 L13,11 L11,13 Z M0,3.99406028 C0,2.8927712 0.898212381,2 1.99079514,2 L18.0092049,2 C19.1086907,2 20,2.89451376 20,3.99406028 L20,16.0059397 C20,17.1072288 19.1017876,18 18.0092049,18 L1.99079514,18 C0.891309342,18 0,17.1054862 0,16.0059397 L0,3.99406028 Z M15,9 C16.1045695,9 17,8.1045695 17,7 C17,5.8954305 16.1045695,5 15,5 C13.8954305,5 13,5.8954305 13,7 C13,8.1045695 13.8954305,9 15,9 Z" />
                        </svg>
                    </button>
                    <div class="relative flex-grow w-full">
                        <label>
                            <input id="message_content"
                                   class="rounded-full py-2 pl-3 pr-10 w-full border border-gray-800 focus:border-gray-700 bg-white focus:bg-white focus:outline-none  focus:shadow-md transition duration-300 ease-in"
                                   type="text" value="" placeholder="Aa"/>
                            <button type="button" class="absolute top-0 right-0 mt-2 mr-3 flex flex-shrink-0
                                                      focus:outline-none block text-blue-600 hover:text-blue-700 w-6 h-6">
                                <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                    <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM6.5 9a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm7 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm2.16 3a6 6 0 0 1-11.32 0h11.32z" />
                                </svg>
                            </button>
                        </label>
                    </div>
                    <button type="submit" class="flex flex-shrink-0 focus:outline-none mx-2 block text-blue-600 hover:text-blue-700 w-6 h-6" onclick="sendMessage({{$room->id}})">
                        <svg class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function sendMessage(roomId){
            let content = document.getElementById("message_content").value;
            $.ajax({
                type: 'POST',
                url: '{{ route("sendmess") }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    chatRoomId: roomId,
                    content:content,
                    type: "text",
                },
                success: function(response) {
                    const html =`
                    <div class="flex flex-row justify-end">
                       <div class="messages text-sm text-white grid grid-flow-row gap-2">
                           <div class="flex items-center flex-row-reverse group">
                               <button type="button" class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2">
                                   <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                                       <path d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
	 M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
	C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"/>
                                   </svg>
                               </button>
                                <p class="px-6 py-3 rounded-lg bg-blue-700 max-w-xs lg:max-w-md">${response.content}</p>
                            </div>
                       </div>
                   </div>`;
                    const listMessage = document.getElementById('list-message');
                    if(listMessage) listMessage.innerHTML +=html;
                },
                error: function(error) {

                   console.log(error);
                }
            });
        }
        const userData = @json($user);
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('message_content');
            const resultBox = document.getElementById('tag-user-box');
            //document.body.appendChild(resultBox);
            //resultBox.style.position = 'absolute';
            //resultBox.style.display = 'none';

            input.addEventListener('input', function(e) {
                const value = e.target.value;
                const cursorPosition = e.target.selectionStart;
                const lastAtPos = value.lastIndexOf('@', cursorPosition - 1);
                const nextSpacePos = value.indexOf(' ', lastAtPos + 1) > -1 ? value.indexOf(' ', lastAtPos + 1) : value.length;
                if(checkSpace(value)){
                    resultBox.style.display = 'none';
                    return 0;
                }
                else {
                if (lastAtPos > -1) {
                    const searchString = value.substring(lastAtPos + 1, nextSpacePos).trim();
                    if (searchString.length > 0) {
                        // Tìm kiếm trong mảng dữ liệu người dùng
                        const searchResults = userData.filter(user => user.name.toLowerCase().includes(searchString.toLowerCase()));
                        console.log(searchResults);
                        // Hiển thị kết quả tìm kiếm
                        resultBox.style.display = 'block';
                        resultBox.innerHTML = searchResults.map(user => `<div class="search-result-item bg-white min-h-10 text-center w-full" data-name="@${user.name}">${user.name}</div>`).join('');
                        positionResultBox(resultBox, input);
                    } else {
                        resultBox.style.display = 'none';
                    }
                } else {
                    resultBox.style.display = 'none';
                }}
            });

            function positionResultBox(box, inputElement) {
                const rect = inputElement.getBoundingClientRect();

            }
            function checkSpace(str) {

                var firstQuoteIndex = str.indexOf(' ');

                if (firstQuoteIndex === -1) {
                    return false;
                }

                return true;
            }

            // Xử lý khi chọn một tên từ danh sách
            resultBox.addEventListener('click', function(e) {
                if (e.target.classList.contains('search-result-item')) {
                    const selectedName = e.target.dataset.name;
                    const value = input.value;
                    const lastAtPos = value.lastIndexOf('@');
                    const nextSpacePos = value.indexOf(' ', lastAtPos + 1) > -1 ? value.indexOf(' ', lastAtPos + 1) : value.length;
                    const newValue = value.substring(0, lastAtPos) + selectedName + value.substring(nextSpacePos);
                    input.value = newValue;
                    resultBox.style.display = 'none';
                }
            });
        });

    </script>
@endsection
