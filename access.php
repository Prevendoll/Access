<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アクセス情報</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
        }

        p {
            font-size: 18px;
        }

        span {
            font-weight: bold;
            color: #0073e6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>アクセス情報</h1>
        <p>IPアドレス:<?php echo $_SERVER['REMOTE_ADDR']; ?></p>
        <p>アクセス時刻: <?php echo date('Y-m-d H:i:s'); ?></p>
        <?php
        $ip = $_SERVER['REMOTE_ADDR'];
        $json = file_get_contents("https://ipinfo.io/{$ip}/json");
        $data = json_decode($json);

        if ($data && isset($data->country) && isset($data->region)) {
            $country = $data->country;
            $region = $data->region;
            echo "<p>アクセス元の国: $country</p>";
            echo "<p>アクセス元の地域: $region</p>";
        } else {
            echo "<p>位置情報が取得できませんでした。</p>";
        }
        ?>
        <p>ブラウザ情報: <span id="browserInfo"></span></p>
        <p>直前のURL（リファラー）: <span id="referrerInfo"></span></p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // ブラウザ情報を取得
            var browserInfo = navigator.userAgent;
            document.getElementById("browserInfo").textContent = browserInfo;

            // リファラー情報を取得
            var referrerInfo = document.referrer;
            document.getElementById("referrerInfo").textContent = referrerInfo;
        });
    </script>
</body>
</html>