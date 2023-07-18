<?php
declare(strict_types=1);

namespace app\models\Auth;

use yii\base\Model;

class UserForm extends Model
{
    public string $name = '';
    public string $surname = '';
    public string $role_id = '';
    public string $email = '';

    public function rules(): array
    {
        return [
            [['name', 'surname', 'email', 'role_id'], 'required'],
            ['email', 'email'],
            [['name', 'surname'], 'string', 'length' => ['2', '30']],
            ['role_id', 'exist', 'targetClass' => UserRole::class, 'targetAttribute' => 'id']
        ];
    }

    function updateUser(string $id): bool
    {
        if($this->validate()) {
            $user = User::findOne($id);
            $user->name = $this->name;
            $user->surname = $this->surname;
            $user->role_id = $this->role_id;
            $user->email = $this->email;
            $user->save();
            return true;
        }
        return false;
    }

}