<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactBookDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'student_name' => $this->student->name,
            'nickname' => $this->student->nickname,
            'date_of_birth' => $this->student->date_of_birth,
            'profile_image' => $this->student->profile_image,
            'classroom' => $this->student->classroom->name,
            'health_information' => [
                'height' => $this->height,
                'weight' => $this->weight,
                'blood_group' => $this->blood_group,
                'blood_pressure' => $this->blood_pressure,
                'vision_test' => $this->vision_test,
                'allergies' => $this->allergies,
            ],
            'total_absences' => $this->total_absences,
            'good_behavior_certificates' => $this->good_behavior_certificates,
            'comment' => $this->comment
        ];
    }
}
