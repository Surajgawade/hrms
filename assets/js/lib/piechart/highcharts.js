/*
 Highcharts JS v6.0.4 (2017-12-15)

 (c) 2009-2016 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(S, M) { "object" === typeof module && module.exports ? module.exports = S.document ? M(S) : M : S.Highcharts = M(S) })("undefined" !== typeof window ? window : this, function(S) {
    var M = function() {
        var a = "undefined" === typeof S ? window : S,
            E = a.document,
            D = a.navigator && a.navigator.userAgent || "",
            H = E && E.createElementNS && !!E.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect,
            p = /(edge|msie|trident)/i.test(D) && !a.opera,
            f = /Firefox/.test(D),
            l = f && 4 > parseInt(D.split("Firefox/")[1], 10);
        return a.Highcharts ? a.Highcharts.error(16, !0) : { product: "Highcharts", version: "6.0.4", deg2rad: 2 * Math.PI / 360, doc: E, hasBidiBug: l, hasTouch: E && void 0 !== E.documentElement.ontouchstart, isMS: p, isWebKit: /AppleWebKit/.test(D), isFirefox: f, isTouchDevice: /(Mobile|Android|Windows Phone)/.test(D), SVG_NS: "http://www.w3.org/2000/svg", chartCount: 0, seriesTypes: {}, symbolSizes: {}, svg: H, win: a, marginNames: ["plotTop", "marginRight", "marginBottom", "plotLeft"], noop: function() {}, charts: [] }
    }();
    (function(a) {
        a.timers = [];
        var E = a.charts,
            D = a.doc,
            H = a.win;
        a.error = function(p,
            f) {
            p = a.isNumber(p) ? "Highcharts error #" + p + ": www.highcharts.com/errors/" + p : p;
            if (f) throw Error(p);
            H.console && console.log(p)
        };
        a.Fx = function(a, f, l) {
            this.options = f;
            this.elem = a;
            this.prop = l
        };
        a.Fx.prototype = {
            dSetter: function() {
                var a = this.paths[0],
                    f = this.paths[1],
                    l = [],
                    r = this.now,
                    n = a.length,
                    w;
                if (1 === r) l = this.toD;
                else if (n === f.length && 1 > r)
                    for (; n--;) w = parseFloat(a[n]), l[n] = isNaN(w) ? f[n] : r * parseFloat(f[n] - w) + w;
                else l = f;
                this.elem.attr("d", l, null, !0)
            },
            update: function() {
                var a = this.elem,
                    f = this.prop,
                    l = this.now,
                    r =
                    this.options.step;
                if (this[f + "Setter"]) this[f + "Setter"]();
                else a.attr ? a.element && a.attr(f, l, null, !0) : a.style[f] = l + this.unit;
                r && r.call(a, l, this)
            },
            run: function(p, f, l) {
                var r = this,
                    n = r.options,
                    w = function(a) { return w.stopped ? !1 : r.step(a) },
                    u = H.requestAnimationFrame || function(a) { setTimeout(a, 13) },
                    e = function() {
                        for (var h = 0; h < a.timers.length; h++) a.timers[h]() || a.timers.splice(h--, 1);
                        a.timers.length && u(e)
                    };
                p === f ? (delete n.curAnim[this.prop], n.complete && 0 === a.keys(n.curAnim).length && n.complete.call(this.elem)) :
                    (this.startTime = +new Date, this.start = p, this.end = f, this.unit = l, this.now = this.start, this.pos = 0, w.elem = this.elem, w.prop = this.prop, w() && 1 === a.timers.push(w) && u(e))
            },
            step: function(p) {
                var f = +new Date,
                    l, r = this.options,
                    n = this.elem,
                    w = r.complete,
                    u = r.duration,
                    e = r.curAnim;
                n.attr && !n.element ? p = !1 : p || f >= u + this.startTime ? (this.now = this.end, this.pos = 1, this.update(), l = e[this.prop] = !0, a.objectEach(e, function(a) {!0 !== a && (l = !1) }), l && w && w.call(n), p = !1) : (this.pos = r.easing((f - this.startTime) / u), this.now = this.start + (this.end -
                    this.start) * this.pos, this.update(), p = !0);
                return p
            },
            initPath: function(p, f, l) {
                function r(a) { var b, c; for (k = a.length; k--;) b = "M" === a[k] || "L" === a[k], c = /[a-zA-Z]/.test(a[k + 3]), b && c && a.splice(k + 1, 0, a[k + 1], a[k + 2], a[k + 1], a[k + 2]) }

                function n(a, b) {
                    for (; a.length < c;) {
                        a[0] = b[c - a.length];
                        var e = a.slice(0, d);
                        [].splice.apply(a, [0, 0].concat(e));
                        z && (e = a.slice(a.length - d), [].splice.apply(a, [a.length, 0].concat(e)), k--)
                    }
                    a[0] = "M"
                }

                function w(a, k) {
                    for (var e = (c - a.length) / d; 0 < e && e--;) b = a.slice().splice(a.length / B - d, d * B), b[0] =
                        k[c - d - e * d], m && (b[d - 6] = b[d - 2], b[d - 5] = b[d - 1]), [].splice.apply(a, [a.length / B, 0].concat(b)), z && e--
                }
                f = f || "";
                var u, e = p.startX,
                    h = p.endX,
                    m = -1 < f.indexOf("C"),
                    d = m ? 7 : 3,
                    c, b, k;
                f = f.split(" ");
                l = l.slice();
                var z = p.isArea,
                    B = z ? 2 : 1,
                    I;
                m && (r(f), r(l));
                if (e && h) {
                    for (k = 0; k < e.length; k++)
                        if (e[k] === h[0]) { u = k; break } else if (e[0] === h[h.length - e.length + k]) {
                        u = k;
                        I = !0;
                        break
                    }
                    void 0 === u && (f = [])
                }
                f.length && a.isNumber(u) && (c = l.length + u * B * d, I ? (n(f, l), w(l, f)) : (n(l, f), w(f, l)));
                return [f, l]
            }
        };
        a.Fx.prototype.fillSetter = a.Fx.prototype.strokeSetter =
            function() { this.elem.attr(this.prop, a.color(this.start).tweenTo(a.color(this.end), this.pos), null, !0) };
        a.extend = function(a, f) {
            var l;
            a || (a = {});
            for (l in f) a[l] = f[l];
            return a
        };
        a.merge = function() {
            var p, f = arguments,
                l, r = {},
                n = function(l, p) {
                    "object" !== typeof l && (l = {});
                    a.objectEach(p, function(e, h) {!a.isObject(e, !0) || a.isClass(e) || a.isDOMElement(e) ? l[h] = p[h] : l[h] = n(l[h] || {}, e) });
                    return l
                };
            !0 === f[0] && (r = f[1], f = Array.prototype.slice.call(f, 2));
            l = f.length;
            for (p = 0; p < l; p++) r = n(r, f[p]);
            return r
        };
        a.pInt = function(a,
            f) { return parseInt(a, f || 10) };
        a.isString = function(a) { return "string" === typeof a };
        a.isArray = function(a) { a = Object.prototype.toString.call(a); return "[object Array]" === a || "[object Array Iterator]" === a };
        a.isObject = function(p, f) { return !!p && "object" === typeof p && (!f || !a.isArray(p)) };
        a.isDOMElement = function(p) { return a.isObject(p) && "number" === typeof p.nodeType };
        a.isClass = function(p) { var f = p && p.constructor; return !(!a.isObject(p, !0) || a.isDOMElement(p) || !f || !f.name || "Object" === f.name) };
        a.isNumber = function(a) {
            return "number" ===
                typeof a && !isNaN(a) && Infinity > a && -Infinity < a
        };
        a.erase = function(a, f) {
            for (var l = a.length; l--;)
                if (a[l] === f) { a.splice(l, 1); break }
        };
        a.defined = function(a) { return void 0 !== a && null !== a };
        a.attr = function(p, f, l) {
            var r;
            a.isString(f) ? a.defined(l) ? p.setAttribute(f, l) : p && p.getAttribute && (r = p.getAttribute(f)) : a.defined(f) && a.isObject(f) && a.objectEach(f, function(a, l) { p.setAttribute(l, a) });
            return r
        };
        a.splat = function(p) { return a.isArray(p) ? p : [p] };
        a.syncTimeout = function(a, f, l) {
            if (f) return setTimeout(a, f, l);
            a.call(0,
                l)
        };
        a.pick = function() {
            var a = arguments,
                f, l, r = a.length;
            for (f = 0; f < r; f++)
                if (l = a[f], void 0 !== l && null !== l) return l
        };
        a.css = function(p, f) {
            a.isMS && !a.svg && f && void 0 !== f.opacity && (f.filter = "alpha(opacity\x3d" + 100 * f.opacity + ")");
            a.extend(p.style, f)
        };
        a.createElement = function(p, f, l, r, n) {
            p = D.createElement(p);
            var w = a.css;
            f && a.extend(p, f);
            n && w(p, { padding: 0, border: "none", margin: 0 });
            l && w(p, l);
            r && r.appendChild(p);
            return p
        };
        a.extendClass = function(p, f) {
            var l = function() {};
            l.prototype = new p;
            a.extend(l.prototype, f);
            return l
        };
        a.pad = function(a, f, l) { return Array((f || 2) + 1 - String(a).length).join(l || 0) + a };
        a.relativeLength = function(a, f, l) { return /%$/.test(a) ? f * parseFloat(a) / 100 + (l || 0) : parseFloat(a) };
        a.wrap = function(a, f, l) {
            var p = a[f];
            a[f] = function() {
                var a = Array.prototype.slice.call(arguments),
                    f = arguments,
                    u = this;
                u.proceed = function() { p.apply(u, arguments.length ? arguments : f) };
                a.unshift(p);
                a = l.apply(this, a);
                u.proceed = null;
                return a
            }
        };
        a.getTZOffset = function(p) {
            var f = a.Date;
            return 6E4 * (f.hcGetTimezoneOffset && f.hcGetTimezoneOffset(p) ||
                f.hcTimezoneOffset || 0)
        };
        a.dateFormat = function(p, f, l) {
            if (!a.defined(f) || isNaN(f)) return a.defaultOptions.lang.invalidDate || "";
            p = a.pick(p, "%Y-%m-%d %H:%M:%S");
            var r = a.Date,
                n = new r(f - a.getTZOffset(f)),
                w = n[r.hcGetHours](),
                u = n[r.hcGetDay](),
                e = n[r.hcGetDate](),
                h = n[r.hcGetMonth](),
                m = n[r.hcGetFullYear](),
                d = a.defaultOptions.lang,
                c = d.weekdays,
                b = d.shortWeekdays,
                k = a.pad,
                r = a.extend({
                    a: b ? b[u] : c[u].substr(0, 3),
                    A: c[u],
                    d: k(e),
                    e: k(e, 2, " "),
                    w: u,
                    b: d.shortMonths[h],
                    B: d.months[h],
                    m: k(h + 1),
                    y: m.toString().substr(2, 2),
                    Y: m,
                    H: k(w),
                    k: w,
                    I: k(w % 12 || 12),
                    l: w % 12 || 12,
                    M: k(n[r.hcGetMinutes]()),
                    p: 12 > w ? "AM" : "PM",
                    P: 12 > w ? "am" : "pm",
                    S: k(n.getSeconds()),
                    L: k(Math.round(f % 1E3), 3)
                }, a.dateFormats);
            a.objectEach(r, function(a, b) { for (; - 1 !== p.indexOf("%" + b);) p = p.replace("%" + b, "function" === typeof a ? a(f) : a) });
            return l ? p.substr(0, 1).toUpperCase() + p.substr(1) : p
        };
        a.formatSingle = function(p, f) {
            var l = /\.([0-9])/,
                r = a.defaultOptions.lang;
            /f$/.test(p) ? (l = (l = p.match(l)) ? l[1] : -1, null !== f && (f = a.numberFormat(f, l, r.decimalPoint, -1 < p.indexOf(",") ? r.thousandsSep :
                ""))) : f = a.dateFormat(p, f);
            return f
        };
        a.format = function(p, f) {
            for (var l = "{", r = !1, n, w, u, e, h = [], m; p;) {
                l = p.indexOf(l);
                if (-1 === l) break;
                n = p.slice(0, l);
                if (r) {
                    n = n.split(":");
                    w = n.shift().split(".");
                    e = w.length;
                    m = f;
                    for (u = 0; u < e; u++) m && (m = m[w[u]]);
                    n.length && (m = a.formatSingle(n.join(":"), m));
                    h.push(m)
                } else h.push(n);
                p = p.slice(l + 1);
                l = (r = !r) ? "}" : "{"
            }
            h.push(p);
            return h.join("")
        };
        a.getMagnitude = function(a) { return Math.pow(10, Math.floor(Math.log(a) / Math.LN10)) };
        a.normalizeTickInterval = function(p, f, l, r, n) {
            var w, u = p;
            l =
                a.pick(l, 1);
            w = p / l;
            f || (f = n ? [1, 1.2, 1.5, 2, 2.5, 3, 4, 5, 6, 8, 10] : [1, 2, 2.5, 5, 10], !1 === r && (1 === l ? f = a.grep(f, function(a) { return 0 === a % 1 }) : .1 >= l && (f = [1 / l])));
            for (r = 0; r < f.length && !(u = f[r], n && u * l >= p || !n && w <= (f[r] + (f[r + 1] || f[r])) / 2); r++);
            return u = a.correctFloat(u * l, -Math.round(Math.log(.001) / Math.LN10))
        };
        a.stableSort = function(a, f) {
            var l = a.length,
                p, n;
            for (n = 0; n < l; n++) a[n].safeI = n;
            a.sort(function(a, n) { p = f(a, n); return 0 === p ? a.safeI - n.safeI : p });
            for (n = 0; n < l; n++) delete a[n].safeI
        };
        a.arrayMin = function(a) {
            for (var f = a.length,
                    l = a[0]; f--;) a[f] < l && (l = a[f]);
            return l
        };
        a.arrayMax = function(a) { for (var f = a.length, l = a[0]; f--;) a[f] > l && (l = a[f]); return l };
        a.destroyObjectProperties = function(p, f) {
            a.objectEach(p, function(a, r) {
                a && a !== f && a.destroy && a.destroy();
                delete p[r]
            })
        };
        a.discardElement = function(p) {
            var f = a.garbageBin;
            f || (f = a.createElement("div"));
            p && f.appendChild(p);
            f.innerHTML = ""
        };
        a.correctFloat = function(a, f) { return parseFloat(a.toPrecision(f || 14)) };
        a.setAnimation = function(p, f) {
            f.renderer.globalAnimation = a.pick(p, f.options.chart.animation, !0)
        };
        a.animObject = function(p) { return a.isObject(p) ? a.merge(p) : { duration: p ? 500 : 0 } };
        a.timeUnits = { millisecond: 1, second: 1E3, minute: 6E4, hour: 36E5, day: 864E5, week: 6048E5, month: 24192E5, year: 314496E5 };
        a.numberFormat = function(p, f, l, r) {
            p = +p || 0;
            f = +f;
            var n = a.defaultOptions.lang,
                w = (p.toString().split(".")[1] || "").split("e")[0].length,
                u, e, h = p.toString().split("e"); - 1 === f ? f = Math.min(w, 20) : a.isNumber(f) ? f && h[1] && 0 > h[1] && (u = f + +h[1], 0 <= u ? (h[0] = (+h[0]).toExponential(u).split("e")[0], f = u) : (h[0] = h[0].split(".")[0] || 0,
                p = 20 > f ? (h[0] * Math.pow(10, h[1])).toFixed(f) : 0, h[1] = 0)) : f = 2;
            e = (Math.abs(h[1] ? h[0] : p) + Math.pow(10, -Math.max(f, w) - 1)).toFixed(f);
            w = String(a.pInt(e));
            u = 3 < w.length ? w.length % 3 : 0;
            l = a.pick(l, n.decimalPoint);
            r = a.pick(r, n.thousandsSep);
            p = (0 > p ? "-" : "") + (u ? w.substr(0, u) + r : "");
            p += w.substr(u).replace(/(\d{3})(?=\d)/g, "$1" + r);
            f && (p += l + e.slice(-f));
            h[1] && 0 !== +p && (p += "e" + h[1]);
            return p
        };
        Math.easeInOutSine = function(a) { return -.5 * (Math.cos(Math.PI * a) - 1) };
        a.getStyle = function(p, f, l) {
            if ("width" === f) return Math.min(p.offsetWidth,
                p.scrollWidth) - a.getStyle(p, "padding-left") - a.getStyle(p, "padding-right");
            if ("height" === f) return Math.min(p.offsetHeight, p.scrollHeight) - a.getStyle(p, "padding-top") - a.getStyle(p, "padding-bottom");
            H.getComputedStyle || a.error(27, !0);
            if (p = H.getComputedStyle(p, void 0)) p = p.getPropertyValue(f), a.pick(l, "opacity" !== f) && (p = a.pInt(p));
            return p
        };
        a.inArray = function(p, f) { return (a.indexOfPolyfill || Array.prototype.indexOf).call(f, p) };
        a.grep = function(p, f) {
            return (a.filterPolyfill || Array.prototype.filter).call(p,
                f)
        };
        a.find = Array.prototype.find ? function(a, f) { return a.find(f) } : function(a, f) {
            var l, r = a.length;
            for (l = 0; l < r; l++)
                if (f(a[l], l)) return a[l]
        };
        a.map = function(a, f) { for (var l = [], r = 0, n = a.length; r < n; r++) l[r] = f.call(a[r], a[r], r, a); return l };
        a.keys = function(p) { return (a.keysPolyfill || Object.keys).call(void 0, p) };
        a.reduce = function(p, f, l) { return (a.reducePolyfill || Array.prototype.reduce).call(p, f, l) };
        a.offset = function(a) {
            var f = D.documentElement;
            a = a.parentElement ? a.getBoundingClientRect() : { top: 0, left: 0 };
            return {
                top: a.top +
                    (H.pageYOffset || f.scrollTop) - (f.clientTop || 0),
                left: a.left + (H.pageXOffset || f.scrollLeft) - (f.clientLeft || 0)
            }
        };
        a.stop = function(p, f) { for (var l = a.timers.length; l--;) a.timers[l].elem !== p || f && f !== a.timers[l].prop || (a.timers[l].stopped = !0) };
        a.each = function(p, f, l) { return (a.forEachPolyfill || Array.prototype.forEach).call(p, f, l) };
        a.objectEach = function(a, f, l) { for (var r in a) a.hasOwnProperty(r) && f.call(l, a[r], r, a) };
        a.addEvent = function(p, f, l) {
            var r, n, w = p.addEventListener || a.addEventListenerPolyfill;
            p.hcEvents &&
                !Object.prototype.hasOwnProperty.call(p, "hcEvents") && (n = {}, a.objectEach(p.hcEvents, function(a, e) { n[e] = a.slice(0) }), p.hcEvents = n);
            r = p.hcEvents = p.hcEvents || {};
            w && w.call(p, f, l, !1);
            r[f] || (r[f] = []);
            r[f].push(l);
            return function() { a.removeEvent(p, f, l) }
        };
        a.removeEvent = function(p, f, l) {
            function r(e, m) {
                var d = p.removeEventListener || a.removeEventListenerPolyfill;
                d && d.call(p, e, m, !1)
            }

            function n() {
                var e, m;
                p.nodeName && (f ? (e = {}, e[f] = !0) : e = u, a.objectEach(e, function(a, c) {
                    if (u[c])
                        for (m = u[c].length; m--;) r(c, u[c][m])
                }))
            }
            var w, u = p.hcEvents,
                e;
            u && (f ? (w = u[f] || [], l ? (e = a.inArray(l, w), -1 < e && (w.splice(e, 1), u[f] = w), r(f, l)) : (n(), u[f] = [])) : (n(), p.hcEvents = {}))
        };
        a.fireEvent = function(p, f, l, r) {
            var n;
            n = p.hcEvents;
            var w, u;
            l = l || {};
            if (D.createEvent && (p.dispatchEvent || p.fireEvent)) n = D.createEvent("Events"), n.initEvent(f, !0, !0), a.extend(n, l), p.dispatchEvent ? p.dispatchEvent(n) : p.fireEvent(f, n);
            else if (n)
                for (n = n[f] || [], w = n.length, l.target || a.extend(l, { preventDefault: function() { l.defaultPrevented = !0 }, target: p, type: f }), f = 0; f < w; f++)(u = n[f]) &&
                    !1 === u.call(p, l) && l.preventDefault();
            r && !l.defaultPrevented && r(l)
        };
        a.animate = function(p, f, l) {
            var r, n = "",
                w, u, e;
            a.isObject(l) || (e = arguments, l = { duration: e[2], easing: e[3], complete: e[4] });
            a.isNumber(l.duration) || (l.duration = 400);
            l.easing = "function" === typeof l.easing ? l.easing : Math[l.easing] || Math.easeInOutSine;
            l.curAnim = a.merge(f);
            a.objectEach(f, function(e, m) {
                a.stop(p, m);
                u = new a.Fx(p, l, m);
                w = null;
                "d" === m ? (u.paths = u.initPath(p, p.d, f.d), u.toD = f.d, r = 0, w = 1) : p.attr ? r = p.attr(m) : (r = parseFloat(a.getStyle(p, m)) ||
                    0, "opacity" !== m && (n = "px"));
                w || (w = e);
                w && w.match && w.match("px") && (w = w.replace(/px/g, ""));
                u.run(r, w, n)
            })
        };
        a.seriesType = function(p, f, l, r, n) {
            var w = a.getOptions(),
                u = a.seriesTypes;
            w.plotOptions[p] = a.merge(w.plotOptions[f], l);
            u[p] = a.extendClass(u[f] || function() {}, r);
            u[p].prototype.type = p;
            n && (u[p].prototype.pointClass = a.extendClass(a.Point, n));
            return u[p]
        };
        a.uniqueKey = function() {
            var a = Math.random().toString(36).substring(2, 9),
                f = 0;
            return function() { return "highcharts-" + a + "-" + f++ }
        }();
        H.jQuery && (H.jQuery.fn.highcharts =
            function() { var p = [].slice.call(arguments); if (this[0]) return p[0] ? (new(a[a.isString(p[0]) ? p.shift() : "Chart"])(this[0], p[0], p[1]), this) : E[a.attr(this[0], "data-highcharts-chart")] })
    })(M);
    (function(a) {
        var E = a.each,
            D = a.isNumber,
            H = a.map,
            p = a.merge,
            f = a.pInt;
        a.Color = function(l) {
            if (!(this instanceof a.Color)) return new a.Color(l);
            this.init(l)
        };
        a.Color.prototype = {
            parsers: [{
                regex: /rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]?(?:\.[0-9]+)?)\s*\)/,
                parse: function(a) {
                    return [f(a[1]), f(a[2]),
                        f(a[3]), parseFloat(a[4], 10)
                    ]
                }
            }, { regex: /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/, parse: function(a) { return [f(a[1]), f(a[2]), f(a[3]), 1] } }],
            names: { none: "rgba(255,255,255,0)", white: "#ffffff", black: "#000000" },
            init: function(l) {
                var f, n, w, u;
                if ((this.input = l = this.names[l && l.toLowerCase ? l.toLowerCase() : ""] || l) && l.stops) this.stops = H(l.stops, function(e) { return new a.Color(e[1]) });
                else if (l && l.charAt && "#" === l.charAt() && (f = l.length, l = parseInt(l.substr(1), 16), 7 === f ? n = [(l & 16711680) >> 16, (l & 65280) >>
                        8, l & 255, 1
                    ] : 4 === f && (n = [(l & 3840) >> 4 | (l & 3840) >> 8, (l & 240) >> 4 | l & 240, (l & 15) << 4 | l & 15, 1])), !n)
                    for (w = this.parsers.length; w-- && !n;) u = this.parsers[w], (f = u.regex.exec(l)) && (n = u.parse(f));
                this.rgba = n || []
            },
            get: function(a) {
                var f = this.input,
                    n = this.rgba,
                    l;
                this.stops ? (l = p(f), l.stops = [].concat(l.stops), E(this.stops, function(n, e) { l.stops[e] = [l.stops[e][0], n.get(a)] })) : l = n && D(n[0]) ? "rgb" === a || !a && 1 === n[3] ? "rgb(" + n[0] + "," + n[1] + "," + n[2] + ")" : "a" === a ? n[3] : "rgba(" + n.join(",") + ")" : f;
                return l
            },
            brighten: function(a) {
                var l, n = this.rgba;
                if (this.stops) E(this.stops, function(n) { n.brighten(a) });
                else if (D(a) && 0 !== a)
                    for (l = 0; 3 > l; l++) n[l] += f(255 * a), 0 > n[l] && (n[l] = 0), 255 < n[l] && (n[l] = 255);
                return this
            },
            setOpacity: function(a) { this.rgba[3] = a; return this },
            tweenTo: function(a, f) {
                var n = this.rgba,
                    l = a.rgba;
                l.length && n && n.length ? (a = 1 !== l[3] || 1 !== n[3], f = (a ? "rgba(" : "rgb(") + Math.round(l[0] + (n[0] - l[0]) * (1 - f)) + "," + Math.round(l[1] + (n[1] - l[1]) * (1 - f)) + "," + Math.round(l[2] + (n[2] - l[2]) * (1 - f)) + (a ? "," + (l[3] + (n[3] - l[3]) * (1 - f)) : "") + ")") : f = a.input || "none";
                return f
            }
        };
        a.color = function(l) { return new a.Color(l) }
    })(M);
    (function(a) {
        var E, D, H = a.addEvent,
            p = a.animate,
            f = a.attr,
            l = a.charts,
            r = a.color,
            n = a.css,
            w = a.createElement,
            u = a.defined,
            e = a.deg2rad,
            h = a.destroyObjectProperties,
            m = a.doc,
            d = a.each,
            c = a.extend,
            b = a.erase,
            k = a.grep,
            z = a.hasTouch,
            B = a.inArray,
            I = a.isArray,
            x = a.isFirefox,
            K = a.isMS,
            t = a.isObject,
            C = a.isString,
            N = a.isWebKit,
            q = a.merge,
            A = a.noop,
            F = a.objectEach,
            G = a.pick,
            g = a.pInt,
            v = a.removeEvent,
            Q = a.stop,
            L = a.svg,
            P = a.SVG_NS,
            J = a.symbolSizes,
            R = a.win;
        E = a.SVGElement = function() { return this };
        c(E.prototype, {
            opacity: 1,
            SVG_NS: P,
            textProps: "direction fontSize fontWeight fontFamily fontStyle color lineHeight width textAlign textDecoration textOverflow textOutline".split(" "),
            init: function(a, g) {
                this.element = "span" === g ? w(g) : m.createElementNS(this.SVG_NS, g);
                this.renderer = a
            },
            animate: function(y, g, b) {
                g = a.animObject(G(g, this.renderer.globalAnimation, !0));
                0 !== g.duration ? (b && (g.complete = b), p(this, y, g)) : (this.attr(y, null, b), g.step && g.step.call(this));
                return this
            },
            colorGradient: function(y, g, b) {
                var v =
                    this.renderer,
                    c, O, k, e, z, h, m, L, A, J, t = [],
                    x;
                y.radialGradient ? O = "radialGradient" : y.linearGradient && (O = "linearGradient");
                O && (k = y[O], z = v.gradients, m = y.stops, J = b.radialReference, I(k) && (y[O] = k = { x1: k[0], y1: k[1], x2: k[2], y2: k[3], gradientUnits: "userSpaceOnUse" }), "radialGradient" === O && J && !u(k.gradientUnits) && (e = k, k = q(k, v.getRadialAttr(J, e), { gradientUnits: "userSpaceOnUse" })), F(k, function(a, y) { "id" !== y && t.push(y, a) }), F(m, function(a) { t.push(a) }), t = t.join(","), z[t] ? J = z[t].attr("id") : (k.id = J = a.uniqueKey(), z[t] = h = v.createElement(O).attr(k).add(v.defs),
                    h.radAttr = e, h.stops = [], d(m, function(y) {
                        0 === y[1].indexOf("rgba") ? (c = a.color(y[1]), L = c.get("rgb"), A = c.get("a")) : (L = y[1], A = 1);
                        y = v.createElement("stop").attr({ offset: y[0], "stop-color": L, "stop-opacity": A }).add(h);
                        h.stops.push(y)
                    })), x = "url(" + v.url + "#" + J + ")", b.setAttribute(g, x), b.gradient = t, y.toString = function() { return x })
            },
            applyTextOutline: function(y) {
                var g = this.element,
                    v, c, k, q, e; - 1 !== y.indexOf("contrast") && (y = y.replace(/contrast/g, this.renderer.getContrast(g.style.fill)));
                y = y.split(" ");
                c = y[y.length - 1];
                if ((k = y[0]) && "none" !== k && a.svg) {
                    this.fakeTS = !0;
                    y = [].slice.call(g.getElementsByTagName("tspan"));
                    this.ySetter = this.xSetter;
                    k = k.replace(/(^[\d\.]+)(.*?)$/g, function(a, y, g) { return 2 * y + g });
                    for (e = y.length; e--;) v = y[e], "highcharts-text-outline" === v.getAttribute("class") && b(y, g.removeChild(v));
                    q = g.firstChild;
                    d(y, function(a, y) {
                        0 === y && (a.setAttribute("x", g.getAttribute("x")), y = g.getAttribute("y"), a.setAttribute("y", y || 0), null === y && g.setAttribute("y", 0));
                        a = a.cloneNode(1);
                        f(a, {
                            "class": "highcharts-text-outline",
                            fill: c,
                            stroke: c,
                            "stroke-width": k,
                            "stroke-linejoin": "round"
                        });
                        g.insertBefore(a, q)
                    })
                }
            },
            attr: function(a, g, b, v) {
                var y, c = this.element,
                    k, d = this,
                    O, q;
                "string" === typeof a && void 0 !== g && (y = a, a = {}, a[y] = g);
                "string" === typeof a ? d = (this[a + "Getter"] || this._defaultGetter).call(this, a, c) : (F(a, function(y, g) {
                    O = !1;
                    v || Q(this, g);
                    this.symbolName && /^(x|y|width|height|r|start|end|innerR|anchorX|anchorY)$/.test(g) && (k || (this.symbolAttr(a), k = !0), O = !0);
                    !this.rotation || "x" !== g && "y" !== g || (this.doTransform = !0);
                    O || (q = this[g + "Setter"] ||
                        this._defaultSetter, q.call(this, y, g, c), this.shadows && /^(width|height|visibility|x|y|d|transform|cx|cy|r)$/.test(g) && this.updateShadows(g, y, q))
                }, this), this.afterSetters());
                b && b();
                return d
            },
            afterSetters: function() { this.doTransform && (this.updateTransform(), this.doTransform = !1) },
            updateShadows: function(a, g, b) { for (var y = this.shadows, v = y.length; v--;) b.call(y[v], "height" === a ? Math.max(g - (y[v].cutHeight || 0), 0) : "d" === a ? this.d : g, a, y[v]) },
            addClass: function(a, g) {
                var y = this.attr("class") || ""; - 1 === y.indexOf(a) &&
                    (g || (a = (y + (y ? " " : "") + a).replace("  ", " ")), this.attr("class", a));
                return this
            },
            hasClass: function(a) { return -1 !== B(a, (this.attr("class") || "").split(" ")) },
            removeClass: function(a) { return this.attr("class", (this.attr("class") || "").replace(a, "")) },
            symbolAttr: function(a) {
                var y = this;
                d("x y r start end width height innerR anchorX anchorY".split(" "), function(g) { y[g] = G(a[g], y[g]) });
                y.attr({ d: y.renderer.symbols[y.symbolName](y.x, y.y, y.width, y.height, y) })
            },
            clip: function(a) {
                return this.attr("clip-path", a ? "url(" +
                    this.renderer.url + "#" + a.id + ")" : "none")
            },
            crisp: function(a, g) {
                var y;
                g = g || a.strokeWidth || 0;
                y = Math.round(g) % 2 / 2;
                a.x = Math.floor(a.x || this.x || 0) + y;
                a.y = Math.floor(a.y || this.y || 0) + y;
                a.width = Math.floor((a.width || this.width || 0) - 2 * y);
                a.height = Math.floor((a.height || this.height || 0) - 2 * y);
                u(a.strokeWidth) && (a.strokeWidth = g);
                return a
            },
            css: function(a) {
                var y = this.styles,
                    b = {},
                    v = this.element,
                    k, d = "",
                    q, e = !y,
                    z = ["textOutline", "textOverflow", "width"];
                a && a.color && (a.fill = a.color);
                y && F(a, function(a, g) { a !== y[g] && (b[g] = a, e = !0) });
                e && (y && (a = c(y, b)), k = this.textWidth = a && a.width && "auto" !== a.width && "text" === v.nodeName.toLowerCase() && g(a.width), this.styles = a, k && !L && this.renderer.forExport && delete a.width, K && !L ? n(this.element, a) : (q = function(a, y) { return "-" + y.toLowerCase() }, F(a, function(a, y) {-1 === B(y, z) && (d += y.replace(/([A-Z])/g, q) + ":" + a + ";") }), d && f(v, "style", d)), this.added && ("text" === this.element.nodeName && this.renderer.buildText(this), a && a.textOutline && this.applyTextOutline(a.textOutline)));
                return this
            },
            strokeWidth: function() {
                return this["stroke-width"] ||
                    0
            },
            on: function(a, g) {
                var y = this,
                    b = y.element;
                z && "click" === a ? (b.ontouchstart = function(a) {
                    y.touchEventFired = Date.now();
                    a.preventDefault();
                    g.call(b, a)
                }, b.onclick = function(a) {
                    (-1 === R.navigator.userAgent.indexOf("Android") || 1100 < Date.now() - (y.touchEventFired || 0)) && g.call(b, a)
                }) : b["on" + a] = g;
                return this
            },
            setRadialReference: function(a) {
                var y = this.renderer.gradients[this.element.gradient];
                this.element.radialReference = a;
                y && y.radAttr && y.animate(this.renderer.getRadialAttr(a, y.radAttr));
                return this
            },
            translate: function(a,
                g) { return this.attr({ translateX: a, translateY: g }) },
            invert: function(a) {
                this.inverted = a;
                this.updateTransform();
                return this
            },
            updateTransform: function() {
                var a = this.translateX || 0,
                    g = this.translateY || 0,
                    b = this.scaleX,
                    v = this.scaleY,
                    c = this.inverted,
                    k = this.rotation,
                    d = this.matrix,
                    q = this.element;
                c && (a += this.width, g += this.height);
                a = ["translate(" + a + "," + g + ")"];
                u(d) && a.push("matrix(" + d.join(",") + ")");
                c ? a.push("rotate(90) scale(-1,1)") : k && a.push("rotate(" + k + " " + G(this.rotationOriginX, q.getAttribute("x"), 0) + " " + G(this.rotationOriginY,
                    q.getAttribute("y") || 0) + ")");
                (u(b) || u(v)) && a.push("scale(" + G(b, 1) + " " + G(v, 1) + ")");
                a.length && q.setAttribute("transform", a.join(" "))
            },
            toFront: function() {
                var a = this.element;
                a.parentNode.appendChild(a);
                return this
            },
            align: function(a, g, v) {
                var y, c, k, d, q = {};
                c = this.renderer;
                k = c.alignedObjects;
                var e, O;
                if (a) { if (this.alignOptions = a, this.alignByTranslate = g, !v || C(v)) this.alignTo = y = v || "renderer", b(k, this), k.push(this), v = null } else a = this.alignOptions, g = this.alignByTranslate, y = this.alignTo;
                v = G(v, c[y], c);
                y = a.align;
                c = a.verticalAlign;
                k = (v.x || 0) + (a.x || 0);
                d = (v.y || 0) + (a.y || 0);
                "right" === y ? e = 1 : "center" === y && (e = 2);
                e && (k += (v.width - (a.width || 0)) / e);
                q[g ? "translateX" : "x"] = Math.round(k);
                "bottom" === c ? O = 1 : "middle" === c && (O = 2);
                O && (d += (v.height - (a.height || 0)) / O);
                q[g ? "translateY" : "y"] = Math.round(d);
                this[this.placed ? "animate" : "attr"](q);
                this.placed = !0;
                this.alignAttr = q;
                return this
            },
            getBBox: function(a, g) {
                var y, b = this.renderer,
                    v, k = this.element,
                    q = this.styles,
                    O, z = this.textStr,
                    h, m = b.cache,
                    L = b.cacheKeys,
                    A;
                g = G(g, this.rotation);
                v = g * e;
                O = q && q.fontSize;
                u(z) && (A = z.toString(), -1 === A.indexOf("\x3c") && (A = A.replace(/[0-9]/g, "0")), A += ["", g || 0, O, q && q.width, q && q.textOverflow].join());
                A && !a && (y = m[A]);
                if (!y) {
                    if (k.namespaceURI === this.SVG_NS || b.forExport) {
                        try {
                            (h = this.fakeTS && function(a) { d(k.querySelectorAll(".highcharts-text-outline"), function(y) { y.style.display = a }) }) && h("none"), y = k.getBBox ? c({}, k.getBBox()) : { width: k.offsetWidth, height: k.offsetHeight }, h && h("")
                        } catch (W) {}
                        if (!y || 0 > y.width) y = { width: 0, height: 0 }
                    } else y = this.htmlGetBBox();
                    b.isSVG &&
                        (a = y.width, b = y.height, q && "11px" === q.fontSize && 17 === Math.round(b) && (y.height = b = 14), g && (y.width = Math.abs(b * Math.sin(v)) + Math.abs(a * Math.cos(v)), y.height = Math.abs(b * Math.cos(v)) + Math.abs(a * Math.sin(v))));
                    if (A && 0 < y.height) {
                        for (; 250 < L.length;) delete m[L.shift()];
                        m[A] || L.push(A);
                        m[A] = y
                    }
                }
                return y
            },
            show: function(a) { return this.attr({ visibility: a ? "inherit" : "visible" }) },
            hide: function() { return this.attr({ visibility: "hidden" }) },
            fadeOut: function(a) {
                var y = this;
                y.animate({ opacity: 0 }, { duration: a || 150, complete: function() { y.attr({ y: -9999 }) } })
            },
            add: function(a) {
                var y = this.renderer,
                    g = this.element,
                    b;
                a && (this.parentGroup = a);
                this.parentInverted = a && a.inverted;
                void 0 !== this.textStr && y.buildText(this);
                this.added = !0;
                if (!a || a.handleZ || this.zIndex) b = this.zIndexSetter();
                b || (a ? a.element : y.box).appendChild(g);
                if (this.onAdd) this.onAdd();
                return this
            },
            safeRemoveChild: function(a) {
                var y = a.parentNode;
                y && y.removeChild(a)
            },
            destroy: function() {
                var a = this,
                    g = a.element || {},
                    v = a.renderer.isSVG && "SPAN" === g.nodeName && a.parentGroup,
                    c = g.ownerSVGElement;
                g.onclick = g.onmouseout =
                    g.onmouseover = g.onmousemove = g.point = null;
                Q(a);
                a.clipPath && c && (d(c.querySelectorAll("[clip-path],[CLIP-PATH]"), function(g) { g.getAttribute("clip-path").match(RegExp('[("]#' + a.clipPath.element.id + '[)"]')) && g.removeAttribute("clip-path") }), a.clipPath = a.clipPath.destroy());
                if (a.stops) {
                    for (c = 0; c < a.stops.length; c++) a.stops[c] = a.stops[c].destroy();
                    a.stops = null
                }
                a.safeRemoveChild(g);
                for (a.destroyShadows(); v && v.div && 0 === v.div.childNodes.length;) g = v.parentGroup, a.safeRemoveChild(v.div), delete v.div, v = g;
                a.alignTo &&
                    b(a.renderer.alignedObjects, a);
                F(a, function(g, y) { delete a[y] });
                return null
            },
            shadow: function(a, g, b) {
                var y = [],
                    v, c, k = this.element,
                    d, q, e, z;
                if (!a) this.destroyShadows();
                else if (!this.shadows) {
                    q = G(a.width, 3);
                    e = (a.opacity || .15) / q;
                    z = this.parentInverted ? "(-1,-1)" : "(" + G(a.offsetX, 1) + ", " + G(a.offsetY, 1) + ")";
                    for (v = 1; v <= q; v++) c = k.cloneNode(0), d = 2 * q + 1 - 2 * v, f(c, { isShadow: "true", stroke: a.color || "#000000", "stroke-opacity": e * v, "stroke-width": d, transform: "translate" + z, fill: "none" }), b && (f(c, "height", Math.max(f(c, "height") -
                        d, 0)), c.cutHeight = d), g ? g.element.appendChild(c) : k.parentNode && k.parentNode.insertBefore(c, k), y.push(c);
                    this.shadows = y
                }
                return this
            },
            destroyShadows: function() {
                d(this.shadows || [], function(a) { this.safeRemoveChild(a) }, this);
                this.shadows = void 0
            },
            xGetter: function(a) { "circle" === this.element.nodeName && ("x" === a ? a = "cx" : "y" === a && (a = "cy")); return this._defaultGetter(a) },
            _defaultGetter: function(a) {
                a = G(this[a + "Value"], this[a], this.element ? this.element.getAttribute(a) : null, 0);
                /^[\-0-9\.]+$/.test(a) && (a = parseFloat(a));
                return a
            },
            dSetter: function(a, g, b) {
                a && a.join && (a = a.join(" "));
                /(NaN| {2}|^$)/.test(a) && (a = "M 0 0");
                this[g] !== a && (b.setAttribute(g, a), this[g] = a)
            },
            dashstyleSetter: function(a) {
                var b, v = this["stroke-width"];
                "inherit" === v && (v = 1);
                if (a = a && a.toLowerCase()) {
                    a = a.replace("shortdashdotdot", "3,1,1,1,1,1,").replace("shortdashdot", "3,1,1,1").replace("shortdot", "1,1,").replace("shortdash", "3,1,").replace("longdash", "8,3,").replace(/dot/g, "1,3,").replace("dash", "4,3,").replace(/,$/, "").split(",");
                    for (b = a.length; b--;) a[b] =
                        g(a[b]) * v;
                    a = a.join(",").replace(/NaN/g, "none");
                    this.element.setAttribute("stroke-dasharray", a)
                }
            },
            alignSetter: function(a) {
                this.alignValue = a;
                this.element.setAttribute("text-anchor", { left: "start", center: "middle", right: "end" }[a])
            },
            opacitySetter: function(a, g, b) {
                this[g] = a;
                b.setAttribute(g, a)
            },
            titleSetter: function(a) {
                var g = this.element.getElementsByTagName("title")[0];
                g || (g = m.createElementNS(this.SVG_NS, "title"), this.element.appendChild(g));
                g.firstChild && g.removeChild(g.firstChild);
                g.appendChild(m.createTextNode(String(G(a),
                    "").replace(/<[^>]*>/g, "")))
            },
            textSetter: function(a) { a !== this.textStr && (delete this.bBox, this.textStr = a, this.added && this.renderer.buildText(this)) },
            fillSetter: function(a, g, b) { "string" === typeof a ? b.setAttribute(g, a) : a && this.colorGradient(a, g, b) },
            visibilitySetter: function(a, g, b) {
                "inherit" === a ? b.removeAttribute(g) : this[g] !== a && b.setAttribute(g, a);
                this[g] = a
            },
            zIndexSetter: function(a, b) {
                var v = this.renderer,
                    y = this.parentGroup,
                    c = (y || v).element || v.box,
                    k, d = this.element,
                    q, e, v = c === v.box;
                k = this.added;
                var z;
                u(a) &&
                    (d.zIndex = a, a = +a, this[b] === a && (k = !1), this[b] = a);
                if (k) {
                    (a = this.zIndex) && y && (y.handleZ = !0);
                    b = c.childNodes;
                    for (z = b.length - 1; 0 <= z && !q; z--)
                        if (y = b[z], k = y.zIndex, e = !u(k), y !== d)
                            if (0 > a && e && !v && !z) c.insertBefore(d, b[z]), q = !0;
                            else if (g(k) <= a || e && (!u(a) || 0 <= a)) c.insertBefore(d, b[z + 1] || null), q = !0;
                    q || (c.insertBefore(d, b[v ? 3 : 0] || null), q = !0)
                }
                return q
            },
            _defaultSetter: function(a, g, b) { b.setAttribute(g, a) }
        });
        E.prototype.yGetter = E.prototype.xGetter;
        E.prototype.translateXSetter = E.prototype.translateYSetter = E.prototype.rotationSetter =
            E.prototype.verticalAlignSetter = E.prototype.rotationOriginXSetter = E.prototype.rotationOriginYSetter = E.prototype.scaleXSetter = E.prototype.scaleYSetter = E.prototype.matrixSetter = function(a, g) {
                this[g] = a;
                this.doTransform = !0
            };
        E.prototype["stroke-widthSetter"] = E.prototype.strokeSetter = function(a, g, b) {
            this[g] = a;
            this.stroke && this["stroke-width"] ? (E.prototype.fillSetter.call(this, this.stroke, "stroke", b), b.setAttribute("stroke-width", this["stroke-width"]), this.hasStroke = !0) : "stroke-width" === g && 0 === a && this.hasStroke &&
                (b.removeAttribute("stroke"), this.hasStroke = !1)
        };
        D = a.SVGRenderer = function() { this.init.apply(this, arguments) };
        c(D.prototype, {
            Element: E,
            SVG_NS: P,
            init: function(a, g, b, v, c, k) {
                var y;
                v = this.createElement("svg").attr({ version: "1.1", "class": "highcharts-root" }).css(this.getStyle(v));
                y = v.element;
                a.appendChild(y);
                f(a, "dir", "ltr"); - 1 === a.innerHTML.indexOf("xmlns") && f(y, "xmlns", this.SVG_NS);
                this.isSVG = !0;
                this.box = y;
                this.boxWrapper = v;
                this.alignedObjects = [];
                this.url = (x || N) && m.getElementsByTagName("base").length ?
                    R.location.href.replace(/#.*?$/, "").replace(/<[^>]*>/g, "").replace(/([\('\)])/g, "\\$1").replace(/ /g, "%20") : "";
                this.createElement("desc").add().element.appendChild(m.createTextNode("Created with Highcharts 6.0.4"));
                this.defs = this.createElement("defs").add();
                this.allowHTML = k;
                this.forExport = c;
                this.gradients = {};
                this.cache = {};
                this.cacheKeys = [];
                this.imgCount = 0;
                this.setSize(g, b, !1);
                var d;
                x && a.getBoundingClientRect && (g = function() {
                    n(a, { left: 0, top: 0 });
                    d = a.getBoundingClientRect();
                    n(a, {
                        left: Math.ceil(d.left) -
                            d.left + "px",
                        top: Math.ceil(d.top) - d.top + "px"
                    })
                }, g(), this.unSubPixelFix = H(R, "resize", g))
            },
            getStyle: function(a) { return this.style = c({ fontFamily: '"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif', fontSize: "12px" }, a) },
            setStyle: function(a) { this.boxWrapper.css(this.getStyle(a)) },
            isHidden: function() { return !this.boxWrapper.getBBox().width },
            destroy: function() {
                var a = this.defs;
                this.box = null;
                this.boxWrapper = this.boxWrapper.destroy();
                h(this.gradients || {});
                this.gradients = null;
                a && (this.defs = a.destroy());
                this.unSubPixelFix && this.unSubPixelFix();
                return this.alignedObjects = null
            },
            createElement: function(a) {
                var g = new this.Element;
                g.init(this, a);
                return g
            },
            draw: A,
            getRadialAttr: function(a, g) { return { cx: a[0] - a[2] / 2 + g.cx * a[2], cy: a[1] - a[2] / 2 + g.cy * a[2], r: g.r * a[2] } },
            getSpanWidth: function(a, g) { var b = a.getBBox(!0).width;!L && this.forExport && (b = this.measureSpanWidth(g.firstChild.data, a.styles)); return b },
            applyEllipsis: function(a, g, b, v) {
                var c = a.rotation,
                    y = b,
                    k, d = 0,
                    q = b.length,
                    e = function(a) {
                        g.removeChild(g.firstChild);
                        a && g.appendChild(m.createTextNode(a))
                    },
                    z;
                a.rotation = 0;
                y = this.getSpanWidth(a, g);
                if (z = y > v) {
                    for (; d <= q;) k = Math.ceil((d + q) / 2), y = b.substring(0, k) + "\u2026", e(y), y = this.getSpanWidth(a, g), d === q ? d = q + 1 : y > v ? q = k - 1 : d = k;
                    0 === q && e("")
                }
                a.rotation = c;
                return z
            },
            escapes: { "\x26": "\x26amp;", "\x3c": "\x26lt;", "\x3e": "\x26gt;", "'": "\x26#39;", '"': "\x26quot;" },
            buildText: function(a) {
                var b = a.element,
                    v = this,
                    c = v.forExport,
                    y = G(a.textStr, "").toString(),
                    q = -1 !== y.indexOf("\x3c"),
                    e = b.childNodes,
                    z, h, A, J, t = f(b, "x"),
                    x = a.styles,
                    B = a.textWidth,
                    l = x && x.lineHeight,
                    C = x && x.textOutline,
                    u = x && "ellipsis" === x.textOverflow,
                    Q = x && "nowrap" === x.whiteSpace,
                    w = x && x.fontSize,
                    R, I, r = e.length,
                    x = B && !a.added && this.box,
                    p = function(a) {
                        var c;
                        c = /(px|em)$/.test(a && a.style.fontSize) ? a.style.fontSize : w || v.style.fontSize || 12;
                        return l ? g(l) : v.fontMetrics(c, a.getAttribute("style") ? a : b).h
                    },
                    K = function(a) { F(v.escapes, function(g, b) { a = a.replace(new RegExp(g, "g"), b) }); return a };
                R = [y, u, Q, l, C, w, B].join();
                if (R !== a.textCache) {
                    for (a.textCache = R; r--;) b.removeChild(e[r]);
                    q || C || u || B ||
                        -1 !== y.indexOf(" ") ? (z = /<.*class="([^"]+)".*>/, h = /<.*style="([^"]+)".*>/, A = /<.*href="([^"]+)".*>/, x && x.appendChild(b), y = q ? y.replace(/<(b|strong)>/g, '\x3cspan style\x3d"font-weight:bold"\x3e').replace(/<(i|em)>/g, '\x3cspan style\x3d"font-style:italic"\x3e').replace(/<a/g, "\x3cspan").replace(/<\/(b|strong|i|em|a)>/g, "\x3c/span\x3e").split(/<br.*?>/g) : [y], y = k(y, function(a) { return "" !== a }), d(y, function(g, y) {
                            var k, q = 0;
                            g = g.replace(/^\s+|\s+$/g, "").replace(/<span/g, "|||\x3cspan").replace(/<\/span>/g, "\x3c/span\x3e|||");
                            k = g.split("|||");
                            d(k, function(g) {
                                if ("" !== g || 1 === k.length) {
                                    var d = {},
                                        e = m.createElementNS(v.SVG_NS, "tspan"),
                                        x, F;
                                    z.test(g) && (x = g.match(z)[1], f(e, "class", x));
                                    h.test(g) && (F = g.match(h)[1].replace(/(;| |^)color([ :])/, "$1fill$2"), f(e, "style", F));
                                    A.test(g) && !c && (f(e, "onclick", 'location.href\x3d"' + g.match(A)[1] + '"'), f(e, "class", "highcharts-anchor"), n(e, { cursor: "pointer" }));
                                    g = K(g.replace(/<[a-zA-Z\/](.|\n)*?>/g, "") || " ");
                                    if (" " !== g) {
                                        e.appendChild(m.createTextNode(g));
                                        q ? d.dx = 0 : y && null !== t && (d.x = t);
                                        f(e, d);
                                        b.appendChild(e);
                                        !q && I && (!L && c && n(e, { display: "block" }), f(e, "dy", p(e)));
                                        if (B) {
                                            d = g.replace(/([^\^])-/g, "$1- ").split(" ");
                                            x = 1 < k.length || y || 1 < d.length && !Q;
                                            var O = [],
                                                l, C = p(e),
                                                G = a.rotation;
                                            for (u && (J = v.applyEllipsis(a, e, g, B)); !u && x && (d.length || O.length);) a.rotation = 0, l = v.getSpanWidth(a, e), g = l > B, void 0 === J && (J = g), g && 1 !== d.length ? (e.removeChild(e.firstChild), O.unshift(d.pop())) : (d = O, O = [], d.length && !Q && (e = m.createElementNS(P, "tspan"), f(e, { dy: C, x: t }), F && f(e, "style", F), b.appendChild(e)), l > B && (B = l)), d.length && e.appendChild(m.createTextNode(d.join(" ").replace(/- /g,
                                                "-")));
                                            a.rotation = G
                                        }
                                        q++
                                    }
                                }
                            });
                            I = I || b.childNodes.length
                        }), J && a.attr("title", a.textStr), x && x.removeChild(b), C && a.applyTextOutline && a.applyTextOutline(C)) : b.appendChild(m.createTextNode(K(y)))
                }
            },
            getContrast: function(a) { a = r(a).rgba; return 510 < a[0] + a[1] + a[2] ? "#000000" : "#FFFFFF" },
            button: function(a, g, b, v, d, k, e, z, h) {
                var y = this.label(a, g, b, h, null, null, null, null, "button"),
                    m = 0;
                y.attr(q({ padding: 8, r: 2 }, d));
                var A, L, J, t;
                d = q({
                    fill: "#f7f7f7",
                    stroke: "#cccccc",
                    "stroke-width": 1,
                    style: {
                        color: "#333333",
                        cursor: "pointer",
                        fontWeight: "normal"
                    }
                }, d);
                A = d.style;
                delete d.style;
                k = q(d, { fill: "#e6e6e6" }, k);
                L = k.style;
                delete k.style;
                e = q(d, { fill: "#e6ebf5", style: { color: "#000000", fontWeight: "bold" } }, e);
                J = e.style;
                delete e.style;
                z = q(d, { style: { color: "#cccccc" } }, z);
                t = z.style;
                delete z.style;
                H(y.element, K ? "mouseover" : "mouseenter", function() { 3 !== m && y.setState(1) });
                H(y.element, K ? "mouseout" : "mouseleave", function() { 3 !== m && y.setState(m) });
                y.setState = function(a) {
                    1 !== a && (y.state = m = a);
                    y.removeClass(/highcharts-button-(normal|hover|pressed|disabled)/).addClass("highcharts-button-" + ["normal", "hover", "pressed", "disabled"][a || 0]);
                    y.attr([d, k, e, z][a || 0]).css([A, L, J, t][a || 0])
                };
                y.attr(d).css(c({ cursor: "default" }, A));
                return y.on("click", function(a) { 3 !== m && v.call(y, a) })
            },
            crispLine: function(a, g) {
                a[1] === a[4] && (a[1] = a[4] = Math.round(a[1]) - g % 2 / 2);
                a[2] === a[5] && (a[2] = a[5] = Math.round(a[2]) + g % 2 / 2);
                return a
            },
            path: function(a) {
                var g = { fill: "none" };
                I(a) ? g.d = a : t(a) && c(g, a);
                return this.createElement("path").attr(g)
            },
            circle: function(a, g, b) {
                a = t(a) ? a : { x: a, y: g, r: b };
                g = this.createElement("circle");
                g.xSetter =
                    g.ySetter = function(a, g, b) { b.setAttribute("c" + g, a) };
                return g.attr(a)
            },
            arc: function(a, g, b, v, c, d) {
                t(a) ? (v = a, g = v.y, b = v.r, a = v.x) : v = { innerR: v, start: c, end: d };
                a = this.symbol("arc", a, g, b, b, v);
                a.r = b;
                return a
            },
            rect: function(a, g, b, v, c, d) {
                c = t(a) ? a.r : c;
                var k = this.createElement("rect");
                a = t(a) ? a : void 0 === a ? {} : { x: a, y: g, width: Math.max(b, 0), height: Math.max(v, 0) };
                void 0 !== d && (a.strokeWidth = d, a = k.crisp(a));
                a.fill = "none";
                c && (a.r = c);
                k.rSetter = function(a, g, b) { f(b, { rx: a, ry: a }) };
                return k.attr(a)
            },
            setSize: function(a, g, b) {
                var v =
                    this.alignedObjects,
                    c = v.length;
                this.width = a;
                this.height = g;
                for (this.boxWrapper.animate({ width: a, height: g }, { step: function() { this.attr({ viewBox: "0 0 " + this.attr("width") + " " + this.attr("height") }) }, duration: G(b, !0) ? void 0 : 0 }); c--;) v[c].align()
            },
            g: function(a) { var g = this.createElement("g"); return a ? g.attr({ "class": "highcharts-" + a }) : g },
            image: function(a, g, b, v, d) {
                var k = { preserveAspectRatio: "none" };
                1 < arguments.length && c(k, { x: g, y: b, width: v, height: d });
                k = this.createElement("image").attr(k);
                k.element.setAttributeNS ?
                    k.element.setAttributeNS("http://www.w3.org/1999/xlink", "href", a) : k.element.setAttribute("hc-svg-href", a);
                return k
            },
            symbol: function(a, g, b, v, k, q) {
                var e = this,
                    y, z = /^url\((.*?)\)$/,
                    h = z.test(a),
                    A = !h && (this.symbols[a] ? a : "circle"),
                    L = A && this.symbols[A],
                    t = u(g) && L && L.call(this.symbols, Math.round(g), Math.round(b), v, k, q),
                    x, F;
                L ? (y = this.path(t), y.attr("fill", "none"), c(y, { symbolName: A, x: g, y: b, width: v, height: k }), q && c(y, q)) : h && (x = a.match(z)[1], y = this.image(x), y.imgwidth = G(J[x] && J[x].width, q && q.width), y.imgheight =
                    G(J[x] && J[x].height, q && q.height), F = function() { y.attr({ width: y.width, height: y.height }) }, d(["width", "height"], function(a) {
                        y[a + "Setter"] = function(a, g) {
                            var b = {},
                                v = this["img" + g],
                                c = "width" === g ? "translateX" : "translateY";
                            this[g] = a;
                            u(v) && (this.element && this.element.setAttribute(g, v), this.alignByTranslate || (b[c] = ((this[g] || 0) - v) / 2, this.attr(b)))
                        }
                    }), u(g) && y.attr({ x: g, y: b }), y.isImg = !0, u(y.imgwidth) && u(y.imgheight) ? F() : (y.attr({ width: 0, height: 0 }), w("img", {
                        onload: function() {
                            var a = l[e.chartIndex];
                            0 === this.width &&
                                (n(this, { position: "absolute", top: "-999em" }), m.body.appendChild(this));
                            J[x] = { width: this.width, height: this.height };
                            y.imgwidth = this.width;
                            y.imgheight = this.height;
                            y.element && F();
                            this.parentNode && this.parentNode.removeChild(this);
                            e.imgCount--;
                            if (!e.imgCount && a && a.onload) a.onload()
                        },
                        src: x
                    }), this.imgCount++));
                return y
            },
            symbols: {
                circle: function(a, g, b, v) { return this.arc(a + b / 2, g + v / 2, b / 2, v / 2, { start: 0, end: 2 * Math.PI, open: !1 }) },
                square: function(a, g, b, v) { return ["M", a, g, "L", a + b, g, a + b, g + v, a, g + v, "Z"] },
                triangle: function(a,
                    g, b, v) { return ["M", a + b / 2, g, "L", a + b, g + v, a, g + v, "Z"] },
                "triangle-down": function(a, g, b, v) { return ["M", a, g, "L", a + b, g, a + b / 2, g + v, "Z"] },
                diamond: function(a, g, b, v) { return ["M", a + b / 2, g, "L", a + b, g + v / 2, a + b / 2, g + v, a, g + v / 2, "Z"] },
                arc: function(a, g, b, v, c) {
                    var k = c.start,
                        d = c.r || b,
                        q = c.r || v || b,
                        e = c.end - .001;
                    b = c.innerR;
                    v = G(c.open, .001 > Math.abs(c.end - c.start - 2 * Math.PI));
                    var y = Math.cos(k),
                        z = Math.sin(k),
                        h = Math.cos(e),
                        e = Math.sin(e);
                    c = .001 > c.end - k - Math.PI ? 0 : 1;
                    d = ["M", a + d * y, g + q * z, "A", d, q, 0, c, 1, a + d * h, g + q * e];
                    u(b) && d.push(v ? "M" : "L", a + b *
                        h, g + b * e, "A", b, b, 0, c, 0, a + b * y, g + b * z);
                    d.push(v ? "" : "Z");
                    return d
                },
                callout: function(a, g, b, v, c) {
                    var d = Math.min(c && c.r || 0, b, v),
                        k = d + 6,
                        q = c && c.anchorX;
                    c = c && c.anchorY;
                    var e;
                    e = ["M", a + d, g, "L", a + b - d, g, "C", a + b, g, a + b, g, a + b, g + d, "L", a + b, g + v - d, "C", a + b, g + v, a + b, g + v, a + b - d, g + v, "L", a + d, g + v, "C", a, g + v, a, g + v, a, g + v - d, "L", a, g + d, "C", a, g, a, g, a + d, g];
                    q && q > b ? c > g + k && c < g + v - k ? e.splice(13, 3, "L", a + b, c - 6, a + b + 6, c, a + b, c + 6, a + b, g + v - d) : e.splice(13, 3, "L", a + b, v / 2, q, c, a + b, v / 2, a + b, g + v - d) : q && 0 > q ? c > g + k && c < g + v - k ? e.splice(33, 3, "L", a, c + 6, a - 6, c, a, c - 6,
                        a, g + d) : e.splice(33, 3, "L", a, v / 2, q, c, a, v / 2, a, g + d) : c && c > v && q > a + k && q < a + b - k ? e.splice(23, 3, "L", q + 6, g + v, q, g + v + 6, q - 6, g + v, a + d, g + v) : c && 0 > c && q > a + k && q < a + b - k && e.splice(3, 3, "L", q - 6, g, q, g - 6, q + 6, g, b - d, g);
                    return e
                }
            },
            clipRect: function(g, b, v, c) {
                var d = a.uniqueKey(),
                    k = this.createElement("clipPath").attr({ id: d }).add(this.defs);
                g = this.rect(g, b, v, c, 0).add(k);
                g.id = d;
                g.clipPath = k;
                g.count = 0;
                return g
            },
            text: function(a, g, b, v) {
                var c = {};
                if (v && (this.allowHTML || !this.forExport)) return this.html(a, g, b);
                c.x = Math.round(g || 0);
                b && (c.y =
                    Math.round(b));
                if (a || 0 === a) c.text = a;
                a = this.createElement("text").attr(c);
                v || (a.xSetter = function(a, g, b) {
                    var v = b.getElementsByTagName("tspan"),
                        c, d = b.getAttribute(g),
                        k;
                    for (k = 0; k < v.length; k++) c = v[k], c.getAttribute(g) === d && c.setAttribute(g, a);
                    b.setAttribute(g, a)
                });
                return a
            },
            fontMetrics: function(a, b) {
                a = a || b && b.style && b.style.fontSize || this.style && this.style.fontSize;
                a = /px/.test(a) ? g(a) : /em/.test(a) ? parseFloat(a) * (b ? this.fontMetrics(null, b.parentNode).f : 16) : 12;
                b = 24 > a ? a + 3 : Math.round(1.2 * a);
                return {
                    h: b,
                    b: Math.round(.8 *
                        b),
                    f: a
                }
            },
            rotCorr: function(a, g, b) {
                var v = a;
                g && b && (v = Math.max(v * Math.cos(g * e), 4));
                return { x: -a / 3 * Math.sin(g * e), y: v }
            },
            label: function(g, b, k, e, z, h, m, A, L) {
                var y = this,
                    J = y.g("button" !== L && "label"),
                    t = J.text = y.text("", 0, 0, m).attr({ zIndex: 1 }),
                    x, F, n = 0,
                    B = 3,
                    l = 0,
                    C, f, Q, G, w, R = {},
                    I, P, r = /^url\((.*?)\)$/.test(e),
                    p = r,
                    K, O, N, T;
                L && J.addClass("highcharts-" + L);
                p = r;
                K = function() { return (I || 0) % 2 / 2 };
                O = function() {
                    var a = t.element.style,
                        g = {};
                    F = (void 0 === C || void 0 === f || w) && u(t.textStr) && t.getBBox();
                    J.width = (C || F.width || 0) + 2 * B + l;
                    J.height =
                        (f || F.height || 0) + 2 * B;
                    P = B + y.fontMetrics(a && a.fontSize, t).b;
                    p && (x || (J.box = x = y.symbols[e] || r ? y.symbol(e) : y.rect(), x.addClass(("button" === L ? "" : "highcharts-label-box") + (L ? " highcharts-" + L + "-box" : "")), x.add(J), a = K(), g.x = a, g.y = (A ? -P : 0) + a), g.width = Math.round(J.width), g.height = Math.round(J.height), x.attr(c(g, R)), R = {})
                };
                N = function() {
                    var a = l + B,
                        g;
                    g = A ? 0 : P;
                    u(C) && F && ("center" === w || "right" === w) && (a += { center: .5, right: 1 }[w] * (C - F.width));
                    if (a !== t.x || g !== t.y) t.attr("x", a), void 0 !== g && t.attr("y", g);
                    t.x = a;
                    t.y = g
                };
                T = function(a,
                    g) { x ? x.attr(a, g) : R[a] = g };
                J.onAdd = function() {
                    t.add(J);
                    J.attr({ text: g || 0 === g ? g : "", x: b, y: k });
                    x && u(z) && J.attr({ anchorX: z, anchorY: h })
                };
                J.widthSetter = function(g) { C = a.isNumber(g) ? g : null };
                J.heightSetter = function(a) { f = a };
                J["text-alignSetter"] = function(a) { w = a };
                J.paddingSetter = function(a) { u(a) && a !== B && (B = J.padding = a, N()) };
                J.paddingLeftSetter = function(a) { u(a) && a !== l && (l = a, N()) };
                J.alignSetter = function(a) {
                    a = { left: 0, center: .5, right: 1 }[a];
                    a !== n && (n = a, F && J.attr({ x: Q }))
                };
                J.textSetter = function(a) {
                    void 0 !== a && t.textSetter(a);
                    O();
                    N()
                };
                J["stroke-widthSetter"] = function(a, g) {
                    a && (p = !0);
                    I = this["stroke-width"] = a;
                    T(g, a)
                };
                J.strokeSetter = J.fillSetter = J.rSetter = function(a, g) {
                    "r" !== g && ("fill" === g && a && (p = !0), J[g] = a);
                    T(g, a)
                };
                J.anchorXSetter = function(a, g) {
                    z = J.anchorX = a;
                    T(g, Math.round(a) - K() - Q)
                };
                J.anchorYSetter = function(a, g) {
                    h = J.anchorY = a;
                    T(g, a - G)
                };
                J.xSetter = function(a) {
                    J.x = a;
                    n && (a -= n * ((C || F.width) + 2 * B));
                    Q = Math.round(a);
                    J.attr("translateX", Q)
                };
                J.ySetter = function(a) {
                    G = J.y = Math.round(a);
                    J.attr("translateY", G)
                };
                var U = J.css;
                return c(J, {
                    css: function(a) {
                        if (a) {
                            var g = {};
                            a = q(a);
                            d(J.textProps, function(b) { void 0 !== a[b] && (g[b] = a[b], delete a[b]) });
                            t.css(g)
                        }
                        return U.call(J, a)
                    },
                    getBBox: function() { return { width: F.width + 2 * B, height: F.height + 2 * B, x: F.x - B, y: F.y - B } },
                    shadow: function(a) { a && (O(), x && x.shadow(a)); return J },
                    destroy: function() {
                        v(J.element, "mouseenter");
                        v(J.element, "mouseleave");
                        t && (t = t.destroy());
                        x && (x = x.destroy());
                        E.prototype.destroy.call(J);
                        J = y = O = N = T = null
                    }
                })
            }
        });
        a.Renderer = D
    })(M);
    (function(a) {
        var E = a.attr,
            D = a.createElement,
            H = a.css,
            p = a.defined,
            f = a.each,
            l = a.extend,
            r = a.isFirefox,
            n = a.isMS,
            w = a.isWebKit,
            u = a.pick,
            e = a.pInt,
            h = a.SVGRenderer,
            m = a.win,
            d = a.wrap;
        l(a.SVGElement.prototype, {
            htmlCss: function(a) {
                var b = this.element;
                if (b = a && "SPAN" === b.tagName && a.width) delete a.width, this.textWidth = b, this.updateTransform();
                a && "ellipsis" === a.textOverflow && (a.whiteSpace = "nowrap", a.overflow = "hidden");
                this.styles = l(this.styles, a);
                H(this.element, a);
                return this
            },
            htmlGetBBox: function() { var a = this.element; return { x: a.offsetLeft, y: a.offsetTop, width: a.offsetWidth, height: a.offsetHeight } },
            htmlUpdateTransform: function() {
                if (this.added) {
                    var a = this.renderer,
                        b = this.element,
                        d = this.translateX || 0,
                        z = this.translateY || 0,
                        h = this.x || 0,
                        m = this.y || 0,
                        x = this.textAlign || "left",
                        n = { left: 0, center: .5, right: 1 }[x],
                        t = this.styles;
                    H(b, { marginLeft: d, marginTop: z });
                    this.shadows && f(this.shadows, function(a) { H(a, { marginLeft: d + 1, marginTop: z + 1 }) });
                    this.inverted && f(b.childNodes, function(c) { a.invertChild(c, b) });
                    if ("SPAN" === b.tagName) {
                        var l = this.rotation,
                            u = e(this.textWidth),
                            q = t && t.whiteSpace,
                            A = [l, x, b.innerHTML, this.textWidth,
                                this.textAlign
                            ].join();
                        A !== this.cTT && (t = a.fontMetrics(b.style.fontSize).b, p(l) && this.setSpanRotation(l, n, t), H(b, { width: "", whiteSpace: q || "nowrap" }), b.offsetWidth > u && /[ \-]/.test(b.textContent || b.innerText) && H(b, { width: u + "px", display: "block", whiteSpace: q || "normal" }), this.getSpanCorrection(b.offsetWidth, t, n, l, x));
                        H(b, { left: h + (this.xCorr || 0) + "px", top: m + (this.yCorr || 0) + "px" });
                        w && (t = b.offsetHeight);
                        this.cTT = A
                    }
                } else this.alignOnAdd = !0
            },
            setSpanRotation: function(a, b, d) {
                var c = {},
                    k = this.renderer.getTransformKey();
                c[k] = c.transform = "rotate(" + a + "deg)";
                c[k + (r ? "Origin" : "-origin")] = c.transformOrigin = 100 * b + "% " + d + "px";
                H(this.element, c)
            },
            getSpanCorrection: function(a, b, d) {
                this.xCorr = -a * d;
                this.yCorr = -b
            }
        });
        l(h.prototype, {
            getTransformKey: function() { return n && !/Edge/.test(m.navigator.userAgent) ? "-ms-transform" : w ? "-webkit-transform" : r ? "MozTransform" : m.opera ? "-o-transform" : "" },
            html: function(a, b, k) {
                var c = this.createElement("span"),
                    e = c.element,
                    h = c.renderer,
                    m = h.isSVG,
                    w = function(a, b) {
                        f(["opacity", "visibility"], function(c) {
                            d(a,
                                c + "Setter",
                                function(a, c, d, k) {
                                    a.call(this, c, d, k);
                                    b[d] = c
                                })
                        })
                    };
                c.textSetter = function(a) {
                    a !== e.innerHTML && delete this.bBox;
                    this.textStr = a;
                    e.innerHTML = u(a, "");
                    c.htmlUpdateTransform()
                };
                m && w(c, c.element.style);
                c.xSetter = c.ySetter = c.alignSetter = c.rotationSetter = function(a, b) {
                    "align" === b && (b = "textAlign");
                    c[b] = a;
                    c.htmlUpdateTransform()
                };
                c.attr({ text: a, x: Math.round(b), y: Math.round(k) }).css({ fontFamily: this.style.fontFamily, fontSize: this.style.fontSize, position: "absolute" });
                e.style.whiteSpace = "nowrap";
                c.css =
                    c.htmlCss;
                m && (c.add = function(a) {
                    var b, d = h.box.parentNode,
                        k = [];
                    if (this.parentGroup = a) {
                        if (b = a.div, !b) {
                            for (; a;) k.push(a), a = a.parentGroup;
                            f(k.reverse(), function(a) {
                                function e(g, b) {
                                    a[b] = g;
                                    n ? q[h.getTransformKey()] = "translate(" + (a.x || a.translateX) + "px," + (a.y || a.translateY) + "px)" : "translateX" === b ? q.left = g + "px" : q.top = g + "px";
                                    a.doTransform = !0
                                }
                                var q, g = E(a.element, "class");
                                g && (g = { className: g });
                                b = a.div = a.div || D("div", g, {
                                    position: "absolute",
                                    left: (a.translateX || 0) + "px",
                                    top: (a.translateY || 0) + "px",
                                    display: a.display,
                                    opacity: a.opacity,
                                    pointerEvents: a.styles && a.styles.pointerEvents
                                }, b || d);
                                q = b.style;
                                l(a, {
                                    classSetter: function(a) {
                                        return function(g) {
                                            this.element.setAttribute("class", g);
                                            a.className = g
                                        }
                                    }(b),
                                    on: function() { k[0].div && c.on.apply({ element: k[0].div }, arguments); return a },
                                    translateXSetter: e,
                                    translateYSetter: e
                                });
                                w(a, q)
                            })
                        }
                    } else b = d;
                    b.appendChild(e);
                    c.added = !0;
                    c.alignOnAdd && c.htmlUpdateTransform();
                    return c
                });
                return c
            }
        })
    })(M);
    (function(a) {
        function E() {
            var n = a.defaultOptions.global,
                l = r.moment;
            if (n.timezone) {
                if (l) return function(a) {
                    return -l.tz(a,
                        n.timezone).utcOffset()
                };
                a.error(25)
            }
            return n.useUTC && n.getTimezoneOffset
        }

        function D() {
            var n = a.defaultOptions.global,
                f, u = n.useUTC,
                e = u ? "getUTC" : "get",
                h = u ? "setUTC" : "set",
                m = "Minutes Hours Day Date Month FullYear".split(" "),
                d = m.concat(["Milliseconds", "Seconds"]);
            a.Date = f = n.Date || r.Date;
            f.hcTimezoneOffset = u && n.timezoneOffset;
            f.hcGetTimezoneOffset = E();
            f.hcHasTimeZone = !(!f.hcTimezoneOffset && !f.hcGetTimezoneOffset);
            f.hcMakeTime = function(a, b, d, e, h, m) {
                var c;
                u ? (c = f.UTC.apply(0, arguments), c += p(c)) : c = (new f(a,
                    b, l(d, 1), l(e, 0), l(h, 0), l(m, 0))).getTime();
                return c
            };
            for (n = 0; n < m.length; n++) f["hcGet" + m[n]] = e + m[n];
            for (n = 0; n < d.length; n++) f["hcSet" + d[n]] = h + d[n]
        }
        var H = a.color,
            p = a.getTZOffset,
            f = a.merge,
            l = a.pick,
            r = a.win;
        a.defaultOptions = {
            colors: "#2d859e #26589b #134674 #039d80 #51e6c7 #533b81 #61bfee #91e8e1".split(" "),
            symbols: ["circle", "diamond", "square", "triangle", "triangle-down"],
            lang: {
                loading: "Loading...",
                months: "January February March April May June July August September October November December".split(" "),
                shortMonths: "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" "),
                weekdays: "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),
                decimalPoint: ".",
                numericSymbols: "kMGTPE".split(""),
                resetZoom: "Reset zoom",
                resetZoomTitle: "Reset zoom level 1:1",
                thousandsSep: " "
            },
            global: { useUTC: !0 },
            chart: {
                borderRadius: 0,
                defaultSeriesType: "line",
                ignoreHiddenSeries: !0,
                spacing: [10, 10, 15, 10],
                resetZoomButton: { theme: { zIndex: 6 }, position: { align: "right", x: -10, y: 10 } },
                width: null,
                height: null,
                borderColor: "#335cad",
                backgroundColor: "#ffffff",
                plotBorderColor: "#cccccc"
            },
            title: { text: "Chart title", align: "center", margin: 15, widthAdjust: -44 },
            subtitle: { text: "", align: "center", widthAdjust: -44 },
            plotOptions: {},
            labels: { style: { position: "absolute", color: "#333333" } },
            legend: {
                enabled: !0,
                align: "center",
                layout: "horizontal",
                labelFormatter: function() { return this.name },
                borderColor: "#999999",
                borderRadius: 0,
                navigation: { activeColor: "#003399", inactiveColor: "#cccccc" },
                itemStyle: { color: "#333333", fontSize: "12px", fontWeight: "bold", textOverflow: "ellipsis" },
                itemHoverStyle: { color: "#000000" },
                itemHiddenStyle: { color: "#cccccc" },
                shadow: !1,
                itemCheckboxStyle: { position: "absolute", width: "13px", height: "13px" },
                squareSymbol: !0,
                symbolPadding: 5,
                verticalAlign: "bottom",
                x: 0,
                y: 0,
                title: { style: { fontWeight: "bold" } }
            },
            loading: { labelStyle: { fontWeight: "bold", position: "relative", top: "45%" }, style: { position: "absolute", backgroundColor: "#ffffff", opacity: .5, textAlign: "center" } },
            tooltip: {
                enabled: !0,
                animation: a.svg,
                borderRadius: 3,
                dateTimeLabelFormats: {
                    millisecond: "%A, %b %e, %H:%M:%S.%L",
                    second: "%A, %b %e, %H:%M:%S",
                    minute: "%A, %b %e, %H:%M",
                    hour: "%A, %b %e, %H:%M",
                    day: "%A, %b %e, %Y",
                    week: "Week from %A, %b %e, %Y",
                    month: "%B %Y",
                    year: "%Y"
                },
                footerFormat: "",
                padding: 8,
                snap: a.isTouchDevice ? 25 : 10,
                backgroundColor: H("#f7f7f7").setOpacity(.85).get(),
                borderWidth: 1,
                headerFormat: '\x3cspan style\x3d"font-size: 10px"\x3e{point.key}\x3c/span\x3e\x3cbr/\x3e',
                pointFormat: '\x3cspan style\x3d"color:{point.color}"\x3e\u25cf\x3c/span\x3e {series.name}: \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3e',
                shadow: !0,
                style: { color: "#333333", cursor: "default", fontSize: "12px", pointerEvents: "none", whiteSpace: "nowrap" }
            },
            credits: { enabled: !0, href: "http://www.highcharts.com", position: { align: "right", x: -10, verticalAlign: "bottom", y: -5 }, style: { cursor: "pointer", color: "#999999", fontSize: "9px" }, text: "" }
        };
        a.setOptions = function(n) {
            a.defaultOptions = f(!0, a.defaultOptions, n);
            D();
            return a.defaultOptions
        };
        a.getOptions = function() { return a.defaultOptions };
        a.defaultPlotOptions = a.defaultOptions.plotOptions;
        D()
    })(M);
    (function(a) {
        var E =
            a.correctFloat,
            D = a.defined,
            H = a.destroyObjectProperties,
            p = a.isNumber,
            f = a.merge,
            l = a.pick,
            r = a.deg2rad;
        a.Tick = function(a, l, f, e) {
            this.axis = a;
            this.pos = l;
            this.type = f || "";
            this.isNewLabel = this.isNew = !0;
            f || e || this.addLabel()
        };
        a.Tick.prototype = {
            addLabel: function() {
                var a = this.axis,
                    w = a.options,
                    u = a.chart,
                    e = a.categories,
                    h = a.names,
                    m = this.pos,
                    d = w.labels,
                    c = a.tickPositions,
                    b = m === c[0],
                    k = m === c[c.length - 1],
                    h = e ? l(e[m], h[m], m) : m,
                    e = this.label,
                    c = c.info,
                    z;
                a.isDatetimeAxis && c && (z = w.dateTimeLabelFormats[c.higherRanks[m] || c.unitName]);
                this.isFirst = b;
                this.isLast = k;
                w = a.labelFormatter.call({ axis: a, chart: u, isFirst: b, isLast: k, dateTimeLabelFormat: z, value: a.isLog ? E(a.lin2log(h)) : h, pos: m });
                D(e) ? e && e.attr({ text: w }) : (this.labelLength = (this.label = e = D(w) && d.enabled ? u.renderer.text(w, 0, 0, d.useHTML).css(f(d.style)).add(a.labelGroup) : null) && e.getBBox().width, this.rotation = 0)
            },
            getLabelSize: function() { return this.label ? this.label.getBBox()[this.axis.horiz ? "height" : "width"] : 0 },
            handleOverflow: function(a) {
                var f = this.axis,
                    n = f.options.labels,
                    e = a.x,
                    h = f.chart.chartWidth,
                    m = f.chart.spacing,
                    d = l(f.labelLeft, Math.min(f.pos, m[3])),
                    m = l(f.labelRight, Math.max(f.isRadial ? 0 : f.pos + f.len, h - m[1])),
                    c = this.label,
                    b = this.rotation,
                    k = { left: 0, center: .5, right: 1 }[f.labelAlign || c.attr("align")],
                    z = c.getBBox().width,
                    B = f.getSlotWidth(),
                    I = B,
                    x = 1,
                    p, t = {};
                if (b || !1 === n.overflow) 0 > b && e - k * z < d ? p = Math.round(e / Math.cos(b * r) - d) : 0 < b && e + k * z > m && (p = Math.round((h - e) / Math.cos(b * r)));
                else if (h = e + (1 - k) * z, e - k * z < d ? I = a.x + I * (1 - k) - d : h > m && (I = m - a.x + I * k, x = -1), I = Math.min(B, I), I < B && "center" === f.labelAlign &&
                    (a.x += x * (B - I - k * (B - Math.min(z, I)))), z > I || f.autoRotation && (c.styles || {}).width) p = I;
                p && (t.width = p, (n.style || {}).textOverflow || (t.textOverflow = "ellipsis"), c.css(t))
            },
            getPosition: function(a, f, l, e) {
                var h = this.axis,
                    m = h.chart,
                    d = e && m.oldChartHeight || m.chartHeight;
                return { x: a ? h.translate(f + l, null, null, e) + h.transB : h.left + h.offset + (h.opposite ? (e && m.oldChartWidth || m.chartWidth) - h.right - h.left : 0), y: a ? d - h.bottom + h.offset - (h.opposite ? h.height : 0) : d - h.translate(f + l, null, null, e) - h.transB }
            },
            getLabelPosition: function(a,
                f, l, e, h, m, d, c) {
                var b = this.axis,
                    k = b.transA,
                    z = b.reversed,
                    B = b.staggerLines,
                    n = b.tickRotCorr || { x: 0, y: 0 },
                    x = h.y,
                    u = e || b.reserveSpaceDefault ? 0 : -b.labelOffset * ("center" === b.labelAlign ? .5 : 1);
                D(x) || (x = 0 === b.side ? l.rotation ? -8 : -l.getBBox().height : 2 === b.side ? n.y + 8 : Math.cos(l.rotation * r) * (n.y - l.getBBox(!1, 0).height / 2));
                a = a + h.x + u + n.x - (m && e ? m * k * (z ? -1 : 1) : 0);
                f = f + x - (m && !e ? m * k * (z ? 1 : -1) : 0);
                B && (l = d / (c || 1) % B, b.opposite && (l = B - l - 1), f += b.labelOffset / B * l);
                return { x: a, y: Math.round(f) }
            },
            getMarkPath: function(a, f, l, e, h, m) {
                return m.crispLine(["M",
                    a, f, "L", a + (h ? 0 : -l), f + (h ? l : 0)
                ], e)
            },
            renderGridLine: function(a, f, l) {
                var e = this.axis,
                    h = e.options,
                    m = this.gridLine,
                    d = {},
                    c = this.pos,
                    b = this.type,
                    k = e.tickmarkOffset,
                    z = e.chart.renderer,
                    B = b ? b + "Grid" : "grid",
                    n = h[B + "LineWidth"],
                    x = h[B + "LineColor"],
                    h = h[B + "LineDashStyle"];
                m || (d.stroke = x, d["stroke-width"] = n, h && (d.dashstyle = h), b || (d.zIndex = 1), a && (d.opacity = 0), this.gridLine = m = z.path().attr(d).addClass("highcharts-" + (b ? b + "-" : "") + "grid-line").add(e.gridGroup));
                if (!a && m && (a = e.getPlotLinePath(c + k, m.strokeWidth() * l, a, !0))) m[this.isNew ?
                    "attr" : "animate"]({ d: a, opacity: f })
            },
            renderMark: function(a, f, u) {
                var e = this.axis,
                    h = e.options,
                    m = e.chart.renderer,
                    d = this.type,
                    c = d ? d + "Tick" : "tick",
                    b = e.tickSize(c),
                    k = this.mark,
                    z = !k,
                    B = a.x;
                a = a.y;
                var n = l(h[c + "Width"], !d && e.isXAxis ? 1 : 0),
                    h = h[c + "Color"];
                b && (e.opposite && (b[0] = -b[0]), z && (this.mark = k = m.path().addClass("highcharts-" + (d ? d + "-" : "") + "tick").add(e.axisGroup), k.attr({ stroke: h, "stroke-width": n })), k[z ? "attr" : "animate"]({ d: this.getMarkPath(B, a, b[0], k.strokeWidth() * u, e.horiz, m), opacity: f }))
            },
            renderLabel: function(a,
                f, u, e) {
                var h = this.axis,
                    m = h.horiz,
                    d = h.options,
                    c = this.label,
                    b = d.labels,
                    k = b.step,
                    h = h.tickmarkOffset,
                    z = !0,
                    B = a.x;
                a = a.y;
                c && p(B) && (c.xy = a = this.getLabelPosition(B, a, c, m, b, h, e, k), this.isFirst && !this.isLast && !l(d.showFirstLabel, 1) || this.isLast && !this.isFirst && !l(d.showLastLabel, 1) ? z = !1 : !m || b.step || b.rotation || f || 0 === u || this.handleOverflow(a), k && e % k && (z = !1), z && p(a.y) ? (a.opacity = u, c[this.isNewLabel ? "attr" : "animate"](a), this.isNewLabel = !1) : (c.attr("y", -9999), this.isNewLabel = !0))
            },
            render: function(a, f, u) {
                var e =
                    this.axis,
                    h = e.horiz,
                    m = this.getPosition(h, this.pos, e.tickmarkOffset, f),
                    d = m.x,
                    c = m.y,
                    e = h && d === e.pos + e.len || !h && c === e.pos ? -1 : 1;
                u = l(u, 1);
                this.isActive = !0;
                this.renderGridLine(f, u, e);
                this.renderMark(m, u, e);
                this.renderLabel(m, f, u, a);
                this.isNew = !1
            },
            destroy: function() { H(this, this.axis) }
        }
    })(M);
    var V = function(a) {
        var E = a.addEvent,
            D = a.animObject,
            H = a.arrayMax,
            p = a.arrayMin,
            f = a.color,
            l = a.correctFloat,
            r = a.defaultOptions,
            n = a.defined,
            w = a.deg2rad,
            u = a.destroyObjectProperties,
            e = a.each,
            h = a.extend,
            m = a.fireEvent,
            d = a.format,
            c = a.getMagnitude,
            b = a.grep,
            k = a.inArray,
            z = a.isArray,
            B = a.isNumber,
            I = a.isString,
            x = a.merge,
            K = a.normalizeTickInterval,
            t = a.objectEach,
            C = a.pick,
            N = a.removeEvent,
            q = a.splat,
            A = a.syncTimeout,
            F = a.Tick,
            G = function() { this.init.apply(this, arguments) };
        a.extend(G.prototype, {
            defaultOptions: {
                dateTimeLabelFormats: { millisecond: "%H:%M:%S.%L", second: "%H:%M:%S", minute: "%H:%M", hour: "%H:%M", day: "%e. %b", week: "%e. %b", month: "%b '%y", year: "%Y" },
                endOnTick: !1,
                labels: {
                    enabled: !0,
                    style: { color: "#666666", cursor: "default", fontSize: "11px" },
                    x: 0
                },
                maxPadding: .01,
                minorTickLength: 2,
                minorTickPosition: "outside",
                minPadding: .01,
                startOfWeek: 1,
                startOnTick: !1,
                tickLength: 10,
                tickmarkPlacement: "between",
                tickPixelInterval: 100,
                tickPosition: "outside",
                title: { align: "middle", style: { color: "#666666" } },
                type: "linear",
                minorGridLineColor: "#f2f2f2",
                minorGridLineWidth: 1,
                minorTickColor: "#999999",
                lineColor: "#ccd6eb",
                lineWidth: 1,
                gridLineColor: "#e6e6e6",
                tickColor: "#ccd6eb"
            },
            defaultYAxisOptions: {
                endOnTick: !0,
                tickPixelInterval: 72,
                showLastLabel: !0,
                labels: { x: -8 },
                maxPadding: .05,
                minPadding: .05,
                startOnTick: !0,
                title: { rotation: 270, text: "Values" },
                stackLabels: { allowOverlap: !1, enabled: !1, formatter: function() { return a.numberFormat(this.total, -1) }, style: { fontSize: "11px", fontWeight: "bold", color: "#000000", textOutline: "1px contrast" } },
                gridLineWidth: 1,
                lineWidth: 0
            },
            defaultLeftAxisOptions: { labels: { x: -15 }, title: { rotation: 270 } },
            defaultRightAxisOptions: { labels: { x: 15 }, title: { rotation: 90 } },
            defaultBottomAxisOptions: { labels: { autoRotation: [-45], x: 0 }, title: { rotation: 0 } },
            defaultTopAxisOptions: {
                labels: {
                    autoRotation: [-45],
                    x: 0
                },
                title: { rotation: 0 }
            },
            init: function(a, b) {
                var g = b.isX,
                    v = this;
                v.chart = a;
                v.horiz = a.inverted && !v.isZAxis ? !g : g;
                v.isXAxis = g;
                v.coll = v.coll || (g ? "xAxis" : "yAxis");
                v.opposite = b.opposite;
                v.side = b.side || (v.horiz ? v.opposite ? 0 : 2 : v.opposite ? 1 : 3);
                v.setOptions(b);
                var c = this.options,
                    d = c.type;
                v.labelFormatter = c.labels.formatter || v.defaultLabelFormatter;
                v.userOptions = b;
                v.minPixelPadding = 0;
                v.reversed = c.reversed;
                v.visible = !1 !== c.visible;
                v.zoomEnabled = !1 !== c.zoomEnabled;
                v.hasNames = "category" === d || !0 === c.categories;
                v.categories =
                    c.categories || v.hasNames;
                v.names = v.names || [];
                v.plotLinesAndBandsGroups = {};
                v.isLog = "logarithmic" === d;
                v.isDatetimeAxis = "datetime" === d;
                v.positiveValuesOnly = v.isLog && !v.allowNegativeLog;
                v.isLinked = n(c.linkedTo);
                v.ticks = {};
                v.labelEdge = [];
                v.minorTicks = {};
                v.plotLinesAndBands = [];
                v.alternateBands = {};
                v.len = 0;
                v.minRange = v.userMinRange = c.minRange || c.maxZoom;
                v.range = c.range;
                v.offset = c.offset || 0;
                v.stacks = {};
                v.oldStacks = {};
                v.stacksTouched = 0;
                v.max = null;
                v.min = null;
                v.crosshair = C(c.crosshair, q(a.options.tooltip.crosshairs)[g ?
                    0 : 1], !1);
                b = v.options.events; - 1 === k(v, a.axes) && (g ? a.axes.splice(a.xAxis.length, 0, v) : a.axes.push(v), a[v.coll].push(v));
                v.series = v.series || [];
                a.inverted && !v.isZAxis && g && void 0 === v.reversed && (v.reversed = !0);
                t(b, function(a, g) { E(v, g, a) });
                v.lin2log = c.linearToLogConverter || v.lin2log;
                v.isLog && (v.val2lin = v.log2lin, v.lin2val = v.lin2log)
            },
            setOptions: function(a) {
                this.options = x(this.defaultOptions, "yAxis" === this.coll && this.defaultYAxisOptions, [this.defaultTopAxisOptions, this.defaultRightAxisOptions, this.defaultBottomAxisOptions,
                    this.defaultLeftAxisOptions
                ][this.side], x(r[this.coll], a))
            },
            defaultLabelFormatter: function() {
                var g = this.axis,
                    b = this.value,
                    c = g.categories,
                    k = this.dateTimeLabelFormat,
                    e = r.lang,
                    q = e.numericSymbols,
                    e = e.numericSymbolMagnitude || 1E3,
                    h = q && q.length,
                    m, z = g.options.labels.format,
                    g = g.isLog ? Math.abs(b) : g.tickInterval;
                if (z) m = d(z, this);
                else if (c) m = b;
                else if (k) m = a.dateFormat(k, b);
                else if (h && 1E3 <= g)
                    for (; h-- && void 0 === m;) c = Math.pow(e, h + 1), g >= c && 0 === 10 * b % c && null !== q[h] && 0 !== b && (m = a.numberFormat(b / c, -1) + q[h]);
                void 0 ===
                    m && (m = 1E4 <= Math.abs(b) ? a.numberFormat(b, -1) : a.numberFormat(b, -1, void 0, ""));
                return m
            },
            getSeriesExtremes: function() {
                var a = this,
                    v = a.chart;
                a.hasVisibleSeries = !1;
                a.dataMin = a.dataMax = a.threshold = null;
                a.softThreshold = !a.isXAxis;
                a.buildStacks && a.buildStacks();
                e(a.series, function(g) {
                    if (g.visible || !v.options.chart.ignoreHiddenSeries) {
                        var c = g.options,
                            d = c.threshold,
                            k;
                        a.hasVisibleSeries = !0;
                        a.positiveValuesOnly && 0 >= d && (d = null);
                        if (a.isXAxis) c = g.xData, c.length && (g = p(c), k = H(c), B(g) || g instanceof Date || (c = b(c, B),
                            g = p(c)), a.dataMin = Math.min(C(a.dataMin, c[0], g), g), a.dataMax = Math.max(C(a.dataMax, c[0], k), k));
                        else if (g.getExtremes(), k = g.dataMax, g = g.dataMin, n(g) && n(k) && (a.dataMin = Math.min(C(a.dataMin, g), g), a.dataMax = Math.max(C(a.dataMax, k), k)), n(d) && (a.threshold = d), !c.softThreshold || a.positiveValuesOnly) a.softThreshold = !1
                    }
                })
            },
            translate: function(a, b, c, d, k, e) {
                var g = this.linkedParent || this,
                    v = 1,
                    q = 0,
                    h = d ? g.oldTransA : g.transA;
                d = d ? g.oldMin : g.min;
                var m = g.minPixelPadding;
                k = (g.isOrdinal || g.isBroken || g.isLog && k) && g.lin2val;
                h || (h = g.transA);
                c && (v *= -1, q = g.len);
                g.reversed && (v *= -1, q -= v * (g.sector || g.len));
                b ? (a = (a * v + q - m) / h + d, k && (a = g.lin2val(a))) : (k && (a = g.val2lin(a)), a = B(d) ? v * (a - d) * h + q + v * m + (B(e) ? h * e : 0) : void 0);
                return a
            },
            toPixels: function(a, b) { return this.translate(a, !1, !this.horiz, null, !0) + (b ? 0 : this.pos) },
            toValue: function(a, b) { return this.translate(a - (b ? 0 : this.pos), !0, !this.horiz, null, !0) },
            getPlotLinePath: function(a, b, c, d, k) {
                var g = this.chart,
                    v = this.left,
                    q = this.top,
                    e, h, m = c && g.oldChartHeight || g.chartHeight,
                    z = c && g.oldChartWidth ||
                    g.chartWidth,
                    A;
                e = this.transB;
                var t = function(a, g, b) { if (a < g || a > b) d ? a = Math.min(Math.max(g, a), b) : A = !0; return a };
                k = C(k, this.translate(a, null, null, c));
                a = c = Math.round(k + e);
                e = h = Math.round(m - k - e);
                B(k) ? this.horiz ? (e = q, h = m - this.bottom, a = c = t(a, v, v + this.width)) : (a = v, c = z - this.right, e = h = t(e, q, q + this.height)) : (A = !0, d = !1);
                return A && !d ? null : g.renderer.crispLine(["M", a, e, "L", c, h], b || 1)
            },
            getLinearTickPositions: function(a, b, c) {
                var g, v = l(Math.floor(b / a) * a);
                c = l(Math.ceil(c / a) * a);
                var d = [],
                    k;
                l(v + a) === v && (k = 20);
                if (this.single) return [b];
                for (b = v; b <= c;) {
                    d.push(b);
                    b = l(b + a, k);
                    if (b === g) break;
                    g = b
                }
                return d
            },
            getMinorTickInterval: function() { var a = this.options; return !0 === a.minorTicks ? C(a.minorTickInterval, "auto") : !1 === a.minorTicks ? null : a.minorTickInterval },
            getMinorTickPositions: function() {
                var a = this,
                    b = a.options,
                    c = a.tickPositions,
                    d = a.minorTickInterval,
                    k = [],
                    q = a.pointRangePadding || 0,
                    h = a.min - q,
                    q = a.max + q,
                    m = q - h;
                if (m && m / d < a.len / 3)
                    if (a.isLog) e(this.paddedTicks, function(g, b, v) { b && k.push.apply(k, a.getLogTickPositions(d, v[b - 1], v[b], !0)) });
                    else if (a.isDatetimeAxis &&
                    "auto" === this.getMinorTickInterval()) k = k.concat(a.getTimeTicks(a.normalizeTimeTickInterval(d), h, q, b.startOfWeek));
                else
                    for (b = h + (c[0] - h) % d; b <= q && b !== k[0]; b += d) k.push(b);
                0 !== k.length && a.trimTicks(k);
                return k
            },
            adjustForMinRange: function() {
                var a = this.options,
                    b = this.min,
                    c = this.max,
                    d, k, q, h, m, z, A, t;
                this.isXAxis && void 0 === this.minRange && !this.isLog && (n(a.min) || n(a.max) ? this.minRange = null : (e(this.series, function(a) {
                        z = a.xData;
                        for (h = A = a.xIncrement ? 1 : z.length - 1; 0 < h; h--)
                            if (m = z[h] - z[h - 1], void 0 === q || m < q) q = m
                    }),
                    this.minRange = Math.min(5 * q, this.dataMax - this.dataMin)));
                c - b < this.minRange && (k = this.dataMax - this.dataMin >= this.minRange, t = this.minRange, d = (t - c + b) / 2, d = [b - d, C(a.min, b - d)], k && (d[2] = this.isLog ? this.log2lin(this.dataMin) : this.dataMin), b = H(d), c = [b + t, C(a.max, b + t)], k && (c[2] = this.isLog ? this.log2lin(this.dataMax) : this.dataMax), c = p(c), c - b < t && (d[0] = c - t, d[1] = C(a.min, c - t), b = H(d)));
                this.min = b;
                this.max = c
            },
            getClosest: function() {
                var a;
                this.categories ? a = 1 : e(this.series, function(g) {
                    var b = g.closestPointRange,
                        v = g.visible ||
                        !g.chart.options.chart.ignoreHiddenSeries;
                    !g.noSharedTooltip && n(b) && v && (a = n(a) ? Math.min(a, b) : b)
                });
                return a
            },
            nameToX: function(a) {
                var g = z(this.categories),
                    b = g ? this.categories : this.names,
                    c = a.options.x,
                    d;
                a.series.requireSorting = !1;
                n(c) || (c = !1 === this.options.uniqueNames ? a.series.autoIncrement() : k(a.name, b)); - 1 === c ? g || (d = b.length) : d = c;
                void 0 !== d && (this.names[d] = a.name);
                return d
            },
            updateNames: function() {
                var a = this;
                0 < this.names.length && (this.names.length = 0, this.minRange = this.userMinRange, e(this.series || [],
                    function(g) {
                        g.xIncrement = null;
                        if (!g.points || g.isDirtyData) g.processData(), g.generatePoints();
                        e(g.points, function(b, v) {
                            var c;
                            b.options && (c = a.nameToX(b), void 0 !== c && c !== b.x && (b.x = c, g.xData[v] = c))
                        })
                    }))
            },
            setAxisTranslation: function(a) {
                var g = this,
                    b = g.max - g.min,
                    c = g.axisPointRange || 0,
                    d, k = 0,
                    q = 0,
                    h = g.linkedParent,
                    m = !!g.categories,
                    z = g.transA,
                    A = g.isXAxis;
                if (A || m || c) d = g.getClosest(), h ? (k = h.minPointOffset, q = h.pointRangePadding) : e(g.series, function(a) {
                    var b = m ? 1 : A ? C(a.options.pointRange, d, 0) : g.axisPointRange || 0;
                    a = a.options.pointPlacement;
                    c = Math.max(c, b);
                    g.single || (k = Math.max(k, I(a) ? 0 : b / 2), q = Math.max(q, "on" === a ? 0 : b))
                }), h = g.ordinalSlope && d ? g.ordinalSlope / d : 1, g.minPointOffset = k *= h, g.pointRangePadding = q *= h, g.pointRange = Math.min(c, b), A && (g.closestPointRange = d);
                a && (g.oldTransA = z);
                g.translationSlope = g.transA = z = g.options.staticScale || g.len / (b + q || 1);
                g.transB = g.horiz ? g.left : g.bottom;
                g.minPixelPadding = z * k
            },
            minFromRange: function() { return this.max - this.range },
            setTickInterval: function(g) {
                var b = this,
                    d = b.chart,
                    k = b.options,
                    q = b.isLog,
                    h = b.log2lin,
                    z = b.isDatetimeAxis,
                    A = b.isXAxis,
                    t = b.isLinked,
                    x = k.maxPadding,
                    f = k.minPadding,
                    F = k.tickInterval,
                    u = k.tickPixelInterval,
                    G = b.categories,
                    p = b.threshold,
                    I = b.softThreshold,
                    r, w, N, D;
                z || G || t || this.getTickAmount();
                N = C(b.userMin, k.min);
                D = C(b.userMax, k.max);
                t ? (b.linkedParent = d[b.coll][k.linkedTo], d = b.linkedParent.getExtremes(), b.min = C(d.min, d.dataMin), b.max = C(d.max, d.dataMax), k.type !== b.linkedParent.options.type && a.error(11, 1)) : (!I && n(p) && (b.dataMin >= p ? (r = p, f = 0) : b.dataMax <= p && (w = p, x = 0)), b.min =
                    C(N, r, b.dataMin), b.max = C(D, w, b.dataMax));
                q && (b.positiveValuesOnly && !g && 0 >= Math.min(b.min, C(b.dataMin, b.min)) && a.error(10, 1), b.min = l(h(b.min), 15), b.max = l(h(b.max), 15));
                b.range && n(b.max) && (b.userMin = b.min = N = Math.max(b.dataMin, b.minFromRange()), b.userMax = D = b.max, b.range = null);
                m(b, "foundExtremes");
                b.beforePadding && b.beforePadding();
                b.adjustForMinRange();
                !(G || b.axisPointRange || b.usePercentage || t) && n(b.min) && n(b.max) && (h = b.max - b.min) && (!n(N) && f && (b.min -= h * f), !n(D) && x && (b.max += h * x));
                B(k.softMin) && !B(b.userMin) &&
                    (b.min = Math.min(b.min, k.softMin));
                B(k.softMax) && !B(b.userMax) && (b.max = Math.max(b.max, k.softMax));
                B(k.floor) && (b.min = Math.max(b.min, k.floor));
                B(k.ceiling) && (b.max = Math.min(b.max, k.ceiling));
                I && n(b.dataMin) && (p = p || 0, !n(N) && b.min < p && b.dataMin >= p ? b.min = p : !n(D) && b.max > p && b.dataMax <= p && (b.max = p));
                b.tickInterval = b.min === b.max || void 0 === b.min || void 0 === b.max ? 1 : t && !F && u === b.linkedParent.options.tickPixelInterval ? F = b.linkedParent.tickInterval : C(F, this.tickAmount ? (b.max - b.min) / Math.max(this.tickAmount - 1, 1) :
                    void 0, G ? 1 : (b.max - b.min) * u / Math.max(b.len, u));
                A && !g && e(b.series, function(a) { a.processData(b.min !== b.oldMin || b.max !== b.oldMax) });
                b.setAxisTranslation(!0);
                b.beforeSetTickPositions && b.beforeSetTickPositions();
                b.postProcessTickInterval && (b.tickInterval = b.postProcessTickInterval(b.tickInterval));
                b.pointRange && !F && (b.tickInterval = Math.max(b.pointRange, b.tickInterval));
                g = C(k.minTickInterval, b.isDatetimeAxis && b.closestPointRange);
                !F && b.tickInterval < g && (b.tickInterval = g);
                z || q || F || (b.tickInterval = K(b.tickInterval,
                    null, c(b.tickInterval), C(k.allowDecimals, !(.5 < b.tickInterval && 5 > b.tickInterval && 1E3 < b.max && 9999 > b.max)), !!this.tickAmount));
                this.tickAmount || (b.tickInterval = b.unsquish());
                this.setTickPositions()
            },
            setTickPositions: function() {
                var a = this.options,
                    b, c = a.tickPositions;
                b = this.getMinorTickInterval();
                var d = a.tickPositioner,
                    k = a.startOnTick,
                    q = a.endOnTick;
                this.tickmarkOffset = this.categories && "between" === a.tickmarkPlacement && 1 === this.tickInterval ? .5 : 0;
                this.minorTickInterval = "auto" === b && this.tickInterval ? this.tickInterval /
                    5 : b;
                this.single = this.min === this.max && n(this.min) && !this.tickAmount && (parseInt(this.min, 10) === this.min || !1 !== a.allowDecimals);
                this.tickPositions = b = c && c.slice();
                !b && (b = this.isDatetimeAxis ? this.getTimeTicks(this.normalizeTimeTickInterval(this.tickInterval, a.units), this.min, this.max, a.startOfWeek, this.ordinalPositions, this.closestPointRange, !0) : this.isLog ? this.getLogTickPositions(this.tickInterval, this.min, this.max) : this.getLinearTickPositions(this.tickInterval, this.min, this.max), b.length > this.len && (b = [b[0], b.pop()], b[0] === b[1] && (b.length = 1)), this.tickPositions = b, d && (d = d.apply(this, [this.min, this.max]))) && (this.tickPositions = b = d);
                this.paddedTicks = b.slice(0);
                this.trimTicks(b, k, q);
                this.isLinked || (this.single && 2 > b.length && (this.min -= .5, this.max += .5), c || d || this.adjustTickAmount())
            },
            trimTicks: function(a, b, c) {
                var g = a[0],
                    d = a[a.length - 1],
                    k = this.minPointOffset || 0;
                if (!this.isLinked) {
                    if (b && -Infinity !== g) this.min = g;
                    else
                        for (; this.min - k > a[0];) a.shift();
                    if (c) this.max = d;
                    else
                        for (; this.max + k < a[a.length - 1];) a.pop();
                    0 === a.length && n(g) && !this.options.tickPositions && a.push((d + g) / 2)
                }
            },
            alignToOthers: function() {
                var a = {},
                    b, c = this.options;
                !1 === this.chart.options.chart.alignTicks || !1 === c.alignTicks || this.isLog || e(this.chart[this.coll], function(g) {
                    var c = g.options,
                        c = [g.horiz ? c.left : c.top, c.width, c.height, c.pane].join();
                    g.series.length && (a[c] ? b = !0 : a[c] = 1)
                });
                return b
            },
            getTickAmount: function() {
                var a = this.options,
                    b = a.tickAmount,
                    c = a.tickPixelInterval;
                !n(a.tickInterval) && this.len < c && !this.isRadial && !this.isLog && a.startOnTick &&
                    a.endOnTick && (b = 2);
                !b && this.alignToOthers() && (b = Math.ceil(this.len / c) + 1);
                4 > b && (this.finalTickAmt = b, b = 5);
                this.tickAmount = b
            },
            adjustTickAmount: function() {
                var a = this.tickInterval,
                    b = this.tickPositions,
                    c = this.tickAmount,
                    d = this.finalTickAmt,
                    k = b && b.length,
                    q = C(this.threshold, this.softThreshold ? 0 : null);
                if (this.hasData()) {
                    if (k < c) {
                        for (; b.length < c;) b.length % 2 || this.min === q ? b.push(l(b[b.length - 1] + a)) : b.unshift(l(b[0] - a));
                        this.transA *= (k - 1) / (c - 1);
                        this.min = b[0];
                        this.max = b[b.length - 1]
                    } else k > c && (this.tickInterval *=
                        2, this.setTickPositions());
                    if (n(d)) {
                        for (a = c = b.length; a--;)(3 === d && 1 === a % 2 || 2 >= d && 0 < a && a < c - 1) && b.splice(a, 1);
                        this.finalTickAmt = void 0
                    }
                }
            },
            setScale: function() {
                var a, b;
                this.oldMin = this.min;
                this.oldMax = this.max;
                this.oldAxisLength = this.len;
                this.setAxisSize();
                b = this.len !== this.oldAxisLength;
                e(this.series, function(b) { if (b.isDirtyData || b.isDirty || b.xAxis.isDirty) a = !0 });
                b || a || this.isLinked || this.forceRedraw || this.userMin !== this.oldUserMin || this.userMax !== this.oldUserMax || this.alignToOthers() ? (this.resetStacks &&
                    this.resetStacks(), this.forceRedraw = !1, this.getSeriesExtremes(), this.setTickInterval(), this.oldUserMin = this.userMin, this.oldUserMax = this.userMax, this.isDirty || (this.isDirty = b || this.min !== this.oldMin || this.max !== this.oldMax)) : this.cleanStacks && this.cleanStacks()
            },
            setExtremes: function(a, b, c, d, k) {
                var g = this,
                    q = g.chart;
                c = C(c, !0);
                e(g.series, function(a) { delete a.kdTree });
                k = h(k, { min: a, max: b });
                m(g, "setExtremes", k, function() {
                    g.userMin = a;
                    g.userMax = b;
                    g.eventArgs = k;
                    c && q.redraw(d)
                })
            },
            zoom: function(a, b) {
                var g = this.dataMin,
                    c = this.dataMax,
                    d = this.options,
                    k = Math.min(g, C(d.min, g)),
                    d = Math.max(c, C(d.max, c));
                if (a !== this.min || b !== this.max) this.allowZoomOutside || (n(g) && (a < k && (a = k), a > d && (a = d)), n(c) && (b < k && (b = k), b > d && (b = d))), this.displayBtn = void 0 !== a || void 0 !== b, this.setExtremes(a, b, !1, void 0, { trigger: "zoom" });
                return !0
            },
            setAxisSize: function() {
                var b = this.chart,
                    c = this.options,
                    d = c.offsets || [0, 0, 0, 0],
                    k = this.horiz,
                    q = this.width = Math.round(a.relativeLength(C(c.width, b.plotWidth - d[3] + d[1]), b.plotWidth)),
                    e = this.height = Math.round(a.relativeLength(C(c.height,
                        b.plotHeight - d[0] + d[2]), b.plotHeight)),
                    h = this.top = Math.round(a.relativeLength(C(c.top, b.plotTop + d[0]), b.plotHeight, b.plotTop)),
                    c = this.left = Math.round(a.relativeLength(C(c.left, b.plotLeft + d[3]), b.plotWidth, b.plotLeft));
                this.bottom = b.chartHeight - e - h;
                this.right = b.chartWidth - q - c;
                this.len = Math.max(k ? q : e, 0);
                this.pos = k ? c : h
            },
            getExtremes: function() {
                var a = this.isLog,
                    b = this.lin2log;
                return {
                    min: a ? l(b(this.min)) : this.min,
                    max: a ? l(b(this.max)) : this.max,
                    dataMin: this.dataMin,
                    dataMax: this.dataMax,
                    userMin: this.userMin,
                    userMax: this.userMax
                }
            },
            getThreshold: function(a) {
                var b = this.isLog,
                    g = this.lin2log,
                    c = b ? g(this.min) : this.min,
                    b = b ? g(this.max) : this.max;
                null === a ? a = c : c > a ? a = c : b < a && (a = b);
                return this.translate(a, 0, 1, 0, 1)
            },
            autoLabelAlign: function(a) { a = (C(a, 0) - 90 * this.side + 720) % 360; return 15 < a && 165 > a ? "right" : 195 < a && 345 > a ? "left" : "center" },
            tickSize: function(a) {
                var b = this.options,
                    g = b[a + "Length"],
                    c = C(b[a + "Width"], "tick" === a && this.isXAxis ? 1 : 0);
                if (c && g) return "inside" === b[a + "Position"] && (g = -g), [g, c]
            },
            labelMetrics: function() {
                var a =
                    this.tickPositions && this.tickPositions[0] || 0;
                return this.chart.renderer.fontMetrics(this.options.labels.style && this.options.labels.style.fontSize, this.ticks[a] && this.ticks[a].label)
            },
            unsquish: function() {
                var a = this.options.labels,
                    b = this.horiz,
                    c = this.tickInterval,
                    d = c,
                    k = this.len / (((this.categories ? 1 : 0) + this.max - this.min) / c),
                    q, h = a.rotation,
                    m = this.labelMetrics(),
                    z, A = Number.MAX_VALUE,
                    t, x = function(a) {
                        a /= k || 1;
                        a = 1 < a ? Math.ceil(a) : 1;
                        return a * c
                    };
                b ? (t = !a.staggerLines && !a.step && (n(h) ? [h] : k < C(a.autoRotationLimit,
                    80) && a.autoRotation)) && e(t, function(a) { var b; if (a === h || a && -90 <= a && 90 >= a) z = x(Math.abs(m.h / Math.sin(w * a))), b = z + Math.abs(a / 360), b < A && (A = b, q = a, d = z) }) : a.step || (d = x(m.h));
                this.autoRotation = t;
                this.labelRotation = C(q, h);
                return d
            },
            getSlotWidth: function() {
                var a = this.chart,
                    b = this.horiz,
                    c = this.options.labels,
                    d = Math.max(this.tickPositions.length - (this.categories ? 0 : 1), 1),
                    k = a.margin[3];
                return b && 2 > (c.step || 0) && !c.rotation && (this.staggerLines || 1) * this.len / d || !b && (c.style && parseInt(c.style.width, 10) || k && k - a.spacing[3] ||
                    .33 * a.chartWidth)
            },
            renderUnsquish: function() {
                var a = this.chart,
                    b = a.renderer,
                    c = this.tickPositions,
                    d = this.ticks,
                    k = this.options.labels,
                    q = this.horiz,
                    h = this.getSlotWidth(),
                    m = Math.max(1, Math.round(h - 2 * (k.padding || 5))),
                    z = {},
                    A = this.labelMetrics(),
                    t = k.style && k.style.textOverflow,
                    f, F = 0,
                    l, B;
                I(k.rotation) || (z.rotation = k.rotation || 0);
                e(c, function(a) {
                    (a = d[a]) && a.labelLength > F && (F = a.labelLength)
                });
                this.maxLabelLength = F;
                if (this.autoRotation) F > m && F > A.h ? z.rotation = this.labelRotation : this.labelRotation = 0;
                else if (h &&
                    (f = { width: m + "px" }, !t))
                    for (f.textOverflow = "clip", l = c.length; !q && l--;)
                        if (B = c[l], m = d[B].label) m.styles && "ellipsis" === m.styles.textOverflow ? m.css({ textOverflow: "clip" }) : d[B].labelLength > h && m.css({ width: h + "px" }), m.getBBox().height > this.len / c.length - (A.h - A.f) && (m.specCss = { textOverflow: "ellipsis" });
                z.rotation && (f = { width: (F > .5 * a.chartHeight ? .33 * a.chartHeight : a.chartHeight) + "px" }, t || (f.textOverflow = "ellipsis"));
                if (this.labelAlign = k.align || this.autoLabelAlign(this.labelRotation)) z.align = this.labelAlign;
                e(c,
                    function(a) {
                        var b = (a = d[a]) && a.label;
                        b && (b.attr(z), f && b.css(x(f, b.specCss)), delete b.specCss, a.rotation = z.rotation)
                    });
                this.tickRotCorr = b.rotCorr(A.b, this.labelRotation || 0, 0 !== this.side)
            },
            hasData: function() { return this.hasVisibleSeries || n(this.min) && n(this.max) && this.tickPositions && 0 < this.tickPositions.length },
            addTitle: function(a) {
                var b = this.chart.renderer,
                    g = this.horiz,
                    c = this.opposite,
                    d = this.options.title,
                    k;
                this.axisTitle || ((k = d.textAlign) || (k = (g ? { low: "left", middle: "center", high: "right" } : {
                    low: c ? "right" : "left",
                    middle: "center",
                    high: c ? "left" : "right"
                })[d.align]), this.axisTitle = b.text(d.text, 0, 0, d.useHTML).attr({ zIndex: 7, rotation: d.rotation || 0, align: k }).addClass("highcharts-axis-title").css(d.style).add(this.axisGroup), this.axisTitle.isNew = !0);
                d.style.width || this.isRadial || this.axisTitle.css({ width: this.len });
                this.axisTitle[a ? "show" : "hide"](!0)
            },
            generateTick: function(a) {
                var b = this.ticks;
                b[a] ? b[a].addLabel() : b[a] = new F(this, a)
            },
            getOffset: function() {
                var a = this,
                    b = a.chart,
                    c = b.renderer,
                    d = a.options,
                    k = a.tickPositions,
                    q = a.ticks,
                    h = a.horiz,
                    m = a.side,
                    z = b.inverted && !a.isZAxis ? [1, 0, 3, 2][m] : m,
                    A, x, f = 0,
                    F, l = 0,
                    B = d.title,
                    u = d.labels,
                    G = 0,
                    p = b.axisOffset,
                    b = b.clipOffset,
                    I = [-1, 1, 1, -1][m],
                    r = d.className,
                    w = a.axisParent,
                    K = this.tickSize("tick");
                A = a.hasData();
                a.showAxis = x = A || C(d.showEmpty, !0);
                a.staggerLines = a.horiz && u.staggerLines;
                a.axisGroup || (a.gridGroup = c.g("grid").attr({ zIndex: d.gridZIndex || 1 }).addClass("highcharts-" + this.coll.toLowerCase() + "-grid " + (r || "")).add(w), a.axisGroup = c.g("axis").attr({ zIndex: d.zIndex || 2 }).addClass("highcharts-" +
                    this.coll.toLowerCase() + " " + (r || "")).add(w), a.labelGroup = c.g("axis-labels").attr({ zIndex: u.zIndex || 7 }).addClass("highcharts-" + a.coll.toLowerCase() + "-labels " + (r || "")).add(w));
                A || a.isLinked ? (e(k, function(b, c) { a.generateTick(b, c) }), a.renderUnsquish(), a.reserveSpaceDefault = 0 === m || 2 === m || { 1: "left", 3: "right" }[m] === a.labelAlign, C(u.reserveSpace, "center" === a.labelAlign ? !0 : null, a.reserveSpaceDefault) && e(k, function(a) { G = Math.max(q[a].getLabelSize(), G) }), a.staggerLines && (G *= a.staggerLines), a.labelOffset = G *
                    (a.opposite ? -1 : 1)) : t(q, function(a, b) {
                    a.destroy();
                    delete q[b]
                });
                B && B.text && !1 !== B.enabled && (a.addTitle(x), x && !1 !== B.reserveSpace && (a.titleOffset = f = a.axisTitle.getBBox()[h ? "height" : "width"], F = B.offset, l = n(F) ? 0 : C(B.margin, h ? 5 : 10)));
                a.renderLine();
                a.offset = I * C(d.offset, p[m]);
                a.tickRotCorr = a.tickRotCorr || { x: 0, y: 0 };
                c = 0 === m ? -a.labelMetrics().h : 2 === m ? a.tickRotCorr.y : 0;
                l = Math.abs(G) + l;
                G && (l = l - c + I * (h ? C(u.y, a.tickRotCorr.y + 8 * I) : u.x));
                a.axisTitleMargin = C(F, l);
                p[m] = Math.max(p[m], a.axisTitleMargin + f + I * a.offset,
                    l, A && k.length && K ? K[0] + I * a.offset : 0);
                d = d.offset ? 0 : 2 * Math.floor(a.axisLine.strokeWidth() / 2);
                b[z] = Math.max(b[z], d)
            },
            getLinePath: function(a) {
                var b = this.chart,
                    c = this.opposite,
                    g = this.offset,
                    d = this.horiz,
                    k = this.left + (c ? this.width : 0) + g,
                    g = b.chartHeight - this.bottom - (c ? this.height : 0) + g;
                c && (a *= -1);
                return b.renderer.crispLine(["M", d ? this.left : k, d ? g : this.top, "L", d ? b.chartWidth - this.right : k, d ? g : b.chartHeight - this.bottom], a)
            },
            renderLine: function() {
                this.axisLine || (this.axisLine = this.chart.renderer.path().addClass("highcharts-axis-line").add(this.axisGroup),
                    this.axisLine.attr({ stroke: this.options.lineColor, "stroke-width": this.options.lineWidth, zIndex: 7 }))
            },
            getTitlePosition: function() {
                var a = this.horiz,
                    b = this.left,
                    c = this.top,
                    d = this.len,
                    k = this.options.title,
                    q = a ? b : c,
                    e = this.opposite,
                    h = this.offset,
                    m = k.x || 0,
                    z = k.y || 0,
                    A = this.axisTitle,
                    t = this.chart.renderer.fontMetrics(k.style && k.style.fontSize, A),
                    A = Math.max(A.getBBox(null, 0).height - t.h - 1, 0),
                    d = { low: q + (a ? 0 : d), middle: q + d / 2, high: q + (a ? d : 0) }[k.align],
                    b = (a ? c + this.height : b) + (a ? 1 : -1) * (e ? -1 : 1) * this.axisTitleMargin + [-A,
                        A, t.f, -A
                    ][this.side];
                return { x: a ? d + m : b + (e ? this.width : 0) + h + m, y: a ? b + z - (e ? this.height : 0) + h : d + z }
            },
            renderMinorTick: function(a) {
                var b = this.chart.hasRendered && B(this.oldMin),
                    c = this.minorTicks;
                c[a] || (c[a] = new F(this, a, "minor"));
                b && c[a].isNew && c[a].render(null, !0);
                c[a].render(null, !1, 1)
            },
            renderTick: function(a, b) {
                var c = this.isLinked,
                    g = this.ticks,
                    d = this.chart.hasRendered && B(this.oldMin);
                if (!c || a >= this.min && a <= this.max) g[a] || (g[a] = new F(this, a)), d && g[a].isNew && g[a].render(b, !0, .1), g[a].render(b)
            },
            render: function() {
                var b =
                    this,
                    c = b.chart,
                    d = b.options,
                    k = b.isLog,
                    q = b.lin2log,
                    h = b.isLinked,
                    m = b.tickPositions,
                    z = b.axisTitle,
                    x = b.ticks,
                    f = b.minorTicks,
                    l = b.alternateBands,
                    C = d.stackLabels,
                    n = d.alternateGridColor,
                    u = b.tickmarkOffset,
                    G = b.axisLine,
                    p = b.showAxis,
                    I = D(c.renderer.globalAnimation),
                    r, w;
                b.labelEdge.length = 0;
                b.overlap = !1;
                e([x, f, l], function(a) { t(a, function(a) { a.isActive = !1 }) });
                if (b.hasData() || h) b.minorTickInterval && !b.categories && e(b.getMinorTickPositions(), function(a) { b.renderMinorTick(a) }), m.length && (e(m, function(a, c) {
                    b.renderTick(a,
                        c)
                }), u && (0 === b.min || b.single) && (x[-1] || (x[-1] = new F(b, -1, null, !0)), x[-1].render(-1))), n && e(m, function(d, g) {
                    w = void 0 !== m[g + 1] ? m[g + 1] + u : b.max - u;
                    0 === g % 2 && d < b.max && w <= b.max + (c.polar ? -u : u) && (l[d] || (l[d] = new a.PlotLineOrBand(b)), r = d + u, l[d].options = { from: k ? q(r) : r, to: k ? q(w) : w, color: n }, l[d].render(), l[d].isActive = !0)
                }), b._addedPlotLB || (e((d.plotLines || []).concat(d.plotBands || []), function(a) { b.addPlotBandOrLine(a) }), b._addedPlotLB = !0);
                e([x, f, l], function(a) {
                    var b, d = [],
                        g = I.duration;
                    t(a, function(a, b) {
                        a.isActive ||
                            (a.render(b, !1, 0), a.isActive = !1, d.push(b))
                    });
                    A(function() { for (b = d.length; b--;) a[d[b]] && !a[d[b]].isActive && (a[d[b]].destroy(), delete a[d[b]]) }, a !== l && c.hasRendered && g ? g : 0)
                });
                G && (G[G.isPlaced ? "animate" : "attr"]({ d: this.getLinePath(G.strokeWidth()) }), G.isPlaced = !0, G[p ? "show" : "hide"](!0));
                z && p && (d = b.getTitlePosition(), B(d.y) ? (z[z.isNew ? "attr" : "animate"](d), z.isNew = !1) : (z.attr("y", -9999), z.isNew = !0));
                C && C.enabled && b.renderStackTotals();
                b.isDirty = !1
            },
            redraw: function() {
                this.visible && (this.render(), e(this.plotLinesAndBands,
                    function(a) { a.render() }));
                e(this.series, function(a) { a.isDirty = !0 })
            },
            keepProps: "extKey hcEvents names series userMax userMin".split(" "),
            destroy: function(a) {
                var b = this,
                    c = b.stacks,
                    d = b.plotLinesAndBands,
                    g;
                a || N(b);
                t(c, function(a, b) {
                    u(a);
                    c[b] = null
                });
                e([b.ticks, b.minorTicks, b.alternateBands], function(a) { u(a) });
                if (d)
                    for (a = d.length; a--;) d[a].destroy();
                e("stackTotalGroup axisLine axisTitle axisGroup gridGroup labelGroup cross".split(" "), function(a) { b[a] && (b[a] = b[a].destroy()) });
                for (g in b.plotLinesAndBandsGroups) b.plotLinesAndBandsGroups[g] =
                    b.plotLinesAndBandsGroups[g].destroy();
                t(b, function(a, c) {-1 === k(c, b.keepProps) && delete b[c] })
            },
            drawCrosshair: function(a, b) {
                var c, d = this.crosshair,
                    g = C(d.snap, !0),
                    k, q = this.cross;
                a || (a = this.cross && this.cross.e);
                this.crosshair && !1 !== (n(b) || !g) ? (g ? n(b) && (k = this.isXAxis ? b.plotX : this.len - b.plotY) : k = a && (this.horiz ? a.chartX - this.pos : this.len - a.chartY + this.pos), n(k) && (c = this.getPlotLinePath(b && (this.isXAxis ? b.x : C(b.stackY, b.y)), null, null, null, k) || null), n(c) ? (b = this.categories && !this.isRadial, q || (this.cross =
                    q = this.chart.renderer.path().addClass("highcharts-crosshair highcharts-crosshair-" + (b ? "category " : "thin ") + d.className).attr({ zIndex: C(d.zIndex, 2) }).add(), q.attr({ stroke: d.color || (b ? f("#ccd6eb").setOpacity(.25).get() : "#cccccc"), "stroke-width": C(d.width, 1) }).css({ "pointer-events": "none" }), d.dashStyle && q.attr({ dashstyle: d.dashStyle })), q.show().attr({ d: c }), b && !d.width && q.attr({ "stroke-width": this.transA }), this.cross.e = a) : this.hideCrosshair()) : this.hideCrosshair()
            },
            hideCrosshair: function() {
                this.cross &&
                    this.cross.hide()
            }
        });
        return a.Axis = G
    }(M);
    (function(a) {
        var E = a.Axis,
            D = a.Date,
            H = a.dateFormat,
            p = a.defaultOptions,
            f = a.defined,
            l = a.each,
            r = a.extend,
            n = a.getMagnitude,
            w = a.getTZOffset,
            u = a.normalizeTickInterval,
            e = a.pick,
            h = a.timeUnits;
        E.prototype.getTimeTicks = function(a, d, c, b) {
            var k = [],
                m = {},
                B = p.global.useUTC,
                n, x = new D(d - Math.max(w(d), w(c))),
                u = D.hcMakeTime,
                t = a.unitRange,
                C = a.count,
                N, q;
            if (f(d)) {
                x[D.hcSetMilliseconds](t >= h.second ? 0 : C * Math.floor(x.getMilliseconds() / C));
                if (t >= h.second) x[D.hcSetSeconds](t >= h.minute ?
                    0 : C * Math.floor(x.getSeconds() / C));
                if (t >= h.minute) x[D.hcSetMinutes](t >= h.hour ? 0 : C * Math.floor(x[D.hcGetMinutes]() / C));
                if (t >= h.hour) x[D.hcSetHours](t >= h.day ? 0 : C * Math.floor(x[D.hcGetHours]() / C));
                if (t >= h.day) x[D.hcSetDate](t >= h.month ? 1 : C * Math.floor(x[D.hcGetDate]() / C));
                t >= h.month && (x[D.hcSetMonth](t >= h.year ? 0 : C * Math.floor(x[D.hcGetMonth]() / C)), n = x[D.hcGetFullYear]());
                if (t >= h.year) x[D.hcSetFullYear](n - n % C);
                if (t === h.week) x[D.hcSetDate](x[D.hcGetDate]() - x[D.hcGetDay]() + e(b, 1));
                n = x[D.hcGetFullYear]();
                b = x[D.hcGetMonth]();
                var A = x[D.hcGetDate](),
                    F = x[D.hcGetHours]();
                d = x.getTime();
                D.hcHasTimeZone && (q = (!B || !!D.hcGetTimezoneOffset) && (c - d > 4 * h.month || w(d) !== w(c)), N = w(x), x = new D(d + N));
                B = x.getTime();
                for (d = 1; B < c;) k.push(B), B = t === h.year ? u(n + d * C, 0) : t === h.month ? u(n, b + d * C) : !q || t !== h.day && t !== h.week ? q && t === h.hour ? u(n, b, A, F + d * C, 0, 0, N) - N : B + t * C : u(n, b, A + d * C * (t === h.day ? 1 : 7)), d++;
                k.push(B);
                t <= h.hour && 1E4 > k.length && l(k, function(a) { 0 === a % 18E5 && "000000000" === H("%H%M%S%L", a) && (m[a] = "day") })
            }
            k.info = r(a, { higherRanks: m, totalRange: t * C });
            return k
        };
        E.prototype.normalizeTimeTickInterval = function(a, d) {
            var c = d || [
                ["millisecond", [1, 2, 5, 10, 20, 25, 50, 100, 200, 500]],
                ["second", [1, 2, 5, 10, 15, 30]],
                ["minute", [1, 2, 5, 10, 15, 30]],
                ["hour", [1, 2, 3, 4, 6, 8, 12]],
                ["day", [1, 2]],
                ["week", [1, 2]],
                ["month", [1, 2, 3, 4, 6]],
                ["year", null]
            ];
            d = c[c.length - 1];
            var b = h[d[0]],
                k = d[1],
                e;
            for (e = 0; e < c.length && !(d = c[e], b = h[d[0]], k = d[1], c[e + 1] && a <= (b * k[k.length - 1] + h[c[e + 1][0]]) / 2); e++);
            b === h.year && a < 5 * b && (k = [1, 2, 5]);
            a = u(a / b, k, "year" === d[0] ? Math.max(n(a / b), 1) : 1);
            return { unitRange: b, count: a, unitName: d[0] }
        }
    })(M);
    (function(a) {
        var E = a.Axis,
            D = a.getMagnitude,
            H = a.map,
            p = a.normalizeTickInterval,
            f = a.pick;
        E.prototype.getLogTickPositions = function(a, r, n, w) {
            var l = this.options,
                e = this.len,
                h = this.lin2log,
                m = this.log2lin,
                d = [];
            w || (this._minorAutoInterval = null);
            if (.5 <= a) a = Math.round(a), d = this.getLinearTickPositions(a, r, n);
            else if (.08 <= a)
                for (var e = Math.floor(r), c, b, k, z, B, l = .3 < a ? [1, 2, 4] : .15 < a ? [1, 2, 4, 6, 8] : [1, 2, 3, 4, 5, 6, 7, 8, 9]; e < n + 1 && !B; e++)
                    for (b = l.length, c = 0; c < b && !B; c++) k = m(h(e) * l[c]), k > r && (!w || z <= n) && void 0 !== z && d.push(z), z > n &&
                        (B = !0), z = k;
            else r = h(r), n = h(n), a = w ? this.getMinorTickInterval() : l.tickInterval, a = f("auto" === a ? null : a, this._minorAutoInterval, l.tickPixelInterval / (w ? 5 : 1) * (n - r) / ((w ? e / this.tickPositions.length : e) || 1)), a = p(a, null, D(a)), d = H(this.getLinearTickPositions(a, r, n), m), w || (this._minorAutoInterval = a / 5);
            w || (this.tickInterval = a);
            return d
        };
        E.prototype.log2lin = function(a) { return Math.log(a) / Math.LN10 };
        E.prototype.lin2log = function(a) { return Math.pow(10, a) }
    })(M);
    (function(a, E) {
        var D = a.arrayMax,
            H = a.arrayMin,
            p = a.defined,
            f = a.destroyObjectProperties,
            l = a.each,
            r = a.erase,
            n = a.merge,
            w = a.pick;
        a.PlotLineOrBand = function(a, e) {
            this.axis = a;
            e && (this.options = e, this.id = e.id)
        };
        a.PlotLineOrBand.prototype = {
            render: function() {
                var f = this,
                    e = f.axis,
                    h = e.horiz,
                    m = f.options,
                    d = m.label,
                    c = f.label,
                    b = m.to,
                    k = m.from,
                    z = m.value,
                    l = p(k) && p(b),
                    r = p(z),
                    x = f.svgElem,
                    K = !x,
                    t = [],
                    C = m.color,
                    N = w(m.zIndex, 0),
                    q = m.events,
                    t = { "class": "highcharts-plot-" + (l ? "band " : "line ") + (m.className || "") },
                    A = {},
                    F = e.chart.renderer,
                    G = l ? "bands" : "lines",
                    g = e.log2lin;
                e.isLog && (k = g(k), b = g(b),
                    z = g(z));
                r ? (t = { stroke: C, "stroke-width": m.width }, m.dashStyle && (t.dashstyle = m.dashStyle)) : l && (C && (t.fill = C), m.borderWidth && (t.stroke = m.borderColor, t["stroke-width"] = m.borderWidth));
                A.zIndex = N;
                G += "-" + N;
                (C = e.plotLinesAndBandsGroups[G]) || (e.plotLinesAndBandsGroups[G] = C = F.g("plot-" + G).attr(A).add());
                K && (f.svgElem = x = F.path().attr(t).add(C));
                if (r) t = e.getPlotLinePath(z, x.strokeWidth());
                else if (l) t = e.getPlotBandPath(k, b, m);
                else return;
                K && t && t.length ? (x.attr({ d: t }), q && a.objectEach(q, function(a, b) {
                    x.on(b, function(a) {
                        q[b].apply(f, [a])
                    })
                })) : x && (t ? (x.show(), x.animate({ d: t })) : (x.hide(), c && (f.label = c = c.destroy())));
                d && p(d.text) && t && t.length && 0 < e.width && 0 < e.height && !t.flat ? (d = n({ align: h && l && "center", x: h ? !l && 4 : 10, verticalAlign: !h && l && "middle", y: h ? l ? 16 : 10 : l ? 6 : -4, rotation: h && !l && 90 }, d), this.renderLabel(d, t, l, N)) : c && c.hide();
                return f
            },
            renderLabel: function(a, e, h, m) {
                var d = this.label,
                    c = this.axis.chart.renderer;
                d || (d = { align: a.textAlign || a.align, rotation: a.rotation, "class": "highcharts-plot-" + (h ? "band" : "line") + "-label " + (a.className || "") },
                    d.zIndex = m, this.label = d = c.text(a.text, 0, 0, a.useHTML).attr(d).add(), d.css(a.style));
                m = e.xBounds || [e[1], e[4], h ? e[6] : e[1]];
                e = e.yBounds || [e[2], e[5], h ? e[7] : e[2]];
                h = H(m);
                c = H(e);
                d.align(a, !1, { x: h, y: c, width: D(m) - h, height: D(e) - c });
                d.show()
            },
            destroy: function() {
                r(this.axis.plotLinesAndBands, this);
                delete this.axis;
                f(this)
            }
        };
        a.extend(E.prototype, {
            getPlotBandPath: function(a, e) {
                var h = this.getPlotLinePath(e, null, null, !0),
                    m = this.getPlotLinePath(a, null, null, !0),
                    d = [],
                    c = this.horiz,
                    b = 1,
                    k;
                a = a < this.min && e < this.min || a > this.max &&
                    e > this.max;
                if (m && h)
                    for (a && (k = m.toString() === h.toString(), b = 0), a = 0; a < m.length; a += 6) c && h[a + 1] === m[a + 1] ? (h[a + 1] += b, h[a + 4] += b) : c || h[a + 2] !== m[a + 2] || (h[a + 2] += b, h[a + 5] += b), d.push("M", m[a + 1], m[a + 2], "L", m[a + 4], m[a + 5], h[a + 4], h[a + 5], h[a + 1], h[a + 2], "z"), d.flat = k;
                return d
            },
            addPlotBand: function(a) { return this.addPlotBandOrLine(a, "plotBands") },
            addPlotLine: function(a) { return this.addPlotBandOrLine(a, "plotLines") },
            addPlotBandOrLine: function(f, e) {
                var h = (new a.PlotLineOrBand(this, f)).render(),
                    m = this.userOptions;
                h && (e &&
                    (m[e] = m[e] || [], m[e].push(f)), this.plotLinesAndBands.push(h));
                return h
            },
            removePlotBandOrLine: function(a) {
                for (var e = this.plotLinesAndBands, h = this.options, m = this.userOptions, d = e.length; d--;) e[d].id === a && e[d].destroy();
                l([h.plotLines || [], m.plotLines || [], h.plotBands || [], m.plotBands || []], function(c) { for (d = c.length; d--;) c[d].id === a && r(c, c[d]) })
            },
            removePlotBand: function(a) { this.removePlotBandOrLine(a) },
            removePlotLine: function(a) { this.removePlotBandOrLine(a) }
        })
    })(M, V);
    (function(a) {
        var E = a.dateFormat,
            D = a.each,
            H = a.extend,
            p = a.format,
            f = a.isNumber,
            l = a.map,
            r = a.merge,
            n = a.pick,
            w = a.splat,
            u = a.syncTimeout,
            e = a.timeUnits;
        a.Tooltip = function() { this.init.apply(this, arguments) };
        a.Tooltip.prototype = {
            init: function(a, e) {
                this.chart = a;
                this.options = e;
                this.crosshairs = [];
                this.now = { x: 0, y: 0 };
                this.isHidden = !0;
                this.split = e.split && !a.inverted;
                this.shared = e.shared || this.split
            },
            cleanSplit: function(a) {
                D(this.chart.series, function(e) {
                    var d = e && e.tt;
                    d && (!d.isActive || a ? e.tt = d.destroy() : d.isActive = !1)
                })
            },
            getLabel: function() {
                var a = this.chart.renderer,
                    e = this.options;
                this.label || (this.split ? this.label = a.g("tooltip") : (this.label = a.label("", 0, 0, e.shape || "callout", null, null, e.useHTML, null, "tooltip").attr({ padding: e.padding, r: e.borderRadius }), this.label.attr({ fill: e.backgroundColor, "stroke-width": e.borderWidth }).css(e.style).shadow(e.shadow)), this.label.attr({ zIndex: 8 }).add());
                return this.label
            },
            update: function(a) {
                this.destroy();
                r(!0, this.chart.options.tooltip.userOptions, a);
                this.init(this.chart, r(!0, this.options, a))
            },
            destroy: function() {
                this.label &&
                    (this.label = this.label.destroy());
                this.split && this.tt && (this.cleanSplit(this.chart, !0), this.tt = this.tt.destroy());
                clearTimeout(this.hideTimer);
                clearTimeout(this.tooltipTimeout)
            },
            move: function(a, e, d, c) {
                var b = this,
                    k = b.now,
                    h = !1 !== b.options.animation && !b.isHidden && (1 < Math.abs(a - k.x) || 1 < Math.abs(e - k.y)),
                    m = b.followPointer || 1 < b.len;
                H(k, { x: h ? (2 * k.x + a) / 3 : a, y: h ? (k.y + e) / 2 : e, anchorX: m ? void 0 : h ? (2 * k.anchorX + d) / 3 : d, anchorY: m ? void 0 : h ? (k.anchorY + c) / 2 : c });
                b.getLabel().attr(k);
                h && (clearTimeout(this.tooltipTimeout),
                    this.tooltipTimeout = setTimeout(function() { b && b.move(a, e, d, c) }, 32))
            },
            hide: function(a) {
                var e = this;
                clearTimeout(this.hideTimer);
                a = n(a, this.options.hideDelay, 500);
                this.isHidden || (this.hideTimer = u(function() {
                    e.getLabel()[a ? "fadeOut" : "hide"]();
                    e.isHidden = !0
                }, a))
            },
            getAnchor: function(a, e) {
                var d, c = this.chart,
                    b = c.inverted,
                    k = c.plotTop,
                    h = c.plotLeft,
                    m = 0,
                    f = 0,
                    x, n;
                a = w(a);
                d = a[0].tooltipPos;
                this.followPointer && e && (void 0 === e.chartX && (e = c.pointer.normalize(e)), d = [e.chartX - c.plotLeft, e.chartY - k]);
                d || (D(a, function(a) {
                    x =
                        a.series.yAxis;
                    n = a.series.xAxis;
                    m += a.plotX + (!b && n ? n.left - h : 0);
                    f += (a.plotLow ? (a.plotLow + a.plotHigh) / 2 : a.plotY) + (!b && x ? x.top - k : 0)
                }), m /= a.length, f /= a.length, d = [b ? c.plotWidth - f : m, this.shared && !b && 1 < a.length && e ? e.chartY - k : b ? c.plotHeight - m : f]);
                return l(d, Math.round)
            },
            getPosition: function(a, e, d) {
                var c = this.chart,
                    b = this.distance,
                    k = {},
                    h = c.inverted && d.h || 0,
                    m, f = ["y", c.chartHeight, e, d.plotY + c.plotTop, c.plotTop, c.plotTop + c.plotHeight],
                    x = ["x", c.chartWidth, a, d.plotX + c.plotLeft, c.plotLeft, c.plotLeft + c.plotWidth],
                    l = !this.followPointer && n(d.ttBelow, !c.inverted === !!d.negative),
                    t = function(a, c, d, g, e, q) {
                        var m = d < g - b,
                            z = g + b + d < c,
                            A = g - b - d;
                        g += b;
                        if (l && z) k[a] = g;
                        else if (!l && m) k[a] = A;
                        else if (m) k[a] = Math.min(q - d, 0 > A - h ? A : A - h);
                        else if (z) k[a] = Math.max(e, g + h + d > c ? g : g + h);
                        else return !1
                    },
                    C = function(a, c, d, g) {
                        var e;
                        g < b || g > c - b ? e = !1 : k[a] = g < d / 2 ? 1 : g > c - d / 2 ? c - d - 2 : g - d / 2;
                        return e
                    },
                    p = function(a) {
                        var b = f;
                        f = x;
                        x = b;
                        m = a
                    },
                    q = function() {!1 !== t.apply(0, f) ? !1 !== C.apply(0, x) || m || (p(!0), q()) : m ? k.x = k.y = 0 : (p(!0), q()) };
                (c.inverted || 1 < this.len) && p();
                q();
                return k
            },
            defaultFormatter: function(a) {
                var e = this.points || w(this),
                    d;
                d = [a.tooltipFooterHeaderFormatter(e[0])];
                d = d.concat(a.bodyFormatter(e));
                d.push(a.tooltipFooterHeaderFormatter(e[0], !0));
                return d
            },
            refresh: function(a, e) {
                var d, c = this.options,
                    b, k = a,
                    h, m = {},
                    f = [];
                d = c.formatter || this.defaultFormatter;
                var m = this.shared,
                    x;
                c.enabled && (clearTimeout(this.hideTimer), this.followPointer = w(k)[0].series.tooltipOptions.followPointer, h = this.getAnchor(k, e), e = h[0], b = h[1], !m || k.series && k.series.noSharedTooltip ? m = k.getLabelConfig() :
                    (D(k, function(a) {
                        a.setState("hover");
                        f.push(a.getLabelConfig())
                    }), m = { x: k[0].category, y: k[0].y }, m.points = f, k = k[0]), this.len = f.length, m = d.call(m, this), x = k.series, this.distance = n(x.tooltipOptions.distance, 16), !1 === m ? this.hide() : (d = this.getLabel(), this.isHidden && d.attr({ opacity: 1 }).show(), this.split ? this.renderSplit(m, w(a)) : (c.style.width || d.css({ width: this.chart.spacingBox.width }), d.attr({ text: m && m.join ? m.join("") : m }), d.removeClass(/highcharts-color-[\d]+/g).addClass("highcharts-color-" + n(k.colorIndex,
                        x.colorIndex)), d.attr({ stroke: c.borderColor || k.color || x.color || "#666666" }), this.updatePosition({ plotX: e, plotY: b, negative: k.negative, ttBelow: k.ttBelow, h: h[2] || 0 })), this.isHidden = !1))
            },
            renderSplit: function(e, m) {
                var d = this,
                    c = [],
                    b = this.chart,
                    k = b.renderer,
                    h = !0,
                    f = this.options,
                    l = 0,
                    x = this.getLabel();
                a.isString(e) && (e = [!1, e]);
                D(e.slice(0, m.length + 1), function(a, e) {
                    if (!1 !== a) {
                        e = m[e - 1] || { isHeader: !0, plotX: m[0].plotX };
                        var z = e.series || d,
                            t = z.tt,
                            q = e.series || {},
                            A = "highcharts-color-" + n(e.colorIndex, q.colorIndex, "none");
                        t || (z.tt = t = k.label(null, null, null, "callout", null, null, f.useHTML).addClass("highcharts-tooltip-box " + A).attr({ padding: f.padding, r: f.borderRadius, fill: f.backgroundColor, stroke: f.borderColor || e.color || q.color || "#333333", "stroke-width": f.borderWidth }).add(x));
                        t.isActive = !0;
                        t.attr({ text: a });
                        t.css(f.style).shadow(f.shadow);
                        a = t.getBBox();
                        q = a.width + t.strokeWidth();
                        e.isHeader ? (l = a.height, q = Math.max(0, Math.min(e.plotX + b.plotLeft - q / 2, b.chartWidth - q))) : q = e.plotX + b.plotLeft - n(f.distance, 16) - q;
                        0 > q && (h = !1);
                        a = (e.series &&
                            e.series.yAxis && e.series.yAxis.pos) + (e.plotY || 0);
                        a -= b.plotTop;
                        c.push({ target: e.isHeader ? b.plotHeight + l : a, rank: e.isHeader ? 1 : 0, size: z.tt.getBBox().height + 1, point: e, x: q, tt: t })
                    }
                });
                this.cleanSplit();
                a.distribute(c, b.plotHeight + l);
                D(c, function(a) {
                    var c = a.point,
                        d = c.series;
                    a.tt.attr({ visibility: void 0 === a.pos ? "hidden" : "inherit", x: h || c.isHeader ? a.x : c.plotX + b.plotLeft + n(f.distance, 16), y: a.pos + b.plotTop, anchorX: c.isHeader ? c.plotX + b.plotLeft : c.plotX + d.xAxis.pos, anchorY: c.isHeader ? a.pos + b.plotTop - 15 : c.plotY + d.yAxis.pos })
                })
            },
            updatePosition: function(a) {
                var e = this.chart,
                    d = this.getLabel(),
                    d = (this.options.positioner || this.getPosition).call(this, d.width, d.height, a);
                this.move(Math.round(d.x), Math.round(d.y || 0), a.plotX + e.plotLeft, a.plotY + e.plotTop)
            },
            getDateFormat: function(a, m, d, c) {
                var b = E("%m-%d %H:%M:%S.%L", m),
                    k, h, f = { millisecond: 15, second: 12, minute: 9, hour: 6, day: 3 },
                    l = "millisecond";
                for (h in e) {
                    if (a === e.week && +E("%w", m) === d && "00:00:00.000" === b.substr(6)) { h = "week"; break }
                    if (e[h] > a) { h = l; break }
                    if (f[h] && b.substr(f[h]) !== "01-01 00:00:00.000".substr(f[h])) break;
                    "week" !== h && (l = h)
                }
                h && (k = c[h]);
                return k
            },
            getXDateFormat: function(a, e, d) { e = e.dateTimeLabelFormats; var c = d && d.closestPointRange; return (c ? this.getDateFormat(c, a.x, d.options.startOfWeek, e) : e.day) || e.year },
            tooltipFooterHeaderFormatter: function(a, e) {
                e = e ? "footer" : "header";
                var d = a.series,
                    c = d.tooltipOptions,
                    b = c.xDateFormat,
                    k = d.xAxis,
                    h = k && "datetime" === k.options.type && f(a.key),
                    m = c[e + "Format"];
                h && !b && (b = this.getXDateFormat(a, c, k));
                h && b && D(a.point && a.point.tooltipDateKeys || ["key"], function(a) {
                    m = m.replace("{point." +
                        a + "}", "{point." + a + ":" + b + "}")
                });
                return p(m, { point: a, series: d })
            },
            bodyFormatter: function(a) { return l(a, function(a) { var d = a.series.tooltipOptions; return (d[(a.point.formatPrefix || "point") + "Formatter"] || a.point.tooltipFormatter).call(a.point, d[(a.point.formatPrefix || "point") + "Format"]) }) }
        }
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.attr,
            H = a.charts,
            p = a.color,
            f = a.css,
            l = a.defined,
            r = a.each,
            n = a.extend,
            w = a.find,
            u = a.fireEvent,
            e = a.isObject,
            h = a.offset,
            m = a.pick,
            d = a.splat,
            c = a.Tooltip;
        a.Pointer = function(a, c) {
            this.init(a,
                c)
        };
        a.Pointer.prototype = {
            init: function(a, d) {
                this.options = d;
                this.chart = a;
                this.runChartClick = d.chart.events && !!d.chart.events.click;
                this.pinchDown = [];
                this.lastValidTouch = {};
                c && (a.tooltip = new c(a, d.tooltip), this.followTouchMove = m(d.tooltip.followTouchMove, !0));
                this.setDOMEvents()
            },
            zoomOption: function(a) {
                var b = this.chart,
                    c = b.options.chart,
                    d = c.zoomType || "",
                    b = b.inverted;
                /touch/.test(a.type) && (d = m(c.pinchType, d));
                this.zoomX = a = /x/.test(d);
                this.zoomY = d = /y/.test(d);
                this.zoomHor = a && !b || d && b;
                this.zoomVert = d &&
                    !b || a && b;
                this.hasZoom = a || d
            },
            normalize: function(a, c) {
                var b;
                b = a.touches ? a.touches.length ? a.touches.item(0) : a.changedTouches[0] : a;
                c || (this.chartPosition = c = h(this.chart.container));
                return n(a, { chartX: Math.round(b.pageX - c.left), chartY: Math.round(b.pageY - c.top) })
            },
            getCoordinates: function(a) {
                var b = { xAxis: [], yAxis: [] };
                r(this.chart.axes, function(c) { b[c.isXAxis ? "xAxis" : "yAxis"].push({ axis: c, value: c.toValue(a[c.horiz ? "chartX" : "chartY"]) }) });
                return b
            },
            findNearestKDPoint: function(a, c, d) {
                var b;
                r(a, function(a) {
                    var k = !(a.noSharedTooltip && c) && 0 > a.options.findNearestPointBy.indexOf("y");
                    a = a.searchPoint(d, k);
                    if ((k = e(a, !0)) && !(k = !e(b, !0))) var k = b.distX - a.distX,
                        h = b.dist - a.dist,
                        m = (a.series.group && a.series.group.zIndex) - (b.series.group && b.series.group.zIndex),
                        k = 0 < (0 !== k && c ? k : 0 !== h ? h : 0 !== m ? m : b.series.index > a.series.index ? -1 : 1);
                    k && (b = a)
                });
                return b
            },
            getPointFromEvent: function(a) { a = a.target; for (var b; a && !b;) b = a.point, a = a.parentNode; return b },
            getChartCoordinatesFromPoint: function(a, c) {
                var b = a.series,
                    d = b.xAxis,
                    b = b.yAxis,
                    k =
                    m(a.clientX, a.plotX);
                if (d && b) return c ? { chartX: d.len + d.pos - k, chartY: b.len + b.pos - a.plotY } : { chartX: k + d.pos, chartY: a.plotY + b.pos }
            },
            getHoverData: function(b, c, d, h, f, l, n) {
                var k, z = [],
                    x = n && n.isBoosting;
                h = !(!h || !b);
                n = c && !c.stickyTracking ? [c] : a.grep(d, function(a) { return a.visible && !(!f && a.directTouch) && m(a.options.enableMouseTracking, !0) && a.stickyTracking });
                c = (k = h ? b : this.findNearestKDPoint(n, f, l)) && k.series;
                k && (f && !c.noSharedTooltip ? (n = a.grep(d, function(a) {
                    return a.visible && !(!f && a.directTouch) && m(a.options.enableMouseTracking, !0) && !a.noSharedTooltip
                }), r(n, function(a) {
                    var b = w(a.points, function(a) { return a.x === k.x && !a.isNull });
                    e(b) && (x && (b = a.getPoint(b)), z.push(b))
                })) : z.push(k));
                return { hoverPoint: k, hoverSeries: c, hoverPoints: z }
            },
            runPointActions: function(b, c) {
                var d = this.chart,
                    k = d.tooltip && d.tooltip.options.enabled ? d.tooltip : void 0,
                    e = k ? k.shared : !1,
                    h = c || d.hoverPoint,
                    f = h && h.series || d.hoverSeries,
                    f = this.getHoverData(h, f, d.series, !!c || f && f.directTouch && this.isDirectTouch, e, b, { isBoosting: d.isBoosting }),
                    l, h = f.hoverPoint;
                l = f.hoverPoints;
                c = (f = f.hoverSeries) && f.tooltipOptions.followPointer;
                e = e && f && !f.noSharedTooltip;
                if (h && (h !== d.hoverPoint || k && k.isHidden)) {
                    r(d.hoverPoints || [], function(b) {-1 === a.inArray(b, l) && b.setState() });
                    r(l || [], function(a) { a.setState("hover") });
                    if (d.hoverSeries !== f) f.onMouseOver();
                    d.hoverPoint && d.hoverPoint.firePointEvent("mouseOut");
                    if (!h.series) return;
                    h.firePointEvent("mouseOver");
                    d.hoverPoints = l;
                    d.hoverPoint = h;
                    k && k.refresh(e ? l : h, b)
                } else c && k && !k.isHidden && (h = k.getAnchor([{}], b), k.updatePosition({ plotX: h[0], plotY: h[1] }));
                this.unDocMouseMove || (this.unDocMouseMove = E(d.container.ownerDocument, "mousemove", function(b) { var c = H[a.hoverChartIndex]; if (c) c.pointer.onDocumentMouseMove(b) }));
                r(d.axes, function(c) {
                    var d = m(c.crosshair.snap, !0),
                        k = d ? a.find(l, function(a) { return a.series[c.coll] === c }) : void 0;
                    k || !d ? c.drawCrosshair(b, k) : c.hideCrosshair()
                })
            },
            reset: function(a, c) {
                var b = this.chart,
                    k = b.hoverSeries,
                    e = b.hoverPoint,
                    h = b.hoverPoints,
                    m = b.tooltip,
                    f = m && m.shared ? h : e;
                a && f && r(d(f), function(b) {
                    b.series.isCartesian && void 0 === b.plotX &&
                        (a = !1)
                });
                if (a) m && f && (m.refresh(f), e && (e.setState(e.state, !0), r(b.axes, function(a) { a.crosshair && a.drawCrosshair(null, e) })));
                else {
                    if (e) e.onMouseOut();
                    h && r(h, function(a) { a.setState() });
                    if (k) k.onMouseOut();
                    m && m.hide(c);
                    this.unDocMouseMove && (this.unDocMouseMove = this.unDocMouseMove());
                    r(b.axes, function(a) { a.hideCrosshair() });
                    this.hoverX = b.hoverPoints = b.hoverPoint = null
                }
            },
            scaleGroups: function(a, c) {
                var b = this.chart,
                    d;
                r(b.series, function(k) {
                    d = a || k.getPlotBox();
                    k.xAxis && k.xAxis.zoomEnabled && k.group && (k.group.attr(d),
                        k.markerGroup && (k.markerGroup.attr(d), k.markerGroup.clip(c ? b.clipRect : null)), k.dataLabelsGroup && k.dataLabelsGroup.attr(d))
                });
                b.clipRect.attr(c || b.clipBox)
            },
            dragStart: function(a) {
                var b = this.chart;
                b.mouseIsDown = a.type;
                b.cancelClick = !1;
                b.mouseDownX = this.mouseDownX = a.chartX;
                b.mouseDownY = this.mouseDownY = a.chartY
            },
            drag: function(a) {
                var b = this.chart,
                    c = b.options.chart,
                    d = a.chartX,
                    e = a.chartY,
                    h = this.zoomHor,
                    m = this.zoomVert,
                    f = b.plotLeft,
                    l = b.plotTop,
                    n = b.plotWidth,
                    q = b.plotHeight,
                    A, F = this.selectionMarker,
                    G = this.mouseDownX,
                    g = this.mouseDownY,
                    v = c.panKey && a[c.panKey + "Key"];
                F && F.touch || (d < f ? d = f : d > f + n && (d = f + n), e < l ? e = l : e > l + q && (e = l + q), this.hasDragged = Math.sqrt(Math.pow(G - d, 2) + Math.pow(g - e, 2)), 10 < this.hasDragged && (A = b.isInsidePlot(G - f, g - l), b.hasCartesianSeries && (this.zoomX || this.zoomY) && A && !v && !F && (this.selectionMarker = F = b.renderer.rect(f, l, h ? 1 : n, m ? 1 : q, 0).attr({ fill: c.selectionMarkerFill || p("#335cad").setOpacity(.25).get(), "class": "highcharts-selection-marker", zIndex: 7 }).add()), F && h && (d -= G, F.attr({
                    width: Math.abs(d),
                    x: (0 < d ?
                        0 : d) + G
                })), F && m && (d = e - g, F.attr({ height: Math.abs(d), y: (0 < d ? 0 : d) + g })), A && !F && c.panning && b.pan(a, c.panning)))
            },
            drop: function(a) {
                var b = this,
                    c = this.chart,
                    d = this.hasPinched;
                if (this.selectionMarker) {
                    var e = { originalEvent: a, xAxis: [], yAxis: [] },
                        h = this.selectionMarker,
                        m = h.attr ? h.attr("x") : h.x,
                        t = h.attr ? h.attr("y") : h.y,
                        p = h.attr ? h.attr("width") : h.width,
                        w = h.attr ? h.attr("height") : h.height,
                        q;
                    if (this.hasDragged || d) r(c.axes, function(c) {
                        if (c.zoomEnabled && l(c.min) && (d || b[{ xAxis: "zoomX", yAxis: "zoomY" }[c.coll]])) {
                            var k = c.horiz,
                                h = "touchend" === a.type ? c.minPixelPadding : 0,
                                g = c.toValue((k ? m : t) + h),
                                k = c.toValue((k ? m + p : t + w) - h);
                            e[c.coll].push({ axis: c, min: Math.min(g, k), max: Math.max(g, k) });
                            q = !0
                        }
                    }), q && u(c, "selection", e, function(a) { c.zoom(n(a, d ? { animation: !1 } : null)) });
                    this.selectionMarker = this.selectionMarker.destroy();
                    d && this.scaleGroups()
                }
                c && (f(c.container, { cursor: c._cursor }), c.cancelClick = 10 < this.hasDragged, c.mouseIsDown = this.hasDragged = this.hasPinched = !1, this.pinchDown = [])
            },
            onContainerMouseDown: function(a) {
                2 !== a.button && (a = this.normalize(a),
                    this.zoomOption(a), a.preventDefault && a.preventDefault(), this.dragStart(a))
            },
            onDocumentMouseUp: function(b) { H[a.hoverChartIndex] && H[a.hoverChartIndex].pointer.drop(b) },
            onDocumentMouseMove: function(a) {
                var b = this.chart,
                    c = this.chartPosition;
                a = this.normalize(a, c);
                !c || this.inClass(a.target, "highcharts-tracker") || b.isInsidePlot(a.chartX - b.plotLeft, a.chartY - b.plotTop) || this.reset()
            },
            onContainerMouseLeave: function(b) {
                var c = H[a.hoverChartIndex];
                c && (b.relatedTarget || b.toElement) && (c.pointer.reset(), c.pointer.chartPosition =
                    null)
            },
            onContainerMouseMove: function(b) {
                var c = this.chart;
                l(a.hoverChartIndex) && H[a.hoverChartIndex] && H[a.hoverChartIndex].mouseIsDown || (a.hoverChartIndex = c.index);
                b = this.normalize(b);
                b.returnValue = !1;
                "mousedown" === c.mouseIsDown && this.drag(b);
                !this.inClass(b.target, "highcharts-tracker") && !c.isInsidePlot(b.chartX - c.plotLeft, b.chartY - c.plotTop) || c.openMenu || this.runPointActions(b)
            },
            inClass: function(a, c) {
                for (var b; a;) {
                    if (b = D(a, "class")) { if (-1 !== b.indexOf(c)) return !0; if (-1 !== b.indexOf("highcharts-container")) return !1 }
                    a =
                        a.parentNode
                }
            },
            onTrackerMouseOut: function(a) {
                var b = this.chart.hoverSeries;
                a = a.relatedTarget || a.toElement;
                this.isDirectTouch = !1;
                if (!(!b || !a || b.stickyTracking || this.inClass(a, "highcharts-tooltip") || this.inClass(a, "highcharts-series-" + b.index) && this.inClass(a, "highcharts-tracker"))) b.onMouseOut()
            },
            onContainerClick: function(a) {
                var b = this.chart,
                    c = b.hoverPoint,
                    d = b.plotLeft,
                    e = b.plotTop;
                a = this.normalize(a);
                b.cancelClick || (c && this.inClass(a.target, "highcharts-tracker") ? (u(c.series, "click", n(a, { point: c })),
                    b.hoverPoint && c.firePointEvent("click", a)) : (n(a, this.getCoordinates(a)), b.isInsidePlot(a.chartX - d, a.chartY - e) && u(b, "click", a)))
            },
            setDOMEvents: function() {
                var b = this,
                    c = b.chart.container,
                    d = c.ownerDocument;
                c.onmousedown = function(a) { b.onContainerMouseDown(a) };
                c.onmousemove = function(a) { b.onContainerMouseMove(a) };
                c.onclick = function(a) { b.onContainerClick(a) };
                this.unbindContainerMouseLeave = E(c, "mouseleave", b.onContainerMouseLeave);
                a.unbindDocumentMouseUp || (a.unbindDocumentMouseUp = E(d, "mouseup", b.onDocumentMouseUp));
                a.hasTouch && (c.ontouchstart = function(a) { b.onContainerTouchStart(a) }, c.ontouchmove = function(a) { b.onContainerTouchMove(a) }, a.unbindDocumentTouchEnd || (a.unbindDocumentTouchEnd = E(d, "touchend", b.onDocumentTouchEnd)))
            },
            destroy: function() {
                var b = this;
                b.unDocMouseMove && b.unDocMouseMove();
                this.unbindContainerMouseLeave();
                a.chartCount || (a.unbindDocumentMouseUp && (a.unbindDocumentMouseUp = a.unbindDocumentMouseUp()), a.unbindDocumentTouchEnd && (a.unbindDocumentTouchEnd = a.unbindDocumentTouchEnd()));
                clearInterval(b.tooltipTimeout);
                a.objectEach(b, function(a, c) { b[c] = null })
            }
        }
    })(M);
    (function(a) {
        var E = a.charts,
            D = a.each,
            H = a.extend,
            p = a.map,
            f = a.noop,
            l = a.pick;
        H(a.Pointer.prototype, {
            pinchTranslate: function(a, f, l, p, e, h) {
                this.zoomHor && this.pinchTranslateDirection(!0, a, f, l, p, e, h);
                this.zoomVert && this.pinchTranslateDirection(!1, a, f, l, p, e, h)
            },
            pinchTranslateDirection: function(a, f, l, p, e, h, m, d) {
                var c = this.chart,
                    b = a ? "x" : "y",
                    k = a ? "X" : "Y",
                    z = "chart" + k,
                    n = a ? "width" : "height",
                    r = c["plot" + (a ? "Left" : "Top")],
                    x, w, t = d || 1,
                    C = c.inverted,
                    u = c.bounds[a ? "h" : "v"],
                    q = 1 === f.length,
                    A = f[0][z],
                    F = l[0][z],
                    G = !q && f[1][z],
                    g = !q && l[1][z],
                    v;
                l = function() {
                    !q && 20 < Math.abs(A - G) && (t = d || Math.abs(F - g) / Math.abs(A - G));
                    w = (r - F) / t + A;
                    x = c["plot" + (a ? "Width" : "Height")] / t
                };
                l();
                f = w;
                f < u.min ? (f = u.min, v = !0) : f + x > u.max && (f = u.max - x, v = !0);
                v ? (F -= .8 * (F - m[b][0]), q || (g -= .8 * (g - m[b][1])), l()) : m[b] = [F, g];
                C || (h[b] = w - r, h[n] = x);
                h = C ? 1 / t : t;
                e[n] = x;
                e[b] = f;
                p[C ? a ? "scaleY" : "scaleX" : "scale" + k] = t;
                p["translate" + k] = h * r + (F - h * A)
            },
            pinch: function(a) {
                var n = this,
                    r = n.chart,
                    u = n.pinchDown,
                    e = a.touches,
                    h = e.length,
                    m = n.lastValidTouch,
                    d = n.hasZoom,
                    c = n.selectionMarker,
                    b = {},
                    k = 1 === h && (n.inClass(a.target, "highcharts-tracker") && r.runTrackerClick || n.runChartClick),
                    z = {};
                1 < h && (n.initiated = !0);
                d && n.initiated && !k && a.preventDefault();
                p(e, function(a) { return n.normalize(a) });
                "touchstart" === a.type ? (D(e, function(a, b) { u[b] = { chartX: a.chartX, chartY: a.chartY } }), m.x = [u[0].chartX, u[1] && u[1].chartX], m.y = [u[0].chartY, u[1] && u[1].chartY], D(r.axes, function(a) {
                    if (a.zoomEnabled) {
                        var b = r.bounds[a.horiz ? "h" : "v"],
                            c = a.minPixelPadding,
                            d = a.toPixels(l(a.options.min,
                                a.dataMin)),
                            e = a.toPixels(l(a.options.max, a.dataMax)),
                            k = Math.max(d, e);
                        b.min = Math.min(a.pos, Math.min(d, e) - c);
                        b.max = Math.max(a.pos + a.len, k + c)
                    }
                }), n.res = !0) : n.followTouchMove && 1 === h ? this.runPointActions(n.normalize(a)) : u.length && (c || (n.selectionMarker = c = H({ destroy: f, touch: !0 }, r.plotBox)), n.pinchTranslate(u, e, b, c, z, m), n.hasPinched = d, n.scaleGroups(b, z), n.res && (n.res = !1, this.reset(!1, 0)))
            },
            touch: function(f, n) {
                var p = this.chart,
                    r, e;
                if (p.index !== a.hoverChartIndex) this.onContainerMouseLeave({ relatedTarget: !0 });
                a.hoverChartIndex = p.index;
                1 === f.touches.length ? (f = this.normalize(f), (e = p.isInsidePlot(f.chartX - p.plotLeft, f.chartY - p.plotTop)) && !p.openMenu ? (n && this.runPointActions(f), "touchmove" === f.type && (n = this.pinchDown, r = n[0] ? 4 <= Math.sqrt(Math.pow(n[0].chartX - f.chartX, 2) + Math.pow(n[0].chartY - f.chartY, 2)) : !1), l(r, !0) && this.pinch(f)) : n && this.reset()) : 2 === f.touches.length && this.pinch(f)
            },
            onContainerTouchStart: function(a) {
                this.zoomOption(a);
                this.touch(a, !0)
            },
            onContainerTouchMove: function(a) { this.touch(a) },
            onDocumentTouchEnd: function(f) {
                E[a.hoverChartIndex] &&
                    E[a.hoverChartIndex].pointer.drop(f)
            }
        })
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.charts,
            H = a.css,
            p = a.doc,
            f = a.extend,
            l = a.noop,
            r = a.Pointer,
            n = a.removeEvent,
            w = a.win,
            u = a.wrap;
        if (!a.hasTouch && (w.PointerEvent || w.MSPointerEvent)) {
            var e = {},
                h = !!w.PointerEvent,
                m = function() {
                    var c = [];
                    c.item = function(a) { return this[a] };
                    a.objectEach(e, function(a) { c.push({ pageX: a.pageX, pageY: a.pageY, target: a.target }) });
                    return c
                },
                d = function(c, b, d, e) {
                    "touch" !== c.pointerType && c.pointerType !== c.MSPOINTER_TYPE_TOUCH || !D[a.hoverChartIndex] ||
                        (e(c), e = D[a.hoverChartIndex].pointer, e[b]({ type: d, target: c.currentTarget, preventDefault: l, touches: m() }))
                };
            f(r.prototype, {
                onContainerPointerDown: function(a) { d(a, "onContainerTouchStart", "touchstart", function(a) { e[a.pointerId] = { pageX: a.pageX, pageY: a.pageY, target: a.currentTarget } }) },
                onContainerPointerMove: function(a) {
                    d(a, "onContainerTouchMove", "touchmove", function(a) {
                        e[a.pointerId] = { pageX: a.pageX, pageY: a.pageY };
                        e[a.pointerId].target || (e[a.pointerId].target = a.currentTarget)
                    })
                },
                onDocumentPointerUp: function(a) {
                    d(a,
                        "onDocumentTouchEnd", "touchend",
                        function(a) { delete e[a.pointerId] })
                },
                batchMSEvents: function(a) {
                    a(this.chart.container, h ? "pointerdown" : "MSPointerDown", this.onContainerPointerDown);
                    a(this.chart.container, h ? "pointermove" : "MSPointerMove", this.onContainerPointerMove);
                    a(p, h ? "pointerup" : "MSPointerUp", this.onDocumentPointerUp)
                }
            });
            u(r.prototype, "init", function(a, b, d) {
                a.call(this, b, d);
                this.hasZoom && H(b.container, { "-ms-touch-action": "none", "touch-action": "none" })
            });
            u(r.prototype, "setDOMEvents", function(a) {
                a.apply(this);
                (this.hasZoom || this.followTouchMove) && this.batchMSEvents(E)
            });
            u(r.prototype, "destroy", function(a) {
                this.batchMSEvents(n);
                a.call(this)
            })
        }
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.css,
            H = a.discardElement,
            p = a.defined,
            f = a.each,
            l = a.isFirefox,
            r = a.marginNames,
            n = a.merge,
            w = a.pick,
            u = a.setAnimation,
            e = a.stableSort,
            h = a.win,
            m = a.wrap;
        a.Legend = function(a, c) { this.init(a, c) };
        a.Legend.prototype = {
            init: function(a, c) {
                this.chart = a;
                this.setOptions(c);
                c.enabled && (this.render(), E(this.chart, "endResize", function() { this.legend.positionCheckboxes() }))
            },
            setOptions: function(a) {
                var c = w(a.padding, 8);
                this.options = a;
                this.itemStyle = a.itemStyle;
                this.itemHiddenStyle = n(this.itemStyle, a.itemHiddenStyle);
                this.itemMarginTop = a.itemMarginTop || 0;
                this.padding = c;
                this.initialItemY = c - 5;
                this.itemHeight = this.maxItemWidth = 0;
                this.symbolWidth = w(a.symbolWidth, 16);
                this.pages = []
            },
            update: function(a, c) {
                var b = this.chart;
                this.setOptions(n(!0, this.options, a));
                this.destroy();
                b.isDirtyLegend = b.isDirtyBox = !0;
                w(c, !0) && b.redraw()
            },
            colorizeItem: function(a, c) {
                a.legendGroup[c ? "removeClass" :
                    "addClass"]("highcharts-legend-item-hidden");
                var b = this.options,
                    d = a.legendItem,
                    e = a.legendLine,
                    h = a.legendSymbol,
                    f = this.itemHiddenStyle.color,
                    b = c ? b.itemStyle.color : f,
                    m = c ? a.color || f : f,
                    l = a.options && a.options.marker,
                    t = { fill: m };
                d && d.css({ fill: b, color: b });
                e && e.attr({ stroke: m });
                h && (l && h.isMarker && (t = a.pointAttribs(), c || (t.stroke = t.fill = f)), h.attr(t))
            },
            positionItem: function(a) {
                var c = this.options,
                    b = c.symbolPadding,
                    c = !c.rtl,
                    d = a._legendItemPos,
                    e = d[0],
                    d = d[1],
                    h = a.checkbox;
                (a = a.legendGroup) && a.element && a.translate(c ?
                    e : this.legendWidth - e - 2 * b - 4, d);
                h && (h.x = e, h.y = d)
            },
            destroyItem: function(a) {
                var c = a.checkbox;
                f(["legendItem", "legendLine", "legendSymbol", "legendGroup"], function(b) { a[b] && (a[b] = a[b].destroy()) });
                c && H(a.checkbox)
            },
            destroy: function() {
                function a(a) { this[a] && (this[a] = this[a].destroy()) }
                f(this.getAllItems(), function(c) { f(["legendItem", "legendGroup"], a, c) });
                f("clipRect up down pager nav box title group".split(" "), a, this);
                this.display = null
            },
            positionCheckboxes: function() {
                var a = this.group && this.group.alignAttr,
                    c, b = this.clipHeight || this.legendHeight,
                    e = this.titleHeight;
                a && (c = a.translateY, f(this.allItems, function(d) {
                    var k = d.checkbox,
                        h;
                    k && (h = c + e + k.y + (this.scrollOffset || 0) + 3, D(k, { left: a.translateX + d.checkboxOffset + k.x - 20 + "px", top: h + "px", display: h > c - 6 && h < c + b - 6 ? "" : "none" }))
                }, this))
            },
            renderTitle: function() {
                var a = this.options,
                    c = this.padding,
                    b = a.title,
                    e = 0;
                b.text && (this.title || (this.title = this.chart.renderer.label(b.text, c - 3, c - 4, null, null, null, a.useHTML, null, "legend-title").attr({ zIndex: 1 }).css(b.style).add(this.group)),
                    a = this.title.getBBox(), e = a.height, this.offsetWidth = a.width, this.contentGroup.attr({ translateY: e }));
                this.titleHeight = e
            },
            setText: function(d) {
                var c = this.options;
                d.legendItem.attr({ text: c.labelFormat ? a.format(c.labelFormat, d) : c.labelFormatter.call(d) })
            },
            renderItem: function(a) {
                var c = this.chart,
                    b = c.renderer,
                    d = this.options,
                    e = "horizontal" === d.layout,
                    h = this.symbolWidth,
                    f = d.symbolPadding,
                    m = this.itemStyle,
                    l = this.itemHiddenStyle,
                    t = this.padding,
                    p = e ? w(d.itemDistance, 20) : 0,
                    r = !d.rtl,
                    q = d.width,
                    A = d.itemMarginBottom ||
                    0,
                    F = this.itemMarginTop,
                    G = a.legendItem,
                    g = !a.series,
                    v = !g && a.series.drawLegendSymbol ? a.series : a,
                    u = v.options,
                    L = this.createCheckboxForItem && u && u.showCheckbox,
                    u = h + f + p + (L ? 20 : 0),
                    P = d.useHTML,
                    J = a.options.className;
                G || (a.legendGroup = b.g("legend-item").addClass("highcharts-" + v.type + "-series highcharts-color-" + a.colorIndex + (J ? " " + J : "") + (g ? " highcharts-series-" + a.index : "")).attr({ zIndex: 1 }).add(this.scrollGroup), a.legendItem = G = b.text("", r ? h + f : -f, this.baseline || 0, P).css(n(a.visible ? m : l)).attr({
                    align: r ? "left" : "right",
                    zIndex: 2
                }).add(a.legendGroup), this.baseline || (h = m.fontSize, this.fontMetrics = b.fontMetrics(h, G), this.baseline = this.fontMetrics.f + 3 + F, G.attr("y", this.baseline)), this.symbolHeight = d.symbolHeight || this.fontMetrics.f, v.drawLegendSymbol(this, a), this.setItemEvents && this.setItemEvents(a, G, P), L && this.createCheckboxForItem(a));
                this.colorizeItem(a, a.visible);
                m.width || G.css({ width: (d.itemWidth || d.width || c.spacingBox.width) - u });
                this.setText(a);
                b = G.getBBox();
                m = a.checkboxOffset = d.itemWidth || a.legendItemWidth || b.width +
                    u;
                this.itemHeight = b = Math.round(a.legendItemHeight || b.height || this.symbolHeight);
                e && this.itemX - t + m > (q || c.spacingBox.width - 2 * t - d.x) && (this.itemX = t, this.itemY += F + this.lastLineHeight + A, this.lastLineHeight = 0);
                this.maxItemWidth = Math.max(this.maxItemWidth, m);
                this.lastItemY = F + this.itemY + A;
                this.lastLineHeight = Math.max(b, this.lastLineHeight);
                a._legendItemPos = [this.itemX, this.itemY];
                e ? this.itemX += m : (this.itemY += F + b + A, this.lastLineHeight = b);
                this.offsetWidth = q || Math.max((e ? this.itemX - t - (a.checkbox ? 0 : p) : m) + t, this.offsetWidth)
            },
            getAllItems: function() {
                var a = [];
                f(this.chart.series, function(c) {
                    var b = c && c.options;
                    c && w(b.showInLegend, p(b.linkedTo) ? !1 : void 0, !0) && (a = a.concat(c.legendItems || ("point" === b.legendType ? c.data : c)))
                });
                return a
            },
            getAlignment: function() { var a = this.options; return a.floating ? "" : a.align.charAt(0) + a.verticalAlign.charAt(0) + a.layout.charAt(0) },
            adjustMargins: function(a, c) {
                var b = this.chart,
                    d = this.options,
                    e = this.getAlignment();
                e && f([/(lth|ct|rth)/, /(rtv|rm|rbv)/, /(rbh|cb|lbh)/, /(lbv|lm|ltv)/], function(k, h) {
                    k.test(e) &&
                        !p(a[h]) && (b[r[h]] = Math.max(b[r[h]], b.legend[(h + 1) % 2 ? "legendHeight" : "legendWidth"] + [1, -1, -1, 1][h] * d[h % 2 ? "x" : "y"] + w(d.margin, 12) + c[h] + (0 === h ? b.titleOffset + b.options.title.margin : 0)))
                })
            },
            render: function() {
                var a = this,
                    c = a.chart,
                    b = c.renderer,
                    k = a.group,
                    h, m, l, x, p = a.box,
                    t = a.options,
                    C = a.padding;
                a.itemX = C;
                a.itemY = a.initialItemY;
                a.offsetWidth = 0;
                a.lastItemY = 0;
                k || (a.group = k = b.g("legend").attr({ zIndex: 7 }).add(), a.contentGroup = b.g().attr({ zIndex: 1 }).add(k), a.scrollGroup = b.g().add(a.contentGroup));
                a.renderTitle();
                h = a.getAllItems();
                e(h, function(a, b) { return (a.options && a.options.legendIndex || 0) - (b.options && b.options.legendIndex || 0) });
                t.reversed && h.reverse();
                a.allItems = h;
                a.display = m = !!h.length;
                a.lastLineHeight = 0;
                f(h, function(b) { a.renderItem(b) });
                l = (t.width || a.offsetWidth) + C;
                x = a.lastItemY + a.lastLineHeight + a.titleHeight;
                x = a.handleOverflow(x);
                x += C;
                p || (a.box = p = b.rect().addClass("highcharts-legend-box").attr({ r: t.borderRadius }).add(k), p.isNew = !0);
                p.attr({
                    stroke: t.borderColor,
                    "stroke-width": t.borderWidth || 0,
                    fill: t.backgroundColor ||
                        "none"
                }).shadow(t.shadow);
                0 < l && 0 < x && (p[p.isNew ? "attr" : "animate"](p.crisp.call({}, { x: 0, y: 0, width: l, height: x }, p.strokeWidth())), p.isNew = !1);
                p[m ? "show" : "hide"]();
                a.legendWidth = l;
                a.legendHeight = x;
                f(h, function(b) { a.positionItem(b) });
                m && (b = c.spacingBox, /(lth|ct|rth)/.test(a.getAlignment()) && (b = n(b, { y: b.y + c.titleOffset + c.options.title.margin })), k.align(n(t, { width: l, height: x }), !0, b));
                c.isResizing || this.positionCheckboxes()
            },
            handleOverflow: function(a) {
                var c = this,
                    b = this.chart,
                    d = b.renderer,
                    e = this.options,
                    h =
                    e.y,
                    m = this.padding,
                    b = b.spacingBox.height + ("top" === e.verticalAlign ? -h : h) - m,
                    h = e.maxHeight,
                    l, n = this.clipRect,
                    t = e.navigation,
                    p = w(t.animation, !0),
                    r = t.arrowSize || 12,
                    q = this.nav,
                    A = this.pages,
                    F, G = this.allItems,
                    g = function(a) {
                        "number" === typeof a ? n.attr({ height: a }) : n && (c.clipRect = n.destroy(), c.contentGroup.clip());
                        c.contentGroup.div && (c.contentGroup.div.style.clip = a ? "rect(" + m + "px,9999px," + (m + a) + "px,0)" : "auto")
                    };
                "horizontal" !== e.layout || "middle" === e.verticalAlign || e.floating || (b /= 2);
                h && (b = Math.min(b, h));
                A.length =
                    0;
                a > b && !1 !== t.enabled ? (this.clipHeight = l = Math.max(b - 20 - this.titleHeight - m, 0), this.currentPage = w(this.currentPage, 1), this.fullHeight = a, f(G, function(a, b) {
                    var c = a._legendItemPos[1],
                        d = Math.round(a.legendItem.getBBox().height),
                        g = A.length;
                    if (!g || c - A[g - 1] > l && (F || c) !== A[g - 1]) A.push(F || c), g++;
                    a.pageIx = g - 1;
                    F && (G[b - 1].pageIx = g - 1);
                    b === G.length - 1 && c + d - A[g - 1] > l && (A.push(c), a.pageIx = g);
                    c !== F && (F = c)
                }), n || (n = c.clipRect = d.clipRect(0, m, 9999, 0), c.contentGroup.clip(n)), g(l), q || (this.nav = q = d.g().attr({ zIndex: 1 }).add(this.group),
                    this.up = d.symbol("triangle", 0, 0, r, r).on("click", function() { c.scroll(-1, p) }).add(q), this.pager = d.text("", 15, 10).addClass("highcharts-legend-navigation").css(t.style).add(q), this.down = d.symbol("triangle-down", 0, 0, r, r).on("click", function() { c.scroll(1, p) }).add(q)), c.scroll(0), a = b) : q && (g(), this.nav = q.destroy(), this.scrollGroup.attr({ translateY: 1 }), this.clipHeight = 0);
                return a
            },
            scroll: function(a, c) {
                var b = this.pages,
                    d = b.length;
                a = this.currentPage + a;
                var e = this.clipHeight,
                    h = this.options.navigation,
                    f = this.pager,
                    m = this.padding;
                a > d && (a = d);
                0 < a && (void 0 !== c && u(c, this.chart), this.nav.attr({ translateX: m, translateY: e + this.padding + 7 + this.titleHeight, visibility: "visible" }), this.up.attr({ "class": 1 === a ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active" }), f.attr({ text: a + "/" + d }), this.down.attr({ x: 18 + this.pager.getBBox().width, "class": a === d ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active" }), this.up.attr({ fill: 1 === a ? h.inactiveColor : h.activeColor }).css({ cursor: 1 === a ? "default" : "pointer" }), this.down.attr({
                    fill: a ===
                        d ? h.inactiveColor : h.activeColor
                }).css({ cursor: a === d ? "default" : "pointer" }), this.scrollOffset = -b[a - 1] + this.initialItemY, this.scrollGroup.animate({ translateY: this.scrollOffset }), this.currentPage = a, this.positionCheckboxes())
            }
        };
        a.LegendSymbolMixin = {
            drawRectangle: function(a, c) {
                var b = a.symbolHeight,
                    d = a.options.squareSymbol;
                c.legendSymbol = this.chart.renderer.rect(d ? (a.symbolWidth - b) / 2 : 0, a.baseline - b + 1, d ? b : a.symbolWidth, b, w(a.options.symbolRadius, b / 2)).addClass("highcharts-point").attr({ zIndex: 3 }).add(c.legendGroup)
            },
            drawLineMarker: function(a) {
                var c = this.options,
                    b = c.marker,
                    d = a.symbolWidth,
                    e = a.symbolHeight,
                    h = e / 2,
                    f = this.chart.renderer,
                    m = this.legendGroup;
                a = a.baseline - Math.round(.3 * a.fontMetrics.b);
                var l;
                l = { "stroke-width": c.lineWidth || 0 };
                c.dashStyle && (l.dashstyle = c.dashStyle);
                this.legendLine = f.path(["M", 0, a, "L", d, a]).addClass("highcharts-graph").attr(l).add(m);
                b && !1 !== b.enabled && (c = Math.min(w(b.radius, h), h), 0 === this.symbol.indexOf("url") && (b = n(b, { width: e, height: e }), c = 0), this.legendSymbol = b = f.symbol(this.symbol, d /
                    2 - c, a - c, 2 * c, 2 * c, b).addClass("highcharts-point").add(m), b.isMarker = !0)
            }
        };
        (/Trident\/7\.0/.test(h.navigator.userAgent) || l) && m(a.Legend.prototype, "positionItem", function(a, c) {
            var b = this,
                d = function() { c._legendItemPos && a.call(b, c) };
            d();
            setTimeout(d)
        })
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.animate,
            H = a.animObject,
            p = a.attr,
            f = a.doc,
            l = a.Axis,
            r = a.createElement,
            n = a.defaultOptions,
            w = a.discardElement,
            u = a.charts,
            e = a.css,
            h = a.defined,
            m = a.each,
            d = a.extend,
            c = a.find,
            b = a.fireEvent,
            k = a.grep,
            z = a.isNumber,
            B = a.isObject,
            I =
            a.isString,
            x = a.Legend,
            K = a.marginNames,
            t = a.merge,
            C = a.objectEach,
            N = a.Pointer,
            q = a.pick,
            A = a.pInt,
            F = a.removeEvent,
            G = a.seriesTypes,
            g = a.splat,
            v = a.svg,
            Q = a.syncTimeout,
            L = a.win,
            P = a.Chart = function() { this.getArgs.apply(this, arguments) };
        a.chart = function(a, b, c) { return new P(a, b, c) };
        d(P.prototype, {
            callbacks: [],
            getArgs: function() {
                var a = [].slice.call(arguments);
                if (I(a[0]) || a[0].nodeName) this.renderTo = a.shift();
                this.init(a[0], a[1])
            },
            init: function(b, c) {
                var d, g, e = b.series,
                    k = b.plotOptions || {};
                b.series = null;
                d = t(n, b);
                for (g in d.plotOptions) d.plotOptions[g].tooltip =
                    k[g] && t(k[g].tooltip) || void 0;
                d.tooltip.userOptions = b.chart && b.chart.forExport && b.tooltip.userOptions || b.tooltip;
                d.series = b.series = e;
                this.userOptions = b;
                b = d.chart;
                g = b.events;
                this.margin = [];
                this.spacing = [];
                this.bounds = { h: {}, v: {} };
                this.labelCollectors = [];
                this.callback = c;
                this.isResizing = 0;
                this.options = d;
                this.axes = [];
                this.series = [];
                this.hasCartesianSeries = b.showAxes;
                var q = this;
                q.index = u.length;
                u.push(q);
                a.chartCount++;
                g && C(g, function(a, b) { E(q, b, a) });
                q.xAxis = [];
                q.yAxis = [];
                q.pointCount = q.colorCounter = q.symbolCounter =
                    0;
                q.firstRender()
            },
            initSeries: function(b) {
                var c = this.options.chart;
                (c = G[b.type || c.type || c.defaultSeriesType]) || a.error(17, !0);
                c = new c;
                c.init(this, b);
                return c
            },
            orderSeries: function(a) { var b = this.series; for (a = a || 0; a < b.length; a++) b[a] && (b[a].index = a, b[a].name = b[a].name || "Series " + (b[a].index + 1)) },
            isInsidePlot: function(a, b, c) {
                var d = c ? b : a;
                a = c ? a : b;
                return 0 <= d && d <= this.plotWidth && 0 <= a && a <= this.plotHeight
            },
            redraw: function(c) {
                var g = this.axes,
                    e = this.series,
                    k = this.pointer,
                    q = this.legend,
                    h = this.isDirtyLegend,
                    f, l, v = this.hasCartesianSeries,
                    A = this.isDirtyBox,
                    F, t = this.renderer,
                    x = t.isHidden(),
                    n = [];
                this.setResponsive && this.setResponsive(!1);
                a.setAnimation(c, this);
                x && this.temporaryDisplay();
                this.layOutTitles();
                for (c = e.length; c--;)
                    if (F = e[c], F.options.stacking && (f = !0, F.isDirty)) { l = !0; break }
                if (l)
                    for (c = e.length; c--;) F = e[c], F.options.stacking && (F.isDirty = !0);
                m(e, function(a) {
                    a.isDirty && "point" === a.options.legendType && (a.updateTotals && a.updateTotals(), h = !0);
                    a.isDirtyData && b(a, "updatedData")
                });
                h && q.options.enabled &&
                    (q.render(), this.isDirtyLegend = !1);
                f && this.getStacks();
                v && m(g, function(a) {
                    a.updateNames();
                    a.setScale()
                });
                this.getMargins();
                v && (m(g, function(a) { a.isDirty && (A = !0) }), m(g, function(a) {
                    var c = a.min + "," + a.max;
                    a.extKey !== c && (a.extKey = c, n.push(function() {
                        b(a, "afterSetExtremes", d(a.eventArgs, a.getExtremes()));
                        delete a.eventArgs
                    }));
                    (A || f) && a.redraw()
                }));
                A && this.drawChartBox();
                b(this, "predraw");
                m(e, function(a) {
                    (A || a.isDirty) && a.visible && a.redraw();
                    a.isDirtyData = !1
                });
                k && k.reset(!0);
                t.draw();
                b(this, "redraw");
                b(this,
                    "render");
                x && this.temporaryDisplay(!0);
                m(n, function(a) { a.call() })
            },
            get: function(a) {
                function b(b) { return b.id === a || b.options && b.options.id === a }
                var d, g = this.series,
                    e;
                d = c(this.axes, b) || c(this.series, b);
                for (e = 0; !d && e < g.length; e++) d = c(g[e].points || [], b);
                return d
            },
            getAxes: function() {
                var a = this,
                    b = this.options,
                    c = b.xAxis = g(b.xAxis || {}),
                    b = b.yAxis = g(b.yAxis || {});
                m(c, function(a, b) {
                    a.index = b;
                    a.isX = !0
                });
                m(b, function(a, b) { a.index = b });
                c = c.concat(b);
                m(c, function(b) { new l(a, b) })
            },
            getSelectedPoints: function() {
                var a = [];
                m(this.series, function(b) { a = a.concat(k(b.data || [], function(a) { return a.selected })) });
                return a
            },
            getSelectedSeries: function() { return k(this.series, function(a) { return a.selected }) },
            setTitle: function(a, b, c) {
                var d = this,
                    g = d.options,
                    e;
                e = g.title = t({ style: { color: "#333333", fontSize: g.isStock ? "16px" : "18px" } }, g.title, a);
                g = g.subtitle = t({ style: { color: "#666666" } }, g.subtitle, b);
                m([
                    ["title", a, e],
                    ["subtitle", b, g]
                ], function(a, b) {
                    var c = a[0],
                        g = d[c],
                        e = a[1];
                    a = a[2];
                    g && e && (d[c] = g = g.destroy());
                    a && !g && (d[c] = d.renderer.text(a.text,
                        0, 0, a.useHTML).attr({ align: a.align, "class": "highcharts-" + c, zIndex: a.zIndex || 4 }).add(), d[c].update = function(a) { d.setTitle(!b && a, b && a) }, d[c].css(a.style))
                });
                d.layOutTitles(c)
            },
            layOutTitles: function(a) {
                var b = 0,
                    c, g = this.renderer,
                    e = this.spacingBox;
                m(["title", "subtitle"], function(a) {
                    var c = this[a],
                        k = this.options[a];
                    a = "title" === a ? -3 : k.verticalAlign ? 0 : b + 2;
                    var q;
                    c && (q = k.style.fontSize, q = g.fontMetrics(q, c).b, c.css({ width: (k.width || e.width + k.widthAdjust) + "px" }).align(d({ y: a + q }, k), !1, "spacingBox"), k.floating ||
                        k.verticalAlign || (b = Math.ceil(b + c.getBBox(k.useHTML).height)))
                }, this);
                c = this.titleOffset !== b;
                this.titleOffset = b;
                !this.isDirtyBox && c && (this.isDirtyBox = c, this.hasRendered && q(a, !0) && this.isDirtyBox && this.redraw())
            },
            getChartSize: function() {
                var b = this.options.chart,
                    c = b.width,
                    b = b.height,
                    d = this.renderTo;
                h(c) || (this.containerWidth = a.getStyle(d, "width"));
                h(b) || (this.containerHeight = a.getStyle(d, "height"));
                this.chartWidth = Math.max(0, c || this.containerWidth || 600);
                this.chartHeight = Math.max(0, a.relativeLength(b,
                    this.chartWidth) || (1 < this.containerHeight ? this.containerHeight : 400))
            },
            temporaryDisplay: function(b) {
                var c = this.renderTo;
                if (b)
                    for (; c && c.style;) c.hcOrigStyle && (a.css(c, c.hcOrigStyle), delete c.hcOrigStyle), c.hcOrigDetached && (f.body.removeChild(c), c.hcOrigDetached = !1), c = c.parentNode;
                else
                    for (; c && c.style;) {
                        f.body.contains(c) || c.parentNode || (c.hcOrigDetached = !0, f.body.appendChild(c));
                        if ("none" === a.getStyle(c, "display", !1) || c.hcOricDetached) c.hcOrigStyle = { display: c.style.display, height: c.style.height, overflow: c.style.overflow },
                            b = { display: "block", overflow: "hidden" }, c !== this.renderTo && (b.height = 0), a.css(c, b), c.offsetWidth || c.style.setProperty("display", "block", "important");
                        c = c.parentNode;
                        if (c === f.body) break
                    }
            },
            setClassName: function(a) { this.container.className = "highcharts-container " + (a || "") },
            getContainer: function() {
                var b, c = this.options,
                    g = c.chart,
                    e, k;
                b = this.renderTo;
                var q = a.uniqueKey(),
                    h;
                b || (this.renderTo = b = g.renderTo);
                I(b) && (this.renderTo = b = f.getElementById(b));
                b || a.error(13, !0);
                e = A(p(b, "data-highcharts-chart"));
                z(e) && u[e] &&
                    u[e].hasRendered && u[e].destroy();
                p(b, "data-highcharts-chart", this.index);
                b.innerHTML = "";
                g.skipClone || b.offsetWidth || this.temporaryDisplay();
                this.getChartSize();
                e = this.chartWidth;
                k = this.chartHeight;
                h = d({ position: "relative", overflow: "hidden", width: e + "px", height: k + "px", textAlign: "left", lineHeight: "normal", zIndex: 0, "-webkit-tap-highlight-color": "rgba(0,0,0,0)" }, g.style);
                this.container = b = r("div", { id: q }, h, b);
                this._cursor = b.style.cursor;
                this.renderer = new(a[g.renderer] || a.Renderer)(b, e, k, null, g.forExport,
                    c.exporting && c.exporting.allowHTML);
                this.setClassName(g.className);
                this.renderer.setStyle(g.style);
                this.renderer.chartIndex = this.index
            },
            getMargins: function(a) {
                var b = this.spacing,
                    c = this.margin,
                    d = this.titleOffset;
                this.resetMargins();
                d && !h(c[0]) && (this.plotTop = Math.max(this.plotTop, d + this.options.title.margin + b[0]));
                this.legend && this.legend.display && this.legend.adjustMargins(c, b);
                this.extraMargin && (this[this.extraMargin.type] = (this[this.extraMargin.type] || 0) + this.extraMargin.value);
                this.adjustPlotArea &&
                    this.adjustPlotArea();
                a || this.getAxisMargins()
            },
            getAxisMargins: function() {
                var a = this,
                    b = a.axisOffset = [0, 0, 0, 0],
                    c = a.margin;
                a.hasCartesianSeries && m(a.axes, function(a) { a.visible && a.getOffset() });
                m(K, function(d, g) { h(c[g]) || (a[d] += b[g]) });
                a.setChartSize()
            },
            reflow: function(b) {
                var c = this,
                    d = c.options.chart,
                    g = c.renderTo,
                    e = h(d.width) && h(d.height),
                    k = d.width || a.getStyle(g, "width"),
                    d = d.height || a.getStyle(g, "height"),
                    g = b ? b.target : L;
                if (!e && !c.isPrinting && k && d && (g === L || g === f)) {
                    if (k !== c.containerWidth || d !== c.containerHeight) clearTimeout(c.reflowTimeout),
                        c.reflowTimeout = Q(function() { c.container && c.setSize(void 0, void 0, !1) }, b ? 100 : 0);
                    c.containerWidth = k;
                    c.containerHeight = d
                }
            },
            initReflow: function() {
                var a = this,
                    b;
                b = E(L, "resize", function(b) { a.reflow(b) });
                E(a, "destroy", b)
            },
            setSize: function(c, d, g) {
                var k = this,
                    q = k.renderer;
                k.isResizing += 1;
                a.setAnimation(g, k);
                k.oldChartHeight = k.chartHeight;
                k.oldChartWidth = k.chartWidth;
                void 0 !== c && (k.options.chart.width = c);
                void 0 !== d && (k.options.chart.height = d);
                k.getChartSize();
                c = q.globalAnimation;
                (c ? D : e)(k.container, {
                    width: k.chartWidth +
                        "px",
                    height: k.chartHeight + "px"
                }, c);
                k.setChartSize(!0);
                q.setSize(k.chartWidth, k.chartHeight, g);
                m(k.axes, function(a) {
                    a.isDirty = !0;
                    a.setScale()
                });
                k.isDirtyLegend = !0;
                k.isDirtyBox = !0;
                k.layOutTitles();
                k.getMargins();
                k.redraw(g);
                k.oldChartHeight = null;
                b(k, "resize");
                Q(function() { k && b(k, "endResize", null, function() {--k.isResizing }) }, H(c).duration)
            },
            setChartSize: function(a) {
                var b = this.inverted,
                    c = this.renderer,
                    d = this.chartWidth,
                    g = this.chartHeight,
                    e = this.options.chart,
                    k = this.spacing,
                    q = this.clipOffset,
                    h, f, l, v;
                this.plotLeft =
                    h = Math.round(this.plotLeft);
                this.plotTop = f = Math.round(this.plotTop);
                this.plotWidth = l = Math.max(0, Math.round(d - h - this.marginRight));
                this.plotHeight = v = Math.max(0, Math.round(g - f - this.marginBottom));
                this.plotSizeX = b ? v : l;
                this.plotSizeY = b ? l : v;
                this.plotBorderWidth = e.plotBorderWidth || 0;
                this.spacingBox = c.spacingBox = { x: k[3], y: k[0], width: d - k[3] - k[1], height: g - k[0] - k[2] };
                this.plotBox = c.plotBox = { x: h, y: f, width: l, height: v };
                d = 2 * Math.floor(this.plotBorderWidth / 2);
                b = Math.ceil(Math.max(d, q[3]) / 2);
                c = Math.ceil(Math.max(d,
                    q[0]) / 2);
                this.clipBox = { x: b, y: c, width: Math.floor(this.plotSizeX - Math.max(d, q[1]) / 2 - b), height: Math.max(0, Math.floor(this.plotSizeY - Math.max(d, q[2]) / 2 - c)) };
                a || m(this.axes, function(a) {
                    a.setAxisSize();
                    a.setAxisTranslation()
                })
            },
            resetMargins: function() {
                var a = this,
                    b = a.options.chart;
                m(["margin", "spacing"], function(c) {
                    var d = b[c],
                        g = B(d) ? d : [d, d, d, d];
                    m(["Top", "Right", "Bottom", "Left"], function(d, e) { a[c][e] = q(b[c + d], g[e]) })
                });
                m(K, function(b, c) { a[b] = q(a.margin[c], a.spacing[c]) });
                a.axisOffset = [0, 0, 0, 0];
                a.clipOffset = [0, 0, 0, 0]
            },
            drawChartBox: function() {
                var a = this.options.chart,
                    b = this.renderer,
                    c = this.chartWidth,
                    d = this.chartHeight,
                    g = this.chartBackground,
                    e = this.plotBackground,
                    k = this.plotBorder,
                    q, h = this.plotBGImage,
                    f = a.backgroundColor,
                    m = a.plotBackgroundColor,
                    l = a.plotBackgroundImage,
                    v, A = this.plotLeft,
                    F = this.plotTop,
                    t = this.plotWidth,
                    x = this.plotHeight,
                    n = this.plotBox,
                    p = this.clipRect,
                    z = this.clipBox,
                    G = "animate";
                g || (this.chartBackground = g = b.rect().addClass("highcharts-background").add(), G = "attr");
                q = a.borderWidth || 0;
                v = q + (a.shadow ?
                    8 : 0);
                f = { fill: f || "none" };
                if (q || g["stroke-width"]) f.stroke = a.borderColor, f["stroke-width"] = q;
                g.attr(f).shadow(a.shadow);
                g[G]({ x: v / 2, y: v / 2, width: c - v - q % 2, height: d - v - q % 2, r: a.borderRadius });
                G = "animate";
                e || (G = "attr", this.plotBackground = e = b.rect().addClass("highcharts-plot-background").add());
                e[G](n);
                e.attr({ fill: m || "none" }).shadow(a.plotShadow);
                l && (h ? h.animate(n) : this.plotBGImage = b.image(l, A, F, t, x).add());
                p ? p.animate({ width: z.width, height: z.height }) : this.clipRect = b.clipRect(z);
                G = "animate";
                k || (G = "attr", this.plotBorder =
                    k = b.rect().addClass("highcharts-plot-border").attr({ zIndex: 1 }).add());
                k.attr({ stroke: a.plotBorderColor, "stroke-width": a.plotBorderWidth || 0, fill: "none" });
                k[G](k.crisp({ x: A, y: F, width: t, height: x }, -k.strokeWidth()));
                this.isDirtyBox = !1
            },
            propFromSeries: function() {
                var a = this,
                    b = a.options.chart,
                    c, d = a.options.series,
                    g, e;
                m(["inverted", "angular", "polar"], function(k) {
                    c = G[b.type || b.defaultSeriesType];
                    e = b[k] || c && c.prototype[k];
                    for (g = d && d.length; !e && g--;)(c = G[d[g].type]) && c.prototype[k] && (e = !0);
                    a[k] = e
                })
            },
            linkSeries: function() {
                var a =
                    this,
                    b = a.series;
                m(b, function(a) { a.linkedSeries.length = 0 });
                m(b, function(b) {
                    var c = b.options.linkedTo;
                    I(c) && (c = ":previous" === c ? a.series[b.index - 1] : a.get(c)) && c.linkedParent !== b && (c.linkedSeries.push(b), b.linkedParent = c, b.visible = q(b.options.visible, c.options.visible, b.visible))
                })
            },
            renderSeries: function() {
                m(this.series, function(a) {
                    a.translate();
                    a.render()
                })
            },
            renderLabels: function() {
                var a = this,
                    b = a.options.labels;
                b.items && m(b.items, function(c) {
                    var g = d(b.style, c.style),
                        e = A(g.left) + a.plotLeft,
                        k = A(g.top) +
                        a.plotTop + 12;
                    delete g.left;
                    delete g.top;
                    a.renderer.text(c.html, e, k).attr({ zIndex: 2 }).css(g).add()
                })
            },
            render: function() {
                var a = this.axes,
                    b = this.renderer,
                    c = this.options,
                    d, g, e;
                this.setTitle();
                this.legend = new x(this, c.legend);
                this.getStacks && this.getStacks();
                this.getMargins(!0);
                this.setChartSize();
                c = this.plotWidth;
                d = this.plotHeight = Math.max(this.plotHeight - 21, 0);
                m(a, function(a) { a.setScale() });
                this.getAxisMargins();
                g = 1.1 < c / this.plotWidth;
                e = 1.05 < d / this.plotHeight;
                if (g || e) m(a, function(a) {
                    (a.horiz && g || !a.horiz &&
                        e) && a.setTickInterval(!0)
                }), this.getMargins();
                this.drawChartBox();
                this.hasCartesianSeries && m(a, function(a) { a.visible && a.render() });
                this.seriesGroup || (this.seriesGroup = b.g("series-group").attr({ zIndex: 3 }).add());
                this.renderSeries();
                this.renderLabels();
                this.addCredits();
                this.setResponsive && this.setResponsive();
                this.hasRendered = !0
            },
            addCredits: function(a) {
                var b = this;
                a = t(!0, this.options.credits, a);
                a.enabled && !this.credits && (this.credits = this.renderer.text(a.text + (this.mapCredits || ""), 0, 0).addClass("highcharts-credits").on("click",
                    function() { a.href && (L.location.href = a.href) }).attr({ align: a.position.align, zIndex: 8 }).css(a.style).add().align(a.position), this.credits.update = function(a) {
                    b.credits = b.credits.destroy();
                    b.addCredits(a)
                })
            },
            destroy: function() {
                var c = this,
                    d = c.axes,
                    g = c.series,
                    e = c.container,
                    k, q = e && e.parentNode;
                b(c, "destroy");
                c.renderer.forExport ? a.erase(u, c) : u[c.index] = void 0;
                a.chartCount--;
                c.renderTo.removeAttribute("data-highcharts-chart");
                F(c);
                for (k = d.length; k--;) d[k] = d[k].destroy();
                this.scroller && this.scroller.destroy &&
                    this.scroller.destroy();
                for (k = g.length; k--;) g[k] = g[k].destroy();
                m("title subtitle chartBackground plotBackground plotBGImage plotBorder seriesGroup clipRect credits pointer rangeSelector legend resetZoomButton tooltip renderer".split(" "), function(a) {
                    var b = c[a];
                    b && b.destroy && (c[a] = b.destroy())
                });
                e && (e.innerHTML = "", F(e), q && w(e));
                C(c, function(a, b) { delete c[b] })
            },
            isReadyToRender: function() {
                var a = this;
                return v || L != L.top || "complete" === f.readyState ? !0 : (f.attachEvent("onreadystatechange", function() {
                    f.detachEvent("onreadystatechange",
                        a.firstRender);
                    "complete" === f.readyState && a.firstRender()
                }), !1)
            },
            firstRender: function() {
                var a = this,
                    c = a.options;
                if (a.isReadyToRender()) {
                    a.getContainer();
                    b(a, "init");
                    a.resetMargins();
                    a.setChartSize();
                    a.propFromSeries();
                    a.getAxes();
                    m(c.series || [], function(b) { a.initSeries(b) });
                    a.linkSeries();
                    b(a, "beforeRender");
                    N && (a.pointer = new N(a, c));
                    a.render();
                    if (!a.renderer.imgCount && a.onload) a.onload();
                    a.temporaryDisplay(!0)
                }
            },
            onload: function() {
                m([this.callback].concat(this.callbacks), function(a) {
                    a && void 0 !== this.index &&
                        a.apply(this, [this])
                }, this);
                b(this, "load");
                b(this, "render");
                h(this.index) && !1 !== this.options.chart.reflow && this.initReflow();
                this.onload = null
            }
        })
    })(M);
    (function(a) {
        var E, D = a.each,
            H = a.extend,
            p = a.erase,
            f = a.fireEvent,
            l = a.format,
            r = a.isArray,
            n = a.isNumber,
            w = a.pick,
            u = a.removeEvent;
        a.Point = E = function() {};
        a.Point.prototype = {
            init: function(a, h, f) {
                this.series = a;
                this.color = a.color;
                this.applyOptions(h, f);
                a.options.colorByPoint ? (h = a.options.colors || a.chart.options.colors, this.color = this.color || h[a.colorCounter],
                    h = h.length, f = a.colorCounter, a.colorCounter++, a.colorCounter === h && (a.colorCounter = 0)) : f = a.colorIndex;
                this.colorIndex = w(this.colorIndex, f);
                a.chart.pointCount++;
                return this
            },
            applyOptions: function(a, h) {
                var e = this.series,
                    d = e.options.pointValKey || e.pointValKey;
                a = E.prototype.optionsToObject.call(this, a);
                H(this, a);
                this.options = this.options ? H(this.options, a) : a;
                a.group && delete this.group;
                d && (this.y = this[d]);
                this.isNull = w(this.isValid && !this.isValid(), null === this.x || !n(this.y, !0));
                this.selected && (this.state =
                    "select");
                "name" in this && void 0 === h && e.xAxis && e.xAxis.hasNames && (this.x = e.xAxis.nameToX(this));
                void 0 === this.x && e && (this.x = void 0 === h ? e.autoIncrement(this) : h);
                return this
            },
            optionsToObject: function(a) {
                var e = {},
                    f = this.series,
                    d = f.options.keys,
                    c = d || f.pointArrayMap || ["y"],
                    b = c.length,
                    k = 0,
                    l = 0;
                if (n(a) || null === a) e[c[0]] = a;
                else if (r(a))
                    for (!d && a.length > b && (f = typeof a[0], "string" === f ? e.name = a[0] : "number" === f && (e.x = a[0]), k++); l < b;) d && void 0 === a[k] || (e[c[l]] = a[k]), k++, l++;
                else "object" === typeof a && (e = a, a.dataLabels &&
                    (f._hasPointLabels = !0), a.marker && (f._hasPointMarkers = !0));
                return e
            },
            getClassName: function() { return "highcharts-point" + (this.selected ? " highcharts-point-select" : "") + (this.negative ? " highcharts-negative" : "") + (this.isNull ? " highcharts-null-point" : "") + (void 0 !== this.colorIndex ? " highcharts-color-" + this.colorIndex : "") + (this.options.className ? " " + this.options.className : "") + (this.zone && this.zone.className ? " " + this.zone.className.replace("highcharts-negative", "") : "") },
            getZone: function() {
                var a = this.series,
                    h = a.zones,
                    a = a.zoneAxis || "y",
                    f = 0,
                    d;
                for (d = h[f]; this[a] >= d.value;) d = h[++f];
                d && d.color && !this.options.color && (this.color = d.color);
                return d
            },
            destroy: function() {
                var a = this.series.chart,
                    h = a.hoverPoints,
                    f;
                a.pointCount--;
                h && (this.setState(), p(h, this), h.length || (a.hoverPoints = null));
                if (this === a.hoverPoint) this.onMouseOut();
                if (this.graphic || this.dataLabel) u(this), this.destroyElements();
                this.legendItem && a.legend.destroyItem(this);
                for (f in this) this[f] = null
            },
            destroyElements: function() {
                for (var a = ["graphic", "dataLabel",
                        "dataLabelUpper", "connector", "shadowGroup"
                    ], h, f = 6; f--;) h = a[f], this[h] && (this[h] = this[h].destroy())
            },
            getLabelConfig: function() { return { x: this.category, y: this.y, color: this.color, colorIndex: this.colorIndex, key: this.name || this.category, series: this.series, point: this, percentage: this.percentage, total: this.total || this.stackTotal } },
            tooltipFormatter: function(a) {
                var e = this.series,
                    f = e.tooltipOptions,
                    d = w(f.valueDecimals, ""),
                    c = f.valuePrefix || "",
                    b = f.valueSuffix || "";
                D(e.pointArrayMap || ["y"], function(e) {
                    e = "{point." +
                        e;
                    if (c || b) a = a.replace(e + "}", c + e + "}" + b);
                    a = a.replace(e + "}", e + ":,." + d + "f}")
                });
                return l(a, { point: this, series: this.series })
            },
            firePointEvent: function(a, h, m) {
                var d = this,
                    c = this.series.options;
                (c.point.events[a] || d.options && d.options.events && d.options.events[a]) && this.importEvents();
                "click" === a && c.allowPointSelect && (m = function(a) { d.select && d.select(null, a.ctrlKey || a.metaKey || a.shiftKey) });
                f(this, a, h, m)
            },
            visible: !0
        }
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.animObject,
            H = a.arrayMax,
            p = a.arrayMin,
            f = a.correctFloat,
            l = a.Date,
            r = a.defaultOptions,
            n = a.defaultPlotOptions,
            w = a.defined,
            u = a.each,
            e = a.erase,
            h = a.extend,
            m = a.fireEvent,
            d = a.grep,
            c = a.isArray,
            b = a.isNumber,
            k = a.isString,
            z = a.merge,
            B = a.objectEach,
            I = a.pick,
            x = a.removeEvent,
            K = a.splat,
            t = a.SVGElement,
            C = a.syncTimeout,
            N = a.win;
        a.Series = a.seriesType("line", null, {
            lineWidth: 2,
            allowPointSelect: !1,
            showCheckbox: !1,
            animation: { duration: 1E3 },
            events: {},
            marker: {
                lineWidth: 0,
                lineColor: "#ffffff",
                radius: 4,
                states: {
                    hover: { animation: { duration: 50 }, enabled: !0, radiusPlus: 2, lineWidthPlus: 1 },
                    select: {
                        fillColor: "#cccccc",
                        lineColor: "#000000",
                        lineWidth: 2
                    }
                }
            },
            point: { events: {} },
            dataLabels: { align: "center", formatter: function() { return null === this.y ? "" : a.numberFormat(this.y, -1) }, style: { fontSize: "11px", fontWeight: "bold", color: "contrast", textOutline: "1px contrast" }, verticalAlign: "bottom", x: 0, y: 0, padding: 5 },
            cropThreshold: 300,
            pointRange: 0,
            softThreshold: !0,
            states: { hover: { animation: { duration: 50 }, lineWidthPlus: 1, marker: {}, halo: { size: 10, opacity: .25 } }, select: { marker: {} } },
            stickyTracking: !0,
            turboThreshold: 1E3,
            findNearestPointBy: "x"
        }, {
            isCartesian: !0,
            pointClass: a.Point,
            sorted: !0,
            requireSorting: !0,
            directTouch: !1,
            axisTypes: ["xAxis", "yAxis"],
            colorCounter: 0,
            parallelArrays: ["x", "y"],
            coll: "series",
            init: function(a, b) {
                var c = this,
                    d, g = a.series,
                    e;
                c.chart = a;
                c.options = b = c.setOptions(b);
                c.linkedSeries = [];
                c.bindAxes();
                h(c, { name: b.name, state: "", visible: !1 !== b.visible, selected: !0 === b.selected });
                d = b.events;
                B(d, function(a, b) { E(c, b, a) });
                if (d && d.click || b.point && b.point.events && b.point.events.click || b.allowPointSelect) a.runTrackerClick = !0;
                c.getColor();
                c.getSymbol();
                u(c.parallelArrays, function(a) { c[a + "Data"] = [] });
                c.setData(b.data, !1);
                c.isCartesian && (a.hasCartesianSeries = !0);
                g.length && (e = g[g.length - 1]);
                c._i = I(e && e._i, -1) + 1;
                a.orderSeries(this.insert(g))
            },
            insert: function(a) {
                var c = this.options.index,
                    d;
                if (b(c)) {
                    for (d = a.length; d--;)
                        if (c >= I(a[d].options.index, a[d]._i)) { a.splice(d + 1, 0, this); break } - 1 === d && a.unshift(this);
                    d += 1
                } else a.push(this);
                return I(d, a.length - 1)
            },
            bindAxes: function() {
                var b = this,
                    c = b.options,
                    d = b.chart,
                    e;
                u(b.axisTypes || [], function(g) {
                    u(d[g],
                        function(a) { e = a.options; if (c[g] === e.index || void 0 !== c[g] && c[g] === e.id || void 0 === c[g] && 0 === e.index) b.insert(a.series), b[g] = a, a.isDirty = !0 });
                    b[g] || b.optionalAxis === g || a.error(18, !0)
                })
            },
            updateParallelArrays: function(a, c) {
                var d = a.series,
                    e = arguments,
                    g = b(c) ? function(b) {
                        var g = "y" === b && d.toYData ? d.toYData(a) : a[b];
                        d[b + "Data"][c] = g
                    } : function(a) { Array.prototype[c].apply(d[a + "Data"], Array.prototype.slice.call(e, 2)) };
                u(d.parallelArrays, g)
            },
            autoIncrement: function() {
                var b = this.options,
                    c = this.xIncrement,
                    d, e = b.pointIntervalUnit,
                    g = 0,
                    c = I(c, b.pointStart, 0);
                this.pointInterval = d = I(this.pointInterval, b.pointInterval, 1);
                e && (b = new l(c), "day" === e ? b = +b[l.hcSetDate](b[l.hcGetDate]() + d) : "month" === e ? b = +b[l.hcSetMonth](b[l.hcGetMonth]() + d) : "year" === e && (b = +b[l.hcSetFullYear](b[l.hcGetFullYear]() + d)), l.hcHasTimeZone && (g = a.getTZOffset(b) - a.getTZOffset(c)), d = b - c + g);
                this.xIncrement = c + d;
                return c
            },
            setOptions: function(a) {
                var b = this.chart,
                    c = b.options,
                    d = c.plotOptions,
                    g = (b.userOptions || {}).plotOptions || {},
                    e = d[this.type];
                this.userOptions = a;
                b = z(e,
                    d.series, a);
                this.tooltipOptions = z(r.tooltip, r.plotOptions.series && r.plotOptions.series.tooltip, r.plotOptions[this.type].tooltip, c.tooltip.userOptions, d.series && d.series.tooltip, d[this.type].tooltip, a.tooltip);
                this.stickyTracking = I(a.stickyTracking, g[this.type] && g[this.type].stickyTracking, g.series && g.series.stickyTracking, this.tooltipOptions.shared && !this.noSharedTooltip ? !0 : b.stickyTracking);
                null === e.marker && delete b.marker;
                this.zoneAxis = b.zoneAxis;
                a = this.zones = (b.zones || []).slice();
                !b.negativeColor &&
                    !b.negativeFillColor || b.zones || a.push({ value: b[this.zoneAxis + "Threshold"] || b.threshold || 0, className: "highcharts-negative", color: b.negativeColor, fillColor: b.negativeFillColor });
                a.length && w(a[a.length - 1].value) && a.push({ color: this.color, fillColor: this.fillColor });
                return b
            },
            getCyclic: function(a, b, c) {
                var d, g = this.chart,
                    e = this.userOptions,
                    k = a + "Index",
                    h = a + "Counter",
                    q = c ? c.length : I(g.options.chart[a + "Count"], g[a + "Count"]);
                b || (d = I(e[k], e["_" + k]), w(d) || (g.series.length || (g[h] = 0), e["_" + k] = d = g[h] % q, g[h] += 1),
                    c && (b = c[d]));
                void 0 !== d && (this[k] = d);
                this[a] = b
            },
            getColor: function() { this.options.colorByPoint ? this.options.color = null : this.getCyclic("color", this.options.color || n[this.type].color, this.chart.options.colors) },
            getSymbol: function() { this.getCyclic("symbol", this.options.marker.symbol, this.chart.options.symbols) },
            drawLegendSymbol: a.LegendSymbolMixin.drawLineMarker,
            setData: function(d, e, h, f) {
                var g = this,
                    q = g.points,
                    m = q && q.length || 0,
                    l, A = g.options,
                    t = g.chart,
                    x = null,
                    n = g.xAxis,
                    p = A.turboThreshold,
                    z = this.xData,
                    F =
                    this.yData,
                    C = (l = g.pointArrayMap) && l.length;
                d = d || [];
                l = d.length;
                e = I(e, !0);
                if (!1 !== f && l && m === l && !g.cropped && !g.hasGroupedData && g.visible) u(d, function(a, b) { q[b].update && a !== A.data[b] && q[b].update(a, !1, null, !1) });
                else {
                    g.xIncrement = null;
                    g.colorCounter = 0;
                    u(this.parallelArrays, function(a) { g[a + "Data"].length = 0 });
                    if (p && l > p) {
                        for (h = 0; null === x && h < l;) x = d[h], h++;
                        if (b(x))
                            for (h = 0; h < l; h++) z[h] = this.autoIncrement(), F[h] = d[h];
                        else if (c(x))
                            if (C)
                                for (h = 0; h < l; h++) x = d[h], z[h] = x[0], F[h] = x.slice(1, C + 1);
                            else
                                for (h = 0; h < l; h++) x =
                                    d[h], z[h] = x[0], F[h] = x[1];
                        else a.error(12)
                    } else
                        for (h = 0; h < l; h++) void 0 !== d[h] && (x = { series: g }, g.pointClass.prototype.applyOptions.apply(x, [d[h]]), g.updateParallelArrays(x, h));
                    F && k(F[0]) && a.error(14, !0);
                    g.data = [];
                    g.options.data = g.userOptions.data = d;
                    for (h = m; h--;) q[h] && q[h].destroy && q[h].destroy();
                    n && (n.minRange = n.userMinRange);
                    g.isDirty = t.isDirtyBox = !0;
                    g.isDirtyData = !!q;
                    h = !1
                }
                "point" === A.legendType && (this.processData(), this.generatePoints());
                e && t.redraw(h)
            },
            processData: function(b) {
                var c = this.xData,
                    d = this.yData,
                    e = c.length,
                    g;
                g = 0;
                var k, h, q = this.xAxis,
                    f, m = this.options;
                f = m.cropThreshold;
                var l = this.getExtremesFromAll || m.getExtremesFromAll,
                    t = this.isCartesian,
                    m = q && q.val2lin,
                    x = q && q.isLog,
                    n = this.requireSorting,
                    p, z;
                if (t && !this.isDirty && !q.isDirty && !this.yAxis.isDirty && !b) return !1;
                q && (b = q.getExtremes(), p = b.min, z = b.max);
                if (t && this.sorted && !l && (!f || e > f || this.forceCrop))
                    if (c[e - 1] < p || c[0] > z) c = [], d = [];
                    else if (c[0] < p || c[e - 1] > z) g = this.cropData(this.xData, this.yData, p, z), c = g.xData, d = g.yData, g = g.start, k = !0;
                for (f = c.length ||
                    1; --f;) e = x ? m(c[f]) - m(c[f - 1]) : c[f] - c[f - 1], 0 < e && (void 0 === h || e < h) ? h = e : 0 > e && n && (a.error(15), n = !1);
                this.cropped = k;
                this.cropStart = g;
                this.processedXData = c;
                this.processedYData = d;
                this.closestPointRange = h
            },
            cropData: function(a, b, c, d) {
                var g = a.length,
                    e = 0,
                    k = g,
                    h = I(this.cropShoulder, 1),
                    f;
                for (f = 0; f < g; f++)
                    if (a[f] >= c) { e = Math.max(0, f - h); break }
                for (c = f; c < g; c++)
                    if (a[c] > d) { k = c + h; break }
                return { xData: a.slice(e, k), yData: b.slice(e, k), start: e, end: k }
            },
            generatePoints: function() {
                var a = this.options,
                    b = a.data,
                    c = this.data,
                    d, g = this.processedXData,
                    e = this.processedYData,
                    k = this.pointClass,
                    h = g.length,
                    f = this.cropStart || 0,
                    m, l = this.hasGroupedData,
                    a = a.keys,
                    t, x = [],
                    n;
                c || l || (c = [], c.length = b.length, c = this.data = c);
                a && l && (this.options.keys = !1);
                for (n = 0; n < h; n++) m = f + n, l ? (t = (new k).init(this, [g[n]].concat(K(e[n]))), t.dataGroup = this.groupMap[n]) : (t = c[m]) || void 0 === b[m] || (c[m] = t = (new k).init(this, b[m], g[n])), t && (t.index = m, x[n] = t);
                this.options.keys = a;
                if (c && (h !== (d = c.length) || l))
                    for (n = 0; n < d; n++) n !== f || l || (n += h), c[n] && (c[n].destroyElements(), c[n].plotX = void 0);
                this.data = c;
                this.points = x
            },
            getExtremes: function(a) {
                var d = this.yAxis,
                    e = this.processedXData,
                    k, g = [],
                    h = 0;
                k = this.xAxis.getExtremes();
                var f = k.min,
                    q = k.max,
                    m, l, t, n;
                a = a || this.stackedYData || this.processedYData || [];
                k = a.length;
                for (n = 0; n < k; n++)
                    if (l = e[n], t = a[n], m = (b(t, !0) || c(t)) && (!d.positiveValuesOnly || t.length || 0 < t), l = this.getExtremesFromAll || this.options.getExtremesFromAll || this.cropped || (e[n + 1] || l) >= f && (e[n - 1] || l) <= q, m && l)
                        if (m = t.length)
                            for (; m--;) "number" === typeof t[m] && (g[h++] = t[m]);
                        else g[h++] = t;
                this.dataMin =
                    p(g);
                this.dataMax = H(g)
            },
            translate: function() {
                this.processedXData || this.processData();
                this.generatePoints();
                var a = this.options,
                    c = a.stacking,
                    d = this.xAxis,
                    e = d.categories,
                    g = this.yAxis,
                    k = this.points,
                    h = k.length,
                    m = !!this.modifyValue,
                    l = a.pointPlacement,
                    t = "between" === l || b(l),
                    n = a.threshold,
                    x = a.startFromThreshold ? n : 0,
                    p, z, C, r, u = Number.MAX_VALUE;
                "between" === l && (l = .5);
                b(l) && (l *= I(a.pointRange || d.pointRange));
                for (a = 0; a < h; a++) {
                    var B = k[a],
                        N = B.x,
                        K = B.y;
                    z = B.low;
                    var D = c && g.stacks[(this.negStacks && K < (x ? 0 : n) ? "-" : "") + this.stackKey],
                        E;
                    g.positiveValuesOnly && null !== K && 0 >= K && (B.isNull = !0);
                    B.plotX = p = f(Math.min(Math.max(-1E5, d.translate(N, 0, 0, 0, 1, l, "flags" === this.type)), 1E5));
                    c && this.visible && !B.isNull && D && D[N] && (r = this.getStackIndicator(r, N, this.index), E = D[N], K = E.points[r.key], z = K[0], K = K[1], z === x && r.key === D[N].base && (z = I(n, g.min)), g.positiveValuesOnly && 0 >= z && (z = null), B.total = B.stackTotal = E.total, B.percentage = E.total && B.y / E.total * 100, B.stackY = K, E.setOffset(this.pointXOffset || 0, this.barW || 0));
                    B.yBottom = w(z) ? g.translate(z, 0, 1, 0, 1) :
                        null;
                    m && (K = this.modifyValue(K, B));
                    B.plotY = z = "number" === typeof K && Infinity !== K ? Math.min(Math.max(-1E5, g.translate(K, 0, 1, 0, 1)), 1E5) : void 0;
                    B.isInside = void 0 !== z && 0 <= z && z <= g.len && 0 <= p && p <= d.len;
                    B.clientX = t ? f(d.translate(N, 0, 0, 0, 1, l)) : p;
                    B.negative = B.y < (n || 0);
                    B.category = e && void 0 !== e[B.x] ? e[B.x] : B.x;
                    B.isNull || (void 0 !== C && (u = Math.min(u, Math.abs(p - C))), C = p);
                    B.zone = this.zones.length && B.getZone()
                }
                this.closestPointRangePx = u
            },
            getValidPoints: function(a, b) {
                var c = this.chart;
                return d(a || this.points || [], function(a) {
                    return b &&
                        !c.isInsidePlot(a.plotX, a.plotY, c.inverted) ? !1 : !a.isNull
                })
            },
            setClip: function(a) {
                var b = this.chart,
                    c = this.options,
                    d = b.renderer,
                    g = b.inverted,
                    e = this.clipBox,
                    k = e || b.clipBox,
                    h = this.sharedClipKey || ["_sharedClip", a && a.duration, a && a.easing, k.height, c.xAxis, c.yAxis].join(),
                    f = b[h],
                    q = b[h + "m"];
                f || (a && (k.width = 0, g && (k.x = b.plotSizeX), b[h + "m"] = q = d.clipRect(g ? b.plotSizeX + 99 : -99, g ? -b.plotLeft : -b.plotTop, 99, g ? b.chartWidth : b.chartHeight)), b[h] = f = d.clipRect(k), f.count = { length: 0 });
                a && !f.count[this.index] && (f.count[this.index] = !0, f.count.length += 1);
                !1 !== c.clip && (this.group.clip(a || e ? f : b.clipRect), this.markerGroup.clip(q), this.sharedClipKey = h);
                a || (f.count[this.index] && (delete f.count[this.index], --f.count.length), 0 === f.count.length && h && b[h] && (e || (b[h] = b[h].destroy()), b[h + "m"] && (b[h + "m"] = b[h + "m"].destroy())))
            },
            animate: function(a) {
                var b = this.chart,
                    c = D(this.options.animation),
                    d;
                a ? this.setClip(c) : (d = this.sharedClipKey, (a = b[d]) && a.animate({ width: b.plotSizeX, x: 0 }, c), b[d + "m"] && b[d + "m"].animate({ width: b.plotSizeX + 99, x: 0 }, c), this.animate =
                    null)
            },
            afterAnimate: function() {
                this.setClip();
                m(this, "afterAnimate");
                this.finishedAnimating = !0
            },
            drawPoints: function() {
                var a = this.points,
                    b = this.chart,
                    c, d, g, e, k = this.options.marker,
                    h, f, l, m = this[this.specialGroup] || this.markerGroup,
                    t, n = I(k.enabled, this.xAxis.isRadial ? !0 : null, this.closestPointRangePx >= 2 * k.radius);
                if (!1 !== k.enabled || this._hasPointMarkers)
                    for (c = 0; c < a.length; c++) d = a[c], e = d.graphic, h = d.marker || {}, f = !!d.marker, g = n && void 0 === h.enabled || h.enabled, l = d.isInside, g && !d.isNull ? (g = I(h.symbol, this.symbol),
                        d.hasImage = 0 === g.indexOf("url"), t = this.markerAttribs(d, d.selected && "select"), e ? e[l ? "show" : "hide"](!0).animate(t) : l && (0 < t.width || d.hasImage) && (d.graphic = e = b.renderer.symbol(g, t.x, t.y, t.width, t.height, f ? h : k).add(m)), e && e.attr(this.pointAttribs(d, d.selected && "select")), e && e.addClass(d.getClassName(), !0)) : e && (d.graphic = e.destroy())
            },
            markerAttribs: function(a, b) {
                var c = this.options.marker,
                    d = a.marker || {},
                    g = I(d.radius, c.radius);
                b && (c = c.states[b], b = d.states && d.states[b], g = I(b && b.radius, c && c.radius, g + (c && c.radiusPlus ||
                    0)));
                a.hasImage && (g = 0);
                a = { x: Math.floor(a.plotX) - g, y: a.plotY - g };
                g && (a.width = a.height = 2 * g);
                return a
            },
            pointAttribs: function(a, b) {
                var c = this.options.marker,
                    d = a && a.options,
                    g = d && d.marker || {},
                    e = this.color,
                    k = d && d.color,
                    h = a && a.color,
                    d = I(g.lineWidth, c.lineWidth);
                a = a && a.zone && a.zone.color;
                e = k || a || h || e;
                a = g.fillColor || c.fillColor || e;
                e = g.lineColor || c.lineColor || e;
                b && (c = c.states[b], b = g.states && g.states[b] || {}, d = I(b.lineWidth, c.lineWidth, d + I(b.lineWidthPlus, c.lineWidthPlus, 0)), a = b.fillColor || c.fillColor || a, e = b.lineColor ||
                    c.lineColor || e);
                return { stroke: e, "stroke-width": d, fill: a }
            },
            destroy: function() {
                var a = this,
                    b = a.chart,
                    c = /AppleWebKit\/533/.test(N.navigator.userAgent),
                    d, g, k = a.data || [],
                    h, f;
                m(a, "destroy");
                x(a);
                u(a.axisTypes || [], function(b) {
                    (f = a[b]) && f.series && (e(f.series, a), f.isDirty = f.forceRedraw = !0)
                });
                a.legendItem && a.chart.legend.destroyItem(a);
                for (g = k.length; g--;)(h = k[g]) && h.destroy && h.destroy();
                a.points = null;
                clearTimeout(a.animationTimeout);
                B(a, function(a, b) {
                    a instanceof t && !a.survive && (d = c && "group" === b ? "hide" : "destroy",
                        a[d]())
                });
                b.hoverSeries === a && (b.hoverSeries = null);
                e(b.series, a);
                b.orderSeries();
                B(a, function(b, c) { delete a[c] })
            },
            getGraphPath: function(a, b, c) {
                var d = this,
                    g = d.options,
                    e = g.step,
                    k, h = [],
                    f = [],
                    l;
                a = a || d.points;
                (k = a.reversed) && a.reverse();
                (e = { right: 1, center: 2 }[e] || e && 3) && k && (e = 4 - e);
                !g.connectNulls || b || c || (a = this.getValidPoints(a));
                u(a, function(k, m) {
                    var q = k.plotX,
                        t = k.plotY,
                        n = a[m - 1];
                    (k.leftCliff || n && n.rightCliff) && !c && (l = !0);
                    k.isNull && !w(b) && 0 < m ? l = !g.connectNulls : k.isNull && !b ? l = !0 : (0 === m || l ? m = ["M", k.plotX, k.plotY] :
                        d.getPointSpline ? m = d.getPointSpline(a, k, m) : e ? (m = 1 === e ? ["L", n.plotX, t] : 2 === e ? ["L", (n.plotX + q) / 2, n.plotY, "L", (n.plotX + q) / 2, t] : ["L", q, n.plotY], m.push("L", q, t)) : m = ["L", q, t], f.push(k.x), e && f.push(k.x), h.push.apply(h, m), l = !1)
                });
                h.xMap = f;
                return d.graphPath = h
            },
            drawGraph: function() {
                var a = this,
                    b = this.options,
                    c = (this.gappedPath || this.getGraphPath).call(this),
                    d = [
                        ["graph", "highcharts-graph", b.lineColor || this.color, b.dashStyle]
                    ];
                u(this.zones, function(c, e) {
                    d.push(["zone-graph-" + e, "highcharts-graph highcharts-zone-graph-" +
                        e + " " + (c.className || ""), c.color || a.color, c.dashStyle || b.dashStyle
                    ])
                });
                u(d, function(d, e) {
                    var g = d[0],
                        k = a[g];
                    k ? (k.endX = a.preventGraphAnimation ? null : c.xMap, k.animate({ d: c })) : c.length && (a[g] = a.chart.renderer.path(c).addClass(d[1]).attr({ zIndex: 1 }).add(a.group), k = { stroke: d[2], "stroke-width": b.lineWidth, fill: a.fillGraph && a.color || "none" }, d[3] ? k.dashstyle = d[3] : "square" !== b.linecap && (k["stroke-linecap"] = k["stroke-linejoin"] = "round"), k = a[g].attr(k).shadow(2 > e && b.shadow));
                    k && (k.startX = c.xMap, k.isArea = c.isArea)
                })
            },
            applyZones: function() {
                var a = this,
                    b = this.chart,
                    c = b.renderer,
                    d = this.zones,
                    e, k, h = this.clips || [],
                    f, m = this.graph,
                    l = this.area,
                    t = Math.max(b.chartWidth, b.chartHeight),
                    n = this[(this.zoneAxis || "y") + "Axis"],
                    x, p, z = b.inverted,
                    C, r, w, B, K = !1;
                d.length && (m || l) && n && void 0 !== n.min && (p = n.reversed, C = n.horiz, m && m.hide(), l && l.hide(), x = n.getExtremes(), u(d, function(d, g) {
                    e = p ? C ? b.plotWidth : 0 : C ? 0 : n.toPixels(x.min);
                    e = Math.min(Math.max(I(k, e), 0), t);
                    k = Math.min(Math.max(Math.round(n.toPixels(I(d.value, x.max), !0)), 0), t);
                    K && (e = k = n.toPixels(x.max));
                    r = Math.abs(e - k);
                    w = Math.min(e, k);
                    B = Math.max(e, k);
                    n.isXAxis ? (f = { x: z ? B : w, y: 0, width: r, height: t }, C || (f.x = b.plotHeight - f.x)) : (f = { x: 0, y: z ? B : w, width: t, height: r }, C && (f.y = b.plotWidth - f.y));
                    z && c.isVML && (f = n.isXAxis ? { x: 0, y: p ? w : B, height: f.width, width: b.chartWidth } : { x: f.y - b.plotLeft - b.spacingBox.x, y: 0, width: f.height, height: b.chartHeight });
                    h[g] ? h[g].animate(f) : (h[g] = c.clipRect(f), m && a["zone-graph-" + g].clip(h[g]), l && a["zone-area-" + g].clip(h[g]));
                    K = d.value > x.max
                }), this.clips = h)
            },
            invertGroups: function(a) {
                function b() {
                    u(["group",
                        "markerGroup"
                    ], function(b) { c[b] && (d.renderer.isVML && c[b].attr({ width: c.yAxis.len, height: c.xAxis.len }), c[b].width = c.yAxis.len, c[b].height = c.xAxis.len, c[b].invert(a)) })
                }
                var c = this,
                    d = c.chart,
                    e;
                c.xAxis && (e = E(d, "resize", b), E(c, "destroy", e), b(a), c.invertGroups = b)
            },
            plotGroup: function(a, b, c, d, e) {
                var g = this[a],
                    k = !g;
                k && (this[a] = g = this.chart.renderer.g().attr({ zIndex: d || .1 }).add(e));
                g.addClass("highcharts-" + b + " highcharts-series-" + this.index + " highcharts-" + this.type + "-series " + (w(this.colorIndex) ? "highcharts-color-" +
                    this.colorIndex + " " : "") + (this.options.className || "") + (g.hasClass("highcharts-tracker") ? " highcharts-tracker" : ""), !0);
                g.attr({ visibility: c })[k ? "attr" : "animate"](this.getPlotBox());
                return g
            },
            getPlotBox: function() {
                var a = this.chart,
                    b = this.xAxis,
                    c = this.yAxis;
                a.inverted && (b = c, c = this.xAxis);
                return { translateX: b ? b.left : a.plotLeft, translateY: c ? c.top : a.plotTop, scaleX: 1, scaleY: 1 }
            },
            render: function() {
                var a = this,
                    b = a.chart,
                    c, d = a.options,
                    e = !!a.animate && b.renderer.isSVG && D(d.animation).duration,
                    k = a.visible ? "inherit" :
                    "hidden",
                    h = d.zIndex,
                    f = a.hasRendered,
                    m = b.seriesGroup,
                    l = b.inverted;
                c = a.plotGroup("group", "series", k, h, m);
                a.markerGroup = a.plotGroup("markerGroup", "markers", k, h, m);
                e && a.animate(!0);
                c.inverted = a.isCartesian ? l : !1;
                a.drawGraph && (a.drawGraph(), a.applyZones());
                a.drawDataLabels && a.drawDataLabels();
                a.visible && a.drawPoints();
                a.drawTracker && !1 !== a.options.enableMouseTracking && a.drawTracker();
                a.invertGroups(l);
                !1 === d.clip || a.sharedClipKey || f || c.clip(b.clipRect);
                e && a.animate();
                f || (a.animationTimeout = C(function() { a.afterAnimate() },
                    e));
                a.isDirty = !1;
                a.hasRendered = !0
            },
            redraw: function() {
                var a = this.chart,
                    b = this.isDirty || this.isDirtyData,
                    c = this.group,
                    d = this.xAxis,
                    e = this.yAxis;
                c && (a.inverted && c.attr({ width: a.plotWidth, height: a.plotHeight }), c.animate({ translateX: I(d && d.left, a.plotLeft), translateY: I(e && e.top, a.plotTop) }));
                this.translate();
                this.render();
                b && delete this.kdTree
            },
            kdAxisArray: ["clientX", "plotY"],
            searchPoint: function(a, b) {
                var c = this.xAxis,
                    d = this.yAxis,
                    e = this.chart.inverted;
                return this.searchKDTree({
                    clientX: e ? c.len - a.chartY +
                        c.pos : a.chartX - c.pos,
                    plotY: e ? d.len - a.chartX + d.pos : a.chartY - d.pos
                }, b)
            },
            buildKDTree: function() {
                function a(c, d, e) { var g, k; if (k = c && c.length) return g = b.kdAxisArray[d % e], c.sort(function(a, b) { return a[g] - b[g] }), k = Math.floor(k / 2), { point: c[k], left: a(c.slice(0, k), d + 1, e), right: a(c.slice(k + 1), d + 1, e) } }
                this.buildingKdTree = !0;
                var b = this,
                    c = -1 < b.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                delete b.kdTree;
                C(function() {
                    b.kdTree = a(b.getValidPoints(null, !b.directTouch), c, c);
                    b.buildingKdTree = !1
                }, b.options.kdNow ? 0 : 1)
            },
            searchKDTree: function(a, b) {
                function c(a, b, g, f) {
                    var m = b.point,
                        l = d.kdAxisArray[g % f],
                        q, t, n = m;
                    t = w(a[e]) && w(m[e]) ? Math.pow(a[e] - m[e], 2) : null;
                    q = w(a[k]) && w(m[k]) ? Math.pow(a[k] - m[k], 2) : null;
                    q = (t || 0) + (q || 0);
                    m.dist = w(q) ? Math.sqrt(q) : Number.MAX_VALUE;
                    m.distX = w(t) ? Math.sqrt(t) : Number.MAX_VALUE;
                    l = a[l] - m[l];
                    q = 0 > l ? "left" : "right";
                    t = 0 > l ? "right" : "left";
                    b[q] && (q = c(a, b[q], g + 1, f), n = q[h] < n[h] ? q : m);
                    b[t] && Math.sqrt(l * l) < n[h] && (a = c(a, b[t], g + 1, f), n = a[h] < n[h] ? a : n);
                    return n
                }
                var d = this,
                    e = this.kdAxisArray[0],
                    k = this.kdAxisArray[1],
                    h = b ? "distX" : "dist";
                b = -1 < d.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                this.kdTree || this.buildingKdTree || this.buildKDTree();
                if (this.kdTree) return c(a, this.kdTree, b, b)
            }
        })
    })(M);
    (function(a) {
        var E = a.Axis,
            D = a.Chart,
            H = a.correctFloat,
            p = a.defined,
            f = a.destroyObjectProperties,
            l = a.each,
            r = a.format,
            n = a.objectEach,
            w = a.pick,
            u = a.Series;
        a.StackItem = function(a, h, f, d, c) {
            var b = a.chart.inverted;
            this.axis = a;
            this.isNegative = f;
            this.options = h;
            this.x = d;
            this.total = null;
            this.points = {};
            this.stack = c;
            this.rightCliff = this.leftCliff =
                0;
            this.alignOptions = { align: h.align || (b ? f ? "left" : "right" : "center"), verticalAlign: h.verticalAlign || (b ? "middle" : f ? "bottom" : "top"), y: w(h.y, b ? 4 : f ? 14 : -6), x: w(h.x, b ? f ? -6 : 6 : 0) };
            this.textAlign = h.textAlign || (b ? f ? "right" : "left" : "center")
        };
        a.StackItem.prototype = {
            destroy: function() { f(this, this.axis) },
            render: function(a) {
                var e = this.options,
                    f = e.format,
                    f = f ? r(f, this) : e.formatter.call(this);
                this.label ? this.label.attr({ text: f, visibility: "hidden" }) : this.label = this.axis.chart.renderer.text(f, null, null, e.useHTML).css(e.style).attr({
                    align: this.textAlign,
                    rotation: e.rotation,
                    visibility: "hidden"
                }).add(a)
            },
            setOffset: function(a, h) {
                var e = this.axis,
                    d = e.chart,
                    c = e.translate(e.usePercentage ? 100 : this.total, 0, 0, 0, 1),
                    e = e.translate(0),
                    e = Math.abs(c - e);
                a = d.xAxis[0].translate(this.x) + a;
                c = this.getStackBox(d, this, a, c, h, e);
                if (h = this.label) h.align(this.alignOptions, null, c), c = h.alignAttr, h[!1 === this.options.crop || d.isInsidePlot(c.x, c.y) ? "show" : "hide"](!0)
            },
            getStackBox: function(a, h, f, d, c, b) {
                var e = h.axis.reversed,
                    l = a.inverted;
                a = a.plotHeight;
                h = h.isNegative && !e || !h.isNegative &&
                    e;
                return { x: l ? h ? d : d - b : f, y: l ? a - f - c : h ? a - d - b : a - d, width: l ? b : c, height: l ? c : b }
            }
        };
        D.prototype.getStacks = function() {
            var a = this;
            l(a.yAxis, function(a) { a.stacks && a.hasVisibleSeries && (a.oldStacks = a.stacks) });
            l(a.series, function(e) {!e.options.stacking || !0 !== e.visible && !1 !== a.options.chart.ignoreHiddenSeries || (e.stackKey = e.type + w(e.options.stack, "")) })
        };
        E.prototype.buildStacks = function() {
            var a = this.series,
                h = w(this.options.reversedStacks, !0),
                f = a.length,
                d;
            if (!this.isXAxis) {
                this.usePercentage = !1;
                for (d = f; d--;) a[h ? d :
                    f - d - 1].setStackedPoints();
                for (d = 0; d < f; d++) a[d].modifyStacks()
            }
        };
        E.prototype.renderStackTotals = function() {
            var a = this.chart,
                h = a.renderer,
                f = this.stacks,
                d = this.stackTotalGroup;
            d || (this.stackTotalGroup = d = h.g("stack-labels").attr({ visibility: "visible", zIndex: 6 }).add());
            d.translate(a.plotLeft, a.plotTop);
            n(f, function(a) { n(a, function(a) { a.render(d) }) })
        };
        E.prototype.resetStacks = function() {
            var a = this,
                h = a.stacks;
            a.isXAxis || n(h, function(e) {
                n(e, function(d, c) {
                    d.touched < a.stacksTouched ? (d.destroy(), delete e[c]) :
                        (d.total = null, d.cumulative = null)
                })
            })
        };
        E.prototype.cleanStacks = function() {
            var a;
            this.isXAxis || (this.oldStacks && (a = this.stacks = this.oldStacks), n(a, function(a) { n(a, function(a) { a.cumulative = a.total }) }))
        };
        u.prototype.setStackedPoints = function() {
            if (this.options.stacking && (!0 === this.visible || !1 === this.chart.options.chart.ignoreHiddenSeries)) {
                var e = this.processedXData,
                    h = this.processedYData,
                    f = [],
                    d = h.length,
                    c = this.options,
                    b = c.threshold,
                    k = w(c.startFromThreshold && b, 0),
                    l = c.stack,
                    c = c.stacking,
                    n = this.stackKey,
                    r =
                    "-" + n,
                    x = this.negStacks,
                    u = this.yAxis,
                    t = u.stacks,
                    C = u.oldStacks,
                    N, q, A, F, G, g, v;
                u.stacksTouched += 1;
                for (G = 0; G < d; G++) g = e[G], v = h[G], N = this.getStackIndicator(N, g, this.index), F = N.key, A = (q = x && v < (k ? 0 : b)) ? r : n, t[A] || (t[A] = {}), t[A][g] || (C[A] && C[A][g] ? (t[A][g] = C[A][g], t[A][g].total = null) : t[A][g] = new a.StackItem(u, u.options.stackLabels, q, g, l)), A = t[A][g], null !== v ? (A.points[F] = A.points[this.index] = [w(A.cumulative, k)], p(A.cumulative) || (A.base = F), A.touched = u.stacksTouched, 0 < N.index && !1 === this.singleStacks && (A.points[F][0] =
                    A.points[this.index + "," + g + ",0"][0])) : A.points[F] = A.points[this.index] = null, "percent" === c ? (q = q ? n : r, x && t[q] && t[q][g] ? (q = t[q][g], A.total = q.total = Math.max(q.total, A.total) + Math.abs(v) || 0) : A.total = H(A.total + (Math.abs(v) || 0))) : A.total = H(A.total + (v || 0)), A.cumulative = w(A.cumulative, k) + (v || 0), null !== v && (A.points[F].push(A.cumulative), f[G] = A.cumulative);
                "percent" === c && (u.usePercentage = !0);
                this.stackedYData = f;
                u.oldStacks = {}
            }
        };
        u.prototype.modifyStacks = function() {
            var a = this,
                h = a.stackKey,
                f = a.yAxis.stacks,
                d = a.processedXData,
                c, b = a.options.stacking;
            a[b + "Stacker"] && l([h, "-" + h], function(e) {
                for (var k = d.length, h, l; k--;)
                    if (h = d[k], c = a.getStackIndicator(c, h, a.index, e), l = (h = f[e] && f[e][h]) && h.points[c.key]) a[b + "Stacker"](l, h, k)
            })
        };
        u.prototype.percentStacker = function(a, h, f) {
            h = h.total ? 100 / h.total : 0;
            a[0] = H(a[0] * h);
            a[1] = H(a[1] * h);
            this.stackedYData[f] = a[1]
        };
        u.prototype.getStackIndicator = function(a, h, f, d) {
            !p(a) || a.x !== h || d && a.key !== d ? a = { x: h, index: 0, key: d } : a.index++;
            a.key = [f, h, a.index].join();
            return a
        }
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.animate,
            H = a.Axis,
            p = a.createElement,
            f = a.css,
            l = a.defined,
            r = a.each,
            n = a.erase,
            w = a.extend,
            u = a.fireEvent,
            e = a.inArray,
            h = a.isNumber,
            m = a.isObject,
            d = a.isArray,
            c = a.merge,
            b = a.objectEach,
            k = a.pick,
            z = a.Point,
            B = a.Series,
            I = a.seriesTypes,
            x = a.setAnimation,
            K = a.splat;
        w(a.Chart.prototype, {
            addSeries: function(a, b, c) {
                var d, e = this;
                a && (b = k(b, !0), u(e, "addSeries", { options: a }, function() {
                    d = e.initSeries(a);
                    e.isDirtyLegend = !0;
                    e.linkSeries();
                    b && e.redraw(c)
                }));
                return d
            },
            addAxis: function(a, b, d, e) {
                var h = b ? "xAxis" : "yAxis",
                    f = this.options;
                a = c(a, { index: this[h].length, isX: b });
                b = new H(this, a);
                f[h] = K(f[h] || {});
                f[h].push(a);
                k(d, !0) && this.redraw(e);
                return b
            },
            showLoading: function(a) {
                var b = this,
                    c = b.options,
                    d = b.loadingDiv,
                    e = c.loading,
                    k = function() { d && f(d, { left: b.plotLeft + "px", top: b.plotTop + "px", width: b.plotWidth + "px", height: b.plotHeight + "px" }) };
                d || (b.loadingDiv = d = p("div", { className: "highcharts-loading highcharts-loading-hidden" }, null, b.container), b.loadingSpan = p("span", { className: "highcharts-loading-inner" }, null, d), E(b, "redraw", k));
                d.className =
                    "highcharts-loading";
                b.loadingSpan.innerHTML = a || c.lang.loading;
                f(d, w(e.style, { zIndex: 10 }));
                f(b.loadingSpan, e.labelStyle);
                b.loadingShown || (f(d, { opacity: 0, display: "" }), D(d, { opacity: e.style.opacity || .5 }, { duration: e.showDuration || 0 }));
                b.loadingShown = !0;
                k()
            },
            hideLoading: function() {
                var a = this.options,
                    b = this.loadingDiv;
                b && (b.className = "highcharts-loading highcharts-loading-hidden", D(b, { opacity: 0 }, { duration: a.loading.hideDuration || 100, complete: function() { f(b, { display: "none" }) } }));
                this.loadingShown = !1
            },
            propsRequireDirtyBox: "backgroundColor borderColor borderWidth margin marginTop marginRight marginBottom marginLeft spacing spacingTop spacingRight spacingBottom spacingLeft borderRadius plotBackgroundColor plotBackgroundImage plotBorderColor plotBorderWidth plotShadow shadow".split(" "),
            propsRequireUpdateSeries: "chart.inverted chart.polar chart.ignoreHiddenSeries chart.type colors plotOptions tooltip".split(" "),
            update: function(a, d, f) {
                var m = this,
                    n = { credits: "addCredits", title: "setTitle", subtitle: "setSubtitle" },
                    t = a.chart,
                    x, g, p = [];
                if (t) {
                    c(!0, m.options.chart, t);
                    "className" in t && m.setClassName(t.className);
                    if ("inverted" in t || "polar" in t) m.propFromSeries(), x = !0;
                    "alignTicks" in t && (x = !0);
                    b(t, function(a, b) {
                        -1 !== e("chart." + b, m.propsRequireUpdateSeries) && (g = !0); - 1 !== e(b, m.propsRequireDirtyBox) &&
                            (m.isDirtyBox = !0)
                    });
                    "style" in t && m.renderer.setStyle(t.style)
                }
                a.colors && (this.options.colors = a.colors);
                a.plotOptions && c(!0, this.options.plotOptions, a.plotOptions);
                b(a, function(a, b) {
                    if (m[b] && "function" === typeof m[b].update) m[b].update(a, !1);
                    else if ("function" === typeof m[n[b]]) m[n[b]](a);
                    "chart" !== b && -1 !== e(b, m.propsRequireUpdateSeries) && (g = !0)
                });
                r("xAxis yAxis zAxis series colorAxis pane".split(" "), function(b) {
                    a[b] && (r(K(a[b]), function(a, c) {
                        (c = l(a.id) && m.get(a.id) || m[b][c]) && c.coll === b && (c.update(a, !1), f && (c.touched = !0));
                        if (!c && f)
                            if ("series" === b) m.addSeries(a, !1).touched = !0;
                            else if ("xAxis" === b || "yAxis" === b) m.addAxis(a, "xAxis" === b, !1).touched = !0
                    }), f && r(m[b], function(a) { a.touched ? delete a.touched : p.push(a) }))
                });
                r(p, function(a) { a.remove(!1) });
                x && r(m.axes, function(a) { a.update({}, !1) });
                g && r(m.series, function(a) { a.update({}, !1) });
                a.loading && c(!0, m.options.loading, a.loading);
                x = t && t.width;
                t = t && t.height;
                h(x) && x !== m.chartWidth || h(t) && t !== m.chartHeight ? m.setSize(x, t) : k(d, !0) && m.redraw()
            },
            setSubtitle: function(a) {
                this.setTitle(void 0,
                    a)
            }
        });
        w(z.prototype, {
            update: function(a, b, c, d) {
                function e() {
                    h.applyOptions(a);
                    null === h.y && g && (h.graphic = g.destroy());
                    m(a, !0) && (g && g.element && a && a.marker && void 0 !== a.marker.symbol && (h.graphic = g.destroy()), a && a.dataLabels && h.dataLabel && (h.dataLabel = h.dataLabel.destroy()), h.connector && (h.connector = h.connector.destroy()));
                    l = h.index;
                    f.updateParallelArrays(h, l);
                    t.data[l] = m(t.data[l], !0) || m(a, !0) ? h.options : a;
                    f.isDirty = f.isDirtyData = !0;
                    !f.fixedBox && f.hasCartesianSeries && (n.isDirtyBox = !0);
                    "point" === t.legendType &&
                        (n.isDirtyLegend = !0);
                    b && n.redraw(c)
                }
                var h = this,
                    f = h.series,
                    g = h.graphic,
                    l, n = f.chart,
                    t = f.options;
                b = k(b, !0);
                !1 === d ? e() : h.firePointEvent("update", { options: a }, e)
            },
            remove: function(a, b) { this.series.removePoint(e(this, this.series.data), a, b) }
        });
        w(B.prototype, {
            addPoint: function(a, b, c, d) {
                var e = this.options,
                    h = this.data,
                    f = this.chart,
                    g = this.xAxis,
                    g = g && g.hasNames && g.names,
                    l = e.data,
                    m, n, t = this.xData,
                    q, x;
                b = k(b, !0);
                m = { series: this };
                this.pointClass.prototype.applyOptions.apply(m, [a]);
                x = m.x;
                q = t.length;
                if (this.requireSorting &&
                    x < t[q - 1])
                    for (n = !0; q && t[q - 1] > x;) q--;
                this.updateParallelArrays(m, "splice", q, 0, 0);
                this.updateParallelArrays(m, q);
                g && m.name && (g[x] = m.name);
                l.splice(q, 0, a);
                n && (this.data.splice(q, 0, null), this.processData());
                "point" === e.legendType && this.generatePoints();
                c && (h[0] && h[0].remove ? h[0].remove(!1) : (h.shift(), this.updateParallelArrays(m, "shift"), l.shift()));
                this.isDirtyData = this.isDirty = !0;
                b && f.redraw(d)
            },
            removePoint: function(a, b, c) {
                var d = this,
                    e = d.data,
                    h = e[a],
                    f = d.points,
                    g = d.chart,
                    l = function() {
                        f && f.length === e.length &&
                            f.splice(a, 1);
                        e.splice(a, 1);
                        d.options.data.splice(a, 1);
                        d.updateParallelArrays(h || { series: d }, "splice", a, 1);
                        h && h.destroy();
                        d.isDirty = !0;
                        d.isDirtyData = !0;
                        b && g.redraw()
                    };
                x(c, g);
                b = k(b, !0);
                h ? h.firePointEvent("remove", null, l) : l()
            },
            remove: function(a, b, c) {
                function d() {
                    e.destroy();
                    h.isDirtyLegend = h.isDirtyBox = !0;
                    h.linkSeries();
                    k(a, !0) && h.redraw(b)
                }
                var e = this,
                    h = e.chart;
                !1 !== c ? u(e, "remove", null, d) : d()
            },
            update: function(a, b) {
                var d = this,
                    e = d.chart,
                    h = d.userOptions,
                    f = d.oldType || d.type,
                    l = a.type || h.type || e.options.chart.type,
                    g = I[f].prototype,
                    m, n = ["group", "markerGroup", "dataLabelsGroup"],
                    t = ["navigatorSeries", "baseSeries"],
                    x = d.finishedAnimating && { animation: !1 };
                if (Object.keys && "data" === Object.keys(a).toString()) return this.setData(a.data, b);
                t = n.concat(t);
                r(t, function(a) {
                    t[a] = d[a];
                    delete d[a]
                });
                a = c(h, x, { index: d.index, pointStart: d.xData[0] }, { data: d.options.data }, a);
                d.remove(!1, null, !1);
                for (m in g) d[m] = void 0;
                w(d, I[l || f].prototype);
                r(t, function(a) { d[a] = t[a] });
                d.init(e, a);
                a.zIndex !== h.zIndex && r(n, function(b) { d[b] && d[b].attr({ zIndex: a.zIndex }) });
                d.oldType = f;
                e.linkSeries();
                k(b, !0) && e.redraw(!1)
            }
        });
        w(H.prototype, {
            update: function(a, b) {
                var d = this.chart;
                a = d.options[this.coll][this.options.index] = c(this.userOptions, a);
                this.destroy(!0);
                this.init(d, w(a, { events: void 0 }));
                d.isDirtyBox = !0;
                k(b, !0) && d.redraw()
            },
            remove: function(a) {
                for (var b = this.chart, c = this.coll, e = this.series, h = e.length; h--;) e[h] && e[h].remove(!1);
                n(b.axes, this);
                n(b[c], this);
                d(b.options[c]) ? b.options[c].splice(this.options.index, 1) : delete b.options[c];
                r(b[c], function(a, b) {
                    a.options.index =
                        b
                });
                this.destroy();
                b.isDirtyBox = !0;
                k(a, !0) && b.redraw()
            },
            setTitle: function(a, b) { this.update({ title: a }, b) },
            setCategories: function(a, b) { this.update({ categories: a }, b) }
        })
    })(M);
    (function(a) {
        var E = a.color,
            D = a.each,
            H = a.map,
            p = a.pick,
            f = a.Series,
            l = a.seriesType;
        l("area", "line", { softThreshold: !1, threshold: 0 }, {
            singleStacks: !1,
            getStackPoints: function(f) {
                var l = [],
                    r = [],
                    u = this.xAxis,
                    e = this.yAxis,
                    h = e.stacks[this.stackKey],
                    m = {},
                    d = this.index,
                    c = e.series,
                    b = c.length,
                    k, z = p(e.options.reversedStacks, !0) ? 1 : -1,
                    B;
                f = f || this.points;
                if (this.options.stacking) {
                    for (B = 0; B < f.length; B++) f[B].leftNull = f[B].rightNull = null, m[f[B].x] = f[B];
                    a.objectEach(h, function(a, b) { null !== a.total && r.push(b) });
                    r.sort(function(a, b) { return a - b });
                    k = H(c, function() { return this.visible });
                    D(r, function(a, c) {
                        var f = 0,
                            n, x;
                        if (m[a] && !m[a].isNull) l.push(m[a]), D([-1, 1], function(e) {
                            var f = 1 === e ? "rightNull" : "leftNull",
                                l = 0,
                                t = h[r[c + e]];
                            if (t)
                                for (B = d; 0 <= B && B < b;) n = t.points[B], n || (B === d ? m[a][f] = !0 : k[B] && (x = h[a].points[B]) && (l -= x[1] - x[0])), B += z;
                            m[a][1 === e ? "rightCliff" : "leftCliff"] =
                                l
                        });
                        else {
                            for (B = d; 0 <= B && B < b;) {
                                if (n = h[a].points[B]) { f = n[1]; break }
                                B += z
                            }
                            f = e.translate(f, 0, 1, 0, 1);
                            l.push({ isNull: !0, plotX: u.translate(a, 0, 0, 0, 1), x: a, plotY: f, yBottom: f })
                        }
                    })
                }
                return l
            },
            getGraphPath: function(a) {
                var l = f.prototype.getGraphPath,
                    r = this.options,
                    u = r.stacking,
                    e = this.yAxis,
                    h, m, d = [],
                    c = [],
                    b = this.index,
                    k, z = e.stacks[this.stackKey],
                    B = r.threshold,
                    I = e.getThreshold(r.threshold),
                    x, r = r.connectNulls || "percent" === u,
                    K = function(h, f, l) {
                        var m = a[h];
                        h = u && z[m.x].points[b];
                        var n = m[l + "Null"] || 0;
                        l = m[l + "Cliff"] || 0;
                        var x,
                            t, m = !0;
                        l || n ? (x = (n ? h[0] : h[1]) + l, t = h[0] + l, m = !!n) : !u && a[f] && a[f].isNull && (x = t = B);
                        void 0 !== x && (c.push({ plotX: k, plotY: null === x ? I : e.getThreshold(x), isNull: m, isCliff: !0 }), d.push({ plotX: k, plotY: null === t ? I : e.getThreshold(t), doCurve: !1 }))
                    };
                a = a || this.points;
                u && (a = this.getStackPoints(a));
                for (h = 0; h < a.length; h++)
                    if (m = a[h].isNull, k = p(a[h].rectPlotX, a[h].plotX), x = p(a[h].yBottom, I), !m || r) r || K(h, h - 1, "left"), m && !u && r || (c.push(a[h]), d.push({ x: h, plotX: k, plotY: x })), r || K(h, h + 1, "right");
                h = l.call(this, c, !0, !0);
                d.reversed = !0;
                m = l.call(this, d, !0, !0);
                m.length && (m[0] = "L");
                m = h.concat(m);
                l = l.call(this, c, !1, r);
                m.xMap = h.xMap;
                this.areaPath = m;
                return l
            },
            drawGraph: function() {
                this.areaPath = [];
                f.prototype.drawGraph.apply(this);
                var a = this,
                    l = this.areaPath,
                    w = this.options,
                    u = [
                        ["area", "highcharts-area", this.color, w.fillColor]
                    ];
                D(this.zones, function(e, h) { u.push(["zone-area-" + h, "highcharts-area highcharts-zone-area-" + h + " " + e.className, e.color || a.color, e.fillColor || w.fillColor]) });
                D(u, function(e) {
                    var h = e[0],
                        f = a[h];
                    f ? (f.endX = a.preventGraphAnimation ?
                        null : l.xMap, f.animate({ d: l })) : (f = a[h] = a.chart.renderer.path(l).addClass(e[1]).attr({ fill: p(e[3], E(e[2]).setOpacity(p(w.fillOpacity, .75)).get()), zIndex: 0 }).add(a.group), f.isArea = !0);
                    f.startX = l.xMap;
                    f.shiftUnit = w.step ? 2 : 1
                })
            },
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle
        })
    })(M);
    (function(a) {
        var E = a.pick;
        a = a.seriesType;
        a("spline", "line", {}, {
            getPointSpline: function(a, H, p) {
                var f = H.plotX,
                    l = H.plotY,
                    r = a[p - 1];
                p = a[p + 1];
                var n, w, u, e;
                if (r && !r.isNull && !1 !== r.doCurve && !H.isCliff && p && !p.isNull && !1 !== p.doCurve &&
                    !H.isCliff) {
                    a = r.plotY;
                    u = p.plotX;
                    p = p.plotY;
                    var h = 0;
                    n = (1.5 * f + r.plotX) / 2.5;
                    w = (1.5 * l + a) / 2.5;
                    u = (1.5 * f + u) / 2.5;
                    e = (1.5 * l + p) / 2.5;
                    u !== n && (h = (e - w) * (u - f) / (u - n) + l - e);
                    w += h;
                    e += h;
                    w > a && w > l ? (w = Math.max(a, l), e = 2 * l - w) : w < a && w < l && (w = Math.min(a, l), e = 2 * l - w);
                    e > p && e > l ? (e = Math.max(p, l), w = 2 * l - e) : e < p && e < l && (e = Math.min(p, l), w = 2 * l - e);
                    H.rightContX = u;
                    H.rightContY = e
                }
                H = ["C", E(r.rightContX, r.plotX), E(r.rightContY, r.plotY), E(n, f), E(w, l), f, l];
                r.rightContX = r.rightContY = null;
                return H
            }
        })
    })(M);
    (function(a) {
        var E = a.seriesTypes.area.prototype,
            D = a.seriesType;
        D("areaspline", "spline", a.defaultPlotOptions.area, { getStackPoints: E.getStackPoints, getGraphPath: E.getGraphPath, drawGraph: E.drawGraph, drawLegendSymbol: a.LegendSymbolMixin.drawRectangle })
    })(M);
    (function(a) {
        var E = a.animObject,
            D = a.color,
            H = a.each,
            p = a.extend,
            f = a.isNumber,
            l = a.merge,
            r = a.pick,
            n = a.Series,
            w = a.seriesType,
            u = a.svg;
        w("column", "line", {
            borderRadius: 0,
            crisp: !0,
            groupPadding: .2,
            marker: null,
            pointPadding: .1,
            minPointLength: 0,
            cropThreshold: 50,
            pointRange: null,
            states: {
                hover: { halo: !1, brightness: .1 },
                select: { color: "#cccccc", borderColor: "#000000" }
            },
            dataLabels: { align: null, verticalAlign: null, y: null },
            softThreshold: !1,
            startFromThreshold: !0,
            stickyTracking: !1,
            tooltip: { distance: 6 },
            threshold: 0,
            borderColor: "#ffffff"
        }, {
            cropShoulder: 0,
            directTouch: !0,
            trackerGroups: ["group", "dataLabelsGroup"],
            negStacks: !0,
            init: function() {
                n.prototype.init.apply(this, arguments);
                var a = this,
                    h = a.chart;
                h.hasRendered && H(h.series, function(e) { e.type === a.type && (e.isDirty = !0) })
            },
            getColumnMetrics: function() {
                var a = this,
                    h = a.options,
                    f = a.xAxis,
                    d = a.yAxis,
                    c = f.reversed,
                    b, k = {},
                    l = 0;
                !1 === h.grouping ? l = 1 : H(a.chart.series, function(c) {
                    var e = c.options,
                        h = c.yAxis,
                        f;
                    c.type !== a.type || !c.visible && a.chart.options.chart.ignoreHiddenSeries || d.len !== h.len || d.pos !== h.pos || (e.stacking ? (b = c.stackKey, void 0 === k[b] && (k[b] = l++), f = k[b]) : !1 !== e.grouping && (f = l++), c.columnIndex = f)
                });
                var n = Math.min(Math.abs(f.transA) * (f.ordinalSlope || h.pointRange || f.closestPointRange || f.tickInterval || 1), f.len),
                    p = n * h.groupPadding,
                    x = (n - 2 * p) / (l || 1),
                    h = Math.min(h.maxPointWidth || f.len, r(h.pointWidth,
                        x * (1 - 2 * h.pointPadding)));
                a.columnMetrics = { width: h, offset: (x - h) / 2 + (p + ((a.columnIndex || 0) + (c ? 1 : 0)) * x - n / 2) * (c ? -1 : 1) };
                return a.columnMetrics
            },
            crispCol: function(a, h, f, d) {
                var c = this.chart,
                    b = this.borderWidth,
                    e = -(b % 2 ? .5 : 0),
                    b = b % 2 ? .5 : 1;
                c.inverted && c.renderer.isVML && (b += 1);
                this.options.crisp && (f = Math.round(a + f) + e, a = Math.round(a) + e, f -= a);
                d = Math.round(h + d) + b;
                e = .5 >= Math.abs(h) && .5 < d;
                h = Math.round(h) + b;
                d -= h;
                e && d && (--h, d += 1);
                return { x: a, y: h, width: f, height: d }
            },
            translate: function() {
                var a = this,
                    h = a.chart,
                    f = a.options,
                    d =
                    a.dense = 2 > a.closestPointRange * a.xAxis.transA,
                    d = a.borderWidth = r(f.borderWidth, d ? 0 : 1),
                    c = a.yAxis,
                    b = f.threshold,
                    k = a.translatedThreshold = c.getThreshold(b),
                    l = r(f.minPointLength, 5),
                    p = a.getColumnMetrics(),
                    u = p.width,
                    x = a.barW = Math.max(u, 1 + 2 * d),
                    w = a.pointXOffset = p.offset;
                h.inverted && (k -= .5);
                f.pointPadding && (x = Math.ceil(x));
                n.prototype.translate.apply(a);
                H(a.points, function(d) {
                    var e = r(d.yBottom, k),
                        f = 999 + Math.abs(e),
                        f = Math.min(Math.max(-f, d.plotY), c.len + f),
                        m = d.plotX + w,
                        n = x,
                        t = Math.min(f, e),
                        p, g = Math.max(f, e) - t;
                    l &&
                        Math.abs(g) < l && (g = l, p = !c.reversed && !d.negative || c.reversed && d.negative, d.y === b && a.dataMax <= b && c.min < b && (p = !p), t = Math.abs(t - k) > l ? e - l : k - (p ? l : 0));
                    d.barX = m;
                    d.pointWidth = u;
                    d.tooltipPos = h.inverted ? [c.len + c.pos - h.plotLeft - f, a.xAxis.len - m - n / 2, g] : [m + n / 2, f + c.pos - h.plotTop, g];
                    d.shapeType = "rect";
                    d.shapeArgs = a.crispCol.apply(a, d.isNull ? [m, k, n, 0] : [m, t, n, g])
                })
            },
            getSymbol: a.noop,
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle,
            drawGraph: function() { this.group[this.dense ? "addClass" : "removeClass"]("highcharts-dense-data") },
            pointAttribs: function(a, f) {
                var e = this.options,
                    d, c = this.pointAttrToOptions || {};
                d = c.stroke || "borderColor";
                var b = c["stroke-width"] || "borderWidth",
                    k = a && a.color || this.color,
                    h = a && a[d] || e[d] || this.color || k,
                    n = a && a[b] || e[b] || this[b] || 0,
                    c = e.dashStyle;
                a && this.zones.length && (k = a.getZone(), k = a.options.color || k && k.color || this.color);
                f && (a = l(e.states[f], a.options.states && a.options.states[f] || {}), f = a.brightness, k = a.color || void 0 !== f && D(k).brighten(a.brightness).get() || k, h = a[d] || h, n = a[b] || n, c = a.dashStyle || c);
                d = {
                    fill: k,
                    stroke: h,
                    "stroke-width": n
                };
                c && (d.dashstyle = c);
                return d
            },
            drawPoints: function() {
                var a = this,
                    h = this.chart,
                    m = a.options,
                    d = h.renderer,
                    c = m.animationLimit || 250,
                    b;
                H(a.points, function(e) {
                    var k = e.graphic;
                    if (f(e.plotY) && null !== e.y) {
                        b = e.shapeArgs;
                        if (k) k[h.pointCount < c ? "animate" : "attr"](l(b));
                        else e.graphic = k = d[e.shapeType](b).add(e.group || a.group);
                        m.borderRadius && k.attr({ r: m.borderRadius });
                        k.attr(a.pointAttribs(e, e.selected && "select")).shadow(m.shadow, null, m.stacking && !m.borderRadius);
                        k.addClass(e.getClassName(), !0)
                    } else k && (e.graphic = k.destroy())
                })
            },
            animate: function(a) {
                var e = this,
                    f = this.yAxis,
                    d = e.options,
                    c = this.chart.inverted,
                    b = {},
                    k = c ? "translateX" : "translateY",
                    l;
                u && (a ? (b.scaleY = .001, a = Math.min(f.pos + f.len, Math.max(f.pos, f.toPixels(d.threshold))), c ? b.translateX = a - f.len : b.translateY = a, e.group.attr(b)) : (l = e.group.attr(k), e.group.animate({ scaleY: 1 }, p(E(e.options.animation), {
                    step: function(a, c) {
                        b[k] = l + c.pos * (f.pos - l);
                        e.group.attr(b)
                    }
                })), e.animate = null))
            },
            remove: function() {
                var a = this,
                    f = a.chart;
                f.hasRendered && H(f.series,
                    function(e) { e.type === a.type && (e.isDirty = !0) });
                n.prototype.remove.apply(a, arguments)
            }
        })
    })(M);
    (function(a) {
        a = a.seriesType;
        a("bar", "column", null, { inverted: !0 })
    })(M);
    (function(a) {
        var E = a.Series;
        a = a.seriesType;
        a("scatter", "line", { lineWidth: 0, findNearestPointBy: "xy", marker: { enabled: !0 }, tooltip: { headerFormat: '\x3cspan style\x3d"color:{point.color}"\x3e\u25cf\x3c/span\x3e \x3cspan style\x3d"font-size: 0.85em"\x3e {series.name}\x3c/span\x3e\x3cbr/\x3e', pointFormat: "x: \x3cb\x3e{point.x}\x3c/b\x3e\x3cbr/\x3ey: \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3e" } }, { sorted: !1, requireSorting: !1, noSharedTooltip: !0, trackerGroups: ["group", "markerGroup", "dataLabelsGroup"], takeOrdinalPosition: !1, drawGraph: function() { this.options.lineWidth && E.prototype.drawGraph.call(this) } })
    })(M);
    (function(a) {
        var E = a.deg2rad,
            D = a.isNumber,
            H = a.pick,
            p = a.relativeLength;
        a.CenteredSeriesMixin = {
            getCenter: function() {
                var a = this.options,
                    l = this.chart,
                    r = 2 * (a.slicedOffset || 0),
                    n = l.plotWidth - 2 * r,
                    l = l.plotHeight - 2 * r,
                    w = a.center,
                    w = [H(w[0], "50%"), H(w[1], "50%"), a.size || "100%", a.innerSize || 0],
                    u = Math.min(n,
                        l),
                    e, h;
                for (e = 0; 4 > e; ++e) h = w[e], a = 2 > e || 2 === e && /%$/.test(h), w[e] = p(h, [n, l, u, w[2]][e]) + (a ? r : 0);
                w[3] > w[2] && (w[3] = w[2]);
                return w
            },
            getStartAndEndRadians: function(a, l) {
                a = D(a) ? a : 0;
                l = D(l) && l > a && 360 > l - a ? l : a + 360;
                return { start: E * (a + -90), end: E * (l + -90) }
            }
        }
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.CenteredSeriesMixin,
            H = a.defined,
            p = a.each,
            f = a.extend,
            l = D.getStartAndEndRadians,
            r = a.inArray,
            n = a.noop,
            w = a.pick,
            u = a.Point,
            e = a.Series,
            h = a.seriesType,
            m = a.setAnimation;
        h("pie", "line", {
            center: [null, null],
            clip: !1,
            colorByPoint: !0,
            dataLabels: {
                distance: 30,
                enabled: !0,
                formatter: function() { return this.point.isNull ? void 0 : this.point.name },
                x: 0
            },
            ignoreHiddenPoint: !0,
            legendType: "point",
            marker: null,
            size: null,
            showInLegend: !1,
            slicedOffset: 10,
            stickyTracking: !1,
            tooltip: { followPointer: !0 },
            borderColor: "#ffffff",
            borderWidth: 1,
            states: { hover: { brightness: .1, shadow: !1 } }
        }, {
            isCartesian: !1,
            requireSorting: !1,
            directTouch: !0,
            noSharedTooltip: !0,
            trackerGroups: ["group", "dataLabelsGroup"],
            axisTypes: [],
            pointAttribs: a.seriesTypes.column.prototype.pointAttribs,
            animate: function(a) {
                var c =
                    this,
                    b = c.points,
                    d = c.startAngleRad;
                a || (p(b, function(a) {
                    var b = a.graphic,
                        e = a.shapeArgs;
                    b && (b.attr({ r: a.startR || c.center[3] / 2, start: d, end: d }), b.animate({ r: e.r, start: e.start, end: e.end }, c.options.animation))
                }), c.animate = null)
            },
            updateTotals: function() {
                var a, c = 0,
                    b = this.points,
                    e = b.length,
                    f, h = this.options.ignoreHiddenPoint;
                for (a = 0; a < e; a++) f = b[a], c += h && !f.visible ? 0 : f.isNull ? 0 : f.y;
                this.total = c;
                for (a = 0; a < e; a++) f = b[a], f.percentage = 0 < c && (f.visible || !h) ? f.y / c * 100 : 0, f.total = c
            },
            generatePoints: function() {
                e.prototype.generatePoints.call(this);
                this.updateTotals()
            },
            translate: function(a) {
                this.generatePoints();
                var c = 0,
                    b = this.options,
                    d = b.slicedOffset,
                    e = d + (b.borderWidth || 0),
                    f, h, m, n = l(b.startAngle, b.endAngle),
                    t = this.startAngleRad = n.start,
                    n = (this.endAngleRad = n.end) - t,
                    p = this.points,
                    u, q = b.dataLabels.distance,
                    b = b.ignoreHiddenPoint,
                    r, F = p.length,
                    G;
                a || (this.center = a = this.getCenter());
                this.getX = function(b, c, d) { m = Math.asin(Math.min((b - a[1]) / (a[2] / 2 + d.labelDistance), 1)); return a[0] + (c ? -1 : 1) * Math.cos(m) * (a[2] / 2 + d.labelDistance) };
                for (r = 0; r < F; r++) {
                    G = p[r];
                    G.labelDistance = w(G.options.dataLabels && G.options.dataLabels.distance, q);
                    this.maxLabelDistance = Math.max(this.maxLabelDistance || 0, G.labelDistance);
                    f = t + c * n;
                    if (!b || G.visible) c += G.percentage / 100;
                    h = t + c * n;
                    G.shapeType = "arc";
                    G.shapeArgs = { x: a[0], y: a[1], r: a[2] / 2, innerR: a[3] / 2, start: Math.round(1E3 * f) / 1E3, end: Math.round(1E3 * h) / 1E3 };
                    m = (h + f) / 2;
                    m > 1.5 * Math.PI ? m -= 2 * Math.PI : m < -Math.PI / 2 && (m += 2 * Math.PI);
                    G.slicedTranslation = { translateX: Math.round(Math.cos(m) * d), translateY: Math.round(Math.sin(m) * d) };
                    h = Math.cos(m) * a[2] /
                        2;
                    u = Math.sin(m) * a[2] / 2;
                    G.tooltipPos = [a[0] + .7 * h, a[1] + .7 * u];
                    G.half = m < -Math.PI / 2 || m > Math.PI / 2 ? 1 : 0;
                    G.angle = m;
                    f = Math.min(e, G.labelDistance / 5);
                    G.labelPos = [a[0] + h + Math.cos(m) * G.labelDistance, a[1] + u + Math.sin(m) * G.labelDistance, a[0] + h + Math.cos(m) * f, a[1] + u + Math.sin(m) * f, a[0] + h, a[1] + u, 0 > G.labelDistance ? "center" : G.half ? "right" : "left", m]
                }
            },
            drawGraph: null,
            drawPoints: function() {
                var a = this,
                    c = a.chart.renderer,
                    b, e, h, l, m = a.options.shadow;
                m && !a.shadowGroup && (a.shadowGroup = c.g("shadow").add(a.group));
                p(a.points, function(d) {
                    e =
                        d.graphic;
                    if (d.isNull) e && (d.graphic = e.destroy());
                    else {
                        l = d.shapeArgs;
                        b = d.getTranslate();
                        var k = d.shadowGroup;
                        m && !k && (k = d.shadowGroup = c.g("shadow").add(a.shadowGroup));
                        k && k.attr(b);
                        h = a.pointAttribs(d, d.selected && "select");
                        e ? e.setRadialReference(a.center).attr(h).animate(f(l, b)) : (d.graphic = e = c[d.shapeType](l).setRadialReference(a.center).attr(b).add(a.group), d.visible || e.attr({ visibility: "hidden" }), e.attr(h).attr({ "stroke-linejoin": "round" }).shadow(m, k));
                        e.addClass(d.getClassName())
                    }
                })
            },
            searchPoint: n,
            sortByAngle: function(a, c) { a.sort(function(a, d) { return void 0 !== a.angle && (d.angle - a.angle) * c }) },
            drawLegendSymbol: a.LegendSymbolMixin.drawRectangle,
            getCenter: D.getCenter,
            getSymbol: n
        }, {
            init: function() {
                u.prototype.init.apply(this, arguments);
                var a = this,
                    c;
                a.name = w(a.name, "Slice");
                c = function(b) { a.slice("select" === b.type) };
                E(a, "select", c);
                E(a, "unselect", c);
                return a
            },
            isValid: function() { return a.isNumber(this.y, !0) && 0 <= this.y },
            setVisible: function(a, c) {
                var b = this,
                    d = b.series,
                    e = d.chart,
                    f = d.options.ignoreHiddenPoint;
                c = w(c, f);
                a !== b.visible && (b.visible = b.options.visible = a = void 0 === a ? !b.visible : a, d.options.data[r(b, d.data)] = b.options, p(["graphic", "dataLabel", "connector", "shadowGroup"], function(c) { if (b[c]) b[c][a ? "show" : "hide"](!0) }), b.legendItem && e.legend.colorizeItem(b, a), a || "hover" !== b.state || b.setState(""), f && (d.isDirty = !0), c && e.redraw())
            },
            slice: function(a, c, b) {
                var d = this.series;
                m(b, d.chart);
                w(c, !0);
                this.sliced = this.options.sliced = H(a) ? a : !this.sliced;
                d.options.data[r(this, d.data)] = this.options;
                this.graphic.animate(this.getTranslate());
                this.shadowGroup && this.shadowGroup.animate(this.getTranslate())
            },
            getTranslate: function() { return this.sliced ? this.slicedTranslation : { translateX: 0, translateY: 0 } },
            haloPath: function(a) { var c = this.shapeArgs; return this.sliced || !this.visible ? [] : this.series.chart.renderer.symbols.arc(c.x, c.y, c.r + a, c.r + a, { innerR: this.shapeArgs.r - 1, start: c.start, end: c.end }) }
        })
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.arrayMax,
            H = a.defined,
            p = a.each,
            f = a.extend,
            l = a.format,
            r = a.map,
            n = a.merge,
            w = a.noop,
            u = a.pick,
            e = a.relativeLength,
            h =
            a.Series,
            m = a.seriesTypes,
            d = a.stableSort;
        a.distribute = function(a, b) {
            function c(a, b) { return a.target - b.target }
            var e, f = !0,
                h = a,
                l = [],
                m;
            m = 0;
            for (e = a.length; e--;) m += a[e].size;
            if (m > b) {
                d(a, function(a, b) { return (b.rank || 0) - (a.rank || 0) });
                for (m = e = 0; m <= b;) m += a[e].size, e++;
                l = a.splice(e - 1, a.length)
            }
            d(a, c);
            for (a = r(a, function(a) { return { size: a.size, targets: [a.target], align: u(a.align, .5) } }); f;) {
                for (e = a.length; e--;) f = a[e], m = (Math.min.apply(0, f.targets) + Math.max.apply(0, f.targets)) / 2, f.pos = Math.min(Math.max(0, m - f.size *
                    f.align), b - f.size);
                e = a.length;
                for (f = !1; e--;) 0 < e && a[e - 1].pos + a[e - 1].size > a[e].pos && (a[e - 1].size += a[e].size, a[e - 1].targets = a[e - 1].targets.concat(a[e].targets), a[e - 1].align = .5, a[e - 1].pos + a[e - 1].size > b && (a[e - 1].pos = b - a[e - 1].size), a.splice(e, 1), f = !0)
            }
            e = 0;
            p(a, function(a) {
                var b = 0;
                p(a.targets, function() {
                    h[e].pos = a.pos + b;
                    b += h[e].size;
                    e++
                })
            });
            h.push.apply(h, l);
            d(h, c)
        };
        h.prototype.drawDataLabels = function() {
            function c(a, b) {
                var c = b.filter;
                return c ? (b = c.operator, a = a[c.property], c = c.value, "\x3e" === b && a > c || "\x3c" ===
                    b && a < c || "\x3e\x3d" === b && a >= c || "\x3c\x3d" === b && a <= c || "\x3d\x3d" === b && a == c || "\x3d\x3d\x3d" === b && a === c ? !0 : !1) : !0
            }
            var b = this,
                d = b.options,
                e = d.dataLabels,
                f = b.points,
                h, m, r = b.hasRendered || 0,
                t, w, D = u(e.defer, !!d.animation),
                q = b.chart.renderer;
            if (e.enabled || b._hasPointLabels) b.dlProcessOptions && b.dlProcessOptions(e), w = b.plotGroup("dataLabelsGroup", "data-labels", D && !r ? "hidden" : "visible", e.zIndex || 6), D && (w.attr({ opacity: +r }), r || E(b, "afterAnimate", function() {
                b.visible && w.show(!0);
                w[d.animation ? "animate" : "attr"]({ opacity: 1 }, { duration: 200 })
            })), m = e, p(f, function(f) {
                var k, p = f.dataLabel,
                    g, x, r = f.connector,
                    z = !p,
                    C;
                h = f.dlOptions || f.options && f.options.dataLabels;
                (k = u(h && h.enabled, m.enabled) && !f.isNull) && (k = !0 === c(f, h || e));
                k && (e = n(m, h), g = f.getLabelConfig(), C = e[f.formatPrefix + "Format"] || e.format, t = H(C) ? l(C, g) : (e[f.formatPrefix + "Formatter"] || e.formatter).call(g, e), C = e.style, g = e.rotation, C.color = u(e.color, C.color, b.color, "#000000"), "contrast" === C.color && (f.contrastColor = q.getContrast(f.color || b.color), C.color = e.inside || 0 > u(f.labelDistance,
                    e.distance) || d.stacking ? f.contrastColor : "#000000"), d.cursor && (C.cursor = d.cursor), x = { fill: e.backgroundColor, stroke: e.borderColor, "stroke-width": e.borderWidth, r: e.borderRadius || 0, rotation: g, padding: e.padding, zIndex: 1 }, a.objectEach(x, function(a, b) { void 0 === a && delete x[b] }));
                !p || k && H(t) ? k && H(t) && (p ? x.text = t : (p = f.dataLabel = g ? q.text(t, 0, -9999).addClass("highcharts-data-label") : q.label(t, 0, -9999, e.shape, null, null, e.useHTML, null, "data-label"), p.addClass(" highcharts-data-label-color-" + f.colorIndex + " " + (e.className ||
                    "") + (e.useHTML ? "highcharts-tracker" : ""))), p.attr(x), p.css(C).shadow(e.shadow), p.added || p.add(w), b.alignDataLabel(f, p, e, null, z)) : (f.dataLabel = p = p.destroy(), r && (f.connector = r.destroy()))
            })
        };
        h.prototype.alignDataLabel = function(a, b, d, e, h) {
            var c = this.chart,
                k = c.inverted,
                l = u(a.dlBox && a.dlBox.centerX, a.plotX, -9999),
                m = u(a.plotY, -9999),
                n = b.getBBox(),
                p, q = d.rotation,
                r = d.align,
                w = this.visible && (a.series.forceDL || c.isInsidePlot(l, Math.round(m), k) || e && c.isInsidePlot(l, k ? e.x + 1 : e.y + e.height - 1, k)),
                z = "justify" === u(d.overflow,
                    "justify");
            if (w && (p = d.style.fontSize, p = c.renderer.fontMetrics(p, b).b, e = f({ x: k ? this.yAxis.len - m : l, y: Math.round(k ? this.xAxis.len - l : m), width: 0, height: 0 }, e), f(d, { width: n.width, height: n.height }), q ? (z = !1, l = c.renderer.rotCorr(p, q), l = { x: e.x + d.x + e.width / 2 + l.x, y: e.y + d.y + { top: 0, middle: .5, bottom: 1 }[d.verticalAlign] * e.height }, b[h ? "attr" : "animate"](l).attr({ align: r }), m = (q + 720) % 360, m = 180 < m && 360 > m, "left" === r ? l.y -= m ? n.height : 0 : "center" === r ? (l.x -= n.width / 2, l.y -= n.height / 2) : "right" === r && (l.x -= n.width, l.y -= m ? 0 : n.height)) :
                    (b.align(d, null, e), l = b.alignAttr), z ? a.isLabelJustified = this.justifyDataLabel(b, d, l, n, e, h) : u(d.crop, !0) && (w = c.isInsidePlot(l.x, l.y) && c.isInsidePlot(l.x + n.width, l.y + n.height)), d.shape && !q)) b[h ? "attr" : "animate"]({ anchorX: k ? c.plotWidth - a.plotY : a.plotX, anchorY: k ? c.plotHeight - a.plotX : a.plotY });
            w || (b.attr({ y: -9999 }), b.placed = !1)
        };
        h.prototype.justifyDataLabel = function(a, b, d, e, f, h) {
            var c = this.chart,
                k = b.align,
                l = b.verticalAlign,
                m, n, p = a.box ? 0 : a.padding || 0;
            m = d.x + p;
            0 > m && ("right" === k ? b.align = "left" : b.x = -m, n = !0);
            m = d.x + e.width - p;
            m > c.plotWidth && ("left" === k ? b.align = "right" : b.x = c.plotWidth - m, n = !0);
            m = d.y + p;
            0 > m && ("bottom" === l ? b.verticalAlign = "top" : b.y = -m, n = !0);
            m = d.y + e.height - p;
            m > c.plotHeight && ("top" === l ? b.verticalAlign = "bottom" : b.y = c.plotHeight - m, n = !0);
            n && (a.placed = !h, a.align(b, null, f));
            return n
        };
        m.pie && (m.pie.prototype.drawDataLabels = function() {
            var c = this,
                b = c.data,
                d, e = c.chart,
                f = c.options.dataLabels,
                l = u(f.connectorPadding, 10),
                m = u(f.connectorWidth, 1),
                n = e.plotWidth,
                t = e.plotHeight,
                r, w = c.center,
                q = w[2] / 2,
                A = w[1],
                F, G,
                g, v, E = [
                    [],
                    []
                ],
                L, P, J, M, y = [0, 0, 0, 0];
            c.visible && (f.enabled || c._hasPointLabels) && (p(b, function(a) { a.dataLabel && a.visible && a.dataLabel.shortened && (a.dataLabel.attr({ width: "auto" }).css({ width: "auto", textOverflow: "clip" }), a.dataLabel.shortened = !1) }), h.prototype.drawDataLabels.apply(c), p(b, function(a) { a.dataLabel && a.visible && (E[a.half].push(a), a.dataLabel._pos = null) }), p(E, function(b, h) {
                var k, m, x = b.length,
                    r = [],
                    z;
                if (x)
                    for (c.sortByAngle(b, h - .5), 0 < c.maxLabelDistance && (k = Math.max(0, A - q - c.maxLabelDistance), m = Math.min(A +
                            q + c.maxLabelDistance, e.plotHeight), p(b, function(a) { 0 < a.labelDistance && a.dataLabel && (a.top = Math.max(0, A - q - a.labelDistance), a.bottom = Math.min(A + q + a.labelDistance, e.plotHeight), z = a.dataLabel.getBBox().height || 21, a.positionsIndex = r.push({ target: a.labelPos[1] - a.top + z / 2, size: z, rank: a.y }) - 1) }), a.distribute(r, m + z - k)), M = 0; M < x; M++) d = b[M], m = d.positionsIndex, g = d.labelPos, F = d.dataLabel, J = !1 === d.visible ? "hidden" : "inherit", P = k = g[1], r && H(r[m]) && (void 0 === r[m].pos ? J = "hidden" : (v = r[m].size, P = d.top + r[m].pos)), delete d.positionIndex,
                        L = f.justify ? w[0] + (h ? -1 : 1) * (q + d.labelDistance) : c.getX(P < d.top + 2 || P > d.bottom - 2 ? k : P, h, d), F._attr = { visibility: J, align: g[6] }, F._pos = { x: L + f.x + ({ left: l, right: -l }[g[6]] || 0), y: P + f.y - 10 }, g.x = L, g.y = P, u(f.crop, !0) && (G = F.getBBox().width, k = null, L - G < l ? (k = Math.round(G - L + l), y[3] = Math.max(k, y[3])) : L + G > n - l && (k = Math.round(L + G - n + l), y[1] = Math.max(k, y[1])), 0 > P - v / 2 ? y[0] = Math.max(Math.round(-P + v / 2), y[0]) : P + v / 2 > t && (y[2] = Math.max(Math.round(P + v / 2 - t), y[2])), F.sideOverflow = k)
            }), 0 === D(y) || this.verifyDataLabelOverflow(y)) && (this.placeDataLabels(),
                m && p(this.points, function(a) {
                    var b;
                    r = a.connector;
                    if ((F = a.dataLabel) && F._pos && a.visible && 0 < a.labelDistance) {
                        J = F._attr.visibility;
                        if (b = !r) a.connector = r = e.renderer.path().addClass("highcharts-data-label-connector  highcharts-color-" + a.colorIndex).add(c.dataLabelsGroup), r.attr({ "stroke-width": m, stroke: f.connectorColor || a.color || "#666666" });
                        r[b ? "attr" : "animate"]({ d: c.connectorPath(a.labelPos) });
                        r.attr("visibility", J)
                    } else r && (a.connector = r.destroy())
                }))
        }, m.pie.prototype.connectorPath = function(a) {
            var b =
                a.x,
                c = a.y;
            return u(this.options.dataLabels.softConnector, !0) ? ["M", b + ("left" === a[6] ? 5 : -5), c, "C", b, c, 2 * a[2] - a[4], 2 * a[3] - a[5], a[2], a[3], "L", a[4], a[5]] : ["M", b + ("left" === a[6] ? 5 : -5), c, "L", a[2], a[3], "L", a[4], a[5]]
        }, m.pie.prototype.placeDataLabels = function() {
            p(this.points, function(a) {
                var b = a.dataLabel;
                b && a.visible && ((a = b._pos) ? (b.sideOverflow && (b._attr.width = b.getBBox().width - b.sideOverflow, b.css({ width: b._attr.width + "px", textOverflow: "ellipsis" }), b.shortened = !0), b.attr(b._attr), b[b.moved ? "animate" : "attr"](a),
                    b.moved = !0) : b && b.attr({ y: -9999 }))
            }, this)
        }, m.pie.prototype.alignDataLabel = w, m.pie.prototype.verifyDataLabelOverflow = function(a) {
            var b = this.center,
                c = this.options,
                d = c.center,
                f = c.minSize || 80,
                h, l = null !== c.size;
            l || (null !== d[0] ? h = Math.max(b[2] - Math.max(a[1], a[3]), f) : (h = Math.max(b[2] - a[1] - a[3], f), b[0] += (a[3] - a[1]) / 2), null !== d[1] ? h = Math.max(Math.min(h, b[2] - Math.max(a[0], a[2])), f) : (h = Math.max(Math.min(h, b[2] - a[0] - a[2]), f), b[1] += (a[0] - a[2]) / 2), h < b[2] ? (b[2] = h, b[3] = Math.min(e(c.innerSize || 0, h), h), this.translate(b),
                this.drawDataLabels && this.drawDataLabels()) : l = !0);
            return l
        });
        m.column && (m.column.prototype.alignDataLabel = function(a, b, d, e, f) {
            var c = this.chart.inverted,
                k = a.series,
                l = a.dlBox || a.shapeArgs,
                m = u(a.below, a.plotY > u(this.translatedThreshold, k.yAxis.len)),
                p = u(d.inside, !!this.options.stacking);
            l && (e = n(l), 0 > e.y && (e.height += e.y, e.y = 0), l = e.y + e.height - k.yAxis.len, 0 < l && (e.height -= l), c && (e = { x: k.yAxis.len - e.y - e.height, y: k.xAxis.len - e.x - e.width, width: e.height, height: e.width }), p || (c ? (e.x += m ? 0 : e.width, e.width = 0) : (e.y +=
                m ? e.height : 0, e.height = 0)));
            d.align = u(d.align, !c || p ? "center" : m ? "right" : "left");
            d.verticalAlign = u(d.verticalAlign, c || p ? "middle" : m ? "top" : "bottom");
            h.prototype.alignDataLabel.call(this, a, b, d, e, f);
            a.isLabelJustified && a.contrastColor && a.dataLabel.css({ color: a.contrastColor })
        })
    })(M);
    (function(a) {
        var E = a.Chart,
            D = a.each,
            H = a.objectEach,
            p = a.pick;
        a = a.addEvent;
        a(E.prototype, "render", function() {
            var a = [];
            D(this.labelCollectors || [], function(f) { a = a.concat(f()) });
            D(this.yAxis || [], function(f) {
                f.options.stackLabels &&
                    !f.options.stackLabels.allowOverlap && H(f.stacks, function(f) { H(f, function(f) { a.push(f.label) }) })
            });
            D(this.series || [], function(f) {
                var l = f.options.dataLabels,
                    n = f.dataLabelCollections || ["dataLabel"];
                (l.enabled || f._hasPointLabels) && !l.allowOverlap && f.visible && D(n, function(l) { D(f.points, function(f) { f[l] && (f[l].labelrank = p(f.labelrank, f.shapeArgs && f.shapeArgs.height), a.push(f[l])) }) })
            });
            this.hideOverlappingLabels(a)
        });
        E.prototype.hideOverlappingLabels = function(a) {
            var f = a.length,
                p, n, w, u, e, h, m, d, c, b = function(a,
                    b, c, d, e, f, h, l) { return !(e > a + c || e + h < a || f > b + d || f + l < b) };
            for (n = 0; n < f; n++)
                if (p = a[n]) p.oldOpacity = p.opacity, p.newOpacity = 1, p.width || (w = p.getBBox(), p.width = w.width, p.height = w.height);
            a.sort(function(a, b) { return (b.labelrank || 0) - (a.labelrank || 0) });
            for (n = 0; n < f; n++)
                for (w = a[n], p = n + 1; p < f; ++p)
                    if (u = a[p], w && u && w !== u && w.placed && u.placed && 0 !== w.newOpacity && 0 !== u.newOpacity && (e = w.alignAttr, h = u.alignAttr, m = w.parentGroup, d = u.parentGroup, c = 2 * (w.box ? 0 : w.padding || 0), e = b(e.x + m.translateX, e.y + m.translateY, w.width - c, w.height -
                            c, h.x + d.translateX, h.y + d.translateY, u.width - c, u.height - c)))(w.labelrank < u.labelrank ? w : u).newOpacity = 0;
            D(a, function(a) {
                var b, c;
                a && (c = a.newOpacity, a.oldOpacity !== c && a.placed && (c ? a.show(!0) : b = function() { a.hide() }, a.alignAttr.opacity = c, a[a.isOld ? "animate" : "attr"](a.alignAttr, null, b)), a.isOld = !0)
            })
        }
    })(M);
    (function(a) {
        var E = a.addEvent,
            D = a.Chart,
            H = a.createElement,
            p = a.css,
            f = a.defaultOptions,
            l = a.defaultPlotOptions,
            r = a.each,
            n = a.extend,
            w = a.fireEvent,
            u = a.hasTouch,
            e = a.inArray,
            h = a.isObject,
            m = a.Legend,
            d = a.merge,
            c = a.pick,
            b = a.Point,
            k = a.Series,
            z = a.seriesTypes,
            B = a.svg,
            I;
        I = a.TrackerMixin = {
            drawTrackerPoint: function() {
                var a = this,
                    b = a.chart.pointer,
                    c = function(a) {
                        var c = b.getPointFromEvent(a);
                        void 0 !== c && (b.isDirectTouch = !0, c.onMouseOver(a))
                    };
                r(a.points, function(a) {
                    a.graphic && (a.graphic.element.point = a);
                    a.dataLabel && (a.dataLabel.div ? a.dataLabel.div.point = a : a.dataLabel.element.point = a)
                });
                a._hasTracking || (r(a.trackerGroups, function(d) {
                    if (a[d]) {
                        a[d].addClass("highcharts-tracker").on("mouseover", c).on("mouseout", function(a) { b.onTrackerMouseOut(a) });
                        if (u) a[d].on("touchstart", c);
                        a.options.cursor && a[d].css(p).css({ cursor: a.options.cursor })
                    }
                }), a._hasTracking = !0)
            },
            drawTrackerGraph: function() {
                var a = this,
                    b = a.options,
                    c = b.trackByArea,
                    d = [].concat(c ? a.areaPath : a.graphPath),
                    e = d.length,
                    f = a.chart,
                    h = f.pointer,
                    k = f.renderer,
                    l = f.options.tooltip.snap,
                    g = a.tracker,
                    m, n = function() { if (f.hoverSeries !== a) a.onMouseOver() },
                    p = "rgba(192,192,192," + (B ? .0001 : .002) + ")";
                if (e && !c)
                    for (m = e + 1; m--;) "M" === d[m] && d.splice(m + 1, 0, d[m + 1] - l, d[m + 2], "L"), (m && "M" === d[m] || m === e) && d.splice(m,
                        0, "L", d[m - 2] + l, d[m - 1]);
                g ? g.attr({ d: d }) : a.graph && (a.tracker = k.path(d).attr({ "stroke-linejoin": "round", visibility: a.visible ? "visible" : "hidden", stroke: p, fill: c ? p : "none", "stroke-width": a.graph.strokeWidth() + (c ? 0 : 2 * l), zIndex: 2 }).add(a.group), r([a.tracker, a.markerGroup], function(a) {
                    a.addClass("highcharts-tracker").on("mouseover", n).on("mouseout", function(a) { h.onTrackerMouseOut(a) });
                    b.cursor && a.css({ cursor: b.cursor });
                    if (u) a.on("touchstart", n)
                }))
            }
        };
        z.column && (z.column.prototype.drawTracker = I.drawTrackerPoint);
        z.pie && (z.pie.prototype.drawTracker = I.drawTrackerPoint);
        z.scatter && (z.scatter.prototype.drawTracker = I.drawTrackerPoint);
        n(m.prototype, {
            setItemEvents: function(a, c, e) {
                var f = this,
                    h = f.chart.renderer.boxWrapper,
                    k = "highcharts-legend-" + (a instanceof b ? "point" : "series") + "-active";
                (e ? c : a.legendGroup).on("mouseover", function() {
                    a.setState("hover");
                    h.addClass(k);
                    c.css(f.options.itemHoverStyle)
                }).on("mouseout", function() {
                    c.css(d(a.visible ? f.itemStyle : f.itemHiddenStyle));
                    h.removeClass(k);
                    a.setState()
                }).on("click",
                    function(b) {
                        var c = function() { a.setVisible && a.setVisible() };
                        h.removeClass(k);
                        b = { browserEvent: b };
                        a.firePointEvent ? a.firePointEvent("legendItemClick", b, c) : w(a, "legendItemClick", b, c)
                    })
            },
            createCheckboxForItem: function(a) {
                a.checkbox = H("input", { type: "checkbox", checked: a.selected, defaultChecked: a.selected }, this.options.itemCheckboxStyle, this.chart.container);
                E(a.checkbox, "click", function(b) { w(a.series || a, "checkboxClick", { checked: b.target.checked, item: a }, function() { a.select() }) })
            }
        });
        f.legend.itemStyle.cursor =
            "pointer";
        n(D.prototype, {
            showResetZoom: function() {
                var a = this,
                    b = f.lang,
                    c = a.options.chart.resetZoomButton,
                    d = c.theme,
                    e = d.states,
                    h = "chart" === c.relativeTo ? null : "plotBox";
                this.resetZoomButton = a.renderer.button(b.resetZoom, null, null, function() { a.zoomOut() }, d, e && e.hover).attr({ align: c.position.align, title: b.resetZoomTitle }).addClass("highcharts-reset-zoom").add().align(c.position, !1, h)
            },
            zoomOut: function() {
                var a = this;
                w(a, "selection", { resetSelection: !0 }, function() { a.zoom() })
            },
            zoom: function(a) {
                var b, d = this.pointer,
                    e = !1,
                    f;
                !a || a.resetSelection ? (r(this.axes, function(a) { b = a.zoom() }), d.initiated = !1) : r(a.xAxis.concat(a.yAxis), function(a) {
                    var c = a.axis;
                    d[c.isXAxis ? "zoomX" : "zoomY"] && (b = c.zoom(a.min, a.max), c.displayBtn && (e = !0))
                });
                f = this.resetZoomButton;
                e && !f ? this.showResetZoom() : !e && h(f) && (this.resetZoomButton = f.destroy());
                b && this.redraw(c(this.options.chart.animation, a && a.animation, 100 > this.pointCount))
            },
            pan: function(a, b) {
                var c = this,
                    d = c.hoverPoints,
                    e;
                d && r(d, function(a) { a.setState() });
                r("xy" === b ? [1, 0] : [1], function(b) {
                    b =
                        c[b ? "xAxis" : "yAxis"][0];
                    var d = b.horiz,
                        f = a[d ? "chartX" : "chartY"],
                        d = d ? "mouseDownX" : "mouseDownY",
                        h = c[d],
                        g = (b.pointRange || 0) / 2,
                        k = b.getExtremes(),
                        l = b.toValue(h - f, !0) + g,
                        m = b.toValue(h + b.len - f, !0) - g,
                        n = m < l,
                        h = n ? m : l,
                        l = n ? l : m,
                        m = Math.min(k.dataMin, g ? k.min : b.toValue(b.toPixels(k.min) - b.minPixelPadding)),
                        g = Math.max(k.dataMax, g ? k.max : b.toValue(b.toPixels(k.max) + b.minPixelPadding)),
                        n = m - h;
                    0 < n && (l += n, h = m);
                    n = l - g;
                    0 < n && (l = g, h -= n);
                    b.series.length && h !== k.min && l !== k.max && (b.setExtremes(h, l, !1, !1, { trigger: "pan" }), e = !0);
                    c[d] =
                        f
                });
                e && c.redraw(!1);
                p(c.container, { cursor: "move" })
            }
        });
        n(b.prototype, {
            select: function(a, b) {
                var d = this,
                    f = d.series,
                    h = f.chart;
                a = c(a, !d.selected);
                d.firePointEvent(a ? "select" : "unselect", { accumulate: b }, function() {
                    d.selected = d.options.selected = a;
                    f.options.data[e(d, f.data)] = d.options;
                    d.setState(a && "select");
                    b || r(h.getSelectedPoints(), function(a) { a.selected && a !== d && (a.selected = a.options.selected = !1, f.options.data[e(a, f.data)] = a.options, a.setState(""), a.firePointEvent("unselect")) })
                })
            },
            onMouseOver: function(a) {
                var b =
                    this.series.chart,
                    c = b.pointer;
                a = a ? c.normalize(a) : c.getChartCoordinatesFromPoint(this, b.inverted);
                c.runPointActions(a, this)
            },
            onMouseOut: function() {
                var a = this.series.chart;
                this.firePointEvent("mouseOut");
                r(a.hoverPoints || [], function(a) { a.setState() });
                a.hoverPoints = a.hoverPoint = null
            },
            importEvents: function() {
                if (!this.hasImportedEvents) {
                    var b = this,
                        c = d(b.series.options.point, b.options).events;
                    b.events = c;
                    a.objectEach(c, function(a, c) { E(b, c, a) });
                    this.hasImportedEvents = !0
                }
            },
            setState: function(a, b) {
                var d = Math.floor(this.plotX),
                    e = this.plotY,
                    f = this.series,
                    h = f.options.states[a] || {},
                    k = l[f.type].marker && f.options.marker,
                    m = k && !1 === k.enabled,
                    p = k && k.states && k.states[a] || {},
                    g = !1 === p.enabled,
                    r = f.stateMarkerGraphic,
                    u = this.marker || {},
                    w = f.chart,
                    x = f.halo,
                    z, B = k && f.markerAttribs;
                a = a || "";
                if (!(a === this.state && !b || this.selected && "select" !== a || !1 === h.enabled || a && (g || m && !1 === p.enabled) || a && u.states && u.states[a] && !1 === u.states[a].enabled)) {
                    B && (z = f.markerAttribs(this, a));
                    if (this.graphic) this.state && this.graphic.removeClass("highcharts-point-" +
                        this.state), a && this.graphic.addClass("highcharts-point-" + a), this.graphic.animate(f.pointAttribs(this, a), c(w.options.chart.animation, h.animation)), z && this.graphic.animate(z, c(w.options.chart.animation, p.animation, k.animation)), r && r.hide();
                    else {
                        if (a && p) {
                            k = u.symbol || f.symbol;
                            r && r.currentSymbol !== k && (r = r.destroy());
                            if (r) r[b ? "animate" : "attr"]({ x: z.x, y: z.y });
                            else k && (f.stateMarkerGraphic = r = w.renderer.symbol(k, z.x, z.y, z.width, z.height).add(f.markerGroup), r.currentSymbol = k);
                            r && r.attr(f.pointAttribs(this,
                                a))
                        }
                        r && (r[a && w.isInsidePlot(d, e, w.inverted) ? "show" : "hide"](), r.element.point = this)
                    }(d = h.halo) && d.size ? (x || (f.halo = x = w.renderer.path().add((this.graphic || r).parentGroup)), x[b ? "animate" : "attr"]({ d: this.haloPath(d.size) }), x.attr({ "class": "highcharts-halo highcharts-color-" + c(this.colorIndex, f.colorIndex) }), x.point = this, x.attr(n({ fill: this.color || f.color, "fill-opacity": d.opacity, zIndex: -1 }, d.attributes))) : x && x.point && x.point.haloPath && x.animate({ d: x.point.haloPath(0) });
                    this.state = a
                }
            },
            haloPath: function(a) {
                return this.series.chart.renderer.symbols.circle(Math.floor(this.plotX) -
                    a, this.plotY - a, 2 * a, 2 * a)
            }
        });
        n(k.prototype, {
            onMouseOver: function() {
                var a = this.chart,
                    b = a.hoverSeries;
                if (b && b !== this) b.onMouseOut();
                this.options.events.mouseOver && w(this, "mouseOver");
                this.setState("hover");
                a.hoverSeries = this
            },
            onMouseOut: function() {
                var a = this.options,
                    b = this.chart,
                    c = b.tooltip,
                    d = b.hoverPoint;
                b.hoverSeries = null;
                if (d) d.onMouseOut();
                this && a.events.mouseOut && w(this, "mouseOut");
                !c || this.stickyTracking || c.shared && !this.noSharedTooltip || c.hide();
                this.setState()
            },
            setState: function(a) {
                var b = this,
                    d = b.options,
                    e = b.graph,
                    f = d.states,
                    h = d.lineWidth,
                    d = 0;
                a = a || "";
                if (b.state !== a && (r([b.group, b.markerGroup, b.dataLabelsGroup], function(c) { c && (b.state && c.removeClass("highcharts-series-" + b.state), a && c.addClass("highcharts-series-" + a)) }), b.state = a, !f[a] || !1 !== f[a].enabled) && (a && (h = f[a].lineWidth || h + (f[a].lineWidthPlus || 0)), e && !e.dashstyle))
                    for (h = { "stroke-width": h }, e.animate(h, c(b.chart.options.chart.animation, f[a] && f[a].animation)); b["zone-graph-" + d];) b["zone-graph-" + d].attr(h), d += 1
            },
            setVisible: function(a,
                b) {
                var c = this,
                    d = c.chart,
                    e = c.legendItem,
                    f, h = d.options.chart.ignoreHiddenSeries,
                    k = c.visible;
                f = (c.visible = a = c.options.visible = c.userOptions.visible = void 0 === a ? !k : a) ? "show" : "hide";
                r(["group", "dataLabelsGroup", "markerGroup", "tracker", "tt"], function(a) { if (c[a]) c[a][f]() });
                if (d.hoverSeries === c || (d.hoverPoint && d.hoverPoint.series) === c) c.onMouseOut();
                e && d.legend.colorizeItem(c, a);
                c.isDirty = !0;
                c.options.stacking && r(d.series, function(a) { a.options.stacking && a.visible && (a.isDirty = !0) });
                r(c.linkedSeries, function(b) {
                    b.setVisible(a, !1)
                });
                h && (d.isDirtyBox = !0);
                !1 !== b && d.redraw();
                w(c, f)
            },
            show: function() { this.setVisible(!0) },
            hide: function() { this.setVisible(!1) },
            select: function(a) {
                this.selected = a = void 0 === a ? !this.selected : a;
                this.checkbox && (this.checkbox.checked = a);
                w(this, a ? "select" : "unselect")
            },
            drawTracker: I.drawTrackerGraph
        })
    })(M);
    (function(a) {
        var E = a.Chart,
            D = a.each,
            H = a.inArray,
            p = a.isArray,
            f = a.isObject,
            l = a.pick,
            r = a.splat;
        E.prototype.setResponsive = function(f) {
            var l = this.options.responsive,
                n = [],
                e = this.currentResponsive;
            l && l.rules &&
                D(l.rules, function(e) {
                    void 0 === e._id && (e._id = a.uniqueKey());
                    this.matchResponsiveRule(e, n, f)
                }, this);
            var h = a.merge.apply(0, a.map(n, function(e) { return a.find(l.rules, function(a) { return a._id === e }).chartOptions })),
                n = n.toString() || void 0;
            n !== (e && e.ruleIds) && (e && this.update(e.undoOptions, f), n ? (this.currentResponsive = { ruleIds: n, mergedOptions: h, undoOptions: this.currentOptions(h) }, this.update(h, f)) : this.currentResponsive = void 0)
        };
        E.prototype.matchResponsiveRule = function(a, f) {
            var n = a.condition;
            (n.callback ||
                function() { return this.chartWidth <= l(n.maxWidth, Number.MAX_VALUE) && this.chartHeight <= l(n.maxHeight, Number.MAX_VALUE) && this.chartWidth >= l(n.minWidth, 0) && this.chartHeight >= l(n.minHeight, 0) }).call(this) && f.push(a._id)
        };
        E.prototype.currentOptions = function(l) {
            function n(e, h, l, d) {
                var c;
                a.objectEach(e, function(a, e) {
                    if (!d && -1 < H(e, ["series", "xAxis", "yAxis"]))
                        for (a = r(a), l[e] = [], c = 0; c < a.length; c++) h[e][c] && (l[e][c] = {}, n(a[c], h[e][c], l[e][c], d + 1));
                    else f(a) ? (l[e] = p(a) ? [] : {}, n(a, h[e] || {}, l[e], d + 1)) : l[e] = h[e] ||
                        null
                })
            }
            var u = {};
            n(l, this.options, u, 0);
            return u
        }
    })(M);
    return M
});