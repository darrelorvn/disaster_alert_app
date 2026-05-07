<?php

namespace App\Enums;

enum ReportStatus: string
{
    case Submitted = 'submitted';
case Verified = 'verified';
case InProgress = 'in_progress';
case Handled = 'handled';
case Rejected = 'rejected';
}
