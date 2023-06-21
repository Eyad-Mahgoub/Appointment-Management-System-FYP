<?php

namespace App\Enums;

enum AppointmentStatusEnum:string {
    case PENDING        = 'pending';
    case COMPLETE       = 'complete';
    case CANCELLED      = 'cancelled';
    case DIDNOTATTEND   = 'Did Not Attend';
    case ONGOING        = 'On Going';
}
