<?php
$show_block = get_field('show_block', $post_id);
if ($show_block['form_2']) :
    get_template_part('template-parts/blocks/form', null, array(
        'content_show' => '1',
        'section_id' => 'footer'
    ));
endif;
