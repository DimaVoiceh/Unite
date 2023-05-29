<?php class trueTopPostsWidget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'true_top_widget',
            'Агентства',
            array('description' => 'Агентства недвижимости')
        );
    }

    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        $q = new WP_Query("posts_per_page=-1&post_type=agency");

        $current_agency_id = isset($_GET["agency_id"]) ?  $_GET["agency_id"] : null;

        if ($q->have_posts()) : ?>
            <ul>
                <li><a data-id="0" class="agency-filter-link agency-link-js  <?php echo !$current_agency_id ? "active" : ""; ?>">Все</a> </li>
                <?php
                while ($q->have_posts()) : $q->the_post();
                ?>
                    <li>
                        <a data-id="<?php echo get_the_ID(); ?>" class="agency-filter-link agency-link-js <?php echo $current_agency_id == get_the_ID() ? "active" : ''; ?>"><?php the_title() ?></a>
                    </li>
                <?php
                endwhile;
                ?>
            </ul>
        <?php
        endif;
        wp_reset_postdata();

        echo $args['after_widget'];
    }


    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Заголовок</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

<?php
    }
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

        return $instance;
    }
}

function true_top_posts_widget_load()
{
    register_widget('trueTopPostsWidget');
}
add_action('widgets_init', 'true_top_posts_widget_load');
