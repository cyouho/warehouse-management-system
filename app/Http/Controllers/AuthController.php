<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Cookie;

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

        try {
            $client = new Client();
            $response = $client->request('POST', $this->_url['login'], [
                'header' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'email' => $postData['email'],
                    'password' => $postData['password'],
                ],
                'http_errors' => FALSE, // api 会返回自己的错误信息，这些不计入 http 错误
            ]);
            $statusCode = $response->getStatusCode();
            $rsp = $response->getBody()->getContents();
            $response = json_decode($rsp, TRUE);
        } catch (ClientException $e) {
            report($e);
            return back();
        }

        if ($statusCode === 200) {
            $userData = json_decode($rsp, TRUE);
            return response()->redirectTo('/')->cookie('_cyouho', $userData['session'], 60);
        } else if ($response['api_status_code'] === 40401) {
            return back()->with('email', $response['message']);
        } else if ($response['api_status_code'] === 40402) {
            return back()->with('password', $response['message']);
        }
    }

    public function doLogout()
    {
        $cookie = Cookie::forget('_cyouho');
        return response()->redirectTo('/')->cookie($cookie);
    }
}
