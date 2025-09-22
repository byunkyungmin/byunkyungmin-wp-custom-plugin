<?php
/**
 * Plugin Name: Contact API
 * Description: Next.js ContactBubble 전송용 REST API 엔드포인트
 * Version: 1.0
 * Author: Byun Kyung Min
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // 직접 접근 방지
}

add_action('rest_api_init', function () {
    register_rest_route('contact/v1', '/send', [
        'methods'  => 'POST',
        'callback' => 'handle_contact_form',
        'permission_callback' => '__return_true', // 인증 필요시 바꿀 수 있음
    ]);
});

function handle_contact_form(WP_REST_Request $request) {
    $email     = sanitize_email($request['email']);
    $message   = sanitize_textarea_field($request['message']);
    $pageTitle = sanitize_text_field($request['pageTitle']);

    if (empty($email) || empty($message)) {
        return new WP_Error('missing_data', '이메일과 메시지는 필수입니다.', ['status' => 400]);
    }

    $to      = get_option('admin_email'); // 워드프레스 관리자 이메일
    $subject = "새 문의가 도착했습니다: {$pageTitle}";
    $body    = "보낸 사람: {$email}\n\n페이지: {$pageTitle}\n\n메시지:\n{$message}";
    $headers = ["Reply-To: {$email}"];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        return ['success' => true];
    } else {
        return new WP_Error('mail_failed', '메일 전송에 실패했습니다.', ['status' => 500]);
    }
}
