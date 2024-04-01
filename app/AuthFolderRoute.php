<?php

namespace App;

class AuthFolderRoute extends FolderRoute
{
    protected function middleware(): array
    {
        return ['api', 'auth:sanctum'];
    }

    protected function path(): string
    {
        return 'routes/api/auth';
    }

    protected function prefix(): string
    {
        return 'api';
    }
}
