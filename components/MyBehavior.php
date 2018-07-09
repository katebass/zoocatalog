<?php

namespace app\components;

use yii\base\Behavior;

class MyBehavior extends Behavior
{

	public $property1 = 'свойство из поведения';

	public function foo(){
		echo 'Hello!';
	}
}