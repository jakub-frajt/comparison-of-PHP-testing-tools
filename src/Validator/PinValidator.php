<?php

declare(strict_types=1);

namespace App\Validator;

class PinValidator
{
    private const LENGTH = 4;

    private const DISALLOWED_COMBINATIONS = [
        '1234', '4321'
    ];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @param string $value
     *
     * @return array errors
     */
    public function validate(string $value): array
    {
        if ($value === '') {
            $this->errors[] = 'PIN cannot be empty.';

            return $this->errors;
        }

        if (\strlen($value) !== self::LENGTH) {
            $this->errors[] = 'PIN must contains exactly four numbers.';

            return $this->errors;
        }

        if (preg_match('/\D/', $value)) {
            $this->errors[] = 'PIN must contains only numbers';
        }

        if (\in_array($value, self::DISALLOWED_COMBINATIONS, true)) {
            $this->errors[] = 'This combination is not allowed.';
        }

        return $this->errors;
    }
}
