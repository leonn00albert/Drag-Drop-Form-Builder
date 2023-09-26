<?php

namespace App\Form;

use App\Form\Interface\OutputStrategy;

class OutputContext
{
    private $outputStrategy;

    public function setOutputStrategy(OutputStrategy $strategy)
    {
        $this->outputStrategy = $strategy;
    }

    public function generateOutput(Form $data)
    {
        return $this->outputStrategy->generateOutput($data);
    }

    public function setOutputType()
    {
        return $this->outputStrategy->setOutputType();
    }
}
