<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Status;
use App\Models\Post;
use App\Models\Post_tag;
use App\Models\Tag;

class PostRepository implements PostRepositoryInterface 
{
    public function getAllPosts() 
    {
        return Post::all();
    }

    public function getPostById($postId) 
    {
        return Post::findOrFail($postId);
    }

    public function getPostByUuid($postUuid) 
    {
        return Post::where(['uuid' => $postUuid])->firstOrFail();
    }

    public function deletePost($postId) 
    {
        Post::where(['uuid' => $postId])->update(['status_id' => Status::where(['name' => 'Deleted', 'table' => 'posts'])->first()->id]);
    }

    public function createPost(array $postDetails) 
    {
        DB::beginTransaction();
        try
        {
            $data = array_merge($postDetails, ['uuid'=>Str::uuid()->toString(),'slug'=>Str::slug($postDetails['title'], '-'),'status_id'=>Status::draft()->first()->id, 'user_id'=>Auth::user()->id]);
            $post = Post::create($data);

            $tags = collect(explode(',', $postDetails['tags']))->map(function($tag){ 
                return ['tag'=>trim($tag)];
            });
            
            $idTags = [];
            foreach ($tags->toArray() as $key => $value) {
                $tag = Tag::firstOrCreate($value);
                array_push($idTags, new Post_tag(['tag_id'=>$tag->id]));
            }
            
            $post->tags()->saveMany($idTags);            
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $e->getMessage();
        }

        return $post;
    }

    public function updatePost($postId, array $newDetails) 
    {
        DB::beginTransaction();
        try
        {
            $post = Post::whereId($postId)->first();
            $post = $this->saveTags($post, $newDetails['tags']);
            unset($newDetails['tags']);
            $post->update($newDetails);
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $e->getMessage();
        }
        return $post;
    }

    public function getTagsPostById($id) 
    {
        return Post::find($id)->tags->map(function(Post_tag $post_tags){
            return [
                'tag' => $post_tags->tag->tag
            ];
        });
    }

    public function getPostByUrl($url)
    {
        return Post::where(['slug' => $url])->first();
    }

    public function saveTags($post, $tags)
    {
        $newTags = collect(explode(',', $tags))->map(function($tag){ 
            return ['tag'=>trim($tag)];
        });
        $idTags = [];
        foreach ($newTags->toArray() as $key => $value) {
            $tag = Tag::firstOrCreate($value);
            array_push($idTags, new Post_tag(['tag_id'=>$tag->id]));
        }
        Post_tag::where(['post_id' => $post->id])->delete();
        $post->tags()->saveMany($idTags);
        return $post;
    }
}