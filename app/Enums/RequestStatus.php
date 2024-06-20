<?php

namespace App\Enums;

enum RequestStatus: string
{
    case APPROVED = 'Approuvé';
    case REJECTED = 'Rejeté';
    case PENDING = "En attente de validation";

}
