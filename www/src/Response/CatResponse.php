<?php

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class CatResponse
{
    public string $animal = 'cat';

    public string $result = 'created';

    /**
     * @param string $animal
     * @param string $result
     */
    public function __construct(string $animal = 'cat', string $result = 'created')
    {
//        parent::__construct();
        $this->animal = $animal;
        $this->result = $result;

        $json = ['animal' => $this->animal, 'result' => $this->result];

//        $this->setJson(json_encode($json));
    }
}