<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">

<head>
    <base href="{{ url()->current() }}">
    <title>{{ $title ?? 'Crust Pizza Co. Team App' }}</title>
    <meta charset="utf-8" />
    <meta content="follow, index" name="robots" />
    <link href="https://127.0.0.1:8001/metronic-tailwind-html/demo1/dashboards/dark-sidebar" rel="canonical" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <meta content="Dark Sidebar style dashboard with data widgets and interactive charts" name="description" />
    <meta content="@keenthemes" name="twitter:site" />
    <meta content="@keenthemes" name="twitter:creator" />
    <meta content="summary_large_image" name="twitter:card" />
    <meta content="Metronic - Tailwind CSS Dark Sidebar" name="twitter:title" />
    <meta content="Dark Sidebar style dashboard with data widgets and interactive charts" name="twitter:description" />
    <meta content="{{ asset('frontend_assets') }}/media/app/og-image.png" name="twitter:image" />
    <meta content="https://127.0.0.1:8001/metronic-tailwind-html/demo1/dashboards/dark-sidebar" property="og:url" />
    <meta content="en_US" property="og:locale" />
    <meta content="website" property="og:type" />
    <meta content="@keenthemes" property="og:site_name" />
    <meta content="Metronic - Tailwind CSS Dark Sidebar" property="og:title" />
    <meta content="Dark Sidebar style dashboard with data widgets and interactive charts" property="og:description" />
    <meta content="{{ asset('frontend_assets') }}/media/app/og-image.png" property="og:image" />
    <link href="{{ asset('frontend_assets') }}/media/app/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="{{ asset('frontend_assets') }}/media/app/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png" />
    <link href="{{ asset('frontend_assets') }}/media/app/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png" />
    <link href="{{ asset('frontend_assets') }}/media/app/favicon.ico" rel="shortcut icon" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="{{ asset('frontend_assets') }}/vendors/apexcharts/apexcharts.css" rel="stylesheet" />
    <link href="{{ asset('frontend_assets') }}/vendors/keenicons/styles.bundle.css" rel="stylesheet" />
    <link href="{{ asset('frontend_assets') }}/css/styles.css" rel="stylesheet" />

    {{ $styles ?? '' }}
    
</head>

<body class="antialiased flex h-full text-base text-foreground bg-background demo1 kt-sidebar-fixed kt-header-fixed">
    
    <script>
        const defaultThemeMode = 'light'; // light|dark|system
        let themeMode;

        if (document.documentElement) {
            if (localStorage.getItem('kt-theme')) {
                themeMode = localStorage.getItem('kt-theme');
            } else if (
                document.documentElement.hasAttribute('data-kt-theme-mode')
            ) {
                themeMode =
                    document.documentElement.getAttribute('data-kt-theme-mode');
            } else {
                themeMode = defaultThemeMode;
            }

            if (themeMode === 'system') {
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ?
                    'dark' :
                    'light';
            }

            document.documentElement.classList.add(themeMode);
        }
    </script>
    
    <!-- Main -->
    <div class="flex grow">
        <!-- Sidebar -->
        <x-layouts.backend.sidebar />
        <!-- End of Sidebar -->
        <!-- Wrapper -->
        <div class="kt-wrapper flex grow flex-col">
            <!-- Header -->
            <x-layouts.backend.header />
            
            <!-- End of Header -->
            <!-- Content -->
            <main class="grow pt-5" id="content" role="content">
                <!-- Container -->
                <div class="kt-container-fixed" id="contentContainer"></div>
                <!-- End of Container -->
                <!-- Container -->
                <div class="kt-container-fixed">
                    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                        <div class="flex flex-col justify-center gap-2">
                            <h1 class="text-xl font-medium leading-none text-mono">
                                Dashboard
                            </h1>
                            <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                                Central Hub for Personal Customization
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <a class="kt-btn kt-btn-outline" href="#">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End of Container -->
                <!-- Container -->

                {{ $slot }}

                <!-- End of Container -->
            </main>
            <!-- End of Content -->
            <!-- Footer -->
            <x-layouts.backend.footer />
            <!-- End of Footer -->
        </div>
       
        <!-- End of Wrapper -->
    </div>
    

    <!-- Scripts -->
    <script src="{{ asset('frontend_assets') }}/js/core.bundle.js"></script>
    <script src="{{ asset('frontend_assets') }}/vendors/ktui/ktui.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/widgets/general.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/layouts/demo1.js"></script>
    <!-- End of Scripts -->

    {{ $scripts ?? '' }}


</body>

</html>
