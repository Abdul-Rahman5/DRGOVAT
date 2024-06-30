<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VitalSingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'VitalSigns_id' =>$this->id,
            'heart_rate' =>$this->heart_rate,
            'blood_pressure' =>$this->blood_pressure,
            'respiratory_rate' =>$this->respiratory_rate,
            'oxygen_saturation' =>$this->oxygen_saturation,
            'end_tidal_carbon' =>$this->end_tidal_carbon,
            'temperature' =>$this->temperature,
            'electrocardiogram' =>$this->electrocardiogram,
        ];
    }
}
