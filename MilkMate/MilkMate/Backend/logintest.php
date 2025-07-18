<?php
include 'load.php';

$user = "santhosh";
$pass = isset($_GET['pass']) ? $_GET['pass'] : '';
$result = null;

if (isset($_GET['logout'])) {
    Session::Destroy();
    die("Session destroyed,<a href='logintest.php'>Login Again</a>");
}

if (Session::get('is_loggedin')) {
    $username = Session::get('session_username');
    $userobj = new User($username);
    print("Welcome Back " . $userobj->getAvatar());
    print("<br>" . $userobj->getBio());
    $userobj->setBio("Making new things...");
    print("<br>" . $userobj->getBio());
} else {
    printf("No session found, trying to login now. <br>");
    $result = User::validate_credentials($user, $pass);

    if ($result) {
        $userobj = new User($user);
        echo "Login Success ", $userobj->getUsername();
        Session::set('is_loggedin', true);
        Session::set('session_username', $result);
    } else {
        echo "Login failed, $user <br>";
    }
}

echo <<<EOL
<br><br><a href=" logintest.php?logout">Logout</a>
EOL;
