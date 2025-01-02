<?php

namespace Artistfy\Kontor;

use Saloon\Http\Connector;

class Kontor extends Connector
{
    use HandlesAuthentication;

    public function __construct(
        private string $user,
        private string $password,
        private bool $autoAuthenticate = true,
    ) {}

    public function resolveBaseUrl(): string
    {
        return 'https://dmb.kontornewmedia.com/api/v1';
    }
}
