<?php
session_start();
$con = mysqli_connect("localhost", "root", "root", "crm");
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (isset($_POST['import'])) {
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    $fileName = $_FILES['import_excel']['name'];
    $checking = explode('.', $fileName);
    $file_ext = end($checking);

    if (in_array($file_ext, $allowed_ext)) {
        $targetPah = $_FILES['import_excel']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($targetPah);
        $data = $spreadsheet->getActiveSheet()->toArray();
        foreach ($data as $row) {
            $Number = $row['0'];
            $fio = $row['1'];
            $dob = $row['2'];
            $position = $row['3'];
            $salary = $row['4'];

            $checkList = "SELECT numv FROM list where numv='$Number'";
            $checkList_result = mysqli_query($con, $checkList);

            if (mysqli_num_rows($checkList_result) > 0) {
                $up_query = "UPDATE list SET numv = '$Number',fio = '$fio', dob ='$dob',position = '$position' salary = '$salary'  where numv ='$Number'";
                $up_result = mysqli_query($con, $up_query);
                $msg = 1;

            } else {
                $in_query = "INSERT INTO list(numv,fio,dob,position,salary) values ('$Number','$fio','$dob','$position','$salary')";
                $in_result = mysqli_query($con, $in_query);
                $msg = 1;
            }
        }

        if (isset($msg)) {

            $_SESSION['status'] = 'File Imported Successfully';
            header('Location: index.php');

        } else {

            $_SESSION['status'] = 'File Importing Failed ';
            header('Location: index.php');

        }


    } else {
        $_SESSION['status'] = 'Invalid file';
        header('Location: index.php');
    }
}