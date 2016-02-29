<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property integer $id_answer
 * @property integer $id_question
 *
 * @property Tests $idQuestion
 */
class Answers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_answer', 'id_question'], 'required'],
            [['id_answer', 'id_question'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_answer' => 'Id Answer',
            'id_question' => 'Id Question',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdQuestion()
    {
        return $this->hasOne(Tests::className(), ['id' => 'id_question']);
    }
}
