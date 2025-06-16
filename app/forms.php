<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form id="biba" action="forms.php" method="POST"> 
        <h1>TESTTESTTEST</h1>
        <!-- <input type="email" name="email" id="email" placeholder="Enter email here"'>
        <input type="password" name="pass" id="pass" placeholder="Enter email here" '>
        <input type="submit" value="Add"> -->
        <div>
            <input type="checkbox" name="php" id="php" /> 
            <span>php</span>
        </div>
        <div>
            <input type="checkbox" name="c++" id="c++" /> 
            <span>c++</span>
        </div>
        <div>
            <input type="checkbox" name="c" id="c" /> 
            <span>c</span>
        </div>
        <select name="select[]" id="select" multiple size='2'>
            <option value="1">1 val</option>
            <option value="2">2 val</option>
            <option value="3">3 val</option>
        </select>
        <input type='submit' value='Отправить' /> 
    </form>
    <?php
    echo '<pre>';
        print_r($_POST);
    echo '</pre>';
    // $errors = [];

    // if (!empty($_POST)) 
    // { 
    //     if (empty($_POST['email'])) {
    //         $errors['email'] = 'Email not added';
    //         exit ('Email not added');
    //     }
    //     if (empty($_POST['pass'])) {
    //         $errors['pass'] = 'Pass not added';
    //         exit ('pass not added');
    //     }

    //     if(empty($errors)){
    //         echo htmlspecialchars($_POST['email']) . PHP_EOL . htmlspecialchars($_POST['pass']);
    //         exit();
    //     };
    // }
    // if(!empty($errors)){
    //     foreach($errors as $val) {
    //         echo "<span style=\"color:red\">$err<br>"; 
    //     }
    // }
?>
</body>
</html>