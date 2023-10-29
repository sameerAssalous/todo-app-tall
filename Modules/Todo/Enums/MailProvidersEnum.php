<?php

namespace Module\Todo\Enums;

enum MailProvidersEnum: int
{
    case SENDGRID = 1;
    case SES = 2;

    public static function providerSlug($providerId): string
    {
        return match($providerId)
        {
            self::SENDGRID => 'sendgrid',
            self::SES => 'ses',
            default => 'sendgrid',
        };
    }
}
