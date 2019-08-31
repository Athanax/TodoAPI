<?php

namespace App\Http\Controllers\Api;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);

        // $user = User::firstOrNew(['email'=>$request->email]);
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = bcrypt($request->password);

        // $user->save();

        $http = new Client;
        // return url('oauth/token');
        // return response(['data'=>$user]);

        $response = $http->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'x95CPwksKqgU4GTxUMxqfqobJ2tuDnCq0nGtcRsh',
                'username'=>'athanas@gmail.com',
                'password'=>'athanas1',
                'scope' => '',
            ],
        ]);

        return response(['data'=>json_decode((string) $response->getBody(), true)]);
    }
}
