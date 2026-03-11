@push('styles')
    <link rel="stylesheet" href="{{ asset('css/nazeerstyles.css') }}">
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="hero dashboard-hero">
        <div class="hero-overlay">
            <div class="about-section dashboard-intro">
                <p class="dashboard-eyebrow">{{ __('Account Hub') }}</p>
                <h1>{{ __('Welcome back, :name', ['name' => Auth::user()->name]) }}</h1>
                <p class="about-text">
                    {{ __("You're logged in. Use this dashboard to browse the storefront, manage your account details, review your orders, or sign out.") }}
                </p>
            </div>

            <div class="values-section dashboard-actions">
                <h2>{{ __('Quick Actions') }}</h2>

                <div class="values-grid dashboard-grid">
                    <a href="{{ route('landing') }}" class="value-card dashboard-card">
                        <h3>{{ __('Go to Landing Page') }}</h3>
                        <p>{{ __('Browse the main storefront and keep shopping from the homepage.') }}</p>
                    </a>

                    <a href="{{ route('orders.index') }}" class="value-card dashboard-card">
                        <h3>{{ __('View Your Orders') }}</h3>
                        <p>{{ __('Check previous purchases, order details, and current order history.') }}</p>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="value-card dashboard-card">
                        <h3>{{ __('Profile') }}</h3>
                        <p>{{ __('Update your account information, password, and saved profile details.') }}</p>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="value-card dashboard-card dashboard-card-form">
                        @csrf
                        <button type="submit" class="dashboard-card-button">
                            <h3>{{ __('Log Out') }}</h3>
                            <p>{{ __('End your current session and return safely to the authentication screen.') }}</p>
                        </button>
                    </form>

                    <button
                        type="button"
                        class="value-card dashboard-card dashboard-card-button dashboard-card-danger"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    >
                        <h3>{{ __('Delete Account') }}</h3>
                        <p>{{ __('Permanently remove your account after confirming your password in the modal.') }}</p>
                    </button>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
