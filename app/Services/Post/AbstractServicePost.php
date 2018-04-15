<?php

namespace App\Services\Post;

use App\Models\Post;

abstract class AbstractServicePost
{
    protected function prepareDataBeforeSave(Post $post, array $data)
    {
        if (empty($data)) {
            return;
        }

        foreach ($this->mappingFields() as $field => $attribute) {
            $post->{$attribute} = $data[$field];
        }

    }

    protected function mappingFields()
    {
        return [
            'title' => 'p_title',
            'content' => 'p_content'
        ];
    }
}
