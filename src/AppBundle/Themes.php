<?php
/**
 * Created by PhpStorm.
 * User: andrzej
 * Date: 28.10.17
 * Time: 16:31
 */

namespace AppBundle;


class Themes {
    const THEMES = array(
        'dip' => 'informacjapublizna_org'
    );

    static function getThemesArray() {
        return array_map( function ( $key, $label ) {
            return array(
                "key"   => $key,
                "label" => $label
            );
        }, array_keys( self::THEMES ), self::THEMES );
    }
}
