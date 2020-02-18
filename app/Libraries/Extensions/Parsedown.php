<?php

namespace App\Libraries\Extensions;

class Parsedown extends \Parsedown
{
    protected function inlineImage($Excerpt)
    {
        $Inline = parent::inlineImage($Excerpt);

        if ( ! isset($Inline['element']['attributes']['title']))
        {
            return $Inline;
        }

        $size = $Inline['element']['attributes']['title'];

        if (preg_match('/^\d+x\d+$/', $size))
        {
            list($width, $height) = explode('x', $size);

            if ($width > 0) $Inline['element']['attributes']['width'] = $width;
            if ($height > 0) $Inline['element']['attributes']['height'] = $height;

            unset ($Inline['element']['attributes']['title']);
        }

        return $Inline;
    }
}
