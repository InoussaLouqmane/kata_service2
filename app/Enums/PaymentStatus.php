<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case ONGOING = 'En cours';
    case COMPLETED = 'Terminé';

}
