
            <?php
            include_once 'configuracion.php';
                        function sesion0($id) {
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
                        
        if( sesion0($id)  == true ) {
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