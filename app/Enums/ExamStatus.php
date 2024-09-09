<?php

namespace App\Enums;

enum ExamStatus: string
{
    case INITIATED = 'A venir';

    case POSTPONED = 'Postponed';
    case PENDING = 'En cours';

    case ENDED= 'Terminé';
    case CANCELLED= 'Annulé';
    case ARCHIEVED= 'Archivé';



}
