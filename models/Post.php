<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\components\MyBehavior;


class Post extends Model
{
   public $name = 'modelll';

   public function behaviors()
   {

    return [
        [
            'class' => MyBehavior::className()
        ]
    ];

   } 
}
