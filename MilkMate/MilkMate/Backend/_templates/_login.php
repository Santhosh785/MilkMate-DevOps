<?php
include_once '/../includes/user.class.php';

$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email_address'] ?? '';
    $password = $_POST['password'] ?? '';

    $result = User::validate_credentials($username, $password);
}
?>

<main class="container">
    <?php if ($result) { ?>
        <div class="bg-light p-5 rounded mt-3">
            <h1>Login Success</h1>
            <p class="lead">This example is a quick exercise to do basic login with html forms.</p>
        </div>
    <?php } else { ?>
        <form method="post" action="login.php" class="form-signin">
            <img class="mb-4" src="https://git.selfmade.ninja/uploads/-/system/appearance/logo/1/Logo_Dark.png" alt="" height="50">
            <input name="fingerprint" type="hidden" id="fingerprint" value="">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input name="email_address" type="email" class="form-control" id="floatingInput"
                    placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword"
                    placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary hvr-grow-rotate" type="submit">Sign in</button>
        </form>
    <?php } ?>
</main>