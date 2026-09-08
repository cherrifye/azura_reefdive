<?php
session_start();
require_once "db.php";

$error = "";

if (isset($_SESSION["user_id"])) {

    if (($_SESSION["role"] ?? "") === "admin") {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: index.php");
    }

    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($email) || empty($password)) {

        $error = "Please enter your email and password.";

    } else {

        $stmt = $conn->prepare(
            "SELECT id, first_name, last_name, email, password, role
             FROM users
             WHERE email = ?"
        );

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["first_name"] = $user["first_name"];
            $_SESSION["last_name"] = $user["last_name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            if ($user["role"] === "admin") {

                header("Location: admin_dashboard.php");

            } else {

                header("Location: index.php");

            }

            exit;

        } else {

            $error = "Incorrect email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Azura Reef Dive</title>

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
            max-width: 470px;
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
        }

        .message {
            padding: 12px 14px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            font-size: .9rem;
        }

        .error {
            background: #fff1f1;
            color: #9a3434;
        }

        .success {
            background: var(--mint-100);
            color: var(--teal-900);
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

        <h1>Welcome Back</h1>

        <p class="auth-intro">
            Log in to your Azura Reef account.
        </p>


        <?php if (isset($_GET["registered"])): ?>

            <div class="message success">
                Account created successfully. You can now log in.
            </div>

        <?php endif; ?>


        <?php if (!empty($error)): ?>

            <div class="message error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form method="POST">

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
                    required
                >

            </div>


            <button type="submit" class="btn btn-primary">
                Log In
            </button>

        </form>


        <div class="auth-bottom">

            Don't have an account?

            <a href="register.php">
                Create Account
            </a>

        </div>

    </div>

</section>

</body>
</html>