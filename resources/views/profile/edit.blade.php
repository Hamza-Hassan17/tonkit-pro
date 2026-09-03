<x-app-layout>
    <x-slot name="title">My Account</x-slot>

    <x-page-hero title="MY" accent="ACCOUNT" subtitle="Manage your profile, password, and account settings." />

    <div class="container-site max-w-3xl py-12 space-y-6">
        <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
