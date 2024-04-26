<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class AttributeProperty
{
    public const BASE_PATH = 'App\Attributes\\';

    public function __construct(
        private readonly mixed $value
    ) {
    }

    public function get(): mixed
    {
        return $this->value;
    }
}
