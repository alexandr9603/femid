<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "alerts".
 *
 * @property integer $alert_id
 * @property integer $user_sender
 * @property string $message
 * @property integer $is_viewed
 * @property integer $user_get
 * @property string $date
 * @property integer $task_id
 * @property string $href
 *
 * @property User $userSender
 * @property User $userGet
 * @property Tasks $task
 */
class Alerts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alerts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_sender', 'is_viewed', 'user_get', 'task_id'], 'integer'],
            [['message', 'user_get', 'task_id', 'href'], 'required'],
            [['message'], 'string'],
            [['date'], 'safe'],
            [['href'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alert_id' => 'Alert ID',
            'user_sender' => 'User Sender',
            'message' => 'Message',
            'is_viewed' => 'Is Viewed',
            'user_get' => 'User Get',
            'date' => 'Date',
            'task_id' => 'Task ID',
            'href' => 'Href',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSender()
    {
        return $this->hasOne(User::className(), ['id' => 'user_sender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGet()
    {
        return $this->hasOne(User::className(), ['id' => 'user_get']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
    }
}
