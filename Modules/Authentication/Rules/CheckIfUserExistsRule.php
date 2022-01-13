<?php
namespace Modules\Authentication\Rules;

use Illuminate\Contracts\Validation\Rule;
use Modules\Authentication\Models\User;

class CheckIfUserExistsRule implements Rule
{

    public function __construct()
    {

    }

    public function passes($attribute, $value)
    {
        if(User::where('email',$value)->exists())
            return true;
        return false;
    }

    public function message()
    {
        return 'Email or Password is wrong';
    }
}
