<?php

namespace App\DataFixtures\Faker\Provider;

class CategoryProvider
{
    private static $categories = [
        'Халяль',
        'Кошерное',
        'Вегетарианское меню',
        'Здоровая еда',
        'Пицца',
        'Суши',
        'Бургеры',
        'Рыба',
        'Хинкали',
        'Пироги',
        'Шашлыки',
        'Плов',
        'Паста и ризотто',
        'Паназиатская',
        'Грузинская',
        'Китайская',
        'Корейская',
        'Вьетнамская',
        'Японская',
        'Индийская',
        'Русская',
        'Итальянская',
        'Обеды',
        'Завтраки',
    ];

    public static function category()
    {
        return array_shift(static::$categories);
    }
}