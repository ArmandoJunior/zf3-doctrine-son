<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 01/01/2019
 * Time: 21:24
 */

namespace Blog\Model;


class Comment
{
    public $id;
    public $content;
    public $post_id;

    public function exchangeArray(array $data)
    {
        $this->id       = $data['id'] ?? null;
        $this->content  = $data['content'] ?? null;
        $this->post_id  = $data['post_id'] ?? null;
    }
    public function getArrayCopy()
    {
        return [
            'id'        => $this->id,
            'content'   => $this->content,
            'post_id'     => $this->post_id
        ];
    }


}