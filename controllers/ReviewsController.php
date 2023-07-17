<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\Base\BaseController;
use app\models\Reviews\Review;
use app\models\Reviews\ReviewForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Response;

class ReviewsController extends BaseController
{
    function actionList(): string|Response
    {
        $redirect = $this->redirectIfGuest();
        if($redirect) return $redirect;
        $query = Review::find()->with(['author']);
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('list', ['provider' => $provider]);
    }
    function actionView(): string|Response
    {
        $redirect = $this->redirectIfGuest();
        if($redirect) return $redirect;
        $review = Review::findOne(Yii::$app->request->get('id'));
        if (!$review) throw new Exception('this entity not found');
        return $this->render('view', ['review' => $review]);
    }
    function actionCreate(): string|Response
    {
        if($redirect = $this->redirectIfGuest()) return $redirect;
        $form = new ReviewForm();
        if($form->load(\Yii::$app->request->post()) && $form->createReview()) {
            \Yii::$app->session->setFlash('info', 'feedback was created');
            return $this->redirect('/reviews/list');
        }
        return $this->render('review-form', ['model' => $form]);
    }


}