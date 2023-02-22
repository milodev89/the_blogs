@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        @include('layouts.nav_user')

        <main class="col-md-8">

            <h2>Create a Post</h2>
            <form action="{{ route('store_post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="titlepost">Title</label>
                    <input type="text" class="form-control" name="title" id="titlepost" placeholder="Write a Title"  required>
                </div>
                <div class="form-group">
                    <label for="bodypost">Body</label>
                    <textarea name="body" class="form-control" id="bodypost" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="categoriespost">Categories</label>
                    <select name="category_id" id="categoriespost" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tagspost">Tags</label>
                    <input type="text" data-role="tagsinput" class="form-control" name="tags" id="tagspost" placeholder="Write a Tag" required>
                </div>                 
                <button style="margin-top:10px" type="submit" class="btn btn-primary">Create</button>
            </form>

        </main>
        
    </div>
</div>
@endsection