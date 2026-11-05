<?php

namespace App\Services;

use App\Contracts\CountryProvider;
use Illuminate\Support\Facades\Http;

class RestCountriesProvider implements CountryProvider
{
    private const PAGE_SIZE = 100;

    public function allCountries(): array
    {
        $countries = [];
        $offset = 0;

        do {
            $response = Http::withToken(config('services.restcountries.key'))
                ->timeout(10)
                ->get(config('services.restcountries.base_url'), [
                    'response_fields' => 'names.common,flag.url_svg',
                    'limit' => self::PAGE_SIZE, //ana 100 gt free plan
                    'offset' => $offset, // 1-100 meta 101-200 kai telos 201-254 , total 254 countries
                ])
                ->throw();

            $data = $response->json('data'); //kateu8eian to key data pairnw value "objects" pou exei values names : common kai flag : url_svg kai gia kapoio logo _meta

            foreach ($data['objects'] as $country) {
                $countries[] = [
                    'name' => $country['names']['common'],
                    'flag' => $country['flag']['url_svg'],
                ];
            }

            $offset += self::PAGE_SIZE;
        } while ($data['meta']['more']); // υπαρχει meta : more ,true: Υπάρχουν περισσότερες χώρες, συνέχισε.false: σταμάτα.

        return $countries;
    }
}
