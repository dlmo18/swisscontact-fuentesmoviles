<?php
/**
 * Template Name: Instalar y Migrar
 * Description: Template for installing and migrating content.
 *
 * @package WordPress
 * @subpackage Xtra Child
 * @since Xtra Child 1.0

Migrar las páginas de Información técnica (se adecuarán como publicaciones de wordpress), esto incluye 
○	https://programacalac.com/informacion-tecnica/
○	https://programacalac.com/info/estudios-y-guias/
○	https://programacalac.com/info/material-de-eventos/

Migrar las páginas de Herramientas (se adecuarán como plugins de wordpress), esto incluye 
○	https://programacalac.com/herramientas/
○	https://programacalac.com/herramientas/calmaq/
○	https://programacalac.com/herramientas/hebash/
○	https://programacalac.com/herramientas/hetrans/
○	https://programacalac.com/herramientas/hemaq/

Migrar las páginas de Multimedia (se adecuarán como publicaciones de wordpress), esto incluye 
○	https://programacalac.com/multimedia-es/
○	https://programacalac.com/multimedia_cat/fotos/
○	https://programacalac.com/multimedia_cat/infografias/
○	https://programacalac.com/multimedia_cat/videos/

Migrar las páginas de Normativas Maquinarias (se adecuarán como publicaciones de wordpress), esto incluye 
○	https://programacalac.com/politicas-y-normativas-mmnc-en-el-mundo/
*/
$pages=[
    'politicas-y-normativas-mmnc-en-el-mundo',
    'herramientas'
];

$result = [];

foreach ($pages as $slug) {
    // Buscar la página principal por slug
    $parent = get_page_by_path($slug, OBJECT, 'page');
    if ($parent) {
        // Guardar contenido de la página principal
        $result[$slug] = [
            'ID' => $parent->ID,
            'title' => get_the_title($parent->ID),
            'content' => apply_filters('the_content', $parent->post_content),
            'children' => []
        ];

        // Buscar páginas hijas
        $children = get_pages([
            'child_of' => $parent->ID,
            'parent' => $parent->ID,
            'post_type' => 'page',
            'sort_column' => 'menu_order'
        ]);

        foreach ($children as $child) {
            $result[$slug]['children'][] = [
                'ID' => $child->ID,
                'title' => get_the_title($child->ID),
                'content' => apply_filters('the_content', $child->post_content)
            ];
        }
    }
}

// Ejemplo de impresión del resultado
echo '<pre>';
echo json_enconde($result);
echo '</pre>';
// ...existing code...
