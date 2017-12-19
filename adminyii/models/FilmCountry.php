<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "film_country".
 *
 * @property int $film_id
 * @property int $country_id
 */
class FilmCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'film_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['film_id', 'country_id'], 'required'],
            [['film_id', 'country_id'], 'default', 'value' => null],
            [['film_id', 'country_id'], 'integer'],
            [['film_id', 'country_id'], 'unique', 'targetAttribute' => ['film_id', 'country_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'film_id' => 'Film ID',
            'country_id' => 'Country ID',
        ];
    }
}
