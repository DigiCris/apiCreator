
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update zona4 by id inside a row in the databse.
* \details  Defines a new zona4 in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $zona4 The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateZona4ById($id, $zona4)
{
    debug ('i am in updateIdByZona4');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_zona4($zona4);
        $success['response'] = $information->updateZona4ById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['zona4'] == $zona4)
        {
            $success['success'] = true;
            $success['msg'] = 'Updated.';
        }
        else
        {
            $success['success'] = false;
            $success['msg'] = 'We could not update. Try again later.'; 
        }
    }
    else
    {
        $success['success'] = false;
        $success['msg'] = 'We could not find the id you are trying to update.';
    }

    return $success;
}

?>    
    