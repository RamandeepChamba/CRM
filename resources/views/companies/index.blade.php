@php
    $flash_message = session('status');    
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto my-10">
        @isset($flash_message)
            <x-flash-message color="green" class="flash-message">{{ $flash_message }}</x-flash-message>
        @endisset
        <a href="{{ route('companies.create') }}">
            <button class="block disable-onClick bg-green-500 p-5 rounded-md mx-auto text-white font-bold mb-10">
                Add a company
            </button>
        </a>
        @isset($companies[0])
            <table class="table-auto border-2 w-full md:w-2/3 lg:w-1/2 mx-auto">
                <thead>
                    <tr class="border-2">
                        <th colspan="4" class="bg-white p-8 text-xl">Companies list</th>
                    </tr>
                    <tr class="border-2 bg-white">
                        <th class="border-2 px-5 py-8 text-left">Name</th>
                        <th class="border-2 px-5 py-8 text-left">Website</th>
                        <th class="border-2 px-5 py-8 text-left">Email</th>
                        <th class="border-2 px-5 py-8 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr class="border-2 bg-gray-600 text-gray-100">
                            <td class="border-2 px-5">{{ $company->name }}</td>
                            <td class="border-2 px-5">{{ $company->website ?? 'N/A' }}</td>
                            <td class="border-2 px-5">{{ $company->email ?? 'N/A' }}</td>
                            <td class="border-2 px-5 py-3">
                                <a href="{{ route('companies.show', $company->id) }}">
                                    <button class="disable-onClick px-2 py-1 border 
                                        border-black bg-blue-500 text-white rounded-md py-2 px-4">
                                        View
                                    </button>
                                </a>
                                <a href="{{ route('companies.edit', $company->id) }}">
                                    <button class="disable-onClick px-2 py-1 border 
                                        border-black bg-yellow-500 text-black rounded-md py-2 px-4">
                                        Edit
                                    </button>
                                </a>
                                
                                <form action="{{ route('companies.destroy', $company->id) }}" 
                                    class="disable-onSubmit" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="block px-2 py-1 border 
                                        border-black bg-red-800 rounded-md py-2 px-4">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>   
        @else
            <h2>No Companies</h2>
        @endisset
    </div>
    {{ $companies->links() }}
</x-app-layout>