<?php

namespace App\Http\Controllers;

use App\Helpers\GoogleReviews;

class TestimonialController extends Controller
{
    public function index(GoogleReviews $googleReviews)
    {
        $reviews = $googleReviews->reviews->where('status', 1);
        $reviewsTotal = $googleReviews->reviewsTotal;
        $avgRating = $googleReviews->avgRating;
        return view('testimonials.index', compact('reviews', 'reviewsTotal', 'avgRating'));
    }
}
