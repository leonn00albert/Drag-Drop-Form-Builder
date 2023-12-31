<?php
namespace App\Form\Interface; 

interface Builder {
   public function reset();
   public function buildText(string $name):void;
   public function buildNumber(string $name):void;
   public function buildButton(string $name):void;
}