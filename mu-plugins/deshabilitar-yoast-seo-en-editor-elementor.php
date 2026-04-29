<?php

    // Desactiva Yoast SEO SOLO en contexto Elementor (admin + AJAX)
    add_filter('option_active_plugins', function ($plugins) {

        // Detectar Elementor editor o AJAX de Elementor
        $es_elementor =
            (isset($_GET['action']) && $_GET['action'] === 'elementor') ||
            (isset($_POST['action']) && strpos($_POST['action'], 'elementor') !== false) ||
            (defined('DOING_AJAX') && DOING_AJAX && isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'elementor') !== false);

        if ($es_elementor) {
            return array_values(array_filter($plugins, function ($plugin) {
                return strpos($plugin, 'wordpress-seo') === false;
            }));
        }

    return $plugins;
    
    });