<?php

namespace App;


class ReservationRuleChecker
{
    private array $data;

    private array $rules;

    public static function make(): self
    {
        return new self();
    }

    public function forData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function forRules(array $rules): self
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
