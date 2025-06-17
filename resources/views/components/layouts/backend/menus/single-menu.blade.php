@props(['menu'])
@php
    $url = $menu['url'];
@endphp

<div class="kt-menu-item {{ request()->routeIs($url) ? 'kt-menu-item-active:bg-accent/60' : '' }}">
    <a class="kt-menu-label border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[6px]" href="{{ route($url) }}">
        @if(isset($menu['icon']) && !empty($menu['icon']))
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]"><i class="{{ $menu['icon'] }} text-lg"></i></span>
        @endif
        <span class="kt-menu-title text-sm font-medium text-foreground">{{ $menu['title'] }}</span>
        @if(isset($menu['badge']) && $menu['badge'] > 0)
            <span class="kt-menu-badge me-[-10px]"><span class="kt-badge kt-badge-sm text-accent-foreground/60">{{ $menu['badge'] }}</span></span>
        @endif
    </a>
</div>