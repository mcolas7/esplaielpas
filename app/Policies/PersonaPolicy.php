<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Persona;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonaPolicy
{
    use HandlesAuthorization;

    

    /**
     * If the user's role is 1, then they can monitor
     * 
     * @param User user The user object that is currently logged in.
     */
    public function monitor(User $user) {

        return $user->rol_id == 1;
    }

    /**
     * If the user's role is 1, then the user can view the person
     * 
     * @param User user The currently authenticated user.
     * @param Persona persona The model instance passed to the policy's `update` method.
     * 
     * @return A boolean value.
     */
    public function show(User $user, Persona $persona) {

        return $user->rol_id == 1;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->rol_id == 1;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Persona $persona)
    {
        return $user->rol_id == 1;
    }

    /**
     * If the user is an admin, they can do anything. Otherwise, they can only edit their own profile
     * 
     * @param User user The currently authenticated user.
     * @param Persona persona The model instance passed to the policy's `update` method.
     * 
     * @return A boolean value.
     */
    public function tutor(User $user, Persona $persona) {
        if ($user->rol_id == 1) {
            return true;
        } else {
            if ($persona->persona_id == $user->persona_id) {
                return true;
            }
        }
    }

    /**
     * If the user is trying to change the password of the person that is logged in, then allow it
     * 
     * @param User user The currently authenticated user.
     * @param Persona persona The model instance passed to the policy's before callback.
     * 
     * @return a boolean value.
     */
    public function contrasenya(User $user, Persona $persona) {
        return $persona->persona_id == $user->persona_id;
    }

    /**
     * Only users with a role of 2 can inscriure.
     * 
     * @param User user The currently authenticated user.
     * @param Persona persona The model instance passed to the policy's `update` method.
     * 
     * @return A boolean value.
     */
    public function inscriure(User $user, Persona $persona) {
        return $user->rol_id == 2;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Persona $persona)
    {
        return $user->rol_id == 1;
    }
}
