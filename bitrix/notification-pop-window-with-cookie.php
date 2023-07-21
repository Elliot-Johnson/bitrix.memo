<div class="pop-form" id="warning" style="display: none">
    <p style="font-size: 23px;color: #a21c17;max-width: 800px;padding:15px 15px 0;">
        Текст текст текст текст текст текст текст текст текст текст текст текст текст текст</p>
    <div style="display: flex;justify-content: center">
        <a class="warning__button_ok" onclick="$.fancybox.close();$('#warning_stop').click();"
           href="#">ПОДПИСАТЬСЯ</a>
        <a class="warning__button_close" onclick="$.fancybox.close();$('#warning_stop').click();">ОТМЕНА</a>
    </div>
</div>
<a href="#warning" id="warning_click" class="show-form" data-fancybox data-src="#warning"></a>
<div id="warning_stop"></div>
<style>
    .warning__button_ok,.warning__button_close{
        width: 200px;
        display: block;
        text-align: center;
        margin: 1rem;
        cursor: pointer;
        outline: none;
        border: none;
        padding: 0.5rem;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.8rem;
    }
    .warning__button_ok{
        background: #a21c17;
        color: #fff;
    }
    .warning__button_close{
        background: #777777;
        color: #fff;
    }
    #warning.fancybox-content {
        padding: 10px !important;
    }
    #warning .btn-close {
        background: #a21c17 url("/images/krestik.png") no-repeat 7px 7px;
        border-radius: 50%;
        display: block;
        height: 35px;
        overflow: hidden;
        position: absolute;
        right: 5px;
        text-indent: -999px;
        top: 5px;
        width: 35px;
        z-index: 100000;
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function () {
        if(getCookie('stop_warning') != '1' ){
            setTimeout(function () {
                $('#warning_click').click();
            }, 10000);
        }
        $("#warning_stop").click(
            function () {
                let date = new Date;
                date.setDate(date.getDate() + 3);
                date = date.toUTCString();

                setCookie('stop_warning', '1', {path: '/','expires': date});
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
