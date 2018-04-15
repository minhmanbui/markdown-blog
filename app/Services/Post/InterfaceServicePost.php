<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\User;

interface InterfaceServicePost
{
    /**
     * list of post pagination
     * @param  integer $numberItem [description]
     * @param  [type]  $status     [description]
     * @return [type]              [description]
     */
    public function paginationPost($numberItem = 10, $status = Post::POST_STATUS_APPROVED);

    /**
     * create post
     * @param  User   $creater [description]
     * @param  array  $data    [description]
     * @return [type]          [description]
     */
    public function createPost(User $creater, array $data);

    /**
     * update post
     * @param  Post   $post     [description]
     * @param  User   $modifier [description]
     * @param  array  $data     [description]
     * @return [type]           [description]
     */
    public function updatePost(Post $post, User $modifier, array $data);

    /**
     * approve post
     * @param  Post   $post     [description]
     * @param  User   $approver [description]
     * @return [type]           [description]
     */
    public function approvePost(Post $post, User $approver);

    /**
     * remove post
     * @param  Post   $post [description]
     * @return [type]       [description]
     */
    public function removePost(Post $post);
}
