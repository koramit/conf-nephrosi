<?php

namespace App\APIs;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LINELoginAPI
{
    protected ?string $id;

    protected ?string $name;

    protected ?string $nickname;

    protected ?string $email;

    protected ?string $avatar;

    protected ?string $status;

    public function redirect(): RedirectResponse
    {
        $configs = config('services.line');
        $url = $configs['auth_url'];
        $url .= '&client_id='.$configs['channel_id'];
        $url .= '&redirect_uri='.route($configs['redirect_uri']);
        $url .= '&state='.csrf_token();
        $url .= '&scope=profile openid email';
        $url .= '&nonce='.Str::random(10);

        return redirect()->to($url);
    }

    /**
     * @throws Exception
     */
    public function __invoke(array $data): void
    {
        if (isset($data['error'])) {
            throw new Exception('LINE LOGIN: access denied => '.$data['error_description']);
        }

        if (! isset($data['code'])) {
            throw new Exception('LINE LOGIN: Callback response error');
        }

        // access granted then fetch access token
        $configs = config('services.line');
        $response = Http::asForm()->post(
            $configs['access_token_url'],
            [
                'grant_type' => 'authorization_code',
                'code' => $data['code'],
                'redirect_uri' => route($configs['redirect_uri']),
                'client_id' => $configs['channel_id'],
                'client_secret' => $configs['channel_secret'],
            ]
        );

        if (! $response->successful()) {
            throw new Exception('LINE LOGIN: fetch access token error => '.$response->body());
        }

        $profile = explode('.', $response->json()['id_token'])[1]; // => JWT body
        $profile = json_decode(base64_decode($profile), true);
        $this->name = $profile['name'] ?? null;
        $this->email = $profile['email'] ?? null;
        $this->avatar = $profile['picture'] ?? null;

        // fetch profile for other users stuffs
        $response = Http::withToken($response->json()['access_token'])->get($configs['profile_url']);

        if (! $response->successful()) {
            throw new Exception('LINE LOGIN: fetch profile error => '.$response->body());
        }

        $profile = $response->json();
        $this->id = $profile['userId'];
        $this->nickname = $profile['displayName'] ?? null;
        $this->status = $profile['statusMessage'] ?? null;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }
}
