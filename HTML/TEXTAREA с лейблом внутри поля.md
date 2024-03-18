# TEXTAREA с лейблом внутри поля
```
<div class="textarea_container">
            <textarea id="form_message" type="text" autocomplete="off" class="textarea" name="message" placeholder=""></textarea>
            <label for="form_message">Сообщение</label>
</div>
```

```
/* textarea */
.textarea_container {
    position: relative;
    background: #fff;
    border: 1px solid #eeeeee;
    border-radius: 10px;
    margin: 0;
    padding: 1px;
    outline: none;
    -webkit-appearance: none;
    appearance: none;
    min-height: 120px;
    width: 100%;
}
.textarea_container textarea {
    border: none;
    box-shadow: none;
    position: absolute;
    top: 16px;
    min-height: 80px;
    width: 99%;
    padding: 0 12px;
    left: 0px;
    transition: 0.2s;
    border-radius: 10px;
}
.textarea_container textarea:focus {
    border: none;
    top: 23px;
}
.textarea_container label {
    position: absolute;
    top: 15px;
    left: 10px;
    transition: 0.2s;
    color: #777777;
}
.textarea_container textarea:focus + label, .textarea_container textarea:not(:placeholder-shown) + label {
    top: 7px;
    left: 11px;
    font-style: normal;
    font-size: 11px;
    line-height: 16px;
    color: #777777;
    transition: 0.2s;
}
.textarea_container textarea:focus,
.textarea_container textarea:not(:placeholder-shown) {
    top: 23px;
}
/* textarea */
```
