<?php get_header(); ?>
<body <?php body_class(); ?> >
<?php get_template_part("/template-parts/common/hero"); 
 // for including our custom file.php
 ?>
<div class="posts text-center">
     <?php
        if (is_month()) {
          $month = get_query_var("monthnum");
          $date_object = DateTime::createFromFormat("!m",$month);
          echo $date_object->format("F");
        }else if(is_year()){
         echo esc_html(get_query_var("year"));
        }else if(is_day()){
          printf("%s%s%s",get_query_var("day"),get_query_var("monthnum"),get_query_var("year"));
        }
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