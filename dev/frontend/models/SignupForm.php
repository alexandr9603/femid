<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $last_name;
    public $username;
    public $tel;
    public $email;
    public $groups;
    public $password;
    public $password_repeat;
    public $lvl;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            
            ['last_name', 'filter', 'filter' => 'trim'],
            ['last_name', 'required'],
            ['last_name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
            ['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => 6],
            ['password_repeat', 'compare','compareAttribute'=>'password'],
            
            ['tel', 'required'],
            ['tel', 'string', 'min' => 6],
            
            ['groups', 'required'],
            ['lvl', 'required']
            
            
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
            $user->last_name = $this->last_name;
            $user->tel = $this->tel;
            $user->email = $this->email;
            $user->groups = $this->groups;
            $user->lvl = $this->lvl;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
