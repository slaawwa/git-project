<?php
namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;
/*use backend\models\AuthAssignment;*/

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required', 'message'=>'Введіть Ваше ім`я'],
            // ['username', 'unique', 'targetClass' => '\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Ваш email має бути особливим. Цей email уже зареєстровано.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            // echo '<hr>$user->id: '.isset($user->id).'<hr>';
            $user->save();

            if (isset($user->id)) {
                return $user;
            }
        }

        return null;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Ім’я',
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }
}
