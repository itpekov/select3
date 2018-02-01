$(document).ready(function () {
    // При изменении поля Страна меняем поле Город
    $('#country').change(function () {
        var url = 'getCity.php';
        var country = $(this).val();
        var str = 'country=' + country;
        $.get(url, str,
            function (result) {
                if (result.type == 'error') {
                    alert('error');
                    return(false);
                }
                else { $('#city').html(result); }
            },"html");
        // Список2 изменили
        // Теперь меняем список 3
        $.get('getHotel.php', str,
            function (result) {
                if (result.type == 'error') {
                    alert('error');
                    return(false);
                }
                else { $('#hotel').html(result); }
            },"html");
    });

    // При изменении поля Город меняем Отель
    $('#city').change(function () {
        var url = 'getHotel.php';
        var city = $(this).val();
        var str = 'city=' + city;
        $.get(url, str,
            function (result) {
                if (result.type == 'error') {
                    alert('error');
                    return(false);
                }
                else { $('#hotel').html(result); }
            },"html");
        // Список 3 изменили
        // Меняем список 1
        $.get('getCountry.php', str,
            function (result) {
                if (result.type == 'error') {
                    alert('error');
                    return(false);
                }
                else { $('#country').html(result); }
            },"html");
    });

    // При изменении поля 3 меняем поле 2 и поле 1
    $('#hotel').change(function () {
        var url = 'getCity.php';
        var hotel = $(this).val();
        var str = 'hotel=' + hotel;
        $.get(url, str,
            function (result) {
                if (result.type == 'error') {
                    alert('error');
                    return(false);
                }
                else { $('#city').html(result); }
            },"html");
        // Меняем список 1
        $.get('getCountry.php', str,
            function (result) {
                if (result.type == 'error') {
                    alert('error');
                    return(false);
                }
                else { $('#country').html(result); }
            },"html");
    });
});