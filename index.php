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
    $text = "";
    if(isset($_POST["type"]) && isset($_POST["text"]) && isset($_POST["key"])){
        $isEncode = $_POST["type"] == "encode";
        $text = str_split($_POST["text"]);
        $key = $_POST["key"];
        for($i = 0; $i < count($text); $i++){
            //$text[$i] = chr(ord($text[$i]) + ($isEncode ? $key : -$key));
            if($isEncode){
                $text[$i] = chr((ord($text[$i]) + $key)%128);
            }else{
                $text[$i] = ord($text[$i]) - $key;
                if($text[$i] < 0){
                    $text[$i] = 128 + $text[$i];
                }
                $text[$i] = chr($text[$i]);
            }
        }
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
