<div class="kt-sidebar bg-background border-e border-e-border fixed top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0 [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]" data-kt-drawer="true" data-kt-drawer-class="top-0 bottom-0 kt-drawer kt-drawer-start" id="sidebar">
    <div class="relative items-center justify-between hidden px-3 kt-sidebar-header lg:flex lg:px-6 shrink-0" id="sidebar_header">
     <a class="" href="html/demo1.html">
      <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('frontend_assets/media/images/nn-crust-logo.svg') }}" alt="Crust Pizza Co"/>
      {{-- <img src="{{ asset('frontend_assets/media/images/site-logo.svg') }}" alt="Crust Pizza Co" class="w-auto h-32"> --}}
      {{-- <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('frontend_assets') }}/media/app/mini-logo.svg"/> --}}
     </a>
     {{-- <a class="hidden dark:block" href="html/demo1.html"> --}}
      {{-- <img class="default-logo min-h-[22px] max-w-none" src="{{ asset('frontend_assets') }}/media/app/default-logo-dark.svg"/>
      <img class="small-logo min-h-[22px] max-w-none" src="{{ asset('frontend_assets') }}/media/app/mini-logo.svg"/> --}}
     {{-- </a> --}}
     <button class="kt-btn kt-btn-outline kt-btn-icon size-[30px] absolute start-full top-2/4 -translate-x-2/4 -translate-y-2/4 rtl:translate rtl:rotate-180 rtl:kt-toggle-active:rotate-0" data-kt-toggle="body" data-kt-toggle-class="kt-sidebar-collapse" id="sidebar_toggle">
      <i class="transition-all duration-300 ki-filled ki-black-left-line kt-toggle-active:rotate-180 rtl:translate rtl:rotate-180 rtl:kt-toggle-active:rotate-0">
      </i>
     </button>
    </div>
    <div class="flex py-5 kt-sidebar-content grow shrink-0 pe-2" id="sidebar_content">
     <div class="flex kt-scrollable-y-hover grow shrink-0 ps-2 lg:ps-5 pe-1 lg:pe-3" data-kt-scrollable="true" data-kt-scrollable-dependencies="#sidebar_header" data-kt-scrollable-height="auto" data-kt-scrollable-offset="0px" data-kt-scrollable-wrappers="#sidebar_content" id="sidebar_scrollable">
      <!-- Sidebar Menu -->
      <div class="flex flex-col gap-1 kt-menu grow" data-kt-menu="true" data-kt-menu-accordion-expand-all="false" id="sidebar_menu">
        @include('layouts.backend.sidebar')
      </div>
      <!-- End of Sidebar Menu -->
     </div>
    </div>
   </div>