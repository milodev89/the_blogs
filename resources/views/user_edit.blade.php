@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        @include('layouts.nav_user')

        <main class="col-md-8">

            <h2>Edit User: {{ $user->name }}</h2>
            <form action="{{ route('user_update', $user) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row">                    
                    <div class="col-md-6 col-lg-6 col-sd-12 form-group">
                        <label for="nameuser">Name</label>
                        <input type="text" class="form-control" name="name" id="nameuser" value="{{ old('name', $user->name) }}" required>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sd-12 form-group">
                        <label for="emailuser">Email</label>
                        <input type="text" class="form-control" name="name" id="emailuser" value="{{ old('email', $user->email) }}" required disabled>
                    </div>
                </div>
                <div class="row">                    
                    <div class="col-md-6 col-lg-6 col-sd-12 form-group">
                        <label for="passuser">Password</label>
                        <input type="password" class="form-control" name="password" id="passuser" value="{{ old('password') }}">
                    </div>
                    <div class="col-md-6 col-lg-6 col-sd-12 form-group">
                        <label for="passuser2">Repeat Password</label>
                        <input type="password" class="form-control" id="passuser2" >
                    </div>
                </div>
                <button style="margin-top:10px" type="submit" class="btn btn-primary">Update</button>
            </form>

        </main>
        
    </div>
</div>
@endsection