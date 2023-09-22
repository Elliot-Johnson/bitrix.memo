<div id="suggest_telegram_window" style="display: none">
    <div class="wrapinn">
        <p class="warning__text">
            Подпишитесь на наш Telegram-канал</p>
        <div style="display: flex;justify-content: center">
            <a class="warning__button_ok" onclick="$.fancybox.close();$('#warning_stop').click();"
               href="https://t.me/xxxxx">ПОДПИСАТЬСЯ</a>
            <a class="warning__button_close" onclick="$.fancybox.close();$('#warning_stop').click();">ОТМЕНА</a>
        </div>
    </div>
</div>
<a href="#warning" id="warning_click"  ></a>
<div id="warning_stop"></div>
<style>
    #suggest_telegram_window{
        display: none;
        transition: 0.2s;
    }
    #suggest_telegram_window.active{
        display: flex !important;
        align-items: center;
        justify-content: center;
        position: fixed;
        top:0;
        bottom: 0;
        left:0;
        right: 0;
        background: rgba(0,0,0,0.5);
        z-index: 10000;
    }
    #suggest_telegram_window .wrapinn{
        background: #ffffff;
        width: 100%;
        max-width: 500px;
        padding: 10px;
        box-shadow: 0 0 5px rgba(0,0,0,0.5);
    }

    .warning__text {
        font-size: 22px;
        color: #2482cc;
        max-width: 800px;
        padding: 25px 25px 10px;
        font-weight: bold;
        text-align: center;
    }

    .warning__button_ok, .warning__button_close {
        width: 200px;
        display: block;
        text-align: center;
        margin: 1rem;
        cursor: pointer;
        outline: none;
        border: none;
        border-radius: 5px;
        padding: 0.5rem;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .warning__button_ok {
        background: #2482cc;
        color: #fff;
    }

    .warning__button_close {
        background: #777777;
        color: #fff;
    }


</style>
<script>
    $(document).ready(function () {
        $('#warning_click').click(function () {
            $('#suggest_telegram_window').addClass('active');
        });

        if (getCookie('stop_suggest_telegram_window') != '1') {
            setTimeout(function () {
                $('#warning_click').click();
            }, 10000);
        }
        $("#warning_stop").click(
            function () {
                $('#suggest_telegram_window').removeClass('active');
                let date = new Date;
                date.setDate(date.getDate() + 5);
                date = date.toUTCString();
                setCookie('stop_suggest_telegram_window', '1', {path: '/', 'expires': date});
            }
        );

        function setCookie(name, value, options = {}) {

            if (options.expires instanceof Date) {
                options.expires = options.expires.toUTCString();
            }

            let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

            for (let optionKey in options) {
                updatedCookie += "; " + optionKey;
                let optionValue = options[optionKey];
                if (optionValue !== true) {
                    updatedCookie += "=" + optionValue;
                }
            }
            console.log(updatedCookie);
            document.cookie = updatedCookie;
        }

        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }
    });
</script>
