<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>caesar-cipher</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <?php
    //Initialize variables
    $text = "";
    //Check if the form has been submitted
    if(isset($_POST["type"]) && isset($_POST["text"]) && isset($_POST["key"])){
        //Check if the operation is encode or decode
        $isEncode = $_POST["type"] == "encode";
        //Split the text into an array of characters
        $text = str_split($_POST["text"]);
        //Get the key
        $key = $_POST["key"];
        //Loop through the array of characters
        for($i = 0; $i < count($text); $i++){
            //If the operation is encode, add the key to the character's ASCII code
            $text[$i] = ord($text[$i]);
            //If char isn't between Ascii code 32 and 126 return error.
            if($text[$i] < 32 || $text[$i] > 126 ){
                //Error message
                $text = "Char number " . $text[$i]+1 . " isn't valid.";
                //Interrupt cycle
                break;
                //If is encode
            }else if($isEncode){
                //Sum the key to the character's ASCII code
                $text[$i] = $text[$i] + $key;
                //If the ASCII code is greater than 126
                if($text[$i] > 126){
                    //Divide the ASCII code by 126 and add the remainder to 32
                    $text[$i] = ($text[$i] % 126) + 32;
                }
                //If is decode
            }else{
                //Subtract the key to the character's ASCII code
                $text[$i] = $text[$i] - $key;
                //If the ASCII code is less than 32
                if($text[$i] < 32){
                    //Subtract the ASCII code from 32 and add the remainder to 126
                    $text[$i] = $text[$i] + 94;
                }
            }
            //Convert the ASCII code to a character
            $text[$i] = chr($text[$i]);
        }
        //Join the array of characters into a string
        $text = implode($text);
    }
    ?>
    <h1>Caesar Cipher</h1>
    <form action="index.php" method="post">
        <select name="type">
            <option value="encode">Encode</option>
            <option value="decode">Decode</option>
        </select>
        <input type="text" name="key" placeholder="encryption key" maxlength="4" onkeydown="return /[0-9]|Backspace/i.test(event.key)" required>
        <textarea name="text" placeholder="Enter text here" required><?php echo $text; ?></textarea>
        <input type="submit" value="Execute">
    </form>
</body>
</html>
