<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

echo '<div style="background:#111;color:#fff;padding:20px;font-family:monospace;border-radius:12px;max-width:700px;margin:20px auto">';

echo '<h2 style="color:#a29bfe">FORCE SESSION TEST</h2><hr style="border-color:#333;margin:10px 0">';

echo '<p><strong>session.save_handler:</strong> ' . ini_get('session.save_handler') . '</p>';

echo '<p><strong>session.save_path:</strong> ' . ini_get('session.save_path') . '</p>';

echo '<p><strong>session.use_strict_mode:</strong> ' . ini_get('session.use_strict_mode') . '</p>';

echo '<hr style="border-color:#333;margin:10px 0">';

echo '<p>Before: <strong>' . session_status() . '</strong> (0=Disabled, 1=None, 2=Active)</p>';

 $res = session_start();

echo '<p>session_start() returned: <strong>' . var_export($res, true) . '</strong></p>';

echo '<p>After: <strong>' . session_status() . '</strong></p>';

echo '<p>Session ID: <strong>"' . session_id() . '"</strong></p>';

if (session_status() === 2) {

    $_SESSION['force_test'] = 'WORKING';

    if (isset($_POST['check'])) {

        echo '<p style="color:#55efc4;font-size:18px">✅ SESSION PERSISTS ACROSS REQUESTS!</p>';

        echo '<p>Problem is in your config.php or login.php — not PHP settings.</p>';

    } else {

        echo '<p style="color:#55efc4;font-size:18px">✅ SESSION STARTED!</p>';

        echo '<form method="POST"><button type="submit" name="check" style="padding:12px 30px;background:#6C5CE7;color:#fff;border:none;border-radius:8px;cursor:pointer;font-size:16px">TEST PERSISTENCE →</button></form>';

    }

} else {

    echo '<p style="color:#ff7675;font-size:18px">❌ SESSION FAILED!</p>';

    echo '<p>Open this file in XAMPP: <code>C:\xampp\php\php.ini</code></p>';

    echo '<p>Search for <strong>session.</strong> and check if anything is set to <strong>0</strong> or <strong>disabled</strong></p>';

    echo '<p>Also check if folder <strong>C:\xampp\tmp</strong> exists.</p>';

}

echo '</div>';

?>