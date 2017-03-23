$(document).ready(function(){

/* Переменная-флаг для отслеживания того, происходит ли в данный момент ajax-запрос. В самом начале даем ей значение false, т.е. запрос не в процессе выполнения */
var inProcess = false;
/* С какой статьи надо делать выборку из базы при ajax-запросе */
var startFrom = 6;

    /* Используйте вариант $('#more').click(function() для того, чтобы дать пользователю возможность управлять процессом, кликая по кнопке "Дальше" под блоком статей (см. файл index.php) */
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() >= $(document).height() && !inProcess ) {

            $.ajax({
                url: "/",
                method: 'GET',
                data: {"startFrom" : startFrom},
                beforeSend: function() {
                    inProcess = true;
                }
            }).done(function(data){
                data = jQuery.parseJSON(data);
                var restaurants = data['restaurants'];
                var img = data['img'];
                var address = data['address'];
                var mark = data['mark'];

                if (restaurants.length > 0) {
                        restaurants.forEach(function(item, i, restaurants){

                         $("#pinBoot").append("  <article class=\"white-panel\" >" +
                            "<img class=\"img_rest\" src=\""+ img[item.id]+"\"> "+
                             "<h4>"+
                             "<a href=\"restaurant/"+item.id+"\">"+
                             item.name+
                        "</a></h4><p> Оцінка:"+mark[item.id]+"| <span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span> 365 |"+
                            "<span class=\" glyphicon glyphicon-comment\" aria-hidden=\"true\"></span> 4 | <span"+
                           " class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span> +5 <span"+
                            "class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span></p>"+
                                "<p> <p>  Адреса:"+
                             address[item.id]+

                       "  </p>" +
                        "</article>");
                    });

                    inProcess = false;
                    startFrom += 6;
                }
            });
        }

       /* /!* Если высота окна + высота прокрутки больше или равны высоте всего документа и ajax-запрос в настоящий момент не выполняется, то запускаем ajax-запрос *!/
        if($(window).scrollTop() + $(window).height() >= $(document).height() && !inProgress) {

        $.ajax({
            /!* адрес файла-обработчика запроса *!/
            url: '/',
            /!* метод отправки данных *!/
            method: 'POST',
            /!* данные, которые мы передаем в файл-обработчик *!/
            data: {"startFrom" : startFrom},
            /!* что нужно сделать до отправки запрса *!/
            beforeSend: function() {
            /!* меняем значение флага на true, т.е. запрос сейчас в процессе выполнения *!/
            inProgress = true;}
            /!* что нужно сделать по факту выполнения запроса *!/
            }).done(function(data){

            /!* Преобразуем результат, пришедший от обработчика - преобразуем json-строку обратно в массив *!/
            data = jQuery.parseJSON(data);

            /!* Если массив не пуст (т.е. статьи там есть) *!/
            if (data.length > 0) {

            /!* Делаем проход по каждому результату, оказвашемуся в массиве,
            где в index попадает индекс текущего элемента массива, а в data - сама статья *!/
            $.each(data, function(index, data){

            /!* Отбираем по идентификатору блок со статьями и дозаполняем его новыми данными *!/
            $("#restaurants").append("<p>fghj</p>");
            });

            /!* По факту окончания запроса снова меняем значение флага на false *!/
            inProgress = false;
            // Увеличиваем на 10 порядковый номер статьи, с которой надо начинать выборку из базы
            startFrom += 6;
            }});
        }*/
    });
});