<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit();
}

class OpalHotel_Comment{

    /**
     * Constructor
     */
    function __construct(){
        // add_action( 'opalhotel_after_single_room_main', array( $this, 'reviews' ), 30 );
        add_action( 'opalhotel_after_single_room_main', array( $this, 'comments_template' ), 10 );
        add_filter( 'comments_template', array( $this, 'comment_template' ) );
        add_action( 'comment_post', array( $this, 'add_rating' ), 10, 2 );

        add_filter( 'manage_edit-comments_columns', array( $this, 'comments_column' ), 10, 2 );
        add_filter( 'manage_comments_custom_column', array( $this, 'comments_custom_column' ), 10, 2 );
    }

    public function reviews() {
        // opalhotel_get_template( 'single-room/reviews/reviews.php' );
    }

    public function comments_template() {
        if ( comments_open() ) {
            comments_template();
        }
    }

    static function comment_filter( $comment, $args, $depth ) {
        opalhotel_get_template( 'single-room/reviews/review-loop.php', array( 'comment' => $comment, 'args' => $args, 'depth' => $depth ) );
    }

    /**
     * Load template for reviews if we found a file in theme/plugin directory
     *
     * @param string $template
     * @return string
     */
    public function comment_template( $template ){
        if ( get_post_type() !== 'opalhotel_room' ) {
            return $template;
        }

        $check_dirs = array(
            trailingslashit( get_stylesheet_directory() ) . OpalHotel::instance()->template_path(),
            trailingslashit( get_template_directory() ) . OpalHotel::instance()->template_path(),
            trailingslashit( get_stylesheet_directory() ),
            trailingslashit( get_template_directory() ),
            trailingslashit( OpalHotel::instance()->plugin_path() . '/templates' )
        );

        foreach ( $check_dirs as $dir ) {
            if ( file_exists( trailingslashit( $dir ) . 'single-room/comment-form.php' ) ) {
                return trailingslashit( $dir ) . 'single-room/comment-form.php';
            }
        }
        return $template;
    }

    /**
     * Add comment rating
     *
     * @param int $comment_id
     */
    public function add_rating( $comment_id, $approved ) {
        $comment = get_comment( $comment_id );
        $post_id = absint( $comment->comment_post_ID );
        if ( 'opalhotel_room' !== get_post_type( $post_id ) ) {
            return;
        }
        if ( ! isset( $_POST['opalhotel_rating'] ) || empty( $_POST['opalhotel_rating'] ) ) {
            return;
        }

        $rates = $_POST['opalhotel_rating'];

        foreach ( $rates as $name => $rating ) {

            if ( $rating > 5 ) {
                continue;
            }
            $name = sanitize_text_field( $name );
            // save comment rating
            add_comment_meta( $comment_id, 'opalhotel_rating_' . $name, $rating, true );

            if( $approved < 1 ) {
                return;
            }

            /* get averger rating room */
            $averger_rating = opalhotel_get_averger_rating( $post_id );

            update_post_meta( $post_id, 'arveger_rating_' . $name, $averger_rating );
            update_post_meta( $post_id, 'modified_rating_' . $name, current_time( 'mysql' ) );
        }
    }

    /* add comment column for rating */
    function comments_column( $columns ) {
        $columns['opalhotel_rating']   = __( 'Rating Room', 'opal-hotel-room-booking' );
        return $columns;
    }

    /* display comment column rating */
    function comments_custom_column( $column, $comment_id ) {
        $html = '';
        $comment = get_comment( $comment_id );
        $post_id = $comment->comment_post_ID;
        if ( get_post_type( $post_id ) !== 'opalhotel_room' ) {
            return;
        }
        if ( $column === 'opalhotel_rating' ) {
            $html = array();
            $html[] = '<div class="opalhotel_rating">';
            $rating = get_comment_meta( $comment_id, 'opalhotel_rating_comfort', true );
            if( $rating ):
                $html[] =   '<div class="comment-rating opalhotel_tiptip" data-tip="' . sprintf( __( 'Rated %d star for Comfort', 'opal-hotel-room-booking' ), $rating ) . '">';
                $html[] =       '<span style="width:'.( ( $rating / 5 ) * 100 ) .'%"></span>';
                $html[] =   '</div>';
            endif;

            $rating = get_comment_meta( $comment_id, 'opalhotel_rating_position', true );
            if( $rating ):
                $html[] =   '<div class="comment-rating opalhotel_tiptip" data-tip="' . sprintf( __( 'Rated %d star for Position', 'opal-hotel-room-booking' ), $rating ) . '">';
                $html[] =       '<span style="width:'.( ( $rating / 5 ) * 100 ) .'%"></span>';
                $html[] =   '</div>';
            endif;

            $rating = get_comment_meta( $comment_id, 'opalhotel_rating_price', true );
            if( $rating ):
                $html[] =   '<div class="comment-rating opalhotel_tiptip" data-tip="' . sprintf( __( 'Rated %d star for Price', 'opal-hotel-room-booking' ), $rating ) . '">';
                $html[] =       '<span style="width:'.( ( $rating / 5 ) * 100 ) .'%"></span>';
                $html[] =   '</div>';
            endif;

            $rating = get_comment_meta( $comment_id, 'opalhotel_rating_quantity', true );
            if( $rating ):
                $html[] =   '<div class="comment-rating opalhotel_tiptip" data-tip="' . sprintf( __( 'Rated %d star for %s', 'opal-hotel-room-booking' ), $rating, __( 'Quantity', 'opal-hotel-room-booking' ) ) . '">';
                $html[] =       '<span style="width:'.( ( $rating / 5 ) * 100 ) .'%"></span>';
                $html[] =   '</div>';
            endif;
            $html[] =  '</div>';
            $html = implode( '', $html);
        } else {
            $html = __( 'No rating', 'opal-hotel-room-booking' );
        }
        printf( '%s', $html );
    }

}

new OpalHotel_Comment();