<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "person".
 *
 * @property int $person_id
 * @property string $first_name
 * @property string $last_name
 * @property int $gender
 * @property int $birth
 * @property int $city_id
 * @property string $photo
 * @property string $alias
 * @property int $status
 *
 * @property City $city
 */
class Person extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE=0; // статус записи - скрыто
    const STATUS_ACTIVE=1; // статус - доступно
    const STATUS_ARCHIVED=2; // статус - в архиве

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'imageUploader' => [
                'class' => '\bajadev\upload\ImageUploadBehavior',
                'attribute' => 'photo',
                'thumbs' => [
                    'thumb' => ['height' => 310, 'width' => 210, 'crop' => false, 'quality' => 80],
                ],
                //'deleteOriginalFile' => true,
                'rotateImageByExif' => true,
                'filePath' => '@webroot/images/[[pk]].[[extension]]',
                'fileUrl' => '@web/images/[[pk]].[[extension]]',
                'thumbPath' => '@webroot/images/personPhotos/[[filename]]_[[pk]].[[extension]]',
                'thumbUrl' => '@web/images/personPhotos/[[filename]]_[[pk]].[[extension]]',
            ],

            'slug' => [
                'class' => SluggableBehavior::className(),
                'slugAttribute' => 'alias',
                'attribute' => 'first_name',
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
            //[['gender', 'birth', 'city_id', 'status'], 'default', 'value' => null],
            [['first_name', 'last_name', 'gender', 'status','city_id', 'birth'], 'required'],
            [['gender', 'status', 'city_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 300],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'city_id']],
            ['photo', 'file', 'extensions' => 'jpeg, gif, png, jpg'],
            [['birth'], 'date', 'format' => 'php:d.m.Y'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'gender' => 'Пол',
            'birth' => 'Дата Рождения',
            'photo' => 'Фото',
            'alias' => 'Псевдоним',
            'status' => 'Статус',
            'city_id'=> 'Город',
        ];
    }

    //==================================================================================================================
    public function getFilmPeople()
    {
        return $this->hasMany(FilmPerson::className(), ['person_id' => 'person_id']);
    }

    public function getCity()
    {
        return $this->hasOne(City::className(), ['city_id' => 'city_id']);
    }
    //==================================================================================================================
    //==================================================================================================================
    public function getCityList()
    {
        return ArrayHelper::map(City::find()->orderBy('city')
            ->asArray()
            ->all(), 'city_id', 'city');
    }

    public function getDateBirth()
    {
        return isset($this->birth)? date('d.m.Y', $this->birth) : null;
    }

    public function getStatusList()
    {
        return [
            self::STATUS_INACTIVE => 'Скрыто',
            self::STATUS_ACTIVE => 'Доступно',
            self::STATUS_ARCHIVED => 'Архив',
        ];
    }

    public function getGenderList()
    {
        return [
            self::GENDER_MALE => 'Мужской',
            self::GENDER_FEMALE => 'Женский',
        ];
    }

    public function getGenderType($genderType)
    {
        return ($genderType == self::GENDER_MALE) ? 'Мужской' : 'Женский' ;
    }

    public function getLabelsStatusList()
    {
        return [
            self::STATUS_INACTIVE => '<span class="label label-danger">Скрыто</span>',
            self::STATUS_ACTIVE => '<span class="label label-success">Доступно</span>',
            self::STATUS_ARCHIVED => '<span class="label label-warning">Архив</span>',
        ];
    }
    //==================================================================================================================

    public function beforeSave($insert)
    {
        $request = Yii::$app->request;

        if ($this->isNewRecord)
        {

        }
        else { //если запись не новая(обновляется)

        }

        if(!$request->isAjax)
        {
            $this->birth = ($this->birth == '') ? null : strtotime($this->birth);
        }
        return parent::beforeSave($insert);
    }

}
