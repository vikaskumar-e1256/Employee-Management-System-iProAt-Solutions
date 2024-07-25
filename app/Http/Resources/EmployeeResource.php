<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "contact_number" => $this->contact_number,
            "email" => $this->email,
            "date_of_birth" => $this->date_of_birth,
            "address" => $this->address,
            "employee_register_number" => $this->employee_register_number,
            "created_at" => $this->created_at->toDateString()
        ];
    }
}
