<?php
if (!function_exists('blogbrute_main_banner')) :
    /**
     *
     * @since Blogbrute
     *
     */
    function blogbrute_main_banner() {
        if (is_front_page() || is_home()) {
            $blogarise_enable_main_slider = get_theme_mod('show_main_news_section',1);
            if ($blogarise_enable_main_slider){
                do_action('blogbrute_action_right_silder');
                do_action('blogbrute_action_trending_posts');
                do_action('blogbrute_action_featured_story');
            }
        }
    }
endif;
add_action('blogbrute_action_main_banner', 'blogbrute_main_banner', 40);

if (!function_exists('blogbrute_right_silder')) :
    /**
     *
     * @since Blogbrute
     *
     */
    function blogbrute_right_silder() { ?>
           
        <div class="col-md-8 cc">
            <div class="homemain bs swiper-container">
                <div class="swiper-wrapper">
                    <?php blogarise_get_block('list', 'banner'); ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <!--==/ Home Slider ==-->
        <!-- end slider-section -->
        <?php
    }
endif;
add_action('blogbrute_action_right_silder', 'blogbrute_right_silder', 40);


if (!function_exists('blogbrute_trending_posts')) :
    /**
     *
     * @since Blogbrute
     *
     */
    function blogbrute_trending_posts() { ?>
        <div class="col-md-4 cc">
            <div class="trending-posts">
                <?php
                    $blogarise_slider_category = get_theme_mod('trending_post_category', 0);
                    $blogarise_number_of_slides = 4;
                    $blogarise_all_posts_main = blogarise_get_posts($blogarise_number_of_slides, $blogarise_slider_category);
                    $blogarise_count = 1;

                    if ($blogarise_all_posts_main->have_posts()) :
                        while ($blogarise_all_posts_main->have_posts()) : $blogarise_all_posts_main->the_post();
                        global $post;
                        $blogarise_url = blogarise_get_freatured_image_url($post->ID, 'blogarise-featured');
                        ?>
                        <div class="small-post">
                            <div class="small-post-content">
                                <?php blogarise_post_categories(); ?>
                                <h5 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <div class="bs-blog-meta">
                                    <?php blogarise_date_content(); ?>
                                </div>
                            </div>
                            <?php if(!empty($blogarise_url)) { ?>
                            <div class="img-small-post back-img hlgr right">
                                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                                    <img src="<?php echo esc_url($blogarise_url); ?>" class="post-small-img" alt="<?php the_title(); ?>">
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                        <?php 
                        endwhile;
                    endif;
                    wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }
endif;
add_action('blogbrute_action_trending_posts', 'blogbrute_trending_posts', 40);

if (!function_exists('blogbrute_ticker_section')) :
    /**
     *
     * @since Blogbrute
     *
     */
    function blogbrute_ticker_section() { ?>
           
        <div class="news-ticker my-4">
            <div class="container">
                <?php do_action('blogarise_action_header_ticker_section'); ?>
            </div>
        </div>
        <?php
    }
endif;
add_action('blogbrute_action_ticker_section', 'blogbrute_ticker_section', 40);