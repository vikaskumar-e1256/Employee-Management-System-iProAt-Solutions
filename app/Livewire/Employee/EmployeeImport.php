<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Imports\EmployeesImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;


class EmployeeImport extends Component
{
    use WithFileUploads;

    public $file;

    public function import()
    {
        $this->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new EmployeesImport, $this->file->path());
            Session::flash('status', 'Employees imported successfully.');
            $this->reset();
        } catch (\Exception $e) {
            Log::alert("message".$e->getMessage());
            Session::flash('error', $e->getMessage());
        }
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.employee.employee-import');
    }
}
