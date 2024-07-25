<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Session;

class ListEmployee extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedEmployee = null;

    public $name;
    public $contact_number;
    public $email;
    public $date_of_birth;
    public $address;

    protected $rules = [
        'name' => 'required|string|max:255',
        'contact_number' => 'required|numeric|unique:employees,contact_number',
        'email' => 'required|email|unique:employees,email',
        'date_of_birth' => 'required|date',
        'address' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->contact_number = '';
        $this->email = '';
        $this->date_of_birth = '';
        $this->address = '';
        $this->selectedEmployee = null;
    }

    public function editEmployee(Employee $employee)
    {
        $this->selectedEmployee = $employee;
        $this->name = $employee->name;
        $this->contact_number = $employee->contact_number;
        $this->email = $employee->email;
        $this->date_of_birth = $employee->date_of_birth;
        $this->address = $employee->address;
    }

    public function updateEmployee()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'contact_number' => ['required', 'numeric', Rule::unique('employees')->ignore($this->selectedEmployee->id)],
            'email' => ['required', 'email', Rule::unique('employees')->ignore($this->selectedEmployee->id)],
            'date_of_birth' => 'required|date',
            'address' => 'nullable|string|max:255',
        ]);

        if ($this->selectedEmployee) {
            $this->selectedEmployee->update([
                'name' => $this->name,
                'contact_number' => $this->contact_number,
                'email' => $this->email,
                'date_of_birth' => $this->date_of_birth,
                'address' => $this->address,
            ]);

            Session::flash('message', 'Employee details updated successfully.');
            $this->resetFields();
        }
    }

    public function deleteEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        $employees = Employee::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('contact_number', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate(5);

        return view('livewire.employee.list-employee')->with([
            'employees' => $employees
        ]);
    }
}
