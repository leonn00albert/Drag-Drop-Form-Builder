<?php

namespace App\Form;
use App\Form\Form;
use App\Form\Builder;

class FormBuilder implements Builder
{
    private array $form = [] ;
    public function reset()
    {
        $this->form[] = [];
    }
    public function buildText(string $name):void
    {
        $element = (object) ['type' => 'text', 'name' => $name];
        $this->form[] = $element;
    }
    public function buildNumber(string $name):void
    {
        $element = (object) ['type' => 'number', 'name' => $name];
        $this->form[] = $element;
    }
    public function buildButton(string $name):void
    {
        $element = (object) ['type' => 'button', 'name' => $name];
        $this->form[] = $element;
    }

    public function getResult(): Form
    {
        return new Form($this->form);
    }
}
