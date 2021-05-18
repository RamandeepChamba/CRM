@php
    $flash_message = session('status');    
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Company Info') }}
        </h2>
    </x-slot>

    <div>
        @isset($flash_message)
            <x-flash-message color="green" class="flash-message">{{ $flash_message }}</x-flash-message>
        @endisset
        <table class="table-auto bg-white w-full sm:w-2/3 sm:mx-auto sm:mt-10">
            <thead>
                <tr>
                    <th colspan="2" class="">
                        <div class="flex flex-col md:flex-row">
                            <div id="logo-container" class="bg-blue-200 h-56 md:w-1/2 text-white">
                                <!-- Logo -->
                                <img 
                                    src="{{ $company->logo ?? 'https://sahityabhawanpublications.com/wp-content/uploads/2017/10/logo-placeholder.jpg' }}" 
                                    alt="company logo"
                                    class="object-contain w-full h-56 bg-gray-900 py-6 px-4"
                                >
                            </div>
                            
                            <!-- Name -->
                            <div class="p-10 text-2xl bg-gray-900 text-gray-200 md:text-3xl lg:text-4xl md:w-2/3 md:p-0 
                                md:flex md:items-center md:justify-center">
                                {{ $company->name }}
                            </div>
                        </div>
                    </th>  
                </tr>
            </thead>
            
            <tbody class="border-t-2">
                <tr class="border-b-2">
                    <td class="p-8 border-r-2">Email</td>
                    <td class="p-8">{{ $company->email ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="p-8 border-r-2">Website</td>
                    <td class="p-8">{{ $company->website ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>