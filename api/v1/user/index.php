
    <?php

    include_once '../configuracion.php';
    include_once '../lib.php';

    debug('I am user <br>');
    setPostWhenMissing();
    debug($_POST);

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            if(!isset($_POST['method'])) {
                $result['success']=false; // I write the error directly in the result
                $result['msg']='no post method especified';
            }else {
                $result = postFunctions($_POST);
            }
            $result=json_encode($result);
            echo $result;
            break;
        
        case 'GET':
            if(!isset($_GET['method'])) {
                $result['success']=false; // I write the error directly in the result
                $result['msg']='no get method especified';
            }else {
                $result = getFunctions($_GET);
            }
            $result=json_encode($result);
            echo $result;
            break;

        default:
            $result['success']=false;
            $result['msg']='Invalid REQUEST_METHOD (GET or POST)';
            $result = json_encode($result);
            echo $result;
            break;
    }
    
/*!
* \brief    Endpoints of the get method.
* \details  It has a switch that reads the get method, which connects to the corresponding endpoint.
* \param $get['method'] (string) Specifies the method that connects to the corresponding get endpoints.
*    'getAll' -> Read all user
*    'getById' -> Read user by id.
*    'getByUsername' -> Read user by username.
*    'getByFirstName' -> Read user by firstName.
*    'getByLastName' -> Read user by lastName.
*    'getByEmail' -> Read user by email.
*    'getByPassword' -> Read user by password.
*    'getByPhone' -> Read user by phone.
*    'getByCountry' -> Read user by country.
*    'getByState' -> Read user by state.
*    'getByCity' -> Read user by city.
*    'getByRol' -> Read user by rol.
*    'getByKyc' -> Read user by kyc.
*    'getByTarjeta' -> Read user by tarjeta.
*    'getByCuenta' -> Read user by cuenta.
*    'getByAdmin' -> Read user by admin.
*    'getByPriceKm' -> Read user by priceKm.
*    'getByZona1' -> Read user by zona1.
*    'getByZona2' -> Read user by zona2.
*    'getByZona3' -> Read user by zona3.
*    'getByZona4' -> Read user by zona4.
* \param $get['id'] searching variable of the user table to read (in method getById).
* \param $get['username'] searching variable of the user table to read (in method getByUsername).
* \param $get['firstName'] searching variable of the user table to read (in method getByFirstName).
* \param $get['lastName'] searching variable of the user table to read (in method getByLastName).
* \param $get['email'] searching variable of the user table to read (in method getByEmail).
* \param $get['password'] searching variable of the user table to read (in method getByPassword).
* \param $get['phone'] searching variable of the user table to read (in method getByPhone).
* \param $get['country'] searching variable of the user table to read (in method getByCountry).
* \param $get['state'] searching variable of the user table to read (in method getByState).
* \param $get['city'] searching variable of the user table to read (in method getByCity).
* \param $get['rol'] searching variable of the user table to read (in method getByRol).
* \param $get['kyc'] searching variable of the user table to read (in method getByKyc).
* \param $get['tarjeta'] searching variable of the user table to read (in method getByTarjeta).
* \param $get['cuenta'] searching variable of the user table to read (in method getByCuenta).
* \param $get['admin'] searching variable of the user table to read (in method getByAdmin).
* \param $get['priceKm'] searching variable of the user table to read (in method getByPriceKm).
* \param $get['zona1'] searching variable of the user table to read (in method getByZona1).
* \param $get['zona2'] searching variable of the user table to read (in method getByZona2).
* \param $get['zona3'] searching variable of the user table to read (in method getByZona3).
* \param $get['zona4'] searching variable of the user table to read (in method getByZona4).
* \return $result['response'] (array) An array with the requested information of user table.
    * ['id'] (INT)  1 unique id for each user (Special carachteristic => autoincremental ).
    * ['username'] (VARCHAR) Unique username for users (Special carachteristic => ).
    * ['firstName'] (VARCHAR) Users name (Special carachteristic => ).
    * ['lastName'] (VARCHAR) Users lastname (Special carachteristic => ).
    * ['email'] (VARCHAR)  users email encoded by rsa (Special carachteristic => rsa ).
    * ['password'] (VARCHAR)  users password by bcrypt (Special carachteristic => PASSWORD_BCRYPT ).
    * ['phone'] (VARCHAR)  users phone encoded by rsa (Special carachteristic => rsa ).
    * ['country'] (VARCHAR) users location (Special carachteristic => ).
    * ['state'] (VARCHAR) users location (Special carachteristic => ).
    * ['city'] (VARCHAR) users location (Special carachteristic => ).
    * ['rol'] (INT) worker / shop / normal user (Special carachteristic => ).
    * ['kyc'] (INT) know the user (Special carachteristic => ).
    * ['tarjeta'] (VARCHAR) card wallet (Special carachteristic => ).
    * ['cuenta'] (VARCHAR) wallet in app (Special carachteristic => ).
    * ['admin'] (INT) is it admin or a user (Special carachteristic => ).
    * ['priceKm'] (INT) price by km for workers (Special carachteristic => ).
    * ['zona1'] (VARCHAR) border to deliver (top left) (Special carachteristic => ).
    * ['zona2'] (VARCHAR) border to deliver (top right) (Special carachteristic => ).
    * ['zona3'] (VARCHAR) border to deliver  (bottom left) (Special carachteristic => ).
    * ['zona4'] (VARCHAR) border to deliver  (bottom right (Special carachteristic => ).
* \return $result['success'] (bool) Returns true if the request was succesful, false if not.
* \return $result['msg'] (string) Returns a message explaining the status of the execution.
*   'user fetched' -> When was able to read the fetched user.
*   'No id selected to read.' -> When id is missing (in method getById).
*   'No username selected to read.' -> When username is missing (in method getByUsername).
*   'No firstName selected to read.' -> When firstName is missing (in method getByFirstName).
*   'No lastName selected to read.' -> When lastName is missing (in method getByLastName).
*   'No email selected to read.' -> When email is missing (in method getByEmail).
*   'No password selected to read.' -> When password is missing (in method getByPassword).
*   'No phone selected to read.' -> When phone is missing (in method getByPhone).
*   'No country selected to read.' -> When country is missing (in method getByCountry).
*   'No state selected to read.' -> When state is missing (in method getByState).
*   'No city selected to read.' -> When city is missing (in method getByCity).
*   'No rol selected to read.' -> When rol is missing (in method getByRol).
*   'No kyc selected to read.' -> When kyc is missing (in method getByKyc).
*   'No tarjeta selected to read.' -> When tarjeta is missing (in method getByTarjeta).
*   'No cuenta selected to read.' -> When cuenta is missing (in method getByCuenta).
*   'No admin selected to read.' -> When admin is missing (in method getByAdmin).
*   'No priceKm selected to read.' -> When priceKm is missing (in method getByPriceKm).
*   'No zona1 selected to read.' -> When zona1 is missing (in method getByZona1).
*   'No zona2 selected to read.' -> When zona2 is missing (in method getByZona2).
*   'No zona3 selected to read.' -> When zona3 is missing (in method getByZona3).
*   'No zona4 selected to read.' -> When zona4 is missing (in method getByZona4).
*   'No valid get case selected' -> When a method that does not exist is selected (in the default of the switch). 
*/
function getFunctions($get) {
    debug($get['method']);
    switch ($get['method']) {
        
        case 'getAll':
            auth0();
            include_once 'functions/read/getAll.php';
            $result = getAll();
            debug('getAll');
            break;
            
        case 'getById':
            auth();
            include_once 'functions/read/getById.php';
            if(!isset($get['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id selected to read.';
                break;
            }
            $result = getById($get['id']);
            debug('getById');
            break;
            
        case 'getByUsername':
            auth();
            include_once 'functions/read/getByUsername.php';
            if(!isset($get['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username selected to read.';
                break;
            }
            $result = getByUsername($get['username']);
            debug('getByUsername');
            break;
            
        case 'getByFirstName':
            auth();
            include_once 'functions/read/getByFirstName.php';
            if(!isset($get['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName selected to read.';
                break;
            }
            $result = getByFirstName($get['firstName']);
            debug('getByFirstName');
            break;
            
        case 'getByLastName':
            auth();
            include_once 'functions/read/getByLastName.php';
            if(!isset($get['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName selected to read.';
                break;
            }
            $result = getByLastName($get['lastName']);
            debug('getByLastName');
            break;
            
        case 'getByEmail':
            auth();
            include_once 'functions/read/getByEmail.php';
            if(!isset($get['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email selected to read.';
                break;
            }
            $result = getByEmail($get['email']);
            debug('getByEmail');
            break;
            
        case 'getByPassword':
            auth();
            include_once 'functions/read/getByPassword.php';
            if(!isset($get['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password selected to read.';
                break;
            }
            $result = getByPassword($get['password']);
            debug('getByPassword');
            break;
            
        case 'getByPhone':
            auth();
            include_once 'functions/read/getByPhone.php';
            if(!isset($get['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone selected to read.';
                break;
            }
            $result = getByPhone($get['phone']);
            debug('getByPhone');
            break;
            
        case 'getByCountry':
            auth();
            include_once 'functions/read/getByCountry.php';
            if(!isset($get['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country selected to read.';
                break;
            }
            $result = getByCountry($get['country']);
            debug('getByCountry');
            break;
            
        case 'getByState':
            auth();
            include_once 'functions/read/getByState.php';
            if(!isset($get['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state selected to read.';
                break;
            }
            $result = getByState($get['state']);
            debug('getByState');
            break;
            
        case 'getByCity':
            auth();
            include_once 'functions/read/getByCity.php';
            if(!isset($get['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city selected to read.';
                break;
            }
            $result = getByCity($get['city']);
            debug('getByCity');
            break;
            
        case 'getByRol':
            auth();
            include_once 'functions/read/getByRol.php';
            if(!isset($get['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol selected to read.';
                break;
            }
            $result = getByRol($get['rol']);
            debug('getByRol');
            break;
            
        case 'getByKyc':
            auth();
            include_once 'functions/read/getByKyc.php';
            if(!isset($get['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc selected to read.';
                break;
            }
            $result = getByKyc($get['kyc']);
            debug('getByKyc');
            break;
            
        case 'getByTarjeta':
            auth();
            include_once 'functions/read/getByTarjeta.php';
            if(!isset($get['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta selected to read.';
                break;
            }
            $result = getByTarjeta($get['tarjeta']);
            debug('getByTarjeta');
            break;
            
        case 'getByCuenta':
            auth();
            include_once 'functions/read/getByCuenta.php';
            if(!isset($get['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta selected to read.';
                break;
            }
            $result = getByCuenta($get['cuenta']);
            debug('getByCuenta');
            break;
            
        case 'getByAdmin':
            auth();
            include_once 'functions/read/getByAdmin.php';
            if(!isset($get['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin selected to read.';
                break;
            }
            $result = getByAdmin($get['admin']);
            debug('getByAdmin');
            break;
            
        case 'getByPriceKm':
            auth();
            include_once 'functions/read/getByPriceKm.php';
            if(!isset($get['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm selected to read.';
                break;
            }
            $result = getByPriceKm($get['priceKm']);
            debug('getByPriceKm');
            break;
            
        case 'getByZona1':
            auth();
            include_once 'functions/read/getByZona1.php';
            if(!isset($get['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 selected to read.';
                break;
            }
            $result = getByZona1($get['zona1']);
            debug('getByZona1');
            break;
            
        case 'getByZona2':
            auth();
            include_once 'functions/read/getByZona2.php';
            if(!isset($get['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 selected to read.';
                break;
            }
            $result = getByZona2($get['zona2']);
            debug('getByZona2');
            break;
            
        case 'getByZona3':
            auth();
            include_once 'functions/read/getByZona3.php';
            if(!isset($get['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 selected to read.';
                break;
            }
            $result = getByZona3($get['zona3']);
            debug('getByZona3');
            break;
            
        case 'getByZona4':
            auth();
            include_once 'functions/read/getByZona4.php';
            if(!isset($get['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 selected to read.';
                break;
            }
            $result = getByZona4($get['zona4']);
            debug('getByZona4');
            break;
            
        default:
            $result['success']=false;
            $result['msg']='No valid get case selected';
            break;
    }
    return $result;
        
}
        

/*!
* \brief    Endpoints of the post method.
* \details  It has a switch that reads the post method, which connects to the corresponding endpoint (set, delete or update).
* \param $post['method'] (string) Specifies the method that connects to the corresponding post endpoints. 
*    'setAll' -> Insert a new row in user
*    'deleteAll' -> delete all table in user
*    'deleteById' -> delete all that matches id in user
*    'deleteByUsername' -> delete all that matches username in user
*    'deleteByFirstName' -> delete all that matches firstName in user
*    'deleteByLastName' -> delete all that matches lastName in user
*    'deleteByEmail' -> delete all that matches email in user
*    'deleteByPassword' -> delete all that matches password in user
*    'deleteByPhone' -> delete all that matches phone in user
*    'deleteByCountry' -> delete all that matches country in user
*    'deleteByState' -> delete all that matches state in user
*    'deleteByCity' -> delete all that matches city in user
*    'deleteByRol' -> delete all that matches rol in user
*    'deleteByKyc' -> delete all that matches kyc in user
*    'deleteByTarjeta' -> delete all that matches tarjeta in user
*    'deleteByCuenta' -> delete all that matches cuenta in user
*    'deleteByAdmin' -> delete all that matches admin in user
*    'deleteByPriceKm' -> delete all that matches priceKm in user
*    'deleteByZona1' -> delete all that matches zona1 in user
*    'deleteByZona2' -> delete all that matches zona2 in user
*    'deleteByZona3' -> delete all that matches zona3 in user
*    'deleteByZona4' -> delete all that matches zona4 in user
*    'updateAllById' -> Updates all that matches id in user
*    'updateAllByUsername' -> Updates all that matches username in user
*    'updateAllByFirstName' -> Updates all that matches firstName in user
*    'updateAllByLastName' -> Updates all that matches lastName in user
*    'updateAllByEmail' -> Updates all that matches email in user
*    'updateAllByPassword' -> Updates all that matches password in user
*    'updateAllByPhone' -> Updates all that matches phone in user
*    'updateAllByCountry' -> Updates all that matches country in user
*    'updateAllByState' -> Updates all that matches state in user
*    'updateAllByCity' -> Updates all that matches city in user
*    'updateAllByRol' -> Updates all that matches rol in user
*    'updateAllByKyc' -> Updates all that matches kyc in user
*    'updateAllByTarjeta' -> Updates all that matches tarjeta in user
*    'updateAllByCuenta' -> Updates all that matches cuenta in user
*    'updateAllByAdmin' -> Updates all that matches admin in user
*    'updateAllByPriceKm' -> Updates all that matches priceKm in user
*    'updateAllByZona1' -> Updates all that matches zona1 in user
*    'updateAllByZona2' -> Updates all that matches zona2 in user
*    'updateAllByZona3' -> Updates all that matches zona3 in user
*    'updateAllByZona4' -> Updates all that matches zona4 in user
*    'updateUsernameById' -> Updates username that matches id in user
*    'updateUsernameByFirstName' -> Updates username that matches firstName in user
*    'updateUsernameByLastName' -> Updates username that matches lastName in user
*    'updateUsernameByEmail' -> Updates username that matches email in user
*    'updateUsernameByPassword' -> Updates username that matches password in user
*    'updateUsernameByPhone' -> Updates username that matches phone in user
*    'updateUsernameByCountry' -> Updates username that matches country in user
*    'updateUsernameByState' -> Updates username that matches state in user
*    'updateUsernameByCity' -> Updates username that matches city in user
*    'updateUsernameByRol' -> Updates username that matches rol in user
*    'updateUsernameByKyc' -> Updates username that matches kyc in user
*    'updateUsernameByTarjeta' -> Updates username that matches tarjeta in user
*    'updateUsernameByCuenta' -> Updates username that matches cuenta in user
*    'updateUsernameByAdmin' -> Updates username that matches admin in user
*    'updateUsernameByPriceKm' -> Updates username that matches priceKm in user
*    'updateUsernameByZona1' -> Updates username that matches zona1 in user
*    'updateUsernameByZona2' -> Updates username that matches zona2 in user
*    'updateUsernameByZona3' -> Updates username that matches zona3 in user
*    'updateUsernameByZona4' -> Updates username that matches zona4 in user
*    'updateFirstNameById' -> Updates firstName that matches id in user
*    'updateFirstNameByUsername' -> Updates firstName that matches username in user
*    'updateFirstNameByLastName' -> Updates firstName that matches lastName in user
*    'updateFirstNameByEmail' -> Updates firstName that matches email in user
*    'updateFirstNameByPassword' -> Updates firstName that matches password in user
*    'updateFirstNameByPhone' -> Updates firstName that matches phone in user
*    'updateFirstNameByCountry' -> Updates firstName that matches country in user
*    'updateFirstNameByState' -> Updates firstName that matches state in user
*    'updateFirstNameByCity' -> Updates firstName that matches city in user
*    'updateFirstNameByRol' -> Updates firstName that matches rol in user
*    'updateFirstNameByKyc' -> Updates firstName that matches kyc in user
*    'updateFirstNameByTarjeta' -> Updates firstName that matches tarjeta in user
*    'updateFirstNameByCuenta' -> Updates firstName that matches cuenta in user
*    'updateFirstNameByAdmin' -> Updates firstName that matches admin in user
*    'updateFirstNameByPriceKm' -> Updates firstName that matches priceKm in user
*    'updateFirstNameByZona1' -> Updates firstName that matches zona1 in user
*    'updateFirstNameByZona2' -> Updates firstName that matches zona2 in user
*    'updateFirstNameByZona3' -> Updates firstName that matches zona3 in user
*    'updateFirstNameByZona4' -> Updates firstName that matches zona4 in user
*    'updateLastNameById' -> Updates lastName that matches id in user
*    'updateLastNameByUsername' -> Updates lastName that matches username in user
*    'updateLastNameByFirstName' -> Updates lastName that matches firstName in user
*    'updateLastNameByEmail' -> Updates lastName that matches email in user
*    'updateLastNameByPassword' -> Updates lastName that matches password in user
*    'updateLastNameByPhone' -> Updates lastName that matches phone in user
*    'updateLastNameByCountry' -> Updates lastName that matches country in user
*    'updateLastNameByState' -> Updates lastName that matches state in user
*    'updateLastNameByCity' -> Updates lastName that matches city in user
*    'updateLastNameByRol' -> Updates lastName that matches rol in user
*    'updateLastNameByKyc' -> Updates lastName that matches kyc in user
*    'updateLastNameByTarjeta' -> Updates lastName that matches tarjeta in user
*    'updateLastNameByCuenta' -> Updates lastName that matches cuenta in user
*    'updateLastNameByAdmin' -> Updates lastName that matches admin in user
*    'updateLastNameByPriceKm' -> Updates lastName that matches priceKm in user
*    'updateLastNameByZona1' -> Updates lastName that matches zona1 in user
*    'updateLastNameByZona2' -> Updates lastName that matches zona2 in user
*    'updateLastNameByZona3' -> Updates lastName that matches zona3 in user
*    'updateLastNameByZona4' -> Updates lastName that matches zona4 in user
*    'updateEmailById' -> Updates email that matches id in user
*    'updateEmailByUsername' -> Updates email that matches username in user
*    'updateEmailByFirstName' -> Updates email that matches firstName in user
*    'updateEmailByLastName' -> Updates email that matches lastName in user
*    'updateEmailByPassword' -> Updates email that matches password in user
*    'updateEmailByPhone' -> Updates email that matches phone in user
*    'updateEmailByCountry' -> Updates email that matches country in user
*    'updateEmailByState' -> Updates email that matches state in user
*    'updateEmailByCity' -> Updates email that matches city in user
*    'updateEmailByRol' -> Updates email that matches rol in user
*    'updateEmailByKyc' -> Updates email that matches kyc in user
*    'updateEmailByTarjeta' -> Updates email that matches tarjeta in user
*    'updateEmailByCuenta' -> Updates email that matches cuenta in user
*    'updateEmailByAdmin' -> Updates email that matches admin in user
*    'updateEmailByPriceKm' -> Updates email that matches priceKm in user
*    'updateEmailByZona1' -> Updates email that matches zona1 in user
*    'updateEmailByZona2' -> Updates email that matches zona2 in user
*    'updateEmailByZona3' -> Updates email that matches zona3 in user
*    'updateEmailByZona4' -> Updates email that matches zona4 in user
*    'updatePasswordById' -> Updates password that matches id in user
*    'updatePasswordByUsername' -> Updates password that matches username in user
*    'updatePasswordByFirstName' -> Updates password that matches firstName in user
*    'updatePasswordByLastName' -> Updates password that matches lastName in user
*    'updatePasswordByEmail' -> Updates password that matches email in user
*    'updatePasswordByPhone' -> Updates password that matches phone in user
*    'updatePasswordByCountry' -> Updates password that matches country in user
*    'updatePasswordByState' -> Updates password that matches state in user
*    'updatePasswordByCity' -> Updates password that matches city in user
*    'updatePasswordByRol' -> Updates password that matches rol in user
*    'updatePasswordByKyc' -> Updates password that matches kyc in user
*    'updatePasswordByTarjeta' -> Updates password that matches tarjeta in user
*    'updatePasswordByCuenta' -> Updates password that matches cuenta in user
*    'updatePasswordByAdmin' -> Updates password that matches admin in user
*    'updatePasswordByPriceKm' -> Updates password that matches priceKm in user
*    'updatePasswordByZona1' -> Updates password that matches zona1 in user
*    'updatePasswordByZona2' -> Updates password that matches zona2 in user
*    'updatePasswordByZona3' -> Updates password that matches zona3 in user
*    'updatePasswordByZona4' -> Updates password that matches zona4 in user
*    'updatePhoneById' -> Updates phone that matches id in user
*    'updatePhoneByUsername' -> Updates phone that matches username in user
*    'updatePhoneByFirstName' -> Updates phone that matches firstName in user
*    'updatePhoneByLastName' -> Updates phone that matches lastName in user
*    'updatePhoneByEmail' -> Updates phone that matches email in user
*    'updatePhoneByPassword' -> Updates phone that matches password in user
*    'updatePhoneByCountry' -> Updates phone that matches country in user
*    'updatePhoneByState' -> Updates phone that matches state in user
*    'updatePhoneByCity' -> Updates phone that matches city in user
*    'updatePhoneByRol' -> Updates phone that matches rol in user
*    'updatePhoneByKyc' -> Updates phone that matches kyc in user
*    'updatePhoneByTarjeta' -> Updates phone that matches tarjeta in user
*    'updatePhoneByCuenta' -> Updates phone that matches cuenta in user
*    'updatePhoneByAdmin' -> Updates phone that matches admin in user
*    'updatePhoneByPriceKm' -> Updates phone that matches priceKm in user
*    'updatePhoneByZona1' -> Updates phone that matches zona1 in user
*    'updatePhoneByZona2' -> Updates phone that matches zona2 in user
*    'updatePhoneByZona3' -> Updates phone that matches zona3 in user
*    'updatePhoneByZona4' -> Updates phone that matches zona4 in user
*    'updateCountryById' -> Updates country that matches id in user
*    'updateCountryByUsername' -> Updates country that matches username in user
*    'updateCountryByFirstName' -> Updates country that matches firstName in user
*    'updateCountryByLastName' -> Updates country that matches lastName in user
*    'updateCountryByEmail' -> Updates country that matches email in user
*    'updateCountryByPassword' -> Updates country that matches password in user
*    'updateCountryByPhone' -> Updates country that matches phone in user
*    'updateCountryByState' -> Updates country that matches state in user
*    'updateCountryByCity' -> Updates country that matches city in user
*    'updateCountryByRol' -> Updates country that matches rol in user
*    'updateCountryByKyc' -> Updates country that matches kyc in user
*    'updateCountryByTarjeta' -> Updates country that matches tarjeta in user
*    'updateCountryByCuenta' -> Updates country that matches cuenta in user
*    'updateCountryByAdmin' -> Updates country that matches admin in user
*    'updateCountryByPriceKm' -> Updates country that matches priceKm in user
*    'updateCountryByZona1' -> Updates country that matches zona1 in user
*    'updateCountryByZona2' -> Updates country that matches zona2 in user
*    'updateCountryByZona3' -> Updates country that matches zona3 in user
*    'updateCountryByZona4' -> Updates country that matches zona4 in user
*    'updateStateById' -> Updates state that matches id in user
*    'updateStateByUsername' -> Updates state that matches username in user
*    'updateStateByFirstName' -> Updates state that matches firstName in user
*    'updateStateByLastName' -> Updates state that matches lastName in user
*    'updateStateByEmail' -> Updates state that matches email in user
*    'updateStateByPassword' -> Updates state that matches password in user
*    'updateStateByPhone' -> Updates state that matches phone in user
*    'updateStateByCountry' -> Updates state that matches country in user
*    'updateStateByCity' -> Updates state that matches city in user
*    'updateStateByRol' -> Updates state that matches rol in user
*    'updateStateByKyc' -> Updates state that matches kyc in user
*    'updateStateByTarjeta' -> Updates state that matches tarjeta in user
*    'updateStateByCuenta' -> Updates state that matches cuenta in user
*    'updateStateByAdmin' -> Updates state that matches admin in user
*    'updateStateByPriceKm' -> Updates state that matches priceKm in user
*    'updateStateByZona1' -> Updates state that matches zona1 in user
*    'updateStateByZona2' -> Updates state that matches zona2 in user
*    'updateStateByZona3' -> Updates state that matches zona3 in user
*    'updateStateByZona4' -> Updates state that matches zona4 in user
*    'updateCityById' -> Updates city that matches id in user
*    'updateCityByUsername' -> Updates city that matches username in user
*    'updateCityByFirstName' -> Updates city that matches firstName in user
*    'updateCityByLastName' -> Updates city that matches lastName in user
*    'updateCityByEmail' -> Updates city that matches email in user
*    'updateCityByPassword' -> Updates city that matches password in user
*    'updateCityByPhone' -> Updates city that matches phone in user
*    'updateCityByCountry' -> Updates city that matches country in user
*    'updateCityByState' -> Updates city that matches state in user
*    'updateCityByRol' -> Updates city that matches rol in user
*    'updateCityByKyc' -> Updates city that matches kyc in user
*    'updateCityByTarjeta' -> Updates city that matches tarjeta in user
*    'updateCityByCuenta' -> Updates city that matches cuenta in user
*    'updateCityByAdmin' -> Updates city that matches admin in user
*    'updateCityByPriceKm' -> Updates city that matches priceKm in user
*    'updateCityByZona1' -> Updates city that matches zona1 in user
*    'updateCityByZona2' -> Updates city that matches zona2 in user
*    'updateCityByZona3' -> Updates city that matches zona3 in user
*    'updateCityByZona4' -> Updates city that matches zona4 in user
*    'updateRolById' -> Updates rol that matches id in user
*    'updateRolByUsername' -> Updates rol that matches username in user
*    'updateRolByFirstName' -> Updates rol that matches firstName in user
*    'updateRolByLastName' -> Updates rol that matches lastName in user
*    'updateRolByEmail' -> Updates rol that matches email in user
*    'updateRolByPassword' -> Updates rol that matches password in user
*    'updateRolByPhone' -> Updates rol that matches phone in user
*    'updateRolByCountry' -> Updates rol that matches country in user
*    'updateRolByState' -> Updates rol that matches state in user
*    'updateRolByCity' -> Updates rol that matches city in user
*    'updateRolByKyc' -> Updates rol that matches kyc in user
*    'updateRolByTarjeta' -> Updates rol that matches tarjeta in user
*    'updateRolByCuenta' -> Updates rol that matches cuenta in user
*    'updateRolByAdmin' -> Updates rol that matches admin in user
*    'updateRolByPriceKm' -> Updates rol that matches priceKm in user
*    'updateRolByZona1' -> Updates rol that matches zona1 in user
*    'updateRolByZona2' -> Updates rol that matches zona2 in user
*    'updateRolByZona3' -> Updates rol that matches zona3 in user
*    'updateRolByZona4' -> Updates rol that matches zona4 in user
*    'updateKycById' -> Updates kyc that matches id in user
*    'updateKycByUsername' -> Updates kyc that matches username in user
*    'updateKycByFirstName' -> Updates kyc that matches firstName in user
*    'updateKycByLastName' -> Updates kyc that matches lastName in user
*    'updateKycByEmail' -> Updates kyc that matches email in user
*    'updateKycByPassword' -> Updates kyc that matches password in user
*    'updateKycByPhone' -> Updates kyc that matches phone in user
*    'updateKycByCountry' -> Updates kyc that matches country in user
*    'updateKycByState' -> Updates kyc that matches state in user
*    'updateKycByCity' -> Updates kyc that matches city in user
*    'updateKycByRol' -> Updates kyc that matches rol in user
*    'updateKycByTarjeta' -> Updates kyc that matches tarjeta in user
*    'updateKycByCuenta' -> Updates kyc that matches cuenta in user
*    'updateKycByAdmin' -> Updates kyc that matches admin in user
*    'updateKycByPriceKm' -> Updates kyc that matches priceKm in user
*    'updateKycByZona1' -> Updates kyc that matches zona1 in user
*    'updateKycByZona2' -> Updates kyc that matches zona2 in user
*    'updateKycByZona3' -> Updates kyc that matches zona3 in user
*    'updateKycByZona4' -> Updates kyc that matches zona4 in user
*    'updateTarjetaById' -> Updates tarjeta that matches id in user
*    'updateTarjetaByUsername' -> Updates tarjeta that matches username in user
*    'updateTarjetaByFirstName' -> Updates tarjeta that matches firstName in user
*    'updateTarjetaByLastName' -> Updates tarjeta that matches lastName in user
*    'updateTarjetaByEmail' -> Updates tarjeta that matches email in user
*    'updateTarjetaByPassword' -> Updates tarjeta that matches password in user
*    'updateTarjetaByPhone' -> Updates tarjeta that matches phone in user
*    'updateTarjetaByCountry' -> Updates tarjeta that matches country in user
*    'updateTarjetaByState' -> Updates tarjeta that matches state in user
*    'updateTarjetaByCity' -> Updates tarjeta that matches city in user
*    'updateTarjetaByRol' -> Updates tarjeta that matches rol in user
*    'updateTarjetaByKyc' -> Updates tarjeta that matches kyc in user
*    'updateTarjetaByCuenta' -> Updates tarjeta that matches cuenta in user
*    'updateTarjetaByAdmin' -> Updates tarjeta that matches admin in user
*    'updateTarjetaByPriceKm' -> Updates tarjeta that matches priceKm in user
*    'updateTarjetaByZona1' -> Updates tarjeta that matches zona1 in user
*    'updateTarjetaByZona2' -> Updates tarjeta that matches zona2 in user
*    'updateTarjetaByZona3' -> Updates tarjeta that matches zona3 in user
*    'updateTarjetaByZona4' -> Updates tarjeta that matches zona4 in user
*    'updateCuentaById' -> Updates cuenta that matches id in user
*    'updateCuentaByUsername' -> Updates cuenta that matches username in user
*    'updateCuentaByFirstName' -> Updates cuenta that matches firstName in user
*    'updateCuentaByLastName' -> Updates cuenta that matches lastName in user
*    'updateCuentaByEmail' -> Updates cuenta that matches email in user
*    'updateCuentaByPassword' -> Updates cuenta that matches password in user
*    'updateCuentaByPhone' -> Updates cuenta that matches phone in user
*    'updateCuentaByCountry' -> Updates cuenta that matches country in user
*    'updateCuentaByState' -> Updates cuenta that matches state in user
*    'updateCuentaByCity' -> Updates cuenta that matches city in user
*    'updateCuentaByRol' -> Updates cuenta that matches rol in user
*    'updateCuentaByKyc' -> Updates cuenta that matches kyc in user
*    'updateCuentaByTarjeta' -> Updates cuenta that matches tarjeta in user
*    'updateCuentaByAdmin' -> Updates cuenta that matches admin in user
*    'updateCuentaByPriceKm' -> Updates cuenta that matches priceKm in user
*    'updateCuentaByZona1' -> Updates cuenta that matches zona1 in user
*    'updateCuentaByZona2' -> Updates cuenta that matches zona2 in user
*    'updateCuentaByZona3' -> Updates cuenta that matches zona3 in user
*    'updateCuentaByZona4' -> Updates cuenta that matches zona4 in user
*    'updateAdminById' -> Updates admin that matches id in user
*    'updateAdminByUsername' -> Updates admin that matches username in user
*    'updateAdminByFirstName' -> Updates admin that matches firstName in user
*    'updateAdminByLastName' -> Updates admin that matches lastName in user
*    'updateAdminByEmail' -> Updates admin that matches email in user
*    'updateAdminByPassword' -> Updates admin that matches password in user
*    'updateAdminByPhone' -> Updates admin that matches phone in user
*    'updateAdminByCountry' -> Updates admin that matches country in user
*    'updateAdminByState' -> Updates admin that matches state in user
*    'updateAdminByCity' -> Updates admin that matches city in user
*    'updateAdminByRol' -> Updates admin that matches rol in user
*    'updateAdminByKyc' -> Updates admin that matches kyc in user
*    'updateAdminByTarjeta' -> Updates admin that matches tarjeta in user
*    'updateAdminByCuenta' -> Updates admin that matches cuenta in user
*    'updateAdminByPriceKm' -> Updates admin that matches priceKm in user
*    'updateAdminByZona1' -> Updates admin that matches zona1 in user
*    'updateAdminByZona2' -> Updates admin that matches zona2 in user
*    'updateAdminByZona3' -> Updates admin that matches zona3 in user
*    'updateAdminByZona4' -> Updates admin that matches zona4 in user
*    'updatePriceKmById' -> Updates priceKm that matches id in user
*    'updatePriceKmByUsername' -> Updates priceKm that matches username in user
*    'updatePriceKmByFirstName' -> Updates priceKm that matches firstName in user
*    'updatePriceKmByLastName' -> Updates priceKm that matches lastName in user
*    'updatePriceKmByEmail' -> Updates priceKm that matches email in user
*    'updatePriceKmByPassword' -> Updates priceKm that matches password in user
*    'updatePriceKmByPhone' -> Updates priceKm that matches phone in user
*    'updatePriceKmByCountry' -> Updates priceKm that matches country in user
*    'updatePriceKmByState' -> Updates priceKm that matches state in user
*    'updatePriceKmByCity' -> Updates priceKm that matches city in user
*    'updatePriceKmByRol' -> Updates priceKm that matches rol in user
*    'updatePriceKmByKyc' -> Updates priceKm that matches kyc in user
*    'updatePriceKmByTarjeta' -> Updates priceKm that matches tarjeta in user
*    'updatePriceKmByCuenta' -> Updates priceKm that matches cuenta in user
*    'updatePriceKmByAdmin' -> Updates priceKm that matches admin in user
*    'updatePriceKmByZona1' -> Updates priceKm that matches zona1 in user
*    'updatePriceKmByZona2' -> Updates priceKm that matches zona2 in user
*    'updatePriceKmByZona3' -> Updates priceKm that matches zona3 in user
*    'updatePriceKmByZona4' -> Updates priceKm that matches zona4 in user
*    'updateZona1ById' -> Updates zona1 that matches id in user
*    'updateZona1ByUsername' -> Updates zona1 that matches username in user
*    'updateZona1ByFirstName' -> Updates zona1 that matches firstName in user
*    'updateZona1ByLastName' -> Updates zona1 that matches lastName in user
*    'updateZona1ByEmail' -> Updates zona1 that matches email in user
*    'updateZona1ByPassword' -> Updates zona1 that matches password in user
*    'updateZona1ByPhone' -> Updates zona1 that matches phone in user
*    'updateZona1ByCountry' -> Updates zona1 that matches country in user
*    'updateZona1ByState' -> Updates zona1 that matches state in user
*    'updateZona1ByCity' -> Updates zona1 that matches city in user
*    'updateZona1ByRol' -> Updates zona1 that matches rol in user
*    'updateZona1ByKyc' -> Updates zona1 that matches kyc in user
*    'updateZona1ByTarjeta' -> Updates zona1 that matches tarjeta in user
*    'updateZona1ByCuenta' -> Updates zona1 that matches cuenta in user
*    'updateZona1ByAdmin' -> Updates zona1 that matches admin in user
*    'updateZona1ByPriceKm' -> Updates zona1 that matches priceKm in user
*    'updateZona1ByZona2' -> Updates zona1 that matches zona2 in user
*    'updateZona1ByZona3' -> Updates zona1 that matches zona3 in user
*    'updateZona1ByZona4' -> Updates zona1 that matches zona4 in user
*    'updateZona2ById' -> Updates zona2 that matches id in user
*    'updateZona2ByUsername' -> Updates zona2 that matches username in user
*    'updateZona2ByFirstName' -> Updates zona2 that matches firstName in user
*    'updateZona2ByLastName' -> Updates zona2 that matches lastName in user
*    'updateZona2ByEmail' -> Updates zona2 that matches email in user
*    'updateZona2ByPassword' -> Updates zona2 that matches password in user
*    'updateZona2ByPhone' -> Updates zona2 that matches phone in user
*    'updateZona2ByCountry' -> Updates zona2 that matches country in user
*    'updateZona2ByState' -> Updates zona2 that matches state in user
*    'updateZona2ByCity' -> Updates zona2 that matches city in user
*    'updateZona2ByRol' -> Updates zona2 that matches rol in user
*    'updateZona2ByKyc' -> Updates zona2 that matches kyc in user
*    'updateZona2ByTarjeta' -> Updates zona2 that matches tarjeta in user
*    'updateZona2ByCuenta' -> Updates zona2 that matches cuenta in user
*    'updateZona2ByAdmin' -> Updates zona2 that matches admin in user
*    'updateZona2ByPriceKm' -> Updates zona2 that matches priceKm in user
*    'updateZona2ByZona1' -> Updates zona2 that matches zona1 in user
*    'updateZona2ByZona3' -> Updates zona2 that matches zona3 in user
*    'updateZona2ByZona4' -> Updates zona2 that matches zona4 in user
*    'updateZona3ById' -> Updates zona3 that matches id in user
*    'updateZona3ByUsername' -> Updates zona3 that matches username in user
*    'updateZona3ByFirstName' -> Updates zona3 that matches firstName in user
*    'updateZona3ByLastName' -> Updates zona3 that matches lastName in user
*    'updateZona3ByEmail' -> Updates zona3 that matches email in user
*    'updateZona3ByPassword' -> Updates zona3 that matches password in user
*    'updateZona3ByPhone' -> Updates zona3 that matches phone in user
*    'updateZona3ByCountry' -> Updates zona3 that matches country in user
*    'updateZona3ByState' -> Updates zona3 that matches state in user
*    'updateZona3ByCity' -> Updates zona3 that matches city in user
*    'updateZona3ByRol' -> Updates zona3 that matches rol in user
*    'updateZona3ByKyc' -> Updates zona3 that matches kyc in user
*    'updateZona3ByTarjeta' -> Updates zona3 that matches tarjeta in user
*    'updateZona3ByCuenta' -> Updates zona3 that matches cuenta in user
*    'updateZona3ByAdmin' -> Updates zona3 that matches admin in user
*    'updateZona3ByPriceKm' -> Updates zona3 that matches priceKm in user
*    'updateZona3ByZona1' -> Updates zona3 that matches zona1 in user
*    'updateZona3ByZona2' -> Updates zona3 that matches zona2 in user
*    'updateZona3ByZona4' -> Updates zona3 that matches zona4 in user
*    'updateZona4ById' -> Updates zona4 that matches id in user
*    'updateZona4ByUsername' -> Updates zona4 that matches username in user
*    'updateZona4ByFirstName' -> Updates zona4 that matches firstName in user
*    'updateZona4ByLastName' -> Updates zona4 that matches lastName in user
*    'updateZona4ByEmail' -> Updates zona4 that matches email in user
*    'updateZona4ByPassword' -> Updates zona4 that matches password in user
*    'updateZona4ByPhone' -> Updates zona4 that matches phone in user
*    'updateZona4ByCountry' -> Updates zona4 that matches country in user
*    'updateZona4ByState' -> Updates zona4 that matches state in user
*    'updateZona4ByCity' -> Updates zona4 that matches city in user
*    'updateZona4ByRol' -> Updates zona4 that matches rol in user
*    'updateZona4ByKyc' -> Updates zona4 that matches kyc in user
*    'updateZona4ByTarjeta' -> Updates zona4 that matches tarjeta in user
*    'updateZona4ByCuenta' -> Updates zona4 that matches cuenta in user
*    'updateZona4ByAdmin' -> Updates zona4 that matches admin in user
*    'updateZona4ByPriceKm' -> Updates zona4 that matches priceKm in user
*    'updateZona4ByZona1' -> Updates zona4 that matches zona1 in user
*    'updateZona4ByZona2' -> Updates zona4 that matches zona2 in user
*    'updateZona4ByZona3' -> Updates zona4 that matches zona3 in user
* \param $post['id'] (INT)  1 unique id for each user
* \param $post['username'] (VARCHAR) Unique username for users
* \param $post['firstName'] (VARCHAR) Users name
* \param $post['lastName'] (VARCHAR) Users lastname
* \param $post['email'] (VARCHAR)  users email encoded by rsa
* \param $post['password'] (VARCHAR)  users password by bcrypt
* \param $post['phone'] (VARCHAR)  users phone encoded by rsa
* \param $post['country'] (VARCHAR) users location
* \param $post['state'] (VARCHAR) users location
* \param $post['city'] (VARCHAR) users location
* \param $post['rol'] (INT) worker / shop / normal user
* \param $post['kyc'] (INT) know the user
* \param $post['tarjeta'] (VARCHAR) card wallet
* \param $post['cuenta'] (VARCHAR) wallet in app
* \param $post['admin'] (INT) is it admin or a user
* \param $post['priceKm'] (INT) price by km for workers
* \param $post['zona1'] (VARCHAR) border to deliver (top left)
* \param $post['zona2'] (VARCHAR) border to deliver (top right)
* \param $post['zona3'] (VARCHAR) border to deliver  (bottom left)
* \param $post['zona4'] (VARCHAR) border to deliver  (bottom right
* \return $result['response'] (array) An array with the requested user information.
*    ['id'] (INT)  1 unique id for each user
*    ['username'] (VARCHAR) Unique username for users
*    ['firstName'] (VARCHAR) Users name
*    ['lastName'] (VARCHAR) Users lastname
*    ['email'] (VARCHAR)  users email encoded by rsa
*    ['password'] (VARCHAR)  users password by bcrypt
*    ['phone'] (VARCHAR)  users phone encoded by rsa
*    ['country'] (VARCHAR) users location
*    ['state'] (VARCHAR) users location
*    ['city'] (VARCHAR) users location
*    ['rol'] (INT) worker / shop / normal user
*    ['kyc'] (INT) know the user
*    ['tarjeta'] (VARCHAR) card wallet
*    ['cuenta'] (VARCHAR) wallet in app
*    ['admin'] (INT) is it admin or a user
*    ['priceKm'] (INT) price by km for workers
*    ['zona1'] (VARCHAR) border to deliver (top left)
*    ['zona2'] (VARCHAR) border to deliver (top right)
*    ['zona3'] (VARCHAR) border to deliver  (bottom left)
*    ['zona4'] (VARCHAR) border to deliver  (bottom right
* \return $result['success'] (bool) Returns true if the request was succesful, false if not.
* \return $result['msg'] (string) Returns a message explaining the status of the execution.
*   'user uploaded.' -> When the execution was successful, the user information was uploaded in the database.
*   'This user could not be uploaded. Try again later.' -> When the call fails, it could be because it couldn't connect to the database. 
*   'This user row is already in the database.' -> When trying to insert something that already exists inside the database.
*   'Updated' -> When the updateing execution was successful, the user information was updated in the database.
*   'We couldn't update. Try again later' -> When the update fails, it could be because it couldn't connect to the database. 
*   'We couldn't find what you are trying to update.' -> When the information of user you want to update does not exist or it is not found in the database.
*   'user row deleted' -> When was able to delete the fetched user row/rows.
*   'It was not possible to erase the user. Try again later' -> When it fails to eliminate the user row/rows.
*   'Thisuser row did not exist.' -> When the user row was not found or did not exist.
*   'No id/username/firstName/lastName/email/password/phone/country/state/city/rol/kyc/tarjeta/cuenta/admin/priceKm/zona1/zona2/zona3/zona4/ to set.' -> When one of the required parameters is missing.
*   'No selection to delete.' -> When $post['selection'] is missing (in method deleteBySelection).
*   'No selection to update.' -> When $post['selection'] is missing (in method update...BySelection).
*   'No valid case selected' -> When a method that does not exist is selected (in the default of the switch). 
*/  
function postFunctions($post) {
    switch ($post['method']) {
        
        case 'setAll':
            authSet();
            authProc();
            debug('I am inside the post method setAll <br>');
            include_once 'functions/write/setAll.php';
            $result = setAll($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'deleteAll':
            authDel();
            debug('I am inside the post method deleteAll <br>');
            include_once 'functions/delete/deleteAll.php';
            $result = deleteAll();
            break;
        
        case 'deleteById':
            authDel();
            debug('I am inside the post method deleteById <br>');
            include_once 'functions/delete/deleteById.php';
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to delete.';
                break;
            }
            $result = deleteById($post['id']);
            break;
        
        case 'deleteByUsername':
            authDel();
            debug('I am inside the post method deleteByUsername <br>');
            include_once 'functions/delete/deleteByUsername.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to delete.';
                break;
            }
            $result = deleteByUsername($post['username']);
            break;
        
        case 'deleteByFirstName':
            authDel();
            debug('I am inside the post method deleteByFirstName <br>');
            include_once 'functions/delete/deleteByFirstName.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to delete.';
                break;
            }
            $result = deleteByFirstName($post['firstName']);
            break;
        
        case 'deleteByLastName':
            authDel();
            debug('I am inside the post method deleteByLastName <br>');
            include_once 'functions/delete/deleteByLastName.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to delete.';
                break;
            }
            $result = deleteByLastName($post['lastName']);
            break;
        
        case 'deleteByEmail':
            authDel();
            debug('I am inside the post method deleteByEmail <br>');
            include_once 'functions/delete/deleteByEmail.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to delete.';
                break;
            }
            $result = deleteByEmail($post['email']);
            break;
        
        case 'deleteByPassword':
            authDel();
            debug('I am inside the post method deleteByPassword <br>');
            include_once 'functions/delete/deleteByPassword.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to delete.';
                break;
            }
            $result = deleteByPassword($post['password']);
            break;
        
        case 'deleteByPhone':
            authDel();
            debug('I am inside the post method deleteByPhone <br>');
            include_once 'functions/delete/deleteByPhone.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to delete.';
                break;
            }
            $result = deleteByPhone($post['phone']);
            break;
        
        case 'deleteByCountry':
            authDel();
            debug('I am inside the post method deleteByCountry <br>');
            include_once 'functions/delete/deleteByCountry.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to delete.';
                break;
            }
            $result = deleteByCountry($post['country']);
            break;
        
        case 'deleteByState':
            authDel();
            debug('I am inside the post method deleteByState <br>');
            include_once 'functions/delete/deleteByState.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to delete.';
                break;
            }
            $result = deleteByState($post['state']);
            break;
        
        case 'deleteByCity':
            authDel();
            debug('I am inside the post method deleteByCity <br>');
            include_once 'functions/delete/deleteByCity.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to delete.';
                break;
            }
            $result = deleteByCity($post['city']);
            break;
        
        case 'deleteByRol':
            authDel();
            debug('I am inside the post method deleteByRol <br>');
            include_once 'functions/delete/deleteByRol.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to delete.';
                break;
            }
            $result = deleteByRol($post['rol']);
            break;
        
        case 'deleteByKyc':
            authDel();
            debug('I am inside the post method deleteByKyc <br>');
            include_once 'functions/delete/deleteByKyc.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to delete.';
                break;
            }
            $result = deleteByKyc($post['kyc']);
            break;
        
        case 'deleteByTarjeta':
            authDel();
            debug('I am inside the post method deleteByTarjeta <br>');
            include_once 'functions/delete/deleteByTarjeta.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to delete.';
                break;
            }
            $result = deleteByTarjeta($post['tarjeta']);
            break;
        
        case 'deleteByCuenta':
            authDel();
            debug('I am inside the post method deleteByCuenta <br>');
            include_once 'functions/delete/deleteByCuenta.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to delete.';
                break;
            }
            $result = deleteByCuenta($post['cuenta']);
            break;
        
        case 'deleteByAdmin':
            authDel();
            debug('I am inside the post method deleteByAdmin <br>');
            include_once 'functions/delete/deleteByAdmin.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to delete.';
                break;
            }
            $result = deleteByAdmin($post['admin']);
            break;
        
        case 'deleteByPriceKm':
            authDel();
            debug('I am inside the post method deleteByPriceKm <br>');
            include_once 'functions/delete/deleteByPriceKm.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to delete.';
                break;
            }
            $result = deleteByPriceKm($post['priceKm']);
            break;
        
        case 'deleteByZona1':
            authDel();
            debug('I am inside the post method deleteByZona1 <br>');
            include_once 'functions/delete/deleteByZona1.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to delete.';
                break;
            }
            $result = deleteByZona1($post['zona1']);
            break;
        
        case 'deleteByZona2':
            authDel();
            debug('I am inside the post method deleteByZona2 <br>');
            include_once 'functions/delete/deleteByZona2.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to delete.';
                break;
            }
            $result = deleteByZona2($post['zona2']);
            break;
        
        case 'deleteByZona3':
            authDel();
            debug('I am inside the post method deleteByZona3 <br>');
            include_once 'functions/delete/deleteByZona3.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to delete.';
                break;
            }
            $result = deleteByZona3($post['zona3']);
            break;
        
        case 'deleteByZona4':
            authDel();
            debug('I am inside the post method deleteByZona4 <br>');
            include_once 'functions/delete/deleteByZona4.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to delete.';
                break;
            }
            $result = deleteByZona4($post['zona4']);
            break;
        
        case 'updateAllById':
            authUpdate();
            debug('I am inside the post method updateAllById <br>');
            include_once 'functions/update/updateAllById.php';
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateAllById($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByUsername':
            authUpdate();
            debug('I am inside the post method updateAllByUsername <br>');
            include_once 'functions/update/updateAllByUsername.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateAllByUsername($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByFirstName':
            authUpdate();
            debug('I am inside the post method updateAllByFirstName <br>');
            include_once 'functions/update/updateAllByFirstName.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateAllByFirstName($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByLastName':
            authUpdate();
            debug('I am inside the post method updateAllByLastName <br>');
            include_once 'functions/update/updateAllByLastName.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateAllByLastName($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByEmail':
            authUpdate();
            debug('I am inside the post method updateAllByEmail <br>');
            include_once 'functions/update/updateAllByEmail.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateAllByEmail($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByPassword':
            authUpdate();
            debug('I am inside the post method updateAllByPassword <br>');
            include_once 'functions/update/updateAllByPassword.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateAllByPassword($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByPhone':
            authUpdate();
            debug('I am inside the post method updateAllByPhone <br>');
            include_once 'functions/update/updateAllByPhone.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateAllByPhone($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByCountry':
            authUpdate();
            debug('I am inside the post method updateAllByCountry <br>');
            include_once 'functions/update/updateAllByCountry.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateAllByCountry($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByState':
            authUpdate();
            debug('I am inside the post method updateAllByState <br>');
            include_once 'functions/update/updateAllByState.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateAllByState($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByCity':
            authUpdate();
            debug('I am inside the post method updateAllByCity <br>');
            include_once 'functions/update/updateAllByCity.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateAllByCity($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByRol':
            authUpdate();
            debug('I am inside the post method updateAllByRol <br>');
            include_once 'functions/update/updateAllByRol.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateAllByRol($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByKyc':
            authUpdate();
            debug('I am inside the post method updateAllByKyc <br>');
            include_once 'functions/update/updateAllByKyc.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateAllByKyc($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByTarjeta':
            authUpdate();
            debug('I am inside the post method updateAllByTarjeta <br>');
            include_once 'functions/update/updateAllByTarjeta.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateAllByTarjeta($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByCuenta':
            authUpdate();
            debug('I am inside the post method updateAllByCuenta <br>');
            include_once 'functions/update/updateAllByCuenta.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateAllByCuenta($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByAdmin':
            authUpdate();
            debug('I am inside the post method updateAllByAdmin <br>');
            include_once 'functions/update/updateAllByAdmin.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateAllByAdmin($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByPriceKm':
            authUpdate();
            debug('I am inside the post method updateAllByPriceKm <br>');
            include_once 'functions/update/updateAllByPriceKm.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateAllByPriceKm($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByZona1':
            authUpdate();
            debug('I am inside the post method updateAllByZona1 <br>');
            include_once 'functions/update/updateAllByZona1.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateAllByZona1($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByZona2':
            authUpdate();
            debug('I am inside the post method updateAllByZona2 <br>');
            include_once 'functions/update/updateAllByZona2.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateAllByZona2($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByZona3':
            authUpdate();
            debug('I am inside the post method updateAllByZona3 <br>');
            include_once 'functions/update/updateAllByZona3.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateAllByZona3($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateAllByZona4':
            authUpdate();
            debug('I am inside the post method updateAllByZona4 <br>');
            include_once 'functions/update/updateAllByZona4.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateAllByZona4($post['id'], $post['username'], $post['firstName'], $post['lastName'], $post['email'], $post['password'], $post['phone'], $post['country'], $post['state'], $post['city'], $post['rol'], $post['kyc'], $post['tarjeta'], $post['cuenta'], $post['admin'], $post['priceKm'], $post['zona1'], $post['zona2'], $post['zona3'], $post['zona4']);
            break;
        
        case 'updateUsernameById':
            authUpdate();
            debug('I am inside the post method updateUsernameById <br>');
            include_once 'functions/update/updateUsernameById.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateUsernameById($post['id']);
            break;
        
        case 'updateUsernameByFirstName':
            authUpdate();
            debug('I am inside the post method updateUsernameByFirstName <br>');
            include_once 'functions/update/updateUsernameByFirstName.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateUsernameByFirstName($post['firstName']);
            break;
        
        case 'updateUsernameByLastName':
            authUpdate();
            debug('I am inside the post method updateUsernameByLastName <br>');
            include_once 'functions/update/updateUsernameByLastName.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateUsernameByLastName($post['lastName']);
            break;
        
        case 'updateUsernameByEmail':
            authUpdate();
            debug('I am inside the post method updateUsernameByEmail <br>');
            include_once 'functions/update/updateUsernameByEmail.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateUsernameByEmail($post['email']);
            break;
        
        case 'updateUsernameByPassword':
            authUpdate();
            debug('I am inside the post method updateUsernameByPassword <br>');
            include_once 'functions/update/updateUsernameByPassword.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateUsernameByPassword($post['password']);
            break;
        
        case 'updateUsernameByPhone':
            authUpdate();
            debug('I am inside the post method updateUsernameByPhone <br>');
            include_once 'functions/update/updateUsernameByPhone.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateUsernameByPhone($post['phone']);
            break;
        
        case 'updateUsernameByCountry':
            authUpdate();
            debug('I am inside the post method updateUsernameByCountry <br>');
            include_once 'functions/update/updateUsernameByCountry.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateUsernameByCountry($post['country']);
            break;
        
        case 'updateUsernameByState':
            authUpdate();
            debug('I am inside the post method updateUsernameByState <br>');
            include_once 'functions/update/updateUsernameByState.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateUsernameByState($post['state']);
            break;
        
        case 'updateUsernameByCity':
            authUpdate();
            debug('I am inside the post method updateUsernameByCity <br>');
            include_once 'functions/update/updateUsernameByCity.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateUsernameByCity($post['city']);
            break;
        
        case 'updateUsernameByRol':
            authUpdate();
            debug('I am inside the post method updateUsernameByRol <br>');
            include_once 'functions/update/updateUsernameByRol.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateUsernameByRol($post['rol']);
            break;
        
        case 'updateUsernameByKyc':
            authUpdate();
            debug('I am inside the post method updateUsernameByKyc <br>');
            include_once 'functions/update/updateUsernameByKyc.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateUsernameByKyc($post['kyc']);
            break;
        
        case 'updateUsernameByTarjeta':
            authUpdate();
            debug('I am inside the post method updateUsernameByTarjeta <br>');
            include_once 'functions/update/updateUsernameByTarjeta.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateUsernameByTarjeta($post['tarjeta']);
            break;
        
        case 'updateUsernameByCuenta':
            authUpdate();
            debug('I am inside the post method updateUsernameByCuenta <br>');
            include_once 'functions/update/updateUsernameByCuenta.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateUsernameByCuenta($post['cuenta']);
            break;
        
        case 'updateUsernameByAdmin':
            authUpdate();
            debug('I am inside the post method updateUsernameByAdmin <br>');
            include_once 'functions/update/updateUsernameByAdmin.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateUsernameByAdmin($post['admin']);
            break;
        
        case 'updateUsernameByPriceKm':
            authUpdate();
            debug('I am inside the post method updateUsernameByPriceKm <br>');
            include_once 'functions/update/updateUsernameByPriceKm.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateUsernameByPriceKm($post['priceKm']);
            break;
        
        case 'updateUsernameByZona1':
            authUpdate();
            debug('I am inside the post method updateUsernameByZona1 <br>');
            include_once 'functions/update/updateUsernameByZona1.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateUsernameByZona1($post['zona1']);
            break;
        
        case 'updateUsernameByZona2':
            authUpdate();
            debug('I am inside the post method updateUsernameByZona2 <br>');
            include_once 'functions/update/updateUsernameByZona2.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateUsernameByZona2($post['zona2']);
            break;
        
        case 'updateUsernameByZona3':
            authUpdate();
            debug('I am inside the post method updateUsernameByZona3 <br>');
            include_once 'functions/update/updateUsernameByZona3.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateUsernameByZona3($post['zona3']);
            break;
        
        case 'updateUsernameByZona4':
            authUpdate();
            debug('I am inside the post method updateUsernameByZona4 <br>');
            include_once 'functions/update/updateUsernameByZona4.php';
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateUsernameByZona4($post['zona4']);
            break;
        
        case 'updateFirstNameById':
            authUpdate();
            debug('I am inside the post method updateFirstNameById <br>');
            include_once 'functions/update/updateFirstNameById.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateFirstNameById($post['id']);
            break;
        
        case 'updateFirstNameByUsername':
            authUpdate();
            debug('I am inside the post method updateFirstNameByUsername <br>');
            include_once 'functions/update/updateFirstNameByUsername.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateFirstNameByUsername($post['username']);
            break;
        
        case 'updateFirstNameByLastName':
            authUpdate();
            debug('I am inside the post method updateFirstNameByLastName <br>');
            include_once 'functions/update/updateFirstNameByLastName.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateFirstNameByLastName($post['lastName']);
            break;
        
        case 'updateFirstNameByEmail':
            authUpdate();
            debug('I am inside the post method updateFirstNameByEmail <br>');
            include_once 'functions/update/updateFirstNameByEmail.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateFirstNameByEmail($post['email']);
            break;
        
        case 'updateFirstNameByPassword':
            authUpdate();
            debug('I am inside the post method updateFirstNameByPassword <br>');
            include_once 'functions/update/updateFirstNameByPassword.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateFirstNameByPassword($post['password']);
            break;
        
        case 'updateFirstNameByPhone':
            authUpdate();
            debug('I am inside the post method updateFirstNameByPhone <br>');
            include_once 'functions/update/updateFirstNameByPhone.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateFirstNameByPhone($post['phone']);
            break;
        
        case 'updateFirstNameByCountry':
            authUpdate();
            debug('I am inside the post method updateFirstNameByCountry <br>');
            include_once 'functions/update/updateFirstNameByCountry.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateFirstNameByCountry($post['country']);
            break;
        
        case 'updateFirstNameByState':
            authUpdate();
            debug('I am inside the post method updateFirstNameByState <br>');
            include_once 'functions/update/updateFirstNameByState.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateFirstNameByState($post['state']);
            break;
        
        case 'updateFirstNameByCity':
            authUpdate();
            debug('I am inside the post method updateFirstNameByCity <br>');
            include_once 'functions/update/updateFirstNameByCity.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateFirstNameByCity($post['city']);
            break;
        
        case 'updateFirstNameByRol':
            authUpdate();
            debug('I am inside the post method updateFirstNameByRol <br>');
            include_once 'functions/update/updateFirstNameByRol.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateFirstNameByRol($post['rol']);
            break;
        
        case 'updateFirstNameByKyc':
            authUpdate();
            debug('I am inside the post method updateFirstNameByKyc <br>');
            include_once 'functions/update/updateFirstNameByKyc.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateFirstNameByKyc($post['kyc']);
            break;
        
        case 'updateFirstNameByTarjeta':
            authUpdate();
            debug('I am inside the post method updateFirstNameByTarjeta <br>');
            include_once 'functions/update/updateFirstNameByTarjeta.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateFirstNameByTarjeta($post['tarjeta']);
            break;
        
        case 'updateFirstNameByCuenta':
            authUpdate();
            debug('I am inside the post method updateFirstNameByCuenta <br>');
            include_once 'functions/update/updateFirstNameByCuenta.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateFirstNameByCuenta($post['cuenta']);
            break;
        
        case 'updateFirstNameByAdmin':
            authUpdate();
            debug('I am inside the post method updateFirstNameByAdmin <br>');
            include_once 'functions/update/updateFirstNameByAdmin.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateFirstNameByAdmin($post['admin']);
            break;
        
        case 'updateFirstNameByPriceKm':
            authUpdate();
            debug('I am inside the post method updateFirstNameByPriceKm <br>');
            include_once 'functions/update/updateFirstNameByPriceKm.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateFirstNameByPriceKm($post['priceKm']);
            break;
        
        case 'updateFirstNameByZona1':
            authUpdate();
            debug('I am inside the post method updateFirstNameByZona1 <br>');
            include_once 'functions/update/updateFirstNameByZona1.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateFirstNameByZona1($post['zona1']);
            break;
        
        case 'updateFirstNameByZona2':
            authUpdate();
            debug('I am inside the post method updateFirstNameByZona2 <br>');
            include_once 'functions/update/updateFirstNameByZona2.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateFirstNameByZona2($post['zona2']);
            break;
        
        case 'updateFirstNameByZona3':
            authUpdate();
            debug('I am inside the post method updateFirstNameByZona3 <br>');
            include_once 'functions/update/updateFirstNameByZona3.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateFirstNameByZona3($post['zona3']);
            break;
        
        case 'updateFirstNameByZona4':
            authUpdate();
            debug('I am inside the post method updateFirstNameByZona4 <br>');
            include_once 'functions/update/updateFirstNameByZona4.php';
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateFirstNameByZona4($post['zona4']);
            break;
        
        case 'updateLastNameById':
            authUpdate();
            debug('I am inside the post method updateLastNameById <br>');
            include_once 'functions/update/updateLastNameById.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateLastNameById($post['id']);
            break;
        
        case 'updateLastNameByUsername':
            authUpdate();
            debug('I am inside the post method updateLastNameByUsername <br>');
            include_once 'functions/update/updateLastNameByUsername.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateLastNameByUsername($post['username']);
            break;
        
        case 'updateLastNameByFirstName':
            authUpdate();
            debug('I am inside the post method updateLastNameByFirstName <br>');
            include_once 'functions/update/updateLastNameByFirstName.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateLastNameByFirstName($post['firstName']);
            break;
        
        case 'updateLastNameByEmail':
            authUpdate();
            debug('I am inside the post method updateLastNameByEmail <br>');
            include_once 'functions/update/updateLastNameByEmail.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateLastNameByEmail($post['email']);
            break;
        
        case 'updateLastNameByPassword':
            authUpdate();
            debug('I am inside the post method updateLastNameByPassword <br>');
            include_once 'functions/update/updateLastNameByPassword.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateLastNameByPassword($post['password']);
            break;
        
        case 'updateLastNameByPhone':
            authUpdate();
            debug('I am inside the post method updateLastNameByPhone <br>');
            include_once 'functions/update/updateLastNameByPhone.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateLastNameByPhone($post['phone']);
            break;
        
        case 'updateLastNameByCountry':
            authUpdate();
            debug('I am inside the post method updateLastNameByCountry <br>');
            include_once 'functions/update/updateLastNameByCountry.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateLastNameByCountry($post['country']);
            break;
        
        case 'updateLastNameByState':
            authUpdate();
            debug('I am inside the post method updateLastNameByState <br>');
            include_once 'functions/update/updateLastNameByState.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateLastNameByState($post['state']);
            break;
        
        case 'updateLastNameByCity':
            authUpdate();
            debug('I am inside the post method updateLastNameByCity <br>');
            include_once 'functions/update/updateLastNameByCity.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateLastNameByCity($post['city']);
            break;
        
        case 'updateLastNameByRol':
            authUpdate();
            debug('I am inside the post method updateLastNameByRol <br>');
            include_once 'functions/update/updateLastNameByRol.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateLastNameByRol($post['rol']);
            break;
        
        case 'updateLastNameByKyc':
            authUpdate();
            debug('I am inside the post method updateLastNameByKyc <br>');
            include_once 'functions/update/updateLastNameByKyc.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateLastNameByKyc($post['kyc']);
            break;
        
        case 'updateLastNameByTarjeta':
            authUpdate();
            debug('I am inside the post method updateLastNameByTarjeta <br>');
            include_once 'functions/update/updateLastNameByTarjeta.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateLastNameByTarjeta($post['tarjeta']);
            break;
        
        case 'updateLastNameByCuenta':
            authUpdate();
            debug('I am inside the post method updateLastNameByCuenta <br>');
            include_once 'functions/update/updateLastNameByCuenta.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateLastNameByCuenta($post['cuenta']);
            break;
        
        case 'updateLastNameByAdmin':
            authUpdate();
            debug('I am inside the post method updateLastNameByAdmin <br>');
            include_once 'functions/update/updateLastNameByAdmin.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateLastNameByAdmin($post['admin']);
            break;
        
        case 'updateLastNameByPriceKm':
            authUpdate();
            debug('I am inside the post method updateLastNameByPriceKm <br>');
            include_once 'functions/update/updateLastNameByPriceKm.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateLastNameByPriceKm($post['priceKm']);
            break;
        
        case 'updateLastNameByZona1':
            authUpdate();
            debug('I am inside the post method updateLastNameByZona1 <br>');
            include_once 'functions/update/updateLastNameByZona1.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateLastNameByZona1($post['zona1']);
            break;
        
        case 'updateLastNameByZona2':
            authUpdate();
            debug('I am inside the post method updateLastNameByZona2 <br>');
            include_once 'functions/update/updateLastNameByZona2.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateLastNameByZona2($post['zona2']);
            break;
        
        case 'updateLastNameByZona3':
            authUpdate();
            debug('I am inside the post method updateLastNameByZona3 <br>');
            include_once 'functions/update/updateLastNameByZona3.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateLastNameByZona3($post['zona3']);
            break;
        
        case 'updateLastNameByZona4':
            authUpdate();
            debug('I am inside the post method updateLastNameByZona4 <br>');
            include_once 'functions/update/updateLastNameByZona4.php';
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateLastNameByZona4($post['zona4']);
            break;
        
        case 'updateEmailById':
            authUpdate();
            debug('I am inside the post method updateEmailById <br>');
            include_once 'functions/update/updateEmailById.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateEmailById($post['id']);
            break;
        
        case 'updateEmailByUsername':
            authUpdate();
            debug('I am inside the post method updateEmailByUsername <br>');
            include_once 'functions/update/updateEmailByUsername.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateEmailByUsername($post['username']);
            break;
        
        case 'updateEmailByFirstName':
            authUpdate();
            debug('I am inside the post method updateEmailByFirstName <br>');
            include_once 'functions/update/updateEmailByFirstName.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateEmailByFirstName($post['firstName']);
            break;
        
        case 'updateEmailByLastName':
            authUpdate();
            debug('I am inside the post method updateEmailByLastName <br>');
            include_once 'functions/update/updateEmailByLastName.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateEmailByLastName($post['lastName']);
            break;
        
        case 'updateEmailByPassword':
            authUpdate();
            debug('I am inside the post method updateEmailByPassword <br>');
            include_once 'functions/update/updateEmailByPassword.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateEmailByPassword($post['password']);
            break;
        
        case 'updateEmailByPhone':
            authUpdate();
            debug('I am inside the post method updateEmailByPhone <br>');
            include_once 'functions/update/updateEmailByPhone.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateEmailByPhone($post['phone']);
            break;
        
        case 'updateEmailByCountry':
            authUpdate();
            debug('I am inside the post method updateEmailByCountry <br>');
            include_once 'functions/update/updateEmailByCountry.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateEmailByCountry($post['country']);
            break;
        
        case 'updateEmailByState':
            authUpdate();
            debug('I am inside the post method updateEmailByState <br>');
            include_once 'functions/update/updateEmailByState.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateEmailByState($post['state']);
            break;
        
        case 'updateEmailByCity':
            authUpdate();
            debug('I am inside the post method updateEmailByCity <br>');
            include_once 'functions/update/updateEmailByCity.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateEmailByCity($post['city']);
            break;
        
        case 'updateEmailByRol':
            authUpdate();
            debug('I am inside the post method updateEmailByRol <br>');
            include_once 'functions/update/updateEmailByRol.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateEmailByRol($post['rol']);
            break;
        
        case 'updateEmailByKyc':
            authUpdate();
            debug('I am inside the post method updateEmailByKyc <br>');
            include_once 'functions/update/updateEmailByKyc.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateEmailByKyc($post['kyc']);
            break;
        
        case 'updateEmailByTarjeta':
            authUpdate();
            debug('I am inside the post method updateEmailByTarjeta <br>');
            include_once 'functions/update/updateEmailByTarjeta.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateEmailByTarjeta($post['tarjeta']);
            break;
        
        case 'updateEmailByCuenta':
            authUpdate();
            debug('I am inside the post method updateEmailByCuenta <br>');
            include_once 'functions/update/updateEmailByCuenta.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateEmailByCuenta($post['cuenta']);
            break;
        
        case 'updateEmailByAdmin':
            authUpdate();
            debug('I am inside the post method updateEmailByAdmin <br>');
            include_once 'functions/update/updateEmailByAdmin.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateEmailByAdmin($post['admin']);
            break;
        
        case 'updateEmailByPriceKm':
            authUpdate();
            debug('I am inside the post method updateEmailByPriceKm <br>');
            include_once 'functions/update/updateEmailByPriceKm.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateEmailByPriceKm($post['priceKm']);
            break;
        
        case 'updateEmailByZona1':
            authUpdate();
            debug('I am inside the post method updateEmailByZona1 <br>');
            include_once 'functions/update/updateEmailByZona1.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateEmailByZona1($post['zona1']);
            break;
        
        case 'updateEmailByZona2':
            authUpdate();
            debug('I am inside the post method updateEmailByZona2 <br>');
            include_once 'functions/update/updateEmailByZona2.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateEmailByZona2($post['zona2']);
            break;
        
        case 'updateEmailByZona3':
            authUpdate();
            debug('I am inside the post method updateEmailByZona3 <br>');
            include_once 'functions/update/updateEmailByZona3.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateEmailByZona3($post['zona3']);
            break;
        
        case 'updateEmailByZona4':
            authUpdate();
            debug('I am inside the post method updateEmailByZona4 <br>');
            include_once 'functions/update/updateEmailByZona4.php';
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateEmailByZona4($post['zona4']);
            break;
        
        case 'updatePasswordById':
            authUpdate();
            debug('I am inside the post method updatePasswordById <br>');
            include_once 'functions/update/updatePasswordById.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updatePasswordById($post['id']);
            break;
        
        case 'updatePasswordByUsername':
            authUpdate();
            debug('I am inside the post method updatePasswordByUsername <br>');
            include_once 'functions/update/updatePasswordByUsername.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updatePasswordByUsername($post['username']);
            break;
        
        case 'updatePasswordByFirstName':
            authUpdate();
            debug('I am inside the post method updatePasswordByFirstName <br>');
            include_once 'functions/update/updatePasswordByFirstName.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updatePasswordByFirstName($post['firstName']);
            break;
        
        case 'updatePasswordByLastName':
            authUpdate();
            debug('I am inside the post method updatePasswordByLastName <br>');
            include_once 'functions/update/updatePasswordByLastName.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updatePasswordByLastName($post['lastName']);
            break;
        
        case 'updatePasswordByEmail':
            authUpdate();
            debug('I am inside the post method updatePasswordByEmail <br>');
            include_once 'functions/update/updatePasswordByEmail.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updatePasswordByEmail($post['email']);
            break;
        
        case 'updatePasswordByPhone':
            authUpdate();
            debug('I am inside the post method updatePasswordByPhone <br>');
            include_once 'functions/update/updatePasswordByPhone.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updatePasswordByPhone($post['phone']);
            break;
        
        case 'updatePasswordByCountry':
            authUpdate();
            debug('I am inside the post method updatePasswordByCountry <br>');
            include_once 'functions/update/updatePasswordByCountry.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updatePasswordByCountry($post['country']);
            break;
        
        case 'updatePasswordByState':
            authUpdate();
            debug('I am inside the post method updatePasswordByState <br>');
            include_once 'functions/update/updatePasswordByState.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updatePasswordByState($post['state']);
            break;
        
        case 'updatePasswordByCity':
            authUpdate();
            debug('I am inside the post method updatePasswordByCity <br>');
            include_once 'functions/update/updatePasswordByCity.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updatePasswordByCity($post['city']);
            break;
        
        case 'updatePasswordByRol':
            authUpdate();
            debug('I am inside the post method updatePasswordByRol <br>');
            include_once 'functions/update/updatePasswordByRol.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updatePasswordByRol($post['rol']);
            break;
        
        case 'updatePasswordByKyc':
            authUpdate();
            debug('I am inside the post method updatePasswordByKyc <br>');
            include_once 'functions/update/updatePasswordByKyc.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updatePasswordByKyc($post['kyc']);
            break;
        
        case 'updatePasswordByTarjeta':
            authUpdate();
            debug('I am inside the post method updatePasswordByTarjeta <br>');
            include_once 'functions/update/updatePasswordByTarjeta.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updatePasswordByTarjeta($post['tarjeta']);
            break;
        
        case 'updatePasswordByCuenta':
            authUpdate();
            debug('I am inside the post method updatePasswordByCuenta <br>');
            include_once 'functions/update/updatePasswordByCuenta.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updatePasswordByCuenta($post['cuenta']);
            break;
        
        case 'updatePasswordByAdmin':
            authUpdate();
            debug('I am inside the post method updatePasswordByAdmin <br>');
            include_once 'functions/update/updatePasswordByAdmin.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updatePasswordByAdmin($post['admin']);
            break;
        
        case 'updatePasswordByPriceKm':
            authUpdate();
            debug('I am inside the post method updatePasswordByPriceKm <br>');
            include_once 'functions/update/updatePasswordByPriceKm.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updatePasswordByPriceKm($post['priceKm']);
            break;
        
        case 'updatePasswordByZona1':
            authUpdate();
            debug('I am inside the post method updatePasswordByZona1 <br>');
            include_once 'functions/update/updatePasswordByZona1.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updatePasswordByZona1($post['zona1']);
            break;
        
        case 'updatePasswordByZona2':
            authUpdate();
            debug('I am inside the post method updatePasswordByZona2 <br>');
            include_once 'functions/update/updatePasswordByZona2.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updatePasswordByZona2($post['zona2']);
            break;
        
        case 'updatePasswordByZona3':
            authUpdate();
            debug('I am inside the post method updatePasswordByZona3 <br>');
            include_once 'functions/update/updatePasswordByZona3.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updatePasswordByZona3($post['zona3']);
            break;
        
        case 'updatePasswordByZona4':
            authUpdate();
            debug('I am inside the post method updatePasswordByZona4 <br>');
            include_once 'functions/update/updatePasswordByZona4.php';
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updatePasswordByZona4($post['zona4']);
            break;
        
        case 'updatePhoneById':
            authUpdate();
            debug('I am inside the post method updatePhoneById <br>');
            include_once 'functions/update/updatePhoneById.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updatePhoneById($post['id']);
            break;
        
        case 'updatePhoneByUsername':
            authUpdate();
            debug('I am inside the post method updatePhoneByUsername <br>');
            include_once 'functions/update/updatePhoneByUsername.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updatePhoneByUsername($post['username']);
            break;
        
        case 'updatePhoneByFirstName':
            authUpdate();
            debug('I am inside the post method updatePhoneByFirstName <br>');
            include_once 'functions/update/updatePhoneByFirstName.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updatePhoneByFirstName($post['firstName']);
            break;
        
        case 'updatePhoneByLastName':
            authUpdate();
            debug('I am inside the post method updatePhoneByLastName <br>');
            include_once 'functions/update/updatePhoneByLastName.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updatePhoneByLastName($post['lastName']);
            break;
        
        case 'updatePhoneByEmail':
            authUpdate();
            debug('I am inside the post method updatePhoneByEmail <br>');
            include_once 'functions/update/updatePhoneByEmail.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updatePhoneByEmail($post['email']);
            break;
        
        case 'updatePhoneByPassword':
            authUpdate();
            debug('I am inside the post method updatePhoneByPassword <br>');
            include_once 'functions/update/updatePhoneByPassword.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updatePhoneByPassword($post['password']);
            break;
        
        case 'updatePhoneByCountry':
            authUpdate();
            debug('I am inside the post method updatePhoneByCountry <br>');
            include_once 'functions/update/updatePhoneByCountry.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updatePhoneByCountry($post['country']);
            break;
        
        case 'updatePhoneByState':
            authUpdate();
            debug('I am inside the post method updatePhoneByState <br>');
            include_once 'functions/update/updatePhoneByState.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updatePhoneByState($post['state']);
            break;
        
        case 'updatePhoneByCity':
            authUpdate();
            debug('I am inside the post method updatePhoneByCity <br>');
            include_once 'functions/update/updatePhoneByCity.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updatePhoneByCity($post['city']);
            break;
        
        case 'updatePhoneByRol':
            authUpdate();
            debug('I am inside the post method updatePhoneByRol <br>');
            include_once 'functions/update/updatePhoneByRol.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updatePhoneByRol($post['rol']);
            break;
        
        case 'updatePhoneByKyc':
            authUpdate();
            debug('I am inside the post method updatePhoneByKyc <br>');
            include_once 'functions/update/updatePhoneByKyc.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updatePhoneByKyc($post['kyc']);
            break;
        
        case 'updatePhoneByTarjeta':
            authUpdate();
            debug('I am inside the post method updatePhoneByTarjeta <br>');
            include_once 'functions/update/updatePhoneByTarjeta.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updatePhoneByTarjeta($post['tarjeta']);
            break;
        
        case 'updatePhoneByCuenta':
            authUpdate();
            debug('I am inside the post method updatePhoneByCuenta <br>');
            include_once 'functions/update/updatePhoneByCuenta.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updatePhoneByCuenta($post['cuenta']);
            break;
        
        case 'updatePhoneByAdmin':
            authUpdate();
            debug('I am inside the post method updatePhoneByAdmin <br>');
            include_once 'functions/update/updatePhoneByAdmin.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updatePhoneByAdmin($post['admin']);
            break;
        
        case 'updatePhoneByPriceKm':
            authUpdate();
            debug('I am inside the post method updatePhoneByPriceKm <br>');
            include_once 'functions/update/updatePhoneByPriceKm.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updatePhoneByPriceKm($post['priceKm']);
            break;
        
        case 'updatePhoneByZona1':
            authUpdate();
            debug('I am inside the post method updatePhoneByZona1 <br>');
            include_once 'functions/update/updatePhoneByZona1.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updatePhoneByZona1($post['zona1']);
            break;
        
        case 'updatePhoneByZona2':
            authUpdate();
            debug('I am inside the post method updatePhoneByZona2 <br>');
            include_once 'functions/update/updatePhoneByZona2.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updatePhoneByZona2($post['zona2']);
            break;
        
        case 'updatePhoneByZona3':
            authUpdate();
            debug('I am inside the post method updatePhoneByZona3 <br>');
            include_once 'functions/update/updatePhoneByZona3.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updatePhoneByZona3($post['zona3']);
            break;
        
        case 'updatePhoneByZona4':
            authUpdate();
            debug('I am inside the post method updatePhoneByZona4 <br>');
            include_once 'functions/update/updatePhoneByZona4.php';
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updatePhoneByZona4($post['zona4']);
            break;
        
        case 'updateCountryById':
            authUpdate();
            debug('I am inside the post method updateCountryById <br>');
            include_once 'functions/update/updateCountryById.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateCountryById($post['id']);
            break;
        
        case 'updateCountryByUsername':
            authUpdate();
            debug('I am inside the post method updateCountryByUsername <br>');
            include_once 'functions/update/updateCountryByUsername.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateCountryByUsername($post['username']);
            break;
        
        case 'updateCountryByFirstName':
            authUpdate();
            debug('I am inside the post method updateCountryByFirstName <br>');
            include_once 'functions/update/updateCountryByFirstName.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateCountryByFirstName($post['firstName']);
            break;
        
        case 'updateCountryByLastName':
            authUpdate();
            debug('I am inside the post method updateCountryByLastName <br>');
            include_once 'functions/update/updateCountryByLastName.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateCountryByLastName($post['lastName']);
            break;
        
        case 'updateCountryByEmail':
            authUpdate();
            debug('I am inside the post method updateCountryByEmail <br>');
            include_once 'functions/update/updateCountryByEmail.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateCountryByEmail($post['email']);
            break;
        
        case 'updateCountryByPassword':
            authUpdate();
            debug('I am inside the post method updateCountryByPassword <br>');
            include_once 'functions/update/updateCountryByPassword.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateCountryByPassword($post['password']);
            break;
        
        case 'updateCountryByPhone':
            authUpdate();
            debug('I am inside the post method updateCountryByPhone <br>');
            include_once 'functions/update/updateCountryByPhone.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateCountryByPhone($post['phone']);
            break;
        
        case 'updateCountryByState':
            authUpdate();
            debug('I am inside the post method updateCountryByState <br>');
            include_once 'functions/update/updateCountryByState.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateCountryByState($post['state']);
            break;
        
        case 'updateCountryByCity':
            authUpdate();
            debug('I am inside the post method updateCountryByCity <br>');
            include_once 'functions/update/updateCountryByCity.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateCountryByCity($post['city']);
            break;
        
        case 'updateCountryByRol':
            authUpdate();
            debug('I am inside the post method updateCountryByRol <br>');
            include_once 'functions/update/updateCountryByRol.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateCountryByRol($post['rol']);
            break;
        
        case 'updateCountryByKyc':
            authUpdate();
            debug('I am inside the post method updateCountryByKyc <br>');
            include_once 'functions/update/updateCountryByKyc.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateCountryByKyc($post['kyc']);
            break;
        
        case 'updateCountryByTarjeta':
            authUpdate();
            debug('I am inside the post method updateCountryByTarjeta <br>');
            include_once 'functions/update/updateCountryByTarjeta.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateCountryByTarjeta($post['tarjeta']);
            break;
        
        case 'updateCountryByCuenta':
            authUpdate();
            debug('I am inside the post method updateCountryByCuenta <br>');
            include_once 'functions/update/updateCountryByCuenta.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateCountryByCuenta($post['cuenta']);
            break;
        
        case 'updateCountryByAdmin':
            authUpdate();
            debug('I am inside the post method updateCountryByAdmin <br>');
            include_once 'functions/update/updateCountryByAdmin.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateCountryByAdmin($post['admin']);
            break;
        
        case 'updateCountryByPriceKm':
            authUpdate();
            debug('I am inside the post method updateCountryByPriceKm <br>');
            include_once 'functions/update/updateCountryByPriceKm.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateCountryByPriceKm($post['priceKm']);
            break;
        
        case 'updateCountryByZona1':
            authUpdate();
            debug('I am inside the post method updateCountryByZona1 <br>');
            include_once 'functions/update/updateCountryByZona1.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateCountryByZona1($post['zona1']);
            break;
        
        case 'updateCountryByZona2':
            authUpdate();
            debug('I am inside the post method updateCountryByZona2 <br>');
            include_once 'functions/update/updateCountryByZona2.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateCountryByZona2($post['zona2']);
            break;
        
        case 'updateCountryByZona3':
            authUpdate();
            debug('I am inside the post method updateCountryByZona3 <br>');
            include_once 'functions/update/updateCountryByZona3.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateCountryByZona3($post['zona3']);
            break;
        
        case 'updateCountryByZona4':
            authUpdate();
            debug('I am inside the post method updateCountryByZona4 <br>');
            include_once 'functions/update/updateCountryByZona4.php';
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateCountryByZona4($post['zona4']);
            break;
        
        case 'updateStateById':
            authUpdate();
            debug('I am inside the post method updateStateById <br>');
            include_once 'functions/update/updateStateById.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateStateById($post['id']);
            break;
        
        case 'updateStateByUsername':
            authUpdate();
            debug('I am inside the post method updateStateByUsername <br>');
            include_once 'functions/update/updateStateByUsername.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateStateByUsername($post['username']);
            break;
        
        case 'updateStateByFirstName':
            authUpdate();
            debug('I am inside the post method updateStateByFirstName <br>');
            include_once 'functions/update/updateStateByFirstName.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateStateByFirstName($post['firstName']);
            break;
        
        case 'updateStateByLastName':
            authUpdate();
            debug('I am inside the post method updateStateByLastName <br>');
            include_once 'functions/update/updateStateByLastName.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateStateByLastName($post['lastName']);
            break;
        
        case 'updateStateByEmail':
            authUpdate();
            debug('I am inside the post method updateStateByEmail <br>');
            include_once 'functions/update/updateStateByEmail.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateStateByEmail($post['email']);
            break;
        
        case 'updateStateByPassword':
            authUpdate();
            debug('I am inside the post method updateStateByPassword <br>');
            include_once 'functions/update/updateStateByPassword.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateStateByPassword($post['password']);
            break;
        
        case 'updateStateByPhone':
            authUpdate();
            debug('I am inside the post method updateStateByPhone <br>');
            include_once 'functions/update/updateStateByPhone.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateStateByPhone($post['phone']);
            break;
        
        case 'updateStateByCountry':
            authUpdate();
            debug('I am inside the post method updateStateByCountry <br>');
            include_once 'functions/update/updateStateByCountry.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateStateByCountry($post['country']);
            break;
        
        case 'updateStateByCity':
            authUpdate();
            debug('I am inside the post method updateStateByCity <br>');
            include_once 'functions/update/updateStateByCity.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateStateByCity($post['city']);
            break;
        
        case 'updateStateByRol':
            authUpdate();
            debug('I am inside the post method updateStateByRol <br>');
            include_once 'functions/update/updateStateByRol.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateStateByRol($post['rol']);
            break;
        
        case 'updateStateByKyc':
            authUpdate();
            debug('I am inside the post method updateStateByKyc <br>');
            include_once 'functions/update/updateStateByKyc.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateStateByKyc($post['kyc']);
            break;
        
        case 'updateStateByTarjeta':
            authUpdate();
            debug('I am inside the post method updateStateByTarjeta <br>');
            include_once 'functions/update/updateStateByTarjeta.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateStateByTarjeta($post['tarjeta']);
            break;
        
        case 'updateStateByCuenta':
            authUpdate();
            debug('I am inside the post method updateStateByCuenta <br>');
            include_once 'functions/update/updateStateByCuenta.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateStateByCuenta($post['cuenta']);
            break;
        
        case 'updateStateByAdmin':
            authUpdate();
            debug('I am inside the post method updateStateByAdmin <br>');
            include_once 'functions/update/updateStateByAdmin.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateStateByAdmin($post['admin']);
            break;
        
        case 'updateStateByPriceKm':
            authUpdate();
            debug('I am inside the post method updateStateByPriceKm <br>');
            include_once 'functions/update/updateStateByPriceKm.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateStateByPriceKm($post['priceKm']);
            break;
        
        case 'updateStateByZona1':
            authUpdate();
            debug('I am inside the post method updateStateByZona1 <br>');
            include_once 'functions/update/updateStateByZona1.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateStateByZona1($post['zona1']);
            break;
        
        case 'updateStateByZona2':
            authUpdate();
            debug('I am inside the post method updateStateByZona2 <br>');
            include_once 'functions/update/updateStateByZona2.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateStateByZona2($post['zona2']);
            break;
        
        case 'updateStateByZona3':
            authUpdate();
            debug('I am inside the post method updateStateByZona3 <br>');
            include_once 'functions/update/updateStateByZona3.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateStateByZona3($post['zona3']);
            break;
        
        case 'updateStateByZona4':
            authUpdate();
            debug('I am inside the post method updateStateByZona4 <br>');
            include_once 'functions/update/updateStateByZona4.php';
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateStateByZona4($post['zona4']);
            break;
        
        case 'updateCityById':
            authUpdate();
            debug('I am inside the post method updateCityById <br>');
            include_once 'functions/update/updateCityById.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateCityById($post['id']);
            break;
        
        case 'updateCityByUsername':
            authUpdate();
            debug('I am inside the post method updateCityByUsername <br>');
            include_once 'functions/update/updateCityByUsername.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateCityByUsername($post['username']);
            break;
        
        case 'updateCityByFirstName':
            authUpdate();
            debug('I am inside the post method updateCityByFirstName <br>');
            include_once 'functions/update/updateCityByFirstName.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateCityByFirstName($post['firstName']);
            break;
        
        case 'updateCityByLastName':
            authUpdate();
            debug('I am inside the post method updateCityByLastName <br>');
            include_once 'functions/update/updateCityByLastName.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateCityByLastName($post['lastName']);
            break;
        
        case 'updateCityByEmail':
            authUpdate();
            debug('I am inside the post method updateCityByEmail <br>');
            include_once 'functions/update/updateCityByEmail.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateCityByEmail($post['email']);
            break;
        
        case 'updateCityByPassword':
            authUpdate();
            debug('I am inside the post method updateCityByPassword <br>');
            include_once 'functions/update/updateCityByPassword.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateCityByPassword($post['password']);
            break;
        
        case 'updateCityByPhone':
            authUpdate();
            debug('I am inside the post method updateCityByPhone <br>');
            include_once 'functions/update/updateCityByPhone.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateCityByPhone($post['phone']);
            break;
        
        case 'updateCityByCountry':
            authUpdate();
            debug('I am inside the post method updateCityByCountry <br>');
            include_once 'functions/update/updateCityByCountry.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateCityByCountry($post['country']);
            break;
        
        case 'updateCityByState':
            authUpdate();
            debug('I am inside the post method updateCityByState <br>');
            include_once 'functions/update/updateCityByState.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateCityByState($post['state']);
            break;
        
        case 'updateCityByRol':
            authUpdate();
            debug('I am inside the post method updateCityByRol <br>');
            include_once 'functions/update/updateCityByRol.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateCityByRol($post['rol']);
            break;
        
        case 'updateCityByKyc':
            authUpdate();
            debug('I am inside the post method updateCityByKyc <br>');
            include_once 'functions/update/updateCityByKyc.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateCityByKyc($post['kyc']);
            break;
        
        case 'updateCityByTarjeta':
            authUpdate();
            debug('I am inside the post method updateCityByTarjeta <br>');
            include_once 'functions/update/updateCityByTarjeta.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateCityByTarjeta($post['tarjeta']);
            break;
        
        case 'updateCityByCuenta':
            authUpdate();
            debug('I am inside the post method updateCityByCuenta <br>');
            include_once 'functions/update/updateCityByCuenta.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateCityByCuenta($post['cuenta']);
            break;
        
        case 'updateCityByAdmin':
            authUpdate();
            debug('I am inside the post method updateCityByAdmin <br>');
            include_once 'functions/update/updateCityByAdmin.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateCityByAdmin($post['admin']);
            break;
        
        case 'updateCityByPriceKm':
            authUpdate();
            debug('I am inside the post method updateCityByPriceKm <br>');
            include_once 'functions/update/updateCityByPriceKm.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateCityByPriceKm($post['priceKm']);
            break;
        
        case 'updateCityByZona1':
            authUpdate();
            debug('I am inside the post method updateCityByZona1 <br>');
            include_once 'functions/update/updateCityByZona1.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateCityByZona1($post['zona1']);
            break;
        
        case 'updateCityByZona2':
            authUpdate();
            debug('I am inside the post method updateCityByZona2 <br>');
            include_once 'functions/update/updateCityByZona2.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateCityByZona2($post['zona2']);
            break;
        
        case 'updateCityByZona3':
            authUpdate();
            debug('I am inside the post method updateCityByZona3 <br>');
            include_once 'functions/update/updateCityByZona3.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateCityByZona3($post['zona3']);
            break;
        
        case 'updateCityByZona4':
            authUpdate();
            debug('I am inside the post method updateCityByZona4 <br>');
            include_once 'functions/update/updateCityByZona4.php';
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateCityByZona4($post['zona4']);
            break;
        
        case 'updateRolById':
            authUpdate();
            debug('I am inside the post method updateRolById <br>');
            include_once 'functions/update/updateRolById.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateRolById($post['id']);
            break;
        
        case 'updateRolByUsername':
            authUpdate();
            debug('I am inside the post method updateRolByUsername <br>');
            include_once 'functions/update/updateRolByUsername.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateRolByUsername($post['username']);
            break;
        
        case 'updateRolByFirstName':
            authUpdate();
            debug('I am inside the post method updateRolByFirstName <br>');
            include_once 'functions/update/updateRolByFirstName.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateRolByFirstName($post['firstName']);
            break;
        
        case 'updateRolByLastName':
            authUpdate();
            debug('I am inside the post method updateRolByLastName <br>');
            include_once 'functions/update/updateRolByLastName.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateRolByLastName($post['lastName']);
            break;
        
        case 'updateRolByEmail':
            authUpdate();
            debug('I am inside the post method updateRolByEmail <br>');
            include_once 'functions/update/updateRolByEmail.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateRolByEmail($post['email']);
            break;
        
        case 'updateRolByPassword':
            authUpdate();
            debug('I am inside the post method updateRolByPassword <br>');
            include_once 'functions/update/updateRolByPassword.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateRolByPassword($post['password']);
            break;
        
        case 'updateRolByPhone':
            authUpdate();
            debug('I am inside the post method updateRolByPhone <br>');
            include_once 'functions/update/updateRolByPhone.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateRolByPhone($post['phone']);
            break;
        
        case 'updateRolByCountry':
            authUpdate();
            debug('I am inside the post method updateRolByCountry <br>');
            include_once 'functions/update/updateRolByCountry.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateRolByCountry($post['country']);
            break;
        
        case 'updateRolByState':
            authUpdate();
            debug('I am inside the post method updateRolByState <br>');
            include_once 'functions/update/updateRolByState.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateRolByState($post['state']);
            break;
        
        case 'updateRolByCity':
            authUpdate();
            debug('I am inside the post method updateRolByCity <br>');
            include_once 'functions/update/updateRolByCity.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateRolByCity($post['city']);
            break;
        
        case 'updateRolByKyc':
            authUpdate();
            debug('I am inside the post method updateRolByKyc <br>');
            include_once 'functions/update/updateRolByKyc.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateRolByKyc($post['kyc']);
            break;
        
        case 'updateRolByTarjeta':
            authUpdate();
            debug('I am inside the post method updateRolByTarjeta <br>');
            include_once 'functions/update/updateRolByTarjeta.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateRolByTarjeta($post['tarjeta']);
            break;
        
        case 'updateRolByCuenta':
            authUpdate();
            debug('I am inside the post method updateRolByCuenta <br>');
            include_once 'functions/update/updateRolByCuenta.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateRolByCuenta($post['cuenta']);
            break;
        
        case 'updateRolByAdmin':
            authUpdate();
            debug('I am inside the post method updateRolByAdmin <br>');
            include_once 'functions/update/updateRolByAdmin.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateRolByAdmin($post['admin']);
            break;
        
        case 'updateRolByPriceKm':
            authUpdate();
            debug('I am inside the post method updateRolByPriceKm <br>');
            include_once 'functions/update/updateRolByPriceKm.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateRolByPriceKm($post['priceKm']);
            break;
        
        case 'updateRolByZona1':
            authUpdate();
            debug('I am inside the post method updateRolByZona1 <br>');
            include_once 'functions/update/updateRolByZona1.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateRolByZona1($post['zona1']);
            break;
        
        case 'updateRolByZona2':
            authUpdate();
            debug('I am inside the post method updateRolByZona2 <br>');
            include_once 'functions/update/updateRolByZona2.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateRolByZona2($post['zona2']);
            break;
        
        case 'updateRolByZona3':
            authUpdate();
            debug('I am inside the post method updateRolByZona3 <br>');
            include_once 'functions/update/updateRolByZona3.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateRolByZona3($post['zona3']);
            break;
        
        case 'updateRolByZona4':
            authUpdate();
            debug('I am inside the post method updateRolByZona4 <br>');
            include_once 'functions/update/updateRolByZona4.php';
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateRolByZona4($post['zona4']);
            break;
        
        case 'updateKycById':
            authUpdate();
            debug('I am inside the post method updateKycById <br>');
            include_once 'functions/update/updateKycById.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateKycById($post['id']);
            break;
        
        case 'updateKycByUsername':
            authUpdate();
            debug('I am inside the post method updateKycByUsername <br>');
            include_once 'functions/update/updateKycByUsername.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateKycByUsername($post['username']);
            break;
        
        case 'updateKycByFirstName':
            authUpdate();
            debug('I am inside the post method updateKycByFirstName <br>');
            include_once 'functions/update/updateKycByFirstName.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateKycByFirstName($post['firstName']);
            break;
        
        case 'updateKycByLastName':
            authUpdate();
            debug('I am inside the post method updateKycByLastName <br>');
            include_once 'functions/update/updateKycByLastName.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateKycByLastName($post['lastName']);
            break;
        
        case 'updateKycByEmail':
            authUpdate();
            debug('I am inside the post method updateKycByEmail <br>');
            include_once 'functions/update/updateKycByEmail.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateKycByEmail($post['email']);
            break;
        
        case 'updateKycByPassword':
            authUpdate();
            debug('I am inside the post method updateKycByPassword <br>');
            include_once 'functions/update/updateKycByPassword.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateKycByPassword($post['password']);
            break;
        
        case 'updateKycByPhone':
            authUpdate();
            debug('I am inside the post method updateKycByPhone <br>');
            include_once 'functions/update/updateKycByPhone.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateKycByPhone($post['phone']);
            break;
        
        case 'updateKycByCountry':
            authUpdate();
            debug('I am inside the post method updateKycByCountry <br>');
            include_once 'functions/update/updateKycByCountry.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateKycByCountry($post['country']);
            break;
        
        case 'updateKycByState':
            authUpdate();
            debug('I am inside the post method updateKycByState <br>');
            include_once 'functions/update/updateKycByState.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateKycByState($post['state']);
            break;
        
        case 'updateKycByCity':
            authUpdate();
            debug('I am inside the post method updateKycByCity <br>');
            include_once 'functions/update/updateKycByCity.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateKycByCity($post['city']);
            break;
        
        case 'updateKycByRol':
            authUpdate();
            debug('I am inside the post method updateKycByRol <br>');
            include_once 'functions/update/updateKycByRol.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateKycByRol($post['rol']);
            break;
        
        case 'updateKycByTarjeta':
            authUpdate();
            debug('I am inside the post method updateKycByTarjeta <br>');
            include_once 'functions/update/updateKycByTarjeta.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateKycByTarjeta($post['tarjeta']);
            break;
        
        case 'updateKycByCuenta':
            authUpdate();
            debug('I am inside the post method updateKycByCuenta <br>');
            include_once 'functions/update/updateKycByCuenta.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateKycByCuenta($post['cuenta']);
            break;
        
        case 'updateKycByAdmin':
            authUpdate();
            debug('I am inside the post method updateKycByAdmin <br>');
            include_once 'functions/update/updateKycByAdmin.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateKycByAdmin($post['admin']);
            break;
        
        case 'updateKycByPriceKm':
            authUpdate();
            debug('I am inside the post method updateKycByPriceKm <br>');
            include_once 'functions/update/updateKycByPriceKm.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateKycByPriceKm($post['priceKm']);
            break;
        
        case 'updateKycByZona1':
            authUpdate();
            debug('I am inside the post method updateKycByZona1 <br>');
            include_once 'functions/update/updateKycByZona1.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateKycByZona1($post['zona1']);
            break;
        
        case 'updateKycByZona2':
            authUpdate();
            debug('I am inside the post method updateKycByZona2 <br>');
            include_once 'functions/update/updateKycByZona2.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateKycByZona2($post['zona2']);
            break;
        
        case 'updateKycByZona3':
            authUpdate();
            debug('I am inside the post method updateKycByZona3 <br>');
            include_once 'functions/update/updateKycByZona3.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateKycByZona3($post['zona3']);
            break;
        
        case 'updateKycByZona4':
            authUpdate();
            debug('I am inside the post method updateKycByZona4 <br>');
            include_once 'functions/update/updateKycByZona4.php';
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateKycByZona4($post['zona4']);
            break;
        
        case 'updateTarjetaById':
            authUpdate();
            debug('I am inside the post method updateTarjetaById <br>');
            include_once 'functions/update/updateTarjetaById.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateTarjetaById($post['id']);
            break;
        
        case 'updateTarjetaByUsername':
            authUpdate();
            debug('I am inside the post method updateTarjetaByUsername <br>');
            include_once 'functions/update/updateTarjetaByUsername.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateTarjetaByUsername($post['username']);
            break;
        
        case 'updateTarjetaByFirstName':
            authUpdate();
            debug('I am inside the post method updateTarjetaByFirstName <br>');
            include_once 'functions/update/updateTarjetaByFirstName.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateTarjetaByFirstName($post['firstName']);
            break;
        
        case 'updateTarjetaByLastName':
            authUpdate();
            debug('I am inside the post method updateTarjetaByLastName <br>');
            include_once 'functions/update/updateTarjetaByLastName.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateTarjetaByLastName($post['lastName']);
            break;
        
        case 'updateTarjetaByEmail':
            authUpdate();
            debug('I am inside the post method updateTarjetaByEmail <br>');
            include_once 'functions/update/updateTarjetaByEmail.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateTarjetaByEmail($post['email']);
            break;
        
        case 'updateTarjetaByPassword':
            authUpdate();
            debug('I am inside the post method updateTarjetaByPassword <br>');
            include_once 'functions/update/updateTarjetaByPassword.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateTarjetaByPassword($post['password']);
            break;
        
        case 'updateTarjetaByPhone':
            authUpdate();
            debug('I am inside the post method updateTarjetaByPhone <br>');
            include_once 'functions/update/updateTarjetaByPhone.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateTarjetaByPhone($post['phone']);
            break;
        
        case 'updateTarjetaByCountry':
            authUpdate();
            debug('I am inside the post method updateTarjetaByCountry <br>');
            include_once 'functions/update/updateTarjetaByCountry.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateTarjetaByCountry($post['country']);
            break;
        
        case 'updateTarjetaByState':
            authUpdate();
            debug('I am inside the post method updateTarjetaByState <br>');
            include_once 'functions/update/updateTarjetaByState.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateTarjetaByState($post['state']);
            break;
        
        case 'updateTarjetaByCity':
            authUpdate();
            debug('I am inside the post method updateTarjetaByCity <br>');
            include_once 'functions/update/updateTarjetaByCity.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateTarjetaByCity($post['city']);
            break;
        
        case 'updateTarjetaByRol':
            authUpdate();
            debug('I am inside the post method updateTarjetaByRol <br>');
            include_once 'functions/update/updateTarjetaByRol.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateTarjetaByRol($post['rol']);
            break;
        
        case 'updateTarjetaByKyc':
            authUpdate();
            debug('I am inside the post method updateTarjetaByKyc <br>');
            include_once 'functions/update/updateTarjetaByKyc.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateTarjetaByKyc($post['kyc']);
            break;
        
        case 'updateTarjetaByCuenta':
            authUpdate();
            debug('I am inside the post method updateTarjetaByCuenta <br>');
            include_once 'functions/update/updateTarjetaByCuenta.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateTarjetaByCuenta($post['cuenta']);
            break;
        
        case 'updateTarjetaByAdmin':
            authUpdate();
            debug('I am inside the post method updateTarjetaByAdmin <br>');
            include_once 'functions/update/updateTarjetaByAdmin.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateTarjetaByAdmin($post['admin']);
            break;
        
        case 'updateTarjetaByPriceKm':
            authUpdate();
            debug('I am inside the post method updateTarjetaByPriceKm <br>');
            include_once 'functions/update/updateTarjetaByPriceKm.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateTarjetaByPriceKm($post['priceKm']);
            break;
        
        case 'updateTarjetaByZona1':
            authUpdate();
            debug('I am inside the post method updateTarjetaByZona1 <br>');
            include_once 'functions/update/updateTarjetaByZona1.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateTarjetaByZona1($post['zona1']);
            break;
        
        case 'updateTarjetaByZona2':
            authUpdate();
            debug('I am inside the post method updateTarjetaByZona2 <br>');
            include_once 'functions/update/updateTarjetaByZona2.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateTarjetaByZona2($post['zona2']);
            break;
        
        case 'updateTarjetaByZona3':
            authUpdate();
            debug('I am inside the post method updateTarjetaByZona3 <br>');
            include_once 'functions/update/updateTarjetaByZona3.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateTarjetaByZona3($post['zona3']);
            break;
        
        case 'updateTarjetaByZona4':
            authUpdate();
            debug('I am inside the post method updateTarjetaByZona4 <br>');
            include_once 'functions/update/updateTarjetaByZona4.php';
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateTarjetaByZona4($post['zona4']);
            break;
        
        case 'updateCuentaById':
            authUpdate();
            debug('I am inside the post method updateCuentaById <br>');
            include_once 'functions/update/updateCuentaById.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateCuentaById($post['id']);
            break;
        
        case 'updateCuentaByUsername':
            authUpdate();
            debug('I am inside the post method updateCuentaByUsername <br>');
            include_once 'functions/update/updateCuentaByUsername.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateCuentaByUsername($post['username']);
            break;
        
        case 'updateCuentaByFirstName':
            authUpdate();
            debug('I am inside the post method updateCuentaByFirstName <br>');
            include_once 'functions/update/updateCuentaByFirstName.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateCuentaByFirstName($post['firstName']);
            break;
        
        case 'updateCuentaByLastName':
            authUpdate();
            debug('I am inside the post method updateCuentaByLastName <br>');
            include_once 'functions/update/updateCuentaByLastName.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateCuentaByLastName($post['lastName']);
            break;
        
        case 'updateCuentaByEmail':
            authUpdate();
            debug('I am inside the post method updateCuentaByEmail <br>');
            include_once 'functions/update/updateCuentaByEmail.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateCuentaByEmail($post['email']);
            break;
        
        case 'updateCuentaByPassword':
            authUpdate();
            debug('I am inside the post method updateCuentaByPassword <br>');
            include_once 'functions/update/updateCuentaByPassword.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateCuentaByPassword($post['password']);
            break;
        
        case 'updateCuentaByPhone':
            authUpdate();
            debug('I am inside the post method updateCuentaByPhone <br>');
            include_once 'functions/update/updateCuentaByPhone.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateCuentaByPhone($post['phone']);
            break;
        
        case 'updateCuentaByCountry':
            authUpdate();
            debug('I am inside the post method updateCuentaByCountry <br>');
            include_once 'functions/update/updateCuentaByCountry.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateCuentaByCountry($post['country']);
            break;
        
        case 'updateCuentaByState':
            authUpdate();
            debug('I am inside the post method updateCuentaByState <br>');
            include_once 'functions/update/updateCuentaByState.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateCuentaByState($post['state']);
            break;
        
        case 'updateCuentaByCity':
            authUpdate();
            debug('I am inside the post method updateCuentaByCity <br>');
            include_once 'functions/update/updateCuentaByCity.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateCuentaByCity($post['city']);
            break;
        
        case 'updateCuentaByRol':
            authUpdate();
            debug('I am inside the post method updateCuentaByRol <br>');
            include_once 'functions/update/updateCuentaByRol.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateCuentaByRol($post['rol']);
            break;
        
        case 'updateCuentaByKyc':
            authUpdate();
            debug('I am inside the post method updateCuentaByKyc <br>');
            include_once 'functions/update/updateCuentaByKyc.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateCuentaByKyc($post['kyc']);
            break;
        
        case 'updateCuentaByTarjeta':
            authUpdate();
            debug('I am inside the post method updateCuentaByTarjeta <br>');
            include_once 'functions/update/updateCuentaByTarjeta.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateCuentaByTarjeta($post['tarjeta']);
            break;
        
        case 'updateCuentaByAdmin':
            authUpdate();
            debug('I am inside the post method updateCuentaByAdmin <br>');
            include_once 'functions/update/updateCuentaByAdmin.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateCuentaByAdmin($post['admin']);
            break;
        
        case 'updateCuentaByPriceKm':
            authUpdate();
            debug('I am inside the post method updateCuentaByPriceKm <br>');
            include_once 'functions/update/updateCuentaByPriceKm.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateCuentaByPriceKm($post['priceKm']);
            break;
        
        case 'updateCuentaByZona1':
            authUpdate();
            debug('I am inside the post method updateCuentaByZona1 <br>');
            include_once 'functions/update/updateCuentaByZona1.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateCuentaByZona1($post['zona1']);
            break;
        
        case 'updateCuentaByZona2':
            authUpdate();
            debug('I am inside the post method updateCuentaByZona2 <br>');
            include_once 'functions/update/updateCuentaByZona2.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateCuentaByZona2($post['zona2']);
            break;
        
        case 'updateCuentaByZona3':
            authUpdate();
            debug('I am inside the post method updateCuentaByZona3 <br>');
            include_once 'functions/update/updateCuentaByZona3.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateCuentaByZona3($post['zona3']);
            break;
        
        case 'updateCuentaByZona4':
            authUpdate();
            debug('I am inside the post method updateCuentaByZona4 <br>');
            include_once 'functions/update/updateCuentaByZona4.php';
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateCuentaByZona4($post['zona4']);
            break;
        
        case 'updateAdminById':
            authUpdate();
            debug('I am inside the post method updateAdminById <br>');
            include_once 'functions/update/updateAdminById.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateAdminById($post['id']);
            break;
        
        case 'updateAdminByUsername':
            authUpdate();
            debug('I am inside the post method updateAdminByUsername <br>');
            include_once 'functions/update/updateAdminByUsername.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateAdminByUsername($post['username']);
            break;
        
        case 'updateAdminByFirstName':
            authUpdate();
            debug('I am inside the post method updateAdminByFirstName <br>');
            include_once 'functions/update/updateAdminByFirstName.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateAdminByFirstName($post['firstName']);
            break;
        
        case 'updateAdminByLastName':
            authUpdate();
            debug('I am inside the post method updateAdminByLastName <br>');
            include_once 'functions/update/updateAdminByLastName.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateAdminByLastName($post['lastName']);
            break;
        
        case 'updateAdminByEmail':
            authUpdate();
            debug('I am inside the post method updateAdminByEmail <br>');
            include_once 'functions/update/updateAdminByEmail.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateAdminByEmail($post['email']);
            break;
        
        case 'updateAdminByPassword':
            authUpdate();
            debug('I am inside the post method updateAdminByPassword <br>');
            include_once 'functions/update/updateAdminByPassword.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateAdminByPassword($post['password']);
            break;
        
        case 'updateAdminByPhone':
            authUpdate();
            debug('I am inside the post method updateAdminByPhone <br>');
            include_once 'functions/update/updateAdminByPhone.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateAdminByPhone($post['phone']);
            break;
        
        case 'updateAdminByCountry':
            authUpdate();
            debug('I am inside the post method updateAdminByCountry <br>');
            include_once 'functions/update/updateAdminByCountry.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateAdminByCountry($post['country']);
            break;
        
        case 'updateAdminByState':
            authUpdate();
            debug('I am inside the post method updateAdminByState <br>');
            include_once 'functions/update/updateAdminByState.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateAdminByState($post['state']);
            break;
        
        case 'updateAdminByCity':
            authUpdate();
            debug('I am inside the post method updateAdminByCity <br>');
            include_once 'functions/update/updateAdminByCity.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateAdminByCity($post['city']);
            break;
        
        case 'updateAdminByRol':
            authUpdate();
            debug('I am inside the post method updateAdminByRol <br>');
            include_once 'functions/update/updateAdminByRol.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateAdminByRol($post['rol']);
            break;
        
        case 'updateAdminByKyc':
            authUpdate();
            debug('I am inside the post method updateAdminByKyc <br>');
            include_once 'functions/update/updateAdminByKyc.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateAdminByKyc($post['kyc']);
            break;
        
        case 'updateAdminByTarjeta':
            authUpdate();
            debug('I am inside the post method updateAdminByTarjeta <br>');
            include_once 'functions/update/updateAdminByTarjeta.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateAdminByTarjeta($post['tarjeta']);
            break;
        
        case 'updateAdminByCuenta':
            authUpdate();
            debug('I am inside the post method updateAdminByCuenta <br>');
            include_once 'functions/update/updateAdminByCuenta.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateAdminByCuenta($post['cuenta']);
            break;
        
        case 'updateAdminByPriceKm':
            authUpdate();
            debug('I am inside the post method updateAdminByPriceKm <br>');
            include_once 'functions/update/updateAdminByPriceKm.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateAdminByPriceKm($post['priceKm']);
            break;
        
        case 'updateAdminByZona1':
            authUpdate();
            debug('I am inside the post method updateAdminByZona1 <br>');
            include_once 'functions/update/updateAdminByZona1.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateAdminByZona1($post['zona1']);
            break;
        
        case 'updateAdminByZona2':
            authUpdate();
            debug('I am inside the post method updateAdminByZona2 <br>');
            include_once 'functions/update/updateAdminByZona2.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateAdminByZona2($post['zona2']);
            break;
        
        case 'updateAdminByZona3':
            authUpdate();
            debug('I am inside the post method updateAdminByZona3 <br>');
            include_once 'functions/update/updateAdminByZona3.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateAdminByZona3($post['zona3']);
            break;
        
        case 'updateAdminByZona4':
            authUpdate();
            debug('I am inside the post method updateAdminByZona4 <br>');
            include_once 'functions/update/updateAdminByZona4.php';
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateAdminByZona4($post['zona4']);
            break;
        
        case 'updatePriceKmById':
            authUpdate();
            debug('I am inside the post method updatePriceKmById <br>');
            include_once 'functions/update/updatePriceKmById.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updatePriceKmById($post['id']);
            break;
        
        case 'updatePriceKmByUsername':
            authUpdate();
            debug('I am inside the post method updatePriceKmByUsername <br>');
            include_once 'functions/update/updatePriceKmByUsername.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updatePriceKmByUsername($post['username']);
            break;
        
        case 'updatePriceKmByFirstName':
            authUpdate();
            debug('I am inside the post method updatePriceKmByFirstName <br>');
            include_once 'functions/update/updatePriceKmByFirstName.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updatePriceKmByFirstName($post['firstName']);
            break;
        
        case 'updatePriceKmByLastName':
            authUpdate();
            debug('I am inside the post method updatePriceKmByLastName <br>');
            include_once 'functions/update/updatePriceKmByLastName.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updatePriceKmByLastName($post['lastName']);
            break;
        
        case 'updatePriceKmByEmail':
            authUpdate();
            debug('I am inside the post method updatePriceKmByEmail <br>');
            include_once 'functions/update/updatePriceKmByEmail.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updatePriceKmByEmail($post['email']);
            break;
        
        case 'updatePriceKmByPassword':
            authUpdate();
            debug('I am inside the post method updatePriceKmByPassword <br>');
            include_once 'functions/update/updatePriceKmByPassword.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updatePriceKmByPassword($post['password']);
            break;
        
        case 'updatePriceKmByPhone':
            authUpdate();
            debug('I am inside the post method updatePriceKmByPhone <br>');
            include_once 'functions/update/updatePriceKmByPhone.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updatePriceKmByPhone($post['phone']);
            break;
        
        case 'updatePriceKmByCountry':
            authUpdate();
            debug('I am inside the post method updatePriceKmByCountry <br>');
            include_once 'functions/update/updatePriceKmByCountry.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updatePriceKmByCountry($post['country']);
            break;
        
        case 'updatePriceKmByState':
            authUpdate();
            debug('I am inside the post method updatePriceKmByState <br>');
            include_once 'functions/update/updatePriceKmByState.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updatePriceKmByState($post['state']);
            break;
        
        case 'updatePriceKmByCity':
            authUpdate();
            debug('I am inside the post method updatePriceKmByCity <br>');
            include_once 'functions/update/updatePriceKmByCity.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updatePriceKmByCity($post['city']);
            break;
        
        case 'updatePriceKmByRol':
            authUpdate();
            debug('I am inside the post method updatePriceKmByRol <br>');
            include_once 'functions/update/updatePriceKmByRol.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updatePriceKmByRol($post['rol']);
            break;
        
        case 'updatePriceKmByKyc':
            authUpdate();
            debug('I am inside the post method updatePriceKmByKyc <br>');
            include_once 'functions/update/updatePriceKmByKyc.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updatePriceKmByKyc($post['kyc']);
            break;
        
        case 'updatePriceKmByTarjeta':
            authUpdate();
            debug('I am inside the post method updatePriceKmByTarjeta <br>');
            include_once 'functions/update/updatePriceKmByTarjeta.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updatePriceKmByTarjeta($post['tarjeta']);
            break;
        
        case 'updatePriceKmByCuenta':
            authUpdate();
            debug('I am inside the post method updatePriceKmByCuenta <br>');
            include_once 'functions/update/updatePriceKmByCuenta.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updatePriceKmByCuenta($post['cuenta']);
            break;
        
        case 'updatePriceKmByAdmin':
            authUpdate();
            debug('I am inside the post method updatePriceKmByAdmin <br>');
            include_once 'functions/update/updatePriceKmByAdmin.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updatePriceKmByAdmin($post['admin']);
            break;
        
        case 'updatePriceKmByZona1':
            authUpdate();
            debug('I am inside the post method updatePriceKmByZona1 <br>');
            include_once 'functions/update/updatePriceKmByZona1.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updatePriceKmByZona1($post['zona1']);
            break;
        
        case 'updatePriceKmByZona2':
            authUpdate();
            debug('I am inside the post method updatePriceKmByZona2 <br>');
            include_once 'functions/update/updatePriceKmByZona2.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updatePriceKmByZona2($post['zona2']);
            break;
        
        case 'updatePriceKmByZona3':
            authUpdate();
            debug('I am inside the post method updatePriceKmByZona3 <br>');
            include_once 'functions/update/updatePriceKmByZona3.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updatePriceKmByZona3($post['zona3']);
            break;
        
        case 'updatePriceKmByZona4':
            authUpdate();
            debug('I am inside the post method updatePriceKmByZona4 <br>');
            include_once 'functions/update/updatePriceKmByZona4.php';
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updatePriceKmByZona4($post['zona4']);
            break;
        
        case 'updateZona1ById':
            authUpdate();
            debug('I am inside the post method updateZona1ById <br>');
            include_once 'functions/update/updateZona1ById.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateZona1ById($post['id']);
            break;
        
        case 'updateZona1ByUsername':
            authUpdate();
            debug('I am inside the post method updateZona1ByUsername <br>');
            include_once 'functions/update/updateZona1ByUsername.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateZona1ByUsername($post['username']);
            break;
        
        case 'updateZona1ByFirstName':
            authUpdate();
            debug('I am inside the post method updateZona1ByFirstName <br>');
            include_once 'functions/update/updateZona1ByFirstName.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateZona1ByFirstName($post['firstName']);
            break;
        
        case 'updateZona1ByLastName':
            authUpdate();
            debug('I am inside the post method updateZona1ByLastName <br>');
            include_once 'functions/update/updateZona1ByLastName.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateZona1ByLastName($post['lastName']);
            break;
        
        case 'updateZona1ByEmail':
            authUpdate();
            debug('I am inside the post method updateZona1ByEmail <br>');
            include_once 'functions/update/updateZona1ByEmail.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateZona1ByEmail($post['email']);
            break;
        
        case 'updateZona1ByPassword':
            authUpdate();
            debug('I am inside the post method updateZona1ByPassword <br>');
            include_once 'functions/update/updateZona1ByPassword.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateZona1ByPassword($post['password']);
            break;
        
        case 'updateZona1ByPhone':
            authUpdate();
            debug('I am inside the post method updateZona1ByPhone <br>');
            include_once 'functions/update/updateZona1ByPhone.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateZona1ByPhone($post['phone']);
            break;
        
        case 'updateZona1ByCountry':
            authUpdate();
            debug('I am inside the post method updateZona1ByCountry <br>');
            include_once 'functions/update/updateZona1ByCountry.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateZona1ByCountry($post['country']);
            break;
        
        case 'updateZona1ByState':
            authUpdate();
            debug('I am inside the post method updateZona1ByState <br>');
            include_once 'functions/update/updateZona1ByState.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateZona1ByState($post['state']);
            break;
        
        case 'updateZona1ByCity':
            authUpdate();
            debug('I am inside the post method updateZona1ByCity <br>');
            include_once 'functions/update/updateZona1ByCity.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateZona1ByCity($post['city']);
            break;
        
        case 'updateZona1ByRol':
            authUpdate();
            debug('I am inside the post method updateZona1ByRol <br>');
            include_once 'functions/update/updateZona1ByRol.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateZona1ByRol($post['rol']);
            break;
        
        case 'updateZona1ByKyc':
            authUpdate();
            debug('I am inside the post method updateZona1ByKyc <br>');
            include_once 'functions/update/updateZona1ByKyc.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateZona1ByKyc($post['kyc']);
            break;
        
        case 'updateZona1ByTarjeta':
            authUpdate();
            debug('I am inside the post method updateZona1ByTarjeta <br>');
            include_once 'functions/update/updateZona1ByTarjeta.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateZona1ByTarjeta($post['tarjeta']);
            break;
        
        case 'updateZona1ByCuenta':
            authUpdate();
            debug('I am inside the post method updateZona1ByCuenta <br>');
            include_once 'functions/update/updateZona1ByCuenta.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateZona1ByCuenta($post['cuenta']);
            break;
        
        case 'updateZona1ByAdmin':
            authUpdate();
            debug('I am inside the post method updateZona1ByAdmin <br>');
            include_once 'functions/update/updateZona1ByAdmin.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateZona1ByAdmin($post['admin']);
            break;
        
        case 'updateZona1ByPriceKm':
            authUpdate();
            debug('I am inside the post method updateZona1ByPriceKm <br>');
            include_once 'functions/update/updateZona1ByPriceKm.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateZona1ByPriceKm($post['priceKm']);
            break;
        
        case 'updateZona1ByZona2':
            authUpdate();
            debug('I am inside the post method updateZona1ByZona2 <br>');
            include_once 'functions/update/updateZona1ByZona2.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateZona1ByZona2($post['zona2']);
            break;
        
        case 'updateZona1ByZona3':
            authUpdate();
            debug('I am inside the post method updateZona1ByZona3 <br>');
            include_once 'functions/update/updateZona1ByZona3.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateZona1ByZona3($post['zona3']);
            break;
        
        case 'updateZona1ByZona4':
            authUpdate();
            debug('I am inside the post method updateZona1ByZona4 <br>');
            include_once 'functions/update/updateZona1ByZona4.php';
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateZona1ByZona4($post['zona4']);
            break;
        
        case 'updateZona2ById':
            authUpdate();
            debug('I am inside the post method updateZona2ById <br>');
            include_once 'functions/update/updateZona2ById.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateZona2ById($post['id']);
            break;
        
        case 'updateZona2ByUsername':
            authUpdate();
            debug('I am inside the post method updateZona2ByUsername <br>');
            include_once 'functions/update/updateZona2ByUsername.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateZona2ByUsername($post['username']);
            break;
        
        case 'updateZona2ByFirstName':
            authUpdate();
            debug('I am inside the post method updateZona2ByFirstName <br>');
            include_once 'functions/update/updateZona2ByFirstName.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateZona2ByFirstName($post['firstName']);
            break;
        
        case 'updateZona2ByLastName':
            authUpdate();
            debug('I am inside the post method updateZona2ByLastName <br>');
            include_once 'functions/update/updateZona2ByLastName.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateZona2ByLastName($post['lastName']);
            break;
        
        case 'updateZona2ByEmail':
            authUpdate();
            debug('I am inside the post method updateZona2ByEmail <br>');
            include_once 'functions/update/updateZona2ByEmail.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateZona2ByEmail($post['email']);
            break;
        
        case 'updateZona2ByPassword':
            authUpdate();
            debug('I am inside the post method updateZona2ByPassword <br>');
            include_once 'functions/update/updateZona2ByPassword.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateZona2ByPassword($post['password']);
            break;
        
        case 'updateZona2ByPhone':
            authUpdate();
            debug('I am inside the post method updateZona2ByPhone <br>');
            include_once 'functions/update/updateZona2ByPhone.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateZona2ByPhone($post['phone']);
            break;
        
        case 'updateZona2ByCountry':
            authUpdate();
            debug('I am inside the post method updateZona2ByCountry <br>');
            include_once 'functions/update/updateZona2ByCountry.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateZona2ByCountry($post['country']);
            break;
        
        case 'updateZona2ByState':
            authUpdate();
            debug('I am inside the post method updateZona2ByState <br>');
            include_once 'functions/update/updateZona2ByState.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateZona2ByState($post['state']);
            break;
        
        case 'updateZona2ByCity':
            authUpdate();
            debug('I am inside the post method updateZona2ByCity <br>');
            include_once 'functions/update/updateZona2ByCity.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateZona2ByCity($post['city']);
            break;
        
        case 'updateZona2ByRol':
            authUpdate();
            debug('I am inside the post method updateZona2ByRol <br>');
            include_once 'functions/update/updateZona2ByRol.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateZona2ByRol($post['rol']);
            break;
        
        case 'updateZona2ByKyc':
            authUpdate();
            debug('I am inside the post method updateZona2ByKyc <br>');
            include_once 'functions/update/updateZona2ByKyc.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateZona2ByKyc($post['kyc']);
            break;
        
        case 'updateZona2ByTarjeta':
            authUpdate();
            debug('I am inside the post method updateZona2ByTarjeta <br>');
            include_once 'functions/update/updateZona2ByTarjeta.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateZona2ByTarjeta($post['tarjeta']);
            break;
        
        case 'updateZona2ByCuenta':
            authUpdate();
            debug('I am inside the post method updateZona2ByCuenta <br>');
            include_once 'functions/update/updateZona2ByCuenta.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateZona2ByCuenta($post['cuenta']);
            break;
        
        case 'updateZona2ByAdmin':
            authUpdate();
            debug('I am inside the post method updateZona2ByAdmin <br>');
            include_once 'functions/update/updateZona2ByAdmin.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateZona2ByAdmin($post['admin']);
            break;
        
        case 'updateZona2ByPriceKm':
            authUpdate();
            debug('I am inside the post method updateZona2ByPriceKm <br>');
            include_once 'functions/update/updateZona2ByPriceKm.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateZona2ByPriceKm($post['priceKm']);
            break;
        
        case 'updateZona2ByZona1':
            authUpdate();
            debug('I am inside the post method updateZona2ByZona1 <br>');
            include_once 'functions/update/updateZona2ByZona1.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateZona2ByZona1($post['zona1']);
            break;
        
        case 'updateZona2ByZona3':
            authUpdate();
            debug('I am inside the post method updateZona2ByZona3 <br>');
            include_once 'functions/update/updateZona2ByZona3.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateZona2ByZona3($post['zona3']);
            break;
        
        case 'updateZona2ByZona4':
            authUpdate();
            debug('I am inside the post method updateZona2ByZona4 <br>');
            include_once 'functions/update/updateZona2ByZona4.php';
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateZona2ByZona4($post['zona4']);
            break;
        
        case 'updateZona3ById':
            authUpdate();
            debug('I am inside the post method updateZona3ById <br>');
            include_once 'functions/update/updateZona3ById.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateZona3ById($post['id']);
            break;
        
        case 'updateZona3ByUsername':
            authUpdate();
            debug('I am inside the post method updateZona3ByUsername <br>');
            include_once 'functions/update/updateZona3ByUsername.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateZona3ByUsername($post['username']);
            break;
        
        case 'updateZona3ByFirstName':
            authUpdate();
            debug('I am inside the post method updateZona3ByFirstName <br>');
            include_once 'functions/update/updateZona3ByFirstName.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateZona3ByFirstName($post['firstName']);
            break;
        
        case 'updateZona3ByLastName':
            authUpdate();
            debug('I am inside the post method updateZona3ByLastName <br>');
            include_once 'functions/update/updateZona3ByLastName.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateZona3ByLastName($post['lastName']);
            break;
        
        case 'updateZona3ByEmail':
            authUpdate();
            debug('I am inside the post method updateZona3ByEmail <br>');
            include_once 'functions/update/updateZona3ByEmail.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateZona3ByEmail($post['email']);
            break;
        
        case 'updateZona3ByPassword':
            authUpdate();
            debug('I am inside the post method updateZona3ByPassword <br>');
            include_once 'functions/update/updateZona3ByPassword.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateZona3ByPassword($post['password']);
            break;
        
        case 'updateZona3ByPhone':
            authUpdate();
            debug('I am inside the post method updateZona3ByPhone <br>');
            include_once 'functions/update/updateZona3ByPhone.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateZona3ByPhone($post['phone']);
            break;
        
        case 'updateZona3ByCountry':
            authUpdate();
            debug('I am inside the post method updateZona3ByCountry <br>');
            include_once 'functions/update/updateZona3ByCountry.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateZona3ByCountry($post['country']);
            break;
        
        case 'updateZona3ByState':
            authUpdate();
            debug('I am inside the post method updateZona3ByState <br>');
            include_once 'functions/update/updateZona3ByState.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateZona3ByState($post['state']);
            break;
        
        case 'updateZona3ByCity':
            authUpdate();
            debug('I am inside the post method updateZona3ByCity <br>');
            include_once 'functions/update/updateZona3ByCity.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateZona3ByCity($post['city']);
            break;
        
        case 'updateZona3ByRol':
            authUpdate();
            debug('I am inside the post method updateZona3ByRol <br>');
            include_once 'functions/update/updateZona3ByRol.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateZona3ByRol($post['rol']);
            break;
        
        case 'updateZona3ByKyc':
            authUpdate();
            debug('I am inside the post method updateZona3ByKyc <br>');
            include_once 'functions/update/updateZona3ByKyc.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateZona3ByKyc($post['kyc']);
            break;
        
        case 'updateZona3ByTarjeta':
            authUpdate();
            debug('I am inside the post method updateZona3ByTarjeta <br>');
            include_once 'functions/update/updateZona3ByTarjeta.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateZona3ByTarjeta($post['tarjeta']);
            break;
        
        case 'updateZona3ByCuenta':
            authUpdate();
            debug('I am inside the post method updateZona3ByCuenta <br>');
            include_once 'functions/update/updateZona3ByCuenta.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateZona3ByCuenta($post['cuenta']);
            break;
        
        case 'updateZona3ByAdmin':
            authUpdate();
            debug('I am inside the post method updateZona3ByAdmin <br>');
            include_once 'functions/update/updateZona3ByAdmin.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateZona3ByAdmin($post['admin']);
            break;
        
        case 'updateZona3ByPriceKm':
            authUpdate();
            debug('I am inside the post method updateZona3ByPriceKm <br>');
            include_once 'functions/update/updateZona3ByPriceKm.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateZona3ByPriceKm($post['priceKm']);
            break;
        
        case 'updateZona3ByZona1':
            authUpdate();
            debug('I am inside the post method updateZona3ByZona1 <br>');
            include_once 'functions/update/updateZona3ByZona1.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateZona3ByZona1($post['zona1']);
            break;
        
        case 'updateZona3ByZona2':
            authUpdate();
            debug('I am inside the post method updateZona3ByZona2 <br>');
            include_once 'functions/update/updateZona3ByZona2.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateZona3ByZona2($post['zona2']);
            break;
        
        case 'updateZona3ByZona4':
            authUpdate();
            debug('I am inside the post method updateZona3ByZona4 <br>');
            include_once 'functions/update/updateZona3ByZona4.php';
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            $result = updateZona3ByZona4($post['zona4']);
            break;
        
        case 'updateZona4ById':
            authUpdate();
            debug('I am inside the post method updateZona4ById <br>');
            include_once 'functions/update/updateZona4ById.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['id'])) {
                $result['success'] = false;
                $result['msg'] = 'No id to update.';
                break;
            }
            $result = updateZona4ById($post['id']);
            break;
        
        case 'updateZona4ByUsername':
            authUpdate();
            debug('I am inside the post method updateZona4ByUsername <br>');
            include_once 'functions/update/updateZona4ByUsername.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['username'])) {
                $result['success'] = false;
                $result['msg'] = 'No username to update.';
                break;
            }
            $result = updateZona4ByUsername($post['username']);
            break;
        
        case 'updateZona4ByFirstName':
            authUpdate();
            debug('I am inside the post method updateZona4ByFirstName <br>');
            include_once 'functions/update/updateZona4ByFirstName.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['firstName'])) {
                $result['success'] = false;
                $result['msg'] = 'No firstName to update.';
                break;
            }
            $result = updateZona4ByFirstName($post['firstName']);
            break;
        
        case 'updateZona4ByLastName':
            authUpdate();
            debug('I am inside the post method updateZona4ByLastName <br>');
            include_once 'functions/update/updateZona4ByLastName.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['lastName'])) {
                $result['success'] = false;
                $result['msg'] = 'No lastName to update.';
                break;
            }
            $result = updateZona4ByLastName($post['lastName']);
            break;
        
        case 'updateZona4ByEmail':
            authUpdate();
            debug('I am inside the post method updateZona4ByEmail <br>');
            include_once 'functions/update/updateZona4ByEmail.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['email'])) {
                $result['success'] = false;
                $result['msg'] = 'No email to update.';
                break;
            }
            $result = updateZona4ByEmail($post['email']);
            break;
        
        case 'updateZona4ByPassword':
            authUpdate();
            debug('I am inside the post method updateZona4ByPassword <br>');
            include_once 'functions/update/updateZona4ByPassword.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['password'])) {
                $result['success'] = false;
                $result['msg'] = 'No password to update.';
                break;
            }
            $result = updateZona4ByPassword($post['password']);
            break;
        
        case 'updateZona4ByPhone':
            authUpdate();
            debug('I am inside the post method updateZona4ByPhone <br>');
            include_once 'functions/update/updateZona4ByPhone.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['phone'])) {
                $result['success'] = false;
                $result['msg'] = 'No phone to update.';
                break;
            }
            $result = updateZona4ByPhone($post['phone']);
            break;
        
        case 'updateZona4ByCountry':
            authUpdate();
            debug('I am inside the post method updateZona4ByCountry <br>');
            include_once 'functions/update/updateZona4ByCountry.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['country'])) {
                $result['success'] = false;
                $result['msg'] = 'No country to update.';
                break;
            }
            $result = updateZona4ByCountry($post['country']);
            break;
        
        case 'updateZona4ByState':
            authUpdate();
            debug('I am inside the post method updateZona4ByState <br>');
            include_once 'functions/update/updateZona4ByState.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['state'])) {
                $result['success'] = false;
                $result['msg'] = 'No state to update.';
                break;
            }
            $result = updateZona4ByState($post['state']);
            break;
        
        case 'updateZona4ByCity':
            authUpdate();
            debug('I am inside the post method updateZona4ByCity <br>');
            include_once 'functions/update/updateZona4ByCity.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['city'])) {
                $result['success'] = false;
                $result['msg'] = 'No city to update.';
                break;
            }
            $result = updateZona4ByCity($post['city']);
            break;
        
        case 'updateZona4ByRol':
            authUpdate();
            debug('I am inside the post method updateZona4ByRol <br>');
            include_once 'functions/update/updateZona4ByRol.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['rol'])) {
                $result['success'] = false;
                $result['msg'] = 'No rol to update.';
                break;
            }
            $result = updateZona4ByRol($post['rol']);
            break;
        
        case 'updateZona4ByKyc':
            authUpdate();
            debug('I am inside the post method updateZona4ByKyc <br>');
            include_once 'functions/update/updateZona4ByKyc.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['kyc'])) {
                $result['success'] = false;
                $result['msg'] = 'No kyc to update.';
                break;
            }
            $result = updateZona4ByKyc($post['kyc']);
            break;
        
        case 'updateZona4ByTarjeta':
            authUpdate();
            debug('I am inside the post method updateZona4ByTarjeta <br>');
            include_once 'functions/update/updateZona4ByTarjeta.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['tarjeta'])) {
                $result['success'] = false;
                $result['msg'] = 'No tarjeta to update.';
                break;
            }
            $result = updateZona4ByTarjeta($post['tarjeta']);
            break;
        
        case 'updateZona4ByCuenta':
            authUpdate();
            debug('I am inside the post method updateZona4ByCuenta <br>');
            include_once 'functions/update/updateZona4ByCuenta.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['cuenta'])) {
                $result['success'] = false;
                $result['msg'] = 'No cuenta to update.';
                break;
            }
            $result = updateZona4ByCuenta($post['cuenta']);
            break;
        
        case 'updateZona4ByAdmin':
            authUpdate();
            debug('I am inside the post method updateZona4ByAdmin <br>');
            include_once 'functions/update/updateZona4ByAdmin.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['admin'])) {
                $result['success'] = false;
                $result['msg'] = 'No admin to update.';
                break;
            }
            $result = updateZona4ByAdmin($post['admin']);
            break;
        
        case 'updateZona4ByPriceKm':
            authUpdate();
            debug('I am inside the post method updateZona4ByPriceKm <br>');
            include_once 'functions/update/updateZona4ByPriceKm.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['priceKm'])) {
                $result['success'] = false;
                $result['msg'] = 'No priceKm to update.';
                break;
            }
            $result = updateZona4ByPriceKm($post['priceKm']);
            break;
        
        case 'updateZona4ByZona1':
            authUpdate();
            debug('I am inside the post method updateZona4ByZona1 <br>');
            include_once 'functions/update/updateZona4ByZona1.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['zona1'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona1 to update.';
                break;
            }
            $result = updateZona4ByZona1($post['zona1']);
            break;
        
        case 'updateZona4ByZona2':
            authUpdate();
            debug('I am inside the post method updateZona4ByZona2 <br>');
            include_once 'functions/update/updateZona4ByZona2.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['zona2'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona2 to update.';
                break;
            }
            $result = updateZona4ByZona2($post['zona2']);
            break;
        
        case 'updateZona4ByZona3':
            authUpdate();
            debug('I am inside the post method updateZona4ByZona3 <br>');
            include_once 'functions/update/updateZona4ByZona3.php';
            if(!isset($post['zona4'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona4 to update.';
                break;
            }
            if(!isset($post['zona3'])) {
                $result['success'] = false;
                $result['msg'] = 'No zona3 to update.';
                break;
            }
            $result = updateZona4ByZona3($post['zona3']);
            break;
        
        default:
            $result['success']=false;
            $result['msg']='No valid case selected';
            break;
    }
    return $result;
}

?>
    