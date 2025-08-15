<?php
namespace Taschenrechner\Classes;
use Taschenrechner\Classes\Operationen\Operation;
interface IOperationAdder
{
    public function addOperation(int $reversepriority, Operation $operation);
}

