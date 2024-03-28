
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update zona2 by id inside a row in the databse.
* \details  Defines a new zona2 in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $zona2 The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateZona2ById($id, $zona2)
{
    debug ('i am in updateIdByZona2');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_zona2($zona2);
        $success['response'] = $information->updateZona2ById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['zona2'] == $zona2)
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
    