const hemaq = {
    aux : {
        pais: {
            "ch": "Chile",
            "co": "Colombia",
            "pe": "Perú",
            "mx": "México",
            "ot": "Otro"
        },
        axo_base: [
            2018,
            2019,
            2020,
            2021,
            2022,
            2023,
            2024,
            2025
        ],
        escenario_calculo: [
            'Linea Base',
            'Normativa'
        ],
        factores_emision: [
            'EPA',
            'EEA',
            'CORINAIR GEASUR 2014'
        ],
        fuente_nival_actividad: [
            'NA CALAC/EPA',
            'NA Mexico',
            'Otro NA'
        ],
        retiro_maquinaria: [
            'EPA',
            'Mitad EPA',
            'Sin retiro',
            'Ingresado usuario'
        ],
        normativa_linea_base: [
            'Estándar ingresado usuario',
            'Estándar USA desfasado',
            'Estándar original flota'
        ],
        normativa_escenario: [
            "Estándar USA desfasado",
            "Estándar ingresado usuario"       
        ],
        escenario_normativo_rango: [
           ' >0 A 8',
           '>8 A 19',	
           '>19 A 37',
           '>37 A 56',
           '>56 A 75',
           '>75 A 130',
           '>130 A 225',
           '>225 A 450',
           '>450 A 560',
           '>560'
        ],
        escenario_normativo_tier: [
            'Ninguna',
            'Tier 2',
            'Tier 3',
            'Tier 4I',
            'Tier 4F',
            'Stage V'
        ],
        escenario_normativo_normativa: {
           '>37 A 56':'',
           '>56 A 75':'',
           '>75 A 130':'',
           '>130 A 225':'',
           '>225 A 450':'',
           '>450 A 560':'',
           '>560':''
        }
    },

    principal : {
        pais:"Chile",
        axo_base: 2021,
        escenario_calculo: 'Linea Base',
        factores_emision: 'EPA',
        fuente_nival_actividad: [
            'NA CALAC/EPA',
            'NA Mexico',
            'Otro NA'
        ],
        retiro_maquinaria: [
            'EPA',
            'Mitad EPA',
            'Sin retiro',
            'Ingresado usuario'
        ],
        normativa_linea_base: [
            'Estándar ingresado usuario',
            'Estándar USA desfasado',
            'Estándar original flota'
        ],
        normativa_linea_base_axo: 12,
        normativa_escenario: [
            "Estándar USA desfasado",
            "Estándar ingresado usuario"       
        ],
        normativa_escenario_axo: 12,
        escenario_normativo_rango: [
           ' >0 A 8',
           '>8 A 19',	
           '>19 A 37',
           '>37 A 56',
           '>56 A 75',
           '>75 A 130',
           '>130 A 225',
           '>225 A 450',
           '>450 A 560',
           '>560'
        ],
        escenario_normativo_tier: [
            'Ninguna',
            'Tier 2',
            'Tier 3',
            'Tier 4I',
            'Tier 4F',
            'Stage V'
        ],
        escenario_normativo_normativa: {
           '>37 A 56':'',
           '>56 A 75':'',
           '>75 A 130':'',
           '>130 A 225':'',
           '>225 A 450':'',
           '>450 A 560':'',
           '>560':''
        },
        escenario_normativo_vigencia: {
            '>37 A 56':2025,
           '>56 A 75':2025,
           '>75 A 130':2025,
           '>130 A 225':2025,
           '>225 A 450':2025,
           '>450 A 560':2025,
           '>560':2025
        },
        poblacion_axo_base: 30000000,
        concentarcion_pm_axo_base: 28,
        area_urbana: 2600,
        tipo_zona: "Costera",
        parque_axo_base: {
            'Agrícola': 1000,
            'Forestal': 2000,
            'Construcción': 3000,
            'Industrial': 4000,
            'Minería': 5000
        },
        axo_calculo_emisiones : 2019,

    },

    input: {
        country: "co",
        city: "Bogota"
    },
    
    ready :  function(){
        console.log('Iniciando HEMAQ');

        let y
        for( y = 2018 ; y <= 2030; y++ ) {
            hemaq.data.axo_base.push(y)
        }
        

    }
};

//export default hemaq
$(document).ready(function(){
    hemaq.ready();
});