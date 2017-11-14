<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Posts`.
 */
class m171114_160440_create_posts_table extends Migration
{
    
    private $table = 'Posts';
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'languageId' => $this->integer()->unsigned()->notNull(),
            'authorId' => $this->integer()->unsigned()->notNull(),
            'dateCreated' => $this->integer()->notNull(),
            'title' => $this->string(512)->notNull(),
            'text' => $this->text()->notNull(),
            'likesCount' => $this->integer()->unsigned()->notNull()->defaultValue(0),
        ]);
        $this->createIndex('DateCreated'.$this->table, $this->table, ['dateCreated']);
        $this->createIndex('Title'.$this->table, $this->table, ['title']);
        $this->createIndex('LikesCount'.$this->table, $this->table, ['likesCount']);
        $this->addForeignKey('LanguageId', $this->table, ['languageId'], 'Languages', ['id'], 'CASCADE');
        $this->addForeignKey('AuthorId', $this->table, ['authorId'], 'Authors', ['id'], 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('AuthorId', $this->table);
        $this->dropForeignKey('LanguageId', $this->table);
        $this->dropIndex('LikesCount'.$this->table, $this->table);
        $this->dropIndex('Title'.$this->table, $this->table);
        $this->dropIndex('DateCreated'.$this->table, $this->table);
        $this->dropTable($this->table);
    }
}
