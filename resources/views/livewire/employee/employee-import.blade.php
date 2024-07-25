<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Import Employee') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <x-input-error :messages="session('error')" class="mt-2" />

                <form wire:submit.prevent="import">
                    <div>
                        <input type="file" wire:model="file" accept=".xlsx, .xls" required>
                        @error('file') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Import Employees</button>
                </form>
            </div>
        </div>
    </div>
</div>
