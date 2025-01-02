<?php

namespace Artistfy\Kontor\Requests;

use Saloon\Contracts\Authenticator;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Auth\NullAuthenticator;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasFormBody;
use Saloon\Traits\Plugins\AcceptsJson;

class GetClientCredentialsTokenRequest extends Request implements HasBody
{
    use AcceptsJson;
    use HasFormBody;

    /**
     * Define the method that the request will use.
     */
    protected Method $method = Method::POST;

    public function __construct(protected OAuthConfig $oauthConfig)
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return $this->oauthConfig->getTokenEndpoint();
    }

    public function defaultBody(): array
    {
        return [
            'user' => $this->oauthConfig->getClientId(),
            'pass' => $this->oauthConfig->getClientSecret(),
        ];
    }

    /**
     * Default authenticator used.
     */
    protected function defaultAuth(): ?Authenticator
    {
        return new NullAuthenticator;
    }
}
