# INPUT с лейблом внутри поля
```
<div class="input_container">
  <input id="ind_name" type="text" autocomplete="off" class="input" name="name" placeholder="">
  <label for="ind_name">ФИО (необязательно)</label>
</div>
```
## стили
```
.input_container {
	position: relative;
	background: #fff;
	border: 1px solid transparent;
	-webkit-box-shadow: 0 0 6px rgba(0, 0, 0, 0.13);
	-moz-box-shadow: 0 0 6px rgba(0, 0, 0, 0.13);
	box-shadow: 0 0 6px rgba(0, 0, 0, 0.13);
	border-radius: 0;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	margin: 0;
	padding: 0;
	outline: none;
	-webkit-appearance: none;
	appearance: none;
	height: 51px;
	width: 100%;
}
.input_container input {
	border: none;
	box-shadow: none;
	position: absolute;
	top: 16px;
	left: 0px;
	transition: 0.2s;
}
.input_container input:focus {
    border: none;
}
.input_container label {
	position: absolute;
	top: 15px;
	left: 10px;
	transition: 0.2s;
	color: #777777;
}
.input_container input:focus + label, .input_container input:not(:placeholder-shown) + label {
	top: 7px;
	left: 11px;
	font-style: normal;
	font-size: 11px;
	line-height: 16px;
	color: #777777;
	transition: 0.2s;
}
```
## Проблема в chrome с полями при автозаполнении
```
/////
$('input#ind_email').val(" ");
$('input#ind_password').val(" ");
setTimeout(function () {
    $('input#ind_email').val("");
    $('input#ind_password').val("");
},200);
/////
```
