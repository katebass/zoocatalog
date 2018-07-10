<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "animal".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $breed
 * @property int $age
 * @property string $photo
 *
 * @property Category $category
 * @property Picture[] $pictures
 */
class Animal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;

    public static function tableName()
    {
        return 'animal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'breed'], 'required'],
            [['category_id', 'age'], 'integer'],
            [['name', 'breed'], 'string', 'max' => 45],
            [['photo'], 'string', 'max' => 191],
            [['file'], 'file'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category',
            'name' => 'Name',
            'breed' => 'Breed',
            'age' => 'Age',
            'photo' => 'Animal photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['animal_id' => 'id']);
    }
}
