<option value=0 >не выбран</option>
<?php
require_once("Db.php");
$db8 = ConnectAsPDO();

// Если передано значение списка 1, подбираем значения для списка 2
if (isset($_GET['country'])) {
    if ($_GET['country'] != 0) {
      $result = $db8->prepare("SELECT * FROM city WHERE id_country=? ");
      $result->execute(array($_GET['country']));
    }
    else {
      $result = $db8->prepare("SELECT * FROM city ");
      $result->execute();
    }
}
else
    if (isset($_REQUEST['hotel'])) {
        if ($_REQUEST['hotel'] != 0) {
            // Имеем id списка 2, нужно получить id связанного с ним списка 1
            // и при выводе указать эту страну как selected
            $result = $db8->prepare("SELECT * FROM hotel WHERE id=? ");
            $result->execute(array($_REQUEST['hotel']));
            if ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
                $idCity = $row->id_city;
            }
        }
        $result = $db8->prepare("SELECT * FROM city ");
        $result->execute();
    }

while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
    if ($idCity==$row->id)
        echo "<option value=$row->id selected=\"selected\" >$row->name</option>";
    else
        echo "<option value=$row->id >$row->name</option>";
}
?>