<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "Patient_id" => $this->id,
            "name" => $this->name,
            "gender" => $this->gender,
            "age" => $this->age,
            "height" => $this->height,
            "weight" => $this->weight,
            "heart_state" => $this->heart_state,
            "hypertension" => $this->hypertension,
            "diabetes" => $this->diabetes,
            "full_half" => $this->full_half,
            "period_of_operation" => $this->period_of_operation,
            "operations" => $this->operations,
        ];
    }
}
