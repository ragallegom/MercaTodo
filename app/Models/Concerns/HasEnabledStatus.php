<?php

namespace App\Models\Concerns;

trait HasEnabledStatus
{
    public function isEnabled(): bool
    {
        return ! $this->isDisabled();
    }

    public function isDisabled(): bool
    {
        return (bool) $this->disable_at;
    }
}
