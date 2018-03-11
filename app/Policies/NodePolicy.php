<?php

namespace App\Policies;

use App\Node;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NodePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can view the book.
     *
     * @param  \App\User  $user
     * @param  \App\Node  $node
     * @return mixed
     */
    public function view(User $user, Node $node)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can create books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  \App\User  $user
     * @param  \App\Node  $node
     * @return mixed
     */
    public function update(User $user, Node $node)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \App\User  $user
     * @param  \App\Node  $node
     * @return mixed
     */
    public function delete(User $user, Node $node)
    {
        return $this->isAdmin($user);
    }

    function isAdmin(User $user)
    {
        return $user->name == "admin";
    }
}
