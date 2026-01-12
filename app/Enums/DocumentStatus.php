<?php

namespace App\Enums;

enum DocumentStatus: string
{
    case DRAFT = 'draft';
    case VALIDATED = 'validated';
    case PAID = 'paid';
    case ARCHIVED = 'archived';
}
