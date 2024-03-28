<?php

include_once 'userHandler.php';

/*!
* \brief        Update all row information.
* \details      Update the information of user table, searching it by username.
* \param      $id     (INT)  id to update.  1 unique id for each user
* \param      $username       (VARCHAR)    Identifier of the user to update. Unique username for users
* \param      $firstName     (VARCHAR)  firstName to update. Users name
* \param      $lastName     (VARCHAR)  lastName to update. Users lastname
* \param      $email     (VARCHAR)  email to update.  users email encoded by rsa
* \param      $password     (VARCHAR)  password to update.  users password by bcrypt
* \param      $phone     (VARCHAR)  phone to update.  users phone encoded by rsa
* \param      $country     (VARCHAR)  country to update. users location
* \param      $state     (VARCHAR)  state to update. users location
* \param      $city     (VARCHAR)  city to update. users location
* \param      $rol     (INT)  rol to update. worker / shop / normal user
* \param      $kyc     (INT)  kyc to update. know the user
* \param      $tarjeta     (VARCHAR)  tarjeta to update. card wallet
* \param      $cuenta     (VARCHAR)  cuenta to update. wallet in app
* \param      $admin     (INT)  admin to update. is it admin or a user
* \param      $priceKm     (INT)  priceKm to update. price by km for workers
* \param      $zona1     (VARCHAR)  zona1 to update. border to deliver (top left)
* \param      $zona2     (VARCHAR)  zona2 to update. border to deliver (top right)
* \param      $zona3     (VARCHAR)  zona3 to update. border to deliver  (bottom left)
* \param      $zona4     (VARCHAR)  zona4 to update. border to deliver  (bottom right
* \return      $success['response'] (array) An array with the updated fields of the user.
     ** ['id']        (INT)   autoincremental .
     ** ['username']        (VARCHAR)   .
     ** ['firstName']        (VARCHAR)   .
     ** ['lastName']        (VARCHAR)   .
     ** ['email']        (VARCHAR)   rsa .
     ** ['password']        (VARCHAR)   PASSWORD_BCRYPT .
     ** ['phone']        (VARCHAR)   rsa .
     ** ['country']        (VARCHAR)   .
     ** ['state']        (VARCHAR)   .
     ** ['city']        (VARCHAR)   .
     ** ['rol']        (INT)   .
     ** ['kyc']        (INT)   .
     ** ['tarjeta']        (VARCHAR)   .
     ** ['cuenta']        (VARCHAR)   .
     ** ['admin']        (INT)   .
     ** ['priceKm']        (INT)   .
     ** ['zona1']        (VARCHAR)   .
     ** ['zona2']        (VARCHAR)   .
     ** ['zona3']        (VARCHAR)   .
     ** ['zona4']        (VARCHAR)   .
* \return      $success['success'] (bool) Returns true if the user was updated, false if not.
* \return      $success['msg'] (string) Returns a message explaining the status of the execution.
    * \return •    'user updated' -> When the execution was succesful, the user has been updated.
    * \return •    'We could not update. Try again later.' -> When the update failed, it could be because it couldn't connect to the database.
    * \return •    'We could not find the username you are trying to update.' -> When the user's field username does not exist or it is not found in the database.
*/

function updateAllByUsername($id, $username, $firstName, $lastName, $email, $password, $phone, $country, $state, $city, $rol, $kyc, $tarjeta, $cuenta, $admin, $priceKm, $zona1, $zona2, $zona3, $zona4) {
    $register = new user();

    $success['response'] = $register->readUsername($username);

    if($success['response']['username'] == $username) {
        
        $register->set_id($id);
        $register->set_username($username);
        $register->set_firstName($firstName);
        $register->set_lastName($lastName);
        $register->set_email($email);
        $register->set_password($password);
        $register->set_phone($phone);
        $register->set_country($country);
        $register->set_state($state);
        $register->set_city($city);
        $register->set_rol($rol);
        $register->set_kyc($kyc);
        $register->set_tarjeta($tarjeta);
        $register->set_cuenta($cuenta);
        $register->set_admin($admin);
        $register->set_priceKm($priceKm);
        $register->set_zona1($zona1);
        $register->set_zona2($zona2);
        $register->set_zona3($zona3);
        $register->set_zona4($zona4);

        $success['response'] = $register->updateAllByUsername($username);
        $success['response'] = $register->readUsername($username);
        if($success['response']['zona4'] == $zona4 and $success['response']['username'] == $username) {
            // I prepare the inserted data (encrypted) to show
            $data = array (
               'id' => $register->get_id(),
               'username' => $username,
               'firstName' => $register->get_firstName(),
               'lastName' => $register->get_lastName(),
               'email' => $register->get_email(),
               'password' => $register->get_password(),
               'phone' => $register->get_phone(),
               'country' => $register->get_country(),
               'state' => $register->get_state(),
               'city' => $register->get_city(),
               'rol' => $register->get_rol(),
               'kyc' => $register->get_kyc(),
               'tarjeta' => $register->get_tarjeta(),
               'cuenta' => $register->get_cuenta(),
               'admin' => $register->get_admin(),
               'priceKm' => $register->get_priceKm(),
               'zona1' => $register->get_zona1(),
               'zona2' => $register->get_zona2(),
               'zona3' => $register->get_zona3(),
               'zona4' => $register->get_zona4()
            );
            $success['response'] = $data;
            $success['success'] = true;
            $success['msg'] = 'user updated';
        }else {
            $success['success'] = false;
            $success['msg'] = 'We could not update. Try again later.';
        }
    }else {
        $success['success'] = false;
        $success['msg'] = 'We could not find the username you are trying to update.';
    }
    return $success;
}
    
?>    
    