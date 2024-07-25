<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('List Employee') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <div>
                    <div class="mb-4">
                        <a href="{{ route('employees.export-pdf') }}" class="bg-blue-400 text-white px-4 py-2 rounded">Export to PDF</a>&nbsp;<br>&nbsp;
                        <input type="text" wire:model.live="search" placeholder="Search employees..." class="border p-2 rounded w-full" />
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50">Name</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">Contact Number</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">Email</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">Date of Birth</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">Address</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">Employee Register Number</th>
                                <th scope="col" class="px-6 py-3 bg-gray-50">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($employees as $employee)
                                <tr wire:key="{{ $employee->id }}">
                                    <td class="px-6 py-4">{{ $employee->name }}</td>
                                    <td class="px-6 py-4">{{ $employee->contact_number }}</td>
                                    <td class="px-6 py-4">{{ $employee->email }}</td>
                                    <td class="px-6 py-4">{{ $employee->date_of_birth }}</td>
                                    <td class="px-6 py-4">{{ $employee->address }}</td>
                                    <td class="px-6 py-4">{{ $employee->employee_register_number }}</td>
                                    <td class="px-6 py-4" style="display: flex">
                                        <button wire:click="editEmployee({{ $employee->id }})" class="bg-blue-500 text-white px-4 py-2 rounded">Edit</button>&nbsp;
                                        <button
                                            class="bg-red-500 text-white px-4 py-2 rounded"
                                            type="button"
                                            wire:click="deleteEmployee({{ $employee->id }})"
                                            wire:confirm="Are you sure you want to delete?"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-4 text-center" colspan="6">No employees found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $employees->links(data: ['scrollTo' => false]) }}
                </div>

                @if($selectedEmployee)
                    <div class="mt-6 bg-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Edit Employee</h3>
                        <div>
                            <label for="name">Name</label>
                            <input type="text" wire:model="name" id="name" class="border p-2 rounded w-full" />
                            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="contact_number">Contact Number</label>
                            <input type="text" wire:model="contact_number" id="contact_number" class="border p-2 rounded w-full" />
                            @error('contact_number') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email">Email</label>
                            <input type="email" wire:model="email" id="email" class="border p-2 rounded w-full" />
                            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="date_of_birth">Date of Birth</label>
                            <input type="date" wire:model="date_of_birth" id="date_of_birth" class="border p-2 rounded w-full" />
                            @error('date_of_birth') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="address">Address</label>
                            <input type="text" wire:model="address" id="address" class="border p-2 rounded w-full" />
                            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <button wire:click="updateEmployee" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Update</button>
                        <button wire:click="resetFields" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
