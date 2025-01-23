<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/23/25
 */

namespace App\HelpersClass;

class HelpersRenderHtml
{
    public static function getStatusBadgeClass($status)
    {
        $classes = [
            'published' => 'bg-success',
            'draft' => 'bg-warning',
            'pending' => 'bg-secondary',
        ];
        return $classes[$status] ?? 'bg-light';
    }
}