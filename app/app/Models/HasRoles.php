<?php

namespace App\Models;

use App\Models\Role;
trait HasRoles
{

    /**
     * Get the role that owns the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Assign a role to the user.
     *
     * @param  \App\Models\Role|string|int  $role
     * @return void
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */

    public function assignRole($role)
    {
        $this->role_id = Role::whereRole($role)->first()->id;
        $this->save();
    }


    public function hasRole(string $role): bool
    {
        return $this->role?->name === $role;
    }
}