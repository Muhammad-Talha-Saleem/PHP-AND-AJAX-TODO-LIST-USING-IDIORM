<?php
require_once "config.php";
    if (isset($_POST['id'])) {
        
        $person = ORM::for_table('listitems')
        ->where('id', $_POST['id'])
        ->find_one();
        

        // The following two forms are equivalent
        $person->set($_POST['column'], $_POST['value']);

        
        
        
   
        
        // Syncronise the object with the database
        $person->save();

    }
?> 