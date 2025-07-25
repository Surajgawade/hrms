var ResponsiveBootstrapToolkit = function(e) {
    var t = {
            detectionDivs: { bootstrap: { xs: e('<div class="device-xs visible-xs visible-xs-block"></div>'), sm: e('<div class="device-sm visible-sm visible-sm-block"></div>'), md: e('<div class="device-md visible-md visible-md-block"></div>'), lg: e('<div class="device-lg visible-lg visible-lg-block"></div>') }, foundation: { small: e('<div class="device-xs show-for-small-only"></div>'), medium: e('<div class="device-sm show-for-medium-only"></div>'), large: e('<div class="device-md show-for-large-only"></div>'), xlarge: e('<div class="device-lg show-for-xlarge-only"></div>') } },
            applyDetectionDivs: function() { e(document).ready(function() { e.each(i.breakpoints, function(e) { i.breakpoints[e].appendTo(".responsive-bootstrap-toolkit") }) }) },
            isAnExpression: function(e) { return "<" == e.charAt(0) || ">" == e.charAt(0) },
            splitExpression: function(e) {
                var t = e.charAt(0),
                    i = "=" == e.charAt(1),
                    n = 1 + (i ? 1 : 0),
                    o = e.slice(n);
                return { operator: t, orEqual: i, breakpointName: o }
            },
            isAnyActive: function(t) { var n = !1; return e.each(t, function(e, t) { return i.breakpoints[t].is(":visible") ? (n = !0, !1) : void 0 }), n },
            isMatchingExpression: function(e) {
                var n = t.splitExpression(e),
                    o = Object.keys(i.breakpoints),
                    s = o.indexOf(n.breakpointName);
                if (-1 !== s) {
                    var r = 0,
                        a = 0;
                    "<" == n.operator && (r = 0, a = n.orEqual ? ++s : s), ">" == n.operator && (r = n.orEqual ? s : ++s, a = void 0);
                    var l = o.slice(r, a);
                    return t.isAnyActive(l)
                }
            }
        },
        i = { interval: 300, framework: null, breakpoints: null, is: function(e) { return t.isAnExpression(e) ? t.isMatchingExpression(e) : i.breakpoints[e] && i.breakpoints[e].is(":visible") }, use: function(e, n) { i.framework = e.toLowerCase(), i.breakpoints = "bootstrap" === i.framework || "foundation" === i.framework ? t.detectionDivs[i.framework] : n, t.applyDetectionDivs() }, current: function() { var t = "unrecognized"; return e.each(i.breakpoints, function(e) { i.is(e) && (t = e) }), t }, changed: function(e, t) { var n; return function() { clearTimeout(n), n = setTimeout(function() { e() }, t || i.interval) } } };
    return e(document).ready(function() { e('<div class="responsive-bootstrap-toolkit"></div>').appendTo("body") }), null === i.framework && i.use("bootstrap"), i
}(jQuery);
! function(e) {
    e.fn.clickoutside = function(e) {
        var t = 1,
            i = $(this);
        return i.cb = e, this.click(function() { t = 0 }), $(document).click(function() { t && i.cb(), t = 1 }), $(this)
    }
}(jQuery),
function(e) { "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e : e(jQuery) }(function(e) {
    function t(t) {
        var r = t || window.event,
            a = l.call(arguments, 1),
            c = 0,
            d = 0,
            p = 0,
            f = 0,
            h = 0,
            v = 0;
        if (t = e.event.fix(r), t.type = "mousewheel", "detail" in r && (p = r.detail * -1), "wheelDelta" in r && (p = r.wheelDelta), "wheelDeltaY" in r && (p = r.wheelDeltaY), "wheelDeltaX" in r && (d = r.wheelDeltaX * -1), "axis" in r && r.axis === r.HORIZONTAL_AXIS && (d = p * -1, p = 0), c = 0 === p ? d : p, "deltaY" in r && (p = r.deltaY * -1, c = p), "deltaX" in r && (d = r.deltaX, 0 === p && (c = d * -1)), 0 !== p || 0 !== d) {
            if (1 === r.deltaMode) {
                var g = e.data(this, "mousewheel-line-height");
                c *= g, p *= g, d *= g
            } else if (2 === r.deltaMode) {
                var m = e.data(this, "mousewheel-page-height");
                c *= m, p *= m, d *= m
            }
            if (f = Math.max(Math.abs(p), Math.abs(d)), (!s || f < s) && (s = f, n(r, f) && (s /= 40)), n(r, f) && (c /= 40, d /= 40, p /= 40), c = Math[c >= 1 ? "floor" : "ceil"](c / s), d = Math[d >= 1 ? "floor" : "ceil"](d / s), p = Math[p >= 1 ? "floor" : "ceil"](p / s), u.settings.normalizeOffset && this.getBoundingClientRect) {
                var j = this.getBoundingClientRect();
                h = t.clientX - j.left, v = t.clientY - j.top
            }
            return t.deltaX = d, t.deltaY = p, t.deltaFactor = s, t.offsetX = h, t.offsetY = v, t.deltaMode = 0, a.unshift(t, c, d, p), o && clearTimeout(o), o = setTimeout(i, 200), (e.event.dispatch || e.event.handle).apply(this, a)
        }
    }

    function i() { s = null }

    function n(e, t) { return u.settings.adjustOldDeltas && "mousewheel" === e.type && t % 120 === 0 }
    var o, s, r = ["wheel", "mousewheel", "DOMMouseScroll", "MozMousePixelScroll"],
        a = "onwheel" in document || document.documentMode >= 9 ? ["wheel"] : ["mousewheel", "DomMouseScroll", "MozMousePixelScroll"],
        l = Array.prototype.slice;
    if (e.event.fixHooks)
        for (var c = r.length; c;) e.event.fixHooks[r[--c]] = e.event.mouseHooks;
    var u = e.event.special.mousewheel = {
        version: "3.1.12",
        setup: function() {
            if (this.addEventListener)
                for (var i = a.length; i;) this.addEventListener(a[--i], t, !1);
            else this.onmousewheel = t;
            e.data(this, "mousewheel-line-height", u.getLineHeight(this)), e.data(this, "mousewheel-page-height", u.getPageHeight(this))
        },
        teardown: function() {
            if (this.removeEventListener)
                for (var i = a.length; i;) this.removeEventListener(a[--i], t, !1);
            else this.onmousewheel = null;
            e.removeData(this, "mousewheel-line-height"), e.removeData(this, "mousewheel-page-height")
        },
        getLineHeight: function(t) {
            var i = e(t),
                n = i["offsetParent" in e.fn ? "offsetParent" : "parent"]();
            return n.length || (n = e("body")), parseInt(n.css("fontSize"), 10) || parseInt(i.css("fontSize"), 10) || 16
        },
        getPageHeight: function(t) { return e(t).height() },
        settings: { adjustOldDeltas: !0, normalizeOffset: !0 }
    };
    e.fn.extend({ mousewheel: function(e) { return e ? this.bind("mousewheel", e) : this.trigger("mousewheel") }, unmousewheel: function(e) { return this.unbind("mousewheel", e) } })
}), ! function(e) { "function" == typeof define && define.amd ? define(["jquery"], e) : "object" == typeof exports ? module.exports = e(require("jquery")) : e(jQuery) }(function(e) {
    e.fn.jScrollPane = function(t) {
        function i(t, i) {
            function n(i) {
                var s, a, c, u, d, h, v = !1,
                    g = !1;
                if (I = i, void 0 === L) d = t.scrollTop(), h = t.scrollLeft(), t.css({ overflow: "hidden", padding: 0 }), O = t.innerWidth() + me, q = t.innerHeight(), t.width(O), L = e('<div class="jspPane" />').css("padding", ge).append(t.children()), F = e('<div class="jspContainer" />').css({ width: O + "px", height: q + "px" }).append(L).appendTo(t);
                else {
                    if (t.css("width", ""), v = I.stickToBottom && C(), g = I.stickToRight && B(), u = t.innerWidth() + me != O || t.outerHeight() != q, u && (O = t.innerWidth() + me, q = t.innerHeight(), F.css({ width: O + "px", height: q + "px" })), !u && je == N && L.outerHeight() == V) return void t.width(O);
                    je = N, L.css("width", ""), t.width(O), F.find(">.jspVerticalBar,>.jspHorizontalBar").remove().end()
                }
                L.css("overflow", "auto"), N = i.contentWidth ? i.contentWidth : L[0].scrollWidth, V = L[0].scrollHeight, L.css("overflow", ""), G = N / O, Q = V / q, $ = Q > 1, K = G > 1, K || $ ? (t.addClass("jspScrollable"), s = I.maintainPosition && (_ || te), s && (a = D(), c = T()), o(), r(), l(), s && (y(g ? N - O : a, !1), k(v ? V - q : c, !1)), S(), A(), E(), I.enableKeyboardNavigation && Y(), I.clickOnTrack && p(), z(), I.hijackInternalLinks && W()) : (t.removeClass("jspScrollable"), L.css({ top: 0, left: 0, width: F.width() - me }), H(), P(), X(), f()), I.autoReinitialise && !ve ? ve = setInterval(function() { n(I) }, I.autoReinitialiseDelay) : !I.autoReinitialise && ve && clearInterval(ve), d && t.scrollTop(0) && k(d, !1), h && t.scrollLeft(0) && y(h, !1), t.trigger("jsp-initialised", [K || $])
            }

            function o() { $ && (F.append(e('<div class="jspVerticalBar" />').append(e('<div class="jspCap jspCapTop" />'), e('<div class="jspTrack" />').append(e('<div class="jspDrag" />').append(e('<div class="jspDragTop" />'), e('<div class="jspDragBottom" />'))), e('<div class="jspCap jspCapBottom" />'))), ie = F.find(">.jspVerticalBar"), ne = ie.find(">.jspTrack"), U = ne.find(">.jspDrag"), I.showArrows && (ae = e('<a class="jspArrow jspArrowUp" />').bind("mousedown.jsp", u(0, -1)).bind("click.jsp", M), le = e('<a class="jspArrow jspArrowDown" />').bind("mousedown.jsp", u(0, 1)).bind("click.jsp", M), I.arrowScrollOnHover && (ae.bind("mouseover.jsp", u(0, -1, ae)), le.bind("mouseover.jsp", u(0, 1, le))), c(ne, I.verticalArrowPositions, ae, le)), se = q, F.find(">.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow").each(function() { se -= e(this).outerHeight() }), U.hover(function() { U.addClass("jspHover") }, function() { U.removeClass("jspHover") }).bind("mousedown.jsp", function(t) { e("html").bind("dragstart.jsp selectstart.jsp", M), U.addClass("jspActive"); var i = t.pageY - U.position().top; return e("html").bind("mousemove.jsp", function(e) { v(e.pageY - i, !1) }).bind("mouseup.jsp mouseleave.jsp", h), !1 }), s()) }

            function s() { ne.height(se + "px"), _ = 0, oe = I.verticalGutter + ne.outerWidth(), L.width(O - oe - me); try { 0 === ie.position().left && L.css("margin-left", oe + "px") } catch (e) {} }

            function r() { K && (F.append(e('<div class="jspHorizontalBar" />').append(e('<div class="jspCap jspCapLeft" />'), e('<div class="jspTrack" />').append(e('<div class="jspDrag" />').append(e('<div class="jspDragLeft" />'), e('<div class="jspDragRight" />'))), e('<div class="jspCap jspCapRight" />'))), ce = F.find(">.jspHorizontalBar"), ue = ce.find(">.jspTrack"), J = ue.find(">.jspDrag"), I.showArrows && (fe = e('<a class="jspArrow jspArrowLeft" />').bind("mousedown.jsp", u(-1, 0)).bind("click.jsp", M), he = e('<a class="jspArrow jspArrowRight" />').bind("mousedown.jsp", u(1, 0)).bind("click.jsp", M), I.arrowScrollOnHover && (fe.bind("mouseover.jsp", u(-1, 0, fe)), he.bind("mouseover.jsp", u(1, 0, he))), c(ue, I.horizontalArrowPositions, fe, he)), J.hover(function() { J.addClass("jspHover") }, function() { J.removeClass("jspHover") }).bind("mousedown.jsp", function(t) { e("html").bind("dragstart.jsp selectstart.jsp", M), J.addClass("jspActive"); var i = t.pageX - J.position().left; return e("html").bind("mousemove.jsp", function(e) { m(e.pageX - i, !1) }).bind("mouseup.jsp mouseleave.jsp", h), !1 }), de = F.innerWidth(), a()) }

            function a() { F.find(">.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow").each(function() { de -= e(this).outerWidth() }), ue.width(de + "px"), te = 0 }

            function l() {
                if (K && $) {
                    var t = ue.outerHeight(),
                        i = ne.outerWidth();
                    se -= t, e(ce).find(">.jspCap:visible,>.jspArrow").each(function() { de += e(this).outerWidth() }), de -= i, q -= i, O -= t, ue.parent().append(e('<div class="jspCorner" />').css("width", t + "px")), s(), a()
                }
                K && L.width(F.outerWidth() - me + "px"), V = L.outerHeight(), Q = V / q, K && (pe = Math.ceil(1 / G * de), pe > I.horizontalDragMaxWidth ? pe = I.horizontalDragMaxWidth : pe < I.horizontalDragMinWidth && (pe = I.horizontalDragMinWidth), J.width(pe + "px"), ee = de - pe, j(te)), $ && (re = Math.ceil(1 / Q * se), re > I.verticalDragMaxHeight ? re = I.verticalDragMaxHeight : re < I.verticalDragMinHeight && (re = I.verticalDragMinHeight), U.height(re + "px"), Z = se - re, g(_))
            }

            function c(e, t, i, n) {
                var o, s = "before",
                    r = "after";
                "os" == t && (t = /Mac/.test(navigator.platform) ? "after" : "split"), t == s ? r = t : t == r && (s = t, o = i, i = n, n = o), e[s](i)[r](n)
            }

            function u(e, t, i) { return function() { return d(e, t, this, i), this.blur(), !1 } }

            function d(t, i, n, o) {
                n = e(n).addClass("jspActive");
                var s, r, a = !0,
                    l = function() { 0 !== t && be.scrollByX(t * I.arrowButtonSpeed), 0 !== i && be.scrollByY(i * I.arrowButtonSpeed), r = setTimeout(l, a ? I.initialDelay : I.arrowRepeatFreq), a = !1 };
                l(), s = o ? "mouseout.jsp" : "mouseup.jsp", o = o || e("html"), o.bind(s, function() { n.removeClass("jspActive"), r && clearTimeout(r), r = null, o.unbind(s) })
            }

            function p() {
                f(), $ && ne.bind("mousedown.jsp", function(t) {
                    if (void 0 === t.originalTarget || t.originalTarget == t.currentTarget) {
                        var i, n = e(this),
                            o = n.offset(),
                            s = t.pageY - o.top - _,
                            r = !0,
                            a = function() {
                                var e = n.offset(),
                                    o = t.pageY - e.top - re / 2,
                                    c = q * I.scrollPagePercent,
                                    u = Z * c / (V - q);
                                if (0 > s) _ - u > o ? be.scrollByY(-c) : v(o);
                                else {
                                    if (!(s > 0)) return void l();
                                    o > _ + u ? be.scrollByY(c) : v(o)
                                }
                                i = setTimeout(a, r ? I.initialDelay : I.trackClickRepeatFreq), r = !1
                            },
                            l = function() { i && clearTimeout(i), i = null, e(document).unbind("mouseup.jsp", l) };
                        return a(), e(document).bind("mouseup.jsp", l), !1
                    }
                }), K && ue.bind("mousedown.jsp", function(t) {
                    if (void 0 === t.originalTarget || t.originalTarget == t.currentTarget) {
                        var i, n = e(this),
                            o = n.offset(),
                            s = t.pageX - o.left - te,
                            r = !0,
                            a = function() {
                                var e = n.offset(),
                                    o = t.pageX - e.left - pe / 2,
                                    c = O * I.scrollPagePercent,
                                    u = ee * c / (N - O);
                                if (0 > s) te - u > o ? be.scrollByX(-c) : m(o);
                                else {
                                    if (!(s > 0)) return void l();
                                    o > te + u ? be.scrollByX(c) : m(o)
                                }
                                i = setTimeout(a, r ? I.initialDelay : I.trackClickRepeatFreq), r = !1
                            },
                            l = function() { i && clearTimeout(i), i = null, e(document).unbind("mouseup.jsp", l) };
                        return a(), e(document).bind("mouseup.jsp", l), !1
                    }
                })
            }

            function f() { ue && ue.unbind("mousedown.jsp"), ne && ne.unbind("mousedown.jsp") }

            function h() { e("html").unbind("dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp"), U && U.removeClass("jspActive"), J && J.removeClass("jspActive") }

            function v(i, n) {
                if ($) {
                    0 > i ? i = 0 : i > Z && (i = Z);
                    var o = new e.Event("jsp-will-scroll-y");
                    if (t.trigger(o, [i]), !o.isDefaultPrevented()) {
                        var s = i || 0,
                            r = 0 === s,
                            a = s == Z,
                            l = i / Z,
                            c = -l * (V - q);
                        void 0 === n && (n = I.animateScroll), n ? be.animate(U, "top", i, g, function() { t.trigger("jsp-user-scroll-y", [-c, r, a]) }) : (U.css("top", i), g(i), t.trigger("jsp-user-scroll-y", [-c, r, a]))
                    }
                }
            }

            function g(e) {
                void 0 === e && (e = U.position().top), F.scrollTop(0), _ = e || 0;
                var i = 0 === _,
                    n = _ == Z,
                    o = e / Z,
                    s = -o * (V - q);
                (we != i || ye != n) && (we = i, ye = n, t.trigger("jsp-arrow-change", [we, ye, ke, xe])), b(i, n), L.css("top", s), t.trigger("jsp-scroll-y", [-s, i, n]).trigger("scroll")
            }

            function m(i, n) {
                if (K) {
                    0 > i ? i = 0 : i > ee && (i = ee);
                    var o = new e.Event("jsp-will-scroll-x");
                    if (t.trigger(o, [i]), !o.isDefaultPrevented()) {
                        var s = i || 0,
                            r = 0 === s,
                            a = s == ee,
                            l = i / ee,
                            c = -l * (N - O);
                        void 0 === n && (n = I.animateScroll), n ? be.animate(J, "left", i, j, function() { t.trigger("jsp-user-scroll-x", [-c, r, a]) }) : (J.css("left", i), j(i), t.trigger("jsp-user-scroll-x", [-c, r, a]))
                    }
                }
            }

            function j(e) {
                void 0 === e && (e = J.position().left), F.scrollTop(0), te = e || 0;
                var i = 0 === te,
                    n = te == ee,
                    o = e / ee,
                    s = -o * (N - O);
                (ke != i || xe != n) && (ke = i, xe = n, t.trigger("jsp-arrow-change", [we, ye, ke, xe])), w(i, n), L.css("left", s), t.trigger("jsp-scroll-x", [-s, i, n]).trigger("scroll")
            }

            function b(e, t) { I.showArrows && (ae[e ? "addClass" : "removeClass"]("jspDisabled"), le[t ? "addClass" : "removeClass"]("jspDisabled")) }

            function w(e, t) { I.showArrows && (fe[e ? "addClass" : "removeClass"]("jspDisabled"), he[t ? "addClass" : "removeClass"]("jspDisabled")) }

            function k(e, t) {
                var i = e / (V - q);
                v(i * Z, t)
            }

            function y(e, t) {
                var i = e / (N - O);
                m(i * ee, t)
            }

            function x(t, i, n) {
                var o, s, r, a, l, c, u, d, p, f = 0,
                    h = 0;
                try { o = e(t) } catch (v) { return }
                for (s = o.outerHeight(), r = o.outerWidth(), F.scrollTop(0), F.scrollLeft(0); !o.is(".jspPane");)
                    if (f += o.position().top, h += o.position().left, o = o.offsetParent(), /^body|html$/i.test(o[0].nodeName)) return;
                a = T(), c = a + q, a > f || i ? d = f - I.horizontalGutter : f + s > c && (d = f - q + s + I.horizontalGutter), isNaN(d) || k(d, n), l = D(), u = l + O, l > h || i ? p = h - I.horizontalGutter : h + r > u && (p = h - O + r + I.horizontalGutter), isNaN(p) || y(p, n)
            }

            function D() { return -L.position().left }

            function T() { return -L.position().top }

            function C() { var e = V - q; return e > 20 && e - T() < 10 }

            function B() { var e = N - O; return e > 20 && e - D() < 10 }

            function A() {
                F.unbind(Te).bind(Te, function(e, t, i, n) {
                    te || (te = 0), _ || (_ = 0);
                    var o = te,
                        s = _,
                        r = e.deltaFactor || I.mouseWheelSpeed;
                    return be.scrollBy(i * r, -n * r, !1), o == te && s == _
                })
            }

            function H() { F.unbind(Te) }

            function M() { return !1 }

            function S() { L.find(":input,a").unbind("focus.jsp").bind("focus.jsp", function(e) { x(e.target, !1) }) }

            function P() { L.find(":input,a").unbind("focus.jsp") }

            function Y() {
                function i() {
                    var e = te,
                        t = _;
                    switch (n) {
                        case 40:
                            be.scrollByY(I.keyboardSpeed, !1);
                            break;
                        case 38:
                            be.scrollByY(-I.keyboardSpeed, !1);
                            break;
                        case 34:
                        case 32:
                            be.scrollByY(q * I.scrollPagePercent, !1);
                            break;
                        case 33:
                            be.scrollByY(-q * I.scrollPagePercent, !1);
                            break;
                        case 39:
                            be.scrollByX(I.keyboardSpeed, !1);
                            break;
                        case 37:
                            be.scrollByX(-I.keyboardSpeed, !1)
                    }
                    return o = e != te || t != _
                }
                var n, o, s = [];
                K && s.push(ce[0]), $ && s.push(ie[0]), L.bind("focus.jsp", function() { t.focus() }), t.attr("tabindex", 0).unbind("keydown.jsp keypress.jsp").bind("keydown.jsp", function(t) {
                    if (t.target === this || s.length && e(t.target).closest(s).length) {
                        var r = te,
                            a = _;
                        switch (t.keyCode) {
                            case 40:
                            case 38:
                            case 34:
                            case 32:
                            case 33:
                            case 39:
                            case 37:
                                n = t.keyCode, i();
                                break;
                            case 35:
                                k(V - q), n = null;
                                break;
                            case 36:
                                k(0), n = null
                        }
                        return o = t.keyCode == n && r != te || a != _, !o
                    }
                }).bind("keypress.jsp", function(t) { return t.keyCode == n && i(), t.target === this || s.length && e(t.target).closest(s).length ? !o : void 0 }), I.hideFocus ? (t.css("outline", "none"), "hideFocus" in F[0] && t.attr("hideFocus", !0)) : (t.css("outline", ""), "hideFocus" in F[0] && t.attr("hideFocus", !1))
            }

            function X() { t.attr("tabindex", "-1").removeAttr("tabindex").unbind("keydown.jsp keypress.jsp"), L.unbind(".jsp") }

            function z() {
                if (location.hash && location.hash.length > 1) {
                    var t, i, n = escape(location.hash.substr(1));
                    try { t = e("#" + n + ', a[name="' + n + '"]') } catch (o) { return }
                    t.length && L.find(n) && (0 === F.scrollTop() ? i = setInterval(function() { F.scrollTop() > 0 && (x(t, !0), e(document).scrollTop(F.position().top), clearInterval(i)) }, 50) : (x(t, !0), e(document).scrollTop(F.position().top)))
                }
            }

            function W() {
                e(document.body).data("jspHijack") || (e(document.body).data("jspHijack", !0), e(document.body).delegate('a[href*="#"]', "click", function(t) {
                    var i, n, o, s, r, a, l = this.href.substr(0, this.href.indexOf("#")),
                        c = location.href;
                    if (-1 !== location.href.indexOf("#") && (c = location.href.substr(0, location.href.indexOf("#"))), l === c) {
                        i = escape(this.href.substr(this.href.indexOf("#") + 1));
                        try { n = e("#" + i + ', a[name="' + i + '"]') } catch (u) { return }
                        n.length && (o = n.closest(".jspScrollable"), s = o.data("jsp"), s.scrollToElement(n, !0), o[0].scrollIntoView && (r = e(window).scrollTop(), a = n.offset().top, (r > a || a > r + e(window).height()) && o[0].scrollIntoView()), t.preventDefault())
                    }
                }))
            }

            function E() {
                var e, t, i, n, o, s = !1;
                F.unbind("touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick").bind("touchstart.jsp", function(r) {
                    var a = r.originalEvent.touches[0];
                    e = D(), t = T(), i = a.pageX, n = a.pageY, o = !1, s = !0
                }).bind("touchmove.jsp", function(r) {
                    if (s) {
                        var a = r.originalEvent.touches[0],
                            l = te,
                            c = _;
                        return be.scrollTo(e + i - a.pageX, t + n - a.pageY), o = o || Math.abs(i - a.pageX) > 5 || Math.abs(n - a.pageY) > 5, l == te && c == _
                    }
                }).bind("touchend.jsp", function() { s = !1 }).bind("click.jsp-touchclick", function() { return o ? (o = !1, !1) : void 0 })
            }

            function R() {
                var e = T(),
                    i = D();
                t.removeClass("jspScrollable").unbind(".jsp"), L.unbind(".jsp"), t.replaceWith(De.append(L.children())), De.scrollTop(e), De.scrollLeft(i), ve && clearInterval(ve)
            }
            var I, L, O, q, F, N, V, G, Q, $, K, U, Z, _, J, ee, te, ie, ne, oe, se, re, ae, le, ce, ue, de, pe, fe, he, ve, ge, me, je, be = this,
                we = !0,
                ke = !0,
                ye = !1,
                xe = !1,
                De = t.clone(!1, !1).empty(),
                Te = e.fn.mwheelIntent ? "mwheelIntent.jsp" : "mousewheel.jsp";
            "border-box" === t.css("box-sizing") ? (ge = 0, me = 0) : (ge = t.css("paddingTop") + " " + t.css("paddingRight") + " " + t.css("paddingBottom") + " " + t.css("paddingLeft"), me = (parseInt(t.css("paddingLeft"), 10) || 0) + (parseInt(t.css("paddingRight"), 10) || 0)), e.extend(be, {
                reinitialise: function(t) { t = e.extend({}, I, t), n(t) },
                scrollToElement: function(e, t, i) { x(e, t, i) },
                scrollTo: function(e, t, i) { y(e, i), k(t, i) },
                scrollToX: function(e, t) { y(e, t) },
                scrollToY: function(e, t) { k(e, t) },
                scrollToPercentX: function(e, t) { y(e * (N - O), t) },
                scrollToPercentY: function(e, t) { k(e * (V - q), t) },
                scrollBy: function(e, t, i) { be.scrollByX(e, i), be.scrollByY(t, i) },
                scrollByX: function(e, t) {
                    var i = D() + Math[0 > e ? "floor" : "ceil"](e),
                        n = i / (N - O);
                    m(n * ee, t)
                },
                scrollByY: function(e, t) {
                    var i = T() + Math[0 > e ? "floor" : "ceil"](e),
                        n = i / (V - q);
                    v(n * Z, t)
                },
                positionDragX: function(e, t) { m(e, t) },
                positionDragY: function(e, t) { v(e, t) },
                animate: function(e, t, i, n, o) {
                    var s = {};
                    s[t] = i, e.animate(s, { duration: I.animateDuration, easing: I.animateEase, queue: !1, step: n, complete: o })
                },
                getContentPositionX: function() { return D() },
                getContentPositionY: function() { return T() },
                getContentWidth: function() { return N },
                getContentHeight: function() { return V },
                getPercentScrolledX: function() { return D() / (N - O) },
                getPercentScrolledY: function() { return T() / (V - q) },
                getIsScrollableH: function() { return K },
                getIsScrollableV: function() { return $ },
                getContentPane: function() { return L },
                scrollToBottom: function(e) { v(Z, e) },
                hijackInternalLinks: e.noop,
                destroy: function() { R() }
            }), n(i)
        }
        return t = e.extend({}, e.fn.jScrollPane.defaults, t), e.each(["arrowButtonSpeed", "trackClickSpeed", "keyboardSpeed"], function() { t[this] = t[this] || t.speed }), this.each(function() {
            var n = e(this),
                o = n.data("jsp");
            o ? o.reinitialise(t) : (e("script", n).filter('[type="text/javascript"],:not([type])').remove(), o = new i(n, t), n.data("jsp", o))
        })
    }, e.fn.jScrollPane.defaults = { showArrows: !1, maintainPosition: !0, stickToBottom: !1, stickToRight: !1, clickOnTrack: !0, autoReinitialise: !1, autoReinitialiseDelay: 500, verticalDragMinHeight: 0, verticalDragMaxHeight: 99999, horizontalDragMinWidth: 0, horizontalDragMaxWidth: 99999, contentWidth: void 0, animateScroll: !1, animateDuration: 300, animateEase: "linear", hijackInternalLinks: !1, verticalGutter: 4, horizontalGutter: 4, mouseWheelSpeed: 3, arrowButtonSpeed: 0, arrowRepeatFreq: 50, arrowScrollOnHover: !1, trackClickSpeed: 0, trackClickRepeatFreq: 70, verticalArrowPositions: "split", horizontalArrowPositions: "split", enableKeyboardNavigation: !0, hideFocus: !1, keyboardSpeed: 0, initialDelay: 300, speed: 30, scrollPagePercent: .8 }
});