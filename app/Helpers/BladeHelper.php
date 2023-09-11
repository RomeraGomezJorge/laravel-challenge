<?php

    namespace App\Helpers;

    use Illuminate\Support\Facades\Request;

    class BladeHelper
    {
        public static function generateSortUrl( string $column): string
        {
            $direction = (Request::has('direction') && Request::get('direction') == 'ASC') ? 'DESC' : 'ASC';
            $queryParams = array_merge(
                Request::except(['order_by', 'direction']),
                ['order_by' => $column, 'direction' => $direction]
            );
            return route('discount.index') . '?' . http_build_query($queryParams);
        }

        public static function generateSorDirectionIcon(): string
        {
            return (Request::get('direction') == 'ASC')
                ? '<svg class="h-2 w-2 text-gray-500 inline-block"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M5.07 19H19a2 2 0 0 0 1.75 -2.75L13.75 4a2 2 0 0 0 -3.5 0L3.25 16.25a2 2 0 0 0 1.75 2.75" /></svg>'
                : '<svg class="h-2 w-2 text-gray-500 inline-block"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="transform: rotate(180deg);">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M5.07 19H19a2 2 0 0 0 1.75 -2.75L13.75 4a2 2 0 0 0 -3.5 0L3.25 16.25a2 2 0 0 0 1.75 2.75" /></svg>';
        }
    }
