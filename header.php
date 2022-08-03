<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0,user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Ryan">

    <!-- Structured Data / Rich Snippets -->

    <!-- Load Head / Style Sheets -->
    <?php wp_head(); ?>
</head>

<body <?php body_class("global"); ?> id="body">


    <?php get_template_part('template-parts/nav/content', 'nav-main'); ?>