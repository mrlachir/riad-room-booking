<?php
include_once __DIR__ . '/../models/Activity.php';

class ActivityController
{
    public function index()
    {
        try {
            // Fetch all activities
            $activities = Activity::getAll();

            // Pass data to the view
            include __DIR__ . '/../views/activities.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function show($id)
    {
        try {
            // Fetch activity details by ID
            $activity = Activity::find($id);

            // Fetch recommended activities (excluding the current activity)
            $recommendedActivities = Activity::getRecommended($id);

            // Pass data to the view
            include __DIR__ . '/../views/activity.php';
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
