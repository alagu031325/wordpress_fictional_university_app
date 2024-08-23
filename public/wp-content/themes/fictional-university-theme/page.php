<!-- universal default fallback for this file is index.php -->
<?php 
    get_header();
    //Single page are rendered using page.php
    while(have_posts()){
        the_post();
        pageBanner();
        ?>

    <div class="container container--narrow page-section">
      <?php
      $theParent = wp_get_post_parent_id(get_the_ID());
      // returns 0 if the page doesnt have a parent page - and that evaluates to false
      if($theParent){ ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
          <a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent);?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent);?></a> <span class="metabox__main"><?php the_title();?></span>
        </p>
      </div>
        <?php 
      }
      ?>
      
      <?php  
    //   returns the list of pages of particular id
      $hasChildren = get_pages(array(
        'child_of' => get_the_ID(),
      ));
      if($theParent or $hasChildren) { ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent)?>"><?php 
        //if the parent id is 0 , then returns the title of current page
        echo get_the_title($theParent)
        ?></a></h2>
        <ul class="min-list">
          <?php
          if($theParent){
            $findChildrenOf = $theParent;
          }
          else{
            $findChildrenOf = get_the_ID();
          }
        //   associative array associates a value with each item - if we set the title to NULL then 'pages' title will not appear - list pages very similar to get pages but outputs the pages on the screen
          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order',
          ));
          ?>
        </ul>
      </div>
      <?php } ?>

      <div class="generic-content">
        <?php the_content();?>
      </div>
    </div>
<?php
    }
    get_footer();
?>
