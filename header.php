<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<header class="site-main-header">

    <div class="nav-wrap">

        <!-- LOGO -->

        <a
            href="index.php"
            class="brand"
        >

            <span class="brand-icon">

                <img
                    src="images/daybbb .png"
                    alt="Azura Reef logo"
                >

            </span>

            <span class="brand-name">
                Azura Reef
            </span>

        </a>


        <!-- MAIN NAVIGATION -->

        <nav class="nav-links">

            <a href="index.php">
                Home
            </a>

            <a href="schedule.php">
                Dive Sites
            </a>

            <a href="tours.php">
                Snorkeling
            </a>

            <a href="courses.php">
                Courses
            </a>

            <a href="pricing.php">
                Pricing
            </a>

        </nav>


        <!-- ACCOUNT AREA -->

        <div class="nav-cta">

            <?php if (!empty($_SESSION["user_id"])): ?>

                <span class="nav-user">

                    Hi,
                    <?= htmlspecialchars(
                        $_SESSION["first_name"]
                        ?? "Customer"
                    ) ?>

                </span>

                <a
                    href="my_bookings.php"
                    class="nav-account-link"
                >
                    My Bookings
                </a>

                <a
                    href="logout.php"
                    class="nav-logout"
                >
                    Log Out
                </a>

                <button
                    type="button"
                    class="btn btn-dark"
                    onclick="openLoginPopup()"
                >
                    Book a Dive
                  </button>

            <?php else: ?>

                <a
                    href="login.php"
                    class="nav-logout"
                >
                    Log In
                </a>

                <a
                    href="booking.php"
                    class="btn btn-dark"
                >
                    Book a Dive
                </a>

            <?php endif; ?>

        </div>


        <!-- MOBILE MENU ICON -->

        <button
            class="menu-toggle"
            type="button"
            aria-label="Open menu"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
            >
                <path
                    d="M4 7h16M4 12h16M4 17h16"
                />
            </svg>

        </button>

    </div>
 <div
    class="login-popup-overlay"
    id="loginPopup"
>

    <div class="login-popup-card">

        <button
            type="button"
            class="login-popup-close"
            onclick="closeLoginPopup()"
        >
            ×
        </button>

        <span class="login-popup-eyebrow">
            BEFORE YOU BOOK
        </span>

        <h2>
            Log in to continue
        </h2>

        <p>
            You need an Azura Reef account
            before you can make a booking.
        </p>

        <div class="login-popup-actions">

            <a
                href="login.php"
                class="popup-login-btn"
            >
                Log In
            </a>

            <a
                href="register.php"
                class="popup-register-btn"
            >
                Create Account
            </a>

        </div>

    </div>

</div>

<script>

function openLoginPopup() {
    document
        .getElementById("loginPopup")
        .classList
        .add("show");
}

function closeLoginPopup() {
    document
        .getElementById("loginPopup")
        .classList
        .remove("show");
}

document
    .getElementById("loginPopup")
    ?.addEventListener(
        "click",
        function(event) {

            if (event.target === this) {
                closeLoginPopup();
            }

        }
    );

</script>
</header>