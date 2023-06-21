<?php

namespace App\Enums;

enum UserRoleEnum:int {
    case DOCTOR        = 0;
    case PATIENT       = 1;
    case PHARMACIST    = 2;
    case RECEPTIONIST  = 3;
}
