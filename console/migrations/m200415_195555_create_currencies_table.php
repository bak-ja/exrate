<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currencies}}`.
 */
class m200415_195555_create_currencies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey()->comment('первичный ключ'),
            'name' => $this->char(3)->notNull()->comment('код валюты'),
            'rate' => $this->decimal(10,6)->notNull()->comment('курс валюты к тенге'),
            'date' => $this->date()->notNull()->defaultValue('0000-00-00')->comment('дата получения курса'),
            'created_at' => $this->dateTime()->notNull()->comment('дата создания'),
            'updated_at' => $this->dateTime()->notNull()->comment('дата редактированя')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currencies}}');
    }
}
