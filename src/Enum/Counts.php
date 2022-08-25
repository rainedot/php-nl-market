<?php

namespace Rainedot\PhpNlMarket\Enum;

enum Counts: int
{
    case MONTHLY = 1;
    case QUARTERLY = 2;
    case HALF_YEARLY = 3;
    case YEARLY = 4;

}