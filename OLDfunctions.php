<?php 
if ( function_exists ('register_sidebar')) { 
    register_sidebar (array(
  'name' => 'Sidebar Loja',
  'id' => 's-loja',
  'description' => 'Sidebar utilizado na loja de assinatura.'
  )); 
} 

if ( function_exists ('register_sidebar')) { 
    register_sidebar (array(
  'name' => 'Sidebar parceiro',
  'id' => 's-parceiro',
  'description' => 'Sidebar utilizado no seja um parceiro'
  )); 
} 

/*ADD STYLE E FUNCIONS DO BGMP EM TODAS AS PAGINAS (ARRUMAR) */
function bgmpShortcodeCalled()
{
    global $post;
    /*
    $shortcodePageSlugs = array(
        'hello-world',
        'second-page-slug'
    );
    
    if( $post )
        if( in_array( $post->post_name, $shortcodePageSlugs ) )*/
            add_filter( 'bgmp_map-shortcode-called', '__return_true' );
}
add_action( 'wp', 'bgmpShortcodeCalled' );

/* MODIFICA CAPACIDADES DE USUARIOS */
function add_theme_caps() {
    // gets the author role
    $role = get_role( 'editor' );

    // This only works, because it accesses the class instance.
    // would allow the author to edit others' posts for current theme only
    //$role->add_cap( 'edit_others_posts' );
    $role->remove_cap( 'edit_others_pages' );
    $role->add_cap( 'edit_theme_options' );
}
add_action( 'admin_init', 'add_theme_caps');

/* RENOMEIA MENUS */
function edit_admin_menus() {  
    global $menu;
    global $submenu;
    $menu[21][0] = 'Locais'; // Change Posts to Pomodoros
    $submenu['edit.php?post_type=bgmp'][5][0] = 'Listas locais';
    $submenu['edit.php?post_type=bgmp'][10][0] = 'Adicionar local';
    $submenu['edit.php?post_type=bgmp'][15][0] = 'Categorias dos locais';    
    //var_dump($submenu);die;
}  
add_action( 'admin_menu', 'edit_admin_menus' );

/* ADICIONA ICONES CUSTOMIZADOS */
function setBGMPDefaultIcon( $iconURL, $placemarkID )
{
    //if( $category-slug == "pizzarias" ) // change this to be whatever condition you want
    /*$placemarkCategories = wp_get_object_terms( $placemarkID, 'bgmp-category' );

	foreach( $placemarkCategories as $pc )
		if( $pc->slug == 'pizzarias' )
        $iconURL = get_bloginfo( 'stylesheet_directory' ) . '/imagens/icone-pizzaria.png';
        
    return $iconURL;*/
    $placemarkCategories = wp_get_object_terms( $placemarkID, 'bgmp-category' );

	foreach( $placemarkCategories as $pc )
		if( $pc->slug == 'pizzaria' )
			$iconURL = get_bloginfo( 'stylesheet_directory' ) . '/imagens/icone-pizzaria.png';

    return $iconURL;
}
add_filter( 'bgmp_default-icon', 'setBGMPDefaultIcon', 10, 2 );

?>