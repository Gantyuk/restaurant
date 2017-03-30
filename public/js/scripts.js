$(document).ready(function () {

    /* Переменная-флаг для отслеживания того, происходит ли в данный момент ajax-запрос. В самом начале даем ей значение false, т.е. запрос не в процессе выполнения */
    var inProcess = false;
    /* С какой статьи надо делать выборку из базы при ajax-запросе */
    var startFrom = 6;

    /* Используйте вариант $('#more').click(function() для того, чтобы дать пользователю возможность управлять процессом, кликая по кнопке "Дальше" под блоком статей (см. файл index.php) */
    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() && !inProcess) {

            $.ajax({
                url: "/",
                method: 'GET',
                data: {"startFrom": startFrom},
                beforeSend: function () {
                    inProcess = true;
                }
            }).done(function (data) {
                data = jQuery.parseJSON(data);
                var restaurants = data['restaurants'];
                var img = data['img'];
                var address = data['address'];
                var mark = data['mark'];
                var count = data['count'];
                    if
                (restaurants.length > 0)
                {
                    restaurants.forEach(function (item, i, restaurants) {

                        $("#pinBoot").append("<article class=\"white-panel\" >" +
                            "<img class=\"img_rest\" src=\"" + img[item.id] + "\"> " +
                            "<h4>" +
                            "<a href=\"restaurant/" + item.id + "\">" +
                            item.name +
                            "</a></h4><p> Оцінка:<span class=\"badge\">" + mark[item.id] + "</span> | " +
                            "<span class=\" glyphicon glyphicon-comment\" aria-hidden=\"true\"></span> "+count[item.id]+"  |" +
                            "</p> " +
                            " <p>  Адреса:" +
                            address[item.id] +

                            "  </p>" +
                            "</article>");
                    });

                    inProcess = false;
                    startFrom += 6;
                }
            });
        }
    });
});