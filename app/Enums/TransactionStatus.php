<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case UNPAID = 'Non payé';
    case PAID = 'Soldé';

}
