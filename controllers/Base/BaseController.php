<?php
declare(strict_types=1);

namespace app\controllers\Base;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    function redirectIfGuest(): ?Response
    {
        if(Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('info', 'Please login for show this page');
            return $this->redirect('/auth/login');
        }
        return null;
    }
}