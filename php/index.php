<?php
    echo file_get_contents("header.txt", 'r');

    echo '
    <h4>Select a rasphery pi:</h4>
    <form action="configure.php" method="post">
    
    <select name="location">
    <option value="Artondale">Artondale Elementary School</option>
    <option value="Discovery">Discovery Elementary School</option>
    <option value="Evergreen">Evergreen Elementary School</option>
    <option value="HarborHeights">Harbor Heights Elementary School</option>
    <option value="MinterCreek">Minter Creek Elementary School</option>
    <option value="Purdy">Purdy Elementary School</option>
    <option value="Vaughn">Vaughn Elementary School</option>
    <option value="Voyager">Voyager Elementary School</option>
    <option value="Goodman">Goodman Middle School</option>
    <option value="HarborRidge">Harbor Ridge Middle School</option>
    <option value="KeyPeninsula">Key Peninsula Middle School</option>
    <option value="Kopachuck">Kopachuck Middle School</option>
    <option value="GigHarbor">Gig Harbor High School</option>
    <option value="HendersonBay">Henderson Bay High School</option>
    <option value="Peninsula">Peninsula High School</option>
    <option value="Other">Other</option>
    </select>
    
    
    <input type="text" name="id" placeHolder="id # of rasphery pi" required>
    <input type="password" name="password" placeHolder="password" required>
    <input type="hidden" name="step" value=1>
    <input type="submit">
   </form>
    ';
    
    echo file_get_contents("footer.txt", 'r');
    ?>
