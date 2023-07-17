<?php

namespace app\models\Auth;

use app\models\Base\BaseModel;
use yii\db\ActiveQuery;

/**
 * @property int $id;
 * @property string $name;
 * @property string $surname;
 * @property string $password;
 * @property string $auth_key;
 * @property string $access_token;
 * @property string $email;
 * @property UserRole $role;
 */
class User extends BaseModel implements \yii\web\IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): static
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): static
    {
        return static::findOne(['access_token' => $token]);
    }


    public static function findByEmail(string $email): ?static
    {
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return self::find()->where(['email' => $email])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): string
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return \Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    function getRole(): ActiveQuery
    {
        return $this->hasOne(UserRole::class, ['id' => 'role_id']);
    }

    function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = \Yii::$app->getSecurity()->generatePasswordHash($this->password);
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
    function getFullName(): string
    {
        return "$this->name $this->surname";
    }
}
