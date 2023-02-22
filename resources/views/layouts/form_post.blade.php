
@csrf
<div class="form-group">
    <label for="titlepost">Title</label>
    <input type="text" class="form-control" name="title" id="titlepost" placeholder="Write a Title">
</div>
<div class="form-group">
    <label for="bodypost">Body</label>
    <textarea name="body" class="form-control" id="bodypost" cols="30" rows="10"></textarea>
</div>
<div class="form-group">
    <label for="categoriespost">Categories</label>
    <select name="category_id" id="categoriespost" class="form-control">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="tagspost">Tags</label>
    <input type="text" data-role="tagsinput" class="form-control" name="tags" id="tagspost" placeholder="Write a Tag">
</div>                 
<button style="margin-top:10px" type="submit" class="btn btn-primary">@yield('label_submit')</button>