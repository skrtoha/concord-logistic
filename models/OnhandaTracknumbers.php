<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "onhanda_tracknumbers".
 *
 * @property int $OperationID
 * @property int $SortingNum
 * @property string $TrackNumber
 */
class OnhandaTracknumbers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'onhanda_tracknumbers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['OperationID', 'SortingNum', 'TrackNumber'], 'required'],
            [['OperationID', 'SortingNum'], 'integer'],
            [['TrackNumber'], 'string', 'max' => 100],
            [['OperationID', 'SortingNum'], 'unique', 'targetAttribute' => ['OperationID', 'SortingNum']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'OperationID' => 'Operation ID',
            'SortingNum' => 'Sorting Num',
            'TrackNumber' => 'Track Number',
        ];
    }
}
