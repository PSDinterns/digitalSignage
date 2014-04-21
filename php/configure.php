<?php
    $uniqueid = '' . $_POST["location"] . '/' . $_POST["id"];
    $id = $_POST["id"];                      //rasp id number
    $location = $_POST["location"];          //school name
    $path = 'configurations/'. $uniqueid;    //rasp path
    $subpath = 'configurations/'. $location; //school path
    
    
    echo file_get_contents("header.txt", 'r');
    
    if (!($_POST['password'] == 'evil'))
    {
        die('<h4>Bad password!</h4><meta http-equiv="refresh" content="5;URL=http://localhost">');
    }
    
    
    if ($_POST['step'] == '1'){
    
    if (!file_exists('configurations/' . $uniqueid . '/log.txt'))
    {//make a new thing
        echo '<h4>Since what you specified is not does not exist here yet, this page is for a new rasphery pi configuration for use at <font color="red">'.$location.'</font> with id <font color="red">'.$id.'</font>. Please go <a href="javascript:history.back()">back</a> if this is incorrect.</h4>
        
        
        
        <input type="text" stype="border:none" name="date" style="width: 300px;border:none" placeHolder="'.date("l jS \of F Y h:i:s A").'" value="'.date("l jS \of F Y h:i:s A").'" required>
        
        <form action="configure.php" method="post">
        <!-- 1 -->
        1.<select  name="type1"  required>
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option1" placeHolder="URL of item"  required>
        
        <input type="text" style="border:none" name="time1" placeHolder="seconds to display" required>
        
        <br/>
        
        <!-- 2 -->
        2.<select name="type2">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option2" placeHolder="URL of item">
        <input type="text" style="border:none" name="time2" placeHolder="seconds to display">
        <br/>
        
        <!-- 3 -->
        3.<select name="type3">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option3" placeHolder="URL of item">
        <input type="text" style="border:none" name="time3" placeHolder="seconds to display">
        <br/>
        
        <!-- 4 -->
        4.<select name="type4">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option4" placeHolder="URL of item">
        <input type="text" style="border:none" name="time4" placeHolder="seconds to display">
        <br/>
        
        <!-- 5 -->
        5.<select name="type5">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option5" placeHolder="URL of item">
        <input type="text" style="border:none" name="time5" placeHolder="seconds to display">
        <br/>
        
        <!-- 6 -->
        6.<select name="type6">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option6" placeHolder="URL of item">
        <input type="text" style="border:none" name="time6" placeHolder="seconds to display">
        <br/>
        
        <!-- 7 -->
        7.<select name="type7">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option7" placeHolder="URL of item">
        <input type="text" style="border:none" name="time7" placeHolder="seconds to display">
        <br/>
        
        
        <!-- 8 -->
        8.<select name="type8">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option8" placeHolder="URL of item">
        <input type="text" style="border:none" name="time8" placeHolder="seconds to display">
        <br/>
        
        
        <!-- 9 -->
        9.<select name="type9">
        <option value="url">URL</option>
        <option value="youtube">Youtube</option>
        <option value="googleDocs">Google Docs</option>
        <option value="rss">RSS Feed</option>
        </select>
        <input type="text" style="border:none" name="option9" placeHolder="URL of item">
        <input type="text" style="border:none" name="time9" placeHolder="seconds to display">
        <br/>
        
       
        
        <textarea name="notes" style="border: none" rows="6" cols="83" placeHolder="Where is the rasphery pi located at? Also, is there anything else someone might need to know in the future?" required></textarea>
        <input type="hidden" name="step" value=2>
        
        
        <!-- forward previous values -->
        <input type="hidden" name="password" value=evil>
        <input type="hidden" name="location" value='.$location.'>
        <input type="hidden" name="id" value='.$id.'>
        <input type="submit">
        ';
        
        
    }else{//edit a thing
        //echo $_POST["step"];
        $log = $path .'/log.txt';
        echo '<h4>That rasphery pi at <font color="red">'.$location.'</font> with id <font color="red">'.$id.'</font> seems to already have been set up! Here'."'".'s how it is configured right now:</h4>';
        //todo: come up with a way to load saved configs that isn't a really bad idea
        
        
    }/*----------PHRASE-------------*/
    }elseif($_POST['step'] == '2')
    {
        echo '<pre style="word-wrap: break-word;"><code>';
        if(!is_dir($subpath) == '1')
        {
            echo 'Adding folder for location '.$location.'.<br/>';
            mkdir($subpath, 0700);
        }
        
        if(!is_dir($path) == '1')
        {
            echo 'Adding folder for id '.$id.' at '.$location.'.<br/>';
            mkdir($path, 0700);
        }
        
        if(is_file($path .'/index.html') == '1')
        {
            echo 'Removing old index.html';
            unlink($path .'/index.html');
        }


        echo '<h4>Wrote config file for pi '.$id.' at '.$location.'</h4>';
        file_put_contents($path .'/config.html', $config);
        file_put_contents($path .'/notes.txt', $_POST["notes"]);
        echo '<h4>Sucess! Redirecting to main page</h4>
        <meta http-equiv="refresh" content="10;URL=http://localhost">
        </pre></code>';
    }
    
    echo file_get_contents("footer.txt", 'r');
    ?>
