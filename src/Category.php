<?php

namespace App;

enum Category: string
{
    case HTTP = 'http';
    case PHP = 'php';
    case Container = 'container';
    case EventDispatcher = 'event_dispatcher';
    case Unknown = 'unknown';
}
