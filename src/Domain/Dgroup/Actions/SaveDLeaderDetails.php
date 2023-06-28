<?php

namespace Domain\Dgroup\Actions;

use App\Models\User;

class SaveDLeaderDetails
{
    /**
     * It Saves the dgroup details
     */
    public function __invoke(User $user, array $attributes = null) : User
    {
        try {
            $user->dgroup()->updateOrCreate([
                'day' => $attributes['day'] ?? null,
                'start_date' => $attributes['start_date'] ?? null,
                'life_stage_type' => $attributes['life_stage_type'] ?? null,
                'start_time' => $attributes['start_time'] ?? null,
                'end_time' => $attributes['end_time'] ?? null,
            ]);

            return $user;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
