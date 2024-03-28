
            <?php
            include_once 'configuracion.php';
                    /*!
                    * \brief    Admin identification
                    * \details  It checks if the rol variable of the $_SESSION array is loaded (this happens when logs in) and gives the option to log out. If the role does not exist, the links to login and register are sent.
                    */
                    session_start();
                    function rol0() {
                        if( isset($_SESSION['rol']) ) {
                            if ($_SESSION['rol'] > 2) {
                                $success['url'] = MYURL.'/api/v1/registers/functions/logout.php';
                                $success['success'] = true;
                                $success['msg'] = 'You are login';
                            }else {
                                $url=MYURL.'/api/v1/registers/functions/login.php';
                                //echo '<a href='".$url."'>Login <br></a>';
                                $success['success'] = false;
                                $success['msg'] = 'You do not have access';
                                debug( json_encode($success) );
                            }
                        }else {
                            //echo 'no tienes permiso';
                            $urlogin=MYURL.'/api/v1/registers/functions/login.php';
                            $success['success'] = false;
                            $success['msg'] = 'Please login if you have credentials';
                            debug( json_encode($success) );
                        }
                        return $success;
                    }
                    
                        function sesion1($id) {
                            if( isset($_SESSION['id']) ) {
                                if ($_SESSION['id'] == $id) {
                                    $success['url'] = MYURL.'/api/v1/registers/functions/logout.php';
                                    $success['success'] = true;
                                    $success['msg'] = 'You are login';
                                }else {
                                    $url=MYURL.'/api/v1/registers/functions/login.php';
                                    //echo '<a href='".$url."'>Login <br></a>';
                                    $success['success'] = false;
                                    $success['msg'] = 'You do not have access';
                                    debug( json_encode($success) );
                                }
                            }else {
                                //echo 'no tienes permiso';
                                $urlogin=MYURL.'/api/v1/registers/functions/login.php';
                                $success['success'] = false;
                                $success['msg'] = 'Please login if you have credentials';
                                debug( json_encode($success) );
                            }
                            return $success;
                        }
                        
        if( rol0()  == true ||  sesion1($id)  == true ) {
            $success['url'] = MYURL.'/api/v1/registers/functions/logout.php';
            $success['success'] = true;
            $success['msg'] = 'You are login';
        }else {
            $success['url']=MYURL.'/api/v1/registers/functions/login.php';
            //echo '<a href='".$url."'>Login <br></a>';
            $success['success'] = false;
            $success['msg'] = 'You do not have access';
            debug( json_encode($success) );
        }
        echo (json_encode($success));
        ?>