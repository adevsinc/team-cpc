<div class="kt-sidebar dark bg-background border-e border-e-border fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0 [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]" data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start top-0 bottom-0" id="sidebar">
            <div class="kt-sidebar-header hidden lg:flex items-center relative justify-between px-3 lg:px-6 shrink-0"
                id="sidebar_header">
                <a href="html/demo1/index.html">
                    <img class="default-logo min-h-[30px] max-w-none" src="{{ asset('frontend_assets') }}/media/images/nn-crust-logo.svg" />
                    <img class="small-logo min-h-[32px] max-w-[32px]" src="{{ asset('frontend_assets') }}/media/app/favicon-32x32.png" />
                </a>
                <div data-kt-toggle="body" data-kt-toggle-class="kt-sidebar-collapse" id="sidebar_toggle">
                    <div class="hidden dark:block">
                        <button
                            class="kt-btn kt-btn-outline kt-btn-icon size-[30px] bg-white border border-white hover:[&_i]:text-black/80 [&_border]:[&_i]:text-black/80 border border-black/10! absolute start-full top-2/4 -translate-x-2/4 -translate-y-2/4 rtl:translate-x-2/4">
                            <i
                                class="ki-filled ki-black-left-line kt-toggle-active:rotate-180 transition-all duration-300 rtl:translate rtl:rotate-180 rtl:kt-toggle-active:rotate-0">
                            </i>
                        </button>
                    </div>
                    <div class="dark:hidden light">
                        <button
                            class="kt-btn kt-btn-outline kt-btn-icon size-[30px] rounded-lg absolute start-full top-2/4 -translate-x-2/4 -translate-y-2/4 rtl:translate-x-2/4">
                            <i
                                class="ki-filled ki-black-left-line kt-toggle-active:rotate-180 transition-all duration-300 rtl:translate rtl:rotate-180 rtl:kt-toggle-active:rotate-0">
                            </i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="kt-sidebar-content flex grow shrink-0 py-5 pe-2" id="sidebar_content">
                <div class="kt-scrollable-y-hover grow shrink-0 flex ps-2 lg:ps-5 pe-1 lg:pe-3"
                    data-kt-scrollable="true" data-kt-scrollable-dependencies="#sidebar_header"
                    data-kt-scrollable-height="auto" data-kt-scrollable-offset="0px"
                    data-kt-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
                    <!-- Sidebar Menu -->
                    <div class="kt-menu flex flex-col grow gap-1" data-kt-menu="true"
                        data-kt-menu-accordion-expand-all="false" id="sidebar_menu">

                        <x-layouts.backend.menus.single-menu :menu="['icon' => 'ki-filled ki-tablet-text-up', 'title' => 'News Feed','url' => 'app.social']" />

                        <x-layouts.backend.menus.single-menu :menu="['icon' => 'ki-filled ki-calendar', 'title' => 'Shifts','url' => 'scheduler']" />

                        <x-layouts.backend.menus.single-menu :menu="['icon' => 'ki-filled ki-calendar-tick', 'title' => 'Open Shifts','url' => 'openshifts', 'badge'=> 4 ]" />

                        <x-layouts.backend.menus.single-menu :menu="['icon' => 'ki-filled ki-calendar-remove', 'title' => 'Paid Time Off','url' => 'timeoff']" />

                        <x-layouts.backend.menus.single-menu :menu="['icon' => 'ki-filled ki-calendar-8', 'title' => 'Manage My Requests','url' => 'schedulerrequests', 'badge'=> 10 ]" />
                            
  

                        
                    </div>
                </div>
            </div>
        </div