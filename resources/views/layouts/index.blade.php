@include('layouts/kodeatas')
@include('layouts/sidebar')
@include('layouts/topbar')

<div class="container-fluid">

    @yield('content')

</div>{{-- /.container-fluid --}}
</div>{{-- End of main Content --}}

@include('layouts/footer')
@include('layouts/kodebawah')