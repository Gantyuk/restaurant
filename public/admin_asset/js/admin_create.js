var count = 0;
function checkAddress() {

    var address = $('#inputSuccess2').val();
    $.ajax({
        type: 'POST',
        url: '/add_address',
        data: 'address=' + address,
        success: function (data) {

            var location = new google.maps.LatLng(data['lat'], data['lng'])
            map.setCenter(location);
            $('#inputSuccess2').val(address);
            var markers = new google.maps.Marker({
                position: location,
                map: map
            });
            map.setZoom(18);
            marker.push(markers);


        }
    });
}
function addAddress() {
    var address = $('#inputSuccess2').val();
    $.ajax({
        type: 'POST',
        url: '/add_address',
        data: 'address=' + address,
        success: function (data) {
            count++;
            var location = new google.maps.LatLng(data['lat'], data['lng'])
            map.setCenter(location);
            $('#inputSuccess2').val(address);
            $("tbody.address").append("<tr class=\"even pointer\" id=\"add" + count + "\">" +
                "<td class=\" \">" + data['street'] + "</td>" +
                "<td class=\" \">" + data['house'] + "</td>" +
                "<td class=\" \"><button onclick='deleteAdress(" + count + ")' type='button' >delete</button>" +
                "<input type=\"text\" name='address[" + count + "][street]' hidden value=\"" + data['street'] + "\">" +
                "<input type=\"text\" name='address[" + count + "][house]' hidden value=\"" + data['house'] + "\">" +
                "<input type=\"text\" name='address[" + count + "][lat]' hidden value=\"" + data['lat'] + "\">" +
                "<input type=\"text\" name='address[" + count + "][lng]' hidden value=\"" + data['lng'] + "\">" +
                "</td> </tr>");

        }
    });
}
function deleteAdress(id) {
    $("#add" + id).remove();
}

document.getElementById("uploadBtn").onchange = function () {

    var input = $(this), numFiles = input.get(0).files ? input.get(0).files.length : 1;
    if (numFiles < 2) {
        $("#uploadImg").val(input.val());
    }
    else {
        $("#uploadImg").val("uploaded " + numFiles + " files");

    }

};