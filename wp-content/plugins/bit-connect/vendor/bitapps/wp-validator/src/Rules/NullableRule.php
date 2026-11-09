<?php
namespace BitApps\BitConnect\Deps\BitApps\WPValidator\Rules;

use BitApps\BitConnect\Deps\BitApps\WPValidator\Rule;

class NullableRule extends Rule
{

    private $message = '';

    public function validate($value): bool
    {
        return true;
    }

    public function message()
    {
        return $this->message;
    }
}
