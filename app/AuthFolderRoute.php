<?php

namespace App;

class AuthFolderRoute extends FolderRoute
{
    protected function middleware(): array
    {
        return ['auth:sanctum'];
    }

    protected function path(): string
    {
        return 'routes/api/auth';
    }
}
