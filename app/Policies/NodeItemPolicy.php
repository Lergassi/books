<?php

namespace App\Policies;

use App\NodeItem;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NodeItemPolicy
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
     * @param  \App\NodeItem  $nodeItem
     * @return mixed
     */
    public function view(User $user, NodeItem $nodeItem)
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
     * @param  \App\NodeItem  $nodeItem
     * @return mixed
     */
    public function update(User $user, NodeItem $nodeItem)
    {
        return $this->isAdmin($user);
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \App\User  $user
     * @param  \App\NodeItem  $nodeItem
     * @return mixed
     */
    public function delete(User $user, NodeItem $nodeItem)
    {
        return $this->isAdmin($user);
    }

    function isAdmin(User $user)
    {
//        die();
        return $user->name == "admin";
//        return true;
    }
}
