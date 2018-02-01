<option value=0 >не выбран</option>
<?php
require_once("Db.php");
$db8 = ConnectAsPDO();
// Если передано поле 2, делаем отбор поля 1 связанного с полем 2
if (isset($_GET['city'])) {
    if ($_GET['city'] != 0) {
        // Имеем id списка 2, нужно получить id связанного с ним списка 1
        // и при выводе указать эту страну как selected
        $result = $db8->prepare("SELECT * FROM city WHERE id=? ");
        $result->execute(array($_GET['city']));
        if ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
            $idCountry = $row->id_country;
        }
    }
    
}
// Если передано поле 3
else
    if (isset($_REQUEST['hotel'])) {
        if ($_REQUEST['hotel'] != 0) {
            // Имеем id списка 2, получаем id связанного с ним списка 1
            // и при выводе указать это значение списка 1 как selected
            $result = $db8->prepare("SELECT * FROM hotel WHERE id=? ");
            $result->execute(array($_REQUEST['hotel']));
            if ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
                $idCity = $row->id_city;
                // Получили id списка 2
                // Находим через связанное значение что выбрать в список 1
                $result = $db8->prepare("SELECT * FROM city WHERE id=? ");
                $result->execute(array($idCity));
                if ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
                    $idCountry = $row->id_country;
                }
            }
        }
    }
$result = $db8->prepare("SELECT * FROM country ");
$result->execute();
while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
    if ($idCountry==$row->id)
        echo "<option value=$row->id selected=\"selected\" >$row->name</option>";
    else
        echo "<option value=$row->id >$row->name</option>";
}
?>