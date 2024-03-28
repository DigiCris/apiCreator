
<?php

include_once 'userHandler.php';
/*!
* \brief       Read all that matches tarjeta in user
* \details     Search in the database user that matches tarjeta and returns them in an array.
* \param       (VARCHAR) tarjeta searching table by matching it.
* \return     $success['response'][N] (array) Returns the users, where 'N' that indicates the position of the array to which the information about each user belongs.
     ** ['id']       (INT)    1 unique id for each user
     ** ['username']       (VARCHAR)   Unique username for users
     ** ['firstName']       (VARCHAR)   Users name
     ** ['lastName']       (VARCHAR)   Users lastname
     ** ['email']       (VARCHAR)    users email encoded by rsa
     ** ['password']       (VARCHAR)    users password by bcrypt
     ** ['phone']       (VARCHAR)    users phone encoded by rsa
     ** ['country']       (VARCHAR)   users location
     ** ['state']       (VARCHAR)   users location
     ** ['city']       (VARCHAR)   users location
     ** ['rol']       (INT)   worker / shop / normal user
     ** ['kyc']       (INT)   know the user
     ** ['tarjeta']       (VARCHAR)   card wallet
     ** ['cuenta']       (VARCHAR)   wallet in app
     ** ['admin']       (INT)   is it admin or a user
     ** ['priceKm']       (INT)   price by km for workers
     ** ['zona1']       (VARCHAR)   border to deliver (top left)
     ** ['zona2']       (VARCHAR)   border to deliver (top right)
     ** ['zona3']       (VARCHAR)   border to deliver  (bottom left)
     ** ['zona4']       (VARCHAR)   border to deliver  (bottom right
* \return      $success['success'] (bool) Returns true if the request was succesful, false if not.
* \return      $success['msg'] (string) Returns a message explaining the status of the execution.
* * \return • 'users fetched.' -> When was able to read all the users in the database.
* * \return • 'We could not fetch the users.' -> When there are no users loaded in the database or it could not be connected to it.
*/
function getByTarjeta($tarjeta) {
    $register = new user();
    $success['response'] = $register->readTarjeta($tarjeta);

    if($success['response']) {
        $success['success'] = true;
        $success['msg'] = 'users fetched.';
    }else {
        $success['success'] = false;
        $success['msg'] = 'We could not fetch the users.';
    }
    return $success;
}
    
?>
    