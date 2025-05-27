<?php
include_once '../wp-load.php';

global $status;
$status=[];

function look4_server_path($content) {
    $search=[
        '/wp-content/'
    ];

    $replace=[
        site_url() . '/wp-content/'
    ];

    return str_replace($search, $replace, $content);
}

function subir_imagen_desde_url($url, $post_id = 0) {
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    // Descarga el archivo temporalmente
    $tmp = download_url($url);

    if (is_wp_error($tmp)) {
        return false;
    }

    // Prepara el array de archivo simulado
    $file_array = array(
        'name'     => basename($url),
        'tmp_name' => $tmp
    );

    // Sube a la biblioteca de medios
    $id = media_handle_sideload($file_array, $post_id);

    // Elimina el archivo temporal si hubo error
    if (is_wp_error($id)) {
        @unlink($file_array['tmp_name']);
        return false;
    }

    return $id; // Devuelve el ID del adjunto
}

function install_taxonomies($tax_name,$tax_type,$post_id) {
    
    $term = term_exists($tax_name,$tax_type);
    
    if(!$term) {
        $term = wp_insert_term($tax_name, $tax_type);
    }
    
    if(!is_wp_error($term)) {
        $term_id = $term['term_id'];
        $post_terms = wp_get_post_terms($post_id, $tax_type, array('fields' => 'ids'));
        
        if(!in_array($term_id, $post_terms)) {
            wp_set_post_terms($post_id, array_merge($post_terms, array($tax_name)), $tax_type);
        }
    }
}

function set_link($post_id) {
    $link='<a href="'.get_permalink($post_id).'"><img class="alignnone size-full wp-image-1513" src="'.site_url().'/wp-content/uploads/2024/11/icono.png" alt="" width="47" height="34" /></a>';
    update_field('url_del_evento', $link, $post_id);
}

function subir_adjunto($file_url,$post_id) {

    $file_current=get_field('archivo', $post_id);
    if(!$file_current) {
        $file_path = str_replace('https://server/swisscontact-calac/','https://programacalac.com/',$file_url);
    
        $attachment_id=subir_imagen_desde_url($file_path, $post_id);
        
        update_field('archivo', $attachment_id, $post_id);

        return $attachment_id;
    }
    
    return false;
}

function install_post($data,$post_type='post'){
    global $status;

    echo "<div>{$data['slug']}</div>";

    $post=find_post_by_slug($data['slug'],$post_type);

    $post_data = [];
    $post_data['post_type'] = $post_type;
    $post_data['post_status'] = 'publish';
    $post_data['post_title'] = $data['title'];
    $post_data['post_content'] = look4_server_path($data['content']);
    $post_data['post_name'] = $data['slug'];
    $post_data['post_parent'] = $data['parent'];
    
    if($post) {
        $post->migrate_status = 'migrated';
        
        $post_data['ID'] = $post->ID;
        wp_update_post($post_data);
        
        echo "<div style='color:blue;'>Post <b>migrado</b> {$post->ID} : {$post->post_title} </div>";
    }
    else {
        
        $post_data['ID'] = 0;
        
        wp_insert_post($post_data);
        
        $post=find_post_by_slug($data['slug'],$post_type);

        if($post){
            $post->migrate_status = 'created';
            $status[$post->ID] = $data['slug'];
            echo "<div style='color:".($post->migrate_status=='created'?'green':'blue').";'>Post <b>{$post->migrate_status}</b> {$post->ID} : {$post->post_title} </div>";
        }
        else{
            echo "<div style='color:red;'>Post no creado</div>";
        }
    }

    if( $post_type=='multimedia') {
        foreach($data['multimedia_cat'] as $term) {
            install_taxonomies($term,'multimedia_cat',$post->ID);
        }
    }
    else if($post_type=='evento-de-cooperacio' || $post_type=='estudio_guia') {
        if($data['term_group']) {
            foreach($data['term_group'] as $term) {
                install_taxonomies($term,'temas',$post->ID);
            }
        }
        if($data['term_publicacion']) {
            foreach($data['term_publicacion'] as $term) {
                install_taxonomies($term,'tipo',$post->ID);
            }
        }
        if($data['term_country']) {
            foreach($data['term_country'] as $term) {
                install_taxonomies($term,'pais',$post->ID);
            }
        }
        if($data['file'] && $post_type=='estudio_guia' ) {
            subir_adjunto($data['file'],$post->ID);
        }

        if($post_type=='evento-de-cooperacio' ) {
            set_link($post->ID);
        }
        
        install_taxonomies('Programa CALAC+','area',$post->ID);
    }

    //upload image
    if($data['image']){
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        
        if(!$thumbnail_id) {
            $featured_media = subir_imagen_desde_url($data['image'], $post->ID);
            if ($featured_media) {
                set_post_thumbnail($post->ID, $featured_media); // Asigna como imagen destacada
                echo "*** featured_media: {$featured_media} :: ".$data['image'];
            } else {
                echo "<div style='color:red;'>Error al subir la imagen</div>";
            }
        }
        else {
            echo "::: featured_media: {$thumbnail_id} :: ".$data['image'];
        }
    }


    if($data['children']){
        echo "<div style='color:blue;'>--- Children (".count($data['children']).")</div>";
        foreach($data['children'] as $child){
            $child['parent'] = $post->ID;
            $res = install_post($child,$post_type);
        }
    }

    return $post;
}

function find_post_by_slug($slug,$type){
    global $wpdb;
    $post = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->posts} WHERE post_name= %s AND post_type = %s", $slug, $type));
    return $post ? $post : false;
}

$status=[];

$content=file_get_contents('migrate_content.json');
$content=json_decode($content, ARRAY_A);

// Ejemplo de uso:
// $image_url = 'https://ejemplo.com/imagen.jpg';
// $attachment_id = subir_imagen_desde_url($image_url);

// if ($attachment_id) {
//     echo "Imagen subida con ID: " . $attachment_id;
// } else {
//     echo "Error al subir la imagen.";
// }

echo "<h1>Importar</h1>";

if($content) {
    foreach($content as $p => $posts){
        echo "<h3>{$p} / ".count($posts)."</h3>";

        foreach($posts as $slug=>$post){

            $res = install_post($post,$p);            
        }
    }
}





