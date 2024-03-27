<?php

namespace App;

class RouteLoader
{
    /**
     * Create a new class instance.
     */

    /**
     * @return array<FolderRoute>
     */
    private function folders()
    {
        return [
            new ApiFolderRoute,
            new AuthFolderRoute,
        ];
    }

    public function register()
    {
        foreach($this->folders() as $folder)
        {
            $folder->registerRoutes();
        }
    }
}
