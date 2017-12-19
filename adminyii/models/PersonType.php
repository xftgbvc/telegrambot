<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personType".
 *
 * @property int $personType_id
 * @property string $name
 */
class PersonType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'personType';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'personType_id' => 'Person Type ID',
            'name' => 'Название',
        ];
    }
}
