<?php
require_once "config.php";
error_reporting(0);
function delete(){
    if (!empty($_GET)) {
        $id=$_GET['id'];
    

        $person = ORM::for_table('listitems')
        ->where_equal('id', $id)
        ->delete_many()
        ->save;
        header('Location:index.php');
        exit;
    
    }
}
delete();

?>