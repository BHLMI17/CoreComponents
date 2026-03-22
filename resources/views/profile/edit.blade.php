<x-app-layout>
    @push('styles')
    <link rel="stylesheet" href="{{ asset('css/nazeerstyles.css') }}">
    <style>
        body {
            background-color: #121212;
            color: #f0f0f0;
        }
        .min-h-screen.bg-gray-100 {
            background-color: #121212;
        }
        nav.bg-white {
            background: rgba(14, 14, 14, 0.92);
            border-bottom-color: #2a2a2a;
        }
        nav .text-gray-800,
        nav .text-gray-500,
        nav .text-gray-700 {
            color: #f0f0f0;
        }
        nav a:hover,
        nav button:hover {
            color: #00ffcc;
        }
        header.bg-white {
            background: #161616;
            border-bottom: 1px solid #252525;
        }
        header .text-gray-800 {
            color: #f0f0f0;
        }

        .profile-hero {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            padding: 4rem 2rem;
            text-align: center;
            color: #f0f0f0;
        }
        .profile-hero h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.75);
        }
        .profile-hero p {
            font-size: 1.1rem;
            color: #d1d5db;
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }
        .profile-card {
            background: #1f1f1f;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }
        .profile-card h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #00ffcc;
        }
        .profile-card p {
            color: #d1d5db;
            margin-bottom: 1.5rem;
        }
        .profile-card form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .profile-card .form-group {
            display: flex;
            flex-direction: column;
        }
        .profile-card label {
            font-weight: 600;
            color: #f0f0f0;
            margin-bottom: 0.5rem;
        }
        .profile-card input,
        .profile-card textarea,
        .profile-card select {
            background-color: #2a2a2a;
            color: #f0f0f0;
            border: 1px solid #444;
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 1rem;
        }
        .profile-card input:focus,
        .profile-card textarea:focus,
        .profile-card select:focus {
            border-color: #00ffcc;
            box-shadow: 0 0 0 2px rgba(0, 255, 204, 0.2);
            outline: none;
        }
        .profile-card button {
            background-color: #00ffcc;
            color: #000;
            border: none;
            border-radius: 6px;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 1rem;
        }
        .profile-card button:hover {
            background-color: #00ccaa;
        }
        .profile-card .delete-button {
            background-color: #ff4444;
            color: #fff;
        }
        .profile-card .delete-button:hover {
            background-color: #cc3333;
        }
    </style>
    @endpush

    <div class="profile-hero">
        <h2>{{ __('Profile Management') }}</h2>
        <p>{{ __('Update your account information, change your password, or manage your account settings below.') }}</p>
    </div>

    <div class="profile-grid">
        <div class="profile-card">
            <h2>{{ __('Profile Information') }}</h2>
            <p>{{ __("Update your account's profile information and email address.") }}</p>
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="profile-card">
            <h2>{{ __('Update Password') }}</h2>
            <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
            @include('profile.partials.update-password-form')
        </div>

        <div class="profile-card">
            <h2>{{ __('Delete Account') }}</h2>
            <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
