<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class SsoController extends Controller
{
    public function redirect()
    {
        $uri = config('sso.base_uri').config('sso.authorize')['endpoint'];
        $grant_type = config('sso.authorize')['grant_type'];
        $response_type = config('sso.authorize')['response_type'];
        $client_id = config('sso.authorize')['client_id'];
        $scope = config('sso.authorize')['scope'];
        $nonce = config('sso.authorize')['nonce'];
        $state = config('sso.authorize')['state'];
        $redirect_uri = config('sso.authorize')['redirect_uri'];
        $session_url = $uri.'?grant_type='.$grant_type.'&response_type='.$response_type.'&client_id='.$client_id.'&scope='.$scope.'&nonce='.$nonce.'state='.$state.'&redirect_uri='.$redirect_uri;

        return redirect($session_url);
    }

    public function callback(Request $request)
    {
        if ($request)
        {
            $responseCode = Http::asForm()->post(config('sso.base_uri').config('sso.token')['endpoint'],[
                'client_id' => config('sso.authorize')['client_id'],
                'grant_type' => config('sso.authorize')['grant_type'],
                'client_secret' => config('sso.token')['client_secret'],
                'code' => $request->code,
                'redirect_uri' => config('sso.authorize')['redirect_uri']
            ]);
            $token =  json_decode($responseCode->getBody()->getContents(), false);

            if (isset($token->access_token))
            {
                $responseToken = Http::asForm()->post(config('sso.base_uri').config('sso.userinfo')['endpoint'],[
                    'access_token' => $token->access_token,
                ]);

                if ($responseToken)
                    {
                        $userInfo =  json_decode($responseToken->getBody()->getContents(), false);

                        $user = User::updateOrCreate([
                            'nama' => $userInfo->name,
                            'nip' => $userInfo->nip,
                            // 'password' => Hash::make($userInfo->nip),
                            'kode_satker' => $userInfo->kode_satker,
                        ]);

                        Auth::login($user);
                        Session::regenerate();
                        Session::put('userInfo', $userInfo);
                        return redirect()->intended('/home');
                    }

                    dd("response tidak ada!");
            }

            dd("token tidak ada!");
        }

        dd("request code tidak ada!");
    }


    public function signout(Request $request)
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();

        $uri = config('sso.base_uri') . config('sso.endsession.endpoint');
        $id_token = Session::get('id_token');
        $post_logout_redirect_uri = config('sso.authorize.redirect_uri');
        $state = config('sso.authorize.state');
        $endsession_url = $uri . '?id_token_hint=' . $id_token . '&post_logout_redirect_uri=' . $post_logout_redirect_uri . '&state=' . $state;

        return redirect($endsession_url);
    }
}
