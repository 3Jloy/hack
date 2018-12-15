<?php

namespace App\DataFixtures\Faker\Provider;

class CourseProvider
{
    private static $courses = [
        'Fundamentals',
        'Advanced',
    ];

    public static function courseName()
    {
        return array_shift(static::$courses);
    }
}