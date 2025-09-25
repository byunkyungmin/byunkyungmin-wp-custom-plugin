<?php
/**
 * Plugin Name: Byunkyungmin Wordpress Custom Plugins
 * Description: WPGraphQL where 인자 확장, WORK-THUMB, 기본 삭제 등..
 * Author: Byun Kyung Min
 */

// Graphql slug where 인자 확장
add_action('graphql_register_types', function () {
    $customposttype_graphql_single_name = "Work";
    register_graphql_field('RootQueryTo' . $customposttype_graphql_single_name . 'ConnectionWhereArgs', 'slug', [
        'type' => 'String',
        'description' => __('The databaseId of the post object to filter by', 'your-textdomain'),
    ]);
});

add_filter('graphql_post_object_connection_query_args', function ($query_args, $source, $args, $context, $info) {
    if (isset($args['where']['slug'])) {
        $query_args['meta_query'] = [
            [
                'key' => 'slug',
                'value' => (String) $args['where']['slug'],
                'compare' => '='
            ]
        ];
    }
    return $query_args;
}, 10, 5);

// 최적화를 위한 Work-thumb사이즈 추가 ( WORK-THUMB )
add_action('after_setup_theme', function() {
    add_image_size('work-thumb', 800, 800, false);
});

// 불필요한 사이드바 메뉴 삭제
add_action('admin_menu', 'remove_default_menu');
function remove_default_menu() 
{
    remove_menu_page('edit.php');              // Posts
    remove_menu_page('edit.php?post_type=page'); // Pages
    remove_menu_page('edit-comments.php');     // Comments
}

// Google Map API (환경변수에서 불러오기)
function my_acf_google_map_api($api) {
    $google_map_key = getenv('GOOGLE_MAP_API_KEY');
    if ($google_map_key) {
        $api['key'] = $google_map_key;
    }
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// heic 업로드 허용( 아이폰 사진 )
function allow_heic_uploads($mime_types) {
    $mime_types['heic'] = 'image/heic';
    $mime_types['heif'] = 'image/heif';
    return $mime_types;
}
add_filter('upload_mimes', 'allow_heic_uploads');
