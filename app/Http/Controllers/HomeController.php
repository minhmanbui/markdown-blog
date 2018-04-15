<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Services\Post\ServicePost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const NUMBER_ITEM_POST_PER_PAGE = 5;

    private $srvPost;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServicePost $servicePost)
    {
        $this->srvPost = $servicePost;
    }

    /**
     * Show all post approved
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->srvPost->paginationPost(self::NUMBER_ITEM_POST_PER_PAGE);

        return view('home', compact('posts'));
    }

    /**
     * create post page
     * @return [type] [description]
     */
    public function viewCreatePost()
    {
        return view('post.new');
    }

    /**
     * action create post
     * @param  PostRequest $request [description]
     * @return [type]               [description]
     */
    public function actionCreatePost(PostRequest $request)
    {
        $data = $request->all();
        $post = $this->srvPost->createPost(Auth::user(), $data);

        if ($post) {
            return redirect()->route('post.create.success');
        }
    }

    /**
     * page success create post
     * @return [type] [description]
     */
    public function viewCreatePostSuccess()
    {
        return view('post.new_success');
    }

    /**
     * detail post
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function viewDetailPost(Post $post)
    {
        return view('post.detail', compact('post'));
    }

    public function editPost(Post $post)
    {
        //@TODO : edit post
    }


}
