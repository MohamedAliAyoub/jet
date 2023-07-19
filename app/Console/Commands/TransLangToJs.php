<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class TransLangToJs extends Command
{
    /**
     * The languages to be translated.
     *
     * @var array
     */
    protected $languages = [
        'ar',
        'en',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lang:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'translate language folder from php to js';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->output->progressStart(count($this->languages));

        foreach($this->languages as $lang) {

            app()->setLocale($lang);

            $path = lang_path($lang);

            $collection = collect(File::allFiles($path))->flatMap(function ($file, $lang) {
                return [
                    ($translation = $file->getBasename('.php')) => trans($translation,array(), null, $lang),
                ];
            });

            $data='export default ' . json_encode($collection->toArray());

            file_put_contents(resource_path("js/Locale/{$lang}_php.js"),
                $data
            );

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}
