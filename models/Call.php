<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "call".
 *
 * @property int $id
 * @property string $company_phone_number
 * @property string $created_date
 * @property string $violation_date
 * @property string $consumer_city
 * @property string $consumer_state
 * @property string $subject
 * @property int $recorded_message_or_robocall
 */
class Call extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'call';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_date', 'violation_date'], 'safe'],
            [['recorded_message_or_robocall'], 'integer'],
            [['company_phone_number'], 'string', 'max' => 15],
            [['consumer_city', 'consumer_state'], 'string', 'max' => 45],
            [['subject'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_phone_number' => 'Company Phone Number',
            'created_date' => 'Created Date',
            'violation_date' => 'Violation Date',
            'consumer_city' => 'Consumer City',
            'consumer_state' => 'Consumer State',
            'subject' => 'Subject',
            'recorded_message_or_robocall' => 'Recorded Message Or Robocall',
        ];
    }
}
