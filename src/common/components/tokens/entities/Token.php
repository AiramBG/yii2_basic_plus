<?php

namespace app\src\common\components\tokens\entities;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Token extends ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tokens}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['code', 'string', 'min' => 3, 'max' => 255],
            ['type', 'string', 'min' => 3, 'max' => 50],
            ['behavior', 'string', 'min' => 3, 'max' => 50],
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
