<html>
<head>
  <meta charset="UTF-8" />
  <style>
    body {
      font-family: 'NanumSquareNeo', Arial, sans-serif;
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
    }

    h2 {
      margin-top: 0;
      color: #0066cc;
      font-family: 'NanumSquareNeo-EB', Arial, sans-serif;
    }

    .info {
      font-size: 14px;
      color: #555;
      margin-bottom: 12px;
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
    }

    .footer {
      margin-top: 20px;
      font-size: 12px;
      color: #888;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>📩 새 문의가 도착했습니다</h2>
    <p class="info"><span class="label">보낸 사람:</span> <?= esc_html($email) ?></p>
    <p class="info"><span class="label">페이지:</span> <?= esc_html($pageTitle) ?></p>
    <p class="label">메시지:</p>
    <div class="message-box"><?= nl2br(esc_html($message)) ?></div>
    <div class="footer">이 메일은 ContactBubble 폼을 통해 전송되었습니다.</div>
  </div>
</body>
</html>
