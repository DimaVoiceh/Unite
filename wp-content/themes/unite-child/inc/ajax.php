<?php

add_action("wp_ajax_buildings", 'buildings_output');
add_action("wp_ajax_nopriv_buildings", 'buildings_output');
function buildings_output()
{

    get_template_part("template-parts/buildings-list");

    wp_die();
}
