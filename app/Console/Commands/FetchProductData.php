<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class FetchProductData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch products from external API and store in local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching product data from API...');

        DB::table('products')->truncate();
        //Fetch data from the external API
        $response = Http::withOptions([
            'verify' => false
        ])->timeout(60)->get('https://dummyjson.com/products');

        //check if the request was successful 
        if($response->successful()){
            $responseData = $response->json();
        
            //check if 'products' key exists in the response

            if (isset($responseData['products'])){
                $products = $responseData['products'];
           

            // Start a new ID for the products (e.g., start from 1)
        $newId = 1;

                foreach ($products as $index => $product) {
                    Product::create([
                        'id' => $newId++, 
                        'title' => $product['title'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'discountPercentage' => $product['discountPercentage'],
                        'rating' => $product['rating'] ?? 0,
                        'stock' => $product['stock'] ?? 0,
                        'brand' => $product['brand'] ?? 'Unknown Brand',
                        'category' => $product['category'] ?? 'Unknown Category',
                        'thumbnail' => $product['thumbnail'],
                        'images' => json_encode($product['images']),
                        'sort_order' => $index + 1, // Set the sort_order based on the index
                    ]);
            }

            $this->info('Product data Fetched and stored successfully!');
        }else{
            $this->error('Products key not found in the API response');
        }
        }else{
            $this->error('Failed to fetch product data from the API. Response status: '. $response->status());
            $productsCount = 0;
        }
    }
}
