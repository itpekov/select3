<?php
require_once("Db.php");
/**
 * Get list 1
 */
function loadCountry($idCountry=0, $idCity=0, $idHotel=0){
    $countryString = "";
    $db8 = ConnectAsPDO();

    // Проверяем был ли указан Отель
    if ($idHotel != 0) {
        $result = $db8->prepare("SELECT * FROM hotel WHERE id=? ");
        $result->execute(array($idHotel));
        $row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT);
        $idCity = $row->id_city;
    }
    // Проверяем был ли указан Город
    if ($idCity != 0) {
        $result = $db8->prepare("SELECT id_country FROM city WHERE id=? ");
        $result->execute(array($idCity));
        while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
            $idCountry = $row->id_country;
        }
    }

    $result = $db8->prepare("SELECT * FROM country ");
    $result->execute();
    while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
        if ($idCountry==$row->id)
            $countryString .= "<option value=$row->id selected=\"selected\" >$row->name</option>";
        else
            $countryString .= "<option value=$row->id >$row->name</option>";
    }

    return $countryString;
}
/**
 * Get list 2
 */
function loadCity($idCountry=0, $idCity=0, $idHotel=0){
    $cityString = "";
    $db8 = ConnectAsPDO();

    // Проверяем был ли указан Отель
    if ($idHotel != 0) {
        $result = $db8->prepare("SELECT * FROM hotel WHERE id=? ");
        $result->execute(array($idHotel));
        while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
            $idCity = $row->id_city;
        }
    }

    if ($idCountry != 0) {
        $result = $db8->prepare("SELECT * FROM city WHERE id_country=? ");
        $result->execute(array($idCountry));
    }
    else {
        $result = $db8->prepare("SELECT * FROM city ");
        $result->execute();
    }

    while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
        if ($idCity==$row->id)
            $cityString .= "<option value=$row->id selected=\"selected\" >$row->name</option>";
        else
            $cityString .= "<option value=$row->id >$row->name</option>";
    }
    return $cityString;
}
/**
 * Get list 3
 */
function loadHotel($idCountry=0, $idCity=0, $idHotel=0){
    $hotelString = "";
    $db8 = ConnectAsPDO();

    // Проверяем был ли указан город
    if ($idCity != 0) {
        $result = $db8->prepare("SELECT * FROM hotel WHERE id_city=? ");
        $result->execute(array($idCity));
    }
    else {
        // Проверяем была ли указана страна
        if ($idCountry != 0) {
            // Выбираем города в этой стране и получаем их id
            $result = $db8->prepare("SELECT * FROM city WHERE id_country=? ");
            $result->execute(array($idCountry));
            while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
                $idCityTemp = $row->id;
                // По id города выбираем отели и добавляем в список доступных в этой стране
                $dbCity = ConnectAsPDO();
                $resultCity = $dbCity->prepare("SELECT * FROM hotel WHERE id_city=? ");
                $resultCity->execute(array($idCityTemp));
                while ($rowCity = $resultCity->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
                    $hotelString .= "<option value=$rowCity->id >$rowCity->name</option>";
                }
            }
        }
        else {
            $result = $db8->prepare("SELECT * FROM hotel ");
            $result->execute();
        }
    }
    
    while ($row = $result->fetch(PDO::FETCH_LAZY, PDO::FETCH_ORI_NEXT)) {
        if ($idHotel==$row->id)
            $hotelString .= "<option value=$row->id selected=\"selected\" >$row->name</option>";
        else
            $hotelString .= "<option value=$row->id >$row->name</option>";
    }
    
    return $hotelString;
}

// Check if submit button pressed
if (isset($_REQUEST['load'])) {
    
    //  Load list 1
    $countryString = loadCountry($_REQUEST['country'],$_REQUEST['city'],$_REQUEST['hotel']);

    //  Load list 2
    $cityString = loadCity($_REQUEST['country'],$_REQUEST['city'],$_REQUEST['hotel']);
    
    //  Load list 3
    $hotelString = loadHotel($_REQUEST['country'],$_REQUEST['city'],$_REQUEST['hotel']);
}

?>
<!-- Add jQuery in next two rows -->
<script src="jquery.js"></script>
<script language=javascript src="scripts.js" type="text/javascript"></script>

<form>
<div>
	<label>Страна</label>
	<select name="country" id="country" class="form-control">
		<option value=0 >не выбран</option>
        <?=$countryString?>
	</select>
</div>
<div>
	<label>Город</label>
	<select name="city" id="city" class="form-control">
        <option value=0 >не выбран</option>
        <?=$cityString?>
    </select>
</div>
<div>
	<label>Отель</label>
    <select name="hotel" id="hotel" class="form-control">
        <option value=0 >не выбран</option>
        <?=$hotelString?>
    </select>
</div>
<div>
    <input type="submit" name="load" value="Загрузить">
</div>
</form>