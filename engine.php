<?php
    //system('stty -icanon');
    /*ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
    *///try {
        //echo "t";
        function openIt($dir) {
            //echo $dir."
//";
            if ($dir_handle = opendir($dir)) {
                while ($file = readdir($dir_handle)) {
                    if ($file != '.' && $file != '..') {
                        //echo $dir.'\\'.$file."
//";
                        if (is_dir($dir.'/'.$file)) {
                            echo $dir.'/'.$file."
";
                            openIt($dir.'/'.$file);
                           // echo "tq";
                        } elseif ($file != 'engine.php' && substr($file, -1) != '~') {
                            echo "Tr: $dir/$file
";
                            include $dir.'/'.$file;
                        }
                    }
                }
            }
        }
        echo "test";
        openIt('.');
 /*   } catch (Exception $e) {
        echo "Error: {$e->getMessage())}";
    }*/
    new Controllers\Controller();
