<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apiBlockedTokens".
 *
 * @property int $id
 * @property int|null $blockType 1- Minute, 2 - Hour, 3 - Incorrect token
 * @property string $token
 * @property string $creationDate
 * @property string|null $ip
 * @property int|null $active
 */
class ApiBlockedTokens extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apiBlockedTokens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blockType', 'active'], 'integer'],
            [['token', 'creationDate'], 'required'],
            [['token'], 'string', 'max' => 50],
            [['creationDate','ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blockType' => 'Block Type',
            'token' => 'Token',
            'creationDate' => 'Creation Date',
            'ip' => 'ip',
            'active' => 'Active',
        ];
    }
}
