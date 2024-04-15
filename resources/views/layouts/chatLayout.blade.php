<!doctype html>
<html lang="en">
@include('partials.head')
<body>
<div class="app h-screen w-full grid  grid-cols-6 text-base" >
    @include('partials.sidebar')
    <div  class="col-span-5 w-full h-full bg-[#3c425e]">
        @yield('content')
        @include('components.modals.notificationModal')
    </div>

</div>

<!-- add New Room Form Modal -->

@include('components.notification')
@include('partials.bodyJS')

</body>
</html>
