<?php

namespace Rainedot\PhpNlMarket\Enums;

enum Count: int
{
    case MONTHLY = 0;
    case QUARTERLY = 1;
    case HALF_YEARLY = 2;
    case YEARLY = 3;

}