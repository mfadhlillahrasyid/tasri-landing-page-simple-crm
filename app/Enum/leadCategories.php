<?php

class LeadCategories
{
    public const COLD = 'cold';
    public const WARM = 'warm';
    public const HOT = 'hot';
    public const VISIT = 'visit';
    public const CLOSING = 'closing';

    public static function all(): array
    {
        return [
            self::COLD,
            self::WARM,
            self::HOT,
            self::VISIT,
            self::CLOSING,
        ];
    }

    public static function labels(): array
    {
        return [
            self::COLD => 'Cold',
            self::WARM => 'Warm',
            self::HOT => 'Hot',
            self::VISIT => 'Visit',
            self::CLOSING => 'Closing',
        ];
    }

    public static function primaryLabels(): array
    {
        return [
            self::COLD => 'Cold',
            self::WARM => 'Warm',
            self::HOT => 'Hot',
            self::CLOSING => 'Closing',
        ];
    }

    public static function badgeClasses(): array
    {
        return [
            self::COLD => 'bg-slate-100 border-slate-200 text-slate-700',
            self::WARM => 'bg-yellow-100 border-yellow-200 text-yellow-800',
            self::HOT => 'bg-red-100 border-red-200 text-red-700',
            self::VISIT => 'bg-blue-100 border-blue-200 text-blue-700',
            self::CLOSING => 'bg-emerald-100 border-emerald-200 text-emerald-700',
        ];
    }
}
