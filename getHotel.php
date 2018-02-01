<option value=0 >не выбран</option>
<?php
require_once("Db.php");
// Если передано поле 2, делаем отбор полей 3 связанных с полем 2
if (isset($_GET['city'])){
    $db8 = ConnectAsPDO();
    if ($_GET['city'] == 0) {
        $result = $db8->prepare("SELECT * FROM hotel ");
        $result->execute();
    }
    else {
        $result = $db8->prepare("SELECT * FROM hotel WHERE id_city=? ");
        $result->execute(array($_GET['city']));
    }
    
    while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
        echo "<option value=$row->id >$row->name</option>";
    }
} // Если передано поле 1, делаем отбор полей 3 связанных с каждым подходящим поляем 2
elseif ( isset($_REQUEST['country'])) {
    $db8 = ConnectAsPDO();
    // Поле 1 в положении "не выбрано"
    if ($_REQUEST['country'] == 0) {
        $result = $db8->prepare("SELECT * FROM hotel ");
        $result->execute();
    }
    else {
        $resultCity = $db8->prepare("SELECT * FROM city WHERE id_country=? ");
        $resultCity->execute(array($_REQUEST['country']));
        $db9 = ConnectAsPDO();
        while ($rowCity = $resultCity->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
            //rowCity->id;
            $resultHotel = $db9->prepare("SELECT * FROM hotel WHERE id_city=? ");
            $resultHotel->execute(array($rowCity->id));
            while ($row = $resultHotel->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
                echo "<option value=$row->id >$row->name</option>";
            }
        }
    }
    if (isset($result)) {
        while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
            echo "<option value=$row->id >$row->name</option>";
        }
    }
}
?>