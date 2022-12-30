<?php

namespace App;

enum Category: string
{
    case HTTP = 'http';
    case PHP = 'php';
    case CONTAINER = 'container';
    case EVENT_DISPATCHER = 'event_dispatcher';
    case UNKNOWN = 'unknown';
}
