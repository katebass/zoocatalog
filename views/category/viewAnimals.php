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
                <?php foreach ($categories as $cat): ?>
                    <li><?= Html::a($cat->title, ['category/view-animals', 'id' => $cat->id], ['class' => 'btn btn-default']) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    <div class="col-lg-9">

        <h2 class="category-title"><?= Html::encode($category->title) ?></h2>
        <p><?= Html::encode($category->description) ?></p>
        
        <?php if($animals): ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Age</th>
                </tr>
                
                    <?php foreach ($animals as $animal): ?>
                        <tr>
                            <td>
                                <?= Html::a($animal->name, ['animal/view', 'id' => $animal->id]) ?>
                            </td>

                            <td>
                                <?= Html::encode($animal->breed) ?>
                            </td>

                            <td>
                                <?= Html::encode($animal->age) ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>

            </table>
        <?php else: ?>
            <h2>Sorry, there are no animals yet...</h2>
        <?php endif; ?>
    </div>
    </div>
</div>



