<?php

namespace App\Enums;

enum TransferStatus: string
{
    case APPROVED = 'Approuvé';
    case REJECTED = 'Rejeté';
    case PENDING = "En attente de validation";

}
