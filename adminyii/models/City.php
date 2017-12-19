<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "city".
 *
 * @property int $city_id
 * @property string $city
 * @property int $country_id
 *
 * @property Country $country
 * @property Person[] $people
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id'], 'default', 'value' => null],
            [['country_id'], 'integer'],
            [['city'], 'string', 'max' => 100],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'country_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'city_id' => 'City ID',
            'city' => 'Город',
            'country_id' => 'Страна',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['country_id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['city_id' => 'city_id']);
    }

    //==================================================================================================================
    //Списки данных
    //==================================================================================================================
    public function getCountryList()
    {
        return ArrayHelper::map(Country::find()->orderBy('country')
            ->asArray()
            ->all(), 'country_id', 'country');
    }
}
