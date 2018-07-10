<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Animal */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-view">

    <h1><?= Html::encode($this->title."'s gallery") ?></h1>

<!--     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'label' => 'category',
                'value' => $model->category->title
            ],
            'name',
            'breed',
            'age',
            //'photo',
        ],
    ]) ?> -->

    <?= Html::img('@web/'.$model->photo, ['alt' => 'There is no photo', 'class' => "animal-view-photo"]) ?>
    <br>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur aut exercitationem quia cupiditate illum id natus rerum odio reiciendis totam vel voluptatibus officiis laborum, consequatur fuga non necessitatibus minima laboriosam expedita eum dolorem unde perspiciatis? Expedita adipisci quas, incidunt necessitatibus culpa, harum neque enim fugiat, eius nemo ducimus aliquid totam!</p>

    <div class="gallery-container">

        <?php foreach ($pictures as $picture): ?>
            <div class="gallery-item">
                <?= Html::img('@web/'.$model->photo, ['alt' => 'There is no photo', 'class' => "animal-view-photo"]) ?>
                <?= Html::encode($picture->description) ?>
            </div>
        <?php endforeach; ?>

    </div>
</div>
