<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "weights".
 *
 * @property int $id
 * @property string|null $f1
 * @property string|null $f2
 * @property string|null $f4
 * @property string|null $f13
 * @property int|null $active
 */
class Weights extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'weights';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['f1', 'f2', 'f4', 'f13'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'f1' => 'F1',
            'f2' => 'F2',
            'f4' => 'F4',
            'f13' => 'F13',
            'active' => 'Active',
        ];
    }
}
