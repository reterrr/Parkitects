<?php

namespace App;


abstract class ReservationTimeRuleChecker
{
    protected array $data = [];

    protected array $rules = [];

    public static function make(): static
    {
        return new static();
    }

    public function forData(array $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function forRules(array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    public function validate(): void
    {
        foreach ($this->rules as $rule)
            $rule->validate($this->data);
    }
}
