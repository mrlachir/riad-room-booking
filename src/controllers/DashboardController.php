<?php

require_once __DIR__ . '/../../src/models/Dashboard.php';

class DashboardController {
    private $dashboard;

    public function __construct() {
        $this->dashboard = new Dashboard();
    }

    public function overview() {
        $statistics = $this->dashboard->getStatistics();
        $recentReviews = $this->dashboard->getRecentReviews();
        $recentBookings = $this->dashboard->getRecentBookings();

        // Load the overview view
        require_once __DIR__ . '/../../src/views/dashboard/overview.php';
    }
}
