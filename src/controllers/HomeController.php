<?php

require_once __DIR__ . '/../models/Home.php';

class HomeController
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new Home();
    }

    public function index()
    {
        try {
            // Fetch homepage data
            $homepageHeader = $this->homeModel->getHomepageHeader();
            // $featuredReviews = $this->homeModel->getFeaturedReviews();
            $featuredActivities = $this->homeModel->getFeaturedActivities();
            $featuredRooms = $this->homeModel->getFeaturedRooms();

            // Include the view and pass data
            include __DIR__ . '/../views/home.php';
        } catch (Exception $e) {
            // Handle any errors and display them
            echo "Error: " . $e->getMessage();
        }
    }
}
