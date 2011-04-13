/*
 * Code taken from http://www.crockford.com/javascript/remedial.html
 * This could be called runtime.js or framweork instead of sugar.js
 * http://en.wikipedia.org/wiki/Syntactic_sugar explains meaning of 
 * the term sugar in reference to programming
 */


/*
 * The following methods are used to provide classical inheritance functionality to javascript
 */
Function.prototype.method = function (name, func) {
    this.prototype[name] = func;
    return this;
};


Function.method('inherits', function (parent) {
    var d = 0, p = (this.prototype = new parent());
    this.method('uber', function uber(name) {
        var f, r, t = d, v = parent.prototype;
        if (t) {
            while (t) {
                v = v.constructor.prototype;
                t -= 1;
            }
            f = v[name];
        } else {
            f = p[name];
            if (f == this[name]) {
                f = v[name];
            }
        }
        d += 1;
        r = f.apply(this, Array.prototype.slice.apply(arguments, [1]));
        d -= 1;
        return r;
    });
    return this;
});

Function.method('swiss', function (parent) {
    for (var i = 1; i < arguments.length; i += 1) {
        var name = arguments[i];
        this.prototype[name] = parent.prototype[name];
    }
    return this;
});

/*
 * the following functions are designed to test for object type
 */

function isAlien(a) {
   return isObject(a) && typeof a.constructor != 'function';
}

function isArray(a) {
    return isObject(a) && a.constructor == Array;
}

function isBoolean(a) {
    return typeof a == 'boolean';
}

function isEmpty(o) {
    var i, v;
    if (isObject(o)) {
        for (i in o) {
            v = o[i];
            if (isUndefined(v) && isFunction(v)) {
                return false;
            }
        }
    }
    return true;
}

function isFunction(a) {
    return typeof a == 'function';
}

function isNull(a) {
    return typeof a == 'object' && !a;
}

function isNumber(a) {
    return typeof a == 'number' && isFinite(a);
}

function isObject(a) {
    return (a && typeof a == 'object') || isFunction(a);
}

function isString(a) {
    return typeof a == 'string';
}

function isUndefined(a) {
    return typeof a == 'undefined';
} 

String.
    method('entityify', function () {
        return this.replace(/&/g, "&amp;").replace(/</g,
            "&lt;").replace(/>/g, "&gt;");
    }).
    method('quote', function () {
        var c, i, l = this.length, o = '"';
        for (i = 0; i < l; i += 1) {
            c = this.charAt(i);
            if (c >= ' ') {
                if (c == '\\' || c == '"') {
                    o += '\\';
                }
                o += c;
            } else {
                switch (c) {
                case '\b':
                    o += '\\b';
                    break;
                case '\f':
                    o += '\\f';
                    break;
                case '\n':
                    o += '\\n';
                    break;
                case '\r':
                    o += '\\r';
                    break;
                case '\t':
                    o += '\\t';
                    break;
                default:
                    c = c.charCodeAt();
                    o += '\\u00' + Math.floor(c / 16).toString(16) +
                        (c % 16).toString(16);
                }
            }
        }
        return o + '"';
    }).
    method('supplant', function (o) {
        var i, j, s = this, v;
        for (;;) {
            i = s.lastIndexOf('{');
            if (i < 0) {
                break;
            }
            j = s.indexOf('}', i);
            if (i + 1 >= j) {
                break;
            }
            v = o[s.substring(i + 1, j)];
            if (!isString(v) && !isNumber(v)) {
                break;
            }
            s = s.substring(0, i) + v + s.substring(j + 1);
        }
        return s;
    }).
    method('trim', function () {
        return this.replace(/^\s*(\S*(\s+\S+)*)\s*$/, "$1");
    }); 


/*
 * The functions that follow will be ignored unless they are needed.
 * If there is already a suitable method, we use it. 
 */

if (!isFunction(Function.apply)) {
    Function.method('apply', function (o, a) {
        var r, x = '____apply';
        if (!isObject(o)) {
            o = {};
        }
        o[x] = this;
        switch ((a && a.length) || 0) {
        case 0:
            r = o[x]();
            break;
        case 1:
            r = o[x](a[0]);
            break;
        case 2:
            r = o[x](a[0], a[1]);
            break;
        case 3:
            r = o[x](a[0], a[1], a[2]);
            break;
        case 4:
            r = o[x](a[0], a[1], a[2], a[3]);
            break;
        case 5:
            r = o[x](a[0], a[1], a[2], a[3], a[4]);
            break;
        case 6:
            r = o[x](a[0], a[1], a[2], a[3], a[4], a[5]);
            break;
        default:
            alert('Too many arguments to apply.');
        }
        delete o[x];
        return r;
    });
} 

if (!isFunction(Array.prototype.pop)) {
    Array.method('pop', function () {
        return this.splice(this.length - 1, 1)[0];
    });
}

if (!isFunction(Array.prototype.push)) {
    Array.method('push', function () {
        this.splice.apply(this,
            [this.length, 0].concat(Array.prototype.slice.apply(arguments)));
        return this.length;
    });
}

if (!isFunction(Array.prototype.shift)) {
    Array.method('shift', function () {
        return this.splice(0, 1)[0];
    });
}

if (!isFunction(Array.prototype.splice)) {
    Array.method('splice', function (s, d) {
        var max = Math.max,
            min = Math.min,
            a = [], // The return value array
            e,  // element
            i = max(arguments.length - 2, 0),   // insert count
            k = 0,
            l = this.length,
            n,  // new length
            v,  // delta
            x;  // shift count

        s = s || 0;
        if (s < 0) {
            s += l;
        }
        s = max(min(s, l), 0);  // start point
        d = max(min(isNumber(d) ? d : l, l - s), 0);    // delete count
        v = i - d;
        n = l + v;
        while (k < d) {
            e = this[s + k];
            if (!isUndefined(e)) {
                a[k] = e;
            }
            k += 1;
        }
        x = l - s - d;
        if (v < 0) {
            k = s + i;
            while (x) {
                this[k] = this[k - v];
                k += 1;
                x -= 1;
            }
            this.length = n;
        } else if (v > 0) {
            k = 1;
            while (x) {
                this[n - k] = this[l - k];
                k += 1;
                x -= 1;
            }
        }
        for (k = 0; k < i; ++k) {
            this[s + k] = arguments[k + 2];
        }
        return a;
    });
}

if (!isFunction(Array.prototype.unshift)) {
    Array.method('unshift', function () {
        this.splice.apply(this,
            [0, 0].concat(Array.prototype.slice.apply(arguments)));
        return this.length;
    });
}




