<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use App\Services\Post\ServicePost;
use Auth;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller
{
    const NUMBER_ITEM_POST_PER_PAGE = 5;

    private $srvPost;
    private $currentUser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServicePost $servicePost)
    {
        $this->srvPost = $servicePost;
        $this->currentUser = Auth::check() ? Auth::user() : null;
        //in case auth user is not admin redirect to home
        if ($this->currentUser && !$this->currentUser->isAdmin()) {
            return redirect()->route('home');
        }
    }

    /**
     * Show list post need approve
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->srvPost->paginationPost(self::NUMBER_ITEM_POST_PER_PAGE, Post::POST_STATUS_PENDING);

        return view('admin.index', compact('posts'));
    }

    /**
     * approve post
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function approve(Post $post)
    {
        if (!Request::ajax()) {
            return;
        }

        if (!$this->srvPost->approvePost($post, Auth::user())) {
            return $this->sendFailureAjaxResponse();
        }

        return $this->sendSuccessAjaxResponse();
    }

    /**
     * remove post
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function remove(Post $post)
    {
        if (!Request::ajax()) {
            return;
        }

        if (!$this->srvPost->removePost($post)) {
            return $this->sendFailureAjaxResponse();
        }

        return $this->sendSuccessAjaxResponse();
    }

    protected function sendFailureAjaxResponse()
    {
        $response = [
            'status' => 0,
            'message' => 'Something wrong'
        ];

        return response()->json($response, 200);
    }

    protected function sendSuccessAjaxResponse()
    {
        $response = [
            'status' => 1
        ];

        return response()->json($response, 200);
    }


}
