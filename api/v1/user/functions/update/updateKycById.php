
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update kyc by id inside a row in the databse.
* \details  Defines a new kyc in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $kyc The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updateKycById($id, $kyc)
{
    debug ('i am in updateIdByKyc');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_kyc($kyc);
        $success['response'] = $information->updateKycById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['kyc'] == $kyc)
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
    