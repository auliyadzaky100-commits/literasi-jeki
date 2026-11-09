<?php
namespace BitApps\BitConnect\Deps\BitApps\WPValidator\Rules;

use BitApps\BitConnect\Deps\BitApps\WPValidator\Helpers;
use BitApps\BitConnect\Deps\BitApps\WPValidator\Rule;

class RequiredRule extends Rule
{
    use Helpers;

    private $message = 'The :attribute field is required';

    public function validate($value): bool
    {
        return !$this->isEmpty($value);
    }

    public function message()
    {
        return $this->message;
    }
}
