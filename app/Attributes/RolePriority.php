<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS_CONSTANT)]
class RolePriority extends AttributeProperty
{
    public function __construct(public int $value)
    {
        parent::__construct($value);
    }

    public function get(): int
    {
        return $this->value;
    }
}
