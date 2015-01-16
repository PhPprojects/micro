<?php

namespace App\controllers;

use Micro\Micro;
use Micro\base\Registry;
use App\components\View;
use Micro\web\FormBuilder;
use App\components\Controller;
use App\models\LoginFormModel;

class DefaultController extends Controller
{
    public function filters()
    {
        return [
            [
                'class'   => '\Micro\filters\AccessFilter',
                'actions' => [ 'login', 'logout', 'index', 'error' ],
                'rules'   => [
                    [
                        'allow'   => false,
                        'actions' => [ 'index' ],
                        'users'   => [ '@' ],
                        'message' => 'Only for not authorized!'
                    ],
                    [
                        'allow'   => false,
                        'actions' => [ 'login' ],
                        'users'   => [ '@' ],
                        'message' => 'Not authorized only'
                    ],
                    [
                        'allow'   => false,
                        'actions' => [ 'logout' ],
                        'users'   => [ '?' ],
                        'message' => 'Authorized only'
                    ],
                ]
            ],
            [
                'class'   => '\Micro\filters\CsrfFilter',
                'actions' => [ 'login' ]
            ],
            [
                'class'   => '\Micro\filters\XssFilter',
                'actions' => [ 'index', 'login', 'logout' ],
                'clean'   => '*'
            ]
        ];
    }

    public function actionIndex()
    {
        return new View;
    }

    public function actionLogin()
    {
        $form = new FormBuilder(
            include Micro::getInstance()->config['AppDir'] . '/views/default/loginform.php',
            new LoginFormModel(),
            'POST'
        );

        if (isset( $_POST['LoginFormModel'] )) {
            $form->setModelData( $_POST['LoginFormModel'] );
            if ($form->validateModel() AND $form->getModel()->logined()) {
                $this->redirect( '/profile' );
            }
        }

        $v = new View;
        $v->addParameter( 'form', $form );
        return $v;
    }

    public function actionError()
    {
        $result = null;
        if (isset( $_POST['errors'] )) {
            foreach ($_POST['errors'] AS $err) {
                $result .= '<h3 class="text-danger bg-danger">' . $err . '</h3>';
            }
        }
        $v       = new View;
        $v->data = $result ? $result : 'undefined error';
        return $v;
    }

    public function actionLogout()
    {
        Registry::get( 'session' )->destroy();
        $this->redirect( '/' );
    }
}