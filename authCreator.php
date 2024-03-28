<?php
    /*functions
    createDirectory($directoryName)
    deleteDirectory($directory)
    createFileInDirectory($directory, $fileName)
    writeToFile($text, $fileName)
    moveDirectory($source, $destination)
    rmdirRecursive($directory)
    */
    include_once "./stdio.php";

    createAuthFiles($auths);

    echo "<br><br><a href='configCreator.php'>Go to config creator</a>";




    function divideString($input) {
        $pattern = '/([\w]+)([><=!]{1,2})([\w]+)/';
        preg_match($pattern, $input, $matches);
    
        if (count($matches) == 4) {
            return array(
                '0' => $matches[1],
                '1' => $matches[2],
                '2' => $matches[3]
            );
        }
    
        return $input;
    }



    function createAuthFiles($auths) {
        foreach($auths as $auth) {
            createFileInDirectory("api/v1", $auth[0].".php");
            createAuthContent($auth);
        }
    }

    function createAuthContent($auth) {
        $kinds = explode("|",$auth[1]);
        $condition = explode("|",$auth[2]);
        $i=0;
        //print_r($kinds);
        $name = array();
        $texto = "
            <?php
            include_once 'configuracion.php';";
        foreach($kinds as $kind) {
            //aca tiene cada uno de los tipos
            //echo "<br>\n";
            $conditionPart = divideString($condition[$i]);
            print_r($conditionPart);
            
            switch($kind) {
                case "rol":
                    $name[$i] = "function rol".$i."() {";
                    $texto .= "
                    /*!
                    * \brief    Admin identification
                    * \details  It checks if the ".$conditionPart[0]." variable of the \$_SESSION array is loaded (this happens when logs in) and gives the option to log out. If the role does not exist, the links to login and register are sent.
                    */
                    session_start();
                    ".$name[$i]."
                        if( isset(\$_SESSION['".$conditionPart[0]."']) ) {
                            if (\$_SESSION['".$conditionPart[0]."'] ".$conditionPart[1]." ".$conditionPart[2].") {
                                \$success['url'] = MYURL.'/api/v1/registers/functions/logout.php';
                                \$success['success'] = true;
                                \$success['msg'] = 'You are login';
                            }else {
                                \$url=MYURL.'/api/v1/registers/functions/login.php';
                                //echo '<a href='\".\$url.\"'>Login <br></a>';
                                \$success['success'] = false;
                                \$success['msg'] = 'You do not have access';
                                debug( json_encode(\$success) );
                            }
                        }else {
                            //echo 'no tienes permiso';
                            \$urlogin=MYURL.'/api/v1/registers/functions/login.php';
                            \$success['success'] = false;
                            \$success['msg'] = 'Please login if you have credentials';
                            debug( json_encode(\$success) );
                        }
                        return \$success;
                    }
                    ";
                    break;

                case "proc":
                    $name[$i] = "function proc".$i."() {";
                    $texto .= "
                    
/*!
* \brief    Verify the origin of the user.
* \details  If the user typed the URL and it doesn't come from our website, then we abort the connection.
*/
".$name[$i]."
    if(!isset(\$_SERVER['HTTP_REFERER']))
    {
        \$success['success'] = false;
        \$success['msg'] = 'You cannot access this page by typing the link in the browser directly.';
        //echo json_encode(\$success);
        //die;
    }
    else
    {
        // Get the hostname of the source page
        \$referrer_host = parse_url(\$_SERVER['HTTP_REFERER'], PHP_URL_HOST);

        // Get the hostname of the current page
        \$current_host = \$_SERVER['HTTP_HOST'];

        // Compare the hostname of the source page with the hostname of the current page
        if (\$referrer_host != \$current_host)
        {
            // If the host names are not the same, the page is being accessed from another domain
            \$success['success'] = false;
            \$success['msg'] = 'You cannot access this page from another page';
            //echo json_encode(\$success);
            //die;
        }
    }
}
                    ";
                    break;

                case "sesion":
                    $name[$i] = "function sesion".$i."($".$condition[$i].") {";
                        $texto .= "
                        ".$name[$i]."
                            if( isset(\$_SESSION['".$condition[$i]."']) ) {
                                if (\$_SESSION['".$condition[$i]."'] == $".$condition[$i].") {
                                    \$success['url'] = MYURL.'/api/v1/registers/functions/logout.php';
                                    \$success['success'] = true;
                                    \$success['msg'] = 'You are login';
                                }else {
                                    \$url=MYURL.'/api/v1/registers/functions/login.php';
                                    //echo '<a href='\".\$url.\"'>Login <br></a>';
                                    \$success['success'] = false;
                                    \$success['msg'] = 'You do not have access';
                                    debug( json_encode(\$success) );
                                }
                            }else {
                                //echo 'no tienes permiso';
                                \$urlogin=MYURL.'/api/v1/registers/functions/login.php';
                                \$success['success'] = false;
                                \$success['msg'] = 'Please login if you have credentials';
                                debug( json_encode(\$success) );
                            }
                            return \$success;
                        }
                        ";
                    break;
            }
            $i++;
        }


        $res = "";
        $j=0;
        foreach($name as $oneName) {
            $oneName = str_replace("{","",$oneName);
            if($j==0)
                $res .= str_replace("function","",$oneName)." == true ";
            else
                $res .= "|| ".str_replace("function","",$oneName)." == true ";
            $j++;
        }
        $texto .= "
        if(".$res.") {
            \$success['url'] = MYURL.'/api/v1/registers/functions/logout.php';
            \$success['success'] = true;
            \$success['msg'] = 'You are login';
        }else {
            \$success['url']=MYURL.'/api/v1/registers/functions/login.php';
            //echo '<a href='\".\$url.\"'>Login <br></a>';
            \$success['success'] = false;
            \$success['msg'] = 'You do not have access';
            debug( json_encode(\$success) );
        }
        echo (json_encode(\$success));
        ";


        $texto .= "?>";
        writeToFile($texto, "api/v1/".$auth[0].".php");
    }


?>