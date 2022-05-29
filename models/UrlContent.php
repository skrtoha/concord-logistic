<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "income_content".
 *
 * @property string $url
 * @property string $content
 * @property string $before_content
 * @property string $after_content
 * @property int $website
 *
 */
class UrlContent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url'], 'required'],
            [['content', 'before_content', 'after_content'], 'string']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'url' => '',
            'before_content' => 'Перед контентом',
            'content' => 'Контент',
            'after_content' => 'После контента'
        ];
    }
}
