<?php

namespace App\Enums;

enum Role: string
{
    case SENSEI = 'Sensei';
    case ASSISTANT = 'Assistant';
    case STUDENT = 'Elève';
    case ADMIN = "Admin";
    case PARENT = "Parent";

}
