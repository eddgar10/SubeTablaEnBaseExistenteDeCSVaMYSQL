<!--
    *SE CAMBIAN LOS ATRIBUTOS A VARCHAR DE TODOS LOS CAMPOS PARA RECIBIR TABLAS CON ESPACIOS BLANCOS Y ENCABEZADOS
    SE AÑADE query  PARA:
    *ELIMINAR ENCABEZADOS
    *ELIMINAR FILAS VACIAS
    
-->

<?php
include __DIR__ . '/db_connect.php';
$nombre = $_POST['nombrebdmadre'];
$nombretabla = "6090".$nombre;


if(isset($_POST['import_data']))
    {
    
    // VALIDACION DE QUE EL ARCHIVO CARGADO ES UN FORMATO CSV O SIMILAR
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.ms-excel');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
            {

            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csv_file = fopen($_FILES['file']['tmp_name'], 'r');


            //CREACION DE TABLA PARA PROCEDER A CARGAR INFORMACION DE ARCHIVO LEIDO
            //REF: https://www.w3schools.com/php/php_mysql_create_table.asp 
            //TODOS LOS CAMPOS SE DEFINEN COMO VARCHAR PARA ASI LLEMAR LA TABLA INCLUYENDO FILAS VACIAS
            //LAS FILAS VACIAS CARGADAS DEL DOCUMENTO SE ELIMINAN AL FINAL CON EL QUERY $eliminafilasvacias
            //EL ENCABEZADO QUE TRAE EL DOCUMENTO SE ELIMINA CON EL QUERY $eliminaencabezado 
            
            //ESTA GENERANDO UN ERROR DE CARGHA CON FRASES QUE INCLUYEN ' ya que la sentencia lo toma como cierre de variable, revisar correccion con  VARIANTES DE CODIFICACION UTF8
                
               $sql = "CREATE TABLE $nombretabla (
                        seg varchar(6),
                        id varchar(10),
                        cuenta varchar(8),
                        ppa varchar(20),
                        capa varchar(4),
                        ccto varchar(4),
                        ano_alta varchar(10),
                        ciclo varchar(5),
                        estcob varchar(6),
                        tp varchar(10),
                        cel varchar(10),
                        nombre varchar(80),
                        total varchar(30),
                        act varchar(30),
                        s30 varchar(30),
                        pena varchar(30),
                        minimo varchar(6),
                        tel_1 varchar(10),
                        tel_2 varchar(10),
                        tel_3 varchar(10),
                        tel_4 varchar(10),
                        edo varchar(4),
                        email varchar(80))";

                        if (mysqli_query($conn, $sql))
                            {
                              echo "Table MyGuests created successfully";
                            } 
                        else
                            {
                            echo "Error creating table: " . mysqli_error($conn);
                            }
            //FIN PARA CREAR TABLA EN BD SERVEI

                // EXTRAE DATOS DE ARCHIVO CSV CARGADO PREVIAMENTE
                //set_time_limite(0); //para no perder conexion con sql al cargar muchos registros

                while(($emp_record = fgetcsv($csv_file)) !== FALSE)
                    {
                    
                    // QUERY MANUAL: 
                    //$mysql_insert = "INSERT INTO $nombretabla (seg, id ,cuenta, ppa, capa, ccto, ano_alta, ciclo, estcob, tp, cel, nombre, total, act, s30, pena, minimo, tel_1, tel_2, tel_3, tel_4, edo, email) VALUES ('1', 'C06 CAPA60', '73548985', '0', '60', 'BU', '25/may', '6', 'SP', 'V', '9221591899', 'CRUZ MONTELONGO PAULINO FRANCISCO', '6617,71', '6617,71', '0', '0', '3309', '9221259159', '9221409736', '2292644649', '9221028249', 'Ver', 'PAULINO_FCM@HOTMAIL.COM' )";
                    
                    
                    //QUERY CON DATOS DE EXCEL  
                   $mysql_insert = "INSERT INTO $nombretabla(
                                    seg,
                                    id,
                                    cuenta,
                                    ppa,
                                    capa,
                                    ccto,
                                    ano_alta,
                                    ciclo,
                                    estcob,
                                    tp,
                                    cel,
                                    nombre,
                                    total,
                                    act,
                                    s30,
                                    pena,
                                    minimo,
                                    tel_1,
                                    tel_2,
                                    tel_3,
                                    tel_4,
                                    edo,
                                    email
                                )
                                VALUES(
                                    '".$emp_record[0]."',
                                    '".$emp_record[1]."',
                                    '".$emp_record[2]."',
                                    '".$emp_record[3]."',
                                    '".$emp_record[4]."',
                                    '".$emp_record[5]."',
                                    '".$emp_record[6]."',
                                    '".$emp_record[7]."',
                                    '".$emp_record[8]."',
                                    '".$emp_record[9]."',
                                    '".$emp_record[10]."',
                                    '".$emp_record[11]."',
                                    '".$emp_record[12]."',
                                    '".$emp_record[13]."',
                                    '".$emp_record[14]."',
                                    '".$emp_record[15]."',
                                    '".$emp_record[16]."',
                                    '".$emp_record[17]."',
                                    '".$emp_record[18]."',
                                    '".$emp_record[19]."',
                                    '".$emp_record[20]."',
                                    '".$emp_record[21]."',
                                    '".$emp_record[22]."')";
                    
                    
                        mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
                    }
                }
        fclose($csv_file);
        $import_status = '?import_status=success';
            } 
        else
            {
                $import_status = '?import_status=error';
            }
    } 
    else 
        {
            $import_status = '?import_status=invalid_file';
        }
    $eliminafilasvacias= "DELETE FROM $nombretabla WHERE seg ='' ";
    mysqli_query($conn, $eliminafilasvacias) or die("database error:". mysqli_error($conn));
    


    $eliminaencabezado= "DELETE FROM $nombretabla WHERE seg = 'SEG' ";
    mysqli_query($conn, $eliminaencabezado) or die("database error:". mysqli_error($conn));

header("Location: limpiar6090.php".$import_status);

?>