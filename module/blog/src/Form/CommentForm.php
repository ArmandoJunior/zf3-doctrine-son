<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 01/01/2019
 * Time: 13:16
 */

namespace Blog\Form;


use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class CommentForm extends Form
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'content',
            'type' => Textarea::class,
            'options' => [
                'label'=> 'Content'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value'=> 'Go',
                'id'=>'submitbutton'
            ]
        ]);
    }

}