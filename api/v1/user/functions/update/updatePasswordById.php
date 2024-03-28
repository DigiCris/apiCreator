
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update password by id inside a row in the databse.
* \details  Defines a new password in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $password The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updatePasswordById($id, $password)
{
    debug ('i am in updateIdByPassword');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_password($password);
        $success['response'] = $information->updatePasswordById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['password'] == $password)
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
    