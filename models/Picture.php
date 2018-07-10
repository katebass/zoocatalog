<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "picture".
 *
 * @property int $id
 * @property int $animal_id
 * @property string $path
 * @property string $description
 *
 * @property Animal $animal
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id'], 'required'],
            [['animal_id'], 'integer'],
            [['path'], 'string', 'max' => 191],
            [['description'], 'string', 'max' => 45],
            [['animal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Animal::className(), 'targetAttribute' => ['animal_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'animal_id' => 'Animal ID',
            'path' => 'Path',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnimal()
    {
        return $this->hasOne(Animal::className(), ['id' => 'animal_id']);
    }
}
