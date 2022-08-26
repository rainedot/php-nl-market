<?php

namespace Rainedot\PhpNlMarket\Enum;

enum Counts: int
{
    case MONTHLY = 0;
    case QUARTERLY = 1;
    case HALF_YEARLY = 2;
    case YEARLY = 3;

}