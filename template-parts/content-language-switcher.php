<?php
/**
 * Template part for displaying the language switcher in the header
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package horatiusava
 */

?>

<ul class="language_switch">
    <li>
        <a class="de_lang" <?php
        if (ICL_LANGUAGE_CODE == "en") {
            echo 'data-current="en"';
        } else {
            echo 'data-current="de"';
        }
        ?> href="/">de</a>
    </li>
    <li><a class="break">|</a></li>
    <li>
        <a class="en_lang" <?php
        if (ICL_LANGUAGE_CODE == "en") {
            echo 'data-current="en"';
        } else {
            echo 'data-current="de"';
        }
        ?> href="/en/">en</a></li>                                   
</ul>  