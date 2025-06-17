<form action="#" class="kt-card-content flex flex-col gap-5 p-10" id="sign_in_form" method="get">
    <div class="text-center mb-2.5">
        <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
            Sign in
        </h3>
        <div class="flex items-center justify-center font-medium">
            <span class="text-sm text-secondary-foreground me-1.5">
                Need an account?
            </span>
            <a class="text-sm link" href="html/demo1/authentication/classic/sign-up.html">
                Sign up
            </a>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-2.5">
        <a class="kt-btn kt-btn-outline justify-center" href="#">
            <img alt="" class="size-3.5 shrink-0"
                src="{{ asset('frontend_assets') }}/media/brand-logos/google.svg" />
            Use Google
        </a>
        <a class="kt-btn kt-btn-outline justify-center" href="#">
            <img alt="" class="size-3.5 shrink-0 dark:hidden"
                src="{{ asset('frontend_assets') }}/media/brand-logos/apple-black.svg" />
            <img alt="" class="size-3.5 shrink-0 light:hidden"
                src="{{ asset('frontend_assets') }}/media/brand-logos/apple-white.svg" />
            Use Apple
        </a>
    </div>
    <div class="flex items-center gap-2">
        <span class="border-t border-border w-full">
        </span>
        <span class="text-xs text-muted-foreground font-medium uppercase">
            Or
        </span>
        <span class="border-t border-border w-full">
        </span>
    </div>

    @include('frontend.components.form_elements.input', [
        'label' => 'Mobile',
        'id' => 'mobile',
        'type' => 'text',
        'placeholder' => 'Enter Mobile',
        'value' => '01717171717',
    ])
    <button class="kt-btn kt-btn-primary flex justify-center grow">
        Request Passcode
    </button>
</form>