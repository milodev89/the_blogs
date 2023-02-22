@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        @include('layouts.nav_user')

        <main class="col-md-8">

            <h2>Edit Post: {{ $post->title }}</h2>
            <form action="{{ route('update_post', $post) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="titlepost">Title</label>
                    <input type="text" class="form-control" name="title" id="titlepost" value="{{ old('title', $post->title) }}" required>
                </div>
                <div class="form-group">
                    <label for="bodypost">Body</label>
                    <textarea name="body" class="form-control" id="bodypost" cols="30" rows="10">{{ old('body', $post->body) }}</textarea>
                </div>
                <div class="row">                    
                    <div class="col-md-6 form-group">
                        <label for="categoriespost">Categories</label>
                        <select name="category_id" id="categoriespost" class="form-control" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{($post->category_id == $category->id ? 'selected' : '')}}" >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="statuspost">Status</label>
                        <select name="status_id" id="statuspost" class="form-control" {{ ($post->status->name != 'Draft' ? 'disabled' : '') }} required>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{($post->status_id == $status->id ? 'selected' : '')}} >{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tagspost">Tags</label>
                    <input type="text" data-role="tagsinput" class="form-control" name="tags" id="tagspost" placeholder="Write a Tag" value="{{ $tags }}" required>
                </div>
                @if($post->status->name == 'Draft')
                <button style="margin-top:10px" type="submit" class="btn btn-primary">Update</button>
                @endif
            </form>

        </main>
        
    </div>
</div>
@endsection