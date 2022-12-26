<?php

namespace App;

enum Category: string
{
    case HTTP = 'http';
    case PHP = 'php';
    case UNKNOWN = 'unknown';
}
