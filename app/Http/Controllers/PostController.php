<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Status;

use App\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    private PostRepositoryInterface $postRepository; 

    public function __construct(PostRepositoryInterface $postRepository) 
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $posts = Post::posted()->orderBy('id', 'DESC')->get();
        return view('posts', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return View('create_post', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CreatePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $message = "";
        try {
            $this->postRepository->createPost($request->all()); 
            $message = "Post created!";
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }               
        return redirect('home')->with("success", $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $post = $this->postRepository->getPostByUrl($url); 
        return View('show_post', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $categories = Category::all();
        $post = $this->postRepository->getPostByUuid($uuid); 
        $tags = $this->postRepository->getTagsPostById($post->id); 
        $tags = implode(', ', $tags->pluck('tag')->toArray());
        $statusNames = !in_array($post->status->name, ['Draft', 'In Review']) ? 
                    ['Draft', 'In Review', $post->status->name] : 
                    ['Draft', 'In Review'];
        $status = Status::where(['table' => 'posts'])->whereIn('name', $statusNames)->get();
        
        return View('edit_post', ['categories' => $categories, 'post' => $post, 'tags' => $tags, 'statuses' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdatePostRequest  $request
     * @param  App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $message = "";
        try {
            $this->postRepository->updatePost($post->id, $request->except(['_token', '_method'])); 
            $message = "Post updated!";
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }          
        return redirect('home')->with("success", $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $message = "";
        try {
            $this->postRepository->deletePost($uuid); 
            $message = "Post deleted!";
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }               
        return redirect('home')->with("success", $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\CommentPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store_comment(CommentPostRequest $request)
    {
        $message = "";
        try {
            $this->postRepository->createCommentPost($request->all()); 
            $message = "Comment Post created!";
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }               
        return redirect('home')->with("success", $message);
    }


}
