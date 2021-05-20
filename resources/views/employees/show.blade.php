@php
    $flash_message = session('status');    
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employee Info') }}
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
                                    src="{{ $employee->avatar ?? 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png' }}" 
                                    alt="employee avatar"
                                    class="object-contain w-full h-56 bg-gray-900 py-6 px-4"
                                >
                            </div>
                            
                            <!-- Name -->
                            <div class="p-10 text-2xl bg-gray-900 text-gray-200 md:text-3xl lg:text-4xl md:w-2/3 md:p-0 
                                md:flex md:items-center md:justify-center">
                                {{ $employee->first_name . ' ' . $employee->last_name }}
                            </div>
                        </div>
                    </th>  
                </tr>
            </thead>
            
            <tbody class="border-t-2">
                <tr class="border-b-2">
                    <td class="p-8 border-r-2">Email</td>
                    <td class="p-8">{{ $employee->email ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b-2">
                    <td class="p-8 border-r-2">Phone</td>
                    <td class="p-8">{{ $employee->phone ?? 'N/A' }}</td>
                </tr>
                <tr class="border-b-2">
                    <td class="p-8 border-r-2">Company</td>
                    <td class="p-8">
                        <a href="{{ route('companies.show', $employee->company->id) }}" class="underline">
                            {{ $employee->company->name ?? 'N/A' }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="p-8 border-r-2">Actions</td>
                    <td class="p-8">
                    <a href="{{ route('employees.edit', $employee->id) }}">
                        <button class="disable-onClick px-2 py-1 border 
                            border-black bg-yellow-400 text-black rounded-md py-2 px-4">
                            Edit
                        </button>
                    </a>
                    
                    <form action="{{ route('employees.destroy', $employee->id) }}" 
                        class="disable-onSubmit" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="block px-2 py-1 border 
                            border-black bg-red-600 text-white rounded-md py-2 px-4">
                            Delete
                        </button>
                    </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>