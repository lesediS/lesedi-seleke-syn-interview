<?php

require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/session.php';

startSession();

// if (isLoggedIn()) {
//     redirect('index.php');
// }


$database = new Database();
$userManager = new User($database);

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitizeInput($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required';
    } else {
        $user = $userManager->login($username, $password);
        if ($user) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Set remember me cookie if requested
            if ($remember) {
                $token = bin2hex(random_bytes(32));
                // $expires = time() + 60 * 60 * 24 * 30; // 30 days
                // setcookie('remember_token', $token, $expires, '/', '', true, true);
                
                // Store token in database
               /* $stmt = $database->getConnection()->prepare("
                    INSERT INTO user_sessions (id, user_id, expires_at, ip_address, user_agent) 
                    VALUES (?, ?, FROM_UNIXTIME(?), ?, ?)
                "); */
                $stmt = $database->getConnection()->prepare("
                    INSERT INTO user_sessions (id, user_id, ip_address, user_agent) 
                    VALUES (?, ?, FROM_UNIXTIME(?), ?, ?)
                ");
                
                $stmt->execute([
                    $token,
                    $user['id'],
                    // $expires,
                    $_SERVER['REMOTE_ADDR'] ?? null,
                    $_SERVER['HTTP_USER_AGENT'] ?? null
                ]);
            }

            redirect('index.php');
        } else {
            $error = 'Invalid username or password';
        }
    }
}

// Get message from session if exists
$message = getMessage();
?>


<!DOCTYPE html>
<html class="login">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="shortcut icon" href="assets/images/favicon.png">

    <title>Synrgise - Innovate Learning</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="assets/css/elements.css" rel="stylesheet" type="text/css">

    <script src="assets/js/modernizr.min.js"></script>



</head>

<body>


    <div class="wrapper-page">
        <div class="panel-pages login">
            <div class="panel-body">
                <div class="logo text-center m-b-20">
                    <a href="#"><img src="assets/images/synrgise-logo-white.png"></a>
                </div>

                <!-- Display message if exists -->
                <?php if ($message): ?>
                    <div class="alert alert-<?= $message['type'] ?>">
                        <?= $message['text'] ?>
                    </div>
                <?php endif; ?>

                <!-- Display error otherwise -->
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?= $error ?>
                    </div>
                <?php endif; ?>


                <form class="form-horizontal m-t-20" action="login.php" method="post"> <!-- Submit on login.php and POST -->

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="text" name="username" 
                                required="" placeholder="Username" value="<?php htmlspecialchars($username) ?>"> <!-- Added name attribute for form submission and htmlspecialchars (characters to HTML) -->
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" type="password" name="password"
                                required="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12 col-md-8">
                            <div class="checkbox checkbox-primary">
                                <input id="checkbox-signup" type="checkbox">
                                <label for="checkbox-signup">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <button class="btn btn-black btn-block waves-effect waves-light" type="submit">Log
                                In</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30">
                        <div class="col-sm-7">
                            <a href="#"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a> <!-- TODO: Add forgot-password.php? -->
                        </div>
                        <div class="col-sm-5 text-right">
                            <a href="#">Create an account</a> <!-- TODO: Add register.php file? -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        var resizefunc = [];
    </script>

    <!-- Main  -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


</body>

</html>