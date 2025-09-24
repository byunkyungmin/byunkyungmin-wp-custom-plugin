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
      color: #2ecc71;
      font-family: 'NanumSquareNeo-EB', Arial, sans-serif;
    }

    .info {
      font-size: 14px;
      color: #555;
      margin-bottom: 12px;
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
    <h2>✅ 문의가 정상적으로 접수되었습니다</h2>
    <p class="info">안녕하세요, <strong><?= esc_html($email) ?></strong> 님</p>
    <p>아래와 같은 내용으로 문의를 접수했습니다. 빠른 시일 내에 답변드리겠습니다.</p>
    <p><strong>페이지:</strong> <?= esc_html($pageTitle) ?></p>
    <p><strong>문의 내용:</strong></p>
    <div class="message-box"><?= nl2br(esc_html($message)) ?></div>
    <div class="footer">본 메일은 발신 전용입니다. 추가 문의는 웹사이트 ContactBubble을 이용해주세요.</div>
  </div>
</body>
</html>
