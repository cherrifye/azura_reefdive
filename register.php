<?php
session_start();
require_once "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_name = trim($_POST["first_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";

    if (
        empty($first_name) ||
        empty($last_name) ||
        empty($email) ||
        empty($password) ||
        empty($confirm_password)
    ) {
        $error = "Please complete all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } elseif ($password !== $confirm_password) {

        $error = "Passwords do not match.";

    } elseif (strlen($password) < 6) {

        $error = "Password must be at least 6 characters.";

    } else {

        $check = $conn->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $error = "An account with this email already exists.";

        } else {

            $hashed_password = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $conn->prepare(
                "INSERT INTO users
                (first_name, last_name, email, password, role)
                VALUES (?, ?, ?, ?, 'customer')"
            );

            $stmt->bind_param(
                "ssss",
                $first_name,
                $last_name,
                $email,
                $hashed_password
            );

            if ($stmt->execute()) {

                header("Location: login.php?registered=1");
                exit;

            } else {

                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | Azura Reef Dive</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="style.css">

    <style>

        .auth-section {
            min-height: 82vh;
            background: var(--mint-50);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 70px 24px;
        }

        .auth-card {
            width: 100%;
            max-width: 520px;
            background: white;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            padding: 40px;
        }

        .auth-card h1 {
            color: var(--teal-900);
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .auth-intro {
            color: var(--muted);
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .name-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        label {
            display: block;
            color: var(--teal-900);
            font-size: .88rem;
            font-weight: 600;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'Inter', sans-serif;
            font-size: .95rem;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            border-color: var(--teal-500);
        }

        .auth-card .btn {
            width: 100%;
            justify-content: center;
            margin-top: 5px;
        }

        .error-message {
            background: #fff1f1;
            color: #9a3434;
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-size: .9rem;
        }

        .auth-bottom {
            margin-top: 22px;
            text-align: center;
            color: var(--muted);
            font-size: .9rem;
        }

        .auth-bottom a {
            color: var(--teal-500);
            font-weight: 600;
        }

        @media (max-width: 600px) {

            .name-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .auth-card {
                padding: 30px 22px;
            }
        }

    </style>

</head>

<body>

<header>

    <div class="nav-wrap">

        <a href="index.php" class="brand">

            <span class="brand-icon">
                <img src="images/daybbb .png" alt="Azura Reef logo">
            </span>

            <span class="brand-name">
                Azura Reef
            </span>

        </a>

        <div class="nav-cta">

            <a href="index.php" class="btn btn-dark">
                Home
            </a>

        </div>

    </div>

</header>


<section class="auth-section">

    <div class="auth-card">

        <h1>Create an Account</h1>

        <p class="auth-intro">
            Create your account to book and manage your Azura Reef experiences.
        </p>


        <?php if (!empty($error)): ?>

            <div class="error-message">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form method="POST">


            <div class="name-grid">

                <div class="form-group">

                    <label for="first_name">
                        First Name
                    </label>

                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="last_name">
                        Last Name
                    </label>

                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        required
                    >

                </div>

            </div>


            <div class="form-group">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                >

            </div>


            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    minlength="6"
                    required
                >

            </div>


            <div class="form-group">

                <label for="confirm_password">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    minlength="6"
                    required
                >

            </div>


            <button type="submit" class="btn btn-primary">
                Create Account
            </button>

        </form>


        <div class="auth-bottom">

            Already have an account?

            <a href="login.php">
                Log In
            </a>

        </div>

    </div>

</section>

</body>
</html>