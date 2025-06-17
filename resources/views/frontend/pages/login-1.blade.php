@extends('layouts.frontend.auth')

@section('title')
Employee Login
@endsection

@section('frontend_content')


    <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
        <div class="kt-card max-w-[370px] w-full">
            @include('frontend.components.form.add_user_form')
        </div>
    </div>

@endsection