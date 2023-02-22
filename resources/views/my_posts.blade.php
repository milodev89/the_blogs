@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        @include('layouts.nav_user')

        <main class="col-md-8">

            <div align="right">
                <a href="{{ route('create_post') }}" class="btn btn-primary">Create a post</a>
            </div>
            <br>

            <table class="table table-sm">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>Title</th>
                        <th>Url</th>
                        <th>Created date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td><a href="{{route('show_post', $post->slug)}}">{{$post->title}}</a></td>
                            <td>\{{$post->slug}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>{{$post->status->name}}</td>
                            <td align="center"><a href="{{ route('edit_post', $post->uuid) }}" class="btn btn-warning">Editar</a>
                                @if($post->status->name != 'Deleted')<form action="{{route('delete_post', $post->uuid)}}" method="post">
                                    @csrf
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>@endif</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" align="center">Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </main>


        
    </div>
</div>
@endsection
