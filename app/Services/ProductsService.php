<?php


namespace App\Services;

use Ixudra\Curl\Facades\Curl;

class ProductsService
{
    public static function getProducts($search_term){
        return Curl::to('https://amazon-product-reviews-keywords.p.rapidapi.com/product/search')
            ->withData( array( 'category' => 'aps', 'country' => 'US', 'keyword' => $search_term,) )
            ->withHeader('x-rapidapi-host: amazon-product-reviews-keywords.p.rapidapi.com')
            ->withHeader('x-rapidapi-key: 63747f3104msh21bdd23b3f4aeeep149c10jsn91ab9dc657b6')
            ->get();
    }

    public static function getSingleProduct($asin)
    {
        return Curl::to('https://amazon-product-reviews-keywords.p.rapidapi.com/product/details')
            ->withData( array( 'country' => 'US', 'asin' => $asin) )
            ->withHeader('x-rapidapi-host: amazon-product-reviews-keywords.p.rapidapi.com')
            ->withHeader('x-rapidapi-key: 129ff3216emsh18b5ec5d832e6a4p15e6f7jsn29cdd90e8062')
            ->get();
    }
}
