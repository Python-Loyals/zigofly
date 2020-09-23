<?php


namespace App\Services;

use Ixudra\Curl\Facades\Curl;

class ProductsService
{
    public static function getProducts($search_term){
        return Curl::to('https://amazon-product-reviews-keywords.p.rapidapi.com/product/search')
            ->withData( array( 'category' => 'aps', 'country' => 'US', 'keyword' => $search_term,) )
            ->withHeader('x-rapidapi-host: amazon-product-reviews-keywords.p.rapidapi.com')
            ->withHeader('x-rapidapi-key: '.$_ENV['RAPID_API_KEY'])
            ->get();
    }

    public static function getSingleProduct($asin)
    {
        return Curl::to('https://amazon-product-reviews-keywords.p.rapidapi.com/product/details')
            ->withData( array( 'country' => 'US', 'asin' => $asin) )
            ->withHeader('x-rapidapi-host: amazon-product-reviews-keywords.p.rapidapi.com')
            ->withHeader('x-rapidapi-key: '.$_ENV['RAPID_API_KEY'])
            ->get();
    }
}
