<?php

namespace App;

use App\Attributes\AttributeProperty;
use http\Exception\BadMethodCallException;
use Illuminate\Support\Str;
use ReflectionAttribute;
use ReflectionEnum;

trait AttributableEnum
{
    public function __call(string $name, array $arguments): mixed
    {
        $reflection = new ReflectionEnum(static::class);
        $attributes = $reflection->getCase($this->name)->getAttributes();

        $filteredAttributes = array_filter($attributes, fn(ReflectionAttribute $attribute) => $attribute->getName() === AttributeProperty::BASE_PATH . Str::ucfirst($name));

        if (empty($filteredAttributes))
            throw new BadMethodCallException('Call to undefined method %s::%s()', static::class, $name);

        return array_shift($filteredAttributes)->newInstance()->get();
    }
}
