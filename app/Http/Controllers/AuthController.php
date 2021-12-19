<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\BaseController;

class AuthController extends BaseController
{

    public function auth()
    {
        $authheader = \request()->header('Authorization'); // basic xxxbase64encodexx
        $keyauth = substr($authheader, 6); // hilangkan text basic

        $plainauth = base64_decode($keyauth); //decode text info login
        $tokenauth = explode(':', $plainauth); // pisahkan email:passowrd

        $email = $tokenauth[0]; //email
        $password = $tokenauth[1]; //passowrd


        $data = (new Customer())->newQuery()
            ->where(['email' => $email])
            ->get(['id', 'first_name', 'last_name', 'email', 'password'])->first();

        if ($data == null) {
            return $this->out(
                status: 'Gagal',
                code: 404,
                error: ['Pengguna Tidak Di Temukan']
            );
        } else {
            if (Hash::check($password, $data->password)) {
                $data->token = hash('sha256', Str::random(10)); //kirim token ke client
                unset($data->password); // hilangkan password pada pengrimin token ke client
                $data->update(); // update token
                return $this->out(
                    data: $data,
                    status: 'OK'
                );
            } else {
                return $this->out(
                    status: "GAGAL",
                    code: 401,
                    error: ["tidak memiliki wewenang"]
                );
            }
        }
    }
}
