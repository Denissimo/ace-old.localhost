<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\ApiResource;
use App\Controller\RandomRabbit;

//#[ApiResource(
//    operations: [
//        new Get(
//            uriTemplate: '/api/rabbit',
//            routeName: 'rabbit',
//            controller: RandomRabbit::class,
//            name: 'rabbit')
//    ]
//)]
class Rabbit
{
    #[ApiProperty(
        identifier: true
    )]
    public $from;

    /** @var string */
    public $to;
}