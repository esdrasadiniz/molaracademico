<?php

    $educational_zone_theme_css= "";

    $educational_zone_scroll_position = get_theme_mod( 'educational_zone_scroll_top_position','Right');
    if($educational_zone_scroll_position == 'Right'){
        $educational_zone_theme_css .='#button{';
            $educational_zone_theme_css .='right: 20px;';
        $educational_zone_theme_css .='}';
    }else if($educational_zone_scroll_position == 'Left'){
        $educational_zone_theme_css .='#button{';
            $educational_zone_theme_css .='left: 20px;';
        $educational_zone_theme_css .='}';
    }else if($educational_zone_scroll_position == 'Center'){
        $educational_zone_theme_css .='#button{';
            $educational_zone_theme_css .='right: 50%;left: 50%;';
        $educational_zone_theme_css .='}';
    }