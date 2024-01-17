<?php

namespace App\Enums;

use App\Traits\EnumHelpers;

enum Moods: string
{
    use EnumHelpers;

    case NATURE = 'nature';
    case RELAX = 'relax';
    case HISTORY = 'history';
    case CULTURE = 'culture';
    case PARTY = 'party';
}
