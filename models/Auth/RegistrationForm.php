<?php
declare(strict_types=1);

namespace app\models\Auth;

use yii\base\Model;
use yii\db\IntegrityException;

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
            } catch (IntegrityException $exception) {
                if($exception->getCode() === '23000') {
                    $this->addError('email', 'this email already in use');
                    return false;
                }
                throw $exception;
            }
            return true;
        }
        return false;
    }

}