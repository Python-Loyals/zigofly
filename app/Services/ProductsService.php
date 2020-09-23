<?php


namespace App\Services;

use Ixudra\Curl\Facades\Curl;

class ProductsService
{
    public static function getProducts($search_term){
        $response = Curl::to('https://amazon-product-reviews-keywords.p.rapidapi.com/product/search')
            ->withData( array( 'category' => 'aps', 'country' => 'US', 'keyword' => $search_term,) )
            ->withHeader('x-rapidapi-host: amazon-product-reviews-keywords.p.rapidapi.com')
            ->withHeader('x-rapidapi-key: 63747f3104msh21bdd23b3f4aeeep149c10jsn91ab9dc657b6')
            ->get();

        return $response;
    }
}
