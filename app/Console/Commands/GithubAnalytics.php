<?php

/*
 * This file is part of devhub.io.
 *
 * (c) DevelopHub <master@devhub.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Console\Commands;

use App\Entities\Repos;
use App\Entities\ReposContributor;
use App\Entities\ReposLanguage;
use App\Entities\ReposTag;
use App\Entities\ReposTree;
use App\Entities\Service;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GithubAnalytics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devhub:github:analytics {page} {perPage}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Github Analytics';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $page = $this->argument('page');
        $perPage = $this->argument('perPage');
        $repos = Repos::query()->select(['id', 'owner', 'repo'])->where('status', true)->orderBy('analytics_at', 'asc')
            ->orderBy('stargazers_count', 'desc')->forPage($page, $perPage)->get();
        foreach ($repos as $item) {
            try {
                $job = new \App\Jobs\GithubAnalytics(3, $item->id);
                $job->handle();

                $this->info($item->id);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
        }
    }
}
