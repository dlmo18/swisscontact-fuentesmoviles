<?php
$sector = [
    'Agrícola',
    'Forestal',
    'Construcción',
    'Industrial',
    'Minería'
];

$rel_emis_conc = [
    'Matriz Em-conc (Fantke et al. 2017)',
    'Intake fraction (Apte et al. 2012)',
    'FEC (Chile)'
]

?>
<h3>INGRESO DE PARAMETROS Y RESULTADOS</h3>
<h4>I	VARIABLES CALCULO EMISIONES PARA 1 AÑO (NO REQUIERE MACROS)</h4>
<h5>A	Ingreso parámetros</h5>


<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label>Seleccion País</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id=""
		>
			<option >Chile</option>
			<option >Colombia</option>
			<option >Mexico</option>
			<option >Perú</option>
			<option >Otros</option>
		</select>
	</div>   
</div>
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Nombre Ciudad</label>
	</div>
    <div class="col">
		<input
			type="text"
			class="form-control"
			name=""
			id=""
			placeholder=""
			value="Osorno City"
		/>
	</div>
</div>
		
<h4 class="mt-3 ml-4">PASO 1: Parámetros cálculo emisiones</h4>

<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Año base (T0)</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id="start-param-base-year"
		>
			<option >2018</option>
			<option >2019</option>
		</select>
	</div>
</div>							
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Escenario calculo emisiones</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id=""
		>
			<option >Linea Base</option>
			<option >Normativa</option>
		</select>
	</div>
</div>							
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Factores de emisión</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id=""
		>
			<option >EPA</option>
			<option >EEA</option>
			<option >CORINAIR GEASUR 2014</option>
		</select>
	</div>
</div>
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Fuente Nivel de Actividad</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id=""
		>
			<option >NA CALAC/EPA</option>
			<option >NA México</option>
			<option >Otro NA</option>
		</select>
	</div>
</div>							
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Retiro Maquinaria</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id=""
		>
			<option >EPA</option>
			<option >Mitad EPA</option>
			<option >Sin retiro</option>
			<option >Ingresado usuario</option>
		</select>
	</div>
</div>							
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label pl-3"><small>Si retiro maquinaria es "Ingresado usuario"</small></label>
	</div>
    <div class="col">
		<button class="btn btn-secondary btn-sm">Ingresar Retiro</button>
	</div>
</div>							
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Normativa de línea base</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id=""
		>
			<option >Estándard ingresado usuario</option>
			<option >Estándard USA desfasado</option>
			<option >Estándard original flota</option>
		</select>
	</div>
</div>							
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label pl-3"><small>Si "Estándar USA desfasado"</small></label>
	</div>
    <div class="col">
		<div class="input-group">
			<input 
				type="text" 
				class="form-control" 
			>
			<span class="input-group-text" >años</span>
		</div>
	</div>
</div>						
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label pl-3"><small>Si "Estándar ingresado usuario"</small></label>
	</div>
    <div class="col">
		<button class="btn btn-secondary btn-sm">Ingresar estandar LB</button>
	</div>
</div>								
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label">Normativa escenario</label>
	</div>
    <div class="col">
		<select
			class="form-control"
			name=""
			id=""
		>
			<option >Estándard ingresado usuario</option>
			<option >Estándard USA desfasado</option>
		</select>
	</div>
</div>								
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
		<label for="" class="form-label pl-3"><small>Si "Estándar USA desfasado"</small></label>
	</div>
    <div class="col">
		<div class="input-group">
			<input 
				type="text" 
				class="form-control" 
			>
			<span class="input-group-text" >años</span>
		</div>
	</div>
</div>	
							
<div class="table-group mb-2 mt-3">
    <table class="table table-sm table-striped " style="width: 1300px;">
        <thead class="thead-dark">
            <tr>
                <th colspan="11" >
                    Escenario normativo (Si "Estándar ingresado usuario")
                </th>
            </tr>
            <tr>
                <th scope="col" style="width: 180px;">Rango potencia (KWh)</th>
                <th scope="col">>0 A 8</th>
                <th scope="col">>8 A 19</th>
                <th scope="col">>19 A 37</th>
                <th scope="col">>37 A 56</th>
                <th scope="col">>56 A 75</th>
                <th scope="col">>75 A 130</th>
                <th scope="col">>130 A 225</th>
                <th scope="col">>225 A 450</th>
                <th scope="col">>450 A 560</th>
                <th scope="col">>560</th>
            </tr>
        </thead>
        <tbody>           
            <tr>
                <th scope="row">Normativa</th>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
                <td>
                    <select
                        class="form-control"
                        name=""
                        id=""
                    >
                        <option >Ninguna</option>
                        <option >Tier 2</option>
                        <option >Tier 3</option>
                        <option >Tier 4I</option>
                        <option >Tier 4F</option>
                        <option >Stage V</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">Vigencia</th>
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>

                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>

                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>

                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>
                <td>
                    <input
                        type="text"
                        class="form-control"
                        name=""
                        id=""
                        placeholder=""
                        value="2025"
                    />
                </td>
            </tr>
        </tbody>
    </table>

</div>							
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
        <label for="" class="form-label">Población año base, <span class="start-param-base-year_text"></span> </label>
    </div>
    <div class="col">
        <div class="input-group">
			<input 
				type="text" 
				class="form-control" 
                value="30000000"
			>
			<span class="input-group-text" >capita</span>
		</div>
	</div>
</div>								
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
    <label for="" class="form-label">Concentración de PM2.5 año base, <span class="start-param-base-year_text"></span> </label>
    </div>
    <div class="col">
        <div class="input-group">
			<input 
				type="text" 
				class="form-control" 
                value="28"
			>
			<span class="input-group-text" >µg/m3</span>
		</div>
	</div>
</div>								
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
        <label for="" class="form-label">Area urbana en km2 </label>
	</div>
    <div class="col">
        <div class="input-group">
			<input 
				type="text" 
				class="form-control" 
                value="2600"
			>
			<span class="input-group-text" >km2</span>
		</div>
	</div>
</div>									
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
        <label for="" class="form-label">Tipo de zona  </label>
	</div>
    <div class="col">
        <div class="input-group">
			<input 
				type="text" 
				class="form-control" 
                value="Costera"
			>
		</div>
	</div>
</div>
								
<div class="table-group mt-3 mb-3">
    <table class="table table-sm table-striped " >
        <thead class="thead-dark">
            <tr>
                <th colspan="4">
                    <strong>
                    Parque año base <span class="start-param-base-year_text"></span>
                    </strong>
                </th>
            </tr>
        </thead>
        <tbody>       
            <tr>
                <th scope="col" class="pl-5" >R1</th>
                <th scope="col">Agrícola</th>
                <td scope="col">
                    <input 
                    type="text" 
                    class="form-control" 
                    value="1000"
                ></td>
                <th scope="col">*Incluye Forestal en el caso de Chile y Colombia</th>
            </tr>         
            <tr>
                <th scope="row " class="pl-5" >R2</th>
                <th >Forestal</th>
                <td >
                    <input 
                    type="text" 
                    class="form-control" 
                    value="2000"
                ></td>
                <th></th>
            </tr>         
            <tr>
                <th scope="row " class="pl-5">R3</th>
                <th >Construcción</th>
                <td >
                    <input 
                    type="text" 
                    class="form-control" 
                    value="2000"
                ></td>
                <th></th>
            </tr>          
            <tr>
                <th scope="row" class="pl-5">R4</th>
                <th >Industrial</th>
                <td >
                    <input 
                    type="text" 
                    class="form-control" 
                    value="2000"
                ></td>
                <th></th>
            </tr>            
            <tr>
                <th scope="row " class="pl-5">R5</th>
                <th >Minería</th>
                <td >
                    <input 
                    type="text" 
                    class="form-control" 
                    value="2000"
                ></td>
                <th></th>
            </tr>  
        </tbody>
    </table>
</div>

								
<div class="form-group mb-1 row">
	<div class="col-4 ml-5">
        <label for="" class="form-label">Año calculo emisiones  </label>
	</div>
    <div class="col">
        <div class="input-group">
			<input 
				type="text" 
				class="form-control" 
                value="2021"
			>
        </div>
        <small><i>El año para el cálculo de emisiones debe ser igual o superior al año base	</i>		</small>
	</div>
</div>
		
<h4 class="mt-3 ml-4">PASO 2:	PRESIONAR boton para actualizar el parque y calcular las emisiones (requiere macros)</h4>

<div class="mb-1 pl-5">
    <div class="row text-center">
        <div class="col-6">
            <button
                type="button"
                class="btn btn-primary btn-lg"
            >
                Actualizar parque y calcular emisiones
            </button>
            <br>
            <small>*El parque se debe actualizar solo si cambia la cantidad de maquinaria o parámetros en "Distribución Parque"</small>
        </div>
        <div class="col-6">
            <button
                type="button"
                class="btn btn-primary btn-lg"
            >
                Actualizar (solo emisiones)
            </button>
        </div>
    </div>
</div>

<h5>B   Resultados: Emisiones año</h5>
<div class="mb-5">
    <div class="table-group2 mb-3">
    <table class="table table-sm table-striped w-100" style="width: 1300px;">
        <thead class="thead-dark">
            <tr>                <th colspan="11" >
                    Supuestos ingresados
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>
                    Año emisiones
                </th>
                <th>
                    Factores de emisión
                </th>
                <th>
                    Nivel actividad
                </th>
                <th>
                    Retiro maquinaria
                </th>
                <th>
                    Normativa LB
                </th>
                <th>
                    Escenario    
                </th>
            </tr>
            <tr>
                <td>2022</td>
                <td>2022</td>
                <td>2022</td>
                <td>2022</td>
                <td>2022</td>
                <td>2022</td>
            </tr>
        </tbody>
     </table>
    </div>
    <div class="table-group2 mb-3">
        <table class="table table-sm table-striped  w-100" style="width: 1300px;">
        <thead class="thead-dark">
                <tr>
                    <th colspan="13" >
                        Emisiones año
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        Rubro	
                    </th>
                    <th>
                        PM
                    </th>
                    <th>
                        PM2.5
                    </th>
                    <th>
                        NOx	
                    </th>
                    <th>
                        CO
                    </th>
                    <th>
                        HC
                    </th>
                    <th>
                        CO2
                    </th>
                    <th>
                        BC
                    </th>
                    <th>
                        SO2
                    </th>
                    <th>
                        N2O
                    </th>
                    <th>
                        CH4
                    </th>
                    <th>
                        NH3
                    </th>
                </tr>
                <tr>
                    <td>Agrícola</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Forestal</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Construcción</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Industrial</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>Minería</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <th><strong>TOTAL</strong></th>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>
    
     

    
</div>


<h5>C	Distribución de emisiones y de la flota </h5>
<div class="mb-5">
     <div class="row">
        <div class="col-6 text-center">
            <strong>Distribución de emisiones por sector		
            </strong>
            <br>
            <canvas class="chart-block"  id="chart-ic-emision-sector"></canvas>
        </div>
        <div class="col-6 text-center">
            <strong>Distribución de emisiones según potencia
            </strong>
            <br>

            <canvas class="chart-block" id="chart-ic-emision-power"></canvas>
        </div>
        <div class="col-6 text-center">
            <strong>Distribución flota según estandar de emisión
            </strong>
            <br>

            <canvas class="chart-block"  id="chart-ic-emision-standard"></canvas>
        </div>
        <div class="col-6 text-center">
            <strong>Distribución del parque según potencia
            </strong>
            <br>

            <canvas class="chart-block"  id="chart-ic-park-power"></canvas>
        </div>
     </div>
</div>

<h4>II	VARIABLES ANÁLISIS COSTO-BENEFICIO</h4>
<h5>A	Datos modificables por el usuario</h5>
<div class="mb-5">
         
    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 1	: Seleccionar sectores afectos</label>
        </div>
        <div class="col">
            <?php foreach($sector as $k=>$s) {
                ?>
                <div class="form-check form-check-inline">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="sector-<?php echo $k ?>"
                        value="<?php echo $k ?>"
                        checked
                    />
                    <label class="form-check-label" for=""><?php echo $s ?></label>
                </div>
                <?php
            } ?>
            
        </div>
    </div>

    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 2	: Relación emisiones-concentraciones</label>
        </div>
        <div class="col">
            <select
                class="form-control"
                name=""
                id=""
            >
                <option>Matriz Em-conc (Fantke et al. 2017)</option>
                <option>Intake fraction (Apte et al. 2012)</option>
                <option>FEC (Chile)</option>
            </select>
        </div>
    </div>	

    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 3	: Seleccionar fuente función riesgo relativo (RR)</label>
        </div>
        <div class="col">
            <select
                class="form-control"
                name=""
                id=""
            >
                <option>RR GBD 2015-2016</option>
                <option>RR GBD 2017</option>
                <option>RR GBD 2019</option>
                <option>RR Burnett 2018</option>
            </select>
        </div>
    </div>

    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 4	: Selección de tipo de mortalidad a utilizar para ACB</label>
        </div>
        <div class="col">
            <select
                class="form-control"
                name=""
                id=""
            >
                <option>Causas específicas</option>
                <option>Causas naturales</option>
            </select>
        </div>
    </div>

    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 5	: Selección de valor de la vida estadística (VSL) a utilizar</label>
        </div>
        <div class="col">
            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >VLS</span>                
                <select
                    class="form-control"
                    name=""
                    id=""
                >
                    <option>VSL ingresado usuario</option>
                    <option>VSL transferido OECD (η=nivel ingresos)</option>
                    <option>VSL transferido USA</option>
                    <option>PIB per cápita*100</option>
                    <option>PIB per cápita*160</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >VSL ingresado usuario (USD) $</span>
                <input 
                    type="text" 
                    class="form-control" 
                    value="421,78"
                >
                <span class="input-group-text" >USD 2018</span>
            </div>

            <div class="input-group">
                <span class="input-group-text"  style="width: 300px;" >Elasticidad ingreso para VSL ingresado</span>
                <input 
                    type="text" 
                    class="form-control" 
                    value="1.2"
                >
            </div>
        </div>
    </div>

    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 6	: Precio social del CO2</label>
        </div>
        <div class="col">
            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >VLS</span>                
                <select
                    class="form-control"
                    name=""
                    id=""
                >
                    <option>Perú ($7.17 dólares por tonelada)</option>
                    <option>Chile ($32.5 dólares por tonelada)</option>
                    <option>Colombia ($5.27 dólares por tonelada)</option>
                    <option>México ($1.69 dólares por tonelada)</option>
                    <option>Global ($60 dólares por tonelada)</option>
                    <option>Valor ingresado usuario</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >Valor ingresado usuario (USD)</span>
                <input 
                    type="text" 
                    class="form-control" 
                    value="20"
                >
            </div>
        </div>
    </div>

    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 7	: Tasa de descuento</label>
        </div>
        <div class="col">
            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >Seleccionar</span>                
                <select
                    class="form-control"
                    name=""
                    id=""
                >
                    <option>ingresada usuario (Constante)</option>
                    <option>constante (por defecto)</option>
                    <option>variable (por defecto)</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >Valor ingresado usuario</span>
                <input 
                    type="text" 
                    class="form-control" 
                    value="8"
                >
                <span class="input-group-text" >%</span>
            </div>
        </div>
    </div>

    <div class="form-group mb-3 row">
        <div class="col-4 ml-5">
            <label for="" class="form-label">PASO 8	: Horizonte temporal evaluación</label>
        </div>
        <div class="col">
            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >Año Final (TF)</span>                
                <select
                    class="form-control"
                    name=""
                    id=""
                >
                    <option>2030</option>
                    <option>2031</option>
                    <option>2032</option>
                </select>
            </div>

            <div class="input-group">
                <span class="input-group-text" style="width: 300px;" >Valor ingresado usuario</span>
                <select
                    class="form-control"
                    name=""
                    id=""
                >
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                </select>
            </div>
        </div>
    </div>

</div>


<h4>III	RESULTADOS DEL ANALISIS</h4>
<h5>A	Reducción de emisiones </h5>
<div class="mb-5">
     
</div>

<h5>B	Parque de maquinaria </h5>
<div class="mb-5">
     
</div>

<h5>C	Emisiones de la flota  </h5>
<div class="mb-5">
     
</div>

<h5>D	Cambios en concentración y efectos en salud </h5>
<div class="mb-5">
     
</div>


<h5>E	Años vividos con discapacidad (YLD)</h5>
<div class="mb-5">
     
</div>


<h5>F   Resultados análisis costo-beneficio</h5>
<div class="mb-5">
     
</div>


<h5>G   Resumen de supuestos</h5>
<div class="mb-5">
     
</div>

<h5>H   Escenario cumplimiento</h5>
<div class="mb-5">
     
</div>
