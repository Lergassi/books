<?php

namespace App;

use App\Traits\SelectItems;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use SelectItems;
}
