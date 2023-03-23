<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("includes/ryq_funciones.php"); ?>
<!DOCTYPE html>
<html lang="es-cl">
<head>
    <?php getHeadscripts('cv'); ?>

    <style>
        .informacion-discapacidad::after{
            display:none;

        }
    </style>
    <title>mi CV</title>
</head>
<body>
    <?php
        $buscarDatos= "SELECT * from ryqbd_data LEFT JOIN ryqbd_users
ON ryqbd_data.userdata_key = ryqbd_users.user_key WHERE userdata_key='".$_SESSION['user']."'";
         $resultado = sqlsrv_query($conn, $buscarDatos);
         $obj = sqlsrv_fetch_object($resultado);
         if(isset($obj->user_avatar)){
             $GLOBALS['avatar'] = $obj->user_avatar;
         }else{
            $GLOBALS['avatar'] = 'assets/default-avatar.jpg';
         }
     ?>
     <?php getNav(); ?>
     
<main class="contenedor">
    <section class="seccion-principal">
        <h1 class="titulo-principal-interior">MI CV</h1>
    <article class="grilla-cv">
        <div>
            <ul class="sub-menu">
                <a href="#datos-contacto" class="menu-card">
                    <li>Datos de contacto</li>
                </a>
                <a href="#datos-xp" class="menu-card">
                    <li>Experiencia laboral</li>
                </a>
                <a href="#datos-academicos" class="menu-card">
                    <li>Antecedentes acádemicos</li>
                </a>
                <a href="#datos-adicionales" class="menu-card">
                    <li>Adicionales</li>
                </a>
            </ul>
        </div>
        <div>
            <div class="grid-box">
                <div class="contenedor-foto" id="datos-contacto">
                    <div class="foto-avatar">
                        <input type="file" id="foto-cv" accept=".png, .jpg, .jpeg">
                            <label for="foto-cv"></label>
                    </div>
                    <div class="avatar-preview" >
                    <?php if (isset($obj->user_avatar)) { ?>
                         <div id="imagePreview" class="image-preview" style="background-image: url(data:image/png;base64,<?php echo base64_encode($obj->user_avatar); ?> );" ></div>
                    <?php } else{ ?>  
                         <div id="imagePreview" class="image-preview" style="background-image: url(<?php echo 'assets/default-avatar.jpg' ?> );" ></div>
                         <?php } ?>
                    </div>
                    
                </div>

                <div>
                    <h3><?php echo $obj->userdata_nombre.' '.$obj->userdata_apellidopaterno.' '.$obj->userdata_apellidomaterno; ?></h3>
                    <br>
                </div>
                
                <div class="datos-personales">
                    <div>
                        <h3>País nacimiento</h3>
                        <p><?php echo $obj->userdata_nacionalidad ?></p>
                    </div>
                    <div><h3>Comuna</h3>
                       <p><?php echo $obj->userdata_comuna; ?></p>
                    </div>
                    <div><h3>RUT</h3>
                        <p><?php echo $obj->user_rut; ?></p>
                    </div>
                </div>
                <div class="circulo-mobile">
                    <svg class="round" viewbox="0 0 100 100" width="120" height="120" data-percent="100">
                    
                        <circle cx="50" cy="50" r="30" />
                        <circle cx="50" cy="50" r="27" stroke="#f1f1f1" stroke-width="2" fill="none" /> 
                      </svg>
                      <div class="texto">
                          <p>Tu CV esta al</p>
                          <p>100%</p>
                    </div>
                </div>
            </div>
             <div class="informacion-box">
                <div class="titulo-box">
                    <h4>Datos de contacto</h4>
                </div>
                <div class="informacion-contacto" id="contacto-div">
                <p><strong>Teléfono</strong> <?php echo $obj->userdata_telefono; ?></p>
                <p><strong>Correo electrónico</strong> <?php echo $obj->user_email; ?></p>
                <p><strong>Direccion</strong> <?php echo $obj->userdata_direccion; ?>, <?php echo $obj->userdata_comuna; ?>, <?php echo $obj->userdata_region; ?></p>
                <a href="" class="editar-contacto boton-editar" data-modal="edit-contacto"></a>
                </div>
                    <div class="modal-edit" id="edit-contacto"><!---modal--->
                        <div class="modal-content">
                            <h1 class="titulo-principal-interior-form">ANTECEDENTES <strong>PERSONALES</strong></h1>
                            <form action="">
                            <div class="formulario-ingreso">
                                
                                <div>
                                    <label for="apellidos">Teléfono</label>
                                    <input type="text" id="telefono" name="telefono" value="<?php echo $obj->userdata_telefono; ?>" />
                                </div>
                                <div>
                                    <label for="apellidos">Correo electrónico</label>
                                    <input type="text" id="email" name="email" value="<?php echo $obj->user_email; ?>" />
                                </div>
                                <div>
                                    <label for="direccion">Dirección<span class="importante">*</span></label>
                                    <input type="text" id="direccion" name="direccion" value="<?php echo $obj->userdata_direccion; ?>" placeholder="Escriba su dirección"/>
                                </div>
                                <div class="comuna-region">
                                    <div data-sel="<?php echo $obj->userdata_region; ?>">
                                        <label for="region">Región<span class="importante">*</span></label>
                                        <select name="region" id="region">
                                            <option value="" selected disabled>Selecciona una región</option>
                                        </select>
                                    </div>

                                    <div data-sel="<?php echo $obj->userdata_comuna; ?>">
                                        <label for="comuna">Comuna<span class="importante">*</span></label>
                                        <select name="comuna" id="comuna">
                                            <option value="" selected disabled>Selecciona una comuna</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="form_type" value="antecedentes-personales">
                                
                                <div class="mid-boton">
                                    
                                    <a  class="botones-atras boton-cancelar" id="boton-cancelar">CANCELAR</a><br/>
                                    <a  class="botones boton-enviar" id="boton-enviar">GUARDAR</a>
                                </div>

                            </div>
                            </form>
                            <div class="sucess-div" style="display:none">
                                <div class="modal-mensaje">
                                    
                                        <div class="success-animation">
                                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                                        </div>
                                        
                                        <div class="texto-modal">
                                            <h3>Datos guardados exitosamente</h3>
                                        </div>
                                      
                                            <a class="botones continuar-modal" href="javascript:location.reload();">CONTINUAR</a>
                                        
                                </div>
                            </div>
                            
                        </div>
                    </div><!---fin modal--->
            </div>

            <div class="informacion-box"  id="datos-xp">
                <div class="titulo-box">
                    <h4>Experiencia Laboral</h4>
                    <a href="" class="boton-editar" data-modal="agregar-xp" id="agregar-xp-boton">Agregar experiencia</a>
                </div>


                    <div class="modal-edit" id="agregar-xp"><!---modal--->
                        <div class="modal-content">
                            <h1 class="titulo-principal-interior-form">EXPERIENCIA <strong>LABORAL</strong></h1>
                            <form action="">
                            <div class="formulario-ingreso">
                                
                               <div class="<?php echo $clase; ?>-edit">

                <div>
                    <label for="cargo">Cargo</label>
                    <input type="text" name="cargo" placeholder="Nombre del cargo">
                </div>

                <div>
                    <label for="empresa">Empresa</label>
                    <input type="text" name="empresa" placeholder="Nombre del cargo">
                </div>

                <div>
                    <label for="actividad-empresa">Actividad de la empresa</label>
                    <select id="actividad-empresa" name="actividad_empresa">
                        <option value="" disabled>Selecciona actividad</option>
                        <option value="Agricultura, Ganadería, Silvicultura y Pesca">Agricultura, Ganadería, Silvicultura y Pesca</option>
                        <option value="Explotación de Minas y Canteras">Explotación de Minas y Canteras </option>
                        <option value="Industrias Manufacturera">Industrias Manufacturera</option>
                        <option value="Suministro de Electricidad, Gas, Vapor y Aire Acondicionado ">Suministro de Electricidad, Gas, Vapor y Aire Acondicionado </option>
                        <option value="Suministro de Agua, Evacuación de Agua residuales, gestión de desechos y descontaminación">Suministro de Agua, Evacuación de Agua residuales, gestión de desechos y descontaminación </option>
                        <option value="Construcción">Construcción</option>
                        <option value="Comercio al Por Mayor y al por Menor, Reparación de Vehículos Automotores y Motocicletas">Comercio al Por Mayor y al por Menor, Reparación de Vehículos Automotores y Motocicletas</option>
                        <option value="Transporte y Almacenamiento">Transporte y Almacenamiento</option>
                        <option value="Actividades de Alojamiento y de Servicio de Comidas">Actividades de Alojamiento y de Servicio de Comidas </option>
                        <option value="Información y Comunicaciones">Información y Comunicaciones</option>
                        <option value="Actividades Financieras y de Seguros ">Actividades Financieras y de Seguros </option>
                        <option value="Actividades inmobiliarias">Actividades inmobiliarias</option>
                        <option value="Actividades Profesionales, Cientificas y Técnicas">Actividades Profesionales, Cientificas y Técnicas </option>
                        <option value="Actividades de Servicios Administrativos y de Apoyo">Actividades de Servicios Administrativos y de Apoyo </option>
                        <option value="Adm. Pública y Defensa; Planes de Seguridad Social de Afiliación Obligatoria">Adm. Pública y Defensa; Planes de Seguridad Social de Afiliación Obligatoria</option>
                        <option value="Enseñanza">Enseñanza</option>
                        <option value="Actividades de Atención de la Salud Humana y de Asistencia Social">Actividades de Atención de la Salud Humana y de Asistencia Social</option>
                        <option value="Actividades Artísticas, de Entretenimiento y Recreativas">Actividades Artísticas, de Entretenimiento y Recreativas</option>
                        <option value="Otras Actividades de Servicios">Otras Actividades de Servicios</option>
                        <option value="Actividades de los Hogares como Empleadores; Actividades No Diferenciadas de los Hogares">Actividades de los Hogares como Empleadores; Actividades No Diferenciadas de los Hogares</option>
                        <option value="Actividades de Organizaciones y Órganos Extraterritoriales">Actividades de Organizaciones y Órganos Extraterritoriales </option>
                    </select>
                </div>

                <div>
                    <label for="personal-a-cargo">Personal a cargo</label>
                    <select id="personal-a-cargo" name="personal_a_cargo">
                        <option value="" disabled>Selecciona personas a cargo</option>
                        <option value="1 a 5 personas">1 a 5 personas</option>
                        <option value="6 a 10 personas">6 a 10 personas</option>
                        <option value="mas de 10 personas">Más de 10 personas</option>
                        <option value="ninguno">Ninguno</option>
                    </select>
                </div>

                <div id="contenedor-sueldo">
                    <label for="sueldo">Sueldo</label>
                    <select id="sueldo" name="sueldo">
                        <option value="" selected disabled>Selecciona sueldo</option>
                        <option value="$500.000 a $1.000.000">$500.000 a $1.000.000</option>
                        <option value="$1.000.000 a $2.000.000">$1.000.000 a $2.000.000</option>
                        <option value="$2.000.000 a $3.000.000">$2.000.000 a $3.000.000</option>
                        <option value="$3.000.000 a $4.000.000">$3.000.000 a $4.000.000</option>
                        <option value="$4.000.000 a $5.000.000">$4.000.000 a $5.000.000</option>
                        <option value="más de $5.000.000">más de $5.000.000</option>
                    </select>
                </div>


                <div style="justify-content: space-between;">
                    <label for="fecha-inicio-experiencia">Fecha de inicio</label><br>
    
                    <select name="anio_inicio" id="anio-inicio-experiencia" style="width: 49%;">
                    </select>
    
                    <select name="mes_inicio" id="mes-inicio-experiencia" style="width: 49%;">
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
    
                </div>
    
                <div style="justify-content: space-between;">
                    <label for="fecha-fin-experiencia">Fecha término</label><br>
    
                    <select name="anio_fin" id="anio-fin-experiencia" style="width: 49%;">
                    </select>
    
                    <select name="mes_fin" id="mes-fin-experiencia" style="width: 49%;">
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>

                <div>
                    <label for="resposabilidad-logros" style="margin-bottom: 5px; display: block;">Responsabilidad y logros</label>
                    <textarea name="resposabilidad_logros" rows="5" placeholder="Escribir responsabilidades y logros" style="width: 100%; padding: 10px;" id="responsabilidad-logros"></textarea>
                    <span class="informativo">Cantidad máxima de caracteres permitidos 2000</span>
                </div>
            </div>

            <input type="hidden" name="form_type" value="new-experiencia-laboral">                
                                <div class="mid-boton">
                                    
                                    <a  class="botones-atras boton-cancelar" id="boton-cancelar">CANCELAR</a><br/>
                                    <a  class="botones boton-enviar" id="boton-enviar">GUARDAR</a>
                                </div>


                            </div>
                            </form>
                            <div class="sucess-div" style="display:none">
                                <div class="modal-mensaje">
                                    
                                        <div class="success-animation">
                                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                                        </div>
                                        
                                        <div class="texto-modal">
                                            <h3>Datos guardados exitosamente</h3>
                                        </div>
                                      
                                            <a class="botones continuar-modal" href="javascript:location.reload();">CONTINUAR</a>
                                        
                                </div>
                            </div>
                            
                        </div>
                    </div><!---fin modal--->



                <div class="informacion-contacto laboral">
                    <?php
                        $buscarXP= "SELECT * from ryqbd_experiencia WHERE user_key='".$_SESSION['user']."'";
                        $resultadoXP = sqlsrv_query($conn, $buscarXP);
                        $contadorxp = 1;
                        $clase = "";
                        if( $resultadoXP === false )  
                        {  
                             echo "Error in query preparation/execution.\n";  
                             die( print_r( sqlsrv_errors(), true));  
                        }  
                            
                        while ($fila = sqlsrv_fetch_array($resultadoXP)) {
                                switch ($contadorxp) {
                                    case 1:
                                        $clase = "experiencia-uno";
                                        break;
                                    case 2:
                                        $clase = "experiencia-dos";
                                        break;
                                    case 3:
                                        $clase = "experiencia-tres";
                                        break;
                                }
                                $contadorxp++;
                                $dini =strtotime($fila["user_fechainicio"]);
                                $dfin =strtotime($fila["user_fechatermino"]);

                    ?>
                    <div class="<?php echo $clase; ?>" >
                        <?php if($clase != "experiencia-uno"){ echo '<hr>';} ?>
                            <p><strong><?php echo $fila["user_cargo"]; ?></strong></p>
                            <li><strong><?php echo date("Y", $dini); ?><?php if($dfin > 0){echo " - ".date("Y", $dfin);}else{echo " - "."A la Fecha ";} ?></strong> <?php echo $fila["user_empresa"]; ?></li>
                        <p><?php echo $fila["user_actividad_empresa"]; ?></p>
                        <div class="editar-borrar">
                            <a href="" class="editar-experiencia boton-editar" data-modal="<?php echo $clase; ?>"></a>
                            <a href="" class="borrar-experiencia" data-exp="<?php echo $fila["exp_id"]; ?>"></a>
                        </div>
                        
                    </div>

                    <div class="modal-edit" id="<?php echo $clase; ?>"><!---modal--->
                        <div class="modal-content">
                            <h1 class="titulo-principal-interior-form">EXPERIENCIA <strong>LABORAL</strong></h1>
                            <form action="">
                            <div class="formulario-ingreso">
                                
                               <div class="<?php echo $clase; ?>-edit">

                <div>
                    <label for="cargo">Cargo</label>
                    <input type="text" name="cargo" placeholder="Nombre del cargo" value="<?php echo $fila["user_cargo"]; ?>">
                </div>

                <div>
                    <label for="empresa">Empresa</label>
                    <input type="text" name="empresa" placeholder="Nombre del cargo" value="<?php echo $fila["user_empresa"]; ?>">
                </div>

                <div>
                    <label for="actividad-empresa">Actividad de la empresa</label>
                    <select id="actividad-empresa" name="actividad_empresa" data-select = "<?php echo $fila["user_actividad_empresa"]; ?>">
                        <option value="" disabled>Selecciona actividad</option>
                        <option value="Agricultura, Ganadería, Silvicultura y Pesca">Agricultura, Ganadería, Silvicultura y Pesca</option>
                        <option value="Explotación de Minas y Canteras">Explotación de Minas y Canteras </option>
                        <option value="Industrias Manufacturera">Industrias Manufacturera</option>
                        <option value="Suministro de Electricidad, Gas, Vapor y Aire Acondicionado ">Suministro de Electricidad, Gas, Vapor y Aire Acondicionado </option>
                        <option value="Suministro de Agua, Evacuación de Agua residuales, gestión de desechos y descontaminación">Suministro de Agua, Evacuación de Agua residuales, gestión de desechos y descontaminación </option>
                        <option value="Construcción">Construcción</option>
                        <option value="Comercio al Por Mayor y al por Menor, Reparación de Vehículos Automotores y Motocicletas">Comercio al Por Mayor y al por Menor, Reparación de Vehículos Automotores y Motocicletas</option>
                        <option value="Transporte y Almacenamiento">Transporte y Almacenamiento</option>
                        <option value="Actividades de Alojamiento y de Servicio de Comidas">Actividades de Alojamiento y de Servicio de Comidas </option>
                        <option value="Información y Comunicaciones">Información y Comunicaciones</option>
                        <option value="Actividades Financieras y de Seguros ">Actividades Financieras y de Seguros </option>
                        <option value="Actividades inmobiliarias">Actividades inmobiliarias</option>
                        <option value="Actividades Profesionales, Cientificas y Técnicas">Actividades Profesionales, Cientificas y Técnicas </option>
                        <option value="Actividades de Servicios Administrativos y de Apoyo">Actividades de Servicios Administrativos y de Apoyo </option>
                        <option value="Adm. Pública y Defensa; Planes de Seguridad Social de Afiliación Obligatoria">Adm. Pública y Defensa; Planes de Seguridad Social de Afiliación Obligatoria</option>
                        <option value="Enseñanza">Enseñanza</option>
                        <option value="Actividades de Atención de la Salud Humana y de Asistencia Social">Actividades de Atención de la Salud Humana y de Asistencia Social</option>
                        <option value="Actividades Artísticas, de Entretenimiento y Recreativas">Actividades Artísticas, de Entretenimiento y Recreativas</option>
                        <option value="Otras Actividades de Servicios">Otras Actividades de Servicios</option>
                        <option value="Actividades de los Hogares como Empleadores; Actividades No Diferenciadas de los Hogares">Actividades de los Hogares como Empleadores; Actividades No Diferenciadas de los Hogares</option>
                        <option value="Actividades de Organizaciones y Órganos Extraterritoriales">Actividades de Organizaciones y Órganos Extraterritoriales </option>
                    </select>
                </div>

                <div>
                    <label for="personal-a-cargo">Personal a cargo</label>
                    <select id="personal-a-cargo" name="personal_a_cargo">
                        <option value="" disabled>Selecciona personas a cargo</option>
                        <option value="1 a 5 personas" <?php if($fila["user_personal_acargo"] == "1 a 5 personas"){echo "selected";} ?>>1 a 5 personas</option>
                        <option value="6 a 10 personas" <?php if($fila["user_personal_acargo"] == "6 a 10 personas"){echo "selected";} ?>>6 a 10 personas</option>
                        <option value="mas de 10 personas" <?php if($fila["user_personal_acargo"] == "mas de 10 personas"){echo "selected";} ?>>Más de 10 personas</option>
                        <option value="ninguno" <?php if($fila["user_personal_acargo"] == "ninguno"){echo "selected";} ?>>Ninguno</option>
                    </select>
                </div>

                <div id="contenedor-sueldo">
                    <label for="sueldo">Sueldo</label>
                    <select id="sueldo" name="sueldo">
                        <option value="" selected disabled>Selecciona sueldo</option>
                        <option value="$500.000 a $1.000.000" <?php if($fila["user_sueldo"] == "$500.000 a $1.000.000"){echo "selected";} ?>>$500.000 a $1.000.000</option>
                        <option value="$1.000.000 a $2.000.000" <?php if($fila["user_sueldo"] == "$1.000.000 a $2.000.000"){echo "selected";} ?>>$1.000.000 a $2.000.000</option>
                        <option value="$2.000.000 a $3.000.000" <?php if($fila["user_sueldo"] == "$2.000.000 a $3.000.000"){echo "selected";} ?>>$2.000.000 a $3.000.000</option>
                        <option value="$3.000.000 a $4.000.000" <?php if($fila["user_sueldo"] == "$3.000.000 a $4.000.000"){echo "selected";} ?>>$3.000.000 a $4.000.000</option>
                        <option value="$4.000.000 a $5.000.000" <?php if($fila["user_sueldo"] == "$4.000.000 a $5.000.000"){echo "selected";} ?>>$4.000.000 a $5.000.000</option>
                        <option value="más de $5.000.000" <?php if($fila[" user_sueldo"] == "más de $5.000.000"){echo "selected";} ?>>más de $5.000.000</option>
                    </select>
                </div>


                <div style="justify-content: space-between;">
                    <label for="fecha-inicio-experiencia">Fecha de inicio</label><br>
    
                    <select name="anio_inicio" id="anio-inicio-experiencia-<?php echo $contadorxp; ?>" style="width: 49%;">
                        <option value="<?php echo date("Y", $dini); ?>"><?php echo date("Y", $dini); ?></option>
                    </select>
    
                    <select name="mes_inicio" id="mes-inicio-experiencia-<?php echo $contadorxp; ?>" style="width: 49%;">
                        <option value="01" <?php if(date("m", $dini) == "01"){echo "selected";} ?>>Enero</option>
                        <option value="02" <?php if(date("m", $dini) == "02"){echo "selected";} ?>>Febrero</option>
                        <option value="03" <?php if(date("m", $dini) == "03"){echo "selected";} ?>>Marzo</option>
                        <option value="04" <?php if(date("m", $dini) == "04"){echo "selected";} ?>>Abril</option>
                        <option value="05" <?php if(date("m", $dini) == "05"){echo "selected";} ?>>Mayo</option>
                        <option value="06" <?php if(date("m", $dini) == "06"){echo "selected";} ?>>Junio</option>
                        <option value="07" <?php if(date("m", $dini) == "07"){echo "selected";} ?>>Julio</option>
                        <option value="08" <?php if(date("m", $dini) == "08"){echo "selected";} ?>>Agosto</option>
                        <option value="09" <?php if(date("m", $dini) == "09"){echo "selected";} ?>>Septiembre</option>
                        <option value="10" <?php if(date("m", $dini) == "10"){echo "selected";} ?>>Octubre</option>
                        <option value="11" <?php if(date("m", $dini) == "11"){echo "selected";} ?>>Noviembre</option>
                        <option value="12" <?php if(date("m", $dini) == "12"){echo "selected";} ?>>Diciembre</option>
                    </select>
    
                </div>
    
                <div style="justify-content: space-between;">
                    <label for="fecha-fin-experiencia">Fecha término</label><br>
    
                    <select name="anio_fin" id="anio-fin-experiencia-<?php echo $contadorxp; ?>" style="width: 49%;">
                        <option value="<?php echo date("Y", $dfin); ?>"><?php echo date("Y", $dfin); ?></option>
                    </select>
    
                    <select name="mes_fin" id="mes-fin-experiencia-<?php echo $contadorxp; ?>" style="width: 49%;">
                        <option value="01" <?php if(date("m", $dfin) == "01"){echo "selected";} ?>>Enero</option>
                        <option value="02" <?php if(date("m", $dfin) == "02"){echo "selected";} ?>>Febrero</option>
                        <option value="03" <?php if(date("m", $dfin) == "03"){echo "selected";} ?>>Marzo</option>
                        <option value="04" <?php if(date("m", $dfin) == "04"){echo "selected";} ?>>Abril</option>
                        <option value="05" <?php if(date("m", $dfin) == "05"){echo "selected";} ?>>Mayo</option>
                        <option value="06" <?php if(date("m", $dfin) == "06"){echo "selected";} ?>>Junio</option>
                        <option value="07" <?php if(date("m", $dfin) == "07"){echo "selected";} ?>>Julio</option>
                        <option value="08" <?php if(date("m", $dfin) == "08"){echo "selected";} ?>>Agosto</option>
                        <option value="09" <?php if(date("m", $dfin) == "09"){echo "selected";} ?>>Septiembre</option>
                        <option value="10" <?php if(date("m", $dfin) == "10"){echo "selected";} ?>>Octubre</option>
                        <option value="11" <?php if(date("m", $dfin) == "11"){echo "selected";} ?>>Noviembre</option>
                        <option value="12" <?php if(date("m", $dfin) == "12"){echo "selected";} ?>>Diciembre</option>
                    </select>
                </div>

                <div>
                    <label for="resposabilidad-logros" style="margin-bottom: 5px; display: block;">Responsabilidad y logros</label>
                    <textarea name="resposabilidad_logros" rows="5" placeholder="Escribir responsabilidades y logros" style="width: 100%; padding: 10px;" id="responsabilidad-logros"><?php echo $fila["user_responsabilidadylogros"]; ?></textarea>
                    <span class="informativo">Cantidad máxima de caracteres permitidos 2000</span>
                </div>
            </div>

            <input type="hidden" name="form_type" value="experiencia-laboral">
             <input type="hidden" name="ide_form" value="<?php echo $fila["exp_id"]; ?>">                   
                                <div class="mid-boton">
                                    
                                    <a  class="botones-atras boton-cancelar" id="boton-cancelar">CANCELAR</a><br/>
                                    <a  class="botones boton-enviar" id="boton-enviar">GUARDAR</a>
                                </div>


                            </div>
                            </form>
                            <div class="sucess-div" style="display:none">
                                <div class="modal-mensaje">
                                    
                                        <div class="success-animation">
                                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                                        </div>
                                        
                                        <div class="texto-modal">
                                            <h3>Datos guardados exitosamente</h3>
                                        </div>
                                      
                                            <a class="botones continuar-modal" href="javascript:location.reload();">CONTINUAR</a>
                                        
                                </div>
                            </div>
                            
                        </div>
                    </div><!---fin modal--->

                    <?php 
                            };
                    ?> 
                   
                </div>
            </div>

            <div class="informacion-box" id="datos-academicos">
                <div class="titulo-box">
                    <h4>Antecedentes acádemicos</h4>
                    <a href="" class="boton-editar" data-modal="agregar-ant" id="agregar-ant-boton">Agregar Antencedentes</a>
                </div>

                <!---modal---><div class="modal-edit" id="agregar-ant">
                        <div class="modal-content">
                            <h1 class="titulo-principal-interior-form">ESTUDIOS <strong>SUPERIORES</strong></h1>
                            <form action="">
                            <div class="formulario-ingreso">
                                
                                <div>
                <label for="institucion">Institución</label>
                <input type="text" id="institucion" name="institucion" placeholder="Ej: Pontificia Universidad Católica de Chile">
            </div>

            <div>
                <label for="carrera">Carrera</label>
                <input type="text" id="carrera" name="carrera" placeholder="Ej: Administración Gastronómica">
            </div>

            <div>
                <label for="situacion-academica">Situación académica actual</label>
                <select name="situacion_academica" id="situacion-academica">
                    <option value=""selected disabled>Selecciona tu situación académica</option>
                    <option value="en curso">En curso</option>
                    <option value="egresado">Egresado</option>
                    <option value="titulado">Títulado</option>
                    <option value="congelado">Congelado</option>
                </select>
            </div>

            
            <div style="justify-content: space-between;">
                <label for="fecha-inicio">Fecha de inicio</label><br>

                <select name="anio_inicio" id="anio-inicio" style="width: 49%;">
                    <option value="" selected disabled>Año inicio</option>
                </select>

                <select name="mes_inicio" id="mes-inicio-<?php echo $contadorant; ?>" style="width: 49%;">
                    <option value="" selected disabled>Mes inicio</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>

            </div>

            <div style="justify-content: space-between; <?php if($fila["user_situacion"] == "en curso"){echo "display: none";} ?>" class="fecha-termino-content">
                <label for="fecha-fin">Fecha término</label><br>

                <select name="anio_fin" id="anio-fin-<?php echo $contadorant; ?>" style="width: 49%;">
                    <option value="" selected disabled>Año término</option>
                </select>

                <select name="mes_fin" id="mes-fin-<?php echo $contadorant; ?>" style="width: 49%;">
                    <option value="" selected disabled>Mes término</option>
                    <option value="01">Enero</option>
                    <option value="02">Febrero</option>
                    <option value="03">Marzo</option>
                    <option value="04">Abril</option>
                    <option value="05">Mayo</option>
                    <option value="06">Junio</option>
                    <option value="07">Julio</option>
                    <option value="08">Agosto</option>
                    <option value="09">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
            </div>
                                <input type="hidden" name="form_type" value="new-antecedentes-academicos">  
                                
                                <div class="mid-boton">
                                    
                                    <a  class="botones-atras boton-cancelar" id="boton-cancelar">CANCELAR</a><br/>
                                    <a  class="botones boton-enviar" id="boton-enviar">GUARDAR</a>
                                </div>

                            </div>
                            </form>
                            <div class="sucess-div" style="display:none">
                                <div class="modal-mensaje">
                                    
                                        <div class="success-animation">
                                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                                        </div>
                                        
                                        <div class="texto-modal">
                                            <h3>Datos guardados exitosamente</h3>
                                        </div>
                                      
                                            <a class="botones continuar-modal" href="javascript:location.reload();">CONTINUAR</a>
                                        
                                </div>
                            </div>
                            
                        </div>
                    </div><!---fin modal--->


                <div class="informacion-contacto academicos">
                    <?php
                        $buscarES= "SELECT * from ryqbd_datosacademicos WHERE user_key='".$_SESSION['user']."'";

                        $resultadoES = sqlsrv_query($conn, $buscarES);
                        $contadorant = 1;
                        $clase = "";
                        if( $resultadoES === false )  
                        {  
                             echo "Error in query preparation/execution.\n";  
                             die( print_r( sqlsrv_errors(), true));  
                        }  
                            
                        while ($fila = sqlsrv_fetch_array($resultadoES)) {

                                switch ($contadorant) {
                                    case 1:
                                        $clase = "experiencia-uno";
                                        break;
                                    case 2:
                                        $clase = "experiencia-dos";
                                        break;
                                    case 3:
                                        $clase = "experiencia-tres";
                                        break;
                                }
                                $contadorant++;
                                $dini =strtotime($fila["user_fechainicio"]);
                                $dfin =strtotime($fila["user_fechatermino"]);
                    ?>
                    <div class="<?php echo $clase; ?>" >
                        <?php if($clase != "experiencia-uno"){ echo '<hr>';} ?>
                            <p><strong><?php echo $fila["user_carrera"]; ?></strong></p>
                            <li><strong><?php echo date("Y", $dini); ?><?php if($dfin > 0){echo " - ".date("Y", $dfin);}else{echo " - "."A la Fecha ";} ?></strong> <?php echo $fila["user_institucion"]; ?></li>
                        <div class="editar-borrar">
                            <a href="" class="editar-experiencia  boton-editar" data-modal="ant-<?php echo $clase; ?>"></a>
                            <a href="" class="borrar-antecendentes" data-exp="<?php echo $fila["data_id"]; ?>"></a>
                        </div>
                        
                    </div>

                    <!---modal---><div class="modal-edit" id="ant-<?php echo $clase; ?>">
                        <div class="modal-content">
                            <h1 class="titulo-principal-interior-form">ESTUDIOS <strong>SUPERIORES</strong></h1>
                            <form action="">
                            <div class="formulario-ingreso">
                                
                                <div>
                <label for="institucion">Institución</label>
                <input type="text" id="institucion" name="institucion" value="<?php echo $fila["user_institucion"]; ?>" placeholder="Ej: Pontificia Universidad Católica de Chile">
            </div>

            <div>
                <label for="carrera">Carrera</label>
                <input type="text" id="carrera" name="carrera" value="<?php echo $fila["user_carrera"]; ?>" placeholder="Ej: Administración Gastronómica">
            </div>

            <div>
                <label for="situacion-academica">Situación académica actual</label>
                <select name="situacion_academica" id="situacion-academica">
                    <option value=""selected disabled>Selecciona tu situación académica</option>
                    <option value="en curso" <?php if($fila["user_situacion"] == "en curso"){echo "selected";} ?>>En curso</option>
                    <option value="egresado" <?php if($fila["user_situacion"] == "egresado"){echo "selected";} ?>>Egresado</option>
                    <option value="titulado" <?php if($fila["user_situacion"] == "titulado"){echo "selected";} ?>>Títulado</option>
                    <option value="congelado" <?php if($fila["user_situacion"] == "congelado"){echo "selected";} ?>>Congelado</option>
                </select>
            </div>

            
            <div style="justify-content: space-between;">
                <label for="fecha-inicio">Fecha de inicio</label><br>

                <select name="anio_inicio" id="anio-inicio-<?php echo $contadorant; ?>" style="width: 49%;">
                    <option value="<?php echo date("Y", $dini); ?>"><?php echo date("Y", $dini); ?></option>
                </select>

                <select name="mes_inicio" id="mes-inicio-<?php echo $contadorant; ?>" style="width: 49%;">
                    <option value="" selected disabled>Mes inicio</option>
                    <option value="01" <?php if(date("m", $dini) == "01"){echo "selected";} ?>>Enero</option>
                        <option value="02" <?php if(date("m", $dini) == "02"){echo "selected";} ?>>Febrero</option>
                        <option value="03" <?php if(date("m", $dini) == "03"){echo "selected";} ?>>Marzo</option>
                        <option value="04" <?php if(date("m", $dini) == "04"){echo "selected";} ?>>Abril</option>
                        <option value="05" <?php if(date("m", $dini) == "05"){echo "selected";} ?>>Mayo</option>
                        <option value="06" <?php if(date("m", $dini) == "06"){echo "selected";} ?>>Junio</option>
                        <option value="07" <?php if(date("m", $dini) == "07"){echo "selected";} ?>>Julio</option>
                        <option value="08" <?php if(date("m", $dini) == "08"){echo "selected";} ?>>Agosto</option>
                        <option value="09" <?php if(date("m", $dini) == "09"){echo "selected";} ?>>Septiembre</option>
                        <option value="10" <?php if(date("m", $dini) == "10"){echo "selected";} ?>>Octubre</option>
                        <option value="11" <?php if(date("m", $dini) == "11"){echo "selected";} ?>>Noviembre</option>
                        <option value="12" <?php if(date("m", $dini) == "12"){echo "selected";} ?>>Diciembre</option>
                </select>

            </div>

            <div style="justify-content: space-between; <?php if($fila["user_situacion"] == "en curso"){echo "display: none";} ?>" class="fecha-termino-content">
                <label for="fecha-fin">Fecha término</label><br>

                <select name="anio_fin" id="anio-fin-<?php echo $contadorant; ?>" style="width: 49%;">
                    <option value="<?php echo date("Y", $dfin); ?>"><?php echo date("Y", $dfin); ?></option>
                </select>

                <select name="mes_fin" id="mes-fin-<?php echo $contadorant; ?>" style="width: 49%;">
                    <option value="01" <?php if(date("m", $dfin) == "01"){echo "selected";} ?>>Enero</option>
                        <option value="02" <?php if(date("m", $dfin) == "02"){echo "selected";} ?>>Febrero</option>
                        <option value="03" <?php if(date("m", $dfin) == "03"){echo "selected";} ?>>Marzo</option>
                        <option value="04" <?php if(date("m", $dfin) == "04"){echo "selected";} ?>>Abril</option>
                        <option value="05" <?php if(date("m", $dfin) == "05"){echo "selected";} ?>>Mayo</option>
                        <option value="06" <?php if(date("m", $dfin) == "06"){echo "selected";} ?>>Junio</option>
                        <option value="07" <?php if(date("m", $dfin) == "07"){echo "selected";} ?>>Julio</option>
                        <option value="08" <?php if(date("m", $dfin) == "08"){echo "selected";} ?>>Agosto</option>
                        <option value="09" <?php if(date("m", $dfin) == "09"){echo "selected";} ?>>Septiembre</option>
                        <option value="10" <?php if(date("m", $dfin) == "10"){echo "selected";} ?>>Octubre</option>
                        <option value="11" <?php if(date("m", $dfin) == "11"){echo "selected";} ?>>Noviembre</option>
                        <option value="12" <?php if(date("m", $dfin) == "12"){echo "selected";} ?>>Diciembre</option>
                </select>
            </div>
                                <input type="hidden" name="form_type" value="antecedentes-academicos">
                                <input type="hidden" name="ide_form" value="<?php echo $fila["data_id"]; ?>">     
                                
                                <div class="mid-boton">
                                    
                                    <a  class="botones-atras boton-cancelar" id="boton-cancelar">CANCELAR</a><br/>
                                    <a  class="botones boton-enviar" id="boton-enviar">GUARDAR</a>
                                </div>

                            </div>
                            </form>
                            <div class="sucess-div" style="display:none">
                                <div class="modal-mensaje">
                                    
                                        <div class="success-animation">
                                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                                        </div>
                                        
                                        <div class="texto-modal">
                                            <h3>Datos guardados exitosamente</h3>
                                        </div>
                                      
                                            <a class="botones continuar-modal" href="javascript:location.reload();">CONTINUAR</a>
                                        
                                </div>
                            </div>
                            
                        </div>
                    </div><!---fin modal--->


                    <?php 
                            };
                    ?> 
               
            </div>
            </div>

            <div class="informacion-box"  id="datos-adicionales">
                <div class="titulo-box">
                    <h4>Adicionales </h4>
                </div>
                <div class="informacion-contacto">
                    <?php if(isset($obj->userdata_licencia)){?>
                    <p><strong>Licencia de conducir:</strong> <?php echo $obj->userdata_licencia ?></p>
                    <?php } ?>
                    <?php if(isset($obj->userdata_tipolicencia)){?>
                    <p><strong>Tipo Licencia de conducir:</strong> <?php echo $obj->userdata_tipolicencia ?></p>
                    <?php } ?>
                    <?php if(isset($obj->userdata_discapacidad)){?>
                    <p><strong>Discapacidad:</strong> <?php echo $obj->userdata_discapacidad ?></p>
                    <?php } ?>
                    <?php if(isset($obj->userdata_tipodiscapacidad)){?>
                    <p><strong>Tipo Discapacidad:</strong> <?php echo $obj->userdata_tipodiscapacidad ?></p>
                    <?php } ?>
                    <?php if(isset($obj->userdata_pueblosoriginarios)){?>
                    <p><strong>Pueblos originarios:</strong> <?php echo $obj->userdata_pueblosoriginarios ?></p>
                    <?php } ?>
                    <a href="" class="editar-contacto boton-editar" data-modal="edit-adicionales"></a>
                </div>

                 <div class="modal-edit" id="edit-adicionales"><!---modal--->
                        <div class="modal-content">
                            <h1 class="titulo-principal-interior-form">INFORMACIÓN <strong>ADICIONAL</strong></h1>
                            <form action="">
                            <div class="formulario-ingreso">
                                    
                                 <div>
                                    <label for="licencia-de-conducir">Licencia de conducir <span class="importante">*</span></label>
                              
                                   <div>
                                        <input type="radio" name="licencia" value="si" id="licencia-si" <?php if($obj->userdata_licencia == "si"){ echo "checked";} ?> onclick="validarLicencia()"/>
                                        <label for="licencia-si">Si</label>
                                    
                                        <input type="radio" name="licencia" value="no" <?php if($obj->userdata_licencia == "no"){ echo "checked";} ?> id="licencia-no" onclick="validarLicencia()"/>
                                        <label for="licencia-no">No</label>
                                    </div>
                                </div> 

                                <div>
                                    <label for="tipo-licencia">Tipo de licencia</label>
                                    <select id="tipo-licencia" name="tipo_licencia" <?php if($obj->userdata_licencia == "no"){ echo "disabled";} ?>>
                                        <option value="">Selecciona tipo de licencia</option>
                                        <option value="Clase A1" <?php if($obj->userdata_tipolicencia == "Clase A1"){ echo "selected";} ?>>Clase A1</option>
                                        <option value="Clase A2" <?php if($obj->userdata_tipolicencia == "Clase A2"){ echo "selected";} ?>>Clase A2</option>
                                        <option value="Clase A3" <?php if($obj->userdata_tipolicencia == "Clase A3"){ echo "selected";} ?>>Clase A3</option>
                                        <option value="Clase A4" <?php if($obj->userdata_tipolicencia == "Clase A4"){ echo "selected";} ?>>Clase A4</option>
                                        <option value="Clase A5" <?php if($obj->userdata_tipolicencia == "Clase A5"){ echo "selected";} ?>>Clase A5</option>
                                        <option value="Clase B" <?php if($obj->userdata_tipolicencia == "Clase B"){ echo "selected";} ?>>Clase B</option>
                                        <option value="Clase C" <?php if($obj->userdata_tipolicencia == "Clase C"){ echo "selected";} ?>>Clase C</option>
                                        <option value="Clase D" <?php if($obj->userdata_tipolicencia == "Clase D"){ echo "selected";} ?>>Clase D</option>
                                        <option value="Clase E" <?php if($obj->userdata_tipolicencia == "Clase E"){ echo "selected";} ?>>Clase E</option>
                                        <option value="Clase F" <?php if($obj->userdata_tipolicencia == "Clase F"){ echo "selected";} ?>>Clase F</option>
                                        
                                    </select>
                                </div>

                                <div class="informacion-discapacidad-box">
                                    <label for="discapacidad">¿Tienes alguna discapacidad?</label><p class="informacion-discapacidad" style="left:50%;transform:translate(-50%,0)">Nuestra visión es ser la empresa líder en atracción de talentos, generando espacios innovadores de desarrollo profesional. Por ello, como política interna damos cabida a personas en situación de discapacidad. Menciona si requieres alguna necesidad especial para formar parte de nuestro equipo.</p><img src="assets/information-sign.svg" alt="info" style="max-width: 15px;">
                                    
                                    <div class="informacion-discapacidad-boton">
                                    <input type="radio" name="discapacidad" value="si" <?php if($obj->userdata_discapacidad == "si"){ echo "checked";} ?> id="discapacidad-si" onclick="validarDiscapacidad();"/>
                                    <label for="discapacidad-si">Si</label>
                                
                                    <input type="radio" name="discapacidad" value="no" <?php if($obj->userdata_discapacidad == "no"){ echo "checked";} ?> id="discapacidad-no" onclick="validarDiscapacidad();"/>
                                    <label for="discapacidad-no">No</label>

                                    </div>
                                </div>

                                <div>
                                    <label for="tipo-discapacidad">Tipo de discapacidad</label>
                                    <select id="tipo-discapacidad" name="tipo_discapacidad"  <?php if($obj->userdata_licencia == "no"){ echo "disabled";} ?>>
                                        <option value="" selected disabled>Selecciona una discapacidad</option>
                                        <option value="Fisica o Motora" <?php if($obj->userdata_tipodiscapacidad == "Fisica o Motora"){ echo "selected";} ?>>Fisica o Motora</option>
                                        <option value="Sensorial Auditiva" <?php if($obj->userdata_tipodiscapacidad == "Sensorial Auditiva"){ echo "selected";} ?>>Sensorial Auditiva</option>
                                        <option value="Sensorial Visual" <?php if($obj->userdata_tipodiscapacidad == "Sensorial Visual"){ echo "selected";} ?>>Sensorial Visual</option>
                                        <option value="Cognitiva o Intelectual" <?php if($obj->userdata_tipodiscapacidad == "Cognitiva o Intelectual"){ echo "selected";} ?>>Cognitiva o Intelectual</option>
                                        <option value="Psíquica o Psiquiatrica" <?php if($obj->userdata_tipodiscapacidad == "Psíquica o Psiquiatrica"){ echo "selected";} ?>>Psíquica o Psiquiatrica</option>
                                    </select>
                                </div>

                                <h3 style="text-align: center;margin-top:30px;">ETNIA</h3>

                                <div>
                                    <label for="">¿Pertenece a algún pueblo originario?<span class="importante">*</span></label>
                              
                                   <div>
                                        <input type="radio" name="originarios" value="si" id="originarios-si"  <?php if($obj->userdata_pueblosoriginarios != ""){ echo "checked";} ?> onclick="validarPueblos();"/>
                                        <label for="originarios-si">Si</label>
                                    
                                        <input type="radio" name="originarios" value="no" id="originarios-no" <?php if($obj->userdata_pueblosoriginarios == ""){ echo "checked";} ?> onclick="validarPueblos();"/>
                                        <label for="originarios-no">No</label>
                                </div> 
                                
                                <div>
                                    <label for="pueblos-originarios">Pueblos originarios</label>
                                    <select id="pueblos-originarios" name="pueblos_originarios"  <?php if($obj->userdata_licencia == "no"){ echo "disabled";} ?>>
                                        <option value="" selected disabled>Selecciona si pertenecces a un pueblo originario</option>
                                        <option value="no informa" <?php if($obj->userdata_pueblosoriginarios == "no informa"){ echo "selected";} ?>>Prefiero no informar</option>
                                        <option value="picunches" <?php if($obj->userdata_pueblosoriginarios == "picunches"){ echo "selected";} ?>>Picunches</option>
                                        <option value="mapuches" <?php if($obj->userdata_pueblosoriginarios == "mapuches"){ echo "selected";} ?>>Mapuches</option>
                                        <option value="huilliches" <?php if($obj->userdata_pueblosoriginarios == "huilliches"){ echo "selected";} ?>>Huilliches</option>
                                        <option value="rapanui" <?php if($obj->userdata_pueblosoriginarios == "rapanui"){ echo "selected";} ?>>Rapanui</option>
                                        <option value="diaguitas" <?php if($obj->userdata_pueblosoriginarios == "diaguitas"){ echo "selected";} ?>>Diaguitas</option>
                                        <option value="atacameños" <?php if($obj->userdata_pueblosoriginarios == "atacameños"){ echo "selected";} ?>>Atacameños</option>
                                        <option value="caucauhes" <?php if($obj->userdata_pueblosoriginarios == "caucauhes"){ echo "selected";} ?>>Caucahués</option>
                                        <option value="changos" <?php if($obj->userdata_pueblosoriginarios == "changos"){ echo "selected";} ?>>Changos</option>
                                        <option value="cuncos" <?php if($obj->userdata_pueblosoriginarios == "cuncos"){ echo "selected";} ?>>Cuncos</option>
                                        <option value="kawesqar" <?php if($obj->userdata_pueblosoriginarios == "kawesqar"){ echo "selected";} ?>>Kawésqar</option>
                                        <option value="yaganes" <?php if($obj->userdata_pueblosoriginarios == "yaganes"){ echo "selected";} ?>>Yaganes</option>
                                        <option value="aonikenk" <?php if($obj->userdata_pueblosoriginarios == "aonikenk"){ echo "selected";} ?>>Aonikenk</option>
                                        <option value="selknam" <?php if($obj->userdata_pueblosoriginarios == "selknam"){ echo "selected";} ?>>Selknam</option>
                                    </select>
                                </div>
                            </div>

                                <input type="hidden" name="form_type" value="informacion-adicional">
                                
                                <div class="mid-boton">
                                    
                                    <a  class="botones-atras boton-cancelar" id="boton-cancelar">CANCELAR</a><br/>
                                    <a  class="botones boton-enviar" id="boton-enviar">GUARDAR</a>
                                </div>

                            </div>
                            </form>
                            <div class="sucess-div" style="display:none">
                                <div class="modal-mensaje">
                                    
                                        <div class="success-animation">
                                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                                        </div>
                                        
                                        <div class="texto-modal">
                                            <h3>Datos guardados exitosamente</h3>
                                        </div>
                                      
                                            <a class="botones continuar-modal" href="javascript:location.reload();">CONTINUAR</a>
                                        
                                </div>
                            </div>
                            
                        </div>
                    </div><!---fin modal--->

            </div>

            <div class="informacion-box">
                <div class="titulo-box">
                    <?php if(isset($obj->userdata_CV)){?>
                    <h4><a href="showcv.php" target="_blank">Tu Curriculum</h4>
                    <?php } ?>
                    <a href="" class="boton-editar" data-modal="edit-cv" id="edit-cv-boton">Agregar Curriculum</a>

                    <div class="modal-edit" id="edit-cv"><!---modal--->
                        <div class="modal-content">
                            <h1 class="titulo-principal-interior-form">INFORMACIÓN <strong>ADICIONAL</strong></h1>
                            <form action="">
                            <div class="formulario-ingreso">
                                    
                                 <div>
                                    <label for="curriculum" style="display:block">Sube tu curriculum <span class="importante">*</span></label>
                                    
                                    <input type="file" name="file" id="curriculum" style="border:none;" >
                                    
                                    <span class="informativo" style="display: block;">Carga tu CV en pdf o Word</span>
                                </div>


                                <input type="hidden" name="form_type" value="cv">
                                
                                <div class="mid-boton">
                                    
                                    <a  class="botones-atras boton-cancelar" id="boton-cancelar">CANCELAR</a><br/>
                                    <a  class="botones boton-enviar-archivo" id="boton-enviar">GUARDAR</a>
                                </div>

                            </div>
                            </form>
                            <div class="sucess-div" style="display:none">
                                <div class="modal-mensaje">
                                    
                                        <div class="success-animation">
                                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
                                        </div>
                                        
                                        <div class="texto-modal">
                                            <h3>Datos guardados exitosamente</h3>
                                        </div>
                                      
                                            <a class="botones continuar-modal" href="javascript:location.reload();">CONTINUAR</a>
                                        
                                </div>
                            </div>
                            
                        </div>
                    </div><!---fin modal--->

                </div>
            </div>

          <!--   <div class="mid-boton">
                <button type="submit" class="botones">GUARDAR</button>
            </div>   -->
        
        </div>
    </form>
        <div>
            <div class="grid-box circulo-desktop">
                <svg class="round" viewbox="0 0 100 100" width="120" height="120" data-percent="100">
                    
                  <circle cx="50" cy="50" r="40" />
                  <circle cx="50" cy="50" r="37" stroke="#f1f1f1" stroke-width="2" fill="none" /> 
                </svg>
                <div class="texto">
                    <p>Tu CV esta al</p>
                    <p class="blue-number">100%</p>
                </div>
            </div>
        </div>

        </div>
    </article>
    </section>
    

</main>

<?php getFooterScripts('cv'); ?>
<?php 
if($contadorxp > 3){
                                echo '<script>jQuery(document).ready(function (){$("#agregar-xp-boton").remove(); });</script>';
                            }
if($contadorant > 3){
                                echo '<script>jQuery(document).ready(function (){$("#agregar-ant-boton").remove(); });</script>';
                            }

                            
                            ?>
</body>
</html>