<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use bajadev\ckeditor\CKEditor;
use kartik\select2\Select2;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\slider\Slider;
use kartik\widgets\FileInput;
use app\helpers\StatusHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Film */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="film-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'poster')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [

            'initialPreview'=>Html::img($model->getThumbFileUrl('poster', 'thumb'), ['height' => '207']),
            'overwriteInitial' => true,
            'showUpload'=>false,
            //'showRemove' => true,
            'showCaption' => false,
            'showRemove' => false,
            'browseClass' => 'btn btn-primary',
        ],

    ]); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'content')->widget(CKEditor::className(), [
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
            'filebrowserBrowseUrl' => 'browse-images',
            'filebrowserUploadUrl' => 'upload-images',
            'extraPlugins' => 'imageuploader',
        ],
    ]); ?>

    <?= $form->field($model, 'release_year')->widget(Select2::classname(), [
        'data'=>$model->yearList,
        'options' => [
            'placeholder' => 'Выберите Год ...',
        ],
    ]); ?>

    <?= $form->field($model, 'genre_ids')->widget(Select2::classname(), [
        'data'=>$model->genreList,
        'options' => [
            'placeholder' => 'Выберите Жанр ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'country_ids')->widget(Select2::classname(), [
        'data'=>$model->countryList,
        'options' => [
            'placeholder' => 'Выберите Страну ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'actors_ids')->widget(Select2::classname(), [
        'data'=>$model->peopleList,
        'options' => [
            'placeholder' => 'Выберите Актера ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'directors_ids')->widget(Select2::classname(), [
        'data'=>$model->peopleList,
        'options' => [
            'placeholder' => 'Выберите Режиссера ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'writers_ids')->widget(Select2::classname(), [
        'data'=>$model->peopleList,
        'options' => [
            'placeholder' => 'Выберите Сценариста ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'operators_ids')->widget(Select2::classname(), [
        'data'=>$model->peopleList,
        'options' => [
            'placeholder' => 'Выберите Оператора ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'producers_ids')->widget(Select2::classname(), [
        'data'=>$model->peopleList,
        'options' => [
            'placeholder' => 'Выберите Продюсера ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'composers_ids')->widget(Select2::classname(), [
        'data'=>$model->peopleList,
        'options' => [
            'placeholder' => 'Выберите Композитора ...',
            'multiple' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'budget')->widget(MaskMoney::classname(), [
        'options'=> [
            //'affixesStay' => true,
        ],
        'pluginOptions' => [
            'prefix' => '$ ',
            'precision' => 0,
        ]
    ]);?>

    <?= $form->field($model, 'fees')->widget(MaskMoney::classname(), [
        'options'=> [

        ],
        'pluginOptions' => [
            'prefix' => '$ ',
            'precision' => 0,
        ]
    ]);?>

    <?= $form->field($model, 'premiereWorld')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Введите дату ...',
            'value' => $model->getDatePremierWorld()
        ],
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]);?>

    <?= $form->field($model, 'premiereRF')->widget(DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Введите дату ...',
            'value' => $model->getDatePremierRF()
        ],
        'pluginOptions' => [
            'autoclose'=>true
        ]
    ]);?>


    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList(StatusHelper::getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
