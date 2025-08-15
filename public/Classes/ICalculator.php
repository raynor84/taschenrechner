<?php
namespace Taschenrechner\Classes;

Interface ICalculator extends IOperationAdder
{
    public function calculate($term=0);
}

