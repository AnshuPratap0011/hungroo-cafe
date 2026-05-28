<?php

include "config/config.php";

echo '<div style="background:#111;color:#fff;padding:20px;font-family:monospace;font-size:14px;max-width:700px;margin:20px auto;border-radius:12px">';

echo '<h2 style="color:#a29bfe">SESSION DEBUG v2</h2><hr style="border-color:#333;margin:10px 0">';

/* CHECK 1: Headers sent? */

echo '<p><strong>1. headers_sent():</strong> ' . (headers_sent() ? '<span style="color:#ff7675">YES ❌ (BAD)</span>' : '<span style="color:#55efc4">NO ✅ (GOOD)</span>');

if (headers_sent()) {

    $f = ''; $l = 0;

    headers_sent($f, $l);

    echo ' — File: ' . $f . ' Line: ' . $l;

}

echo '</p>';

/* CHECK 2: Session status */

 $statuses = [1 => 'DISABLED', 2 => 'NONE', 3 => 'ACTIVE'];

echo '<p><strong>2. session_status():</strong> ' . ($statuses[session_status()] ?? session_status()) . '</p>';

/* CHECK 3: Cookie settings */

echo '<p><strong>3. session.use_cookies:</strong> ' . ini_get('session.use_cookies') . '</p>';

echo '<p><strong>4. session.use_only_cookies:</strong> ' . ini_get('session.use_only_cookies') . '</p>';

echo '<p><strong>5. session.cookie_path:</strong> ' . ini_get('session.cookie_path') . '</p>';

echo '<p><strong>6. session.cookie_domain:</strong> "' . ini_get('session.cookie_domain') . '"</p>';

echo '<p><strong>7. session.cookie_samesite:</strong> "' . ini_get('session.cookie_samesite') . '"</p>';

echo '<p><strong>8. session.cookie_secure:</strong> ' . ini_get('session.cookie_secure') . '</p>';

echo '<p><strong>9. session.save_path:</strong> ' . session_save_path() . '</p>';

echo '<hr style="border-color:#333;margin:10px 0">';

/* CHECK 4: Actual session ID */

echo '<p><strong>10. session_id():</strong> "' . session_id() . '"</p>';

echo '<p><strong>11. Session Name:</strong> "' . session_name() . '"</p>';

echo '<hr style="border-color:#333;margin:10px 0">';

/* CHECK 5: What headers PHP actually sent */

echo '<p><strong>12. Headers sent to browser:</strong></p>';

echo '<pre style="background:#222;padding:10px;border-radius:8px;font-size:11px;max-height:200px;overflow:auto">';

 $headers = headers_list();

if (empty($headers)) {

    echo 'NO HEADERS SENT (This is why login fails!)';

} else {

    foreach ($headers as $h) {

        if (stripos($h, 'cookie') !== false || stripos($h, 'session') !== false) {

            echo '<span style="color:#55efc4">' . htmlspecialchars($h) . '</span>';

        } else {

            echo htmlspecialchars($h);

        }

        echo "\n";

    }

}

echo '</pre>';

echo '<hr style="border-color:#333;margin:10px 0">';

/* CHECK 6: Test form */

if (!isset($_POST['login'])) {

    echo '</div>';

    ?>

    <form method="POST" style="max-width:400px;margin:20px auto;background:#111;padding:20px;border-radius:12px;color:#fff;font-family:sans-serif">

        <label style="display:block;margin-bottom:5px">Email or Phone:</label>

        <input type="text" name="email_phone" value="kumarmahabir483@gmail.com" style="width:100%;padding:10px;margin-bottom:15px;border-radius:8px;border:1px solid #333;background:#222;color:#fff">

        <label style="display:block;margin-bottom:5px">Password:</label>

        <input type="password" name="password" style="width:100%;padding:10px;margin-bottom:15px;border-radius:8px;border:1px solid #333;background:#222;color:#fff" required>

        <button type="submit" name="login" style="padding:12px 30px;background:#6C5CE7;color:#fff;border:none;border-radius:8px;cursor:pointer;font-size:16px;font-weight:600">TEST LOGIN</button>

    </form>

    <?php

    exit;

}

 $emailPhone = trim($_POST['email_phone']);

 $password  = $_POST['password'];

 $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ? LIMIT 1");

 $stmt->bind_param('ss', $emailPhone, $emailPhone);

 $stmt->execute();

 $result = $stmt->get_result();

 $user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['id'];

    $_SESSION['name'] = $user['full_name'];

    echo '<p style="color:#55efc4;font-size:16px">✅ LOGIN LOGIC WORKS — Session data set</p>';

    echo '<pre style="background:#222;padding:10px;border-radius:8px;font-size:12px">';

    print_r($_SESSION);

    echo '</pre>';

    echo '<hr style="border-color:#333;margin:10px 0">';

    echo '<p><strong>13. session_id AFTER setting data:</strong> "' . session_id() . '"</p>';

    echo '<p><strong>14. Headers AFTER setting data:</strong></p>';

    echo '<pre style="background:#222;padding:10px;border-radius:8px;font-size:11px;max-height:200px;overflow:auto">';

    $headers2 = headers_list();

    $cookieFound = false;

    foreach ($headers2 as $h) {

        if (stripos($h, 'cookie') !== false || stripos($h, 'session') !== false) {

            echo '<span style="color:#55efc4">' . htmlspecialchars($h) . '</span>';

            $cookieFound = true;

        } else {

            echo htmlspecialchars($h);

        }

        echo "\n";

    }

    if (!$cookieFound) {

        echo '<span style="color:#ff7675">NO SESSION COOKIE IN HEADERS! THIS IS THE BUG!</span>';

    }

    echo '</pre>';

} else {

    echo '<p style="color:#ff7675">Wrong password or user not found</p>';

}

echo '</div>';

?>