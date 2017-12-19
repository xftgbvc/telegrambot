<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "film_person".
 *
 * @property int $person_id
 * @property int $film_id
 * @property int $personType_id
 */
class FilmPerson extends \yii\db\ActiveRecord
{
    const TYPE_ACTOR = 1;
    const TYPE_DIRECTOR = 2;
    const TYPE_WRITER = 3;
    const TYPE_OPERATOR = 4;
    const TYPE_PRODUCER = 5;
    const TYPE_COMPOSER = 6;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'film_person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id', 'film_id', 'personType_id'], 'required'],
            [['person_id', 'film_id', 'personType_id'], 'default', 'value' => null],
            [['person_id', 'film_id', 'personType_id'], 'integer'],
            [['person_id', 'film_id', 'personType_id'], 'unique', 'targetAttribute' => ['person_id', 'film_id', 'personType_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'film_id' => 'Film ID',
            'personType_id' => 'Person Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['person_id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Film::className(), ['film_id' => 'film_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonType()
    {
        return $this->hasOne(PersonType::className(), ['personType_id' => 'personType_id']);
    }
}
