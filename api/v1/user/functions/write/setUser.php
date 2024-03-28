
<?php

include_once 'userHandler.php';

/*!
* \brief      Create a new user row.
* \details    Insert a new user an it's information in the database. Some fields might encrypt.
*\param      $id (INT)  1 unique id for each user
*\param      $username (VARCHAR) Unique username for users
*\param      $firstName (VARCHAR) Users name
*\param      $lastName (VARCHAR) Users lastname
*\param      $email (VARCHAR)  users email encoded by rsa
*\param      $password (VARCHAR)  users password by bcrypt
*\param      $phone (VARCHAR)  users phone encoded by rsa
*\param      $country (VARCHAR) users location
*\param      $state (VARCHAR) users location
*\param      $city (VARCHAR) users location
*\param      $rol (INT) worker / shop / normal user
*\param      $kyc (INT) know the user
*\param      $tarjeta (VARCHAR) card wallet
*\param      $cuenta (VARCHAR) wallet in app
*\param      $admin (INT) is it admin or a user
*\param      $priceKm (INT) price by km for workers
*\param      $zona1 (VARCHAR) border to deliver (top left)
*\param      $zona2 (VARCHAR) border to deliver (top right)
*\param      $zona3 (VARCHAR) border to deliver  (bottom left)
*\param      $zona4 (VARCHAR) border to deliver  (bottom right 
* \return $success['response'] (array) An array with the established user fields.
** ['id'] (INT) The established id.
** ['username'] (VARCHAR) The established username.
** ['firstName'] (VARCHAR) The established firstName.
** ['lastName'] (VARCHAR) The established lastName.
** ['email'] (VARCHAR) The established email.
** ['password'] (VARCHAR) The established password.
** ['phone'] (VARCHAR) The established phone.
** ['country'] (VARCHAR) The established country.
** ['state'] (VARCHAR) The established state.
** ['city'] (VARCHAR) The established city.
** ['rol'] (INT) The established rol.
** ['kyc'] (INT) The established kyc.
** ['tarjeta'] (VARCHAR) The established tarjeta.
** ['cuenta'] (VARCHAR) The established cuenta.
** ['admin'] (INT) The established admin.
** ['priceKm'] (INT) The established priceKm.
** ['zona1'] (VARCHAR) The established zona1.
** ['zona2'] (VARCHAR) The established zona2.
** ['zona3'] (VARCHAR) The established zona3.
** ['zona4'] (VARCHAR) The established zona4.
* \return $success['success'] (bool) Returns true if the new user row was inserted, false if not.
* \return $success['msg'] (string) Returns a message explaining the status of the execution.
** \return • 'user uploaded' -> When the execution was succesful, the new user row was uploaded in the database.
** \return • 'This user could not be uploaded. Try again later.' -> When the insert failed, it could be because it couldn't connect to the database.
*/
function setUser($id=null, $username=null, $firstName=null, $lastName=null, $email=null, $password=null, $phone=null, $country=null, $state=null, $city=null, $rol=null, $kyc=null, $tarjeta=null, $cuenta=null, $admin=null, $priceKm=null, $zona1=null, $zona2=null, $zona3=null, $zona4=null) {
    $register = new user();
    
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
        $success['response'] = $register->insert();
        if($success['response'] == false) {
            $success['success'] = false;
            $success['msg'] = 'This user could not be uploaded. Try again later.';
        }else {
            // I prepare the inserted data (encrypted) to show
            $data = array ( 
              'id' => $register->get_id(),
              'username' => $register->get_username(),
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
            $success['msg'] = 'user uploaded';
        }
    
    return $success;
}

?>
