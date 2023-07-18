<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\Base\BaseController;
use app\Exceptions\ShowableException;
use app\models\Auth\User;
use app\models\Auth\UserForm;
use app\models\Auth\UserRole;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class UsersController extends BaseController
{
    function actionList(): Response|string
    {
        if($response = $this->redirectIfNotAdmin()) return $response;
        $provider = new ActiveDataProvider([
            'query' => User::find()->with(['role']),
            'pagination' => [
                'pageSize' => 15
            ]
        ]);
        return $this->render('list', ['provider' => $provider]);
    }

    function actionUpdate(string $id): Response|string
    {
        if($redirect = $this->redirectIfNotAdmin()) return $redirect;
        $form = new UserForm();
        if($form->load($this->getRequest()->post()) && $form->updateUser($id)) {
            $this->setAlert('user was updated');
            return $this->redirect('/users/list');
        }
        /**
         * @var User $user;
         */
        $user = User::findOne($id);
        if(!$user) throw new ShowableException('cant find this entity');
        $form->email = $user->email;
        $form->role_id = (string)$user->role->id;
        $form->surname = $user->surname;
        $form->name = $user->name;
        $roles = UserRole::find()->all();
        $userRoles = [];
        foreach ($roles as $role) {
            $userRoles[$role->id] = $role->name;
        }
        return $this->render('user-form', ['model' => $form, 'roles' => $userRoles]);
    }

    function actionDelete(string $id): Response
    {
        if($redirect = $this->redirectIfNotAdmin()) return $redirect;
        $user = User::findOne($id);
        if(!$user) throw new ShowableException('cant find this entity');
        $user->delete();
        $this->setAlert('user was deleted');
        return $this->redirect('/users/list');
    }

}