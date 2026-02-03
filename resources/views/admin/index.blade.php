<x-app-layout>
    <h1>Welcome, Admin</h1>
    <p>You are now in the admin dashboard.</p>
    <!-- Button to Landing Page -->
    <div class="mt-6">
        <a 
            href="{{ route('landing') }}" 
            class="inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
        >
            Go to Landing Page
        </a>
    </div>
</x-app-layout>