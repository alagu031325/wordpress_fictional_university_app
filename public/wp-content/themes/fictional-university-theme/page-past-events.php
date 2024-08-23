<?php 

get_header();
pageBanner(array(
  'title' => 'Past Events',
  'subtitle' => 'A recap of our past events'
));
?>

<div class="container container--narrow page-section">

  <?php
    $today = date('Ymd');
    $pastEvents = new WP_Query(array(
      'posts_per_page' => '1',
      'paged' => get_query_var('paged', 1),
      'post_type' => 'event',
      'meta_key' => 'event_date',
      'orderby' => 'meta_value_num',
      'order' => 'ASC',
      'meta_query' => array(
        array(
          'key' => 'event_date',
          'compare' => '<',
          'value' => $today,
          'type' => 'numeric'
        )
      )
    ));
    while($pastEvents->have_posts()){
      $pastEvents->the_post();
      get_template_part('template-parts/content-event');
    }
    // only works with default queries that word press makes that is tied to current URL not with custome queries - so we need give it info
    echo paginate_links(array(
        'total' => $pastEvents->max_num_pages
    ));
  ?>

</div>

<?php

get_footer();

?>