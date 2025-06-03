<?php 
/**
 * @package CALAC+
 * @subpackage archive
 */
get_header(); 

wp_reset_postdata();

//get term data

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// The Query
$tax_query=array();
$args = array( 
    'post_type' => 'multimedia',
    'paged'     => $paged,
    'posts_per_page' => 10
);

$term = get_queried_object(); 
if( isset($term->term_id) ) {
    $tax_query[] = array (
        'taxonomy' => 'multimedia_cat',
        'field' => 'slug',
        'terms' => $term->slug,
    );

    $args['tax_query'] = $tax_query;
}

$query = new WP_Query( $args );

?>
<div class="page-content archive-content" >
    
    <section class="page-banner" >
        <div class="container">
            <div class="block">
                <div class="row">                                
                    <div class="offset-1 col-10 col-md-8 col-md-5">
                        <h1 class="archive-title">							
                        <?php
                            __e( 'Multimedia');
                        ?>
                        </h1>
                    </div>                        
                </div>
            </div>
        </div>
    </section>
    
    <section class="container">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
        </div>
    </section>
    <div class="container archive-multimedia">
        <div class="row">
            <div class="col-12 col-lg-9 mb-3">
                <div class="row">
                    <?php 
                    if ( $query->have_posts() ) : 
                        while ( $query->have_posts() ) : 
                            $query->the_post();
                            $image=get_the_post_thumbnail_url( get_the_ID() );
                            $cats=wp_get_post_terms( get_the_ID(), 'multimedia_cat' );
                            
                            $classSp='';
                            if($cats) {
                                foreach($cats as $c) {
                                    $classSp.=' cat-'.$c->slug;
                                }
                            }
                            ?>
                        <article class="article mb-2 col-md-6">
                            <div class="card h-100 <?php echo $classSp ?>">
                                <div class="card-body">
                                    <a href="<?php echo get_permalink() ?>" class="image" <?php echo get_image_bg($image) ?> >
                                        <?php echo strstr('video',$classSp) ?'<i class="fa fa-play-circle" aria-hidden="true"></i>':'' ?> 
                                    </a>
                                    <h2 class="title"><a href="<?php echo get_permalink() ?>" ><?php the_title()?></a></h2>
                                    <div class="control row">
                                        <div class="col-6">
                                            <a href="<?php echo get_permalink() ?>" class="link"><i class="fa fa-arrow-right"></i>&nbsp;<?php __e('Ver más')?></a>
                                        </div>
                                        <div class="col-6 text-right">
                                            <label class="badge badge-secondary mb-2 p-2">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>&nbsp;<?php echo get_the_date() ?>                         
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>    
                            <?php  

                        endwhile; // end of the loop. 

                    else:
                        get_template_part( 'templates/empty' ); // loading our custom file    
                    endif;

                ?>
                </div>
                <?php get_pagination($query); ?>    
            </div>
            <div class="col-12 col-lg-3 pt-2">
                <?php get_sidebar('multimedia'); ?>
            </div>
        </div>
                
    </div>    
</div>
<?php 
get_footer(); 
