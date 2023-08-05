<?php

namespace App\Response\Rabbit;

class RabbitResponse
{
    public string $animal = 'rabbit';

    public string $result = 'created';

    /**
     * @param string $animal
     * @param string $result
     */
    public function __construct(string $animal = 'rabbit', string $result = 'created')
    {
//        parent::__construct();
        $this->animal = $animal;
        $this->result = $result;

        $json = ['animal' => $this->animal, 'result' => $this->result];

//        $this->setJson(json_encode($json));
    }
}