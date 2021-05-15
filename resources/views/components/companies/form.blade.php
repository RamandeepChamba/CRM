@props(['company' => null])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(($company ? 'Editing' : 'Add') . ' a company') }}
        </h2>
    </x-slot>

    <div class="py-12 md:px-40 lg:px-60 xl:px-96">
        <form action="{{ route('companies.' . (isset($company) ? 'update' : 'store'), $company->id ?? null) }}" 
            method="POST" enctype="multipart/form-data" 
            class="flex flex-col py-16 px-10 bg-white md:px-14 lg:px-20 space-y-4">
            @csrf
            @isset($company)
                @method('PATCH')
            @endisset
            <x-label for="name">
                Name
                <span class="italic font-medium text-sm text-gray-600">
                (required)
                </span>
            </x-label>
            
            <x-input type="text" name="name" id="name" :value="$company->name ?? ''" autofocus />
            @error('name')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror
            
            <x-label for="email">Email</x-label>
            <x-input type="email" name="email" id="email" :value="$company->email ?? ''" />
            @error('email')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror
            
            <x-img-preview name="logo" :src="isset($company) ? $company->logo : ''" />
            <div class="italic text-sm font-medium text-gray-600">
                * minimum dimensions 100x100px
            </div>
            @error('logo')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror
            
            <x-label for="website">Website</x-label>
            <x-input type="text" name="website" id="website" :value="$company->website ?? ''" />
            @error('website')
                <x-alert color="red">{{ $message }}</x-alert>
            @enderror
            
            <x-button class="w-1/3 justify-center">{{ $company ? 'Edit' : 'Add' }}</x-button>
        </form>
    </div>
</x-app-layout>