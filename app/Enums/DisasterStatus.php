<?php

namespace App\Enums;

enum DisasterStatus: string
{
    case Safe = 'safe';
case Watch = 'watch';
case Alert = 'alert';
case Emergency = 'emergency';
case Resolved = 'resolved';
}
