<?php

namespace App;


use Illuminate\View\View;

interface Mail
{
    public function make(): View;
}
