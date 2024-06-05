<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LearningScheduleResource extends JsonResource
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
            'name' => $this->name,
            'date' => $this->date,
            'morning_activities' => $this->morning,
            'noon_activities' => $this->noon,
            'afternoon_activities' => $this->afternoon,
        ];
    }
}
