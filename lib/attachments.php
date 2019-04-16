<?php
define( 'ATTACHMENTS_SETTINGS_SCREEN', false );
add_filter( 'attachments_default_instance', '__return_false' );

function alfa_attachments($attachments){
    $fields = array(
       array(
           'name'      => 'title',
           'type'      => 'text',
           'label'     => __( 'Title', 'alfa' ),
       ),
    );

    $args = array(

        'label'         => 'Featured Slider',
        'post_type'     => array( 'post'),
        'filetype'      => array("image"),
        'note'          => 'Add Slider Images',
        'button_text'   => __( 'Attach Files', 'alfa' ),
        'fields'        => $fields,
    );

    $attachments->register( 'slider', $args );
}
add_action( 'attachments_register', 'alfa_attachments' );