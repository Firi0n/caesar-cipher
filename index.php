<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cifrario-Cesare</title>
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
            if($isEncode){
                //If the character's ASCII code is greater than 128, then divide it by 128 and get the remainder
                $text[$i] = chr((ord($text[$i]) + $key)%128);
            //If the operation is decode, subtract the key from the character's ASCII code
            }else{
                //Subtract the key from the character's ASCII code
                $text[$i] = ord($text[$i]) - $key;
                //If the character's ASCII code is less than 0, then add 128 to it
                if($text[$i] < 0){
                    $text[$i] = 128 + $text[$i];
                }
                //Convert the ASCII code to a character
                $text[$i] = chr($text[$i]);
            }
        }
        //Join the array of characters into a string
        $text = implode($text);
    }
    ?>
    <h1>Cifrario di Cesare</h1>
    <form action="index.php" method="post">
        <select name="type">
            <option value="encode">Codifica</option>
            <option value="decode">Decodifica</option>
        </select>
        <input type="text" name="key" placeholder="Chiave di cifratura" maxlength="4" onkeydown="return /[0-9]|Backspace/i.test(event.key)" required>
        <textarea name="text" placeholder="Inserire il testo qui" required><?php echo $text; ?></textarea>
        <input type="submit" value="Esegui">
    </form>
</body>
</html>
