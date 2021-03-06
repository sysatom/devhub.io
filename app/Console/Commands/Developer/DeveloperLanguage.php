<?php

/*
 * This file is part of devhub.io.
 *
 * (c) sysatom <sysatom@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Console\Commands\Developer;

use DB;
use Illuminate\Console\Command;

class DeveloperLanguage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devhub:developer:language';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Developer Analytics Language';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $developers = DB::table('developer')->select(['id', 'login'])->get();
        foreach ($developers as $developer) {
            $developer_languages = [];
            $repos = DB::table('repos')->select(['id'])->where('owner', $developer->login)->get();
            foreach ($repos as $repo) {
                $languages = DB::table('repos_languages')->where('repos_id', $repo->id)->get();
                foreach ($languages as $language) {
                    $developer_languages[$language->language] = (empty($developer_languages[$language->language]) ? 0 : $developer_languages[$language->language]) + $language->bytes;
                }
            }

            DB::table('developer_languages')->where('developer_id', $developer->id)->delete();
            foreach ($developer_languages as $developer_language => $developer_language_bytes) {
                DB::table('developer_languages')->insert([
                    'developer_id' => $developer->id,
                    'language' => $developer_language,
                    'bytes' => $developer_language_bytes,
                ]);
            }
            $this->info("Developer: $developer->id $developer->login");
        }
        $this->info('All done!');
    }
}
