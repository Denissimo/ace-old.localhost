<?php

namespace App\ApiResource\Custom;

use ApiPlatform\Metadata\Post;
use App\Response\Custom\CustomResponse;
use App\Request\Custom\CustomRequest;

#[Post(
    uriTemplate: '/custom_post',
    input: CustomRequest::class,
    output: CustomResponse::class
)]
class CustomPost
{

}