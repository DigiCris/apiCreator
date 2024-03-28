
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update email by id inside a row in the databse.
* \details  Defines a new email in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $email The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateEmailById($id, $email)
{
    debug ('i am in updateIdByEmail');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_email($email);
        $success['response'] = $information->updateEmailById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['email'] == $email)
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
    