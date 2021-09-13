<?php

/**
 * @package tfjs_toxicity_classifier
 * @version 1.0
 **/

/**
Plugin Name: TensorFlow.js’ Toxicity Classifier
Plugin URI: https://sdardour.com/lab
Description: Shortcode: [tfjs-toxicity-classifier] | Place it inside any WordPress post or page | Demo: https://sdardour.com/lab/2020/tensorflow-js-toxicity-classifier-in-action/ | Based on Bootstrap and requires, therefore, the Bootstrap Plugin: https://sdardour.com/lab/2020/bootstrap-inside-wordpress-plugin/
Author: lab@sdardour.com
Version: 1.0
Author URI: https://sdardour.com/lab
**/

/* --- */

if (!function_exists("add_action")) {

    exit;

}

/* --- */

define("TFJS_TOXICITY_CLASSIFIER_URL", plugin_dir_url( __FILE__));
define("TFJS_TOXICITY_CLASSIFIER_DIR", plugin_dir_path(__FILE__));

/* --- */

$TFJS_TOXICITY_CLASSIFIER_CAN_BE_LOADED = 0;

function TFJS_TOXICITY_CLASSIFIER_TEMPLATE_REDIRECT()
{
    global $TFJS_TOXICITY_CLASSIFIER_CAN_BE_LOADED;

    if ((is_page() or is_single()) and (strpos(get_post(get_the_ID())->post_content, "[tfjs-toxicity-classifier]") !== false)) {

        $TFJS_TOXICITY_CLASSIFIER_CAN_BE_LOADED = 1;

    }

}

add_action("template_redirect", "TFJS_TOXICITY_CLASSIFIER_TEMPLATE_REDIRECT");

/* --- */

function TFJS_TOXICITY_CLASSIFIER_WP_ENQUEUE_SCRIPTS()
{

    global $TFJS_TOXICITY_CLASSIFIER_CAN_BE_LOADED;

    if ($TFJS_TOXICITY_CLASSIFIER_CAN_BE_LOADED === 1) {

        wp_enqueue_script("jquery");

        wp_enqueue_script(
            "tensorflow",
            "https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"
        );

        wp_enqueue_script(
            "tensorflow-model-toxicity",
            "https://cdn.jsdelivr.net/npm/@tensorflow-models/toxicity"
        );

        wp_enqueue_script(
            "tfjs-toxicity-classifier",
            TFJS_TOXICITY_CLASSIFIER_URL . "assets/appl.js",
            array("jquery", "tensorflow", "tensorflow-model-toxicity")
        );

        wp_enqueue_style(
            "tfjs-toxicity-classifier",
            TFJS_TOXICITY_CLASSIFIER_URL . "assets/appl.css"
        );

    }

}

add_action("wp_enqueue_scripts", "TFJS_TOXICITY_CLASSIFIER_WP_ENQUEUE_SCRIPTS");

/* --- */

function TFJS_TOXICITY_CLASSIFIER_HTM($atts)
{

    global $TFJS_TOXICITY_CLASSIFIER_CAN_BE_LOADED;

    if ($TFJS_TOXICITY_CLASSIFIER_CAN_BE_LOADED === 1) {

        return @file_get_contents(TFJS_TOXICITY_CLASSIFIER_DIR . "assets/appl.htm");

    } else {

        return "";

    }

}

add_shortcode("tfjs-toxicity-classifier", "TFJS_TOXICITY_CLASSIFIER_HTM");

/* --- */
