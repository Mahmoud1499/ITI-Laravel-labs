<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class threePostsOnlyForOneUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $user = User::find($value);
        // dd($user->posts);
        if ($user->posts->count() >= 3) {
            $fail("Sorry, Max three posts for user only ");
        }
    }
}
