<?php

namespace App\Form;

class Form
{
    public array  $elements = [];
    public function __construct($elements)
    {
        $this->elements = $elements;
    }
    public function writeJson()
    {
        file_put_contents("form" . uniqid() . '.json', json_encode($this->elements));
    }
}
