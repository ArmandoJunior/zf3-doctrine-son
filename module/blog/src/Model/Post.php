<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 30/12/2018
 * Time: 17:55
 */

namespace Blog\Model;


class Post
{
    public $id;
    public $title;
    public $content;
    public $comments;

    public function exchangeArray(array $data)
    {
        $this->id       = $data['id'] ?? null;
        $this->title    = $data['title'] ?? null;
        $this->content  = $data['content'] ?? null;
    }
    public function getArrayCopy()
    {
        return [
            'id'        => $this->id,
            'title'     => $this->title,
            'content'   => $this->content
        ];
    }

}