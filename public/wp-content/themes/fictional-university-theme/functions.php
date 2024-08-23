<?php
//behind the scenes file - this is where we can have conversation with the word press system itself

//Reusable functions - args assigned with NULL so makes it a optional parameter
function pageBanner($args = NULL){
    if(!isset($args['title'])){
        //pull in wp post page title as intelligence fallback
        $args['title'] = get_the_title();
    }

    if(!isset($args['subtitle'])){
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if(!isset($args['image'])){
        if(get_field('page_banner_background_image') AND !is_archive() AND !is_home()){
            $args['image'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else{
            $args['image'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
    ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['image']?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'];?></h1>
        <div class="page-banner__intro">
          <p><?php echo $args['subtitle'];?></p>
        </div>
      </div>
    </div>
<?php
}

// wordpress lets us give it instructions and tell it what to do using add_action fn
function university_resources(){
    //Load JS - Dependancy array can be NULL if the JS doesnt depend on any other JS files - 'true' loads js right before the closing body tag
    wp_enqueue_script('uni_main_js',get_theme_file_uri('/build/index.js'),array('jquery'),'1.0',true);
    //Load main css file - first arg - nick name and second arg is the location to file
    wp_enqueue_style('uni_main_stylesheet',get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('uni_additional_stylesheet',get_theme_file_uri('/build/index.css'));
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

//first argument is what type of instruction we are giving in - wp will run this code at different times and second argument is the name of the function we want to run
add_action('wp_enqueue_scripts','university_resources');

function university_features(){
    //enable a feature for our theme - title tag will automatically generated
    add_theme_support('title-tag');
    //enable featured image for blog post - but for custom post type we need to add it in professor post type registration
    add_theme_support('post-thumbnails');
    //to automatically generate image copies of specified size - if set 'true'/array of horizontal and vertical corners to crop to array('left','top') - WP will crop into the center of the photo - 400px width and 260px height
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
    //register_nav_menu('headerMenuLocation','Header Menu Location');
    //register another menu location
    //register_nav_menu('footerLocationOne','Footer Location One');
    //register_nav_menu('footerLocationTwo','Footer Location Two');
}

add_action('after_setup_theme','university_features');

function uni_adjusted_queries_for_event_archive($query){
    //passes wp query object while calling this function so that we can manipulate it
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
        //if it is only on the front end and on event archive page - we dont manipulate the custom query just the main query
        $today = date('Ymd');
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value_num');
        $query->set('order','ASC');
        $query->set('meta_query',array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));
    }
    //For changing the default program query - display all programs in one page and  ordering it in ascending order
    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
        $query->set('orderby','title');
        $query->set('order','ASC');
        $query->set('posts_per_page',-1);
    }
}

add_action('pre_get_posts', 'uni_adjusted_queries_for_event_archive');

function universityMapKey($api){
    $api['key'] = 'AIzaSyCzuksMdCFDKqZdKZ3L9m_Zqc1O6q2S9KQ';
    return $api;
}

add_filter('acf/fields/google_map/api','universityMapKey');