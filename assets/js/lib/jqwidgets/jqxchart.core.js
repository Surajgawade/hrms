/*
jQWidgets v5.5.0 (2017-Dec)
Copyright (c) 2011-2017 jQWidgets.
License: https://jqwidgets.com/license/
*/
(function(a) {
    a.jqx.jqxWidget("jqxChart", "", {});
    a.extend(a.jqx._jqxChart.prototype, {
        defineInstance: function() {
            a.extend(true, this, this._defaultSettings);
            this._createColorsCache();
            return this._defaultSettings
        },
        _defaultSettings: {
            title: "Title",
            description: "Description",
            source: [],
            seriesGroups: [],
            categoryAxis: null,
            xAxis: {},
            valueAxis: null,
            renderEngine: "",
            enableAnimations: true,
            enableAxisTextAnimation: false,
            backgroundImage: "",
            background: "#FFFFFF",
            padding: {
                left: 5,
                top: 5,
                right: 5,
                bottom: 5
            },
            backgroundColor: "#FFFFFF",
            showBorderLine: true,
            borderLineWidth: 1,
            borderLineColor: null,
            borderColor: null,
            titlePadding: {
                left: 5,
                top: 5,
                right: 5,
                bottom: 10
            },
            showLegend: true,
            legendLayout: null,
            enabled: true,
            colorScheme: "scheme01",
            animationDuration: 500,
            showToolTips: true,
            toolTipShowDelay: 500,
            toolTipDelay: 500,
            toolTipHideDelay: 4000,
            toolTipMoveDuration: 300,
            toolTipFormatFunction: null,
            toolTipAlignment: "dataPoint",
            localization: null,
            columnSeriesOverlap: false,
            rtl: false,
            legendPosition: null,
            greyScale: false,
            axisPadding: 5,
            enableCrosshairs: false,
            crosshairsColor: "#BCBCBC",
            crosshairsDashStyle: "2,2",
            crosshairsLineWidth: 1,
            enableEvents: true,
            _itemsToggleState: [],
            _isToggleRefresh: false,
            _isSelectorRefresh: false,
            _sliders: [],
            _selectorRange: [],
            _rangeSelectorInstances: {},
            _resizeState: {},
            renderer: null,
            _isRangeSelectorInstance: false,
            drawBefore: null,
            draw: null,
            _renderData: {},
            enableSampling: true
        },
        _defaultLineColor: "#BCBCBC",
        _touchEvents: {
            mousedown: a.jqx.mobile.getTouchEventName("touchstart"),
            click: a.jqx.mobile.getTouchEventName("touchstart"),
            mouseup: a.jqx.mobile.getTouchEventName("touchend"),
            mousemove: a.jqx.mobile.getTouchEventName("touchmove"),
            mouseenter: "mouseenter",
            mouseleave: "mouseleave"
        },
        _getEvent: function(b) {
            if (this._isTouchDevice) {
                return this._touchEvents[b]
            } else {
                return b
            }
        },
        destroy: function() {
            this.host.remove()
        },
        _jqxPlot: null,
        createInstance: function(d) {
            if (!a.jqx.dataAdapter) {
                throw "jqxdata.js is not loaded"
            }
            var c = this;
            c._refreshOnDownloadComlete();
            c._isTouchDevice = a.jqx.mobile.isTouchDevice();
            if (!c._jqxPlot) {
                c._jqxPlot = new jqxPlot()
            }
            c.addHandler(c.host, c._getEvent("mousemove"), function(g) {
                if (c.enabled == false) {
                    return
                }
                if (!c._isRangeSelectorInstance) {
                    c.host.css("cursor", "default")
                }
                var f = g.pageX || g.clientX || g.screenX;
                var j = g.pageY || g.clientY || g.screenY;
                var i = c.host.offset();
                if (c._isTouchDevice) {
                    var h = a.jqx.position(g);
                    f = h.left;
                    j = h.top
                }
                f -= i.left;
                j -= i.top;
                c.onmousemove(f, j)
            });
            c.addHandler(c.host, c._getEvent("mouseleave"), function(h) {
                if (c.enabled == false) {
                    return
                }
                var f = c._mouseX;
                var i = c._mouseY;
                var g = c._plotRect;
                if (g && f >= g.x && f <= g.x + g.width && i >= g.y && i <= g.y + g.height) {
                    return
                }
                c._cancelTooltipTimer();
                c._hideToolTip(0);
                c._unselect()
            });
            c.addHandler(c.host, "click", function(g) {
                if (c.enabled == false) {
                    return
                }
                var f = g.pageX || g.clientX || g.screenX;
                var j = g.pageY || g.clientY || g.screenY;
                var i = c.host.offset();
                if (c._isTouchDevice) {
                    var h = a.jqx.position(g);
                    f = h.left;
                    j = h.top
                }
                f -= i.left;
                j -= i.top;
                c._mouseX = f;
                c._mouseY = j;
                if (!isNaN(c._lastClickTs)) {
                    if ((new Date()).valueOf() - c._lastClickTs < 100) {
                        return
                    }
                }
                this._hostClickTimer = setTimeout(function() {
                    if (!c._isTouchDevice) {
                        c._cancelTooltipTimer();
                        c._hideToolTip();
                        c._unselect()
                    }
                    if (c._pointMarker && c._pointMarker.element) {
                        var l = c.seriesGroups[c._pointMarker.gidx];
                        var k = l.series[c._pointMarker.sidx];
                        g.stopImmediatePropagation();
                        c._raiseItemEvent("click", l, k, c._pointMarker.iidx)
                    }
                }, 100)
            });
            var e = c.element.style;
            if (e) {
                var b = false;
                if (e.width != null) {
                    b |= e.width.toString().indexOf("%") != -1
                }
                if (e.height != null) {
                    b |= e.height.toString().indexOf("%") != -1
                }
                if (b) {
                    a.jqx.utilities.resize(this.host, function() {
                        if (c.timer) {
                            clearTimeout(c.timer)
                        }
                        var f = 1;
                        c.timer = setTimeout(function() {
                            var g = c.enableAnimations;
                            c.enableAnimations = false;
                            c.refresh();
                            c.enableAnimations = g
                        }, f)
                    }, false, true)
                }
            }
        },
        _refreshOnDownloadComlete: function() {
            var d = this;
            var e = this.source;
            if (e instanceof a.jqx.dataAdapter) {
                var f = e._options;
                if (f == undefined || (f != undefined && !f.autoBind)) {
                    e.autoSync = false;
                    e.dataBind()
                }
                var c = this.element.id;
                if (e.records.length == 0) {
                    var b = function() {
                        if (d.ready) {
                            d.ready()
                        }
                        d.refresh()
                    };
                    e.unbindDownloadComplete(c);
                    e.bindDownloadComplete(c, b)
                } else {
                    if (d.ready) {
                        d.ready()
                    }
                }
                e.unbindBindingUpdate(c);
                e.bindBindingUpdate(c, function() {
                    if (d._supressBindingRefresh) {
                        return
                    }
                    d.refresh()
                })
            }
        },
        propertyChangedHandler: function(b, c, e, d) {
            if (this.isInitialized == undefined || this.isInitialized == false) {
                return
            }
            if (c == "source") {
                this._refreshOnDownloadComlete()
            }
            this.refresh()
        },
        _initRenderer: function(b) {
            if (!a.jqx.createRenderer) {
                throw "Please include jqxdraw.js"
            }
            return a.jqx.createRenderer(this, b)
        },
        _internalRefresh: function() {
            var b = this;
            if (a.jqx.isHidden(b.host)) {
                return
            }
            b._stopAnimations();
            if (!b.renderer || (!b._isToggleRefresh && !b._isUpdate)) {
                b._hideToolTip(0);
                b._isVML = false;
                b.host.empty();
                b._measureDiv = undefined;
                b._initRenderer(b.host)
            }
            var d = b.renderer;
            if (!d) {
                return
            }
            var c = d.getRect();
            b._render({
                x: 1,
                y: 1,
                width: c.width,
                height: c.height
            });
            this._raiseEvent("refreshBegin", {
                instance: this
            });
            if (d instanceof a.jqx.HTML5Renderer) {
                d.refresh()
            }
            b._isUpdate = false;
            this._raiseEvent("refreshEnd", {
                instance: this
            })
        },
        saveAsPNG: function(d, b, c) {
            return this._saveAsImage("png", d, b, c)
        },
        saveAsJPEG: function(d, b, c) {
            return this._saveAsImage("jpeg", d, b, c)
        },
        saveAsPDF: function(d, b, c) {
            return this._saveAsImage("pdf", d, b, c)
        },
        _saveAsImage: function(e, h, b, c) {
            var g = false;
            for (var d = 0; d < this.seriesGroups.length && !g; d++) {
                var f = this._getXAxis(d);
                if (f && f.rangeSelector) {
                    g = true
                }
            }
            return a.jqx._widgetToImage(this, e, h, b, c, g ? this._selectorSaveAsImageCallback : undefined)
        },
        _selectorSaveAsImageCallback: function(D, h) {
            var r = D;
            for (var B = 0; B < r.seriesGroups.length; B++) {
                var o = r._getXAxis(B);
                if (!o || !o.rangeSelector || o.rangeSelector.renderTo) {
                    continue
                }
                var m = r._rangeSelectorInstances[B];
                if (!m) {
                    continue
                }
                var s = m.jqxChart("getInstance");
                var e = s.renderEngine;
                var d = s.renderer.getRect();
                var f = s.renderer.getContainer().find("canvas")[0];
                var p = f.getContext("2d");
                var w = r._sliders[B];
                var b = r.seriesGroups[B].orientation == "horizontal";
                var c = !b ? "width" : "height";
                var v = b ? "width" : "height";
                var A = !b ? "x" : "y";
                var g = b ? "x" : "y";
                var k = {};
                k[A] = w.startOffset + w.rect[A];
                k[g] = w.rect[g];
                k[c] = w.endOffset - w.startOffset;
                k[v] = w.rect[v];
                var n = o.rangeSelector.colorSelectedRange || "blue";
                var u = o.rangeSelector.colorUnselectedRange || "white";
                var l = o.rangeSelector.colorRangeLine || "grey";
                var q = [];
                q.push(s.renderer.rect(k.x, k.y, k.width, k.height, {
                    fill: n,
                    opacity: 0.1
                }));
                if (!b) {
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(k.x), a.jqx._ptrnd(w.rect.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(k.x + k.width), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(w.rect.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(k.x), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(k.x), a.jqx._ptrnd(w.rect.y + w.rect.height), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(k.x + k.width), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(k.x + k.width), a.jqx._ptrnd(w.rect.y + w.rect.height), {
                        stroke: l,
                        opacity: 0.5
                    }))
                } else {
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(w.rect.y), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y + k.height), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(w.rect.y + w.rect.height), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x), a.jqx._ptrnd(k.y), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y), {
                        stroke: l,
                        opacity: 0.5
                    }));
                    q.push(s.renderer.line(a.jqx._ptrnd(w.rect.x), a.jqx._ptrnd(k.y + k.height), a.jqx._ptrnd(w.rect.x + w.rect.width), a.jqx._ptrnd(k.y + k.height), {
                        stroke: l,
                        opacity: 0.5
                    }))
                }
                s.renderer.refresh();
                var t = p.getImageData(d.x, d.y, d.width, d.height);
                var C = h.getContext("2d");
                C.putImageData(t, parseInt(m.css("left")), parseInt(m.css("top")), 1, 1, d.width, d.height);
                for (var z = 0; z < q.length; z++) {
                    s.renderer.removeElement(q[z])
                }
                s.renderer.refresh()
            }
            return true
        },
        refresh: function() {
            this._internalRefresh()
        },
        update: function() {
            this._isUpdate = true;
            this._internalRefresh()
        },
        _seriesTypes: ["line", "stackedline", "stackedline100", "spline", "stackedspline", "stackedspline100", "stepline", "stackedstepline", "stackedstepline100", "area", "stackedarea", "stackedarea100", "splinearea", "stackedsplinearea", "stackedsplinearea100", "steparea", "stackedsteparea", "stackedsteparea100", "rangearea", "splinerangearea", "steprangearea", "column", "stackedcolumn", "stackedcolumn100", "rangecolumn", "scatter", "stackedscatter", "stackedscatter100", "bubble", "stackedbubble", "stackedbubble100", "pie", "donut", "candlestick", "ohlc", "waterfall", "stackedwaterfall"],
        clear: function() {
            var b = this;
            for (var c in b._defaultSettings) {
                b[c] = b._defaultSettings[c]
            }
            b.title = "";
            b.description = "";
            b.refresh()
        },
        _validateSeriesGroups: function() {
            if (!a.isArray(this.seriesGroups)) {
                throw "Invalid property: 'seriesGroups' property is required and must be a valid array."
            }
            for (var b = 0; b < this.seriesGroups.length; b++) {
                var c = this.seriesGroups[b];
                if (!c.type) {
                    throw "Invalid property: Each series group must have a valid 'type' property."
                }
                if (!a.isArray(c.series)) {
                    throw "Invalid property: Each series group must have a 'series' property which must be a valid array."
                }
            }
        },
        _render: function(C) {
            var m = this;
            var I = m.renderer;
            m._validateSeriesGroups();
            m._colorsCache.clear();
            if (!m._isToggleRefresh && m._isUpdate && m._renderData) {
                m._renderDataClone()
            }
            m._renderData = [];
            I.clear();
            m._unselect();
            m._hideToolTip(0);
            var n = m.backgroundImage;
            if (n == undefined || n == "") {
                m.host.css({
                    "background-image": ""
                })
            } else {
                m.host.css({
                    "background-image": (n.indexOf("(") != -1 ? n : "url('" + n + "')")
                })
            }
            m._rect = C;
            var Y = m.padding || {
                left: 5,
                top: 5,
                right: 5,
                bottom: 5
            };
            var q = I.createClipRect(C);
            var L = I.beginGroup();
            I.setClip(L, q);
            var ai = I.rect(C.x, C.y, C.width - 2, C.height - 2);
            if (n == undefined || n == "") {
                I.attr(ai, {
                    fill: m.backgroundColor || m.background || "white"
                })
            } else {
                I.attr(ai, {
                    fill: "transparent"
                })
            }
            if (m.showBorderLine != false) {
                var F = m.borderLineColor == undefined ? m.borderColor : m.borderLineColor;
                if (F == undefined) {
                    F = m._defaultLineColor
                }
                var o = this.borderLineWidth;
                if (isNaN(o) || o < 0 || o > 10) {
                    o = 1
                }
                I.attr(ai, {
                    "stroke-width": o,
                    stroke: F
                })
            } else {
                if (a.jqx.browser.msie && a.jqx.browser.version < 9) {
                    I.attr(ai, {
                        "stroke-width": 1,
                        stroke: m.backgroundColor || "white"
                    })
                }
            }
            if (a.isFunction(m.drawBefore)) {
                m.drawBefore(I, C)
            }
            var V = {
                x: Y.left,
                y: Y.top,
                width: C.width - Y.left - Y.right,
                height: C.height - Y.top - Y.bottom
            };
            m._paddedRect = V;
            var e = m.titlePadding || {
                left: 2,
                top: 2,
                right: 2,
                bottom: 2
            };
            var l;
            if (m.title && m.title.length > 0) {
                var S = m.toThemeProperty("jqx-chart-title-text", null);
                l = I.measureText(m.title, 0, {
                    "class": S
                });
                I.text(m.title, V.x + e.left, V.y + e.top, V.width - (e.left + e.right), l.height, 0, {
                    "class": S
                }, true, "center", "center");
                V.y += l.height;
                V.height -= l.height
            }
            if (m.description && m.description.length > 0) {
                var T = m.toThemeProperty("jqx-chart-title-description", null);
                l = I.measureText(m.description, 0, {
                    "class": T
                });
                I.text(m.description, V.x + e.left, V.y + e.top, V.width - (e.left + e.right), l.height, 0, {
                    "class": T
                }, true, "center", "center");
                V.y += l.height;
                V.height -= l.height
            }
            if (m.title || m.description) {
                V.y += (e.bottom + e.top);
                V.height -= (e.bottom + e.top)
            }
            var b = {
                x: V.x,
                y: V.y,
                width: V.width,
                height: V.height
            };
            m._plotRect = b;
            m._buildStats(b);
            var H = m._isPieOnlySeries();
            var s = m.seriesGroups;
            var E;
            var D = {
                xAxis: {},
                valueAxis: {}
            };
            for (var Z = 0; Z < s.length && !H; Z++) {
                if (s[Z].type == "pie" || s[Z].type == "donut") {
                    continue
                }
                var z = m._getXAxis(Z);
                if (!z) {
                    throw "seriesGroup[" + Z + "] is missing xAxis definition"
                }
                var ae = z == m._getXAxis() ? -1 : Z;
                D.xAxis[ae] = 0
            }
            var U = m.axisPadding;
            if (isNaN(U)) {
                U = 5
            }
            var r = {
                left: 0,
                right: 0,
                leftCount: 0,
                rightCount: 0
            };
            var p = [];
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                if (ad.type == "pie" || ad.type == "donut" || ad.spider == true || ad.polar == true) {
                    p.push({
                        width: 0,
                        position: 0,
                        xRel: 0
                    });
                    continue
                }
                E = ad.orientation == "horizontal";
                var z = m._getXAxis(Z);
                var ae = z == m._getXAxis() ? -1 : Z;
                var k = m._getValueAxis(Z);
                var O = k == m._getValueAxis() ? -1 : Z;
                var R = !E ? k.axisSize : z.axisSize;
                var f = {
                    x: 0,
                    y: b.y,
                    width: b.width,
                    height: b.height
                };
                var Q = E ? m._getXAxis(Z).position : k.position;
                if (!R || R == "auto") {
                    if (E) {
                        R = this._renderXAxis(Z, f, true, b).width;
                        if ((D.xAxis[ae] & 1) == 1) {
                            R = 0
                        } else {
                            if (R > 0) {
                                D.xAxis[ae] |= 1
                            }
                        }
                    } else {
                        R = m._renderValueAxis(Z, f, true, b).width;
                        if ((D.valueAxis[O] & 1) == 1) {
                            R = 0
                        } else {
                            if (R > 0) {
                                D.valueAxis[O] |= 1
                            }
                        }
                    }
                }
                if (Q != "left" && m.rtl == true) {
                    Q = "right"
                }
                if (Q != "right") {
                    Q = "left"
                }
                if (r[Q + "Count"] > 0 && r[Q] > 0 && R > 0) {
                    r[Q] += U
                }
                p.push({
                    width: R,
                    position: Q,
                    xRel: r[Q]
                });
                r[Q] += R;
                r[Q + "Count"]++
            }
            var u = Math.max(1, Math.max(C.width, C.height));
            var ac = {
                top: 0,
                bottom: 0,
                topCount: 0,
                bottomCount: 0
            };
            var W = [];
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                if (ad.type == "pie" || ad.type == "donut" || ad.spider == true || ad.polar == true) {
                    W.push({
                        height: 0,
                        position: 0,
                        yRel: 0
                    });
                    continue
                }
                E = ad.orientation == "horizontal";
                var k = this._getValueAxis(Z);
                var O = k == m._getValueAxis() ? -1 : Z;
                var z = m._getXAxis(Z);
                var ae = z == m._getXAxis() ? -1 : Z;
                var ab = !E ? z.axisSize : k.axisSize;
                var Q = E ? k.position : z.position;
                if (!ab || ab == "auto") {
                    if (E) {
                        ab = m._renderValueAxis(Z, {
                            x: 0,
                            y: 0,
                            width: u,
                            height: 0
                        }, true, b).height;
                        if ((D.valueAxis[O] & 2) == 2) {
                            ab = 0
                        } else {
                            if (ab > 0) {
                                D.valueAxis[O] |= 2
                            }
                        }
                    } else {
                        ab = m._renderXAxis(Z, {
                            x: 0,
                            y: 0,
                            width: u,
                            height: 0
                        }, true).height;
                        if ((D.xAxis[ae] & 2) == 2) {
                            ab = 0
                        } else {
                            if (ab > 0) {
                                D.xAxis[ae] |= 2
                            }
                        }
                    }
                }
                if (Q != "top") {
                    Q = "bottom"
                }
                if (ac[Q + "Count"] > 0 && ac[Q] > 0 && ab > 0) {
                    ac[Q] += U
                }
                W.push({
                    height: ab,
                    position: Q,
                    yRel: ac[Q]
                });
                ac[Q] += ab;
                ac[Q + "Count"]++
            }
            m._createAnimationGroup("series");
            var t = (m.showLegend != false);
            var B = !t ? {
                width: 0,
                height: 0
            } : m._renderLegend(m.legendLayout ? m._rect : V, true);
            if (this.legendLayout && (!isNaN(this.legendLayout.left) || !isNaN(this.legendLayout.top))) {
                B = {
                    width: 0,
                    height: 0
                }
            }
            if (V.height < ac.top + ac.bottom + B.height || V.width < r.left + r.right) {
                I.endGroup();
                return
            }
            b.height -= ac.top + ac.bottom + B.height;
            b.x += r.left;
            b.width -= r.left + r.right;
            b.y += ac.top;
            var G = [];
            if (!H) {
                var af = m._getXAxis().tickMarksColor || m._defaultLineColor;
                for (Z = 0; Z < s.length; Z++) {
                    var ad = s[Z];
                    if (ad.polar == true || ad.spider == true || ad.type == "pie" || ad.type == "donut") {
                        continue
                    }
                    E = ad.orientation == "horizontal";
                    var ae = m._getXAxis(Z) == m._getXAxis() ? -1 : Z;
                    var O = m._getValueAxis(Z) == m._getValueAxis() ? -1 : Z;
                    var f = {
                        x: b.x,
                        y: 0,
                        width: b.width,
                        height: W[Z].height
                    };
                    if (W[Z].position != "top") {
                        f.y = b.y + b.height + W[Z].yRel
                    } else {
                        f.y = b.y - W[Z].yRel - W[Z].height
                    }
                    if (E) {
                        if ((D.valueAxis[O] & 4) == 4) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderValueAxis(Z, f, false, b);
                        D.valueAxis[O] |= 4
                    } else {
                        G.push(f);
                        if ((D.xAxis[ae] & 4) == 4) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderXAxis(Z, f, false, b);
                        D.xAxis[ae] |= 4
                    }
                }
            }
            if (t) {
                var A = m.legendLayout ? m._rect : V;
                var P = V.x + a.jqx._ptrnd((V.width - B.width) / 2);
                var N = b.y + b.height + ac.bottom;
                var R = V.width;
                var ab = B.height;
                if (m.legendLayout) {
                    if (!isNaN(m.legendLayout.left)) {
                        P = m.legendLayout.left
                    }
                    if (!isNaN(m.legendLayout.top)) {
                        N = m.legendLayout.top
                    }
                    if (!isNaN(m.legendLayout.width)) {
                        R = m.legendLayout.width
                    }
                    if (!isNaN(m.legendLayout.height)) {
                        ab = m.legendLayout.height
                    }
                }
                if (P + R > A.x + A.width) {
                    R = A.x + A.width - P
                }
                if (N + ab > A.y + A.height) {
                    ab = A.y + A.height - N
                }
                m._renderLegend({
                    x: P,
                    y: N,
                    width: R,
                    height: ab
                })
            }
            m._hasHorizontalLines = false;
            if (!H) {
                for (Z = 0; Z < s.length; Z++) {
                    var ad = s[Z];
                    if (ad.polar == true || ad.spider == true || ad.type == "pie" || ad.type == "donut") {
                        continue
                    }
                    E = s[Z].orientation == "horizontal";
                    var f = {
                        x: b.x - p[Z].xRel - p[Z].width,
                        y: b.y,
                        width: p[Z].width,
                        height: b.height
                    };
                    if (p[Z].position != "left") {
                        f.x = b.x + b.width + p[Z].xRel
                    }
                    var ae = m._getXAxis(Z) == m._getXAxis() ? -1 : Z;
                    var O = m._getValueAxis(Z) == m._getValueAxis() ? -1 : Z;
                    if (E) {
                        G.push(f);
                        if ((D.xAxis[ae] & 8) == 8) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderXAxis(Z, f, false, b);
                        D.xAxis[ae] |= 8
                    } else {
                        if ((D.valueAxis[O] & 8) == 8) {
                            continue
                        }
                        if (!m._isGroupVisible(Z)) {
                            continue
                        }
                        m._renderValueAxis(Z, f, false, b);
                        D.valueAxis[O] |= 8
                    }
                }
            }
            if (b.width <= 0 || b.height <= 0) {
                return
            }
            m._plotRect = {
                x: b.x,
                y: b.y,
                width: b.width,
                height: b.height
            };
            for (Z = 0; Z < s.length; Z++) {
                this._drawPlotAreaLines(Z, true, {
                    gridLines: false,
                    tickMarks: false,
                    alternatingBackground: true
                });
                this._drawPlotAreaLines(Z, false, {
                    gridLines: false,
                    tickMarks: false,
                    alternatingBackground: true
                })
            }
            for (Z = 0; Z < s.length; Z++) {
                this._drawPlotAreaLines(Z, true, {
                    gridLines: true,
                    tickMarks: true,
                    alternatingBackground: false
                });
                this._drawPlotAreaLines(Z, false, {
                    gridLines: true,
                    tickMarks: true,
                    alternatingBackground: false
                })
            }
            var K = false;
            for (Z = 0; Z < s.length && !K; Z++) {
                var ad = s[Z];
                if (ad.annotations !== undefined || a.isFunction(ad.draw) || a.isFunction(ad.drawBefore)) {
                    K = true;
                    break
                }
            }
            var M = I.beginGroup();
            if (!K) {
                var J = I.createClipRect({
                    x: b.x - 2,
                    y: b.y,
                    width: b.width + 4,
                    height: b.height
                });
                I.setClip(M, J)
            }
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                var c = false;
                for (var ag in m._seriesTypes) {
                    if (m._seriesTypes[ag] == ad.type) {
                        c = true;
                        break
                    }
                }
                if (!c) {
                    throw 'Invalid serie type "' + ad.type + '"'
                }
                if (a.isFunction(ad.drawBefore)) {
                    ad.drawBefore(I, C, Z, this)
                }
                if (ad.polar == true || ad.spider == true) {
                    if (ad.type.indexOf("pie") == -1 && ad.type.indexOf("donut") == -1) {
                        m._renderSpiderAxis(Z, b)
                    }
                }
                m._renderAxisBands(Z, b, true);
                m._renderAxisBands(Z, b, false)
            }
            for (Z = 0; Z < s.length; Z++) {
                var ad = s[Z];
                if (m._isColumnType(ad.type)) {
                    m._renderColumnSeries(Z, b)
                } else {
                    if (ad.type.indexOf("pie") != -1 || ad.type.indexOf("donut") != -1) {
                        m._renderPieSeries(Z, b)
                    } else {
                        if (ad.type.indexOf("line") != -1 || ad.type.indexOf("area") != -1) {
                            m._renderLineSeries(Z, b)
                        } else {
                            if (ad.type.indexOf("scatter") != -1 || ad.type.indexOf("bubble") != -1) {
                                m._renderScatterSeries(Z, b)
                            } else {
                                if (ad.type.indexOf("candlestick") != -1 || ad.type.indexOf("ohlc") != -1) {
                                    m._renderCandleStickSeries(Z, b, ad.type.indexOf("ohlc") != -1)
                                }
                            }
                        }
                    }
                }
                if (ad.annotations) {
                    if (!this._moduleAnnotations) {
                        throw "Please include 'jqxchart.annotations.js'"
                    }
                    for (var X = 0; X < ad.annotations.length; X++) {
                        m._renderAnnotation(Z, ad.annotations[X], b)
                    }
                }
                if (a.isFunction(ad.draw)) {
                    m.draw(I, C, Z, this)
                }
            }
            I.endGroup();
            if (m.enabled == false) {
                var aa = I.rect(C.x, C.y, C.width, C.height);
                I.attr(aa, {
                    fill: "#777777",
                    opacity: 0.5,
                    stroke: "#00FFFFFF"
                })
            }
            if (a.isFunction(m.draw)) {
                m.draw(I, C)
            }
            I.endGroup();
            m._startAnimation("series");
            if (m._credits) {
                m._credits()
            }
            var ah = false;
            for (var Z = 0; Z < m.seriesGroups.length && !ah; Z++) {
                var z = m._getXAxis(Z);
                if (z && z.rangeSelector) {
                    ah = true
                }
            }
            if (ah) {
                if (!this._moduleRangeSelector) {
                    throw "Please include 'jqxchart.rangeselector.js'"
                }
                var d = [];
                if (!this._isSelectorRefresh) {
                    m.removeHandler(a(document), m._getEvent("mousemove"), m._onSliderMouseMove);
                    m.removeHandler(a(document), m._getEvent("mousedown"), m._onSliderMouseDown);
                    m.removeHandler(a(document), m._getEvent("mouseup"), m._onSliderMouseUp)
                }
                if (!m._isSelectorRefresh) {
                    m._rangeSelectorInstances = {}
                }
                for (Z = 0; Z < m.seriesGroups.length; Z++) {
                    var v = this._getXAxis(Z);
                    if (d.indexOf(v) == -1) {
                        if (this._renderXAxisRangeSelector(Z, G[Z])) {
                            d.push(v)
                        }
                    }
                }
            }
        },
        _credits: function() {
            var c = this;
            var d ="";
            if (!c._isRangeSelectorInstance && location.hostname.indexOf(d.substring(4)) == -1) {
                var g = c.renderer;
                var f = c._rect;
                var h = {
                    "class": c.toThemeProperty("jqx-chart-legend-text", null),
                    opacity: 0.5
                };
                var e = g.measureText(d, 0, h);
                var b = g.text(d, f.x + f.width - e.width - 5, f.y + f.height - e.height - 5, e.width, e.height, 0, h);
                a(b).on("click", function() {
                    location.href = "http://" + d + "/?ref=" + c.widgetName
                })
            }
        },
        _isPieOnlySeries: function() {
            var c = this.seriesGroups;
            if (c.length == 0) {
                return false
            }
            for (var b = 0; b < c.length; b++) {
                if (c[b].type != "pie" && c[b].type != "donut") {
                    return false
                }
            }
            return true
        },
        _renderChartLegend: function(V, C, S, v) {
            var l = this;
            var D = l.renderer;
            var I = {
                x: C.x,
                y: C.y,
                width: C.width,
                height: C.height
            };
            var N = 3;
            if (I.width >= 2 * N) {
                I.x += N;
                I.width -= 2 * N
            }
            if (I.height >= 2 * N) {
                I.y += N;
                I.height -= 2 * N
            }
            var E = {
                width: I.width,
                height: 0
            };
            var G = 0,
                F = 0;
            var p = 20;
            var m = 0;
            var f = 10;
            var Q = 10;
            var w = 0;
            for (var P = 0; P < V.length; P++) {
                var J = V[P].css;
                if (!J) {
                    J = l.toThemeProperty("jqx-chart-legend-text", null)
                }
                p = 20;
                var A = V[P].text;
                var j = D.measureText(A, 0, {
                    "class": J
                });
                if (j.height > p) {
                    p = j.height
                }
                if (j.width > w) {
                    w = j.width
                }
                if (v) {
                    if (P != 0) {
                        F += p
                    }
                    if (F > I.height) {
                        F = 0;
                        G += w + 2 * Q + f;
                        w = j.width;
                        E.width = G + w
                    }
                } else {
                    if (G != 0) {
                        G += Q
                    }
                    if (G + 2 * f + j.width > I.width && j.width < I.width) {
                        G = 0;
                        F += p;
                        p = 20;
                        m = I.width;
                        E.height = F + p
                    }
                }
                var K = false;
                if (j.width > I.width) {
                    K = true;
                    var s = I.width;
                    var T = A;
                    var X = T.split(/\s+/);
                    var o = [];
                    var q = "";
                    for (var M = 0; M < X.length; M++) {
                        var k = q + ((q.length > 0) ? " " : "") + X[M];
                        var B = l.renderer.measureText(k, 0, {
                            "class": J
                        });
                        if (B.width > s && k.length > 0 && q.length > 0) {
                            o.push({
                                text: q
                            });
                            q = X[M]
                        } else {
                            q = k
                        }
                        if (M + 1 == X.length) {
                            o.push({
                                text: q
                            })
                        }
                    }
                    j.width = 0;
                    var c = 0;
                    for (var H = 0; H < o.length; H++) {
                        var W = o[H].text;
                        var B = l.renderer.measureText(W, 0, {
                            "class": J
                        });
                        j.width = Math.max(j.width, B.width);
                        c += j.height
                    }
                    j.height = c
                }
                var z = (G + j.width < I.width) && (F + j.height < C.height);
                if (l.legendLayout) {
                    var z = I.x + G + j.width < l._rect.x + l._rect.width && I.y + F + j.height < l._rect.y + l._rect.height
                }
                if (!S && z) {
                    var h = V[P].seriesIndex;
                    var n = V[P].groupIndex;
                    var b = V[P].itemIndex;
                    var Y = V[P].fillColor;
                    var U = V[P].lineColor;
                    var e = l._isSerieVisible(n, h, b);
                    var R = D.beginGroup();
                    var O = e ? V[P].opacity : 0.1;
                    if (K) {
                        var T = A;
                        var s = I.width;
                        var X = T.split(/\s+/);
                        var u = "";
                        var d = 0;
                        var o = [];
                        var q = "";
                        for (var M = 0; M < X.length; M++) {
                            var k = q + ((q.length > 0) ? " " : "") + X[M];
                            var B = l.renderer.measureText(k, 0, {
                                "class": J
                            });
                            if (B.width > s && k.length > 0 && q.length > 0) {
                                o.push({
                                    text: q,
                                    dy: d
                                });
                                d += B.height;
                                q = X[M]
                            } else {
                                q = k
                            }
                            if (M + 1 == X.length) {
                                o.push({
                                    text: q,
                                    dy: d
                                })
                            }
                        }
                        for (var H = 0; H < o.length; H++) {
                            var W = o[H].text;
                            d = o[H].dy;
                            var B = l.renderer.measureText(W, 0, {
                                "class": J
                            });
                            if (v) {
                                l.renderer.text(W, I.x + G + 1.5 * f, I.y + F + d, j.width, p, 0, {
                                    "class": J
                                }, false, "left", "center")
                            } else {
                                l.renderer.text(W, I.x + G + 1.5 * f, I.y + F + d, j.width, p, 0, {
                                    "class": J
                                }, false, "center", "center")
                            }
                        }
                        var L = D.rect(I.x + G, I.y + F + f / 2 + d / 2, f, f);
                        if (v) {
                            F += d
                        }
                        l.renderer.attr(L, {
                            fill: Y,
                            "fill-opacity": O,
                            stroke: U,
                            "stroke-width": 1,
                            "stroke-opacity": V[P].opacity
                        })
                    } else {
                        var L = D.rect(I.x + G, I.y + F + f / 2, f, f);
                        l.renderer.attr(L, {
                            fill: Y,
                            "fill-opacity": O,
                            stroke: U,
                            "stroke-width": 1,
                            "stroke-opacity": V[P].opacity
                        });
                        if (v) {
                            l.renderer.text(A, I.x + G + 1.5 * f, I.y + F, j.width, j.height + f / 2, 0, {
                                "class": J
                            }, false, "left", "center")
                        } else {
                            l.renderer.text(A, I.x + G + 1.5 * f, I.y + F, j.width, p, 0, {
                                "class": J
                            }, false, "center", "center")
                        }
                    }
                    l.renderer.endGroup();
                    l._setLegendToggleHandler(n, h, b, R)
                }
                if (v) {} else {
                    G += j.width + 2 * f;
                    if (m < G) {
                        m = G
                    }
                }
            }
            if (S) {
                E.height = a.jqx._ptrnd(F + p + 5);
                E.width = a.jqx._ptrnd(m);
                return E
            }
        },
        isSerieVisible: function(d, b, c) {
            return this._isSerieVisible(d, b, c)
        },
        _isSerieVisible: function(f, b, d) {
            while (this._itemsToggleState.length < f + 1) {
                this._itemsToggleState.push([])
            }
            var e = this._itemsToggleState[f];
            while (e.length < b + 1) {
                e.push(isNaN(d) ? true : [])
            }
            var c = e[b];
            if (isNaN(d)) {
                return c
            }
            if (!a.isArray(c)) {
                e[b] = c = []
            }
            while (c.length < d + 1) {
                c.push(true)
            }
            return c[d]
        },
        isGroupVisible: function(b) {
            return this._isGroupVisible(b)
        },
        _isGroupVisible: function(e) {
            var d = false;
            var c = this.seriesGroups[e].series;
            if (!c) {
                return d
            }
            for (var b = 0; b < c.length; b++) {
                if (this._isSerieVisible(e, b)) {
                    d = true;
                    break
                }
            }
            return d
        },
        _toggleSerie: function(h, b, e, c) {
            var g = !this._isSerieVisible(h, b, e);
            if (c != undefined) {
                g = c
            }
            var i = this.seriesGroups[h];
            var f = i.series[b];
            this._raiseEvent("toggle", {
                state: g,
                seriesGroup: i,
                serie: f,
                elementIndex: e
            });
            if (isNaN(e)) {
                this._itemsToggleState[h][b] = g
            } else {
                var d = this._itemsToggleState[h][b];
                if (!a.isArray(d)) {
                    d = []
                }
                while (d.length < e) {
                    d.push(true)
                }
                d[e] = g
            }
            this._isToggleRefresh = true;
            this.update();
            this._isToggleRefresh = false
        },
        showSerie: function(d, b, c) {
            this._toggleSerie(d, b, c, true)
        },
        hideSerie: function(d, b, c) {
            this._toggleSerie(d, b, c, false)
        },
        _setLegendToggleHandler: function(j, c, h, e) {
            var i = this.seriesGroups[j];
            var f = i.series[c];
            var b = f.enableSeriesToggle;
            if (b == undefined) {
                b = i.enableSeriesToggle != false
            }
            if (b) {
                var d = this;
                this.renderer.addHandler(e, "click", function(g) {
                    d._toggleSerie(j, c, h)
                })
            }
        },
        _renderLegend: function(c, e) {
            var o = this;
            var d = [];
            for (var v = 0; v < o.seriesGroups.length; v++) {
                var t = o.seriesGroups[v];
                if (t.showLegend == false) {
                    continue
                }
                for (var q = 0; q < t.series.length; q++) {
                    var m = t.series[q];
                    if (m.showLegend == false) {
                        continue
                    }
                    var u = o._getSerieSettings(v, q);
                    var p;
                    if (t.type == "pie" || t.type == "donut") {
                        var k = o._getXAxis(v);
                        var h = m.legendFormatSettings || t.legendFormatSettings || k.formatSettings || m.formatSettings || t.formatSettings;
                        var n = m.legendFormatFunction || t.legendFormatFunction || k.formatFunction || m.formatFunction || t.formatFunction;
                        var j = o._getDataLen(v);
                        for (var r = 0; r < j; r++) {
                            p = o._getDataValue(r, m.displayText, v);
                            p = o._formatValue(p, h, n, v, q, r);
                            var l = o._getColors(v, q, r);
                            d.push({
                                groupIndex: v,
                                seriesIndex: q,
                                itemIndex: r,
                                text: p,
                                css: m.displayTextClass,
                                fillColor: l.fillColor,
                                lineColor: l.lineColor,
                                opacity: u.opacity
                            })
                        }
                        continue
                    }
                    var h = m.legendFormatSettings || t.legendFormatSettings;
                    var n = m.legendFormatFunction || t.legendFormatFunction;
                    p = o._formatValue(m.displayText || m.dataField || "", h, n, v, q, NaN);
                    var l = o._getSeriesColors(v, q);
                    var f = this._get([m.legendFillColor, m.legendColor, l.fillColor]);
                    var b = this._get([m.legendLineColor, m.legendColor, l.lineColor]);
                    d.push({
                        groupIndex: v,
                        seriesIndex: q,
                        text: p,
                        css: m.displayTextClass,
                        fillColor: f,
                        lineColor: b,
                        opacity: u.opacity
                    })
                }
            }
            return o._renderChartLegend(d, c, e, (o.legendLayout && o.legendLayout.flow == "vertical"))
        },
        _getInterval: function(d, c) {
            if (!d) {
                return c
            }
            var b = this._get([d.unitInterval, c]);
            if (!isNaN(d.step)) {
                b = d.step * c
            }
            return b
        },
        _getOffsets: function(u, d, n, t, r, l, g, e, k) {
            var s = this._getInterval(r[u], e);
            var m = [];
            if (u == "" || (r[u].visible && r[u].visible != "custom")) {
                m = this._generateIntervalValues(t, s, e, g, k)
            }
            var f;
            if (u != "labels") {
                var j = g ? l.left : 0;
                if (!g && e > 1) {
                    j = l.left * (e + 1)
                }
                if (m.length == 1) {
                    j *= 2
                }
                f = this._valuesToOffsets(m, d, t, n, l, false, j);
                if (!g) {
                    var o = (l.left + l.right) * s / e;
                    if (d.flip) {
                        f.unshift(f[0] + o)
                    } else {
                        f.push(f[f.length - 1] + o)
                    }
                }
            } else {
                var j = l.left;
                if (m.length == 1) {
                    j *= 2
                }
                f = this._valuesToOffsets(m, d, t, n, l, g, j)
            }
            var q = this._arraysToObjectsArray([m, f], ["value", "offset"]);
            if (d[u] && d[u].custom) {
                var h = this._objectsArraysToArray(d[u].custom, "value");
                var c = this._objectsArraysToArray(d[u].custom, "offset");
                var b = this._valuesToOffsets(h, d, t, n, l, g, l.left);
                for (var p = 0; p < d[u].custom.length; p++) {
                    q.push({
                        value: h[p],
                        offset: isNaN(c[p]) ? b[p] : c[p]
                    })
                }
            }
            return q
        },
        _renderXAxis: function(d, z, R, c) {
            var f = this;
            var r = f._getXAxis(d);
            var Q = f.seriesGroups[d];
            var X = Q.orientation == "horizontal";
            var H = {
                width: 0,
                height: 0
            };
            var P = f._getAxisSettings(r);
            if (!r || !P.visible || Q.type == "spider") {
                return H
            }
            if (!f._isGroupVisible(d) || this._isPieGroup(d)) {
                return H
            }
            var W = f._alignValuesWithTicks(d);
            while (f._renderData.length < d + 1) {
                f._renderData.push({})
            }
            if (f.rtl) {
                r.flip = true
            }
            var B = X ? z.height : z.width;
            var w = r.text;
            var t = f._calculateXOffsets(d, B);
            var T = t.axisStats;
            var j = r.rangeSelector;
            var F = 0;
            if (j) {
                if (!this._moduleRangeSelector) {
                    throw "Please include 'jqxchart.rangeselector.js'"
                }
                F = this._selectorGetSize(r)
            }
            var E = (X && r.position == "right") || (!X && r.position == "top");
            if (!R && j) {
                if (X) {
                    z.width -= F;
                    if (r.position != "right") {
                        z.x += F
                    }
                } else {
                    z.height -= F;
                    if (r.position == "top") {
                        z.y += F
                    }
                }
            }
            var k = {
                rangeLength: t.rangeLength,
                itemWidth: t.itemWidth,
                intervalWidth: t.intervalWidth,
                data: t,
                settings: P,
                isMirror: E,
                rect: z
            };
            f._renderData[d].xAxis = k;
            var G = T.interval;
            if (isNaN(G)) {
                return H
            }
            if (X) {
                P.title.angle -= 90;
                P.labels.angle -= 90
            }
            var m = this._getInterval(P.gridLines, G);
            var K = this._getInterval(P.tickMarks, G);
            var C = this._getInterval(P.labels, G);
            var L;
            var V = T.min;
            var s = T.max;
            var N = t.padding;
            var S = r.flip == true || f.rtl;
            var h = {
                min: V,
                max: s
            };
            if (T.logAxis.enabled) {
                h.min = T.logAxis.minPow;
                h.max = T.logAxis.maxPow
            }
            if (r.type == "date") {
                P.gridLines.offsets = this._generateDTOffsets(V, s, B, N, m, G, T.dateTimeUnit, W, NaN, false, S);
                P.tickMarks.offsets = this._generateDTOffsets(V, s, B, N, K, G, T.dateTimeUnit, W, NaN, false, S);
                L = this._generateDTOffsets(V, s, B, N, C, G, T.dateTimeUnit, W, NaN, true, S)
            } else {
                P.gridLines.offsets = this._getOffsets("gridLines", r, B, T, P, N, W, G);
                P.tickMarks.offsets = this._getOffsets("tickMarks", r, B, T, P, N, W, G);
                L = this._getOffsets("labels", r, B, T, P, N, W, G)
            }
            var n = f.renderer.getRect();
            var l = n.width - z.x - z.width;
            var p = f._getDataLen(d);
            var o;
            if (f._elementRenderInfo && f._elementRenderInfo.length > d) {
                o = f._elementRenderInfo[d].xAxis
            }
            var q = [];
            var J;
            if (P.labels.formatFunction) {
                J = P.labels.formatFunction
            }
            var v;
            if (P.labels.formatSettings) {
                v = a.extend({}, P.labels.formatSettings)
            }
            if (r.type == "date") {
                if (r.dateFormat && !J) {
                    if (v) {
                        v.dateFormat = v.dateFormat || r.dateFormat
                    } else {
                        v = {
                            dateFormat: r.dateFormat
                        }
                    }
                } else {
                    if (!J && (!v || (v && !v.dateFormat))) {
                        J = this._getDefaultDTFormatFn(r.baseUnit || "day")
                    }
                }
            }
            for (var O = 0; O < L.length; O++) {
                var M = L[O].value;
                var I = L[O].offset;
                if (isNaN(I)) {
                    continue
                }
                var U = undefined;
                if (r.type != "date" && T.useIndeces && r.dataField) {
                    U = Math.round(M);
                    M = f._getDataValue(U, r.dataField);
                    if (M == undefined) {
                        M = ""
                    }
                }
                var w = f._formatValue(M, v, J, d, undefined, U);
                if (w == undefined || w.toString() == "") {
                    if (isNaN(U)) {
                        U = O
                    }
                    if (U >= T.filterRange.min && U <= T.filterRange.max) {
                        w = T.useIndeces ? (T.min + U).toString() : (M == undefined ? "" : M.toString())
                    }
                }
                var b = {
                    key: M,
                    text: w,
                    targetX: I,
                    x: I
                };
                if (o && o.itemOffsets[M]) {
                    b.x = o.itemOffsets[M].x;
                    b.y = o.itemOffsets[M].y
                }
                q.push(b)
            }
            var D = f._getAnimProps(d);
            var u = D.enabled && q.length < 500 ? D.duration : 0;
            if (f.enableAxisTextAnimation == false) {
                u = 0
            }
            var A = {
                items: q,
                renderData: k
            };
            var e = f._renderAxis(X, E, P, {
                x: z.x,
                y: z.y,
                width: z.width,
                height: z.height
            }, c, G, false, true, A, R, u);
            if (X) {
                e.width += F
            } else {
                e.height += F
            }
            return e
        },
        _animateAxisText: function(f, h) {
            var c = f.items;
            var d = f.textSettings;
            for (var e = 0; e < c.length; e++) {
                var g = c[e];
                if (!g) {
                    continue
                }
                if (!g.visible) {
                    continue
                }
                var b = g.targetX;
                var j = g.targetY;
                if (!isNaN(g.x) && !isNaN(g.y)) {
                    b = g.x + (b - g.x) * h;
                    j = g.y + (j - g.y) * h
                }
                if (g.element) {
                    this.renderer.removeElement(g.element);
                    g.element = undefined
                }
                g.element = this.renderer.text(g.text, b, j, g.width, g.height, d.angle, {
                    "class": d.style
                }, false, d.halign, d.valign, d.textRotationPoint)
            }
        },
        _getPolarAxisCoords: function(e, b) {
            var i = this.seriesGroups[e];
            var p = b.x + a.jqx.getNum([i.offsetX, b.width / 2]);
            var o = b.y + a.jqx.getNum([i.offsetY, b.height / 2]);
            var k = Math.min(b.width, b.height);
            var f = i.radius;
            if (this._isPercent(f)) {
                f = parseFloat(f) / 100 * k / 2
            }
            if (isNaN(f)) {
                f = k / 2 * 0.6
            }
            var h = this._alignValuesWithTicks(e);
            var n = this._get([i.startAngle, i.minAngle, 0]) - 90;
            if (isNaN(n)) {
                n = 0
            } else {
                n = 2 * Math.PI * n / 360
            }
            var m = this._get([i.endAngle, i.maxAngle, 360]) - 90;
            if (isNaN(m)) {
                m = 2 * Math.PI
            } else {
                m = 2 * Math.PI * m / 360
            }
            if (n > m) {
                var l = n;
                n = m;
                m = l
            }
            var t = a.jqx._rnd(Math.abs(n - m) / (Math.PI * 2), 0.001, true);
            var q = Math.PI * 2 * f * t;
            var g = this._calcGroupOffsets(e, b).xoffsets;
            if (!g) {
                return
            }
            var j = !(Math.abs(Math.abs(m - n) - Math.PI * 2) > 0.00001);
            if (i.spider) {
                axisStats = this._getXAxisStats(e, this._getXAxis(e), q);
                var r = axisStats.interval;
                if (isNaN(r) || r == 0) {
                    r = 1
                }
                var d = (axisStats.max - axisStats.min) / r + (j ? 1 : 0);
                d = Math.round(d);
                if (d > 2) {
                    var c = Math.cos(Math.abs(m - n) / 2 / d);
                    c = a.jqx._rnd(c, 0.01);
                    if (c == 0) {
                        c = 1
                    }
                    var s = f / c;
                    if (s > f && h) {
                        f = s
                    }
                }
            }
            f = a.jqx._ptrnd(f);
            return {
                x: p,
                y: o,
                r: f,
                adjR: this._get([s, f]),
                itemWidth: g.itemWidth,
                rangeLength: g.rangeLength,
                valuesOnTicks: h,
                startAngle: n,
                endAngle: m,
                isClosedCircle: j,
                axisSize: q
            }
        },
        _toPolarCoord: function(j, f, h, e) {
            var c = Math.abs(j.startAngle - j.endAngle) / (Math.PI * 2);
            var b = (h - f.x) * 2 * Math.PI * c / Math.max(1, f.width) + j.startAngle;
            var d = ((f.height + f.y) - e) * j.r / Math.max(1, f.height);
            var i = j.x + d * Math.cos(b);
            var g = j.y + d * Math.sin(b);
            return {
                x: a.jqx._ptrnd(i),
                y: a.jqx._ptrnd(g)
            }
        },
        _renderSpiderAxis: function(A, k) {
            var ap = this;
            var g = ap._getXAxis(A);
            var aB = this._getAxisSettings(g);
            if (!g || !aB.visible) {
                return
            }
            var X = ap.seriesGroups[A];
            var S = ap._getPolarAxisCoords(A, k);
            if (!S) {
                return
            }
            var M = a.jqx._ptrnd(S.x);
            var L = a.jqx._ptrnd(S.y);
            var t = S.adjR;
            var Y = S.startAngle;
            var W = S.endAngle;
            if (t < 1) {
                return
            }
            var aw = a.jqx._rnd(Math.abs(Y - W) / (Math.PI * 2), 0.001, true);
            var h = Math.PI * 2 * t * aw;
            var c = S.isClosedCircle;
            var w = this._renderData[A].xoffsets;
            if (!w.rangeLength) {
                return
            }
            var T = w.axisStats.interval;
            if (isNaN(T) || T < 1) {
                T = 1
            }
            var at = X.orientation == "horizontal";
            var aa = (at && g.position == "right") || (!at && g.position == "top");
            while (ap._renderData.length < A + 1) {
                ap._renderData.push({})
            }
            var au = {
                rangeLength: w.rangeLength,
                itemWidth: w.itemWidth,
                data: w,
                rect: k,
                settings: aB
            };
            ap._renderData[A].xAxis = au;
            ap._renderData[A].polarCoords = S;
            var az = true;
            for (var R = 0; R < A; R++) {
                var B = ap._renderData[R].xAxis;
                var b = ap._renderData[R].polarCoords;
                var E = ap._getXAxis(R);
                var V = false;
                for (var P in S) {
                    if (S[P] != b[P]) {
                        V = true;
                        break
                    }
                }
                if (!V || E != g) {
                    az = false
                }
            }
            var e = aB.gridLines;
            var U = aB.tickMarks;
            var z = aB.labels;
            var ad = this._getInterval(e, T);
            var aE = this._getInterval(U, T);
            var an = this._getInterval(z, T);
            var H = ap._alignValuesWithTicks(A);
            var ae = ap.renderer;
            var ai;
            var af = w.axisStats;
            var aD = af.min;
            var r = af.max;
            var u = this._getPaddingSize(w.axisStats, g, H, h, true, c, false);
            var aj = g.flip == true || ap.rtl;
            if (g.type == "date") {
                e.offsets = this._generateDTOffsets(aD, r, h, u, ad, T, g.baseUnit, true, 0, false, aj);
                U.offsets = this._generateDTOffsets(aD, r, h, u, aE, T, g.baseUnit, true, 0, false, aj);
                ai = this._generateDTOffsets(aD, r, h, u, an, T, g.baseUnit, true, 0, true, aj)
            } else {
                aB.gridLines.offsets = this._getOffsets("gridLines", g, h, af, aB, u, true, T);
                aB.tickMarks.offsets = this._getOffsets("tickMarks", g, h, af, aB, u, true, T);
                ai = this._getOffsets("labels", g, h, af, aB, u, true, T)
            }
            var ak = ap.renderer.getRect();
            var ax = ak.width - k.x - k.width;
            var ah = ap._getDataLen(A);
            var s;
            if (ap._elementRenderInfo && ap._elementRenderInfo.length > A) {
                s = ap._elementRenderInfo[A].xAxis
            }
            var ar = [];
            var ag = this._getDataLen(A);
            for (var R = 0; R < ai.length; R++) {
                var G = ai[R].offset;
                var I = ai[R].value;
                if (g.type != "date" && af.useIndeces && g.dataField) {
                    var ay = Math.round(I);
                    if (ay >= ag) {
                        continue
                    }
                    I = ap._getDataValue(ay, g.dataField);
                    if (I == undefined) {
                        I = ""
                    }
                }
                var aq = ap._formatValue(I, z.formatSettings, z.formatFunction, A, undefined, ay);
                if (aq == undefined || aq.toString() == "") {
                    aq = af.useIndeces ? (af.min + R).toString() : (I == undefined ? "" : I.toString())
                }
                var d = {
                    key: I,
                    text: aq,
                    targetX: G,
                    x: G
                };
                if (s && s.itemOffsets[I]) {
                    d.x = s.itemOffsets[I].x;
                    d.y = s.itemOffsets[I].y
                }
                ar.push(d)
            }
            var aA = {
                items: ar,
                renderData: au
            };
            var l = {
                stroke: e.color,
                fill: "none",
                "stroke-width": e.width,
                "stroke-dasharray": e.dashStyle || ""
            };
            if (!X.spider) {
                if (aw == 1) {
                    ae.circle(M, L, t, l)
                } else {
                    var F = -Y / Math.PI * 180;
                    var aF = -W / Math.PI * 180;
                    this.renderer.pieslice(M, L, 0, t, Math.min(F, aF), Math.max(F, aF), undefined, l)
                }
            }
            var N = ar.length;
            var m = 2 * Math.PI / (N);
            var am = Y;
            var f, D;
            if (e.visible && az) {
                if (!H && !c) {
                    e.offsets.unshift({
                        offset: -u.right
                    })
                }
                for (var R = 0; R < e.offsets.length; R++) {
                    var n = e.offsets[R].offset;
                    if (!H) {
                        if (c) {
                            n += u.right / 2
                        } else {
                            n += u.right
                        }
                    }
                    var C = am + n * 2 * Math.PI * aw / Math.max(1, h);
                    if (C - W > 0.01) {
                        continue
                    }
                    var q = a.jqx._ptrnd(M + t * Math.cos(C));
                    var p = a.jqx._ptrnd(L + t * Math.sin(C));
                    ae.line(M, L, q, p, l)
                }
            }
            if (U.visible && az) {
                var Q = 5;
                var o = {
                    stroke: U.color,
                    fill: "none",
                    "stroke-width": U.width,
                    "stroke-dasharray": U.dashStyle || ""
                };
                if (!H && !c) {
                    U.offsets.unshift({
                        offset: -u.right
                    })
                }
                for (var R = 0; R < U.offsets.length; R++) {
                    var n = U.offsets[R].offset;
                    if (!H) {
                        if (c) {
                            n += u.right / 2
                        } else {
                            n += u.right
                        }
                    }
                    var C = am + n * 2 * Math.PI * aw / Math.max(1, h);
                    if (C - W > 0.01) {
                        continue
                    }
                    var ac = {
                        x: M + t * Math.cos(C),
                        y: L + t * Math.sin(C)
                    };
                    var ab = {
                        x: M + (t + Q) * Math.cos(C),
                        y: L + (t + Q) * Math.sin(C)
                    };
                    ae.line(a.jqx._ptrnd(ac.x), a.jqx._ptrnd(ac.y), a.jqx._ptrnd(ab.x), a.jqx._ptrnd(ab.y), o)
                }
            }
            var ao = [];
            if (X.spider) {
                var v = [];
                if (g.type == "date") {
                    v = this._generateDTOffsets(aD, r, h, u, T, T, g.baseUnit, true, 0, false, aj)
                } else {
                    v = this._getOffsets("", g, h, af, aB, u, true, T)
                }
                if (!H && !c) {
                    v.unshift({
                        offset: -u.right
                    })
                }
                for (var R = 0; R < v.length; R++) {
                    var n = v[R].offset;
                    if (!H) {
                        if (c) {
                            n += u.right / 2
                        } else {
                            n += u.right
                        }
                    }
                    var C = am + n * 2 * Math.PI * aw / Math.max(1, h);
                    if (C - W > 0.01) {
                        continue
                    }
                    ao.push(C)
                }
                au.offsetAngles = ao
            }
            var Z = ap._renderSpiderValueAxis(A, k, (H ? S.adjR : S.r), ao);
            if (!Z) {
                Z = []
            }
            if (X.spider) {
                if (!H) {
                    for (var R = 0; R < Z.length; R++) {
                        Z[R] = Z[R] * S.adjR / S.r
                    }
                }
                Z.push(t);
                this._renderSpiderLines(M, L, Z, S, ao, l)
            }
            if (az && z.visible) {
                au.polarLabels = [];
                for (var R = 0; R < ar.length; R++) {
                    var n = ar[R].x;
                    var C = am + n * 2 * Math.PI * aw / Math.max(1, h);
                    C = (360 - C / (2 * Math.PI) * 360) % 360;
                    if (C < 0) {
                        C = 360 + C
                    }
                    var al = ae.measureText(ar[R].text, 0, {
                        "class": aB.labels.style
                    });
                    var O = (H ? S.adjR : S.r) + (U.visible ? 7 : 2);
                    var av = aB.labels;
                    var aC;
                    if (av.autoRotate) {
                        var K = a.jqx._ptRotate(M - al.width / 2, L - O - al.height, M, L, -C / 180 * Math.PI);
                        var J = a.jqx._ptRotate(M + al.width / 2, L - O, M, L, -C / 180 * Math.PI);
                        al.width = Math.abs(K.x - J.x);
                        al.height = Math.abs(K.y - J.y);
                        aC = {
                            x: Math.min(K.x, J.x),
                            y: Math.min(K.y, J.y)
                        }
                    } else {
                        aC = this._adjustTextBoxPosition(M, L, al, O, C, false, false, false)
                    }
                    au.polarLabels.push({
                        x: aC.x,
                        y: aC.y,
                        value: ar[R].text
                    });
                    ae.text(ar[R].text, aC.x, aC.y, al.width, al.height, av.autoRotate ? 90 - C : av.angle, {
                        "class": av.style
                    }, false, av.halign, av.valign)
                }
            }
        },
        _renderSpiderLines: function(h, f, u, m, e, b) {
            var p = this.renderer;
            var q = m.startAngle;
            var o = m.endAngle;
            var g = m.isClosedCircle;
            for (var r = 0; r < u.length; r++) {
                var d = u[r];
                var c = undefined,
                    n = undefined;
                for (var s = 0; s < e.length; s++) {
                    var t = e[s];
                    var l = a.jqx._ptrnd(h + d * Math.cos(t));
                    var k = a.jqx._ptrnd(f + d * Math.sin(t));
                    if (c) {
                        p.line(c.x, c.y, l, k, b)
                    }
                    c = {
                        x: l,
                        y: k
                    };
                    if (!n) {
                        n = {
                            x: l,
                            y: k
                        }
                    }
                }
                if (n && g) {
                    p.line(c.x, c.y, n.x, n.y, b)
                }
            }
        },
        _renderSpiderValueAxis: function(e, D, T, S) {
            var k = this;
            var u = this.seriesGroups[e];
            var E = this._getPolarAxisCoords(e, D);
            if (!E) {
                return
            }
            var P = a.jqx._ptrnd(E.x);
            var O = a.jqx._ptrnd(E.y);
            T = T || E.r;
            var g = E.startAngle;
            var Z = E.endAngle;
            var X = a.jqx._rnd(Math.abs(g - Z) / (Math.PI * 2), 0.001, true);
            if (T < 1) {
                return
            }
            T = a.jqx._ptrnd(T);
            var f = this._getValueAxis(e);
            settings = this._getAxisSettings(f);
            if (!f || false == settings.visible) {
                return
            }
            var L = this._stats.seriesGroups[e].mu;
            var A = settings.labels;
            var z = A.formatSettings;
            var c = u.type.indexOf("stacked") != -1 && u.type.indexOf("100") != -1;
            if (c && !z) {
                z = {
                    sufix: "%"
                }
            }
            var v = this._get([A.step, A.unitInterval / L]);
            if (isNaN(v)) {
                v = 1
            }
            v = Math.max(1, Math.round(v));
            this._calcValueAxisItems(e, T, v);
            var d = settings.gridLines;
            var B = settings.tickMarks;
            var r = this._getInterval(d, L);
            var Q = this._getInterval(B, L);
            var m = settings.labels;
            var l = {
                stroke: d.color,
                fill: "none",
                "stroke-width": 1,
                "stroke-dasharray": d.dashStyle || ""
            };
            var p = this._renderData[e].valueAxis;
            var w = p.items;
            var t = g;
            if (w.length && settings.line.visible) {
                if (!isNaN(settings.line.angle)) {
                    t = 2 * Math.PI * settings.line.angle / 360
                }
                var o = P + Math.cos(t) * T;
                var ac = O + Math.sin(t) * T;
                if (S.indexOf(t) == -1) {
                    var V = a.extend({}, l);
                    V["stroke-width"] = settings.line.lineWidth;
                    V.stroke = settings.line.color;
                    V["stroke-dasharray"] = settings.line.dashStyle;
                    this.renderer.line(P, O, o, ac, V)
                }
            }
            w = w.reverse();
            var I = this.renderer;
            p.polarLabels = [];
            for (var Y = 0; Y < w.length - 1; Y++) {
                var R = w[Y];
                if (isNaN(R)) {
                    continue
                }
                var C = (m.formatFunction) ? m.formatFunction(R) : this._formatNumber(R, z);
                var h = I.measureText(C, 0, {
                    "class": m.style
                });
                var N = P + (f.showTickMarks != false ? 3 : 2);
                var M = O - p.itemWidth * Y - h.height / 2;
                var H = a.jqx._ptRotate(N, M, P, O, t);
                var G = a.jqx._ptRotate(N + h.width, M + h.height, P, O, t);
                N = Math.min(H.x, G.x);
                M = Math.min(H.y, G.y);
                h.width = Math.abs(H.x - G.x);
                h.height = Math.abs(H.y - G.y);
                N += settings.labels.textOffset.x;
                M += settings.labels.textOffset.y;
                p.polarLabels.push({
                    x: N,
                    y: M,
                    value: C
                });
                I.text(C, N, M, h.width, h.height, m.autoRotate ? (90 + g * 180 / Math.PI) : m.angle, {
                    "class": m.style
                }, false, m.halign, m.valign)
            }
            var q = f.logarithmicScale == true;
            var s = q ? w.length : p.rangeLength;
            aIncrement = 2 * Math.PI / s;
            var ab = f.valuesOnTicks != false;
            var K = this._stats.seriesGroups[e];
            var j = K.mu;
            var J = f.logarithmicScale == true;
            var F = f.logarithmicScaleBase || 10;
            if (J) {
                j = 1
            }
            var aa = {
                min: K.min,
                max: K.max,
                logAxis: {
                    enabled: J == true,
                    base: f.logarithmicScaleBase,
                    minPow: K.minPow,
                    maxPow: K.maxPow
                }
            };
            if (d.visible || u.spider || f.alternatingBackgroundColor || f.alternatingBackgroundColor2) {
                d.offsets = this._getOffsets("gridLines", f, T, aa, settings, {
                    left: 0,
                    right: 0
                }, ab, j)
            }
            var U = [];
            if (d.visible || u.spider) {
                var l = {
                    stroke: d.color,
                    fill: "none",
                    "stroke-width": 1,
                    "stroke-dasharray": d.dashStyle || ""
                };
                for (var Y = 0; Y < d.offsets.length; Y++) {
                    var M = a.jqx._ptrnd(d.offsets[Y].offset);
                    if (M == T) {
                        continue
                    }
                    if (u.spider) {
                        U.push(M);
                        continue
                    }
                    if (X != 1) {
                        var n = -g / Math.PI * 180;
                        var W = -Z / Math.PI * 180;
                        this.renderer.pieslice(P, O, 0, M, Math.min(n, W), Math.max(n, W), undefined, l)
                    } else {
                        I.circle(P, O, M, l)
                    }
                }
            }
            if (!f.tickMarks || (!f.tickMarks.visible && !f.showTickMarks)) {
                B.visible = false
            }
            if (B.visible) {
                B.offsets = this._getOffsets("tickMarks", f, T, aa, settings, {
                    left: 0,
                    right: 0
                }, ab, j);
                tickMarkSize = B.size * 2;
                var l = {
                    stroke: B.color,
                    fill: "none",
                    "stroke-width": 1,
                    "stroke-dasharray": B.dashStyle || ""
                };
                for (var Y = 0; Y < B.offsets.length; Y++) {
                    var b = B.offsets[Y].offset;
                    var H = {
                        x: P + b * Math.cos(t) - tickMarkSize / 2 * Math.sin(t + Math.PI / 2),
                        y: O + b * Math.sin(t) - tickMarkSize / 2 * Math.cos(t + Math.PI / 2)
                    };
                    var G = {
                        x: P + b * Math.cos(t) + tickMarkSize / 2 * Math.sin(t + Math.PI / 2),
                        y: O + b * Math.sin(t) + tickMarkSize / 2 * Math.cos(t + Math.PI / 2)
                    };
                    I.line(a.jqx._ptrnd(H.x), a.jqx._ptrnd(H.y), a.jqx._ptrnd(G.x), a.jqx._ptrnd(G.y), l)
                }
            }
            return U
        },
        _renderAxis: function(H, D, Q, z, c, F, m, V, C, U, d) {
            if (Q.customDraw && !U) {
                return {
                    width: NaN,
                    height: NaN
                }
            }
            var t = Q.title,
                n = Q.labels,
                e = Q.gridLines,
                A = Q.tickMarks,
                P = Q.padding;
            var o = A.visible ? A.size : 0;
            var R = 2;
            var G = {
                width: 0,
                height: 0
            };
            var q = {
                width: 0,
                height: 0
            };
            if (H) {
                G.height = q.height = z.height
            } else {
                G.width = q.width = z.width
            }
            if (!U && D) {
                if (H) {
                    z.x -= z.width
                }
            }
            var l = C.renderData;
            var b = l.itemWidth;
            if (t.visible && t.text != undefined && t != "") {
                var p = t.angle;
                var f = this.renderer.measureText(t.text, p, {
                    "class": t.style
                });
                q.width = f.width;
                q.height = f.height;
                if (!U) {
                    this.renderer.text(t.text, z.x + t.offset.x + (H ? (!D ? R + P.left : -P.right - R + 2 * z.width - q.width) : 0), z.y + t.offset.y + (!H ? (!D ? z.height - R - q.height - P.bottom : P.top + R) : 0), H ? q.width : z.width, !H ? q.height : z.height, p, {
                        "class": t.style
                    }, true, t.halign, t.valign, t.rotationPoint)
                }
            }
            var L = 0;
            var u = V ? -b / 2 : 0;
            if (V && !H) {
                n.halign = "center"
            }
            var N = z.x;
            var M = z.y;
            var E = n.textOffset;
            if (E) {
                if (!isNaN(E.x)) {
                    N += E.x
                }
                if (!isNaN(E.y)) {
                    M += E.y
                }
            }
            if (!H) {
                N += u;
                if (D) {
                    M += q.height > 0 ? q.height + 3 * R : 2 * R;
                    M += o - (V ? o : o / 4)
                } else {
                    M += V ? o : o / 4
                }
                M += P.top
            } else {
                N += P.left + R + (q.width > 0 ? q.width + R : 0) + (D ? z.width - q.width : 0);
                M += u
            }
            var T = 0;
            var K = 0;
            var r = C.items;
            l.itemOffsets = {};
            if (this._isToggleRefresh || !this._isUpdate) {
                d = 0
            }
            var k = false;
            var j = 0;
            for (var S = 0; S < r.length && n.visible; S++, L += b) {
                if (!r[S] || isNaN(b)) {
                    continue
                }
                var v = r[S].text;
                if (!isNaN(r[S].targetX)) {
                    L = r[S].targetX
                }
                var f = this.renderer.measureText(v, n.angle, {
                    "class": n.style
                });
                if (f.width > K) {
                    K = f.width
                }
                if (f.height > T) {
                    T = f.height
                }
                j += H ? T : K;
                if (!U) {
                    if ((H && L > z.height + 2) || (!H && L > z.width + 2)) {
                        continue
                    }
                    var J = H ? N + (D ? (q.width == 0 ? o : o - R) : 0) : N + L;
                    var I = H ? M + L : M;
                    l.itemOffsets[r[S].key] = {
                        x: J,
                        y: I
                    };
                    if (!k) {
                        if (!isNaN(r[S].x) || !isNaN(r[S].y) && d) {
                            k = true
                        }
                    }
                    r[S].targetX = J;
                    r[S].targetY = I;
                    r[S].width = !H ? b : z.width - P.left - P.right - 2 * R - o - ((q.width > 0) ? q.width + R : 0);
                    r[S].height = H ? b : z.height - P.top - P.bottom - 2 * R - o - ((q.height > 0) ? q.height + R : 0);
                    r[S].visible = true
                }
            }
            l.avgWidth = r.length == 0 ? 0 : j / r.length;
            if (!U) {
                var s = {
                    items: r,
                    textSettings: n
                };
                if (isNaN(d) || !k) {
                    d = 0
                }
                this._animateAxisText(s, d == 0 ? 1 : 0);
                if (d != 0) {
                    var g = this;
                    this._enqueueAnimation("series", undefined, undefined, d, function(i, h, w) {
                        g._animateAxisText(h, w)
                    }, s)
                }
            }
            G.width += 2 * R + o + q.width + K + (H && q.width > 0 ? R : 0);
            G.height += 2 * R + o + q.height + T + (!H && q.height > 0 ? R : 0);
            if (!H) {
                G.height += P.top + P.bottom
            } else {
                G.width += P.left + P.right
            }
            var B = {};
            if (!U && Q.line.visible) {
                var O = {
                    stroke: Q.line.color,
                    "stroke-width": Q.line.width,
                    "stroke-dasharray": Q.line.dashStyle || ""
                };
                if (H) {
                    var J = z.x + z.width + (D ? P.left : -P.right);
                    J = a.jqx._ptrnd(J);
                    this.renderer.line(J, z.y, J, z.y + z.height, O)
                } else {
                    var I = a.jqx._ptrnd(z.y + (D ? z.height - P.bottom : P.top));
                    this.renderer.line(a.jqx._ptrnd(z.x), I, a.jqx._ptrnd(z.x + z.width + 1), I, O)
                }
            }
            G.width = a.jqx._rup(G.width);
            G.height = a.jqx._rup(G.height);
            return G
        },
        _drawPlotAreaLines: function(j, z, f) {
            var E = this.seriesGroups[j];
            var c = E.orientation != "horizontal";
            if (!this._renderData || this._renderData.length <= j) {
                return
            }
            var I = z ? "valueAxis" : "xAxis";
            var v = this._renderData[j][I];
            if (!v) {
                return
            }
            var n = this._renderData.axisDrawState;
            if (!n) {
                n = this._renderData.axisDrawState = {}
            }
            var A = "",
                h;
            if (z) {
                A = "valueAxis_" + ((E.valueAxis) ? j : "") + (c ? "swap" : "");
                h = this._getValueAxis(j)
            } else {
                A = "xAxis_" + ((E.xAxis || E.categoryAxis) ? j : "") + (c ? "swap" : "");
                h = this._getXAxis(j)
            }
            if (n[A]) {
                n = n[A]
            } else {
                n = n[A] = {}
            }
            if (!z) {
                c = !c
            }
            var G = v.settings;
            if (!G) {
                return
            }
            if (G.customDraw) {
                return
            }
            var F = G.gridLines,
                q = G.tickMarks,
                u = G.padding;
            var e = v.rect;
            var l = this._plotRect;
            if (!F || !q) {
                return
            }
            var p = 0.5;
            var d = {};
            var b = {
                stroke: F.color,
                "stroke-width": F.width,
                "stroke-dasharray": F.dashStyle || ""
            };
            var D = z ? e.y + e.height : e.x;
            var o = F.offsets;
            if (z && !h.flip) {
                o = a.extend([], o);
                o = o.reverse()
            }
            if (o && o.length > 0) {
                var k = NaN;
                var C = o.length;
                for (var B = 0; B < o.length; B++) {
                    if (c) {
                        lineOffset = a.jqx._ptrnd(e.y + o[B].offset);
                        if (lineOffset < e.y - p) {
                            lineOffset = a.jqx._ptrnd(e.y)
                        }
                        if (lineOffset > e.y + e.height) {
                            lineOffset = e.y + e.height
                        }
                    } else {
                        lineOffset = a.jqx._ptrnd(e.x + o[B].offset);
                        if (lineOffset > e.x + e.width + p) {
                            lineOffset = a.jqx._ptrnd(e.x + e.width)
                        }
                    }
                    if (isNaN(lineOffset)) {
                        continue
                    }
                    if (!isNaN(k) && Math.abs(lineOffset - k) < 2) {
                        continue
                    }
                    k = lineOffset;
                    if (f.gridLines && F.visible != false && n.gridLines != true) {
                        if (c) {
                            this.renderer.line(a.jqx._ptrnd(l.x), lineOffset, a.jqx._ptrnd(l.x + l.width), lineOffset, b)
                        } else {
                            this.renderer.line(lineOffset, a.jqx._ptrnd(l.y), lineOffset, a.jqx._ptrnd(l.y + l.height), b)
                        }
                    }
                    d[lineOffset] = true;
                    if (f.alternatingBackground && (F.alternatingBackgroundColor || F.alternatingBackgroundColor2) && n.alternatingBackground != true) {
                        var m = ((B % 2) == 0) ? F.alternatingBackgroundColor2 : F.alternatingBackgroundColor;
                        if (B > 0 && m) {
                            var H;
                            if (c) {
                                H = this.renderer.rect(a.jqx._ptrnd(l.x), D, a.jqx._ptrnd(l.width - 1), lineOffset - D, b)
                            } else {
                                H = this.renderer.rect(D, a.jqx._ptrnd(l.y), lineOffset - D, a.jqx._ptrnd(l.height), b)
                            }
                            this.renderer.attr(H, {
                                "stroke-width": 0,
                                fill: m,
                                opacity: F.alternatingBackgroundOpacity || 1
                            })
                        }
                    }
                    D = lineOffset
                }
            }
            var b = {
                stroke: q.color,
                "stroke-width": q.width,
                "stroke-dasharray": q.dashStyle || ""
            };
            if (f.tickMarks && q.visible && n.tickMarks != true) {
                var t = q.size;
                var o = q.offsets;
                var k = NaN;
                for (var B = 0; B < o.length; B++) {
                    if (c) {
                        lineOffset = a.jqx._ptrnd(e.y + o[B].offset);
                        if (lineOffset < e.y - p) {
                            lineOffset = a.jqx._ptrnd(e.y)
                        }
                        if (lineOffset > e.y + e.height) {
                            lineOffset = e.y + e.height
                        }
                    } else {
                        lineOffset = a.jqx._ptrnd(e.x + o[B].offset);
                        if (lineOffset > e.x + e.width + p) {
                            lineOffset = a.jqx._ptrnd(e.x + e.width)
                        }
                    }
                    if (isNaN(lineOffset)) {
                        continue
                    }
                    if (!isNaN(k) && Math.abs(lineOffset - k) < 2) {
                        continue
                    }
                    if (d[lineOffset - 1]) {
                        lineOffset--
                    } else {
                        if (d[lineOffset + 1]) {
                            lineOffset++
                        }
                    }
                    if (c) {
                        if (lineOffset > e.y + e.height + p) {
                            break
                        }
                    } else {
                        if (lineOffset > e.x + e.width + p) {
                            break
                        }
                    }
                    k = lineOffset;
                    var w = !v.isMirror ? -t : t;
                    if (c) {
                        var s = e.x + e.width + (h.position == "right" ? u.left : -u.right);
                        if (!z) {
                            s = e.x + (v.isMirror ? u.left : -u.right + e.width)
                        }
                        this.renderer.line(s, lineOffset, s + w, lineOffset, b)
                    } else {
                        var r = e.y + (v.isMirror ? e.height : 0);
                        r += v.isMirror ? -u.bottom : u.top;
                        r = a.jqx._ptrnd(r);
                        this.renderer.line(lineOffset, r, lineOffset, r - w, b)
                    }
                }
            }
            n.tickMarks = n.tickMarks || f.tickMarks;
            n.gridLines = n.gridLines || f.gridLines;
            n.alternatingBackground = n.alternatingBackground || f.alternatingBackground
        },
        _calcValueAxisItems: function(j, d, l) {
            var n = this._stats.seriesGroups[j];
            if (!n || !n.isValid) {
                return false
            }
            var w = this.seriesGroups[j];
            var b = w.orientation == "horizontal";
            var f = this._getValueAxis(j);
            var m = f.valuesOnTicks != false;
            var e = f.dataField;
            var o = n.intervals;
            var s = d / o;
            var u = n.min;
            var r = n.mu;
            var c = f.logarithmicScale == true;
            var k = f.logarithmicScaleBase || 10;
            var h = w.type.indexOf("stacked") != -1 && w.type.indexOf("100") != -1;
            if (c) {
                r = !isNaN(f.unitInterval) ? f.unitInterval : 1
            }
            if (!m) {
                o = Math.max(o - 1, 1)
            }
            while (this._renderData.length < j + 1) {
                this._renderData.push({})
            }
            this._renderData[j].valueAxis = {};
            var q = this._renderData[j].valueAxis;
            q.itemWidth = q.intervalWidth = s;
            q.items = [];
            var p = q.items;
            for (var v = 0; v <= o; v++) {
                var t = 0;
                if (c) {
                    if (h) {
                        t = n.max / Math.pow(k, o - v)
                    } else {
                        t = u * Math.pow(k, v)
                    }
                } else {
                    t = m ? u + v * r : u + (v + 0.5) * r
                }
                if (v % l != 0) {
                    p.push(NaN);
                    continue
                }
                p.push(t)
            }
            q.rangeLength = c && !h ? n.intervals : (n.intervals) * r;
            if (f.flip != true) {
                p = p.reverse()
            }
            return true
        },
        _getDecimalPlaces: function(b, g, c) {
            var h = 0;
            if (isNaN(c)) {
                c = 10
            }
            for (var f = 0; f < b.length; f++) {
                var k = g === undefined ? b[f] : b[f][g];
                if (isNaN(k)) {
                    continue
                }
                var d = k.toString();
                for (var e = 0; e < d.length; e++) {
                    if (d[e] < "0" || d[e] > "9") {
                        h = d.length - (e + 1);
                        if (h >= 0) {
                            return Math.min(h, c)
                        }
                    }
                }
                if (h > 0) {
                    k *= Math.pow(10, h)
                }
                while (Math.round(k) != k && h < c) {
                    h++;
                    k *= 10
                }
            }
            return h
        },
        _renderValueAxis: function(f, z, M, e) {
            var L = this.seriesGroups[f];
            var Q = L.orientation == "horizontal";
            var r = this._getValueAxis(f);
            if (!r) {
                throw "SeriesGroup " + f + " is missing valueAxis definition"
            }
            var G = {
                width: 0,
                height: 0
            };
            if (!this._isGroupVisible(f) || this._isPieOnlySeries() || L.type == "spider") {
                return G
            }
            var P = r.valuesOnTicks != false;
            var H = this._stats.seriesGroups[f];
            var j = H.mu;
            var F = r.logarithmicScale == true;
            var C = r.logarithmicScaleBase || 10;
            if (F) {
                j = !isNaN(r.unitInterval) ? r.unitInterval : 1
            }
            if (j == 0) {
                j = 1
            }
            if (isNaN(j)) {
                return G
            }
            var J = this._getAxisSettings(r);
            var q = J.title,
                t = J.labels;
            var k = r.labels || {};
            var v = this._get([r.horizontalTextAlignment, k.horizontalAlignment]);
            if (!v && t.angle == 0) {
                t.halign = Q ? "center" : (r.position == "right" ? "left" : "right")
            }
            var o = this._get([t.step, t.unitInterval / j]);
            if (isNaN(o)) {
                o = 1
            }
            o = Math.max(1, Math.round(o));
            if (!this._calcValueAxisItems(f, (Q ? z.width : z.height), o) || !J.visible) {
                return G
            }
            if (!Q) {
                q.angle = (!this.rtl ? -90 : 90);
                if (q.rotationPoint == "centercenter") {
                    if (q.valign == "top") {
                        q.rotationPoint = "rightcenter"
                    } else {
                        if (q.valign == "bottom") {
                            q.rotationPoint = "leftcenter"
                        }
                    }
                }
            }
            var l = this._renderData[f].valueAxis;
            var h = t.formatSettings;
            var c = L.type.indexOf("stacked") != -1 && L.type.indexOf("100") != -1;
            if (c && !h) {
                h = {
                    sufix: "%"
                }
            }
            if (!t.formatFunction && (!h || !h.decimalPlaces)) {
                h = h || {};
                h.decimalPlaces = this._getDecimalPlaces([H.min, H.max, j], undefined, 3)
            }
            var d = J.gridLines;
            var m = F ? j : this._getInterval(d, j);
            var B = Q ? z.width : z.height;
            var N = (r.flip == true);
            r.flip = !N;
            var O = {
                min: H.min,
                max: H.max,
                logAxis: {
                    enabled: F == true,
                    base: r.logarithmicScaleBase,
                    minPow: H.minPow,
                    maxPow: H.maxPow
                }
            };
            if (d.visible || r.alternatingBackgroundColor || r.alternatingBackgroundColor2) {
                d.offsets = this._getOffsets("gridLines", r, B, O, J, {
                    left: 0,
                    right: 0
                }, P, j)
            }
            var u = J.tickMarks;
            if (u.visible) {
                u.offsets = this._getOffsets("tickMarks", r, B, O, J, {
                    left: 0,
                    right: 0
                }, P, j)
            }
            labelOffsets = this._getOffsets("labels", r, B, O, J, {
                left: 0,
                right: 0
            }, P, j, !P);
            r.flip = N;
            var p = [];
            var n;
            if (this._elementRenderInfo && this._elementRenderInfo.length > f) {
                n = this._elementRenderInfo[f].valueAxis
            }
            for (var K = 0; K < labelOffsets.length; K++) {
                var I = labelOffsets[K].value;
                if (isNaN(labelOffsets[K].offset)) {
                    p.push(undefined);
                    continue
                }
                var w = (t.formatFunction) ? t.formatFunction(I) : (!isNaN(I)) ? this._formatNumber(I, h) : I;
                var b = {
                    key: I,
                    text: w
                };
                if (n && n.itemOffsets[I]) {
                    b.x = n.itemOffsets[I].x;
                    b.y = n.itemOffsets[I].y
                }
                b.targetX = labelOffsets[K].offset;
                if (!isNaN(b.targetX)) {
                    p.push(b)
                }
            }
            var E = (Q && r.position == "top") || (!Q && r.position == "right") || (!Q && this.rtl && r.position != "left");
            var A = {
                items: p,
                renderData: l
            };
            var D = this._getAnimProps(f);
            var s = D.enabled && p.length < 500 ? D.duration : 0;
            if (this.enableAxisTextAnimation == false) {
                s = 0
            }
            l.settings = J;
            l.isMirror = E;
            l.rect = z;
            return this._renderAxis(!Q, E, J, z, e, j, F, true, A, M, s)
        },
        _objectsArraysToArray: function(e, d) {
            var b = [];
            if (!a.isArray(e)) {
                return b
            }
            for (var c = 0; c < e.length; c++) {
                b.push(e[c][d])
            }
            return b
        },
        _arraysToObjectsArray: function(f, e) {
            var c = [];
            if (f.length != e.length) {
                return c
            }
            for (var d = 0; d < f.length; d++) {
                for (var b = 0; b < f[d].length; b++) {
                    if (c.length <= b) {
                        c.push({})
                    }
                    c[b][e[d]] = f[d][b]
                }
            }
            return c
        },
        _valuesToOffsets: function(p, e, l, q, o, f, c) {
            var h = [];
            if (!e || !a.isArray(p)) {
                return h
            }
            var d = l.logAxis.base;
            var m = l.logAxis.enabled ? "logarithmic" : "linear";
            var k = e.flip;
            var n = q;
            var b = 0,
                g = 0;
            if (o && !isNaN(o.left)) {
                b = o.left
            }
            if (o && !isNaN(o.right)) {
                g = o.right
            }
            n = q - b - g;
            q = n;
            for (var j = 0; j < p.length; j++) {
                x = this._jqxPlot.scale(p[j], {
                    min: l.min.valueOf(),
                    max: l.max.valueOf(),
                    type: m,
                    base: d
                }, {
                    min: 0,
                    max: f ? q : n,
                    flip: k
                }, {});
                if (!isNaN(x)) {
                    if (!isNaN(c)) {
                        x += c
                    }
                    if (x <= q + b + g + 1) {
                        h.push(a.jqx._ptrnd(x))
                    } else {
                        h.push(NaN)
                    }
                } else {
                    h.push(NaN)
                }
            }
            return h
        },
        _generateIntervalValues: function(n, c, b, d, e) {
            var j = [];
            var g = n.min;
            var m = n.max;
            if (n.logAxis && n.logAxis.enabled) {
                g = n.logAxis.minPow;
                m = n.logAxis.maxPow
            }
            if (g == undefined || m == undefined) {
                return j
            }
            if (g == m) {
                if (n.logAxis && n.logAxis.enabled) {
                    return [Math.pow(n.logAxis.base, g)]
                } else {
                    return [g]
                }
            }
            var l = 1;
            if (b < 1) {
                l = 1000000;
                g *= l;
                m *= l;
                b *= l
            }
            for (var h = g; h <= m; h += b) {
                j.push(h / l + (e ? b / 2 : 0))
            }
            if (c > b) {
                var f = [];
                var k = Math.round(c / b);
                for (var h = 0; h < j.length; h++) {
                    if ((h % k) == 0) {
                        f.push(j[h])
                    }
                }
                j = f
            }
            if (n.logAxis && n.logAxis.enabled) {
                for (var h = 0; h < j.length; h++) {
                    j[h] = Math.pow(n.logAxis.base, j[h])
                }
            }
            return j
        },
        _generateDTOffsets: function(p, s, z, n, A, c, o, b, u, v, g) {
            if (!o) {
                o = "day"
            }
            var f = [];
            if (p > s) {
                return f
            }
            if (p == s) {
                if (v) {
                    f.push({
                        offset: b ? z / 2 : n.left,
                        value: p
                    })
                } else {
                    if (b) {
                        f.push({
                            offset: z / 2,
                            value: p
                        })
                    }
                }
                return f
            }
            var j = z - n.left - n.right;
            var w = p;
            var k = n.left;
            var e = k;
            c = Math.max(c, 1);
            var m = c;
            var d = Math.min(1, c);
            if (c > 1 && o != "millisecond") {
                c = 1
            }
            while (a.jqx._ptrnd(e) <= a.jqx._ptrnd(n.left + j + (b ? 0 : n.right))) {
                f.push({
                    offset: e,
                    value: w
                });
                var B = new Date(w.valueOf());
                if (o == "millisecond") {
                    B.setMilliseconds(w.getMilliseconds() + c)
                } else {
                    if (o == "second") {
                        B.setSeconds(w.getSeconds() + c)
                    } else {
                        if (o == "minute") {
                            B.setMinutes(w.getMinutes() + c)
                        } else {
                            if (o == "hour") {
                                var l = B.valueOf();
                                B.setHours(w.getHours() + c);
                                if (l == B.valueOf()) {
                                    B.setHours(w.getHours() + c + 1)
                                }
                            } else {
                                if (o == "day") {
                                    B.setDate(w.getDate() + c)
                                } else {
                                    if (o == "month") {
                                        B.setMonth(w.getMonth() + c)
                                    } else {
                                        if (o == "year") {
                                            B.setFullYear(w.getFullYear() + c)
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                w = B;
                e = k + (w.valueOf() - p.valueOf()) * d / (s.valueOf() - p.valueOf()) * j
            }
            if (g) {
                for (var r = 0; r < f.length; r++) {
                    f[r].offset = z - f[r].offset
                }
            }
            if (m > 1 && o != "millisecond") {
                var q = [];
                for (var r = 0; r < f.length; r += m) {
                    q.push({
                        offset: f[r].offset,
                        value: f[r].value
                    })
                }
                f = q
            }
            if (!b && !v && f.length > 1) {
                var q = [];
                q.push({
                    offset: 0,
                    value: undefined
                });
                for (var r = 1; r < f.length; r++) {
                    q.push({
                        offset: f[r - 1].offset + (f[r].offset - f[r - 1].offset) / 2,
                        value: undefined
                    })
                }
                var t = q.length;
                if (t > 1) {
                    q.push({
                        offset: q[t - 1].offset + (q[t - 1].offset - q[t - 2].offset)
                    })
                } else {
                    q.push({
                        offset: z,
                        value: undefined
                    })
                }
                f = q
            }
            if (A > c) {
                var q = [];
                var h = Math.round(A / m);
                for (var r = 0; r < f.length; r++) {
                    if ((r % h) == 0) {
                        q.push({
                            offset: f[r].offset,
                            value: f[r].value
                        })
                    }
                }
                f = q
            }
            return f
        },
        _hasStackValueReversal: function(e, s) {
            var g = this.seriesGroups[e];
            var h = -1 != g.type.indexOf("stacked");
            if (!h) {
                return false
            }
            var b = -1 != g.type.indexOf("waterfall");
            var q = this._getDataLen(e);
            var t = 0;
            var l = false;
            var u = [];
            for (var o = 0; o < g.series.length; o++) {
                u[o] = this._isSerieVisible(e, o)
            }
            for (var p = 0; p < q; p++) {
                var m = (b && p != 0) ? t : s;
                var d = 0,
                    r = 0;
                var c = undefined;
                if (!b) {
                    l = false
                }
                for (var n = 0; n < g.series.length; n++) {
                    if (!u[n]) {
                        continue
                    }
                    val = this._getDataValueAsNumber(p, g.series[n].dataField, e);
                    if (isNaN(val)) {
                        continue
                    }
                    if (g.series[n].summary) {
                        var f = this._getDataValue(p, g.series[n].summary, e);
                        if (undefined !== f) {
                            continue
                        }
                    }
                    var k = !l ? val < s : val < 0;
                    l = true;
                    if (c == undefined) {
                        c = k
                    }
                    if (k != c) {
                        return true
                    }
                    c = k;
                    t += val
                }
            }
            return false
        },
        _getValueAxis: function(b) {
            var c = b == undefined ? this.valueAxis : this.seriesGroups[b].valueAxis || this.valueAxis;
            if (!c) {
                c = this.valueAxis = {}
            }
            return c
        },
        _buildStats: function(J) {
            var W = {
                seriesGroups: []
            };
            this._stats = W;
            for (var s = 0; s < this.seriesGroups.length; s++) {
                var C = this.seriesGroups[s];
                W.seriesGroups[s] = {};
                var F = this._getXAxis(s);
                var n = this._getValueAxis(s);
                var q = this._getXAxisStats(s, F, (C.orientation != "horizontal") ? J.width : J.height);
                var z = W.seriesGroups[s];
                z.isValid = true;
                var K = (C.orientation == "horizontal") ? J.width : J.height;
                var M = n.logarithmicScale == true;
                var L = n.logarithmicScaleBase;
                if (isNaN(L)) {
                    L = 10
                }
                var G = -1 != C.type.indexOf("stacked");
                var e = G && -1 != C.type.indexOf("100");
                var I = -1 != C.type.indexOf("range");
                var S = C.type.indexOf("waterfall") != -1;
                if (S && !this._moduleWaterfall) {
                    throw "Please include 'jqxchart.waterfall.js'"
                }
                if (e) {
                    z.psums = [];
                    z.nsums = []
                }
                var t = NaN,
                    O = NaN;
                var d = NaN,
                    f = NaN;
                var r = n ? n.baselineValue : NaN;
                if (isNaN(r)) {
                    r = M && !e ? 1 : 0
                }
                var g = false;
                if (r != 0 && G) {
                    g = this._hasStackValueReversal(s, r);
                    if (g) {
                        r = 0
                    }
                }
                if (G && S) {
                    g = this._hasStackValueReversal(s, r)
                }
                var B = this._getDataLen(s);
                var c = 0;
                var X = NaN;
                var m = [];
                if (S) {
                    for (var k = 0; k < C.series.length; k++) {
                        m.push(NaN)
                    }
                }
                var v = NaN;
                for (var V = 0; V < B && z.isValid; V++) {
                    if (F.rangeSelector) {
                        var h = F.dataField ? this._getDataValue(V, F.dataField, s) : V;
                        if (h && q.isDateTime) {
                            h = this._castAsDate(h, F.dateFormat)
                        }
                        if (q.useIndeces) {
                            h = V
                        }
                        if (h && (h.valueOf() < q.min.valueOf() || h.valueOf() > q.max.valueOf())) {
                            continue
                        }
                    }
                    var Y = n.minValue;
                    var E = n.maxValue;
                    if (n.baselineValue) {
                        if (isNaN(Y)) {
                            Y = r
                        } else {
                            Y = Math.min(r, Y)
                        }
                        if (isNaN(E)) {
                            E = r
                        } else {
                            E = Math.max(r, E)
                        }
                    }
                    var u = 0,
                        w = 0;
                    for (var k = 0; C.series && k < C.series.length; k++) {
                        if (!this._isSerieVisible(s, k)) {
                            continue
                        }
                        var H = NaN,
                            R = NaN,
                            A = NaN;
                        if (C.type.indexOf("candle") != -1 || C.type.indexOf("ohlc") != -1) {
                            var b = ["Open", "Low", "Close", "High"];
                            for (var T in b) {
                                var l = this._getDataValueAsNumber(V, C.series[k]["dataField" + b[T]], s);
                                if (isNaN(l)) {
                                    continue
                                }
                                A = isNaN(R) ? l : Math.min(A, l);
                                R = isNaN(R) ? l : Math.max(R, l)
                            }
                        } else {
                            if (I) {
                                var Z = this._getDataValueAsNumber(V, C.series[k].dataFieldFrom, s);
                                var D = this._getDataValueAsNumber(V, C.series[k].dataFieldTo, s);
                                R = Math.max(Z, D);
                                A = Math.min(Z, D)
                            } else {
                                H = this._getDataValueAsNumber(V, C.series[k].dataField, s);
                                if (S) {
                                    if (this._isSummary(s, V)) {
                                        var U = this._getDataValue(V, C.series[k].summary, s);
                                        if (U !== undefined) {
                                            continue
                                        }
                                    }
                                    if (!G) {
                                        if (isNaN(m[k])) {
                                            m[k] = H
                                        } else {
                                            H += m[k]
                                        }
                                        m[k] = H
                                    } else {
                                        if (!isNaN(v)) {
                                            H += v
                                        }
                                        v = H
                                    }
                                }
                                if (isNaN(H) || (M && H <= 0)) {
                                    continue
                                }
                                A = R = H
                            }
                        }
                        if ((isNaN(E) || R > E) && ((isNaN(n.maxValue)) ? true : R <= n.maxValue)) {
                            E = R
                        }
                        if ((isNaN(Y) || A < Y) && ((isNaN(n.minValue)) ? true : A >= n.minValue)) {
                            Y = A
                        }
                        if (!isNaN(H) && G && !S) {
                            if (H > r) {
                                u += H
                            } else {
                                if (H < r) {
                                    w += H
                                }
                            }
                        }
                    }
                    if (!e) {
                        if (!isNaN(n.maxValue)) {
                            u = Math.min(n.maxValue, u)
                        }
                        if (!isNaN(n.minValue)) {
                            w = Math.max(n.minValue, w)
                        }
                    }
                    if (M && e) {
                        for (var k = 0; k < C.series.length; k++) {
                            if (!this._isSerieVisible(s, k)) {
                                X = 0.01;
                                continue
                            }
                            var H = this._getDataValueAsNumber(V, C.series[k].dataField, s);
                            if (isNaN(H) || H <= 0) {
                                X = 0.01;
                                continue
                            }
                            var P = u == 0 ? 0 : H / u;
                            if (isNaN(X) || P < X) {
                                X = P
                            }
                        }
                    }
                    var o = u - w;
                    if (c < o) {
                        c = o
                    }
                    if (e) {
                        z.psums[V] = u;
                        z.nsums[V] = w
                    }
                    if (E > O || isNaN(O)) {
                        O = E
                    }
                    if (Y < t || isNaN(t)) {
                        t = Y
                    }
                    if (u > d || isNaN(d)) {
                        d = u
                    }
                    if (w < f || isNaN(f)) {
                        f = w
                    }
                }
                if (e) {
                    d = d == 0 ? 0 : Math.max(d, -f);
                    f = f == 0 ? 0 : Math.min(f, -d)
                }
                if (t == O) {
                    if (!isNaN(n.minValue) && isNaN(n.maxValue)) {
                        t = n.minValue;
                        O = M ? t * L : t + 1
                    } else {
                        if (isNaN(n.minValue) && !isNaN(n.maxValue)) {
                            O = n.maxValue;
                            t = M ? O / L : O - 1
                        }
                    }
                }
                if (t == O) {
                    if (t == 0) {
                        t = -1;
                        O = 1
                    } else {
                        if (t < 0) {
                            O = 0
                        } else {
                            if (!M) {
                                t = 0
                            } else {
                                if (t == 1) {
                                    t = t / L;
                                    O = O * L
                                }
                            }
                        }
                    }
                }
                var Q = {
                    gmin: t,
                    gmax: O,
                    gsumP: d,
                    gsumN: f,
                    gbase: r,
                    isLogAxis: M,
                    logBase: L,
                    minPercent: X,
                    gMaxRange: c,
                    isStacked: G,
                    isStacked100: e,
                    isWaterfall: S,
                    hasStackValueReversal: g,
                    valueAxis: n,
                    valueAxisSize: K
                };
                if (Q.isStacked) {
                    if (Q.gsumN < 0) {
                        Q.gmin = Math.min(Q.gmin, Q.gbase + Q.gsumN)
                    }
                    if (Q.gsumP > 0) {
                        Q.gmax = Math.max(Q.gmax, Q.gbase + Q.gsumP)
                    }
                }
                z.context = Q
            }
            this._mergeCommonValueAxisStats();
            for (var V = 0; V < W.seriesGroups.length; V++) {
                var z = W.seriesGroups[V];
                if (!z.isValid) {
                    continue
                }
                var N = this._calcOutputGroupStats(z.context);
                for (var T in N) {
                    z[T] = N[T]
                }
                delete z.context
            }
        },
        _mergeCommonValueAxisStats: function() {
            var f = {};
            for (var e = 0; e < this.seriesGroups.length; e++) {
                if (!this._isGroupVisible(e)) {
                    continue
                }
                if (this.seriesGroups[e].valueAxis) {
                    continue
                }
                var d = this._stats.seriesGroups[e].context;
                f.gbase = d.gbase;
                if (isNaN(f.gmin) || d.gmin < f.gmin) {
                    f.gmin = d.gmin
                }
                if (isNaN(f.gmax) || d.gmax > f.gmax) {
                    f.gmax = d.gmax
                }
                if (isNaN(f.gsumP) || d.gsumP > f.gsumP) {
                    f.gsumP = d.gsumP
                }
                if (isNaN(f.gsumN) || d.gsumN < f.gsumN) {
                    f.gsumN = d.gsumN
                }
                if (isNaN(f.logBase) || d.logBase < f.logBase) {
                    f.logBase = d.logBase
                }
                if (isNaN(f.minPercent) || d.minPercent < f.minPercent) {
                    f.minPercent = d.minPercent
                }
                if (f.gsumN > 0) {
                    f.gmin = Math.min(f.gmin, f.gbase + f.gsumN)
                }
                if (f.gsumP > 0) {
                    f.gmax = Math.max(f.gmax, f.gbase + f.gsumP)
                }
            }
            for (var e = 0; e < this.seriesGroups.length; e++) {
                if (this.seriesGroups[e].valueAxis) {
                    continue
                }
                var b = this._stats.seriesGroups[e].context;
                for (var c in f) {
                    b[c] = f[c]
                }
            }
        },
        _calcOutputGroupStats: function(g) {
            var c = g.gmin,
                f = g.gmax,
                A = g.gsumP,
                B = g.gsumN,
                z = g.gbase,
                d = g.isLogAxis,
                j = g.logBase,
                t = g.minPercent,
                k = g.gMaxRange,
                l = g.isStacked,
                h = g.isStacked100,
                e = g.isWaterfall,
                n = g.hasStackValueReversal,
                w = g.valueAxis,
                u = g.valueAxisSize;
            var s = g.valueAxis.unitInterval;
            if (!s) {
                s = this._calcInterval(c, f, Math.max(u / 80, 2))
            }
            if (c == f) {
                c = z;
                f = 2 * f
            }
            var i = NaN;
            var b = 0;
            var q = 0;
            if (d) {
                if (h) {
                    i = 0;
                    var r = 1;
                    b = q = a.jqx.log(100, j);
                    while (r > t) {
                        r /= j;
                        b--;
                        i++
                    }
                    c = Math.pow(j, b)
                } else {
                    if (l && !e) {
                        f = Math.max(f, A)
                    }
                    q = a.jqx._rnd(a.jqx.log(f, j), 1, true);
                    f = Math.pow(j, q);
                    b = a.jqx._rnd(a.jqx.log(c, j), 1, false);
                    c = Math.pow(j, b)
                }
                s = j
            }
            if (c < B) {
                B = c
            }
            if (f > A) {
                A = f
            }
            var v = d ? c : a.jqx._rnd(c, s, false);
            var o = d ? f : a.jqx._rnd(f, s, true);
            if (h && o > 100) {
                o = 100
            }
            if (h && !d) {
                o = (o > 0) ? 100 : 0;
                v = (v < 0) ? -100 : 0;
                s = w.unitInterval;
                if (isNaN(s) || s <= 0 || s >= 100) {
                    s = 10
                }
                if ((100 % s) != 0) {
                    for (; s >= 1; s--) {
                        if ((100 % s) == 0) {
                            break
                        }
                    }
                }
            }
            if (isNaN(o) || isNaN(v) || isNaN(s)) {
                return {}
            }
            if (isNaN(i)) {
                i = parseInt(((o - v) / (s == 0 ? 1 : s)).toFixed())
            }
            if (d && !h) {
                i = q - b;
                k = Math.pow(j, i)
            }
            if (i < 1) {
                return {}
            }
            var m = {
                min: v,
                max: o,
                logarithmic: d,
                logBase: j,
                base: d ? v : z,
                minPow: b,
                maxPow: q,
                sumP: A,
                sumN: B,
                mu: s,
                maxRange: k,
                intervals: i,
                hasStackValueReversal: n
            };
            return m
        },
        _getDataLen: function(c) {
            var b = this.source;
            if (c != undefined && c != -1 && this.seriesGroups[c].source) {
                b = this.seriesGroups[c].source
            }
            if (b instanceof a.jqx.dataAdapter) {
                b = b.records
            }
            if (b) {
                return b.length
            }
            return 0
        },
        _getDataValue: function(b, e, d) {
            var c = this.source;
            if (d != undefined && d != -1) {
                c = this.seriesGroups[d].source || c
            }
            if (c instanceof a.jqx.dataAdapter) {
                c = c.records
            }
            if (!c || b < 0 || b > c.length - 1) {
                return undefined
            }
            if (a.isFunction(e)) {
                return e(b, c)
            }
            return (e && e != "") ? c[b][e] : c[b]
        },
        _getDataValueAsNumber: function(b, e, c) {
            var d = this._getDataValue(b, e, c);
            if (this._isDate(d)) {
                return d.valueOf()
            }
            if (typeof(d) != "number") {
                d = parseFloat(d)
            }
            if (typeof(d) != "number") {
                d = undefined
            }
            return d
        },
        _isPieGroup: function(b) {
            var c = this.seriesGroups[b];
            if (!c || !c.type) {
                return false
            }
            return c.type.indexOf("pie") != -1 || c.type.indexOf("donut") != -1
        },
        _renderPieSeries: function(e, c) {
            var f = this._getDataLen(e);
            var g = this.seriesGroups[e];
            var m = this._calcGroupOffsets(e, c).offsets;
            for (var p = 0; p < g.series.length; p++) {
                var k = g.series[p];
                if (k.customDraw) {
                    continue
                }
                var v = this._getSerieSettings(e, p);
                var h = k.colorScheme || g.colorScheme || this.colorScheme;
                var r = this._getAnimProps(e, p);
                var b = r.enabled && f < 5000 && !this._isToggleRefresh && this._isVML != true ? r.duration : 0;
                if (a.jqx.mobile.isMobileBrowser() && (this.renderer instanceof a.jqx.HTML5Renderer)) {
                    b = 0
                }
                var t = this._get([k.minAngle, k.startAngle]);
                if (isNaN(t) || t < 0 || t > 360) {
                    t = 0
                }
                var z = this._get([k.maxAngle, k.endAngle]);
                if (isNaN(z) || z < 0 || z > 360) {
                    z = 360
                }
                var o = {
                    rect: c,
                    minAngle: t,
                    maxAngle: z,
                    groupIndex: e,
                    serieIndex: p,
                    settings: v,
                    items: []
                };
                for (var u = 0; u < f; u++) {
                    var n = m[p][u];
                    if (!n.visible) {
                        continue
                    }
                    var q = n.fromAngle;
                    var d = n.toAngle;
                    var w = this.renderer.pieslice(n.x, n.y, n.innerRadius, n.outerRadius, q, b == 0 ? d : q, n.centerOffset);
                    this._setRenderInfo(e, p, u, {
                        element: w
                    });
                    var j = {
                        displayValue: n.displayValue,
                        itemIndex: u,
                        visible: n.visible,
                        x: n.x,
                        y: n.y,
                        innerRadius: n.innerRadius,
                        outerRadius: n.outerRadius,
                        fromAngle: q,
                        toAngle: d,
                        centerOffset: n.centerOffset
                    };
                    o.items.push(j)
                }
                this._animatePieSlices(o, 0);
                var l = this;
                this._enqueueAnimation("series", undefined, undefined, b, function(s, i, A) {
                    l._animatePieSlices(i, A)
                }, o)
            }
        },
        _sliceSortFunction: function(d, c) {
            return d.fromAngle - c.fromAngle
        },
        _animatePieSlices: function(o, c) {
            var j;
            if (this._elementRenderInfo && this._elementRenderInfo.length > o.groupIndex && this._elementRenderInfo[o.groupIndex].series && this._elementRenderInfo[o.groupIndex].series.length > o.serieIndex) {
                j = this._elementRenderInfo[o.groupIndex].series[o.serieIndex]
            }
            var f = 360 * c;
            var u = this.seriesGroups[o.groupIndex];
            var n = this._getLabelsSettings(o.groupIndex, o.serieIndex, NaN);
            var m = n.visible;
            var b = [];
            for (var t = 0; t < o.items.length; t++) {
                var w = o.items[t];
                if (!w.visible) {
                    continue
                }
                var p = w.fromAngle;
                var e = w.fromAngle + c * (w.toAngle - w.fromAngle);
                if (j && j[w.displayValue]) {
                    var l = j[w.displayValue].fromAngle;
                    var d = j[w.displayValue].toAngle;
                    p = l + (p - l) * c;
                    e = d + (e - d) * c
                }
                b.push({
                    index: t,
                    from: p,
                    to: e
                })
            }
            if (j) {
                b.sort(this._sliceSortFunction)
            }
            var z = NaN;
            for (var t = 0; t < b.length; t++) {
                var w = o.items[b[t].index];
                var q = this._getRenderInfo(o.groupIndex, o.serieIndex, w.itemIndex);
                var p = b[t].from;
                var e = b[t].to;
                if (j) {
                    if (!isNaN(z) && p > z) {
                        p = z
                    }
                    z = e;
                    if (t == b.length - 1 && e != b[0].from) {
                        e = o.maxAngle + b[0].from
                    }
                }
                var r = this.renderer.pieSlicePath(w.x, w.y, w.innerRadius, w.outerRadius, p, e, w.centerOffset);
                this.renderer.attr(q.element, {
                    d: r
                });
                var h = this._getColors(o.groupIndex, o.serieIndex, w.itemIndex, "radialGradient", w.outerRadius);
                var v = o.settings;
                q.colors = h;
                q.settings = v;
                this.renderer.attr(q.element, {
                    fill: h.fillColor,
                    stroke: h.lineColor,
                    "stroke-width": v.stroke,
                    "fill-opacity": v.opacity,
                    "stroke-opacity": v.opacity,
                    "stroke-dasharray": "none" || v.dashStyle
                });
                var k = u.series[o.serieIndex];
                if (m) {
                    this._showPieLabel(o.groupIndex, o.serieIndex, w.itemIndex, n)
                }
                if (c == 1) {
                    this._installHandlers(q.element, "pieslice", o.groupIndex, o.serieIndex, w.itemIndex)
                }
            }
        },
        _showPieLabel: function(e, f, C, p, h) {
            var k = this._renderData[e].offsets[f][C];
            if (k.elementInfo.labelElement) {
                this.renderer.removeElement(k.elementInfo.labelElement)
            }
            if (!p) {
                p = this._getLabelsSettings(e, f, NaN)
            }
            if (!p.visible) {
                return
            }
            var D = k.fromAngle,
                F = k.toAngle;
            var l = Math.abs(D - F);
            var q = l > 180 ? 1 : 0;
            if (l > 360) {
                D = 0;
                F = 360
            }
            var r = D * Math.PI * 2 / 360;
            var i = F * Math.PI * 2 / 360;
            var j = l / 2 + D;
            j = j % 360;
            var E = j * Math.PI * 2 / 360;
            var v;
            if (p.autoRotate == true) {
                v = j < 90 || j > 270 ? 360 - j : 180 - j
            }
            var u = p.linesEnabled;
            var o = this._showLabel(e, f, C, {
                x: 0,
                y: 0,
                width: 0,
                height: 0
            }, "center", "center", true, false, false, v);
            var d = p.radius || k.outerRadius + Math.max(o.width, o.height);
            if (this._isPercent(d)) {
                d = parseFloat(d) / 100 * Math.min(this._plotRect.width, this._plotRect.height) / 2
            }
            d += k.centerOffset;
            if (isNaN(h)) {
                h = 0
            }
            d += h;
            var z = this.seriesGroups[e];
            var n = z.series[f];
            var B = a.jqx.getNum([n.offsetX, z.offsetX, this._plotRect.width / 2]);
            var A = a.jqx.getNum([n.offsetY, z.offsetY, this._plotRect.height / 2]);
            var c = this._plotRect.x + B;
            var b = this._plotRect.y + A;
            var w = this._adjustTextBoxPosition(c, b, o, d, j, k.outerRadius > d, p.linesAngles != false, p.autoRotate == true);
            var m = {};
            k.elementInfo.labelElement = this._showLabel(e, f, C, {
                x: w.x,
                y: w.y,
                width: o.width,
                height: o.height
            }, "left", "top", false, false, false, v, m);
            if (d > k.outerRadius + 5 && u != false) {
                var t = {
                    lineColor: k.elementInfo.colors.lineColor,
                    stroke: k.elementInfo.settings.stroke,
                    opacity: k.elementInfo.settings.opacity,
                    dashStyle: k.elementInfo.settings.dashStyle
                };
                k.elementInfo.labelArrowPath = this._updateLebelArrowPath(k.elementInfo.labelArrowPath, c, b, d, k.outerRadius + h, E, p.linesAngles != false, t, m)
            }
        },
        _updateLebelArrowPath: function(d, j, f, h, l, g, o, e, r) {
            var c = a.jqx._ptrnd(j + (h - 0) * Math.cos(g));
            var n = a.jqx._ptrnd(f - (h - 0) * Math.sin(g));
            var b = a.jqx._ptrnd(j + (l + 2) * Math.cos(g));
            var m = a.jqx._ptrnd(f - (l + 2) * Math.sin(g));
            var p = [];
            p.push({
                x: r.x + r.width / 2,
                y: r.y
            });
            p.push({
                x: r.x + r.width / 2,
                y: r.y + r.height
            });
            p.push({
                x: r.x,
                y: r.y + r.height / 2
            });
            p.push({
                x: r.x + r.width,
                y: r.y + r.height / 2
            });
            if (!o) {
                p.push({
                    x: r.x,
                    y: r.y
                });
                p.push({
                    x: r.x + r.width,
                    y: r.y
                });
                p.push({
                    x: r.x + r.width,
                    y: r.y + r.height
                });
                p.push({
                    x: r.x,
                    y: r.y + r.height
                })
            }
            p = p.sort(function(s, i) {
                return a.jqx._ptdist(s.x, s.y, j, f) - a.jqx._ptdist(i.x, i.y, j, f)
            });
            p = p.sort(function(s, i) {
                return (Math.abs(s.x - j) + Math.abs(s.y - f)) - (Math.abs(i.x - j) + Math.abs(i.y - f))
            });
            for (var k = 0; k < p.length; k++) {
                p[k].x = a.jqx._ptrnd(p[k].x);
                p[k].y = a.jqx._ptrnd(p[k].y)
            }
            c = p[0].x;
            n = p[0].y;
            var q = "M " + c + "," + n + " L" + b + "," + m;
            if (o) {
                q = "M " + c + "," + n + " L" + b + "," + n + " L" + b + "," + m
            }
            if (d) {
                this.renderer.attr(d, {
                    d: q
                })
            } else {
                d = this.renderer.path(q, {})
            }
            this.renderer.attr(d, {
                fill: "none",
                stroke: e.lineColor,
                "stroke-width": e.stroke,
                "stroke-opacity": e.opacity,
                "stroke-dasharray": "none" || e.dashStyle
            });
            return d
        },
        _adjustTextBoxPosition: function(f, e, n, g, s, c, i, o) {
            var d = s * Math.PI * 2 / 360;
            var k = a.jqx._ptrnd(f + g * Math.cos(d));
            var j = a.jqx._ptrnd(e - g * Math.sin(d));
            if (o) {
                var l = n.width;
                var p = n.height;
                var t = Math.atan(p / l) % (Math.PI * 2);
                var u = d % (Math.PI * 2);
                var r = 0,
                    q = 0;
                var m = 0;
                if (u <= t) {
                    m = l / 2 * Math.cos(d)
                } else {
                    if (u >= t && u < Math.PI - t) {
                        m = (p / 2) * Math.sin(d)
                    } else {
                        if (u >= Math.PI - t && u < Math.PI + t) {
                            m = l / 2 * Math.cos(d)
                        } else {
                            if (u >= Math.PI + t && u < 2 * Math.PI - t) {
                                m = p / 2 * Math.sin(d)
                            } else {
                                if (u >= 2 * Math.PI - t && u < 2 * Math.PI) {
                                    m = l / 2 * Math.cos(d)
                                }
                            }
                        }
                    }
                }
                g += Math.abs(m) + 3;
                var k = a.jqx._ptrnd(f + g * Math.cos(d));
                var j = a.jqx._ptrnd(e - g * Math.sin(d));
                k -= n.width / 2;
                j -= n.height / 2;
                return {
                    x: k,
                    y: j
                }
            }
            if (!c) {
                if (!i) {
                    if (s >= 0 && s < 45 || s >= 315 && s < 360) {
                        j -= n.height / 2
                    } else {
                        if (s >= 45 && s < 135) {
                            j -= n.height;
                            k -= n.width / 2
                        } else {
                            if (s >= 135 && s < 225) {
                                j -= n.height / 2;
                                k -= n.width
                            } else {
                                if (s >= 225 && s < 315) {
                                    k -= n.width / 2
                                }
                            }
                        }
                    }
                } else {
                    if (s >= 90 && s < 270) {
                        j -= n.height / 2;
                        k -= n.width
                    } else {
                        j -= n.height / 2
                    }
                }
            } else {
                k -= n.width / 2;
                j -= n.height / 2
            }
            return {
                x: k,
                y: j
            }
        },
        _isColumnType: function(b) {
            return (b.indexOf("column") != -1 || b.indexOf("waterfall") != -1)
        },
        _getColumnGroupsCount: function(c) {
            var e = 0;
            c = c || "vertical";
            var f = this.seriesGroups;
            for (var d = 0; d < f.length; d++) {
                var b = f[d].orientation || "vertical";
                if (this._isColumnType(f[d].type) && b == c) {
                    e++
                }
            }
            if (this.columnSeriesOverlap) {
                e = 1
            }
            return e
        },
        _getColumnGroupIndex: function(g) {
            var b = 0;
            var c = this.seriesGroups[g].orientation || "vertical";
            for (var e = 0; e < g; e++) {
                var f = this.seriesGroups[e];
                var d = f.orientation || "vertical";
                if (this._isColumnType(f.type) && d == c) {
                    b++
                }
            }
            return b
        },
        _renderAxisBands: function(e, C, K) {
            var z = K ? this._getXAxis(e) : this._getValueAxis(e);
            var t = this.seriesGroups[e];
            var v = K ? undefined : t.bands;
            if (!v) {
                for (var P = 0; P < e; P++) {
                    var n = K ? this._getXAxis(P) : this._getValueAxis(P);
                    if (n == z) {
                        return
                    }
                }
                v = z.bands
            }
            if (!a.isArray(v)) {
                return
            }
            var o = C;
            var V = t.orientation == "horizontal";
            if (V) {
                o = {
                    x: C.y,
                    y: C.x,
                    width: C.height,
                    height: C.width
                }
            }
            this._calcGroupOffsets(e, o);
            for (var P = 0; P < v.length; P++) {
                var c = v[P];
                var T = this._get([c.minValue, c.from]);
                var w = this._get([c.maxValue, c.to]);
                var s = K ? this.getXAxisDataPointOffset(T, e) : this.getValueAxisDataPointOffset(T, e);
                var U = K ? this.getXAxisDataPointOffset(w, e) : this.getValueAxisDataPointOffset(w, e);
                var A = Math.abs(s - U);
                var J;
                if (t.polar || t.spider) {
                    var r = this._renderData[e];
                    var d = r.polarCoords;
                    if (!K) {
                        var F = this._toPolarCoord(d, C, C.x, r.baseOffset);
                        var E = this._toPolarCoord(d, C, C.x, s);
                        var D = this._toPolarCoord(d, C, C.x, U);
                        var q = a.jqx._ptdist(F.x, F.y, E.x, E.y);
                        var p = a.jqx._ptdist(F.x, F.y, D.x, D.y);
                        var h = Math.round(-d.startAngle * 360 / (2 * Math.PI));
                        var Q = Math.round(-d.endAngle * 360 / (2 * Math.PI));
                        if (h > Q) {
                            var I = h;
                            h = Q;
                            Q = I
                        }
                        if (t.spider) {
                            var G = r.xAxis.offsetAngles;
                            var H = "";
                            var M = [p, q];
                            var B = G;
                            if (d.isClosedCircle) {
                                B = a.extend([], G);
                                B.push(B[0])
                            }
                            for (var L in M) {
                                for (var N = 0; N < B.length; N++) {
                                    var S = L == 0 ? N : G.length - N - 1;
                                    var l = d.x + M[L] * Math.cos(B[S]);
                                    var g = d.y + M[L] * Math.sin(B[S]);
                                    if (H == "") {
                                        H += "M "
                                    } else {
                                        H += " L"
                                    }
                                    H += a.jqx._ptrnd(l) + "," + a.jqx._ptrnd(g)
                                }
                                if (L == 0) {
                                    var l = d.x + M[1] * Math.cos(B[S]);
                                    var g = d.y + M[1] * Math.sin(B[S]);
                                    H += " L" + a.jqx._ptrnd(l) + "," + a.jqx._ptrnd(g)
                                }
                            }
                            H += " Z";
                            J = this.renderer.path(H)
                        } else {
                            J = this.renderer.pieslice(d.x, d.y, q, p, h, Q)
                        }
                    } else {
                        if (t.spider) {
                            p1 = this.getPolarDataPointOffset(T, this._stats.seriesGroups[e].max, e);
                            p2 = this.getPolarDataPointOffset(w, this._stats.seriesGroups[e].max, e);
                            var H = "M " + d.x + "," + d.y;
                            H += " L " + p1.x + "," + p1.y;
                            H += " L " + p2.x + "," + p2.y;
                            J = this.renderer.path(H)
                        } else {
                            var f = {};
                            var m = {
                                x: Math.min(s, U),
                                y: C.y,
                                width: A,
                                height: C.height
                            };
                            this._columnAsPieSlice(f, C, d, m);
                            J = f.element
                        }
                    }
                } else {
                    var b = {
                        x: Math.min(s, U),
                        y: o.y,
                        width: A,
                        height: o.height
                    };
                    if (!K) {
                        b = {
                            x: o.x,
                            y: Math.min(s, U),
                            width: o.width,
                            height: A
                        }
                    }
                    if (V) {
                        var I = b.x;
                        b.x = b.y;
                        b.y = I;
                        I = b.width;
                        b.width = b.height;
                        b.height = I
                    }
                    if (A == 0 || A == 1) {
                        J = this.renderer.line(a.jqx._ptrnd(b.x), a.jqx._ptrnd(b.y), a.jqx._ptrnd(b.x + (V ? 0 : b.width)), a.jqx._ptrnd(b.y + (V ? b.height : 0)))
                    } else {
                        J = this.renderer.rect(b.x, b.y, b.width, b.height)
                    }
                }
                var W = c.fillColor || c.color || "#AAAAAA";
                var R = c.lineColor || W;
                var u = c.lineWidth;
                if (isNaN(u)) {
                    u = 1
                }
                var O = c.opacity;
                if (isNaN(O) || O < 0 || O > 1) {
                    O = 1
                }
                this.renderer.attr(J, {
                    fill: W,
                    "fill-opacity": O,
                    stroke: R,
                    "stroke-opacity": O,
                    "stroke-width": u,
                    "stroke-dasharray": c.dashStyle
                })
            }
        },
        _getColumnGroupWidth: function(m, h, o) {
            var e = this.seriesGroups[m];
            var l = e.type.indexOf("stacked") != -1;
            var d = l ? 1 : e.series.length;
            var k = this._getColumnGroupsCount(e.orientation);
            if (isNaN(k) || 0 == k) {
                k = 1
            }
            var n = h.rangeLength >= 1 ? h.itemWidth : o * 0.9;
            var c = e.columnsMinWidth;
            if (isNaN(c)) {
                c = 1
            }
            if (!isNaN(e.columnsMaxWidth)) {
                c = Math.min(e.columnsMaxWidth, c)
            }
            if (c > n && h.length > 0) {
                n = Math.max(n, o * 0.9 / h.length)
            }
            var i = c;
            if (!l) {
                var f = e.seriesGapPercent;
                if (isNaN(f) || f < 0) {
                    f = 10
                }
                f /= 100;
                var b = c;
                b *= (1 + f);
                i += e.series.length * b
            }
            var j = Math.max(n / k, i);
            return {
                requiredWidth: i,
                availableWidth: n,
                targetWidth: j
            }
        },
        _getColumnSerieWidthAndOffset: function(d, e) {
            var m = this.seriesGroups[d];
            var u = m.series[e];
            var c = m.orientation == "horizontal";
            var b = this._plotRect;
            if (c) {
                b = {
                    x: b.y,
                    y: b.x,
                    width: b.height,
                    height: b.width
                }
            }
            var v = this._calcGroupOffsets(d, b);
            if (!v || v.xoffsets.length == 0) {
                return
            }
            var l = true;
            var w = this._getColumnGroupsCount(m.orientation);
            if (m.type == "candlestick" || m.type == "ohlc") {
                w = 1
            }
            var q = this._getColumnGroupIndex(d);
            var r = this._getColumnGroupWidth(d, v.xoffsets, c ? b.height : b.width);
            var h = 0;
            var f = r.targetWidth;
            if (this.columnSeriesOverlap == true || (Math.round(f) > Math.round(r.availableWidth / w))) {
                w = 1;
                q = 0
            }
            if (l) {
                h -= (f * w) / 2
            }
            h += f * q;
            var D = m.columnsGapPercent;
            if (D <= 0) {
                D = 0
            }
            if (isNaN(D) || D >= 100) {
                D = 25
            }
            D /= 100;
            var k = f * D;
            if (k + r.requiredWidth > r.targetWidth) {
                k = Math.max(0, r.targetWidth - r.requiredWidth)
            }
            if (Math.round(f) > Math.round(r.availableWidth)) {
                k = 0
            }
            f -= k;
            h += k / 2;
            var z = m.seriesGapPercent;
            if (isNaN(z) || z < 0) {
                z = 10
            }
            var n = m.type.indexOf("stacked") != -1;
            var t = f;
            if (!n) {
                t /= m.series.length
            }
            var A = this._get([m.seriesGap, (f * z / 100) / (m.series.length - 1)]);
            if (m.polar == true || m.spider == true || n || m.series.length <= 1) {
                A = 0
            }
            var o = A * (m.series.length - 1);
            if (m.series.length > 1 && o > f - m.series.length * 1) {
                o = f - m.series.length * 1;
                A = o / Math.max(1, (m.series.length - 1))
            }
            var g = t - (o / m.series.length);
            var C = 0;
            var i = m.columnsMaxWidth;
            if (!isNaN(i)) {
                if (g > i) {
                    C = g - i;
                    g = i
                }
            }
            var B = C / 2;
            var j = 0;
            if (!n) {
                var E = (f - (g * m.series.length) - o) / 2;
                var p = Math.max(0, e);
                j = E + g * e + p * A
            } else {
                j = C / 2
            }
            return {
                width: g,
                offset: h + j
            }
        },
        _renderColumnSeries: function(f, c) {
            var j = this.seriesGroups[f];
            if (!j.series || j.series.length == 0) {
                return
            }
            var h = this._getDataLen(f);
            var e = j.orientation == "horizontal";
            var A = c;
            if (e) {
                A = {
                    x: c.y,
                    y: c.x,
                    width: c.height,
                    height: c.width
                }
            }
            var p = this._calcGroupOffsets(f, A);
            if (!p || p.xoffsets.length == 0) {
                return
            }
            var m;
            if (j.polar == true || j.spider == true) {
                m = this._getPolarAxisCoords(f, A)
            }
            var r = {
                groupIndex: f,
                rect: c,
                vertical: !e,
                seriesCtx: [],
                renderData: p,
                polarAxisCoords: m
            };
            r.columnGroupWidth = this._getColumnGroupWidth(f, p.xoffsets, e ? A.height : A.width);
            var g = this._getGroupGradientType(f);
            for (var t = 0; t < j.series.length; t++) {
                var n = j.series[t];
                if (n.customDraw) {
                    continue
                }
                var w = n.dataField;
                var u = this._getAnimProps(f, t);
                var b = u.enabled && !this._isToggleRefresh && p.xoffsets.length < 100 ? u.duration : 0;
                var k = this._getColumnSerieWidthAndOffset(f, t);
                var q = this._isSerieVisible(f, t);
                var l = this._getSerieSettings(f, t);
                var B = this._getColors(f, t, NaN, this._getGroupGradientType(f), 4);
                var d = [];
                if (a.isFunction(n.colorFunction) && !m) {
                    for (var z = p.xoffsets.first; z <= p.xoffsets.last; z++) {
                        d.push(this._getColors(f, t, z, g, 4))
                    }
                }
                var v = {
                    seriesIndex: t,
                    serieColors: B,
                    itemsColors: d,
                    settings: l,
                    columnWidth: k.width,
                    xAdjust: k.offset,
                    isVisible: q
                };
                r.seriesCtx.push(v)
            }
            this._animColumns(r, b == 0 ? 1 : 0);
            var o = this;
            this._enqueueAnimation("series", undefined, undefined, b, function(s, i, C) {
                o._animColumns(i, C)
            }, r)
        },
        _getPercent: function(d, c, b, e) {
            if (isNaN(d)) {
                d = c
            }
            if (!isNaN(b) && !isNaN(d) && d < b) {
                d = b
            }
            if (!isNaN(e) && !isNaN(d) && d > e) {
                d = e
            }
            if (isNaN(d)) {
                return NaN
            }
            return d
        },
        _getColumnVOffsets: function(n, j, e, D, u, c) {
            var p = this.seriesGroups[j];
            var H = this._getPercent(p.columnsTopWidthPercent, 100, 0, 100);
            var v = this._getPercent(p.columnsBottomWidthPercent, 100, 0, 100);
            if (H == 0 && v == 0) {
                v = 100
            }
            var J = this._getPercent(p.columnsNeckHeightPercent, NaN, 0, 100) / 100;
            var E = this._getPercent(p.columnsNeckWidthPercent, 100, 0, 100) / 100;
            var r = [];
            var I = NaN;
            for (var q = 0; q < e.length; q++) {
                var N = e[q];
                var k = N.seriesIndex;
                var G = p.series[k];
                var o = n.offsets[k][D].from;
                var P = n.offsets[k][D].to;
                var z = n.xoffsets.data[D];
                var g;
                var h = N.isVisible;
                if (!h) {
                    P = o
                }
                var b = this._elementRenderInfo;
                if (h && b && b.length > j && b[j].series.length > k) {
                    var F = n.xoffsets.xvalues[D];
                    g = b[j].series[k][F];
                    if (g && !isNaN(g.from) && !isNaN(g.to)) {
                        o = g.from + (o - g.from) * c;
                        P = g.to + (P - g.to) * c;
                        z = g.xoffset + (z - g.xoffset) * c
                    }
                }
                if (!g) {
                    P = o + (P - o) * (u ? 1 : c)
                }
                if (isNaN(o)) {
                    o = isNaN(I) ? n.baseOffset : I
                }
                if (!isNaN(P) && u) {
                    I = P
                } else {
                    I = o
                }
                if (isNaN(P)) {
                    P = o
                }
                var C = {
                    from: o,
                    to: P,
                    xOffset: z
                };
                if (H != 100 || v != 100) {
                    C.funnel = true;
                    C.toWidthPercent = H;
                    C.fromWidthPercent = v
                }
                r.push(C)
            }
            if (u && r.length > 1 && !(this._elementRenderInfo && this._elementRenderInfo.length > j)) {
                var l = 0,
                    m = 0,
                    K = -Infinity,
                    w = Infinity,
                    L = Infinity,
                    B = -Infinity;
                for (var M = 0; M < r.length; M++) {
                    var N = e[M];
                    if (N.isVisible) {
                        if (r[M].to >= r[M].from) {
                            m += r[M].to - r[M].from;
                            L = Math.min(L, r[M].from);
                            B = Math.max(B, r[M].to)
                        } else {
                            l += r[M].from - r[M].to;
                            K = Math.max(K, r[M].from);
                            w = Math.min(w, r[M].to)
                        }
                    }
                }
                var O = l;
                var t = m;
                l *= c;
                m *= c;
                var d = 0,
                    f = 0;
                for (var M = 0; M < r.length; M++) {
                    if (r[M].to >= r[M].from) {
                        var A = r[M].to - r[M].from;
                        if (A + f > m) {
                            A = Math.max(0, m - f);
                            r[M].to = r[M].from + A
                        }
                        if (H != 100 || v != 100) {
                            r[M].funnel = true;
                            if (!isNaN(J) && t * J >= f) {
                                r[M].fromWidthPercent = E * 100
                            } else {
                                r[M].fromWidthPercent = (Math.abs(r[M].from - L) / t) * (H - v) + v
                            }
                            if (!isNaN(J) && t * J >= (0 + (f + A))) {
                                r[M].toWidthPercent = E * 100
                            } else {
                                r[M].toWidthPercent = (Math.abs(r[M].to - L) / t) * (H - v) + v
                            }
                        }
                        f += A
                    } else {
                        var A = r[M].from - r[M].to;
                        if (A + d > l) {
                            A = Math.max(0, l - d);
                            r[M].to = r[M].from - A
                        }
                        if (H != 100 || v != 100) {
                            r[M].funnel = true;
                            if (!isNaN(J) && O * J >= d) {
                                r[M].fromWidthPercent = E * 100
                            } else {
                                r[M].fromWidthPercent = (Math.abs(r[M].from - K) / O) * (H - v) + v
                            }
                            if (!isNaN(J) && O * J >= (0 + (d + A))) {
                                r[M].toWidthPercent = E * 100
                            } else {
                                r[M].toWidthPercent = (Math.abs(r[M].to - K) / O) * (H - v) + v
                            }
                        }
                        d += A
                    }
                }
            }
            return r
        },
        _columnAsPieSlice: function(d, k, m, o) {
            var e = this._toPolarCoord(m, k, o.x, o.y);
            var f = this._toPolarCoord(m, k, o.x, o.y + o.height);
            var l = a.jqx._ptdist(m.x, m.y, f.x, f.y);
            var i = a.jqx._ptdist(m.x, m.y, e.x, e.y);
            var c = k.width;
            var n = Math.abs(m.startAngle - m.endAngle) * 180 / Math.PI;
            var b = -((o.x - k.x) * n) / c;
            var h = -((o.x + o.width - k.x) * n) / c;
            var j = m.startAngle;
            j = 360 * j / (Math.PI * 2);
            b -= j;
            h -= j;
            if (d) {
                if (d.element != undefined) {
                    var g = this.renderer.pieSlicePath(m.x, m.y, l, i, h, b, 0);
                    g += " Z";
                    this.renderer.attr(d.element, {
                        d: g
                    })
                } else {
                    d.element = this.renderer.pieslice(m.x, m.y, l, i, h, b, 0)
                }
            }
            return {
                fromAngle: h,
                toAngle: b,
                innerRadius: l,
                outerRadius: i
            }
        },
        _setRenderInfo: function(e, b, d, c) {
            this._renderData[e].offsets[b][d].elementInfo = c
        },
        _getRenderInfo: function(d, b, c) {
            return this._renderData[d].offsets[b][c].elementInfo || {}
        },
        _animColumns: function(ai, d) {
            var p = this;
            var q = ai.groupIndex;
            var B = this.seriesGroups[q];
            var v = ai.renderData;
            var aa = B.type.indexOf("waterfall") != -1;
            var G = this._getXAxis(q);
            var I = B.type.indexOf("stacked") != -1;
            var e = ai.polarAxisCoords;
            var A = this._getGroupGradientType(q);
            var s = ai.columnGroupWidth.targetWidth;
            var z = -1;
            for (var ab = 0; ab < B.series.length; ab++) {
                if (this._isSerieVisible(q, ab)) {
                    z = ab;
                    break
                }
            }
            var aj = NaN,
                t = NaN;
            for (var ab = 0; ab < ai.seriesCtx.length; ab++) {
                var ah = ai.seriesCtx[ab];
                if (isNaN(aj) || aj > ah.xAdjust) {
                    aj = ah.xAdjust
                }
                if (isNaN(t) || t < ah.xAdjust + ah.columnWidth) {
                    t = ah.xAdjust + ah.columnWidth
                }
            }
            var r = Math.abs(t - aj);
            var D = this._get([B.columnsGapPercent, 25]) / 100;
            if (isNaN(D) < 0 || D >= 1) {
                D = 0.25
            }
            var f = D * r;
            var Z = ai.renderData.xoffsets;
            var S = -1;
            var O = {};
            var R = B.skipOverlappingPoints == true;
            for (var ad = Z.first; ad <= Z.last; ad++) {
                var V = Z.data[ad];
                if (isNaN(V)) {
                    continue
                }
                if (S != -1 && Math.abs(V - S) < (r - 1 + f) && R) {
                    continue
                } else {
                    S = V
                }
                var F = this._getColumnVOffsets(v, q, ai.seriesCtx, ad, I, d);
                var L = false;
                if (aa) {
                    for (var C = 0; C < B.series.length; C++) {
                        if (B.series[C].summary && Z.xvalues[ad][B.series[C].summary]) {
                            L = true
                        }
                    }
                }
                for (var C = 0; C < ai.seriesCtx.length; C++) {
                    var ah = ai.seriesCtx[C];
                    var m = ah.seriesIndex;
                    var E = B.series[m];
                    var w = F[C].from;
                    var ak = F[C].to;
                    var K = F[C].xOffset;
                    var g = (ai.vertical ? ai.rect.x : ai.rect.y) + ah.xAdjust;
                    var ae = ah.settings;
                    var W = ah.itemsColors.length != 0 ? ah.itemsColors[ad - v.xoffsets.first] : ah.serieColors;
                    var h = this._isSerieVisible(q, m);
                    if (!h) {
                        continue
                    }
                    var V = a.jqx._ptrnd(g + K);
                    var Q = {
                        x: V,
                        width: ah.columnWidth
                    };
                    if (F[C].funnel) {
                        Q.fromWidthPercent = F[C].fromWidthPercent;
                        Q.toWidthPercent = F[C].toWidthPercent
                    }
                    var k = true;
                    if (ai.vertical) {
                        Q.y = w;
                        Q.height = ak - w;
                        if (Q.height < 0) {
                            Q.y += Q.height;
                            Q.height = -Q.height;
                            k = false
                        }
                    } else {
                        Q.x = w < ak ? w : ak;
                        Q.width = Math.abs(w - ak);
                        k = w - ak < 0;
                        Q.y = V;
                        Q.height = ah.columnWidth
                    }
                    var n = w - ak;
                    if (isNaN(n)) {
                        continue
                    }
                    n = Math.abs(n);
                    var H = undefined;
                    var c = p._getRenderInfo(q, m, ad);
                    var u = c.element;
                    var P = c.labelElement;
                    var N = u == undefined;
                    if (P) {
                        p.renderer.removeElement(P);
                        P = undefined
                    }
                    if (!e) {
                        if (F[C].funnel) {
                            var Y = this._getTrapezoidPath(a.extend({}, Q), ai.vertical, k);
                            if (N) {
                                u = this.renderer.path(Y, {})
                            } else {
                                this.renderer.attr(u, {
                                    d: Y
                                })
                            }
                        } else {
                            if (N) {
                                u = this.renderer.rect(Q.x, Q.y, ai.vertical ? Q.width : 0, ai.vertical ? 0 : Q.height)
                            } else {
                                if (ai.vertical == true) {
                                    this.renderer.attr(u, {
                                        x: Q.x,
                                        y: Q.y,
                                        height: n
                                    })
                                } else {
                                    this.renderer.attr(u, {
                                        x: Q.x,
                                        y: Q.y,
                                        width: n
                                    })
                                }
                            }
                        }
                    } else {
                        var l = {
                            element: u
                        };
                        H = this._columnAsPieSlice(l, ai.rect, e, Q);
                        u = l.element;
                        var W = this._getColors(q, m, undefined, "radialGradient", H.outerRadius)
                    }
                    if (n < 1 && (d != 1 || e)) {
                        this.renderer.attr(u, {
                            display: "none"
                        })
                    } else {
                        this.renderer.attr(u, {
                            display: "block"
                        })
                    }
                    if (N) {
                        this.renderer.attr(u, {
                            fill: W.fillColor,
                            "fill-opacity": ae.opacity,
                            "stroke-opacity": ae.opacity,
                            stroke: W.lineColor,
                            "stroke-width": ae.stroke,
                            "stroke-dasharray": ae.dashStyle
                        })
                    }
                    if (P) {
                        this.renderer.removeElement(P)
                    }
                    if (!h || (n == 0 && d < 1)) {
                        c = {
                            element: u,
                            labelElement: P
                        };
                        p._setRenderInfo(q, m, ad, c);
                        continue
                    }
                    if (aa && this._get([E.showWaterfallLines, B.showWaterfallLines]) != false) {
                        if (!I || (I && C == z)) {
                            var ac = I ? -1 : C;
                            if (d == 1 && !isNaN(v.offsets[C][ad].from) && !isNaN(v.offsets[C][ad].to)) {
                                var M = O[ac];
                                if (M != undefined) {
                                    var ag = {
                                        x: M.x,
                                        y: a.jqx._ptrnd(M.y)
                                    };
                                    var af = {
                                        x: V,
                                        y: ag.y
                                    };
                                    var T = B.columnsTopWidthPercent / 100;
                                    if (isNaN(T)) {
                                        T = 1
                                    } else {
                                        if (T > 1 || T < 0) {
                                            T = 1
                                        }
                                    }
                                    var X = B.columnsBottomWidthPercent / 100;
                                    if (isNaN(X)) {
                                        X = 1
                                    } else {
                                        if (X > 1 || X < 0) {
                                            X = 1
                                        }
                                    }
                                    var o = ai.vertical ? Q.width : Q.height;
                                    ag.x = ag.x - o / 2 + o / 2 * T;
                                    if (L) {
                                        var b = o * T / 2;
                                        af.x = af.x + o / 2 - (G.flip ? -b : b)
                                    } else {
                                        var b = o * X / 2;
                                        af.x = af.x + o / 2 - (G.flip ? -b : b)
                                    }
                                    if (!ai.vertical) {
                                        this._swapXY([ag]);
                                        this._swapXY([af])
                                    }
                                    this.renderer.line(ag.x, ag.y, af.x, af.y, {
                                        stroke: M.color,
                                        "stroke-width": ae.stroke,
                                        "stroke-opacity": ae.opacity,
                                        "fill-opacity": ae.opacity,
                                        "stroke-dasharray": ae.dashStyle
                                    })
                                }
                            }
                        }
                        if (d == 1 && n != 0) {
                            O[I ? -1 : C] = {
                                y: ak,
                                x: (ai.vertical ? Q.x + Q.width : Q.y + Q.height),
                                color: W.lineColor
                            }
                        }
                    }
                    if (e) {
                        var U = this._toPolarCoord(e, ai.rect, Q.x + Q.width / 2, Q.y);
                        var o = this._showLabel(q, m, ad, Q, undefined, undefined, true);
                        var J = H.outerRadius + 10;
                        labelOffset = this._adjustTextBoxPosition(e.x, e.y, o, J, (H.fromAngle + H.toAngle) / 2, true, false, false);
                        P = this._showLabel(q, m, ad, {
                            x: labelOffset.x,
                            y: labelOffset.y
                        }, undefined, undefined, false, false, false)
                    } else {
                        P = this._showLabel(q, m, ad, Q, undefined, undefined, false, false, k)
                    }
                    c = {
                        element: u,
                        labelElement: P
                    };
                    p._setRenderInfo(q, m, ad, c);
                    if (d == 1) {
                        this._installHandlers(u, "column", q, m, ad)
                    }
                }
            }
        },
        _getTrapezoidPath: function(g, h, f) {
            var l = "";
            var b = g.fromWidthPercent / 100;
            var c = g.toWidthPercent / 100;
            if (!h) {
                var e = g.width;
                g.width = g.height;
                g.height = e;
                e = g.x;
                g.x = g.y;
                g.y = e
            }
            var j = g.x + g.width / 2;
            var k = [{
                x: j - g.width * (!f ? b : c) / 2,
                y: g.y + g.height
            }, {
                x: j - g.width * (!f ? c : b) / 2,
                y: g.y
            }, {
                x: j + g.width * (!f ? c : b) / 2,
                y: g.y
            }, {
                x: j + g.width * (!f ? b : c) / 2,
                y: g.y + g.height
            }];
            if (!h) {
                this._swapXY(k)
            }
            l += "M " + a.jqx._ptrnd(k[0].x) + "," + a.jqx._ptrnd(k[0].y);
            for (var d = 1; d < k.length; d++) {
                l += " L " + a.jqx._ptrnd(k[d].x) + "," + a.jqx._ptrnd(k[d].y)
            }
            l += " Z";
            return l
        },
        _swapXY: function(d) {
            for (var c = 0; c < d.length; c++) {
                var b = d[c].x;
                d[c].x = d[c].y;
                d[c].y = b
            }
        },
        _renderCandleStickSeries: function(e, c, t) {
            var m = this;
            var h = m.seriesGroups[e];
            if (!h.series || h.series.length == 0) {
                return
            }
            var d = h.orientation == "horizontal";
            var v = c;
            if (d) {
                v = {
                    x: c.y,
                    y: c.x,
                    width: c.height,
                    height: c.width
                }
            }
            var n = m._calcGroupOffsets(e, v);
            if (!n || n.xoffsets.length == 0) {
                return
            }
            var w = v.width;
            var k;
            if (h.polar || h.spider) {
                k = m._getPolarAxisCoords(e, v);
                w = 2 * k.r
            }
            var g = m._alignValuesWithTicks(e);
            var f = m._getGroupGradientType(e);
            var i = [];
            for (var p = 0; p < h.series.length; p++) {
                i[p] = m._getColumnSerieWidthAndOffset(e, p)
            }
            for (var p = 0; p < h.series.length; p++) {
                if (!this._isSerieVisible(e, p)) {
                    continue
                }
                var u = m._getSerieSettings(e, p);
                var l = h.series[p];
                if (l.customDraw) {
                    continue
                }
                var j = a.isFunction(l.colorFunction) ? undefined : m._getColors(e, p, NaN, f);
                var o = {
                    rect: c,
                    inverse: d,
                    groupIndex: e,
                    seriesIndex: p,
                    symbolType: l.symbolType,
                    symbolSize: l.symbolSize,
                    "fill-opacity": u.opacity,
                    "stroke-opacity": u.opacity,
                    "stroke-width": u.stroke,
                    "stroke-dasharray": u.dashStyle,
                    gradientType: f,
                    colors: j,
                    renderData: n,
                    polarAxisCoords: k,
                    columnsInfo: i,
                    isOHLC: t,
                    items: [],
                    self: m
                };
                var q = m._getAnimProps(e, p);
                var b = q.enabled && !m._isToggleRefresh && n.xoffsets.length < 5000 ? q.duration : 0;
                m._animCandleStick(o, 0);
                var r;
                m._enqueueAnimation("series", undefined, undefined, b, function(A, s, z) {
                    m._animCandleStick(s, z)
                }, o)
            }
        },
        _animCandleStick: function(t, b) {
            var q = ["Open", "Low", "Close", "High"];
            var e = t.columnsInfo[t.seriesIndex].width;
            var g = t.self.seriesGroups[t.groupIndex];
            var v = t.renderData.xoffsets;
            var E = -1;
            var n = Math.abs(v.data[v.last] - v.data[v.first]);
            n *= b;
            var c = NaN,
                r = NaN;
            for (var z = 0; z < t.columnsInfo.length; z++) {
                var w = t.columnsInfo[z];
                if (isNaN(c) || c > w.offset) {
                    c = w.offset
                }
                if (isNaN(r) || r < w.offset + w.width) {
                    r = w.offset + w.width
                }
            }
            var m = Math.abs(r - c);
            var B = g.skipOverlappingPoints != false;
            for (var A = v.first; A <= v.last; A++) {
                var l = v.data[A];
                if (isNaN(l)) {
                    continue
                }
                if (E != -1 && Math.abs(l - E) < m && B) {
                    continue
                }
                var C = Math.abs(v.data[A] - v.data[v.first]);
                if (C > n) {
                    break
                }
                E = l;
                var D = t.items[A] = t.items[A] || {};
                for (var z in q) {
                    var F = t.self._getDataValueAsNumber(A, g.series[t.seriesIndex]["dataField" + q[z]], t.groupIndex);
                    if (isNaN(F)) {
                        break
                    }
                    var k = t.renderData.offsets[t.seriesIndex][A][q[z]];
                    if (isNaN(k)) {
                        break
                    }
                    D[q[z]] = k
                }
                l += t.inverse ? t.rect.y : t.rect.x;
                if (t.polarAxisCoords) {
                    var s = this._toPolarCoord(t.polarAxisCoords, this._plotRect, l, k);
                    l = s.x;
                    k = s.y
                }
                l = a.jqx._ptrnd(l);
                for (var f in q) {
                    D[f] = a.jqx._ptrnd(D[f])
                }
                var h = t.colors;
                if (!h) {
                    h = t.self._getColors(t.groupIndex, t.seriesIndex, A, t.gradientType)
                }
                if (!t.isOHLC) {
                    var u = D.lineElement;
                    if (!u) {
                        u = t.inverse ? this.renderer.line(D.Low, l, D.High, l) : this.renderer.line(l, D.Low, l, D.High);
                        this.renderer.attr(u, {
                            fill: h.fillColor,
                            "fill-opacity": t["fill-opacity"],
                            "stroke-opacity": t["fill-opacity"],
                            stroke: h.lineColor,
                            "stroke-width": t["stroke-width"],
                            "stroke-dasharray": t["stroke-dasharray"]
                        });
                        D.lineElement = u
                    }
                    var p = D.stickElement;
                    l -= e / 2;
                    if (!p) {
                        var d = h.fillColor;
                        if (D.Close <= D.Open && h.fillColorAlt) {
                            d = h.fillColorAlt
                        }
                        p = t.inverse ? this.renderer.rect(Math.min(D.Open, D.Close), l, Math.abs(D.Close - D.Open), e) : this.renderer.rect(l, Math.min(D.Open, D.Close), e, Math.abs(D.Close - D.Open));
                        this.renderer.attr(p, {
                            fill: d,
                            "fill-opacity": t["fill-opacity"],
                            "stroke-opacity": t["fill-opacity"],
                            stroke: h.lineColor,
                            "stroke-width": t["stroke-width"],
                            "stroke-dasharray": t["stroke-dasharray"]
                        });
                        D.stickElement = p
                    }
                    if (b == 1) {
                        this._installHandlers(p, "column", t.groupIndex, t.seriesIndex, A)
                    }
                } else {
                    var o = "M" + l + "," + D.Low + " L" + l + "," + D.High + " M" + (l - e / 2) + "," + D.Open + " L" + l + "," + D.Open + " M" + (l + e / 2) + "," + D.Close + " L" + l + "," + D.Close;
                    if (t.inverse) {
                        o = "M" + D.Low + "," + l + " L" + D.High + "," + l + " M" + D.Open + "," + (l - e / 2) + " L" + D.Open + "," + l + " M" + D.Close + "," + l + " L" + D.Close + "," + (l + e / 2)
                    }
                    var u = D.lineElement;
                    if (!u) {
                        u = this.renderer.path(o, {});
                        this.renderer.attr(u, {
                            fill: h.fillColor,
                            "fill-opacity": t["fill-opacity"],
                            "stroke-opacity": t["fill-opacity"],
                            stroke: h.lineColor,
                            "stroke-width": t["stroke-width"],
                            "stroke-dasharray": t["stroke-dasharray"]
                        });
                        D.lineElement = u
                    }
                    if (b == 1) {
                        this._installHandlers(u, "column", t.groupIndex, t.seriesIndex, A)
                    }
                }
            }
        },
        _renderScatterSeries: function(e, D, F) {
            var u = this.seriesGroups[e];
            if (!u.series || u.series.length == 0) {
                return
            }
            var f = u.type.indexOf("bubble") != -1;
            var v = u.orientation == "horizontal";
            var m = D;
            if (v) {
                m = {
                    x: D.y,
                    y: D.x,
                    width: D.height,
                    height: D.width
                }
            }
            var n = this._calcGroupOffsets(e, m);
            if (!n || n.xoffsets.length == 0) {
                return
            }
            var N = m.width;
            var c;
            if (u.polar || u.spider) {
                c = this._getPolarAxisCoords(e, m);
                N = 2 * c.r
            }
            var V = this._alignValuesWithTicks(e);
            var t = this._getGroupGradientType(e);
            if (!F) {
                F = "to"
            }
            for (var g = 0; g < u.series.length; g++) {
                var T = this._getSerieSettings(e, g);
                var K = u.series[g];
                if (K.customDraw) {
                    continue
                }
                var A = K.dataField;
                var l = a.isFunction(K.colorFunction);
                var L = this._getColors(e, g, NaN, t);
                var U = NaN,
                    z = NaN;
                if (f) {
                    for (var S = n.xoffsets.first; S <= n.xoffsets.last; S++) {
                        var C = this._getDataValueAsNumber(S, (K.radiusDataField || K.sizeDataField), e);
                        if (typeof(C) != "number") {
                            throw "Invalid radiusDataField value at [" + S + "]"
                        }
                        if (!isNaN(C)) {
                            if (isNaN(U) || C < U) {
                                U = C
                            }
                            if (isNaN(z) || C > z) {
                                z = C
                            }
                        }
                    }
                }
                var j = K.minRadius || K.minSymbolSize;
                if (isNaN(j)) {
                    j = N / 50
                }
                var E = K.maxRadius || K.maxSymbolSize;
                if (isNaN(E)) {
                    E = N / 25
                }
                if (j > E) {
                    E = j
                }
                var M = K.radius;
                if (isNaN(M) && !isNaN(K.symbolSize)) {
                    M = (K.symbolType == "circle") ? K.symbolSize / 2 : K.symbolSize
                } else {
                    M = 5
                }
                var G = this._getAnimProps(e, g);
                var B = G.enabled && !this._isToggleRefresh && n.xoffsets.length < 5000 ? G.duration : 0;
                var w = {
                    groupIndex: e,
                    seriesIndex: g,
                    symbolType: K.symbolType,
                    symbolSize: K.symbolSize,
                    "fill-opacity": T.opacity,
                    "stroke-opacity": T.opacity,
                    "stroke-width": T.stroke,
                    "stroke-width-symbol": T.strokeSymbol,
                    "stroke-dasharray": T.dashStyle,
                    items: [],
                    polarAxisCoords: c
                };
                var o = undefined;
                for (var S = n.xoffsets.first; S <= n.xoffsets.last; S++) {
                    var C = this._getDataValueAsNumber(S, A, e);
                    if (typeof(C) != "number") {
                        continue
                    }
                    var J = n.xoffsets.data[S];
                    var H = n.xoffsets.xvalues[S];
                    var I = n.offsets[g][S][F];
                    if (I < m.y || I > m.y + m.height) {
                        continue
                    }
                    if (isNaN(J) || isNaN(I)) {
                        continue
                    }
                    if (v) {
                        var Q = J;
                        J = I;
                        I = Q + D.y
                    } else {
                        J += D.x
                    }
                    if (!l && o && this.enableSampling && a.jqx._ptdist(o.x, o.y, J, I) < 1) {
                        continue
                    }
                    o = {
                        x: J,
                        y: I
                    };
                    var O = M;
                    if (f) {
                        var p = this._getDataValueAsNumber(S, (K.radiusDataField || K.sizeDataField), e);
                        if (typeof(p) != "number") {
                            continue
                        }
                        O = j + (E - j) * (p - U) / Math.max(1, z - U);
                        if (isNaN(O)) {
                            O = j
                        }
                    }
                    n.offsets[g][S].radius = O;
                    var k = NaN,
                        P = NaN;
                    var q = 0;
                    var b = this._elementRenderInfo;
                    if (H != undefined && b && b.length > e && b[e].series.length > g) {
                        var d = b[e].series[g][H];
                        if (d && !isNaN(d.to)) {
                            k = d.to;
                            P = d.xoffset;
                            q = M;
                            if (v) {
                                var Q = P;
                                P = k;
                                k = Q + D.y
                            } else {
                                P += D.x
                            }
                            if (f) {
                                q = j + (E - j) * (d.valueRadius - U) / Math.max(1, z - U);
                                if (isNaN(q)) {
                                    q = j
                                }
                            }
                        }
                    }
                    if (l) {
                        L = this._getColors(e, g, S, t)
                    }
                    w.items.push({
                        from: q,
                        to: O,
                        itemIndex: S,
                        fill: L.fillColor,
                        stroke: L.lineColor,
                        x: J,
                        y: I,
                        xFrom: P,
                        yFrom: k
                    })
                }
                this._animR(w, 0);
                var h = this;
                var R;
                this._enqueueAnimation("series", undefined, undefined, B, function(s, i, r) {
                    h._animR(i, r)
                }, w)
            }
        },
        _animR: function(o, g) {
            var j = o.items;
            var p = o.symbolType || "circle";
            var c = o.symbolSize;
            for (var e = 0; e < j.length; e++) {
                var n = j[e];
                var l = n.x;
                var k = n.y;
                var b = Math.round((n.to - n.from) * g + n.from);
                if (!isNaN(n.yFrom)) {
                    k = n.yFrom + (k - n.yFrom) * g
                }
                if (!isNaN(n.xFrom)) {
                    l = n.xFrom + (l - n.xFrom) * g
                }
                if (o.polarAxisCoords) {
                    var m = this._toPolarCoord(o.polarAxisCoords, this._plotRect, l, k);
                    l = m.x;
                    k = m.y
                }
                l = a.jqx._ptrnd(l);
                k = a.jqx._ptrnd(k);
                b = a.jqx._ptrnd(b);
                var f = this._getRenderInfo(o.groupIndex, o.seriesIndex, j[e].itemIndex);
                var d = f.element;
                var h = f.labelElement;
                if (p == "circle") {
                    if (!d) {
                        d = this.renderer.circle(l, k, b);
                        this.renderer.attr(d, {
                            fill: n.fill,
                            "fill-opacity": o["fill-opacity"],
                            "stroke-opacity": o["fill-opacity"],
                            stroke: n.stroke,
                            "stroke-width": o["stroke-width"],
                            "stroke-dasharray": o["stroke-dasharray"]
                        })
                    }
                    if (this._isVML) {
                        this.renderer.updateCircle(d, undefined, undefined, b)
                    } else {
                        this.renderer.attr(d, {
                            r: b,
                            cy: k,
                            cx: l
                        })
                    }
                } else {
                    if (d) {
                        this.renderer.removeElement(d)
                    }
                    d = this._drawSymbol(p, l, k, n.fill, o["fill-opacity"], n.stroke, o["stroke-opacity"] || o["fill-opacity"], o["stroke-width-symbol"], o["stroke-dasharray"], c || b)
                }
                if (h) {
                    this.renderer.removeElement(h)
                }
                h = this._showLabel(o.groupIndex, o.seriesIndex, n.itemIndex, {
                    x: l - b,
                    y: k - b,
                    width: 2 * b,
                    height: 2 * b
                });
                if (g >= 1) {
                    this._installHandlers(d, "circle", o.groupIndex, o.seriesIndex, n.itemIndex)
                }
                this._setRenderInfo(o.groupIndex, o.seriesIndex, j[e].itemIndex, {
                    element: d,
                    labelElement: h
                })
            }
        },
        _showToolTip: function(G, E, k, e, b) {
            var g = this;
            var s = g._getXAxis(k);
            var i = g._getValueAxis(k);
            if (g._ttEl && k == g._ttEl.gidx && e == g._ttEl.sidx && b == g._ttEl.iidx) {
                return
            }
            var p = g.seriesGroups[k];
            var f = p.series[e];
            var C = g.enableCrosshairs;
            if (g._pointMarker) {
                G = parseInt(g._pointMarker.x + 5);
                E = parseInt(g._pointMarker.y - 5)
            } else {
                C = false
            }
            var Q = C && g.showToolTips == false;
            G = a.jqx._ptrnd(G);
            E = a.jqx._ptrnd(E);
            var j = g._ttEl == undefined;
            if (p.showToolTips == false || f.showToolTips == false) {
                return
            }
            var u = g._get([f.toolTipFormatSettings, p.toolTipFormatSettings, i.toolTipFormatSettings, g.toolTipFormatSettings]);
            var B = g._get([f.toolTipFormatFunction, p.toolTipFormatFunction, i.toolTipFormatFunction, g.toolTipFormatFunction]);
            var K = g._getColors(k, e, b);
            var d = g._getDataValue(b, s.dataField, k);
            if (s.dataField == undefined || s.dataField == "") {
                d = b
            }
            if (s.type == "date") {
                d = g._castAsDate(d, (u ? u.dateFormat : undefined) || s.dateFormat)
            }
            var z = "";
            if (a.isFunction(B)) {
                var I = {};
                var r = 0;
                for (var h in f) {
                    if (h.indexOf("dataField") == 0) {
                        I[h.substring(9, h.length).toLowerCase()] = g._getDataValue(b, f[h], k);
                        r++
                    }
                }
                if (r == 0) {
                    I = g._getDataValue(b, undefined, k)
                } else {
                    if (r == 1) {
                        I = I[""]
                    }
                }
                z = B(I, b, f, p, d, s)
            } else {
                z = g._getFormattedValue(k, e, b, u, B);
                var H = this._getAxisSettings(s);
                var L = H.toolTipFormatSettings;
                var O = H.toolTipFormatFunction;
                if (!O && !L && s.type == "date") {
                    O = this._getDefaultDTFormatFn(s.baseUnit || "day")
                }
                var l = g._formatValue(d, L, O, k, e, b);
                if (!g._isPieGroup(k)) {
                    var J = (s.displayText || s.dataField || "");
                    if (J.length > 0) {
                        z = J + ": " + l + "<br>" + z
                    } else {
                        z = l + "<br>" + z
                    }
                } else {
                    d = g._getDataValue(b, f.displayText || f.dataField, k);
                    l = g._formatValue(d, L, O, k, e, b);
                    z = l + ": " + z
                }
            }
            if (!g._ttEl) {
                g._ttEl = {}
            }
            g._ttEl.sidx = e;
            g._ttEl.gidx = k;
            g._ttEl.iidx = b;
            rect = g.renderer.getRect();
            if (C) {
                var F = a.jqx._ptrnd(g._pointMarker.x);
                var D = a.jqx._ptrnd(g._pointMarker.y);
                var w = g.crosshairsColor || g._defaultLineColor;
                if (p.polar || p.spider) {
                    var A = this._getPolarAxisCoords(k, this._plotRect);
                    var c = a.jqx._ptdist(F, D, A.x, A.y);
                    if (c > A.r) {
                        return
                    }
                    var v = Math.atan2(D - A.y, F - A.x);
                    var m = Math.cos(v) * A.r + A.x;
                    var R = Math.sin(v) * A.r + A.y;
                    if (g._ttEl.vLine) {
                        g.renderer.attr(g._ttEl.vLine, {
                            x1: A.x,
                            y1: A.y,
                            x2: m,
                            y2: R
                        })
                    } else {
                        g._ttEl.vLine = g.renderer.line(A.x, A.y, m, R, {
                            stroke: w,
                            "stroke-width": g.crosshairsLineWidth || 1,
                            "stroke-dasharray": g.crosshairsDashStyle || ""
                        })
                    }
                } else {
                    if (g._ttEl.vLine && g._ttEl.hLine) {
                        g.renderer.attr(g._ttEl.vLine, {
                            x1: F,
                            x2: F
                        });
                        g.renderer.attr(g._ttEl.hLine, {
                            y1: D,
                            y2: D
                        })
                    } else {
                        g._ttEl.vLine = g.renderer.line(F, g._plotRect.y, F, g._plotRect.y + g._plotRect.height, {
                            stroke: w,
                            "stroke-width": g.crosshairsLineWidth || 1,
                            "stroke-dasharray": g.crosshairsDashStyle || ""
                        });
                        g._ttEl.hLine = g.renderer.line(g._plotRect.x, D, g._plotRect.x + g._plotRect.width, D, {
                            stroke: w,
                            "stroke-width": g.crosshairsLineWidth || 1,
                            "stroke-dasharray": g.crosshairsDashStyle || ""
                        })
                    }
                }
            }
            if (!Q && g.showToolTips != false) {
                var M = f.toolTipClass || p.toolTipClass || this.toThemeProperty("jqx-chart-tooltip-text", null);
                var q = f.toolTipBackground || p.toolTipBackground || "#FFFFFF";
                var o = f.toolTipLineColor || p.toolTipLineColor || K.lineColor;
                var N = this._get([f.toolTipOpacity, p.toolTipOpacity, 1]);
                var n = this.getItemCoord(k, e, b);
                var P = 0;
                if (g._pointMarker && g._pointMarker.element) {
                    P = f.symbolSizeSelected;
                    if (isNaN(P)) {
                        P = f.symbolSize
                    }
                    if (isNaN(P) || P > 50 || P < 0) {
                        P = p.symbolSize
                    }
                    if (isNaN(P) || P > 50 || P < 0) {
                        P = 8
                    }
                }
                g._createTooltip(n, p, z, {
                    css: M,
                    fill: q,
                    stroke: o,
                    fillOpacity: N,
                    symbolSize: P
                })
            }
        },
        _fitTooltip: function(c, h, j, k, e) {
            var d = {};
            var b = 2 + e / 2;
            var f = 7;
            if (h.x - j.width - f - b > c.x && h.y + h.height / 2 - j.height / 2 > c.y && h.y + h.height / 2 + j.height / 2 < c.y + c.height) {
                d.left = {
                    arrowLocation: "right",
                    x: h.x - j.width - f - b,
                    y: h.y + h.height / 2 - j.height / 2,
                    width: j.width + f,
                    height: j.height
                }
            }
            if (h.x + h.width + j.width + f + b < c.x + c.width && h.y + h.height / 2 - j.height / 2 > c.y && h.y + h.height / 2 + j.height / 2 < c.y + c.height) {
                d.right = {
                    arrowLocation: "left",
                    x: h.x + h.width + b,
                    y: h.y + h.height / 2 - j.height / 2,
                    width: j.width + f,
                    height: j.height
                }
            }
            if (h.y - j.height - b - f > c.y && h.x + h.width / 2 - j.width / 2 > c.x && h.x + h.width / 2 + j.width / 2 < c.x + c.width) {
                d.top = {
                    arrowLocation: "bottom",
                    x: h.x + h.width / 2 - j.width / 2,
                    y: h.y - j.height - b - f,
                    width: j.width,
                    height: j.height + f
                }
            }
            if (h.y + h.height + j.height + f + b < c.y + c.height && h.x + h.width / 2 - j.width / 2 > c.x && h.x + h.width / 2 + j.width / 2 < c.x + c.width) {
                d.bottom = {
                    arrowLocation: "top",
                    x: h.x + h.width / 2 - j.width / 2,
                    y: h.y + h.height + b,
                    width: j.width,
                    height: j.height + f
                }
            }
            if (h.width > h.height || ((k.type.indexOf("stackedcolumn") != -1 || k.type.indexOf("stackedwaterfall") != -1) && k.orientation != "horizontal")) {
                if (d.left) {
                    return d.left
                }
                if (d.right) {
                    return d.right
                }
            } else {
                if (d.top) {
                    return d.top
                }
                if (d.bottom) {
                    return d.bottom
                }
            }
            for (var g in d) {
                if (d[g]) {
                    return d[g]
                }
            }
            return {
                arrowLocation: ""
            }
        },
        _createTooltip: function(C, j, u, v) {
            var p = this;
            var t = j.type;
            var A = false;
            var B = p._ttEl.box;
            if (!B) {
                A = true;
                B = p._ttEl.box = document.createElement("div");
                var e = 10000000;
                B.style.position = "absolute";
                B.style.cursor = "default";
                a(b).css({
                    "z-index": e,
                    "box-sizing": "content-box"
                });
                a(B).css({
                    "z-index": e
                });
                a(document.body).append(B);
                var b = document.createElement("div");
                b.id = "arrowOuterDiv";
                b.style.width = "0px";
                b.style.height = "0px";
                b.style.position = "absolute";
                a(b).css({
                    "z-index": e + 1,
                    "box-sizing": "content-box"
                });
                var g = document.createElement("div");
                g.id = "arrowInnerDiv";
                g.style.width = "0px";
                g.style.height = "0px";
                g.style.position = "absolute";
                var s = document.createElement("div");
                s.id = "contentDiv";
                s.style.position = "absolute";
                a(s).css({
                    "box-sizing": "content-box"
                });
                a(s).addClass("jqx-rc-all jqx-button");
                a(s).appendTo(a(B));
                a(b).appendTo(a(B));
                a(g).appendTo(a(B));
                a(g).css({
                    "z-index": e + 2,
                    "box-sizing": "content-box"
                })
            }
            if (!u || u.length == 0) {
                a(B).fadeTo(0, 0);
                return
            }
            s = a(B).find("#contentDiv")[0];
            b = a(B).find("#arrowOuterDiv")[0];
            g = a(B).find("#arrowInnerDiv")[0];
            g.style.opacity = b.style.opacity = v.fillOpacity;
            s.style.backgroundColor = v.fill;
            s.style.borderColor = v.stroke;
            s.style.opacity = v.fillOpacity;
            var l = "<span class='" + v.css + "'>" + u + "</span>";
            a(s).html(l);
            var o = this._measureHtml(l, "jqx-rc-all jqx-button");
            rect = p._plotRect;
            if (o.width > rect.width || o.height > rect.height) {
                return
            }
            var n = {
                width: o.width,
                height: o.height
            };
            arrowLocation = "";
            var z = 5;
            var q = 7;
            var r = p._isColumnType(t);
            x = Math.max(C.x, rect.x);
            y = Math.max(C.y, rect.y);
            if (p.toolTipAlignment == "dataPoint") {
                if (t.indexOf("pie") != -1 || t.indexOf("donut") != -1) {
                    var k = (C.fromAngle + C.toAngle) / 2;
                    k = k * (Math.PI / 180);
                    var f = (!isNaN(C.innerRadius) && C.innerRadius > 0) ? (C.innerRadius + C.outerRadius) / 2 : C.outerRadius * 0.75;
                    x = C.x = C.center.x + Math.cos(k) * f;
                    y = C.y = C.center.y - Math.sin(k) * f;
                    C.width = C.height = 1
                } else {
                    if (r && (j.polar || j.spider)) {
                        C.width = C.height = 1
                    }
                }
                var w = this._fitTooltip(this._plotRect, C, n, j, v.symbolSize);
                if (w.arrowLocation != "") {
                    arrowLocation = w.arrowLocation;
                    x = w.x;
                    y = w.y;
                    n.width = w.width;
                    n.height = w.height
                }
            } else {
                arrowLocation = ""
            }
            if (arrowLocation == "top" || arrowLocation == "bottom") {
                n.height += q;
                x -= q / 2;
                if (arrowLocation == "bottom") {
                    y -= q
                }
            } else {
                if (arrowLocation == "left" || arrowLocation == "right") {
                    n.width += q;
                    y -= q / 2;
                    if (arrowLocation == "right") {
                        x -= q
                    }
                }
            }
            if (x + n.width > rect.x + rect.width) {
                arrowLocation = "";
                x = rect.x + rect.width - n.width
            }
            if (y + n.height > rect.y + rect.height) {
                arrowLocation = "";
                y = rect.y + rect.height - n.height
            }
            var h = {
                    x: 0,
                    y: 0
                },
                d = {
                    x: 0,
                    y: 0
                };
            a(s).css({
                width: o.width,
                height: o.height,
                left: 0,
                top: 0
            });
            b.style["margin-top"] = b.style["margin-left"] = 0;
            g.style["margin-top"] = g.style["margin-left"] = 0;
            s.style["margin-top"] = s.style["margin-left"] = 0;
            var i = q + "px solid";
            var c = q + "px solid transparent";
            switch (arrowLocation) {
                case "left":
                    h = {
                        x: 0,
                        y: (o.height - q) / 2
                    };
                    contentPostion = {
                        x: q,
                        y: 0
                    };
                    s.style["margin-left"] = q + "px";
                    b.style["margin-left"] = 0 + "px";
                    b.style["margin-top"] = h.y + "px";
                    b.style["border-left"] = "";
                    b.style["border-right"] = i + " " + v.stroke;
                    b.style["border-top"] = c;
                    b.style["border-bottom"] = c;
                    g.style["margin-left"] = 1 + "px";
                    g.style["margin-top"] = h.y + "px";
                    g.style["border-left"] = "";
                    g.style["border-right"] = i + " " + v.fill;
                    g.style["border-top"] = c;
                    g.style["border-bottom"] = c;
                    break;
                case "right":
                    h = {
                        x: n.width - q,
                        y: (o.height - q) / 2
                    };
                    contentPostion = {
                        x: 0,
                        y: 0
                    };
                    b.style["margin-left"] = h.x + "px";
                    b.style["margin-top"] = h.y + "px";
                    b.style["border-left"] = i + " " + v.stroke;
                    b.style["border-right"] = "";
                    b.style["border-top"] = c;
                    b.style["border-bottom"] = c;
                    g.style["margin-left"] = h.x - 1 + "px";
                    g.style["margin-top"] = h.y + "px";
                    g.style["border-left"] = i + " " + v.fill;
                    g.style["border-right"] = "";
                    g.style["border-top"] = c;
                    g.style["border-bottom"] = c;
                    break;
                case "top":
                    h = {
                        x: n.width / 2 - q / 2,
                        y: 0
                    };
                    contentPostion = {
                        x: 0,
                        y: q
                    };
                    s.style["margin-top"] = contentPostion.y + "px";
                    b.style["margin-left"] = h.x + "px";
                    b.style["border-top"] = "";
                    b.style["border-bottom"] = i + " " + v.stroke;
                    b.style["border-left"] = c;
                    b.style["border-right"] = c;
                    g.style["margin-left"] = h.x + "px";
                    g.style["margin-top"] = 1 + "px";
                    g.style["border-top"] = "";
                    g.style["border-bottom"] = i + " " + v.fill;
                    g.style["border-left"] = c;
                    g.style["border-right"] = c;
                    break;
                case "bottom":
                    h = {
                        x: n.width / 2 - q / 2,
                        y: n.height - q
                    };
                    contentPostion = {
                        x: 0,
                        y: 0
                    };
                    b.style["margin-left"] = h.x + "px";
                    b.style["margin-top"] = h.y + "px";
                    b.style["border-top"] = i + " " + v.stroke;
                    b.style["border-bottom"] = "";
                    b.style["border-left"] = c;
                    b.style["border-right"] = c;
                    g.style["margin-left"] = h.x + "px";
                    g.style["margin-top"] = h.y - 1 + "px";
                    g.style["border-top"] = i + " " + v.fill;
                    g.style["border-bottom"] = "";
                    g.style["border-left"] = c;
                    g.style["border-right"] = c;
                    break
            }
            if (arrowLocation == "") {
                a(b).hide();
                a(g).hide()
            } else {
                a(b).show();
                a(g).show()
            }
            a(B).css({
                width: n.width + "px",
                height: n.height + "px"
            });
            var m = p.host.coord();
            if (A) {
                a(B).fadeOut(0, 0);
                B.style.left = x + m.left + "px";
                B.style.top = y + m.top + "px"
            }
            a(B).clearQueue();
            a(B).animate({
                left: x + m.left,
                top: y + m.top,
                opacity: 1
            }, p.toolTipMoveDuration, "easeInOutCirc");
            a(B).fadeTo(400, 1)
        },
        _measureHtml: function(c, b) {
            var e = this._measureDiv;
            if (!e) {
                this._measureDiv = e = document.createElement("div");
                e.style.position = "absolute";
                e.style.cursor = "default";
                e.style.overflow = "hidden";
                e.style.display = "none";
                a(e).addClass(b);
                this.host.append(e)
            }
            a(e).html(c);
            var d = {
                width: a(e).width() + 2,
                height: a(e).height() + 2
            };
            if (a.jqx.browser && a.jqx.browser.mozilla) {
                d.height += 3
            }
            return d
        },
        _hideToolTip: function(b) {
            if (!this._ttEl) {
                return
            }
            if (this._ttEl.box) {
                if (b == 0) {
                    a(this._ttEl.box).hide()
                } else {
                    a(this._ttEl.box).fadeOut()
                }
            }
            this._hideCrosshairs();
            this._ttEl.gidx = undefined
        },
        _hideCrosshairs: function() {
            if (!this._ttEl) {
                return
            }
            if (this._ttEl.vLine) {
                this.renderer.removeElement(this._ttEl.vLine);
                this._ttEl.vLine = undefined
            }
            if (this._ttEl.hLine) {
                this.renderer.removeElement(this._ttEl.hLine);
                this._ttEl.hLine = undefined
            }
        },
        _get: function(b) {
            return a.jqx.getByPriority(b)
        },
        _getAxisSettings: function(f) {
            if (!f) {
                return {}
            }
            var l = this;
            var k = f.gridLines || {};
            var n = {
                visible: this._get([k.visible, f.showGridLines, true]),
                color: l._get([k.color, f.gridLinesColor, l._defaultLineColor]),
                unitInterval: l._get([k.unitInterval, k.interval, f.gridLinesInterval]),
                step: l._get([k.step, f.gridLinesStep]),
                dashStyle: l._get([k.dashStyle, f.gridLinesDashStyle]),
                width: l._get([k.lineWidth, 1]),
                offsets: [],
                alternatingBackgroundColor: f.alternatingBackgroundColor,
                alternatingBackgroundColor2: f.alternatingBackgroundColor2,
                alternatingBackgroundOpacity: f.alternatingBackgroundOpacity
            };
            var d = f.tickMarks || {};
            var h = {
                visible: this._get([d.visible, f.showTickMarks, true]),
                color: l._get([d.color, f.tickMarksColor, l._defaultLineColor]),
                unitInterval: l._get([d.unitInterval, d.interval, f.tickMarksInterval]),
                step: l._get([d.step, f.tickMarksStep]),
                dashStyle: l._get([d.dashStyle, f.tickMarksDashStyle]),
                width: l._get([d.lineWidth, 1]),
                size: l._get([d.size, 4]),
                offsets: []
            };
            var e = f.title || {};
            var c = {
                visible: l._get([e.visible, true]),
                text: l._get([f.description, e.text]),
                style: l._get([f.descriptionClass, e["class"], l.toThemeProperty("jqx-chart-axis-description", null)]),
                halign: l._get([f.horizontalDescriptionAlignment, e.horizontalAlignment, "center"]),
                valign: l._get([f.verticalDescriptionAlignment, e.verticalAlignment, "center"]),
                angle: 0,
                rotationPoint: l._get([e.rotationPoint, "centercenter"]),
                offset: l._get([e.offset, {
                    x: 0,
                    y: 0
                }])
            };
            var i = f.line || {};
            var b = {
                visible: l._get([i.visible, true]),
                color: l._get([i.color, n.color, l._defaultLineColor]),
                dashStyle: l._get([i.dashStyle, n.dashStyle, ""]),
                width: l._get([i.lineWidth, 1]),
                angle: l._get([i.angle, NaN])
            };
            var j = f.padding || {};
            j = {
                left: j.left || 0,
                right: j.right || 0,
                top: j.top || 0,
                bottom: j.bottom || 0
            };
            var g = this._getAxisLabelsSettings(f);
            var m = {
                visible: this._get([f.visible, f.showValueAxis, f.showXAxis, f.showCategoryAxis, true]),
                customDraw: this._get([f.customDraw, false]),
                gridLines: n,
                tickMarks: h,
                line: b,
                title: c,
                labels: g,
                padding: j,
                toolTipFormatFunction: this._get([f.toolTipFormatFunction, f.formatFunction, g.formatFunction]),
                toolTipFormatSettings: this._get([f.toolTipFormatSettings, f.formatSettings, g.formatSettings])
            };
            return m
        },
        _getAxisLabelsSettings: function(d) {
            var b = this;
            var e = d.labels || {};
            var c = {
                visible: b._get([d.showLabels, e.visible, true]),
                unitInterval: b._get([e.unitInterval, e.interval, d.labelsInterval]),
                step: b._get([e.step, d.labelsStep]),
                angle: b._get([d.textRotationAngle, e.angle, 0]),
                style: b._get([d["class"], e["class"], b.toThemeProperty("jqx-chart-axis-text", null)]),
                halign: b._get([d.horizontalTextAlignment, e.horizontalAlignment, "center"]),
                valign: b._get([d.verticalTextAlignment, e.verticalAlignment, "center"]),
                textRotationPoint: b._get([d.textRotationPoint, e.rotationPoint, "auto"]),
                textOffset: b._get([d.textOffset, e.offset, {
                    x: 0,
                    y: 0
                }]),
                autoRotate: b._get([d.labelsAutoRotate, e.autoRotate, false]),
                formatSettings: b._get([d.formatSettings, e.formatSettings, undefined]),
                formatFunction: b._get([d.formatFunction, e.formatFunction, undefined])
            };
            return c
        },
        _getLabelsSettings: function(p, l, h, t) {
            var j = this.seriesGroups[p];
            var r = j.series[l];
            var m = isNaN(h) ? undefined : this._getDataValue(h, r.dataField, p);
            var k = t || ["Visible", "Offset", "Angle", "HorizontalAlignment", "VerticalAlignment", "Class", "BackgroundColor", "BorderColor", "BorderOpacity", "Padding", "Opacity", "BackgroundOpacity", "LinesAngles", "LinesEnabled", "AutoRotate", "Radius"];
            var q = {};
            for (var f = 0; f < k.length; f++) {
                var n = k[f];
                var c = "labels" + n;
                var b = "label" + n;
                var o = n.substring(0, 1).toLowerCase() + n.substring(1);
                var d = undefined;
                if (j.labels && typeof(j.labels) == "object") {
                    d = j.labels[o]
                }
                if (r.labels && typeof(r.labels) == "object" && undefined != r.labels[o]) {
                    d = r.labels[o]
                }
                d = this._get([r[c], r[b], d, j[c], j[b]]);
                if (a.isFunction(d)) {
                    q[o] = d(m, h, r, j)
                } else {
                    q[o] = d
                }
            }
            q["class"] = q["class"] || this.toThemeProperty("jqx-chart-label-text", null);
            q.visible = this._get([q.visible, r.showLabels, j.showLabels, r.labels != undefined ? true : undefined, j.labels != undefined ? true : undefined]);
            var e = q.padding || 1;
            q.padding = {
                left: this._get([e.left, isNaN(e) ? 1 : e]),
                right: this._get([e.right, isNaN(e) ? 1 : e]),
                top: this._get([e.top, isNaN(e) ? 1 : e]),
                bottom: this._get([e.bottom, isNaN(e) ? 1 : e])
            };
            return q
        },
        _showLabel: function(J, E, f, b, t, i, e, k, c, F, B) {
            var m = this.seriesGroups[J];
            var r = m.series[E];
            var C = {
                    width: 0,
                    height: 0
                },
                q;
            if (isNaN(f)) {
                return
            }
            var I = this._getLabelsSettings(J, E, f);
            if (!I.visible) {
                return e ? C : undefined
            }
            if (b.width < 0 || b.height < 0) {
                return e ? C : undefined
            }
            var g = I.angle;
            if (!isNaN(F)) {
                g = F
            }
            var j = I.offset || {};
            var G = {
                x: j.x,
                y: j.y
            };
            if (isNaN(G.x)) {
                G.x = 0
            }
            if (isNaN(G.y)) {
                G.y = 0
            }
            t = t || I.horizontalAlignment || "center";
            i = i || I.verticalAlignment || "center";
            var v = this._getFormattedValue(J, E, f, undefined, undefined, true);
            var s = b.width;
            var H = b.height;
            if (k == true && t != "center") {
                t = t == "right" ? "left" : "right"
            }
            if (c == true && i != "center" && i != "middle") {
                i = i == "top" ? "bottom" : "top";
                G.y *= -1
            }
            C = this.renderer.measureText(v, g, {
                "class": I["class"]
            });
            if (e) {
                return C
            }
            var p = 0,
                n = 0;
            if (s > 0) {
                if (t == "" || t == "center") {
                    p += (s - C.width) / 2
                } else {
                    if (t == "right") {
                        p += (s - C.width)
                    }
                }
            }
            if (H > 0) {
                if (i == "" || i == "center") {
                    n += (H - C.height) / 2
                } else {
                    if (i == "bottom") {
                        n += (H - C.height)
                    }
                }
            }
            p += b.x + G.x;
            n += b.y + G.y;
            var o = this._plotRect;
            if (p <= o.x) {
                p = o.x + 2
            }
            if (n <= o.y) {
                n = o.y + 2
            }
            var l = {
                width: Math.max(C.width, 1),
                height: Math.max(C.height, 1)
            };
            if (n + l.height >= o.y + o.height) {
                n = o.y + o.height - (q ? (l.height + q.height) / 2 : l.height) - 2
            }
            if (p + l.width >= o.x + o.width) {
                p = o.x + o.width - l.width - 2
            }
            var d;
            var A = I.backgroundColor;
            var D = I.borderColor;
            var z = I.padding;
            if (A || D) {
                d = this.renderer.beginGroup();
                var b = this.renderer.rect(p - z.left, n - z.top, C.width + z.left + z.right, C.height + z.bottom + z.bottom, {
                    fill: A || "transparent",
                    "fill-opacity": I.backgroundOpacity || 1,
                    stroke: D || "transparent",
                    "stroke-opacity": I.borderOpacity,
                    "stroke-width": 1
                })
            }
            var u = this.renderer.text(v, p, n, C.width, C.height, g, {
                "class": I["class"],
                opacity: I.opacity || 1
            }, false, "center", "center");
            if (B) {
                B.x = p - z.left;
                B.y = n - z.top;
                B.width = C.width + z.left + z.right;
                B.height = C.height + z.bottom + z.bottom
            }
            if (this._isVML) {
                this.renderer.removeElement(u);
                this.renderer.getContainer()[0].appendChild(u)
            }
            if (d) {
                this.renderer.endGroup()
            }
            return d || u
        },
        _getAnimProps: function(j, f) {
            var e = this.seriesGroups[j];
            var c = !isNaN(f) ? e.series[f] : undefined;
            var b = this.enableAnimations == true;
            if (e.enableAnimations) {
                b = e.enableAnimations == true
            }
            if (c && c.enableAnimations) {
                b = c.enableAnimations == true
            }
            var i = this.animationDuration;
            if (isNaN(i)) {
                i = 1000
            }
            var d = e.animationDuration;
            if (!isNaN(d)) {
                i = d
            }
            if (c) {
                var h = c.animationDuration;
                if (!isNaN(h)) {
                    i = h
                }
            }
            if (i > 5000) {
                i = 1000
            }
            return {
                enabled: b,
                duration: i
            }
        },
        _isColorTransition: function(f, d, e, g) {
            if (g - 1 < e.xoffsets.first) {
                return false
            }
            var b = this._getColors(f, d, g, this._getGroupGradientType(f));
            var c = this._getColors(f, d, g - 1, this._getGroupGradientType(f));
            return (b.fillColor != c.fillColor)
        },
        _renderLineSeries: function(k, R) {
            var I = this.seriesGroups[k];
            if (!I.series || I.series.length == 0) {
                return
            }
            var s = I.type.indexOf("area") != -1;
            var L = I.type.indexOf("stacked") != -1;
            var e = L && I.type.indexOf("100") != -1;
            var af = I.type.indexOf("spline") != -1;
            var t = I.type.indexOf("step") != -1;
            var P = I.type.indexOf("range") != -1;
            var ag = I.polar == true || I.spider == true;
            if (ag) {
                t = false
            }
            if (t && af) {
                return
            }
            var A = this._getDataLen(k);
            var ad = R.width / A;
            var ak = I.orientation == "horizontal";
            var C = this._getXAxis(k).flip == true;
            var z = R;
            if (ak) {
                z = {
                    x: R.y,
                    y: R.x,
                    width: R.height,
                    height: R.width
                }
            }
            var D = this._calcGroupOffsets(k, z);
            if (!D || D.xoffsets.length == 0) {
                return
            }
            if (!this._linesRenderInfo) {
                this._linesRenderInfo = {}
            }
            this._linesRenderInfo[k] = {};
            for (var n = I.series.length - 1; n >= 0; n--) {
                var g = this._getSerieSettings(k, n);
                var ai = {
                    groupIndex: k,
                    rect: z,
                    serieIndex: n,
                    swapXY: ak,
                    isArea: s,
                    isSpline: af,
                    isRange: P,
                    isPolar: ag,
                    settings: g,
                    segments: [],
                    pointsLength: 0
                };
                var j = this._isSerieVisible(k, n);
                if (!j) {
                    this._linesRenderInfo[k][n] = ai;
                    continue
                }
                var K = I.series[n];
                if (K.customDraw) {
                    continue
                }
                var w = a.isFunction(K.colorFunction);
                var V = D.xoffsets.first;
                var H = V;
                var O = this._getColors(k, n, NaN, this._getGroupGradientType(k));
                var ac = false;
                var u;
                do {
                    var X = [];
                    var U = [];
                    var r = [];
                    var Q = -1;
                    var p = 0,
                        o = 0;
                    var S = NaN;
                    var F = NaN;
                    var aj = NaN;
                    if (D.xoffsets.length < 1) {
                        continue
                    }
                    var T = this._getAnimProps(k, n);
                    var M = T.enabled && !this._isToggleRefresh && D.xoffsets.length < 10000 && this._isVML != true ? T.duration : 0;
                    var v = V;
                    u = false;
                    var d = this._getColors(k, n, V, this._getGroupGradientType(k));
                    var E = undefined;
                    for (var ae = V; ae <= D.xoffsets.last; ae++) {
                        V = ae;
                        var Y = D.xoffsets.data[ae];
                        var W = D.xoffsets.xvalues[ae];
                        if (isNaN(Y)) {
                            continue
                        }
                        Y = Math.max(Y, 1);
                        p = Y;
                        o = D.offsets[n][ae].to;
                        if (!w && E && this.enableSampling && a.jqx._ptdist(E.x, E.y, p, o) < 1) {
                            continue
                        }
                        E = {
                            x: p,
                            y: o
                        };
                        var ab = D.offsets[n][ae].from;
                        if (isNaN(o) || isNaN(ab)) {
                            if (K.emptyPointsDisplay == "connect") {
                                continue
                            } else {
                                if (K.emptyPointsDisplay == "zero") {
                                    if (isNaN(o)) {
                                        o = D.baseOffset
                                    }
                                    if (isNaN(ab)) {
                                        ab = D.baseOffset
                                    }
                                } else {
                                    u = true;
                                    break
                                }
                            }
                        }
                        if (w && this._isColorTransition(k, n, D, V)) {
                            if (X.length > 1) {
                                V--;
                                break
                            }
                        }
                        var c = this._elementRenderInfo;
                        if (c && c.length > k && c[k].series.length > n) {
                            var f = c[k].series[n][W];
                            var aj = a.jqx._ptrnd(f ? f.to : undefined);
                            var J = a.jqx._ptrnd(z.x + (f ? f.xoffset : undefined));
                            r.push(ak ? {
                                y: J,
                                x: aj,
                                index: ae
                            } : {
                                x: J,
                                y: aj,
                                index: ae
                            })
                        }
                        H = ae;
                        if (g.stroke < 2) {
                            if (o - z.y <= 1) {
                                o = z.y + 1
                            }
                            if (ab - z.y <= 1) {
                                ab = z.y + 1
                            }
                            if (z.y + z.height - o <= 1) {
                                o = z.y + z.height - 1
                            }
                            if (z.y + z.height - ab <= 1) {
                                ab = z.y + z.height - 1
                            }
                        }
                        if (!s && e) {
                            if (o <= z.y) {
                                o = z.y + 1
                            }
                            if (o >= z.y + z.height) {
                                o = z.y + z.height - 1
                            }
                            if (ab <= z.y) {
                                ab = z.y + 1
                            }
                            if (ab >= z.y + z.height) {
                                ab = z.y + z.height - 1
                            }
                        }
                        Y = Math.max(Y, 1);
                        p = Y + z.x;
                        if (I.skipOverlappingPoints == true && !isNaN(S) && Math.abs(S - p) <= 1) {
                            continue
                        }
                        if (t && !isNaN(S) && !isNaN(F)) {
                            if (F != o) {
                                X.push(ak ? {
                                    y: p,
                                    x: a.jqx._ptrnd(F)
                                } : {
                                    x: p,
                                    y: a.jqx._ptrnd(F)
                                })
                            }
                        }
                        X.push(ak ? {
                            y: p,
                            x: a.jqx._ptrnd(o),
                            index: ae
                        } : {
                            x: p,
                            y: a.jqx._ptrnd(o),
                            index: ae
                        });
                        U.push(ak ? {
                            y: p,
                            x: a.jqx._ptrnd(ab),
                            index: ae
                        } : {
                            x: p,
                            y: a.jqx._ptrnd(ab),
                            index: ae
                        });
                        S = p;
                        F = o;
                        if (isNaN(aj)) {
                            aj = o
                        }
                    }
                    if (X.length == 0) {
                        V++;
                        continue
                    }
                    var G = X[X.length - 1].index;
                    if (w) {
                        O = this._getColors(k, n, G, this._getGroupGradientType(k))
                    }
                    var l = z.x + D.xoffsets.data[v];
                    var aa = z.x + D.xoffsets.data[H];
                    if (s && I.alignEndPointsWithIntervals == true) {
                        var B = C ? -1 : 1;
                        if (l > z.x) {
                            l = z.x
                        }
                        if (aa < z.x + z.width) {
                            aa = z.x + z.width
                        }
                        if (C) {
                            var Z = l;
                            l = aa;
                            aa = Z
                        }
                    }
                    aa = a.jqx._ptrnd(aa);
                    l = a.jqx._ptrnd(l);
                    var m = D.baseOffset;
                    aj = a.jqx._ptrnd(aj);
                    var h = a.jqx._ptrnd(o) || m;
                    if (P) {
                        X = X.concat(U.reverse())
                    }
                    ai.pointsLength += X.length;
                    var b = {
                        lastItemIndex: G,
                        colorSettings: O,
                        pointsArray: X,
                        pointsStart: r,
                        left: l,
                        right: aa,
                        pyStart: aj,
                        pyEnd: h,
                        yBase: m,
                        labelElements: [],
                        symbolElements: []
                    };
                    ai.segments.push(b)
                } while (V < D.xoffsets.first + D.xoffsets.length - 1 || u);
                this._linesRenderInfo[k][n] = ai
            }
            var N = this._linesRenderInfo[k];
            var ah = [];
            for (var ae in N) {
                ah.push(N[ae])
            }
            ah = ah.sort(function(al, i) {
                return al.serieIndex - i.serieIndex
            });
            if (s && L) {
                ah.reverse()
            }
            for (var ae = 0; ae < ah.length; ae++) {
                var ai = ah[ae];
                this._animateLine(ai, M == 0 ? 1 : 0);
                var q = this;
                this._enqueueAnimation("series", undefined, undefined, M, function(al, i, am) {
                    q._animateLine(i, am)
                }, ai)
            }
        },
        _animateLine: function(w, b) {
            var C = w.settings;
            var f = w.groupIndex;
            var g = w.serieIndex;
            var j = this.seriesGroups[f];
            var s = j.series[g];
            var v = this._getSymbol(f, g);
            var p = this._getLabelsSettings(f, g, NaN, ["Visible"]).visible;
            var o = true;
            if (w.isPolar) {
                if (!isNaN(j.endAngle) && Math.round(Math.abs((isNaN(j.startAngle) ? 0 : j.startAngle) - j.endAngle)) != 360) {
                    o = false
                }
            }
            if (s.endPointsConnect == false) {
                o = false
            }
            var q = 0;
            for (var d = 0; d < w.segments.length; d++) {
                var u = w.segments[d];
                var z = this._calculateLine(f, w.pointsLength, q, u.pointsArray, u.pointsStart, u.yBase, b, w.isArea, w.swapXY);
                q += u.pointsArray.length;
                if (z == "") {
                    continue
                }
                var r = z.split(" ");
                var A = r.length;
                var h = z;
                if (h != "") {
                    h = this._buildLineCmd(z, w.isRange, u.left, u.right, u.pyStart, u.pyEnd, u.yBase, w.isArea, w.isPolar, o, w.isSpline, w.swapXY)
                } else {
                    h = "M 0 0"
                }
                var l = u.colorSettings;
                if (!u.pathElement) {
                    u.pathElement = this.renderer.path(h, {
                        "stroke-width": C.stroke,
                        stroke: l.lineColor,
                        "stroke-opacity": C.opacity,
                        "fill-opacity": C.opacity,
                        "stroke-dasharray": C.dashStyle,
                        fill: w.isArea ? l.fillColor : "none"
                    });
                    this._installHandlers(u.pathElement, "path", f, g, u.lastItemIndex)
                } else {
                    this.renderer.attr(u.pathElement, {
                        d: h
                    })
                }
                if (u.labelElements) {
                    for (var B = 0; B < u.labelElements.length; B++) {
                        this.renderer.removeElement(u.labelElements[B])
                    }
                    u.labelElements = []
                }
                if (u.symbolElements) {
                    for (var B = 0; B < u.symbolElements.length; B++) {
                        this.renderer.removeElement(u.symbolElements[B])
                    }
                    u.symbolElements = []
                }
                if (u.pointsArray.length == r.length) {
                    if (v != "none" || p) {
                        var E = s.symbolSize;
                        var D = this._plotRect;
                        for (var B = 0; B < r.length; B++) {
                            var t = r[B].split(",");
                            t = {
                                x: parseFloat(t[0]),
                                y: parseFloat(t[1])
                            };
                            if (t.x < D.x || t.x > D.x + D.width || t.y < D.y || t.y > D.y + D.height) {
                                continue
                            }
                            if (v != "none") {
                                var n = this._getColors(f, g, u.pointsArray[B].index, this._getGroupGradientType(f));
                                var e = this._drawSymbol(v, t.x, t.y, n.fillColorSymbol, C.opacity, n.lineColorSymbol, C.opacity, C.strokeSymbol, undefined, E);
                                u.symbolElements.push(e)
                            }
                            if (p) {
                                var k = (B > 0 ? r[B - 1] : r[B]).split(",");
                                k = {
                                    x: parseFloat(k[0]),
                                    y: parseFloat(k[1])
                                };
                                var m = (B < r.length - 1 ? r[B + 1] : r[B]).split(",");
                                m = {
                                    x: parseFloat(m[0]),
                                    y: parseFloat(m[1])
                                };
                                t = this._adjustLineLabelPosition(f, g, u.pointsArray[B].index, t, k, m);
                                if (t) {
                                    var c = this._showLabel(f, g, u.pointsArray[B].index, {
                                        x: t.x,
                                        y: t.y,
                                        width: 0,
                                        height: 0
                                    });
                                    u.labelElements.push(c)
                                }
                            }
                        }
                    }
                }
                if (b == 1 && v != "none") {
                    for (var B = 0; B < u.symbolElements.length; B++) {
                        if (isNaN(u.pointsArray[B].index)) {
                            continue
                        }
                        this._installHandlers(u.symbolElements[B], "symbol", f, g, u.pointsArray[B].index)
                    }
                }
            }
        },
        _adjustLineLabelPosition: function(i, g, d, h, f, e) {
            var b = this._showLabel(i, g, d, {
                width: 0,
                height: 0
            }, "", "", true);
            if (!b) {
                return
            }
            var c = {
                x: h.x - b.width / 2,
                y: 0
            };
            c.y = h.y - 1.5 * b.height;
            return c
        },
        _calculateLine: function(h, v, p, o, n, f, e, z, c) {
            var w = this.seriesGroups[h];
            var m;
            if (w.polar == true || w.spider == true) {
                m = this._getPolarAxisCoords(h, this._plotRect)
            }
            var s = "";
            var t = o.length;
            if (!z && n.length == 0) {
                var r = v * e;
                t = r - p
            }
            var j = NaN;
            for (var u = 0; u < t + 1 && u < o.length; u++) {
                if (u > 0) {
                    s += " "
                }
                var k = o[u].y;
                var l = o[u].x;
                var b = !z ? k : f;
                var d = l;
                if (n && n.length > u) {
                    b = n[u].y;
                    d = n[u].x;
                    if (isNaN(b) || isNaN(d)) {
                        b = k;
                        d = l
                    }
                }
                j = d;
                if (t <= o.length && u > 0 && u == t) {
                    d = o[u - 1].x;
                    b = o[u - 1].y
                }
                if (c) {
                    l = a.jqx._ptrnd((l - b) * (z ? e : 1) + b);
                    k = a.jqx._ptrnd(k)
                } else {
                    l = a.jqx._ptrnd((l - d) * e + d);
                    k = a.jqx._ptrnd((k - b) * e + b)
                }
                if (m) {
                    var q = this._toPolarCoord(m, this._plotRect, l, k);
                    l = q.x;
                    k = q.y
                }
                s += l + "," + k
            }
            return s
        },
        _buildLineCmd: function(k, o, g, s, e, m, d, r, c, j, f, b) {
            var p = k;
            var l = b ? d + "," + g : g + "," + d;
            var h = b ? d + "," + s : s + "," + d;
            if (r && !c && !o) {
                p = l + " " + k + " " + h
            }
            if (f) {
                p = this._getBezierPoints(p)
            }
            var n = p.split(" ");
            if (n.length == 0) {
                return ""
            }
            if (n.length == 1) {
                var q = n[0].split(",");
                return "M " + n[0] + " L" + (parseFloat(q[0]) + 1) + "," + (parseFloat(q[1]) + 1)
            }
            var i = n[0].replace("M", "");
            if (r && !c) {
                if (!o) {
                    p = "M " + l + " L " + i + " " + p
                } else {
                    p = "M " + i + " L " + i + (f ? "" : (" L " + i + " ")) + p
                }
            } else {
                if (!f) {
                    p = "M " + i + " L " + i + " " + p
                }
            }
            if ((c && j) || o) {
                p += " Z"
            }
            return p
        },
        _getSerieSettings: function(i, c) {
            var h = this.seriesGroups[i];
            var g = h.type.indexOf("area") != -1;
            var f = h.type.indexOf("line") != -1;
            var d = h.series[c];
            var k = d.dashStyle || h.dashStyle || "";
            var e = d.opacity || h.opacity;
            if (isNaN(e) || e < 0 || e > 1) {
                e = 1
            }
            var j = d.lineWidth;
            if (isNaN(j) && j != "auto") {
                j = h.lineWidth
            }
            if (j == "auto" || isNaN(j) || j < 0 || j > 15) {
                if (g) {
                    j = 2
                } else {
                    if (f) {
                        j = 3
                    } else {
                        j = 1
                    }
                }
            }
            var b = d.lineWidthSymbol;
            if (isNaN(b)) {
                b = 1
            }
            return {
                stroke: j,
                strokeSymbol: b,
                opacity: e,
                dashStyle: k
            }
        },
        _getColors: function(u, p, d, e, b) {
            var k = this.seriesGroups[u];
            var o = k.series[p];
            var c = this._get([o.useGradientColors, k.useGradientColors, k.useGradient, true]);
            var l = this._getSeriesColors(u, p, d);
            if (!l.fillColor) {
                l.fillColor = r;
                l.fillColorSelected = a.jqx.adjustColor(r, 1.1);
                l.fillColorAlt = a.jqx.adjustColor(r, 4);
                l.fillColorAltSelected = a.jqx.adjustColor(r, 3);
                l.lineColor = l.symbolColor = a.jqx.adjustColor(r, 0.9);
                l.lineColorSelected = l.symbolColorSelected = a.jqx.adjustColor(r, 0.9)
            }
            var h = [
                [0, 1.4],
                [100, 1]
            ];
            var f = [
                [0, 1],
                [25, 1.1],
                [50, 1.4],
                [100, 1]
            ];
            var n = [
                [0, 1.3],
                [90, 1.2],
                [100, 1]
            ];
            var j = NaN;
            if (!isNaN(b)) {
                j = b == 2 ? h : f
            }
            if (c) {
                var q = {};
                for (var s in l) {
                    q[s] = l[s]
                }
                l = q;
                if (e == "verticalLinearGradient" || e == "horizontalLinearGradient") {
                    var g = e == "verticalLinearGradient" ? j || h : j || f;
                    var m = ["fillColor", "fillColorSelected", "fillColorAlt", "fillColorAltSelected"];
                    for (var v in m) {
                        var r = l[m[v]];
                        if (r) {
                            l[m[v]] = this.renderer._toLinearGradient(r, e == "verticalLinearGradient", g)
                        }
                    }
                } else {
                    if (e == "radialGradient") {
                        var t;
                        var j = h;
                        if ((k.type == "pie" || k.type == "donut" || k.polar) && d != undefined && this._renderData[u] && this._renderData[u].offsets[p]) {
                            t = this._renderData[u].offsets[p][d];
                            j = n
                        }
                        l.fillColor = this.renderer._toRadialGradient(l.fillColor, j, t);
                        l.fillColorSelected = this.renderer._toRadialGradient(l.fillColorSelected, j, t)
                    }
                }
            }
            return l
        },
        _installHandlers: function(c, f, i, h, d) {
            if (!this.enableEvents) {
                return false
            }
            var j = this;
            var e = this.seriesGroups[i];
            var k = this.seriesGroups[i].series[h];
            var b = e.type.indexOf("line") != -1 || e.type.indexOf("area") != -1;
            if (!b && !(e.enableSelection == false || k.enableSelection == false)) {
                this.renderer.addHandler(c, "mousemove", function(m) {
                    var l = j._selected;
                    if (l && l.isLineType && l.linesUnselectMode == "click" && !(l.group == i && l.series == h)) {
                        return
                    }
                    var g = m.pageX || m.clientX || m.screenX;
                    var o = m.pageY || m.clientY || m.screenY;
                    var n = j.host.offset();
                    g -= n.left;
                    o -= n.top;
                    if (j._mouseX == g && j._mouseY == o) {
                        return
                    }
                    if (j._ttEl) {
                        if (j._ttEl.gidx == i && j._ttEl.sidx == h && j._ttEl.iidx == d) {
                            return
                        }
                    }
                    j._startTooltipTimer(i, h, d)
                })
            }
            if (!(e.enableSelection == false || k.enableSelection == false)) {
                this.renderer.addHandler(c, "mouseover", function(l) {
                    var g = j._selected;
                    if (g && g.isLineType && g.linesUnselectMode == "click" && !(g.group == i && g.series == h)) {
                        return
                    }
                    j._select(c, f, i, h, d, d)
                })
            }
            this.renderer.addHandler(c, "click", function(g) {
                clearTimeout(j._hostClickTimer);
                j._lastClickTs = (new Date()).valueOf();
                if (b && (f != "symbol" && f != "pointMarker")) {
                    return
                }
                if (j._isColumnType(e.type)) {
                    j._unselect()
                }
                if (isNaN(d)) {
                    return
                }
                g.stopImmediatePropagation();
                j._raiseItemEvent("click", e, k, d)
            })
        },
        _getHorizontalOffset: function(A, s, k, j) {
            var c = this._plotRect;
            var h = this._getDataLen(A);
            if (h == 0) {
                return {
                    index: undefined,
                    value: k
                }
            }
            var p = this._calcGroupOffsets(A, this._plotRect);
            if (p.xoffsets.length == 0) {
                return {
                    index: undefined,
                    value: undefined
                }
            }
            var n = k;
            var m = j;
            var w = this.seriesGroups[A];
            var l;
            if (w.polar || w.spider) {
                l = this._getPolarAxisCoords(A, c)
            }
            var e = this._getXAxis(A).flip == true;
            var b, o, v, f;
            for (var t = p.xoffsets.first; t <= p.xoffsets.last; t++) {
                var u = p.xoffsets.data[t];
                var d = p.offsets[s][t].to;
                var q = 0;
                if (l) {
                    var r = this._toPolarCoord(l, c, u + c.x, d);
                    u = r.x;
                    d = r.y;
                    q = a.jqx._ptdist(n, m, u, d)
                } else {
                    if (w.orientation == "horizontal") {
                        u += c.y;
                        var z = d;
                        d = u;
                        u = z;
                        q = a.jqx._ptdist(n, m, u, d)
                    } else {
                        u += c.x;
                        q = Math.abs(n - u)
                    }
                }
                if (isNaN(b) || b > q) {
                    b = q;
                    o = t;
                    v = u;
                    f = d
                }
            }
            return {
                index: o,
                value: p.xoffsets.data[o],
                polarAxisCoords: l,
                x: v,
                y: f
            }
        },
        onmousemove: function(k, j) {
            if (this._mouseX == k && this._mouseY == j) {
                return
            }
            this._mouseX = k;
            this._mouseY = j;
            if (!this._selected) {
                return
            }
            var B = this._selected.group;
            var q = this._selected.series;
            var v = this.seriesGroups[B];
            var n = v.series[q];
            var b = this._plotRect;
            if (this.renderer) {
                b = this.renderer.getRect();
                b.x += 5;
                b.y += 5;
                b.width -= 10;
                b.height -= 10
            }
            if (k < b.x || k > b.x + b.width || j < b.y || j > b.y + b.height) {
                this._hideToolTip();
                this._unselect();
                return
            }
            var e = v.orientation == "horizontal";
            var b = this._plotRect;
            if (v.type.indexOf("line") != -1 || v.type.indexOf("area") != -1) {
                var f = this._getHorizontalOffset(B, this._selected.series, k, j);
                var u = f.index;
                if (u == undefined) {
                    return
                }
                if (this._selected.item != u) {
                    var p = this._linesRenderInfo[B][q].segments;
                    var r = 0;
                    while (u > p[r].lastItemIndex) {
                        r++;
                        if (r >= p.length) {
                            return
                        }
                    }
                    var c = p[r].pathElement;
                    var C = p[r].lastItemIndex;
                    this._unselect(false);
                    this._select(c, "path", B, q, u, C)
                }
                var m = this._getSymbol(this._selected.group, this._selected.series);
                if (m == "none") {
                    m = "circle"
                }
                var o = this._calcGroupOffsets(B, b);
                var d = o.offsets[this._selected.series][u].to;
                var t = d;
                if (v.type.indexOf("range") != -1) {
                    t = o.offsets[this._selected.series][u].from
                }
                var l = e ? k : j;
                if (!isNaN(t) && Math.abs(l - t) < Math.abs(l - d)) {
                    j = t
                } else {
                    j = d
                }
                if (isNaN(j)) {
                    return
                }
                k = f.value;
                if (e) {
                    var z = k;
                    k = j;
                    j = z + b.y
                } else {
                    k += b.x
                }
                if (f.polarAxisCoords) {
                    k = f.x;
                    j = f.y
                }
                j = a.jqx._ptrnd(j);
                k = a.jqx._ptrnd(k);
                if (this._pointMarker && this._pointMarker.element) {
                    this.renderer.removeElement(this._pointMarker.element);
                    this._pointMarker.element = undefined
                }
                if (isNaN(k) || isNaN(j)) {
                    return
                }
                var h = this._getSeriesColors(B, q, u);
                var w = this._getSerieSettings(B, q);
                var A = n.symbolSizeSelected;
                if (isNaN(A)) {
                    A = n.symbolSize
                }
                if (isNaN(A) || A > 50 || A < 0) {
                    A = v.symbolSize
                }
                if (isNaN(A) || A > 50 || A < 0) {
                    A = 8
                }
                if (this.showToolTips || this.enableCrosshairs) {
                    this._pointMarker = {
                        type: m,
                        x: k,
                        y: j,
                        gidx: B,
                        sidx: q,
                        iidx: u
                    };
                    this._pointMarker.element = this._drawSymbol(m, k, j, h.fillColorSymbolSelected, w.opacity, h.lineColorSymbolSelected, w.opacity, w.strokeSymbol, w.dashStyle, A);
                    this._installHandlers(this._pointMarker.element, "pointMarker", B, q, u)
                }
                this._startTooltipTimer(B, this._selected.series, u)
            }
        },
        _drawSymbol: function(i, l, j, c, m, k, f, g, b, o) {
            var e;
            var h = o || 6;
            var d = h / 2;
            switch (i) {
                case "none":
                    return undefined;
                case "circle":
                    e = this.renderer.circle(l, j, h / 2);
                    break;
                case "square":
                    h = h - 1;
                    d = h / 2;
                    e = this.renderer.rect(l - d, j - d, h, h);
                    break;
                case "diamond":
                    var n = "M " + (l - d) + "," + (j) + " L" + (l) + "," + (j - d) + " L" + (l + d) + "," + (j) + " L" + (l) + "," + (j + d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_up":
                case "triangle":
                    var n = "M " + (l - d) + "," + (j + d) + " L " + (l + d) + "," + (j + d) + " L " + (l) + "," + (j - d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_down":
                    var n = "M " + (l - d) + "," + (j - d) + " L " + (l) + "," + (j + d) + " L " + (l + d) + "," + (j - d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_left":
                    var n = "M " + (l - d) + "," + (j) + " L " + (l + d) + "," + (j + d) + " L " + (l + d) + "," + (j - d) + " Z";
                    e = this.renderer.path(n);
                    break;
                case "triangle_right":
                    var n = "M " + (l - d) + "," + (j - d) + " L " + (l - d) + "," + (j + d) + " L " + (l + d) + "," + (j) + " Z";
                    e = this.renderer.path(n);
                    break;
                default:
                    e = this.renderer.circle(l, j, h)
            }
            this.renderer.attr(e, {
                fill: c,
                "fill-opacity": m,
                stroke: k,
                "stroke-width": g,
                "stroke-opacity": f,
                "stroke-dasharray": b || ""
            });
            if (i != "circle") {
                this.renderer.attr(e, {
                    r: h / 2
                });
                if (i != "square") {
                    this.renderer.attr(e, {
                        x: l,
                        y: j
                    })
                }
            }
            return e
        },
        _getSymbol: function(f, b) {
            var c = ["circle", "square", "diamond", "triangle_up", "triangle_down", "triangle_left", "triangle_right"];
            var e = this.seriesGroups[f];
            var d = e.series[b];
            var h;
            if (d.symbolType != undefined) {
                h = d.symbolType
            }
            if (h == undefined) {
                h = e.symbolType
            }
            if (h == "default") {
                return c[b % c.length]
            } else {
                if (h != undefined) {
                    return h
                }
            }
            return "none"
        },
        _startTooltipTimer: function(k, j, d, i, h, b, f) {
            this._cancelTooltipTimer();
            var l = this;
            var e = l.seriesGroups[k];
            var c = this.toolTipShowDelay || this.toolTipDelay;
            if (isNaN(c) || c > 10000 || c < 0) {
                c = 500
            }
            if (this._ttEl || (true == this.enableCrosshairs && false == this.showToolTips)) {
                c = 0
            }
            if (!isNaN(b)) {
                c = b
            }
            clearTimeout(this._tttimerHide);
            if (isNaN(i)) {
                i = l._mouseX
            }
            if (isNaN(h)) {
                h = l._mouseY - 3
            }
            if (c == 0) {
                l._showToolTip(i, h, k, j, d)
            }
            this._tttimer = setTimeout(function() {
                if (c != 0) {
                    l._showToolTip(i, h, k, j, d)
                }
                var g = l.toolTipHideDelay;
                if (!isNaN(f)) {
                    g = f
                }
                if (isNaN(g)) {
                    g = 4000
                }
                l._tttimerHide = setTimeout(function() {
                    l._hideToolTip();
                    l._unselect()
                }, g)
            }, c)
        },
        _cancelTooltipTimer: function() {
            clearTimeout(this._tttimer)
        },
        _getGroupGradientType: function(c) {
            var b = this.seriesGroups[c];
            if (b.type.indexOf("area") != -1) {
                return b.orientation == "horizontal" ? "horizontalLinearGradient" : "verticalLinearGradient"
            } else {
                if (this._isColumnType(b.type) || b.type.indexOf("candle") != -1) {
                    if (b.polar) {
                        return "radialGradient"
                    }
                    return b.orientation == "horizontal" ? "verticalLinearGradient" : "horizontalLinearGradient"
                } else {
                    if (b.type.indexOf("scatter") != -1 || b.type.indexOf("bubble") != -1 || this._isPieGroup(c)) {
                        return "radialGradient"
                    }
                }
            }
            return undefined
        },
        _select: function(h, l, o, n, i, m) {
            if (this._selected) {
                if ((this._selected.item != i || this._selected.series != n || this._selected.group != o)) {
                    this._unselect()
                } else {
                    return
                }
            }
            var k = this.seriesGroups[o];
            var p = k.series[n];
            if (k.enableSelection == false || p.enableSelection == false) {
                return
            }
            var f = k.type.indexOf("line") != -1 && k.type.indexOf("area") == -1;
            this._selected = {
                element: h,
                type: l,
                group: o,
                series: n,
                item: i,
                iidxBase: m,
                isLineType: f,
                linesUnselectMode: p.linesUnselectMode || k.linesUnselectMode
            };
            var b = this._getColors(o, n, m || i, this._getGroupGradientType(o));
            var c = b.fillColorSelected;
            if (f) {
                c = "none"
            }
            var e = this._getSerieSettings(o, n);
            var d = (l == "symbol") ? b.lineColorSymbolSelected : b.lineColorSelected;
            c = (l == "symbol") ? b.fillColorSymbolSelected : c;
            var j = (l == "symbol") ? 1 : e.stroke;
            if (this.renderer.getAttr(h, "fill") == b.fillColorAlt) {
                c = b.fillColorAltSelected
            }
            this.renderer.attr(h, {
                stroke: d,
                fill: c,
                "stroke-width": j
            });
            if (k.type.indexOf("pie") != -1 || k.type.indexOf("donut") != -1) {
                this._applyPieSelect()
            }
            this._raiseItemEvent("mouseover", k, p, i)
        },
        _applyPieSelect: function() {
            var c = this;
            c._createAnimationGroup("animPieSlice");
            var e = this._selected;
            if (!e) {
                return
            }
            var f = this.getItemCoord(e.group, e.series, e.item);
            if (!f) {
                return
            }
            var d = this._getRenderInfo(e.group, e.series, e.item);
            var b = {
                element: d,
                coord: f
            };
            this._enqueueAnimation("animPieSlice", undefined, undefined, 300, function(i, g, j) {
                var l = g.coord;
                var h = l.selectedRadiusChange * j;
                var k = c.renderer.pieSlicePath(l.center.x, l.center.y, l.innerRadius == 0 ? 0 : (l.innerRadius + h), l.outerRadius + h, l.fromAngle, l.toAngle, l.centerOffset);
                c.renderer.attr(g.element.element, {
                    d: k
                });
                c._showPieLabel(e.group, e.series, e.item, undefined, h)
            }, b);
            c._startAnimation("animPieSlice")
        },
        _applyPieUnselect: function() {
            this._stopAnimations();
            var b = this._selected;
            if (!b) {
                return
            }
            var d = this.getItemCoord(b.group, b.series, b.item);
            if (!d || !d.center) {
                return
            }
            var c = this.renderer.pieSlicePath(d.center.x, d.center.y, d.innerRadius, d.outerRadius, d.fromAngle, d.toAngle, d.centerOffset);
            this.renderer.attr(b.element, {
                d: c
            });
            this._showPieLabel(b.group, b.series, b.item, undefined, 0)
        },
        _unselect: function() {
            var o = this;
            if (o._selected) {
                var n = o._selected.group;
                var m = o._selected.series;
                var f = o._selected.item;
                var k = o._selected.iidxBase;
                var j = o._selected.type;
                var i = o.seriesGroups[n];
                var p = i.series[m];
                var e = i.type.indexOf("line") != -1 && i.type.indexOf("area") == -1;
                var b = o._getColors(n, m, k || f, o._getGroupGradientType(n));
                var c = b.fillColor;
                if (e) {
                    c = "none"
                }
                var d = o._getSerieSettings(n, m);
                var l = (j == "symbol") ? b.lineColorSymbol : b.lineColor;
                c = (j == "symbol") ? b.fillColorSymbol : c;
                if (this.renderer.getAttr(o._selected.element, "fill") == b.fillColorAltSelected) {
                    c = b.fillColorAlt
                }
                var h = (j == "symbol") ? 1 : d.stroke;
                o.renderer.attr(o._selected.element, {
                    stroke: l,
                    fill: c,
                    "stroke-width": h
                });
                if (i.type.indexOf("pie") != -1 || i.type.indexOf("donut") != -1) {
                    this._applyPieUnselect()
                }
                o._selected = undefined;
                if (!isNaN(f)) {
                    o._raiseItemEvent("mouseout", i, p, f)
                }
            }
            if (o._pointMarker) {
                if (o._pointMarker.element) {
                    o.renderer.removeElement(o._pointMarker.element);
                    o._pointMarker.element = undefined
                }
                o._pointMarker = undefined;
                o._hideCrosshairs()
            }
        },
        _raiseItemEvent: function(f, g, e, c) {
            var d = e[f] || g[f];
            var h = 0;
            for (; h < this.seriesGroups.length; h++) {
                if (this.seriesGroups[h] == g) {
                    break
                }
            }
            if (h == this.seriesGroups.length) {
                return
            }
            var b = {
                event: f,
                seriesGroup: g,
                serie: e,
                elementIndex: c,
                elementValue: this._getDataValue(c, e.dataField, h)
            };
            if (d && a.isFunction(d)) {
                d(b)
            }
            this._raiseEvent(f, b)
        },
        _raiseEvent: function(d, c) {
            var e = new a.Event(d);
            e.owner = this;
            c.event = d;
            e.args = c;
            var b = this.host.trigger(e);
            return b
        },
        _calcInterval: function(d, j, h) {
            var m = Math.abs(j - d);
            var k = m / h;
            var f = [1, 2, 3, 4, 5, 10, 15, 20, 25, 50, 100];
            var b = [0.5, 0.25, 0.125, 0.1];
            var c = 0.1;
            var g = f;
            if (k < 1) {
                g = b;
                c = 10
            }
            var l = 0;
            do {
                l = 0;
                if (k >= 1) {
                    c *= 10
                } else {
                    c /= 10
                }
                for (var e = 1; e < g.length; e++) {
                    if (Math.abs(g[l] * c - k) > Math.abs(g[e] * c - k)) {
                        l = e
                    } else {
                        break
                    }
                }
            } while (l == g.length - 1);
            return g[l] * c
        },
        _renderDataClone: function() {
            if (!this._renderData || this._isToggleRefresh) {
                return
            }
            var d = this._elementRenderInfo = [];
            if (this._isSelectorRefresh) {
                return
            }
            for (var h = 0; h < this._renderData.length; h++) {
                var c = this._getXAxis(h).dataField;
                while (d.length <= h) {
                    d.push({})
                }
                var b = d[h];
                var f = this._renderData[h];
                if (!f.offsets) {
                    continue
                }
                if (f.valueAxis) {
                    b.valueAxis = {
                        itemOffsets: {}
                    };
                    for (var j in f.valueAxis.itemOffsets) {
                        b.valueAxis.itemOffsets[j] = f.valueAxis.itemOffsets[j]
                    }
                }
                if (f.xAxis) {
                    b.xAxis = {
                        itemOffsets: {}
                    };
                    for (var j in f.xAxis.itemOffsets) {
                        b.xAxis.itemOffsets[j] = f.xAxis.itemOffsets[j]
                    }
                }
                b.series = [];
                var g = b.series;
                var l = this._isPieGroup(h);
                for (var m = 0; m < f.offsets.length; m++) {
                    g.push({});
                    for (var e = 0; e < f.offsets[m].length; e++) {
                        if (!l) {
                            g[m][f.xoffsets.xvalues[e]] = {
                                value: f.offsets[m][e].value,
                                valueRadius: f.offsets[m][e].valueRadius,
                                xoffset: f.xoffsets.data[e],
                                from: f.offsets[m][e].from,
                                to: f.offsets[m][e].to
                            }
                        } else {
                            var k = f.offsets[m][e];
                            g[m][k.displayValue] = {
                                value: k.value,
                                x: k.x,
                                y: k.y,
                                fromAngle: k.fromAngle,
                                toAngle: k.toAngle
                            }
                        }
                    }
                }
            }
        },
        getPolarDataPointOffset: function(d, c, f) {
            var e = this._renderData[f];
            if (!e) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var h = this.getValueAxisDataPointOffset(c, f);
            var b = this.getXAxisDataPointOffset(d, f);
            var g = this._toPolarCoord(e.polarCoords, e.xAxis.rect, b, h);
            return {
                x: g.x,
                y: g.y
            }
        },
        _getDataPointOffsetDiff: function(j, i, b, f, g, d, h) {
            var e = this._getDataPointOffset(j, b, f, g, d, h);
            var c = this._getDataPointOffset(i, b, f, g, d, h);
            return Math.abs(e - c)
        },
        _getXAxisRenderData: function(d) {
            if (d >= this._renderData.length) {
                return
            }
            var e = this.seriesGroups[d];
            var c = this._renderData[d].xAxis;
            if (!c) {
                return
            }
            if (e.xAxis == undefined) {
                for (var b = 0; b <= d; b++) {
                    if (this.seriesGroups[b].xAxis == undefined) {
                        break
                    }
                }
                c = this._renderData[b].xAxis
            }
            return c
        },
        getXAxisDataPointOffset: function(j, l) {
            var k = this.seriesGroups[l];
            if (isNaN(j)) {
                return NaN
            }
            renderData = this._getXAxisRenderData(l);
            if (!renderData) {
                return NaN
            }
            var f = renderData.data.axisStats;
            var i = f.min.valueOf();
            var b = f.max.valueOf();
            var g = b - i;
            if (g == 0) {
                g = 1
            }
            if (j.valueOf() > b || j.valueOf() < i) {
                return NaN
            }
            var c = this._getXAxis(l);
            var d = k.orientation == "horizontal" ? "height" : "width";
            var n = k.orientation == "horizontal" ? "y" : "x";
            var h = (j.valueOf() - i) / g;
            var m = renderData.rect[d] - renderData.data.padding.left - renderData.data.padding.right;
            if (k.polar || k.spider) {
                var e = this._renderData[l].polarCoords;
                if (e.isClosedCircle) {
                    m = renderData.data.axisSize
                }
            }
            return this._plotRect[n] + renderData.data.padding.left + m * (c.flip ? (1 - h) : h)
        },
        getValueAxisDataPointOffset: function(g, h) {
            var j = this._getValueAxis(h);
            if (!j) {
                return NaN
            }
            var i = this._renderData[h];
            if (!i) {
                return NaN
            }
            var f = j.flip == true;
            var d = i.logBase;
            var e = i.scale;
            var b = i.gbase;
            var c = i.baseOffset;
            return this._getDataPointOffset(g, b, d, e, c, f)
        },
        _getDataPointOffset: function(f, c, d, h, e, b) {
            var g;
            if (isNaN(f)) {
                f = c
            }
            if (!isNaN(d)) {
                g = (a.jqx.log(f, d) - a.jqx.log(c, d)) * h
            } else {
                g = (f - c) * h
            }
            if (this._isVML) {
                g = Math.round(g)
            }
            if (b) {
                g = e + g
            } else {
                g = e - g
            }
            return g
        },
        _calcGroupOffsets: function(l, L) {
            var z = this.seriesGroups[l];
            while (this._renderData.length < l + 1) {
                this._renderData.push({})
            }
            if (this._renderData[l] != null && this._renderData[l].offsets != undefined) {
                return this._renderData[l]
            }
            if (this._isPieGroup(l)) {
                return this._calcPieSeriesGroupOffsets(l, L)
            }
            var o = this._getValueAxis(l);
            if (!o || !z.series || z.series.length == 0) {
                return this._renderData[l]
            }
            var A = o.flip == true;
            var O = o.logarithmicScale == true;
            var N = o.logarithmicScaleBase || 10;
            var T = [];
            var F = z.type.indexOf("stacked") != -1;
            var d = F && z.type.indexOf("100") != -1;
            var K = z.type.indexOf("range") != -1;
            var U = this._isColumnType(z.type);
            var Z = z.type.indexOf("waterfall") != -1;
            var s = this._getDataLen(l);
            var r = z.baselineValue || o.baselineValue || 0;
            if (d) {
                r = 0
            }
            var ag = this._stats.seriesGroups[l];
            if (!ag || !ag.isValid) {
                return
            }
            var aj = ag.hasStackValueReversal;
            if (aj) {
                r = 0
            }
            if (Z && F) {
                if (aj) {
                    return
                } else {
                    r = ag.base
                }
            }
            if (r > ag.max) {
                r = ag.max
            }
            if (r < ag.min) {
                r = ag.min
            }
            var q = (d || O) ? ag.maxRange : ag.max - ag.min;
            var an = ag.min;
            var C = ag.max;
            var M = L.height / (O ? ag.intervals : q);
            var ai = 0;
            if (d) {
                if (an * C < 0) {
                    q /= 2;
                    ai = -(q + r) * M
                } else {
                    ai = -r * M
                }
            } else {
                ai = -(r - an) * M
            }
            if (A) {
                ai = L.y - ai
            } else {
                ai += L.y + L.height
            }
            var ah = [];
            var ad = [];
            var S = [];
            var al, H;
            if (O) {
                al = a.jqx.log(C, N) - a.jqx.log(r, N);
                if (F) {
                    al = ag.intervals;
                    r = d ? 0 : an
                }
                H = ag.intervals - al;
                if (!A) {
                    ai = L.y + al / ag.intervals * L.height
                }
            }
            ai = a.jqx._ptrnd(ai);
            var c = (an * C < 0) ? L.height / 2 : L.height;
            var m = [];
            var W = [];
            var ao = F && (U || O);
            var am = [];
            T = new Array(z.series.length);
            for (var ab = 0; ab < z.series.length; ab++) {
                T[ab] = new Array(s)
            }
            for (var ac = 0; ac < s; ac++) {
                if (!Z && F) {
                    W = []
                }
                for (var ab = 0; ab < z.series.length; ab++) {
                    if (!F && O) {
                        m = []
                    }
                    var D = z.series[ab];
                    var E = D.dataField;
                    var aq = D.dataFieldFrom;
                    var P = D.dataFieldTo;
                    var Y = D.radiusDataField || D.sizeDataField;
                    T[ab][ac] = {};
                    var g = this._isSerieVisible(l, ab);
                    if (z.type.indexOf("candle") != -1 || z.type.indexOf("ohlc") != -1) {
                        var b = ["Open", "Close", "High", "Low"];
                        for (var ak in b) {
                            var p = "dataField" + b[ak];
                            if (D[p]) {
                                T[ab][ac][b[ak]] = this._getDataPointOffset(this._getDataValueAsNumber(ac, D[p], l), r, O ? N : NaN, M, ai, A)
                            }
                        }
                        continue
                    }
                    if (F) {
                        while (W.length <= ac) {
                            W.push(0)
                        }
                    }
                    var ap = NaN;
                    if (K) {
                        ap = this._getDataValueAsNumber(ac, aq, l);
                        if (isNaN(ap)) {
                            ap = r
                        }
                    }
                    var J = NaN;
                    if (K) {
                        J = this._getDataValueAsNumber(ac, P, l)
                    } else {
                        J = this._getDataValueAsNumber(ac, E, l)
                    }
                    var e = this._getDataValueAsNumber(ac, Y, l);
                    if (F) {
                        W[ac] += g ? J : 0
                    }
                    if (!g) {
                        J = NaN
                    }
                    if (isNaN(J) || (O && J <= 0)) {
                        T[ab][ac] = {
                            from: undefined,
                            to: undefined
                        };
                        continue
                    }
                    var I;
                    if (F) {
                        if (ao) {
                            I = (J >= r) ? ah : ad
                        } else {
                            J = W[ac]
                        }
                    }
                    var af = M * (J - r);
                    if (K) {
                        af = M * (J - ap)
                    }
                    if (F && ao) {
                        if (!am[ac]) {
                            am[ac] = true;
                            af = M * (J - r)
                        } else {
                            af = M * J
                        }
                    }
                    if (O) {
                        while (m.length <= ac) {
                            m.push({
                                p: {
                                    value: 0,
                                    height: 0
                                },
                                n: {
                                    value: 0,
                                    height: 0
                                }
                            })
                        }
                        var B = (K || K) ? ap : r;
                        var aa = J > B ? m[ac].p : m[ac].n;
                        aa.value += J;
                        if (d) {
                            J = aa.value / (ag.psums[ac] + ag.nsums[ac]) * 100;
                            af = (a.jqx.log(J, N) - ag.minPow) * M
                        } else {
                            af = a.jqx.log(aa.value, N) - a.jqx.log(B, N);
                            af *= M
                        }
                        af -= aa.height;
                        aa.height += af
                    }
                    var R = ai;
                    if (K) {
                        var t = 0;
                        if (O) {
                            t = (a.jqx.log(ap, N) - a.jqx.log(r, N)) * M
                        } else {
                            t = (ap - r) * M
                        }
                        R += A ? t : -t
                    }
                    if (F) {
                        if (d && !O) {
                            var w = (ag.psums[ac] - ag.nsums[ac]);
                            if (J > r) {
                                af = (ag.psums[ac] / w) * c;
                                if (ag.psums[ac] != 0) {
                                    af *= J / ag.psums[ac]
                                }
                            } else {
                                af = (ag.nsums[ac] / w) * c;
                                if (ag.nsums[ac] != 0) {
                                    af *= J / ag.nsums[ac]
                                }
                            }
                        }
                        if (ao) {
                            if (isNaN(I[ac])) {
                                I[ac] = R
                            }
                            R = I[ac]
                        }
                    }
                    if (isNaN(S[ac])) {
                        S[ac] = 0
                    }
                    var ae = S[ac];
                    af = Math.abs(af);
                    var V = af;
                    if (af >= 1) {
                        h_new = this._isVML ? Math.round(af) : a.jqx._ptrnd(af) - 1;
                        if (Math.abs(af - h_new) > 0.5) {
                            af = Math.round(af)
                        } else {
                            af = h_new
                        }
                    }
                    ae += af - V;
                    if (!F) {
                        ae = 0
                    }
                    if (Math.abs(ae) > 0.5) {
                        if (ae > 0) {
                            af -= 1;
                            ae -= 1
                        } else {
                            af += 1;
                            ae += 1
                        }
                    }
                    S[ac] = ae;
                    if (ab == z.series.length - 1 && d) {
                        var v = 0;
                        for (var X = 0; X < ab; X++) {
                            v += Math.abs(T[X][ac].to - T[X][ac].from)
                        }
                        v += af;
                        if (v < c) {
                            if (af > 0.5) {
                                af = a.jqx._ptrnd(af + c - v)
                            } else {
                                var X = ab - 1;
                                while (X >= 0) {
                                    var G = Math.abs(T[X][ac].to - T[X][ac].from);
                                    if (G > 1) {
                                        if (T[X][ac].from > T[X][ac].to) {
                                            T[X][ac].from += c - v
                                        }
                                        break
                                    }
                                    X--
                                }
                            }
                        }
                    }
                    if (A) {
                        af *= -1
                    }
                    var Q = J < r;
                    if (K) {
                        Q = ap > J
                    }
                    var n = isNaN(ap) ? J : {
                        from: ap,
                        to: J
                    };
                    if (Q) {
                        if (ao) {
                            I[ac] += af
                        }
                        T[ab][ac] = {
                            from: R,
                            to: R + af,
                            value: n,
                            valueRadius: e
                        }
                    } else {
                        if (ao) {
                            I[ac] -= af
                        }
                        T[ab][ac] = {
                            from: R,
                            to: R - af,
                            value: n,
                            valueRadius: e
                        }
                    }
                }
            }
            var u = this._renderData[l];
            u.baseOffset = ai;
            u.gbase = r;
            u.logBase = O ? N : NaN;
            u.scale = M;
            u.offsets = !Z ? T : this._applyWaterfall(T, s, l, ai, r, O ? N : NaN, M, A, F);
            u.xoffsets = this._calculateXOffsets(l, L.width);
            return this._renderData[l]
        },
        _isPercent: function(b) {
            return (typeof(b) === "string" && b.length > 0 && b.indexOf("%") == b.length - 1)
        },
        _calcPieSeriesGroupOffsets: function(e, b) {
            var z = this;
            var m = this._getDataLen(e);
            var n = this.seriesGroups[e];
            var A = this._renderData[e] = {};
            var G = A.offsets = [];
            for (var C = 0; C < n.series.length; C++) {
                var t = n.series[C];
                var E = this._get([t.minAngle, t.startAngle]);
                if (isNaN(E) || E < 0 || E > 360) {
                    E = 0
                }
                var M = this._get([t.maxAngle, t.endAngle]);
                if (isNaN(M) || M < 0 || M > 360) {
                    M = 360
                }
                var f = M - E;
                var o = t.initialAngle || 0;
                if (o < E) {
                    o = E
                }
                if (o > M) {
                    o = M
                }
                var c = t.centerOffset || 0;
                var K = a.jqx.getNum([t.offsetX, n.offsetX, b.width / 2]);
                var J = a.jqx.getNum([t.offsetY, n.offsetY, b.height / 2]);
                var w = Math.min(b.width, b.height) / 2;
                var v = o;
                var g = t.radius;
                if (z._isPercent(g)) {
                    g = parseFloat(g) / 100 * w
                }
                if (isNaN(g)) {
                    g = w * 0.4
                }
                var l = t.innerRadius;
                if (z._isPercent(l)) {
                    l = parseFloat(l) / 100 * w
                }
                if (isNaN(l) || l >= g) {
                    l = 0
                }
                var d = t.selectedRadiusChange;
                if (z._isPercent(d)) {
                    d = parseFloat(d) / 100 * (g - l)
                }
                if (isNaN(d)) {
                    d = 0.1 * (g - l)
                }
                G.push([]);
                var h = 0;
                var j = 0;
                for (var F = 0; F < m; F++) {
                    var L = this._getDataValueAsNumber(F, t.dataField, e);
                    if (isNaN(L)) {
                        continue
                    }
                    if (!this._isSerieVisible(e, C, F) && t.hiddenPointsDisplay != true) {
                        continue
                    }
                    if (L > 0) {
                        h += L
                    } else {
                        j += L
                    }
                }
                var r = h - j;
                if (r == 0) {
                    r = 1
                }
                for (var F = 0; F < m; F++) {
                    var L = this._getDataValueAsNumber(F, t.dataField, e);
                    if (isNaN(L)) {
                        G[C].push({});
                        continue
                    }
                    var D = t.displayText || t.displayField;
                    var k = this._getDataValue(F, D, e);
                    if (k == undefined) {
                        k = F
                    }
                    var I = 0;
                    var B = this._isSerieVisible(e, C, F);
                    if (B || t.hiddenPointsDisplay == true) {
                        I = Math.abs(L) / r * f
                    }
                    var q = b.x + K;
                    var p = b.y + J;
                    var H = c;
                    if (a.isFunction(c)) {
                        H = c({
                            seriesIndex: C,
                            seriesGroupIndex: e,
                            itemIndex: F
                        })
                    }
                    if (isNaN(H)) {
                        H = 0
                    }
                    var u = {
                        key: e + "_" + C + "_" + F,
                        value: L,
                        displayValue: k,
                        x: q,
                        y: p,
                        fromAngle: v,
                        toAngle: v + I,
                        centerOffset: H,
                        innerRadius: l,
                        outerRadius: g,
                        selectedRadiusChange: d,
                        visible: B
                    };
                    G[C].push(u);
                    v += I
                }
            }
            return A
        },
        _isPointSeriesOnly: function() {
            for (var b = 0; b < this.seriesGroups.length; b++) {
                var c = this.seriesGroups[b];
                if (c.type.indexOf("line") == -1 && c.type.indexOf("area") == -1 && c.type.indexOf("scatter") == -1 && c.type.indexOf("bubble") == -1) {
                    return false
                }
            }
            return true
        },
        _hasColumnSeries: function() {
            var d = ["column", "ohlc", "candlestick", "waterfall"];
            for (var c = 0; c < this.seriesGroups.length; c++) {
                var e = this.seriesGroups[c];
                for (var b in d) {
                    if (e.type.indexOf(d[b]) != -1) {
                        return true
                    }
                }
            }
            return false
        },
        _alignValuesWithTicks: function(f) {
            var b = this._isPointSeriesOnly();
            var c = this.seriesGroups[f];
            var e = this._getXAxis(f);
            var d = e.valuesOnTicks == undefined ? b : e.valuesOnTicks != false;
            if (e.logarithmicScale) {
                d = true
            }
            if (f == undefined) {
                return d
            }
            if (c.valuesOnTicks == undefined) {
                return d
            }
            return c.valuesOnTicks
        },
        _getYearsDiff: function(c, b) {
            return b.getFullYear() - c.getFullYear()
        },
        _getMonthsDiff: function(c, b) {
            return 12 * (b.getFullYear() - c.getFullYear()) + b.getMonth() - c.getMonth()
        },
        _getDateDiff: function(f, e, d, b) {
            var c = 0;
            if (d != "year" && d != "month") {
                c = e.valueOf() - f.valueOf()
            }
            switch (d) {
                case "year":
                    c = this._getYearsDiff(f, e);
                    break;
                case "month":
                    c = this._getMonthsDiff(f, e);
                    break;
                case "day":
                    c /= (24 * 3600 * 1000);
                    break;
                case "hour":
                    c /= (3600 * 1000);
                    break;
                case "minute":
                    c /= (60 * 1000);
                    break;
                case "second":
                    c /= (1000);
                    break;
                case "millisecond":
                    break
            }
            if (d != "year" && d != "month" && b != false) {
                c = a.jqx._rnd(c, 1, true)
            }
            return c
        },
        _getBestDTUnit: function(k, p, q, d, g) {
            var f = "day";
            var m = p.valueOf() - k.valueOf();
            if (m < 1000) {
                f = "second"
            } else {
                if (m < 3600000) {
                    f = "minute"
                } else {
                    if (m < 86400000) {
                        f = "hour"
                    } else {
                        if (m < 2592000000) {
                            f = "day"
                        } else {
                            if (m < 31104000000) {
                                f = "month"
                            } else {
                                f = "year"
                            }
                        }
                    }
                }
            }
            var o = [{
                key: "year",
                cnt: m / (1000 * 60 * 60 * 24 * 365)
            }, {
                key: "month",
                cnt: m / (1000 * 60 * 60 * 24 * 30)
            }, {
                key: "day",
                cnt: m / (1000 * 60 * 60 * 24)
            }, {
                key: "hour",
                cnt: m / (1000 * 60 * 60)
            }, {
                key: "minute",
                cnt: m / (1000 * 60)
            }, {
                key: "second",
                cnt: m / 1000
            }, {
                key: "millisecond",
                cnt: m
            }];
            var l = -1;
            for (var h = 0; h < o.length; h++) {
                if (o[h].key == f) {
                    l = h;
                    break
                }
            }
            var b = -1,
                n = -1;
            for (; l < o.length; l++) {
                if (o[l].cnt / 100 > d) {
                    break
                }
                var c = this._estAxisInterval(k, p, q, d, o[l].key, g);
                var e = this._getDTIntCnt(k, p, c, o[l].key);
                if (b == -1 || b < e) {
                    b = e;
                    n = l
                }
            }
            f = o[n].key;
            return f
        },
        _getXAxisStats: function(h, o, H) {
            var m = this._getDataLen(h);
            var c = o.type == "date" || o.type == "time";
            if (c && !this._autoDateFormats) {
                if (!this._autoDateFormats) {
                    this._autoDateFormats = []
                }
                var q = this._testXAxisDateFormat();
                if (q) {
                    this._autoDateFormats.push(q)
                }
            }
            var p = c ? this._castAsDate(o.minValue, o.dateFormat) : this._castAsNumber(o.minValue);
            var s = c ? this._castAsDate(o.maxValue, o.dateFormat) : this._castAsNumber(o.maxValue);
            if (this._selectorRange && this._selectorRange[h]) {
                var j = this._selectorRange[h].min;
                if (!isNaN(j)) {
                    p = c ? this._castAsDate(j, o.dateFormat) : this._castAsNumber(j)
                }
                var k = this._selectorRange[h].max;
                if (!isNaN(k)) {
                    s = c ? this._castAsDate(k, o.dateFormat) : this._castAsNumber(k)
                }
            }
            var C = p,
                G = s;
            var f, r;
            var d = o.type == undefined || o.type == "auto";
            var l = (d || o.type == "basic");
            var D = 0,
                e = 0;
            for (var F = 0; F < m && o.dataField; F++) {
                var B = this._getDataValue(F, o.dataField, h);
                B = c ? this._castAsDate(B, o.dateFormat) : this._castAsNumber(B);
                if (isNaN(B)) {
                    continue
                }
                if (c) {
                    D++
                } else {
                    e++
                }
                if (isNaN(f) || B < f) {
                    f = B
                }
                if (isNaN(r) || B >= r) {
                    r = B
                }
            }
            if (d && ((!c && e == m) || (c && D == m))) {
                l = false
            }
            if (l) {
                f = 0;
                r = Math.max(0, m - 1)
            }
            if (isNaN(C)) {
                C = f
            }
            if (isNaN(G)) {
                G = r
            }
            if (c) {
                if (!this._isDate(C)) {
                    C = this._isDate(G) ? G : new Date()
                }
                if (!this._isDate(G)) {
                    G = this._isDate(C) ? C : new Date()
                }
            } else {
                if (isNaN(C)) {
                    C = 0
                }
                if (isNaN(G)) {
                    G = l ? Math.max(0, m - 1) : C
                }
            }
            if (f == undefined) {
                f = C
            }
            if (r == undefined) {
                r = G
            }
            var t = o.rangeSelector;
            if (t) {
                var u = t.minValue || C;
                if (u && c) {
                    u = this._castAsDate(u, t.dateFormat || o.dateFormat)
                }
                var A = t.maxValue || G;
                if (A && c) {
                    A = this._castAsDate(A, t.dateFormat || o.rangeSelector)
                }
                if (C < u) {
                    C = u
                }
                if (G < u) {
                    G = A
                }
                if (C > A) {
                    C = u
                }
                if (G > A) {
                    G = A
                }
            }
            var I = o.unitInterval;
            var z, J;
            if (c) {
                z = o.baseUnit;
                if (!z) {
                    z = this._getBestDTUnit(C, G, h, H)
                }
                J = z == "hour" || z == "minute" || z == "second" || z == "millisecond"
            }
            var v = o.logarithmicScale == true;
            var g = o.logarithmicScaleBase;
            if (isNaN(g) || g <= 1) {
                g = 10
            }
            var I = o.unitInterval;
            if (v) {
                I = 1
            } else {
                if (isNaN(I) || I <= 0) {
                    I = this._estAxisInterval(C, G, h, H, z)
                }
            }
            var E = {
                min: C,
                max: G
            };
            var n = this.seriesGroups[h];
            if (v) {
                if (!C) {
                    C = 1;
                    if (G && C > G) {
                        C = G
                    }
                }
                if (!G) {
                    G = C
                }
                E = {
                    min: C,
                    max: G
                };
                var b = a.jqx._rnd(a.jqx.log(C, g), 1, false);
                var w = a.jqx._rnd(a.jqx.log(G, g), 1, true);
                G = Math.pow(g, w);
                C = Math.pow(g, b)
            } else {
                if (!c && (n.polar || n.spider)) {
                    C = a.jqx._rnd(C, I, false);
                    G = a.jqx._rnd(G, I, true)
                }
            }
            return {
                min: C,
                max: G,
                logAxis: {
                    enabled: v,
                    base: g,
                    minPow: b,
                    maxPow: w
                },
                dsRange: {
                    min: f,
                    max: r
                },
                filterRange: E,
                useIndeces: l,
                isDateTime: c,
                isTimeUnit: J,
                dateTimeUnit: z,
                interval: I
            }
        },
        _getDefaultDTFormatFn: function(d) {
            var b = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var c;
            if (d == "year" || d == "month" || d == "day") {
                c = function(e) {
                    return e.getDate() + "-" + b[e.getMonth()] + "-" + e.getFullYear()
                }
            } else {
                c = function(e) {
                    return e.getDate() + "-" + b[e.getMonth()] + "-" + e.getFullYear() + "<br>" + e.getHours() + ":" + e.getMinutes() + ":" + e.getSeconds()
                }
            }
            return c
        },
        _getDTIntCnt: function(e, b, c, h) {
            var d = 0;
            var f = new Date(e);
            var g = new Date(b);
            g = g.valueOf();
            if (c <= 0) {
                return 1
            }
            while (f.valueOf() < g) {
                if (h == "millisecond") {
                    f = new Date(f.valueOf() + c)
                } else {
                    if (h == "second") {
                        f = new Date(f.valueOf() + c * 1000)
                    } else {
                        if (h == "minute") {
                            f = new Date(f.valueOf() + c * 60000)
                        } else {
                            if (h == "hour") {
                                f = new Date(f.valueOf() + c * 60000 * 24)
                            } else {
                                if (h == "day") {
                                    f.setDate(f.getDate() + c)
                                } else {
                                    if (h == "month") {
                                        f.setMonth(f.getMonth() + c)
                                    } else {
                                        if (h == "year") {
                                            f.setFullYear(f.getFullYear() + c)
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                d++
            }
            return d
        },
        _estAxisInterval: function(e, h, m, b, j, c) {
            if (isNaN(e) || isNaN(h)) {
                return NaN
            }
            var d = [1, 2, 5, 10, 15, 20, 50, 100, 200, 500];
            var g = 0;
            var f = b / ((!isNaN(c) && c > 0) ? c : 50);
            if (this._renderData && this._renderData.length > m && this._renderData[m].xAxis && !isNaN(this._renderData[m].xAxis.avgWidth)) {
                var o = Math.max(1, this._renderData[m].xAxis.avgWidth);
                if (o != 0 && isNaN(c)) {
                    f = 0.9 * b / o
                }
            }
            if (f <= 1) {
                return Math.abs(h - e)
            }
            var n = 0;
            while (true) {
                var l = g >= d.length ? Math.pow(10, 3 + g - d.length) : d[g];
                if (this._isDate(e) && this._isDate(h)) {
                    n = this._getDTIntCnt(e, h, l, j)
                } else {
                    n = (h - e) / l
                }
                if (n <= f) {
                    break
                }
                g++
            }
            var k = this.seriesGroups[m];
            if (k.spider || k.polar) {
                if (2 * l > h - e) {
                    l = h - e
                }
            }
            return l
        },
        _getPaddingSize: function(l, e, f, c, n, g, o) {
            var h = l.min;
            var j = l.max;
            if (l.logAxis.enabled) {
                h = l.logAxis.minPow;
                j = l.logAxis.maxPow
            }
            var b = l.interval;
            var d = l.dateTimeUnit;
            if (n) {
                var k = (c / Math.max(1, j - h + b)) * b;
                if (g) {
                    return {
                        left: 0,
                        right: k
                    }
                } else {
                    if (f) {
                        return {
                            left: 0,
                            right: 0
                        }
                    }
                    return {
                        left: k / 2,
                        right: k / 2
                    }
                }
            }
            if (f && !o) {
                return {
                    left: 0,
                    right: 0
                }
            }
            if (this._isDate(h) && this._isDate(j)) {
                var m = this._getDTIntCnt(h, j, Math.min(b, j - h), d);
                var i = c / Math.max(2, m);
                return {
                    left: i / 2,
                    right: i / 2
                }
            }
            var m = Math.max(1, j - h);
            if (m == 1) {
                sz = c / 4;
                return {
                    left: sz,
                    right: sz
                }
            }
            var i = c / (m + 1);
            return {
                left: i / 2,
                right: i / 2
            }
        },
        _calculateXOffsets: function(f, F) {
            var E = this.seriesGroups[f];
            var o = this._getXAxis(f);
            var w = [];
            var m = [];
            var n = this._getDataLen(f);
            var d = this._getXAxisStats(f, o, F);
            var v = d.min;
            var C = d.max;
            var b = d.isDateTime;
            var G = d.isTimeUnit;
            var D = this._hasColumnSeries();
            var c = E.polar || E.spider;
            var z = this._get([E.startAngle, E.minAngle, 0]);
            var t = this._get([E.endAngle, E.maxAngle, 360]);
            var q = c && !(Math.abs(Math.abs(t - z) - 360) > 0.0001);
            var l = this._alignValuesWithTicks(f);
            var s = this._getPaddingSize(d, o, l, F, c, q, D);
            var I = C - v;
            var B = d.filterRange;
            if (I == 0) {
                I = 1
            }
            var H = F - s.left - s.right;
            if (c && l && !q) {
                s.left = s.right = 0
            }
            var j = -1,
                p = -1;
            for (var A = 0; A < n; A++) {
                var u = (o.dataField === undefined) ? A : this._getDataValue(A, o.dataField, f);
                if (d.useIndeces) {
                    if (A < B.min || A > B.max) {
                        w.push(NaN);
                        m.push(undefined);
                        continue
                    }
                    r = s.left + (A - v) / I * H;
                    if (d.logAxis.enabled == true) {
                        var e = d.logAxis.base;
                        r = this._jqxPlot.scale(u, {
                            min: v.valueOf(),
                            max: C.valueOf(),
                            type: "logarithmic",
                            base: e
                        }, {
                            min: 0,
                            max: H,
                            flip: false
                        })
                    }
                    w.push(a.jqx._ptrnd(r));
                    m.push(u);
                    if (j == -1) {
                        j = A
                    }
                    if (p == -1 || p < A) {
                        p = A
                    }
                    continue
                }
                u = b ? this._castAsDate(u, o.dateFormat) : this._castAsNumber(u);
                if (isNaN(u) || u < B.min || u > B.max) {
                    w.push(NaN);
                    m.push(undefined);
                    continue
                }
                var r = 0;
                if (d.logAxis.enabled == true) {
                    var e = d.logAxis.base;
                    r = this._jqxPlot.scale(u, {
                        min: v.valueOf(),
                        max: C.valueOf(),
                        type: "logarithmic",
                        base: e
                    }, {
                        min: 0,
                        max: H,
                        flip: false
                    })
                } else {
                    if (!b || (b && G)) {
                        diffFromMin = u - v;
                        r = (u - v) * H / I
                    } else {
                        r = (u.valueOf() - v.valueOf()) / (C.valueOf() - v.valueOf()) * H
                    }
                }
                r = a.jqx._ptrnd(s.left + r);
                w.push(r);
                m.push(u);
                if (j == -1) {
                    j = A
                }
                if (p == -1 || p < A) {
                    p = A
                }
            }
            if (o.flip == true) {
                for (var A = 0; A < w.length; A++) {
                    if (!isNaN(w[A])) {
                        w[A] = F - w[A]
                    }
                }
            }
            if (G || b) {
                I = this._getDateDiff(v, C, o.baseUnit);
                I = a.jqx._rnd(I, 1, false)
            }
            var k = Math.max(1, I);
            var h = H / k;
            if (j == p && k == 1) {
                w[j] = s.left + H / 2
            }
            return {
                axisStats: d,
                data: w,
                xvalues: m,
                first: j,
                last: p,
                length: p == -1 ? 0 : p - j + 1,
                itemWidth: h,
                intervalWidth: h * d.interval,
                rangeLength: I,
                useIndeces: d.useIndeces,
                padding: s,
                axisSize: H
            }
        },
        _getXAxis: function(b) {
            if (b == undefined || this.seriesGroups.length <= b) {
                return this.categoryAxis || this.xAxis
            }
            return this.seriesGroups[b].categoryAxis || this.seriesGroups[b].xAxis || this.categoryAxis || this.xAxis
        },
        _isGreyScale: function(e, b) {
            var d = this.seriesGroups[e];
            var c = d.series[b];
            if (c.greyScale == true) {
                return true
            } else {
                if (c.greyScale == false) {
                    return false
                }
            }
            if (d.greyScale == true) {
                return true
            } else {
                if (d.greyScale == false) {
                    return false
                }
            }
            return this.greyScale == true
        },
        _getSeriesColors: function(f, c, e) {
            var b = this._getSeriesColorsInternal(f, c, e);
            if (this._isGreyScale(f, c)) {
                for (var d in b) {
                    b[d] = a.jqx.toGreyScale(b[d])
                }
            }
            return b
        },
        _getColorFromScheme: function(o, l, b) {
            var d = "#000000";
            var n = this.seriesGroups[o];
            var g = n.series[l];
            if (this._isPieGroup(o)) {
                var c = this._getDataLen(o);
                d = this._getItemColorFromScheme(g.colorScheme || n.colorScheme || this.colorScheme, l * c + b, o, l)
            } else {
                var m = 0;
                for (var f = 0; f <= o; f++) {
                    for (var e in this.seriesGroups[f].series) {
                        if (f == o && e == l) {
                            break
                        } else {
                            m++
                        }
                    }
                }
                var k = this.colorScheme;
                if (n.colorScheme) {
                    k = n.colorScheme;
                    sidex = seriesIndex
                }
                if (k == undefined || k == "") {
                    k = this.colorSchemes[0].name
                }
                if (!k) {
                    return d
                }
                for (var f = 0; f < this.colorSchemes.length; f++) {
                    var h = this.colorSchemes[f];
                    if (h.name == k) {
                        while (m > h.colors.length) {
                            m -= h.colors.length;
                            if (++f >= this.colorSchemes.length) {
                                f = 0
                            }
                            h = this.colorSchemes[f]
                        }
                        d = h.colors[m % h.colors.length]
                    }
                }
            }
            return d
        },
        _createColorsCache: function() {
            this._colorsCache = {
                get: function(b) {
                    if (this._store[b]) {
                        return this._store[b]
                    }
                },
                set: function(c, b) {
                    if (this._size < 10000) {
                        this._store[c] = b;
                        this._size++
                    }
                },
                clear: function() {
                    this._store = {};
                    this._size = 0
                },
                _size: 0,
                _store: {}
            }
        },
        _getSeriesColorsInternal: function(m, d, b) {
            var f = this.seriesGroups[m];
            var o = f.series[d];
            if (!a.isFunction(o.colorFunction) && f.type != "pie" && f.type != "donut") {
                b = NaN
            }
            var h = m + "_" + d + "_" + (isNaN(b) ? "NaN" : b);
            if (this._colorsCache.get(h)) {
                return this._colorsCache.get(h)
            }
            var c = {
                lineColor: "#222222",
                lineColorSelected: "#151515",
                lineColorSymbol: "#222222",
                lineColorSymbolSelected: "#151515",
                fillColor: "#222222",
                fillColorSelected: "#333333",
                fillColorSymbol: "#222222",
                fillColorSymbolSelected: "#333333",
                fillColorAlt: "#222222",
                fillColorAltSelected: "#333333"
            };
            var i;
            if (a.isFunction(o.colorFunction)) {
                var j = !isNaN(b) ? this._getDataValue(b, o.dataField, m) : NaN;
                if (f.type.indexOf("range") != -1 && !isNaN(b)) {
                    var e = this._getDataValue(b, o.dataFieldFrom, m);
                    var l = this._getDataValue(b, o.dataFieldTo, m);
                    j = {
                        from: e,
                        to: l
                    }
                }
                i = o.colorFunction(j, b, o, f);
                if (typeof(i) == "object") {
                    for (var k in i) {
                        c[k] = i[k]
                    }
                } else {
                    c.fillColor = i
                }
            } else {
                for (var k in c) {
                    if (o[k]) {
                        c[k] = o[k]
                    }
                }
                if (!o.fillColor && !o.color) {
                    c.fillColor = this._getColorFromScheme(m, d, b)
                } else {
                    o.fillColor = o.fillColor || o.color
                }
            }
            var n = {
                fillColor: {
                    baseColor: "fillColor",
                    adjust: 1
                },
                fillColorSelected: {
                    baseColor: "fillColor",
                    adjust: 1.1
                },
                fillColorSymbol: {
                    baseColor: "fillColor",
                    adjust: 1
                },
                fillColorSymbolSelected: {
                    baseColor: "fillColorSymbol",
                    adjust: 2
                },
                fillColorAlt: {
                    baseColor: "fillColor",
                    adjust: 4
                },
                fillColorAltSelected: {
                    baseColor: "fillColor",
                    adjust: 3
                },
                lineColor: {
                    baseColor: "fillColor",
                    adjust: 0.95
                },
                lineColorSelected: {
                    baseColor: "lineColor",
                    adjust: 0.95
                },
                lineColorSymbol: {
                    baseColor: "lineColor",
                    adjust: 1
                },
                lineColorSymbolSelected: {
                    baseColor: "lineColorSelected",
                    adjust: 1
                }
            };
            for (var k in c) {
                if (typeof(i) != "object" || !i[k]) {
                    if (o[k]) {
                        c[k] = o[k]
                    }
                }
            }
            for (var k in c) {
                if (typeof(i) != "object" || !i[k]) {
                    if (!o[k]) {
                        c[k] = a.jqx.adjustColor(c[n[k].baseColor], n[k].adjust)
                    }
                }
            }
            this._colorsCache.set(h, c);
            return c
        },
        _getItemColorFromScheme: function(d, f, k, h) {
            if (d == undefined || d == "") {
                d = this.colorSchemes[0].name
            }
            for (var g = 0; g < this.colorSchemes.length; g++) {
                if (d == this.colorSchemes[g].name) {
                    break
                }
            }
            var e = 0;
            while (e <= f) {
                if (g == this.colorSchemes.length) {
                    g = 0
                }
                var b = this.colorSchemes[g].colors.length;
                if (e + b <= f) {
                    e += b;
                    g++
                } else {
                    var c = this.colorSchemes[g].colors[f - e];
                    if (this._isGreyScale(k, h) && c.indexOf("#") == 0) {
                        c = a.jqx.toGreyScale(c)
                    }
                    return c
                }
            }
        },
        getColorScheme: function(b) {
            for (var c = 0; c < this.colorSchemes.length; c++) {
                if (this.colorSchemes[c].name == b) {
                    return this.colorSchemes[c].colors
                }
            }
            return undefined
        },
        addColorScheme: function(c, b) {
            for (var d = 0; d < this.colorSchemes.length; d++) {
                if (this.colorSchemes[d].name == c) {
                    this.colorSchemes[d].colors = b;
                    return
                }
            }
            this.colorSchemes.push({
                name: c,
                colors: b
            })
        },
        removeColorScheme: function(b) {
            for (var c = 0; c < this.colorSchemes.length; c++) {
                if (this.colorSchemes[c].name == b) {
                    this.colorSchemes.splice(c, 1);
                    break
                }
            }
        },
        colorSchemes: [{
            name: "scheme01",
            colors: ["#307DD7", "#AA4643", "#89A54E", "#71588F", "#4198AF"]
        }, {
            name: "scheme02",
            colors: ["#7FD13B", "#EA157A", "#FEB80A", "#00ADDC", "#738AC8"]
        }, {
            name: "scheme03",
            colors: ["#E8601A", "#FF9639", "#F5BD6A", "#599994", "#115D6E"]
        }, {
            name: "scheme04",
            colors: ["#D02841", "#FF7C41", "#FFC051", "#5B5F4D", "#364651"]
        }, {
            name: "scheme05",
            colors: ["#25A0DA", "#309B46", "#8EBC00", "#FF7515", "#FFAE00"]
        }, {
            name: "scheme06",
            colors: ["#0A3A4A", "#196674", "#33A6B2", "#9AC836", "#D0E64B"]
        }, {
            name: "scheme07",
            colors: ["#CC6B32", "#FFAB48", "#FFE7AD", "#A7C9AE", "#888A63"]
        }, {
            name: "scheme08",
            colors: ["#3F3943", "#01A2A6", "#29D9C2", "#BDF271", "#FFFFA6"]
        }, {
            name: "scheme09",
            colors: ["#1B2B32", "#37646F", "#A3ABAF", "#E1E7E8", "#B22E2F"]
        }, {
            name: "scheme10",
            colors: ["#5A4B53", "#9C3C58", "#DE2B5B", "#D86A41", "#D2A825"]
        }, {
            name: "scheme11",
            colors: ["#993144", "#FFA257", "#CCA56A", "#ADA072", "#949681"]
        }, {
            name: "scheme12",
            colors: ["#105B63", "#EEEAC5", "#FFD34E", "#DB9E36", "#BD4932"]
        }, {
            name: "scheme13",
            colors: ["#BBEBBC", "#F0EE94", "#F5C465", "#FA7642", "#FF1E54"]
        }, {
            name: "scheme14",
            colors: ["#60573E", "#F2EEAC", "#BFA575", "#A63841", "#BFB8A3"]
        }, {
            name: "scheme15",
            colors: ["#444546", "#FFBB6E", "#F28D00", "#D94F00", "#7F203B"]
        }, {
            name: "scheme16",
            colors: ["#583C39", "#674E49", "#948658", "#F0E99A", "#564E49"]
        }, {
            name: "scheme17",
            colors: ["#142D58", "#447F6E", "#E1B65B", "#C8782A", "#9E3E17"]
        }, {
            name: "scheme18",
            colors: ["#4D2B1F", "#635D61", "#7992A2", "#97BFD5", "#BFDCF5"]
        }, {
            name: "scheme19",
            colors: ["#844341", "#D5CC92", "#BBA146", "#897B26", "#55591C"]
        }, {
            name: "scheme20",
            colors: ["#56626B", "#6C9380", "#C0CA55", "#F07C6C", "#AD5472"]
        }, {
            name: "scheme21",
            colors: ["#96003A", "#FF7347", "#FFBC7B", "#FF4154", "#642223"]
        }, {
            name: "scheme22",
            colors: ["#5D7359", "#E0D697", "#D6AA5C", "#8C5430", "#661C0E"]
        }, {
            name: "scheme23",
            colors: ["#16193B", "#35478C", "#4E7AC7", "#7FB2F0", "#ADD5F7"]
        }, {
            name: "scheme24",
            colors: ["#7B1A25", "#BF5322", "#9DA860", "#CEA457", "#B67818"]
        }, {
            name: "scheme25",
            colors: ["#0081DA", "#3AAFFF", "#99C900", "#FFEB3D", "#309B46"]
        }, {
            name: "scheme26",
            colors: ["#0069A5", "#0098EE", "#7BD2F6", "#FFB800", "#FF6800"]
        }, {
            name: "scheme27",
            colors: ["#FF6800", "#A0A700", "#FF8D00", "#678900", "#0069A5"]
        }],
        _formatValue: function(g, i, c, f, b, d) {
            if (g == undefined) {
                return ""
            }
            if (this._isObject(g) && !this._isDate(g) && !c) {
                return ""
            }
            if (c) {
                if (!a.isFunction(c)) {
                    return g.toString()
                }
                try {
                    return c(g, d, b, f)
                } catch (h) {
                    return h.message
                }
            }
            if (this._isNumber(g)) {
                return this._formatNumber(g, i)
            }
            if (this._isDate(g)) {
                return this._formatDate(g, i)
            }
            if (i) {
                return (i.prefix || "") + g.toString() + (i.sufix || "")
            }
            return g.toString()
        },
        _getFormattedValue: function(f, h, A, p, d, l) {
            var w = this.seriesGroups[f];
            var n = w.series[h];
            var m = "";
            var j = p,
                k = d;
            if (!k) {
                k = n.formatFunction || w.formatFunction
            }
            if (!j) {
                j = n.formatSettings || w.formatSettings
            }
            if (!n.formatFunction && n.formatSettings) {
                k = undefined
            }
            var o = {},
                t = 0;
            for (var b in n) {
                if (b.indexOf("dataField") == 0) {
                    o[b.substring(9).toLowerCase()] = this._getDataValue(A, n[b], f);
                    t++
                }
            }
            if (t == 0) {
                o = this._getDataValue(A, undefined, f)
            }
            if (w.type.indexOf("waterfall") != -1 && this._isSummary(f, A)) {
                o = this._renderData[f].offsets[h][A].value;
                t = 0
            }
            if (k && a.isFunction(k)) {
                try {
                    return k(t == 1 ? o[""] : o, A, n, w)
                } catch (z) {
                    return z.message
                }
            }
            if (t == 1 && this._isPieGroup(f)) {
                return this._formatValue(o[""], j, k, f, h, A)
            }
            if (t > 0) {
                var u = 0;
                for (var b in o) {
                    if (u > 0 && m != "") {
                        m += "<br>"
                    }
                    var r = "dataField" + (b.length > 0 ? b.substring(0, 1).toUpperCase() + b.substring(1) : "");
                    var q = "displayText" + (b.length > 0 ? b.substring(0, 1).toUpperCase() + b.substring(1) : "");
                    var v = n[q] || n[r];
                    var c = o[b];
                    if (undefined != c) {
                        c = this._formatValue(c, j, k, f, h, A)
                    } else {
                        continue
                    }
                    if (l === true) {
                        m += c
                    } else {
                        m += v + ": " + c
                    }
                    u++
                }
            } else {
                if (undefined != o) {
                    m = this._formatValue(o, j, k, f, h, A)
                }
            }
            return m || ""
        },
        _isNumberAsString: function(d) {
            if (typeof(d) != "string") {
                return false
            }
            d = a.trim(d);
            for (var b = 0; b < d.length; b++) {
                var c = d.charAt(b);
                if ((c >= "0" && c <= "9") || c == "," || c == ".") {
                    continue
                }
                if (c == "-" && b == 0) {
                    continue
                }
                if ((c == "(" && b == 0) || (c == ")" && b == d.length - 1)) {
                    continue
                }
                return false
            }
            return true
        },
        _castAsDate: function(f, c) {
            if (f instanceof Date && !isNaN(f)) {
                return f
            }
            if (typeof(f) == "string") {
                var b;
                if (c) {
                    b = a.jqx.dataFormat.parsedate(f, c);
                    if (this._isDate(b)) {
                        return b
                    }
                }
                if (this._autoDateFormats) {
                    for (var e = 0; e < this._autoDateFormats.length; e++) {
                        b = a.jqx.dataFormat.parsedate(f, this._autoDateFormats[e]);
                        if (this._isDate(b)) {
                            return b
                        }
                    }
                }
                var d = this._detectDateFormat(f);
                if (d) {
                    b = a.jqx.dataFormat.parsedate(f, d);
                    if (this._isDate(b)) {
                        this._autoDateFormats.push(d);
                        return b
                    }
                }
                b = new Date(f);
                if (this._isDate(b)) {
                    if (f.indexOf(":") == -1) {
                        b.setHours(0, 0, 0, 0)
                    }
                }
                return b
            }
            return undefined
        },
        _castAsNumber: function(c) {
            if (c instanceof Date && !isNaN(c)) {
                return c.valueOf()
            }
            if (typeof(c) == "string") {
                if (this._isNumber(c)) {
                    c = parseFloat(c)
                } else {
                    if (!/[a-zA-Z]/.test(c)) {
                        var b = new Date(c);
                        if (b != undefined) {
                            c = b.valueOf()
                        }
                    }
                }
            }
            return c
        },
        _isNumber: function(b) {
            if (typeof(b) == "string") {
                if (this._isNumberAsString(b)) {
                    b = parseFloat(b)
                }
            }
            return typeof b === "number" && isFinite(b)
        },
        _isDate: function(b) {
            return b instanceof Date && !isNaN(b.getDate())
        },
        _isBoolean: function(b) {
            return typeof b === "boolean"
        },
        _isObject: function(b) {
            return (b && (typeof b === "object" || a.isFunction(b))) || false
        },
        _formatDate: function(d, c) {
            var b = d.toString();
            if (c) {
                if (c.dateFormat) {
                    b = a.jqx.dataFormat.formatDate(d, c.dateFormat)
                }
                b = (c.prefix || "") + b + (c.sufix || "")
            }
            return b
        },
        _formatNumber: function(n, e) {
            if (!this._isNumber(n)) {
                return n
            }
            e = e || {};
            var q = ".";
            var o = "";
            var r = this;
            if (r.localization) {
                q = r.localization.decimalSeparator || r.localization.decimalseparator || q;
                o = r.localization.thousandsSeparator || r.localization.thousandsseparator || o
            }
            if (e.decimalSeparator) {
                q = e.decimalSeparator
            }
            if (e.thousandsSeparator) {
                o = e.thousandsSeparator
            }
            var m = e.prefix || "";
            var p = e.sufix || "";
            var h = e.decimalPlaces;
            if (isNaN(h)) {
                h = this._getDecimalPlaces([n], undefined, 3)
            }
            var l = e.negativeWithBrackets || false;
            var g = (n < 0);
            if (g && l) {
                n *= -1
            }
            var d = n.toString();
            var b;
            var k = Math.pow(10, h);
            d = (Math.round(n * k) / k).toString();
            if (isNaN(d)) {
                d = ""
            }
            b = d.lastIndexOf(".");
            if (h > 0) {
                if (b < 0) {
                    d += q;
                    b = d.length - 1
                } else {
                    if (q !== ".") {
                        d = d.replace(".", q)
                    }
                }
                while ((d.length - 1 - b) < h) {
                    d += "0"
                }
            }
            b = d.lastIndexOf(q);
            b = (b > -1) ? b : d.length;
            var f = d.substring(b);
            var c = 0;
            for (var j = b; j > 0; j--, c++) {
                if ((c % 3 === 0) && (j !== b) && (!g || (j > 1) || (g && l))) {
                    f = o + f
                }
                f = d.charAt(j - 1) + f
            }
            d = f;
            if (g && l) {
                d = "(" + d + ")"
            }
            return m + d + p
        },
        _defaultNumberFormat: {
            prefix: "",
            sufix: "",
            decimalSeparator: ".",
            thousandsSeparator: ",",
            decimalPlaces: 2,
            negativeWithBrackets: false
        },
        _calculateControlPoints: function(g, f) {
            var e = g[f],
                m = g[f + 1],
                d = g[f + 2],
                j = g[f + 3],
                c = g[f + 4],
                i = g[f + 5];
            var l = 0.4;
            var o = Math.sqrt(Math.pow(d - e, 2) + Math.pow(j - m, 2));
            var b = Math.sqrt(Math.pow(c - d, 2) + Math.pow(i - j, 2));
            var h = (o + b);
            if (h == 0) {
                h = 1
            }
            var n = l * o / h;
            var k = l - n;
            return [d + n * (e - c), j + n * (m - i), d - k * (e - c), j - k * (m - i)]
        },
        _getBezierPoints: function(d) {
            var c = "";
            var h = [],
                e = [];
            var g = d.split(" ");
            for (var f = 0; f < g.length; f++) {
                var j = g[f].split(",");
                h.push(parseFloat(j[0]));
                h.push(parseFloat(j[1]));
                if (isNaN(h[h.length - 1]) || isNaN(h[h.length - 2])) {
                    continue
                }
            }
            var b = h.length;
            if (b <= 1) {
                return ""
            } else {
                if (b == 2) {
                    c = "M" + a.jqx._ptrnd(h[0]) + "," + a.jqx._ptrnd(h[1]) + " L" + a.jqx._ptrnd(h[0] + 1) + "," + a.jqx._ptrnd(h[1] + 1) + " ";
                    return c
                }
            }
            for (var f = 0; f < b - 4; f += 2) {
                e = e.concat(this._calculateControlPoints(h, f))
            }
            for (var f = 2; f < b - 5; f += 2) {
                c += " C" + a.jqx._ptrnd(e[2 * f - 2]) + "," + a.jqx._ptrnd(e[2 * f - 1]) + " " + a.jqx._ptrnd(e[2 * f]) + "," + a.jqx._ptrnd(e[2 * f + 1]) + " " + a.jqx._ptrnd(h[f + 2]) + "," + a.jqx._ptrnd(h[f + 3]) + " "
            }
            if (b <= 4 || (Math.abs(h[0] - h[2]) < 3 || Math.abs(h[1] - h[3]) < 3) || this._isVML) {
                c = "M" + a.jqx._ptrnd(h[0]) + "," + a.jqx._ptrnd(h[1]) + " L" + a.jqx._ptrnd(h[2]) + "," + a.jqx._ptrnd(h[3]) + " " + c
            } else {
                c = "M" + a.jqx._ptrnd(h[0]) + "," + a.jqx._ptrnd(h[1]) + " Q" + a.jqx._ptrnd(e[0]) + "," + a.jqx._ptrnd(e[1]) + " " + a.jqx._ptrnd(h[2]) + "," + a.jqx._ptrnd(h[3]) + " " + c
            }
            if (b >= 4 && (Math.abs(h[b - 2] - h[b - 4]) < 3 || Math.abs(h[b - 1] - h[b - 3]) < 3 || this._isVML)) {
                c += " L" + a.jqx._ptrnd(h[b - 2]) + "," + a.jqx._ptrnd(h[b - 1]) + " "
            } else {
                if (b >= 5) {
                    c += " Q" + a.jqx._ptrnd(e[b * 2 - 10]) + "," + a.jqx._ptrnd(e[b * 2 - 9]) + " " + a.jqx._ptrnd(h[b - 2]) + "," + a.jqx._ptrnd(h[b - 1]) + " "
                }
            }
            return c
        },
        _animTickInt: 50,
        _createAnimationGroup: function(b) {
            if (!this._animGroups) {
                this._animGroups = {}
            }
            this._animGroups[b] = {
                animations: [],
                startTick: NaN
            }
        },
        _startAnimation: function(c) {
            var e = new Date();
            var b = e.getTime();
            this._animGroups[c].startTick = b;
            this._runAnimation();
            this._enableAnimTimer()
        },
        _enqueueAnimation: function(e, d, c, g, f, b, h) {
            if (g < 0) {
                g = 0
            }
            if (h == undefined) {
                h = "easeInOutSine"
            }
            this._animGroups[e].animations.push({
                key: d,
                properties: c,
                duration: g,
                fn: f,
                context: b,
                easing: h
            })
        },
        _stopAnimations: function() {
            clearTimeout(this._animtimer);
            this._animtimer = undefined;
            this._animGroups = undefined
        },
        _enableAnimTimer: function() {
            if (!this._animtimer) {
                var b = this;
                this._animtimer = setTimeout(function() {
                    b._runAnimation()
                }, this._animTickInt)
            }
        },
        _runAnimation: function(q) {
            if (this._animGroups) {
                var t = new Date();
                var h = t.getTime();
                var o = {};
                for (var l in this._animGroups) {
                    var s = this._animGroups[l].animations;
                    var m = this._animGroups[l].startTick;
                    var g = 0;
                    for (var n = 0; n < s.length; n++) {
                        var u = s[n];
                        var b = (h - m);
                        if (u.duration > g) {
                            g = u.duration
                        }
                        var r = u.duration > 0 ? b / u.duration : 1;
                        var k = r;
                        if (u.easing && u.duration != 0) {
                            k = a.easing[u.easing](r, b, 0, 1, u.duration)
                        }
                        if (r > 1) {
                            r = 1;
                            k = 1
                        }
                        if (u.fn) {
                            u.fn(u.key, u.context, k);
                            continue
                        }
                        var f = {};
                        for (var l = 0; l < u.properties.length; l++) {
                            var c = u.properties[l];
                            var e = 0;
                            if (r == 1) {
                                e = c.to
                            } else {
                                e = easeParecent * (c.to - c.from) + c.from
                            }
                            f[c.key] = e
                        }
                        this.renderer.attr(u.key, f)
                    }
                    if (m + g > h) {
                        o[l] = ({
                            startTick: m,
                            animations: s
                        })
                    }
                }
                this._animGroups = o;
                if (this.renderer instanceof a.jqx.HTML5Renderer) {
                    this.renderer.refresh()
                }
            }
            this._animtimer = null;
            for (var l in this._animGroups) {
                this._enableAnimTimer();
                break
            }
        },
        _fixCoords: function(d, e) {
            var b = this.seriesGroups[e].orientation == "horizontal";
            if (!b) {
                return d
            }
            var c = d.x;
            d.x = d.y;
            d.y = c + this._plotRect.y - this._plotRect.x;
            var c = d.width;
            d.width = d.height;
            d.height = c;
            return d
        },
        getItemCoord: function(b, d, u) {
            var k = this;
            if (k._isPieGroup(b) && (!k._isSerieVisible(b, d, u) || !k._renderData || k._renderData.length <= b)) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            if (!k._isSerieVisible(b, d) || !k._renderData || k._renderData.length <= b) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var q = k.seriesGroups[b];
            var j = q.series[d];
            var o = k._getItemCoord(b, d, u);
            if (k._isPieGroup(b)) {
                if (isNaN(o.x) || isNaN(o.y) || isNaN(o.fromAngle) || isNaN(o.toAngle)) {
                    return {
                        x: NaN,
                        y: NaN
                    }
                }
                var i = this._plotRect;
                var p = o.fromAngle * (Math.PI / 180);
                var e = o.toAngle * (Math.PI / 180);
                x1 = i.x + o.center.x + Math.cos(p) * o.outerRadius;
                x2 = i.x + o.center.x + Math.cos(e) * o.outerRadius;
                y1 = i.y + o.center.y - Math.sin(p) * o.outerRadius;
                y2 = i.y + o.center.y - Math.sin(e) * o.outerRadius;
                var h = Math.min(x1, x2);
                var m = Math.abs(x2 - x1);
                var f = Math.min(y1, y2);
                var l = Math.abs(y2 - y1);
                o = {
                    x: h,
                    y: f,
                    width: m,
                    height: l,
                    center: o.center,
                    centerOffset: o.centerOffset,
                    innerRadius: o.innerRadius,
                    outerRadius: o.outerRadius,
                    selectedRadiusChange: o.selectedRadiusChange,
                    fromAngle: o.fromAngle,
                    toAngle: o.toAngle
                };
                return o
            }
            if (q.type.indexOf("column") != -1 || q.type.indexOf("waterfall") != -1) {
                var v = this._getColumnSerieWidthAndOffset(b, d);
                o.height = Math.abs(o.y.to - o.y.from);
                o.y = Math.min(o.y.to, o.y.from);
                o.x += v.offset;
                o.width = v.width
            } else {
                if (q.type.indexOf("ohlc") != -1 || q.type.indexOf("candlestick") != -1) {
                    var v = this._getColumnSerieWidthAndOffset(b, d);
                    var f = o.y;
                    var t = Math.min(f.Open, f.Close, f.Low, f.High);
                    var r = Math.max(f.Open, f.Close, f.Low, f.High);
                    o.height = Math.abs(r - t);
                    o.y = t;
                    o.x += v.offset;
                    o.width = v.width
                } else {
                    if (q.type.indexOf("line") != -1 || q.type.indexOf("area") != -1) {
                        o.width = o.height = 0;
                        o.y = o.y.to
                    } else {
                        if (q.type.indexOf("bubble") != -1 || q.type.indexOf("scatter") != -1) {
                            o.center = {
                                x: o.x,
                                y: o.y.to
                            };
                            var c = o.y.radius;
                            if (j.symbolType != "circle" && j.symbolType != undefined) {
                                c /= 2
                            }
                            o.y = o.y.to;
                            o.radius = c;
                            o.width = 2 * c;
                            o.height = 2 * c
                        }
                    }
                }
            }
            o = this._fixCoords(o, b);
            if (q.polar || q.spider) {
                var n = this._toPolarCoord(this._renderData[b].polarCoords, this._plotRect, o.x, o.y);
                o.x = n.x;
                o.y = n.y;
                if (o.center) {
                    o.center = this._toPolarCoord(this._renderData[b].polarCoords, this._plotRect, o.center.x, o.center.y)
                }
            }
            if (q.type.indexOf("bubble") != -1 || q.type.indexOf("scatter") != -1) {
                o.x -= c;
                o.y -= c
            }
            return o
        },
        _getItemCoord: function(o, j, b) {
            var e = this.seriesGroups[o],
                l, k;
            if (!e || !this._renderData) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var f = e.series[j];
            if (!f) {
                return {
                    x: NaN,
                    y: NaN
                }
            }
            var h = this._plotRect;
            if (this._isPieGroup(o)) {
                var m = this._renderData[o].offsets[j][b];
                if (!m) {
                    return {
                        x: NaN,
                        y: NaN
                    }
                }
                var c = (m.fromAngle + m.toAngle) / 2 * (Math.PI / 180);
                l = h.x + m.x + Math.cos(c) * m.outerRadius;
                k = h.y + m.y - Math.sin(c) * m.outerRadius;
                return {
                    x: l,
                    y: k,
                    center: {
                        x: m.x,
                        y: m.y
                    },
                    centerOffset: m.centerOffset,
                    innerRadius: m.innerRadius,
                    outerRadius: m.outerRadius,
                    selectedRadiusChange: m.selectedRadiusChange,
                    fromAngle: m.fromAngle,
                    toAngle: m.toAngle
                }
            } else {
                l = h.x + this._renderData[o].xoffsets.data[b];
                k = this._renderData[o].offsets[j][b];
                if (isNaN(l) || !k) {
                    return {
                        x: NaN,
                        y: NaN
                    }
                }
            }
            var n = {};
            for (var d in k) {
                n[d] = k[d]
            }
            return {
                x: l,
                y: n
            }
        },
        getXAxisValue: function(g, r) {
            var q = this.seriesGroups[r];
            if (!q) {
                return undefined
            }
            var c = this._getXAxis(r);
            var n = this._plotRect;
            var b = 0;
            var m = NaN;
            var e = this._renderData[0].xoffsets.axisStats;
            var f = 0,
                l = 0;
            if (q.polar || q.spider) {
                if (isNaN(g.x) || isNaN(g.y)) {
                    return NaN
                }
                var h = this._getPolarAxisCoords(r, n);
                var k = a.jqx._ptdist(g.x, g.y, h.x, h.y);
                if (k > h.r) {
                    return NaN
                }
                var i = Math.atan2(h.y - g.y, g.x - h.x);
                i = Math.PI / 2 - i;
                if (i < 0) {
                    i = 2 * Math.PI + i
                }
                m = i * h.r;
                var j = h.startAngle + Math.PI / 2;
                var d = h.endAngle + Math.PI / 2;
                f = j * h.r;
                l = d * h.r;
                b = (d - j) * h.r;
                var o = this._getPaddingSize(e, c, c.valuesOnTicks, b, true, h.isClosedCircle, this._hasColumnSeries());
                if (h.isClosedCircle) {
                    b -= (o.left + o.right);
                    l -= (o.left + o.right)
                } else {
                    if (!c.valuesOnTicks) {
                        f += o.left;
                        l -= o.right
                    }
                }
            } else {
                if (q.orientation != "horizontal") {
                    if (g < n.x || g > n.x + n.width) {
                        return NaN
                    }
                    m = g - n.x;
                    b = n.width
                } else {
                    if (g < n.y || g > n.y + n.height) {
                        return NaN
                    }
                    m = g - n.y;
                    b = n.height
                }
                if (this._renderData[r] && this._renderData[r].xoffsets) {
                    var o = this._renderData[r].xoffsets.padding;
                    b -= (o.left + o.right);
                    m -= o.left
                }
                l = b
            }
            var p = this._jqxPlot.scale(m, {
                min: f,
                max: l
            }, {
                min: e.min.valueOf(),
                max: e.max.valueOf(),
                type: e.logAxis.enabled ? "logarithmic" : "linear",
                base: e.logAxis.base,
                flip: c.flip
            });
            return p
        },
        getValueAxisValue: function(c, j) {
            var i = this.seriesGroups[j];
            if (!i) {
                return undefined
            }
            var k = this._getValueAxis(j);
            var g = this._plotRect;
            var b = 0;
            var f = NaN;
            if (i.polar || i.spider) {
                if (isNaN(c.x) || isNaN(c.y)) {
                    return NaN
                }
                var e = this._getPolarAxisCoords(j, g);
                f = a.jqx._ptdist(c.x, c.y, e.x, e.y);
                b = e.r;
                f = b - f
            } else {
                if (i.orientation == "horizontal") {
                    if (c < g.x || c > g.x + g.width) {
                        return NaN
                    }
                    f = c - g.x;
                    b = g.width
                } else {
                    if (c < g.y || c > g.y + g.height) {
                        return NaN
                    }
                    f = c - g.y;
                    b = g.height
                }
            }
            var d = this._stats.seriesGroups[j];
            var h = this._jqxPlot.scale(f, {
                min: 0,
                max: b
            }, {
                min: d.min.valueOf(),
                max: d.max.valueOf(),
                type: d.logarithmic ? "logarithmic" : "linear",
                base: d.logBase,
                flip: !k.flip
            });
            return h
        },
        _detectDateFormat: function(g, e) {
            var d = {
                en_US_d: "M/d/yyyy",
                en_US_D: "dddd, MMMM dd, yyyy",
                en_US_t: "h:mm tt",
                en_US_T: "h:mm:ss tt",
                en_US_f: "dddd, MMMM dd, yyyy h:mm tt",
                en_US_F: "dddd, MMMM dd, yyyy h:mm:ss tt",
                en_US_M: "MMMM dd",
                en_US_Y: "yyyy MMMM",
                en_US_S: "yyyy\u0027-\u0027MM\u0027-\u0027dd\u0027T\u0027HH\u0027:\u0027mm\u0027:\u0027ss",
                en_CA_d: "dd/MM/yyyy",
                en_CA_D: "MMMM-dd-yy",
                en_CA_f: "MMMM-dd-yy h:mm tt",
                en_CA_F: "MMMM-dd-yy h:mm:ss tt",
                ISO: "yyyy-MM-dd hh:mm:ss",
                ISO2: "yyyy-MM-dd HH:mm:ss",
                d1: "dd.MM.yyyy",
                d2: "dd-MM-yyyy",
                zone1: "yyyy-MM-ddTHH:mm:ss-HH:mm",
                zone2: "yyyy-MM-ddTHH:mm:ss+HH:mm",
                custom: "yyyy-MM-ddTHH:mm:ss.fff",
                custom2: "yyyy-MM-dd HH:mm:ss.fff",
                de_DE_d: "dd.MM.yyyy",
                de_DE_D: "dddd, d. MMMM yyyy",
                de_DE_t: "HH:mm",
                de_DE_T: "HH:mm:ss",
                de_DE_f: "dddd, d. MMMM yyyy HH:mm",
                de_DE_F: "dddd, d. MMMM yyyy HH:mm:ss",
                de_DE_M: "dd MMMM",
                de_DE_Y: "MMMM yyyy",
                fr_FR_d: "dd/MM/yyyy",
                fr_FR_D: "dddd d MMMM yyyy",
                fr_FR_t: "HH:mm",
                fr_FR_T: "HH:mm:ss",
                fr_FR_f: "dddd d MMMM yyyy HH:mm",
                fr_FR_F: "dddd d MMMM yyyy HH:mm:ss",
                fr_FR_M: "d MMMM",
                fr_FR_Y: "MMMM yyyy",
                it_IT_d: "dd/MM/yyyy",
                it_IT_D: "dddd d MMMM yyyy",
                it_IT_t: "HH:mm",
                it_IT_T: "HH:mm:ss",
                it_IT_f: "dddd d MMMM yyyy HH:mm",
                it_IT_F: "dddd d MMMM yyyy HH:mm:ss",
                it_IT_M: "dd MMMM",
                it_IT_Y: "MMMM yyyy",
                ru_RU_d: "dd.MM.yyyy",
                ru_RU_D: "d MMMM yyyy '?.'",
                ru_RU_t: "H:mm",
                ru_RU_T: "H:mm:ss",
                ru_RU_f: "d MMMM yyyy '?.' H:mm",
                ru_RU_F: "d MMMM yyyy '?.' H:mm:ss",
                ru_RU_Y: "MMMM yyyy",
                cs_CZ_d: "d.M.yyyy",
                cs_CZ_D: "d. MMMM yyyy",
                cs_CZ_t: "H:mm",
                cs_CZ_T: "H:mm:ss",
                cs_CZ_f: "d. MMMM yyyy H:mm",
                cs_CZ_F: "d. MMMM yyyy H:mm:ss",
                cs_CZ_M: "dd MMMM",
                cs_CZ_Y: "MMMM yyyy",
                he_IL_d: "dd MMMM yyyy",
                he_IL_D: "dddd dd MMMM yyyy",
                he_IL_t: "HH:mm",
                he_IL_T: "HH:mm:ss",
                he_IL_f: "dddd dd MMMM yyyy HH:mm",
                he_IL_F: "dddd dd MMMM yyyy HH:mm:ss",
                he_IL_M: "dd MMMM",
                he_IL_Y: "MMMM yyyy",
                hr_HR_d: "d.M.yyyy.",
                hr_HR_D: "d. MMMM yyyy.",
                hr_HR_t: "H:mm",
                hr_HR_T: "H:mm:ss",
                hr_HR_f: "d. MMMM yyyy. H:mm",
                hr_HR_F: "d. MMMM yyyy. H:mm:ss",
                hr_HR_M: "d. MMMM",
                hu_HU_d: "yyyy.MM.dd.",
                hu_HU_D: "yyyy. MMMM d.",
                hu_HU_t: "H:mm",
                hu_HU_T: "H:mm:ss",
                hu_HU_f: "yyyy. MMMM d. H:mm",
                hu_HU_F: "yyyy. MMMM d. H:mm:ss",
                hu_HU_M: "MMMM d.",
                hu_HU_Y: "yyyy. MMMM",
                jp_JP_d: "gg y/M/d",
                jp_JP_D: "gg y'?'M'?'d'?'",
                jp_JP_t: "H:mm",
                jp_JP_T: "H:mm:ss",
                jp_JP_f: "gg y'?'M'?'d'?' H:mm",
                jp_JP_F: "gg y'?'M'?'d'?' H:mm:ss",
                jp_JP_M: "M'?'d'?'",
                jp_JP_Y: "gg y'?'M'?'",
                lt_LT_d: "yyyy.MM.dd",
                lt_LT_D: "yyyy 'm.' MMMM d 'd.'",
                lt_LT_t: "HH:mm",
                lt_LT_T: "HH:mm:ss",
                lt_LT_f: "yyyy 'm.' MMMM d 'd.' HH:mm",
                lt_LT_F: "yyyy 'm.' MMMM d 'd.' HH:mm:ss",
                lt_LT_M: "MMMM d 'd.'",
                lt_LT_Y: "yyyy 'm.' MMMM",
                sa_IN_d: "dd-MM-yyyy",
                sa_IN_D: "dd MMMM yyyy dddd",
                sa_IN_t: "HH:mm",
                sa_IN_T: "HH:mm:ss",
                sa_IN_f: "dd MMMM yyyy dddd HH:mm",
                sa_IN_F: "dd MMMM yyyy dddd HH:mm:ss",
                sa_IN_M: "dd MMMM",
                basic_y: "yyyy",
                basic_ym: "yyyy-MM",
                basic_d: "yyyy-MM-dd",
                basic_dhm: "yyyy-MM-dd hh:mm",
                basic_bhms: "yyyy-MM-dd hh:mm:ss",
                basic2_ym: "MM-yyyy",
                basic2_d: "MM-dd-yyyy",
                basic2_dhm: "MM-dd-yyyy hh:mm",
                basic2_dhms: "MM-dd-yyyy hh:mm:ss",
                basic3_ym: "yyyy/MM",
                basic3_d: "yyyy/MM/dd",
                basic3_dhm: "yyyy/MM/dd hh:mm",
                basic3_bhms: "yyyy/MM/dd hh:mm:ss",
                basic4_ym: "MM/yyyy",
                basic4_d: "MM/dd/yyyy",
                basic4_dhm: "MM/dd/yyyy hh:mm",
                basic4_dhms: "MM/dd/yyyy hh:mm:ss"
            };
            if (e) {
                d = a.extend({}, d, e)
            }
            var c = [];
            if (!a.isArray(g)) {
                c.push(g)
            } else {
                c = g
            }
            for (var f in d) {
                d[f] = {
                    format: d[f],
                    count: 0
                }
            }
            for (var h = 0; h < c.length; h++) {
                value = c[h];
                if (value == null || value == undefined) {
                    continue
                }
                for (var f in d) {
                    var b = a.jqx.dataFormat.parsedate(value, d[f].format);
                    if (b != null) {
                        d[f].count++
                    }
                }
            }
            var k = {
                key: undefined,
                count: 0
            };
            for (var f in d) {
                if (d[f].count > k.count) {
                    k.key = f;
                    k.count = d[f].count
                }
            }
            return k.key ? d[k.key].format : ""
        },
        _testXAxisDateFormat: function(h) {
            var k = this;
            var d = k._getXAxis(h);
            var c = k._getDataLen(h);
            var e = {};
            if (k.localization && k.localization.patterns) {
                for (var j in k.localization.patterns) {
                    e["local_" + j] = k.localization.patterns[j]
                }
            }
            var g = [];
            for (var f = 0; f < c && f < 10; f++) {
                value = k._getDataValue(f, d.dataField, h);
                if (value == null || value == undefined) {
                    continue
                }
                g.push(value)
            }
            var b = k._detectDateFormat(g, e);
            return b
        }
    })
})(jqxBaseFramework);
