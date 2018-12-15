<?php

namespace App\DataFixtures\Faker\Provider;

use App\Entity\Location;
use App\Entity\Wifi;

class EventProvider
{
    private static $events = [
        [
            'number' => 0,
            'title' =>' Intro',
            'location'=> 'avito'
        ],
        [
            'number' => 1,
            'title' => 'Hello World',
            'location'=> 'avito'
        ],
        [
            'number' => 2,
            'title' => 'Views',
            'location'=> 'avito'
        ],
        [
            'number' => 3,
            'title' => 'Lists and Adapters',
            'location'=> 'avito'
        ],
        [
            'number' => 4,
            'title' => 'Threads',
            'location'=> 'avito'
        ],
        [
            'number' => 5,
            'title' => 'Networking',
            'location'=> 'superjob'
        ],
        [
            'number' => 6,
            'title' => 'Persistency',
            'location'=> 'superjob'
        ],
        [
            'number' => 7,
            'title' => 'Fragments',
            'location'=> 'superjob'
        ],
        [
            'number' => 8,
            'title' => 'Background Work',
            'location'=> 'superjob'
        ],
        [
            'number' => 9,
            'title' => 'Architecture',
            'location'=> 'superjob'
        ],
        [
            'number' => 10,
            'title' => 'Missing parts',
            'location'=> 'superjob'
        ],
        [
            'number' => 11,
            'title' => 'Hackathon',
            'location'=> 'avito'
        ],
    ];

    /**
     * @param int $index
     * @return static
     */
    public static function getEventName($index)
    {
        return static::$events[$index]['title'];
    }

    public static function getLocation($index)
    {
        $locations = [
            'avito' => new Location(
                'Avito',
                '55.778669',
                '37.587964',
                'Продавайся',
                new Wifi('AvitoGuest', 'androidhackaton', 'androidacademy')
            ),
            'superjob' => new Location(
                'SuperJob',
                '55.771943',
                '37.605188',
                'Нанимайся',
                new Wifi('SuperJobGuest', 'androidhackaton', 'androidacademy')
            ),
        ];

        $currentLocation = static::$events[$index]['location'];
        return $locations[$currentLocation];
    }

    public static function getNumber($index)
    {
        return (int)$index;
    }

    public static function getStartDate($index)
    {
        return new \DateTime();
        //return new \DateTime('2018-' . $index + 1 . '-01');
    }

    public static function getEndDate($index)
    {
        return new \DateTime('2018-' . $index + 2 . '-01');
    }
}