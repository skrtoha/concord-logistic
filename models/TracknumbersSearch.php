<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tracknumbers_search".
 *
 * @property string|null $Tracknumber
 * @property string|null $ClientEmail
 * @property string|null $OperationID
 */
class TracknumbersSearch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tracknumbers_search';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Tracknumber', 'ClientEmail', 'OperationID'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Tracknumber' => 'Tracknumber',
            'ClientEmail' => 'Client Email',
            'OperationID' => 'Operation ID',
        ];
    }
}
