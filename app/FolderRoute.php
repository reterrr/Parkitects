<?php

namespace App;

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use SplFileInfo;

abstract class FolderRoute
{
    protected final function register(SplFileInfo $file): void
    {
        $route = static::options();
        $route->group($file->getRealPath());

        //if ($this instanceof AuthFolderRoute)
          //  dd($route);
    }

    public final function registerRoutes(): void
    {
        $files = collect(File::files(base_path($this->path())));
        $folders = collect(File::allFiles(base_path($this->path())))->diff($files);

        $folders->each(fn(SplFileInfo $file) => self::register($file));
        $files->each(fn(SplFileInfo $file) => self::register($file));
    }

    protected function prefix(): string
    {
        return '';
    }

    protected function middleware(): array
    {
        return [];
    }

    protected final function options(): RouteRegistrar
    {
        $route = Route::prefix(static::prefix());

        $route->middleware(static::middleware());

        return $route;
    }

    protected abstract function path(): string;
}
