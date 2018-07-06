<?php

use yii\db\Migration;

/**
 * Handles the creation of table `animal`.
 */
class m180706_090605_create_animal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('animal', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notnull(),
            'name' => $this->string(40)->notNull(),
            'breed' => $this->string()->notNull(),
            'age' => $this->integer(),
            'photo' => $this->string()
        ]);

        $this->createIndex(
            'idx-animal-category_id',
            'animal',
            'category_id'
        );

        $this->addForeignKey(
            'fk-animal-category_id',
            'animal',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-animal-category_id',
            'animal'
        );

        $this->dropIndex(
            'idx-animal-category_id',
            'animal'
        );

        $this->dropTable('animal');
    }
}
