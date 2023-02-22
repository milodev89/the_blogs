@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        @include('layouts.nav_user')

        <main class="col-md-8">
            @if (Session::has('success'))
                {{ Session::get('success') }}
            @endif
        </main>


        
    </div>
</div>
@endsection
