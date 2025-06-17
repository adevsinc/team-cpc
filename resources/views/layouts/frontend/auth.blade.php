<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
 <head><base href="../../../../">
  <title>@yield('title')</title>
  <meta charset="utf-8"/>
  <meta content="follow, index" name="robots"/>
  <link href="{{ url()->current() }}" rel="canonical"/>
  <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
  <meta content="Sign in page using Tailwind CSS" name="description"/>
  <meta content="@keenthemes" name="twitter:site"/>
  <meta content="@keenthemes" name="twitter:creator"/>
  <meta content="summary_large_image" name="twitter:card"/>
  <meta content="Metronic - Tailwind CSS Sign In" name="twitter:title"/>
  <meta content="Sign in page using Tailwind CSS" name="twitter:description"/>
  <meta content="{{ asset('frontend_assets') }}/media/app/og-image.png" name="twitter:image"/>
  <meta content="{{ url()->current() }}" property="og:url"/>
  <meta content="en_US" property="og:locale"/>
  <meta content="website" property="og:type"/>
  <meta content="@keenthemes" property="og:site_name"/>
  <meta content="Metronic - Tailwind CSS Sign In" property="og:title"/>
  <meta content="Sign in page using Tailwind CSS" property="og:description"/>
  <meta content="{{ asset('frontend_assets') }}/media/app/og-image.png" property="og:image"/>

  <!-- Alpine.js -->
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  @include('layouts.frontend.components.styles')

 </head>



 <body class="antialiased flex h-full text-base text-foreground bg-background">
  <!-- Theme Mode -->
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
					themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches
						? 'dark'
						: 'light';
				}

				document.documentElement.classList.add(themeMode);
			}
  </script>
  <!-- End of Theme Mode -->
  <!-- Page -->
  <style>
   .page-bg {
			background-image: url('{{ asset('frontend_assets') }}/media/images/2600x1200/bg-10.png');
		}
		.dark .page-bg {
			background-image: url('{{ asset('frontend_assets') }}/media/images/2600x1200/bg-10-dark.png');
		}
  </style>


  @yield('frontend_content')

  @include('layouts.frontend.components.scripts')


 </body>
</html>
