<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property integer $chat_id
 * @property integer $user_id
 * @property integer $urist_id
 * @property integer $task_id
 * @property string $date_add
 *
 * @property Tasks $task
 * @property User $user
 * @property User $urist
 * @property ChatMessage[] $chatMessages
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'urist_id', 'task_id'], 'required'],
            [['user_id', 'urist_id', 'task_id'], 'integer'],
            [['date_add'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chat_id' => 'Chat ID',
            'user_id' => 'User ID',
            'urist_id' => 'Urist ID',
            'task_id' => 'Task ID',
            'date_add' => 'Date Add',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
    }
    public function getTaskName()
    {           
        return $this->task->name;
    }
   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

     public function getUserName()
    {           
        return $this->user->username." ".$this->user->last_name;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrist()
    {
        return $this->hasOne(User::className(), ['id' => 'urist_id']);
    }
    
     public function getUristName()
    {           
        return $this->urist->username." ".$this->urist->last_name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChatMessages()
    {
        return $this->hasMany(ChatMessage::className(), ['chat_id' => 'chat_id']);
    }
}
