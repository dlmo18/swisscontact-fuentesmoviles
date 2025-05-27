<?php 
/**
 * Template Name: HEMAQ+ - Calculadora Lang
 *
 * @package CALAC+
 * @subpackage page
 */

wp_enqueue_script(THEME_NAME.'-chart-js', 'https://cdn.jsdelivr.net/npm/chart.js' , array(), THEME_VERSION , true );
wp_enqueue_script(THEME_NAME.'-hemaq-js', THEME_URL . '/js/partials/hemaq.js' , array(), THEME_VERSION , true );

get_header(); 

if ( have_posts() ) : 
    while ( have_posts() ) : 
        the_post();
        
        $pageTitle= get_field('custom_title');
        $pageTitle= $pageTitle?$pageTitle: '<h1>'.get_the_title().'</h1>';

        $img= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full');
?>
    <div class="page-content page-hemaq" >        
        <section class="page-banner" <?php echo $img?'style="background-image: url('.$img[0].')"':'' ?> >
            <div class="container">
                <div class="block">
                    <div class="row">                                
                        <div class="offset-1 col-10 col-md-8 col-md-5">
                            <?php echo $pageTitle  ?>
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

        <section class="page-body pb-5" >
            <div class="container">
            
                <nav>
                    <div class="nav nav-tabs" aria-labelledby="nav-tabContent" role="tablist">
                        <a class="nav-item nav-link " id="nav-tab-readme" data-toggle="tab" href="#tab-readme" role="tab" aria-controls="tb-readme" aria-selected="false"><?php __e('Leeme') ?></a>
                        <a class="nav-item nav-link active" id="nav-tab-st" data-toggle="tab" href="#tab-st" role="tab" aria-controls="tab-st" aria-selected="true"><?php __e('Principal') ?></a>
                        <a class="nav-item nav-link " id="nav-tab-ccacb" data-toggle="tab" href="#tab-ccacb" role="tab" aria-controls="tab-ccacb" aria-selected="false"><?php __e('Cálculos') ?></a>
                        <a class="nav-item nav-link " id="nav-tab-tdem" data-toggle="tab" href="#tab-tdem" role="tab" aria-controls="tab-tdem" aria-selected="false"><?php __e('Resultados') ?></a>
                        <a class="nav-item nav-link " id="nav-tab-dtax" data-toggle="tab" href="#tab-dtax" role="tab" aria-controls="tab-dtax" aria-selected="false"><?php __e('Datos') ?></a>
                    </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                    <!---leeme-->
                    <div class="tab-pane fade pt-2 " id="tab-readme" role="tabpanel" aria-labelledby="nav-tab-readme">
                        <?php the_content(); ?> 
                    </div>

                    <!---main-->
                    <div class="tab-pane fade show active" id="tab-st" role="tabpanel" aria-labelledby="nav-tb-st">
                        
                        <?php get_template_part( 'templates/hemaq/nav-start' ); ?> 
                        <div class="tab-content" id="nav-tabStart">
                            <div class="tab-pane fade pt-2 active show" id="tab-st-params" role="tabpanel" aria-labelledby="nav-start-params">
                                <?php get_template_part( 'templates/hemaq/start-params' ); ?> 
                            </div>
                            <div class="tab-pane fade pt-2" id="tab-st-sensibility" role="tabpanel" aria-labelledby="nav-start-sensibility">
                                <?php get_template_part( 'templates/hemaq/start-sensibility' ); ?> 
                            </div>
                            <div class="tab-pane fade pt-2" id="tab-st-distribution" role="tabpanel" aria-labelledby="nav-start-distribution">
                                <?php get_template_part( 'templates/hemaq/start-distribution' ); ?> 
                            </div>
                            <div class="tab-pane fade pt-2" id="tab-st-baseline" role="tabpanel" aria-labelledby="nav-start-baseline">
                                <?php get_template_part( 'templates/hemaq/start-baseline' ); ?> 
                            </div>
                        </div>
                    </div>

                    <!---calc-->
                    <div class="tab-pane fade" id="tab-ccacb" role="tabpanel" aria-labelledby="nav-tb-ccacb">
                        <?php get_template_part( 'templates/hemaq/calc-acb' ); ?> 
                        <?php get_template_part( 'templates/hemaq/calc-emisiones' ); ?> 
                        <?php get_template_part( 'templates/hemaq/calc-salud' ); ?> 
                        <?php get_template_part( 'templates/hemaq/calc-costos' ); ?> 
                    </div>

                    <!---result-->
                    <div class="tab-pane fade" id="tab-tdem" role="tabpanel" aria-labelledby="nav-tb-tdem">
                        <?php get_template_part( 'templates/hemaq/result-tdem' ); ?> 
                        <?php get_template_part( 'templates/hemaq/result-tdct' ); ?> 
                        <?php get_template_part( 'templates/hemaq/result-bdct' ); ?> 
                        <?php get_template_part( 'templates/hemaq/result-tdct' ); ?> 
                        <?php get_template_part( 'templates/hemaq/result-rsem' ); ?> 
                        <?php get_template_part( 'templates/hemaq/result-rspq' ); ?> 
                        <?php get_template_part( 'templates/hemaq/result-rsct' ); ?> 
                    </div>                   
                    
                    <!---data-->
                    <div class="tab-pane fade" id="tab-dtax" role="tabpanel" aria-labelledby="nav-tb-dtax">
                        <?php get_template_part( 'templates/hemaq/data-dtax' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtpb' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtti' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtai' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtif' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtrr' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtwe' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtot' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtpr' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtfe' ); ?> 
                        <?php get_template_part( 'templates/hemaq/data-dtdc' ); ?> 
                    </div>
                </div>        
            </div>
        </section>
                
        <div class="modal fade" id="modalWarning" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="modalConfirmLabel"><?php __e('Revisa tus datos') ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                    </div>    
                </div>   
            </div>
        </div>
    </div>
    <?php endwhile; ?>
<?php else: ?>
    <?php get_404_template(); ?>
<?php endif; ?>
<?php get_footer(); 
