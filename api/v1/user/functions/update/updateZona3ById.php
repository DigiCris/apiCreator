
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update zona3 by id inside a row in the databse.
* \details  Defines a new zona3 in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $zona3 The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateZona3ById($id, $zona3)
{
    debug ('i am in updateIdByZona3');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_zona3($zona3);
        $success['response'] = $information->updateZona3ById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['zona3'] == $zona3)
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
    