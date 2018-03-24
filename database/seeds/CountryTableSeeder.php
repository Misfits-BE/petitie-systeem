<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Misfits\Repositories\CountryRepository;

/**
 * Class CountryTableSeeder
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 */
class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param  CountryRepository $countries DB wrapper for the countries
     * @return void
     */
    public function run(CountryRepository $countries): void
    {
        // Truncate table before seeding 
        // ----------------------------------
        $table = DB::table('countries');
        $table->delete();

        // Seed database table. 
        $client  = new GuzzleHttp\Client();
        $request = $client->request('GET', 'https://restcountries.eu/rest/v2/all');

        foreach (json_decode($request->getBody()) as $country) { // Loop through the API output
            $countries->create(['name' => $country->name, 'iso_2_code' => strtolower($country->alpha2Code)]);
        } // End loop
    }
}
