<?php /*
   $alfa_layout_class = "col-md-8";
   $alfa_text_class = "";
   if(!is_active_sidebar("sidebar-1")){
     $alfa_layout_class = "col-md-10 offset-md-1";
     $alfa_text_class = "text-center";
   }
 */?>

<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part("/template-parts/common/hero"); ?>
    <div class="container">
        <div class="row">

              <?php 
               if (is_active_sidebar("sidebar-1")) { ?>

                  <div class="col-md-8">
              <?php } else { ?>
              <div class="col-md-10 offset-md-1">
              <?php } ?>
                <div class="posts">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <div <?php post_class(array("first_class","second_class")); ?>>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="post-title">
                                            <?php the_title(); ?>
                                        </h2>
                                        <p class="">
                                            <em><?php the_author_posts_link(); ?></em><br/>
                                            <?php echo get_the_date(); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="slider">
                                            <?php
                                            if ( class_exists( 'Attachments' ) ) {
                                                $attachments = new Attachments( 'slider' );
                                                if ( $attachments->exist() ) {
                                                    while ( $attachment = $attachments->get() ) { ?>
                                                        <div>
                                                            <?php echo $attachments->image( 'large' ); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                        <p>
                                            <?php
                                         if ( !class_exists( 'Attachments' ) ) {
                                            if ( has_post_thumbnail() ) {
                                                $thumbnail_url = get_the_post_thumbnail_url(null,"large");
                                                printf( '<a class="popup" href="%s" data-featherlight="image">',$thumbnail_url);
                                                the_post_thumbnail( "large", array( "class" => "img-fluid" ) );
                                                echo '</a>';
                                            }
                                          }

                                            the_content();

                                            wp_link_pages(); //For getting breaking page links


                                            next_post_link();
                                            echo "<br/>";
                                            previous_post_link();

                                            ?>
                                        </p>

                                        <div class="authorsection">
                                            <div class="row">
                                                <div class="col-md-3 authorimage">
                                                    <?php 
                                                      error_reporting(0);
                                                      echo get_avatar(get_the_author_meta("id")); 
                                                    ?>
                                                </div>
                                                <div class="col-md-9">
                                                     <?php 
                                                      error_reporting(0);
                                                      echo get_the_author_meta("display_name");
                                                      echo '</br>';
                                                      echo get_the_author_meta("description"); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <?php if ( comments_open() ): ?>
                                        <div class="col-md-10 offset-md-1">
                                            <?php
                                            comments_template();
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    ?>

                    <div class="container post-pagination">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <?php
                                the_posts_pagination( array(
                                    "screen_reader_text" => ' ',
                                    "prev_text"          => "New Posts",
                                    "next_text"          => "Old Posts"
                                ) );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (is_active_sidebar("sidebar-1")): ?>

            <div class="col-md-4">
                <?php
                if ( is_active_sidebar( "sidebar-1" ) ) {
                    dynamic_sidebar( "sidebar-1" );
                }
                ?>
            </div>
             <?php 
              endif;
             ?>
        </div>
    </div>

<?php get_footer(); ?>