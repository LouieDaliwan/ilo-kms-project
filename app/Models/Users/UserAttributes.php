<?php

namespace App\Models\Users;

trait UserAttributes
{
    public function getFullnameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
