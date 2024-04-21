<?php

namespace App\Attributes;

use ReflectionEnum;

trait AttributableEnum
{
    public function __call(string $name, array $arguments): mixed
    {
        $reflection = new ReflectionEnum(static::class);
        $attributes = $reflection->getCase($this->name)->getAttributes();

        return array_shift($attributes)->newInstance()->get();
    }
}
