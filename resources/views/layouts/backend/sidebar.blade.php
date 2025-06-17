<div class="kt-menu-item" data-kt-menu-item-toggle="accordion" data-kt-menu-item-trigger="click">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('app.social') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('app.social') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-newspaper"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">News Feed</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('scheduler') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('scheduler') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-calendar-day"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Shifts</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('openshifts') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('openshifts') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-people-arrows"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Open Shifts ({{ $countOpenShifts ?? 0 }})</span>
    </a>
</div>
@if(!empty($authUserPolicyCount) && $authUserPolicyCount > 0)
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('timeoff') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('timeoff') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fas fa-umbrella-beach"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Paid Time Off</span>
    </a>
</div>
@endif
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('schedulerrequests') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('schedulerrequests') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-arrows-rotate"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Manage My Requests ({{ $actionSchedulerCounter ?? 0 }})</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('todo.list') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('todo.list') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-square-check"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">To-Do Lists ({{ $todoListCounter ?? 0 }})</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('performance') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('performance') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-star"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Performance Reviews ({{ $actionPerformanceCounter ?? 0 }})</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('course') || request()->routeIs('lesson') || request()->routeIs('quiz') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('course') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-university"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Crust Pizza University @if(!empty($cpuScore)) ({{ $cpuScore }}%) @endif</span>
    </a>
</div>
@if(!empty($authUserIsMitUser) && $authUserIsMitUser == '1')
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('mitcourse') || request()->routeIs('mitlesson') || request()->routeIs('mitquiz') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('mitcourse') }}" style="padding-right: 0px">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-book"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Manager Training Program @if(!empty($mitScore)) ({{ $mitScore }}%) @endif</span>
    </a>
</div>
@endif
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('employee-directory') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('employee-directory') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-users"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Employee Directory</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('document') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('document') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-folder"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">My Files</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('accountsetting') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('accountsetting') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-cog"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">My Profile</span>
    </a>
</div>
<div class="kt-menu-item">
    <a class="kt-menu-link flex items-center grow border border-transparent gap-[10px] ps-[10px] pe-[10px] py-[8px] {{ request()->routeIs('helpdesk.ticketlist') ? 'kt-menu-item-active:bg-accent/60' : '' }}" href="{{ route('helpdesk.ticketlist') }}">
        <span class="kt-menu-icon items-start text-muted-foreground w-[20px]">
            <i class="fa fa-question"></i>
        </span>
        <span class="text-sm font-medium kt-menu-title text-foreground">Help Center</span>
    </a>
</div>
