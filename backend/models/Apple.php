<?php

namespace backend\models;

use yii\base\UserException;
use yii\db\ActiveRecord;
use yii\db\StaleObjectException;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string|null $color Цвет
 * @property int|null $created_at Дата появления
 * @property int|null $fall_at Дата падения
 * @property int|null $status Статус
 * @property int|null $eaten Сколько съели
 */
class Apple extends ActiveRecord
{
    /**
     * Статусы яблока.
     */
    const STATUS_ON_TREE = 1;
    const STATUS_FALL = 2;

    const STATUSES = [
        self::STATUS_ON_TREE => 'На дереве',
        self::STATUS_FALL => 'Упало',
    ];

    /**
     * Цвета по умолчанию.
     */
    const COLORS = [
        'green', 'yellow', 'red',
    ];

    /**
     * Время гниения.
     */
    const ROTTEN_TIME = 18000;

    /**
     * Apple constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        // Задаёт цвет яблоку при создании, если не указан, выбирает случайным образом
        $color = is_string($config)
            ? $config
            : array_rand(array_flip(self::COLORS));

        // Случайное время создания (в пределах одного года)
        $createdAt = rand(time() - 31536000, time());

        $config = [
            'color' => $color,
            'created_at' => $createdAt,
        ];

        parent::__construct($config);
    }


    /**
     * Магические геттеры.
     * @param string $name
     * @return float|int|mixed|null
     */
    public function __get($name) {
        switch ($name) {
            case 'size':
                return (100 - $this->eaten) / 100;
        }

        return parent::__get($name);
    }

    /**
     * Упало ли яблоко.
     * @return bool
     */
    private function isFall(): bool
    {
        return $this->status === self::STATUS_FALL;
    }

    /**
     * Гнилое ли яблоко.
     * @return bool
     */
    private function isRotten(): bool
    {
        return $this->isFall() && ($this->fall_at > time() + self::ROTTEN_TIME);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['color'], 'string'],
            [['created_at', 'fall_at', 'status', 'eaten'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
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

    /**
     * Откусывает от яблока.
     * @param int|null $percent
     * @return bool
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function eat(int $percent = null): bool
    {
        if (! $this->isFall()) {
            throw new UserException('Съесть нельзя, яблоко на дереве.');
        }

        if ($this->isRotten()) {
            throw new UserException('Съесть нельзя, яблоко гнилое.');
        }

        $this->eaten += $percent;

        // Удаляет если всё яблоко съели
        if ($this->eaten >= 100) {
            $this->remove();
        }

        return true;
    }

    /**
     * Роняет яблоко на землю.
     */
    public function fallToGround()
    {
        if ($this->isFall()) {
            return;
        }

        $this->status = self::STATUS_FALL;
        $this->fall_at = time();
    }

    /**
     * Удаляет яблоко.
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function remove()
    {
        $this->delete();
    }
}
