<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case ESPECE = 'Espèce';
    case KKIAPAY = 'KKiaPay';
    case FedaPay = 'FedaPay';

}
