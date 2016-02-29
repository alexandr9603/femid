<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property integer $id
 * @property string $question
 * @property string $answers
 * @property integer $right
 */
class Tests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answers'], 'required'],
            [['question', 'answers'], 'string'],
            [['right'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Вопрос',
            'answers' => 'Ответы',
            'right' => 'Правильный',
        ];
    }
}
