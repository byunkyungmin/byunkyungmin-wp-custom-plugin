<html>
<head>
  <meta charset="UTF-8" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      border: 2px solid #eee;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      padding: 24px;
      text-align: center;
    }
    .logo {
      margin-bottom: 16px;
    }
    .info {
      font-size: 14px;
      color: #555;
      margin-bottom: 12px;
      text-align: left;
    }
    .message-box {
      background: #f2f2f2;
      border-radius: 8px;
      padding: 16px;
      margin-top: 8px;
      font-size: 15px;
      line-height: 1.6;
      white-space: pre-wrap;
      text-align: left;
    }
    .caption {
      font-size: 12px;
      text-align: left;
      margin-bottom: 5px;
      font-weight: bold;
      color: #333;
    }
    .footer {
      margin-top: 20px;
      font-size: 12px;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="https://cms.byunkyungmin.work/wp-content/uploads/2024/02/png_long.png" alt="Byun Kyung Min Logo" width="200" />
    </div>
    <h2>Whether it’s a question or a joke, I got it all 🙂</h2>
    <p>Thanks for checking out <a href="<?= esc_url($url) ?>" target="_blank"><?= esc_html($pageTitle) ?></a>.</p>
    <p class="caption">Your message:</p>
    <div class="message-box"><?= nl2br(esc_html($message)) ?></div>
    <p>If my reply takes a while, it just means I’m really thinking about it. Hang tight!</p>
    <p>In the meantime, would you like to listen to <strong><a href="https://music.apple.com/kr/playlist/%EC%9A%94%EC%A6%98-%EB%82%98%EC%9D%98-%EC%B5%9C%EC%95%A0%EA%B3%A1-%EB%AF%B9%EC%8A%A4/pl.pm-8e975ad16716041cc2a38d10923704c3">some of my favorite songs lately</a></strong>?</p>
    <div class="footer">This email is automatic, but the reply will be written by me. <br />(And I promise, with lots of care!)</div>
  </div>
</body>
</html>

