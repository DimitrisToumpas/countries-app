<?php

namespace App\Contracts;

interface CountryProvider
{
    /** @return array<int, array{name: string, flag: string}> */

    public function allCountries(): array;
}
