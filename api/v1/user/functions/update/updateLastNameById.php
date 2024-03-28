
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update lastName by id inside a row in the databse.
* \details  Defines a new lastName in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $lastName The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateLastNameById($id, $lastName)
{
    debug ('i am in updateIdByLastName');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_lastName($lastName);
        $success['response'] = $information->updateLastNameById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['lastName'] == $lastName)
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
    