<?php
/**
 * Plugin Name: Testimonials Masonry Grid
 * Description: Masonry grid for testimonials using WordPress’ built-in Masonry. Use shortcode: [testimonials_masonry posts_per_page="12" order="DESC" columns="4"]
 * Version: 1.0.0
 * Author: Shawn Kelshaw / Windsurf
 */

if (!defined('ABSPATH')) exit;

class TM_Masonry_Testimonials {
    public function __construct() {
        add_action('init', [$this, 'register_cpt']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_shortcode('testimonials_masonry', [$this, 'shortcode']);
        add_action('after_setup_theme', function() {
            add_theme_support('post-thumbnails', ['testimonial']);
        });
    }

    public function register_cpt() {
        $labels = [
            'name'                  => 'Testimonials',
            'singular_name'         => 'Testimonial',
            'menu_name'             => 'Testimonials',
            'name_admin_bar'        => 'Testimonial',
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New Testimonial',
            'new_item'              => 'New Testimonial',
            'edit_item'             => 'Edit Testimonial',
            'view_item'             => 'View Testimonial',
            'all_items'             => 'All Testimonials',
            'search_items'          => 'Search Testimonials',
            'not_found'             => 'No testimonials found.',
            'not_found_in_trash'    => 'No testimonials found in Trash.'
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'menu_icon'          => 'dashicons-testimonial',
            'supports'           => ['title', 'editor', 'thumbnail', 'excerpt'],
            'has_archive'        => false,
            'rewrite'            => ['slug' => 'testimonial'],
            'show_in_rest'       => true, // Gutenberg friendly
        ];

        register_post_type('testimonial', $args);
    }

    public function enqueue_assets() {
        // Styles
        wp_register_style('tm-masonry-style', plugins_url('assets/testimonials-masonry.css', __FILE__), [], '1.0.0');
        wp_enqueue_style('tm-masonry-style');

        // Scripts: WordPress bundles Masonry + imagesLoaded
        wp_enqueue_script('imagesloaded');
        wp_enqueue_script('masonry');

        // Our init script
        wp_register_script('tm-masonry-init', plugins_url('assets/testimonials-masonry.js', __FILE__), ['jquery', 'masonry', 'imagesloaded'], '1.0.0', true);
        wp_enqueue_script('tm-masonry-init');
    }

    public function shortcode($atts) {
        $atts = shortcode_atts([
            'posts_per_page' => 12,
            'order'          => 'DESC',
            'orderby'        => 'date',
            'columns'        => 4, // affects CSS via data attribute
            'category'       => '', // optional taxonomy if you add one later
        ], $atts, 'testimonials_masonry');

        $args = [
            'post_type'      => 'testimonial',
            'posts_per_page' => intval($atts['posts_per_page']),
            'order'          => sanitize_text_field($atts['order']),
            'orderby'        => sanitize_text_field($atts['orderby']),
            'no_found_rows'  => true,
        ];

        $q = new WP_Query($args);

        ob_start();

        $columns = max(1, min(6, intval($atts['columns']))); // clamp 1–6
        ?>
        <div class="tm-wrap" data-columns="<?php echo esc_attr($columns); ?>">
            <div class="tm-grid">
                <div class="tm-sizer"></div>
                <div class="tm-gutter-sizer"></div>
                <?php if ($q->have_posts()) : while ($q->have_posts()) : $q->the_post(); ?>
                    <?php
                    $client = get_the_title();
                    $role   = get_post_meta(get_the_ID(), 'client_role', true); // optional custom field
                    $company= get_post_meta(get_the_ID(), 'client_company', true); // optional custom field
                    $cite   = trim(implode(' · ', array_filter([$client, $role, $company])));
                    $avatar = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                    if (!$avatar) {
                        $avatar = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    }
                    ?>
                    <article class="tm-item" aria-label="<?php echo esc_attr($client); ?>">
                        <?php if ($avatar): ?>
                            <img class="tm-avatar" src="<?php echo esc_url($avatar); ?>" alt="<?php echo esc_attr($client); ?>">
                        <?php endif; ?>
                        <blockquote class="tm-quote">
                            <?php the_content(); ?>
                        </blockquote>
                        <?php if ($cite): ?>
                            <footer class="tm-cite">— <?php echo esc_html($cite); ?></footer>
                        <?php endif; ?>
                    </article>
                <?php endwhile; wp_reset_postdata(); else: ?>
                    <p class="tm-empty">No testimonials found.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}
new TM_Masonry_Testimonials();