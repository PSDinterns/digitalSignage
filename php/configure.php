<?php
    $uniqueid = '' . $_POST["location"] . '/' . $_POST["id"];
    $id = $_POST["id"];                      //rasp id number
    $location = $_POST["location"];          //school name
    $path = 'configurations/'. $uniqueid;    //rasp path
    $subpath = 'configurations/'. $location; //school path
    $configpath = $path .'/config.html';
    $amoutofmagicalboxes = 5;                //amount of magical textfields
    $debug = 0;
    
    
    echo file_get_contents("header.txt", 'r');
    
    if (!($_POST['password'] == 'evil'))
    {
        die('<h4>Bad password!</h4><meta http-equiv="refresh" content="5;URL=http://localhost">');
    }
    
    $dir = 5;
    
    
    //finds the smallest available number and selects that (an id that does not already exist under that school)
    if ($_POST['id'] == '')
    {
        
        for ($dir = 1; $dir < 100; $dir++)
        {
            
            $dirtest = 'configurations/'. $_POST["location"] . '/' . $dir. '/';
            echo '<!--'.$dirtest.' already exists-->';
            if(!is_dir($dirtest))
            {
                echo '<!-- Smallest id found! '.$dir.'-->';
                $id = $dir;
                $isdir = 1;
                break;
            }
        }
        
    }
    
    
    
    if ($_POST['step'] == '1'){
    
    
    
    if (!file_exists('configurations/' . $uniqueid . '/config.html'))
    {//make a new id
        echo '<h4>This page is for a new configuration for a rasphery pi at <font color="red">'.$location.'</font> with id <font color="red">'.$id.'</font>. Please go <a href="javascript:history.back()">back</a> if this is incorrect.</h4>
        
        
        <form action="configure.php" method="post">
        <input type="text" stype="border:none" name="date" style="width: 300px;border:none" placeHolder="'.date("l jS \of F Y h:i:s A").'" value="'.date("l jS \of F Y h:i:s A").'" disabled>
        <br/>
        <center>
        ';
        
        
        ++$debug; //d1
        //echo $debug;
        
        
        
        //fixed pure idiocy of typing them out one by one
        //poops out a ton of form boxes
        //change amount of magical boxes var to adjust amount of boxes that come out
        for ($amt = 1; $amt <= $amoutofmagicalboxes; $amt++)
        {
            echo '
            <!-- '.$amt.' -->
            '.$amt.'.<select  name="dropdown'.$amt.'">
            <option value="url">URL</option>
            <option value="youtube">Youtube</option>
            <option value="googleDocs">Google Docs</option>
            <option value="rss">RSS Feed</option>
            </select>
            <input type="text" size="40" style="border:none" name="url'.$amt.'" placeHolder="URL of item">
            <input type="text" style="border:none" name="time'.$amt.'" placeHolder="Seconds to display">
            
            <br/>
            ';
        }
        
        echo '
        </center>
        <textarea name="notes" style="border: none" rows="6" cols="83" placeHolder="Describe the general location of the rasphery pi, such as how and where it is mounted and what display it is pluged into." required></textarea>
        
        <!-- /*tell php to jump to step 2*/ -->
        <input type="hidden" name="step" value=2>
        
        
        <!-- /*forward previous values*/ -->
        <input type="hidden" name="password" value=evil>
        <input type="hidden" name="location" value='.$location.'>
        <input type="hidden" name="id" value='.$id.'>
        <input type="submit">';
        
        echo file_get_contents("notes.txt", 'r');
        
    }else{//edit a thing
        
        ++$debug; //d1
        //echo $debug;
        
        //echo $_POST["step"];
        
        echo '<h4>That rasphery pi at <font color="red">'.$location.'</font> with id <font color="red">'.$id.'</font> seems to already have been set up! Here'."'".'s how it is configured right now:</h4>';
        //loads a file from /$config/$school/$id/config.html
        //and just pops it out here
        
        if (is_file($path .'/config.html') == '0')
           {
           echo '<h4>Failure to load configuration!</h4>';
           print_r(scandir($path));
           echo '<h4>Destory configuration and start over?</h4>';
           }else{
           echo file_get_contents($configpath, 'r');
           }
       // echo file_get_contents("notes.txt", 'r');
        
    }//makes folder structure required & generates configurations alongside jadoncode
    }elseif ($_POST['step'] == '2')
    {
        
        ++$debug;//d1
        //echo $debug;
        
        echo '<pre style="word-wrap: break-word;"><code>';
        
        //adds a folder for the school/location if it does not exist
        if (!is_dir($subpath) == '1')
        {
            echo 'Adding folder for location '.$location.'.<br/>';
            mkdir($subpath, 0700);
        }
        
        
        //If they leave the id box blank, just pick the smallest available number and use that instead
        if ($id == "")
        {
            $isdir = 0;
            for ($dir = 1; $isdir = 1; $dir++)
            {
                $dirtest = $_POST["location"] . '/' . $dir;
                if (!is_dir($dirtest) == '1')
                {
                    echo $dirtest .'is not a dir!';
                    $isdir=1;
                }
            }
        }
        
        //adds a folder for the pi if it does not exist
        if (!is_dir($path) == '1')
        {
            echo 'Adding folder for id '.$id.' at '.$location.'.<br/>';
            mkdir($path, 0700);
        }
        
        //waiting to use, index.html will be generated
        /*if (is_file($path .'/index.html') == '1')
        {
            echo 'Removing old index.html';
            unlink($path .'/index.html');
        }*/
        
        
        if (is_file($path .'/config.html') == '1')
        {
            echo 'Removing old config.html';
            unlink($path .'/config.html');
        }
        
        //start generateing congfig
        //generate a config to allow lazy loading from textfiles
        //this file is named configure.php
        $configdata = '<form action="configure.php" method="post"><input type="text" stype="border:none" name="date" style="width: 300px;border:none" placeHolder="'.date("l jS \of F Y h:i:s A").'" value="'.date("l jS \of F Y h:i:s A").'" disabled><br/>';
        
        ++$debug;//d2
        //echo $debug;
        
        
        for ($amt = 1; $amt <= $amoutofmagicalboxes; $amt++)
        {

            
            $configdata .= '
            <!-- '.$amt.' -->
            '.$amt.'.<select  name="dropdown'.$amt.'">
            ';
            
            $dropdownid = 'dropdown'.$amt;
            
            switch ($_POST[$dropdownid]){//the selected type (youtube, gdocs, whatever)
                case 'url':
                    $configdata .= '<option value="url" selected>URL</option>
                    <option value="youtube">Youtube</option>
                    <option value="googleDocs">Google Docs</option>
                    <option value="rss">RSS Feed</option>';
                    break;
                case 'youtube':
                    $configdata .= '<option value="url">URL</option>
                    <option value="youtube" selected>Youtube</option>
                    <option value="googleDocs">Google Docs</option>
                    <option value="rss">RSS Feed</option>';
                    break;
                case 'googleDocs':
                    $configdata .= '<option value="url">URL</option>
                    <option value="youtube">Youtube</option>
                    <option value="googleDocs" selected>Google Docs</option>
                    <option value="rss">RSS Feed</option>';
                    break;
                case 'rss':
                    $configdata .= '<option value="url">URL</option>
                    <option value="youtube">Youtube</option>
                    <option value="googleDocs">Google Docs</option>
                    <option value="rss" selected>RSS Feed</option>';
                    break;
            }
            
            $configdata .= '
            </select>
            <input type="text" size="40" style="border:none" name="url'.$amt.'" placeHolder="URL of item" value="'.$_POST["url".$amt].'">
            <input type="text" style="border:none" name="time'.$amt.'" placeHolder="Seconds to display" value="'.$_POST["time".$amt].'">
            <br/>
            ';
            
        }
        
        $configdata .='<textarea name="notes" style="border: none" rows="6" cols="83" placeHolder="Describe the general location of the rasphery pi, such as how and where it is mounted and what display it is plugged into." required>'.$_POST["notes"].'</textarea>
        
        
        <!-- /*tell php to jump to step 2 when you hit sumbit*/ -->
        <input type="hidden" name="step" value=2>
        
        <!-- /*forward previous values*/ -->
        <input type="hidden" name="password" value=evil>
        <input type="hidden" name="location" value='.$location.'>
        <input type="hidden" name="id" value='.$id.'>
        <input type="submit"></form>';
        
        ++$debug;
        //echo $debug;
        
        
        
        echo '<h4>Wrote config file for pi '.$id.' at '.$location.'</h4>';
        file_put_contents($path .'/config.html', $configdata);
        
        
        ++$debug;
        //echo $debug;
        
        echo '<h4>Sucess! Redirecting to main page</h4></pre></code><meta http-equiv="refresh" content="0;URL=http://localhost">';
    }
    
    echo file_get_contents("footer.txt", 'r');
    ?>
