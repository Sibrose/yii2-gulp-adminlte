<?php

namespace app\modules\admin\forms;

use Yii;
use yii\base\Model;

use app\models\User;

/**
 * Форма для восстановления пароля
 *
 * @property User|null $user This property is read-only.
 *
 */
class PasswordResetForm extends Model
{
    public $password;
    public $passwordRepeat;
    private $user;

    public function __construct($user)
    {
        $this->user = $user;

        parent::__construct();
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['password', 'passwordRepeat'], 'required'],
            ['password', 'string', 'min' => 6],
            ['passwordRepeat', 'compare', 'compareAttribute'=>'password', 'message' => "Повторение пароля не совпадает" ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => 'Пароль',
            'passwordRepeat' => 'Повторение пароля'
        ];
    }

    public function resetPassword()
    {
        if (!$this->validate()) {
            return false;
        }

        $this->user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $this->user->password_reset_token = null;
        $this->user->password_reset_token_expired_on = null;

        return $this->user->save();
    }
}
