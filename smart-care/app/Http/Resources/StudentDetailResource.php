<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDetailResource extends JsonResource
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
            'nickname' => $this->nickname,
            'profile_image' => $this->profile_image,
            'class' => $this->classroom->name,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'parent' => [
                'name' => $this->parent->name,
                'date_of_birth' => $this->parent->date_of_birth,
                'gender' => $this->parent->gender,
                'address' => $this->address,
                'phone' => $this->phone_number,
                'email' => $this->email
            ]
        ];
    }
}
