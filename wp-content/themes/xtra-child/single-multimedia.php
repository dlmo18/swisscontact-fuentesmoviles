<?php 
/**
 * @package CALAC+
 * @subpackage post
 */
get_header(); 

if ( have_posts() ) : 
    while ( have_posts() ) : 
        the_post();
?>
<div class="page-content " > 
    
    <section class="container">
        <div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
            <?php if(function_exists('bcn_display'))
            {
                bcn_display();
            }?>
        </div>
    </section>
    <section class="post-content" >     
        <div class="container">

            <div class="row">
                <div class="col-12 col-lg-9 mb-3">

                    <header class="archive-header mb-3">
                        <h1 class="post-title"><?php the_title() ?></h1>
                    </header>

                    <div class="post-content">
                        <?php                     
                        if( in_category('eventos') || in_category('event') ) {
                            $dateIni= strtotime( get_field('date_ini') );
                            $dateEnd= strtotime( get_field('date_end') );

                            ?>
                            <div class="mb-3">
                                <a target="_blank" href="<?php echo get_calendar_link( get_post() )?>" class="badge badge-secondary mb-2 p-2">
                                    <i class="fa fa-calendar mr-2" aria-hidden="true"></i><?php echo ___('del').' '.strftime('%d %B %Y',$dateIni) .' '.___('al').' '. strftime('%d %B %Y',$dateEnd)  ?>
                                </a>
                                <span class="badge badge-primary mb-2 p-2">
                                    <i class="fa fa-map mr-2" aria-hidden="true"></i> <?php echo ___('Lugar') .': '. get_field('place') ?>
                                </span>
                            </div>                        
                            <?php
                        }
                        ?>

                        <?php                 
                        the_content();
                        ?>  
                    </div>                         

                </div>
                <div class="col-12 col-lg-3 pt-2">
                    <?php get_sidebar('multimedia'); ?>
                </div>
            </div>
        </div>      
    </section>    
</div>

    <?php endwhile; ?>
<?php else: ?>
    <?php get_404_template(); ?>
<?php endif; ?>
<?php get_footer(); ?>