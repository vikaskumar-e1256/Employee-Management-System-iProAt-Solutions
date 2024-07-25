<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;


class CreateEmployee extends Component
{
    public $name;
    public $contact_number;
    public $email;
    public $date_of_birth;
    public $address;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'contact_number' => 'required|unique:employees|regex:/^(\+\d{1,3}[- ]?)?\d{10}$/',
            'email' => 'required|email|unique:employees|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string|max:255',
        ];
    }

    public function generateEmployeeRegisterNumber()
    {
        $latestEmployee = Employee::latest('id')->first();
        $number = $latestEmployee ? ((int) substr($latestEmployee->employee_register_number, 3)) + 1 : 1;
        return 'EMP' . str_pad($number, 3, '0', STR_PAD_LEFT);
    }

    public function submit(): void
    {
        $validatedData = $this->validate();
        $validatedData['employee_register_number'] = $this->generateEmployeeRegisterNumber();

        Employee::create($validatedData);

        Session::flash('status', 'Employee successfully created.');

        $this->reset();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.employee.create-employee');
    }
}
