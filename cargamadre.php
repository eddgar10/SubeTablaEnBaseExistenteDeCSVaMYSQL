<!--CREATE DATABASE basesservei;
CREATE TABLE IF NOT EXISTS `basemadre` (
seg int(6) NOT NULL,
id varchar(10) NOT NULL,
cuenta int(8) NOT NULL,
ppa varchar(20) NOT NULL,
capa int(2) NOT NULL,
ccto varchar(2) NOT NULL,
ano_alta varchar(10) NOT NULL,
ciclo int (2) NOT NULL,
estcob varchar (2) NOT NULL,
tp varchar (5) NOT NULL,
cel int (10) NOT NULL,
nombre varchar (80) NOT NULL,
total float (10) NOT NULL,
act float (10) NOT NULL,
s30 float (10) NOT NULL,
pena float (10) NOT NULL,
minimo int (4) NOT NULL,
tel_1 int (10),
tel_2 int (10),
tel_3 int (10),
tel_4 int (10),
edo varchar (4) NOT NULL,
email varchar (80),
) ENGINE=InnoDB  CHARSET=utf8_general_ci;

-->

<?php
include __DIR__ . '/db_connect.php';
$nombretabla = $_POST['nombrebdmadre'];


if(isset($_POST['import_data'])){
    
    // validate to check uploaded file is a valid csv file
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$file_mimes)){

        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $csv_file = fopen($_FILES['file']['tmp_name'], 'r');
            
            
        //CREACION DE TABLA PARA PROCEDER A CARGAR INFORMACION DE ARCHIVO LEIDO
        //REF: https://www.w3schools.com/php/php_mysql_create_table.asp Myguests debe ser remplazado por variable nombretabla
           $sql = "CREATE TABLE $nombretabla (
                    seg int(6) NOT NULL,
                    id varchar(10) NOT NULL,
                    cuenta int(8) NOT NULL,
                    ppa varchar(20) NOT NULL,
                    capa int(2) NOT NULL,
                    ccto varchar(2) NOT NULL,
                    ano_alta varchar(10) NOT NULL,
                    ciclo int (2) NOT NULL,
                    estcob varchar (2) NOT NULL,
                    tp varchar (5) NOT NULL,
                    cel int (10) NOT NULL,
                    nombre varchar (80) NOT NULL,
                    total float (10) NOT NULL,
                    act float (10) NOT NULL,
                    s30 float (10) NOT NULL,
                    pena float (10) NOT NULL,
                    minimo int (4) NOT NULL,
                    tel_1 int (10),
                    tel_2 int (10),
                    tel_3 int (10),
                    tel_4 int (10),
                    edo varchar (4) NOT NULL,
                    email varchar (80))";

                    if (mysqli_query($conn, $sql)) {
                      echo "Table MyGuests created successfully";
                    } else {
                      echo "Error creating table: " . mysqli_error($conn);
                    }

        //FIN PARA CREAR TABLA EN BD SERVEI
            // get data records from csv file
            //set_time_limite(0); //para no perder conexion con sql al cargar muchos registros
            /*while(($emp_record = fgetcsv($csv_file)) !== FALSE){

                
                $mysql_insert = "INSERT INTO emp (emp_id, emp_name, emp_email, emp_salary, emp_age )
                VALUES('".$emp_record[0]."','".$emp_record[1]."', '".$emp_record[2]."', '".$emp_record[3]."', '".$emp_record[4]."')";
                    mysqli_query($conn, $mysql_insert) or die("database error:". mysqli_error($conn));
                //}
            }*/
            }
    fclose($csv_file);
    $import_status = '?import_status=success';
        } 
        else{
            $import_status = '?import_status=error';
        }
    } 
    else {
    $import_status = '?import_status=invalid_file';
    }
header("Location: index.php".$import_status);
?>