<?php 

class wp_list_comments_walker extends Walker_Comment {
    /* Start the list before the elements are added.
    *
    * @see Walker::start_lvl()
    *
    * @since 2.7.0
    *
    * @param string $output Passed by reference. Used to append additional content.
    * @param int $depth Depth of comment.
    * @param array $args Uses 'style' argument for type of HTML list.
    */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
        switch ( $args['style'] ) {
            case 'div':
                break;
            case 'ol':
                $output .= '<ol class="children">' . "\n";
                break;
            case 'ul':
                default:
                $output .= '<ul class="children list-unstyled sub-comments">' . "\n";
                break;
        }
    }
}


?>