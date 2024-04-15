<script>
    // TODO: Open modal by Id
    function openModal(modal_id){
        console.log("open modal")
        let addNewRoomFormModal = document.getElementById(modal_id);
        addNewRoomFormModal.classList.remove('hidden');
        addNewRoomFormModal.classList.add('visible');
    }
    // TODO: Close modal by Id
    function closeModal(modal_id){
        console.log("close modal")
        let addNewRoomFormModal = document.getElementById(modal_id);
        addNewRoomFormModal.classList.remove('visible');
        addNewRoomFormModal.classList.add('hidden');
    }
    function turnOnNotification(message, type){
        const notificationElement = document.getElementById('notification-'+type);
        const notificationMessageElement = document.getElementById('notification-'+type+'-message');
        console.log(message)
        notificationMessageElement.innerText = message;
        notificationElement.classList.remove('hidden');
        notificationElement.classList.add('visible');
        setTimeout(function(){
            notificationElement.classList.remove('visible');
            notificationElement.classList.add('hidden');
        }, 3000);
    }
    $(document).ready(function() {

        $.ajax({
            type: 'GET',
            url: '{{ route("room.messageNotify") }}',
            data: $('#searchRoomForm').serialize(),
            success: function(response) {
                console.log(response);
                let html ='';
                response.forEach((item) =>{
                    const senderName = item.sender.name;
                    // Để lấy tên phòng từ chuỗi JSON trong 'data'
                    const notificationData = JSON.parse(item.data);
                    const roomName = notificationData.roomName;
                    html+=`
                                <div class="bg-white rounded-lg border-gray-200 border p-3 shadow-lg mt-4">
                                    <div class="flex justify-between items-center">
                                      <span class="text-gray-800 text-sm font-semibold">New Message</span>
                                      <span class="text-gray-400 text-xs">2 mins ago</span>
                                    </div>
                                    <p class="text-gray-600 text-sm mt-1">
                                      Bạn có một tin nhắn mới từ ${senderName} trong phòng ${roomName}
                                    </p>
                                </div>`
                });
                $('#list-notification-message').append(html);
                //var unreadCount = notifications.filter(notification => notification.pivot.read_at === null).length;

            },
            error: function(error) {
                console.log(error);
            }
        });


    });

</script>

