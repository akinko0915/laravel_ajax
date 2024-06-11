<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Menu</title>

    </head>
    <body class="antialiased">
        <div>
            <h1>献立作成</h1>
            <br>
            <br>
            <form>
                @csrf
                主食：<br>
                <input name="staple">
                <br>
                主菜：<br>
                <input name="main">
                <br>
                副菜：<br>
                <input name="sub">
                <br>
                汁物：<br>
                <input name="soup">
                <br>
                飲み物：<br>
                <input name="drink">
                <br>
                デザート：<br>
                <input name="dessert">
                <br>
                <button type="button" id="create">作成</button>
            </form>
        </div>
        <div class="menus"></div>
        
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
        $("#create").click(function() {
            $.ajax({
                type: "POST",
                url: "/postmenu",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    staple: $("input[name='staple']").val(),
                    main: $("input[name='main']").val(),
                    sub: $("input[name='sub']").val(),
                    soup: $("input[name='soup']").val(),
                    drink: $("input[name='drink']").val(),
                    dessert: $("input[name='dessert']").val(),
                },
            })
            .done(function(res) {
                console.log(res);
                var html = `<div>
                    <h1>献立一覧</h1>
                    <br>
                    <h2>主食</h2>
                    <h3>${res.staple}</h3>
                    <br>
                    <h2>主菜</h2>
                    <h3>${res.main}</h3>
                    <br>
                    <h2>副菜</h2>
                    <h3>${res.sub}</h3>
                    <br>
                    <h2>汁物</h2>
                    <h3>${res.soup}</h3>
                    <br>
                    <h2>飲み物</h2>
                    <h3>${res.drink}</h3>
                    <br>
                    <h2>デザート</h2>       
                    <h3>${res.dessert}</h3>         
                </div>`;
                $('.menus').append(html);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                console.error("Ajax request failed:", textStatus, errorThrown);
                alert("献立の作成に失敗しました。");
            });
        });
    });
</script>