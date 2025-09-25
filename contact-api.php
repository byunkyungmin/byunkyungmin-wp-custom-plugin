<?php
/**
 * Plugin Name: Contact API
 * Description: Next.js ContactBubble 전송용 REST API 엔드포인트
 * Version: 1.2
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

    if (empty($email) || empty($message)) {
        return new WP_Error('missing_data', '이메일과 메시지는 필수입니다.', ['status' => 400]);
    }

    $admin_to   = get_option('admin_email');
    $admin_subj = "새 문의가 도착했습니다: {$pageTitle}";

    ob_start();
    include plugin_dir_path(__FILE__) . 'contact-templates/ko/email-admin.php';
    $admin_body = ob_get_clean();

    $headers_admin = [
        "Reply-To: {$email}",
        "Content-Type: text/html; charset=UTF-8"
    ];

    $sent_admin = wp_mail($admin_to, $admin_subj, $admin_body, $headers_admin);

    // ✅ 사용자 회신 메일
    $user_subj = "문의가 접수되었습니다: {$pageTitle}";
    ob_start();
    include plugin_dir_path(__FILE__) . 'contact-templates/ko/email-user.php';
    $user_body = ob_get_clean();

    $headers_user = [
        "Content-Type: text/html; charset=UTF-8"
    ];

    $sent_user = wp_mail($email, $user_subj, $user_body, $headers_user);

    if ($sent_admin && $sent_user) {
        return ['success' => true];
    } else {
        return new WP_Error('mail_failed', '메일 전송에 실패했습니다.', ['status' => 500]);
    }
}

