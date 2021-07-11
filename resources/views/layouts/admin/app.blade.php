<html>
{{--@section('header')--}}
   @include('layouts/admin/header')
{{--@show--}}
{{--@section('sidebar')--}}
{{--<div class="wrapper ">--}}
    @include('layouts/admin/sidebar')
{{--@show--}}


        @include('layouts/admin/navbar')

<div id="main">
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
         @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>


{{--</div>--}}
</body>

{{--@section('footer')--}}
    @include('layouts/admin/footer')
{{--@show--}}

</html>
