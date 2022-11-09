<?php

namespace App\Actions\Fortify;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'teacher_name' => ['string', 'max:255', 'unique:teachers,name'],
        ])->validate();

        DB::beginTransaction();
        try {
            // ユーザーの登録
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            // 教師情報の登録
            if (isset($input['teacher_name'])) {
                Teacher::create([
                    'user_id' => $user->id,
                    'name' => $input['teacher_name'],
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        return $user;
    }
}
