@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>
                {{ $post->title }}
            </h2>
            <p>
                {{ $post->body }}
            </p>
        </div>
        <form action="{{ route('comment_post') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="favorite">Favorite?</label>
                <select name="favorite" id="favorite" class="form-control">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <div>
                <button style="margin-top:10px" type="submit" class="btn btn-primary">Send comment</button>
            </div>
        </form>
    </div>
</div>
@endsection