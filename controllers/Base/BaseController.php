<?php
declare(strict_types=1);

namespace app\controllers\Base;

use app\Enums\UserRoleEnum;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;

class BaseController extends Controller
{
    function redirectIfGuest(): ?Response
    {
        if(Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('info', 'Please login for show this page');
            return $this->redirect('/auth/login');
        }
        return null;
    }
    function getRequest(): Request
    {
        return \Yii::$app->request;
    }

    function setAlert(string $message, string $type = 'info')
    {
        \Yii::$app->session->setFlash($type, $message);
    }
    function redirectIfNotAdmin(): ?Response
    {
        $user = \Yii::$app->user;
        if( $user->isGuest || $user->getIdentity()->role_id !== UserRoleEnum::Admin->value) {
            $this->setAlert('You dont have admin privileges for this action', 'warning');
            return $this->goBack();
        }
        return null;
    }
}