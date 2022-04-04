<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    private $_url = [];

    public function __construct()
    {
        $this->_url = config('serversurl');
    }

    public function showRegisterPage()
    {
        return view('register');
    }

    public function showLoginPage()
    {
        return view('login');
    }

    public function doRegister()
    {
    }

    public function doLogin(Request $request)
    {
        $postData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:16',
        ]);

        $client = new Client();
        $response = $client->request('POST', $this->_url['login'], [
            'header' => [
                'Accept' => 'application/json',
            ],
            'form_params' => [
                'email' => $postData['email'],
                'password' => $postData['password'],
            ],
        ]);
        $statusCode = $response->getStatusCode();
        $rsp = $response->getBody()->getContents();
        dd($rsp);
    }
}
