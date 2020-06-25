<?php
include __DIR__ . '/db_connect.php';
$nombretabla = $_POST['nombrebdmadre'];


if(isset($_POST['import_data']))
    {
    
    // validate to check uploaded file is a valid csv file se añaden extensiones XLS XLSX
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.ms-excel','text/xls','text/xlsx');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes))
            {

            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                $csv_file = fopen($_FILES['file']['tmp_name'], 'r');


            //CREACION DE TABLA PARA PROCEDER A CARGAR INFORMACION DE ARCHIVO LEIDO
            //REF: https://www.w3schools.com/php/php_mysql_create_table.asp Myguests debe ser remplazado por variable nombretabla
               $sql = "CREATE TABLE $nombretabla (
                        seg int(6),
                        id varchar(10),
                        cuenta int(8),
                        ppa varchar(20),
                        capa int(2),
                        ccto varchar(2),
                        ano_alta varchar(10),
                        ciclo int(2),
                        estcob varchar(2),
                        tp varchar(10),
                        cel varchar(10),
                        nombre varchar(80),
                        total varchar(10),
                        act varchar(10),
                        s30 varchar(10),
                        pena varchar(10),
                        minimo varchar(4),
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
                   $mysql_insert = "INSERT INTO $nombretabla (seg, id ,cuenta, ppa, capa, ccto, ano_alta, ciclo, estcob, tp, cel, nombre, total, act, s30, pena, minimo, tel_1, tel_2, tel_3, tel_4, edo, email) VALUES('".$emp_record[0]."','".$emp_record[1]."','".$emp_record[2]."','".$emp_record[3]."','".$emp_record[4]."','".$emp_record[5]."','".$emp_record[6]."','".$emp_record[7]."','".$emp_record[8]."','".$emp_record[9]."','".$emp_record[10]."','".$emp_record[11]."','".$emp_record[12]."','".$emp_record[13]."','".$emp_record[14]."','".$emp_record[15]."','".$emp_record[16]."','".$emp_record[17]."','".$emp_record[18]."','".$emp_record[19]."','".$emp_record[20]."','".$emp_record[21]."','".$emp_record[22]."')";
                    
                    
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
header("Location: index.php".$import_status);
?>