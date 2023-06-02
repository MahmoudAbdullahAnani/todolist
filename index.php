<?php
date_default_timezone_set('Africa/Cairo');
include_once("./modile.php");
$error = '';
$titleValUpdate = '';
$detailsValUpdate = '';
$idValUpdate = '';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if ($_POST['title']==='') {
        $error = 'Enter the title idea!';
    }if ($_POST['mssg']==='') {
        $error = 'Enter the idea!';
    }else{
        $todolists  = new todolist();
        $date = date("Y/m/d H:i:s");
        $todolists->insert($_POST['title'],$_POST['mssg'], $date);
    }
}
if (isset($_GET)) {
    // if (isset($_GET['title'])) {
    //     $titleValUpdate = $_GET['title'];
    //     $detailsValUpdate = $_GET['details'];
    //     $idValUpdate = $_GET['id'];
    // }
    // if (isset($_GET['update'])) {
    //             $todolists  = new todolist();
    //     $date = date("Y/m/d H:i:s");
    //     $todolists->update($idValUpdate, $titleValUpdate, $detailsValUpdate, $date);
    // } 

    if (isset($_GET['delete'])) {
        $todolists  = new todolist();
        $todolists->delete($_GET['delete']);
        header("location: ./");
    }
}
function getData(){
    $todolists  = new todolist();
    $data = $todolists->select("*","1")->print();
    return $data;
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>
</head>

<body>
    <form method="post" style="width: 100; text-align: center;">
        <input value="<?=$titleValUpdate?>" type="text"
            style="width: 60%; padding: 7px; margin: 3px; border-radius: 6px;" placeholder="Enter title..."
            name="title">
        <input value="<?=$detailsValUpdate?>" type="text"
            style="width: 60%; padding: 7px; margin: 3px; border-radius: 6px;" placeholder="Enter details..."
            name="mssg">
        <div
            style="background-color: red; color:aliceblue;font-weight: 700;width: 60%; text-align: center;margin: 0 auto;">
            <?=$error?>
        </div>
        <br />
        <div style="display: flex; justify-content: center;">
            <!-- <a href="./?update&titleValUpdate=<?=$titleValUpdate?>&detailsValUpdate=<?=$detailsValUpdate?>"
                style="width: 60%;cursor: pointer;text-decoration: none; background-color: blue; font-weight: 700; color:antiquewhite">Update</a> -->
            <input type="submit"
                style="width: 60%;cursor: pointer; background-color: green; font-weight: 700; color:antiquewhite"
                value="Add">
            <!-- <a href="./?del"
                style="width: 60%;cursor: pointer;text-decoration: none; background-color: red; font-weight: 700; color:antiquewhite">Delete</a> -->
        </div>
    </form>
    <div>
        <?php 
            foreach (getData() as $key => $value) :
        ?>
        <hr />
        <ul>
            <li><?=$value['title']?></li>
            <li><?=$value['details']?></li>
            <li><?=$value['dateCreate']?></li>
            <div style="margin-top: 10px;">
                <a href="./?delete=<?=$value['id']?>"
                    style="background: red; color:aliceblue; font-weight: 700; border-radius: 10px; padding: 5px">Delete</a>
                <!-- <a href="./?id=<?=$value['id']?>&title=<?=$value['title']?>&details=<?=$value['details']?>"
                    style="background: blue; color:aliceblue; font-weight: 700; border-radius: 10px; padding: 5px">Update</a> -->
            </div>
        </ul>
        <?php endforeach;?>
    </div>
</body>

</html>
