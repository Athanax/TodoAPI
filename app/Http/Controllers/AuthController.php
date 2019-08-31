<?php

namespace App\Http\Controllers;

use App\User;
use Throwable;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * this method will recieve data in json form and perform authenication
     */
    public function client()
    {
        $client=DB::table('oauth_clients')->where('id', 2)->first();

        // return $client->secret;

        return response([
            'data'=>[
                'clientId'=>$client->id,
                'clientSecret'=>$client->secret
            ]
        ]);
    }
    /**
     * this controller will recieve data in json format and register new users
     */
    public function register()
    { }
}
