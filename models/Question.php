<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $npp
 * @property string $text
 * @property integer $created
 * @property integer $user_created
 * @property integer $user_take
 * @property string $link
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['npp', 'created', 'publiced', 'user_created', 'user_take'], 'integer'],
            [['text'], 'string'],
            [['link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'npp' => '№п/п',
            'text' => 'Завдання',
            'created' => 'Створено',
            'publiced' => 'Опубліковано',
            'user_created' => 'Автор',
            'user_take' => 'Виконавець',
            'link' => 'Публікація!',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_created']);
    }
    public function getDoers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_take']);
    }
}
