<div class="hidden" id="addNewRoomFormModal">
    <div class="absolute top-0 left-0 h-screen w-full opacity-50 bg-black">
    </div>
    <div class="absolute top-0 left-0 h-screen w-full flex justify-center">
        <div class=" w-1/3 self-center p-4 relative">
            <div class="w-full h-full  bg-white rounded-lg">
                <form id="createRoomForm" class="py-6 px-8">
                    @csrf
                    <!-- Form Title -->
                    <h3 class="text-2xl text-center font-bold pb-4 text-gray-700">Create new Form</h3>
                    <!-- Room Name -->
                    <div class="w-full">
                        <label for="room_name" class="font-lg font-semibold text-gray-600">Room Name: </label>   <br>
                        <input type="text" name="room_name" id="room_name" required
                               placeholder="Type room name"
                               class="w-full py-1.5 px-4 border border-gray-400 rounded-lg mt-1 focus:outline-blue-600"
                               autofocus
                        />
                    </div>
                    <!-- Room Icon -->
                    <div class="w-full mt-3">
                        <label for="room_icon" class="font-lg font-semibold text-gray-600">Room Icon: </label>   <br>
                        <input type="text" name="room_icon" id="room_icon"
                               placeholder="Type room name"
                               class="w-full py-1.5 px-4 border border-gray-400 rounded-lg mt-1 focus:outline-blue-600"
                               autofocus
                        />
                    </div>

                    <!-- Room Description -->
                    <div class="w-full mt-3">
                        <label for="room_description" class="font-lg font-semibold text-gray-600">Room Description: </label>   <br>
                        <textarea type="text" name="room_description" id="room_description"
                                  placeholder="Type room name"
                                  class="w-full py-1.5 px-4 border border-gray-400 rounded-lg mt-1 focus:outline-blue-600"
                                  rows="3"
                                  autofocus
                        ></textarea>
                    </div>

                    <!-- Submit button -->
                    <div class="w-full mt-3 ">
                        <div class="flex justify-end items-center gap-2">
                            <button type="button" onclick="closeModal('addNewRoomFormModal')" class="bg-gray-500 border border-gray-500 text-white py-2 px-4 rounded-lg hover:bg-white hover:text-gray-500 ">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 border border-blue-500 text-white py-2 px-4 rounded-lg hover:bg-white hover:text-blue-600">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <button type="button" onclick="closeModal('addNewRoomFormModal')"
                    class="absolute top-0 right-0 border border-gray-300 bg-gray-300 w-8 h-8 rounded-full text-red-500 hover:text-white hover:bg-red-500 hover:border-red-500">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>
