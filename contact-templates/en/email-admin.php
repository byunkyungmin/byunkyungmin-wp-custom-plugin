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

    h2 {
      margin-top: 0;
      color: #0066cc;
    }

    .info {
      font-size: 14px;
      color: #555;
      margin-bottom: 12px;
      text-align: left;
    }

    .label {
      font-weight: bold;
      color: #333;
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
    <h2>You’ve got a new message ✉️</h2>
    <p class="info"><span class="label">From: </span><?= esc_html($email) ?></p>
    <p class="info"><span class="label">Page: </span><a href="<?= esc_url($url) ?>" target="_blank"><?= esc_html($pageTitle) ?></a></p>
    <div class="message-box"><?= nl2br(esc_html($message)) ?></div>
    <div class="footer">No rush — take your time and share your honest thoughts when you’re ready.</div>
  </div>
</body>
</html>