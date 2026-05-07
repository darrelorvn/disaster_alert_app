<?php

namespace App\Enums;

enum UserRole: string
{
    case User = 'user';
case Officer = 'officer';
case Admin = 'admin';
}
