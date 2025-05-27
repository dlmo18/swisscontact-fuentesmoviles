const calmaq = {
    'info': {
        'project_time': 123,
        'fuel': 1,
        'azufre': 200,
        'azufre_perc': 0,
        'diesel_kgm3': 856,
        'diesel_ggal': 0,
        'lowheat_MJkg': 43.829,
        'lowheat_kWhgal': 0
    },
    'data': [
        {
            'group' : 'Construcción',
            'type'  : 'Autohormigonera',
            'year'  : '2011',
            'power' : '500',
            'level' : '500',
            'emission'  : 'Tier 3',
            'quantity'  : '2'
        },
        {
            'group' : 'Agrícola',
            'type'  : 'Bulldozer',
            'year'  : '2019',
            'power' : '110',
            'level' : '1000',
            'emission'  : 'Tier 4IA',
            'quantity'  : '5'
        },
        {
            'group' : 'Industrial',
            'type'  : 'Barredora',
            'year'  : '2005',
            'power' : '200',
            'level' : '120',
            'emission'  : 'Tier 3',
            'quantity'  : '12'
        },
        {
            'group' : 'Construcción',
            'type'  : 'Carretilla apiladora',
            'year'  : '1990',
            'power' : '100',
            'level' : '948',
            'emission'  : 'Tier 0',
            'quantity'  : '3'
        }
    ],
    'result': null,
    'activity_level': null,
    'tier': null,
    'power': null,
    'ready':  function(){

        jQuery('.input-fuel').on('change',()=>{
            console.log('.input-fuel',jQuery('.input-fuel').val())
            if( jQuery('.input-fuel:checked').val()=='1' ) {
                jQuery('.input-azufre').show();
            }
            else {
                jQuery('.input-azufre').hide();
            }  
        })
        jQuery('#form-step-1').on('submit', this.submit)


        //grid
        jQuery(document).on('click','.btn-edit',this.grid_record)
        jQuery(document).on('click','.btn-delete',this.grid_alert)
        jQuery(document).on('click','.btn-cancel',this.grid_alert_close)
       
        jQuery('.btn-confirm').on('click',this.grid_remove)
        jQuery('.btn-reset').on('click',this.reset)
        jQuery('.btn-update').on('click',this.update)
        jQuery('.btn-result').on('click',this.grid_result)

        //form 
        jQuery('.record-group').on('change',this.form_type)//change type
        jQuery('.record-power').on('change',function(){
            
            let range=calmaq.form_power( jQuery('.record-power').val() );

            jQuery('.record-range').val(range)
            console.log("jQuery('.record-range').val(range)",range)
            
            //list 
            jQuery('.record-tier').html('')
            if(calmaq.power) {
                for(let p in calmaq.power) {
                    if( calmaq.power[p].varPower==range ) {
                        for(let t in calmaq.power[p].tier) {
                            jQuery('.record-tier').append('<option>'+calmaq.power[p].tier[t].varTier+'</option>')
                        }                        
                    }        
                }
            }
            
            
        }) 
        
        jQuery('#modalRecord-form').on('submit',calmaq.form_save)

        //fonts
        this.fonts();

    },
    'get_activity': function( group, type ){
        let result = null
        if( group in calmaq.activity_level ) {

            for(let i in calmaq.activity_level[group]  ) {
                if( calmaq.activity_level[group][i].name==type ) {
                    result = calmaq.activity_level[group][i]
                    break
                }
            }

        }

        return result
    },
    'get_tier': function(tier) {
        let result
        
        for(let i in calmaq.tier  ) {
            if( calmaq.tier[i].varTier==tier ) {
                result = calmaq.tier[i]
                break
            }
        }

        return result
    },
    'get_power': function( power ){
        power=parseInt( power );
        let range=null;

        if(calmaq.power) {
            for(let i in calmaq.power) {
                if( parseInt(calmaq.power[i].intHigh) > power ) {
                    range=calmaq.power[i]
                    break
                }
            }

            if(range==null) {
                range=calmaq.power[ (calmaq.power.length-1) ]
            }
        }

        return range
    },
    'calc': function(){
        
        calmaq.info.project_factor = calmaq.info.project_time / 365 
        
        let i = 0

        let row, activity, power, tier, power_tier
        let hc_k=0,hc_g=0,calc_work=0
        let result_grid={
            hc_t: 0,
            co_t: 0,
            no_t: 0,
            pm10_t: 0,
            pm25_t: 0,
            bc_t: 0,
            dco_t: 0,
            dso_t: 0,
            bsfc_t: 0
        }
        let result_d15=0,result_d14=0,result_d13=0

        let today=new Date()
        let year=today.getUTCFullYear()


        jQuery('#collapseMachine tbody').html('')
        jQuery('#collapseCycle tbody').html('')
        jQuery('#collapseDeterioration tbody').html('')
        jQuery('#collapseEmission tbody').html('')
        jQuery('#collapseTotal tbody').html('')
        

        for(i in calmaq.data) {

            row=calmaq.data[i]
            activity = calmaq.get_activity(row.group,row.type)
            power=calmaq.get_power(row.power)
            tier=calmaq.get_tier(row.emission)

            power_tier = ( tier.varTier in power.tier ) ? power.tier[tier.varTier] : {
                "floatFEHC": 0,
                "floatFECO": 0,
                "floatFENOx": 0,
                "floatFEPM": 0,
                "floatFEBSFC": 0,
                "floatFEPMSoxcnv": 0,
                "floatSoxcnv": 0.02247
            }
            
            row.calc_A='<small><strong>'+row.group+'</strong></small><br>'+row.type
            row.calc_B=( year>parseInt(row.year) ? year-parseInt(row.year) : 0),
            row.calc_C=activity.scc
            row.calc_D=activity.charge        

            
            if(power) {
                row.calc_E = row.level * row.calc_B * row.calc_D / power.intLifeHour
            }
            else {
                row.calc_E = null
            }

            row.calc_F = row.calc_D * row.power * row.level * row.quantity * calmaq.info.project_factor
            
            row.calc_G = row.emission.indexOf('Tier 4')>=0 ? 1 : activity.floatHC 
            row.calc_G = parseFloat(row.calc_G)

            row.calc_H = row.emission.indexOf('Tier 4')>=0 ? 1 : activity.floatCO 

            row.calc_I = row.emission.indexOf('Tier 4')>=0 ? 1 : ( row.emission.indexOf('Tier 3')>=0 ? activity.floatNOxT3 : activity.floatNOxT0  ) 

            row.calc_J = row.emission.indexOf('Tier 4')>=0 ? 1 : ( row.emission.indexOf('Tier 3')>=0 ? activity.floatPMT3 : activity.floatPMT0  ) 
            row.calc_J = parseFloat(row.calc_J)

            row.calc_K = row.emission.indexOf('Tier 4')>=0 ? 1 : activity.floatBSFC 
            row.calc_K = parseFloat(row.calc_K)

            row.calc_L = parseFloat(tier.floatHC_A)

            row.calc_M = parseFloat(tier.floatCO_A)

            row.calc_N = parseFloat(tier.floatNOx_A)

            row.calc_O = parseFloat(tier.floatPM_A)

            row.calc_P = row.calc_E>=1 ? (1 + row.calc_L) : (1 + (row.calc_L * row.calc_E) )

            row.calc_Q = row.calc_E>=1 ? (1 + row.calc_M) : (1 + (row.calc_M * row.calc_E) )

            row.calc_R = row.calc_E>=1 ? (1 + row.calc_N) : (1 + (row.calc_N * row.calc_E) )

            row.calc_S = row.calc_E>=1 ? (1 + row.calc_O) : (1 + (row.calc_O * row.calc_E) )

            row.calc_T = parseFloat(power_tier.floatFEHC)

            row.calc_U = parseFloat(power_tier.floatFECO)

            row.calc_V = parseFloat(power_tier.floatFENOx)  

            row.calc_W = parseFloat(power_tier.floatFEPM)

            row.calc_X = parseFloat(power_tier.floatFEBSFC)

            row.calc_Y = row.emission.indexOf('Tier 4')>=0 ? 0 : row.calc_T * 0.02
            
            row.calc_Z = (row.calc_X*row.calc_K-(row.calc_T+row.calc_Y)*row.calc_P*row.calc_G)*0.87*(44/12)
            
            row.calc_AA = ( row.calc_X*row.calc_K * ( 1 - power_tier.floatSoxcnv)-(row.calc_T+row.calc_Y)*row.calc_P*row.calc_G ) * 0.01 * 2 * calmaq.info.azufre/10000
            
            row.calc_AB = row.calc_W*0.97

            row.calc_AC = (row.power<130 ? tier.floatKWmnfBC : tier.floatKWmxfBC) * row.calc_W
            
            row.calc_AD = (row.calc_T+row.calc_Y)*row.calc_P*row.calc_G*row.calc_F
            
            row.calc_AE = row.calc_U*row.calc_Q*row.calc_H*row.calc_F
            
            row.calc_AF = row.calc_V*row.calc_R*row.calc_I*row.calc_F
            
            row.calc_AG = ( row.calc_W*row.calc_S*row.calc_J-(row.calc_X*row.calc_K*7*power_tier.floatSoxcnv*0.01*(tier.floatAzure - calmaq.info.azufre_perc ) ) ) * row.calc_F
            row.calc_AG = row.calc_AG > 0 ? row.calc_AG : 0
            console.log( power_tier.floatSoxcnv,tier.floatAzure,calmaq.info.azufre_perc,row.calc_F)
            row.calc_AH = row.calc_AG*0.97

            row.calc_AI = row.calc_AG * (row.power<130 ? tier.floatKWmnfBC : tier.floatKWmxfBC )

            row.calc_AJ = row.calc_F*row.calc_Z

            row.calc_AK = row.calc_F*row.calc_AA

            row.calc_AL = row.calc_X*row.calc_K*row.calc_F

            row.calc_AM = row.calc_AL/calmaq.info.diesel_ggal

            calmaq.data[i]=row
    
            jQuery('#collapseMachine tbody').append(
                '<tr>'+
                    '<td>'+row.calc_A+'</td>'+
                    '<td>'+row.calc_B+'</td>'+
                    '<td>'+row.calc_C+'</td>'+
                    '<td>'+row.calc_D+'</td>'+
                    '<td>'+row.calc_E.toFixed(5)+'</td>'+
                    '<td>'+row.calc_F.toFixed(5)+'</td>'+
                '</tr>'
            );

            jQuery('#collapseCycle tbody').append(
                '<tr>'+
                    '<td>'+row.calc_A+'</td>'+
                    '<td>'+row.calc_G+'</td>'+
                    '<td>'+row.calc_H+'</td>'+
                    '<td>'+row.calc_I+'</td>'+
                    '<td>'+row.calc_J+'</td>'+
                    '<td>'+row.calc_K+'</td>'+
                '</tr>'
            );
            
            jQuery('#collapseDeterioration tbody').append(
                '<tr>'+
                    '<td>'+row.calc_A+'</td>'+
                    '<td>'+row.calc_L+'</td>'+
                    '<td>'+row.calc_M+'</td>'+
                    '<td>'+row.calc_N+'</td>'+
                    '<td>'+row.calc_O+'</td>'+
                    '<td>'+row.calc_P.toFixed(5)+'</td>'+
                    '<td>'+row.calc_Q.toFixed(5)+'</td>'+
                    '<td>'+row.calc_R.toFixed(5)+'</td>'+
                    '<td>'+row.calc_S.toFixed(5)+'</td>'+
                '</tr>'
            );

            jQuery('#collapseEmission tbody').append(
                '<tr>'+
                    '<td>'+row.calc_A+'</td>'+
                    '<td>'+row.calc_T.toFixed(5)+'</td>'+
                    '<td>'+row.calc_U.toFixed(5)+'</td>'+
                    '<td>'+row.calc_V.toFixed(5)+'</td>'+
                    '<td>'+row.calc_W.toFixed(5)+'</td>'+
                    '<td>'+row.calc_X.toFixed(5)+'</td>'+
                    '<td>'+row.calc_Y.toFixed(5)+'</td>'+
                    '<td>'+row.calc_Z.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AA.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AB.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AC.toFixed(5)+'</td>'+
                '</tr>'
            );

            jQuery('#collapseTotal tbody').append(
                '<tr>'+
                    '<td>'+row.calc_A+'</td>'+
                    '<td>'+row.calc_AD.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AE.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AF.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AG.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AH.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AI.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AJ.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AK.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AL.toFixed(5)+'</td>'+
                    '<td>'+row.calc_AM.toFixed(5)+'</td>'+
                '</tr>'
            );

            //results
            calc_work+=row.calc_F

            result_grid.hc_t+=row.calc_AD
            result_grid.co_t+=row.calc_AE
            result_grid.no_t+=row.calc_AF
            result_grid.pm10_t+=row.calc_AG
            result_grid.pm25_t+=row.calc_AH
            result_grid.bc_t+=row.calc_AI
            result_grid.dco_t+=row.calc_AJ
            result_grid.dso_t+=row.calc_AK
            result_grid.bsfc_t+=row.calc_AL

            result_d13+=row.calc_AM
            result_d15+=row.calc_F
        }

        for(let i in result_grid) {
            result_grid[i]=result_grid[i]/1000000
            jQuery('.'+i).text(result_grid[i].toFixed(3))
    
            hc_k=result_grid[i]*1000
            jQuery('.'+i+'_k').text(hc_k.toFixed(0))
    
            hc_g=result_grid[i]*1000000/calc_work
            jQuery('.'+i+'_g').text(hc_g.toFixed(5))
        } 

        
        jQuery('.result_d11').text(calmaq.info.project_time)

        jQuery('.result_d12').text(calmaq.info.project_factor.toFixed(5))

        jQuery('.result_d13').text(result_d13.toFixed(0))

        result_d14=calmaq.info.lowheat_kWhgal*result_d13/1000
        jQuery('.result_d14').text(result_d14.toFixed(0))
        
        result_d15 = (result_d15 / 1000).toFixed(0)
        jQuery('.result_d15').text(result_d15)
                
    },
    'grid_result': function(){
        calmaq.calc()       
        jQuery('.calmaq-result').slideDown()
        jQuery('.calmaq-grid').slideUp()
    },
    'update': function(){
        jQuery('.calmaq-grid').slideDown()
        jQuery('.calmaq-result').slideUp()

        return false
    },
    'reset': function(){
        jQuery('.calmaq-intro').slideDown()
        jQuery('.calmaq-grid').slideUp()
        jQuery('.calmaq-result').slideUp()

        return false
    },
    'submit': function(){
        
        calmaq.info.project_time    = parseInt(jQuery('#project-time').val()),
        calmaq.info.fuel            = jQuery('.input-fuel:checked').val()
        calmaq.info.azufre          = parseInt(jQuery('#azufre').val())
        calmaq.info.azufre_perc     = calmaq.info.azufre/10000
        calmaq.info.diesel_ggal     = (calmaq.info.diesel_kgm3/1000)*3.78541*1000
        calmaq.info.lowheat_kWhgal  = calmaq.info.lowheat_MJkg/3.6/1000*calmaq.info.diesel_ggal
       
        jQuery('.azufre_ppm').text(calmaq.info.azufre)
        jQuery('.azufre_perc').text(calmaq.info.azufre_perc)
        jQuery('.diesel_kgm3').text(calmaq.info.diesel_kgm3)
        jQuery('.diesel_ggal').text(calmaq.info.diesel_ggal.toFixed(5))
        jQuery('.lowheat_ggal').text(calmaq.info.lowheat_MJkg.toFixed(5))
        jQuery('.lowheat_kWh').text(calmaq.info.lowheat_kWhgal.toFixed(5))

        if( isNaN(calmaq.info.project_time) || calmaq.info.project_time<=0 ) {
            calmaq.warning('Debe especificar Tiempo de proyecto (días)')
        }
        else if( calmaq.info.fuel=='1' && (isNaN(calmaq.info.azufre) || calmaq.info.azufre<=0) ) {
            calmaq.warning('Debe especificar la candidad de azufre en diésel')
        }
        else {
            jQuery('.calmaq-intro').slideUp()
            jQuery('.calmaq-grid').slideDown()
        }


        return false
    },
    'form_load': function(){
        
        for(let group in calmaq.activity_level) {
            jQuery('.record-group').append('<option>'+group+'</option>')
        }
        jQuery('.record-group').change();

    },
    'form_type': function(){
        jQuery('.record-type').html('')
        let val=jQuery('.record-group').val()
        
        //console.log('form_type',val,calmaq.activity_level[val])
        if(val in calmaq.activity_level) {
            for(let r in calmaq.activity_level[val]) {
                jQuery('.record-type').append('<option>'+calmaq.activity_level[val][r].name+'</option>')
            }
        }
    },
    'form_power': function( power ){

        let range=calmaq.get_power(power)

        return range ? range.varPower : ''
    },
    'form_save': function(){

        let formData={
            'group'     : jQuery('.record-group').val(),
            'type'      : jQuery('.record-type').val(),
            'year'      : jQuery('.record-year').val(),
            'power'     : jQuery('.record-power').val(),
            'level'     : jQuery('.record-activity').val(),
            'emission'  : jQuery('.record-tier').val(),
            'quantity'  : jQuery('.record-quantity').val(),
        }

        console.log('formData',formData)
        
        let row=jQuery('.btn-save').attr('itemid')
        if(row in calmaq.data) {
            calmaq.data[row]=formData
        }
        else {
            calmaq.data.push(formData)
        }
        calmaq.grid_load()
        jQuery('#modalRecord').modal('hide')
        return false;
    },
    'grid_record': function(){
        let row=jQuery(this).data('id')
        console.log('grid_record',row)
        let formD=null
        if(row in calmaq.data) {
            formD=calmaq.data[row];

            jQuery('.record-group').val( formD.group ).change();
            jQuery('.record-type').val( formD.type );
            jQuery('.record-year').val( formD.year )
            jQuery('.record-power').val( formD.power )
            jQuery('.record-activity').val( formD.level )
            jQuery('.record-quantity').val( formD.quantity )
        }
        else {
            jQuery('.record-group').val( jQuery(".record-group option:first").val() );
            jQuery('.record-year').val(2022)
            jQuery('.record-power').val(0)
            jQuery('.record-activity').val(1)
            jQuery('.record-quantity').val(1)
        }
        
        let power=jQuery('.record-power').val()
        
        jQuery('.record-range').val( calmaq.form_power(power) )
        jQuery('.record-power').change();

        if(formD) {
            console.log('formD.tier',formD.emission)
            jQuery('.record-tier').val( formD.emission )
        }        
        
        jQuery('#modalRecord').modal() //edit
        jQuery('#modalRecord .btn-save').attr('itemid',row)
        return false
    },
    'warning': function(msj){
        jQuery('#modalWarning').modal() //edit
        jQuery('#modalWarning .modal-body').text(msj)
        return false
    }, 
    'grid_alert': function(){
        let row=jQuery(this).data('id')

        jQuery('#modalConfirm').modal() //edit
        jQuery('#modalConfirm .btn-confirm').attr('itemid',row)
        return false
    },   
    'grid_alert_close': function(){
        jQuery('#modalConfirm').modal('hide')
    },
    'grid_remove': function(){
        let row=jQuery('#modalConfirm .btn-confirm').attr('itemid')
        calmaq.grid_alert_close();
        
        console.log('remove row',row)
        let dataTepm=[]
        for(let i in calmaq.data ) {
            if( i == row ) {
                continue
            }
            dataTepm.push(calmaq.data[i])
        }
        calmaq.data=dataTepm;
        console.log('dataTepm',dataTepm)
        calmaq.grid_load()
    },
    'grid_load': function(){

        let gridBody=jQuery('.table-record tbody')
        gridBody.html('')

        for(let i in this.data ) {

            gridBody.append(
                '<tr class="record">'+
                    '<td><a data-id="'+i+'" class="btn btn-secondary btn-sm btn-edit" href="#" role="button" title="Editar"><i class="fas fa-edit"></i></a></td>'+
                    '<td>'+this.data[i].group+'</td>'+
                    '<td>'+this.data[i].type+'</td>'+
                    '<td>'+this.data[i].year+'</td>'+
                    '<td>'+this.data[i].power+'</td>'+
                    '<td>'+this.data[i].level+'</td>'+
                    '<td>'+this.data[i].emission+'</td>'+
                    '<td>'+this.data[i].quantity+'</td>'+
                    '<td>'+this.form_power(this.data[i].power)+'</td>'+
                    '<td><a data-id="'+i+'" class="btn btn-light btn-sm btn-delete" href="#" role="button" ><i class="fas fa-trash"></i> Eliminar</a></td>'+
                '</tr>'
            )
        }


    },
    'fonts': function(){
        jQuery.ajax({
            dataType: "json",
            url: theme_vars.THEME_URL + 'data/calmaq.json',
        }).done(function(result) {  
            calmaq.result = result['grid']  
            calmaq.activity_level = result['activity_level']
            calmaq.power = result['power'] 
            calmaq.tier = result['tier']   
                  
            for(let i in calmaq.result) {
                jQuery('.page-grid .buttons').append(
                    '<div class="col-6 col-md-4">'+
                        '<button data-id="'+i+'" class="link">'+
                            '<i class="'+calmaq.result[i].icon+'"></i>'+
                            '<label>'+calmaq.result[i].name+'</label>'+
                        '</button>'+
                    '</div>'
                )
            }
            
            jQuery('.page-grid .link').on('click', calmaq.load_card)
            
            //form
            calmaq.form_load()

            //grid
            calmaq.grid_load();

            //default calc
            //calmaq.calc()

        });

        return false
    },
    'load_card': function(){
        //console.log('button', calmaq.result[jQuery(this).data('id')])
        var content=calmaq.result[jQuery(this).data('id')]
        var details=jQuery('.page-grid .details')

        details.find('.card-body').html(
            '<h4><i class="fas fa-plus-square"></i> '+content.name+'</h4>'+
            '<div class="text">'+content.text+'</div>'+
            '<div class="accordeon">'+content.grid+'</div>'
        );
        details.slideDown()
    }
}

jQuery(document).ready(function() {
    // Initialize Calmaq
    calmaq.ready();
});