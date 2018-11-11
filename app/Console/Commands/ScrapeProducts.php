<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Product;

class ScrapeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrap Pruducts';

    /**
     * The list of funko collection slugs.
     *
     * @var array
     */
    protected $categories = [
        'dishwashers',
        'small-appliances',
    ];


    /**
     * Create a new command instance.
     *
     * @return void
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
      foreach ($this->categories as $category) {
        $this->scrape($category);
      }
    }

    /**
    * For scraping data for the specified collection.
    *
    * @param  string $collection
    * @return boolean
    */
   public static function scrape($category)
   {
       $crawler = Goutte::request('GET', env('SCRAP_URL').'/'.$category);
       $href=$crawler->filter('.result-list-pagination a:nth-last-child(1)')->attr('href');
       $pages=substr($href, strpos($href, 'page=')+5);

       for ($i = 0; $i < $pages + 1; $i++) {
           if ($i != 0) {
               $crawler = Goutte::request('GET', env('SCRAP_URL').'/'.$category.'?page='.$i);
           }

               $crawler->filter('.search-results-product')->each(function ($node, $category) {
                 $title = trim($node->filter('.product-description .row > div > h4')->text());
                 $href = $node->filter('.product-description .row > div > h4 > a')->attr('href');
                 $id= substr($href, strrpos($href, '/')+1);
                 $price= trim($node->filter('.product-description h3.section-title')->text());
                 $img = $node->filter('.product-image img')->attr('src');
                 $description = $node->filter('.product-description .result-list-item-desc-list')->text();

                 $product = new Product;
                 $product->real_id = $id;
                 $product->real_url = $href;
                 $product->title = $title;
                 $product->description = $description;
                 $product->price = $price;
                 $product->img_url = $img;
                 $product->save();
               });
       }
       return true;
   }
}
