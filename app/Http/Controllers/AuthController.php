<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use \Illuminate\Validation\Validator as Validator;

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
        } catch (ClientException $e) {
            report($e);
            return redirect('/login')->withErrors('sdf', 'email')->withInput();
        }

        if ($statusCode === 200) {
            $userData = json_decode($rsp, TRUE);
            return response()->redirectTo('/index')->cookie('_cyouho', $userData['session'], 60);
        } else {
            return back()->withInput()->withErrors('sdf', 'email');
        }
    }
}
