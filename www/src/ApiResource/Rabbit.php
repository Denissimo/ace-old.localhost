<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Controller\RandomRabbit;
use App\Response\Rabbit\RabbitResponse;
use App\Response\Rabbit\RabbitBadRequest;

#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/api/rabbit',
            formats: ['json'],
            routeName: 'rabbit',
            controller: RandomRabbit::class,
            exceptionToStatus: [RabbitBadRequest::class => 400],
            output: RabbitResponse::class,
            name: 'rabbit'
        )
    ]
)]
class Rabbit
{
    #[ApiProperty(
        identifier: true
    )]
    public $from;

    /** @var string */
    public $to;
}