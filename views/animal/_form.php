<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Animal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animal-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if (isset($category_id)): ?>
        <?php $model->category_id = $category_id; ?> 
        <?= $form->field($model, 'category_id')->hiddenInput()->label(false) ?>
    <?php else: ?>
         <?= $form->field($model, 'category_id')->dropDownList(
                ArrayHelper::map(Category::find()->all(), 'id', 'title'),
                [
                    'prompt' => 'Select category',
                    'class' => 'custom-select'
                ]
        ) ?>
    <?php endif; ?> 

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'breed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
