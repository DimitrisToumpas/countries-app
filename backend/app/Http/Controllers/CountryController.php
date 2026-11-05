<?php

namespace App\Http\Controllers;

use App\Contracts\CountryProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(
        private CountryProvider $countryProvider
    ) {}

    public function index()
    {
        $countries = Cache::remember(
            'countries.all',
            now()->addHours(6),
            fn() => $this->countryProvider->allCountries()
        );

        return response()->json($countries);
    }
}
