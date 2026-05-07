<?php

namespace App\Enums;

enum InformationSource: string
{
    case UserReport = 'user_report';
case Bmkg = 'bmkg';
case Officer = 'officer';
case System = 'system';
}
