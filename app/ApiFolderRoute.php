<?php

namespace App;

class ApiFolderRoute extends FolderRoute
{
    protected function prefix(): string
    {
        return 'api';
    }

    protected function middleware(): array
    {
        return ['api'];
    }

    protected function path(): string
    {
        return 'routes/api';
    }
}
