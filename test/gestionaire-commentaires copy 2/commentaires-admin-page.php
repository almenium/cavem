<?php

/*
Plugin Name: Commentaires
Plugin URI: https://cavem.com/
Description: plugin commentaire avec base de donnée différente de worpress
Author: MENIER Alexia
Version: 1.0
Author URI: http://cavem.com/
*/
require_once 'fonctions.php';


add_action( 'admin_menu', 'my_comments_moderation' );
add_action('my_comments_moderation','my_comments_moderation_admin_page');


