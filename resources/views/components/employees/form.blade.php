@props(['companies', 'employee' => null])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(($employee ? 'Editing' : 'Add') . ' an employee') }}
        </h2>
    </x-slot>

    <div class="py-12 md:px-40 lg:px-60 xl:px-96">
        <form action="{{ route('employees.' . (isset($employee) ? 'update' : 'store'), $employee->id ?? null) }}" 
            method="POST" enctype="multipart/form-data" 
            class="flex flex-col py-16 px-10 bg-white md:px-14 lg:px-20 space-y-4 disable-onSubmit">
            @csrf
            @isset($employee)
                @method('PATCH')
            @endisset
            <!-- First Name -->
            <x-label for="first_name">
                First Name
                <span class="italic font-medium text-sm text-gray-600">
                (required)
                </span>
            </x-label>
            
            <x-input type="text" name="first_name" id="first_name" :value="$employee->first_name ?? ''" autofocus />
            @error('first_name')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror

            <!-- Last Name -->
            <x-label for="last_name">
                Last Name
                <span class="italic font-medium text-sm text-gray-600">
                (required)
                </span>
            </x-label>
            
            <x-input type="text" name="last_name" id="last_name" :value="$employee->last_name ?? ''" autofocus />
            @error('last_name')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror
            
            <!-- Company -->
            <x-label for="company">
                Company
                <span class="italic font-medium text-sm text-gray-600">
                (required)
                </span>    
            </x-label>
            <select name="company" id="company" data-company-id="{{ isset($employee) ? $employee->company->id : null }}">
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" id="{{ 'option-' . $company->id }}">
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
            @error('company')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror

            <!-- Email -->
            <x-label for="email">Email</x-label>
            <x-input type="email" name="email" id="email" :value="$employee->email ?? ''" />
            @error('email')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror

            <!-- Phone -->
            <x-label for="phone">Enter your phone number:</x-label>

            <x-input type="tel" id="phone" name="phone" :value="$employee->phone ?? ''"
                placeholder="888-888-8888"
                pattern="^([\+]?\d{1,2}[\s.-]?)?\(?[\s.-]?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$" />

            @error('phone')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror


            <!-- Avatar -->
            <x-img-preview name="avatar" :src="isset($employee) ? $employee->avatar : ''" />
            <div class="italic text-sm font-medium text-gray-600">
                * minimum dimensions 100x100px
            </div>
            @error('avatar')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror
            
            <x-button class="w-1/3 justify-center">{{ $employee ? 'Edit' : 'Add' }}</x-button>
        </form>
    </div>

    @push('scripts')
        <script>
            // isset($employee) ? ($employee->company->id == $company->id) : false
            const companyId = document.getElementById('company').dataset.companyId

            if (companyId) {
                let option = document.getElementById(`option-${companyId}`)
                option.selected = true
            }
        </script>
    @endpush
</x-app-layout>
