<?php

namespace App\Enums;

enum PaymentStatus: string
{
    case CANCELLED = 'Annulé';
    case PENDING = 'En attente';
    case VALIDATE = 'Payé';

}
