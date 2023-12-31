<?php
    return [
        'base_uri' => env('SSO_BASE_URI'),
        'authorize' => [
            'endpoint' => env('SSO_AUTHORIZE_ENDPOINT', 'authorize'),
            'grant_type' => env('SSO_AUTHORIZE_GRANT_TYPE', 'authorization_code'),
            'response_type' => env('SSO_AUTHORIZE_RESPONSE_TYPE', 'code'),
            'client_id' => env('SSO_AUTHORIZE_CLIENT_ID', ''),
            'scope' => env('SSO_AUTHORIZE_SCOPE', 'profile openid gateway jabatan.hris'),
            'nonce' => env('SSO_AUTHORIZE_NONCE', '123456'),
            'state' => env('SSO_AUTHORIZE_STATE', '123456'),
            'redirect_uri' => env('SSO_AUTHORIZE_REDIRECT_URI')
        ],
        'token' => [
            'endpoint' => env('SSO_TOKEN_ENDPOINT', 'token'),
            'client_secret' => env('SSO_TOKEN_CLIENT_SECRET', '')
        ],
        'userinfo' => [
            'endpoint' => env('SSO_USERINFO_ENDPOINT', 'userinfo')
        ],
        'endsession' => [
            'endpoint' => env('SSO_ENDSESSION_ENDSESSION', 'endsession')
        ]
    ];