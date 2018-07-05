<?php

/* @var $this yii\web\View */

$this->registerCssFile("css/content.css");
$this->title = 'Zoo Catalog';
use yii\helpers\Html;

?>

<div class="jumbotron">
    <h1>Welcome to our zoo catalog!</h1>

    <p class="lead">Here you can be aquinted with our animals and read some information about them</p>
</div>

<div class="content-main">
    <div class="row">
        <div class="col-lg-3 categories-list">
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li><?= Html::a($category->title, ['category/view-animals', 'id' => $category->id], ['class' => 'btn btn-default']) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col-lg-9">
            <h3>Hello! Take a look at wonderful animals in our zoo. Here are a lot of cool info. Choose a category you are interested in.</h3>
        </div>
    </div>
</div>