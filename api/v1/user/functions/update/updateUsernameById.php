
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update username by id inside a row in the databse.
* \details  Defines a new username in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $username The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateUsernameById($id, $username)
{
    debug ('i am in updateIdByUsername');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_username($username);
        $success['response'] = $information->updateUsernameById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['username'] == $username)
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
    