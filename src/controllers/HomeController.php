<?php
include_once __DIR__ . '/../models/Home.php';

class HomeController
{
    // Home page controller
    public function index()
    {
        try {
            // Fetch the required data for the home page
            $headerData = Home::getHeaderData();  // Data for the header image and text
            $featuredActivities = Home::getFeaturedActivities();  // Featured activities
            $featuredRooms = Home::getFeaturedRooms();  // Featured rooms
            $featuredReviews = Home::getFeaturedReviews();  // Featured reviews

            // Pass the data to the view
            require_once __DIR__ . '/../views/home.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
