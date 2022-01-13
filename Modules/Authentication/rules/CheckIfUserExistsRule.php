<?php
namespace Modules\Authentication\rules;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

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
