<?php 
/**
 * Template Name: CALMAQ+ - Calculadora
 *
 * @package CALAC+
 * @subpackage page
 */

wp_enqueue_style( 'js_composer-css', site_url() . '/wp-content/plugins/js_composer/assets/css/js_composer.min.css?ver=8.0' );    

#### bootstrap4 
wp_enqueue_style( 'bootstrap-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css' );    
wp_enqueue_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js', array( 'jquery' ), true );


wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js', array( 'jquery' ), true );
wp_localize_script(
	'bootstrap-js',
	'theme_vars',
	array(
		'THEME_URL' => THEME_URL
	)
);

##calmaq
wp_enqueue_style( 'calmaq-css', THEME_URL . 'css/calmaq.css' );    
wp_enqueue_script('calmaq-js', THEME_URL . 'js/calmaq.js', array( 'jquery' ), true  );    
    


get_header(); 

if ( have_posts() ) : 
    while ( have_posts() ) : 
        the_post();
        
        $pageTitle= get_field('custom_title');
        $pageTitle= $pageTitle?$pageTitle: '<h1>'.get_the_title().'</h1>';

        $img= wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full');
?>
<div id="page_content" class="page_content" style="margin: 0;" role="main">
    <div class="row clr">
        <div class="s12 clr">
            <div class="cz_is_blank clr">
                <div class="cz_post_content clr">
                    <div class="wpb-content-wrapper">
                        <div
                            data-vc-full-width="true"
                            data-vc-full-width-init="true"
                            data-vc-parallax="1"
                            data-vc-parallax-image="#"
                            data-vc-parallax-image-lazyload="<?php echo site_url() ?>/wp-content/uploads/2024/10/header-ti.jpg"
                            class="vc_row wpb_row vc_row-fluid vc_custom_1731955012187 vc_row-has-fill vc_general vc_parallax vc_parallax-content-moving lazyDone"
                            style="position: relative; left: -45.5px; box-sizing: border-box; width: 1291px; max-width: 1291px; padding-left: 45.5px; padding-right: 45.5px;">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div class="vc_row wpb_row vc_inner vc_row-fluid vc_custom_1731955081283">
                                            <div class="wpb_column vc_column_container vc_col-sm-3">
                                                <div class="vc_column-inner">
                                                    <div class="wpb_wrapper">
                                                        <div
                                                            id="cz_76717"
                                                            class="cz_76717 cz_image clr cz_image_no_fx center_on_mobile">
                                                            <div class="">
                                                                <div class="cz_image_in">
                                                                    <div class="cz_main_image">
                                                                        <img
                                                                            decoding="async"
                                                                            width="147"
                                                                            height="169"
                                                                            src="<?php echo site_url() ?>/wp-content/uploads/2024/11/icon-12.png"
                                                                            data-src=""
                                                                            class="attachment-full lazyDone"
                                                                            alt=""
                                                                            title="icon-12"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wpb_column vc_column_container vc_col-sm-6">
                                                    <div class="vc_column-inner">
                                                        <div class="wpb_wrapper">
                                                            <div class="cz_gap clr " style="height: 80px"></div>
                                                            <div
                                                                id="cz_34404"
                                                                class="cz_34404 cz_title clr cz_mobile_text_center cz_title_pos_inline tac">
                                                                <div class="cz_title_content">
                                                                    <div class="cz_wpe_content">
                                                                        <h2 style="text-align: center;"><?php echo $pageTitle  ?></h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="wpb_column vc_column_container vc_col-sm-3">
                                                    <div class="vc_column-inner">
                                                        <div class="wpb_wrapper"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cz_gap clr " style="height: 70px"></div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="vc_parallax-inner skrollable skrollable-between"
                                    data-bottom-top="top: 0%;"
                                    data-top-bottom="top: 0%;"
                                    style="height: 100%; background-image: url(&quot;<?php echo site_url() ?>/wp-content/uploads/2024/10/header-ti.jpg&quot;); top: 0%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="page-content page-calmaq" >        
        
        
        <section class="page-body pt-5" >
            <div class="container">
                <div class="calmaq-intro">
                    <div class="row">
                        <div class="col-lg-6 info">
                            <?php the_content(); ?>  
                        </div>
                        <div class="col-lg-5 form">
                            <h3><i class="fas fa-plus-square"></i> <?php __e( 'ELIGE LAS OPCIONES DESEADAS') ?></h3>

                            <form action="" id="form-step-1" class="form-step-1 pb-5">
                                <h4><?php __e( 'Tiempo de proyecto (días)') ?></h4>
                                <div class="form-group mb-5">
                                    <div class="input-group">
                                        <input type="number" min="1" name="project-time" id="project-time" class="form-control" placeholder="<?php __e( 'Elegir días') ?>" inputmode="numeric" require >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="project-r"><?php __e( 'días') ?></span>
                                        </div>
                                    </div>
                                </div>
                                <h4><?php __e( 'Combustible') ?></h4>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input input-fuel" name="fuel" id="fuel-1" value="1" checked>
                                        <?php __e( 'Seleccione si quiere definir la cantidad de azufre en el diésel') ?>
                                    </label>
                                </div>
                                <div class="form-group mb-3 input-azufre pt-2">
                                    <div class="input-group">
                                        <input type="number" min="1"  name="azufre" id="azufre" class="form-control" placeholder="<?php __e( 'Elegir candidad de azufre en diésel') ?>" inputmode="numeric" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="azufre-r"><?php __e( 'ppm') ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mb-5">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input input-fuel" name="fuel" id="fuel-2" value="0" >
                                        <?php __e( 'Seleccione si quiere que la herramienta defina la cantidad de azufre según norma colombiana azufre en diésel (ppm)') ?>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-lg"><?php __e( 'Enviar') ?></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="calmaq-grid">
                    <h3 class="mt-0 mr-5 ml-5 mb-3"><?php __e( 'Herramienta para cálculo de emisiones contaminantes de') ?> <br><?php __e( 'Maquinaria Móvil No de Carretera') ?></h3>

                    <p><?php __e('Indicar en la tabla las características de sus equipos para proceder con el calculo de resultados. Puede editar los datos de ejemplo.') ?></p>
                    <div class="table-scroll">
                        <table class="table-record table table-sm table-striped table-bordered table-hover table-sm ">
                            <thead class="table-primary">
                                <tr>
                                    <th></th>
                                    <th><?php __e('Rubro') ?></th>
                                    <th><?php __e('Tipo') ?></th>
                                    <th><?php __e('Año modelo') ?></th>
                                    <th><?php __e('Potencia') ?> <br><?php __e('(kW)') ?></th>
                                    <th><?php __e('Nivel de actividad') ?> <br><?php __e('(horas año)') ?></th>
                                    <th><?php __e('Estándar de Emisiones') ?></th>
                                    <th><?php __e('Cantidad') ?></th>
                                    <th><?php __e('Rango de Potencia') ?></th>
                                    <th width="120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-lg btn-secondary btn-result"><i class="fas fa-calculator"></i> <?php __e('Calcular') ?></button>
                        <button type="button" class="btn btn-lg btn-light btn-edit" data-id="new"><i class="fas fa-plus"></i> <?php __e('Añadir campo') ?></button>
                        <button type="button" class="btn btn-lg btn-info btn-reset"><i class="fab fa-wpforms"></i> <?php __e('Reiniciar') ?></button>
                    </div>
                </div>
                <div class="calmaq-result">
                    <h3 class="mt-0 mr-5 ml-5 mb-3"><i class="fas fa-plus-square"></i> <?php __e('Resultados') ?></h3>
                    <div class="table-scroll">
                        <table class="table-result table table-sm table-striped table-bordered table-hover table-sm ">
                            <thead class="table-primary">
                                <tr>
                                    <th></th>
                                    <th><?php __e('Total') ?><br><?php __e('[t/proyecto]') ?></th>
                                    <th><?php __e('Total') ?><br><?php __e('[kg/proyecto]') ?></th>
                                    <th><?php __e('Emisiones específicas de la flota') ?><br><?php __e('[g/kWh]') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th><?php __e('Hidrocarburo ') ?> (HC)</th>
                                    <td class="hc_t" >0</td>
                                    <td class="hc_t_k" >0</td>
                                    <td class="hc_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Monóxido de Carbono') ?> (CO)</th>
                                    <td class="co_t" >0</td>
                                    <td class="co_t_k" >0</td>
                                    <td class="co_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Óxidos de Nitrógeno') ?> (NOx)</th>
                                    <td class="no_t" >0</td>
                                    <td class="no_t_k" >0</td>
                                    <td class="no_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Material Particulado') ?> (PM<sub>10</sub>)</th>
                                    <td class="pm10_t" >0</td>
                                    <td class="pm10_t_k" >0</td>
                                    <td class="pm10_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Material Particulado') ?> (PM<sub>2.5</sub>)</th>
                                    <td class="pm25_t" >0</td>
                                    <td class="pm25_t_k" >0</td>
                                    <td class="pm25_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Carbono Negro') ?> (BC)</th>
                                    <td class="bc_t" >0</td>
                                    <td class="bc_t_k" >0</td>
                                    <td class="bc_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Dióxido de Carbono') ?> (CO<sup>2</sup>)</th>
                                    <td class="dco_t" >0</td>
                                    <td class="dco_t_k" >0</td>
                                    <td class="dco_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Dióxido de Azufre') ?> (SO<sub>2</sub>)</th>
                                    <td class="dso_t" >0</td>
                                    <td class="dso_t_k" >0</td>
                                    <td class="dso_t_g" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('BSFC') ?></th>
                                    <td class="bsfc_t" >0</td>
                                    <td class="bsfc_t_k" >0</td>
                                    <td class="bsfc_t_g" >0</td>
                                </tr>
                                <tr>
                                    <td colspan="4">&nbsp</td>
                                </tr>  
                                
                                <tr>
                                    <th><?php __e('Azufre en el diésel') ?> [<?php __e('ppm') ?>]</th>
                                    <td class="azufre_ppm" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Azufre en el diésel') ?> [<?php __e('%') ?>]</th>
                                    <td class="azufre_perc" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Densidad del diésel') ?> [<?php __e('kg/m3') ?>]</th>
                                    <td class="diesel_kgm3" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Densidad del diésel') ?> [<?php __e('g/gal') ?>]</th>
                                    <td class="diesel_ggal" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Low Heating Value') ?> [<?php __e('MJ/kg') ?>]</th>
                                    <td class="lowheat_ggal" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Low Heating Value') ?> [<?php __e('kWh/gal') ?>]</th>
                                    <td class="lowheat_kWh" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Tiempo del proyecto') ?> [<?php __e('días') ?>]</th>
                                    <td class="result_d11" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Factor del proyecto en años') ?></th>
                                    <td class="result_d12" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Consumo de diésel') ?> [<?php __e('gal/proyecto') ?>]</th>
                                    <td class="result_d13" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Energía consumida') ?> [<?php __e('MWh/proyecto') ?>]</th>
                                    <td class="result_d14" >0</td>
                                </tr>
                                <tr>
                                    <th><?php __e('Trabajo realizado') ?> [<?php __e('MWh/proyecto') ?>]</th>
                                    <td class="result_d15" >0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h3 class="mt-5 mr-5 ml-5 mb-3"><i class="fas fa-plus-square"></i> <?php __e('Cálculos') ?></h3>
                    <div class="accordion" id="accordionResult">
                        <div class="card">
                            <div class="card-header" id="headingMachine">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseMachine" aria-expanded="false" aria-controls="collapseMachine">
                                <?php __e('Información de la maquinaria') ?>
                                </button>
                                </h2>
                            </div>      
                            <div id="collapseMachine" class="collapse " aria-labelledby="headingMachine" data-parent="#accordionResult">
                                <div class="card-body">                                    
                                    <div class="table-scroll">
                                        <table class="table table-sm table-striped table-bordered table-hover table-sm ">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th><?php __e('ID') ?></th>
                                                    <th><?php __e('Edad') ?> [<?php __e('años') ?>]</th>
                                                    <th><?php __e('SCC') ?></th>
                                                    <th><?php __e('Factor de carga') ?></th>
                                                    <th><?php __e('Factor de Edad') ?></th>
                                                    <th><?php __e('Trabajo realizado') ?> [<?php __e('kWh/proyecto') ?>]</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingCycle">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCycle" aria-expanded="false" aria-controls="collapseCycle">
                                <?php __e('Factores de Ajuste a Ciclo Transitorio') ?>
                                </button>
                                </h2>
                            </div>
                            <div id="collapseCycle" class="collapse" aria-labelledby="headingCycle" data-parent="#accordionResult">
                                <div class="card-body">                              
                                    <div class="table-scroll">                                                                      
                                        <table class="table table-sm table-striped table-bordered table-hover table-sm ">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th><?php __e('ID') ?></th>
                                                    <th><?php __e('FAT') ?> <?php __e('HC') ?></th>
                                                    <th><?php __e('FAT') ?> <?php __e('CO') ?></th>
                                                    <th><?php __e('FAT') ?> <?php __e('NOx') ?></th>
                                                    <th><?php __e('FAT') ?> <?php __e('PM') ?></th>
                                                    <th><?php __e('FAT') ?> <?php __e('BSFC') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingDeterioration">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseDeterioration" aria-expanded="false" aria-controls="collapseDeterioration">
                                <?php __e('Deterioro') ?>
                                </button>
                                </h2>
                            </div>
                            <div id="collapseDeterioration" class="collapse" aria-labelledby="headingDeterioration" data-parent="#accordionResult">
                                <div class="card-body">                      
                                    <div class="table-scroll">   
                                        <table class="table table-sm table-striped table-bordered table-hover table-sm ">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th><?php __e('ID') ?></th>
                                                    <th><?php __e('HC_A') ?></th>
                                                    <th><?php __e('CO_A') ?></th>
                                                    <th><?php __e('NOx_A') ?></th>
                                                    <th><?php __e('PM_A') ?></th>
                                                    <th><?php __e('HC_FD') ?></th>
                                                    <th><?php __e('CO_FD') ?></th>
                                                    <th><?php __e('NOx_FD') ?></th>
                                                    <th><?php __e('PM_FD') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>  
                                    </div>
                                </div>  
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingEmission">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseEmission" aria-expanded="true" aria-controls="collapseEmission">
                                <?php __e('PM_FD') ?> [<?php __e('g/kWh') ?>]
                                </button>
                                </h2>
                            </div>
                            <div id="collapseEmission" class="collapse" aria-labelledby="headingEmission" data-parent="#accordionResult">
                                <div class="card-body">                
                                    <div class="table-scroll"> 
                                        <table class="table table-sm table-striped table-bordered table-hover table-sm ">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th><?php __e('ID') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('HC') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('CO') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('NOx') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('PM') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('BSFC') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('HC carter') ?></th>
                                                    <th><?php __e('CO2') ?> <?php __e('específico') ?></th>
                                                    <th><?php __e('SO2') ?> <?php __e('específico') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('PM2.5') ?></th>
                                                    <th><?php __e('FE') ?> <?php __e('BC') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTotal">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTotal" aria-expanded="false" aria-controls="collapseTotal">
                                <?php __e('Resultados Totales') ?> [<?php __e('g/proyecto') ?>]
                                </button>
                                </h2>
                            </div>      
                            <div id="collapseTotal" class="collapse" aria-labelledby="headingTotal" data-parent="#accordionResult">
                                <div class="card-body">               
                                    <div class="table-scroll">                                  
                                        <table class="table table-sm table-striped table-bordered table-hover table-sm ">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th><?php __e('ID') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('HC') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('CO') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('NOx') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('PM10') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('PM2.5') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('Carbono Negro') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('CO2') ?></th>
                                                    <th><?php __e('Emisiones') ?> <?php __e('SO2') ?></th>
                                                    <th><?php __e('BSFC') ?></th>
                                                    <th><?php __e('Consumo de combustible') ?> [<?php __e('gal/proyecto') ?>]</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <!-- <button type="button" class="btn btn-lg btn-secondary btn-download"><i class="fas fa-download"></i> Descargar</button> -->
                        <button type="button" class="btn btn-lg btn-secondary btn-update"><i class="fas fa-sync"></i> <?php __e('Actualizar') ?></button>
                        <button type="button" class="btn btn-lg btn-info btn-reset"><i class="fab fa-wpforms"></i> <?php __e('Reiniciar') ?></button>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="page-grid" >
            <div class="container">
                <h3><?php __e('Nuestras fuentes') ?></h3>

                <div class="row justify-content-center buttons">
                </div>

                <div class="details card">
                    <div class="card-body"></div>
                </div>
            </div>     
        </section>

        <div class="modal fade" id="modalRecord" tabindex="-1">
            <div class="modal-dialog">
                <form id="modalRecord-form" action="" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php __e('Editar Registro') ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label><?php __e('Rubro') ?></label>
                                <select class="form-control record-group" name="group">
                                </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                <label><?php __e('Tipo') ?></label>
                                <select class="form-control record-type" name="type">
                                </select>
                                </div>
                            </div>
                            <div class="col-6">                                
                                <div class="form-group">
                                <label><?php __e('Año modelo') ?></label>
                                <input type="numeric" inputmode="numeric" class="form-control record-year" name="year" value="2022" require >
                                </div>
                            </div>
                            <div class="col-6">                      
                                <div class="form-group">
                                    <label><?php __e('Potencia') ?></label>
                                    <div class="input-group">
                                        <input type="number" inputmode="numeric" name="power" class="form-control record-power" require placeholder="<?php __e('Elegir potencia') ?>" value="0" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="project-r"><?php __e('kW') ?></span>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label><?php __e('Nivel de actividad') ?></label>
                                    <div class="input-group">
                                        <input type="number" name="activity" class="form-control record-activity" placeholder="<?php __e('Elegir nivel') ?>" inputmode="numeric"  value="0" >
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="project-r"><?php __e('horas/año') ?></span>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-6">                                
                                <div class="form-group">
                                    <label><?php __e('Estándar de Emisiones') ?></label>
                                    <select class="form-control record-tier" name="emission"></select>
                                </div> 
                            </div>
                            <div class="col-6">                                
                                <div class="form-group">
                                <label><?php __e('Cantidad') ?></label>
                                <input type="numeric" inputmode="numeric" class="form-control record-quantity" name="quantity"  value="0" >
                                </div>
                            </div>
                            <div class="col-6">                                
                                <div class="form-group">
                                <label><?php __e('Rango de Potencia') ?></label>
                                <input type="text" readonly inputmode="numeric" class="form-control record-range" name="range" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><?php __e('Cancelar') ?></button>
                        <button type="submit" class="btn btn-secondary btn-save"><?php __e('Guardar') ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modalConfirm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="modalConfirmLabel"><?php __e('Confirmar cambio') ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php __e('¿Está seguro de realizar esta acción?') ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-ternary btn-cancel" ><?php __e('Cancelar') ?></button>
                        <button type="button" class="btn btn-warning btn-confirm" ><?php __e('Confirmar') ?></button>
                    </div>    
                </div>   
            </div>
        </div>
        
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
