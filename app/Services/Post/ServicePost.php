<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\User;

class ServicePost extends AbstractServicePost implements InterfaceServicePost
{
    public function createPost(User $creater, array $data)
    {
        $post = new Post();

        $this->prepareDataBeforeSave($post, $data);

        $creater->posts()->save($post);

        return $post;
    }

    public function updatePost(Post $post, User $modifier, array $data)
    {
        $this->prepareDataBeforeSave($post, $data);

        $post->setModifier($modifier);

        return $post->save();
    }

    public function approvePost(Post $post, User $approver)
    {
        if (!$approver->isAdmin()) {
            return false;
        }

        if ($post->isApproved()) {
            return true;
        }

        $post->setStatus(Post::POST_STATUS_APPROVED);
        $post->setApprover($approver);

        return $post->save();
    }

    public function removePost(Post $post)
    {
        return $post->delete();
    }

    public function paginationPost($numberItem = 10, $status = Post::POST_STATUS_APPROVED)
    {
        return Post::where('p_status', $status)
            ->orderBy('created_at', 'desc') //get newest post
            ->paginate($numberItem);
    }
}
