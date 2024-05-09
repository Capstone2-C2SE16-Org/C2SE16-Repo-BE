<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'manager_id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'date_of_birth' => $this->date_of_birth,
            'email' => $this->email,
            'gender' => $this->gender,
            'profile_image' => $this->profile_image,
            'phone_number' => $this->phone_number,
            'username' => $this->username,
            'is_enable' => $this->is_enable,
            'token' => $this->createToken("Token")->plainTextToken,
            'role' => $this->roles->pluck('name') ?? [],
            'roles.permissions' => $this->getPermissionsViaRoles()->pluck(['name']) ?? [],
            'permissions' => $this->permissions->pluck('name') ?? []
        ];
    }
}
