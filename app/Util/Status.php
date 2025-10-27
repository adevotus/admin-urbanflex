<?php

namespace App\Util;

class Status
{
    public const INSTOCK = 'INSTOCK';
    public const OUTSTOCK = 'OUTSTOCK';

    public const PENDING = 'PENDING';
    public const CANCELLED = 'CANCELLED';
    public const PAID = 'PAID';
    public const COMPLETED = 'COMPLETED';

    public const FAILED = 'FAILED';
    public const PROCESSING = 'PROCESSING';
    public const ACCEPTED = 'ACCEPTED';
    public const REJECTED = 'REJECTED';
    public const SUBSCRIBED = 'SUBSCRIBED';
    public const UNSUBSCRIBED = 'UNSUBSCRIBED';
    public const VERIFIED = 'VERIFIED';
    public const NOT_PAID = 'NOT PAID';
    public const  NOTIFIED = 'NOTIFIED';
    public const  NON_NOTIFIED = 'NON NOTIFIED';
    public const DRAFT = 'DRAFT';
    public const PUBLISHED = 'PUBLISHED';

    public const ACTIVE = 'ACTIVE';

    public const INACTIVE = 'INACTIVE';

    public const SUSPENDED = 'SUSPENDED';
    /**
     * Get all possible statuses.
     *
     * @return array
     */
    public static function getAllStatuses(): array
    {
        return [
            self::INSTOCK,
            self::OUTSTOCK,
            self::PENDING,
            self::CANCELLED,
            self::PAID,
            self::COMPLETED,
            self::PROCESSING,
            self::ACCEPTED,
            self::FAILED,
            self::REJECTED,
            self::SUBSCRIBED,
            self::UNSUBSCRIBED,
            self::VERIFIED,
            self::NOT_PAID,
            self::NOTIFIED,
            self::NON_NOTIFIED,
            self::DRAFT,
            self::PUBLISHED,
            self::ACTIVE,
            self::INACTIVE,
            self::SUSPENDED,

        ];
    }
}
