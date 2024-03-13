# Стилизация SELECT

![alt ](https://github.com/Elliot-Johnson/bitrix.memo/blob/main/HTML/select.PNG?raw=true)

```
<select class="select-css" name="city" id="city">
            <option value="city_1">Санкт-Петербург</option>
            <option value="city_2">Москва</option>
            <option value="city_3">Владивосток</option>
</select>
```


```
/* SELECT  SELECT  SELECT  SELECT  SELECT */
.select-css {
    display: inline-block;
    font-size: var(--font-size-small-2);
    font-weight: 500;
    color: var(--color-gray-darker2);
    line-height: 1.3;
    padding: .6em 2.2em .5em .8em;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0;
    border: 1px solid #aaa;
    box-shadow: 0 1px 0 1px rgba(0, 0, 0, .04);
    border-radius: 10px;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3Csvg width='11' height='7' viewBox='0 0 11 7' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1 1L5.5 6L10 1' stroke='black' stroke-linecap='round'/%3E%3C/svg%3E%0A");
    background-repeat: no-repeat, repeat;
    background-position: right .7em top 55%, 0 0;
    background-size: 15px auto, 100%;
    cursor: pointer;
}

.select-css::-ms-expand {
    display: none;
}

.select-css:hover {
    border-color: #888;
}

.select-css:focus {
    border-color: #aaa;
    box-shadow: 0 0 1px 3px #00000011;
    box-shadow: 0 0 0 3px -moz-mac-focusring;
    color: #222;
    outline: none;
}

.select-css option {
    font-weight: normal;
    font-size: var(--font-size-small-2);
}

*[dir="rtl"] .select-css, :root:lang(ar) .select-css, :root:lang(iw) .select-css {
    background-position: left .7em top 50%, 0 0;
    padding: .6em .8em .5em 1.4em;
}

/* SELECT  SELECT  SELECT  SELECT  SELECT */
```
