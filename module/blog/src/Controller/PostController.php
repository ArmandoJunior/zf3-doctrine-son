<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 01/01/2019
 * Time: 12:21
 */

namespace Blog\Controller;


use Blog\Form\CommentForm;
use Blog\Model\Comment;
use Blog\Model\CommentTable;
use Blog\Model\PostTable;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    /**
     * @var PostTable
     */
    private $table;

    /**
     * @var string
     */
    private $routeSite;
    /**
     * @var CommentForm
     */
    private $form;
    /**
     * @var CommentTable
     */
    private $commentTable;
    /**
     * @var Comment
     */
    private $comment;


    /**
     * PostController constructor.
     * @param PostTable $table
     * @param CommentForm $form
     * @param CommentTable $commentTable
     */
    public function __construct(PostTable $table, CommentForm $form, CommentTable $commentTable)
    {
        $this->table = $table;
        $this->form = $form;
        $this->routeSite = 'site-post';
        $this->commentTable = $commentTable;
//        $this->comment = $comment;
    }

    public function indexAction()
    {
        $postTable = $this->table;

        return new ViewModel([
            'posts' => $postTable->fetchAll()
        ]);
    }

    public function showAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        $form = $this->form;

        if(!$id) {
            return $this->redirect()->toRoute($this->routeSite);
        }

        try {
            $post = $this->table->find($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute($this->routeSite);
        }

        return new ViewModel([
           'post' => $post,
            'commentForm' => $form
        ]);
    }

    public function addCommentAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if(!$id) {
            return $this->redirect()->toRoute($this->routeSite);
        }

        $request = $this->getRequest();
        if(!$request->isPost()) {
            return $this->redirect()->toRoute($this->routeSite);
        } else {
            try {
                $post = $this->table->find($id);
            } catch (\Exception $e) {
                return $this->redirect()->toRoute($this->routeSite);
            }

            $form = $this->form;
            $form->setData($request->getPost());

            if (!$form->isValid()) {
                return $this->redirect()->toRoute($this->routeSite, ['action' => 'show', 'id' => $post->id]);
            }

            $data = $form->getData();
            $data['post_id'] = $post->id;

            $comment = new Comment();
            $comment->exchangeArray($data);

            $this->commentTable->save($comment);

            return $this->redirect()->toRoute($this->routeSite, ['action' => 'show', 'id' => $post->id]);
        }
    }
}