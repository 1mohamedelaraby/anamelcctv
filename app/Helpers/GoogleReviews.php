<?php

namespace App\Helpers;

use App\GoogleReview;
use Illuminate\Support\Facades\Http;

class GoogleReviews
{
    public $reviews;
    public $reviewsTotal;
    public $avgRating;

    public function __construct()
    {
        // Get latest time from our database
        $time = GoogleReview::max('time');

        // get latest reviews from google API
        $response = Http::get('https://maps.googleapis.com/maps/api/place/details/json?placeid=ChIJ70shnFWrLz4R7hEKDegBlxQ&key=AIzaSyCxPxyk_wzEmobhpJ6lctPNPg87mFEcOfE');
        // total reviews
        $this->reviewsTotal = $response->json()['result']['user_ratings_total'];
        // Average Ratings
        $this->avgRating = $response->json()['result']['rating'];
        // filter to get newer reviews only 
        $reviews = collect($response->json()['result']['reviews'])->where('time', '>', $time)->toArray();

        // Insert new reviews in our databse
        foreach ($reviews as $review) {
            GoogleReview::create($review);
        }

        $this->reviews = GoogleReview::all();
    }
}
