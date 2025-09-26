<?php
/**
 * Plugin Name: Contact API
 * Description: Next.js ContactBubble 전송용 REST API 엔드포인트
 * Version: 1.5
 * Author: Byun Kyung Min
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action('rest_api_init', function () {
    register_rest_route('contact/v1', '/send', [
        'methods'  => 'POST',
        'callback' => 'handle_contact_form',
        'permission_callback' => '__return_true',
    ]);
});

function handle_contact_form(WP_REST_Request $request) {
    $email     = sanitize_email($request['email']);
    $message   = sanitize_textarea_field($request['message']);
    $pageTitle = sanitize_text_field($request['pageTitle']);
    $url       = esc_url_raw($request['url']); 

    // 언어 감지 (URL에 /en 포함 여부)
    $lang = (strpos($url, '/en') !== false) ? 'en' : 'ko';

    // 다국어 에러 메시지
    $errors = [
        'rate_limited' => [
            'ko' => '너무 자주 보내고 있습니다. 잠시 후 다시 시도해주세요.',
            'en' => 'You are sending too frequently. Please try again later.'
        ],
        'invalid_email' => [
            'ko' => '올바른 이메일 주소를 입력해주세요.',
            'en' => 'Please enter a valid email address.'
        ],
        'email_too_long' => [
            'ko' => '이메일 주소가 너무 깁니다.',
            'en' => 'The email address is too long.'
        ],
        'missing_message' => [
            'ko' => '메시지를 입력해주세요.',
            'en' => 'Please enter a message.'
        ],
        'message_too_long' => [
            'ko' => '메시지가 너무 깁니다. (최대 5000자)',
            'en' => 'Your message is too long. (Maximum 5000 characters)'
        ],
        'invalid_url' => [
            'ko' => '잘못된 URL 형식입니다.',
            'en' => 'The URL format is invalid.'
        ],
        'mail_failed' => [
            'ko' => '메일 전송에 실패했습니다.',
            'en' => 'Failed to send the email.'
        ]
    ];

    // Rate Limit (IP 기준 20초)
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $lock_key = 'contact_rate_limit_' . md5($ip);
    if (get_transient($lock_key)) {
        return new WP_Error('rate_limited', $errors['rate_limited'][$lang], ['status' => 429]);
    }
    set_transient($lock_key, true, 20);

    // 이메일 검사
    if (empty($email) || !is_email($email)) {
        return new WP_Error('invalid_email', $errors['invalid_email'][$lang], ['status' => 400]);
    }
    if (strlen($email) > 255) {
        return new WP_Error('email_too_long', $errors['email_too_long'][$lang], ['status' => 400]);
    }

    // 메시지 검사 (최대 5000자)
    if (empty($message)) {
        return new WP_Error('missing_message', $errors['missing_message'][$lang], ['status' => 400]);
    }
    if (mb_strlen($message) > 5000) {
        return new WP_Error('message_too_long', $errors['message_too_long'][$lang], ['status' => 400]);
    }

    // URL 검사
    if (!empty($url) && !filter_var($url, FILTER_VALIDATE_URL)) {
        return new WP_Error('invalid_url', $errors['invalid_url'][$lang], ['status' => 400]);
    }

    // 메일 제목 (UTF-8 안전 처리)
    $admin_subj_raw = ($lang === 'en') 
        ? "New message about {$pageTitle}" 
        : "{$pageTitle}에 관한 새로운 이야기가 도착했어요";

    $admin_subj = mb_encode_mimeheader($admin_subj_raw, 'UTF-8');

    $admin_to = get_option('admin_email');

    // 관리자 메일 템플릿
    ob_start();
    include plugin_dir_path(__FILE__) . "contact-templates/{$lang}/email-admin.php";
    $admin_body = ob_get_clean();

    $headers_admin = [
        "Reply-To: {$email}",
        "Content-Type: text/html; charset=UTF-8"
    ];

    $sent_admin = wp_mail($admin_to, $admin_subj, $admin_body, $headers_admin);

    //  회신 메일
    $user_subj_raw = ($lang === 'en') 
        ? "We've received your message about {$pageTitle}" 
        : "{$pageTitle}에 관한 이야기를 잘 받았습니다";

    $user_subj = mb_encode_mimeheader($user_subj_raw, 'UTF-8');

    ob_start();
    include plugin_dir_path(__FILE__) . "contact-templates/{$lang}/email-user.php";
    $user_body = ob_get_clean();

    $headers_user = [
        "Content-Type: text/html; charset=UTF-8"
    ];

    $sent_user = wp_mail($email, $user_subj, $user_body, $headers_user);

    if ($sent_admin && $sent_user) {
        return ['success' => true];
    } else {
        return new WP_Error('mail_failed', $errors['mail_failed'][$lang], ['status' => 500]);
    }
}
