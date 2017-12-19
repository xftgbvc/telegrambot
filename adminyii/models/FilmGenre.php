<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "film_genre".
 *
 * @property int $film_id
 * @property int $genre_id
 */
class FilmGenre extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'film_genre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['film_id', 'genre_id'], 'required'],
            [['film_id', 'genre_id'], 'default', 'value' => null],
            [['film_id', 'genre_id'], 'integer'],
            [['film_id', 'genre_id'], 'unique', 'targetAttribute' => ['film_id', 'genre_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'film_id' => 'Film ID',
            'genre_id' => 'Genre ID',
        ];
    }
}
