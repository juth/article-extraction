<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goose\Client as GooseClient;

/**
 *  Used to test article scraping/extraction
 *
 *  @author  Steve Juth
 */
class TestArticle extends Command {

    /**
     *  Name and signature of the console command
     *
     *  @var string
     */
    protected $signature = 'test:article';

    /**
     *  Console command description
     *
     *  @var string
     */
    protected $description = 'Test article scraping and extraction';


    /**
     *  Executes the console command
     *
     *  @return mixed
     */
    public function handle() {
        
        $goose = new GooseClient();
        $article = $goose->extractContent(
            'https://www.road2college.com/15-best-paying-part-time-jobs-for-high-school-students/');

        $title = $article->getTitle();
        echo "Title: $title\n";

        $description = $article->getMetaDescription();
        echo "Description: $description\n";

        $keywords = $article->getMetaKeywords();
        echo "Keywords: $keywords\n";

        $tags = implode(', ', $article->getTags());
        echo "Tags: $tags\n";

        $text = $article->getCleanedArticleText();
        echo "Text: $text\n";

        $popWords = implode(', ', $article->getPopularWords());
        echo "Popular Words: $popWords\n";
    }
}
