<?php

use yii\helpers\Html;
use app\models\Category;


/* @var $this yii\web\View */
/* @var $model app\models\Animal */

$this->title = 'Create Animal';
$this->params['breadcrumbs'][] = ['label' => 'Animals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="animal-create">

	<?php if($category_id): ?>

		<h1><?= Html::encode($this->title) ?> by the category "<b><?= Html::encode(strtolower(Category::find()->where(['id' => $category_id])->one()->title)); ?></b>"</h1>

    <?php else: ?>

    	<h1><?= Html::encode($this->title) ?></h1>
    	
    <?php endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
        'category_id' => $category_id,
    ]) ?>

</div>
