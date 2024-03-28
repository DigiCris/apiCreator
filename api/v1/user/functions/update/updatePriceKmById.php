
<?php 

include_once 'userHandler.php';

debug ('i am updateLink.php <br>');

/*!
* \brief    Update priceKm by id inside a row in the databse.
* \details  Defines a new priceKm in the database of user stored in the database, which is searched by id.
* \param    $id The field of the user table that I want to use to search.
* \param    $priceKm The value in user table that I want to update.
* \return   $success  (array) Returns an array with different success states.
*/

function updatePriceKmById($id, $priceKm)
{
    debug ('i am in updateIdByPriceKm');

    $information = new user();
    $success['response'] = $information->readId($id);

    if($success['response']['id'] == $id)
    {
        $information->set_priceKm($priceKm);
        $success['response'] = $information->updatePriceKmById($id);
        $success['response'] = $information->readId($id);
        if($success['response']['priceKm'] == $priceKm)
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
    