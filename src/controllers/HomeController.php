<?php
// // Include the necessary models
// require_once __DIR__ . '/../models/HomepageHeader.php';
// require_once __DIR__ . '/../models/Room.php';
// require_once __DIR__ . '/../models/Activity.php';
// require_once __DIR__ . '/../models/Review.php';
// class HomeController
// {
//     public function index()
//     {
//         // Fetch data
//         $header = HomepageHeader::getHeader();
//         $featuredRooms = Room::getFeaturedRooms();
//         $featuredActivities = Activity::getFeaturedActivities();
//         $featuredReviews = Review::getFeaturedReviews();

//         // If no data is found, set a message
//         if (!$header) {
//             $header = ['IMAGE' => 'default.jpg', 'OVERLAY_TEXT' => 'Welcome to Riad Room Booking'];
//         }

//         // Pass data to the view
//         include __DIR__ . '/../views/home.php';
//     }
// }
