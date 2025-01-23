<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail($email)
    {
        return User::where("email", $email)->first();
    }

    /**
     * @param $dataDto
     * @return mixed
     */
    public function createResetPassword($dataDto)
    {
        $existing = DB::table('password_reset_tokens')
            ->where('email', $dataDto['email'])
            ->first();

        if ($existing) {
            DB::table('password_reset_tokens')
                ->where('email', $dataDto['email'])
                ->update($dataDto);
        } else {
            // Insert if not exists
            DB::table('password_reset_tokens')->insert($dataDto);
        }

        return DB::table("password_reset_tokens")->where("email", $dataDto["email"])->first();
    }

    /**
     * @param $token
     * @return mixed
     */
    public function findByToken($token)
    {
        return DB::table("password_reset_tokens")->where("token", $token)->first();
    }

    public function findByOtp($otp)
    {
        return User::where("otp", $otp)->first();
    }

    public function resetDataPassword($email)
    {
        return DB::table("password_reset_tokens")->where("email", $email)->delete();
    }
}