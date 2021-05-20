@php
    $flash_message = session('status');    
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="overflow-x-auto my-10">
        @isset($flash_message)
            <x-flash-message color="green" class="flash-message">{{ $flash_message }}</x-flash-message>
        @endisset
        <a href="{{ route('employees.create') }}">
            <button class="block disable-onClick bg-green-500 p-5 rounded-md mx-auto text-white font-bold mb-10">
                Add an Employee
            </button>
        </a>
            <table class="table-auto border-2 w-full md:w-2/3 lg:w-1/2 mx-auto">
                <thead>
                    <tr class="border-2">
                        <th colspan="5" class="bg-white p-8 text-xl">Employees list</th>
                    </tr>
                    <tr class="border-2 bg-white">
                        <th class="border-2 px-5 py-8 text-left">First Name</th>
                        <th class="border-2 px-5 py-8 text-left">Last Name</th>
                        <th class="border-2 px-5 py-8 text-left">Email</th>
                        <th class="border-2 px-5 py-8 text-left">Company</th>
                        <th class="border-2 px-5 py-8 text-left"></th>
                    </tr>
                </thead>
                <tbody>
                @isset($employees[0])
                    @foreach ($employees as $employee)
                        <tr class="border-2 bg-gray-600 text-gray-100">
                            <td class="border-2 px-5">{{ $employee->first_name }}</td>
                            <td class="border-2 px-5">{{ $employee->last_name }}</td>
                            <td class="border-2 px-5">{{ $employee->email ?? 'N/A' }}</td>
                            <td class="border-2 px-5">
                                <a href="{{ route('companies.show', $employee->company->id) }}" class="underline">
                                    {{ $employee->company->name }}</td>
                                </a>
                            <td class="border-2 px-5 py-3">
                                <a href="{{ route('employees.show', $employee->id) }}">
                                    <button class="disable-onClick px-2 py-1 border 
                                        border-black bg-blue-500 text-white rounded-md py-2 px-4">
                                        View
                                    </button>
                                </a>
                                <a href="{{ route('employees.edit', $employee->id) }}">
                                    <button class="disable-onClick px-2 py-1 border 
                                        border-black bg-yellow-500 text-black rounded-md py-2 px-4">
                                        Edit
                                    </button>
                                </a>
                                
                                <form action="{{ route('employees.destroy', $employee->id) }}" 
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
                @else
                    <tr class="border-2">
                        <th colspan="5" class="bg-gray-600 text-gray-100 p-8 text-xl">No Employees</th>
                    </tr>
                @endisset
                </tbody>
            </table>
    </div>
    {{ $employees->links() }}
</x-app-layout>