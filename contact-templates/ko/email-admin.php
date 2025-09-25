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
      text-align: center; /* 이미지와 상단 타이틀 중앙 정렬 */
    }

    .logo {
      margin-bottom: 16px;
    }

    h2 {
      margin-top: 0;
      color: #0066cc;
      font-family: Arial, sans-serif;
    }

    .info {
      font-size: 14px;
      color: #555;
      margin-bottom: 12px;
      text-align: left; /* 본문은 다시 왼쪽 정렬 */
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
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="https://cms.byunkyungmin.work/wp-content/uploads/2024/02/png_long.png" alt="Byun Kyung Min Logo" width="200" />
    </div>
    <h2>새로운 메세지가 도착했어요</h2>
    <p class="info"><span class="label">보낸 사람: </span><?= esc_html($email) ?></p>
    <p class="info"><span class="label">페이지: </span><a href="<?= esc_url($url) ?>" target="_blank"><?= esc_html($pageTitle) ?></a></p>
    <div class="message-box"><?= nl2br(esc_html($message)) ?></div>
    <div class="footer">느려도 괜찮아요, 진심을 담아 솔직한 이야기를 공유해보아요.</div>

  </div>
</body>
</html>
