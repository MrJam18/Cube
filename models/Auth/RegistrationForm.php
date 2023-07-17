<?php
declare(strict_types=1);

namespace app\models\Auth;

use Exception;
use yii\base\Model;

class RegistrationForm extends Model
{
    public string $name = '';
    public string $surname = '';
    public string $password = '';
    public string $confirmPassword = '';
    public string $email = '';

    public function rules(): array
    {
        return [
            [['name', 'surname', 'password', 'confirmPassword', 'email'], 'required'],
            ['email', 'email'],
            [['name', 'surname'], 'string', 'length' => ['2', '30']],
            ['password', 'compare', 'compareAttribute' => 'confirmPassword'],
        ];
    }

    public function register(): bool
    {
        if($this->validate()) {
            $user = new User();
            $user->name = $this->name;
            $user->surname = $this->surname;
            $user->password = $this->password;
            $user->email = $this->email;
            try {
                $user->save();
            } catch (Exception) {
                $this->addError('email', 'this email already in use');
                return false;
            }
            return true;
        }
        return false;
    }

}