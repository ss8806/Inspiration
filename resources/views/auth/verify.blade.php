@extends('layouts.app')

@section('content')
            <div class="p-card--scaff">
                <div class="p-card__header">{{ __('Verify Your Email Address') }}</div>

                <div class="p-card__body">
                    @if (session('resent'))
                        <div class="c-alert c-alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="p-form" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="c-btn">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>

@endsection
