/*
 Highcharts JS v6.0.4 (2017-12-15)

 3D features for Highcharts JS

 @license: www.highcharts.com/license
*/
(function(C) { "object" === typeof module && module.exports ? module.exports = C : C(Highcharts) })(function(C) {
    (function(c) {
        var q = c.deg2rad,
            u = c.pick;
        c.perspective = function(p, y, B) {
            var v = y.options.chart.options3d,
                h = B ? y.inverted : !1,
                z = y.plotWidth / 2,
                t = y.plotHeight / 2,
                A = v.depth / 2,
                e = u(v.depth, 1) * u(v.viewDistance, 0),
                b = y.scale3d || 1,
                f = q * v.beta * (h ? -1 : 1),
                v = q * v.alpha * (h ? -1 : 1),
                k = Math.cos(v),
                d = Math.cos(-f),
                a = Math.sin(v),
                m = Math.sin(-f);
            B || (z += y.plotLeft, t += y.plotTop);
            return c.map(p, function(c) {
                var f, l;
                l = (h ? c.y : c.x) - z;
                var r = (h ?
                        c.x : c.y) - t,
                    x = (c.z || 0) - A;
                f = d * l - m * x;
                c = -a * m * l + k * r - d * a * x;
                l = k * m * l + a * r + k * d * x;
                r = 0 < e && e < Number.POSITIVE_INFINITY ? e / (l + A + e) : 1;
                f = f * r * b + z;
                c = c * r * b + t;
                return { x: h ? c : f, y: h ? f : c, z: l * b + A }
            })
        };
        c.pointCameraDistance = function(c, y) { var p = y.options.chart.options3d,
                v = y.plotWidth / 2;
            y = y.plotHeight / 2;
            p = u(p.depth, 1) * u(p.viewDistance, 0) + p.depth; return Math.sqrt(Math.pow(v - c.plotX, 2) + Math.pow(y - c.plotY, 2) + Math.pow(p - c.plotZ, 2)) };
        c.shapeArea = function(c) {
            var y = 0,
                p, v;
            for (p = 0; p < c.length; p++) v = (p + 1) % c.length, y += c[p].x * c[v].y - c[v].x *
                c[p].y;
            return y / 2
        };
        c.shapeArea3d = function(p, y, u) { return c.shapeArea(c.perspective(p, y, u)) }
    })(C);
    (function(c) {
        function q(b, d, a, c, e, f, l, m) {
            var g = [],
                r = f - e;
            return f > e && f - e > Math.PI / 2 + .0001 ? (g = g.concat(q(b, d, a, c, e, e + Math.PI / 2, l, m)), g = g.concat(q(b, d, a, c, e + Math.PI / 2, f, l, m))) : f < e && e - f > Math.PI / 2 + .0001 ? (g = g.concat(q(b, d, a, c, e, e - Math.PI / 2, l, m)), g = g.concat(q(b, d, a, c, e - Math.PI / 2, f, l, m))) : ["C", b + a * Math.cos(e) - a * w * r * Math.sin(e) + l, d + c * Math.sin(e) + c * w * r * Math.cos(e) + m, b + a * Math.cos(f) + a * w * r * Math.sin(f) + l, d + c * Math.sin(f) -
                c * w * r * Math.cos(f) + m, b + a * Math.cos(f) + l, d + c * Math.sin(f) + m
            ]
        }
        var u = Math.cos,
            p = Math.PI,
            y = Math.sin,
            B = c.animObject,
            v = c.charts,
            h = c.color,
            z = c.defined,
            t = c.deg2rad,
            A = c.each,
            e = c.extend,
            b = c.inArray,
            f = c.map,
            k = c.merge,
            d = c.perspective,
            a = c.pick,
            m = c.SVGElement,
            l = c.SVGRenderer,
            n = c.wrap,
            w = 4 * (Math.sqrt(2) - 1) / 3 / (p / 2);
        l.prototype.toLinePath = function(b, d) { var a = [];
            A(b, function(b) { a.push("L", b.x, b.y) });
            b.length && (a[0] = "M", d && a.push("Z")); return a };
        l.prototype.toLineSegments = function(b) {
            var d = [],
                a = !0;
            A(b, function(b) {
                d.push(a ?
                    "M" : "L", b.x, b.y);
                a = !a
            });
            return d
        };
        l.prototype.face3d = function(b) {
            var e = this,
                g = this.createElement("path");
            g.vertexes = [];
            g.insidePlotArea = !1;
            g.enabled = !0;
            n(g, "attr", function(b, g) {
                if ("object" === typeof g && (z(g.enabled) || z(g.vertexes) || z(g.insidePlotArea))) {
                    this.enabled = a(g.enabled, this.enabled);
                    this.vertexes = a(g.vertexes, this.vertexes);
                    this.insidePlotArea = a(g.insidePlotArea, this.insidePlotArea);
                    delete g.enabled;
                    delete g.vertexes;
                    delete g.insidePlotArea;
                    var f = d(this.vertexes, v[e.chartIndex], this.insidePlotArea),
                        l = e.toLinePath(f, !0),
                        f = c.shapeArea(f),
                        f = this.enabled && 0 < f ? "visible" : "hidden";
                    g.d = l;
                    g.visibility = f
                }
                return b.apply(this, [].slice.call(arguments, 1))
            });
            n(g, "animate", function(b, g) {
                if ("object" === typeof g && (z(g.enabled) || z(g.vertexes) || z(g.insidePlotArea))) {
                    this.enabled = a(g.enabled, this.enabled);
                    this.vertexes = a(g.vertexes, this.vertexes);
                    this.insidePlotArea = a(g.insidePlotArea, this.insidePlotArea);
                    delete g.enabled;
                    delete g.vertexes;
                    delete g.insidePlotArea;
                    var f = d(this.vertexes, v[e.chartIndex], this.insidePlotArea),
                        l = e.toLinePath(f, !0),
                        f = c.shapeArea(f),
                        f = this.enabled && 0 < f ? "visible" : "hidden";
                    g.d = l;
                    this.attr("visibility", f)
                }
                return b.apply(this, [].slice.call(arguments, 1))
            });
            return g.attr(b)
        };
        l.prototype.polyhedron = function(b) {
            var d = this,
                a = this.g(),
                e = a.destroy;
            a.attr({ "stroke-linejoin": "round" });
            a.faces = [];
            a.destroy = function() { for (var b = 0; b < a.faces.length; b++) a.faces[b].destroy(); return e.call(this) };
            n(a, "attr", function(b, g, e, c, f) {
                if ("object" === typeof g && z(g.faces)) {
                    for (; a.faces.length > g.faces.length;) a.faces.pop().destroy();
                    for (; a.faces.length < g.faces.length;) a.faces.push(d.face3d().add(a));
                    for (var l = 0; l < g.faces.length; l++) a.faces[l].attr(g.faces[l], null, c, f);
                    delete g.faces
                }
                return b.apply(this, [].slice.call(arguments, 1))
            });
            n(a, "animate", function(b, g, e, c) {
                if (g && g.faces) { for (; a.faces.length > g.faces.length;) a.faces.pop().destroy(); for (; a.faces.length < g.faces.length;) a.faces.push(d.face3d().add(a)); for (var f = 0; f < g.faces.length; f++) a.faces[f].animate(g.faces[f], e, c);
                    delete g.faces }
                return b.apply(this, [].slice.call(arguments,
                    1))
            });
            return a.attr(b)
        };
        l.prototype.cuboid = function(b) {
            var a = this.g(),
                d = a.destroy;
            b = this.cuboidPath(b);
            a.attr({ "stroke-linejoin": "round" });
            a.front = this.path(b[0]).attr({ "class": "highcharts-3d-front" }).add(a);
            a.top = this.path(b[1]).attr({ "class": "highcharts-3d-top" }).add(a);
            a.side = this.path(b[2]).attr({ "class": "highcharts-3d-side" }).add(a);
            a.fillSetter = function(b) {
                this.front.attr({ fill: b });
                this.top.attr({ fill: h(b).brighten(.1).get() });
                this.side.attr({ fill: h(b).brighten(-.1).get() });
                this.color = b;
                a.fill =
                    b;
                return this
            };
            a.opacitySetter = function(a) { this.front.attr({ opacity: a });
                this.top.attr({ opacity: a });
                this.side.attr({ opacity: a }); return this };
            a.attr = function(a, b, d, g) { if ("string" === typeof a && "undefined" !== typeof b) { var e = a;
                    a = {};
                    a[e] = b } if (a.shapeArgs || z(a.x)) a = this.renderer.cuboidPath(a.shapeArgs || a), this.front.attr({ d: a[0] }), this.top.attr({ d: a[1] }), this.side.attr({ d: a[2] });
                else return m.prototype.attr.call(this, a, void 0, d, g); return this };
            a.animate = function(a, b, d) {
                z(a.x) && z(a.y) ? (a = this.renderer.cuboidPath(a),
                    this.front.animate({ d: a[0] }, b, d), this.top.animate({ d: a[1] }, b, d), this.side.animate({ d: a[2] }, b, d), this.attr({ zIndex: -a[3] })) : a.opacity ? (this.front.animate(a, b, d), this.top.animate(a, b, d), this.side.animate(a, b, d)) : m.prototype.animate.call(this, a, b, d);
                return this
            };
            a.destroy = function() { this.front.destroy();
                this.top.destroy();
                this.side.destroy(); return d.call(this) };
            a.attr({ zIndex: -b[3] });
            return a
        };
        c.SVGRenderer.prototype.cuboidPath = function(a) {
            function b(a) { return p[a] }
            var g = a.x,
                e = a.y,
                l = a.z,
                m = a.height,
                k = a.width,
                r = a.depth,
                A = v[this.chartIndex],
                n, t, w = A.options.chart.options3d.alpha,
                h = 0,
                p = [{ x: g, y: e, z: l }, { x: g + k, y: e, z: l }, { x: g + k, y: e + m, z: l }, { x: g, y: e + m, z: l }, { x: g, y: e + m, z: l + r }, { x: g + k, y: e + m, z: l + r }, { x: g + k, y: e, z: l + r }, { x: g, y: e, z: l + r }],
                p = d(p, A, a.insidePlotArea);
            t = function(a, d) { var g = [
                    [], -1
                ];
                a = f(a, b);
                d = f(d, b);
                0 > c.shapeArea(a) ? g = [a, 0] : 0 > c.shapeArea(d) && (g = [d, 1]); return g };
            n = t([3, 2, 1, 0], [7, 6, 5, 4]);
            a = n[0];
            k = n[1];
            n = t([1, 6, 7, 0], [4, 5, 2, 3]);
            m = n[0];
            r = n[1];
            n = t([1, 2, 5, 6], [0, 7, 4, 3]);
            t = n[0];
            n = n[1];
            1 === n ? h += 1E4 * (1E3 - g) : n ||
                (h += 1E4 * g);
            h += 10 * (!r || 0 <= w && 180 >= w || 360 > w && 357.5 < w ? A.plotHeight - e : 10 + e);
            1 === k ? h += 100 * l : k || (h += 100 * (1E3 - l));
            h = -Math.round(h);
            return [this.toLinePath(a, !0), this.toLinePath(m, !0), this.toLinePath(t, !0), h]
        };
        c.SVGRenderer.prototype.arc3d = function(d) {
            function c(a) { var d = !1,
                    g = {};
                a = k(a); for (var e in a) - 1 !== b(e, l) && (g[e] = a[e], delete a[e], d = !0); return d ? g : !1 }
            var g = this.g(),
                f = g.renderer,
                l = "x y r innerR start end".split(" ");
            d = k(d);
            d.alpha *= t;
            d.beta *= t;
            g.top = f.path();
            g.side1 = f.path();
            g.side2 = f.path();
            g.inn = f.path();
            g.out = f.path();
            g.onAdd = function() { var a = g.parentGroup,
                    b = g.attr("class");
                g.top.add(g);
                A(["out", "inn", "side1", "side2"], function(d) { g[d].attr({ "class": b + " highcharts-3d-side" }).add(a) }) };
            A(["addClass", "removeClass"], function(a) { g[a] = function() { var b = arguments;
                    A(["top", "out", "inn", "side1", "side2"], function(d) { g[d][a].apply(g[d], b) }) } });
            g.setPaths = function(a) {
                var b = g.renderer.arc3dPath(a),
                    d = 100 * b.zTop;
                g.attribs = a;
                g.top.attr({ d: b.top, zIndex: b.zTop });
                g.inn.attr({ d: b.inn, zIndex: b.zInn });
                g.out.attr({
                    d: b.out,
                    zIndex: b.zOut
                });
                g.side1.attr({ d: b.side1, zIndex: b.zSide1 });
                g.side2.attr({ d: b.side2, zIndex: b.zSide2 });
                g.zIndex = d;
                g.attr({ zIndex: d });
                a.center && (g.top.setRadialReference(a.center), delete a.center)
            };
            g.setPaths(d);
            g.fillSetter = function(a) { var b = h(a).brighten(-.1).get();
                this.fill = a;
                this.side1.attr({ fill: b });
                this.side2.attr({ fill: b });
                this.inn.attr({ fill: b });
                this.out.attr({ fill: b });
                this.top.attr({ fill: a }); return this };
            A(["opacity", "translateX", "translateY", "visibility"], function(a) {
                g[a + "Setter"] = function(a,
                    b) { g[b] = a;
                    A(["out", "inn", "side1", "side2", "top"], function(d) { g[d].attr(b, a) }) }
            });
            n(g, "attr", function(a, b) { var d; "object" === typeof b && (d = c(b)) && (e(g.attribs, d), g.setPaths(g.attribs)); return a.apply(this, [].slice.call(arguments, 1)) });
            n(g, "animate", function(b, d, e, f) {
                var l, m = this.attribs,
                    r;
                delete d.center;
                delete d.z;
                delete d.depth;
                delete d.alpha;
                delete d.beta;
                r = B(a(e, this.renderer.globalAnimation));
                r.duration && (l = c(d), d.dummy = g.dummy++, l && (r.step = function(b, d) {
                    function g(b) {
                        return m[b] + (a(l[b], m[b]) - m[b]) *
                            d.pos
                    }
                    "dummy" === d.prop && d.elem.setPaths(k(m, { x: g("x"), y: g("y"), r: g("r"), innerR: g("innerR"), start: g("start"), end: g("end") }))
                }), e = r);
                return b.call(this, d, e, f)
            });
            g.dummy = 0;
            g.destroy = function() { this.top.destroy();
                this.out.destroy();
                this.inn.destroy();
                this.side1.destroy();
                this.side2.destroy();
                m.prototype.destroy.call(this) };
            g.hide = function() { this.top.hide();
                this.out.hide();
                this.inn.hide();
                this.side1.hide();
                this.side2.hide() };
            g.show = function() {
                this.top.show();
                this.out.show();
                this.inn.show();
                this.side1.show();
                this.side2.show()
            };
            return g
        };
        l.prototype.arc3dPath = function(a) {
            function b(a) { a %= 2 * Math.PI;
                a > Math.PI && (a = 2 * Math.PI - a); return a }
            var d = a.x,
                e = a.y,
                c = a.start,
                f = a.end - .00001,
                l = a.r,
                m = a.innerR,
                k = a.depth,
                n = a.alpha,
                t = a.beta,
                A = Math.cos(c),
                w = Math.sin(c);
            a = Math.cos(f);
            var r = Math.sin(f),
                h = l * Math.cos(t),
                l = l * Math.cos(n),
                v = m * Math.cos(t),
                z = m * Math.cos(n),
                m = k * Math.sin(t),
                B = k * Math.sin(n),
                k = ["M", d + h * A, e + l * w],
                k = k.concat(q(d, e, h, l, c, f, 0, 0)),
                k = k.concat(["L", d + v * a, e + z * r]),
                k = k.concat(q(d, e, v, z, f, c, 0, 0)),
                k = k.concat(["Z"]),
                C =
                0 < t ? Math.PI / 2 : 0,
                t = 0 < n ? 0 : Math.PI / 2,
                C = c > -C ? c : f > -C ? -C : c,
                D = f < p - t ? f : c < p - t ? p - t : f,
                E = 2 * p - t,
                n = ["M", d + h * u(C), e + l * y(C)],
                n = n.concat(q(d, e, h, l, C, D, 0, 0));
            f > E && c < E ? (n = n.concat(["L", d + h * u(D) + m, e + l * y(D) + B]), n = n.concat(q(d, e, h, l, D, E, m, B)), n = n.concat(["L", d + h * u(E), e + l * y(E)]), n = n.concat(q(d, e, h, l, E, f, 0, 0)), n = n.concat(["L", d + h * u(f) + m, e + l * y(f) + B]), n = n.concat(q(d, e, h, l, f, E, m, B)), n = n.concat(["L", d + h * u(E), e + l * y(E)]), n = n.concat(q(d, e, h, l, E, D, 0, 0))) : f > p - t && c < p - t && (n = n.concat(["L", d + h * Math.cos(D) + m, e + l * Math.sin(D) + B]), n = n.concat(q(d,
                e, h, l, D, f, m, B)), n = n.concat(["L", d + h * Math.cos(f), e + l * Math.sin(f)]), n = n.concat(q(d, e, h, l, f, D, 0, 0)));
            n = n.concat(["L", d + h * Math.cos(D) + m, e + l * Math.sin(D) + B]);
            n = n.concat(q(d, e, h, l, D, C, m, B));
            n = n.concat(["Z"]);
            t = ["M", d + v * A, e + z * w];
            t = t.concat(q(d, e, v, z, c, f, 0, 0));
            t = t.concat(["L", d + v * Math.cos(f) + m, e + z * Math.sin(f) + B]);
            t = t.concat(q(d, e, v, z, f, c, m, B));
            t = t.concat(["Z"]);
            A = ["M", d + h * A, e + l * w, "L", d + h * A + m, e + l * w + B, "L", d + v * A + m, e + z * w + B, "L", d + v * A, e + z * w, "Z"];
            d = ["M", d + h * a, e + l * r, "L", d + h * a + m, e + l * r + B, "L", d + v * a + m, e + z * r + B, "L", d + v *
                a, e + z * r, "Z"
            ];
            r = Math.atan2(B, -m);
            e = Math.abs(f + r);
            a = Math.abs(c + r);
            c = Math.abs((c + f) / 2 + r);
            e = b(e);
            a = b(a);
            c = b(c);
            c *= 1E5;
            f = 1E5 * a;
            e *= 1E5;
            return { top: k, zTop: 1E5 * Math.PI + 1, out: n, zOut: Math.max(c, f, e), inn: t, zInn: Math.max(c, f, e), side1: A, zSide1: .99 * e, side2: d, zSide2: .99 * f }
        }
    })(C);
    (function(c) {
        function q(c, A) {
            var e = c.plotLeft,
                b = c.plotWidth + e,
                f = c.plotTop,
                k = c.plotHeight + f,
                d = e + c.plotWidth / 2,
                a = f + c.plotHeight / 2,
                m = Number.MAX_VALUE,
                l = -Number.MAX_VALUE,
                n = Number.MAX_VALUE,
                t = -Number.MAX_VALUE,
                h, x = 1;
            h = [{ x: e, y: f, z: 0 }, {
                x: e,
                y: f,
                z: A
            }];
            p([0, 1], function(a) { h.push({ x: b, y: h[a].y, z: h[a].z }) });
            p([0, 1, 2, 3], function(a) { h.push({ x: h[a].x, y: k, z: h[a].z }) });
            h = B(h, c, !1);
            p(h, function(a) { m = Math.min(m, a.x);
                l = Math.max(l, a.x);
                n = Math.min(n, a.y);
                t = Math.max(t, a.y) });
            e > m && (x = Math.min(x, 1 - Math.abs((e + d) / (m + d)) % 1));
            b < l && (x = Math.min(x, (b - d) / (l - d)));
            f > n && (x = 0 > n ? Math.min(x, (f + a) / (-n + f + a)) : Math.min(x, 1 - (f + a) / (n + a) % 1));
            k < t && (x = Math.min(x, Math.abs((k - a) / (t - a))));
            return x
        }
        var u = c.Chart,
            p = c.each,
            y = c.merge,
            B = c.perspective,
            v = c.pick,
            h = c.wrap;
        u.prototype.is3d =
            function() { return this.options.chart.options3d && this.options.chart.options3d.enabled };
        u.prototype.propsRequireDirtyBox.push("chart.options3d");
        u.prototype.propsRequireUpdateSeries.push("chart.options3d");
        h(u.prototype, "initSeries", function(c, h) { var e = h.type || this.options.chart.type || this.options.chart.defaultSeriesType;
            this.is3d() && "scatter" === e && (h.type = "scatter3d"); return c.call(this, h) });
        c.wrap(c.Chart.prototype, "isInsidePlot", function(c) {
            return this.is3d() || c.apply(this, [].slice.call(arguments,
                1))
        });
        var z = c.getOptions();
        y(!0, z, { chart: { options3d: { enabled: !1, alpha: 0, beta: 0, depth: 100, fitToPlot: !0, viewDistance: 25, axisLabelPosition: "default", frame: { visible: "default", size: 1, bottom: {}, top: {}, left: {}, right: {}, back: {}, front: {} } } } });
        h(u.prototype, "setClassName", function(c) { c.apply(this, [].slice.call(arguments, 1));
            this.is3d() && (this.container.className += " highcharts-3d-chart") });
        c.wrap(c.Chart.prototype, "setChartSize", function(c) {
            var h = this.options.chart.options3d;
            c.apply(this, [].slice.call(arguments,
                1));
            if (this.is3d()) { var e = this.inverted,
                    b = this.clipBox,
                    f = this.margin;
                b[e ? "y" : "x"] = -(f[3] || 0);
                b[e ? "x" : "y"] = -(f[0] || 0);
                b[e ? "height" : "width"] = this.chartWidth + (f[3] || 0) + (f[1] || 0);
                b[e ? "width" : "height"] = this.chartHeight + (f[0] || 0) + (f[2] || 0);
                this.scale3d = 1;!0 === h.fitToPlot && (this.scale3d = q(this, h.depth)) }
        });
        h(u.prototype, "redraw", function(c) { this.is3d() && (this.isDirtyBox = !0, this.frame3d = this.get3dFrame());
            c.apply(this, [].slice.call(arguments, 1)) });
        h(u.prototype, "render", function(c) {
            this.is3d() && (this.frame3d =
                this.get3dFrame());
            c.apply(this, [].slice.call(arguments, 1))
        });
        h(u.prototype, "renderSeries", function(c) { var h = this.series.length; if (this.is3d())
                for (; h--;) c = this.series[h], c.translate(), c.render();
            else c.call(this) });
        h(u.prototype, "drawChartBox", function(h) {
            if (this.is3d()) {
                var t = this.renderer,
                    e = this.options.chart.options3d,
                    b = this.get3dFrame(),
                    f = this.plotLeft,
                    k = this.plotLeft + this.plotWidth,
                    d = this.plotTop,
                    a = this.plotTop + this.plotHeight,
                    e = e.depth,
                    m = f - (b.left.visible ? b.left.size : 0),
                    l = k + (b.right.visible ?
                        b.right.size : 0),
                    n = d - (b.top.visible ? b.top.size : 0),
                    w = a + (b.bottom.visible ? b.bottom.size : 0),
                    r = 0 - (b.front.visible ? b.front.size : 0),
                    x = e + (b.back.visible ? b.back.size : 0),
                    g = this.hasRendered ? "animate" : "attr";
                this.frame3d = b;
                this.frameShapes || (this.frameShapes = { bottom: t.polyhedron().add(), top: t.polyhedron().add(), left: t.polyhedron().add(), right: t.polyhedron().add(), back: t.polyhedron().add(), front: t.polyhedron().add() });
                this.frameShapes.bottom[g]({
                    "class": "highcharts-3d-frame highcharts-3d-frame-bottom",
                    zIndex: b.bottom.frontFacing ?
                        -1E3 : 1E3,
                    faces: [{ fill: c.color(b.bottom.color).brighten(.1).get(), vertexes: [{ x: m, y: w, z: r }, { x: l, y: w, z: r }, { x: l, y: w, z: x }, { x: m, y: w, z: x }], enabled: b.bottom.visible }, { fill: c.color(b.bottom.color).brighten(.1).get(), vertexes: [{ x: f, y: a, z: e }, { x: k, y: a, z: e }, { x: k, y: a, z: 0 }, { x: f, y: a, z: 0 }], enabled: b.bottom.visible }, { fill: c.color(b.bottom.color).brighten(-.1).get(), vertexes: [{ x: m, y: w, z: r }, { x: m, y: w, z: x }, { x: f, y: a, z: e }, { x: f, y: a, z: 0 }], enabled: b.bottom.visible && !b.left.visible }, {
                        fill: c.color(b.bottom.color).brighten(-.1).get(),
                        vertexes: [{ x: l, y: w, z: x }, { x: l, y: w, z: r }, { x: k, y: a, z: 0 }, { x: k, y: a, z: e }],
                        enabled: b.bottom.visible && !b.right.visible
                    }, { fill: c.color(b.bottom.color).get(), vertexes: [{ x: l, y: w, z: r }, { x: m, y: w, z: r }, { x: f, y: a, z: 0 }, { x: k, y: a, z: 0 }], enabled: b.bottom.visible && !b.front.visible }, { fill: c.color(b.bottom.color).get(), vertexes: [{ x: m, y: w, z: x }, { x: l, y: w, z: x }, { x: k, y: a, z: e }, { x: f, y: a, z: e }], enabled: b.bottom.visible && !b.back.visible }]
                });
                this.frameShapes.top[g]({
                    "class": "highcharts-3d-frame highcharts-3d-frame-top",
                    zIndex: b.top.frontFacing ?
                        -1E3 : 1E3,
                    faces: [{ fill: c.color(b.top.color).brighten(.1).get(), vertexes: [{ x: m, y: n, z: x }, { x: l, y: n, z: x }, { x: l, y: n, z: r }, { x: m, y: n, z: r }], enabled: b.top.visible }, { fill: c.color(b.top.color).brighten(.1).get(), vertexes: [{ x: f, y: d, z: 0 }, { x: k, y: d, z: 0 }, { x: k, y: d, z: e }, { x: f, y: d, z: e }], enabled: b.top.visible }, { fill: c.color(b.top.color).brighten(-.1).get(), vertexes: [{ x: m, y: n, z: x }, { x: m, y: n, z: r }, { x: f, y: d, z: 0 }, { x: f, y: d, z: e }], enabled: b.top.visible && !b.left.visible }, {
                        fill: c.color(b.top.color).brighten(-.1).get(),
                        vertexes: [{
                            x: l,
                            y: n,
                            z: r
                        }, { x: l, y: n, z: x }, { x: k, y: d, z: e }, { x: k, y: d, z: 0 }],
                        enabled: b.top.visible && !b.right.visible
                    }, { fill: c.color(b.top.color).get(), vertexes: [{ x: m, y: n, z: r }, { x: l, y: n, z: r }, { x: k, y: d, z: 0 }, { x: f, y: d, z: 0 }], enabled: b.top.visible && !b.front.visible }, { fill: c.color(b.top.color).get(), vertexes: [{ x: l, y: n, z: x }, { x: m, y: n, z: x }, { x: f, y: d, z: e }, { x: k, y: d, z: e }], enabled: b.top.visible && !b.back.visible }]
                });
                this.frameShapes.left[g]({
                    "class": "highcharts-3d-frame highcharts-3d-frame-left",
                    zIndex: b.left.frontFacing ? -1E3 : 1E3,
                    faces: [{
                        fill: c.color(b.left.color).brighten(.1).get(),
                        vertexes: [{ x: m, y: w, z: r }, { x: f, y: a, z: 0 }, { x: f, y: a, z: e }, { x: m, y: w, z: x }],
                        enabled: b.left.visible && !b.bottom.visible
                    }, { fill: c.color(b.left.color).brighten(.1).get(), vertexes: [{ x: m, y: n, z: x }, { x: f, y: d, z: e }, { x: f, y: d, z: 0 }, { x: m, y: n, z: r }], enabled: b.left.visible && !b.top.visible }, { fill: c.color(b.left.color).brighten(-.1).get(), vertexes: [{ x: m, y: w, z: x }, { x: m, y: n, z: x }, { x: m, y: n, z: r }, { x: m, y: w, z: r }], enabled: b.left.visible }, {
                        fill: c.color(b.left.color).brighten(-.1).get(),
                        vertexes: [{ x: f, y: d, z: e }, { x: f, y: a, z: e }, { x: f, y: a, z: 0 },
                            { x: f, y: d, z: 0 }
                        ],
                        enabled: b.left.visible
                    }, { fill: c.color(b.left.color).get(), vertexes: [{ x: m, y: w, z: r }, { x: m, y: n, z: r }, { x: f, y: d, z: 0 }, { x: f, y: a, z: 0 }], enabled: b.left.visible && !b.front.visible }, { fill: c.color(b.left.color).get(), vertexes: [{ x: m, y: n, z: x }, { x: m, y: w, z: x }, { x: f, y: a, z: e }, { x: f, y: d, z: e }], enabled: b.left.visible && !b.back.visible }]
                });
                this.frameShapes.right[g]({
                    "class": "highcharts-3d-frame highcharts-3d-frame-right",
                    zIndex: b.right.frontFacing ? -1E3 : 1E3,
                    faces: [{
                        fill: c.color(b.right.color).brighten(.1).get(),
                        vertexes: [{ x: l, y: w, z: x }, { x: k, y: a, z: e }, { x: k, y: a, z: 0 }, { x: l, y: w, z: r }],
                        enabled: b.right.visible && !b.bottom.visible
                    }, { fill: c.color(b.right.color).brighten(.1).get(), vertexes: [{ x: l, y: n, z: r }, { x: k, y: d, z: 0 }, { x: k, y: d, z: e }, { x: l, y: n, z: x }], enabled: b.right.visible && !b.top.visible }, { fill: c.color(b.right.color).brighten(-.1).get(), vertexes: [{ x: k, y: d, z: 0 }, { x: k, y: a, z: 0 }, { x: k, y: a, z: e }, { x: k, y: d, z: e }], enabled: b.right.visible }, {
                        fill: c.color(b.right.color).brighten(-.1).get(),
                        vertexes: [{ x: l, y: w, z: r }, { x: l, y: n, z: r }, {
                            x: l,
                            y: n,
                            z: x
                        }, { x: l, y: w, z: x }],
                        enabled: b.right.visible
                    }, { fill: c.color(b.right.color).get(), vertexes: [{ x: l, y: n, z: r }, { x: l, y: w, z: r }, { x: k, y: a, z: 0 }, { x: k, y: d, z: 0 }], enabled: b.right.visible && !b.front.visible }, { fill: c.color(b.right.color).get(), vertexes: [{ x: l, y: w, z: x }, { x: l, y: n, z: x }, { x: k, y: d, z: e }, { x: k, y: a, z: e }], enabled: b.right.visible && !b.back.visible }]
                });
                this.frameShapes.back[g]({
                    "class": "highcharts-3d-frame highcharts-3d-frame-back",
                    zIndex: b.back.frontFacing ? -1E3 : 1E3,
                    faces: [{
                        fill: c.color(b.back.color).brighten(.1).get(),
                        vertexes: [{ x: l, y: w, z: x }, { x: m, y: w, z: x }, { x: f, y: a, z: e }, { x: k, y: a, z: e }],
                        enabled: b.back.visible && !b.bottom.visible
                    }, { fill: c.color(b.back.color).brighten(.1).get(), vertexes: [{ x: m, y: n, z: x }, { x: l, y: n, z: x }, { x: k, y: d, z: e }, { x: f, y: d, z: e }], enabled: b.back.visible && !b.top.visible }, { fill: c.color(b.back.color).brighten(-.1).get(), vertexes: [{ x: m, y: w, z: x }, { x: m, y: n, z: x }, { x: f, y: d, z: e }, { x: f, y: a, z: e }], enabled: b.back.visible && !b.left.visible }, {
                        fill: c.color(b.back.color).brighten(-.1).get(),
                        vertexes: [{ x: l, y: n, z: x }, {
                            x: l,
                            y: w,
                            z: x
                        }, { x: k, y: a, z: e }, { x: k, y: d, z: e }],
                        enabled: b.back.visible && !b.right.visible
                    }, { fill: c.color(b.back.color).get(), vertexes: [{ x: f, y: d, z: e }, { x: k, y: d, z: e }, { x: k, y: a, z: e }, { x: f, y: a, z: e }], enabled: b.back.visible }, { fill: c.color(b.back.color).get(), vertexes: [{ x: m, y: w, z: x }, { x: l, y: w, z: x }, { x: l, y: n, z: x }, { x: m, y: n, z: x }], enabled: b.back.visible }]
                });
                this.frameShapes.front[g]({
                    "class": "highcharts-3d-frame highcharts-3d-frame-front",
                    zIndex: b.front.frontFacing ? -1E3 : 1E3,
                    faces: [{
                        fill: c.color(b.front.color).brighten(.1).get(),
                        vertexes: [{ x: m, y: w, z: r }, { x: l, y: w, z: r }, { x: k, y: a, z: 0 }, { x: f, y: a, z: 0 }],
                        enabled: b.front.visible && !b.bottom.visible
                    }, { fill: c.color(b.front.color).brighten(.1).get(), vertexes: [{ x: l, y: n, z: r }, { x: m, y: n, z: r }, { x: f, y: d, z: 0 }, { x: k, y: d, z: 0 }], enabled: b.front.visible && !b.top.visible }, { fill: c.color(b.front.color).brighten(-.1).get(), vertexes: [{ x: m, y: n, z: r }, { x: m, y: w, z: r }, { x: f, y: a, z: 0 }, { x: f, y: d, z: 0 }], enabled: b.front.visible && !b.left.visible }, {
                        fill: c.color(b.front.color).brighten(-.1).get(),
                        vertexes: [{ x: l, y: w, z: r }, {
                            x: l,
                            y: n,
                            z: r
                        }, { x: k, y: d, z: 0 }, { x: k, y: a, z: 0 }],
                        enabled: b.front.visible && !b.right.visible
                    }, { fill: c.color(b.front.color).get(), vertexes: [{ x: k, y: d, z: 0 }, { x: f, y: d, z: 0 }, { x: f, y: a, z: 0 }, { x: k, y: a, z: 0 }], enabled: b.front.visible }, { fill: c.color(b.front.color).get(), vertexes: [{ x: l, y: w, z: r }, { x: m, y: w, z: r }, { x: m, y: n, z: r }, { x: l, y: n, z: r }], enabled: b.front.visible }]
                })
            }
            return h.apply(this, [].slice.call(arguments, 1))
        });
        u.prototype.retrieveStacks = function(c) {
            var h = this.series,
                e = {},
                b, f = 1;
            p(this.series, function(k) {
                b = v(k.options.stack,
                    c ? 0 : h.length - 1 - k.index);
                e[b] ? e[b].series.push(k) : (e[b] = { series: [k], position: f }, f++)
            });
            e.totalStacks = f + 1;
            return e
        };
        u.prototype.get3dFrame = function() {
            var h = this,
                A = h.options.chart.options3d,
                e = A.frame,
                b = h.plotLeft,
                f = h.plotLeft + h.plotWidth,
                k = h.plotTop,
                d = h.plotTop + h.plotHeight,
                a = A.depth,
                m = function(a) { a = c.shapeArea3d(a, h); return .5 < a ? 1 : -.5 > a ? -1 : 0 },
                l = m([{ x: b, y: d, z: a }, { x: f, y: d, z: a }, { x: f, y: d, z: 0 }, { x: b, y: d, z: 0 }]),
                n = m([{ x: b, y: k, z: 0 }, { x: f, y: k, z: 0 }, { x: f, y: k, z: a }, { x: b, y: k, z: a }]),
                w = m([{ x: b, y: k, z: 0 }, { x: b, y: k, z: a },
                    { x: b, y: d, z: a }, { x: b, y: d, z: 0 }
                ]),
                r = m([{ x: f, y: k, z: a }, { x: f, y: k, z: 0 }, { x: f, y: d, z: 0 }, { x: f, y: d, z: a }]),
                x = m([{ x: b, y: d, z: 0 }, { x: f, y: d, z: 0 }, { x: f, y: k, z: 0 }, { x: b, y: k, z: 0 }]),
                m = m([{ x: b, y: k, z: a }, { x: f, y: k, z: a }, { x: f, y: d, z: a }, { x: b, y: d, z: a }]),
                g = !1,
                z = !1,
                y = !1,
                u = !1;
            p([].concat(h.xAxis, h.yAxis, h.zAxis), function(a) { a && (a.horiz ? a.opposite ? z = !0 : g = !0 : a.opposite ? u = !0 : y = !0) });
            var q = function(a, d, b) {
                    for (var e = ["size", "color", "visible"], c = {}, f = 0; f < e.length; f++)
                        for (var l = e[f], g = 0; g < a.length; g++)
                            if ("object" === typeof a[g]) {
                                var m = a[g][l];
                                if (void 0 !== m && null !== m) { c[l] = m; break }
                            }
                    a = b;
                    !0 === c.visible || !1 === c.visible ? a = c.visible : "auto" === c.visible && (a = 0 < d);
                    return { size: v(c.size, 1), color: v(c.color, "none"), frontFacing: 0 < d, visible: a }
                },
                e = { bottom: q([e.bottom, e.top, e], l, g), top: q([e.top, e.bottom, e], n, z), left: q([e.left, e.right, e.side, e], w, y), right: q([e.right, e.left, e.side, e], r, u), back: q([e.back, e.front, e], m, !0), front: q([e.front, e.back, e], x, !1) };
            "auto" === A.axisLabelPosition ? (r = function(a, d) {
                return a.visible !== d.visible || a.visible && d.visible && a.frontFacing !==
                    d.frontFacing
            }, A = [], r(e.left, e.front) && A.push({ y: (k + d) / 2, x: b, z: 0, xDir: { x: 1, y: 0, z: 0 } }), r(e.left, e.back) && A.push({ y: (k + d) / 2, x: b, z: a, xDir: { x: 0, y: 0, z: -1 } }), r(e.right, e.front) && A.push({ y: (k + d) / 2, x: f, z: 0, xDir: { x: 0, y: 0, z: 1 } }), r(e.right, e.back) && A.push({ y: (k + d) / 2, x: f, z: a, xDir: { x: -1, y: 0, z: 0 } }), l = [], r(e.bottom, e.front) && l.push({ x: (b + f) / 2, y: d, z: 0, xDir: { x: 1, y: 0, z: 0 } }), r(e.bottom, e.back) && l.push({ x: (b + f) / 2, y: d, z: a, xDir: { x: -1, y: 0, z: 0 } }), n = [], r(e.top, e.front) && n.push({ x: (b + f) / 2, y: k, z: 0, xDir: { x: 1, y: 0, z: 0 } }), r(e.top,
                e.back) && n.push({ x: (b + f) / 2, y: k, z: a, xDir: { x: -1, y: 0, z: 0 } }), w = [], r(e.bottom, e.left) && w.push({ z: (0 + a) / 2, y: d, x: b, xDir: { x: 0, y: 0, z: -1 } }), r(e.bottom, e.right) && w.push({ z: (0 + a) / 2, y: d, x: f, xDir: { x: 0, y: 0, z: 1 } }), d = [], r(e.top, e.left) && d.push({ z: (0 + a) / 2, y: k, x: b, xDir: { x: 0, y: 0, z: -1 } }), r(e.top, e.right) && d.push({ z: (0 + a) / 2, y: k, x: f, xDir: { x: 0, y: 0, z: 1 } }), b = function(a, d, b) {
                if (0 === a.length) return null;
                if (1 === a.length) return a[0];
                for (var e = 0, c = B(a, h, !1), f = 1; f < c.length; f++) b * c[f][d] > b * c[e][d] ? e = f : b * c[f][d] === b * c[e][d] && c[f].z <
                    c[e].z && (e = f);
                return a[e]
            }, e.axes = { y: { left: b(A, "x", -1), right: b(A, "x", 1) }, x: { top: b(n, "y", -1), bottom: b(l, "y", 1) }, z: { top: b(d, "y", -1), bottom: b(w, "y", 1) } }) : e.axes = { y: { left: { x: b, z: 0, xDir: { x: 1, y: 0, z: 0 } }, right: { x: f, z: 0, xDir: { x: 0, y: 0, z: 1 } } }, x: { top: { y: k, z: 0, xDir: { x: 1, y: 0, z: 0 } }, bottom: { y: d, z: 0, xDir: { x: 1, y: 0, z: 0 } } }, z: { top: { x: y ? f : b, y: k, xDir: y ? { x: 0, y: 0, z: 1 } : { x: 0, y: 0, z: -1 } }, bottom: { x: y ? f : b, y: d, xDir: y ? { x: 0, y: 0, z: 1 } : { x: 0, y: 0, z: -1 } } } };
            return e
        };
        c.Fx.prototype.matrixSetter = function() {
            var h;
            if (1 > this.pos && (c.isArray(this.start) ||
                    c.isArray(this.end))) { var A = this.start || [1, 0, 0, 1, 0, 0],
                    e = this.end || [1, 0, 0, 1, 0, 0];
                h = []; for (var b = 0; 6 > b; b++) h.push(this.pos * e[b] + (1 - this.pos) * A[b]) } else h = this.end;
            this.elem.attr(this.prop, h, null, !0)
        }
    })(C);
    (function(c) {
        function q(d, a, b) {
            if (!d.chart.is3d() || "colorAxis" === d.coll) return a;
            var c = d.chart,
                f = B * c.options.chart.options3d.alpha,
                m = B * c.options.chart.options3d.beta,
                h = A(b && d.options.title.position3d, d.options.labels.position3d);
            b = A(b && d.options.title.skew3d, d.options.labels.skew3d);
            var k = c.frame3d,
                g = c.plotLeft,
                v = c.plotWidth + g,
                p = c.plotTop,
                y = c.plotHeight + p,
                c = !1,
                z = 0,
                u = 0,
                q = { x: 0, y: 1, z: 0 };
            a = d.swapZ({ x: a.x, y: a.y, z: 0 });
            if (d.isZAxis)
                if (d.opposite) { if (null === k.axes.z.top) return {};
                    u = a.y - p;
                    a.x = k.axes.z.top.x;
                    a.y = k.axes.z.top.y;
                    g = k.axes.z.top.xDir;
                    c = !k.top.frontFacing } else { if (null === k.axes.z.bottom) return {};
                    u = a.y - y;
                    a.x = k.axes.z.bottom.x;
                    a.y = k.axes.z.bottom.y;
                    g = k.axes.z.bottom.xDir;
                    c = !k.bottom.frontFacing }
            else if (d.horiz)
                if (d.opposite) {
                    if (null === k.axes.x.top) return {};
                    u = a.y - p;
                    a.y = k.axes.x.top.y;
                    a.z = k.axes.x.top.z;
                    g = k.axes.x.top.xDir;
                    c = !k.top.frontFacing
                } else { if (null === k.axes.x.bottom) return {};
                    u = a.y - y;
                    a.y = k.axes.x.bottom.y;
                    a.z = k.axes.x.bottom.z;
                    g = k.axes.x.bottom.xDir;
                    c = !k.bottom.frontFacing }
            else if (d.opposite) { if (null === k.axes.y.right) return {};
                z = a.x - v;
                a.x = k.axes.y.right.x;
                a.z = k.axes.y.right.z;
                g = k.axes.y.right.xDir;
                g = { x: g.z, y: g.y, z: -g.x } } else { if (null === k.axes.y.left) return {};
                z = a.x - g;
                a.x = k.axes.y.left.x;
                a.z = k.axes.y.left.z;
                g = k.axes.y.left.xDir }
            "chart" !== h && ("flap" === h ? d.horiz ? (m = Math.sin(f), f = Math.cos(f), d.opposite &&
                (m = -m), c && (m = -m), q = { x: g.z * m, y: f, z: -g.x * m }) : g = { x: Math.cos(m), y: 0, z: Math.sin(m) } : "ortho" === h ? d.horiz ? (q = Math.cos(f), h = Math.sin(m) * q, f = -Math.sin(f), m = -q * Math.cos(m), q = { x: g.y * m - g.z * f, y: g.z * h - g.x * m, z: g.x * f - g.y * h }, f = 1 / Math.sqrt(q.x * q.x + q.y * q.y + q.z * q.z), c && (f = -f), q = { x: f * q.x, y: f * q.y, z: f * q.z }) : g = { x: Math.cos(m), y: 0, z: Math.sin(m) } : d.horiz ? q = { x: Math.sin(m) * Math.sin(f), y: Math.cos(f), z: -Math.cos(m) * Math.sin(f) } : g = { x: Math.cos(m), y: 0, z: Math.sin(m) });
            a.x += z * g.x + u * q.x;
            a.y += z * g.y + u * q.y;
            a.z += z * g.z + u * q.z;
            c = t([a], d.chart)[0];
            b ? (0 > e(t([a, { x: a.x + g.x, y: a.y + g.y, z: a.z + g.z }, { x: a.x + q.x, y: a.y + q.y, z: a.z + q.z }], d.chart)) && (g = { x: -g.x, y: -g.y, z: -g.z }), d = t([{ x: a.x, y: a.y, z: a.z }, { x: a.x + g.x, y: a.y + g.y, z: a.z + g.z }, { x: a.x + q.x, y: a.y + q.y, z: a.z + q.z }], d.chart), c.matrix = [d[1].x - d[0].x, d[1].y - d[0].y, d[2].x - d[0].x, d[2].y - d[0].y, c.x, c.y], c.matrix[4] -= c.x * c.matrix[0] + c.y * c.matrix[2], c.matrix[5] -= c.x * c.matrix[1] + c.y * c.matrix[3]) : c.matrix = null;
            return c
        }
        var u, p = c.Axis,
            y = c.Chart,
            B = c.deg2rad,
            v = c.each,
            h = c.extend,
            z = c.merge,
            t = c.perspective,
            A = c.pick,
            e = c.shapeArea,
            b = c.splat,
            f = c.Tick,
            k = c.wrap;
        z(!0, p.prototype.defaultOptions, { labels: { position3d: "offset", skew3d: !1 }, title: { position3d: null, skew3d: null } });
        k(p.prototype, "setOptions", function(d, a) { d.call(this, a);
            this.chart.is3d && this.chart.is3d() && "colorAxis" !== this.coll && (d = this.options, d.tickWidth = A(d.tickWidth, 0), d.gridLineWidth = A(d.gridLineWidth, 1)) });
        k(p.prototype, "getPlotLinePath", function(d) {
            var a = d.apply(this, [].slice.call(arguments, 1));
            if (!this.chart.is3d() || "colorAxis" === this.coll || null === a) return a;
            var b =
                this.chart,
                c = b.options.chart.options3d,
                c = this.isZAxis ? b.plotWidth : c.depth,
                b = b.frame3d,
                a = [this.swapZ({ x: a[1], y: a[2], z: 0 }), this.swapZ({ x: a[1], y: a[2], z: c }), this.swapZ({ x: a[4], y: a[5], z: 0 }), this.swapZ({ x: a[4], y: a[5], z: c })],
                c = [];
            this.horiz ? (this.isZAxis ? (b.left.visible && c.push(a[0], a[2]), b.right.visible && c.push(a[1], a[3])) : (b.front.visible && c.push(a[0], a[2]), b.back.visible && c.push(a[1], a[3])), b.top.visible && c.push(a[0], a[1]), b.bottom.visible && c.push(a[2], a[3])) : (b.front.visible && c.push(a[0], a[2]), b.back.visible &&
                c.push(a[1], a[3]), b.left.visible && c.push(a[0], a[1]), b.right.visible && c.push(a[2], a[3]));
            c = t(c, this.chart, !1);
            return this.chart.renderer.toLineSegments(c)
        });
        k(p.prototype, "getLinePath", function(b) { return this.chart.is3d() && "colorAxis" !== this.coll ? [] : b.apply(this, [].slice.call(arguments, 1)) });
        k(p.prototype, "getPlotBandPath", function(b) {
            if (!this.chart.is3d() || "colorAxis" === this.coll) return b.apply(this, [].slice.call(arguments, 1));
            var a = arguments,
                d = a[2],
                c = [],
                a = this.getPlotLinePath(a[1]),
                d = this.getPlotLinePath(d);
            if (a && d)
                for (var e = 0; e < a.length; e += 6) c.push("M", a[e + 1], a[e + 2], "L", a[e + 4], a[e + 5], "L", d[e + 4], d[e + 5], "L", d[e + 1], d[e + 2], "Z");
            return c
        });
        k(f.prototype, "getMarkPath", function(b) { var a = b.apply(this, [].slice.call(arguments, 1)),
                a = [q(this.axis, { x: a[1], y: a[2], z: 0 }), q(this.axis, { x: a[4], y: a[5], z: 0 })]; return this.axis.chart.renderer.toLineSegments(a) });
        k(f.prototype, "getLabelPosition", function(b) { var a = b.apply(this, [].slice.call(arguments, 1)); return q(this.axis, a) });
        k(p.prototype, "getTitlePosition", function(b) {
            var a =
                b.apply(this, [].slice.call(arguments, 1));
            return q(this, a, !0)
        });
        k(p.prototype, "drawCrosshair", function(b) { var a = arguments;
            this.chart.is3d() && "colorAxis" !== this.coll && a[2] && (a[2] = { plotX: a[2].plotXold || a[2].plotX, plotY: a[2].plotYold || a[2].plotY });
            b.apply(this, [].slice.call(a, 1)) });
        k(p.prototype, "destroy", function(b) { v(["backFrame", "bottomFrame", "sideFrame"], function(a) { this[a] && (this[a] = this[a].destroy()) }, this);
            b.apply(this, [].slice.call(arguments, 1)) });
        p.prototype.swapZ = function(b, a) {
            return this.isZAxis ?
                (a = a ? 0 : this.chart.plotLeft, { x: a + b.z, y: b.y, z: b.x - a }) : b
        };
        u = c.ZAxis = function() { this.init.apply(this, arguments) };
        h(u.prototype, p.prototype);
        h(u.prototype, {
            isZAxis: !0,
            setOptions: function(b) { b = z({ offset: 0, lineWidth: 0 }, b);
                p.prototype.setOptions.call(this, b);
                this.coll = "zAxis" },
            setAxisSize: function() { p.prototype.setAxisSize.call(this);
                this.width = this.len = this.chart.options.chart.options3d.depth;
                this.right = this.chart.chartWidth - this.width - this.left },
            getSeriesExtremes: function() {
                var b = this,
                    a = b.chart;
                b.hasVisibleSeries = !1;
                b.dataMin = b.dataMax = b.ignoreMinPadding = b.ignoreMaxPadding = null;
                b.buildStacks && b.buildStacks();
                v(b.series, function(d) { if (d.visible || !a.options.chart.ignoreHiddenSeries) b.hasVisibleSeries = !0, d = d.zData, d.length && (b.dataMin = Math.min(A(b.dataMin, d[0]), Math.min.apply(null, d)), b.dataMax = Math.max(A(b.dataMax, d[0]), Math.max.apply(null, d))) })
            }
        });
        k(y.prototype, "getAxes", function(d) {
            var a = this,
                c = this.options,
                c = c.zAxis = b(c.zAxis || {});
            d.call(this);
            a.is3d() && (this.zAxis = [], v(c, function(b, d) {
                b.index = d;
                b.isX = !0;
                (new u(a, b)).setScale()
            }))
        })
    })(C);
    (function(c) {
        var q = c.perspective,
            u = c.pick,
            p = c.wrap;
        p(c.Series.prototype, "translate", function(c) { c.apply(this, [].slice.call(arguments, 1));
            this.chart.is3d() && this.translate3dPoints() });
        c.Series.prototype.translate3dPoints = function() {
            var c = this.chart,
                p = u(this.zAxis, c.options.zAxis[0]),
                v = [],
                h, z, t;
            for (t = 0; t < this.data.length; t++) h = this.data[t], p && p.translate ? (z = p.isLog && p.val2lin ? p.val2lin(h.z) : h.z, h.plotZ = p.translate(z), h.isInside = h.isInside ? z >= p.min && z <= p.max : !1) : h.plotZ =
                0, v.push({ x: u(h.plotXold, h.plotX), y: u(h.plotYold, h.plotY), z: u(h.plotZold, h.plotZ) });
            c = q(v, c, !0);
            for (t = 0; t < this.data.length; t++) h = this.data[t], p = c[t], h.plotXold = h.plotX, h.plotYold = h.plotY, h.plotZold = h.plotZ, h.plotX = p.x, h.plotY = p.y, h.plotZ = p.z
        }
    })(C);
    (function(c) {
        function q(c) { var e = c.apply(this, [].slice.call(arguments, 1));
            this.chart.is3d && this.chart.is3d() && (e.stroke = this.options.edgeColor || e.fill, e["stroke-width"] = y(this.options.edgeWidth, 1)); return e }
        var u = c.each,
            p = c.perspective,
            y = c.pick,
            B = c.Series,
            v = c.seriesTypes,
            h = c.inArray,
            z = c.svg,
            t = c.wrap;
        t(v.column.prototype, "translate", function(c) { c.apply(this, [].slice.call(arguments, 1));
            this.chart.is3d() && this.translate3dShapes() });
        v.column.prototype.translate3dPoints = function() {};
        v.column.prototype.translate3dShapes = function() {
            var c = this,
                e = c.chart,
                b = c.options,
                f = b.depth || 25,
                k = (b.stacking ? b.stack || 0 : c.index) * (f + (b.groupZPadding || 1)),
                d = c.borderWidth % 2 ? .5 : 0;
            e.inverted && !c.yAxis.reversed && (d *= -1);
            !1 !== b.grouping && (k = 0);
            k += b.groupZPadding || 1;
            u(c.data, function(a) {
                if (null !==
                    a.y) { var b = a.shapeArgs,
                        h = a.tooltipPos,
                        n;
                    u([
                        ["x", "width"],
                        ["y", "height"]
                    ], function(a) { n = b[a[0]] - d;
                        0 > n && (b[a[1]] += b[a[0]] + d, b[a[0]] = -d, n = 0);
                        n + b[a[1]] > c[a[0] + "Axis"].len && 0 !== b[a[1]] && (b[a[1]] = c[a[0] + "Axis"].len - b[a[0]]); if (0 !== b[a[1]] && (b[a[0]] >= c[a[0] + "Axis"].len || b[a[0]] + b[a[1]] <= d))
                            for (var e in b) b[e] = 0 });
                    a.shapeType = "cuboid";
                    b.z = k;
                    b.depth = f;
                    b.insidePlotArea = !0;
                    h = p([{ x: h[0], y: h[1], z: k }], e, !0)[0];
                    a.tooltipPos = [h.x, h.y] }
            });
            c.z = k
        };
        t(v.column.prototype, "animate", function(c) {
            if (this.chart.is3d()) {
                var e =
                    arguments[1],
                    b = this.yAxis,
                    f = this,
                    k = this.yAxis.reversed;
                z && (e ? u(f.data, function(c) { null !== c.y && (c.height = c.shapeArgs.height, c.shapey = c.shapeArgs.y, c.shapeArgs.height = 1, k || (c.shapeArgs.y = c.stackY ? c.plotY + b.translate(c.stackY) : c.plotY + (c.negative ? -c.height : c.height))) }) : (u(f.data, function(b) { null !== b.y && (b.shapeArgs.height = b.height, b.shapeArgs.y = b.shapey, b.graphic && b.graphic.animate(b.shapeArgs, f.options.animation)) }), this.drawDataLabels(), f.animate = null))
            } else c.apply(this, [].slice.call(arguments, 1))
        });
        t(v.column.prototype, "plotGroup", function(c, e, b, f, k, d) { this.chart.is3d() && d && !this[e] && (this.chart.columnGroup || (this.chart.columnGroup = this.chart.renderer.g("columnGroup").add(d)), this[e] = this.chart.columnGroup, this.chart.columnGroup.attr(this.getPlotBox()), this[e].survive = !0); return c.apply(this, Array.prototype.slice.call(arguments, 1)) });
        t(v.column.prototype, "setVisible", function(c, e) {
            var b = this,
                f;
            b.chart.is3d() && u(b.data, function(c) {
                f = (c.visible = c.options.visible = e = void 0 === e ? !c.visible : e) ? "visible" :
                    "hidden";
                b.options.data[h(c, b.data)] = c.options;
                c.graphic && c.graphic.attr({ visibility: f })
            });
            c.apply(this, Array.prototype.slice.call(arguments, 1))
        });
        t(v.column.prototype, "init", function(c) {
            c.apply(this, [].slice.call(arguments, 1));
            if (this.chart.is3d()) {
                var e = this.options,
                    b = e.grouping,
                    f = e.stacking,
                    h = y(this.yAxis.options.reversedStacks, !0),
                    d = 0;
                if (void 0 === b || b) {
                    b = this.chart.retrieveStacks(f);
                    d = e.stack || 0;
                    for (f = 0; f < b[d].series.length && b[d].series[f] !== this; f++);
                    d = 10 * (b.totalStacks - b[d].position) + (h ? f : -f);
                    this.xAxis.reversed || (d = 10 * b.totalStacks - d)
                }
                e.zIndex = d
            }
        });
        t(v.column.prototype, "pointAttribs", q);
        v.columnrange && (t(v.columnrange.prototype, "pointAttribs", q), v.columnrange.prototype.plotGroup = v.column.prototype.plotGroup, v.columnrange.prototype.setVisible = v.column.prototype.setVisible);
        t(B.prototype, "alignDataLabel", function(c) {
            if (this.chart.is3d() && ("column" === this.type || "columnrange" === this.type)) { var e = arguments[4],
                    b = { x: e.x, y: e.y, z: this.z },
                    b = p([b], this.chart, !0)[0];
                e.x = b.x;
                e.y = b.y }
            c.apply(this, [].slice.call(arguments, 1))
        });
        t(c.StackItem.prototype, "getStackBox", function(h, e) { var b = h.apply(this, [].slice.call(arguments, 1)); if (e.is3d()) { var f = { x: b.x, y: b.y, z: 0 },
                    f = c.perspective([f], e, !0)[0];
                b.x = f.x;
                b.y = f.y } return b })
    })(C);
    (function(c) {
        var q = c.deg2rad,
            u = c.each,
            p = c.pick,
            y = c.seriesTypes,
            B = c.svg;
        c = c.wrap;
        c(y.pie.prototype, "translate", function(c) {
            c.apply(this, [].slice.call(arguments, 1));
            if (this.chart.is3d()) {
                var h = this,
                    p = h.options,
                    t = p.depth || 0,
                    v = h.chart.options.chart.options3d,
                    e = v.alpha,
                    b = v.beta,
                    f = p.stacking ? (p.stack || 0) * t : h._i * t,
                    f = f + t / 2;
                !1 !== p.grouping && (f = 0);
                u(h.data, function(c) { var d = c.shapeArgs;
                    c.shapeType = "arc3d";
                    d.z = f;
                    d.depth = .75 * t;
                    d.alpha = e;
                    d.beta = b;
                    d.center = h.center;
                    d = (d.end + d.start) / 2;
                    c.slicedTranslation = { translateX: Math.round(Math.cos(d) * p.slicedOffset * Math.cos(e * q)), translateY: Math.round(Math.sin(d) * p.slicedOffset * Math.cos(e * q)) } })
            }
        });
        c(y.pie.prototype.pointClass.prototype, "haloPath", function(c) { var h = arguments; return this.series.chart.is3d() ? [] : c.call(this, h[1]) });
        c(y.pie.prototype,
            "pointAttribs",
            function(c, h, q) { c = c.call(this, h, q);
                q = this.options;
                this.chart.is3d() && (c.stroke = q.edgeColor || h.color || this.color, c["stroke-width"] = p(q.edgeWidth, 1)); return c });
        c(y.pie.prototype, "drawPoints", function(c) { c.apply(this, [].slice.call(arguments, 1));
            this.chart.is3d() && u(this.points, function(c) { var h = c.graphic; if (h) h[c.y && c.visible ? "show" : "hide"]() }) });
        c(y.pie.prototype, "drawDataLabels", function(c) {
            if (this.chart.is3d()) {
                var h = this.chart.options.chart.options3d;
                u(this.data, function(c) {
                    var p =
                        c.shapeArgs,
                        v = p.r,
                        e = (p.start + p.end) / 2,
                        b = c.labelPos,
                        f = -v * (1 - Math.cos((p.alpha || h.alpha) * q)) * Math.sin(e),
                        k = v * (Math.cos((p.beta || h.beta) * q) - 1) * Math.cos(e);
                    u([0, 2, 4], function(c) { b[c] += k;
                        b[c + 1] += f })
                })
            }
            c.apply(this, [].slice.call(arguments, 1))
        });
        c(y.pie.prototype, "addPoint", function(c) { c.apply(this, [].slice.call(arguments, 1));
            this.chart.is3d() && this.update(this.userOptions, !0) });
        c(y.pie.prototype, "animate", function(c) {
            if (this.chart.is3d()) {
                var h = arguments[1],
                    p = this.options.animation,
                    t = this.center,
                    q = this.group,
                    e = this.markerGroup;
                B && (!0 === p && (p = {}), h ? (q.oldtranslateX = q.translateX, q.oldtranslateY = q.translateY, h = { translateX: t[0], translateY: t[1], scaleX: .001, scaleY: .001 }, q.attr(h), e && (e.attrSetters = q.attrSetters, e.attr(h))) : (h = { translateX: q.oldtranslateX, translateY: q.oldtranslateY, scaleX: 1, scaleY: 1 }, q.animate(h, p), e && e.animate(h, p), this.animate = null))
            } else c.apply(this, [].slice.call(arguments, 1))
        })
    })(C);
    (function(c) {
        var q = c.Point,
            u = c.seriesType,
            p = c.seriesTypes;
        u("scatter3d", "scatter", { tooltip: { pointFormat: "x: \x3cb\x3e{point.x}\x3c/b\x3e\x3cbr/\x3ey: \x3cb\x3e{point.y}\x3c/b\x3e\x3cbr/\x3ez: \x3cb\x3e{point.z}\x3c/b\x3e\x3cbr/\x3e" } }, { pointAttribs: function(q) { var u = p.scatter.prototype.pointAttribs.apply(this, arguments);
                this.chart.is3d() && q && (u.zIndex = c.pointCameraDistance(q, this.chart)); return u }, axisTypes: ["xAxis", "yAxis", "zAxis"], pointArrayMap: ["x", "y", "z"], parallelArrays: ["x", "y", "z"], directTouch: !0 }, { applyOptions: function() { q.prototype.applyOptions.apply(this, arguments);
                void 0 === this.z && (this.z = 0); return this } })
    })(C);
    (function(c) {
        var q = c.Axis,
            u = c.SVGRenderer,
            p = c.VMLRenderer;
        p && (c.setOptions({ animate: !1 }), p.prototype.face3d =
            u.prototype.face3d, p.prototype.polyhedron = u.prototype.polyhedron, p.prototype.cuboid = u.prototype.cuboid, p.prototype.cuboidPath = u.prototype.cuboidPath, p.prototype.toLinePath = u.prototype.toLinePath, p.prototype.toLineSegments = u.prototype.toLineSegments, p.prototype.createElement3D = u.prototype.createElement3D, p.prototype.arc3d = function(c) { c = u.prototype.arc3d.call(this, c);
                c.css({ zIndex: c.zIndex }); return c }, c.VMLRenderer.prototype.arc3dPath = c.SVGRenderer.prototype.arc3dPath, c.wrap(q.prototype, "render", function(c) {
                c.apply(this, [].slice.call(arguments, 1));
                this.sideFrame && (this.sideFrame.css({ zIndex: 0 }), this.sideFrame.front.attr({ fill: this.sideFrame.color }));
                this.bottomFrame && (this.bottomFrame.css({ zIndex: 1 }), this.bottomFrame.front.attr({ fill: this.bottomFrame.color }));
                this.backFrame && (this.backFrame.css({ zIndex: 0 }), this.backFrame.front.attr({ fill: this.backFrame.color }))
            }))
    })(C)
});