window.onload = function () {
    ({
        init: function () {
            self = this;
            $('.favorite_link').on('click', function () {
                $(this).toggleClass('active');
                let product_id = $(this).attr('data_product_id');
                let user_id = $(this).attr('data_user_id');
                if (product_id) {
                    self.set_favorite(product_id, user_id, $(this).hasClass('active'), self);
                }
            });
        },
        set_favorite: function (product_id, user_id, state, self) {
            let action = "";
            if (state) {
                action = "add";
            } else {
                action = "delete";
            }
            if (user_id > 0) {
                $.ajax(
                    {
                        type: "POST",
                        url: "/include/catalog/favorite/ajax_favorite.php",
                        data: {
                            "action": action,
                            "product_id": product_id,
                            "user_id": user_id,
                        },
                        success: function (result) {
                            try {
                                let parsed_result = JSON.parse(result);
                                if (parsed_result["result"]["success"]) {
                                    self.update_favorite_info_panel(state);
                                }
                            } catch (e) {
                                console.log(result);
                                return false;
                            }
                        }
                    }
                );
            } else {
                if (state) {
                    self.add_product_cookie(product_id, self);
                } else {
                    self.delete_product_cookie(product_id, self);
                }
                self.update_favorite_info_panel(state);
            }
        },
        update_favorite_info_panel: function (state) {
            let counter = $('.favorite_info_panel .favorite_info_panel__counter').html();
            if (state) {
                counter++;
            } else {
                counter--;
            }
            $('.favorite_info_panel .favorite_info_panel__counter').html(counter);
            if (counter > 0) {
                $('.favorite_info_panel').addClass('active');
            } else {
                $('.favorite_info_panel').removeClass('active');
            }
        },
        get_product_list_cookie: function (self) {
            let res = false;
            let FavoriteList = self.getCookie('favorites');
            if (typeof FavoriteList !== 'undefined' && FavoriteList != '') {
                res = JSON.parse(FavoriteList);
                //res = self.unserialize(FavoriteList,self);
                return res;
            }
            return res;
        },
        add_product_cookie: function (product_id, self) {
            let FavoriteList = self.get_product_list_cookie(self);
            if (Array.isArray(FavoriteList)) {
                let index = FavoriteList.indexOf(product_id);
                if (index === -1) {
                    FavoriteList.push(product_id);
//                let res = self.serialize(FavoriteList,self);
                    let res = JSON.stringify(FavoriteList);
                    self.setCookie("favorites", res);
                }
            } else {
                //let res = self.serialize([product_id],self);
                //console.log();
                //console.log(JSON.stringify(res));
                self.setCookie("favorites", JSON.stringify([product_id]));
            }
        },
        delete_product_cookie: function (product_id, self) {
            let FavoriteList = self.get_product_list_cookie(self);
            console.log(FavoriteList);
            let index = FavoriteList.indexOf(product_id);
            if (index !== -1) {
                FavoriteList.splice(index, 1);
                //let res = self.serialize(FavoriteList, self);
                let res = JSON.stringify(FavoriteList);
                self.setCookie("favorites", res);
            }
        },
        serialize: function (mixed_value, self) {
            var _getType = function (inp) {
                var type = typeof inp, match;
                var key;
                if (type == 'object' && !inp) {
                    return 'null';
                }
                if (type == 'object') {
                    if (!inp.constructor) {
                        return 'object';
                    }
                    var cons = inp.constructor.toString();
                    if (match = cons.match(/(\w+)\(/)) {
                        cons = match[1].toLowerCase();
                    }
                    var types = ['boolean', 'number', 'string', 'array'];
                    for (key in types) {
                        if (cons == types[key]) {
                            type = types[key];
                            break;
                        }
                    }
                }
                return type;
            };

            function serialize_get_length(val) {
                var counter = 0;
                for (i = 0; val.length > i; i++)
                    if (/[абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ]/.test(val[i])) {
                        counter += 2;
                    } else {
                        counter++;
                    }
                return counter;
            };

            var type = _getType(mixed_value);
            var val, ktype = '';
            switch (type) {
                case 'function':
                    val = '';
                    break;
                case 'undefined':
                    val = 'N';
                    break;
                case 'boolean':
                    val = 'b:' + (mixed_value ? '1' : '0');
                    break;
                case 'number':
                    val = (Math.round(mixed_value) == mixed_value ? 'i' : 'd') + ':' + mixed_value;
                    break;
                case 'string':
                    val = 's:' + serialize_get_length(mixed_value) + ':"' + mixed_value + '"';
                    break;
                case 'array':
                case 'object':
                    val = 'a';
                    var count = 0;
                    var vals = '';
                    var okey;
                    var key;
                    for (key in mixed_value) {
                        ktype = _getType(mixed_value[key]);
                        if (ktype == 'function') {
                            continue;
                        }
                        okey = (key.match(/^[0-9]+$/) ? parseInt(key) : key);
                        vals += self.serialize(okey) + self.serialize(mixed_value[key]);
                        count++;
                    }
                    val += ':' + count + ':{' + vals + '}';
                    break;
            }
            if (type != 'object' && type != 'array') val += ';';
            return val;
        },


        unserialize: function (inp, self) {
            error = 0;
            if (inp == "" || inp.length < 2) {
                errormsg = "input is too short";
                return;
            }
            var val, kret, vret, cval;
            var type = inp.charAt(0);
            var cont = inp.substring(2);
            var size = 0, divpos = 0, endcont = 0, rest = "", next = "";

            switch (type) {
                case "N": // null
                    if (inp.charAt(1) != ";") {
                        errormsg = "missing ; for null";
                    }
                    // leave val undefined
                    rest = cont;
                    break;
                case "b": // boolean
                    if (!/[01];/.test(cont.substring(0, 2))) {
                        errormsg = "value not 0 or 1, or missing ; for boolean";
                    }
                    val = (cont.charAt(0) == "1");
                    rest = cont.substring(1);
                    break;
                case "s": // string
                    val = "";
                    divpos = cont.indexOf(":");
                    if (divpos == -1) {
                        errormsg = "missing : for string";
                        break;
                    }
                    size = parseInt(cont.substring(0, divpos));
                    if (size == 0) {
                        if (cont.length - divpos < 4) {
                            errormsg = "string is too short";
                            break;
                        }
                        rest = cont.substring(divpos + 4);
                        break;
                    }
                    if ((cont.length - divpos - size) < 4) {
                        errormsg = "string is too short";
                        break;
                    }
                    if (cont.substring(divpos + 2 + size, divpos + 4 + size) != "\";") {
                        errormsg = "string is too long, or missing \";";
                    }
                    val = cont.substring(divpos + 2, divpos + 2 + size);
                    rest = cont.substring(divpos + 4 + size);
                    break;
                case "i": // integer
                case "d": // float
                    var dotfound = 0;
                    for (var i = 0; i < cont.length; i++) {
                        cval = cont.charAt(i);
                        if (isNaN(parseInt(cval)) && !(type == "d" && cval == "." && !dotfound++)) {
                            endcont = i;
                            break;
                        }
                    }
                    if (!endcont || cont.charAt(endcont) != ";") {
                        errormsg = "missing or invalid value, or missing ; for int/float";
                    }
                    val = cont.substring(0, endcont);
                    val = (type == "i" ? parseInt(val) : parseFloat(val));
                    rest = cont.substring(endcont + 1);
                    break;
                case "a": // array
                    if (cont.length < 4) {
                        errormsg = "array is too short";
                        return;
                    }
                    divpos = cont.indexOf(":", 1);
                    if (divpos == -1) {
                        errormsg = "missing : for array";
                        return;
                    }
                    size = parseInt(cont.substring(1, divpos - 1));
                    cont = cont.substring(divpos + 2);
                    val = new Array();
                    if (cont.length < 1) {
                        errormsg = "array is too short";
                        return;
                    }
                    for (var i = 0; i + 1 < size * 2; i += 2) {
                        kret = unserialize(cont, 1);
                        if (error || kret[0] == undefined || kret[1] == "") {
                            errormsg = "missing or invalid key, or missing value for array";
                            return;
                        }
                        vret = unserialize(kret[1], 1);
                        if (error) {
                            errormsg = "invalid value for array";
                            return;
                        }
                        val[kret[0]] = vret[0];
                        cont = vret[1];
                    }
                    if (cont.charAt(0) != "}") {
                        errormsg = "missing ending }, or too many values for array";
                        return;
                    }
                    rest = cont.substring(1);
                    break;
                case "O": // object
                    divpos = cont.indexOf(":");
                    if (divpos == -1) {
                        errormsg = "missing : for object";
                        return;
                    }
                    size = parseInt(cont.substring(0, divpos));
                    var objname = cont.substring(divpos + 2, divpos + 2 + size);
                    if (cont.substring(divpos + 2 + size, divpos + 4 + size) != "\":") {
                        errormsg = "object name is too long, or missing \":";
                        return;
                    }
                    var objprops = unserialize("a:" + cont.substring(divpos + 4 + size), 1);
                    if (error) {
                        errormsg = "invalid object properties";
                        return;
                    }
                    rest = objprops[1];
                    var objout = "function " + objname + "(){";
                    for (key in objprops[0]) {
                        objout += "" + key + "=objprops[0]['" + key + "'];";
                    }
                    objout += "}val=new " + objname + "();";
                    eval(objout);
                    break;
                default:
                    errormsg = "invalid input type";
            }
            return (arguments.length == 1 ? val : [val, rest]);
        },
        setCookie: function (name, value) {
            var date = new Date(new Date().getTime() + 3600 * 1000);
            document.cookie = "" + name + "=" + value + "; path=/; expires=" + date.toUTCString();
        },
        getCookie: function (name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        },


    }).init();
};


