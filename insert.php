<?php
require_once "config.php";
function insert(){
    //Insert into database
    if(isset($_POST['submit'])) {
        // Create a new contact object
        $contact = ORM::for_table('listitems')->create();

        // SHOULD BE MORE ERROR CHECKING HERE!

        // Set the properties of the object
        
        $contact->name = $_POST['name'];
        

        // Save the object to the database
        $contact->save();
        
        // Redirect to self.
        header('Location:index.php');
    
    }
}

return insert();
        
    
?>