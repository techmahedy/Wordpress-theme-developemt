<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php get_template_part("/template-parts/common/hero"); 
 // for including our custom file.php
 ?>
<div class="container">
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
                  echo strtoupper(get_the_author_meta("display_name"));
                  echo '</br>';
                  echo get_the_author_meta("description"); 
                ?>
            </div>
        </div>
    </div>
</div>

<div class="posts text-center">
     <?php
        single_tag_title(); //for showing current active tag
     ?>
    <?php 
        while(have_posts()){

        the_post(); ?>
      <h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
      <?php 
        } 
     ?>
   
 <div class="container">
     <div class="row">
         <div class="com-md-4"></div>
          <div class="com-md-8">
              <?php 
                    the_posts_pagination(array(
                        "screen_reader_text"=>' '
                    ));
               ?>
          </div>
     </div>
 </div>

</div>
<?php get_footer(); ?>