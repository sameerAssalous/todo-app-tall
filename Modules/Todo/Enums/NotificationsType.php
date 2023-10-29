<?php

namespace Module\Todo\Enums;

enum NotificationsType: string
{
    case CREATED = 'created';
    case COMPLETED = 'completed';
    case REMOVED = 'removed';
}
