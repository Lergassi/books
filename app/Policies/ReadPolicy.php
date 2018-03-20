<?php

namespace App\Policies;

use App\Book;
use App\Read;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReadPolicy
{
    use HandlesAuthorization;

    function isAdmin(User $user)
    {
        return $user->name == "admin";
    }

    public function read(User $user, Read $read)
    {
        if ($this->isAdmin($user)) {
            return true;
        } else {
            return $read->getBook()->isStatus(Book::STATUS_ACTIVE);
        }
    }
}
