<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Posts".
 *
 * @property integer $id
 * @property integer $languageId
 * @property integer $authorId
 * @property integer $dateCreated
 * @property string $title
 * @property string $text
 * @property integer $likesCount
 *
 * @property Author $author
 * @property Language $language
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['languageId', 'authorId', 'dateCreated', 'title', 'text'], 'required'],
            [['languageId', 'authorId', 'dateCreated', 'likesCount'], 'integer'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 512],
            [['authorId'], 'exist', 'skipOnError' => false, 'targetClass' => Author::className(), 'targetAttribute' => ['authorId' => 'id']],
            [['languageId'], 'exist', 'skipOnError' => false, 'targetClass' => Language::className(), 'targetAttribute' => ['languageId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'languageId' => 'Language ID',
            'authorId' => 'Author ID',
            'dateCreated' => 'Date Created',
            'title' => 'Title',
            'text' => 'Text',
            'likesCount' => 'Likes Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'authorId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['id' => 'languageId']);
    }
}
