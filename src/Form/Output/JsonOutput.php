<?php

namespace App\Form\Output;

use App\Form\Interface\OutputStrategy;
use App\Form\Form;

class JsonOutput implements OutputStrategy
{
    public function generateOutput(Form $data):string
    {
        return json_encode($data->elements);
    }
    public function setOutputType()
    {
        header('Content-Type: application/json');
    }
}
