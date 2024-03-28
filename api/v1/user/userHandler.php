<?php

    include_once '../configuracion.php';
    
/*!
 * \brief      Handler for user.
 * \details    It has every function to interact with the user in the database (Create, read, update, delete)
 * \param      $id       (INT)    1 unique id for each user
 * \param      $username       (VARCHAR)   Unique username for users
 * \param      $firstName       (VARCHAR)   Users name
 * \param      $lastName       (VARCHAR)   Users lastname
 * \param      $email       (VARCHAR)    users email encoded by rsa
 * \param      $password       (VARCHAR)    users password by bcrypt
 * \param      $phone       (VARCHAR)    users phone encoded by rsa
 * \param      $country       (VARCHAR)   users location
 * \param      $state       (VARCHAR)   users location
 * \param      $city       (VARCHAR)   users location
 * \param      $rol       (INT)   worker / shop / normal user
 * \param      $kyc       (INT)   know the user
 * \param      $tarjeta       (VARCHAR)   card wallet
 * \param      $cuenta       (VARCHAR)   wallet in app
 * \param      $admin       (INT)   is it admin or a user
 * \param      $priceKm       (INT)   price by km for workers
 * \param      $zona1       (VARCHAR)   border to deliver (top left)
 * \param      $zona2       (VARCHAR)   border to deliver (top right)
 * \param      $zona3       (VARCHAR)   border to deliver  (bottom left)
 * \param      $zona4       (VARCHAR)   border to deliver  (bottom right
 */
class user
{
    
/*!
* \brief    PDO instance for the database
*/
    private $base;


    /*!
* \brief    (INT) 1 unique id for each user
*/
    private $id;

/*!
* \brief    (VARCHAR)Unique username for users
*/
    private $username;

/*!
* \brief    (VARCHAR)Users name
*/
    private $firstName;

/*!
* \brief    (VARCHAR)Users lastname
*/
    private $lastName;

/*!
* \brief    (VARCHAR) users email encoded by rsa
*/
    private $email;

/*!
* \brief    (VARCHAR) users password by bcrypt
*/
    private $password;

/*!
* \brief    (VARCHAR) users phone encoded by rsa
*/
    private $phone;

/*!
* \brief    (VARCHAR)users location
*/
    private $country;

/*!
* \brief    (VARCHAR)users location
*/
    private $state;

/*!
* \brief    (VARCHAR)users location
*/
    private $city;

/*!
* \brief    (INT)worker / shop / normal user
*/
    private $rol;

/*!
* \brief    (INT)know the user
*/
    private $kyc;

/*!
* \brief    (VARCHAR)card wallet
*/
    private $tarjeta;

/*!
* \brief    (VARCHAR)wallet in app
*/
    private $cuenta;

/*!
* \brief    (INT)is it admin or a user
*/
    private $admin;

/*!
* \brief    (INT)price by km for workers
*/
    private $priceKm;

/*!
* \brief    (VARCHAR)border to deliver (top left)
*/
    private $zona1;

/*!
* \brief    (VARCHAR)border to deliver (top right)
*/
    private $zona2;

/*!
* \brief    (VARCHAR)border to deliver  (bottom left)
*/
    private $zona3;

/*!
* \brief    (VARCHAR)border to deliver  (bottom right
*/
    private $zona4;


/*!
* \brief    Sets id for the caller instance.
* \details  The value received as a param is added to the id property of the instance of this class.
* \param $var    (INT) id I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_id($var) {
        $success=true;
        $this->id=$var;
        return $success;
    }



/*!
* \brief    Sets username for the caller instance.
* \details  The value received as a param is added to the username property of the instance of this class.
* \param $var    (VARCHAR) username I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_username($var) {
        $success=true;
        $this->username=$var;
        return $success;
    }



/*!
* \brief    Sets firstName for the caller instance.
* \details  The value received as a param is added to the firstName property of the instance of this class.
* \param $var    (VARCHAR) firstName I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_firstName($var) {
        $success=true;
        $this->firstName=$var;
        return $success;
    }



/*!
* \brief    Sets lastName for the caller instance.
* \details  The value received as a param is added to the lastName property of the instance of this class.
* \param $var    (VARCHAR) lastName I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_lastName($var) {
        $success=true;
        $this->lastName=$var;
        return $success;
    }



/*!
* \brief    Sets email for the caller instance.
* \details  The value received as a param is added to the email property of the instance of this class.
* \param $var    (VARCHAR) email I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_email($var) {
        $success=true;
        $this->email=$var;
        return $success;
    }



/*!
* \brief    Sets password for the caller instance.
* \details  The value received as a param is added to the password property of the instance of this class.
* \param $var    (VARCHAR) password I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_password($var) {
        $success=true;
        $this->password=$var;
        return $success;
    }



/*!
* \brief    Sets phone for the caller instance.
* \details  The value received as a param is added to the phone property of the instance of this class.
* \param $var    (VARCHAR) phone I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_phone($var) {
        $success=true;
        $this->phone=$var;
        return $success;
    }



/*!
* \brief    Sets country for the caller instance.
* \details  The value received as a param is added to the country property of the instance of this class.
* \param $var    (VARCHAR) country I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_country($var) {
        $success=true;
        $this->country=$var;
        return $success;
    }



/*!
* \brief    Sets state for the caller instance.
* \details  The value received as a param is added to the state property of the instance of this class.
* \param $var    (VARCHAR) state I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_state($var) {
        $success=true;
        $this->state=$var;
        return $success;
    }



/*!
* \brief    Sets city for the caller instance.
* \details  The value received as a param is added to the city property of the instance of this class.
* \param $var    (VARCHAR) city I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_city($var) {
        $success=true;
        $this->city=$var;
        return $success;
    }



/*!
* \brief    Sets rol for the caller instance.
* \details  The value received as a param is added to the rol property of the instance of this class.
* \param $var    (INT) rol I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_rol($var) {
        $success=true;
        $this->rol=$var;
        return $success;
    }



/*!
* \brief    Sets kyc for the caller instance.
* \details  The value received as a param is added to the kyc property of the instance of this class.
* \param $var    (INT) kyc I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_kyc($var) {
        $success=true;
        $this->kyc=$var;
        return $success;
    }



/*!
* \brief    Sets tarjeta for the caller instance.
* \details  The value received as a param is added to the tarjeta property of the instance of this class.
* \param $var    (VARCHAR) tarjeta I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_tarjeta($var) {
        $success=true;
        $this->tarjeta=$var;
        return $success;
    }



/*!
* \brief    Sets cuenta for the caller instance.
* \details  The value received as a param is added to the cuenta property of the instance of this class.
* \param $var    (VARCHAR) cuenta I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_cuenta($var) {
        $success=true;
        $this->cuenta=$var;
        return $success;
    }



/*!
* \brief    Sets admin for the caller instance.
* \details  The value received as a param is added to the admin property of the instance of this class.
* \param $var    (INT) admin I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_admin($var) {
        $success=true;
        $this->admin=$var;
        return $success;
    }



/*!
* \brief    Sets priceKm for the caller instance.
* \details  The value received as a param is added to the priceKm property of the instance of this class.
* \param $var    (INT) priceKm I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_priceKm($var) {
        $success=true;
        $this->priceKm=$var;
        return $success;
    }



/*!
* \brief    Sets zona1 for the caller instance.
* \details  The value received as a param is added to the zona1 property of the instance of this class.
* \param $var    (VARCHAR) zona1 I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_zona1($var) {
        $success=true;
        $this->zona1=$var;
        return $success;
    }



/*!
* \brief    Sets zona2 for the caller instance.
* \details  The value received as a param is added to the zona2 property of the instance of this class.
* \param $var    (VARCHAR) zona2 I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_zona2($var) {
        $success=true;
        $this->zona2=$var;
        return $success;
    }



/*!
* \brief    Sets zona3 for the caller instance.
* \details  The value received as a param is added to the zona3 property of the instance of this class.
* \param $var    (VARCHAR) zona3 I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_zona3($var) {
        $success=true;
        $this->zona3=$var;
        return $success;
    }



/*!
* \brief    Sets zona4 for the caller instance.
* \details  The value received as a param is added to the zona4 property of the instance of this class.
* \param $var    (VARCHAR) zona4 I want to set.
* \return   $success  (bool) returns true if this function is executed and false/undefined if it's not.
*/
    public function set_zona4($var) {
        $success=true;
        $this->zona4=$var;
        return $success;
    }



/*!
* \brief    Gets id for the caller instance.
* \details  The id property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->id  (INT) returns the id already set in the instance of this class.
*/
    public function get_id() {
        return($this->id);
    }



/*!
* \brief    Gets username for the caller instance.
* \details  The username property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->username  (VARCHAR) returns the username already set in the instance of this class.
*/
    public function get_username() {
        return($this->username);
    }



/*!
* \brief    Gets firstName for the caller instance.
* \details  The firstName property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->firstName  (VARCHAR) returns the firstName already set in the instance of this class.
*/
    public function get_firstName() {
        return($this->firstName);
    }



/*!
* \brief    Gets lastName for the caller instance.
* \details  The lastName property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->lastName  (VARCHAR) returns the lastName already set in the instance of this class.
*/
    public function get_lastName() {
        return($this->lastName);
    }



/*!
* \brief    Gets email for the caller instance.
* \details  The email property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->email  (VARCHAR) returns the email already set in the instance of this class.
*/
    public function get_email() {
        return($this->email);
    }



/*!
* \brief    Gets password for the caller instance.
* \details  The password property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->password  (VARCHAR) returns the password already set in the instance of this class.
*/
    public function get_password() {
        return($this->password);
    }



/*!
* \brief    Gets phone for the caller instance.
* \details  The phone property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->phone  (VARCHAR) returns the phone already set in the instance of this class.
*/
    public function get_phone() {
        return($this->phone);
    }



/*!
* \brief    Gets country for the caller instance.
* \details  The country property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->country  (VARCHAR) returns the country already set in the instance of this class.
*/
    public function get_country() {
        return($this->country);
    }



/*!
* \brief    Gets state for the caller instance.
* \details  The state property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->state  (VARCHAR) returns the state already set in the instance of this class.
*/
    public function get_state() {
        return($this->state);
    }



/*!
* \brief    Gets city for the caller instance.
* \details  The city property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->city  (VARCHAR) returns the city already set in the instance of this class.
*/
    public function get_city() {
        return($this->city);
    }



/*!
* \brief    Gets rol for the caller instance.
* \details  The rol property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->rol  (INT) returns the rol already set in the instance of this class.
*/
    public function get_rol() {
        return($this->rol);
    }



/*!
* \brief    Gets kyc for the caller instance.
* \details  The kyc property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->kyc  (INT) returns the kyc already set in the instance of this class.
*/
    public function get_kyc() {
        return($this->kyc);
    }



/*!
* \brief    Gets tarjeta for the caller instance.
* \details  The tarjeta property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->tarjeta  (VARCHAR) returns the tarjeta already set in the instance of this class.
*/
    public function get_tarjeta() {
        return($this->tarjeta);
    }



/*!
* \brief    Gets cuenta for the caller instance.
* \details  The cuenta property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->cuenta  (VARCHAR) returns the cuenta already set in the instance of this class.
*/
    public function get_cuenta() {
        return($this->cuenta);
    }



/*!
* \brief    Gets admin for the caller instance.
* \details  The admin property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->admin  (INT) returns the admin already set in the instance of this class.
*/
    public function get_admin() {
        return($this->admin);
    }



/*!
* \brief    Gets priceKm for the caller instance.
* \details  The priceKm property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->priceKm  (INT) returns the priceKm already set in the instance of this class.
*/
    public function get_priceKm() {
        return($this->priceKm);
    }



/*!
* \brief    Gets zona1 for the caller instance.
* \details  The zona1 property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->zona1  (VARCHAR) returns the zona1 already set in the instance of this class.
*/
    public function get_zona1() {
        return($this->zona1);
    }



/*!
* \brief    Gets zona2 for the caller instance.
* \details  The zona2 property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->zona2  (VARCHAR) returns the zona2 already set in the instance of this class.
*/
    public function get_zona2() {
        return($this->zona2);
    }



/*!
* \brief    Gets zona3 for the caller instance.
* \details  The zona3 property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->zona3  (VARCHAR) returns the zona3 already set in the instance of this class.
*/
    public function get_zona3() {
        return($this->zona3);
    }



/*!
* \brief    Gets zona4 for the caller instance.
* \details  The zona4 property of the instance in this class is returned.
* \param    (void) none param needed.
* \return   $this->zona4  (VARCHAR) returns the zona4 already set in the instance of this class.
*/
    public function get_zona4() {
        return($this->zona4);
    }



/*!
* \brief    Constructor function.
* \details  Turns on the Database and connect it.
* \param    (void) non param needed.
* \return   error  (void) Nothing is return really but if there is an error a message will be printed
*/
    public function __construct() {
        try
        {
            $this->base = new PDO('mysql:host=localhost; dbname='.DBNAME,DBUSER,DBPASSWD);
            $this->base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->base->exec('SET CHARACTER SET utf8');
        }
        catch (Exception $e) 
        {
            $success['success'] = false;
            $success['msg'] = $e->getMessage();
            echo json_encode($success);
        }
    }



/*!
* \brief    Add new data to the table.
* \details  Using PDO, htmlentities and addslashes, we insert the data contained in the instance of the callee class.
* \param    (void) non param needed.
* \return   $success  (bool) true if it has added the value, false in any other case.
*/
    public function insert() {
        //SQL query for insertion of the data saved in this instance
        $query='insert into user (id,username,firstName,lastName,email,password,phone,country,state,city,rol,kyc,tarjeta,cuenta,admin,priceKm,zona1,zona2,zona3,zona4) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
        $result= $this->base->prepare($query);

       $this->id =       htmlentities(addslashes($this->id));
       $this->username =       htmlentities(addslashes($this->username));
       $this->firstName =       htmlentities(addslashes($this->firstName));
       $this->lastName =       htmlentities(addslashes($this->lastName));
       $this->email =       htmlentities(addslashes($this->email));
       $this->password =       htmlentities(addslashes($this->password));
       $this->phone =       htmlentities(addslashes($this->phone));
       $this->country =       htmlentities(addslashes($this->country));
       $this->state =       htmlentities(addslashes($this->state));
       $this->city =       htmlentities(addslashes($this->city));
       $this->rol =       htmlentities(addslashes($this->rol));
       $this->kyc =       htmlentities(addslashes($this->kyc));
       $this->tarjeta =       htmlentities(addslashes($this->tarjeta));
       $this->cuenta =       htmlentities(addslashes($this->cuenta));
       $this->admin =       htmlentities(addslashes($this->admin));
       $this->priceKm =       htmlentities(addslashes($this->priceKm));
       $this->zona1 =       htmlentities(addslashes($this->zona1));
       $this->zona2 =       htmlentities(addslashes($this->zona2));
       $this->zona3 =       htmlentities(addslashes($this->zona3));
       $this->zona4 =       htmlentities(addslashes($this->zona4));

        $success = $result->execute(array($this->id,$this->username,$this->firstName,$this->lastName,$this->email,$this->password,$this->phone,$this->country,$this->state,$this->city,$this->rol,$this->kyc,$this->tarjeta,$this->cuenta,$this->admin,$this->priceKm,$this->zona1,$this->zona2,$this->zona3,$this->zona4)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update all column features by id.
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param $id    identifier used to find rows to change.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAllById($Id) {
        //SQL query for updating
        $query='update user set username=?, firstName=?, lastName=?, email=?, password=?, phone=?, country=?, state=?, city=?, rol=?, kyc=?, tarjeta=?, cuenta=?, admin=?, priceKm=?, zona1=?, zona2=?, zona3=?, zona4=? where id=?';
        $result= $this->base->prepare($query);

       $this->username =       htmlentities(addslashes($this->username));
       $this->firstName =       htmlentities(addslashes($this->firstName));
       $this->lastName =       htmlentities(addslashes($this->lastName));
       $this->email =       htmlentities(addslashes($this->email));
       $this->password =       htmlentities(addslashes($this->password));
       $this->phone =       htmlentities(addslashes($this->phone));
       $this->country =       htmlentities(addslashes($this->country));
       $this->state =       htmlentities(addslashes($this->state));
       $this->city =       htmlentities(addslashes($this->city));
       $this->rol =       htmlentities(addslashes($this->rol));
       $this->kyc =       htmlentities(addslashes($this->kyc));
       $this->tarjeta =       htmlentities(addslashes($this->tarjeta));
       $this->cuenta =       htmlentities(addslashes($this->cuenta));
       $this->admin =       htmlentities(addslashes($this->admin));
       $this->priceKm =       htmlentities(addslashes($this->priceKm));
       $this->zona1 =       htmlentities(addslashes($this->zona1));
       $this->zona2 =       htmlentities(addslashes($this->zona2));
       $this->zona3 =       htmlentities(addslashes($this->zona3));
       $this->zona4 =       htmlentities(addslashes($this->zona4));

        $success = $result->execute(array($this->username,$this->firstName,$this->lastName,$this->email,$this->password,$this->phone,$this->country,$this->state,$this->city,$this->rol,$this->kyc,$this->tarjeta,$this->cuenta,$this->admin,$this->priceKm,$this->zona1,$this->zona2,$this->zona3,$this->zona4, $this->id)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update all column features by username.
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param $username    identifier used to find rows to change.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAllByUsername($Username) {
        //SQL query for updating
        $query='update user set id=?, firstName=?, lastName=?, email=?, password=?, phone=?, country=?, state=?, city=?, rol=?, kyc=?, tarjeta=?, cuenta=?, admin=?, priceKm=?, zona1=?, zona2=?, zona3=?, zona4=? where username=?';
        $result= $this->base->prepare($query);

       $this->id =       htmlentities(addslashes($this->id));
       $this->username =       htmlentities(addslashes($this->username));
       $this->firstName =       htmlentities(addslashes($this->firstName));
       $this->lastName =       htmlentities(addslashes($this->lastName));
       $this->email =       htmlentities(addslashes($this->email));
       $this->password =       htmlentities(addslashes($this->password));
       $this->phone =       htmlentities(addslashes($this->phone));
       $this->country =       htmlentities(addslashes($this->country));
       $this->state =       htmlentities(addslashes($this->state));
       $this->city =       htmlentities(addslashes($this->city));
       $this->rol =       htmlentities(addslashes($this->rol));
       $this->kyc =       htmlentities(addslashes($this->kyc));
       $this->tarjeta =       htmlentities(addslashes($this->tarjeta));
       $this->cuenta =       htmlentities(addslashes($this->cuenta));
       $this->admin =       htmlentities(addslashes($this->admin));
       $this->priceKm =       htmlentities(addslashes($this->priceKm));
       $this->zona1 =       htmlentities(addslashes($this->zona1));
       $this->zona2 =       htmlentities(addslashes($this->zona2));
       $this->zona3 =       htmlentities(addslashes($this->zona3));
       $this->zona4 =       htmlentities(addslashes($this->zona4));

        $success = $result->execute(array($this->id,$this->firstName,$this->lastName,$this->email,$this->password,$this->phone,$this->country,$this->state,$this->city,$this->rol,$this->kyc,$this->tarjeta,$this->cuenta,$this->admin,$this->priceKm,$this->zona1,$this->zona2,$this->zona3,$this->zona4, $this->username)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update all column features by rol.
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param $rol    identifier used to find rows to change.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAllByRol($Rol) {
        //SQL query for updating
        $query='update user set id=?, username=?, firstName=?, lastName=?, email=?, password=?, phone=?, country=?, state=?, city=?, kyc=?, tarjeta=?, cuenta=?, admin=?, priceKm=?, zona1=?, zona2=?, zona3=?, zona4=? where rol=?';
        $result= $this->base->prepare($query);

       $this->id =       htmlentities(addslashes($this->id));
       $this->username =       htmlentities(addslashes($this->username));
       $this->firstName =       htmlentities(addslashes($this->firstName));
       $this->lastName =       htmlentities(addslashes($this->lastName));
       $this->email =       htmlentities(addslashes($this->email));
       $this->password =       htmlentities(addslashes($this->password));
       $this->phone =       htmlentities(addslashes($this->phone));
       $this->country =       htmlentities(addslashes($this->country));
       $this->state =       htmlentities(addslashes($this->state));
       $this->city =       htmlentities(addslashes($this->city));
       $this->rol =       htmlentities(addslashes($this->rol));
       $this->kyc =       htmlentities(addslashes($this->kyc));
       $this->tarjeta =       htmlentities(addslashes($this->tarjeta));
       $this->cuenta =       htmlentities(addslashes($this->cuenta));
       $this->admin =       htmlentities(addslashes($this->admin));
       $this->priceKm =       htmlentities(addslashes($this->priceKm));
       $this->zona1 =       htmlentities(addslashes($this->zona1));
       $this->zona2 =       htmlentities(addslashes($this->zona2));
       $this->zona3 =       htmlentities(addslashes($this->zona3));
       $this->zona4 =       htmlentities(addslashes($this->zona4));

        $success = $result->execute(array($this->id,$this->username,$this->firstName,$this->lastName,$this->email,$this->password,$this->phone,$this->country,$this->state,$this->city,$this->kyc,$this->tarjeta,$this->cuenta,$this->admin,$this->priceKm,$this->zona1,$this->zona2,$this->zona3,$this->zona4, $this->rol)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update all column features by kyc.
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param $kyc    identifier used to find rows to change.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAllByKyc($Kyc) {
        //SQL query for updating
        $query='update user set id=?, username=?, firstName=?, lastName=?, email=?, password=?, phone=?, country=?, state=?, city=?, rol=?, tarjeta=?, cuenta=?, admin=?, priceKm=?, zona1=?, zona2=?, zona3=?, zona4=? where kyc=?';
        $result= $this->base->prepare($query);

       $this->id =       htmlentities(addslashes($this->id));
       $this->username =       htmlentities(addslashes($this->username));
       $this->firstName =       htmlentities(addslashes($this->firstName));
       $this->lastName =       htmlentities(addslashes($this->lastName));
       $this->email =       htmlentities(addslashes($this->email));
       $this->password =       htmlentities(addslashes($this->password));
       $this->phone =       htmlentities(addslashes($this->phone));
       $this->country =       htmlentities(addslashes($this->country));
       $this->state =       htmlentities(addslashes($this->state));
       $this->city =       htmlentities(addslashes($this->city));
       $this->rol =       htmlentities(addslashes($this->rol));
       $this->kyc =       htmlentities(addslashes($this->kyc));
       $this->tarjeta =       htmlentities(addslashes($this->tarjeta));
       $this->cuenta =       htmlentities(addslashes($this->cuenta));
       $this->admin =       htmlentities(addslashes($this->admin));
       $this->priceKm =       htmlentities(addslashes($this->priceKm));
       $this->zona1 =       htmlentities(addslashes($this->zona1));
       $this->zona2 =       htmlentities(addslashes($this->zona2));
       $this->zona3 =       htmlentities(addslashes($this->zona3));
       $this->zona4 =       htmlentities(addslashes($this->zona4));

        $success = $result->execute(array($this->id,$this->username,$this->firstName,$this->lastName,$this->email,$this->password,$this->phone,$this->country,$this->state,$this->city,$this->rol,$this->tarjeta,$this->cuenta,$this->admin,$this->priceKm,$this->zona1,$this->zona2,$this->zona3,$this->zona4, $this->kyc)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update all column features by cuenta.
* \details  Using PDO, htmlentities and addslashes, we update the data contained in the instance of the callee class.
* \param $cuenta    identifier used to find rows to change.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAllByCuenta($Cuenta) {
        //SQL query for updating
        $query='update user set id=?, username=?, firstName=?, lastName=?, email=?, password=?, phone=?, country=?, state=?, city=?, rol=?, kyc=?, tarjeta=?, admin=?, priceKm=?, zona1=?, zona2=?, zona3=?, zona4=? where cuenta=?';
        $result= $this->base->prepare($query);

       $this->id =       htmlentities(addslashes($this->id));
       $this->username =       htmlentities(addslashes($this->username));
       $this->firstName =       htmlentities(addslashes($this->firstName));
       $this->lastName =       htmlentities(addslashes($this->lastName));
       $this->email =       htmlentities(addslashes($this->email));
       $this->password =       htmlentities(addslashes($this->password));
       $this->phone =       htmlentities(addslashes($this->phone));
       $this->country =       htmlentities(addslashes($this->country));
       $this->state =       htmlentities(addslashes($this->state));
       $this->city =       htmlentities(addslashes($this->city));
       $this->rol =       htmlentities(addslashes($this->rol));
       $this->kyc =       htmlentities(addslashes($this->kyc));
       $this->tarjeta =       htmlentities(addslashes($this->tarjeta));
       $this->cuenta =       htmlentities(addslashes($this->cuenta));
       $this->admin =       htmlentities(addslashes($this->admin));
       $this->priceKm =       htmlentities(addslashes($this->priceKm));
       $this->zona1 =       htmlentities(addslashes($this->zona1));
       $this->zona2 =       htmlentities(addslashes($this->zona2));
       $this->zona3 =       htmlentities(addslashes($this->zona3));
       $this->zona4 =       htmlentities(addslashes($this->zona4));

        $success = $result->execute(array($this->id,$this->username,$this->firstName,$this->lastName,$this->email,$this->password,$this->phone,$this->country,$this->state,$this->city,$this->rol,$this->kyc,$this->tarjeta,$this->admin,$this->priceKm,$this->zona1,$this->zona2,$this->zona3,$this->zona4, $this->cuenta)); 

        $result ->closeCursor();
            
        // I send success to handle mistakes
        return $success;
    
    }
    


/*!
* \brief    Update username by id.
* \details  Using PDO, htmlentities and addslashes, we update the username contained in the instance of the callee class.
* \param $id    identifier of the table we want to change username.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateUsernameById($id) {
        //SQL query for updating
        $query='update user set username=? where id=?'; 

        $this->username =          htmlentities(addslashes($this->username));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->username, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update firstName by id.
* \details  Using PDO, htmlentities and addslashes, we update the firstName contained in the instance of the callee class.
* \param $id    identifier of the table we want to change firstName.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateFirstNameById($id) {
        //SQL query for updating
        $query='update user set firstName=? where id=?'; 

        $this->firstName =          htmlentities(addslashes($this->firstName));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->firstName, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update lastName by id.
* \details  Using PDO, htmlentities and addslashes, we update the lastName contained in the instance of the callee class.
* \param $id    identifier of the table we want to change lastName.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateLastNameById($id) {
        //SQL query for updating
        $query='update user set lastName=? where id=?'; 

        $this->lastName =          htmlentities(addslashes($this->lastName));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->lastName, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update email by id.
* \details  Using PDO, htmlentities and addslashes, we update the email contained in the instance of the callee class.
* \param $id    identifier of the table we want to change email.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateEmailById($id) {
        //SQL query for updating
        $query='update user set email=? where id=?'; 

        $this->email =          htmlentities(addslashes($this->email));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->email, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update password by id.
* \details  Using PDO, htmlentities and addslashes, we update the password contained in the instance of the callee class.
* \param $id    identifier of the table we want to change password.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updatePasswordById($id) {
        //SQL query for updating
        $query='update user set password=? where id=?'; 

        $this->password =          htmlentities(addslashes($this->password));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->password, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update password by username.
* \details  Using PDO, htmlentities and addslashes, we update the password contained in the instance of the callee class.
* \param $username    identifier of the table we want to change password.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updatePasswordByUsername($username) {
        //SQL query for updating
        $query='update user set password=? where username=?'; 

        $this->password =          htmlentities(addslashes($this->password));
        $this->username =                   htmlentities(addslashes($username));
        
        $success = $resultado->execute(array($this->password, $this->username));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update phone by id.
* \details  Using PDO, htmlentities and addslashes, we update the phone contained in the instance of the callee class.
* \param $id    identifier of the table we want to change phone.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updatePhoneById($id) {
        //SQL query for updating
        $query='update user set phone=? where id=?'; 

        $this->phone =          htmlentities(addslashes($this->phone));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->phone, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update country by id.
* \details  Using PDO, htmlentities and addslashes, we update the country contained in the instance of the callee class.
* \param $id    identifier of the table we want to change country.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateCountryById($id) {
        //SQL query for updating
        $query='update user set country=? where id=?'; 

        $this->country =          htmlentities(addslashes($this->country));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->country, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update state by id.
* \details  Using PDO, htmlentities and addslashes, we update the state contained in the instance of the callee class.
* \param $id    identifier of the table we want to change state.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateStateById($id) {
        //SQL query for updating
        $query='update user set state=? where id=?'; 

        $this->state =          htmlentities(addslashes($this->state));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->state, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update city by id.
* \details  Using PDO, htmlentities and addslashes, we update the city contained in the instance of the callee class.
* \param $id    identifier of the table we want to change city.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateCityById($id) {
        //SQL query for updating
        $query='update user set city=? where id=?'; 

        $this->city =          htmlentities(addslashes($this->city));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->city, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update rol by id.
* \details  Using PDO, htmlentities and addslashes, we update the rol contained in the instance of the callee class.
* \param $id    identifier of the table we want to change rol.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateRolById($id) {
        //SQL query for updating
        $query='update user set rol=? where id=?'; 

        $this->rol =          htmlentities(addslashes($this->rol));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->rol, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update kyc by id.
* \details  Using PDO, htmlentities and addslashes, we update the kyc contained in the instance of the callee class.
* \param $id    identifier of the table we want to change kyc.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateKycById($id) {
        //SQL query for updating
        $query='update user set kyc=? where id=?'; 

        $this->kyc =          htmlentities(addslashes($this->kyc));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->kyc, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update tarjeta by id.
* \details  Using PDO, htmlentities and addslashes, we update the tarjeta contained in the instance of the callee class.
* \param $id    identifier of the table we want to change tarjeta.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateTarjetaById($id) {
        //SQL query for updating
        $query='update user set tarjeta=? where id=?'; 

        $this->tarjeta =          htmlentities(addslashes($this->tarjeta));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->tarjeta, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update cuenta by id.
* \details  Using PDO, htmlentities and addslashes, we update the cuenta contained in the instance of the callee class.
* \param $id    identifier of the table we want to change cuenta.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateCuentaById($id) {
        //SQL query for updating
        $query='update user set cuenta=? where id=?'; 

        $this->cuenta =          htmlentities(addslashes($this->cuenta));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->cuenta, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update admin by id.
* \details  Using PDO, htmlentities and addslashes, we update the admin contained in the instance of the callee class.
* \param $id    identifier of the table we want to change admin.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateAdminById($id) {
        //SQL query for updating
        $query='update user set admin=? where id=?'; 

        $this->admin =          htmlentities(addslashes($this->admin));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->admin, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update priceKm by id.
* \details  Using PDO, htmlentities and addslashes, we update the priceKm contained in the instance of the callee class.
* \param $id    identifier of the table we want to change priceKm.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updatePriceKmById($id) {
        //SQL query for updating
        $query='update user set priceKm=? where id=?'; 

        $this->priceKm =          htmlentities(addslashes($this->priceKm));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->priceKm, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update zona1 by id.
* \details  Using PDO, htmlentities and addslashes, we update the zona1 contained in the instance of the callee class.
* \param $id    identifier of the table we want to change zona1.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateZona1ById($id) {
        //SQL query for updating
        $query='update user set zona1=? where id=?'; 

        $this->zona1 =          htmlentities(addslashes($this->zona1));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->zona1, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update zona2 by id.
* \details  Using PDO, htmlentities and addslashes, we update the zona2 contained in the instance of the callee class.
* \param $id    identifier of the table we want to change zona2.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateZona2ById($id) {
        //SQL query for updating
        $query='update user set zona2=? where id=?'; 

        $this->zona2 =          htmlentities(addslashes($this->zona2));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->zona2, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update zona3 by id.
* \details  Using PDO, htmlentities and addslashes, we update the zona3 contained in the instance of the callee class.
* \param $id    identifier of the table we want to change zona3.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateZona3ById($id) {
        //SQL query for updating
        $query='update user set zona3=? where id=?'; 

        $this->zona3 =          htmlentities(addslashes($this->zona3));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->zona3, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Update zona4 by id.
* \details  Using PDO, htmlentities and addslashes, we update the zona4 contained in the instance of the callee class.
* \param $id    identifier of the table we want to change zona4.
* \return   $success  (bool) true if it has updated the value, false in any other case.
*/
    public function updateZona4ById($id) {
        //SQL query for updating
        $query='update user set zona4=? where id=?'; 

        $this->zona4 =          htmlentities(addslashes($this->zona4));
        $this->id =                   htmlentities(addslashes($id));
        
        $success = $resultado->execute(array($this->zona4, $this->id));
        $resultado ->closeCursor();

        // I send success to handle mistakes
        return $success;
    }
    


/*!
* \brief    Gets all the rows from the database 
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readAll() {
        $query='select * from user where 1';
        $result= $this->base->prepare($query);
        
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where id equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    id.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readId($id) {
        $query='select * from user where id=:id';
        $result= $this->base->prepare($query);
        
        $id=htmlentities(addslashes($id));
        $result->BindValue(':id',$id);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where username equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    username.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readUsername($username) {
        $query='select * from user where username=:username';
        $result= $this->base->prepare($query);
        
        $username=htmlentities(addslashes($username));
        $result->BindValue(':username',$username);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where firstName equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    firstName.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readFirstName($firstName) {
        $query='select * from user where firstName=:firstName';
        $result= $this->base->prepare($query);
        
        $firstName=htmlentities(addslashes($firstName));
        $result->BindValue(':firstName',$firstName);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where lastName equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    lastName.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readLastName($lastName) {
        $query='select * from user where lastName=:lastName';
        $result= $this->base->prepare($query);
        
        $lastName=htmlentities(addslashes($lastName));
        $result->BindValue(':lastName',$lastName);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where email equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    email.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readEmail($email) {
        $query='select * from user where email=:email';
        $result= $this->base->prepare($query);
        
        $email=htmlentities(addslashes($email));
        $result->BindValue(':email',$email);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where password equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    password.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readPassword($password) {
        $query='select * from user where password=:password';
        $result= $this->base->prepare($query);
        
        $password=htmlentities(addslashes($password));
        $result->BindValue(':password',$password);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where phone equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    phone.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readPhone($phone) {
        $query='select * from user where phone=:phone';
        $result= $this->base->prepare($query);
        
        $phone=htmlentities(addslashes($phone));
        $result->BindValue(':phone',$phone);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where country equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    country.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readCountry($country) {
        $query='select * from user where country=:country';
        $result= $this->base->prepare($query);
        
        $country=htmlentities(addslashes($country));
        $result->BindValue(':country',$country);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where state equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    state.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readState($state) {
        $query='select * from user where state=:state';
        $result= $this->base->prepare($query);
        
        $state=htmlentities(addslashes($state));
        $result->BindValue(':state',$state);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where city equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    city.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readCity($city) {
        $query='select * from user where city=:city';
        $result= $this->base->prepare($query);
        
        $city=htmlentities(addslashes($city));
        $result->BindValue(':city',$city);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where rol equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    rol.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readRol($rol) {
        $query='select * from user where rol=:rol';
        $result= $this->base->prepare($query);
        
        $rol=htmlentities(addslashes($rol));
        $result->BindValue(':rol',$rol);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where kyc equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    kyc.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readKyc($kyc) {
        $query='select * from user where kyc=:kyc';
        $result= $this->base->prepare($query);
        
        $kyc=htmlentities(addslashes($kyc));
        $result->BindValue(':kyc',$kyc);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where tarjeta equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    tarjeta.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readTarjeta($tarjeta) {
        $query='select * from user where tarjeta=:tarjeta';
        $result= $this->base->prepare($query);
        
        $tarjeta=htmlentities(addslashes($tarjeta));
        $result->BindValue(':tarjeta',$tarjeta);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where admin equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    admin.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readAdmin($admin) {
        $query='select * from user where admin=:admin';
        $result= $this->base->prepare($query);
        
        $admin=htmlentities(addslashes($admin));
        $result->BindValue(':admin',$admin);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where priceKm equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    priceKm.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readPriceKm($priceKm) {
        $query='select * from user where priceKm=:priceKm';
        $result= $this->base->prepare($query);
        
        $priceKm=htmlentities(addslashes($priceKm));
        $result->BindValue(':priceKm',$priceKm);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where zona1 equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    zona1.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readZona1($zona1) {
        $query='select * from user where zona1=:zona1';
        $result= $this->base->prepare($query);
        
        $zona1=htmlentities(addslashes($zona1));
        $result->BindValue(':zona1',$zona1);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where zona2 equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    zona2.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readZona2($zona2) {
        $query='select * from user where zona2=:zona2';
        $result= $this->base->prepare($query);
        
        $zona2=htmlentities(addslashes($zona2));
        $result->BindValue(':zona2',$zona2);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where zona3 equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    zona3.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readZona3($zona3) {
        $query='select * from user where zona3=:zona3';
        $result= $this->base->prepare($query);
        
        $zona3=htmlentities(addslashes($zona3));
        $result->BindValue(':zona3',$zona3);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Gets all the rows from the database where zona4 equals the param sent
* \details  By sql query using PDO, we get all the results of the database and send them as an array.
* \param    zona4.
* \return   $row  (array) all pairs of -id-username-firstName-lastName-email-password-phone-country-state-city-rol-kyc-tarjeta-cuenta-admin-priceKm-zona1-zona2-zona3-zona4 in the database.
*/    
    public function readZona4($zona4) {
        $query='select * from user where zona4=:zona4';
        $result= $this->base->prepare($query);
        
        $zona4=htmlentities(addslashes($zona4));
        $result->BindValue(':zona4',$zona4);
            
        $result->execute();
        $row=$result->fetchAll(PDO::FETCH_ASSOC);
        $result ->closeCursor();
        if(!empty($row)) {
            foreach($row as $news => &$user) {
                $user['id'] = stripslashes(html_entity_decode($user['id'])); 
                $user['username'] = stripslashes(html_entity_decode($user['username'])); 
                $user['firstName'] = stripslashes(html_entity_decode($user['firstName'])); 
                $user['lastName'] = stripslashes(html_entity_decode($user['lastName'])); 
                $user['email'] = stripslashes(html_entity_decode($user['email'])); 
                $user['password'] = stripslashes(html_entity_decode($user['password'])); 
                $user['phone'] = stripslashes(html_entity_decode($user['phone'])); 
                $user['country'] = stripslashes(html_entity_decode($user['country'])); 
                $user['state'] = stripslashes(html_entity_decode($user['state'])); 
                $user['city'] = stripslashes(html_entity_decode($user['city'])); 
                $user['rol'] = stripslashes(html_entity_decode($user['rol'])); 
                $user['kyc'] = stripslashes(html_entity_decode($user['kyc'])); 
                $user['tarjeta'] = stripslashes(html_entity_decode($user['tarjeta'])); 
                $user['cuenta'] = stripslashes(html_entity_decode($user['cuenta'])); 
                $user['admin'] = stripslashes(html_entity_decode($user['admin'])); 
                $user['priceKm'] = stripslashes(html_entity_decode($user['priceKm'])); 
                $user['zona1'] = stripslashes(html_entity_decode($user['zona1'])); 
                $user['zona2'] = stripslashes(html_entity_decode($user['zona2'])); 
                $user['zona3'] = stripslashes(html_entity_decode($user['zona3'])); 
                $user['zona4'] = stripslashes(html_entity_decode($user['zona4'])); 
            }
        }

        return $row;
    }


/*!
* \brief    Deletes all rows in the database
* \details  By sql query using PDO, we delete all.
* \param all    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteAll() {
        $query='delete from user where 1';
        $result= $this->base->prepare($query);
        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by id
* \details  By sql query using PDO, we delete all the results where the id matches.
* \param id    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteById($id) {
        $query='delete from user where id=:id';
        $result= $this->base->prepare($query);
        $id=htmlentities(addslashes($id));
        $result->BindValue(':id',$id);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by username
* \details  By sql query using PDO, we delete all the results where the username matches.
* \param username    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByUsername($username) {
        $query='delete from user where username=:username';
        $result= $this->base->prepare($query);
        $username=htmlentities(addslashes($username));
        $result->BindValue(':username',$username);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by country
* \details  By sql query using PDO, we delete all the results where the country matches.
* \param country    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByCountry($country) {
        $query='delete from user where country=:country';
        $result= $this->base->prepare($query);
        $country=htmlentities(addslashes($country));
        $result->BindValue(':country',$country);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by rol
* \details  By sql query using PDO, we delete all the results where the rol matches.
* \param rol    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByRol($rol) {
        $query='delete from user where rol=:rol';
        $result= $this->base->prepare($query);
        $rol=htmlentities(addslashes($rol));
        $result->BindValue(':rol',$rol);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by kyc
* \details  By sql query using PDO, we delete all the results where the kyc matches.
* \param kyc    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByKyc($kyc) {
        $query='delete from user where kyc=:kyc';
        $result= $this->base->prepare($query);
        $kyc=htmlentities(addslashes($kyc));
        $result->BindValue(':kyc',$kyc);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
* \brief    Deletes rows in the database by admin
* \details  By sql query using PDO, we delete all the results where the admin matches.
* \param admin    Identifier of what we want to erase from the database.
* \return   $success  (bool) true if it has deleted the row, false in any other case.
*/
    public function deleteByAdmin($admin) {
        $query='delete from user where admin=:admin';
        $result= $this->base->prepare($query);
        $admin=htmlentities(addslashes($admin));
        $result->BindValue(':admin',$admin);

        $success = $result->execute();
        $result ->closeCursor();
        return $success;
    }



/*!
 * \brief    Login verifier.
 * \details  Send username and password to the database and verify if the username exists. If so, check if the password matches. 
 * \param    $username The username to login.
 * \param    $password (string) The password of the user to login.
 * \return   False (bool) Returns false if the name does not exist or password does not match.
 * \return   $row (array) Returns the row if the password matches.
*/
    public function login($username, $password)
    {
        $query = 'select * from user where username=?';
        $result = $this->base->prepare($query);
        $result->execute(array($username));
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        if ($row) {
            $verifypass = password_verify($password, $row[0]['password']);
            if ($verifypass) {
                return $row[0];
            } else {
                return false;
            }
        }
        return $row;
    } 


    
}

?>