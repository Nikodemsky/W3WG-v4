<?php

// Register Custom Taxonomy for languages
function language_tax() {

	$labels = array(
		'name'                       => _x( 'Języki', 'Taxonomy General Name', 'wg-blank' ),
		'singular_name'              => _x( 'Język', 'Taxonomy Singular Name', 'wg-blank' ),
		'menu_name'                  => __( 'Języki', 'wg-blank' ),
		'all_items'                  => __( 'Wszystkie języki', 'wg-blank' ),
		'parent_item'                => __( 'Język nadrzędny', 'wg-blank' ),
		'parent_item_colon'          => __( 'Język nadrzędny:', 'wg-blank' ),
		'new_item_name'              => __( 'Nowa nazwa języka', 'wg-blank' ),
		'add_new_item'               => __( 'Nowy język', 'wg-blank' ),
		'edit_item'                  => __( 'Edytuj język', 'wg-blank' ),
		'update_item'                => __( 'Aktualizuj język', 'wg-blank' ),
		'view_item'                  => __( 'Zobacz język', 'wg-blank' ),
		'separate_items_with_commas' => __( 'Odseparuj języki przecinkami', 'wg-blank' ),
		'add_or_remove_items'        => __( 'Dodaj lub usuń język', 'wg-blank' ),
		'choose_from_most_used'      => __( 'Wybierz z najczęściej używanych', 'wg-blank' ),
		'popular_items'              => __( 'Najczęściej używane', 'wg-blank' ),
		'search_items'               => __( 'Szukaj języków', 'wg-blank' ),
		'not_found'                  => __( 'Brak znalezionych językó', 'wg-blank' ),
		'no_terms'                   => __( 'Brak języków', 'wg-blank' ),
		'items_list'                 => __( 'Lista języków', 'wg-blank' ),
		'items_list_navigation'      => __( 'Nawigacyjna lista języków', 'wg-blank' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => false,
	);
	register_taxonomy( 'web-lang', array( 'post', 'page', 'projekt' ), $args );

}
add_action( 'init', 'language_tax', 0 );