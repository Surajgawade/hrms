/*
 FusionCharts JavaScript Library
 Copyright FusionCharts Technologies LLP
 License Information at <http://www.fusioncharts.com/license>
*/
(function(B) { "object" === typeof module && "undefined" !== typeof module.exports ? module.exports = B : B(FusionCharts) })(function(B) {
    B.register("module", ["private", "modules.renderer.js-charts", function() {
            B.register("module", ["private", "modules.renderer.js-column2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("column2d", { standaloneInit: !0, friendlyName: "Column Chart", creditLabel: b, defaultDatasetType: "column", applicableDSList: { column: !0 }, singleseries: !0 }, a.sscartesian, { enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-column3d", function() { var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("column3d", { friendlyName: "3D Column Chart", defaultDatasetType: "column3d", applicableDSList: { column3d: !0 }, defaultPlotShadow: 1, creditLabel: b, is3D: !0, standaloneInit: !0, hasLegend: !1, singleseries: !0, fireGroupEvent: !0, defaultZeroPlaneHighlighted: !1 }, a.sscartesian3d, { showplotborder: 0, enablemousetracking: !0 }) }]);
            B.register("module", ["private", "modules.renderer.js-bar2d", function() { var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("bar2d", { friendlyName: "Bar Chart", isBar: !0, standaloneInit: !0, defaultDatasetType: "bar2d", creditLabel: a, applicableDSList: { bar2d: !0 }, singleseries: !0, spaceManager: b.barbase }, b.ssbarcartesian, { enablemousetracking: !0 }) }]);
            B.register("module", ["private", "modules.renderer.js-bar3d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("bar3d", { friendlyName: "3D Bar Chart", defaultDatasetType: "bar3d", applicableDSList: { bar3d: !0 }, defaultPlotShadow: 1, fireGroupEvent: !0, standaloneInit: !0, creditLabel: b, is3D: !0, isBar: !0, singleseries: !0, defaultZeroPlaneHighlighted: !1 }, a.ssbarcartesian3d, { showplotborder: 0, enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-area2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("area2d", {
                    friendlyName: "Area Chart",
                    standaloneInit: !0,
                    creditLabel: b,
                    defaultDatasetType: "area",
                    singleseries: !0,
                    defaultPlotShadow: 0
                }, a.sscartesian, { enablemousetracking: !0 }, a.areabase)
            }]);
            B.register("module", ["private", "modules.renderer.js-line", function() {
                var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("line", { friendlyName: "Line Chart", standaloneInit: !0, creditLabel: a, defaultPlotShadow: 1, singleseries: !0, axisPaddingLeft: 0, axisPaddingRight: 0, defaultDatasetType: "line" }, b.sscartesian, {
                    zeroplanethickness: 1,
                    enablemousetracking: !0,
                    zeroplanealpha: 40,
                    showzeroplaneontop: 0
                }, b.areabase)
            }]);
            B.register("module", ["private", "modules.renderer.js-pareto2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    m = a.chartAPI,
                    C = a.pluck,
                    p = a.pluckNumber,
                    K = a.componentDispose;
                m("pareto2d", {
                    defaultDatasetType: "column2d",
                    singleseries: !0,
                    creditLabel: b,
                    _createDatasets: function() {
                        var a = this.components,
                            b = this.jsonData,
                            h = this.is3D,
                            x = a.numberFormatter,
                            l = b.data || b.dataset && b.dataset[0] && b.dataset[0].data,
                            f = l && l.length,
                            q = b.chart,
                            y = this.defaultDatasetType,
                            b = new(B.get("component", ["dataset", "Pareto"])),
                            G = p(q.showcumulativeline, 1),
                            L = [],
                            k, t;
                        if (l) {
                            for (q = 0; q < f; q++) k = l[q], t = x.getCleanValue(k.value), null !== t && "true" !== k.vline && !0 !== k.vline && 1 !== k.vline && "1" !== k.vline && L.push(k);
                            this.config.categories = L;
                            x = a.dataset || (a.dataset = []);
                            (l = C(y)) && l.toLowerCase();
                            l = B.register("component", ["datasetGroup", "column"]);
                            l = a[void 0] = new l;
                            l.chart = this;
                            l.init();
                            if (f = h ? B.get("component", ["dataset", "Column3d"]) : B.get("component", ["dataset", "Column"]))(h =
                                x[0]) ? (y = L.length, l = h.components.data.length, y < l && h.removeData(y, l - y), h.JSONData = { data: L }, b.configure.call(h)) : (h = new f, x.push(h), h.chart = this, h.index = q, l && l.addDataSet(h, 0, 0), b.init(h, L, y));
                            a = a.yAxis[1];
                            if (G) a && a.setAxisConfig({ drawLabels: !0, drawPlotLines: !0, drawAxisName: !0, drawAxisLine: !0, drawPlotBands: !0, drawTrendLines: !0, drawTrendLabels: !0 }), a.show(), f = B.get("component", ["dataset", "line"]), (h = x[1]) ? (y = L.length, l = h.components.data.length, y < l && h.removeData(y, l - y), h.JSONData = { data: L }, b.configure.call(h)) :
                                (h = new f, x.push(h), h.chart = this, h.index = q, b.init(h, L, "line"));
                            else { if (h = x[1]) K.call(h), x.pop();
                                a && (a.setAxisConfig({ drawLabels: !1, drawPlotLines: !1, drawAxisName: !1, drawAxisLine: !1, drawPlotBands: !1, drawTrendLines: !1, drawTrendLabels: !1 }), a.hide()) }
                        } else this.setChartMessage()
                    },
                    _setCategories: function() {
                        var a = this.components,
                            b = this.jsonData,
                            h = b.dataset,
                            x = a.numberFormatter,
                            a = a.xAxis,
                            b = b.data || h && h[0].data || [],
                            h = [],
                            l, f = b.length,
                            q, y = {},
                            G = 0,
                            L;
                        for (q = 0; q < f; q++) {
                            l = b[q];
                            L = x.getCleanValue(l.value, !0);
                            if ("true" ===
                                l.vline || "1" === l.vline || 1 === l.vline || !0 === l.vline) y[G] = l;
                            else if (null === L) continue;
                            else l.value = L, h.push(l);
                            G++
                        }
                        h.sort(function(a, f) { return f.value - a.value });
                        for (q in y) h.splice(q, 0, y[q]);
                        a[0].setCategory(h)
                    },
                    standaloneInit: !0,
                    hasLegend: !1,
                    isPercentage: !0
                }, m.msdybasecartesian, { enablemousetracking: !0, plotfillalpha: a.preDefStr.NINETYSTRING })
            }]);
            B.register("module", ["private", "modules.renderer.js-pareto3d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    m = a.chartAPI;
                m("pareto3d", { standaloneInit: !0, is3D: !0, friendlyName: "3D Pareto Chart", creditLabel: b, fireGroupEvent: !0, defaultPlotShadow: 1, singleseries: !0, hasLegend: !1, defaultDatasetType: "column3d", _createDatasets: m.pareto2d, _setCategories: m.pareto2d, isPercentage: !0 }, m.msdybasecartesian3d, { plotfillalpha: a.preDefStr.NINETYSTRING, use3dlineshift: 1, enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-pie2d", function() {
                var a = this,
                    b = a.hcLib,
                    m = b.hasTouch,
                    C = a.window,
                    p = C.document,
                    K = b.BLANKSTRING,
                    N = b.pluck,
                    Q = b.pluckNumber,
                    h = b.toRaphaelColor,
                    x = "createTouch" in p,
                    l = x && !(C.navigator.maxTouchPoints || C.navigator.msMaxTouchPoints),
                    f = b.each,
                    q = b.plotEventHandler,
                    y = b.schedular,
                    G = b.priorityList,
                    L = 8 === C.document.documentMode ? "visible" : "",
                    k = Math,
                    t = k.sin,
                    E = k.cos,
                    v = k.round,
                    z = k.atan2,
                    Y = k.min,
                    ka = k.max,
                    ea = k.abs,
                    B = k.PI,
                    ia = k.ceil,
                    ra = k.floor,
                    sa = B / 180,
                    na = 180 / B,
                    ma = Math.PI,
                    U = ma / 2,
                    ba = 2 * ma,
                    Aa = ma + U,
                    ua = b.graphics.convertColor,
                    P = b.POSITION_BOTTOM,
                    fa = b.POSITION_RIGHT,
                    B = b.chartAPI,
                    qa = b.COMMASTRING,
                    wa = b.ZEROSTRING,
                    ta = b.ONESTRING,
                    b = !b.CREDIT_REGEX.test(C.location.hostname),
                    xa = function(a, r, e, c, d) { return z((r - e[1] - c.top) / d, a - e[0] - c.left) };
                B("pie2d", {
                    friendlyName: "Pie Chart",
                    standaloneInit: !0,
                    defaultSeriesType: "pie",
                    defaultPlotShadow: 1,
                    reverseLegend: 1,
                    alignCaptionWithCanvas: 0,
                    sliceOnLegendClick: !0,
                    isSingleSeries: !0,
                    dontShowLegendByDefault: !0,
                    defaultDatasetType: "Pie2D",
                    applicableDSList: { Pie2D: !0 },
                    defaultZeroPlaneHighlighted: !1,
                    creditLabel: b,
                    _plotDragMove: function(f, r) {
                        var e = r[0],
                            c = r[1],
                            d = r[2],
                            n = r[3],
                            g = this.data("plotItem"),
                            ga =
                            g.chart,
                            g = g.seriesData,
                            T = ga.components.dataset[0].config;
                        isNaN(e) || isNaN(c) || !T.enableRotation || g.singletonCase || g.isRightClicked || (e = xa.call(f, d, n, g.pieCenter, g.chartPosition, 1), g.isRotating || (g.dragStartAngle !== e && (g.isRotating = !0), a.raiseEvent("RotationStart", { startingAngle: g._rotationalStartAngle = ga._startingAngle() }, ga.chartInstance)), T.startAngle += e - g.dragStartAngle, g.dragStartAngle = e, g.moveDuration = 0, T.updateInited || (T.updateInited = !0, setTimeout(ga._batchRotate || (ga._batchRotate = function() {
                            ga._rotate();
                            T.updateInited = !1
                        }), 50)))
                    },
                    _plotDragStart: function(a, r) {
                        var e = r[0],
                            c = r[1],
                            d = this.data("plotItem"),
                            n = d.chart,
                            d = d.seriesData,
                            g = n.components.dataset[0].config,
                            ga = -g.startAngle;
                        d.isRightClicked = m || 0 === a.button || 1 === a.button ? !1 : !0;
                        if (g.enableRotation && !d.isRightClicked) {
                            d.isRotating = !1;
                            g = n.linkedItems.container;
                            n = { left: 0, top: 0 };
                            if (g.getBoundingClientRect) g = g.getBoundingClientRect(), n.top = g.top + (C.pageYOffset || p.scrollTop || 0) - (p.clientTop || 0), n.left = g.left + (C.pageXOffset || p.scrollLeft || 0) - (p.clientLeft ||
                                0);
                            else
                                for (; g;) n.left += g.offsetLeft || 0, n.top += g.offsetTop || 0, g !== p.body && g !== p.documentElement && (n.left -= g.scrollLeft || 0, n.top -= g.scrollTop || 0), g = g.offsetParent;
                            d.chartPosition = n;
                            e = xa.call(a, e, c, d.pieCenter, d.chartPosition, 1);
                            d.dragStartAngle = e;
                            d.startingAngleOnDragStart = ga
                        }
                    },
                    _plotDragEnd: function(f) {
                        var r, e = this.data("plotItem"),
                            c = e.chart,
                            d = c.config,
                            n = d.linkedChartOpened,
                            g = e.seriesData;
                        g.isRightClicked || (d.clicked = !0, c.disposed || n || c._rotate(), !g.isRotating && c._plotGraphicClick.call(e.graphic, f),
                            delete d.clicked, g.isRotating && (setTimeout(function() { g.isRotating = !1 }, 0), a.raiseEvent("RotationEnd", { startingAngle: r = c._startingAngle(), changeInAngle: r - g._rotationalStartAngle }, c.chartInstance)))
                    },
                    _plotRollOver: function(a) {
                        var r = this.plotItem || this.data("plotItem"),
                            e = r.chart,
                            c = e.components.dataset[0].config,
                            d, n;
                        c.isRotating || (q.call(this, e, a, "DataPlotRollOver"), e.onPlotHover(this, !0));
                        c.isHovered = !0;
                        (a = r.innerDiameter) && (d = r.centerLabelConfig) && (n = d.label) && e.drawDoughnutCenterLabel(n, r.center[0],
                            r.center[1], a, a, d, !1)
                    },
                    onPlotHover: function(a, r) { var e = a.data("plotItem"),
                            c = e.center,
                            d = e.rolloverProperties || {},
                            n = r ? d.color : e.color,
                            g = r ? d.borderWidth : e.borderWidth,
                            ga = r ? d.borderColor : e.borderColor;
                        n && (r && (n.cx = c[0], n.cy = c[1], n.r = e.radius), d.enabled && e.graphic.attr({ fill: h(n), "stroke-width": g, stroke: ga })) },
                    _plotRollOut: function(a) {
                        var r = this.plotItem || this.data("plotItem"),
                            e = r.chart,
                            c = e.components.dataset[0].config,
                            d, n;
                        c.isRotating || (q.call(this, e, a, "DataPlotRollOut"), e.onPlotHover(this, !1));
                        c.isHovered = !1;
                        (a = r.innerDiameter) && (d = c.centerLabelConfig) && ((n = d.label) || !n) && e.drawDoughnutCenterLabel(n, r.center[0], r.center[1], a, a, d, !1)
                    },
                    _rotate: function() {
                        var a, r, e = this.components.dataset[0],
                            c = e.config,
                            d = e.components.data,
                            n = this.config,
                            g = c.slicingDistance,
                            e = e.config,
                            ga = ba / e.valueTotal,
                            T = n.canvasLeft + .5 * n.canvasWidth,
                            n = n.canvasTop + .5 * n.canvasHeight,
                            w = c.pieMinRadius,
                            V = .5 * (c.piePlotOptions.innerSize || 0),
                            S, ca, F, f, u;
                        S = (c.startAngle || 0) % ba;
                        for (u = 0; u < d.length; u += 1) F = d[u].config, f = d[u].graphics, a = F.y, null !==
                            a && void 0 !== a && (ca = S, S -= e.singletonCase ? ba : a * ga, a = .5 * (S + ca), F.angle = a, F.transX = E(a) * g, F.transY = t(a) * g, F.slicedTranslation = "t" + E(a) * g + qa + t(a) * g, (r = F._rotateAttrs) || (r = F._rotateAttrs = { ringpath: [], transform: K }), a = r.ringpath, a[0] = T, a[1] = n, a[2] = w, a[3] = V, a[4] = S, a[5] = ca, r.transform = F.sliced ? F.slicedTranslation : K, f.element.attr(r));
                        this.placeDataLabels(!0, d, c)
                    },
                    getPlotData: function(a, r) {
                        var e = this.components.dataset[0],
                            c = e.components.data[a].config,
                            e = e.config.userData || (e.config.userData = []),
                            d, n;
                        if (e[a]) e =
                            e[a];
                        else { e = e[a] = {}; for (n in c) "object" !== typeof(d = c[n]) && "function" !== typeof d && 0 !== n.indexOf("_") && (e[n] = d);
                            e.value = e.y;
                            e.categoryLabel = e.label = e.seriesName;
                            delete e.y;
                            delete e.total;
                            delete e.doNotSlice;
                            delete e.name;
                            delete e.seriesName;
                            delete e.centerAngle;
                            delete e.showInLegend;
                            delete e.angle;
                            delete e.endAngle;
                            delete e.isVisible;
                            delete e.setColor;
                            delete e.slicedTranslation;
                            delete e.startAngle;
                            delete e.transX;
                            delete e.transY;
                            delete e.pValue }
                        e.sliced = r;
                        return e
                    },
                    _plotGraphicClick: function(f) {
                        var r,
                            e = this.element || this,
                            c = e.plotItem || e.data("plotItem"),
                            d = e.data("eventArgs") || {},
                            n = c.chart,
                            g = c.index,
                            ga = n.components.dataset[0],
                            T = n.config,
                            w = ga.config,
                            V = w.enableMultiSlicing,
                            S = ga.components.data[g],
                            ca = ga.config.labelDrawID,
                            F = S.graphics,
                            S = S.config,
                            b = S.doNotSlice,
                            u;
                        r = S.slicedTranslation;
                        var k = n.get("config", "animationObj"),
                            ga = k.duration || 200,
                            G = k.dummyObj,
                            L = k.animObj,
                            k = k.animType,
                            A = e.data("eventArgs").link,
                            A = A && A.split(/\s*[\-\:]\s*/)[0].toLowerCase();
                        !w.isRotating && f && q.call(e, n, f);
                        if (!(w.isRotating ||
                                w.singletonCase || b))
                            if ("newchart" === A || "newmap" === A) T.linkedChartOpened = !0, ca && y.removeJob(ca);
                            else if (T.linkedChartOpened = !1, f = !V && n.sliceInOtherPies(g), !(u = S.sliced) || !f) {
                            if (x && !l) { f = (new Date).getTime(); if (c.lastSliceTimeStamp && 400 > f - c.lastSliceTimeStamp) return;
                                c.lastSliceTimeStamp = f }
                            T = F.element;
                            c = F.connector;
                            w = F.label || F.dataLabel;
                            r = "object" === typeof r ? "t" + r : r;
                            V = S.connectorPath;
                            F = (u ? -1 : 1) * S.transX;
                            f = (u ? -1 : 1) * S.transY;
                            e = T.data("eventArgs") || T.data("eventArgs", {});
                            a.raiseEvent("slicingStart", {
                                slicedState: u,
                                dataIndex: "index" in d && d.index,
                                data: n.getPlotData(g, u)
                            }, n.chartInstance);
                            T.animateWith(G, L, { transform: u ? "t0,0" : r }, ga, k, function() { a.raiseEvent("slicingEnd", { slicedState: u, dataIndex: "index" in d && d.index, data: n.getPlotData(g, u) }, n.chartInstance) });
                            w && w.x && ((r = w.data("textPos")) || (r = w.data("textPos", { x: w.x, y: w.y })), w.animateWith(G, L, { x: w.x + (u ? 0 : F) }, ga, k), r.x = w.x + (u ? 0 : F));
                            V && (r = V.slice(0), r[1] += F, r[2] += f, r[4] += F, r[6] += F, c.animateWith(G, L, { path: r }, ga, k), S.connectorPath = r);
                            return e.isSliced = u = S.sliced = !u
                        }
                    },
                    sliceInOtherPies: function(a) { var r = this.components.dataset[0],
                            e = r.components.data,
                            c = e.length,
                            d = 0,
                            n; for (r.enableMultiSlicing = !0; c--;) c !== a && (n = e[c]).config.sliced && ++d && this._plotGraphicClick.call(n.graphics);
                        r.enableMultiSlicing = !1; return !!d },
                    placeDataLabels: function() {
                        var a = function(e, c) { return e.point.value - c.point.value },
                            r = function(e, c) { return e.angle - c.angle },
                            e = ["start", "start", "end", "end"],
                            c = [-1, 1, 1, -1],
                            d = [1, 1, -1, -1];
                        return function(n, g, ga, T) {
                            var w = this.config,
                                V = this.components,
                                S = V.dataset[0],
                                ca = V.legend.config,
                                F = ca.symbolWidth,
                                q = ca.align,
                                ca = ca.borderWidth,
                                u = S.graphics,
                                b = S.config,
                                G = w.canvasLeft,
                                y = w.canvasTop,
                                S = w.canvasWidth,
                                A = G + .5 * w.canvasWidth,
                                l = y + .5 * w.canvasHeight,
                                Ba = this.linkedItems.smartLabel,
                                ya = b.dataLabelOptions,
                                v = ya.style,
                                h = Q(ia(parseFloat(v.lineHeight)), 12),
                                N = 1 === g.length ? w.singletonPlaceValue : !1,
                                x = ya.skipOverlapLabels,
                                R = ya.manageLabelOverflow,
                                D = ya.connectorPadding,
                                J;
                            J = T && T.metrics || [A, l, 2 * b.pieMinRadius, b.innerSize || 0];
                            var M = J[1],
                                z = J[0];
                            T = .5 * J[2];
                            var b = [
                                    [],
                                    [],
                                    [],
                                    []
                                ],
                                A = ga.labelsRadius =
                                T + ya.distance,
                                Z = l = parseInt(v.fontSize, 10),
                                W = Z / 2,
                                D = [D, D, -D, -D];
                            ga = ga.labelsMaxInQuadrant = ra(A / Z);
                            var ya = ya.isSmartLineSlanted,
                                H = J[3] / 2,
                                X, O, K, p, C, m, B, P, ha, Ea, I, oa, la, va, fa;
                            J = Number.POSITIVE_INFINITY;
                            var ja, pa;
                            O = [];
                            K = [];
                            O = this.get("config", "animationObj");
                            var na = n ? 0 : O.duration || 0,
                                qa = O.dummyObj,
                                sa = O.animObj,
                                ua = O.animType,
                                ta = this._plotDragMove,
                                Sa = this._plotDragStart,
                                Ka = this._plotDragEnd,
                                za = this._plotRollOver,
                                aa = this._plotRollOut,
                                wa = V.paper,
                                xa = u.dataLabelContainer,
                                da, Ga;
                            Ba.useEllipsesOnOverflow(w.useEllipsesWhenOverflow);
                            n || Ba.setStyle(v);
                            if (1 == g.length && !H && N) O = g[0], (da = O.config._textAttrs).text && (pa = O.graphics, ja = O.config, I = pa.label, O.slicedTranslation = [G, y], da["text-anchor"] = "middle", da.x = 0, da.y = 0, da.transform = ["t", z, M], I ? I.animateWith(qa, sa, da, na, ua) : I = pa.label = wa.text(da, Ga, xa).drag(ta, Sa, Ka).hover(za, aa), I.x = z, I.data("textPos", { x: z, y: M }).data("plotItem", da.plotItem).data("eventArgs", da.eventArgs), null !== ja.y && void 0 !== ja.y && I.show(), pa.connector && pa.connector.attr({ path: [] }));
                            else if (N) fa = H + (T - H) / 2, f(g, function(e) {
                                ja =
                                    e.config;
                                (da = ja._textAttrs).text && (pa = e.graphics, I = pa.label, null !== ja.y && void 0 !== ja.y && ((Ea = pa.connector) && Ea.show(), I && I.show()), da.transform = "t0,0", ha = ja.angle, P = M + fa * t(ha), p = z + fa * E(ha), da._x = p, da._y = P, e.sliced && (va = e.slicedTranslation, oa = va[0] - G, la = va[1] - y, p += oa, P += la), da["text-anchor"] = "middle", da.x = 0, da.y = 0, da.transform = ["t", p, P], I ? I.animateWith(qa, sa, da, na, ua) : I = pa.label = wa.text(da, Ga, xa).drag(ta, Sa, Ka).hover(za, aa), I.x = da._x, I.x = da._x, I.y = da._y, I.data("plotItem", da.plotItem).data("eventArgs",
                                    da.eventArgs), da.visibility === L && I.show())
                            });
                            else {
                                for (n = g.length - 1; 0 <= n; n--)
                                    if (O = g[n], ja = O.config, da = ja._textAttrs, da.text = ja.displayValue) pa = O.graphics, null !== ja.y && void 0 !== ja.y && (I = pa.label, (Ea = pa.connector) && Ea.show(), I && I.show()), da.text = ja.displayValue, da.transform = "t0,0", ha = ja.angle % ba, 0 > ha && (ha = ba + ha), V = 0 <= ha && ha < U ? 1 : ha < ma ? 2 : ha < Aa ? 3 : 0, b[V].push({ point: O, angle: ha });
                                for (n = g = 4; n--;) {
                                    if (x && (V = b[n].length - ga, 0 < V))
                                        for (b[n].sort(a), u = b[n].splice(0, V), V = 0, N = u.length; V < N; V += 1) O = u[V].point, da = O.config._textAttrs,
                                            pa = O.graphics, pa.label && pa.label.attr("visibility", "hidden"), pa.connector && pa.connector.attr({ visibility: "hidden" });
                                    b[n].sort(r)
                                }
                                n = ka(b[0].length, b[1].length, b[2].length, b[3].length);
                                V = ka(Y(n, ga) * Z, A + Z);
                                K = b[0].concat(b[1]);
                                O = b[2].concat(b[3]);
                                for (n = K.length - 1; 0 <= n; n--) u = K[n].point.config, delete u.clearance, delete u.clearanceShift, H = ea(V * t(u.angle)), Math.abs(J - H) < 2 * h && (u.clearance = 0, K[n + 1].point.clearanceShift = h / 2), J = H;
                                J = Number.POSITIVE_INFINITY;
                                n = 0;
                                for (N = O.length; n < N; n++) u = O[n].point.config, delete u.clearance,
                                    delete u.clearanceShift, H = ea(V * t(u.angle)), Math.abs(J - H) < 2 * h && (u.clearance = 0, O[n - 1].point.clearanceShift = h / 2), J = H;
                                b[1].reverse();
                                for (b[3].reverse(); g--;) {
                                    u = b[g];
                                    N = u.length;
                                    x || (Z = N > ga ? V / N : l, W = Z / 2);
                                    h = N * Z;
                                    J = V;
                                    for (n = 0; n < N; n += 1, h -= Z) H = ea(V * t(u[n].angle)), J < H ? H = J : H < h && (H = h), J = (u[n].oriY = H) - Z;
                                    v = e[g];
                                    N = V - (N - 1) * Z;
                                    J = 0;
                                    for (n = u.length - 1; 0 <= n; --n, N += Z)
                                        if (O = u[n].point, ha = u[n].angle, ja = O.config, da = ja._textAttrs, da.text && (Ga = ja._textCss, pa = O.graphics, O = ja.sliced, I = pa.label, H = ea(V * t(ha)), H < J ? H = J : H > N && (H = N), J = H + Z,
                                                h = void 0 === ja.clearance ? 2 * ia(Q(parseFloat(ja.style.border), 12), 12) : 2 * ia(Q(parseFloat(ja.style.border), ja.clearance)), m = (H + u[n].oriY) / 2, H = z + d[g] * A * E(k.asin(m / V)), m *= c[g], m += M, B = M + T * t(ha), K = z + T * E(ha), (2 > g && H < K || 1 < g && H > K) && (H = K), p = H + D[g], P = m - W - 2, C = p + D[g], da._x = C, R && (X = 1 < g ? C - w.canvasLeft : w.canvasLeft + S - C, Ba.setStyle(ja.style), h = Q(ia(parseFloat(ja.style.lineHeight)), 12) + h, "right" === q && 0 < ja.transX && (X -= F + 2 * ca), h = Ba.getSmartText(ja.displayValue, X, h), void 0 === ja.clearance && h.height > Z && (m += Z), "right" !== q &&
                                                    0 < ja.transY && (m -= Z), da.text = h.text, da.tooltip = h.tooltext), da._y = P, O && (oa = ja.transX, la = ja.transY, p += oa, H += oa, K += oa, B += la, C += oa), da["text-anchor"] = v, da.vAlign = "middle", da.x = C, da.y = m, (h = I && I.data("textPos")) ? I.attr({ x: h.x, y: h.y }).animateWith(qa, sa, da, na) : I = pa.label = wa.text(da, Ga, xa).drag(ta, Sa, Ka).hover(za, aa), I.x = da._x, I._x = da._x, I.y = da._y, da.tooltip && (I.tooltip(da.tooltip), delete da.tooltip), da.visibility === L && I.show(), I.data("textPos", { x: C, y: m }).data("plotItem", da.plotItem).data("eventArgs", da.eventArgs),
                                                Ea = pa.connector)) ja.connectorPath = h = ["M", K, B, "L", ya ? H : K, m, p, m], (O = Ea.data("connectorPath")) ? w.clicked || Ea.attr({ path: O.path }).animateWith(qa, sa, { path: h }, na) : Ea.attr({ path: h }), Ea.data("connectorPath", { path: h })
                                }
                            }
                        }
                    }(),
                    _spaceManager: function() {
                        var a = this.config,
                            r = this.components,
                            e = r.dataset[0],
                            c = e.components.data,
                            d = e.config,
                            n = r.legend,
                            g = r.colorManager,
                            ga = this.linkedItems.smartLabel,
                            T = d.dataLabelCounter,
                            w = 0,
                            f = this.jsonData.chart,
                            r = Q(f.managelabeloverflow, 0),
                            S = Q(f.slicingdistance),
                            ca = d.preSliced || a.allPlotSliceEnabled !==
                            wa || f.showlegend === ta && f.interactivelegend !== wa ? ea(Q(S, 20)) : 0,
                            F = Q(f.pieradius, 0),
                            b = (S = Q(f.enablesmartlabels, f.enablesmartlabel, 1)) ? Q(f.skipoverlaplabels, f.skipoverlaplabel, 1) : 0,
                            u = Q(f.issmartlineslanted, 1),
                            q = T ? Q(f.labeldistance, f.nametbdistance, 5) : ca,
                            k = Q(f.smartlabelclearance, 5),
                            G = a.width,
                            A = a.height,
                            y = (this._manageActionBarSpace(.225 * A) || {}).bottom,
                            G = G - (a.marginRight + a.marginLeft),
                            A = A - (a.marginTop + a.marginBottom) - (y ? y + a.marginBottom : 0),
                            y = Y(A, G),
                            L = N(f.smartlinecolor, g.getColor("plotFillColor")),
                            t = Q(f.smartlinealpha,
                                100),
                            E = Q(f.smartlinethickness, .7),
                            e = d.dataLabelOptions = e._parseDataLabelOptions(),
                            g = e.style,
                            g = T ? Q(parseInt(g.lineHeight, 10), 12) : 0,
                            h = 0 === F ? .15 * y : F,
                            l = 2 * h,
                            v = { bottom: 0, right: 0 },
                            R = d.pieYScale,
                            y = d.pieSliceDepth;
                        e.connectorWidth = E;
                        e.connectorPadding = Q(f.connectorpadding, 5);
                        e.connectorColor = ua(L, t);
                        T && (S && (q = k), q += ca);
                        k = l + 2 * (g + q);
                        k = this._manageChartMenuBar(k < A ? A - k : A / 2);
                        A -= (k.top || 0) + (k.bottom || 0);
                        d.showLegend && (this.hasLegend = !0, N(f.legendposition, P).toLowerCase() !== fa ? (v = n._manageLegendPosition(A / 2), A -=
                            v.bottom) : (v = n._manageLegendPosition(A / 2), G -= v.right));
                        this._allocateSpace(v);
                        ga.useEllipsesOnOverflow(a.useEllipsesWhenOverflow);
                        if (1 !== T)
                            for (; T--;) ga.setStyle(c[T].config.style || a.dataLabelStyle), n = ga.getOriSize(c[T].config.displayValue), w = ka(w, n.width);
                        0 === F ? h = this._stubRadius(G, w, A, q, ca, g, h) : (d.slicingDistance = ca, d.pieMinRadius = h, e.distance = q);
                        a = A - 2 * (h * R + g);
                        d.managedPieSliceDepth = y > a ? y - a : d.pieSliceDepth;
                        e.isSmartLineSlanted = u;
                        e.enableSmartLabels = S;
                        e.skipOverlapLabels = b;
                        e.manageLabelOverflow = r
                    },
                    _stubRadius: function(a, r, e, c, d, n, g) { var ga = this.components.dataset[0],
                            f = ga.config,
                            w = Q(this.jsonData.chart.slicingdistance),
                            ga = f.dataLabelOptions || (f.dataLabelOptions = ga._parseDataLabelOptions()),
                            V = 0,
                            V = Y(a / 2 - r - d, e / 2 - n) - c;
                        V >= g ? g = V : w || (d = c = ka(Y(c - (g - V), d), 10));
                        f.slicingDistance = d;
                        f.pieMinRadius = g;
                        ga.distance = c; return g },
                    getDataSet: function(a) { return this.components.dataset[a] },
                    _startingAngle: function(a, r) {
                        var e, c = this.components.dataset[0].config,
                            d = (e = c.startAngle) * -na + (0 > -1 * e ? 360 : 0);
                        isNaN(a) || (c.singletonCase ||
                            c.isRotating ? d = c.startAngle : (a += r ? d : 0, c.startAngle = -a * sa, this._rotate(a), d = a));
                        return v(100 * ((d %= 360) + (0 > d ? 360 : 0))) / 100
                    },
                    eiMethods: {
                        isPlotItemSliced: function(a) { var r, e, c, d = this.apiInstance; return d && d.components.dataset && (c = d.components.dataset[0]) && (r = c.components.data) && r.length && r[a] && (e = r[a].config) && e.sliced },
                        addData: function() { var a, r = this.apiInstance; return r && r.components.dataset && (a = r.components.dataset[0]) && a.addData.apply(a, arguments) },
                        removeData: function() {
                            var a, r = this.apiInstance;
                            return r &&
                                r.components.dataset && (a = r.components.dataset[0]) && a.removeData.apply(a, arguments)
                        },
                        updateData: function() { var a, r = this.apiInstance; return r && r.components.dataset && (a = r.components.dataset[0]) && a.updateData.apply(a, arguments) },
                        slicePlotItem: function(a, r, e) {
                            var c, d, n, g, ga, f = !!r,
                                w = this.apiInstance,
                                V = w.chartInstance.args.asyncRender,
                                S = w.getJobList();
                            if (e || V) S.eiMethods.push(y.addJob(function() {
                                ga = w && w.components.dataset && (c = w.components.dataset[0]) && (d = c.components.data) && (g = d.length) && d[a = c.config.reversePlotOrder ?
                                    g - a - 1 : a] && (n = d[a].config) && ((f !== n.sliced || void 0 === r) && w._plotGraphicClick.call(d[a].graphics.element) || n.sliced);
                                "function" === typeof e && e(ga)
                            }, G.postRender));
                            else return w && w.components.dataset && (c = w.components.dataset[0]) && (d = c.components.data) && (g = d.length) && d[a = c.config.reversePlotOrder ? g - a - 1 : a] && (n = d[a].config) && ((f !== n.sliced || void 0 === r) && w._plotGraphicClick.call(d[a].graphics.element) || n.sliced)
                        },
                        centerLabel: function(a, r) {
                            var e = this.apiInstance,
                                c = e.getJobList(),
                                d = function() {
                                    var c = e.components.dataset[0],
                                        d = c.config,
                                        ga = d.piePlotOptions.innerSize,
                                        f = d.pieCenter,
                                        w = f[0],
                                        f = f[1],
                                        d = d.centerLabelConfig,
                                        V;
                                    if ("object" !== typeof r) r = d;
                                    else
                                        for (V in d) void 0 === r[V] && (r[V] = d[V]);
                                    r.label = a;
                                    c.centerLabelConfig = r;
                                    ga && e.drawDoughnutCenterLabel(a || "", w, f, ga, ga, r, !0)
                                };
                            e.chartInstance.args.asyncRender ? c.eiMethods.push(y.addJob(d, G.postRender)) : d()
                        },
                        startingAngle: function(a, r, e) {
                            var c = this.apiInstance,
                                d = c.chartInstance.args.asyncRender,
                                n = c.getJobList(),
                                g;
                            if (e || d) n.eiMethods.push(y.addJob(function() {
                                g = c._startingAngle(a,
                                    r);
                                "function" === typeof e && e(g)
                            }, G.postRender));
                            else return c._startingAngle(a, r)
                        }
                    }
                }, B.guageBase, { plotborderthickness: 1, alphaanimation: 0, singletonPlaceValue: !0, usedataplotcolorforlabels: 0, enableslicing: ta })
            }]);
            B.register("module", ["private", "modules.renderer.js-pie3d", function() {
                function a(r) { this.config = {};
                    this.linkedItems = { chart: r } }
                var b = this,
                    m = b.hcLib,
                    C = m.Raphael,
                    p = m.hasTouch,
                    K = b.window,
                    N = m.getPosition,
                    Q = m.pluck,
                    h = m.pluckNumber,
                    x = m.each,
                    l = m.plotEventHandler,
                    f = 8 === K.document.documentMode ? "visible" :
                    "",
                    q = Math,
                    y = q.sin,
                    G = q.cos,
                    L = q.round,
                    k = q.atan2,
                    t = q.min,
                    E = q.max,
                    v = q.abs,
                    z = q.PI,
                    B = q.ceil,
                    ka = q.floor,
                    ea = Math.PI,
                    va = ea / 2,
                    ia = 2 * ea,
                    ra = ea + va,
                    sa = m.chartAPI,
                    na = !m.CREDIT_REGEX.test(K.location.hostname),
                    ma = function(r, e, c, d, n) { return k((e - c[1] - d.top) / n, r - c[0] - d.left) },
                    U = m.graphics.getDarkColor,
                    ba = m.graphics.getLightColor,
                    Aa = m.getFirstValue,
                    ua = m.graphics.convertColor,
                    P = m.COMMASTRING,
                    fa = m.toRaphaelColor,
                    qa = m.hasSVG,
                    wa = function(r, e) { for (var c = [], d = 0, n = r.length; d < n; d++) c[d] = e.call(r[d], r[d], d, r); return c },
                    ta = function(r,
                        e) { var c = e ? 360 : ia;
                        r = (r || 0) % c; return 0 > r ? c + r : r },
                    xa = {},
                    Fa = {};
                sa("pie3d", {
                    defaultDatasetType: "Pie3D",
                    applicableDSList: { Pie3D: !0 },
                    is3D: !0,
                    friendlyName: "3D Pie Chart",
                    fireGroupEvent: !0,
                    creditLabel: na,
                    getPointColor: function(r) { return r },
                    _configureManager: function() { var r = this.components.dataset[0],
                            e = r.config,
                            c = r.components,
                            r = c.Pie3DManager,
                            c = c.data;
                        r && r.configure(e.pieSliceDepth, 1 === c.length, e.use3DLighting, !1) },
                    defaultPlotShadow: 0,
                    _preDrawCalculate: function() {
                        var r, e, c = this.config,
                            d = 0,
                            n = this.components.dataset[0],
                            g = n.config;
                        r = n.components;
                        e = g.dataLabelOptions;
                        var ga = g.pie3DOptions = n._parsePie3DOptions(),
                            f = Q(g.startAngle, 0) % ia,
                            w = g.managedPieSliceDepth,
                            V = g.slicedOffset = ga.slicedOffset,
                            S = c.canvasWidth,
                            ca = c.canvasHeight,
                            F = [c.canvasLeft + .5 * S, c.canvasTop + .5 * ca - .5 * w],
                            b, u, c = r.data,
                            k, E = t(S, ca),
                            l, A = e.distance;
                        b = g.pieYScale;
                        var v = g.slicedOffsetY || (g.slicedOffsetY = V * g.pieYScale);
                        k = r.Pie3DManager;
                        F.push(2 * g.pieMinRadius, ga.innerSize || 0);
                        F = wa(F, function(e, c) { return (l = /%$/.test(e)) ? [S, ca - w, E, E][c] * parseInt(e, 10) / 100 : e });
                        F[2] /= 2;
                        F[3] /= 2;
                        F.push(F[2] * b);
                        F.push((F[2] + F[3]) / 2);
                        F.push(F[5] * b);
                        n.getX = function(e, c) { u = q.asin((e - F[1]) / (F[2] + A)); return F[0] + (c ? -1 : 1) * G(u) * (F[2] + A) };
                        g.center = F;
                        x(c, function(e) { d += e.config.y });
                        g.labelsRadius = F[2] + A;
                        g.labelsRadiusY = g.labelsRadius * b;
                        g.quadrantHeight = (ca - w) / 2;
                        g.quadrantWidth = S / 2;
                        n = L(1E3 * f) / 1E3;
                        ga = n + ia;
                        f = h(parseInt(e.style.fontSize, 10), 10) + 4;
                        g.maxLabels = ka(g.quadrantHeight / f);
                        g.labelFontSize = f;
                        g.connectorPadding = h(e.connectorPadding, 5);
                        g.isSmartLineSlanted = Q(e.isSmartLineSlanted, !0);
                        g.connectorWidth = h(e.connectorWidth, 1);
                        g.enableSmartLabels = e.enableSmartLabels;
                        k || (k = r.Pie3DManager = new a(this), this.get("graphics", "datasetGroup").trackTooltip(!0));
                        this._configureManager();
                        for (r = c.length - 1; 0 <= r; --r) e = c[r], e = e.config, f = n, k = d ? e.y / d : 0, n = L(1E3 * (n + k * ia)) / 1E3, n > ga && (n = ga), b = n, e.shapeArgs = { start: L(1E3 * f) / 1E3, end: L(1E3 * b) / 1E3 }, e.centerAngle = u = (b + f) / 2 % ia, e.slicedTranslation = [L(G(u) * V), L(y(u) * v)], f = G(u) * F[2], g.radiusY = b = y(u) * F[4], e.tooltipPos = [F[0] + .7 * f, F[1] + b], e.percentage = 100 * k, e.total =
                            d
                    },
                    placeDataLabels: function() {
                        var r = function(e, c) { return e.point.value - c.point.value },
                            e = function(e, c) { return e.angle - c.angle },
                            c = ["start", "start", "end", "end"],
                            d = [-1, 1, 1, -1],
                            n = [1, 1, -1, -1];
                        return function(g) {
                            var a, T, w = this.config,
                                V = this.components,
                                S = V.dataset[0],
                                ca = S.config,
                                F = S.components.data,
                                b = ca.piePlotOptions,
                                u = w.canvasLeft,
                                k = w.canvasTop,
                                l = w.canvasWidth,
                                N = u + .5 * w.canvasWidth,
                                A = k + .5 * w.canvasHeight,
                                K = this.linkedItems.smartLabel,
                                Ba = ca.dataLabelOptions,
                                ya = Ba.style;
                            a = h(B(parseFloat(ya.lineHeight)), 12);
                            a = Aa(Ba.placeInside, !1);
                            var z = Ba.skipOverlapLabels,
                                m = Ba.manageLabelOverflow,
                                p = Ba.connectorPadding,
                                C = Ba.distance,
                                R = Ba.connectorWidth,
                                D = [
                                    [],
                                    [],
                                    [],
                                    []
                                ],
                                J = parseInt(ya.fontSize, 10),
                                M = J,
                                Q = M / 2,
                                p = [p, p, -p, -p],
                                Z = Ba.isSmartLineSlanted,
                                W, H, X, O, ka, P, Da, Ra, fa, U, ha, Ea, I, oa, la, C = 0 < C,
                                ba = ca.center || (ca.center = [N, A, b.size, b.innerSize || 0]),
                                na = ba[1],
                                ja = ba[0],
                                b = ba[2],
                                N = ba[4],
                                A = ca.labelsRadius,
                                pa = L(100 * ca.labelsRadiusY) / 100,
                                qa = ca.maxLabels,
                                sa = ca.enableSmartLabels,
                                ma = ca.pieSliceDepth / 2;
                            H = this.get("config", "animationObj");
                            var ua = g ? 0 : H.duration,
                                ta = H.dummyObj,
                                wa = H.animObj,
                                xa = H.animType,
                                za, aa, Ta = this._plotDragMove,
                                Fa = this._plotDragStart,
                                da = this._plotDragEnd,
                                Ga = this._plotRollOver,
                                La = this._plotRollOut,
                                Ma = V.paper,
                                Ua = S.graphics.dataLabelContainer;
                            K.useEllipsesOnOverflow(w.useEllipsesWhenOverflow);
                            if (ca.dataLabelCounter)
                                if (g || K.setStyle(ya), 1 == F.length) H = F[0], oa = H.graphics, I = H.config, aa = I._textAttrs, za = I._textCss, ha = oa.label, la = oa.connector, I.slicedTranslation = [u, k], null !== I.y && void 0 !== I.y && (aa.visibility = f, aa["text-anchor"] =
                                    "middle", aa.x = ja, aa.y = na + Q - 2, aa._x = ja), ha ? ha.animateWith(ta, wa, aa, ua, xa) : ha = oa.label = Ma.text(aa, za, Ua).drag(Ta, Fa, da).hover(Ga, La), aa._x && (ha.x = aa._x, delete aa.x), ha.data("plotItem", aa.plotItem).data("eventArgs", aa.eventArgs), aa.visibility === f && ha.show(), la && la.hide();
                                else if (a) x(F, function(e) {
                                oa = e.graphics;
                                I = e.config;
                                aa = I._textAttrs;
                                ha = oa.label;
                                if (null !== I.y && void 0 !== I.y) {
                                    U = I.angle;
                                    fa = na + ba[6] * y(U) + Q - 2;
                                    ka = ja + ba[5] * G(U);
                                    aa._x = ka;
                                    aa._y = fa;
                                    if (I.sliced) {
                                        e = e.slicedTranslation;
                                        var c = e[1] - k;
                                        ka += e[0] - u;
                                        fa += c
                                    }
                                    aa.visibility = f;
                                    aa.align = "middle";
                                    aa.x = ka;
                                    aa.y = fa
                                }
                                ha ? ha.animateWith(ta, wa, aa, ua, xa) : ha = oa.label = Ma.text(aa, za, Ua).drag(Ta, Fa, da).hover(Ga, La);
                                ha.data("plotItem", aa.plotItem).data("eventArgs", aa.eventArgs);
                                aa.visibility === f && ha.show();
                                ha.x = aa._x;
                                ha._x = aa._x;
                                ha._y = aa._y
                            });
                            else {
                                x(F, function(e) {
                                    oa = e.graphics;
                                    I = e.config;
                                    za = I._textCss;
                                    aa = I._textAttrs;
                                    if (aa.text = I.displayValue) oa = e.graphics, null !== I.y && void 0 !== I.y && (ha = oa.label, (la = oa.connector) && la.show(), ha && ha.show()), ha = oa.label, U = I.angle, 0 > U &&
                                        (U = ia + U), Ea = 0 <= U && U < va ? 1 : U < ea ? 2 : U < ra ? 3 : 0, D[Ea].push({ point: e, angle: U })
                                });
                                for (V = w = 4; V--;) { if (z && (S = D[V].length - qa, 0 < S))
                                        for (D[V].sort(r), ca = D[V].splice(0, S), S = 0, a = ca.length; S < a; S += 1) H = ca[S].point, oa = H.graphics, oa.label && oa.label.attr("visibility", "hidden"), oa.connector && oa.connector.attr({ visibility: "hidden" });
                                    D[V].sort(e) }
                                V = E(D[0].length, D[1].length, D[2].length, D[3].length);
                                pa = E(t(V, qa) * M, pa + M);
                                D[1].reverse();
                                D[3].reverse();
                                for (K.setStyle(ya); w--;) {
                                    S = D[w];
                                    a = S.length;
                                    z || (M = a > qa ? pa / a : J, Q = M / 2);
                                    ca = a * M;
                                    ya = pa;
                                    for (V = 0; V < a; V += 1, ca -= M) H = v(pa * y(S[V].angle)), ya < H ? H = ya : H < ca && (H = ca), ya = (S[V].oriY = H) - M;
                                    ca = c[w];
                                    F = pa - (a - 1) * M;
                                    ya = 0;
                                    for (V = S.length - 1; 0 <= V; --V, F += M) H = S[V].point, oa = H.graphics, I = H.config, aa = I._textAttrs, za = I._textCss, null !== I.y && aa.text && (U = S[V].angle, X = I.sliced, ha = oa.label, H = v(pa * y(U)), H < ya ? H = ya : H > F && (H = F), ya = H + M, Da = (H + S[V].oriY) / 2, H = ja + n[w] * A * G(q.asin(Da / pa)), Da *= d[w], Da += na, Ra = na + N * y(U), O = ja + b * G(U), (2 > w && H < O || 1 < w && H > O) && (H = O), ka = H + p[w], fa = Da + Q - 2, P = ka + p[w], aa._x = P, m && (W = 1 < w ? P - u : u + l - P, K.setStyle(I.style),
                                        a = h(B(parseFloat(I.style.lineHeight)), 12) + (2 * B(parseFloat(I.style.border), 12) || 0), a = K.getSmartText(I.displayValue, W, a), aa.text = a.text, aa.tooltip = a.tooltext), U < ea && (Da += ma, Ra += ma, fa += ma), aa._y = fa, X && (a = I.transX, X = I.transY, ka += a, H += a, O += a, Ra += X, P += a), aa.visibility = f, aa["text-anchor"] = ca, (a = ha && ha.data("textPos")) && ha.attr({ x: a.x, y: a.y }), aa.x = P, aa.y = Da, !g && a ? ha.animateWith(ta, wa, aa, ua, xa) : ha ? aa && ha.attr(aa) : ha = oa.label = Ma.text(aa, za, Ua).drag(Ta, Fa, da).hover(Ga, La), ha.data("textPos", { x: P, y: Da }).data("plotItem",
                                        aa.plotItem).data("eventArgs", aa.eventArgs), ha.x = aa._x, ha._x = aa._x, ha.y = aa._y, aa.tooltip && (ha.tooltip(aa.tooltip), delete aa.tooltip), C && R && sa && (la = oa.connector, I.connectorPath || (T = !0), I.connectorPath = a = ["M", O, Ra, "L", Z ? H : O, Da, ka, Da], a = { path: a, "stroke-width": R, stroke: Ba.connectorColor || "#606060", visibility: f }, la && (g || T ? la.attr(a) : la.animateWith(ta, wa, a, ua, xa))))
                                }
                            }
                        }
                    }(),
                    animate: function() {
                        var r, e, c, d, n = this,
                            a = n.components.dataset[0],
                            f = a.components.data;
                        r = n.graphics.datasetGroup;
                        var T = f.length;
                        e = a.config.alphaAnimation;
                        c = function() { n.disposed || n.disposing || n.placeDataLabels(!1) };
                        var w = n.get("config", "animationObj"),
                            a = w.duration || 0,
                            V = w.dummyObj,
                            S = w.animObj,
                            w = w.animType;
                        if (e) r.attr({ opacity: 0 }), r.animateWith(V, S, { opacity: 1 }, a, w, c);
                        else
                            for (r = 0; r < T; r++)
                                if (e = f[r], c = e.graphics, e = e.config, d = e.shapeArgs, e = 2 * z, c = c.element) c.attr({ start: e, end: e }), c = d.start, d = d.end, (void 0).animateWith(V, S, { cx: c - e, cy: d - e }, a, w)
                    },
                    _rotate: function(a) {
                        var e = this.components.dataset[0],
                            c = e.config,
                            e = e.components,
                            d = e.data,
                            n = c.slicedOffset,
                            g = c.slicedOffsetY,
                            f = c.startAngle,
                            T;
                        a = isNaN(a) ? -c._lastAngle : a;
                        T = (a - f) % 360;
                        c.startAngle = h(a, c.startAngle) % 360;
                        T = -(T * z) / 180;
                        e.Pie3DManager && e.Pie3DManager.rotate(T);
                        x(d, function(e) { var c = [],
                                d = e.config;
                            e = e.graphics.element; var c = d.shapeArgs,
                                a = c.start += T,
                                c = c.end += T,
                                r = d.angle = ta((a + c) / 2),
                                a = d.sliced,
                                c = G(r),
                                r = y(r),
                                c = d.slicedTranslation = [L(c * n), L(r * g)];
                            d.transX = c[0];
                            d.transY = c[1];
                            d.slicedX = a ? G(T) * n : 0;
                            d.slicedY = a ? y(T) * g : 0;
                            e && a && e.attr({ transform: "t" + c[0] + "," + c[1] }) });
                        this.placeDataLabels(!0, d)
                    },
                    _plotRollOver: function(a) {
                        var e =
                            this.data("plotItem"),
                            c = e.chart,
                            d = c.config,
                            n = c.components.dataset[0],
                            g = n.components.data[e.index],
                            e = g.graphics.element,
                            g = g.config.hoverEffects;
                        n.config.isRotating || (l.call(e, c, a, "DataPlotRollOver"), g.enabled && e.attr(g));
                        d.isHovered = !0
                    },
                    _plotRollOut: function(a) {
                        var e = this.data("plotItem"),
                            c = e.chart,
                            d = c.config,
                            n = c.components.dataset[0],
                            g = n.components.data[e.index],
                            e = g.config,
                            g = g.graphics.element;
                        n.config.isRotating || (l.call(g, c, a, "DataPlotRollOut"), g.attr({
                            color: e.color.color.split(",")[0],
                            alpha: e._3dAlpha,
                            borderWidth: e.borderWidth,
                            borderColor: e.borderColor
                        }));
                        d.isHovered = !1
                    },
                    _plotDragStart: function(a, e) { var c = this.data("plotItem"),
                            d = e[0],
                            n = e[1],
                            g = c.chart,
                            c = g.components.dataset[0].config;
                        c.isRightClicked = p || 0 === a.button || 1 === a.button ? !1 : !0;
                        c.enableRotation && !c.isRightClicked && (c.isRotating = !1, d = ma.call(a, d, n, c.center, c.chartPosition = N(g.linkedItems.container), c.pieYScale), c.dragStartAngle = d, c._lastAngle = -c.startAngle, c.startingAngleOnDragStart = c.startAngle) },
                    _plotDragEnd: function(a) {
                        var e = this.data("plotItem"),
                            c = e.index,
                            e = e.chart,
                            d = e.config,
                            n = e.components.dataset[0],
                            g = n.config,
                            n = n.components.Pie3DManager,
                            f = g.startAngle;
                        g.isRightClicked || (g.isRotating ? (setTimeout(function() { g.isRotating = !1 }, 0), b.raiseEvent("rotationEnd", { startingAngle: ta(f, !0), changeInAngle: f - g.startingAngleOnDragStart }, e.chartInstance), !d.isHovered && n.colorObjs[c] && n.onPlotHover(c, !1)) : e._plotGraphicClick.call(this, a))
                    },
                    _plotDragMove: function(a, e) {
                        var c = this.data("plotItem"),
                            d = e[1],
                            n = e[2],
                            g = e[3],
                            f = c.chart,
                            c = f.components.dataset[0].config;
                        isNaN(e[0]) || isNaN(d) || !c.enableRotation || c.singletonCase || c.isRightClicked || (d = ma.call(a, n, g, c.center, c.chartPosition, c.pieYScale), c.isRotating || (c.dragStartAngle !== d && (c.isRotating = !0), b.raiseEvent("rotationStart", { startingAngle: ta(c.startAngle, !0) }, f.chartInstance)), n = d - c.dragStartAngle, c.dragStartAngle = d, c.moveDuration = 0, c._lastAngle += 180 * n / z, d = (new Date).getTime(), c._lastTime && !(c._lastTime + c.timerThreshold < d)) || (c._lastTime || f._rotate(), c.timerId = setTimeout(function() {
                            f.disposed && f.disposing ||
                                f._rotate()
                        }, c.timerThreshold), c._lastTime = d)
                    },
                    _stubRadius: function(a, e, c, d, n, g, f) { var T = this.components.dataset[0],
                            w = T.config,
                            b = h(T.config.slicingdistance),
                            T = w.dataLabelOptions || (w.dataLabelOptions = T._parseDataLabelOptions()),
                            S = 0,
                            S = w.pieYScale;
                        c -= w.pieSliceDepth;
                        S = t(a / 2 - e - n, (c / 2 - g) / S) - d;
                        S >= f ? f = S : b || (n = d = E(t(d - (f - S), n), 10));
                        w.slicingDistance = n;
                        w.pieMinRadius = f;
                        T.distance = d; return f },
                    _startingAngle: function(a, e) {
                        var c, d = this.components.dataset[0].config,
                            n = (c = d.startAngle) + (0 > c ? 360 : 0);
                        isNaN(a) || d.singletonCase ||
                            d.isRotating || (a += e ? n : 0, this._rotate(a), n = a);
                        return L(100 * ((n %= 360) + (0 > n ? 360 : 0))) / 100
                    }
                }, sa.pie2d, { plotborderthickness: .1, alphaanimation: 1 });
                C._availableAnimAttrs && C._availableAnimAttrs.cx && (C._availableAnimAttrs.innerR = C._availableAnimAttrs.depth = C._availableAnimAttrs.radiusYFactor = C._availableAnimAttrs.start = C._availableAnimAttrs.end = C._availableAnimAttrs.cx);
                a.prototype = {
                    configure: function(a, e, c, d) {
                        var n = this.linkedItems.chart,
                            g = n.get("components", "paper"),
                            n = n.get("graphics", "datasetGroup");
                        "object" ===
                        typeof a && (a = a.depth, e = a.hasOnePoint, c = a.use3DLighting, d = a.isDoughnut);
                        this.renderer || (this.renderer = g);
                        this.hasOnePoint = e;
                        this.use3DLighting = c;
                        this.isDoughnut = d;
                        this.depth = a;
                        !this.bottomBorderGroup && (this.bottomBorderGroup = g.group("bottom-border", n));
                        this.bottomBorderGroup.attr({ transform: "t0," + a });
                        !this.slicingWallsBackGroup && (this.slicingWallsBackGroup = g.group("slicingWalls-back-Side", n));
                        !this.slicingWallsFrontGroup && (this.slicingWallsFrontGroup = g.group("slicingWalls-front-Side", n));
                        !this.topGroup &&
                            (this.topGroup = g.group("top-Side", n));
                        !this.pointElemStore && (this.pointElemStore = []);
                        !this.slicingWallsArr && (this.slicingWallsArr = []);
                        this.moveCmdArr = ["M"];
                        this.lineCmdArr = ["L"];
                        this.closeCmdArr = ["Z"];
                        this.colorObjs = []
                    },
                    getArcPath: function(a, e, c, d, n, g, f, T, w, b) { return c == n && d == g ? [] : ["A", f, T, 0, b, w, n, g] },
                    _parseSliceColor: function(a, e, c) {
                        var d, n, g, f, T, w, b, S, ca, F, q, u, k, G, y;
                        y = 3;
                        var A = (d = this.use3DLighting) ? xa : Fa,
                            L = c.radiusYFactor,
                            E = c.cx,
                            t = c.cy,
                            h = c.r,
                            l = h * L,
                            v = c.innerR || 0,
                            N = E + h,
                            K = E - h,
                            D = E + v,
                            J = E - v;
                        e = e || 100;
                        c = e / 2;
                        A[a] && A[a][e] ? A = A[a][e] : (A[a] || (A[a] = {}), A[a][e] || (A[a][e] = {}), A = A[a][e], d ? (d = U(a, 80), n = U(a, 75), w = ba(a, 85), b = ba(a, 70), S = ba(a, 40), ca = ba(a, 50), ba(a, 30), F = ba(a, 65), U(a, 85), g = U(a, 69), f = U(a, 75), T = U(a, 95)) : (y = 10, d = U(a, 90), n = U(a, 87), w = ba(a, 93), b = ba(a, 87), S = ba(a, 80), F = ca = ba(a, 85), ba(a, 80), T = U(a, 85), g = U(a, 75), f = U(a, 80)), q = n + P + w + P + b + P + w + P + n, k = e + P + e + P + e + P + e + P + e, u = n + P + a + P + w + P + a + P + n, G = c + P + c + P + c + P + c + P + c, S = n + P + a + P + S + P + a + P + n, g = f + P + w + P + ca + P + w + P + g, f = "FFFFFF" + P + "FFFFFF" + P + "FFFFFF" + P + "FFFFFF" + P + "FFFFFF", y = 0 + P +
                            c / y + P + e / y + P + c / y + P + 0, A.top = qa ? { FCcolor: { gradientUnits: "userSpaceOnUse", radialGradient: !0, color: F + P + T, alpha: e + P + e, ratio: "0,100" } } : { FCcolor: { gradientUnits: "objectBoundingBox", color: b + P + b + P + w + P + n, alpha: e + P + e + P + e + P + e, angle: -72, ratio: "0,8,15,77" } }, A.frontOuter = { FCcolor: { gradientUnits: "userSpaceOnUse", y1: 0, y2: 0, color: g, alpha: k, angle: 0, ratio: "0,20,15,15,50" } }, A.backOuter = { FCcolor: { gradientUnits: "userSpaceOnUse", y1: 0, y2: 0, color: S, alpha: G, angle: 0, ratio: "0,62,8,8,22" } }, A.frontInner = {
                                FCcolor: {
                                    gradientUnits: "userSpaceOnUse",
                                    y1: 0,
                                    y2: 0,
                                    color: u,
                                    alpha: G,
                                    angle: 0,
                                    ratio: "0,25,5,5,65"
                                }
                            }, A.backInner = { FCcolor: { gradientUnits: "userSpaceOnUse", y1: 0, y2: 0, color: q, alpha: k, angle: 0, ratio: "0,62,8,8,22" } }, A.topBorder = { FCcolor: { gradientUnits: "userSpaceOnUse", y1: 0, y2: 0, color: f, alpha: y, angle: 0, ratio: "0,20,15,15,50" } }, A.topInnerBorder = { FCcolor: { gradientUnits: "userSpaceOnUse", y1: 0, y2: 0, color: f, alpha: y, angle: 0, ratio: "0,50,15,15,20" } }, A.bottom = fa(ua(a, c)), A.startSlice = fa(ua(d, e)), A.endSlice = fa(ua(d, e)));
                        if (A.cx !== E || A.cy !== t || A.rx !== h || A.radiusYFactor !==
                            L || A.innerRx !== v) qa && (A.top.FCcolor.cx = E, A.top.FCcolor.cy = t, A.top.FCcolor.r = h, A.top.FCcolor.fx = E - .3 * h, A.top.FCcolor.fy = t + 1.2 * l), A.topBorder.FCcolor.x1 = A.backOuter.FCcolor.x1 = A.frontOuter.FCcolor.x1 = K, A.topBorder.FCcolor.x2 = A.backOuter.FCcolor.x2 = A.frontOuter.FCcolor.x2 = N, A.topInnerBorder.FCcolor.x1 = A.backInner.FCcolor.x1 = A.frontInner.FCcolor.x1 = J, A.topInnerBorder.FCcolor.x2 = A.backInner.FCcolor.x2 = A.frontInner.FCcolor.x2 = D, A.cx = E, A.cy = t, A.rx = h, A.radiusYFactor = L, A.innerRx = v;
                        return A
                    },
                    rotate: function(a) {
                        var e =
                            this.pointElemStore,
                            c = 0,
                            d = e.length,
                            n;
                        if (!this.hasOnePoint) { for (; c < d; c += 1) n = e[c], n = n._confObject, n.start += a, n.end += a, this._setSliceShape(n);
                            this.refreshDrawing() }
                    },
                    removeSlice: function(a) {
                        var e = this.pointElemStore,
                            c = a._confObject.elements,
                            d = this.slicingWallsArr,
                            n;
                        n = e.length;
                        var g;
                        for (--n; 0 <= n; --n) g = e[n], g === a && e.splice(n, 1);
                        n = d.length;
                        for (--n; 0 <= n; --n) e = d[n], e !== c.startSlice && e !== c.frontOuter1 && e !== c.frontOuter && e !== c.backInner && e !== c.endSlice || d.splice(n, 1);
                        a.hide && a.hide();
                        this._slicePool || (this._slicePool = []);
                        this._slicePool.push(a);
                        this.refreshDrawing()
                    },
                    useSliceFromPool: function() { var a = this._slicePool || (this._slicePool = []),
                            e = this.slicingWallsArr,
                            c = !1;
                        a.length && (c = a.shift(), this.pointElemStore.push(c), c.show(), a = c._confObject.elements, e.push(a.startSlice, a.frontOuter1, a.frontOuter), a.backInner && e.push(a.backInner), e.push(a.endSlice)); return c },
                    refreshDrawing: function() {
                        var a = function(e, c) {
                            return e._conf.index - c._conf.index || e._conf.cIndex - c._conf.cIndex || e._conf.isStart - c._conf.isStart || e._conf.si -
                                c._conf.si
                        };
                        return function() { var e = this.slicingWallsArr,
                                c = 0,
                                d, n = e.length,
                                g, f, T, w, b = this.slicingWallsFrontGroup,
                                S = this.slicingWallsBackGroup;
                            e.sort(a);
                            a: { var ca = e[0] && e[0]._conf.index,
                                    F, k;w = ca <= ea;g = 1; for (d = e.length; g < d; g += 1)
                                    if (k = e[g]._conf.index, F = k <= ea, F != w || k < ca) break a;g = 0 }
                            for (; c < n; c += 1, g += 1) g === n && (g = 0), d = e[g], w = d._conf.index, w < va ? b.appendChild(d) : w <= ea ? (f ? d.insertBefore(f) : b.appendChild(d), f = d) : w <= ra ? (T ? d.insertBefore(T) : S.appendChild(d), T = d) : S.appendChild(d) }
                    }(),
                    _setSliceShape: function(a, e) {
                        var c =
                            this.getArcPath,
                            d = a.start,
                            n = a.end,
                            g = ta(d),
                            f = ta(n),
                            T, w, b, S, ca, F, k, u, q, L, E, A, t, h, l, v, N, K = this.isDoughnut,
                            p = a.radiusYFactor,
                            R = a.cx,
                            D = a.cy,
                            J = a.r,
                            M = J * p,
                            z = J + (qa ? -1 : 2),
                            Z = M + (qa ? -1 : 2),
                            W = a.innerR || 0,
                            H = W * p,
                            X = this.depth,
                            O = X + D,
                            m = R + J,
                            x = R - J,
                            C = R + W,
                            Q = R - W,
                            ka = D - M,
                            B = ["M", Q, ka, "L", Q, O + M, "Z"],
                            p = a.elements,
                            P, Y, I, U, fa, ba = "path",
                            na = (g + f) / 2,
                            ja = g > f;
                        w = G(g);
                        b = y(g);
                        S = G(f);
                        ca = y(f);
                        F = R + J * w;
                        k = D + M * b;
                        u = R + z * w;
                        q = D + Z * b;
                        P = k + X;
                        Y = R + J * S;
                        I = D + M * ca;
                        L = R + z * S;
                        E = D + Z * ca;
                        U = I + X;
                        K ? (A = R + W * w, t = D + H * b, v = t + X, h = R + W * S, l = D + H * ca, N = l + X, a.startSlice = ["M", F, k,
                            "L", F, P, A, v, A, t, "Z"
                        ], a.endSlice = ["M", Y, I, "L", Y, U, h, N, h, l, "Z"]) : (a.startSlice = ["M", F, k, "L", F, P, R, O, R, D, "Z"], a.endSlice = ["M", Y, I, "L", Y, U, R, O, R, D, "Z"]);
                        qa ? (T = (g > f ? ia : 0) + f - g, a.clipTopPath = K ? [
                                ["M", F, k, "A", J, M, 0, T > ea ? 1 : 0, 1, Y, I, "L", h, l, "A", W, H, 0, T > ea ? 1 : 0, 0, A, t, "Z"]
                            ] : [
                                ["M", F, k, "A", J, M, 0, T > ea ? 1 : 0, 1, Y, I, "L", R, D, "Z"]
                            ], a.clipOuterFrontPath1 = [B], a.clipTopBorderPath = [
                                ["M", u, q, "A", z, Z, 0, T > ea ? 1 : 0, 1, L, E, "L", Y, I, Y, I + 1, "A", J, M, 0, T > ea ? 1 : 0, 0, F, k + 1, "L", F, k, "Z"]
                            ], d != n ? g > f ? g < ea ? (a.clipOuterFrontPath = [
                                ["M", m, D, "A", J, M, 0,
                                    0, 1, Y, I, "v", X, "A", J, M, 0, 0, 0, m, D + X, "Z"
                                ]
                            ], a.clipOuterFrontPath1 = [
                                ["M", x, D, "A", J, M, 0, 0, 0, F, k, "v", X, "A", J, M, 0, 0, 1, x, D + X, "Z"]
                            ], a.clipOuterBackPath = [
                                ["M", m, D, "A", J, M, 0, 1, 0, x, D, "v", X, "A", J, M, 0, 1, 1, m, D + X, "Z"]
                            ], K && (a.clipInnerBackPath = [
                                ["M", C, D, "A", W, H, 0, 1, 0, Q, D, "v", X, "A", W, H, 0, 1, 1, C, D + X, "Z"]
                            ], a.clipInnerFrontPath = [
                                ["M", C, D, "A", W, H, 0, 0, 1, h, l, "v", X, "A", W, H, 0, 0, 0, C, D + X, "Z", "M", Q, D, "A", W, H, 0, 0, 0, A, t, "v", X, "A", W, H, 0, 0, 1, Q, D + X, "Z"]
                            ])) : f > ea ? (a.clipOuterFrontPath = [
                                ["M", m, D, "A", J, M, 0, 1, 1, x, D, "v", X, "A", J, M, 0, 1, 0, m,
                                    D + X, "Z"
                                ]
                            ], a.clipOuterBackPath = [
                                ["M", x, D, "A", J, M, 0, 0, 1, Y, I, "v", X, "A", J, M, 0, 0, 0, x, D + X, "Z", "M", m, D, "A", J, M, 0, 0, 0, F, k, "v", X, "A", J, M, 0, 0, 1, m, D + X, "Z"]
                            ], K && (a.clipInnerFrontPath = [
                                ["M", C, D, "A", W, H, 0, 1, 1, Q, D, "v", X, "A", W, H, 0, 1, 0, C, D + X, "Z"]
                            ], a.clipInnerBackPath = [
                                ["M", Q, D, "A", W, H, 0, 0, 1, h, l, "v", X, "A", W, H, 0, 0, 0, Q, D + X, "Z", "M", C, D, "A", W, H, 0, 0, 0, A, t, "v", X, "A", W, H, 0, 0, 1, C, D + X, "Z"]
                            ])) : (a.clipOuterFrontPath = [
                                ["M", m, D, "A", J, M, 0, 0, 1, Y, I, "v", X, "A", J, M, 0, 0, 0, m, D + X, "Z"]
                            ], a.clipOuterBackPath = [
                                ["M", F, k, "A", J, M, 0, 0, 1, m, D, "v",
                                    X, "A", J, M, 0, 0, 0, F, P, "Z"
                                ]
                            ], K && (a.clipInnerFrontPath = [
                                ["M", C, D, "A", W, H, 0, 0, 1, h, l, "v", X, "A", W, H, 0, 0, 0, C, D + X, "Z"]
                            ], a.clipInnerBackPath = [
                                ["M", A, t, "A", W, H, 0, 0, 1, C, D, "v", X, "A", W, H, 0, 0, 0, A, v, "Z"]
                            ])) : g < ea ? f > ea ? (a.clipOuterFrontPath = [
                                ["M", F, k, "A", J, M, 0, 0, 1, x, D, "v", X, "A", J, M, 0, 0, 0, F, P, "Z"]
                            ], a.clipOuterBackPath = [
                                ["M", x, D, "A", J, M, 0, 0, 1, Y, I, "v", X, "A", J, M, 0, 0, 0, x, D + X, "Z"]
                            ], K && (a.clipInnerFrontPath = [
                                ["M", A, t, "A", W, H, 0, 0, 1, Q, D, "v", X, "A", W, H, 0, 0, 0, A, v, "Z"]
                            ], a.clipInnerBackPath = [
                                ["M", Q, D, "A", W, H, 0, 0, 1, h, l, "v", X, "A",
                                    W, H, 0, 0, 0, Q, D + X, "Z"
                                ]
                            ])) : (a.clipOuterFrontPath = [
                                ["M", F, k, "A", J, M, 0, 0, 1, Y, I, "v", X, "A", J, M, 0, 0, 0, F, P, "Z"]
                            ], a.clipOuterBackPath = [B], K && (a.clipInnerFrontPath = [
                                ["M", A, t, "A", W, H, 0, 0, 1, h, l, "v", X, "A", W, H, 0, 0, 0, A, v, "Z"]
                            ], a.clipInnerBackPath = [B])) : (a.clipOuterFrontPath = [B], a.clipOuterBackPath = [
                                ["M", F, k, "A", J, M, 0, 0, 1, Y, I, "v", X, "A", J, M, 0, 0, 0, F, P, "Z"]
                            ], K && (a.clipInnerFrontPath = [B], a.clipInnerBackPath = [
                                ["M", A, t, "A", W, H, 0, 0, 1, h, l, "v", X, "A", W, H, 0, 0, 0, A, v, "Z"]
                            ])) : a.clipOuterFrontPath = a.clipOuterBackPath = a.clipInnerBackPath =
                            a.clipInnerFrontPath = [B], ba = "litepath", a.clipBottomBorderPath = a.clipTopPath, a.startSlice = [a.startSlice], a.endSlice = [a.endSlice]) : (z = this.moveCmdArr, Z = this.lineCmdArr, w = this.closeCmdArr, X = [R, D], b = [x, D], ka = [R, ka], S = [m, D], ca = [R, D + M], B = [x, O], fa = [m, O], u = [Q, D], q = [C, D], L = [Q, O], E = [C, O], a.clipOuterFrontPath1 = [], d != n ? (g > f ? g < ea ? (d = c(R, D, F, k, x, D, J, M, 1, 0), n = c(R, D, x, D, m, D, J, M, 1, 0), I = c(R, D, m, D, Y, I, J, M, 1, 0), a.clipOuterBackPath = z.concat(b, n, Z, fa, c(R, O, m, O, x, O, J, M, 0, 0), w), a.clipOuterFrontPath1 = z.concat([F, k], d, Z, B,
                            c(R, O, x, O, F, P, J, M, 0, 0), w), a.clipOuterFrontPath = z.concat(S, I, Z, [Y, U], c(R, O, Y, U, m, O, J, M, 0, 0), w), a.clipTopBorderPath = z.concat([F, k], d, n, I), K ? (J = c(R, D, h, l, C, D, W, H, 0, 0), M = c(R, D, C, D, Q, D, W, H, 0, 0), t = c(R, D, Q, D, A, t, W, H, 0, 0), a.clipInnerBackPath = z.concat(q, M, Z, L, c(R, O, Q, O, C, O, W, H, 1, 0), w), a.clipInnerFrontPath = z.concat(u, t, Z, [A, v], c(R, O, A, v, Q, O, W, H, 1, 0), w, z, [h, l], J, Z, E, c(R, O, C, O, h, N, W, H, 1, 0), w), a.clipTopPath = a.clipTopBorderPath.concat(Z, [h, l], J, M, t, w), a.clipTopBorderPath = a.clipTopBorderPath.concat(z, [h, l], J, M,
                            t)) : a.clipTopPath = a.clipTopBorderPath.concat(Z, X, w)) : f > ea ? (d = c(R, D, F, k, m, D, J, M, 1, 0), n = c(R, D, m, D, x, D, J, M, 1, 0), I = c(R, D, x, D, Y, I, J, M, 1, 0), a.clipOuterFrontPath = z.concat(S, n, Z, B, c(R, O, x, O, m, O, J, M, 0, 0), w), a.clipOuterBackPath = z.concat([F, k], d, Z, fa, c(R, O, m, O, F, P, J, M, 0, 0), w, z, b, I, Z, [Y, U], c(R, O, Y, U, x, O, J, M, 0, 0), w), a.clipTopBorderPath = z.concat([F, k], d, n, I), K ? (J = c(R, D, h, l, Q, D, W, H, 0, 0), M = c(R, D, Q, D, C, D, W, H, 0, 0), t = c(R, D, C, D, A, t, W, H, 0, 0), a.clipInnerFrontPath = z.concat(u, M, Z, E, c(R, O, C, O, Q, O, W, H, 1, 0), w), a.clipInnerBackPath =
                            z.concat(q, t, Z, [A, v], c(R, O, A, v, C, O, W, H, 1, 0), w, z, [h, l], J, Z, L, c(R, O, Q, O, h, N, W, H, 1, 0), w), a.clipTopPath = a.clipTopBorderPath.concat(Z, [h, l], J, M, t, w), a.clipTopBorderPath = a.clipTopBorderPath.concat(z, [h, l], J, M, t)) : a.clipTopPath = a.clipTopBorderPath.concat(Z, X, w)) : (d = c(R, D, F, k, m, D, J, M, 1, 0), n = c(R, D, m, D, Y, I, J, M, 1, 0), a.clipOuterFrontPath = z.concat(S, n, Z, [Y, U], c(R, O, Y, U, m, O, J, M, 0, 0), w), a.clipOuterBackPath = z.concat([F, k], d, Z, fa, c(R, O, m, O, F, P, J, M, 0, 0), w), a.clipTopBorderPath = z.concat([F, k], d, n), K ? (J = c(R, D, h, l, C, D,
                            W, H, 0, 0), M = c(R, D, C, D, A, t, W, H, 0, 0), a.clipInnerFrontPath = z.concat([h, l], J, Z, E, c(R, O, C, O, h, N, W, H, 1, 0), w), a.clipInnerBackPath = z.concat(q, M, Z, [A, v], c(R, O, A, v, C, O, W, H, 1, 0), w), a.clipTopPath = a.clipTopBorderPath.concat(Z, [h, l], J, M, w), a.clipTopBorderPath = a.clipTopBorderPath.concat(z, [h, l], J, M)) : a.clipTopPath = a.clipTopBorderPath.concat(Z, X, w)) : g < ea ? f > ea ? (d = c(R, D, F, k, x, D, J, M, 1, 0), n = c(R, D, x, D, Y, I, J, M, 1, 0), a.clipOuterBackPath = z.concat(b, n, Z, [Y, U], c(R, O, Y, U, x, O, J, M, 0, 0), w), a.clipOuterFrontPath = z.concat([F, k], d,
                            Z, B, c(R, O, x, O, F, P, J, M, 0, 0), w), a.clipTopBorderPath = z.concat([F, k], d, n), K ? (J = c(R, D, h, l, Q, D, W, H, 0, 0), M = c(R, D, Q, D, A, t, W, H, 0, 0), a.clipInnerBackPath = z.concat([h, l], J, Z, L, c(R, O, Q, O, h, N, W, H, 1, 0), w), a.clipInnerFrontPath = z.concat(u, M, Z, [A, v], c(R, O, A, v, Q, O, W, H, 1, 0), w), a.clipTopPath = a.clipTopBorderPath.concat(Z, [h, l], J, M, w), a.clipTopBorderPath = a.clipTopBorderPath.concat(z, [h, l], J, M)) : a.clipTopPath = a.clipTopBorderPath.concat(Z, X, w)) : (d = c(R, D, F, k, Y, I, J, M, 1, 0), a.clipOuterBackPath = z.concat([F, k]), a.clipTopBorderPath =
                            a.clipOuterBackPath.concat(d), a.clipOuterFrontPath = a.clipTopBorderPath.concat(Z, [Y, U], c(R, O, Y, U, F, P, J, M, 0, 0), w), K ? (J = c(R, D, h, l, A, t, W, H, 0, 0), a.clipInnerBackPath = z.concat([h, l]), a.clipTopPath = a.clipTopBorderPath.concat(Z, [h, l], J, w), a.clipTopBorderPath = a.clipTopBorderPath.concat(z, [h, l], J), a.clipInnerFrontPath = a.clipInnerBackPath.concat(J, Z, [A, v], c(R, O, A, v, h, N, W, H, 1, 0), w)) : a.clipTopPath = a.clipTopBorderPath.concat(Z, X, w)) : (d = c(R, D, F, k, Y, I, J, M, 1, 0), a.clipOuterFrontPath = z.concat([F, k]), a.clipTopBorderPath =
                            a.clipOuterFrontPath.concat(d), a.clipOuterBackPath = a.clipTopBorderPath.concat(Z, [Y, U], c(R, O, Y, U, F, P, J, M, 0, 0), w), K ? (J = c(R, D, h, l, A, t, W, H, 0, 0), a.clipInnerFrontPath = z.concat([h, l]), a.clipTopPath = a.clipTopBorderPath.concat(Z, [h, l], J, w), a.clipTopBorderPath = a.clipTopBorderPath.concat(a.clipInnerFrontPath, J), a.clipInnerBackPath = a.clipInnerFrontPath.concat(J, Z, [A, v], c(R, O, A, v, h, N, W, H, 1, 0), w)) : a.clipTopPath = a.clipTopBorderPath.concat(Z, X, w)), d = z.concat(b, Z, S), J = z.concat(ka, Z, ca), a.clipTopPath = a.clipTopPath.concat(d,
                            J), a.clipOuterFrontPath = a.clipOuterFrontPath.concat(d), a.clipOuterFrontPath1 = a.clipOuterFrontPath1.concat(d), a.clipOuterBackPath = a.clipOuterBackPath.concat(d), K && (J = z.concat(u, Z, q), a.clipInnerFrontPath = a.clipInnerFrontPath.concat(J), a.clipInnerBackPath = a.clipInnerBackPath.concat(J))) : (a.clipTopPath = a.clipOuterFrontPath = a.clipOuterBackPath = [], K && (a.clipInnerFrontPath = a.clipInnerBackPath = [])), a.clipBottomBorderPath = a.clipTopBorderPath);
                        e || (p.startSlice._conf.index = g, p.endSlice._conf.index = f, p.backOuter._conf.index =
                            A = ja && (g <= ra || f > ra) || g <= ra && f > ra ? ra : g > ea ? g : f, p.frontOuter._conf.index = c = f <= va ? f : g > f || g <= va ? va : g, p.frontOuter1._conf.index = g, p.frontOuter1._conf.cIndex = ea, g > f ? (p.backOuter._conf.cIndex = g < ra ? ra : ia, p.startSlice._conf.cIndex = g < ea ? (g + ea) / 2 : (g + ia) / 2, p.endSlice._conf.cIndex = p.frontOuter._conf.cIndex = 0) : p.backOuter._conf.cIndex = p.startSlice._conf.cIndex = p.endSlice._conf.cIndex = p.frontOuter._conf.cIndex = na, T > ea ? p.frontOuter1.show().attr(ba, a.clipOuterFrontPath1) : p.frontOuter1.hide(), a.thisElement._attr(ba,
                                a.clipTopPath), p.bottom.attr(ba, a.clipTopPath), p.bottomBorder.attr(ba, a.clipBottomBorderPath), p.topBorder && p.topBorder.attr(ba, a.clipTopBorderPath), p.frontOuter.attr(ba, a.clipOuterFrontPath), p.backOuter.attr(ba, a.clipOuterBackPath), K && (p.backInner.attr(ba, a.clipInnerBackPath), p.frontInner.attr(ba, a.clipInnerFrontPath), p.backInner._conf.index = A, p.frontInner._conf.index = c, g > f ? (p.backInner._conf.cIndex = ia, p.frontInner._conf.cIndex = 0) : p.backInner._conf.cIndex = p.frontInner._conf.cIndex = na), this.hasOnePoint ?
                            (p.startSlice.hide(), p.endSlice.hide()) : (p.startSlice.attr(ba, a.startSlice).show(), p.endSlice.attr(ba, a.endSlice).show()))
                    },
                    _setSliceCosmetics: function(a) {
                        var e = a.thisElement,
                            c = a.showBorderEffect,
                            d = a.elements,
                            n = ua(a.borderColor, h(a.borderAlpha, a.alpha)),
                            g = a.borderWidth,
                            f;
                        a.color && (a = this._parseSliceColor(a.color, a.alpha, a), qa ? (f = { fill: fa(a.top), "stroke-width": 0 }, c ? d.topBorder.show().attr({ fill: fa(a.topBorder), "stroke-width": 0 }) : (d.topBorder.hide(), f.stroke = n, f["stroke-width"] = g), e._attr(f)) : (e._attr({
                            fill: fa(a.top),
                            "stroke-width": 0
                        }), d.topBorder.attr({ stroke: n, "stroke-width": g })), d.bottom.attr({ fill: fa(a.bottom) }), d.bottomBorder.attr({ stroke: n, "stroke-width": g }), d.frontOuter.attr({ fill: fa(a.frontOuter) }), d.frontOuter1.attr({ fill: fa(a.frontOuter) }), d.backOuter.attr({ fill: fa(a.backOuter) }), d.startSlice.attr({ fill: fa(a.startSlice), stroke: n, "stroke-width": g }), d.endSlice.attr({ fill: fa(a.endSlice), stroke: n, "stroke-width": g }), this.isDoughnut && (d.frontInner.attr({ fill: fa(a.frontInner) }), d.backInner.attr({ fill: fa(a.backInner) })))
                    },
                    createSlice: function() {
                        var a = { stroke: !0, strokeWidth: !0, "stroke-width": !0, dashstyle: !0, "stroke-dasharray": !0, translateX: !0, translateY: !0, "stroke-opacity": !0, fill: !0, opacity: !0, transform: !0, ishot: !0, cursor: !0, start: !0, end: !0, color: !0, alpha: !0, borderColor: !0, borderAlpha: !0, borderWidth: !0, rolloverProps: !0, showBorderEffect: !0, positionIndex: !0, cx: !0, cy: !0, radiusYFactor: !0, r: !0, innerR: !0 },
                            e = function(e, c) {
                                var d, n, g = this,
                                    f = g._confObject,
                                    w = {},
                                    k = f.elements,
                                    b, T, q, ga = f.Pie3DManager,
                                    G;
                                "string" === typeof e && void 0 !==
                                    c && null !== c && (d = e, e = {}, e[d] = c);
                                if (e && "string" !== typeof e) { for (d in e)
                                        if (n = e[d], a[d])
                                            if (f[d] = n, "ishot" === d || "cursor" === d || "transform" === d) w[d] = n, G = !0;
                                            else if ("start" === d || "end" === d || "cx" === d || "cy" === d || "radiusYFactor" === d || "r" === d || "innerR" === d) T = !0;
                                    else { if ("color" === d || "alpha" === d || "borderColor" === d || "borderAlpha" === d || "borderWidth" === d) q = !0 } else g._attr(d, n);
                                    T && (ga._setSliceShape(f), ga.refreshDrawing());
                                    (q || T) && ga._setSliceCosmetics(f); if (G) { for (b in k) k[b].attr(w);
                                        g._attr(w) } } else g = a[e] ? f[e] : g._attr(e);
                                return g
                            },
                            c = function(a, e) { var c = this._confObject.elements,
                                    d; for (d in c) c[d].on(a, e); return this._on(a, e) },
                            d = function(a, e, c) { var d, n = this._confObject.elements,
                                    g = -1 < K.navigator.userAgent.toLowerCase().indexOf("android"); for (d in n) g ? "topBorder" !== d && "frontOuter" !== d && "startSlice" !== d && "endSlice" !== d || n[d].drag(a, e, c) : n[d].drag(a, e, c); return this._drag(a, e, c) },
                            n = function() { var a = this._confObject.elements,
                                    e; for (e in a) a[e].hide(); return this._hide() },
                            g = function() {
                                var a = this._confObject.elements,
                                    e;
                                for (e in a) a[e].show();
                                return this._show()
                            },
                            f = function() { var a = this._confObject,
                                    e = a.elements,
                                    c; for (c in e) e[c].destroy();
                                qa && (a.clipTop.destroy(), a.clipOuterFront.destroy(), a.clipOuterBack.destroy(), a.clipOuterFront1 && a.clipOuterFront1.destroy(), a.clipInnerFront && a.clipInnerFront.destroy(), a.clipInnerBack && a.clipInnerBack.destroy()); return this._destroy() },
                            b = function(a) { var e = this._confObject.elements,
                                    c; for (c in e) e[c].tooltip(a); return this._tooltip(a) },
                            w = function(a, e) {
                                var c = this._confObject.elements,
                                    d;
                                if (void 0 === e) return this._data(a);
                                for (d in c) c[d].data(a, e);
                                return this._data(a, e)
                            },
                            k = 0;
                        return function() {
                            var a = this.renderer,
                                q, F = { elements: {}, Pie3DManager: this },
                                G = this.slicingWallsArr,
                                u = F.elements,
                                h = qa ? "litepath" : "path";
                            q = a[h](this.topGroup);
                            q._confObject = F;
                            F.thisElement = q;
                            q._destroy = q.destroy;
                            q.destroy = f;
                            q._show = q.show;
                            q.show = g;
                            q._hide = q.hide;
                            q.hide = n;
                            q._on = q.on;
                            q.on = c;
                            q._drag = q.drag;
                            q.drag = d;
                            q._attr = q.attr;
                            q.attr = e;
                            q._tooltip = q.tooltip;
                            q.tooltip = b;
                            q._data = q.data;
                            q.data = w;
                            this.pointElemStore.push(q);
                            u.topBorder = a[h](this.topGroup);
                            u.bottom = a[h](this.bottomBorderGroup).attr({ "stroke-width": 0 });
                            u.bottomBorder = a[h](this.bottomBorderGroup);
                            u.frontOuter = a[h](this.slicingWallsFrontGroup).attr({ "stroke-width": 0 });
                            u.backOuter = a[h](this.slicingWallsFrontGroup).attr({ "stroke-width": 0 });
                            u.startSlice = a[h](this.slicingWallsFrontGroup);
                            u.endSlice = a[h](this.slicingWallsFrontGroup);
                            u.frontOuter1 = a[h](this.slicingWallsFrontGroup).attr({ "stroke-width": 0 });
                            u.frontOuter._conf = { si: k, isStart: .5 };
                            u.frontOuter1._conf = { si: k, isStart: .5 };
                            u.startSlice._conf = { si: k, isStart: 0 };
                            u.endSlice._conf = { si: k, isStart: 1 };
                            u.backOuter._conf = { si: k, isStart: .4 };
                            G.push(u.startSlice, u.frontOuter1, u.frontOuter, u.backOuter, u.endSlice);
                            this.isDoughnut && (u.frontInner = a[h](this.slicingWallsFrontGroup).attr({ "stroke-width": 0 }), u.backInner = a[h](this.slicingWallsFrontGroup).attr({ "stroke-width": 0 }), u.backInner._conf = { si: k, isStart: .5 }, u.frontInner._conf = { si: k, isStart: .4 }, G.push(u.frontInner, u.backInner));
                            k += 1;
                            return q
                        }
                    }()
                };
                a.prototype.constructor = a
            }]);
            B.register("module", ["private",
                "modules.renderer.js-doughnut2d",
                function() {
                    var a = this,
                        b = a.hcLib,
                        m = a.window,
                        C = !b.CREDIT_REGEX.test(m.location.hostname),
                        p = b.chartAPI,
                        K = b.getFirstColor,
                        N = b.getFirstAlpha,
                        Q = b.hasSVG,
                        h = b.toRaphaelColor,
                        x = b.hashify,
                        l = 8 === m.document.documentMode ? "visible" : "",
                        f = b.graphics.getLightColor,
                        q = Math.floor,
                        y = b.graphics.getDarkColor;
                    p("doughnut2d", {
                        friendlyName: "Doughnut Chart",
                        defaultDatasetType: "Doughnut2D",
                        creditLabel: C,
                        applicableDSList: { Doughnut2D: !0 },
                        getPointColor: function(a, b, k) {
                            var h;
                            a = K(a);
                            b = N(b);
                            100 > k &&
                                Q ? (h = y(a, q(100 * (85 - .2 * (100 - k))) / 100), a = f(a, q(100 * (100 - .5 * k)) / 100), b = { FCcolor: { color: h + "," + a + "," + a + "," + h, alpha: b + "," + b + "," + b + "," + b, radialGradient: !0, gradientUnits: "userSpaceOnUse", r: k } }) : b = { FCcolor: { color: a + "," + a, alpha: b + "," + b, ratio: "0,100" } };
                            return b
                        },
                        drawDoughnutCenterLabel: function(a, f, b, q, y, v, z) {
                            var p = this.components,
                                K = p.dataset[0].config;
                            v = v || K.lastCenterLabelConfig;
                            var p = p.paper,
                                N = this.linkedItems.smartLabel,
                                m = this.graphics,
                                C = m.datasetGroup,
                                Q = v.padding,
                                B = 2 * v.textPadding,
                                na = {
                                    fontFamily: v.font,
                                    fontSize: v.fontSize + "px",
                                    lineHeight: 1.2 * v.fontSize + "px",
                                    fontWeight: v.bold ? "bold" : "",
                                    fontStyle: v.italic ? "italic" : ""
                                },
                                ma = 1.414 * (.5 * q - Q) - B;
                            y = 1.414 * (.5 * y - Q) - B;
                            var U;
                            N.setStyle(na);
                            N.useEllipsesOnOverflow(this.config.useEllipsesWhenOverflow);
                            N = N.getSmartText(a, ma, y);
                            (y = m.doughnutCenterLabel) ? (y.attr("text") !== a && this.centerLabelChange(a), U = m.centerLabelOvalBg) : (v.bgOval && (m.centerLabelOvalBg = U = p.circle(f, b, .5 * q - Q, C)), y = m.doughnutCenterLabel = p.text(C).hover(this.centerLabelRollover, this.centerLabelRollout).click(this.centerLabelClick),
                                y.chart = this);
                            a ? (y.css(na).attr({ x: f, y: b, text: N.text, visibility: l, direction: K.textDirection, fill: h({ FCcolor: { color: v.color, alpha: v.alpha } }), "text-bound": v.bgOval ? "none" : [h({ FCcolor: { color: v.bgColor, alpha: v.bgAlpha } }), h({ FCcolor: { color: v.borderColor, alpha: v.borderAlpha } }), v.borderThickness, v.textPadding, v.borderRadius] }).tooltip(v.toolText || N.tooltext), v.bgOval && U && U.attr({
                                visibility: l,
                                fill: x(v.bgColor),
                                "fill-opacity": v.bgAlpha / 100,
                                stroke: x(v.borderColor),
                                "stroke-width": v.borderThickness,
                                "stroke-opacity": v.borderAlpha /
                                    100
                            })) : (y.attr("visibility", "hidden"), U && U.attr("visibility", "hidden"));
                            z && (K.lastCenterLabelConfig = v, K.centerLabelConfig = v)
                        },
                        centerLabelRollover: function() {
                            var f = this.chart,
                                b = f.config,
                                k = f.chartInstance,
                                q = k.ref,
                                h = f.components.dataset[0].config.lastCenterLabelConfig,
                                b = { height: b.height, width: b.width, pixelHeight: q.offsetHeight, pixelWidth: q.offsetWidth, id: k.id, renderer: k.args.renderer, container: f.linkedItems.container, centerLabelText: h && h.label };
                            this.attr("text") && a.raiseEvent("centerLabelRollover", b,
                                k, this, f.hoverOnCenterLabel)
                        },
                        centerLabelRollout: function() { var f = this.chart,
                                b = f.config,
                                q = f.chartInstance,
                                h = q.ref,
                                y = f.components.dataset[0].config.lastCenterLabelConfig,
                                b = { height: b.height, width: b.width, pixelHeight: h.offsetHeight, pixelWidth: h.offsetWidth, id: q.id, renderer: q.args.renderer, container: f.linkedItems.container, centerLabelText: y && y.label };
                            this.attr("text") && a.raiseEvent("centerLabelRollout", b, q, this, f.hoverOffCenterLabel) },
                        centerLabelClick: function() {
                            var f = this.chart,
                                b = f.config,
                                q = f.chartInstance,
                                h = q.ref,
                                y = f.components.dataset[0].config.lastCenterLabelConfig,
                                f = { height: b.height, width: b.width, pixelHeight: h.offsetHeight, pixelWidth: h.offsetWidth, id: q.id, renderer: q.args.renderer, container: f.linkedItems.container, centerLabelText: y && y.label };
                            this.attr("text") && a.raiseEvent("centerLabelClick", f, q)
                        },
                        centerLabelChange: function(f) {
                            var b = this.config,
                                q = this.chartInstance,
                                h = q.ref;
                            a.raiseEvent("centerLabelChanged", {
                                height: b.height,
                                width: b.width,
                                pixelHeight: h.offsetHeight,
                                pixelWidth: h.offsetWidth,
                                id: q.id,
                                renderer: q.args.renderer,
                                container: this.linkedItems.container,
                                centerLabelText: f
                            }, q)
                        },
                        hoverOnCenterLabel: function() { var a = this.chart.components.dataset[0].config.lastCenterLabelConfig;
                            (a.hoverColor || a.hoverAlpha) && this.attr({ fill: h({ FCcolor: { color: a.hoverColor || a.color, alpha: a.hoverAlpha || a.alpha } }) }) },
                        hoverOffCenterLabel: function() { var a = this.chart.components.dataset[0].config.lastCenterLabelConfig;
                            (a.hoverColor || a.hoverAlpha) && this.attr({ fill: h({ FCcolor: { color: a.color, alpha: a.alpha } }) }) }
                    }, p.pie2d, { singletonPlaceValue: !1 })
                }
            ]);
            B.register("module", ["private", "modules.renderer.js-doughnut3d", function() { var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("doughnut3d", { friendlyName: "3D Doughnut Chart", defaultDatasetType: "Doughnut3D", creditLabel: b, applicableDSList: { Doughnut3D: !0 }, _configureManager: function() { var a = this.components.dataset[0],
                            b = a.config,
                            p = a.components,
                            a = p.Pie3DManager,
                            p = p.data;
                        a && a.configure(b.pieSliceDepth, 1 === p.length, b.use3DLighting, !0) } }, a.pie3d) }]);
            B.register("module", ["private", "modules.renderer.js-mscolumn2d", function() { var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("mscolumn2d", { standaloneInit: !0, friendlyName: "Multi-series Column Chart", creditLabel: b, defaultDatasetType: "column", applicableDSList: { column: !0 }, eiMethods: {} }, a.mscartesian, { enablemousetracking: !0 }) }]);
            B.register("module", ["private", "modules.renderer.js-mscolumn3d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("mscolumn3d", { standaloneInit: !0, defaultDatasetType: "column3d", friendlyName: "Multi-series 3D Column Chart", applicableDSList: { column3d: !0 }, defaultPlotShadow: 1, fireGroupEvent: !0, is3D: !0, creditLabel: b, defaultZeroPlaneHighlighted: !1 }, a.mscartesian3d, { showplotborder: 0, enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-msbar2d", function() {
                var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("msbar2d", {
                    standaloneInit: !0,
                    friendlyName: "Multi-series Bar Chart",
                    isBar: !0,
                    hasLegend: !0,
                    creditLabel: a,
                    defaultDatasetType: "bar2d",
                    applicableDSList: { bar2d: !0 }
                }, b.msbarcartesian, { enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-msbar3d", function() {
                var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("msbar3d", {
                    standaloneInit: !0,
                    defaultSeriesType: "bar3d",
                    friendlyName: "Multi-series 3D Bar Chart",
                    fireGroupEvent: !0,
                    defaultPlotShadow: 1,
                    is3D: !0,
                    isBar: !0,
                    hasLegend: !0,
                    creditLabel: a,
                    defaultZeroPlaneHighlighted: !1,
                    defaultDatasetType: "bar3d",
                    applicableDSList: { bar3d: !0 }
                }, b.msbarcartesian3d, { showplotborder: 0, enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-msarea", function() { var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("msarea", { standaloneInit: !0, friendlyName: "Multi-series Area Chart", creditLabel: b, defaultDatasetType: "area", defaultPlotShadow: 0, applicableDSList: { area: !0 } }, a.areabase, { enablemousetracking: !0 }) }]);
            B.register("module", ["private",
                "modules.renderer.js-msline",
                function() { var a = this.hcLib,
                        b = a.chartAPI,
                        a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                    b("msline", { standaloneInit: !0, friendlyName: "Multi-series Line Chart", creditLabel: a, defaultDatasetType: "line", defaultPlotShadow: 1, axisPaddingLeft: 0, axisPaddingRight: 0, applicableDSList: { line: !0 } }, b.areabase, { zeroplanethickness: 1, zeroplanealpha: 40, showzeroplaneontop: 0, enablemousetracking: !0 }) }
            ]);
            B.register("module", ["private", "modules.renderer.js-stackedarea2d", function() {
                var a =
                    this.hcLib,
                    b = a.chartAPI,
                    m = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("stackedarea2d", { friendlyName: "Stacked Area Chart", showsum: 0, creditLabel: m }, b.msarea, { plotfillalpha: a.preDefStr.HUNDREDSTRING, isstacked: 1 })
            }]);
            B.register("module", ["private", "modules.renderer.js-stackedcolumn2d", function() { var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("stackedcolumn2d", { friendlyName: "Stacked Column Chart", creditLabel: a }, b.mscolumn2d, { isstacked: !0 }) }]);
            B.register("module", ["private", "modules.renderer.js-stackedcolumn3d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    m = a.chartAPI;
                m("stackedcolumn3d", {
                    friendlyName: "3D Stacked Column Chart",
                    creditLabel: b,
                    _mouseEvtHandler: function(b) {
                        var p = b.data.mouseTracker,
                            K = this.config,
                            N = K.canvasLeft,
                            m = K.canvasRight,
                            h = K.canvasBottom,
                            x = K.canvasTop,
                            l = K.datasetOrder || this.components.dataset,
                            f = a.getMouseCoordinate(this.linkedItems.container, b.originalEvent, this),
                            q = f.chartX,
                            f = f.chartY,
                            y, G = this.components,
                            L = "datasetGroup_" + l[0].type,
                            k, t = !1,
                            E = l.length,
                            v, z = p._lastDatasetIndex,
                            B = p._lastPointIndex;
                        if (q > N && q < m && f > x && f < h || this.config.plotOverFlow) {
                            for (; E-- && !t;) y = l[E], y.valueLook = !0, y && y.visible && (k = y._getHoveredPlot && y._getHoveredPlot(q, f)) && k.hovered && (t = !0, k.datasetIndex = E, v = p._getMouseEvents(b, k.datasetIndex, k.pointIndex));
                            for (E = 0; E < l.length && !t;) y = l[E], y.valueLook = !1, y && y.visible && (k = y._getHoveredPlot && y._getHoveredPlot(q, f)) && k.hovered && (t = !0, k.datasetIndex = E, v = p._getMouseEvents(b, k.datasetIndex, k.pointIndex)),
                                E++
                        }(!t || v && v.fireOut) && void 0 !== z && (delete p._lastDatasetIndex, delete p._lastPointIndex, l[z] && l[z]._firePlotEvent && l[z]._firePlotEvent("mouseout", B, b));
                        if (t)
                            for (N = v.events && v.events.length, p._lastDatasetIndex = k.datasetIndex, B = p._lastPointIndex = k.pointIndex, K.drawTrendRegion && G[L]._notifyGroup(!0, b), p = 0; p < N; p += 1) y && y._firePlotEvent && y._firePlotEvent(v.events[p], B, b, k.datasetIndex);
                        else K.drawTrendRegion && G[L]._notifyGroup(!1, b);
                        K.drawTrendRegion && G[L]._getHoveredRegion(q, f, b)
                    }
                }, m.mscolumn3d, {
                    showplotborder: 0,
                    enablemousetracking: !0
                }, m.stackedcolumn2d)
            }]);
            B.register("module", ["private", "modules.renderer.js-stackedbar2d", function() { var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("stackedbar2d", { friendlyName: "Stacked Bar Chart", creditLabel: b }, a.msbar2d, { maxbarheight: 50, enablemousetracking: !0 }, a.stackedcolumn2d) }]);
            B.register("module", ["private", "modules.renderer.js-stackedbar3d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    m = a.chartAPI;
                m("stackedbar3d", {
                    friendlyName: "3D Stacked Bar Chart",
                    creditLabel: b,
                    _mouseEvtHandler: function(b) {
                        var p = b.data.mouseTracker,
                            K = this.config,
                            N = K.canvasLeft,
                            m = K.canvasRight,
                            h = K.canvasBottom,
                            x = K.canvasTop,
                            l = K.datasetOrder || this.components.dataset,
                            f = a.getMouseCoordinate(this.linkedItems.container, b.originalEvent, this),
                            q = f.chartX,
                            f = f.chartY,
                            y, G = this.components,
                            L = "datasetGroup_" + l[0].type,
                            k, t = !1,
                            E = l.length,
                            v, z = p._lastDatasetIndex,
                            B = p._lastPointIndex;
                        if (q > N && q < m && f > x && f < h || this.config.plotOverFlow) {
                            for (E = l.length; E-- &&
                                !t;)
                                if (y = l[E], y.valueLook = !0, y && y.visible) { if ((k = y._getHoveredPlot && y._getHoveredPlot(q, f)) && k.hovered)
                                        for (N = 0; N <= E; ++N)
                                            if (E !== N && k && (m = l[N], (h = m._getHoveredPlot && m._getHoveredPlot(q, f)) && h.pointIndex === k.pointIndex - 1)) { k = h;
                                                E = N;
                                                y = m;
                                                y.valueLook = !0; break }
                                    k && k.hovered && (t = !0, k.datasetIndex = E, v = p._getMouseEvents(b, k.datasetIndex, k.pointIndex)) }
                            for (E = 0; E < l.length && !t;) {
                                y = l[E];
                                y.valueLook = !1;
                                if (y && y.visible) {
                                    if ((k = y._getHoveredPlot && y._getHoveredPlot(q, f)) && k.hovered)
                                        for (N = 0; N <= E; ++N)
                                            if (E !== N && k && (m = l[N],
                                                    (h = m._getHoveredPlot && m._getHoveredPlot(q, f)) && h.pointIndex === k.pointIndex - 1)) { k = h;
                                                E = N;
                                                y = m;
                                                y.valueLook = !1; break }
                                    k && k.hovered && (t = !0, k.datasetIndex = E, v = p._getMouseEvents(b, k.datasetIndex, k.pointIndex))
                                }
                                E++
                            }
                        }(!t || v && v.fireOut) && void 0 !== z && (delete p._lastDatasetIndex, delete p._lastPointIndex, l[z] && l[z]._firePlotEvent && l[z]._firePlotEvent("mouseout", B, b));
                        if (t)
                            for (l = v.events && v.events.length, p._lastDatasetIndex = k.datasetIndex, B = p._lastPointIndex = k.pointIndex, K.drawTrendRegion && G[L]._notifyGroup(!0, b),
                                p = 0; p < l; p += 1) y && y._firePlotEvent && y._firePlotEvent(v.events[p], B, b, k.datasetIndex);
                        else K.drawTrendRegion && G[L]._notifyGroup(!1, b);
                        K.drawTrendRegion && G[L]._getHoveredRegion(q, f, b)
                    }
                }, m.msbar3d, { showplotborder: 0, enablemousetracking: !0 }, m.stackedcolumn2d)
            }]);
            B.register("module", ["private", "modules.renderer.js-marimekko", function() {
                var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    m = Math,
                    B = m.min,
                    p = m.max;
                b("marimekko", {
                    standaloneInit: !0,
                    friendlyName: "Marimekko Chart",
                    isValueAbs: !0,
                    usesXYinCategory: !0,
                    distributedColumns: !0,
                    stack100percent: !0,
                    defaultDatasetType: "marimekko",
                    applicableDSList: { marimekko: !0 },
                    isStacked: !0,
                    showsum: 1,
                    creditLabel: a,
                    _setAxisLimits: function() {
                        var a = this.components,
                            b = a.dataset,
                            m = a.yAxis,
                            a = a.xAxis,
                            h, x = b.length,
                            l, f = -Infinity,
                            q = Infinity,
                            y = Infinity,
                            G = -Infinity,
                            L, k, t = {};
                        L = this.config.categories;
                        var E = [],
                            v = function(a) { f = p(f, a.max);
                                q = B(q, a.min);
                                G = p(G, a.xMax || -Infinity);
                                y = B(y, a.xMin || Infinity) };
                        for (l = 0; l < x; l++) h = b[l], (k = h.groupManager) ? t[h.type] =
                            k : E.push(h);
                        for (k in t) b = t[k].getDataLimits(), v(b);
                        x = E.length;
                        for (l = 0; l < x; l++) b = E[l].getDataLimits(), v(b); - Infinity === f && (f = 0);
                        Infinity === q && (q = 0);
                        m[0].setAxisConfig({ isPercent: this.config.isstacked ? this.config.stack100percent : 0 });
                        m[0].setDataLimit(f, q);
                        if (-Infinity !== G || Infinity !== y) a[0].config.xaxisrange = { max: G, min: y }, a[0].setDataLimit(G, y);
                        m = t[k].getStackSumPercent();
                        l = m.length;
                        k = a[0].getCategoryLen();
                        k > l && L.splice(l, k - l);
                        this._setCategories();
                        l = a[0].getLimit();
                        y = l.min;
                        G = l.max;
                        L = y;
                        k = G - y;
                        for (l =
                            0; l < m.length; l++) b = m[l], x = k * b / 100, b = L + x / 2, a[0].updateCategory(l, { x: b }), L += x
                    }
                }, b.mscartesian, { isstacked: !0, showpercentvalues: 0, usepercentdistribution: 1, showsum: 1, enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-msstackedcolumn2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    m = a.chartAPI,
                    C = a.pluck,
                    p = a.componentDispose;
                m("msstackedcolumn2d", {
                    standaloneInit: !0,
                    defaultDatasetType: "column",
                    applicableDSList: { column: !0 },
                    friendlyName: "Multi-series Stacked Column Chart",
                    _createDatasets: function() {
                        var a = this.components,
                            b = this.jsonData,
                            m = b.dataset,
                            h = m && m.length || 0,
                            x, l, f, q = this.defaultDatasetType,
                            y = this.applicableDSList,
                            G, L, k, t, E, v, z = b.lineset || [],
                            Y = this.config,
                            ka = Y.dataSetMap,
                            ea = Y.lineSetMap,
                            va = ka && ka.length,
                            ia = a.legend,
                            ra = [],
                            sa = [],
                            na = 0;
                        k = 0;
                        var ma, U = -1,
                            ba, Aa = this.config.catLen,
                            ua = a.xAxis[0],
                            P, fa, qa = a.dataset;
                        if (m || 0 !== z.length) {
                            this.config.categories = b.categories && b.categories[0].category;
                            l = a.dataset = [];
                            for (b = 0; b < h; b++) {
                                E = m[b];
                                U++;
                                if (E.dataset)
                                    for (fa = !0, v = E.dataset &&
                                        E.dataset.length || 0, ra[b] = [], x = 0; x < v; x++) {
                                        if (k = E.dataset[x], G = (G = C(k.renderas, q)) && G.toLowerCase(), y[G] || (G = q), f = B.get("component", ["dataset", G])) t = "datasetGroup_" + G, L = B.register("component", ["datasetGroup", G]), G = a[t], L && !G ? (G = a[t] = new L, G.chart = this, G.init()) : G && ka && 0 !== ka.length && !ma && (G.init(), ma = !0), ka && ka[b] && ka[b][x] ? (f = ka[b][x], f.index = na, t = f.JSONData, L = t.data && t.data.length || 0, t = k.data && k.data.length || 0, ba = ua.getCategoryLen(), P = Aa - ba, L -= t, L = this._getDiff(L, t, P, ba), t = L.diff, L = L.startIndex,
                                            0 < t && f.removeData(L, t, !1), f.JSONData = k, f.configure()) : (f = new f, f.chart = this, f.index = na, f.init(k)), na++, ra[b].push(f), l.push(f), G && G.addDataSet(f, U, x)
                                    } else v = x = 0, U--;
                                E = ka && ka[b] && ka[b].length;
                                if (E > v)
                                    for (k = x, E = E - v + x; k < E; k++) G = ka[b][k], ia.removeItem(G.legendItemId), p.call(G)
                            }
                            if (va > h)
                                for (k = b, E = va - h + b; k < E; k++)
                                    for (v = ka[k].length, x = 0; x < v; x++) G = ka[k][x], ia.removeItem(G.legendItemId), p.call(G);
                            Y.dataSetMap = ra;
                            if (this.lineset) {
                                b = 0;
                                for (h = z.length; b < h; b++) m = z[b], f = B.get("component", ["dataset", "line"]), f = new f,
                                    ea && ea[b] ? (f = ea[b], f.index = na, t = f.JSONData, L = t.data.length, t = m.data && m.data.length || 0, L > t && f.removeData(t, L - t, !1), f.JSONData = m, f.configure()) : (f.chart = this, f.index = na, f.init(m)), sa.push(f), l.push(f), na++;
                                z = ea && ea.length;
                                if (z > h)
                                    for (k = b, E = z - h + b; k < E; k++) G = ea[k], ia.removeItem(G.legendItemId), p.call(G);
                                Y.lineSetMap = sa
                            }
                            fa ? this.config.catLen = ua.getCategoryLen() : (a.dataset = qa, this.setChartMessage())
                        } else this.setChartMessage()
                    },
                    creditLabel: b
                }, m.mscartesian, { isstacked: !0, enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-mscombi2d", function() {
                var a = this.hcLib,
                    b = a.chartAPI,
                    m = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    C = a.pluck,
                    p = a.componentDispose;
                b("mscombi2d", {
                        friendlyName: "Multi-series Combination Chart",
                        standaloneInit: !0,
                        creditLabel: m,
                        defaultDatasetType: "column",
                        applicableDSList: { line: !0, area: !0, column: !0 },
                        _createDatasets: function() {
                            var a = this.components,
                                b = this.jsonData,
                                m = b.dataset,
                                h = m && m.length,
                                x, l, f = this.defaultDatasetType,
                                q = this.applicableDSList;
                            x = this.components.legend;
                            var y = a.xAxis[0],
                                G, L, k, t, E, v = this.config.isstacked,
                                z, Y, ka = [],
                                ea = {},
                                va = this.config,
                                ia = this.config.catLen,
                                ra = va.datasetMap || (va.datasetMap = { line: [], area: [], column: [], column3d: [], scrollcolumn2d: [] }),
                                sa = { line: [], area: [], column: [], column3d: [], scrollcolumn2d: [] };
                            m || this.setChartMessage();
                            this.config.categories = b.categories && b.categories[0].category;
                            b = a.dataset = [];
                            x && x.emptyItems();
                            for (x = 0; x < h; x++)
                                if (E = m[x], t = E.parentyaxis || "", L = (L = this.config.isdual && "s" === t.toLowerCase() ? "line" === this.defaultSecondaryDataset ?
                                        this.sDefaultDatasetType : C(E.renderas, this.sDefaultDatasetType) : C(E.renderas, f)) && L.toLowerCase(), q[L] || (L = f), k = B.get("component", ["dataset", L])) void 0 === ea[L] ? ea[L] = 0 : ea[L]++, l = "datasetGroup_" + L, t = B.register("component", ["datasetGroup", L]), (G = a[l]) && ka.push(G), t && !G && (G = a[l] = new t, G.chart = this, G.init()), t = ra[L], (l = t[0]) ? (delete l.legendItemId, G = y.getCategoryLen(), k = ia - G, Y = l.JSONData, z = Y.data && Y.data.length, Y = E.data && E.data.length || 0, z -= Y, k = this._getDiff(z, Y, k, G), G = k.diff, k = k.startIndex, 0 < G && l.removeData(k,
                                    G, !1), l.index = x, l.JSONData = E, l.configure(), t.splice(0, 1)) : (l = new k, l.chart = this, l.index = x, G && (v ? G.addDataSet(l, 0, ea[L]) : G.addDataSet(l, ea[L], 0)), l.init(E)), sa[L].push(l), b.push(l);
                            this._setDatasetOrder();
                            for (m in ra)
                                if (t = ra[m], f = t[0] && t[0].groupManager, h = t.length, q = void 0 === ea[m] ? 0 : ea[m] + 1, h)
                                    for (v && f && f.removeDataSet(0, q, h), a = 0; a < h; a++) f && !v && f.removeDataSet(q, 0, 1), "column" === t[a].type && !0 === this.is3D ? (t[a].visible = !1, t[a].draw()) : p.call(t[a]);
                            va.datasetMap = sa;
                            this.config.catLen = y.getCategoryLen()
                        }
                    },
                    b.areabase, { enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-mscombi3d", function() { var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("mscombi3d", { standaloneInit: !0, friendlyName: "Multi-series 3D Combination Chart", defaultDatasetType: "column3d", is3D: !0, creditLabel: b, defaultPlotShadow: 1, applicableDSList: { column3d: !0, line: !0, area: !0 }, _createDatasets: a.mscombi2d }, a.mscartesian3d, { showplotborder: 0, enablemousetracking: !0 }, a.areabase) }]);
            B.register("module", ["private", "modules.renderer.js-mscolumnline3d", function() { var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("mscolumnline3d", { friendlyName: "Multi-series Column and Line Chart", is3D: !0, creditLabel: b, defaultPlotShadow: 1, applicableDSList: { column3d: !0, line: !0 } }, a.mscombi3d, { use3dlineshift: 1, showplotborder: 0, enablemousetracking: !0 }, a.msarea) }]);
            B.register("module", ["private", "modules.renderer.js-stackedcolumn2dline", function() {
                var a = this.hcLib,
                    b =
                    a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("stackedcolumn2dline", { friendlyName: "Stacked Column and Line Chart", defaultDatasetType: "column", creditLabel: a, applicableDSList: { line: !0, column: !0 } }, b.mscombi2d, { isstacked: !0, stack100percent: 0, enablemousetracking: !0 }, b.msarea)
            }]);
            B.register("module", ["private", "modules.renderer.js-stackedcolumn3dline", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("stackedcolumn3dline", {
                    friendlyName: "Stacked 3D Column and Line Chart",
                    is3D: !0,
                    creditLabel: b,
                    _mouseEvtHandler: a.stackedcolumn3d._mouseEvtHandler,
                    applicableDSList: { column3d: !0, line: !0 }
                }, a.mscombi3d, { use3dlineshift: 1, isstacked: !0, stack100percent: 0, showplotborder: 0, enablemousetracking: !0 }, a.msarea)
            }]);
            B.register("module", ["private", "modules.renderer.js-mscombidy2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("mscombidy2d", {
                    standaloneInit: !0,
                    friendlyName: "Multi-series Dual Y-Axis Combination Chart",
                    defaultDatasetType: "column",
                    sDefaultDatasetType: "line",
                    _createDatasets: a.mscombi2d,
                    creditLabel: b,
                    applicableDSList: { column: !0, line: !0, area: !0 }
                }, a.msdybasecartesian, { isdual: 1, enablemousetracking: !0 }, a.msarea)
            }]);
            B.register("module", ["private", "modules.renderer.js-mscolumn3dlinedy", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("mscolumn3dlinedy", {
                    standaloneInit: !0,
                    friendlyName: "Multi-series 3D Column and Line Chart",
                    defaultDatasetType: "column3d",
                    sDefaultDatasetType: "line",
                    is3D: !0,
                    creditLabel: b,
                    _createDatasets: a.mscombi2d,
                    defaultPlotShadow: 1,
                    applicableDSList: { column3d: !0, line: !0 }
                }, a.msdybasecartesian3d, { use3dlineshift: 1, isdual: !0, showplotborder: 0, enablemousetracking: !0 }, a.msarea)
            }]);
            B.register("module", ["private", "modules.renderer.js-stackedcolumn3dlinedy", function() {
                var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("stackedcolumn3dlinedy", {
                    standaloneInit: !0,
                    friendlyName: "Stacked 3D Column and Line Chart",
                    is3D: !0,
                    defaultDatasetType: "column3d",
                    creditLabel: a,
                    sDefaultDatasetType: "line",
                    defaultSecondaryDataset: "line",
                    _createDatasets: b.mscombi2d,
                    _mouseEvtHandler: b.stackedcolumn3d._mouseEvtHandler,
                    applicableDSList: { column3d: !0, line: !0 }
                }, b.msdybasecartesian3d, { use3dlineshift: 1, isdual: !0, isstacked: !0, showplotborder: 0, enablemousetracking: !0 }, b.msarea)
            }]);
            B.register("module", ["private", "modules.renderer.js-msstackedcolumn2dlinedy", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("msstackedcolumn2dlinedy", { standaloneInit: !0, friendlyName: "Multi-series Dual Y-Axis Stacked Column and Line Chart", stack100percent: 0, defaultDatasetType: "column", sDefaultDatasetType: "line", hasLineSet: !0, creditLabel: b, applicableDSList: { column: !0 }, lineset: !0, _createDatasets: a.msstackedcolumn2d }, a.msdybasecartesian, { isdual: !0, haslineset: !0, isstacked: !0, enablemousetracking: !0 }, a.msarea)
            }]);
            B.register("module", ["private", "modules.renderer.js-scrollcolumn2d", function() {
                var a = this,
                    b = a.hcLib,
                    m = b.chartAPI,
                    B = !b.CREDIT_REGEX.test(a.window.location.hostname),
                    p = Math,
                    K = p.min,
                    N = p.max,
                    Q = p.floor,
                    h = p.round,
                    x = b.pluckNumber,
                    l = b.Raphael;
                m("scrollcolumn2d", {
                    standaloneInit: !0,
                    friendlyName: "Scrollable Multi-series Column Chart",
                    tooltipConstraint: "plot",
                    canvasborderthickness: 1,
                    creditLabel: B,
                    defaultDatasetType: "scrollcolumn2d",
                    applicableDSList: { scrollcolumn2d: !0 },
                    avgScrollPointWidth: 40,
                    hasScroll: !0,
                    defaultPlotShadow: 1,
                    binSize: 0,
                    _swipeX: function(f, b) {
                        var h = this.config,
                            l = this.components,
                            m = l.scrollBar.conf,
                            k = m.scrollRatio,
                            t = m.width - 1,
                            E = m.height - 1,
                            v = h.scrollToEnd,
                            m = h.lastScrollPosition;
                        x(l.canvas.config.canvasBorderWidth, l.xAxis[0].config.lineStartExtension);
                        var l = this.touchCurrPos,
                            p = this.swipeStart,
                            B = f.type,
                            E = h.scrollShowButtons ? K(E, .5 * t) : 0,
                            C = this.config.mousedown,
                            m = void 0 !== m ? m : v;
                        switch (B) {
                            case "touchstart":
                            case "mousedown":
                                this.config.mousedown = !0;
                                this.prevScrollPosition = m;
                                this.touchCurrPos = b;
                                break;
                            case "touchmove":
                            case "mousemove":
                                if (C) return p || a.raiseEvent("scrollStart", { scrollPosition: m }, this.chartInstance), h = t - 2 * E - (t * k - 2 * E * k), h = K(N(m + (l - b) / h, 0), 1), this.updateManager(h),
                                    this.swipeStart = !0, this.touchCurrPos = b, f.originalEvent.preventDefault ? f.originalEvent.preventDefault() : f.originalEvent.returnValue = !1, !0;
                                break;
                            case "touchend":
                            case "mouseup":
                                C && (this.swipeStart && (a.raiseEvent("scrollEnd", { prevScrollPosition: this.prevScrollPosition, scrollPosition: h.lastScrollPosition }, this.chartInstance), this.swipeStart = !1), h.mousedown = !1)
                        }
                    },
                    eiMethods: { scrollTo: m.mscartesian._scrollTo },
                    _manageScrollerPosition: function() {
                        var a = this.config,
                            b;
                        b = this._scrollBar.get;
                        var h = this.components.scrollBar,
                            l;
                        b = b()[0];
                        h.setConfiguaration(b.conf);
                        b = a.scrollEnabled;
                        l = h.getLogicalSpace();
                        this._allocateSpace({ bottom: a.shift = !1 === b ? 0 : l.height + h.conf.padding })
                    },
                    _resetViewPortConfig: function() { this.config.viewPortConfig = { scaleX: 1, scaleY: 1, x: 0, y: 0 } },
                    _setInitialDrawingIndex: function() {
                        var a = this.config,
                            b = this.components,
                            h = b.xAxis[0],
                            l = h._getVisibleConfig(),
                            h = h.getCategoryLen(),
                            m = b.dataset,
                            k, t, E, v = m.length,
                            p;
                        a.showsum && a.isstacked && this._createSumLabelPool();
                        this._createDataPool();
                        for (p = 0; p < v; p++) k = m[p], E = k.components,
                            E.removeDataArr = [], t = E.pool, k.drawn && t && (k = E.data.slice(a.scrollMinVal, a.scrollMaxVal), t.element && t.element.push.apply(t.element, k.filter(this._filterDataFn).map(this._datasetModifyFn)), t.label && t.label.push.apply(t.label, k.filter(this._filterLabelFn).map(this._labelModifyFn)), t.image && t.image.push.apply(t.image, k.filter(this._filterImageFn).map(this._imageModifyFn)));
                        (t = (b = b.datasetGroup_scrollcolumn2d) && b.pool) && a.isstacked && (t = t.sumLabels[0]) && t.push.apply(t, b.graphics.sumLabels[0].slice(a.scrollMinVal,
                            a.scrollMaxVal).filter(this._filterSumFn).map(this._sumValModifyFn));
                        a.visibleAxisMinVal = l.minValue;
                        a.visibleAxisMaxVal = l.maxValue;
                        a.startPathIndex = a.scrollMinVal = Math.max(Math.round(l.minValue), 0);
                        a.endPathIndex = a.scrollMaxVal = Math.min(Math.round(l.maxValue) + 1, h)
                    },
                    updateManager: function(a) {
                        var b = this.config,
                            l = this.config.viewPortConfig,
                            m = l.scaleX,
                            p = this.graphics.datasetGroup,
                            k = this.graphics.datalabelsGroup,
                            t = this.graphics.trackerGroup,
                            E = b.canvasWidth * (m - 1) * a,
                            v = this.components,
                            z = v.xAxis[0],
                            x = this.graphics.sumLabelsLayer;
                        l.x = E / m;
                        l = "t" + -h(E) + ",0";
                        b.lastScrollPosition = a;
                        void 0 !== a && v.scrollBar.node && v.scrollBar.node.attr({ "scroll-position": a });
                        this._manageScroll();
                        p.attr({ transform: l });
                        k.attr({ transform: l });
                        t.attr({ transform: l });
                        x && x.attr({ transform: l });
                        a = z.getAxisConfig("animateAxis");
                        b = z.getAxisConfig("drawAxisName");
                        z.setAxisConfig({ animateAxis: !1, drawAxisName: !1 });
                        z.draw();
                        z.setAxisConfig({ animateAxis: a, drawAxisName: b })
                    },
                    _filterLabelFn: function(a) { if (a.graphics && a.graphics.label) return a },
                    _filterDataFn: function(a) {
                        a._xPos =
                            void 0;
                        a._yPos = void 0;
                        a._baseXPos = void 0;
                        a._baseYPos = void 0;
                        if (a.graphics && a.graphics.element) return a
                    },
                    _filterImageFn: function(a) { if (a.graphics && a.graphics.image) return a },
                    _filterSumFn: function(a) { if (a.graphics && a.element) return a },
                    _datasetModifyFn: function(a) { var b = a.graphics.element;
                        a.graphics.element = void 0; return b.hide() },
                    _imageModifyFn: function(a) { var b = a.graphics.image;
                        a.graphics.image = void 0; return b.hide() },
                    _labelModifyFn: function(a) { var b = a.graphics.label;
                        a.graphics.label = void 0; return b.hide() },
                    _sumValModifyFn: function(a) { var b = a.element;
                        a.element = void 0; return b.hide() },
                    _createSumLabelPool: function() { var a = this.components,
                            b, h = a.paper,
                            l;
                        b = a.datasetGroup_scrollcolumn2d;
                        a = b.pool;
                        l = b.graphics && b.graphics.sumLabelContainer; if (!a && l)
                            for (a = b.pool = { sumLabels: [
                                        []
                                    ] }, b = 0; 2 > b; b++) a.sumLabels[0].push(h.text(l[0])) },
                    _createDataPool: function() {
                        var a = this.components,
                            b, h = a.dataset,
                            l = h.length,
                            m, k, t, p, v = a.paper;
                        for (m = 0; m < l; m++) {
                            a = h[m];
                            if (!a.drawn) break;
                            b = a.components;
                            k = a.graphics;
                            t = k.container.anchorGroup ||
                                k.container;
                            p = k.dataLabelContainer;
                            k = b.pool;
                            if (!k)
                                for (k = b.pool = { element: [], label: [], image: [] }, b = 0; 2 > b; b++) k.element.push("column" === a.type ? v.rect(t) : v.polypath(t)), k.label.push(v.text(p))
                        }
                    },
                    _manageScroll: function() {
                        var a = this.config,
                            b = this.components,
                            l;
                        l = b.xAxis[0]._getVisibleConfig();
                        var m = b.dataset,
                            p = m.length,
                            k, t, E, v = a.scrollMinVal,
                            z = a.scrollMaxVal,
                            x = h(l.minValue),
                            B = h(l.maxValue + 1);
                        k = a.visibleAxisMinVal;
                        var K = B - x,
                            C, N;
                        .5 <= l.maxValue - a.visibleAxisMaxVal ? (N = B - z > K, a.scrollMinVal = N ? B - K : z, a.scrollMaxVal =
                            B, a.visibleAxisMaxVal = l.maxValue, a.visibleAxisMinVal = l.minValue, a.startPathIndex = B - K, a.endPathIndex = B, E = !0) : .5 <= k - l.minValue && (N = v - x > K, a.scrollMinVal = x, a.scrollMaxVal = N ? x + K : v, a.visibleAxisMaxVal = l.maxValue, a.visibleAxisMinVal = l.minValue, a.startPathIndex = x, a.endPathIndex = x + K, t = !0);
                        if (t || E) {
                            a.showsum && a.isstacked && (b = b.datasetGroup_scrollcolumn2d, b.drawSumValueFlag = !0, this._createSumLabelPool(), l = b.pool, E ? C = b.graphics.sumLabels[0].slice(v, N ? v + K : x) : t && (C = b.graphics.sumLabels[0].slice(N ? z - K : B, z)), l.sumLabels[0].push.apply(l.sumLabels[0],
                                C.filter(this._filterSumFn).map(this._sumValModifyFn)));
                            for (b = 0; b < p; b++) k = m[b], l = k.components, this._createDataPool(), l = l.pool, E ? C = k.components.data.slice(v, N ? v + K : x) : t && (C = k.components.data.slice(N ? z - K : B, z)), l.element.push.apply(l.element, C.filter(this._filterDataFn).map(this._datasetModifyFn)), l.label.push.apply(l.label, C.filter(this._filterLabelFn).map(this._labelModifyFn)), k.config.imageCount && l.image.push.apply(l.image, C.filter(this._filterImageFn).map(this._imageModifyFn)), k.draw();
                            a.scrollMinVal =
                                x;
                            a.scrollMaxVal = B
                        }
                    },
                    _createToolBox: function() {
                        var b = this.components,
                            h = this._scrollBar,
                            l = h.get,
                            p = h.add,
                            x, k, t = b.scrollBar;
                        m.mscartesian._createToolBox.call(this);
                        x = b.tb;
                        k = (b.toolBoxAPI || x.getAPIInstances(x.ALIGNMENT_HORIZONTAL)).Scroller;
                        h.clear();
                        p({ isHorizontal: !0 }, {
                            scroll: function(b) {
                                return function() {
                                    var f = arguments && arguments[0],
                                        h = b.components.scrollBar.conf,
                                        k = h.scrollTo;
                                    b.config.scrollCurrPosition = f;
                                    k || a.raiseEvent("onScroll", { scrollPosition: f }, b.chartInstance);
                                    h.scrollTo = !1;
                                    b.updateManager.apply(b,
                                        arguments)
                                }
                            }(this)
                        });
                        h = l()[0];
                        t || (b.scrollBar = (new k(h.conf, x.idCount, x.pId)).attachEventHandlers(h.handler))
                    },
                    _setAxisScale: function() {
                        var a = this.config,
                            b = this.components.xAxis[0].getCategoryLen(),
                            h = this.jsonData,
                            l = a.scrollOptions || (a.scrollOptions = {}),
                            m = this.components.dataset,
                            k = m.length,
                            t, p, v = 0,
                            z;
                        z = a.canvasWidth;
                        var B = a.scrollToEnd,
                            K = a.lastScrollPosition,
                            h = x(h.chart.numvisibleplot, Q(a.width / this.avgScrollPointWidth));
                        for (p = 0; p < k; p++) t = m[p], "column" === t.type && v++;
                        this.config.isstacked && (v = 1);
                        b *=
                            v || 1;
                        2 <= h && h < b ? (a.viewPortConfig.scaleX = b /= h, z = z * (b - 1) * (void 0 !== K ? K : B ? 1 : 0), a.viewPortConfig.x = z / b, l.vxLength = h / k, a.scrollEnabled = !0) : a.scrollEnabled = !1
                    },
                    drawScrollBar: function() {
                        var b = this,
                            h = b.config,
                            m = h.viewPortConfig,
                            p = b.components,
                            B = b.graphics,
                            k = p.paper,
                            t = p.xAxis[0],
                            E = t.config,
                            v = t.config.axisRange,
                            z = h.scrollOptions || (h.scrollOptions = {}),
                            K = v.max,
                            C = v.min,
                            N = z.vxLength,
                            Q = p.scrollBar,
                            v = Q.node,
                            ia = h.scrollToEnd,
                            ra = h.lastScrollPosition,
                            sa = m.scaleX,
                            na, ma, U, ba, Aa;
                        ba = void 0 !== ra ? ra : ia ? 1 : 0;
                        m = h.canvasLeft;
                        ia = h.canvasTop;
                        ra = h.canvasHeight;
                        na = h.canvasWidth;
                        p = p.canvas.config;
                        ma = p.canvasBorderWidth;
                        U = E.showAxisLine ? E.axisLineThickness || 0 : 0;
                        Aa = x(ma, E.lineStartExtension);
                        E = x(ma, E.lineEndExtension);
                        z.viewPortMin = C;
                        z.viewPortMax = K;
                        sa = z.scrollRatio = 1 / sa;
                        N = z.windowedCanvasWidth = t.getAxisPosition(N);
                        t = z.fullCanvasWidth = t.getAxisPosition(K - C) - N;
                        z = B.scrollBarParentGroup;
                        z || (z = B.scrollBarParentGroup = k.group("scrollBarParentGroup", B.parentGroup).insertBefore(B.datalabelsGroup));
                        !1 !== h.scrollEnabled ? (Q.draw(m - Aa,
                            ia + ra + ma + U - 2, { width: na + Aa + E, scrollRatio: sa, roundEdges: p.isRoundEdges, fullCanvasWidth: t, windowedCanvasWidth: N, scrollPosition: ba, parentLayer: z }), !v && function() { var h;
                            l.eve.on("raphael.scroll.start." + Q.node.id, function(k) { h = k;
                                a.raiseEvent("scrollstart", { scrollPosition: k }, b.chartInstance) });
                            l.eve.on("raphael.scroll.end." + Q.node.id, function(k) { a.raiseEvent("scrollend", { prevScrollPosition: h, scrollPosition: k }, b.chartInstance) }) }()) : Q && Q.node && Q.node.hide()
                    },
                    _drawDataset: function() { this._setClipping();
                        m.mscartesian._drawDataset.call(this) },
                    _setClipping: function() {
                        var a = this.config,
                            b = this.graphics.datasetGroup,
                            h = this.graphics.datalabelsGroup,
                            l = this.graphics.trackerGroup,
                            m = a.viewPortConfig,
                            k = this.graphics.sumLabelsLayer,
                            p = m.scaleX,
                            x = this.get("config", "animationObj"),
                            v = x.duration,
                            B = x.dummyObj,
                            K = x.animObj,
                            x = x.animType,
                            m = m.x,
                            a = a.height,
                            C = this.components.canvas.config.clip["clip-canvas"],
                            C = C && C.slice(0) || [];
                        this.config.clipSet ? (b.animateWith(B, K, { "clip-rect": C }, v, x), h.animateWith(B, K, { "clip-rect": C }, v, x), l.attr({ "clip-rect": C }), C[3] = a, C[1] =
                            0, k && k.animateWith(B, K, { "clip-rect": C }, v, x)) : (b.attr({ "clip-rect": C }), h.attr({ "clip-rect": C }), l.attr({ "clip-rect": C }), C[3] = a, C[1] = 0, k && k.attr({ "clip-rect": C }));
                        b.attr({ transform: "T" + -(m * p) + ",0" });
                        h.attr({ transform: "T" + -(m * p) + ",0" });
                        l.attr({ transform: "T" + -(m * p) + ",0" });
                        k && k.attr({ transform: "T" + -(m * p) + ",0" });
                        this.config.clipSet = !0
                    },
                    configure: function() { var a = this.jsonData.chart,
                            b;
                        m.mscolumn2d.configure.call(this);
                        b = this.config;
                        b.scrollToEnd = x(a.scrolltoend, 0);
                        b.lastScrollPosition = void 0 }
                }, m.scrollbase)
            }]);
            B.register("module", ["private", "modules.renderer.js-scrollarea2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    m = a.chartAPI,
                    B = a.pluckNumber,
                    p = Math.floor;
                m("scrollarea2d", {
                    friendlyName: "Scrollable Multi-series Area Chart",
                    tooltipConstraint: "plot",
                    canvasborderthickness: 1,
                    creditLabel: b,
                    hasScroll: !0,
                    defaultDatasetType: "scrollarea2d",
                    applicableDSList: { scrollarea2d: !0 },
                    avgScrollPointWidth: 75,
                    defaultPlotShadow: 0,
                    binSize: 0,
                    _setAxisScale: function() {
                        var a = this.config,
                            b =
                            this.components.xAxis[0].getCategoryLen(),
                            m = this.jsonData,
                            h = a.scrollOptions || (a.scrollOptions = {}),
                            x;
                        x = a.lastScrollPosition;
                        var l = a.scrollToEnd,
                            f = a.canvasWidth,
                            m = B(m.chart.numvisibleplot, p(a.width / this.avgScrollPointWidth));
                        2 <= m && m < b ? (a.viewPortConfig.scaleX = b /= m, x = f * (b - 1) * (void 0 !== x ? x : l ? 1 : 0), a.viewPortConfig.x = x / b, h.vxLength = m, a.scrollEnabled = !0) : a.scrollEnabled = !1
                    }
                }, m.scrollcolumn2d, { enablemousetracking: !0 }, m.areabase)
            }]);
            B.register("module", ["private", "modules.renderer.js-scrollline2d", function() {
                var a =
                    this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("scrollline2d", { friendlyName: "Scrollable Multi-series Line Chart", tooltipConstraint: "plot", canvasborderthickness: 1, defaultDatasetType: "line", creditLabel: a, avgScrollPointWidth: 75, defaultPlotShadow: 1, binSize: 0 }, b.scrollarea2d, { zeroplanethickness: 1, zeroplanealpha: 40, showzeroplaneontop: 0, enablemousetracking: !0 }, b.areabase)
            }]);
            B.register("module", ["private", "modules.renderer.js-scrollstackedcolumn2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("scrollstackedcolumn2d", { friendlyName: "Scrollable Stacked Column Chart", canvasborderthickness: 1, tooltipConstraint: "plot", avgScrollPointWidth: 75, creditLabel: b }, a.scrollcolumn2d, {}, a.stackedcolumn2d)
            }]);
            B.register("module", ["private", "modules.renderer.js-scrollcombi2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("scrollcombi2d", {
                    friendlyName: "Scrollable Combination Chart",
                    tooltipConstraint: "plot",
                    hasScroll: !0,
                    canvasborderthickness: 1,
                    avgScrollPointWidth: 40,
                    applicableDSList: { area: !0, line: !0, column: !0 },
                    creditLabel: b,
                    _createDatasets: a.mscombi2d
                }, a.scrollcolumn2d, {}, a.msarea)
            }]);
            B.register("module", ["private", "modules.renderer.js-scrollcombidy2d", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI;
                a("scrollcombidy2d", {
                    friendlyName: "Scrollable Dual Y-Axis Combination Chart",
                    tooltipConstraint: "plot",
                    canvasborderthickness: 1,
                    avgScrollPointWidth: 40,
                    hasScroll: !0,
                    _swipeX: a.scrollcolumn2d,
                    _drawDataset: a.scrollcolumn2d,
                    updateManager: a.scrollcolumn2d,
                    _setAxisScale: a.scrollcolumn2d,
                    _createToolBox: a.scrollcolumn2d,
                    _scrollBar: a.scrollcolumn2d,
                    _manageScrollerPosition: a.scrollcolumn2d,
                    drawScrollBar: a.scrollcolumn2d,
                    _setClipping: a.scrollcolumn2d,
                    _setInitialDrawingIndex: a.scrollcolumn2d,
                    _filterLabelFn: a.scrollcolumn2d,
                    _filterDataFn: a.scrollcolumn2d,
                    _filterSumFn: a.scrollcolumn2d,
                    _datasetModifyFn: a.scrollcolumn2d,
                    _labelModifyFn: a.scrollcolumn2d,
                    _sumValModifyFn: a.scrollcolumn2d,
                    _manageScroll: a.scrollcolumn2d,
                    _createSumLabelPool: a.scrollcolumn2d,
                    _createDataPool: a.scrollcolumn2d,
                    _imageModifyFn: a.scrollcolumn2d,
                    _filterImageFn: a.scrollcolumn2d,
                    creditLabel: b,
                    configure: a.scrollcolumn2d,
                    eiMethods: { scrollTo: a.mscartesian._scrollTo }
                }, a.mscombidy2d, { enablemousetracking: !0, isdual: !0 }, a.areabase)
            }]);
            B.register("module", ["private", "modules.renderer.js-scatter", function() {
                var a = this.hcLib,
                    b = a.chartAPI,
                    a = !a.CREDIT_REGEX.test(this.window.location.hostname);
                b("scatter", {
                    friendlyName: "Scatter Chart",
                    isXY: !0,
                    usesXYinCategory: !0,
                    standaloneInit: !0,
                    hasLegend: !0,
                    defaultZeroPlaneHighlighted: !1,
                    creditLabel: a,
                    defaultDatasetType: "Scatter",
                    applicableDSList: { Scatter: !0 },
                    drawTracker: !0
                }, b.scatterBase, { allowreversexaxis: !0, enablemousetracking: !0 })
            }]);
            B.register("module", ["private", "modules.renderer.js-bubble", function() {
                var a = this.hcLib,
                    b = !a.CREDIT_REGEX.test(this.window.location.hostname),
                    a = a.chartAPI,
                    m = Math,
                    B = m.max,
                    p = m.min;
                a("bubble", {
                    friendlyName: "Bubble Chart",
                    standaloneInit: !0,
                    defaultDatasetType: "bubble",
                    creditLabel: b,
                    applicableDSList: { bubble: !0 },
                    getDataLimits: function() { var a = this.components.dataset,
                            b, m, h, x = -Infinity,
                            l = Infinity;
                        b = 0; for (h = a.length; b < h; b++) m = a[b], m = m.getDataLimits(), x = B(x, m.zMax || -Infinity), l = p(l, m.zMin || Infinity);
                        x = -Infinity === x ? 0 : x;
                        l = Infinity === l ? 0 : l; return { zMax: x, zMin: l } }
                }, a.scatter, { enablemousetracking: !0 })
            }])
        },
        [3, 2, 2, "sr4"]
    ]);
    B.register("module", ["private", "modules.renderer.js-zoomline", function() {
        var a = this,
            b = a.hcLib,
            m = b.hashify,
            C = a.window,
            p = C.document,
            K = C.Image,
            N = C.MouseEvent,
            Q = /msie/i.test(C.navigator.userAgent) && !C.opera,
            h = b.chartAPI,
            x = b.extend2,
            l = b.addEvent,
            f = b.pluck,
            q = b.pluckNumber,
            y = b.getFirstColor,
            G = b.graphics.convertColor,
            L = b.bindSelectionEvent,
            k = b.parseUnsafeString,
            t = b.componentDispose,
            E = b.Raphael,
            v = b.toRaphaelColor,
            z = b.hasTouch,
            Y = b.plotEventHandler,
            ka = b.getMouseCoordinate,
            ea = !b.CREDIT_REGEX.test(C.location.hostname),
            va = b.TOUCH_THRESHOLD_PIXELS,
            ia = b.CLICK_THRESHOLD_PIXELS,
            ra = z ? va : ia,
            sa = b.preDefStr.DEFAULT,
            na = "rgba(192,192,192," + (Q ? .002 : 1E-6) + ")",
            ma = b.schedular,
            U = b.priorityList,
            ba = Math,
            Aa = ba.ceil,
            ua = ba.floor,
            P = ba.round,
            fa = ba.max,
            qa = ba.min,
            wa = ba.cos,
            ta = ba.sin,
            xa = C.parseFloat,
            Fa = C.parseInt,
            r;
        x(b.eventList, { zoomed: "FC_Zoomed", pinned: "FC_Pinned", resetzoomchart: "FC_ResetZoomChart" });
        h("zoomline", {
            standaloneInit: !0,
            canvasborderthickness: 1,
            defaultDatasetType: "zoomline",
            applicableDSList: { zoomline: !0 },
            friendlyName: "Zoomable and Panable Multi-series Line Chart",
            creditLabel: ea,
            _drawAxis: function() { var a = this.components.yAxis || [],
                    c, d;
                c = 0; for (d = a.length; c < d; c++) a[c].draw() },
            _setCategories: function() { var a = this.config,
                    c = this.jsonData,
                    d = this.components.xAxis,
                    n, b, h;
                b = a.cdmchar; var f = c.categories && c.categories[0].category || []; if ((a.cdm || "string" === typeof f) && f.split) { a = f.split(b);
                    n = [];
                    b = 0; for (h = a.length; b < h; b += 1) n.push({ label: a[b] });
                    this.config.categories = c.categories[0].category = n }
                d[0].setAxisPadding(0, 0);
                d[0].setCategory(n || f) },
            _createDatasets: function() {
                var a, c, d, b, g, h, k, w, l;
                g = {};
                var m = this.config;
                a = this.components;
                w = this.jsonData;
                var q = w.dataset,
                    F = q && q.length,
                    p = m.cdmchar,
                    u = m.cdm,
                    r = this.defaultDatasetType,
                    v = this.applicableDSList,
                    m = this.components.legend.components.items || [];
                w = w.categories && w.categories[0].category;
                q && w || this.setChartMessage();
                this.config.categories = w;
                w = a.dataset || (a.dataset = []);
                l = w.length;
                for (a = 0; a < F; a++) {
                    k = q[a];
                    if (u && k.data && k.data.split) { h = k.data.split(p);
                        b = [];
                        c = 0; for (d = h.length; c < d; c++) b.push({ value: h[c] });
                        k.data = b }
                    c = k.parentyaxis || "";
                    c = (c = this.isDual && "s" === c.toLowerCase() ? f(k.renderas, this.sDefaultDatasetType) : f(k.renderas, r)) && c.toLowerCase();
                    v[c] || (c = r);
                    if (d = B.get("component", ["dataset", c])) void 0 === g[c] ? g[c] = 0 : g[c]++, (c = w[a]) ? (d = (c.JSONData.data || []).length, b = (k.data || []).length, d > b && c.removeData(b, d - b, !1), w[a].JSONData = k, w[a].configure(), w[a]._deleteGridImages && w[a]._deleteGridImages()) : (c = new d, w.push(c), c.chart = this, c.index = a, c.init(k))
                }
                if (l > F) { g = l - F;
                    c = a; for (F = g + a; c < F; c++) t.call(w[c]);
                    w.splice(a, g);
                    m.splice(a, g) }
            },
            isWithinCanvas: function(a, c) {
                var d = c.get("config"),
                    n = b.getMouseCoordinate(c.get("linkedItems", "container"), a, c),
                    g = n.chartX,
                    h = n.chartY,
                    f = d.canvasLeft,
                    w = d.canvasTop,
                    k = d.canvasLeft + d.canvasWidth,
                    d = d.canvasHeight + d.canvasTop;
                n.insideCanvas = !1;
                n.originalEvent = a;
                g > f && g < k && h > w && h < d && (n.insideCanvas = !0);
                return n
            },
            highlightPoint: function(a, c, d, n, g, h) {
                var f = this,
                    k = f.config,
                    l = f.components,
                    m = f.graphics,
                    q = l.paper,
                    F = m.tracker,
                    p = (l = l.dataset[g]) && l.config;
                g = l && p.zoomedRadius || 0;
                var u = l && p.hoverCosmetics,
                    l = u && u.fill,
                    p = u && u.borderColor,
                    u = u && u.borderThickness,
                    r = {},
                    r = function(a) { b.plotEventHandler.call(this, f, a) },
                    t = function(a) {
                        b.plotEventHandler.call(this,
                            f, a, "dataplotRollover")
                    },
                    v = function(a) { b.plotEventHandler.call(this, f, a, "dataplotRollout") };
                F || (F = m.tracker = q.circle(0, 0, 0, m.trackerGroup).attr({ "clip-rect": k.canvasLeft + "," + k.canvasTop + "," + k.canvasWidth + "," + k.canvasHeight }).click(r).trackTooltip(!0).hover(t, v));
                n && F.data("eventArgs", { x: n.x, y: n.y, tooltip: n.tooltip, link: n.link });
                k.lastHoveredPoint = n;
                r = Number(a) ? { r: g, fill: l, stroke: p, "stroke-width": u } : { r: g, fill: na, stroke: na, "stroke-width": 0 };
                F.attr(r).tooltip(h).transform("t" + (c + k.canvasLeft) + "," + (d +
                    k.canvasTop));
                n && f.fireMouseEvent("mouseover", F && F.node, k.lastMouseEvent)
            },
            fireMouseEvent: function(a, c, d) {
                var b;
                c && a && (d || (d = {}), d.originalEvent && (d = d.originalEvent), d.touches && (d = d.touches[0]), c.dispatchEvent ? (N ? b = new N(a, {
                    bubbles: !!d.bubbles,
                    cancelable: !!d.cancelable,
                    clientX: d.clientX || d.pageX && d.pageX - p.body.scrollLeft - p.documentElement.scrollLeft || 0,
                    clientY: d.clientY || d.pageY && d.pageY - p.body.scrollTop - p.documentElement.scrollTop || 0,
                    screenX: d.screenX || 0,
                    screenY: d.screenY || 0,
                    pageX: d.pageX || 0,
                    pageY: d.pageY ||
                        0
                }) : p.createEvent && (b = p.createEvent("HTMLEvents"), b.initEvent(a, !!d.bubbles, !!d.cancelable)), b.eventName = a, b && c.dispatchEvent(b)) : p.createEventObject && c.fireEvent && (b = p.createEventObject(), b.eventType = a, b.eventName = a, c.fireEvent("on" + a, b)))
            },
            configure: function() {
                var a, c = this.jsonData.chart || {},
                    d = this.components.colorManager,
                    b = d.getColor("canvasBorderColor"),
                    g;
                c.animation = 0;
                c.showvalues = 0;
                h.msline.configure.call(this);
                g = this.config;
                a = g.style;
                x(g, {
                    useRoundEdges: q(c.useroundedges, 0),
                    animation: !1,
                    zoomType: "x",
                    canvasPadding: q(c.canvaspadding, 0),
                    scrollColor: y(f(c.scrollcolor, d.getColor("altHGridColor"))),
                    scrollShowButtons: !!q(c.scrollshowbuttons, 1),
                    scrollHeight: q(c.scrollheight, 16) || 16,
                    scrollBarFlat: q(c.flatscrollbars, 0),
                    allowPinMode: q(c.allowpinmode, 1),
                    skipOverlapPoints: q(c.skipoverlappoints, 1),
                    showToolBarButtonTooltext: q(c.showtoolbarbuttontooltext, 1),
                    btnResetChartTooltext: f(c.btnresetcharttooltext, "Reset Chart"),
                    btnZoomOutTooltext: f(c.btnzoomouttooltext, "Zoom out one level"),
                    btnSwitchToZoomModeTooltext: f(c.btnswitchtozoommodetooltext,
                        "<strong>Switch to Zoom Mode</strong><br/>Select a subset of data to zoom into it for detailed view"),
                    btnSwitchToPinModeTooltext: f(c.btnswitchtopinmodetooltext, "<strong>Switch to Pin Mode</strong><br/>Select a subset of data and compare with the rest of the view"),
                    pinPaneFill: G(f(c.pinpanebgcolor, b), q(c.pinpanebgalpha, 15)),
                    zoomPaneFill: G(f(c.zoompanebgcolor, "#b9d5f1"), q(c.zoompanebgalpha, 30)),
                    zoomPaneStroke: G(f(c.zoompanebordercolor, "#3399ff"), q(c.zoompaneborderalpha, 80)),
                    showPeakData: q(c.showpeakdata,
                        0),
                    maxPeakDataLimit: q(c.maxpeakdatalimit, c.maxpeaklimit, null),
                    minPeakDataLimit: q(c.minpeakdatalimit, c.minpeaklimit, null),
                    crossline: {
                        enabled: q(c.showcrossline, 1),
                        line: { "stroke-width": q(c.crosslinethickness, 1), stroke: y(f(c.crosslinecolor, "#000000")), "stroke-opacity": q(c.crosslinealpha, 20) / 100 },
                        labelEnabled: q(c.showcrosslinelabel, c.showcrossline, 1),
                        labelstyle: { fontSize: xa(c.crosslinelabelsize) ? xa(c.crosslinelabelsize) + "px" : a.outCanfontSize, fontFamily: f(c.crosslinelabelfont, a.outCanfontFamily) },
                        valueEnabled: q(c.showcrosslinevalues,
                            c.showcrossline, 1),
                        valuestyle: { fontSize: xa(c.crosslinevaluesize) ? xa(c.crosslinevaluesize) + "px" : a.inCanfontSize, fontFamily: f(c.crosslinevaluefont, a.inCanvasStyle.fontFamily) }
                    },
                    useCrossline: q(c.usecrossline, 1),
                    tooltipSepChar: f(c.tooltipsepchar, ", "),
                    showTerminalValidData: q(c.showterminalvaliddata, 0),
                    cdmchar: f(c.dataseparator, "|"),
                    cdm: q(c.compactdatamode, 0)
                })
            },
            getValuePixel: function(a) { var c = this.config.viewPortConfig; return c.ddsi + ua(a / c.ppp) },
            __toolbar: function() {
                var a, c, d, b, g = this,
                    h = g.components,
                    f = h.tb = new(B.register("component", ["toolbox", "toolbox"])),
                    k = f.getDefaultConfiguration(),
                    l, m;
                f.init({ iAPI: { chart: g }, graphics: g.graphics, chart: g, components: h });
                a = h.toolBoxAPI || f.getAPIInstances(f.ALIGNMENT_HORIZONTAL);
                c = a.SymbolStore;
                d = a.ComponentGroup;
                b = a.Toolbar;
                l = a.Symbol;
                m = a.Scroller;
                f.graphics = {};
                return {
                    reInit: function() { f.init({ iAPI: { chart: g }, graphics: g.graphics, chart: g, components: h }) },
                    addSymbol: function(a, c, e, d) {
                        a = new l(a);
                        e && d.setConfiguaration({ buttons: x(x({}, k), e) });
                        c.tooltext = e.tooltip;
                        c && a.attachEventHandlers(c);
                        d.addSymbol(a);
                        return a
                    },
                    addScroll: function(a, c) { var e = new m(a);
                        c && e.attachEventHandlers(c); return e },
                    addComponentGroup: function(a, c) { var e;
                        e = new d;
                        e.setConfiguaration({ group: { fill: c ? c.fill : G("EBEBEB", 0), borderThickness: c ? q(c.borderThickness, 0) : 0 } }); return e },
                    addToolBox: function(a) { var c, e = new b; for (c = 0; c < a.length; c += 1) e.addComponent(a[c]); return e },
                    setDrawingArea: function(a, c) { a.drawingArea = c; return a },
                    draw: function(a) {
                        var c, e, d;
                        for (c = 0; c < a.length; c += 1) e = a[c], d = e.drawingArea,
                            e.draw(d.x, d.y)
                    },
                    registerSymbol: function(a, e) { c.register(a, e) },
                    getLogicalSpace: function(a) { return a.getLogicalSpace() },
                    getNode: function(a) { return a.node }
                }
            },
            __preDraw: function() {
                var a, c, d, b, g, h, f, k, l, m = this,
                    p = m.components,
                    F = p.paper,
                    t = m.graphics;
                c = t.imageContainer;
                var u = m.config,
                    v = u.canvasLeft,
                    B = u.canvasWidth;
                a = m.jsonData.chart;
                var y = u.cdm;
                d = p.xAxis[0];
                var A = u.viewPortConfig,
                    z = m.components.canvas.config;
                g = fa(z.canvasPadding, z.canvasPaddingLeft, z.canvasPaddingRight);
                h = p.yAxis[0];
                l = t.datasetGroup;
                var z =
                    u.canvasHeight,
                    C = u.canvasTop,
                    G = m.jsonData.chart,
                    G = u.borderWidth || (u.borderWidth = q(G.showborder, 1) ? q(G.borderthickness, 1) : 0);
                f = u.allowPinMode;
                var K = u.crossline,
                    A = d.getCategoryLen(),
                    N = Fa(q(a.displaystartindex, 1), 10) - 1,
                    P = Fa(q(a.displayendindex, A || 2), 10) - 1,
                    Q = 0,
                    R = p.dataset,
                    D = R.length,
                    p = t.crossline;
                u.updateAnimDuration = 500;
                c.transform("t" + v + "," + C);
                c.attr({ "clip-rect": v + "," + C + "," + B + "," + z });
                u.status = "zoom";
                u.maxZoomLimit = q(a.maxzoomlimit, 1E3);
                u.viewPortHistory = [];
                1 > (c = q(a.pixelsperpoint, 15)) && (c = 1);
                (d = q(a.pixelsperlabel,
                    a.xaxisminlabelwidth, d.getAxisConfig("labels").rotation ? 20 : 60)) < c && (d = c);
                (0 > N || N >= (A - 1 || 1)) && (N = 0);
                (P <= N || P > (A - 1 || 1)) && (P = A - 1 || 1);
                A = u.viewPortConfig = x(u.viewPortConfig, { amrd: q(a.anchorminrenderdistance, 20), nvl: q(a.numvisiblelabels, 0), cdm: y, oppp: c, oppl: d, dsi: N, dei: P, vdl: P - N, clen: A, offset: 0, step: 1, llen: 0, alen: 0, ddsi: N, ddei: P, ppc: 0 });
                if (A.clen) {
                    for (; D--;) a = R[D].config, Q = fa(Q, a.drawanchors && (a.anchorradius || 0) + (Number(a.anchorborderthickness) || 0) || 0);
                    u.overFlowingMarkerWidth = Q;
                    g = u.canvasPadding = fa(Q,
                        g);
                    u._prezoomed = A.dei - A.dsi < A.clen - 1;
                    a = u._visw = u.canvasWidth - 2 * g;
                    b = u._visx = u.canvasLeft + g;
                    u._visout = -(u.height + z + 1E3);
                    u._ypvr = h && h.getPVR() || 0;
                    g = u._yminValue = h.getLimit().min;
                    h = u._ymin = h.getPixel(g);
                    l = l.attr("clip-rect", [b - Q, C, a + 2 * Q, z]);
                    t.scroll || (t.scroll = F.group("scroll").insertAfter(t.datasetGroup));
                    f && (u.viewPortConfig.pinned = !1, f = E.crispBound(0, C - h, 0, z, G), u["clip-pinrect"] = [f.x, C, f.width, f.height], k = (t.zoompin || (t.zoompin = F.group("zoompin"))).insertBefore(l).transform(u._pingrouptransform = ["T",
                        b, h
                    ]).hide(), l = { "stroke-width": 0, stroke: "none", fill: u.pinPaneFill, "shape-rendering": "crisp", ishot: !0 }, t.pinrect ? (l.x = 0, l.y = C - h, l.width = a, l.height = z, t.pinrect.attr(l)) : t.pinrect = F.rect(0, C - h, a, z, k).attr(l), l = { transform: k.transform(), x: 0, y: C - h, width: 0, height: z, stroke: "none", fill: na, ishot: !0, cursor: E.svg && "ew-resize" || "e-resize" }, t.pintracker ? t.pintracker.attr(l).hide() : t.pintracker = F.rect(t.trackerGroup).attr(l).hide().drag(function(a, c) {
                        var e = c[0],
                            d = b + e + this.__pindragdelta,
                            g = this.__pinboundleft,
                            h =
                            this.__pinboundright,
                            f = this.data("cliprect").slice(0),
                            l = u._ymin;
                        d < g ? d = g : d > h && (d = h);
                        k.transform(["T", d, l]);
                        t.pintracker.transform(k.transform());
                        E.svg || (f[0] = f[0] + d - b - this.__pindragdelta, k.attr("clip-rect", f));
                        this.__pindragoffset = e
                    }, function() { var a = u["clip-pinrect"],
                            c = u._visw;
                        this.__pinboundleft = 0 - a[0] + u._visx + u.canvasLeft;
                        this.__pinboundright = this.__pinboundleft + c - a[2];
                        this.data("cliprect", k.attr("clip-rect"));
                        k._.clipispath = !0 }, function() {
                        k._.clipispath = !1;
                        this.__pindragdelta += this.__pindragoffset;
                        delete this.__pindragoffset;
                        delete this.__pinboundleft;
                        delete this.__pinboundright
                    }));
                    G++;
                    f = E.crispBound(v - G, C + z + G, B + G + G, u.scrollHeight, G);
                    G--;
                    L(m, { attr: { stroke: u.zoomPaneStroke, fill: u.zoomPaneFill, strokeWidth: 0 }, selectionStart: function() {}, selectionEnd: function(a) { var c = a.selectionLeft - v;
                            a = c + a.selectionWidth;
                            t.crossline && t.crossline.hide();
                            m[u.viewPortConfig.pinned ? "pinRangePixels" : "zoomRangePixels"](c, a) } });
                    K && 0 !== K.enabled && 1 === u.useCrossline ? (p || (p = t.crossline = new r), p.configure(m, K)) : (K && (K.enabled =
                        0), p && p.hide())
                }
            },
            resetZoom: function() { var e = this.config.viewPortHistory,
                    c = e[0]; if (!e.length) return !1;
                e.length = 0;
                this.zoomTo(c.dsi, c.dei, c) && a.raiseEvent("zoomReset", this._zoomargs, this.chartInstance, [this.chartInstance.id]); return !0 },
            eiMethods: {
                zoomOut: function(a) { var c = this.apiInstance,
                        d = c.chartInstance.args.asyncRender,
                        b, g = c.getJobList(); if (c)
                        if (d) g.eiMethods.push(ma.addJob(function() { b = c.zoomOut && c.zoomOut(); "function" === typeof a && a(b) }, U.postRender));
                        else return c.zoomOut && c.zoomOut() },
                scrollTo: h.mscartesian._scrollTo,
                zoomTo: function(a, c, d) { var b = this.apiInstance,
                        g = b.chartInstance.args.asyncRender,
                        h, f = b.getJobList(); if (b)
                        if (g || d) f.eiMethods.push(ma.addJob(function() { h = b.zoomRange && b.zoomRange(a, c); "function" === typeof d && d(h) }, U.postRender));
                        else return b.zoomRange && b.zoomRange(a, c) },
                resetChart: function() { var a = this.apiInstance,
                        c = a.chartInstance.args.asyncRender,
                        d = a.getJobList(),
                        b = function() { a.pinRangePixels && a.pinRangePixels();
                            a.resetZoom && a.resetZoom() };
                    a && (c ? d.eiMethods.push(ma.addJob(b, U.postRender)) : b()) },
                setZoomMode: function(a) { var c = this.apiInstance,
                        d = c.chartInstance.args.asyncRender,
                        b = c.getJobList();
                    c && (d ? b.eiMethods.push(ma.addJob(function() { c.activatePin && c.activatePin(!a) }, U.postRender)) : c.activatePin && c.activatePin(!a)) },
                getViewStartIndex: function(a) { var c = this.apiInstance,
                        d = c.chartInstance.args.asyncRender,
                        b, g = c.getJobList(); if (a || d) g.eiMethods.push(ma.addJob(function() { "function" === typeof a && c && (b = c.config.viewPortConfig) && a(b.ddsi) }, U.postRender));
                    else if (c && (b = c.config.viewPortConfig)) return b.ddsi },
                getViewEndIndex: function(a) { var c = this.apiInstance,
                        d = c.chartInstance.args.asyncRender,
                        b, g, h = c.getJobList(); if (a || d) h.eiMethods.push(ma.addJob(function() { "function" === typeof a && c && (b = c.config.viewPortConfig) && (g = b.ddei - 1, a((g >= b.clen ? b.clen : g) - 1)) }, U.postRender));
                    else if (c && (b = c.config.viewPortConfig)) return g = b.ddei - 1, (g >= b.clen ? b.clen : g) - 1 }
            },
            zoomOut: function() {
                var e, c, d = this.config;
                c = d.viewPortHistory;
                var b, g, h;
                e = c.pop();
                c = c[0] || d.viewPortConfig;
                e ? (b = e.dsi, g = e.dei) : d._prezoomed && (b = 0, g = c.clen - 1);
                (h = this.zoomTo(b, g, e)) && a.raiseEvent("zoomedout", h, this.chartInstance);
                return !0
            },
            zoomRangePixels: function(e, c) { var d = this.config,
                    b = d.viewPortHistory,
                    d = d.viewPortConfig,
                    g = d.ppp,
                    h = d.ddsi,
                    f;
                b.push(d);
                (f = this.zoomTo(h + ua(e / g), h + ua(c / g))) ? a.raiseEvent("zoomedin", f, this.chartInstance): b.pop() },
            zoomRange: function(e, c) {
                var d, b, g = this.config,
                    h = g.viewPortConfig;
                b = this.components.xAxis[0];
                var f = g.viewPortHistory,
                    k;
                f.push(h);
                d = b.getPixel(e);
                b = b.getPixel(c);
                h.x = d;
                h.scaleX = g.canvasWidth / (d - b);
                (k = this.zoomTo(+e, +c)) ? a.raiseEvent("zoomedin", k, this.chartInstance): f.pop()
            },
            zoomTo: function(e, c, d) {
                var b, g;
                b = this.config;
                var h = this.components,
                    f = b.viewPortConfig,
                    k = b.canvasHeight;
                g = b.canvasLeft;
                var l = b.canvasTop,
                    m = b.canvasBottom,
                    p = b.viewPortHistory,
                    q = f.clen,
                    r = this.components.xAxis[0];
                0 > e && (e = 0);
                e >= q - 1 && (e = q - 1);
                c <= e && (c = e + 1);
                c > q - 1 && (c = q - 1);
                if (e === c || e === f.dsi && c === f.dei) return !1;
                this.pinRangePixels();
                f = x({}, f);
                f.dsi = e;
                f.dei = c;
                f = b.viewPortConfig = f;
                d ? this.updateVisual(d.x, d.y, d.scaleX, d.scaleY) : (d = r.getPixel(e), b = r.getPixel(c),
                    g = this.getOriginalPositions(d - g, l, b - g, m - l), this.zoomSelection(g[0], 0, g[2], k));
                h.scrollBar.node.attr({ "scroll-ratio": f.vdl / (q - !!q), "scroll-position": [f.dsi / (q - f.vdl - 1), !0] });
                h = { level: p.length + 1, startIndex: e, startLabel: r.getLabel(e).label, endIndex: c, endLabel: r.getLabel(c).label };
                a.raiseEvent("zoomed", h, this.chartInstance, [this.chartInstance.id, e, c, h.startLabel, h.endLabel, h.level]);
                return h
            },
            activatePin: function(e) {
                var c = this.config.viewPortConfig,
                    d = this.components.tb.graphics.pinButton;
                if (c.pinned ^
                    (e = !!e)) return e || this.pinRangePixels(), a.raiseEvent("zoomModeChanged", { pinModeActive: e }, this.chartInstance, []), this.updateButtonVisual(d.node, e ? "pressed" : "enable"), c.pinned = e
            },
            updateButtonVisual: function(a, c) {
                return a.attr({
                    disable: {
                        config: {
                            hover: { fill: "#FFFFFF", "fill-symbol": "#FFFFFF", "stroke-width": 1, stroke: "#E3E3E3", cursor: "default" },
                            normal: { fill: "#FFFFFF", "fill-symbol": "#FFFFFF", stroke: "#E3E3E3", "stroke-width": 1, cursor: "default" },
                            disable: {
                                fill: "#FFFFFF",
                                "fill-symbol": "#FFFFFF",
                                "stroke-width": 1,
                                stroke: "#E3E3E3",
                                "stroke-opacity": 1,
                                cursor: "default"
                            },
                            pressed: { fill: "#FFFFFF", "fill-symbol": "#FFFFFF", "stroke-width": 1, stroke: "#E3E3E3", cursor: "default" }
                        },
                        "button-disabled": !1,
                        stroke: "#E3E3E3",
                        "stroke-opacity": 1
                    },
                    enable: {
                        config: {
                            hover: { fill: "#FFFFFF", "fill-symbol": "#FFFFFF", "stroke-width": 1, stroke: "#aaaaaa", cursor: "pointer" },
                            normal: { fill: "#FFFFFF", "fill-symbol": "#FFFFFF", stroke: "#C2C2C2", "stroke-width": 1, cursor: "pointer" },
                            disable: {
                                fill: "#FFFFFF",
                                "fill-symbol": "#FFFFFF",
                                "stroke-width": 1,
                                stroke: "#E3E3E3",
                                "stroke-opacity": 1,
                                cursor: "pointer"
                            },
                            pressed: { fill: "#EFEFEF", "fill-symbol": "#EFEFEF", "stroke-width": 1, stroke: "#C2C2C2", cursor: "pointer" }
                        },
                        "button-disabled": !1,
                        fill: ["#FFFFFF", "#FFFFFF", "#FFFFFF", "#FFFFFF", !0],
                        stroke: "#C2C2C2",
                        "stroke-opacity": 1
                    },
                    pressed: {
                        config: {
                            hover: { fill: "#dcdcdc", "fill-symbol": "#FFFFFF", "stroke-width": 1, stroke: "#b7b7b7", cursor: "pointer" },
                            normal: { fill: "#dcdcdc", "fill-symbol": "#FFFFFF", "stroke-width": 1, stroke: "#b7b7b7", cursor: "pointer" },
                            pressed: {
                                fill: "#dcdcdc",
                                "fill-symbol": "#FFFFFF",
                                "stroke-width": 1,
                                stroke: "#b7b7b7",
                                cursor: "pointer"
                            }
                        },
                        fill: "#dcdcdc",
                        "fill-symbol": "#FFFFFF",
                        "stroke-width": 1,
                        stroke: "#b7b7b7",
                        cursor: "pointer"
                    }
                }[c])
            },
            pinRangePixels: function(a, c) {
                var d, b = this.components,
                    g = b.paper,
                    h = this.graphics,
                    f = this.config,
                    k = f.canvasLeft,
                    l = f.viewPortConfig,
                    m = h.zoompin;
                d = h.pinrect;
                var q = f["clip-pinrect"],
                    p = f._pingrouptransform,
                    b = b.dataset,
                    r = c - a,
                    u, t, v, h = h.pintracker;
                if (l && m && d) {
                    if (a === c) return m.hide(), h.hide(), l.pinned = !1;
                    for (v = b.length; v--;) u = b[v], d = u.graphics, t = d.pinline, t || (t =
                        d.pinline = g.path(m)), t.attr({ path: d.lineElement.attrs.path, transform: ["T", -f._visx, -f._ymin] }).attr(u.config.pin);
                    q[0] = a + k;
                    q[2] = r;
                    m.attr({ "clip-rect": q, transform: p }).show();
                    h.__pindragdelta = 0;
                    h.show().attr({ transform: p, x: a, width: r });
                    this.getValuePixel(a);
                    this.getValuePixel(c);
                    return l.pinned = !0
                }
            },
            _createLayers: function() { var a, c = this.components.paper;
                h.scatter._createLayers.call(this);
                a = this.graphics;
                a.imageContainer = c.group("dataset-orphan", a.dataSetGroup);
                this.__preDraw() },
            getValue: function(a) {
                var c =
                    this.config,
                    d = this.components,
                    b = c.viewPortConfig;
                a = this.getOriginalPositions(a.x, a.y, a.x, a.y);
                var g = d.xAxis[0].config.axisRange,
                    d = d.yAxis[0].config.axisRange,
                    h = g.min,
                    f = d.max;
                return { x: h + (a[0] - c.canvasLeft) / (c.canvasWidth * b.scaleX / (g.max - h)), y: f - (a[1] - c.canvasTop) / (c.canvasHeight * b.scaleY / (f - d.min)) }
            },
            getOriginalPositions: function(a, c, d, b) {
                var g = this.config,
                    h = g.viewPortConfig,
                    f = h.scaleX,
                    k = h.scaleY,
                    l = h.x,
                    h = h.y,
                    m = qa(a, d);
                a = fa(a, d);
                d = qa(c, b);
                c = fa(c, b);
                a = a > g.canvasWidth ? g.canvasWidth : a;
                c = c > g.canvasHeight ?
                    g.canvasHeight : c;
                m = 0 > m ? 0 : m;
                d = 0 > d ? 0 : d;
                return [l + m / f, h + d / k, (a - m) / f, (c - d) / k]
            },
            zoomSelection: function(a, c, d, b) { var g = this.config;
                d && b && (d = Math.abs(g.canvasWidth / d), b = Math.abs(g.canvasHeight / b), this.updateVisual(a, c, d, b)) },
            updateVisual: function(a, c, b, n, g) {
                var h = this.config,
                    f = h.viewPortConfig,
                    k = h.canvasWidth,
                    l = h.canvasHeight,
                    m = h.viewPortHistory.slice(-1)[0] || f,
                    h = h.maxZoomLimit;
                f.x = isNaN(a) ? a = m.x : a;
                f.y = isNaN(c) ? c = m.y : c;
                f.scaleX = b || (b = m.scaleX);
                f.scaleY = n || (n = m.scaleY);
                b > h && (f.x = qa(a, k - k / h), f.scaleX = h);
                n >
                    h && (f.y = qa(c, l - l / h), f.scaleY = h);
                this.updateManager(g)
            },
            toogleDragPan: function(a) { var c = this.config.viewPortConfig,
                    b = c.status;
                a && (c.status = "zoom" === b ? "pan" : "zoom") },
            resize: function() {
                var a = this.config,
                    c = this.graphics,
                    b = this.components.canvas,
                    h = b.graphics,
                    g = h.canvasBorderElement,
                    h = h.canvasElement,
                    b = b.config.canvasBorderThickness,
                    f = b / 2,
                    k = a.canvasHeight -= b,
                    l = a.canvasWidth -= 2 * b,
                    m = a.canvasLeft += b;
                a.canvasBottom -= b;
                a.canvasRight -= b;
                h ? h.attr({ x: m, y: a.canvasTop, height: k, width: l }) : this.drawCanvas();
                g && g.attr({
                    x: m -
                        f,
                    y: a.canvasTop - f,
                    height: k + b,
                    width: l + b,
                    "stroke-width": b
                });
                c.imageContainer.attr({ "clip-rect": a.canvasLeft + "," + a.canvasTop + "," + a.canvasWidth + "," + a.canvasHeight }).transform("t" + a.canvasLeft + "," + a.canvasTop);
                c.trackerElem.attr({ x: a.canvasLeft, y: a.canvasTop, width: a.canvasWidth, height: a.canvasHeight });
                c.tracker && c.tracker.attr({ "clip-rect": a.canvasLeft + "," + a.canvasTop + "," + a.canvasWidth + "," + a.canvasHeight })
            },
            updateManager: function(a) {
                var c, b;
                b = this.components;
                var h = b.dataset,
                    g = h.length;
                c = this.config;
                var f =
                    c.allowPinMode,
                    k = c.viewPortConfig,
                    l = c._ypvr,
                    m = c._visw,
                    q = this.components.xAxis[0],
                    p = function() { return q.getPixel.apply(q, arguments) },
                    r = q.getAxisConfig("labels").style,
                    t, u, v, x, z, A = this.updateButtonVisual,
                    y = b.tb.graphics,
                    G = y.zoomOutButton,
                    E = y.resetButton,
                    y = y.pinButton,
                    K = c.viewPortHistory;
                if (c.legendClicked)
                    for (a = 0; a < g; a += 1) h[a].draw();
                else {
                    !k && (k = c.viewPortConfig);
                    t = k.oppp;
                    z = v = k.nvl;
                    u = k.dsi;
                    v = k.dei;
                    u = k.vdl = v - u;
                    v = k.ppl = z ? m / z : k.oppl;
                    m = k.step = (x = k.ppp = m / u) < t ? Aa(t / x) : 1;
                    r = k.lskip = Aa(fa(v, xa(r.lineHeight)) /
                        x / m);
                    void 0 !== a ? (t = (k.clen - u - 1) * a, k.offset = (t - (t = Fa(t))) * x, u = t + u) : (t = k.dsi, u = k.dei, k.offset = 0);
                    x = k.norm = t % m;
                    k.ddsi = t -= x;
                    k.ddei = u = u + 2 * m - x;
                    k.pvr = l;
                    k._ymin = c._ymin;
                    k._yminValue = c._yminValue;
                    k.x = (p(t) - p(q.getLimit().min) + k.offset) / k.scaleX;
                    u - t > q.getCategoryLen() ? k.scaleX = 1 : k.scaleX = q.getCategoryLen() / Math.abs(u - t - m - .9);
                    void 0 !== a && b.scrollBar.node && b.scrollBar.node.attr({ "scroll-position": k._pos = a });
                    b = q._getVisibleConfig();
                    b = Math.ceil((b.maxValue - b.minValue + 1) / z);
                    c = c.viewPortConfig && c.viewPortConfig.scaleX;
                    c = Math.max(Math.round(q.getAxisConfig("labelStep") / c), z ? b : r * m);
                    q.setLabelConfig({ step: c });
                    c = q.getAxisConfig("animateAxis");
                    z = q.getAxisConfig("drawAxisName");
                    a && q.setAxisConfig({ animateAxis: !1, drawAxisName: !1 });
                    q.draw();
                    q.setAxisConfig({ animateAxis: c, drawAxisName: z });
                    for (a = 0; a < g; a += 1) h[a].draw();
                    A(G.node, k.vdl === k.clen - 1 ? "disable" : "enable");
                    A(E.node, 0 < K.length ? "enable" : "disable");
                    y && A(y.node, f ? "enable" : "disable");
                    C.FC_DEV_ENVIRONMENT && C.jQuery && (B["debugger"].enable() ? (this.debug = this.debug || (C.jQuery("#fc-zoominfo").length ||
                        C.jQuery("body").append('<pre id="fc-zoominfo">'), C.jQuery("#fc-zoominfo").css({ position: "absolute", left: "10px", top: "0", "pointer-events": "none", opacity: .7, width: "250px", zIndex: "999", border: "1px solid #cccccc", "box-shadow": "1px 1px 3px #cccccc", background: "#ffffff" })), this.debug.text(JSON.stringify(k, 0, 2))) : (this.debug && C.jQuery("#fc-zoominfo").remove(), delete this.debug))
                }
            },
            _drawDataset: function() { h.zoomline.updateManager.call(this) },
            getParsedLabel: function(a) {
                var c = this.xlabels;
                return c.parsed[a] ||
                    (c.parsed[a] = k(c.data[a] || ""))
            },
            _createToolBox: function() {
                var a, c, b, f, g, k, l, m = this,
                    q = m.config;
                l = q.allowPinMode;
                f = m.components;
                var p = q.showToolBarButtonTooltext;
                a = f.chartMenuBar;
                c = f.actionBar;
                a && a.drawn || c && c.drawn || (h.scrollcolumn2d._createToolBox.call(m), a = f.tb, c = a.graphics || (a.graphics = {}), b = f.toolBoxAPI || a.getAPIInstances(a.ALIGNMENT_HORIZONTAL), b = b.Symbol, f = (f.chartMenuBar || f.actionBar).componentGroups[0], g = c.zoomOutButton = (new b("zoomOutIcon", void 0, a.idCount++, a.pId)).attachEventHandlers({
                    click: function() { m.zoomOut() },
                    tooltext: p && q.btnZoomOutTooltext || ""
                }), k = c.resetButton = (new b("resetIcon", void 0, a.idCount++, a.pId)).attachEventHandlers({ click: function() { m.resetZoom() }, tooltext: p && q.btnResetChartTooltext || "" }), l && (l = c.pinButton = (new b("pinModeIcon", void 0, a.idCount++, a.pId)).attachEventHandlers({ click: function() { m.activatePin(!q.viewPortConfig.pinned) }, tooltext: p && q.btnSwitchToPinModeTooltext || "" }), f.addSymbol(l, !0)), f.addSymbol(k, !0), f.addSymbol(g, !0))
            },
            _scrollBar: h.scrollcolumn2d,
            _manageScrollerPosition: h.scrollcolumn2d,
            draw: function() {
                var b, c, d, f, g, k, l, m, q, p, t = this,
                    r = t.config,
                    v = t.graphics || (t.graphics = {});
                k = t.components;
                b = t.jsonData;
                f = b.dataset;
                var u = b.categories && b.categories[0].category,
                    x;
                h.msline.draw.call(t);
                l = r.canvasLeft;
                m = r.canvasTop;
                q = r.canvasHeight;
                p = r.canvasWidth;
                b = r.borderWidth;
                c = r.useRoundEdges;
                d = r.viewPortConfig;
                (x = v.toolboxParentGroup) || (x = v.toolboxParentGroup = k.paper.group("toolbarParentGroup", v.parentGroup));
                f && u && (b++, f = E.crispBound(l - b, m + q + b, p + b + b, r.scrollHeight, b), b--, k = (g = k.scrollBar) && g.node,
                    g.draw(f.x + (c && -1 || b % 2), f.y - (c && 4 || 2), { isHorizontal: !0, width: f.width - (!c && 2 || 0), height: f.height, showButtons: r.scrollShowButtons, scrollRatio: d.vdl / (d.clen - !!d.clen), scrollPosition: [d.dsi / (d.clen - d.vdl - 1), !1], r: c && 2 || 0, parentLayer: x.insertBefore(v.datalabelsGroup) }), !k && function() {
                        var c;
                        E.eve.on("raphael.scroll.start." + g.node.id, function(b) { c = b;
                            t.graphics.crossline && t.graphics.crossline.disable(!0);
                            a.raiseEvent("scrollstart", { scrollPosition: b }, t.chartInstance) });
                        E.eve.on("raphael.scroll.end." + g.node.id,
                            function(b) { t.graphics.crossline && t.graphics.crossline.disable(!1);
                                a.raiseEvent("scrollend", { prevScrollPosition: c, scrollPosition: b }, t.chartInstance) })
                    }())
            }
        }, h.msline, { showValues: 0, zeroplanethickness: 1, zeroplanealpha: 40, showzeroplaneontop: 0, enablemousetracking: !0 });
        h("zoomlinedy", {
            standaloneInit: !0,
            defaultDatasetType: "zoomline",
            applicableDSList: { zoomline: !0 },
            creditLabel: ea,
            friendlyName: "Zoomable and Panable Multi-series Dual-axis Line Chart",
            _spaceManager: h.msdybasecartesian._spaceManager,
            _setAxisLimits: h.msdybasecartesian._setAxisLimits,
            _createAxes: h.msdybasecartesian._createAxes,
            _feedAxesRawData: h.msdybasecartesian._feedAxesRawData
        }, h.zoomline, { isdual: !0 });
        B.register("component", ["dataset", "zoomline", {
            _setConfigure: function() { var a = this.config,
                    c = this.chart.jsonData.chart,
                    b = this.JSONData;
                a.drawanchors = q(c.drawanchors, c.showanchors, 1);
                a.anchorradius = q(b.anchorradius, c.anchorradius, a.linethickness + 2);
                this.__base__._setConfigure.apply(this, arguments) },
            _firePlotEvent: function(a, c, d, f) {
                var g = this.chart,
                    h = this.components,
                    h = (h.dataRT ||
                        h.data)[c],
                    k = h.graphics.element,
                    l = b.toolTip,
                    m = d.originalEvent,
                    q = g.components.paper.canvas.style,
                    t = !this.chart.config.useCrossline,
                    p, r;
                if (k) switch (p = h.config, r = p.setLink, p = p.eventArgs, a) {
                    case "mouseover":
                        t && this._decideTooltipType(c, f, d);
                        this._rolloverResponseSetter(g, h, m);
                        r && (q.cursor = "pointer");
                        break;
                    case "mouseout":
                        l.hide(g.chartInstance.id);
                        this._rolloutResponseSetter(g, h, m);
                        r && (q.cursor = sa);
                        break;
                    case "click":
                        Y.call(k, g, m, "dataplotclick", p);
                        break;
                    case "mousemove":
                        t && this._decideTooltipType(c,
                            f, d)
                }
            },
            configure: function() { var a, c, d = {};
                a = this.chart.jsonData.chart;
                a.animation = 0;
                a.showvalues = q(a.showvalues, 0);
                this.__base__.configure.call(this);
                c = this.config;
                a = c.linethickness + q(a.pinlinethicknessdelta, 1);
                d["stroke-width"] = 0 < a && a || 0;
                d["stroke-dasharray"] = [3, 2];
                d.stroke = b.hashify(c.linecolor);
                d["stroke-opacity"] = c.alpha / 100;
                d["stroke-linejoin"] = c["stroke-linejoin"] = "round";
                d["stroke-linecap"] = c["stroke-linecap"] = "round";
                c.pin = d;
                c.animation = !1;
                c.transposeanimduration = 0 },
            isWithinShape: function(a,
                c, b, h) { if (a) { var g = a.config.anchorProps,
                        f = g.borderThickness,
                        k = this.components.data,
                        l = q(a.config.dragTolerance, 0),
                        m, p;
                    m = a._xPos;
                    p = a._yPos; if (null !== p) return a = a.config.hoverEffects, g = Math.max(g.radius, a && a.anchorRadius || 0, ra) + f / 2, b = Math.sqrt(Math.pow(b - m, 2) + Math.pow(h - p, 2)), b <= g || b <= l ? { pointIndex: c, hovered: !0, pointObj: k[c] } : !1 } },
            draw: function() {
                var a, c, d = !1,
                    h = !1,
                    g = this,
                    k = g.JSONData,
                    l = g.chart,
                    m = l.components,
                    p = g.config,
                    t = g.index || g.positionIndex,
                    r = l.config,
                    x = l.jsonData.chart,
                    z = g.components,
                    u = z.data,
                    B = u.length,
                    y, C = m.paper,
                    A = m.xAxis[0],
                    G = g.yAxis,
                    E, L, N = l.graphics,
                    P = N.datalabelsGroup,
                    Q = b.parseUnsafeString,
                    U = b.getValidValue,
                    R, D, J, M, ba, Z, W, H, X, O = p.linethickness,
                    Y = g.graphics.container,
                    ea = g.graphics.trackerContainer,
                    na = r.viewPortConfig,
                    ma = N.datasetGroup,
                    ia, ra = p.shadow,
                    ha, sa = g.graphics.dataLabelContainer,
                    I = {},
                    oa, la, ta = l.is3D,
                    ua = p.use3dlineshift,
                    ja, pa, va, wa = G.getAxisBase(),
                    xa = G.yBasePos = G.getAxisPosition(wa),
                    Aa = A.getAxisPosition(0),
                    Fa = A.getAxisPosition(1) - Aa,
                    Sa, Ka = ta ? 10 : 0,
                    za = ta && ua ? 10 : 0,
                    aa = [fa(0, r.canvasLeft -
                        Ka), fa(0, r.canvasTop - za), fa(1, r.canvasWidth + 2 * Ka), fa(1, r.canvasHeight + za)],
                    Ta = [fa(0, r.canvasLeft - Ka), fa(0, r.canvasTop - za), 1, fa(1, r.canvasHeight + 2 * za)],
                    qb = {},
                    da = l.hasScroll || !1,
                    Ga, La = p.lineDashStyle,
                    Ma = { color: p.linecolor, alpha: p.alpha };
                [v(Ma), La].join(":");
                var Ua, gb, $a, Pa = g.graphics.lineElement,
                    Va = g.visible,
                    hb, ab, Ha = g.pool || (g.pool = { element: [] }),
                    ib = {},
                    bb = {},
                    jb = {},
                    kb, cb = [],
                    lb, Ca, Wa, Xa, db, eb, rb = r.showTerminalValidData,
                    Qa = r.viewPortConfig,
                    sb = r.showPeakData,
                    mb = r.maxPeakDataLimit,
                    nb = r.minPeakDataLimit,
                    tb = q(r.useCrossline, 0),
                    Ia = Qa.step,
                    fb = A.getPixel(Qa.step) - Aa < Qa.amrd,
                    ob = function(a, c) {
                        var b = a.graphics;
                        la = a.config;
                        M = la.setValue;
                        J = la.setLink;
                        hb = la.x || c;
                        pa = U(Q(f(la.setLevelTooltext, k.plottooltext, x.plottooltext)));
                        la.toolTipValue = G.dataLabels(M);
                        ja = la.showValue;
                        I = la.anchorProps;
                        ha = I.shadow;
                        Z = la.displayValue;
                        ab = la.dip || 0;
                        a || (a = u[c] = { graphics: {} });
                        $a = { color: la.color, alpha: la.alpha };
                        va = la.dashStyle;
                        E = la.xPos || A.getAxisPosition(hb) - Ka;
                        L = g.visible ? G.getAxisPosition(M) + za : xa;
                        ia = la.hoverEffects;
                        I.isAnchorHoverRadius =
                            ia.anchorRadius;
                        kb = A.getLabel(c);
                        R = la.toolText + (pa ? "" : la.toolTipValue);
                        la.finalTooltext = R;
                        ba = { index: c, link: J, value: M, displayValue: Z, categoryLabel: kb, toolText: R, id: p.userID, datasetIndex: t, datasetName: k.seriesname, visible: Va };
                        null === la.setValue || fb || (I.imageUrl ? (oa = new K, oa.onload = g._onAnchorImageLoad(g, c, ba, E, L), oa.onerror = g._onErrorSetter(E, L, c, g), oa.src = I.imageUrl) : (D = b.element, D || (D = Ha.element && Ha.element.length ? b.element = Ha.element.shift() : b.element = C.polypath(Y.anchorGroup)), D.attr({
                            polypath: [I.symbol[1] ||
                                2, E, L, I.radius, I.startAngle, ab
                            ],
                            fill: v({ color: I.bgColor, alpha: I.bgAlpha }),
                            stroke: v({ color: I.borderColor, alpha: I.borderAlpha }),
                            "stroke-width": I.borderThickness,
                            visibility: I.radius ? Va : "hidden"
                        }).shadow(ha, Y.anchorShadowGroup).data("anchorRadius", I.radius).data("anchorHoverRadius", ia.anchorRadius).data("hoverEnabled", ia.enabled).data("eventArgs", ba), ia.enabled && (X = {
                            polypath: [ia.anchorSides || 2, E, L, ia.anchorRadius, ia.startAngle, ia.dip],
                            fill: v({ color: ia.anchorColor, alpha: ia.anchorBgAlpha }),
                            stroke: v({
                                color: ia.anchorBorderColor,
                                alpha: ia.anchorBorderAlpha
                            }),
                            "stroke-width": ia.anchorBorderThickness
                        }, H = { polypath: [I.sides, E, L, I.radius, I.startAngle, ab], fill: v({ color: I.bgColor, alpha: I.bgAlpha }), stroke: v({ color: I.borderColor, alpha: I.borderAlpha }), "stroke-width": I.borderThickness }, D && D.data("setRolloverAttr", X).data("setRolloutAttr", H)), D[M || 0 === M ? "show" : "hide"]()), fa(I.radius, ia && ia.anchorRadius || 0));
                        a._xPos = E;
                        a._yPos = L;
                        [v($a || Ma), va || La].join(":");
                        jb = g.getLinePath([a], jb);
                        Ua = v($a || Ma);
                        gb = va || La;
                        f(la.setColor, la.setAlpha, la.setDashed);
                        [Ua, gb].join(":");
                        ja && !I.imageUrl && g.drawLabel(c);
                        cb.push(a)
                    },
                    ub = function(a, c) { var b = a && a.length,
                            d = a.slice().sort(function(a, c) { return a.config.setValue - c.config.setValue }),
                            e = d && d.pop().config.setValue,
                            g = d.length && d.shift().config.setValue || e,
                            d = 0; if (e > mb || g < nb)
                            for (; d < b;) { D = a[d];
                                e = D.config.setValue; if (e > mb || e < nb) e = c + d, ob(D, e);
                                d += 1 } },
                    Ya = function(c, b) {
                        --c;
                        b += 1;
                        var d;
                        for (y = c; y < b; y += 1)
                            for (d in a = u[y] && u[y].graphics || {}, u[y] && (u[y].config.isRemoving = !0), a) Ha[d] || (Ha[d] = []), a[d] && (Ha[d].push(a[d].hide()),
                                a[d] = void 0)
                    },
                    Za = na.ddsi || 0,
                    Ja = na.ddei || B,
                    Na = p._oldStartIndex,
                    Oa = p._oldEndIndex,
                    vb = p._oldStep,
                    pb = z.removeDataArr,
                    wb = pb && pb.length;
                ma.line = ma.line || C.group("line", ma);
                ma.lineConnector = ma.lineConnector || C.group("line-connector", ma);
                Y || (Y = g.graphics.container = { lineShadowGroup: C.group("connector-shadow", ma.line), anchorShadowGroup: C.group("anchor-shadow", ma.lineConnector), lineGroup: C.group("line", ma.line), anchorGroup: C.group("anchors", ma.lineConnector) }, Y.lineGroup.trackTooltip(!0), Va || (Y.lineShadowGroup.hide(),
                    Y.anchorShadowGroup.hide(), Y.lineGroup.hide(), Y.anchorGroup.hide()));
                ea || (ea = g.graphics.trackerContainer = C.group("line-hot", N.trackerGroup).toBack(), Va || ea.hide());
                u || (u = g.components.data = []);
                sa || (sa = g.graphics.dataLabelContainer = g.graphics.dataLabelContainer || C.group("datalabel", P), Va || sa.hide());
                Sa = Fa * B;
                fb && !p._oldHideAnchors ? Ya(Na, Oa) : Ia !== vb ? Ya(Na, Oa) : (Za > Na && Ya(Na, Za > Oa ? Oa : Za), Ja < Oa && Ya(Ja < Na ? Na : Ja, Oa), (Za < Na || Ja > Oa) && Ya(Na, Oa));
                p._oldHideAnchors = fb;
                p._oldEndIndex = Ja;
                p._oldStep = Ia;
                g.setVisibility(Va);
                for (y = p._oldStartIndex = Za; y <= Ja; y += Ia) {
                    W = u[y] || {};
                    la = W.config || {};
                    la.isRemoving = !1;
                    M = la.setValue || null;
                    Wa = y;
                    if (rb)
                        if (0 === y && null === M) { lb = 0; for (Ca = c = y; Ca < B;)
                                if (null !== u[Ca].config.setValue || d ? d = !0 : Ca++, null === u[c].config.setValue && !h && c <= B ? (c += Ia, lb++) : h = !0, d && h) { d = h = !1; break }
                            0 !== Ca % Ia && (la = u[Ca].config, Wa = Ca) } else if (y >= B && null === M) { for (Ca = c = y; 0 < Ca && (void 0 !== u[Ca] || d ? d = !0 : Ca--, void 0 === u[c] && !h && 0 <= c ? c -= Ia : h = !0, !d || !h););
                        0 !== Ca % Ia && (la = u[Ca].config, Wa = Ca) }
                    if (W = u[Wa]) ob(W, Wa), sb && 1 < Ia && (Xa = qa(y + 1,
                        Ja), eb = qa(Xa + Ia, Ja), db = eb === Ja ? u.slice(Xa) : u.slice(Xa, eb), db.length && ub(db, Xa))
                }
                bb = g.getLinePath(cb, {});
                ib = g.getLinePath(cb, ib);
                p.lastPath = bb;
                Pa || (Pa = Ha.lineElement && Ha.lineElement.length ? g.graphics.lineElement = Ha.lineElement.shift() : g.graphics.lineElement = C.path(Y.lineGroup));
                tb || Pa.tooltipListenerAttached || (Pa.tooltipListenerAttached = !0, Pa.mousemove(function(a) {
                    Qa = r.viewPortConfig;
                    var c = r._visx,
                        b = Qa.step,
                        d = Qa.ppp * b,
                        c = ka(l.linkedItems.container, a, l).chartX - c,
                        e;
                    a = r.tooltipSepChar;
                    c = (c += d / 2 + Qa.offset) -
                        c % d;
                    e = (e = l.getValuePixel(c)) + e % b;
                    b = A.getLabel(e).label + a + g.components.data[e].config.formatedVal;
                    b = p.seriesname && p.seriesname + a + b || b;
                    Pa.tooltip(0 === r.crossline.enabled ? b : !1)
                }));
                Pa.attr({ path: bb.getPathArr(), "stroke-dasharray": La, "stroke-width": O, stroke: v(Ma), "stroke-linecap": "round", "stroke-linejoin": 2 <= O ? "round" : "miter" }).shadow(ra, Y.lineShadowGroup);
                da && (Ga = qb.startPercent, aa[2] = Sa + Ta[0], 1 === Ga && (Ta[0] = aa[2], aa[0] = 0));
                aa[3] += za;
                g.drawn = !0;
                wb && g.remove()
            },
            setVisibility: function(a, c) {
                var b = this.graphics,
                    h = b && b.container,
                    g = b && b.trackerContainer,
                    b = b && b.dataLabelContainer,
                    f = a ? "show" : "hide";
                h.lineGroup[f]();
                h.anchorGroup[f]();
                h.anchorShadowGroup[f]();
                h.lineShadowGroup[f]();
                g[f]();
                b[f]();
                c && this.transposeLimits(a)
            },
            transposeLimits: function(a) { var c = this.chart,
                    b = c.config,
                    h = this.yAxis;
                c._chartAnimation();
                this.visible = a;
                this._conatinerHidden = !a;
                c._setAxisLimits();
                h.draw();
                b.legendClicked = !0;
                c._drawDataset();
                delete b.legendClicked },
            hide: function() { this.setVisibility(!1, !0) },
            show: function() {
                this.setVisibility(!0, !0)
            }
        }, "Line"]);
        r = function() {};
        r.prototype.configure = function(a, c) {
            var b, h, g, f = {},
                k = this,
                p = a.components,
                q = p.numberFormatter,
                r = p.paper,
                t = a.config;
            b = a.graphics;
            h = this.left = t._visx;
            g = this.top = t.canvasTop;
            var v = this.height = t.canvasHeight,
                y = this._visout = t._visout,
                u = this.plots = a.components.dataset,
                B = b.datalabelsGroup,
                z, C, A = c.labelstyle,
                E = c.valuestyle,
                G = p.yAxis[0],
                K = G.getLimit(),
                L = p.yAxis[1],
                N = L && L.getLimit();
            C = this.tracker;
            var p = this.labels,
                P = this.positionLabel;
            z = a.get("linkedItems");
            var Q = z.container,
                R =
                z.eventListeners || (z.eventListeners = []);
            k.width = t._visw;
            z = this.group;
            z || (z = this.group = r.group("crossline-labels", B), this.container = Q);
            z.attr({ transform: ["T", h, t._ymin] }).css(E);
            C || (C = k.tracker = Q, R.push(l(Q, "touchstart mousemove", function(c) { var b = k.onMouseMove,
                    d = k.onMouseOut;
                a.isWithinCanvas(c, a).insideCanvas ? b.call(k, c) : d.call(k, c) }, k)), R.push(l(Q, "mousedown", function() { k.onMouseDown() }, k)), R.push(l(Q, "mouseup", function() { k.onMouseUp() }, k)), R.push(l(Q, "mouseout", function() { k.onMouseOut() }, k)));
            C =
                this.line;
            C || (C = this.line = r.path(B).toBack());
            C.attr(x({ path: ["M", h, g, "l", 0, v] }, c.line));
            p || (p = this.labels = c.valueEnabled && r.set());
            c.labelEnabled ? (f.x = y, f.y = g + v + (t.scrollHeight || 0) + 2.5, f["vertical-align"] = "top", f.direction = t.textDirection, f.text = "", P ? (P.attr(f), P.css(A)) : P = this.positionLabel = r.text(f, A, b.datalabelsGroup).insertBefore(b.datasetGroup)) : (P && P.remove(), delete this.positionLabel);
            this.hide();
            this.ppixelRatio = -G.getPVR();
            this.spixelRatio = L && -L.getPVR();
            this.yminValue = t._yminValue;
            this.pyaxisminvalue =
                K.min;
            this.pyaxismaxvalue = K.max;
            this.syaxisminvalue = N && N.min;
            this.syaxismaxvalue = N && N.max;
            this.positionLabels = t.xlabels || { data: [], parsed: [] };
            this.chart = a;
            this.getZoomInfo = function() { return t.viewPortConfig };
            this.getDataIndexFromPixel = function(c) { return Math.round(a.components.xAxis[0].getValue(c)) };
            this.getPositionLabel = function(c) { return (c = a.components.xAxis[0].getLabel(c)) && c.label || "" };
            if (c.valueEnabled) {
                b = 0;
                for (h = u.length; b < h; b += 1) g = u[b], g = m(g.config.linecolor), f.x = 0, f.y = y, f.fill = g, f.direction =
                    t.textDirection, f.text = "", f["text-bound"] = E["text-bound"], f.lineHeight = E.lineHeight, p[b] ? p[b].attr(f) : p[b] = p.items[b] = r.text(f, void 0, z);
                for (; b < p.items.length; b += 1) p[b].remove(), delete p[b], p.items.splice(b, 1);
                this.numberFormatter = q
            } else if (p.items && p.items.length) { for (b = 0; b < p.items.length; b += 1) p[b].remove(), delete p[b];
                p.length = 0 }
        };
        r.prototype.disable = function(a) { void 0 !== a && (this.disabled = !!a) && this.visible && this.hide(); return this.disabled };
        r.prototype.onMouseOut = function() {
            this.hide();
            this.position =
                void 0
        };
        r.prototype.onMouseDown = function() {!z && this.hide();
            this._mouseIsDown = !0 };
        r.prototype.onMouseUp = function() {!z && this.hide();
            delete this._mouseIsDown };
        r.prototype.onMouseMove = function(a) {
            if (!(this.disabled || this._mouseIsDown && !z)) {
                var c, b = this.getZoomInfo(),
                    h = this.line,
                    g = this.left,
                    b = b.step,
                    f = this.chart,
                    k = f.components.xAxis[0],
                    l = f.get("config"),
                    m = l.canvasLeft,
                    p = k.getAxisConfig("axisDimention");
                a = ka(this.container, a, f).chartX - g;
                var g = k._getVisibleConfig(),
                    p = p.x - m,
                    q;
                q = (q = this.getDataIndexFromPixel(P(a))) +
                    ((c = q % b) > b / 2 ? b - c : -c);
                a = k.getPixel(q) - p - m;
                h.transform(["T", P(a), 0]);
                this.hidden && 0 !== l.crossline.enabled && this.show();
                (q < g.minValue || q > g.maxValue) && this.hide();
                if (q !== this.position || this.hidden) this.position = q, this.lineX = a, this.updateLabels()
            }
        };
        r.prototype.updateLabels = function() {
            var a = this,
                c = a.labels,
                b = a.plots,
                f = a.width,
                g = a.position,
                h = a.lineX,
                k = ua(h),
                l = a.ppixelRatio,
                m = a.spixelRatio,
                p = a.yminValue,
                q = a._visout,
                r = a.numberFormatter,
                t = a.pyaxisminvalue,
                u = a.pyaxismaxvalue,
                v = a.syaxisminvalue,
                y = a.syaxismaxvalue,
                x = function() {
                    function c() { this.y = 0;
                        this.lRef = void 0;
                        this.__index = this.__shift = 0 }

                    function b(a) { for (var c = 0; c < a;) this.push(c++); return this }

                    function d(a) { var c, b, e, g = {},
                            f = Number.POSITIVE_INFINITY; for (c = 0; c < this.length; c++) b = this[c] - a, 0 > b ? e = v.NEG : e = v.POS, b = t(b), b <= f && (f = b, g.absValue = b, g.noScaleSide = e); return g }

                    function g(a) { this.holes = b.call([], a) }
                    var f = -1 * a.height,
                        h = p * l,
                        k = 0,
                        n, m = {},
                        r, t = Math.abs,
                        u = Math.floor,
                        v = {};
                    "function" != typeof Object.create && (Object.create = function() {
                        function a() {}
                        var c = Object.prototype.hasOwnProperty;
                        return function(b) { var d, e, g; if ("object" != typeof b) throw new TypeError("Object prototype may only be an Object or null");
                            a.prototype = b;
                            g = new a;
                            a.prototype = null; if (1 < arguments.length)
                                for (e in d = Object(arguments[1]), d) c.call(d, e) && (g[e] = d[e]); return g }
                    }());
                    Array.prototype.indexOf || (Array.prototype.indexOf = function(a, c) {
                        var b, d, e;
                        if (null == this) throw new TypeError('"this" is null or not defined');
                        d = Object(this);
                        e = d.length >>> 0;
                        if (0 === e) return -1;
                        b = +c || 0;
                        Infinity === Math.abs(b) && (b = 0);
                        if (b >= e) return -1;
                        for (b =
                            Math.max(0 <= b ? b : e - Math.abs(b), 0); b < e;) { if (b in d && d[b] === a) return b;
                            b++ }
                        return -1
                    });
                    Array.prototype.forEach || (Array.prototype.forEach = function(a, c) { var b, d, e, g, f; if (null == this) throw new TypeError(" this is null or not defined");
                        e = Object(this);
                        g = e.length >>> 0; if ("function" !== typeof a) throw new TypeError(a + " is not a function");
                        1 < arguments.length && (b = c); for (d = 0; d < g;) d in e && (f = e[d], a.call(b, f, d, e)), d++ });
                    c.prototype.constructor = c;
                    c.prototype.applyShift = function(a) {
                        this.__shift = a;
                        this.lRef.calcY = this.y +=
                            a * k
                    };
                    c.prototype.applyDirectIndex = function(a) { this.__index = a;
                        this.lRef.calcY = this.y = f - a * k * -1 };
                    try { Object.defineProperty(v, "POS", { enumerable: !1, configurable: !1, get: function() { return 1 } }), Object.defineProperty(v, "NEG", { enumerable: !1, configurable: !1, get: function() { return -1 } }) } catch (x) { v.POS = 1, v.NEG = -1 }
                    g.prototype = Object.create(Array.prototype);
                    g.prototype.constructor = g;
                    g.prototype.repositionHoles = function() { var a, c = 0,
                            b; for (a = this.holes.length = 0; a < this.length; a++) b = this[a], !b && (this.holes[c++] = a) };
                    g.prototype.attachShift =
                        function(a, b, e) {
                            var g, f = this.length;
                            if (a === q) e.calcY = q;
                            else if (f = b > f - 1 ? f - 1 : b, g = this[f], b = new c, b.y = a, b.lRef = e, g) {
                                a = d.call(this.holes, f);
                                e = f + a.absValue * a.noScaleSide;
                                if (a.noScaleSide === v.POS) return b.applyDirectIndex(e), this.splice(e, 1, b), this.holes.splice(this.holes.indexOf(e), 1), e;
                                if (a.noScaleSide === v.NEG) {
                                    a = this.splice(e + 1, this.length - 1);
                                    this.pop();
                                    a.forEach(function(a) { a && a.applyShift(-1) });
                                    for ([].push.apply(this, a); this[e];) e++;
                                    this.push(0);
                                    this.repositionHoles();
                                    a = d.call(this.holes, e);
                                    e += a.absValue *
                                        a.noScaleSide;
                                    b.applyDirectIndex(e);
                                    this.splice(e, 1, b);
                                    this.repositionHoles();
                                    return this.length - 1
                                }
                            } else b.applyDirectIndex(f), this.splice(f, 1, b), this.holes.splice(this.holes.indexOf(f), 1)
                        };
                    try { Object.defineProperty(m, "top", { enumerable: !1, configurable: !1, get: function() { return f } }), Object.defineProperty(m, "bottom", { enumerable: !1, configurable: !1, get: function() { return h } }) } catch (x) { m.top = f, m.bottom = h }
                    m.init = function(a, c) { var b;
                        k = a + 2;
                        f += k / 2;
                        r = u(t(f) / k);
                        n = new g(r); for (b = 0; b < r; b++) n.push(0) };
                    m.occupy = function(a,
                        c) { var b = u(t(f - a) / k);
                        n && n.attachShift(a, b, c) };
                    return m
                }();
            c && (c[0] && c[0].attr({ text: r.yAxis("0") }), c[0] && x.init(c[0].getBBox().height, c.length), c.forEach(function(a, c) { var e = b[c],
                    f = e.components.data[g] && e.components.data[g].config.setValue,
                    h = e.config.parentYAxis;
                x.occupy(void 0 === f || !e.visible || (h ? f > y || f < v : f > u || f < t) ? q : h ? (f - v) * m : (f - t) * l, a) }));
            c && c.forEach(function(a, c) {
                var e = b[c],
                    l, m;
                (e = r[e.config.parentYAxis ? "sYAxis" : "yAxis"](e.components.data[g] && e.components.data[g].config.setValue)) ? (a.attr({ text: e }),
                    e = (e = (e = (e = a.getBBox()) && e.width) && .5 * e) && e + 10, m = a.calcY, l = fa(0, qa(k, f)), void 0 !== m && void 0 !== l && a.attr({ x: l, y: m, "text-anchor": h <= e && "start" || h + e >= f && "end" || "middle", "text-bound": ["rgba(255,255,255,0.8)", "rgba(0,0,0,0.2)", 1, 2.5] })) : a.attr({ x: -f })
            });
            a.positionLabel && a.positionLabel.attr({ x: h + a.left, text: a.getPositionLabel(g), "text-bound": ["rgba(255,255,255,1)", "rgba(0,0,0,1)", 1, 2.5] })
        };
        r.prototype.show = function() {
            this.disabled || (this.hidden = !1, this.group.attr("visibility", "visible"), this.line.attr("visibility",
                "visible"), this.positionLabel && this.positionLabel.attr("visibility", "visible"))
        };
        r.prototype.hide = function() { this.hidden = !0;
            this.group.attr("visibility", "hidden");
            this.line.attr("visibility", "hidden");
            this.positionLabel && this.positionLabel.attr("visibility", "hidden") };
        r.prototype.dispose = function() { for (var a in this) this.hasOwnProperty(a) && delete this[a] };
        E.addSymbol({
            pinModeIcon: function(a, c, b) {
                var f = .5 * b,
                    g = a - b,
                    h = a + b,
                    k = a - f,
                    l = a + f,
                    m = a + .5,
                    p = m + 1,
                    q = m + 1.5,
                    r = c - b,
                    t = c + f,
                    u = c - f,
                    f = c + (b - f);
                return ["M", g, r, "L",
                    k, u, k, f, g, t, a - .5, t, a, c + b + .5, m, t, h, t, l, f, l, u, h, r, q, r, q, u, q, f, p, f, p, u, q, u, q, r, "Z"
                ]
            },
            zoomOutIcon: function(a, c, b) { a -= .2 * b;
                c -= .2 * b; var f = .8 * b,
                    g = E.rad(43),
                    h = E.rad(48),
                    k = a + f * wa(g),
                    g = c + f * ta(g),
                    l = a + f * wa(h),
                    h = c + f * ta(h),
                    m = E.rad(45),
                    p = k + b * wa(m),
                    q = g + b * ta(m),
                    r = l + b * wa(m);
                b = h + b * ta(m); return ["M", k, g, "A", f, f, 0, 1, 0, l, h, "Z", "M", k + 1, g + 1, "L", p, q, r, b, l + 1, h + 1, "Z", "M", a - 2, c, "L", a + 2, c, "Z"] },
            resetIcon: function(a, b, d) {
                var f = a - d,
                    g = (ba.PI / 2 + ba.PI) / 2;
                a += d * wa(g);
                var g = b + d * ta(g),
                    h = 2 * d / 3;
                return ["M", f, b, "A", d, d, 0, 1, 1, a, g, "L", a + h, g -
                    1, a + 2, g + h - .5, a, g
                ]
            }
        })
    }])
});

//# sourceMappingURL=http://localhost:3052/3.12.2/map/eval/fusioncharts.charts.js.map