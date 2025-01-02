<?php

namespace Artistfy\Kontor;

use Artistfy\Kontor\Requests\GetClientCredentialsTokenRequest;
use Saloon\Contracts\Authenticator;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Auth\AccessTokenAuthenticator;
use Saloon\Http\Request;
use Saloon\Traits\OAuth2\ClientCredentialsGrant;

/**
 * @property-read string $user
 * @property-read string $password
 * @property-read bool $autoAuthenticate
 */
trait HandlesAuthentication
{
    use ClientCredentialsGrant;

    protected ?string $accessToken = null;

    protected function defaultAuth(): ?Authenticator
    {
        if (!$this->autoAuthenticate) {
            return null;
        }

        if ($this->accessToken) {
            return $this->createOAuthAuthenticator($this->accessToken);
        }

        /** @var AccessTokenAuthenticator $accessTokenAuthenticator */
        $accessTokenAuthenticator = $this->getAccessToken();

        $this->accessToken = $accessTokenAuthenticator->getAccessToken();

        return $accessTokenAuthenticator;
    }

    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId($this->user)
            ->setClientSecret($this->password)
            ->setTokenEndpoint('/users/auth');
    }

    /**
     * Resolve the access token request
     */
    protected function resolveAccessTokenRequest(OAuthConfig $oauthConfig): Request
    {
        return new GetClientCredentialsTokenRequest($oauthConfig);
    }
}
