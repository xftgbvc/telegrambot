<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_messages".
 *
 * @property string $request_message
 * @property string $response_message
 * @property integer $user_id
 * @property string $user_name
 * @property string $created_at
 * @property integer $user_messages_id
 */
class UserMessages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_message', 'response_message'], 'string'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['user_name'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'request_message' => 'Сообщения запроса',
            'response_message' => 'Сообщения ответа',
            'user_id' => 'ID Пользователя',
            'user_name' => 'Имя Ползователя',
            'created_at' => 'Создано',
            'user_messages_id' => 'ID',
        ];
    }
}
