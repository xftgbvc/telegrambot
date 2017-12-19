<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\helpers\RelationHelper;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "film".
 *
 * @property int $film_id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $budget
 * @property string $fees
 * @property int $premiereWorld
 * @property int $premiereRF
 * @property int $release_year
 * @property int $duration
 * @property string $poster
 * @property int $status
 * @property string $alias

 */
class Film extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE=0; // статус записи - скрыто
    const STATUS_ACTIVE=1; // статус - доступно
    const STATUS_ARCHIVED=2; // статус - в архиве

    public $genres_implode;
    public $countries_implode;
    public $actors_implode;
    public $directors_implode;
    public $writers_implode;
    public $producers_implode;
    public $operators_implode;
    public $composers_implode;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'film';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'imageUploader' => [
                'class' => '\bajadev\upload\ImageUploadBehavior',
                'attribute' => 'poster',
                'thumbs' => [
                    'thumb' => ['height' => 310, 'width' => 210, 'crop' => false, 'quality' => 80],
                ],
                //'deleteOriginalFile' => true,
                'rotateImageByExif' => true,
                'filePath' => '@webroot/images/[[pk]].[[extension]]',
                'fileUrl' => '@web/images/[[pk]].[[extension]]',
                'thumbPath' => '@webroot/images/filmsPosters/[[filename]]_[[pk]].[[extension]]',
                'thumbUrl' => '@web/images/filmsPosters/[[filename]]_[[pk]].[[extension]]',
            ],

            'manyToMany'=>[
                'class' => \voskobovich\behaviors\ManyToManyBehavior::className(),
                'relations' => [
                    'country_ids' => 'countries',
                    'genre_ids' => 'genres',

                    //Сохранение актеров
                    'actors_ids' => [
                        'actors',
                        'viaTableValues' => [
                            'personType_id' => FilmPerson::TYPE_ACTOR,
                        ],
                        'customDeleteCondition' => [
                            'personType_id' => FilmPerson::TYPE_ACTOR,
                        ],
                    ],
                    //Сохранение режиссеров
                    'directors_ids' => [
                        'directors',
                        'viaTableValues' => [
                            'personType_id' => FilmPerson::TYPE_DIRECTOR,
                        ],
                        'customDeleteCondition' => [
                            'personType_id' => FilmPerson::TYPE_DIRECTOR,
                        ],
                    ],
                    //Сохранение сценаристов
                    'writers_ids' => [
                        'writers',
                        'viaTableValues' => [
                            'personType_id' => FilmPerson::TYPE_WRITER,
                        ],
                        'customDeleteCondition' => [
                            'personType_id' => FilmPerson::TYPE_WRITER,
                        ],
                    ],
                    //Сохранение операторов
                    'operators_ids' => [
                        'operators',
                        'viaTableValues' => [
                            'personType_id' => FilmPerson::TYPE_OPERATOR,
                        ],
                        'customDeleteCondition' => [
                            'personType_id' => FilmPerson::TYPE_OPERATOR,
                        ],
                    ],
                    //Сохранение продюсеров
                    'producers_ids' => [
                        'producers',
                        'viaTableValues' => [
                            'personType_id' => FilmPerson::TYPE_PRODUCER,
                        ],
                        'customDeleteCondition' => [
                            'personType_id' => FilmPerson::TYPE_PRODUCER,
                        ],
                    ],
                    //Сохранение композиторов
                    'composers_ids' => [
                        'composers',
                        'viaTableValues' => [
                            'personType_id' => FilmPerson::TYPE_COMPOSER,
                        ],
                        'customDeleteCondition' => [
                            'personType_id' => FilmPerson::TYPE_COMPOSER,
                        ],
                    ],

                ],
            ],

            'slug' => [
                'class' => SluggableBehavior::className(),
                'slugAttribute' => 'alias',
                'attribute' => 'title',
                'immutable' => true,
                'ensureUnique' => true,
            ],


        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'content', 'status', 'alias'], 'required'],
            [['description', 'content'], 'string'],
            [['budget', 'fees'], 'number'],
            [['duration', 'status','release_year'], 'integer'],
            [['title', 'alias'], 'string', 'max' => 255],
            ['poster', 'file', 'extensions' => 'jpeg, gif, png, jpg'],
            [['genre_ids','country_ids','actors_ids','directors_ids','writers_ids','operators_ids', 'producers_ids', 'composers_ids'], 'each', 'rule' => ['integer']],
            [['premiereWorld', 'premiereRF',], 'date', 'format' => 'php:d.m.Y'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'film_id' => 'Film ID',
            'title' => 'Название',
            'budget' => 'Бюджет',
            'fees' => 'Сборы',
            'premiereWorld' => 'Премьера(Мир)',
            'premiereRF' => 'Премьера(Россия)',
            'duration' => 'Продолжительность(минут)',
            'poster' => 'Постер',
            'alias' => 'Псевдоним',
            'status' => 'Статус',
            'description' => 'Описание',
            'content' => 'Содержание',
            'release_year' => 'Год Выпуска',
            'genre_ids' => 'Жанр',
            'country_ids' => 'Страна',
            'actors_ids' => 'Актеры',
            'directors_ids' => 'Режиссеры',
            'writers_ids' => 'Сценаристы',
            'operators_ids' => 'Операторы',
            'producers_ids' => 'Продюсеры',
            'composers_ids' => 'Композиторы',

            'genres_implode'=>'Жанр',
            'countries_implode'=>'Страна',
            'actors_implode'=>'Актеры',
            'directors_implode'=>'Режиссеры',
            'writers_implode'=>'Сценаристы',
            'producers_implode'=>'Продюсеры',
            'operators_implode'=>'Операторы',
            'composers_implode'=>'Композиторы',

        ];
    }

    //==================================================================================================================
    //Связи
    //==================================================================================================================
    public function getFilmGenres()
    {
        return $this->hasMany(FilmGenre::className(), ['film_id' => 'film_id']);
    }

    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['genre_id' => 'genre_id'])->viaTable('film_genre', ['film_id' => 'film_id']);
    }

    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['country_id' => 'country_id'])->viaTable('film_country', ['film_id' => 'film_id']);
    }

    public function getFilmPeople()
    {
        return $this->hasMany(FilmPerson::className(), ['film_id' => 'film_id']);
    }

    public function getPeople()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])->viaTable('film_person', ['film_id' => 'film_id']);
    }

    public function getActors()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])
            ->viaTable('film_person', ['film_id' => 'film_id'], function ($query) {
                $query->andWhere([
                    'personType_id' => FilmPerson::TYPE_ACTOR,
                ]);
                return $query;
            });
    }

    public function getDirectors()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])
            ->viaTable('film_person', ['film_id' => 'film_id'], function ($query) {
                $query->andWhere([
                    'personType_id' => FilmPerson::TYPE_DIRECTOR,
                ]);
                return $query;
            });
    }

    public function getWriters()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])
            ->viaTable('film_person', ['film_id' => 'film_id'], function ($query) {
                $query->andWhere([
                    'personType_id' => FilmPerson::TYPE_WRITER,
                ]);
                return $query;
            });
    }

    public function getOperators()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])
            ->viaTable('film_person', ['film_id' => 'film_id'], function ($query) {
                $query->andWhere([
                    'personType_id' => FilmPerson::TYPE_OPERATOR,
                ]);
                return $query;
            });
    }

    public function getProducers()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])
            ->viaTable('film_person', ['film_id' => 'film_id'], function ($query) {
                $query->andWhere([
                    'personType_id' => FilmPerson::TYPE_PRODUCER,
                ]);
                return $query;
            });
    }

    public function getComposers()
    {
        return $this->hasMany(Person::className(), ['person_id' => 'person_id'])
            ->viaTable('film_person', ['film_id' => 'film_id'], function ($query) {
                $query->andWhere([
                    'personType_id' => FilmPerson::TYPE_COMPOSER,
                ]);
                return $query;
            });
    }

    //==================================================================================================================
    //Списки данных
    //==================================================================================================================
    public function getPeopleList() {
        return ArrayHelper::map(Person::find()
            ->orderBy('last_name')
            ->asArray()
            ->all(), 'person_id', function($model, $defaultValue) {
            return $model['first_name'].' '.$model['last_name'];
        });
    }

    public function getGenreList()
    {
        return ArrayHelper::map(Genre::find()->orderBy('genre')
            ->asArray()
            ->all(), 'genre_id', 'genre');
    }

    public function getCountryList()
    {
        return ArrayHelper::map(Country::find()->orderBy('country')
            ->asArray()
            ->all(), 'country_id', 'country');
    }

    public function getYearList()
    {
        $year = range(date("Y"),1910);
        return array_combine($year,$year);
    }

    //==================================================================================================================

    public function getGenreNames()
    {
        return RelationHelper::implode($this->genres, ['genre']);
    }

    public function getCountryNames()
    {
        return RelationHelper::implode($this->countries, ['country']);
    }

    public function getActorNames()
    {
        return RelationHelper::implode($this->actors, ['first_name','last_name']);
    }

    public function getDirectorNames()
    {
        return RelationHelper::implode($this->directors, ['first_name','last_name']);
    }

    public function getWriterNames()
    {
        return RelationHelper::implode($this->writers, ['first_name','last_name']);
    }

    public function getOperatorNames()
    {
        return RelationHelper::implode($this->operators, ['first_name','last_name']);
    }

    public function getProducerNames()
    {
        return RelationHelper::implode($this->producers, ['first_name','last_name']);
    }

    public function getComposerNames()
    {
        return RelationHelper::implode($this->composers, ['first_name','last_name']);
    }

    //==================================================================================================================
    public function getDatePremierRF()
    {
        return isset($this->premiereRF)? date('d.m.Y', $this->premiereRF) : null;
    }

    public function getDatePremierWorld()
    {
        return isset($this->premiereWorld)? date('d.m.Y', $this->premiereWorld) : null;
    }


    //==================================================================================================================
    public function beforeSave($insert)
    {
        if(!Yii::$app->request->isAjax) {
            $this->premiereRF = ($this->premiereRF == '') ? null : strtotime($this->premiereRF);
            $this->premiereWorld = ($this->premiereWorld == '') ? null : strtotime($this->premiereWorld);
        }
        if ($this->isNewRecord) {

        }
        else {

        }
        return parent::beforeSave($insert);
    }
}
