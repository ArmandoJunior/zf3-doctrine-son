<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 31/12/2018
 * Time: 16:16
 */

namespace Blog\Inputfilter;


use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class PostInputfilter extends InputFilter
{
    public function __construct()
    {
        $this->add([
            'name' => 'id',
            'required' => true,
            'allow_empty' => true
        ]);

        $this->add([
            'name' => 'title',
            'required' => true,
            'filters' => [
                ['name' => StringTrim::class],
                ['name' => StripTags::class]
            ],
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'O campo é requerido',
                            NotEmpty::INVALID => 'O campo não é válido'
                        ]
                    ]
                ]
            ]
        ]);

        $this->add([
            'name' => 'content',
            'required' => true,
            'validators' => [
                [
                    'name' => NotEmpty::class,
                    'options' => [
                        'messages' => [
                            NotEmpty::IS_EMPTY => 'O campo é requerido',
                            NotEmpty::INVALID => 'O campo não é válido'
                        ]
                    ]
                ]
            ]
        ]);
    }

}