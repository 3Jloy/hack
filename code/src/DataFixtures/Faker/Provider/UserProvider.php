<?php

namespace App\DataFixtures\Faker\Provider;

class UserProvider
{
    private static $mentors = [
        [
            'name' => 'Alexander',
            'surname' => 'Blinov',
            'job' => 'Head of Android Department',
            'photo' => 'img/blinov.png',
        ],
        [
            'name' => 'Eugene',
            'surname' => 'Matsyuk',
            'job' => 'Development Team Lead KasperskyLAB',
            'photo' => 'img/matcuk.png',
        ],
        [
            'name' => 'Alexey',
            'surname' => 'Bykov',
            'job' => 'Android Developer KasperskyLAB',
            'photo' => 'img/bykov.png',
        ],
        [
            'name' => 'Sergey',
            'surname' => 'Ryabov',
            'job' => 'Senior Android Developer Unknown',
            'photo' => 'img/ryabov.png',
        ],
        [
            'name' => 'Nikita',
            'surname' => 'Kulikov',
            'job' => 'Android Dev @ Yandex.Browser',
            'photo' => 'img/kulikov.png',
        ],
        [
            'name' => 'Alyona',
            'surname' => 'Manyuhina',
            'job' => 'Android Dev @ Auto.ru',
            'photo' => 'img/manuhina.png',
        ],
        [
            'name' => 'Tamara',
            'surname' => 'Sineva',
            'job' => 'Android Dev @ Yandex.Browser',
            'photo' => 'img/sineva.png',
        ],
        [
            'name' => 'Alexander',
            'surname' => 'Pronin',
            'job' => 'Senior Android Dev @ KasperskyLAB',
            'photo' => 'img/pronin.png',
        ],
        [
            'name' => 'Sergey',
            'surname' => 'Garbar',
            'job' => 'Senior Android Dev @ Golamago',
            'photo' => 'img/gabar.png',
        ],
        [
            'name' => 'Dmitry',
            'surname' => 'Gryazin',
            'job' => 'Senior Android Dev @ Avito',
            'photo' => 'img/grazin.png',
        ],
        [
            'name' => 'Dmitriy',
            'surname' => 'Movchan',
            'job' => 'Android Dev @ KasperskyLAB',
            'photo' => 'img/movchan.png',
        ],
        [
            'name' => 'Pavel',
            'surname' => 'Strelchenko',
            'job' => 'Android Dev @ HeadHunter',
            'photo' => 'img/strelchenko.png',
        ],
        [
            'name' => 'Anton',
            'surname' => 'Miroshnichenko',
            'job' => 'Android Dev @ HeadHunter',
            'photo' => 'img/miroshnichenco.png',
        ],
        [
            'name' => 'Vladimir',
            'surname' => 'Demyshev',
            'job' => 'Senior Android Dev @ HeadHunter',
            'photo' => 'img/deimeshin.png',
        ]
];

    public static function mentorName($item)
    {
        return static::$mentors[$item]['name'];
    }

    public static function mentorSurname($item)
    {
        return static::$mentors[$item]['surname'];
    }

    public static function mentorJob($item)
    {
        return static::$mentors[$item]['job'];
    }

    public static function mentorPhoto($item)
    {
        return static::$mentors[$item]['photo'];
    }
}