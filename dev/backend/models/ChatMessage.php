<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "chat_message".
 *
 * @property integer $id
 * @property integer $sender
 * @property string $message
 * @property string $updateDate
 * @property integer $chat_id
 * @property integer $is_read
 *
 * @property Chat $chat
 */
class ChatMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender', 'chat_id'], 'required'],
            [['sender', 'chat_id', 'is_read'], 'integer'],
            [['message'], 'string'],
            [['updateDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender' => 'Sender',
            'message' => 'Message',
            'updateDate' => 'Update Date',
            'chat_id' => 'Chat ID',
            'is_read' => 'Is Read',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChat()
    {
        return $this->hasOne(Chat::className(), ['chat_id' => 'chat_id']);
    }
}
