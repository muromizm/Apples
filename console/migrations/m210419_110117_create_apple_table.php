<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m210419_110117_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string()->comment('Цвет'),
            'created_at' => $this->integer()->comment('Дата появления'),
            'fall_at' => $this->integer()->comment('Дата падения'),
            'status' => $this->integer()->comment('Статус'),
            'eaten' => $this->integer()->comment('Сколько съели'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
