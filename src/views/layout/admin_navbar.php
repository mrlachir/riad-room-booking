<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Hotel Management System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'DashboardOverview')? 'active' : '';?>" href="?page=DashboardOverview">Dashboard Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'HomePageManagement')? 'active' : '';?>" href="?page=HomePageManagement">Home Page Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'ManageActivities')? 'active' : '';?>" href="?page=ManageActivities">Manage Activities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'ManageRooms')? 'active' : '';?>" href="?page=ManageRooms">Manage Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'ManageUsers')? 'active' : '';?>" href="?page=ManageUsers">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'profile')? 'active' : '';?>" href="?page=profile">Profile</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <!-- Example for a logout link, adjust as needed -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>