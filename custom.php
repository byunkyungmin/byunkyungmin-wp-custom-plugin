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
                'key' => 'workFieldGroup',
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
    // Posts
    remove_menu_page('edit.php');
    // Pages
    remove_menu_page('edit.php?post_type=page');
    // Comments
    remove_menu_page('edit-comments.php');
}