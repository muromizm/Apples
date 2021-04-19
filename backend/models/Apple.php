<?php

namespace backend\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property int|null $color Цвет
 * @property int|null $created_at Дата появления
 * @property int|null $fall_at Дата падения
 * @property int|null $status Статус
 * @property int|null $eaten Сколько съели
 */
class Apple extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color'], 'string'],
            [['created_at', 'fall_at', 'status', 'eaten'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'created_at' => 'Дата появления',
            'fall_at' => 'Дата падения',
            'status' => 'Статус',
            'eaten' => 'Сколько съели',
        ];
    }
}
