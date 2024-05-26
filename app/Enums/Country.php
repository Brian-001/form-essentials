<?php

namespace App\Enums;

enum Country: string
{
    case Kenya = 'KE';
    case United_States = 'US';
    case Uganda = 'UG';
    case Canada = 'CA';
    case Brazil = 'BR';
    case Germany = 'GE';
    case Argentina = 'AR';
    case France = 'FR';
    case Italy = 'IT';
    case United_Kingdom = 'GB';


    public function label()
    {
        return (string) str($this->name)->replace('_', ' ');
    }
}
