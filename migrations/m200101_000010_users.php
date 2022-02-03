<?php

use yii\db\Migration;

/**
 * Class m200101_000001_users
 * This migration enables the users module
 */
class m200101_000010_users extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'avatar' => $this->string(),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->insert('{{%users}}', [
            'name' => 'Admin',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'email' => Yii::$app->params['adminEmail'],
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
    }
}
