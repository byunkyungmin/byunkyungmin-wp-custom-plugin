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
      font-family: Arial, sans-serif;
    }

    .info {
      font-size: 14px;
      color: #555;
      margin-bottom: 12px;
      text-align: left; /* 본문은 다시 왼쪽 정렬 */
    }
    p {
      font-size: 14px;
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
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="https://cms.byunkyungmin.work/wp-content/uploads/2024/02/png_long.png" alt="Byun Kyung Min Logo" width="200" />
    </div>
    <h2>궁금증이든 농담이든, 다 잘 받았습니다</h2>
    <p><a href="<?= esc_url($url) ?>" target="_blank"><?= esc_html($pageTitle) ?></a>에 관심가져주셔서 감사해요.</p>
    <p class="caption">남겨주신 내용:</p>
    <div class="message-box"><?= nl2br(esc_html($message)) ?></div>
    <p>답변이 빨리 오지 않는다면, 오래오래 고민중인거에요. 조금만 기다려주세요.</p>
    <p>기다리시는 동안, <strong><a href="https://music.apple.com/kr/playlist/%EC%9A%94%EC%A6%98-%EB%82%98%EC%9D%98-%EC%B5%9C%EC%95%A0%EA%B3%A1-%EB%AF%B9%EC%8A%A4/pl.pm-8e975ad16716041cc2a38d10923704c3">제가 요즘 즐겨듣는 노래</a></strong> 들어보실래요?</p>
    <div class="footer">이 메일은 자동이지만, 답장은 제가 직접 쓸 거예요. <br />(그것도 아주 열심히요!)</div>
  </div>
</body>
</html>
