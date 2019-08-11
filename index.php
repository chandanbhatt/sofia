<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sofia
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php
            if (have_posts()) :

                if (is_home() && !is_front_page()) :
                    ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php
                endif;

                $posts = get_posts();
                ?>
                <div class="container">
                <?php
                /* Start the Loop */
                foreach ($posts as $index=>$post) {
                    ?>

                        <div class="row post-row animate">
                            <div class="col-12 col-lg-10 col-xl-8 <?php if($index % 2 !== 0 && $index > 0) { echo 'offset-lg-2 offset-xl-4'; } ?>">
                                <a class="post-link" href="<?php echo $post->guid?>">
                                <div class="post-featured-image">
                                    <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>">
                                </div>
                                <div class="post-title">
                                <?php
                                    echo ($post->post_title);
                                ?>
                                </div>
                                <div class="post-excerpt">
                                    <?php
                                    echo $post->post_excerpt;
                                    ?>
                                </div>
                                <div class="post-meta">
                                    <?php
                                $diff = abs(time() - strtotime($post->post_date_gmt));

                                $post_date_gmt['years'] = floor($diff / (365*60*60*24));
                                $post_date_gmt['months'] = floor(($diff - $post_date_gmt['years'] * 365*60*60*24) / (30*60*60*24));
                                $post_date_gmt['days'] = floor(($diff - $post_date_gmt['years'] * 365*60*60*24 - $post_date_gmt['months']*30*60*60*24)/ (60*60*24));
                                $post_date_gmt['hours'] = floor(($diff - $post_date_gmt['years'] * 365*60*60*24 - $post_date_gmt['months']*30*60*60*24 - $post_date_gmt['days']*60*60*24) / (60*60));
                                $post_date_gmt['minutes'] = floor(($diff - $post_date_gmt['years'] * 365*60*60*24 - $post_date_gmt['months']*30*60*60*24 - $post_date_gmt['days']*60*60*24 - $post_date_gmt['hours']*60*60)/ 60);
                                $post_date_gmt['seconds'] = floor(($diff - $post_date_gmt['years'] * 365*60*60*24 - $post_date_gmt['months']*30*60*60*24 - $post_date_gmt['days']*60*60*24 - $post_date_gmt['hours']*60*60 - $post_date_gmt['minutes']*60));


                                foreach ($post_date_gmt as $key=>$post_time){
                                    if($post_time > 0){
                                        echo $post_time.' '.$key.' ago';
                                        break;
                                    }
                                }


                                ?>
                                </div>
                                </a>
                            </div>
                        </div>

                    <?php

                }
                ?>
                </div>
                <?php

                the_posts_navigation();

            else :

                get_template_part('template-parts/content', 'none');

            endif;
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
