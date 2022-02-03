<?php

use yii\db\Migration;

/**
 * Class m200101_000004_internationalization
 * This migration allows:
 *  - translation sheets in DB
 *  - list of supported languages
 *  - routing html translations
 */
class m200101_000040_internationalization extends Migration
{
    protected $localesTableName = 'i18n_locales';
    protected $routesTableName = 'i18n_routes';
    protected $supportedLanguagesTableName = 'i18n_languages';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%'.$this->supportedLanguagesTableName.'}}', [
            'langcode' => $this->string(7)->unique()->notNull(),
            'localname' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'PRIMARY KEY(langcode)'
        ], $tableOptions);


        //Translation table
        $this->createTable('{{%'.$this->localesTableName.'}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'key' => $this->string()->notNull(),
            'langcode' => $this->string()->notNull(),
            'translation' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex(
            'idx-'.$this->localesTableName.'-key-langcode',
            '{{%'.$this->localesTableName.'}}',
            ['key', 'langcode'],
            true
        );

        $this->addForeignKey(
            'fk-'.$this->localesTableName.'-langcode',
            '{{%'.$this->localesTableName.'}}',
            'langcode',
            '{{%'.$this->supportedLanguagesTableName.'}}',
            'langcode',
            'CASCADE'
        );


        //Routing translation table
        $this->createTable('{{%'.$this->routesTableName.'}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'key' => $this->string()->unique()->notNull(),
            'langcode' => $this->string()->notNull(),
            'translation' => $this->text()->notNull(),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex(
            'idx-'.$this->routesTableName.'-key-langcode',
            '{{%'.$this->routesTableName.'}}',
            ['key', 'langcode'],
            true
        );

        $this->addForeignKey(
            'fk-'.$this->routesTableName.'-langcode',
            '{{%'.$this->routesTableName.'}}',
            'langcode',
            '{{%'.$this->supportedLanguagesTableName.'}}',
            'langcode',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-'.$this->routesTableName.'-langcode', '{{%'.$this->routesTableName.'}}');
        $this->dropForeignKey('fk-'.$this->localesTableName.'-langcode', '{{%'.$this->localesTableName.'}}');
        $this->dropIndex('idx-'.$this->routesTableName.'-key-langcode', '{{%'.$this->routesTableName.'}}');
        $this->dropIndex('idx-'.$this->localesTableName.'-key-langcode', '{{%'.$this->localesTableName.'}}');
        $this->dropTable('{{%'.$this->routesTableName.'}}');
        $this->dropTable('{{%'.$this->localesTableName.'}}');
        $this->dropTable('{{%'.$this->supportedLanguagesTableName.'}}');
    }
}
