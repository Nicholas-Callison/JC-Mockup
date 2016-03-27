<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');

include_once("pathways.inc.php");
check_sid();

$disable_http_login = config_get_bool('options', 'disable-http-login');
if (!$disable_http_login || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'])) {
    $login = try_login();
    $login_error = $login['error'];
}

html_header('Pathways - Login');
?>

<div id="login" class="box">
    <h2>Pathways Login</h2>
    <?php if (isset($_COOKIE['PSID'])): ?>
    <p>
        Logged-in as: <strong><?= username_from_sid($_COOKIE["PSID"]) ?></strong>
        <a href="<?= get_uri('/logout/') ?>">Logout</a>
    </p>
    <?php elseif (!$disable_http_login || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'])): ?>
    <form method="post" action="<?= get_uri('/login') ?>">
        <fieldset>
            <legend>Enter login information</legend>
            <?php if (!empty($login_error)): ?>
                <ul class="errorlist"><li><?= $login_error ?></li></ul>
            <?php endif; ?>
            <p>
                <label for="id_username">Username or Email:</label>
                <input id="id_username" type="text" name="user" autofocus="autofocus" />
            </p>
            <p>
                <label for="id_password">Password</label>
                <input id="id_password" type="password" name="password" />
            </p>
            <p>
                <input type="checkbox" name="remember_me" id="id_remember_me" />
                <label for="id_remember_me">Remember</label>
            </p>
            <p>
                <input type="submit" class="button" value="Login" />
                <a href="<?= get_uri('/passwordreset/') ?>">Forgot Password</a>
                <?php if (in_request('referrer') !== ""): ?>
                    <input id="id_referrer" type="hidden" name="referrer" value="<?= in_request('referrer') ?>" />
                <?php elseif (isset($_SERVER['HTTP_REFERER'])): ?>
                    <input id="id_referrer" type="hidden" name="referrer" value="<?= htmlspecialchars($_SERVER['HTTP_REFERER'], ENT_QUOTES) ?>" />
                <?php endif; ?>
            </p>
        </fieldset>
    </form>
    <?php else: ?>
    <p>
        HTTP login is disabled. Please switch to HTTPS if you want to login.
    </p>
    <?php endif; ?>
</div>
<?php
html_footer(PATHWAYS_VERSION);