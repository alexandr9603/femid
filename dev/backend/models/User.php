<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $username
 * @property string $last_name
 * @property string $tel
 * @property integer $groups
 *
 * @property Alerts[] $alerts
 * @property Alerts[] $alerts0
 * @property Chat[] $chats
 * @property Chat[] $chats0
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['auth_key', 'password_hash', 'email', 'created_at', 'updated_at', 'username', 'last_name', 'tel'], 'required'],
            [['status', 'created_at', 'updated_at', 'groups'], 'integer'],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email', 'username', 'last_name'], 'string', 'max' => 255],
            [['tel'], 'string', 'max' => 13],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
            'last_name' => 'Last Name',
            'tel' => 'Tel',
            'groups' => 'Groups',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlerts()
    {
        return $this->hasMany(Alerts::className(), ['user_get' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlerts0()
    {
        return $this->hasMany(Alerts::className(), ['user_sender' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats0()
    {
        return $this->hasMany(Chat::className(), ['urist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['urist_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Tasks::className(), ['user_id' => 'id']);
    }
}
