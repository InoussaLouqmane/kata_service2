<?php

namespace App\Enums;

enum ExamStatus: string
{
    case INITIATED = 'Initié';

    case POSTPONED = 'Postponed';
    case PENDING = 'En cours';

    case ENDED= "Terminé";



}
