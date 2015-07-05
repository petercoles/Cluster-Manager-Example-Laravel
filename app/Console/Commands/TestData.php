<?php

namespace App\Console\Commands;

use Storage;
use SplTempFileObject;
use Illuminate\Console\Command;
use League\Csv\Writer;

class TestData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test-data {size=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a csv test data file.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $size = (int) $this->argument('size');

        $documents = factory('App\Models\Document', $size)->make()->toArray();

        $headers = array_keys($documents[0]);

        $csv = Writer::createFromFileObject(new SplTempFileObject());
        $csv->insertOne($headers);
        $csv->insertAll($documents);

        Storage::put('testdata/test-'.$size.'.csv', $csv);
    }
}
