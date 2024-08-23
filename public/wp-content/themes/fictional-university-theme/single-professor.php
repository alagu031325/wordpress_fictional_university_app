<!-- universal default fallback for this file is index.php -->
<?php 
    get_header();
    //Single post are rendered using single.php
    while(have_posts()){
        //keeps tracks of the post that we are currently working with
        the_post();
        pageBanner();
        ?>
    

    <div class="container container--narrow page-section">

    <div class="generic-content">
        <div class="row group">
          <div class="one-third">
              <?php the_post_thumbnail('medium'); ?>
          </div>
          <div class="two-thirds">
              <?php the_content();?>
          </div>
        </div>
    </div>

    <?php
      //we shouldnt set the relationship between 2 posts more than once(like events and programs have one common relationship field - related programs)
      $relatedPrograms = get_field('related_programs');
      //evaluates to false if the variable doesnt have any content
      if($relatedPrograms){
      // print_r($relatedPrograms) - outputs all sorts of info about that variable
      ?>
      <hr class="section-break">
      <h2 class="headline headline--medium">Subject(s) Taught</h2>
      <ul class="link-list min-list">
      <?php
      
      foreach($relatedPrograms as $program){
        ?>
        <li><a href="<?php echo get_the_permalink($program);?>"><?php echo get_the_title($program)?></a></li>
        
        <?php
      }
    }
    ?>
    </ul>
    </div>
<?php
    }
    get_footer();
?>
