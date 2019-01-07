<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 01/01/2019
 * Time: 22:40
 */

namespace Blog\Model;

use Zend\Db\TableGateway\Exception\RuntimeException;
use Zend\Db\TableGateway\TableGatewayInterface;

class CommentTable
{
    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll($post_id)
    {
        return $this->tableGateway->select([
            'post_id' => $post_id
        ]);
    }

    public function save(Comment $comment)
    {
        $data = [
            'content' => $comment->content,
            'post_id' => $comment->post_id
        ];

        $this->tableGateway->insert($data);

        return;
    }

    public function find($id)
    {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();

        if (!$row) {
            throw  new RuntimeException(sprintf(
                'Could not retrieve the row %d', $id
            ));
        }

        return $row;
    }
}