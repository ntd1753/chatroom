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
        @foreach($queue as $item)
            @if( $item->status == 0)
            <div class="rounded-lg w-full flex items-center bg-[#262948] shadow-lg" id="queue-{{$item->id}}">
                <div class="flex-grow p-4 border-r border-gray-200">
                    <span class="font-semibold">{{$item->user->name}}</span> muốn xin vào phòng <span class="font-semibold">{{$item->room->name}}</span> của bạn
                </div>
                <div class="p-4 text-green-600 rounded-full">
                    <button class="rounded-full bg-green-100 hover:bg-green-200 p-2 transition-colors duration-150 ease-in-out" onclick="allowUser({{$item->id}},1,{{$item->id}})">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </div>
                <div class="p-4">
                    <button class="rounded-full bg-red-100 hover:bg-red-200 p-2 transition-colors duration-150 ease-in-out" onclick="allowUser({{$item->id}},0,{{$item->id}})">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function allowUser(id,status,queueId){

        $.ajax({
            type: 'POST',
            url: '{{ route("approveUser") }}',
            data: {
                _token: '{{ csrf_token() }}',
                queueId:id,
                status: status,
            },
            success: function(response) {
                console.log(response);
                const element =document.getElementById(`queue-${queueId}`)
                element.remove();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

</script>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('3c0d0b48b67a1ded1766', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe(`my-channel`);
        document.addEventListener('DOMContentLoaded', function() {
            channel.bind('my-event', function(data) {
                console.log(data);
            });
        })

    </script>


@endsection
