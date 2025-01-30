<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\QueryException;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = Reader::createFromPath(database_path('seeders/data/uscities.csv'));
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        foreach ($records as $town) {
            try {
                Town::create(...$town);
            } catch (QueryException $exception) {
                Log::warning("TownSeeder: {$exception->getMessage()}");
            }
        }
    }
}
