<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactBookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'height' => $this->height,
            'weight' => $this->weight,
            'blood_group' => $this->blood_group,
            'blood_pressure' => $this->blood_pressure,
            'vision_test' => $this->vision_test,
            'allergies' => $this->allergies,
            'total_absences' => $this->total_absences,
            'good_behavior_certificates' => $this->good_behavior_certificates,
            'comment' => $this->comment,
            'student_id' => $this->student_id,
        ];
    }
}
