<?php
namespace App\Form\Interface; 
use App\Form\Form;
interface OutputStrategy {
   public function generateOutput(Form $data):string;
   public function setOutputType();
}
