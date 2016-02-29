<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $task_id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $txt
 * @property integer $urist_id
 * @property string $date_add
 * @property string $date_upd
 * @property double $price
 * @property integer $stat
 * @property integer $form
 * @property string $name
 *
 * @property Chat[] $chats
 * @property User $urist
 * @property Category $category
 * @property User $user
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'txt','date_add', 'date_upd', 'name'], 'required'],
            [['user_id', 'category_id', 'urist_id', 'stat', 'form'], 'integer'],
            [['txt'], 'string'],
            [['date_add', 'date_upd'], 'safe'],
            [['price'], 'double'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'user_id' => 'Пользователь',
            'category_id' => 'Категория',
            'txt' => 'Сообщение',
            'urist_id' => 'Юрист',
            'date_add' => 'Дата добавления',
            'date_upd' => 'Дата изменения',
            'price' => 'Цена',
            'stat' => 'Stat',
            'form' => 'Form',
            'name' => 'Заголовок',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChats()
    {
        return $this->hasMany(Chat::className(), ['task_id' => 'task_id']);
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id_category' => 'category_id']);
    }
    public function getCategoryName()
    {           
        return $this->category->name;
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
    
     public function getTxtstatus($id)
    {
        $stat[0]='У администратора';
        $stat[1]='У юриста';
        $stat[2]='У пользователя';
        $stat[3]='Юрист отклонил';
        $stat[4]='Пользователь отклонил';
        $stat[5]='Пользователь принял';
        $stat[6]='Задача решена';
        return $stat[$id];
    }
}
