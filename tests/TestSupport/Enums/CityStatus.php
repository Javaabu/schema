<?php

namespace Javaabu\Schema\Tests\TestSupport\Enums;

enum CityStatus: string
{
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
