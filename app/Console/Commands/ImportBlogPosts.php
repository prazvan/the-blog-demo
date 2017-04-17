<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\Aggregator\Aggregator;

/**
 * Class ImportBlogPosts
 * @package App\Console\Commands
 */
class ImportBlogPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:blog-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Blog Posts from the API and store them for 24h';
    /**
     * @var Aggregator
     */
    private $aggregator;

    /**
     * Create a new command instance.
     *
     * @param Aggregator $aggregator
     */
    public function __construct(Aggregator $aggregator)
    {
        parent::__construct();

        $this->aggregator = $aggregator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        try {

            $this->info('Aggregating posts...');

            $posts_collection = $this->aggregator->run();

            $this->info("{$posts_collection->count()} Posts saved!");

        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}
