<?php
/**
 * Created by PhpStorm.
 * User: arman
 * Date: 31/12/2018
 * Time: 21:01
 */

namespace User\Form;


use Zend\Form\Element;
use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        $this->add([
            'name' => 'username',
            'type' => Element\Text::class,
            'options' => [
                'label'=> 'Usuario'
            ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => Element\Password::class,
            'options' => [
                'label'=> 'Senha'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value'=> 'Entrar',
                'id'=>'submitbutton'
            ]
        ]);
    }
}