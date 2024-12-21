<nav class="navbar">
    <div class="container">
        <!-- Logo -->
        <a href="/riad-room-booking/public/index.php?page=home" class="navbar-brand">
            <img src="/riad-room-booking/public/images/logo.png" alt="Riad Room Booking" class="logo">
        </a>

        <!-- Navigation Links -->
        <ul class="navbar-menu">
            <li><a href="/riad-room-booking/public/index.php?page=home">Home</a></li>
            <li><a href="/riad-room-booking/public/index.php?page=rooms">Rooms</a></li>
            <li><a href="/riad-room-booking/public/index.php?page=activities">Activities</a></li>
            <li><a href="/riad-room-booking/public/index.php?page=about">About Us</a></li>
            <li><a href="/riad-room-booking/public/index.php?page=contact">Contact</a></li>
        </ul>

        <!-- User Authentication Links -->
        <div class="navbar-auth">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/riad-room-booking/public/index.php?page=profile" class="auth-link">Profile</a>
                <a href="/riad-room-booking/public/index.php?page=logout" class="auth-link">Logout</a>
            <?php else: ?>
                <a href="/riad-room-booking/public/index.php?page=login" class="auth-link">Login</a>
                <a href="/riad-room-booking/public/index.php?page=register" class="auth-link">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

