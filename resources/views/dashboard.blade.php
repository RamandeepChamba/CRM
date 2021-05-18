<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <h2 class="text-5xl text-center text-white py-10 bg-gray-600 max-w-5xl mx-auto py-10 sm:px-6 lg:px-8">CRM</h2>
        <p class="text-2xl bg-gray-200 max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
            Welcome to CRM, manage companies and their employees all in one place
        </p>
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 text-2xl bg-white p-10 text-blue-400">
            <a href="{{ route('companies.index') }}" class="block mb-6">Companies</a>
            <a href="#" class="block">Employees</a>
        </div>
    </div>
</x-app-layout>
