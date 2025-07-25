/*
jQWidgets v5.5.0 (2017-Dec)
Copyright (c) 2011-2017 jQWidgets.
License: https://jqwidgets.com/license/
*/
var oldBrowser = document.all && !document.addEventListener;
if (!oldBrowser) {
    (function(be, H) {
        var r, ao, al = be.document,
            bp = be.location,
            bu = be.navigator,
            ay = be.JQXLite,
            Y = be.$,
            aS = Array.prototype.push,
            aE = Array.prototype.slice,
            aB = Array.prototype.indexOf,
            z = Object.prototype.toString,
            b = Object.prototype.hasOwnProperty,
            ax = String.prototype.trim,
            D = function(bv, bw) {
                return new D.fn.init(bv, bw, r)
            },
            aF = /[\-+]?(?:\d*\.|)\d+(?:[eE][\-+]?\d+|)/.source,
            au = /\S/,
            a9 = /\s+/,
            T = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,
            aG = /^(?:[^#<]*(<[\w\W]+>)[^>]*$|#([\w\-]*)$)/,
            e = /^<(\w+)\s*\/?>(?:<\/\1>|)$/,
            k = /^[\],:{}\s]*$/,
            u = /(?:^|:|,)(?:\s*\[)+/g,
            a6 = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
            L = /"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g,
            av = /^-ms-/,
            aT = /-([\da-z])/gi,
            n = function(bv, bw) {
                return (bw + "").toUpperCase()
            },
            a5 = function() {
                if (al.addEventListener) {
                    al.removeEventListener("DOMContentLoaded", a5, false);
                    D.ready()
                } else {
                    if (al.readyState === "complete") {
                        al.detachEvent("onreadystatechange", a5);
                        D.ready()
                    }
                }
            },
            a1 = {};
        D.fn = D.prototype = {
            constructor: D,
            init: function(bv, by, bz) {
                var bx, bA, bw, bB;
                if (!bv) {
                    return this
                }
                if (bv.nodeType) {
                    this.context = this[0] = bv;
                    this.length = 1;
                    return this
                }
                if (typeof bv === "string") {
                    if (bv.charAt(0) === "<" && bv.charAt(bv.length - 1) === ">" && bv.length >= 3) {
                        bx = [null, bv, null]
                    } else {
                        bx = aG.exec(bv)
                    }
                    if (bx && (bx[1] || !by)) {
                        if (bx[1]) {
                            by = by instanceof D ? by[0] : by;
                            bB = (by && by.nodeType ? by.ownerDocument || by : al);
                            bv = D.parseHTML(bx[1], bB, true);
                            if (e.test(bx[1]) && D.isPlainObject(by)) {
                                this.attr.call(bv, by, true)
                            }
                            return D.merge(this, bv)
                        } else {
                            bA = al.getElementById(bx[2]);
                            if (bA && bA.parentNode) {
                                if (bA.id !== bx[2]) {
                                    return bz.find(bv)
                                }
                                this.length = 1;
                                this[0] = bA
                            }
                            this.context = al;
                            this.selector = bv;
                            return this
                        }
                    } else {
                        if (!by || by.jqx) {
                            return (by || bz).find(bv)
                        } else {
                            return this.constructor(by).find(bv)
                        }
                    }
                } else {
                    if (D.isFunction(bv)) {
                        return bz.ready(bv)
                    }
                }
                if (bv.selector !== H) {
                    this.selector = bv.selector;
                    this.context = bv.context
                }
                return D.makeArray(bv, this)
            },
            selector: "",
            jqx: "4.5.0",
            length: 0,
            size: function() {
                return this.length
            },
            toArray: function() {
                return aE.call(this)
            },
            get: function(bv) {
                return bv == null ? this.toArray() : (bv < 0 ? this[this.length + bv] : this[bv])
            },
            pushStack: function(bw, by, bv) {
                var bx = D.merge(this.constructor(), bw);
                bx.prevObject = this;
                bx.context = this.context;
                if (by === "find") {
                    bx.selector = this.selector + (this.selector ? " " : "") + bv
                } else {
                    if (by) {
                        bx.selector = this.selector + "." + by + "(" + bv + ")"
                    }
                }
                return bx
            },
            each: function(bw, bv) {
                return D.each(this, bw, bv)
            },
            ready: function(bv) {
                D.ready.promise().done(bv);
                return this
            },
            eq: function(bv) {
                bv = +bv;
                return bv === -1 ? this.slice(bv) : this.slice(bv, bv + 1)
            },
            first: function() {
                return this.eq(0)
            },
            last: function() {
                return this.eq(-1)
            },
            slice: function() {
                return this.pushStack(aE.apply(this, arguments), "slice", aE.call(arguments).join(","))
            },
            map: function(bv) {
                return this.pushStack(D.map(this, function(bx, bw) {
                    return bv.call(bx, bw, bx)
                }))
            },
            end: function() {
                return this.prevObject || this.constructor(null)
            },
            push: aS,
            sort: [].sort,
            splice: [].splice
        };
        D.fn.init.prototype = D.fn;
        D.extend = D.fn.extend = function() {
            var bE, bx, bv, bw, bB, bC, bA = arguments[0] || {},
                bz = 1,
                by = arguments.length,
                bD = false;
            if (typeof bA === "boolean") {
                bD = bA;
                bA = arguments[1] || {};
                bz = 2
            }
            if (typeof bA !== "object" && !D.isFunction(bA)) {
                bA = {}
            }
            if (by === bz) {
                bA = this;
                --bz
            }
            for (; bz < by; bz++) {
                if ((bE = arguments[bz]) != null) {
                    for (bx in bE) {
                        bv = bA[bx];
                        bw = bE[bx];
                        if (bA === bw) {
                            continue
                        }
                        if (bD && bw && (D.isPlainObject(bw) || (bB = D.isArray(bw)))) {
                            if (bB) {
                                bB = false;
                                bC = bv && D.isArray(bv) ? bv : []
                            } else {
                                bC = bv && D.isPlainObject(bv) ? bv : {}
                            }
                            bA[bx] = D.extend(bD, bC, bw)
                        } else {
                            if (bw !== H) {
                                bA[bx] = bw
                            }
                        }
                    }
                }
            }
            return bA
        };
        D.extend({
            noConflict: function(bv) {
                if (be.$ === D) {
                    be.$ = Y
                }
                if (bv && be.JQXLite === D) {
                    be.JQXLite = ay
                }
                return D
            },
            isReady: false,
            readyWait: 1,
            holdReady: function(bv) {
                if (bv) {
                    D.readyWait++
                } else {
                    D.ready(true)
                }
            },
            ready: function(bv) {
                if (bv === true ? --D.readyWait : D.isReady) {
                    return
                }
                if (!al.body) {
                    return setTimeout(D.ready, 1)
                }
                D.isReady = true;
                if (bv !== true && --D.readyWait > 0) {
                    return
                }
                ao.resolveWith(al, [D]);
                if (D.fn.trigger) {
                    D(al).trigger("ready").off("ready")
                }
            },
            isFunction: function(bv) {
                return D.type(bv) === "function"
            },
            isArray: Array.isArray || function(bv) {
                return D.type(bv) === "array"
            },
            isWindow: function(bv) {
                return bv != null && bv == bv.window
            },
            isNumeric: function(bv) {
                return !isNaN(parseFloat(bv)) && isFinite(bv)
            },
            type: function(bv) {
                return bv == null ? String(bv) : a1[z.call(bv)] || "object"
            },
            isPlainObject: function(bx) {
                if (!bx || D.type(bx) !== "object" || bx.nodeType || D.isWindow(bx)) {
                    return false
                }
                try {
                    if (bx.constructor && !b.call(bx, "constructor") && !b.call(bx.constructor.prototype, "isPrototypeOf")) {
                        return false
                    }
                } catch (bw) {
                    return false
                }
                var bv;
                for (bv in bx) {}
                return bv === H || b.call(bx, bv)
            },
            isEmptyObject: function(bw) {
                var bv;
                for (bv in bw) {
                    return false
                }
                return true
            },
            error: function(bv) {
                throw new Error(bv)
            },
            parseHTML: function(by, bx, bv) {
                var bw;
                if (!by || typeof by !== "string") {
                    return null
                }
                if (typeof bx === "boolean") {
                    bv = bx;
                    bx = 0
                }
                bx = bx || al;
                if ((bw = e.exec(by))) {
                    return [bx.createElement(bw[1])]
                }
                bw = D.buildFragment([by], bx, bv ? null : []);
                return D.merge([], (bw.cacheable ? D.clone(bw.fragment) : bw.fragment).childNodes)
            },
            parseJSON: function(bv) {
                if (!bv || typeof bv !== "string") {
                    return null
                }
                bv = D.trim(bv);
                if (be.JSON && be.JSON.parse) {
                    return be.JSON.parse(bv)
                }
                if (k.test(bv.replace(a6, "@").replace(L, "]").replace(u, ""))) {
                    return (new Function("return " + bv))()
                }
                D.error("Invalid JSON: " + bv)
            },
            parseXML: function(bx) {
                var bv, bw;
                if (!bx || typeof bx !== "string") {
                    return null
                }
                try {
                    if (be.DOMParser) {
                        bw = new DOMParser();
                        bv = bw.parseFromString(bx, "text/xml")
                    } else {
                        bv = new ActiveXObject("Microsoft.XMLDOM");
                        bv.async = "false";
                        bv.loadXML(bx)
                    }
                } catch (by) {
                    bv = H
                }
                if (!bv || !bv.documentElement || bv.getElementsByTagName("parsererror").length) {
                    D.error("Invalid XML: " + bx)
                }
                return bv
            },
            noop: function() {},
            globalEval: function(bv) {
                if (bv && au.test(bv)) {
                    (be.execScript || function(bw) {
                        be["eval"].call(be, bw)
                    })(bv)
                }
            },
            camelCase: function(bv) {
                return bv.replace(av, "ms-").replace(aT, n)
            },
            nodeName: function(bw, bv) {
                return bw.nodeName && bw.nodeName.toLowerCase() === bv.toLowerCase()
            },
            each: function(bA, bB, bx) {
                var bw, by = 0,
                    bz = bA.length,
                    bv = bz === H || D.isFunction(bA);
                if (bx) {
                    if (bv) {
                        for (bw in bA) {
                            if (bB.apply(bA[bw], bx) === false) {
                                break
                            }
                        }
                    } else {
                        for (; by < bz;) {
                            if (bB.apply(bA[by++], bx) === false) {
                                break
                            }
                        }
                    }
                } else {
                    if (bv) {
                        for (bw in bA) {
                            if (bB.call(bA[bw], bw, bA[bw]) === false) {
                                break
                            }
                        }
                    } else {
                        for (; by < bz;) {
                            if (bB.call(bA[by], by, bA[by++]) === false) {
                                break
                            }
                        }
                    }
                }
                return bA
            },
            trim: ax && !ax.call("\uFEFF\xA0") ? function(bv) {
                return bv == null ? "" : ax.call(bv)
            } : function(bv) {
                return bv == null ? "" : (bv + "").replace(T, "")
            },
            makeArray: function(bv, bx) {
                var by, bw = bx || [];
                if (bv != null) {
                    by = D.type(bv);
                    if (bv.length == null || by === "string" || by === "function" || by === "regexp" || D.isWindow(bv)) {
                        aS.call(bw, bv)
                    } else {
                        D.merge(bw, bv)
                    }
                }
                return bw
            },
            inArray: function(by, bw, bx) {
                var bv;
                if (bw) {
                    if (aB) {
                        return aB.call(bw, by, bx)
                    }
                    bv = bw.length;
                    bx = bx ? bx < 0 ? Math.max(0, bv + bx) : bx : 0;
                    for (; bx < bv; bx++) {
                        if (bx in bw && bw[bx] === by) {
                            return bx
                        }
                    }
                }
                return -1
            },
            merge: function(bz, bx) {
                var bv = bx.length,
                    by = bz.length,
                    bw = 0;
                if (typeof bv === "number") {
                    for (; bw < bv; bw++) {
                        bz[by++] = bx[bw]
                    }
                } else {
                    while (bx[bw] !== H) {
                        bz[by++] = bx[bw++]
                    }
                }
                bz.length = by;
                return bz
            },
            grep: function(bw, bB, bv) {
                var bA, bx = [],
                    by = 0,
                    bz = bw.length;
                bv = !!bv;
                for (; by < bz; by++) {
                    bA = !!bB(bw[by], by);
                    if (bv !== bA) {
                        bx.push(bw[by])
                    }
                }
                return bx
            },
            map: function(bv, bC, bD) {
                var bA, bB, bz = [],
                    bx = 0,
                    bw = bv.length,
                    by = bv instanceof D || bw !== H && typeof bw === "number" && ((bw > 0 && bv[0] && bv[bw - 1]) || bw === 0 || D.isArray(bv));
                if (by) {
                    for (; bx < bw; bx++) {
                        bA = bC(bv[bx], bx, bD);
                        if (bA != null) {
                            bz[bz.length] = bA
                        }
                    }
                } else {
                    for (bB in bv) {
                        bA = bC(bv[bB], bB, bD);
                        if (bA != null) {
                            bz[bz.length] = bA
                        }
                    }
                }
                return bz.concat.apply([], bz)
            },
            guid: 1,
            proxy: function(bz, by) {
                var bx, bv, bw;
                if (typeof by === "string") {
                    bx = bz[by];
                    by = bz;
                    bz = bx
                }
                if (!D.isFunction(bz)) {
                    return H
                }
                bv = aE.call(arguments, 2);
                bw = function() {
                    return bz.apply(by, bv.concat(aE.call(arguments)))
                };
                bw.guid = bz.guid = bz.guid || D.guid++;
                return bw
            },
            access: function(bv, bB, bE, bC, bz, bF, bD) {
                var bx, bA = bE == null,
                    by = 0,
                    bw = bv.length;
                if (bE && typeof bE === "object") {
                    for (by in bE) {
                        D.access(bv, bB, by, bE[by], 1, bF, bC)
                    }
                    bz = 1
                } else {
                    if (bC !== H) {
                        bx = bD === H && D.isFunction(bC);
                        if (bA) {
                            if (bx) {
                                bx = bB;
                                bB = function(bH, bG, bI) {
                                    return bx.call(D(bH), bI)
                                }
                            } else {
                                bB.call(bv, bC);
                                bB = null
                            }
                        }
                        if (bB) {
                            for (; by < bw; by++) {
                                bB(bv[by], bE, bx ? bC.call(bv[by], by, bB(bv[by], bE)) : bC, bD)
                            }
                        }
                        bz = 1
                    }
                }
                return bz ? bv : bA ? bB.call(bv) : bw ? bB(bv[0], bE) : bF
            },
            now: function() {
                return (new Date()).getTime()
            }
        });
        D.ready.promise = function(by) {
            if (!ao) {
                ao = D.Deferred();
                if (al.readyState === "complete") {
                    setTimeout(D.ready, 1)
                } else {
                    if (al.addEventListener) {
                        al.addEventListener("DOMContentLoaded", a5, false);
                        be.addEventListener("load", D.ready, false)
                    } else {
                        al.attachEvent("onreadystatechange", a5);
                        be.attachEvent("onload", D.ready);
                        var bx = false;
                        try {
                            bx = be.frameElement == null && al.documentElement
                        } catch (bw) {}
                        if (bx && bx.doScroll) {
                            (function bv() {
                                if (!D.isReady) {
                                    try {
                                        bx.doScroll("left")
                                    } catch (bz) {
                                        return setTimeout(bv, 50)
                                    }
                                    D.ready()
                                }
                            })()
                        }
                    }
                }
            }
            return ao.promise(by)
        };
        D.each("Boolean Number String Function Array Date RegExp Object".split(" "), function(bw, bv) {
            a1["[object " + bv + "]"] = bv.toLowerCase()
        });
        r = D(al);
        var aY = {};

        function C(bw) {
            var bv = aY[bw] = {};
            D.each(bw.split(a9), function(by, bx) {
                bv[bx] = true
            });
            return bv
        }
        D.Callbacks = function(bF) {
            bF = typeof bF === "string" ? (aY[bF] || C(bF)) : D.extend({}, bF);
            var by, bv, bz, bx, bA, bB, bC = [],
                bD = !bF.once && [],
                bw = function(bG) {
                    by = bF.memory && bG;
                    bv = true;
                    bB = bx || 0;
                    bx = 0;
                    bA = bC.length;
                    bz = true;
                    for (; bC && bB < bA; bB++) {
                        if (bC[bB].apply(bG[0], bG[1]) === false && bF.stopOnFalse) {
                            by = false;
                            break
                        }
                    }
                    bz = false;
                    if (bC) {
                        if (bD) {
                            if (bD.length) {
                                bw(bD.shift())
                            }
                        } else {
                            if (by) {
                                bC = []
                            } else {
                                bE.disable()
                            }
                        }
                    }
                },
                bE = {
                    add: function() {
                        if (bC) {
                            var bH = bC.length;
                            (function bG(bI) {
                                D.each(bI, function(bK, bJ) {
                                    var bL = D.type(bJ);
                                    if (bL === "function") {
                                        if (!bF.unique || !bE.has(bJ)) {
                                            bC.push(bJ)
                                        }
                                    } else {
                                        if (bJ && bJ.length && bL !== "string") {
                                            bG(bJ)
                                        }
                                    }
                                })
                            })(arguments);
                            if (bz) {
                                bA = bC.length
                            } else {
                                if (by) {
                                    bx = bH;
                                    bw(by)
                                }
                            }
                        }
                        return this
                    },
                    remove: function() {
                        if (bC) {
                            D.each(arguments, function(bI, bG) {
                                var bH;
                                while ((bH = D.inArray(bG, bC, bH)) > -1) {
                                    bC.splice(bH, 1);
                                    if (bz) {
                                        if (bH <= bA) {
                                            bA--
                                        }
                                        if (bH <= bB) {
                                            bB--
                                        }
                                    }
                                }
                            })
                        }
                        return this
                    },
                    has: function(bG) {
                        return D.inArray(bG, bC) > -1
                    },
                    empty: function() {
                        bC = [];
                        return this
                    },
                    disable: function() {
                        bC = bD = by = H;
                        return this
                    },
                    disabled: function() {
                        return !bC
                    },
                    lock: function() {
                        bD = H;
                        if (!by) {
                            bE.disable()
                        }
                        return this
                    },
                    locked: function() {
                        return !bD
                    },
                    fireWith: function(bH, bG) {
                        bG = bG || [];
                        bG = [bH, bG.slice ? bG.slice() : bG];
                        if (bC && (!bv || bD)) {
                            if (bz) {
                                bD.push(bG)
                            } else {
                                bw(bG)
                            }
                        }
                        return this
                    },
                    fire: function() {
                        bE.fireWith(this, arguments);
                        return this
                    },
                    fired: function() {
                        return !!bv
                    }
                };
            return bE
        };
        D.extend({
            Deferred: function(bx) {
                var bw = [
                        ["resolve", "done", D.Callbacks("once memory"), "resolved"],
                        ["reject", "fail", D.Callbacks("once memory"), "rejected"],
                        ["notify", "progress", D.Callbacks("memory")]
                    ],
                    by = "pending",
                    bz = {
                        state: function() {
                            return by
                        },
                        always: function() {
                            bv.done(arguments).fail(arguments);
                            return this
                        },
                        then: function() {
                            var bA = arguments;
                            return D.Deferred(function(bB) {
                                D.each(bw, function(bD, bC) {
                                    var bF = bC[0],
                                        bE = bA[bD];
                                    bv[bC[1]](D.isFunction(bE) ? function() {
                                        var bG = bE.apply(this, arguments);
                                        if (bG && D.isFunction(bG.promise)) {
                                            bG.promise().done(bB.resolve).fail(bB.reject).progress(bB.notify)
                                        } else {
                                            bB[bF + "With"](this === bv ? bB : this, [bG])
                                        }
                                    } : bB[bF])
                                });
                                bA = null
                            }).promise()
                        },
                        promise: function(bA) {
                            return bA != null ? D.extend(bA, bz) : bz
                        }
                    },
                    bv = {};
                bz.pipe = bz.then;
                D.each(bw, function(bB, bA) {
                    var bD = bA[2],
                        bC = bA[3];
                    bz[bA[1]] = bD.add;
                    if (bC) {
                        bD.add(function() {
                            by = bC
                        }, bw[bB ^ 1][2].disable, bw[2][2].lock)
                    }
                    bv[bA[0]] = bD.fire;
                    bv[bA[0] + "With"] = bD.fireWith
                });
                bz.promise(bv);
                if (bx) {
                    bx.call(bv, bv)
                }
                return bv
            },
            when: function(bz) {
                var bx = 0,
                    bB = aE.call(arguments),
                    bv = bB.length,
                    bw = bv !== 1 || (bz && D.isFunction(bz.promise)) ? bv : 0,
                    bE = bw === 1 ? bz : D.Deferred(),
                    by = function(bG, bH, bF) {
                        return function(bI) {
                            bH[bG] = this;
                            bF[bG] = arguments.length > 1 ? aE.call(arguments) : bI;
                            if (bF === bD) {
                                bE.notifyWith(bH, bF)
                            } else {
                                if (!(--bw)) {
                                    bE.resolveWith(bH, bF)
                                }
                            }
                        }
                    },
                    bD, bA, bC;
                if (bv > 1) {
                    bD = new Array(bv);
                    bA = new Array(bv);
                    bC = new Array(bv);
                    for (; bx < bv; bx++) {
                        if (bB[bx] && D.isFunction(bB[bx].promise)) {
                            bB[bx].promise().done(by(bx, bC, bB)).fail(bE.reject).progress(by(bx, bA, bD))
                        } else {
                            --bw
                        }
                    }
                }
                if (!bw) {
                    bE.resolveWith(bC, bB)
                }
                return bE.promise()
            }
        });
        D.support = (function() {
            var bH, bG, bE, bF, by, bD, bC, bA, bz, bx, bv, bw = al.createElement("div");
            bw.setAttribute("className", "t");
            bw.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>";
            bG = bw.getElementsByTagName("*");
            bE = bw.getElementsByTagName("a")[0];
            if (!bG || !bE || !bG.length) {
                return {}
            }
            bF = al.createElement("select");
            by = bF.appendChild(al.createElement("option"));
            bD = bw.getElementsByTagName("input")[0];
            bE.style.cssText = "top:1px;float:left;opacity:.5";
            bH = {
                leadingWhitespace: (bw.firstChild.nodeType === 3),
                tbody: !bw.getElementsByTagName("tbody").length,
                htmlSerialize: !!bw.getElementsByTagName("link").length,
                style: /top/.test(bE.getAttribute("style")),
                hrefNormalized: (bE.getAttribute("href") === "/a"),
                opacity: /^0.5/.test(bE.style.opacity),
                cssFloat: !!bE.style.cssFloat,
                checkOn: (bD.value === "on"),
                optSelected: by.selected,
                getSetAttribute: bw.className !== "t",
                enctype: !!al.createElement("form").enctype,
                html5Clone: al.createElement("nav").cloneNode(true).outerHTML !== "<:nav></:nav>",
                boxModel: (al.compatMode === "CSS1Compat"),
                submitBubbles: true,
                changeBubbles: true,
                focusinBubbles: false,
                deleteExpando: true,
                noCloneEvent: true,
                inlineBlockNeedsLayout: false,
                shrinkWrapBlocks: false,
                reliableMarginRight: true,
                boxSizingReliable: true,
                pixelPosition: false
            };
            bD.checked = true;
            bH.noCloneChecked = bD.cloneNode(true).checked;
            bF.disabled = true;
            bH.optDisabled = !by.disabled;
            try {
                delete bw.test
            } catch (bB) {
                bH.deleteExpando = false
            }
            if (!bw.addEventListener && bw.attachEvent && bw.fireEvent) {
                bw.attachEvent("onclick", bv = function() {
                    bH.noCloneEvent = false
                });
                bw.cloneNode(true).fireEvent("onclick");
                bw.detachEvent("onclick", bv)
            }
            bD = al.createElement("input");
            bD.value = "t";
            bD.setAttribute("type", "radio");
            bH.radioValue = bD.value === "t";
            bD.setAttribute("checked", "checked");
            bD.setAttribute("name", "t");
            bw.appendChild(bD);
            bC = al.createDocumentFragment();
            bC.appendChild(bw.lastChild);
            bH.checkClone = bC.cloneNode(true).cloneNode(true).lastChild.checked;
            bH.appendChecked = bD.checked;
            bC.removeChild(bD);
            bC.appendChild(bw);
            if (bw.attachEvent) {
                for (bz in {
                        submit: true,
                        change: true,
                        focusin: true
                    }) {
                    bA = "on" + bz;
                    bx = (bA in bw);
                    if (!bx) {
                        bw.setAttribute(bA, "return;");
                        bx = (typeof bw[bA] === "function")
                    }
                    bH[bz + "Bubbles"] = bx
                }
            }
            D(function() {
                var bJ, bN, bL, bM, bK = "padding:0;margin:0;border:0;display:block;overflow:hidden;",
                    bI = al.getElementsByTagName("body")[0];
                if (!bI) {
                    return
                }
                bJ = al.createElement("div");
                bJ.style.cssText = "visibility:hidden;border:0;width:0;height:0;position:static;top:0;margin-top:1px";
                bI.insertBefore(bJ, bI.firstChild);
                bN = al.createElement("div");
                bJ.appendChild(bN);
                bN.innerHTML = "<table><tr><td></td><td>t</td></tr></table>";
                bL = bN.getElementsByTagName("td");
                bL[0].style.cssText = "padding:0;margin:0;border:0;display:none";
                bx = (bL[0].offsetHeight === 0);
                bL[0].style.display = "";
                bL[1].style.display = "none";
                bH.reliableHiddenOffsets = bx && (bL[0].offsetHeight === 0);
                bN.innerHTML = "";
                bN.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;";
                bH.boxSizing = (bN.offsetWidth === 4);
                bH.doesNotIncludeMarginInBodyOffset = (bI.offsetTop !== 1);
                if (be.getComputedStyle) {
                    bH.pixelPosition = (be.getComputedStyle(bN, null) || {}).top !== "1%";
                    bH.boxSizingReliable = (be.getComputedStyle(bN, null) || {
                        width: "4px"
                    }).width === "4px";
                    bM = al.createElement("div");
                    bM.style.cssText = bN.style.cssText = bK;
                    bM.style.marginRight = bM.style.width = "0";
                    bN.style.width = "1px";
                    bN.appendChild(bM);
                    bH.reliableMarginRight = !parseFloat((be.getComputedStyle(bM, null) || {}).marginRight)
                }
                if (typeof bN.style.zoom !== "undefined") {
                    bN.innerHTML = "";
                    bN.style.cssText = bK + "width:1px;padding:1px;display:inline;zoom:1";
                    bH.inlineBlockNeedsLayout = (bN.offsetWidth === 3);
                    bN.style.display = "block";
                    bN.style.overflow = "visible";
                    bN.innerHTML = "<div></div>";
                    bN.firstChild.style.width = "5px";
                    bH.shrinkWrapBlocks = (bN.offsetWidth !== 3);
                    bJ.style.zoom = 1
                }
                bI.removeChild(bJ);
                bJ = bN = bL = bM = null
            });
            bC.removeChild(bw);
            bG = bE = bF = by = bD = bC = bw = null;
            return bH
        })();
        var aL = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
            ar = /([A-Z])/g;
        D.extend({
            cache: {},
            deletedIds: [],
            uuid: 0,
            expando: "JQXLite" + (D.fn.jqx + Math.random()).replace(/\D/g, ""),
            noData: {
                embed: true,
                object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000",
                applet: true
            },
            hasData: function(bv) {
                bv = bv.nodeType ? D.cache[bv[D.expando]] : bv[D.expando];
                return !!bv && !N(bv)
            },
            data: function(by, bw, bA, bz) {
                if (!D.acceptData(by)) {
                    return
                }
                var bB, bD, bE = D.expando,
                    bC = typeof bw === "string",
                    bF = by.nodeType,
                    bv = bF ? D.cache : by,
                    bx = bF ? by[bE] : by[bE] && bE;
                if ((!bx || !bv[bx] || (!bz && !bv[bx].data)) && bC && bA === H) {
                    return
                }
                if (!bx) {
                    if (bF) {
                        by[bE] = bx = D.deletedIds.pop() || D.guid++
                    } else {
                        bx = bE
                    }
                }
                if (!bv[bx]) {
                    bv[bx] = {};
                    if (!bF) {
                        bv[bx].toJSON = D.noop
                    }
                }
                if (typeof bw === "object" || typeof bw === "function") {
                    if (bz) {
                        bv[bx] = D.extend(bv[bx], bw)
                    } else {
                        bv[bx].data = D.extend(bv[bx].data, bw)
                    }
                }
                bB = bv[bx];
                if (!bz) {
                    if (!bB.data) {
                        bB.data = {}
                    }
                    bB = bB.data
                }
                if (bA !== H) {
                    bB[D.camelCase(bw)] = bA
                }
                if (bC) {
                    bD = bB[bw];
                    if (bD == null) {
                        bD = bB[D.camelCase(bw)]
                    }
                } else {
                    bD = bB
                }
                return bD
            },
            removeData: function(by, bw, bz) {
                if (!D.acceptData(by)) {
                    return
                }
                var bC, bB, bA, bD = by.nodeType,
                    bv = bD ? D.cache : by,
                    bx = bD ? by[D.expando] : D.expando;
                if (!bv[bx]) {
                    return
                }
                if (bw) {
                    bC = bz ? bv[bx] : bv[bx].data;
                    if (bC) {
                        if (!D.isArray(bw)) {
                            if (bw in bC) {
                                bw = [bw]
                            } else {
                                bw = D.camelCase(bw);
                                if (bw in bC) {
                                    bw = [bw]
                                } else {
                                    bw = bw.split(" ")
                                }
                            }
                        }
                        for (bB = 0, bA = bw.length; bB < bA; bB++) {
                            delete bC[bw[bB]]
                        }
                        if (!(bz ? N : D.isEmptyObject)(bC)) {
                            return
                        }
                    }
                }
                if (!bz) {
                    delete bv[bx].data;
                    if (!N(bv[bx])) {
                        return
                    }
                }
                if (bD) {
                    D.cleanData([by], true)
                } else {
                    if (D.support.deleteExpando || bv != bv.window) {
                        delete bv[bx]
                    } else {
                        bv[bx] = null
                    }
                }
            },
            _data: function(bw, bv, bx) {
                return D.data(bw, bv, bx, true)
            },
            acceptData: function(bw) {
                var bv = bw.nodeName && D.noData[bw.nodeName.toLowerCase()];
                return !bv || bv !== true && bw.getAttribute("classid") === bv
            }
        });
        D.fn.extend({
            data: function(bE, bD) {
                var bz, bw, bC, bv, by, bx = this[0],
                    bB = 0,
                    bA = null;
                if (bE === H) {
                    if (this.length) {
                        bA = D.data(bx);
                        if (bx.nodeType === 1 && !D._data(bx, "parsedAttrs")) {
                            bC = bx.attributes;
                            for (by = bC.length; bB < by; bB++) {
                                bv = bC[bB].name;
                                if (!bv.indexOf("data-")) {
                                    bv = D.camelCase(bv.substring(5));
                                    ba(bx, bv, bA[bv])
                                }
                            }
                            D._data(bx, "parsedAttrs", true)
                        }
                    }
                    return bA
                }
                if (typeof bE === "object") {
                    return this.each(function() {
                        D.data(this, bE)
                    })
                }
                bz = bE.split(".", 2);
                bz[1] = bz[1] ? "." + bz[1] : "";
                bw = bz[1] + "!";
                return D.access(this, function(bF) {
                    if (bF === H) {
                        bA = this.triggerHandler("getData" + bw, [bz[0]]);
                        if (bA === H && bx) {
                            bA = D.data(bx, bE);
                            bA = ba(bx, bE, bA)
                        }
                        return bA === H && bz[1] ? this.data(bz[0]) : bA
                    }
                    bz[1] = bF;
                    this.each(function() {
                        var bG = D(this);
                        bG.triggerHandler("setData" + bw, bz);
                        D.data(this, bE, bF);
                        bG.triggerHandler("changeData" + bw, bz)
                    })
                }, null, bD, arguments.length > 1, null, false)
            },
            removeData: function(bv) {
                return this.each(function() {
                    D.removeData(this, bv)
                })
            }
        });

        function ba(bx, bw, by) {
            if (by === H && bx.nodeType === 1) {
                var bv = "data-" + bw.replace(ar, "-$1").toLowerCase();
                by = bx.getAttribute(bv);
                if (typeof by === "string") {
                    try {
                        by = by === "true" ? true : by === "false" ? false : by === "null" ? null : +by + "" === by ? +by : aL.test(by) ? D.parseJSON(by) : by
                    } catch (bz) {}
                    D.data(bx, bw, by)
                } else {
                    by = H
                }
            }
            return by
        }

        function N(bw) {
            var bv;
            for (bv in bw) {
                if (bv === "data" && D.isEmptyObject(bw[bv])) {
                    continue
                }
                if (bv !== "toJSON") {
                    return false
                }
            }
            return true
        }
        D.extend({
            queue: function(bx, bw, by) {
                var bv;
                if (bx) {
                    bw = (bw || "fx") + "queue";
                    bv = D._data(bx, bw);
                    if (by) {
                        if (!bv || D.isArray(by)) {
                            bv = D._data(bx, bw, D.makeArray(by))
                        } else {
                            bv.push(by)
                        }
                    }
                    return bv || []
                }
            },
            dequeue: function(bA, bz) {
                bz = bz || "fx";
                var bw = D.queue(bA, bz),
                    bB = bw.length,
                    by = bw.shift(),
                    bv = D._queueHooks(bA, bz),
                    bx = function() {
                        D.dequeue(bA, bz)
                    };
                if (by === "inprogress") {
                    by = bw.shift();
                    bB--
                }
                if (by) {
                    if (bz === "fx") {
                        bw.unshift("inprogress")
                    }
                    delete bv.stop;
                    by.call(bA, bx, bv)
                }
                if (!bB && bv) {
                    bv.empty.fire()
                }
            },
            _queueHooks: function(bx, bw) {
                var bv = bw + "queueHooks";
                return D._data(bx, bv) || D._data(bx, bv, {
                    empty: D.Callbacks("once memory").add(function() {
                        D.removeData(bx, bw + "queue", true);
                        D.removeData(bx, bv, true)
                    })
                })
            }
        });
        D.fn.extend({
            queue: function(bv, bw) {
                var bx = 2;
                if (typeof bv !== "string") {
                    bw = bv;
                    bv = "fx";
                    bx--
                }
                if (arguments.length < bx) {
                    return D.queue(this[0], bv)
                }
                return bw === H ? this : this.each(function() {
                    var by = D.queue(this, bv, bw);
                    D._queueHooks(this, bv);
                    if (bv === "fx" && by[0] !== "inprogress") {
                        D.dequeue(this, bv)
                    }
                })
            },
            dequeue: function(bv) {
                return this.each(function() {
                    D.dequeue(this, bv)
                })
            },
            delay: function(bw, bv) {
                bw = D.fx ? D.fx.speeds[bw] || bw : bw;
                bv = bv || "fx";
                return this.queue(bv, function(by, bx) {
                    var bz = setTimeout(by, bw);
                    bx.stop = function() {
                        clearTimeout(bz)
                    }
                })
            },
            clearQueue: function(bv) {
                return this.queue(bv || "fx", [])
            },
            promise: function(bx, bB) {
                var bw, by = 1,
                    bC = D.Deferred(),
                    bA = this,
                    bv = this.length,
                    bz = function() {
                        if (!(--by)) {
                            bC.resolveWith(bA, [bA])
                        }
                    };
                if (typeof bx !== "string") {
                    bB = bx;
                    bx = H
                }
                bx = bx || "fx";
                while (bv--) {
                    bw = D._data(bA[bv], bx + "queueHooks");
                    if (bw && bw.empty) {
                        by++;
                        bw.empty.add(bz)
                    }
                }
                bz();
                return bC.promise(bB)
            }
        });
        var bi, aU, az, aJ = /[\t\r\n]/g,
            aQ = /\r/g,
            d = /^(?:button|input)$/i,
            A = /^(?:button|input|object|select|textarea)$/i,
            h = /^a(?:rea|)$/i,
            af = /^(?:autofocus|autoplay|async|checked|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped|selected)$/i,
            B = D.support.getSetAttribute;
        D.fn.extend({
            attr: function(bv, bw) {
                return D.access(this, D.attr, bv, bw, arguments.length > 1)
            },
            removeAttr: function(bv) {
                return this.each(function() {
                    D.removeAttr(this, bv)
                })
            },
            prop: function(bv, bw) {
                return D.access(this, D.prop, bv, bw, arguments.length > 1)
            },
            removeProp: function(bv) {
                bv = D.propFix[bv] || bv;
                return this.each(function() {
                    try {
                        this[bv] = H;
                        delete this[bv]
                    } catch (bw) {}
                })
            },
            addClass: function(bz) {
                var bB, bx, bw, by, bA, bC, bv;
                if (D.isFunction(bz)) {
                    return this.each(function(bD) {
                        D(this).addClass(bz.call(this, bD, this.className))
                    })
                }
                if (bz && typeof bz === "string") {
                    bB = bz.split(a9);
                    for (bx = 0, bw = this.length; bx < bw; bx++) {
                        by = this[bx];
                        if (by.nodeType === 1) {
                            if (!by.className && bB.length === 1) {
                                by.className = bz
                            } else {
                                bA = " " + by.className + " ";
                                for (bC = 0, bv = bB.length; bC < bv; bC++) {
                                    if (bA.indexOf(" " + bB[bC] + " ") < 0) {
                                        bA += bB[bC] + " "
                                    }
                                }
                                by.className = D.trim(bA)
                            }
                        }
                    }
                }
                return this
            },
            removeClass: function(bB) {
                var by, bz, bA, bC, bw, bx, bv;
                if (D.isFunction(bB)) {
                    return this.each(function(bD) {
                        D(this).removeClass(bB.call(this, bD, this.className))
                    })
                }
                if ((bB && typeof bB === "string") || bB === H) {
                    by = (bB || "").split(a9);
                    for (bx = 0, bv = this.length; bx < bv; bx++) {
                        bA = this[bx];
                        if (bA.nodeType === 1 && bA.className) {
                            bz = (" " + bA.className + " ").replace(aJ, " ");
                            for (bC = 0, bw = by.length; bC < bw; bC++) {
                                while (bz.indexOf(" " + by[bC] + " ") >= 0) {
                                    bz = bz.replace(" " + by[bC] + " ", " ")
                                }
                            }
                            bA.className = bB ? D.trim(bz) : ""
                        }
                    }
                }
                return this
            },
            toggleClass: function(by, bw) {
                var bx = typeof by,
                    bv = typeof bw === "boolean";
                if (D.isFunction(by)) {
                    return this.each(function(bz) {
                        D(this).toggleClass(by.call(this, bz, this.className, bw), bw)
                    })
                }
                return this.each(function() {
                    if (bx === "string") {
                        var bB, bA = 0,
                            bz = D(this),
                            bC = bw,
                            bD = by.split(a9);
                        while ((bB = bD[bA++])) {
                            bC = bv ? bC : !bz.hasClass(bB);
                            bz[bC ? "addClass" : "removeClass"](bB)
                        }
                    } else {
                        if (bx === "undefined" || bx === "boolean") {
                            if (this.className) {
                                D._data(this, "__className__", this.className)
                            }
                            this.className = this.className || by === false ? "" : D._data(this, "__className__") || ""
                        }
                    }
                })
            },
            hasClass: function(bv) {
                var by = " " + bv + " ",
                    bx = 0,
                    bw = this.length;
                for (; bx < bw; bx++) {
                    if (this[bx].nodeType === 1 && (" " + this[bx].className + " ").replace(aJ, " ").indexOf(by) >= 0) {
                        return true
                    }
                }
                return false
            },
            val: function(by) {
                var bv, bw, bz, bx = this[0];
                if (!arguments.length) {
                    if (bx) {
                        bv = D.valHooks[bx.type] || D.valHooks[bx.nodeName.toLowerCase()];
                        if (bv && "get" in bv && (bw = bv.get(bx, "value")) !== H) {
                            return bw
                        }
                        bw = bx.value;
                        return typeof bw === "string" ? bw.replace(aQ, "") : bw == null ? "" : bw
                    }
                    return
                }
                bz = D.isFunction(by);
                return this.each(function(bB) {
                    var bC, bA = D(this);
                    if (this.nodeType !== 1) {
                        return
                    }
                    if (bz) {
                        bC = by.call(this, bB, bA.val())
                    } else {
                        bC = by
                    }
                    if (bC == null) {
                        bC = ""
                    } else {
                        if (typeof bC === "number") {
                            bC += ""
                        } else {
                            if (D.isArray(bC)) {
                                bC = D.map(bC, function(bD) {
                                    return bD == null ? "" : bD + ""
                                })
                            }
                        }
                    }
                    bv = D.valHooks[this.type] || D.valHooks[this.nodeName.toLowerCase()];
                    if (!bv || !("set" in bv) || bv.set(this, bC, "value") === H) {
                        this.value = bC
                    }
                })
            }
        });
        D.extend({
            valHooks: {
                option: {
                    get: function(bv) {
                        var bw = bv.attributes.value;
                        return !bw || bw.specified ? bv.value : bv.text
                    }
                },
                select: {
                    get: function(bv) {
                        var bB, bx, bD = bv.options,
                            bz = bv.selectedIndex,
                            by = bv.type === "select-one" || bz < 0,
                            bC = by ? null : [],
                            bA = by ? bz + 1 : bD.length,
                            bw = bz < 0 ? bA : by ? bz : 0;
                        for (; bw < bA; bw++) {
                            bx = bD[bw];
                            if ((bx.selected || bw === bz) && (D.support.optDisabled ? !bx.disabled : bx.getAttribute("disabled") === null) && (!bx.parentNode.disabled || !D.nodeName(bx.parentNode, "optgroup"))) {
                                bB = D(bx).val();
                                if (by) {
                                    return bB
                                }
                                bC.push(bB)
                            }
                        }
                        return bC
                    },
                    set: function(bw, bx) {
                        var bv = D.makeArray(bx);
                        D(bw).find("option").each(function() {
                            this.selected = D.inArray(D(this).val(), bv) >= 0
                        });
                        if (!bv.length) {
                            bw.selectedIndex = -1
                        }
                        return bv
                    }
                }
            },
            attrFn: {},
            attr: function(bB, by, bC, bA) {
                var bx, bv, bz, bw = bB.nodeType;
                if (!bB || bw === 3 || bw === 8 || bw === 2) {
                    return
                }
                if (bA && D.isFunction(D.fn[by])) {
                    return D(bB)[by](bC)
                }
                if (typeof bB.getAttribute === "undefined") {
                    return D.prop(bB, by, bC)
                }
                bz = bw !== 1 || !D.isXMLDoc(bB);
                if (bz) {
                    by = by.toLowerCase();
                    bv = D.attrHooks[by] || (af.test(by) ? aU : bi)
                }
                if (bC !== H) {
                    if (bC === null) {
                        D.removeAttr(bB, by);
                        return
                    } else {
                        if (bv && "set" in bv && bz && (bx = bv.set(bB, bC, by)) !== H) {
                            return bx
                        } else {
                            bB.setAttribute(by, bC + "");
                            return bC
                        }
                    }
                } else {
                    if (bv && "get" in bv && bz && (bx = bv.get(bB, by)) !== null) {
                        return bx
                    } else {
                        bx = bB.getAttribute(by);
                        return bx === null ? H : bx
                    }
                }
            },
            removeAttr: function(by, bA) {
                var bz, bB, bw, bv, bx = 0;
                if (bA && by.nodeType === 1) {
                    bB = bA.split(a9);
                    for (; bx < bB.length; bx++) {
                        bw = bB[bx];
                        if (bw) {
                            bz = D.propFix[bw] || bw;
                            bv = af.test(bw);
                            if (!bv) {
                                D.attr(by, bw, "")
                            }
                            by.removeAttribute(B ? bw : bz);
                            if (bv && bz in by) {
                                by[bz] = false
                            }
                        }
                    }
                }
            },
            attrHooks: {
                type: {
                    set: function(bv, bw) {
                        if (d.test(bv.nodeName) && bv.parentNode) {
                            D.error("type property can't be changed")
                        } else {
                            if (!D.support.radioValue && bw === "radio" && D.nodeName(bv, "input")) {
                                var bx = bv.value;
                                bv.setAttribute("type", bw);
                                if (bx) {
                                    bv.value = bx
                                }
                                return bw
                            }
                        }
                    }
                },
                value: {
                    get: function(bw, bv) {
                        if (bi && D.nodeName(bw, "button")) {
                            return bi.get(bw, bv)
                        }
                        return bv in bw ? bw.value : null
                    },
                    set: function(bw, bx, bv) {
                        if (bi && D.nodeName(bw, "button")) {
                            return bi.set(bw, bx, bv)
                        }
                        bw.value = bx
                    }
                }
            },
            propFix: {
                tabindex: "tabIndex",
                readonly: "readOnly",
                "for": "htmlFor",
                "class": "className",
                maxlength: "maxLength",
                cellspacing: "cellSpacing",
                cellpadding: "cellPadding",
                rowspan: "rowSpan",
                colspan: "colSpan",
                usemap: "useMap",
                frameborder: "frameBorder",
                contenteditable: "contentEditable"
            },
            prop: function(bA, by, bB) {
                var bx, bv, bz, bw = bA.nodeType;
                if (!bA || bw === 3 || bw === 8 || bw === 2) {
                    return
                }
                bz = bw !== 1 || !D.isXMLDoc(bA);
                if (bz) {
                    by = D.propFix[by] || by;
                    bv = D.propHooks[by]
                }
                if (bB !== H) {
                    if (bv && "set" in bv && (bx = bv.set(bA, bB, by)) !== H) {
                        return bx
                    } else {
                        return (bA[by] = bB)
                    }
                } else {
                    if (bv && "get" in bv && (bx = bv.get(bA, by)) !== null) {
                        return bx
                    } else {
                        return bA[by]
                    }
                }
            },
            propHooks: {
                tabIndex: {
                    get: function(bw) {
                        var bv = bw.getAttributeNode("tabindex");
                        return bv && bv.specified ? parseInt(bv.value, 10) : A.test(bw.nodeName) || h.test(bw.nodeName) && bw.href ? 0 : H
                    }
                }
            }
        });
        aU = {
            get: function(bw, bv) {
                var by, bx = D.prop(bw, bv);
                return bx === true || typeof bx !== "boolean" && (by = bw.getAttributeNode(bv)) && by.nodeValue !== false ? bv.toLowerCase() : H
            },
            set: function(bw, by, bv) {
                var bx;
                if (by === false) {
                    D.removeAttr(bw, bv)
                } else {
                    bx = D.propFix[bv] || bv;
                    if (bx in bw) {
                        bw[bx] = true
                    }
                    bw.setAttribute(bv, bv.toLowerCase())
                }
                return bv
            }
        };
        if (!D.support.enctype) {
            D.propFix.enctype = "encoding"
        }
        var bg = /^(?:textarea|input|select)$/i,
            o = /^([^\.]*|)(?:\.(.+)|)$/,
            G = /(?:^|\s)hover(\.\S+|)\b/,
            aI = /^key/,
            bj = /^(?:mouse|contextmenu)|click/,
            O = /^(?:focusinfocus|focusoutblur)$/,
            bt = function(bv) {
                return D.event.special.hover ? bv : bv.replace(G, "mouseenter$1 mouseleave$1")
            };
        D.event = {
            add: function(by, bC, bJ, bA, bz) {
                var bD, bB, bK, bI, bH, bF, bv, bG, bw, bx, bE;
                if (by.nodeType === 3 || by.nodeType === 8 || !bC || !bJ || !(bD = D._data(by))) {
                    return
                }
                if (bJ.handler) {
                    bw = bJ;
                    bJ = bw.handler;
                    bz = bw.selector
                }
                if (!bJ.guid) {
                    bJ.guid = D.guid++
                }
                bK = bD.events;
                if (!bK) {
                    bD.events = bK = {}
                }
                bB = bD.handle;
                if (!bB) {
                    bD.handle = bB = function(bL) {
                        return typeof D !== "undefined" && (!bL || D.event.triggered !== bL.type) ? D.event.dispatch.apply(bB.elem, arguments) : H
                    };
                    bB.elem = by
                }
                bC = D.trim(bt(bC)).split(" ");
                for (bI = 0; bI < bC.length; bI++) {
                    bH = o.exec(bC[bI]) || [];
                    bF = bH[1];
                    bv = (bH[2] || "").split(".").sort();
                    bE = D.event.special[bF] || {};
                    bF = (bz ? bE.delegateType : bE.bindType) || bF;
                    bE = D.event.special[bF] || {};
                    bG = D.extend({
                        type: bF,
                        origType: bH[1],
                        data: bA,
                        handler: bJ,
                        guid: bJ.guid,
                        selector: bz,
                        needsContext: bz && D.expr.match.needsContext.test(bz),
                        namespace: bv.join(".")
                    }, bw);
                    bx = bK[bF];
                    if (!bx) {
                        bx = bK[bF] = [];
                        bx.delegateCount = 0;
                        if (!bE.setup || bE.setup.call(by, bA, bv, bB) === false) {
                            if (by.addEventListener) {
                                by.addEventListener(bF, bB, false)
                            } else {
                                if (by.attachEvent) {
                                    by.attachEvent("on" + bF, bB)
                                }
                            }
                        }
                    }
                    if (bE.add) {
                        bE.add.call(by, bG);
                        if (!bG.handler.guid) {
                            bG.handler.guid = bJ.guid
                        }
                    }
                    if (bz) {
                        bx.splice(bx.delegateCount++, 0, bG)
                    } else {
                        bx.push(bG)
                    }
                    D.event.global[bF] = true
                }
                by = null
            },
            global: {},
            remove: function(by, bD, bJ, bz, bC) {
                var bK, bL, bG, bx, bw, bA, bB, bI, bF, bv, bH, bE = D.hasData(by) && D._data(by);
                if (!bE || !(bI = bE.events)) {
                    return
                }
                bD = D.trim(bt(bD || "")).split(" ");
                for (bK = 0; bK < bD.length; bK++) {
                    bL = o.exec(bD[bK]) || [];
                    bG = bx = bL[1];
                    bw = bL[2];
                    if (!bG) {
                        for (bG in bI) {
                            D.event.remove(by, bG + bD[bK], bJ, bz, true)
                        }
                        continue
                    }
                    bF = D.event.special[bG] || {};
                    bG = (bz ? bF.delegateType : bF.bindType) || bG;
                    bv = bI[bG] || [];
                    bA = bv.length;
                    bw = bw ? new RegExp("(^|\\.)" + bw.split(".").sort().join("\\.(?:.*\\.|)") + "(\\.|$)") : null;
                    for (bB = 0; bB < bv.length; bB++) {
                        bH = bv[bB];
                        if ((bC || bx === bH.origType) && (!bJ || bJ.guid === bH.guid) && (!bw || bw.test(bH.namespace)) && (!bz || bz === bH.selector || bz === "**" && bH.selector)) {
                            bv.splice(bB--, 1);
                            if (bH.selector) {
                                bv.delegateCount--
                            }
                            if (bF.remove) {
                                bF.remove.call(by, bH)
                            }
                        }
                    }
                    if (bv.length === 0 && bA !== bv.length) {
                        if (!bF.teardown || bF.teardown.call(by, bw, bE.handle) === false) {
                            D.removeEvent(by, bG, bE.handle)
                        }
                        delete bI[bG]
                    }
                }
                if (D.isEmptyObject(bI)) {
                    delete bE.handle;
                    D.removeData(by, "events", true)
                }
            },
            customEvent: {
                getData: true,
                setData: true,
                changeData: true
            },
            trigger: function(bw, bD, bB, bK) {
                if (bB && (bB.nodeType === 3 || bB.nodeType === 8)) {
                    return
                }
                var bv, by, bE, bI, bA, bz, bG, bF, bC, bJ, bH = bw.type || bw,
                    bx = [];
                if (O.test(bH + D.event.triggered)) {
                    return
                }
                if (bH.indexOf("!") >= 0) {
                    bH = bH.slice(0, -1);
                    by = true
                }
                if (bH.indexOf(".") >= 0) {
                    bx = bH.split(".");
                    bH = bx.shift();
                    bx.sort()
                }
                if ((!bB || D.event.customEvent[bH]) && !D.event.global[bH]) {
                    return
                }
                bw = typeof bw === "object" ? bw[D.expando] ? bw : new D.Event(bH, bw) : new D.Event(bH);
                bw.type = bH;
                bw.isTrigger = true;
                bw.exclusive = by;
                bw.namespace = bx.join(".");
                bw.namespace_re = bw.namespace ? new RegExp("(^|\\.)" + bx.join("\\.(?:.*\\.|)") + "(\\.|$)") : null;
                bz = bH.indexOf(":") < 0 ? "on" + bH : "";
                if (!bB) {
                    bv = D.cache;
                    for (bE in bv) {
                        if (bv[bE].events && bv[bE].events[bH]) {
                            D.event.trigger(bw, bD, bv[bE].handle.elem, true)
                        }
                    }
                    return
                }
                bw.result = H;
                if (!bw.target) {
                    bw.target = bB
                }
                bD = bD != null ? D.makeArray(bD) : [];
                bD.unshift(bw);
                bG = D.event.special[bH] || {};
                if (bG.trigger && bG.trigger.apply(bB, bD) === false) {
                    return
                }
                bC = [
                    [bB, bG.bindType || bH]
                ];
                if (!bK && !bG.noBubble && !D.isWindow(bB)) {
                    bJ = bG.delegateType || bH;
                    bI = O.test(bJ + bH) ? bB : bB.parentNode;
                    for (bA = bB; bI; bI = bI.parentNode) {
                        bC.push([bI, bJ]);
                        bA = bI
                    }
                    if (bA === (bB.ownerDocument || al)) {
                        bC.push([bA.defaultView || bA.parentWindow || be, bJ])
                    }
                }
                for (bE = 0; bE < bC.length && !bw.isPropagationStopped(); bE++) {
                    bI = bC[bE][0];
                    bw.type = bC[bE][1];
                    bF = (D._data(bI, "events") || {})[bw.type] && D._data(bI, "handle");
                    if (bF) {
                        bF.apply(bI, bD)
                    }
                    bF = bz && bI[bz];
                    if (bF && D.acceptData(bI) && bF.apply && bF.apply(bI, bD) === false) {
                        bw.preventDefault()
                    }
                }
                bw.type = bH;
                if (!bK && !bw.isDefaultPrevented()) {
                    if ((!bG._default || bG._default.apply(bB.ownerDocument, bD) === false) && !(bH === "click" && D.nodeName(bB, "a")) && D.acceptData(bB)) {
                        if (bz && bB[bH] && ((bH !== "focus" && bH !== "blur") || bw.target.offsetWidth !== 0) && !D.isWindow(bB)) {
                            bA = bB[bz];
                            if (bA) {
                                bB[bz] = null
                            }
                            D.event.triggered = bH;
                            bB[bH]();
                            D.event.triggered = H;
                            if (bA) {
                                bB[bz] = bA
                            }
                        }
                    }
                }
                return bw.result
            },
            dispatch: function(bv) {
                bv = D.event.fix(bv || be.event);
                var bC, bB, bL, bF, bE, bw, bD, bJ, by, bK, bz = ((D._data(this, "events") || {})[bv.type] || []),
                    bA = bz.delegateCount,
                    bH = aE.call(arguments),
                    bx = !bv.exclusive && !bv.namespace,
                    bG = D.event.special[bv.type] || {},
                    bI = [];
                bH[0] = bv;
                bv.delegateTarget = this;
                if (bG.preDispatch && bG.preDispatch.call(this, bv) === false) {
                    return
                }
                if (bA && !(bv.button && bv.type === "click")) {
                    for (bL = bv.target; bL != this; bL = bL.parentNode || this) {
                        if (bL.disabled !== true || bv.type !== "click") {
                            bE = {};
                            bD = [];
                            for (bC = 0; bC < bA; bC++) {
                                bJ = bz[bC];
                                by = bJ.selector;
                                if (bE[by] === H) {
                                    bE[by] = bJ.needsContext ? D(by, this).index(bL) >= 0 : D.find(by, this, null, [bL]).length
                                }
                                if (bE[by]) {
                                    bD.push(bJ)
                                }
                            }
                            if (bD.length) {
                                bI.push({
                                    elem: bL,
                                    matches: bD
                                })
                            }
                        }
                    }
                }
                if (bz.length > bA) {
                    bI.push({
                        elem: this,
                        matches: bz.slice(bA)
                    })
                }
                for (bC = 0; bC < bI.length && !bv.isPropagationStopped(); bC++) {
                    bw = bI[bC];
                    bv.currentTarget = bw.elem;
                    for (bB = 0; bB < bw.matches.length && !bv.isImmediatePropagationStopped(); bB++) {
                        bJ = bw.matches[bB];
                        if (bx || (!bv.namespace && !bJ.namespace) || bv.namespace_re && bv.namespace_re.test(bJ.namespace)) {
                            bv.data = bJ.data;
                            bv.handleObj = bJ;
                            bF = ((D.event.special[bJ.origType] || {}).handle || bJ.handler).apply(bw.elem, bH);
                            if (bF !== H) {
                                bv.result = bF;
                                if (bF === false) {
                                    bv.preventDefault();
                                    bv.stopPropagation()
                                }
                            }
                        }
                    }
                }
                if (bG.postDispatch) {
                    bG.postDispatch.call(this, bv)
                }
                return bv.result
            },
            props: "attrChange attrName relatedNode srcElement altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "),
                filter: function(bw, bv) {
                    if (bw.which == null) {
                        bw.which = bv.charCode != null ? bv.charCode : bv.keyCode
                    }
                    return bw
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function(by, bx) {
                    var bz, bA, bv, bw = bx.button,
                        bB = bx.fromElement;
                    if (by.pageX == null && bx.clientX != null) {
                        bz = by.target.ownerDocument || al;
                        bA = bz.documentElement;
                        bv = bz.body;
                        by.pageX = bx.clientX + (bA && bA.scrollLeft || bv && bv.scrollLeft || 0) - (bA && bA.clientLeft || bv && bv.clientLeft || 0);
                        by.pageY = bx.clientY + (bA && bA.scrollTop || bv && bv.scrollTop || 0) - (bA && bA.clientTop || bv && bv.clientTop || 0)
                    }
                    if (!by.relatedTarget && bB) {
                        by.relatedTarget = bB === by.target ? bx.toElement : bB
                    }
                    if (!by.which && bw !== H) {
                        by.which = (bw & 1 ? 1 : (bw & 2 ? 3 : (bw & 4 ? 2 : 0)))
                    }
                    return by
                }
            },
            fix: function(bx) {
                if (bx[D.expando]) {
                    return bx
                }
                var bw, bA, bv = bx,
                    by = D.event.fixHooks[bx.type] || {},
                    bz = by.props ? this.props.concat(by.props) : this.props;
                bx = D.Event(bv);
                for (bw = bz.length; bw;) {
                    bA = bz[--bw];
                    bx[bA] = bv[bA]
                }
                if (!bx.target) {
                    bx.target = bv.srcElement || al
                }
                if (bx.target.nodeType === 3) {
                    bx.target = bx.target.parentNode
                }
                bx.metaKey = !!bx.metaKey;
                return by.filter ? by.filter(bx, bv) : bx
            },
            special: {
                load: {
                    noBubble: true
                },
                focus: {
                    delegateType: "focusin"
                },
                blur: {
                    delegateType: "focusout"
                },
                beforeunload: {
                    setup: function(bx, bw, bv) {
                        if (D.isWindow(this)) {
                            this.onbeforeunload = bv
                        }
                    },
                    teardown: function(bw, bv) {
                        if (this.onbeforeunload === bv) {
                            this.onbeforeunload = null
                        }
                    }
                }
            },
            simulate: function(bw, by, bx, bv) {
                var bz = D.extend(new D.Event(), bx, {
                    type: bw,
                    isSimulated: true,
                    originalEvent: {}
                });
                if (bv) {
                    D.event.trigger(bz, null, by)
                } else {
                    D.event.dispatch.call(by, bz)
                }
                if (bz.isDefaultPrevented()) {
                    bx.preventDefault()
                }
            }
        };
        D.event.handle = D.event.dispatch;
        D.removeEvent = al.removeEventListener ? function(bw, bv, bx) {
            if (bw.removeEventListener) {
                bw.removeEventListener(bv, bx, false)
            }
        } : function(bx, bw, by) {
            var bv = "on" + bw;
            if (bx.detachEvent) {
                if (typeof bx[bv] === "undefined") {
                    bx[bv] = null
                }
                bx.detachEvent(bv, by)
            }
        };
        D.Event = function(bw, bv) {
            if (!(this instanceof D.Event)) {
                return new D.Event(bw, bv)
            }
            if (bw && bw.type) {
                this.originalEvent = bw;
                this.type = bw.type;
                this.isDefaultPrevented = (bw.defaultPrevented || bw.returnValue === false || bw.getPreventDefault && bw.getPreventDefault()) ? f : bo
            } else {
                this.type = bw
            }
            if (bv) {
                D.extend(this, bv)
            }
            this.timeStamp = bw && bw.timeStamp || D.now();
            this[D.expando] = true
        };

        function bo() {
            return false
        }

        function f() {
            return true
        }
        D.Event.prototype = {
            preventDefault: function() {
                this.isDefaultPrevented = f;
                var bv = this.originalEvent;
                if (!bv) {
                    return
                }
                if (bv.preventDefault) {
                    bv.preventDefault()
                } else {
                    bv.returnValue = false
                }
            },
            stopPropagation: function() {
                this.isPropagationStopped = f;
                var bv = this.originalEvent;
                if (!bv) {
                    return
                }
                if (bv.stopPropagation) {
                    bv.stopPropagation()
                }
                bv.cancelBubble = true
            },
            stopImmediatePropagation: function() {
                this.isImmediatePropagationStopped = f;
                this.stopPropagation()
            },
            isDefaultPrevented: bo,
            isPropagationStopped: bo,
            isImmediatePropagationStopped: bo
        };
        D.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout"
        }, function(bw, bv) {
            D.event.special[bw] = {
                delegateType: bv,
                bindType: bv,
                handle: function(bA) {
                    var by, bC = this,
                        bB = bA.relatedTarget,
                        bz = bA.handleObj,
                        bx = bz.selector;
                    if (!bB || (bB !== bC && !D.contains(bC, bB))) {
                        bA.type = bz.origType;
                        by = bz.handler.apply(this, arguments);
                        bA.type = bv
                    }
                    return by
                }
            }
        });
        D.fn.extend({
            on: function(bx, bv, bA, bz, bw) {
                var bB, by;
                if (typeof bx === "object") {
                    if (typeof bv !== "string") {
                        bA = bA || bv;
                        bv = H
                    }
                    for (by in bx) {
                        this.on(by, bv, bA, bx[by], bw)
                    }
                    return this
                }
                if (bA == null && bz == null) {
                    bz = bv;
                    bA = bv = H
                } else {
                    if (bz == null) {
                        if (typeof bv === "string") {
                            bz = bA;
                            bA = H
                        } else {
                            bz = bA;
                            bA = bv;
                            bv = H
                        }
                    }
                }
                if (bz === false) {
                    bz = bo
                } else {
                    if (!bz) {
                        return this
                    }
                }
                if (bw === 1) {
                    bB = bz;
                    bz = function(bC) {
                        D().off(bC);
                        return bB.apply(this, arguments)
                    };
                    bz.guid = bB.guid || (bB.guid = D.guid++)
                }
                return this.each(function() {
                    D.event.add(this, bx, bz, bA, bv)
                })
            },
            off: function(bx, bv, bz) {
                var bw, by;
                if (bx && bx.preventDefault && bx.handleObj) {
                    bw = bx.handleObj;
                    D(bx.delegateTarget).off(bw.namespace ? bw.origType + "." + bw.namespace : bw.origType, bw.selector, bw.handler);
                    return this
                }
                if (typeof bx === "object") {
                    for (by in bx) {
                        this.off(by, bv, bx[by])
                    }
                    return this
                }
                if (bv === false || typeof bv === "function") {
                    bz = bv;
                    bv = H
                }
                if (bz === false) {
                    bz = bo
                }
                return this.each(function() {
                    D.event.remove(this, bx, bz, bv)
                })
            },
            delegate: function(bv, bw, by, bx) {
                return this.on(bw, bv, by, bx)
            },
            undelegate: function(bv, bw, bx) {
                return arguments.length === 1 ? this.off(bv, "**") : this.off(bw, bv || "**", bx)
            },
            trigger: function(bv, bw) {
                return this.each(function() {
                    D.event.trigger(bv, bw, this)
                })
            },
            triggerHandler: function(bv, bw) {
                if (this[0]) {
                    return D.event.trigger(bv, bw, this[0], true)
                }
            },
            toggle: function(by) {
                var bw = arguments,
                    bv = by.guid || D.guid++,
                    bx = 0,
                    bz = function(bA) {
                        var bB = (D._data(this, "lastToggle" + by.guid) || 0) % bx;
                        D._data(this, "lastToggle" + by.guid, bB + 1);
                        bA.preventDefault();
                        return bw[bB].apply(this, arguments) || false
                    };
                bz.guid = bv;
                while (bx < bw.length) {
                    bw[bx++].guid = bv
                }
                return this.click(bz)
            },
            hover: function(bv, bw) {
                return this.mouseenter(bv).mouseleave(bw || bv)
            }
        });
        D.each(("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu").split(" "), function(bw, bv) {
            D.fn[bv] = function(by, bx) {
                if (bx == null) {
                    bx = by;
                    by = null
                }
                return arguments.length > 0 ? this.on(bv, null, by, bx) : this.trigger(bv)
            };
            if (aI.test(bv)) {
                D.event.fixHooks[bv] = D.event.keyHooks
            }
            if (bj.test(bv)) {
                D.event.fixHooks[bv] = D.event.mouseHooks
            }
        });
        /*!
         * Sizzle CSS Selector Engine
         * Copyright 2012 JQXLite Foundation and other contributors
         * Released under the MIT license
         * http://sizzlejs.com/
         */
        (function(co, bN) {
            var ct, bG, ch, bw, bS, b6, bJ, bM, bI, cf, bF = true,
                b0 = "undefined",
                cv = ("sizcache" + Math.random()).replace(".", ""),
                bA = String,
                bE = co.document,
                bH = bE.documentElement,
                bX = 0,
                bL = 0,
                ca = [].pop,
                cs = [].push,
                bR = [].slice,
                bU = [].indexOf || function(cF) {
                    var cE = 0,
                        cD = this.length;
                    for (; cE < cD; cE++) {
                        if (this[cE] === cF) {
                            return cE
                        }
                    }
                    return -1
                },
                cx = function(cD, cE) {
                    cD[cv] = cE == null || cE;
                    return cD
                },
                cB = function() {
                    var cD = {},
                        cE = [];
                    return cx(function(cF, cG) {
                        if (cE.push(cF) > ch.cacheLength) {
                            delete cD[cE.shift()]
                        }
                        return (cD[cF + " "] = cG)
                    }, cD)
                },
                cq = cB(),
                cr = cB(),
                bT = cB(),
                b4 = "[\\x20\\t\\r\\n\\f]",
                bQ = "(?:\\\\.|[-\\w]|[^\\x00-\\xa0])+",
                bO = bQ.replace("w", "w#"),
                cA = "([*^$|!~]?=)",
                cl = "\\[" + b4 + "*(" + bQ + ")" + b4 + "*(?:" + cA + b4 + "*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + bO + ")|)|)" + b4 + "*\\]",
                cC = ":(" + bQ + ")(?:\\((?:(['\"])((?:\\\\.|[^\\\\])*?)\\2|([^()[\\]]*|(?:(?:" + cl + ")|[^:]|\\\\.)*|.*))\\)|)",
                b5 = ":(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + b4 + "*((?:-\\d)?\\d*)" + b4 + "*\\)|)(?=[^-]|$)",
                cp = new RegExp("^" + b4 + "+|((?:^|[^\\\\])(?:\\\\.)*)" + b4 + "+$", "g"),
                bB = new RegExp("^" + b4 + "*," + b4 + "*"),
                cd = new RegExp("^" + b4 + "*([\\x20\\t\\r\\n\\f>+~])" + b4 + "*"),
                ci = new RegExp(cC),
                ck = /^(?:#([\w\-]+)|(\w+)|\.([\w\-]+))$/,
                b9 = /^:not/,
                cn = /[\x20\t\r\n\f]*[+~]/,
                cw = /:not\($/,
                bY = /h\d/i,
                cj = /input|select|textarea|button/i,
                bZ = /\\(?!\\)/g,
                cc = {
                    ID: new RegExp("^#(" + bQ + ")"),
                    CLASS: new RegExp("^\\.(" + bQ + ")"),
                    NAME: new RegExp("^\\[name=['\"]?(" + bQ + ")['\"]?\\]"),
                    TAG: new RegExp("^(" + bQ.replace("w", "w*") + ")"),
                    ATTR: new RegExp("^" + cl),
                    PSEUDO: new RegExp("^" + cC),
                    POS: new RegExp(b5, "i"),
                    CHILD: new RegExp("^:(only|nth|first|last)-child(?:\\(" + b4 + "*(even|odd|(([+-]|)(\\d*)n|)" + b4 + "*(?:([+-]|)" + b4 + "*(\\d+)|))" + b4 + "*\\)|)", "i"),
                    needsContext: new RegExp("^" + b4 + "*[>+~]|" + b5, "i")
                },
                cg = function(cD) {
                    var cF = bE.createElement("div");
                    try {
                        return cD(cF)
                    } catch (cE) {
                        return false
                    } finally {
                        cF = null
                    }
                },
                bD = cg(function(cD) {
                    cD.appendChild(bE.createComment(""));
                    return !cD.getElementsByTagName("*").length
                }),
                b8 = cg(function(cD) {
                    cD.innerHTML = "<a href='#'></a>";
                    return cD.firstChild && typeof cD.firstChild.getAttribute !== b0 && cD.firstChild.getAttribute("href") === "#"
                }),
                bW = cg(function(cE) {
                    cE.innerHTML = "<select></select>";
                    var cD = typeof cE.lastChild.getAttribute("multiple");
                    return cD !== "boolean" && cD !== "string"
                }),
                b7 = cg(function(cD) {
                    cD.innerHTML = "<div class='hidden e'></div><div class='hidden'></div>";
                    if (!cD.getElementsByClassName || !cD.getElementsByClassName("e").length) {
                        return false
                    }
                    cD.lastChild.className = "e";
                    return cD.getElementsByClassName("e").length === 2
                }),
                bv = cg(function(cE) {
                    cE.id = cv + 0;
                    cE.innerHTML = "<a name='" + cv + "'></a><div name='" + cv + "'></div>";
                    bH.insertBefore(cE, bH.firstChild);
                    var cD = bE.getElementsByName && bE.getElementsByName(cv).length === 2 + bE.getElementsByName(cv + 0).length;
                    bG = !bE.getElementById(cv);
                    bH.removeChild(cE);
                    return cD
                });
            try {
                bR.call(bH.childNodes, 0)[0].nodeType
            } catch (cz) {
                bR = function(cE) {
                    var cF, cD = [];
                    for (;
                        (cF = this[cE]); cE++) {
                        cD.push(cF)
                    }
                    return cD
                }
            }

            function cm(cG, cD, cI, cL) {
                cI = cI || [];
                cD = cD || bE;
                var cJ, cE, cK, cF, cH = cD.nodeType;
                if (!cG || typeof cG !== "string") {
                    return cI
                }
                if (cH !== 1 && cH !== 9) {
                    return []
                }
                cK = bS(cD);
                if (!cK && !cL) {
                    if ((cJ = ck.exec(cG))) {
                        if ((cF = cJ[1])) {
                            if (cH === 9) {
                                cE = cD.getElementById(cF);
                                if (cE && cE.parentNode) {
                                    if (cE.id === cF) {
                                        cI.push(cE);
                                        return cI
                                    }
                                } else {
                                    return cI
                                }
                            } else {
                                if (cD.ownerDocument && (cE = cD.ownerDocument.getElementById(cF)) && b6(cD, cE) && cE.id === cF) {
                                    cI.push(cE);
                                    return cI
                                }
                            }
                        } else {
                            if (cJ[2]) {
                                cs.apply(cI, bR.call(cD.getElementsByTagName(cG), 0));
                                return cI
                            } else {
                                if ((cF = cJ[3]) && b7 && cD.getElementsByClassName) {
                                    cs.apply(cI, bR.call(cD.getElementsByClassName(cF), 0));
                                    return cI
                                }
                            }
                        }
                    }
                }
                return cu(cG.replace(cp, "$1"), cD, cI, cL, cK)
            }
            cm.matches = function(cE, cD) {
                return cm(cE, null, null, cD)
            };
            cm.matchesSelector = function(cD, cE) {
                return cm(cE, null, null, [cD]).length > 0
            };

            function ce(cD) {
                return function(cF) {
                    var cE = cF.nodeName.toLowerCase();
                    return cE === "input" && cF.type === cD
                }
            }

            function bz(cD) {
                return function(cF) {
                    var cE = cF.nodeName.toLowerCase();
                    return (cE === "input" || cE === "button") && cF.type === cD
                }
            }

            function cb(cD) {
                return cx(function(cE) {
                    cE = +cE;
                    return cx(function(cF, cJ) {
                        var cH, cG = cD([], cF.length, cE),
                            cI = cG.length;
                        while (cI--) {
                            if (cF[(cH = cG[cI])]) {
                                cF[cH] = !(cJ[cH] = cF[cH])
                            }
                        }
                    })
                })
            }
            bw = cm.getText = function(cH) {
                var cG, cE = "",
                    cF = 0,
                    cD = cH.nodeType;
                if (cD) {
                    if (cD === 1 || cD === 9 || cD === 11) {
                        if (typeof cH.textContent === "string") {
                            return cH.textContent
                        } else {
                            for (cH = cH.firstChild; cH; cH = cH.nextSibling) {
                                cE += bw(cH)
                            }
                        }
                    } else {
                        if (cD === 3 || cD === 4) {
                            return cH.nodeValue
                        }
                    }
                } else {
                    for (;
                        (cG = cH[cF]); cF++) {
                        cE += bw(cG)
                    }
                }
                return cE
            };
            bS = cm.isXML = function(cD) {
                var cE = cD && (cD.ownerDocument || cD).documentElement;
                return cE ? cE.nodeName !== "HTML" : false
            };
            b6 = cm.contains = bH.contains ? function(cE, cD) {
                var cG = cE.nodeType === 9 ? cE.documentElement : cE,
                    cF = cD && cD.parentNode;
                return cE === cF || !!(cF && cF.nodeType === 1 && cG.contains && cG.contains(cF))
            } : bH.compareDocumentPosition ? function(cE, cD) {
                return cD && !!(cE.compareDocumentPosition(cD) & 16)
            } : function(cE, cD) {
                while ((cD = cD.parentNode)) {
                    if (cD === cE) {
                        return true
                    }
                }
                return false
            };
            cm.attr = function(cF, cE) {
                var cG, cD = bS(cF);
                if (!cD) {
                    cE = cE.toLowerCase()
                }
                if ((cG = ch.attrHandle[cE])) {
                    return cG(cF)
                }
                if (cD || bW) {
                    return cF.getAttribute(cE)
                }
                cG = cF.getAttributeNode(cE);
                return cG ? typeof cF[cE] === "boolean" ? cF[cE] ? cE : null : cG.specified ? cG.value : null : null
            };
            ch = cm.selectors = {
                cacheLength: 50,
                createPseudo: cx,
                match: cc,
                attrHandle: b8 ? {} : {
                    href: function(cD) {
                        return cD.getAttribute("href", 2)
                    },
                    type: function(cD) {
                        return cD.getAttribute("type")
                    }
                },
                find: {
                    ID: bG ? function(cG, cF, cE) {
                        if (typeof cF.getElementById !== b0 && !cE) {
                            var cD = cF.getElementById(cG);
                            return cD && cD.parentNode ? [cD] : []
                        }
                    } : function(cG, cF, cE) {
                        if (typeof cF.getElementById !== b0 && !cE) {
                            var cD = cF.getElementById(cG);
                            return cD ? cD.id === cG || typeof cD.getAttributeNode !== b0 && cD.getAttributeNode("id").value === cG ? [cD] : bN : []
                        }
                    },
                    TAG: bD ? function(cD, cE) {
                        if (typeof cE.getElementsByTagName !== b0) {
                            return cE.getElementsByTagName(cD)
                        }
                    } : function(cD, cH) {
                        var cG = cH.getElementsByTagName(cD);
                        if (cD === "*") {
                            var cI, cF = [],
                                cE = 0;
                            for (;
                                (cI = cG[cE]); cE++) {
                                if (cI.nodeType === 1) {
                                    cF.push(cI)
                                }
                            }
                            return cF
                        }
                        return cG
                    },
                    NAME: bv && function(cD, cE) {
                        if (typeof cE.getElementsByName !== b0) {
                            return cE.getElementsByName(name)
                        }
                    },
                    CLASS: b7 && function(cF, cE, cD) {
                        if (typeof cE.getElementsByClassName !== b0 && !cD) {
                            return cE.getElementsByClassName(cF)
                        }
                    }
                },
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: true
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: true
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(cD) {
                        cD[1] = cD[1].replace(bZ, "");
                        cD[3] = (cD[4] || cD[5] || "").replace(bZ, "");
                        if (cD[2] === "~=") {
                            cD[3] = " " + cD[3] + " "
                        }
                        return cD.slice(0, 4)
                    },
                    CHILD: function(cD) {
                        cD[1] = cD[1].toLowerCase();
                        if (cD[1] === "nth") {
                            if (!cD[2]) {
                                cm.error(cD[0])
                            }
                            cD[3] = +(cD[3] ? cD[4] + (cD[5] || 1) : 2 * (cD[2] === "even" || cD[2] === "odd"));
                            cD[4] = +((cD[6] + cD[7]) || cD[2] === "odd")
                        } else {
                            if (cD[2]) {
                                cm.error(cD[0])
                            }
                        }
                        return cD
                    },
                    PSEUDO: function(cE) {
                        var cF, cD;
                        if (cc.CHILD.test(cE[0])) {
                            return null
                        }
                        if (cE[3]) {
                            cE[2] = cE[3]
                        } else {
                            if ((cF = cE[4])) {
                                if (ci.test(cF) && (cD = bx(cF, true)) && (cD = cF.indexOf(")", cF.length - cD) - cF.length)) {
                                    cF = cF.slice(0, cD);
                                    cE[0] = cE[0].slice(0, cD)
                                }
                                cE[2] = cF
                            }
                        }
                        return cE.slice(0, 3)
                    }
                },
                filter: {
                    ID: bG ? function(cD) {
                        cD = cD.replace(bZ, "");
                        return function(cE) {
                            return cE.getAttribute("id") === cD
                        }
                    } : function(cD) {
                        cD = cD.replace(bZ, "");
                        return function(cF) {
                            var cE = typeof cF.getAttributeNode !== b0 && cF.getAttributeNode("id");
                            return cE && cE.value === cD
                        }
                    },
                    TAG: function(cD) {
                        if (cD === "*") {
                            return function() {
                                return true
                            }
                        }
                        cD = cD.replace(bZ, "").toLowerCase();
                        return function(cE) {
                            return cE.nodeName && cE.nodeName.toLowerCase() === cD
                        }
                    },
                    CLASS: function(cD) {
                        var cE = cq[cv][cD + " "];
                        return cE || (cE = new RegExp("(^|" + b4 + ")" + cD + "(" + b4 + "|$)")) && cq(cD, function(cF) {
                            return cE.test(cF.className || (typeof cF.getAttribute !== b0 && cF.getAttribute("class")) || "")
                        })
                    },
                    ATTR: function(cF, cE, cD) {
                        return function(cI, cH) {
                            var cG = cm.attr(cI, cF);
                            if (cG == null) {
                                return cE === "!="
                            }
                            if (!cE) {
                                return true
                            }
                            cG += "";
                            return cE === "=" ? cG === cD : cE === "!=" ? cG !== cD : cE === "^=" ? cD && cG.indexOf(cD) === 0 : cE === "*=" ? cD && cG.indexOf(cD) > -1 : cE === "$=" ? cD && cG.substr(cG.length - cD.length) === cD : cE === "~=" ? (" " + cG + " ").indexOf(cD) > -1 : cE === "|=" ? cG === cD || cG.substr(0, cD.length + 1) === cD + "-" : false
                        }
                    },
                    CHILD: function(cD, cF, cG, cE) {
                        if (cD === "nth") {
                            return function(cJ) {
                                var cI, cK, cH = cJ.parentNode;
                                if (cG === 1 && cE === 0) {
                                    return true
                                }
                                if (cH) {
                                    cK = 0;
                                    for (cI = cH.firstChild; cI; cI = cI.nextSibling) {
                                        if (cI.nodeType === 1) {
                                            cK++;
                                            if (cJ === cI) {
                                                break
                                            }
                                        }
                                    }
                                }
                                cK -= cE;
                                return cK === cG || (cK % cG === 0 && cK / cG >= 0)
                            }
                        }
                        return function(cI) {
                            var cH = cI;
                            switch (cD) {
                                case "only":
                                case "first":
                                    while ((cH = cH.previousSibling)) {
                                        if (cH.nodeType === 1) {
                                            return false
                                        }
                                    }
                                    if (cD === "first") {
                                        return true
                                    }
                                    cH = cI;
                                case "last":
                                    while ((cH = cH.nextSibling)) {
                                        if (cH.nodeType === 1) {
                                            return false
                                        }
                                    }
                                    return true
                            }
                        }
                    },
                    PSEUDO: function(cG, cF) {
                        var cD, cE = ch.pseudos[cG] || ch.setFilters[cG.toLowerCase()] || cm.error("unsupported pseudo: " + cG);
                        if (cE[cv]) {
                            return cE(cF)
                        }
                        if (cE.length > 1) {
                            cD = [cG, cG, "", cF];
                            return ch.setFilters.hasOwnProperty(cG.toLowerCase()) ? cx(function(cJ, cL) {
                                var cI, cH = cE(cJ, cF),
                                    cK = cH.length;
                                while (cK--) {
                                    cI = bU.call(cJ, cH[cK]);
                                    cJ[cI] = !(cL[cI] = cH[cK])
                                }
                            }) : function(cH) {
                                return cE(cH, 0, cD)
                            }
                        }
                        return cE
                    }
                },
                pseudos: {
                    not: cx(function(cD) {
                        var cE = [],
                            cF = [],
                            cG = bJ(cD.replace(cp, "$1"));
                        return cG[cv] ? cx(function(cI, cN, cL, cJ) {
                            var cM, cH = cG(cI, null, cJ, []),
                                cK = cI.length;
                            while (cK--) {
                                if ((cM = cH[cK])) {
                                    cI[cK] = !(cN[cK] = cM)
                                }
                            }
                        }) : function(cJ, cI, cH) {
                            cE[0] = cJ;
                            cG(cE, null, cH, cF);
                            return !cF.pop()
                        }
                    }),
                    has: cx(function(cD) {
                        return function(cE) {
                            return cm(cD, cE).length > 0
                        }
                    }),
                    contains: cx(function(cD) {
                        return function(cE) {
                            return (cE.textContent || cE.innerText || bw(cE)).indexOf(cD) > -1
                        }
                    }),
                    enabled: function(cD) {
                        return cD.disabled === false
                    },
                    disabled: function(cD) {
                        return cD.disabled === true
                    },
                    checked: function(cD) {
                        var cE = cD.nodeName.toLowerCase();
                        return (cE === "input" && !!cD.checked) || (cE === "option" && !!cD.selected)
                    },
                    selected: function(cD) {
                        if (cD.parentNode) {
                            cD.parentNode.selectedIndex
                        }
                        return cD.selected === true
                    },
                    parent: function(cD) {
                        return !ch.pseudos.empty(cD)
                    },
                    empty: function(cE) {
                        var cD;
                        cE = cE.firstChild;
                        while (cE) {
                            if (cE.nodeName > "@" || (cD = cE.nodeType) === 3 || cD === 4) {
                                return false
                            }
                            cE = cE.nextSibling
                        }
                        return true
                    },
                    header: function(cD) {
                        return bY.test(cD.nodeName)
                    },
                    text: function(cF) {
                        var cE, cD;
                        return cF.nodeName.toLowerCase() === "input" && (cE = cF.type) === "text" && ((cD = cF.getAttribute("type")) == null || cD.toLowerCase() === cE)
                    },
                    radio: ce("radio"),
                    checkbox: ce("checkbox"),
                    file: ce("file"),
                    password: ce("password"),
                    image: ce("image"),
                    submit: bz("submit"),
                    reset: bz("reset"),
                    button: function(cE) {
                        var cD = cE.nodeName.toLowerCase();
                        return cD === "input" && cE.type === "button" || cD === "button"
                    },
                    input: function(cD) {
                        return cj.test(cD.nodeName)
                    },
                    focus: function(cD) {
                        var cE = cD.ownerDocument;
                        return cD === cE.activeElement && (!cE.hasFocus || cE.hasFocus()) && !!(cD.type || cD.href || ~cD.tabIndex)
                    },
                    active: function(cD) {
                        return cD === cD.ownerDocument.activeElement
                    },
                    first: cb(function() {
                        return [0]
                    }),
                    last: cb(function(cD, cE) {
                        return [cE - 1]
                    }),
                    eq: cb(function(cD, cF, cE) {
                        return [cE < 0 ? cE + cF : cE]
                    }),
                    even: cb(function(cD, cF) {
                        for (var cE = 0; cE < cF; cE += 2) {
                            cD.push(cE)
                        }
                        return cD
                    }),
                    odd: cb(function(cD, cF) {
                        for (var cE = 1; cE < cF; cE += 2) {
                            cD.push(cE)
                        }
                        return cD
                    }),
                    lt: cb(function(cD, cG, cF) {
                        for (var cE = cF < 0 ? cF + cG : cF; --cE >= 0;) {
                            cD.push(cE)
                        }
                        return cD
                    }),
                    gt: cb(function(cD, cG, cF) {
                        for (var cE = cF < 0 ? cF + cG : cF; ++cE < cG;) {
                            cD.push(cE)
                        }
                        return cD
                    })
                }
            };

            function by(cE, cD, cF) {
                if (cE === cD) {
                    return cF
                }
                var cG = cE.nextSibling;
                while (cG) {
                    if (cG === cD) {
                        return -1
                    }
                    cG = cG.nextSibling
                }
                return 1
            }
            bM = bH.compareDocumentPosition ? function(cE, cD) {
                if (cE === cD) {
                    bI = true;
                    return 0
                }
                return (!cE.compareDocumentPosition || !cD.compareDocumentPosition ? cE.compareDocumentPosition : cE.compareDocumentPosition(cD) & 4) ? -1 : 1
            } : function(cL, cK) {
                if (cL === cK) {
                    bI = true;
                    return 0
                } else {
                    if (cL.sourceIndex && cK.sourceIndex) {
                        return cL.sourceIndex - cK.sourceIndex
                    }
                }
                var cI, cE, cF = [],
                    cD = [],
                    cH = cL.parentNode,
                    cJ = cK.parentNode,
                    cM = cH;
                if (cH === cJ) {
                    return by(cL, cK)
                } else {
                    if (!cH) {
                        return -1
                    } else {
                        if (!cJ) {
                            return 1
                        }
                    }
                }
                while (cM) {
                    cF.unshift(cM);
                    cM = cM.parentNode
                }
                cM = cJ;
                while (cM) {
                    cD.unshift(cM);
                    cM = cM.parentNode
                }
                cI = cF.length;
                cE = cD.length;
                for (var cG = 0; cG < cI && cG < cE; cG++) {
                    if (cF[cG] !== cD[cG]) {
                        return by(cF[cG], cD[cG])
                    }
                }
                return cG === cI ? by(cL, cD[cG], -1) : by(cF[cG], cK, 1)
            };
            [0, 0].sort(bM);
            bF = !bI;
            cm.uniqueSort = function(cF) {
                var cG, cH = [],
                    cE = 1,
                    cD = 0;
                bI = bF;
                cF.sort(bM);
                if (bI) {
                    for (;
                        (cG = cF[cE]); cE++) {
                        if (cG === cF[cE - 1]) {
                            cD = cH.push(cE)
                        }
                    }
                    while (cD--) {
                        cF.splice(cH[cD], 1)
                    }
                }
                return cF
            };
            cm.error = function(cD) {
                throw new Error("Syntax error, unrecognized expression: " + cD)
            };

            function bx(cH, cM) {
                var cE, cI, cK, cL, cJ, cF, cD, cG = cr[cv][cH + " "];
                if (cG) {
                    return cM ? 0 : cG.slice(0)
                }
                cJ = cH;
                cF = [];
                cD = ch.preFilter;
                while (cJ) {
                    if (!cE || (cI = bB.exec(cJ))) {
                        if (cI) {
                            cJ = cJ.slice(cI[0].length) || cJ
                        }
                        cF.push(cK = [])
                    }
                    cE = false;
                    if ((cI = cd.exec(cJ))) {
                        cK.push(cE = new bA(cI.shift()));
                        cJ = cJ.slice(cE.length);
                        cE.type = cI[0].replace(cp, " ")
                    }
                    for (cL in ch.filter) {
                        if ((cI = cc[cL].exec(cJ)) && (!cD[cL] || (cI = cD[cL](cI)))) {
                            cK.push(cE = new bA(cI.shift()));
                            cJ = cJ.slice(cE.length);
                            cE.type = cL;
                            cE.matches = cI
                        }
                    }
                    if (!cE) {
                        break
                    }
                }
                return cM ? cJ.length : cJ ? cm.error(cH) : cr(cH, cF).slice(0)
            }

            function b2(cH, cF, cG) {
                var cD = cF.dir,
                    cI = cG && cF.dir === "parentNode",
                    cE = bL++;
                return cF.first ? function(cL, cK, cJ) {
                    while ((cL = cL[cD])) {
                        if (cI || cL.nodeType === 1) {
                            return cH(cL, cK, cJ)
                        }
                    }
                } : function(cM, cL, cK) {
                    if (!cK) {
                        var cJ, cN = bX + " " + cE + " ",
                            cO = cN + ct;
                        while ((cM = cM[cD])) {
                            if (cI || cM.nodeType === 1) {
                                if ((cJ = cM[cv]) === cO) {
                                    return cM.sizset
                                } else {
                                    if (typeof cJ === "string" && cJ.indexOf(cN) === 0) {
                                        if (cM.sizset) {
                                            return cM
                                        }
                                    } else {
                                        cM[cv] = cO;
                                        if (cH(cM, cL, cK)) {
                                            cM.sizset = true;
                                            return cM
                                        }
                                        cM.sizset = false
                                    }
                                }
                            }
                        }
                    } else {
                        while ((cM = cM[cD])) {
                            if (cI || cM.nodeType === 1) {
                                if (cH(cM, cL, cK)) {
                                    return cM
                                }
                            }
                        }
                    }
                }
            }

            function bK(cD) {
                return cD.length > 1 ? function(cH, cG, cE) {
                    var cF = cD.length;
                    while (cF--) {
                        if (!cD[cF](cH, cG, cE)) {
                            return false
                        }
                    }
                    return true
                } : cD[0]
            }

            function b1(cD, cE, cF, cG, cJ) {
                var cH, cM = [],
                    cI = 0,
                    cK = cD.length,
                    cL = cE != null;
                for (; cI < cK; cI++) {
                    if ((cH = cD[cI])) {
                        if (!cF || cF(cH, cG, cJ)) {
                            cM.push(cH);
                            if (cL) {
                                cE.push(cI)
                            }
                        }
                    }
                }
                return cM
            }

            function cy(cF, cE, cH, cG, cI, cD) {
                if (cG && !cG[cv]) {
                    cG = cy(cG)
                }
                if (cI && !cI[cv]) {
                    cI = cy(cI, cD)
                }
                return cx(function(cT, cQ, cL, cS) {
                    var cV, cR, cN, cM = [],
                        cU = [],
                        cK = cQ.length,
                        cJ = cT || bV(cE || "*", cL.nodeType ? [cL] : cL, []),
                        cO = cF && (cT || !cE) ? b1(cJ, cM, cF, cL, cS) : cJ,
                        cP = cH ? cI || (cT ? cF : cK || cG) ? [] : cQ : cO;
                    if (cH) {
                        cH(cO, cP, cL, cS)
                    }
                    if (cG) {
                        cV = b1(cP, cU);
                        cG(cV, [], cL, cS);
                        cR = cV.length;
                        while (cR--) {
                            if ((cN = cV[cR])) {
                                cP[cU[cR]] = !(cO[cU[cR]] = cN)
                            }
                        }
                    }
                    if (cT) {
                        if (cI || cF) {
                            if (cI) {
                                cV = [];
                                cR = cP.length;
                                while (cR--) {
                                    if ((cN = cP[cR])) {
                                        cV.push((cO[cR] = cN))
                                    }
                                }
                                cI(null, (cP = []), cV, cS)
                            }
                            cR = cP.length;
                            while (cR--) {
                                if ((cN = cP[cR]) && (cV = cI ? bU.call(cT, cN) : cM[cR]) > -1) {
                                    cT[cV] = !(cQ[cV] = cN)
                                }
                            }
                        }
                    } else {
                        cP = b1(cP === cQ ? cP.splice(cK, cP.length) : cP);
                        if (cI) {
                            cI(null, cQ, cP, cS)
                        } else {
                            cs.apply(cQ, cP)
                        }
                    }
                })
            }

            function b3(cJ) {
                var cE, cH, cF, cI = cJ.length,
                    cM = ch.relative[cJ[0].type],
                    cN = cM || ch.relative[" "],
                    cG = cM ? 1 : 0,
                    cK = b2(function(cO) {
                        return cO === cE
                    }, cN, true),
                    cL = b2(function(cO) {
                        return bU.call(cE, cO) > -1
                    }, cN, true),
                    cD = [function(cQ, cP, cO) {
                        return (!cM && (cO || cP !== cf)) || ((cE = cP).nodeType ? cK(cQ, cP, cO) : cL(cQ, cP, cO))
                    }];
                for (; cG < cI; cG++) {
                    if ((cH = ch.relative[cJ[cG].type])) {
                        cD = [b2(bK(cD), cH)]
                    } else {
                        cH = ch.filter[cJ[cG].type].apply(null, cJ[cG].matches);
                        if (cH[cv]) {
                            cF = ++cG;
                            for (; cF < cI; cF++) {
                                if (ch.relative[cJ[cF].type]) {
                                    break
                                }
                            }
                            return cy(cG > 1 && bK(cD), cG > 1 && cJ.slice(0, cG - 1).join("").replace(cp, "$1"), cH, cG < cF && b3(cJ.slice(cG, cF)), cF < cI && b3((cJ = cJ.slice(cF))), cF < cI && cJ.join(""))
                        }
                        cD.push(cH)
                    }
                }
                return bK(cD)
            }

            function bC(cG, cF) {
                var cD = cF.length > 0,
                    cH = cG.length > 0,
                    cE = function(cR, cL, cQ, cP, cX) {
                        var cM, cN, cS, cW = [],
                            cV = 0,
                            cO = "0",
                            cI = cR && [],
                            cT = cX != null,
                            cU = cf,
                            cK = cR || cH && ch.find.TAG("*", cX && cL.parentNode || cL),
                            cJ = (bX += cU == null ? 1 : Math.E);
                        if (cT) {
                            cf = cL !== bE && cL;
                            ct = cE.el
                        }
                        for (;
                            (cM = cK[cO]) != null; cO++) {
                            if (cH && cM) {
                                for (cN = 0;
                                    (cS = cG[cN]); cN++) {
                                    if (cS(cM, cL, cQ)) {
                                        cP.push(cM);
                                        break
                                    }
                                }
                                if (cT) {
                                    bX = cJ;
                                    ct = ++cE.el
                                }
                            }
                            if (cD) {
                                if ((cM = !cS && cM)) {
                                    cV--
                                }
                                if (cR) {
                                    cI.push(cM)
                                }
                            }
                        }
                        cV += cO;
                        if (cD && cO !== cV) {
                            for (cN = 0;
                                (cS = cF[cN]); cN++) {
                                cS(cI, cW, cL, cQ)
                            }
                            if (cR) {
                                if (cV > 0) {
                                    while (cO--) {
                                        if (!(cI[cO] || cW[cO])) {
                                            cW[cO] = ca.call(cP)
                                        }
                                    }
                                }
                                cW = b1(cW)
                            }
                            cs.apply(cP, cW);
                            if (cT && !cR && cW.length > 0 && (cV + cF.length) > 1) {
                                cm.uniqueSort(cP)
                            }
                        }
                        if (cT) {
                            bX = cJ;
                            cf = cU
                        }
                        return cI
                    };
                cE.el = 0;
                return cD ? cx(cE) : cE
            }
            bJ = cm.compile = function(cD, cI) {
                var cF, cE = [],
                    cH = [],
                    cG = bT[cv][cD + " "];
                if (!cG) {
                    if (!cI) {
                        cI = bx(cD)
                    }
                    cF = cI.length;
                    while (cF--) {
                        cG = b3(cI[cF]);
                        if (cG[cv]) {
                            cE.push(cG)
                        } else {
                            cH.push(cG)
                        }
                    }
                    cG = bT(cD, bC(cH, cE))
                }
                return cG
            };

            function bV(cE, cH, cG) {
                var cF = 0,
                    cD = cH.length;
                for (; cF < cD; cF++) {
                    cm(cE, cH[cF], cG)
                }
                return cG
            }

            function cu(cF, cD, cH, cL, cK) {
                var cI, cO, cE, cN, cM, cJ = bx(cF),
                    cG = cJ.length;
                if (!cL) {
                    if (cJ.length === 1) {
                        cO = cJ[0] = cJ[0].slice(0);
                        if (cO.length > 2 && (cE = cO[0]).type === "ID" && cD.nodeType === 9 && !cK && ch.relative[cO[1].type]) {
                            cD = ch.find.ID(cE.matches[0].replace(bZ, ""), cD, cK)[0];
                            if (!cD) {
                                return cH
                            }
                            cF = cF.slice(cO.shift().length)
                        }
                        for (cI = cc.POS.test(cF) ? -1 : cO.length - 1; cI >= 0; cI--) {
                            cE = cO[cI];
                            if (ch.relative[(cN = cE.type)]) {
                                break
                            }
                            if ((cM = ch.find[cN])) {
                                if ((cL = cM(cE.matches[0].replace(bZ, ""), cn.test(cO[0].type) && cD.parentNode || cD, cK))) {
                                    cO.splice(cI, 1);
                                    cF = cL.length && cO.join("");
                                    if (!cF) {
                                        cs.apply(cH, bR.call(cL, 0));
                                        return cH
                                    }
                                    break
                                }
                            }
                        }
                    }
                }
                bJ(cF, cJ)(cL, cD, cK, cH, cn.test(cF));
                return cH
            }
            if (bE.querySelectorAll) {
                (function() {
                    var cI, cJ = cu,
                        cH = /'|\\/g,
                        cF = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g,
                        cE = [":focus"],
                        cD = [":active"],
                        cG = bH.matchesSelector || bH.mozMatchesSelector || bH.webkitMatchesSelector || bH.oMatchesSelector || bH.msMatchesSelector;
                    cg(function(cK) {
                        cK.innerHTML = "<select><option selected=''></option></select>";
                        if (!cK.querySelectorAll("[selected]").length) {
                            cE.push("\\[" + b4 + "*(?:checked|disabled|ismap|multiple|readonly|selected|value)")
                        }
                        if (!cK.querySelectorAll(":checked").length) {
                            cE.push(":checked")
                        }
                    });
                    cg(function(cK) {
                        cK.innerHTML = "<p test=''></p>";
                        if (cK.querySelectorAll("[test^='']").length) {
                            cE.push("[*^$]=" + b4 + "*(?:\"\"|'')")
                        }
                        cK.innerHTML = "<input type='hidden'/>";
                        if (!cK.querySelectorAll(":enabled").length) {
                            cE.push(":enabled", ":disabled")
                        }
                    });
                    cE = new RegExp(cE.join("|"));
                    cu = function(cQ, cL, cS, cV, cU) {
                        if (!cV && !cU && !cE.test(cQ)) {
                            var cO, cT, cN = true,
                                cK = cv,
                                cM = cL,
                                cR = cL.nodeType === 9 && cQ;
                            if (cL.nodeType === 1 && cL.nodeName.toLowerCase() !== "object") {
                                cO = bx(cQ);
                                if ((cN = cL.getAttribute("id"))) {
                                    cK = cN.replace(cH, "\\$&")
                                } else {
                                    cL.setAttribute("id", cK)
                                }
                                cK = "[id='" + cK + "'] ";
                                cT = cO.length;
                                while (cT--) {
                                    cO[cT] = cK + cO[cT].join("")
                                }
                                cM = cn.test(cQ) && cL.parentNode || cL;
                                cR = cO.join(",")
                            }
                            if (cR) {
                                try {
                                    cs.apply(cS, bR.call(cM.querySelectorAll(cR), 0));
                                    return cS
                                } catch (cP) {} finally {
                                    if (!cN) {
                                        cL.removeAttribute("id")
                                    }
                                }
                            }
                        }
                        return cJ(cQ, cL, cS, cV, cU)
                    };
                    if (cG) {
                        cg(function(cL) {
                            cI = cG.call(cL, "div");
                            try {
                                cG.call(cL, "[test!='']:sizzle");
                                cD.push("!=", cC)
                            } catch (cK) {}
                        });
                        cD = new RegExp(cD.join("|"));
                        cm.matchesSelector = function(cL, cN) {
                            cN = cN.replace(cF, "='$1']");
                            if (!bS(cL) && !cD.test(cN) && !cE.test(cN)) {
                                try {
                                    var cK = cG.call(cL, cN);
                                    if (cK || cI || cL.document && cL.document.nodeType !== 11) {
                                        return cK
                                    }
                                } catch (cM) {}
                            }
                            return cm(cN, null, null, [cL]).length > 0
                        }
                    }
                })()
            }
            ch.pseudos.nth = ch.pseudos.eq;

            function bP() {}
            ch.filters = bP.prototype = ch.pseudos;
            ch.setFilters = new bP();
            cm.attr = D.attr;
            D.find = cm;
            D.expr = cm.selectors;
            D.expr[":"] = D.expr.pseudos;
            D.unique = cm.uniqueSort;
            D.text = cm.getText;
            D.isXMLDoc = cm.isXML;
            D.contains = cm.contains
        })(be);
        var V = /Until$/,
            ah = /^(?:parents|prev(?:Until|All))/,
            br = /^.[^:#\[\.,]*$/,
            aR = D.expr.match.needsContext,
            ap = {
                children: true,
                contents: true,
                next: true,
                prev: true
            };
        D.fn.extend({
            find: function(bv) {
                var bz, bw, bB, bC, bA, by, bx = this;
                if (typeof bv !== "string") {
                    return D(bv).filter(function() {
                        for (bz = 0, bw = bx.length; bz < bw; bz++) {
                            if (D.contains(bx[bz], this)) {
                                return true
                            }
                        }
                    })
                }
                by = this.pushStack("", "find", bv);
                for (bz = 0, bw = this.length; bz < bw; bz++) {
                    bB = by.length;
                    D.find(bv, this[bz], by);
                    if (bz > 0) {
                        for (bC = bB; bC < by.length; bC++) {
                            for (bA = 0; bA < bB; bA++) {
                                if (by[bA] === by[bC]) {
                                    by.splice(bC--, 1);
                                    break
                                }
                            }
                        }
                    }
                }
                return by
            },
            has: function(by) {
                var bx, bw = D(by, this),
                    bv = bw.length;
                return this.filter(function() {
                    for (bx = 0; bx < bv; bx++) {
                        if (D.contains(this, bw[bx])) {
                            return true
                        }
                    }
                })
            },
            not: function(bv) {
                return this.pushStack(aA(this, bv, false), "not", bv)
            },
            filter: function(bv) {
                return this.pushStack(aA(this, bv, true), "filter", bv)
            },
            is: function(bv) {
                return !!bv && (typeof bv === "string" ? aR.test(bv) ? D(bv, this.context).index(this[0]) >= 0 : D.filter(bv, this).length > 0 : this.filter(bv).length > 0)
            },
            closest: function(bz, by) {
                var bA, bx = 0,
                    bv = this.length,
                    bw = [],
                    bB = aR.test(bz) || typeof bz !== "string" ? D(bz, by || this.context) : 0;
                for (; bx < bv; bx++) {
                    bA = this[bx];
                    while (bA && bA.ownerDocument && bA !== by && bA.nodeType !== 11) {
                        if (bB ? bB.index(bA) > -1 : D.find.matchesSelector(bA, bz)) {
                            bw.push(bA);
                            break
                        }
                        bA = bA.parentNode
                    }
                }
                bw = bw.length > 1 ? D.unique(bw) : bw;
                return this.pushStack(bw, "closest", bz)
            },
            index: function(bv) {
                if (!bv) {
                    return (this[0] && this[0].parentNode) ? this.prevAll().length : -1
                }
                if (typeof bv === "string") {
                    return D.inArray(this[0], D(bv))
                }
                return D.inArray(bv.jqx ? bv[0] : bv, this)
            },
            add: function(bv, bw) {
                var by = typeof bv === "string" ? D(bv, bw) : D.makeArray(bv && bv.nodeType ? [bv] : bv),
                    bx = D.merge(this.get(), by);
                return this.pushStack(y(by[0]) || y(bx[0]) ? bx : D.unique(bx))
            },
            addBack: function(bv) {
                return this.add(bv == null ? this.prevObject : this.prevObject.filter(bv))
            }
        });
        D.fn.andSelf = D.fn.addBack;

        function y(bv) {
            return !bv || !bv.parentNode || bv.parentNode.nodeType === 11
        }

        function aC(bw, bv) {
            do {
                bw = bw[bv]
            } while (bw && bw.nodeType !== 1);
            return bw
        }
        D.each({
            parent: function(bw) {
                var bv = bw.parentNode;
                return bv && bv.nodeType !== 11 ? bv : null
            },
            parents: function(bv) {
                return D.dir(bv, "parentNode")
            },
            parentsUntil: function(bw, bv, bx) {
                return D.dir(bw, "parentNode", bx)
            },
            next: function(bv) {
                return aC(bv, "nextSibling")
            },
            prev: function(bv) {
                return aC(bv, "previousSibling")
            },
            nextAll: function(bv) {
                return D.dir(bv, "nextSibling")
            },
            prevAll: function(bv) {
                return D.dir(bv, "previousSibling")
            },
            nextUntil: function(bw, bv, bx) {
                return D.dir(bw, "nextSibling", bx)
            },
            prevUntil: function(bw, bv, bx) {
                return D.dir(bw, "previousSibling", bx)
            },
            siblings: function(bv) {
                return D.sibling((bv.parentNode || {}).firstChild, bv)
            },
            children: function(bv) {
                return D.sibling(bv.firstChild)
            },
            contents: function(bv) {
                return D.nodeName(bv, "iframe") ? bv.contentDocument || bv.contentWindow.document : D.merge([], bv.childNodes)
            }
        }, function(bv, bw) {
            D.fn[bv] = function(bz, bx) {
                var by = D.map(this, bw, bz);
                if (!V.test(bv)) {
                    bx = bz
                }
                if (bx && typeof bx === "string") {
                    by = D.filter(bx, by)
                }
                by = this.length > 1 && !ap[bv] ? D.unique(by) : by;
                if (this.length > 1 && ah.test(bv)) {
                    by = by.reverse()
                }
                return this.pushStack(by, bv, aE.call(arguments).join(","))
            }
        });
        D.extend({
            filter: function(bx, bv, bw) {
                if (bw) {
                    bx = ":not(" + bx + ")"
                }
                return bv.length === 1 ? D.find.matchesSelector(bv[0], bx) ? [bv[0]] : [] : D.find.matches(bx, bv)
            },
            dir: function(bx, bw, bz) {
                var bv = [],
                    by = bx[bw];
                while (by && by.nodeType !== 9 && (bz === H || by.nodeType !== 1 || !D(by).is(bz))) {
                    if (by.nodeType === 1) {
                        bv.push(by)
                    }
                    by = by[bw]
                }
                return bv
            },
            sibling: function(bx, bw) {
                var bv = [];
                for (; bx; bx = bx.nextSibling) {
                    if (bx.nodeType === 1 && bx !== bw) {
                        bv.push(bx)
                    }
                }
                return bv
            }
        });

        function aA(by, bx, bv) {
            bx = bx || 0;
            if (D.isFunction(bx)) {
                return D.grep(by, function(bA, bz) {
                    var bB = !!bx.call(bA, bz, bA);
                    return bB === bv
                })
            } else {
                if (bx.nodeType) {
                    return D.grep(by, function(bA, bz) {
                        return (bA === bx) === bv
                    })
                } else {
                    if (typeof bx === "string") {
                        var bw = D.grep(by, function(bz) {
                            return bz.nodeType === 1
                        });
                        if (br.test(bx)) {
                            return D.filter(bx, bw, !bv)
                        } else {
                            bx = D.filter(bx, bw)
                        }
                    }
                }
            }
            return D.grep(by, function(bA, bz) {
                return (D.inArray(bA, bx) >= 0) === bv
            })
        }

        function a(bv) {
            var bx = aK.split("|"),
                bw = bv.createDocumentFragment();
            if (bw.createElement) {
                while (bx.length) {
                    bw.createElement(bx.pop())
                }
            }
            return bw
        }
        var aK = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
            ab = / JQXLite\d+="(?:null|\d+)"/g,
            ai = /^\s+/,
            M = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
            c = /<([\w:]+)/,
            w = /<tbody/i,
            Q = /<|&#?\w+;/,
            X = /<(?:script|style|link)/i,
            J = /<(?:script|object|embed|option|style)/i,
            ad = new RegExp("<(?:" + aK + ")[\\s/>]", "i"),
            S = /^(?:checkbox|radio)$/,
            p = /checked\s*(?:[^=]|=\s*.checked.)/i,
            bq = /\/(java|ecma)script/i,
            aH = /^\s*<!(?:\[CDATA\[|\-\-)|[\]\-]{2}>\s*$/g,
            an = {
                option: [1, "<select multiple='multiple'>", "</select>"],
                legend: [1, "<fieldset>", "</fieldset>"],
                thead: [1, "<table>", "</table>"],
                tr: [2, "<table><tbody>", "</tbody></table>"],
                td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
                col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
                area: [1, "<map>", "</map>"],
                _default: [0, "", ""]
            },
            U = a(al),
            bh = U.appendChild(al.createElement("div"));
        an.optgroup = an.option;
        an.tbody = an.tfoot = an.colgroup = an.caption = an.thead;
        an.th = an.td;
        if (!D.support.htmlSerialize) {
            an._default = [1, "X<div>", "</div>"]
        }
        D.fn.extend({
            text: function(bv) {
                return D.access(this, function(bw) {
                    return bw === H ? D.text(this) : this.empty().append((this[0] && this[0].ownerDocument || al).createTextNode(bw))
                }, null, bv, arguments.length)
            },
            wrapAll: function(bv) {
                if (D.isFunction(bv)) {
                    return this.each(function(bx) {
                        D(this).wrapAll(bv.call(this, bx))
                    })
                }
                if (this[0]) {
                    var bw = D(bv, this[0].ownerDocument).eq(0).clone(true);
                    if (this[0].parentNode) {
                        bw.insertBefore(this[0])
                    }
                    bw.map(function() {
                        var bx = this;
                        while (bx.firstChild && bx.firstChild.nodeType === 1) {
                            bx = bx.firstChild
                        }
                        return bx
                    }).append(this)
                }
                return this
            },
            wrapInner: function(bv) {
                if (D.isFunction(bv)) {
                    return this.each(function(bw) {
                        D(this).wrapInner(bv.call(this, bw))
                    })
                }
                return this.each(function() {
                    var bw = D(this),
                        bx = bw.contents();
                    if (bx.length) {
                        bx.wrapAll(bv)
                    } else {
                        bw.append(bv)
                    }
                })
            },
            wrap: function(bv) {
                var bw = D.isFunction(bv);
                return this.each(function(bx) {
                    D(this).wrapAll(bw ? bv.call(this, bx) : bv)
                })
            },
            unwrap: function() {
                return this.parent().each(function() {
                    if (!D.nodeName(this, "body")) {
                        D(this).replaceWith(this.childNodes)
                    }
                }).end()
            },
            append: function() {
                return this.domManip(arguments, true, function(bv) {
                    if (this.nodeType === 1 || this.nodeType === 11) {
                        this.appendChild(bv)
                    }
                })
            },
            prepend: function() {
                return this.domManip(arguments, true, function(bv) {
                    if (this.nodeType === 1 || this.nodeType === 11) {
                        this.insertBefore(bv, this.firstChild)
                    }
                })
            },
            before: function() {
                if (!y(this[0])) {
                    return this.domManip(arguments, false, function(bw) {
                        this.parentNode.insertBefore(bw, this)
                    })
                }
                if (arguments.length) {
                    var bv = D.clean(arguments);
                    return this.pushStack(D.merge(bv, this), "before", this.selector)
                }
            },
            after: function() {
                if (!y(this[0])) {
                    return this.domManip(arguments, false, function(bw) {
                        this.parentNode.insertBefore(bw, this.nextSibling)
                    })
                }
                if (arguments.length) {
                    var bv = D.clean(arguments);
                    return this.pushStack(D.merge(this, bv), "after", this.selector)
                }
            },
            remove: function(bv, by) {
                var bx, bw = 0;
                for (;
                    (bx = this[bw]) != null; bw++) {
                    if (!bv || D.filter(bv, [bx]).length) {
                        if (!by && bx.nodeType === 1) {
                            D.cleanData(bx.getElementsByTagName("*"));
                            D.cleanData([bx])
                        }
                        if (bx.parentNode) {
                            bx.parentNode.removeChild(bx)
                        }
                    }
                }
                return this
            },
            empty: function() {
                var bw, bv = 0;
                for (;
                    (bw = this[bv]) != null; bv++) {
                    if (bw.nodeType === 1) {
                        D.cleanData(bw.getElementsByTagName("*"))
                    }
                    while (bw.firstChild) {
                        bw.removeChild(bw.firstChild)
                    }
                }
                return this
            },
            clone: function(bw, bv) {
                bw = bw == null ? false : bw;
                bv = bv == null ? bw : bv;
                return this.map(function() {
                    return D.clone(this, bw, bv)
                })
            },
            html: function(bv) {
                return D.access(this, function(bz) {
                    var by = this[0] || {},
                        bx = 0,
                        bw = this.length;
                    if (bz === H) {
                        return by.nodeType === 1 ? by.innerHTML.replace(ab, "") : H
                    }
                    if (typeof bz === "string" && !X.test(bz) && (D.support.htmlSerialize || !ad.test(bz)) && (D.support.leadingWhitespace || !ai.test(bz)) && !an[(c.exec(bz) || ["", ""])[1].toLowerCase()]) {
                        bz = bz.replace(M, "<$1></$2>");
                        try {
                            for (; bx < bw; bx++) {
                                by = this[bx] || {};
                                if (by.nodeType === 1) {
                                    D.cleanData(by.getElementsByTagName("*"));
                                    by.innerHTML = bz
                                }
                            }
                            by = 0
                        } catch (bA) {}
                    }
                    if (by) {
                        this.empty().append(bz)
                    }
                }, null, bv, arguments.length)
            },
            replaceWith: function(bv) {
                if (!y(this[0])) {
                    if (D.isFunction(bv)) {
                        return this.each(function(by) {
                            var bx = D(this),
                                bw = bx.html();
                            bx.replaceWith(bv.call(this, by, bw))
                        })
                    }
                    if (typeof bv !== "string") {
                        bv = D(bv).detach()
                    }
                    return this.each(function() {
                        var bx = this.nextSibling,
                            bw = this.parentNode;
                        D(this).remove();
                        if (bx) {
                            D(bx).before(bv)
                        } else {
                            D(bw).append(bv)
                        }
                    })
                }
                return this.length ? this.pushStack(D(D.isFunction(bv) ? bv() : bv), "replaceWith", bv) : this
            },
            detach: function(bv) {
                return this.remove(bv, true)
            },
            domManip: function(bB, bF, bE) {
                bB = [].concat.apply([], bB);
                var bx, bz, bA, bD, by = 0,
                    bC = bB[0],
                    bw = [],
                    bv = this.length;
                if (!D.support.checkClone && bv > 1 && typeof bC === "string" && p.test(bC)) {
                    return this.each(function() {
                        D(this).domManip(bB, bF, bE)
                    })
                }
                if (D.isFunction(bC)) {
                    return this.each(function(bH) {
                        var bG = D(this);
                        bB[0] = bC.call(this, bH, bF ? bG.html() : H);
                        bG.domManip(bB, bF, bE)
                    })
                }
                if (this[0]) {
                    bx = D.buildFragment(bB, this, bw);
                    bA = bx.fragment;
                    bz = bA.firstChild;
                    if (bA.childNodes.length === 1) {
                        bA = bz
                    }
                    if (bz) {
                        bF = bF && D.nodeName(bz, "tr");
                        for (bD = bx.cacheable || bv - 1; by < bv; by++) {
                            bE.call(bF && D.nodeName(this[by], "table") ? a4(this[by], "tbody") : this[by], by === bD ? bA : D.clone(bA, true, true))
                        }
                    }
                    bA = bz = null;
                    if (bw.length) {
                        D.each(bw, function(bG, bH) {
                            if (bH.src) {
                                if (D.ajax) {
                                    D.ajax({
                                        url: bH.src,
                                        type: "GET",
                                        dataType: "script",
                                        async: false,
                                        global: false,
                                        "throws": true
                                    })
                                } else {
                                    D.error("no ajax")
                                }
                            } else {
                                D.globalEval((bH.text || bH.textContent || bH.innerHTML || "").replace(aH, ""))
                            }
                            if (bH.parentNode) {
                                bH.parentNode.removeChild(bH)
                            }
                        })
                    }
                }
                return this
            }
        });

        function a4(bw, bv) {
            return bw.getElementsByTagName(bv)[0] || bw.appendChild(bw.ownerDocument.createElement(bv))
        }

        function s(bC, bw) {
            if (bw.nodeType !== 1 || !D.hasData(bC)) {
                return
            }
            var bz, by, bv, bB = D._data(bC),
                bA = D._data(bw, bB),
                bx = bB.events;
            if (bx) {
                delete bA.handle;
                bA.events = {};
                for (bz in bx) {
                    for (by = 0, bv = bx[bz].length; by < bv; by++) {
                        D.event.add(bw, bz, bx[bz][by])
                    }
                }
            }
            if (bA.data) {
                bA.data = D.extend({}, bA.data)
            }
        }

        function ac(bw, bv) {
            var bx;
            if (bv.nodeType !== 1) {
                return
            }
            if (bv.clearAttributes) {
                bv.clearAttributes()
            }
            if (bv.mergeAttributes) {
                bv.mergeAttributes(bw)
            }
            bx = bv.nodeName.toLowerCase();
            if (bx === "object") {
                if (bv.parentNode) {
                    bv.outerHTML = bw.outerHTML
                }
                if (D.support.html5Clone && (bw.innerHTML && !D.trim(bv.innerHTML))) {
                    bv.innerHTML = bw.innerHTML
                }
            } else {
                if (bx === "input" && S.test(bw.type)) {
                    bv.defaultChecked = bv.checked = bw.checked;
                    if (bv.value !== bw.value) {
                        bv.value = bw.value
                    }
                } else {
                    if (bx === "option") {
                        bv.selected = bw.defaultSelected
                    } else {
                        if (bx === "input" || bx === "textarea") {
                            bv.defaultValue = bw.defaultValue
                        } else {
                            if (bx === "script" && bv.text !== bw.text) {
                                bv.text = bw.text
                            }
                        }
                    }
                }
            }
            bv.removeAttribute(D.expando)
        }
        D.buildFragment = function(by, bz, bw) {
            var bx, bv, bA, bB = by[0];
            bz = bz || al;
            bz = !bz.nodeType && bz[0] || bz;
            bz = bz.ownerDocument || bz;
            if (by.length === 1 && typeof bB === "string" && bB.length < 512 && bz === al && bB.charAt(0) === "<" && !J.test(bB) && (D.support.checkClone || !p.test(bB)) && (D.support.html5Clone || !ad.test(bB))) {
                bv = true;
                bx = D.fragments[bB];
                bA = bx !== H
            }
            if (!bx) {
                bx = bz.createDocumentFragment();
                D.clean(by, bz, bx, bw);
                if (bv) {
                    D.fragments[bB] = bA && bx
                }
            }
            return {
                fragment: bx,
                cacheable: bv
            }
        };
        D.fragments = {};
        D.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function(bv, bw) {
            D.fn[bv] = function(bx) {
                var bz, bB = 0,
                    bA = [],
                    bD = D(bx),
                    by = bD.length,
                    bC = this.length === 1 && this[0].parentNode;
                if ((bC == null || bC && bC.nodeType === 11 && bC.childNodes.length === 1) && by === 1) {
                    bD[bw](this[0]);
                    return this
                } else {
                    for (; bB < by; bB++) {
                        bz = (bB > 0 ? this.clone(true) : this).get();
                        D(bD[bB])[bw](bz);
                        bA = bA.concat(bz)
                    }
                    return this.pushStack(bA, bv, bD.selector)
                }
            }
        });

        function bl(bv) {
            if (typeof bv.getElementsByTagName !== "undefined") {
                return bv.getElementsByTagName("*")
            } else {
                if (typeof bv.querySelectorAll !== "undefined") {
                    return bv.querySelectorAll("*")
                } else {
                    return []
                }
            }
        }

        function am(bv) {
            if (S.test(bv.type)) {
                bv.defaultChecked = bv.checked
            }
        }
        D.extend({
            clone: function(bz, bB, bx) {
                var bv, bw, by, bA;
                if (D.support.html5Clone || D.isXMLDoc(bz) || !ad.test("<" + bz.nodeName + ">")) {
                    bA = bz.cloneNode(true)
                } else {
                    bh.innerHTML = bz.outerHTML;
                    bh.removeChild(bA = bh.firstChild)
                }
                if ((!D.support.noCloneEvent || !D.support.noCloneChecked) && (bz.nodeType === 1 || bz.nodeType === 11) && !D.isXMLDoc(bz)) {
                    ac(bz, bA);
                    bv = bl(bz);
                    bw = bl(bA);
                    for (by = 0; bv[by]; ++by) {
                        if (bw[by]) {
                            ac(bv[by], bw[by])
                        }
                    }
                }
                if (bB) {
                    s(bz, bA);
                    if (bx) {
                        bv = bl(bz);
                        bw = bl(bA);
                        for (by = 0; bv[by]; ++by) {
                            s(bv[by], bw[by])
                        }
                    }
                }
                bv = bw = null;
                return bA
            },
            clean: function(bI, bx, bv, by) {
                var bF, bE, bH, bM, bB, bL, bC, bz, bw, bG, bK, bD, bA = bx === al && U,
                    bJ = [];
                if (!bx || typeof bx.createDocumentFragment === "undefined") {
                    bx = al
                }
                for (bF = 0;
                    (bH = bI[bF]) != null; bF++) {
                    if (typeof bH === "number") {
                        bH += ""
                    }
                    if (!bH) {
                        continue
                    }
                    if (typeof bH === "string") {
                        if (!Q.test(bH)) {
                            bH = bx.createTextNode(bH)
                        } else {
                            bA = bA || a(bx);
                            bC = bx.createElement("div");
                            bA.appendChild(bC);
                            bH = bH.replace(M, "<$1></$2>");
                            bM = (c.exec(bH) || ["", ""])[1].toLowerCase();
                            bB = an[bM] || an._default;
                            bL = bB[0];
                            bC.innerHTML = bB[1] + bH + bB[2];
                            while (bL--) {
                                bC = bC.lastChild
                            }
                            if (!D.support.tbody) {
                                bz = w.test(bH);
                                bw = bM === "table" && !bz ? bC.firstChild && bC.firstChild.childNodes : bB[1] === "<table>" && !bz ? bC.childNodes : [];
                                for (bE = bw.length - 1; bE >= 0; --bE) {
                                    if (D.nodeName(bw[bE], "tbody") && !bw[bE].childNodes.length) {
                                        bw[bE].parentNode.removeChild(bw[bE])
                                    }
                                }
                            }
                            if (!D.support.leadingWhitespace && ai.test(bH)) {
                                bC.insertBefore(bx.createTextNode(ai.exec(bH)[0]), bC.firstChild)
                            }
                            bH = bC.childNodes;
                            bC.parentNode.removeChild(bC)
                        }
                    }
                    if (bH.nodeType) {
                        bJ.push(bH)
                    } else {
                        D.merge(bJ, bH)
                    }
                }
                if (bC) {
                    bH = bC = bA = null
                }
                if (!D.support.appendChecked) {
                    for (bF = 0;
                        (bH = bJ[bF]) != null; bF++) {
                        if (D.nodeName(bH, "input")) {
                            am(bH)
                        } else {
                            if (typeof bH.getElementsByTagName !== "undefined") {
                                D.grep(bH.getElementsByTagName("input"), am)
                            }
                        }
                    }
                }
                if (bv) {
                    bK = function(bN) {
                        if (!bN.type || bq.test(bN.type)) {
                            return by ? by.push(bN.parentNode ? bN.parentNode.removeChild(bN) : bN) : bv.appendChild(bN)
                        }
                    };
                    for (bF = 0;
                        (bH = bJ[bF]) != null; bF++) {
                        if (!(D.nodeName(bH, "script") && bK(bH))) {
                            bv.appendChild(bH);
                            if (typeof bH.getElementsByTagName !== "undefined") {
                                bD = D.grep(D.merge([], bH.getElementsByTagName("script")), bK);
                                bJ.splice.apply(bJ, [bF + 1, 0].concat(bD));
                                bF += bD.length
                            }
                        }
                    }
                }
                return bJ
            },
            cleanData: function(bw, bE) {
                var bz, bx, by, bD, bA = 0,
                    bF = D.expando,
                    bv = D.cache,
                    bB = D.support.deleteExpando,
                    bC = D.event.special;
                for (;
                    (by = bw[bA]) != null; bA++) {
                    if (bE || D.acceptData(by)) {
                        bx = by[bF];
                        bz = bx && bv[bx];
                        if (bz) {
                            if (bz.events) {
                                for (bD in bz.events) {
                                    if (bC[bD]) {
                                        D.event.remove(by, bD)
                                    } else {
                                        D.removeEvent(by, bD, bz.handle)
                                    }
                                }
                            }
                            if (bv[bx]) {
                                delete bv[bx];
                                if (bB) {
                                    delete by[bF]
                                } else {
                                    if (by.removeAttribute) {
                                        by.removeAttribute(bF)
                                    } else {
                                        by[bF] = null
                                    }
                                }
                                D.deletedIds.push(bx)
                            }
                        }
                    }
                }
            }
        });
        (function() {
            var bv, bw;
            D.uaMatch = function(by) {
                by = by.toLowerCase();
                var bx = /(chrome)[ \/]([\w.]+)/.exec(by) || /(webkit)[ \/]([\w.]+)/.exec(by) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(by) || /(msie) ([\w.]+)/.exec(by) || by.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(by) || [];
                return {
                    browser: bx[1] || "",
                    version: bx[2] || "0"
                }
            };
            bv = D.uaMatch(bu.userAgent);
            bw = {};
            if (bv.browser) {
                bw[bv.browser] = true;
                bw.version = bv.version
            }
            if (bw.chrome) {
                bw.webkit = true
            } else {
                if (bw.webkit) {
                    bw.safari = true
                }
            }
            D.browser = bw;
            D.sub = function() {
                function by(bA, bB) {
                    return new by.fn.init(bA, bB)
                }
                D.extend(true, by, this);
                by.superclass = this;
                by.fn = by.prototype = this();
                by.fn.constructor = by;
                by.sub = this.sub;
                by.fn.init = function bz(bA, bB) {
                    if (bB && bB instanceof D && !(bB instanceof by)) {
                        bB = by(bB)
                    }
                    return D.fn.init.call(this, bA, bB, bx)
                };
                by.fn.init.prototype = by.fn;
                var bx = by(al);
                return by
            }
        })();
        var R, bd, m, ae = /alpha\([^)]*\)/i,
            ak = /opacity=([^)]*)/,
            x = /^(top|right|bottom|left)$/,
            aj = /^(none|table(?!-c[ea]).+)/,
            aw = /^margin/,
            j = new RegExp("^(" + aF + ")(.*)$", "i"),
            aW = new RegExp("^(" + aF + ")(?!px)[a-z%]+$", "i"),
            F = new RegExp("^([-+])=(" + aF + ")", "i"),
            K = {
                BODY: "block"
            },
            bb = {
                position: "absolute",
                visibility: "hidden",
                display: "block"
            },
            aM = {
                letterSpacing: 0,
                fontWeight: 400
            },
            E = ["Top", "Right", "Bottom", "Left"],
            P = ["Webkit", "O", "Moz", "ms"],
            bf = D.fn.toggle;

        function a3(by, bw) {
            if (bw in by) {
                return bw
            }
            var bz = bw.charAt(0).toUpperCase() + bw.slice(1),
                bv = bw,
                bx = P.length;
            while (bx--) {
                bw = P[bx] + bz;
                if (bw in by) {
                    return bw
                }
            }
            return bv
        }

        function aq(bw, bv) {
            bw = bv || bw;
            return D.css(bw, "display") === "none" || !D.contains(bw.ownerDocument, bw)
        }

        function bc(bA, bv) {
            var bz, bB, bw = [],
                bx = 0,
                by = bA.length;
            for (; bx < by; bx++) {
                bz = bA[bx];
                if (!bz.style) {
                    continue
                }
                bw[bx] = D._data(bz, "olddisplay");
                if (bv) {
                    if (!bw[bx] && bz.style.display === "none") {
                        bz.style.display = ""
                    }
                    if (bz.style.display === "" && aq(bz)) {
                        bw[bx] = D._data(bz, "olddisplay", aO(bz.nodeName))
                    }
                } else {
                    bB = R(bz, "display");
                    if (!bw[bx] && bB !== "none") {
                        D._data(bz, "olddisplay", bB)
                    }
                }
            }
            for (bx = 0; bx < by; bx++) {
                bz = bA[bx];
                if (!bz.style) {
                    continue
                }
                if (!bv || bz.style.display === "none" || bz.style.display === "") {
                    bz.style.display = bv ? bw[bx] || "" : "none"
                }
            }
            return bA
        }
        D.fn.extend({
            css: function(bv, bw) {
                return D.access(this, function(by, bx, bz) {
                    return bz !== H ? D.style(by, bx, bz) : D.css(by, bx)
                }, bv, bw, arguments.length > 1)
            },
            show: function() {
                return bc(this, true)
            },
            hide: function() {
                return bc(this)
            },
            toggle: function(bx, bw) {
                var bv = typeof bx === "boolean";
                if (D.isFunction(bx) && D.isFunction(bw)) {
                    return bf.apply(this, arguments)
                }
                return this.each(function() {
                    if (bv ? bx : aq(this)) {
                        D(this).show()
                    } else {
                        D(this).hide()
                    }
                })
            }
        });
        D.extend({
            cssHooks: {
                opacity: {
                    get: function(bx, bw) {
                        if (bw) {
                            var bv = R(bx, "opacity");
                            return bv === "" ? "1" : bv
                        }
                    }
                }
            },
            cssNumber: {
                fillOpacity: true,
                fontWeight: true,
                lineHeight: true,
                opacity: true,
                orphans: true,
                widows: true,
                zIndex: true,
                zoom: true
            },
            cssProps: {
                "float": D.support.cssFloat ? "cssFloat" : "styleFloat"
            },
            style: function(bx, bw, bD, by) {
                if (!bx || bx.nodeType === 3 || bx.nodeType === 8 || !bx.style) {
                    return
                }
                var bB, bC, bE, bz = D.camelCase(bw),
                    bv = bx.style;
                bw = D.cssProps[bz] || (D.cssProps[bz] = a3(bv, bz));
                bE = D.cssHooks[bw] || D.cssHooks[bz];
                if (bD !== H) {
                    bC = typeof bD;
                    if (bC === "string" && (bB = F.exec(bD))) {
                        bD = (bB[1] + 1) * bB[2] + parseFloat(D.css(bx, bw));
                        bC = "number"
                    }
                    if (bD == null || bC === "number" && isNaN(bD)) {
                        return
                    }
                    if (bC === "number" && !D.cssNumber[bz]) {
                        bD += "px"
                    }
                    if (!bE || !("set" in bE) || (bD = bE.set(bx, bD, by)) !== H) {
                        try {
                            bv[bw] = bD
                        } catch (bA) {}
                    }
                } else {
                    if (bE && "get" in bE && (bB = bE.get(bx, false, by)) !== H) {
                        return bB
                    }
                    return bv[bw]
                }
            },
            css: function(bB, bz, bA, bw) {
                var bC, by, bv, bx = D.camelCase(bz);
                bz = D.cssProps[bx] || (D.cssProps[bx] = a3(bB.style, bx));
                bv = D.cssHooks[bz] || D.cssHooks[bx];
                if (bv && "get" in bv) {
                    bC = bv.get(bB, true, bw)
                }
                if (bC === H) {
                    bC = R(bB, bz)
                }
                if (bC === "normal" && bz in aM) {
                    bC = aM[bz]
                }
                if (bA || bw !== H) {
                    by = parseFloat(bC);
                    return bA || D.isNumeric(by) ? by || 0 : bC
                }
                return bC
            },
            swap: function(bz, by, bA) {
                var bx, bw, bv = {};
                for (bw in by) {
                    bv[bw] = bz.style[bw];
                    bz.style[bw] = by[bw]
                }
                bx = bA.call(bz);
                for (bw in by) {
                    bz.style[bw] = bv[bw]
                }
                return bx
            }
        });
        if (be.getComputedStyle) {
            R = function(bC, bw) {
                var bv, bz, by, bB, bA = be.getComputedStyle(bC, null),
                    bx = bC.style;
                if (bA) {
                    bv = bA.getPropertyValue(bw) || bA[bw];
                    if (bv === "" && !D.contains(bC.ownerDocument, bC)) {
                        bv = D.style(bC, bw)
                    }
                    if (aW.test(bv) && aw.test(bw)) {
                        bz = bx.width;
                        by = bx.minWidth;
                        bB = bx.maxWidth;
                        bx.minWidth = bx.maxWidth = bx.width = bv;
                        bv = bA.width;
                        bx.width = bz;
                        bx.minWidth = by;
                        bx.maxWidth = bB
                    }
                }
                return bv
            }
        } else {
            if (al.documentElement.currentStyle) {
                R = function(bz, bx) {
                    var bA, bv, bw = bz.currentStyle && bz.currentStyle[bx],
                        by = bz.style;
                    if (bw == null && by && by[bx]) {
                        bw = by[bx]
                    }
                    if (aW.test(bw) && !x.test(bx)) {
                        bA = by.left;
                        bv = bz.runtimeStyle && bz.runtimeStyle.left;
                        if (bv) {
                            bz.runtimeStyle.left = bz.currentStyle.left
                        }
                        by.left = bx === "fontSize" ? "1em" : bw;
                        bw = by.pixelLeft + "px";
                        by.left = bA;
                        if (bv) {
                            bz.runtimeStyle.left = bv
                        }
                    }
                    return bw === "" ? "auto" : bw
                }
            }
        }

        function aP(bv, bx, by) {
            var bw = j.exec(bx);
            return bw ? Math.max(0, bw[1] - (by || 0)) + (bw[2] || "px") : bx
        }

        function a0(by, bw, bv, bA) {
            var bx = bv === (bA ? "border" : "content") ? 4 : bw === "width" ? 1 : 0,
                bz = 0;
            for (; bx < 4; bx += 2) {
                if (bv === "margin") {
                    bz += D.css(by, bv + E[bx], true)
                }
                if (bA) {
                    if (bv === "content") {
                        bz -= parseFloat(R(by, "padding" + E[bx])) || 0
                    }
                    if (bv !== "margin") {
                        bz -= parseFloat(R(by, "border" + E[bx] + "Width")) || 0
                    }
                } else {
                    bz += parseFloat(R(by, "padding" + E[bx])) || 0;
                    if (bv !== "padding") {
                        bz += parseFloat(R(by, "border" + E[bx] + "Width")) || 0
                    }
                }
            }
            return bz
        }

        function Z(by, bw, bv) {
            var bz = bw === "width" ? by.offsetWidth : by.offsetHeight,
                bx = true,
                bA = D.support.boxSizing && D.css(by, "boxSizing") === "border-box";
            if (bz <= 0 || bz == null) {
                bz = R(by, bw);
                if (bz < 0 || bz == null) {
                    bz = by.style[bw]
                }
                if (aW.test(bz)) {
                    return bz
                }
                bx = bA && (D.support.boxSizingReliable || bz === by.style[bw]);
                bz = parseFloat(bz) || 0
            }
            return (bz + a0(by, bw, bv || (bA ? "border" : "content"), bx)) + "px"
        }

        function aO(bx) {
            if (K[bx]) {
                return K[bx]
            }
            var bv = D("<" + bx + ">").appendTo(al.body),
                bw = bv.css("display");
            bv.remove();
            if (bw === "none" || bw === "") {
                bd = al.body.appendChild(bd || D.extend(al.createElement("iframe"), {
                    frameBorder: 0,
                    width: 0,
                    height: 0
                }));
                if (!m || !bd.createElement) {
                    m = (bd.contentWindow || bd.contentDocument).document;
                    m.write("<!doctype html><html><body>");
                    m.close()
                }
                bv = m.body.appendChild(m.createElement(bx));
                bw = R(bv, "display");
                al.body.removeChild(bd)
            }
            K[bx] = bw;
            return bw
        }
        D.each(["height", "width"], function(bw, bv) {
            D.cssHooks[bv] = {
                get: function(bz, by, bx) {
                    if (by) {
                        if (bz.offsetWidth === 0 && aj.test(R(bz, "display"))) {
                            return D.swap(bz, bb, function() {
                                return Z(bz, bv, bx)
                            })
                        } else {
                            return Z(bz, bv, bx)
                        }
                    }
                },
                set: function(by, bz, bx) {
                    return aP(by, bz, bx ? a0(by, bv, bx, D.support.boxSizing && D.css(by, "boxSizing") === "border-box") : 0)
                }
            }
        });
        if (!D.support.opacity) {
            D.cssHooks.opacity = {
                get: function(bw, bv) {
                    return ak.test((bv && bw.currentStyle ? bw.currentStyle.filter : bw.style.filter) || "") ? (0.01 * parseFloat(RegExp.$1)) + "" : bv ? "1" : ""
                },
                set: function(bz, bA) {
                    var by = bz.style,
                        bw = bz.currentStyle,
                        bv = D.isNumeric(bA) ? "alpha(opacity=" + bA * 100 + ")" : "",
                        bx = bw && bw.filter || by.filter || "";
                    by.zoom = 1;
                    if (bA >= 1 && D.trim(bx.replace(ae, "")) === "" && by.removeAttribute) {
                        by.removeAttribute("filter");
                        if (bw && !bw.filter) {
                            return
                        }
                    }
                    by.filter = ae.test(bx) ? bx.replace(ae, bv) : bx + " " + bv
                }
            }
        }
        D(function() {
            if (!D.support.reliableMarginRight) {
                D.cssHooks.marginRight = {
                    get: function(bw, bv) {
                        return D.swap(bw, {
                            display: "inline-block"
                        }, function() {
                            if (bv) {
                                return R(bw, "marginRight")
                            }
                        })
                    }
                }
            }
            if (!D.support.pixelPosition && D.fn.position) {
                D.each(["top", "left"], function(bv, bw) {
                    D.cssHooks[bw] = {
                        get: function(bz, by) {
                            if (by) {
                                var bx = R(bz, bw);
                                return aW.test(bx) ? D(bz).position()[bw] + "px" : bx
                            }
                        }
                    }
                })
            }
        });
        if (D.expr && D.expr.filters) {
            D.expr.filters.hidden = function(bv) {
                return (bv.offsetWidth === 0 && bv.offsetHeight === 0) || (!D.support.reliableHiddenOffsets && ((bv.style && bv.style.display) || R(bv, "display")) === "none")
            };
            D.expr.filters.visible = function(bv) {
                return !D.expr.filters.hidden(bv)
            }
        }
        D.each({
            margin: "",
            padding: "",
            border: "Width"
        }, function(bv, bw) {
            D.cssHooks[bv + bw] = {
                expand: function(bz) {
                    var by, bA = typeof bz === "string" ? bz.split(" ") : [bz],
                        bx = {};
                    for (by = 0; by < 4; by++) {
                        bx[bv + E[by] + bw] = bA[by] || bA[by - 2] || bA[0]
                    }
                    return bx
                }
            };
            if (!aw.test(bv)) {
                D.cssHooks[bv + bw].set = aP
            }
        });
        var g = /%20/g,
            ag = /\[\]$/,
            bs = /\r?\n/g,
            aV = /^(?:color|date|datetime|datetime-local|email|hidden|month|number|password|range|search|tel|text|time|url|week)$/i,
            q = /^(?:select|textarea)/i;
        D.fn.extend({
            serialize: function() {
                return D.param(this.serializeArray())
            },
            serializeArray: function() {
                return this.map(function() {
                    return this.elements ? D.makeArray(this.elements) : this
                }).filter(function() {
                    return this.name && !this.disabled && (this.checked || q.test(this.nodeName) || aV.test(this.type))
                }).map(function(bv, bw) {
                    var bx = D(this).val();
                    return bx == null ? null : D.isArray(bx) ? D.map(bx, function(bz, by) {
                        return {
                            name: bw.name,
                            value: bz.replace(bs, "\r\n")
                        }
                    }) : {
                        name: bw.name,
                        value: bx.replace(bs, "\r\n")
                    }
                }).get()
            }
        });
        D.param = function(bv, bx) {
            var by, bw = [],
                bz = function(bA, bB) {
                    bB = D.isFunction(bB) ? bB() : (bB == null ? "" : bB);
                    bw[bw.length] = encodeURIComponent(bA) + "=" + encodeURIComponent(bB)
                };
            if (bx === H) {
                bx = D.ajaxSettings && D.ajaxSettings.traditional
            }
            if (D.isArray(bv) || (bv.jqx && !D.isPlainObject(bv))) {
                D.each(bv, function() {
                    bz(this.name, this.value)
                })
            } else {
                for (by in bv) {
                    t(by, bv[by], bx, bz)
                }
            }
            return bw.join("&").replace(g, "+")
        };

        function t(bx, bz, bw, by) {
            var bv;
            if (D.isArray(bz)) {
                D.each(bz, function(bB, bA) {
                    if (bw || ag.test(bx)) {
                        by(bx, bA)
                    } else {
                        t(bx + "[" + (typeof bA === "object" ? bB : "") + "]", bA, bw, by)
                    }
                })
            } else {
                if (!bw && D.type(bz) === "object") {
                    for (bv in bz) {
                        t(bx + "[" + bv + "]", bz[bv], bw, by)
                    }
                } else {
                    by(bx, bz)
                }
            }
        }
        if (D.support.ajax) {
            D.ajaxTransport(function(bv) {
                if (!bv.crossDomain || D.support.cors) {
                    var bw;
                    return {
                        send: function(bC, bx) {
                            var bA, bz, bB = bv.xhr();
                            if (bv.username) {
                                bB.open(bv.type, bv.url, bv.async, bv.username, bv.password)
                            } else {
                                bB.open(bv.type, bv.url, bv.async)
                            }
                            if (bv.xhrFields) {
                                for (bz in bv.xhrFields) {
                                    bB[bz] = bv.xhrFields[bz]
                                }
                            }
                            if (bv.mimeType && bB.overrideMimeType) {
                                bB.overrideMimeType(bv.mimeType)
                            }
                            if (!bv.crossDomain && !bC["X-Requested-With"]) {
                                bC["X-Requested-With"] = "XMLHttpRequest"
                            }
                            try {
                                for (bz in bC) {
                                    bB.setRequestHeader(bz, bC[bz])
                                }
                            } catch (by) {}
                            bB.send((bv.hasContent && bv.data) || null);
                            bw = function(bL, bF) {
                                var bG, bE, bD, bJ, bI;
                                try {
                                    if (bw && (bF || bB.readyState === 4)) {
                                        bw = H;
                                        if (bA) {
                                            bB.onreadystatechange = D.noop;
                                            if (xhrOnUnloadAbort) {
                                                delete xhrCallbacks[bA]
                                            }
                                        }
                                        if (bF) {
                                            if (bB.readyState !== 4) {
                                                bB.abort()
                                            }
                                        } else {
                                            bG = bB.status;
                                            bD = bB.getAllResponseHeaders();
                                            bJ = {};
                                            bI = bB.responseXML;
                                            if (bI && bI.documentElement) {
                                                bJ.xml = bI
                                            }
                                            try {
                                                bJ.text = bB.responseText
                                            } catch (bK) {}
                                            try {
                                                bE = bB.statusText
                                            } catch (bK) {
                                                bE = ""
                                            }
                                            if (!bG && bv.isLocal && !bv.crossDomain) {
                                                bG = bJ.text ? 200 : 404
                                            } else {
                                                if (bG === 1223) {
                                                    bG = 204
                                                }
                                            }
                                        }
                                    }
                                } catch (bH) {
                                    if (!bF) {
                                        bx(-1, bH)
                                    }
                                }
                                if (bJ) {
                                    bx(bG, bE, bJ, bD)
                                }
                            };
                            if (!bv.async) {
                                bw()
                            } else {
                                if (bB.readyState === 4) {
                                    setTimeout(bw, 0)
                                } else {
                                    bA = ++xhrId;
                                    if (xhrOnUnloadAbort) {
                                        if (!xhrCallbacks) {
                                            xhrCallbacks = {};
                                            D(be).unload(xhrOnUnloadAbort)
                                        }
                                        xhrCallbacks[bA] = bw
                                    }
                                    bB.onreadystatechange = bw
                                }
                            }
                        },
                        abort: function() {
                            if (bw) {
                                bw(0, 1)
                            }
                        }
                    }
                }
            })
        }
        var a7, a2, at = /^(?:toggle|show|hide)$/,
            aN = new RegExp("^(?:([-+])=|)(" + aF + ")([a-z%]*)$", "i"),
            a8 = /queueHooks$/,
            l = [bn],
            I = {
                "*": [function(bv, bC) {
                    var by, bD, bE = this.createTween(bv, bC),
                        bz = aN.exec(bC),
                        bA = bE.cur(),
                        bw = +bA || 0,
                        bx = 1,
                        bB = 20;
                    if (bz) {
                        by = +bz[2];
                        bD = bz[3] || (D.cssNumber[bv] ? "" : "px");
                        if (bD !== "px" && bw) {
                            bw = D.css(bE.elem, bv, true) || by || 1;
                            do {
                                bx = bx || ".5";
                                bw = bw / bx;
                                D.style(bE.elem, bv, bw + bD)
                            } while (bx !== (bx = bE.cur() / bA) && bx !== 1 && --bB)
                        }
                        bE.unit = bD;
                        bE.start = bw;
                        bE.end = bz[1] ? bw + (bz[1] + 1) * by : by
                    }
                    return bE
                }]
            };

        function bm() {
            setTimeout(function() {
                a7 = H
            }, 0);
            return (a7 = D.now())
        }

        function aa(bw, bv) {
            D.each(bv, function(bB, bz) {
                var bA = (I[bB] || []).concat(I["*"]),
                    bx = 0,
                    by = bA.length;
                for (; bx < by; bx++) {
                    if (bA[bx].call(bw, bB, bz)) {
                        return
                    }
                }
            })
        }

        function bk(bx, bB, bE) {
            var bF, bA = 0,
                bv = 0,
                bw = l.length,
                bD = D.Deferred().always(function() {
                    delete bz.elem
                }),
                bz = function() {
                    var bL = a7 || bm(),
                        bI = Math.max(0, by.startTime + by.duration - bL),
                        bG = bI / by.duration || 0,
                        bK = 1 - bG,
                        bH = 0,
                        bJ = by.tweens.length;
                    for (; bH < bJ; bH++) {
                        by.tweens[bH].run(bK)
                    }
                    bD.notifyWith(bx, [by, bK, bI]);
                    if (bK < 1 && bJ) {
                        return bI
                    } else {
                        bD.resolveWith(bx, [by]);
                        return false
                    }
                },
                by = bD.promise({
                    elem: bx,
                    props: D.extend({}, bB),
                    opts: D.extend(true, {
                        specialEasing: {}
                    }, bE),
                    originalProperties: bB,
                    originalOptions: bE,
                    startTime: a7 || bm(),
                    duration: bE.duration,
                    tweens: [],
                    createTween: function(bJ, bG, bI) {
                        var bH = D.Tween(bx, by.opts, bJ, bG, by.opts.specialEasing[bJ] || by.opts.easing);
                        by.tweens.push(bH);
                        return bH
                    },
                    stop: function(bH) {
                        var bG = 0,
                            bI = bH ? by.tweens.length : 0;
                        for (; bG < bI; bG++) {
                            by.tweens[bG].run(1)
                        }
                        if (bH) {
                            bD.resolveWith(bx, [by, bH])
                        } else {
                            bD.rejectWith(bx, [by, bH])
                        }
                        return this
                    }
                }),
                bC = by.props;
            aX(bC, by.opts.specialEasing);
            for (; bA < bw; bA++) {
                bF = l[bA].call(by, bx, bC, by.opts);
                if (bF) {
                    return bF
                }
            }
            aa(by, bC);
            if (D.isFunction(by.opts.start)) {
                by.opts.start.call(bx, by)
            }
            D.fx.timer(D.extend(bz, {
                anim: by,
                queue: by.opts.queue,
                elem: bx
            }));
            return by.progress(by.opts.progress).done(by.opts.done, by.opts.complete).fail(by.opts.fail).always(by.opts.always)
        }

        function aX(by, bA) {
            var bx, bw, bB, bz, bv;
            for (bx in by) {
                bw = D.camelCase(bx);
                bB = bA[bw];
                bz = by[bx];
                if (D.isArray(bz)) {
                    bB = bz[1];
                    bz = by[bx] = bz[0]
                }
                if (bx !== bw) {
                    by[bw] = bz;
                    delete by[bx]
                }
                bv = D.cssHooks[bw];
                if (bv && "expand" in bv) {
                    bz = bv.expand(bz);
                    delete by[bw];
                    for (bx in bz) {
                        if (!(bx in by)) {
                            by[bx] = bz[bx];
                            bA[bx] = bB
                        }
                    }
                } else {
                    bA[bw] = bB
                }
            }
        }
        D.Animation = D.extend(bk, {
            tweener: function(bw, bz) {
                if (D.isFunction(bw)) {
                    bz = bw;
                    bw = ["*"]
                } else {
                    bw = bw.split(" ")
                }
                var by, bv = 0,
                    bx = bw.length;
                for (; bv < bx; bv++) {
                    by = bw[bv];
                    I[by] = I[by] || [];
                    I[by].unshift(bz)
                }
            },
            prefilter: function(bw, bv) {
                if (bv) {
                    l.unshift(bw)
                } else {
                    l.push(bw)
                }
            }
        });

        function bn(bz, bF, bv) {
            var bE, bx, bH, by, bL, bB, bK, bJ, bI, bA = this,
                bw = bz.style,
                bG = {},
                bD = [],
                bC = bz.nodeType && aq(bz);
            if (!bv.queue) {
                bJ = D._queueHooks(bz, "fx");
                if (bJ.unqueued == null) {
                    bJ.unqueued = 0;
                    bI = bJ.empty.fire;
                    bJ.empty.fire = function() {
                        if (!bJ.unqueued) {
                            bI()
                        }
                    }
                }
                bJ.unqueued++;
                bA.always(function() {
                    bA.always(function() {
                        bJ.unqueued--;
                        if (!D.queue(bz, "fx").length) {
                            bJ.empty.fire()
                        }
                    })
                })
            }
            if (bz.nodeType === 1 && ("height" in bF || "width" in bF)) {
                bv.overflow = [bw.overflow, bw.overflowX, bw.overflowY];
                if (D.css(bz, "display") === "inline" && D.css(bz, "float") === "none") {
                    if (!D.support.inlineBlockNeedsLayout || aO(bz.nodeName) === "inline") {
                        bw.display = "inline-block"
                    } else {
                        bw.zoom = 1
                    }
                }
            }
            if (bv.overflow) {
                bw.overflow = "hidden";
                if (!D.support.shrinkWrapBlocks) {
                    bA.done(function() {
                        bw.overflow = bv.overflow[0];
                        bw.overflowX = bv.overflow[1];
                        bw.overflowY = bv.overflow[2]
                    })
                }
            }
            for (bE in bF) {
                bH = bF[bE];
                if (at.exec(bH)) {
                    delete bF[bE];
                    bB = bB || bH === "toggle";
                    if (bH === (bC ? "hide" : "show")) {
                        continue
                    }
                    bD.push(bE)
                }
            }
            by = bD.length;
            if (by) {
                bL = D._data(bz, "fxshow") || D._data(bz, "fxshow", {});
                if ("hidden" in bL) {
                    bC = bL.hidden
                }
                if (bB) {
                    bL.hidden = !bC
                }
                if (bC) {
                    D(bz).show()
                } else {
                    bA.done(function() {
                        D(bz).hide()
                    })
                }
                bA.done(function() {
                    var bM;
                    D.removeData(bz, "fxshow", true);
                    for (bM in bG) {
                        D.style(bz, bM, bG[bM])
                    }
                });
                for (bE = 0; bE < by; bE++) {
                    bx = bD[bE];
                    bK = bA.createTween(bx, bC ? bL[bx] : 0);
                    bG[bx] = bL[bx] || D.style(bz, bx);
                    if (!(bx in bL)) {
                        bL[bx] = bK.start;
                        if (bC) {
                            bK.end = bK.start;
                            bK.start = bx === "width" || bx === "height" ? 1 : 0
                        }
                    }
                }
            }
        }

        function v(bx, bw, bz, bv, by) {
            return new v.prototype.init(bx, bw, bz, bv, by)
        }
        D.Tween = v;
        v.prototype = {
            constructor: v,
            init: function(by, bw, bA, bv, bz, bx) {
                this.elem = by;
                this.prop = bA;
                this.easing = bz || "swing";
                this.options = bw;
                this.start = this.now = this.cur();
                this.end = bv;
                this.unit = bx || (D.cssNumber[bA] ? "" : "px")
            },
            cur: function() {
                var bv = v.propHooks[this.prop];
                return bv && bv.get ? bv.get(this) : v.propHooks._default.get(this)
            },
            run: function(bx) {
                var bw, bv = v.propHooks[this.prop];
                if (this.options.duration) {
                    this.pos = bw = D.easing[this.easing](bx, this.options.duration * bx, 0, 1, this.options.duration)
                } else {
                    this.pos = bw = bx
                }
                this.now = (this.end - this.start) * bw + this.start;
                if (this.options.step) {
                    this.options.step.call(this.elem, this.now, this)
                }
                if (bv && bv.set) {
                    bv.set(this)
                } else {
                    v.propHooks._default.set(this)
                }
                return this
            }
        };
        v.prototype.init.prototype = v.prototype;
        v.propHooks = {
            _default: {
                get: function(bw) {
                    var bv;
                    if (bw.elem[bw.prop] != null && (!bw.elem.style || bw.elem.style[bw.prop] == null)) {
                        return bw.elem[bw.prop]
                    }
                    bv = D.css(bw.elem, bw.prop, false, "");
                    return !bv || bv === "auto" ? 0 : bv
                },
                set: function(bv) {
                    if (D.fx.step[bv.prop]) {
                        D.fx.step[bv.prop](bv)
                    } else {
                        if (bv.elem.style && (bv.elem.style[D.cssProps[bv.prop]] != null || D.cssHooks[bv.prop])) {
                            D.style(bv.elem, bv.prop, bv.now + bv.unit)
                        } else {
                            bv.elem[bv.prop] = bv.now
                        }
                    }
                }
            }
        };
        v.propHooks.scrollTop = v.propHooks.scrollLeft = {
            set: function(bv) {
                if (bv.elem.nodeType && bv.elem.parentNode) {
                    bv.elem[bv.prop] = bv.now
                }
            }
        };
        D.each(["toggle", "show", "hide"], function(bw, bv) {
            var bx = D.fn[bv];
            D.fn[bv] = function(by, bA, bz) {
                return by == null || typeof by === "boolean" || (!bw && D.isFunction(by) && D.isFunction(bA)) ? bx.apply(this, arguments) : this.animate(aZ(bv, true), by, bA, bz)
            }
        });
        D.fn.extend({
            fadeTo: function(bv, by, bx, bw) {
                return this.filter(aq).css("opacity", 0).show().end().animate({
                    opacity: by
                }, bv, bx, bw)
            },
            animate: function(bB, by, bA, bz) {
                var bx = D.isEmptyObject(bB),
                    bv = D.speed(by, bA, bz),
                    bw = function() {
                        var bC = bk(this, D.extend({}, bB), bv);
                        if (bx) {
                            bC.stop(true)
                        }
                    };
                return bx || bv.queue === false ? this.each(bw) : this.queue(bv.queue, bw)
            },
            stop: function(bx, bw, bv) {
                var by = function(bz) {
                    var bA = bz.stop;
                    delete bz.stop;
                    bA(bv)
                };
                if (typeof bx !== "string") {
                    bv = bw;
                    bw = bx;
                    bx = H
                }
                if (bw && bx !== false) {
                    this.queue(bx || "fx", [])
                }
                return this.each(function() {
                    var bC = true,
                        bz = bx != null && bx + "queueHooks",
                        bB = D.timers,
                        bA = D._data(this);
                    if (bz) {
                        if (bA[bz] && bA[bz].stop) {
                            by(bA[bz])
                        }
                    } else {
                        for (bz in bA) {
                            if (bA[bz] && bA[bz].stop && a8.test(bz)) {
                                by(bA[bz])
                            }
                        }
                    }
                    for (bz = bB.length; bz--;) {
                        if (bB[bz].elem === this && (bx == null || bB[bz].queue === bx)) {
                            bB[bz].anim.stop(bv);
                            bC = false;
                            bB.splice(bz, 1)
                        }
                    }
                    if (bC || !bv) {
                        D.dequeue(this, bx)
                    }
                })
            }
        });

        function aZ(bx, bz) {
            var by, bv = {
                    height: bx
                },
                bw = 0;
            bz = bz ? 1 : 0;
            for (; bw < 4; bw += 2 - bz) {
                by = E[bw];
                bv["margin" + by] = bv["padding" + by] = bx
            }
            if (bz) {
                bv.opacity = bv.width = bx
            }
            return bv
        }
        D.each({
            slideDown: aZ("show"),
            slideUp: aZ("hide"),
            slideToggle: aZ("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function(bv, bw) {
            D.fn[bv] = function(bx, bz, by) {
                return this.animate(bw, bx, bz, by)
            }
        });
        D.speed = function(bx, by, bw) {
            var bv = bx && typeof bx === "object" ? D.extend({}, bx) : {
                complete: bw || !bw && by || D.isFunction(bx) && bx,
                duration: bx,
                easing: bw && by || by && !D.isFunction(by) && by
            };
            bv.duration = D.fx.off ? 0 : typeof bv.duration === "number" ? bv.duration : bv.duration in D.fx.speeds ? D.fx.speeds[bv.duration] : D.fx.speeds._default;
            if (bv.queue == null || bv.queue === true) {
                bv.queue = "fx"
            }
            bv.old = bv.complete;
            bv.complete = function() {
                if (D.isFunction(bv.old)) {
                    bv.old.call(this)
                }
                if (bv.queue) {
                    D.dequeue(this, bv.queue)
                }
            };
            return bv
        };
        D.easing = {
            linear: function(bv) {
                return bv
            },
            swing: function(bv) {
                return 0.5 - Math.cos(bv * Math.PI) / 2
            }
        };
        D.timers = [];
        D.fx = v.prototype.init;
        D.fx.tick = function() {
            var bx, bw = D.timers,
                bv = 0;
            a7 = D.now();
            for (; bv < bw.length; bv++) {
                bx = bw[bv];
                if (!bx() && bw[bv] === bx) {
                    bw.splice(bv--, 1)
                }
            }
            if (!bw.length) {
                D.fx.stop()
            }
            a7 = H
        };
        D.fx.timer = function(bv) {
            if (bv() && D.timers.push(bv) && !a2) {
                a2 = setInterval(D.fx.tick, D.fx.interval)
            }
        };
        D.fx.interval = 13;
        D.fx.stop = function() {
            clearInterval(a2);
            a2 = null
        };
        D.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        };
        D.fx.step = {};
        if (D.expr && D.expr.filters) {
            D.expr.filters.animated = function(bv) {
                return D.grep(D.timers, function(bw) {
                    return bv === bw.elem
                }).length
            }
        }
        var W = /^(?:body|html)$/i;
        D.fn.offset = function(bF) {
            if (arguments.length) {
                return bF === H ? this : this.each(function(bG) {
                    D.offset.setOffset(this, bF, bG)
                })
            }
            var bw, bB, bC, bz, bD, bv, by, bA = {
                    top: 0,
                    left: 0
                },
                bx = this[0],
                bE = bx && bx.ownerDocument;
            if (!bE) {
                return
            }
            if ((bB = bE.body) === bx) {
                return D.offset.bodyOffset(bx)
            }
            bw = bE.documentElement;
            if (!D.contains(bw, bx)) {
                return bA
            }
            if (typeof bx.getBoundingClientRect !== "undefined") {
                bA = bx.getBoundingClientRect()
            }
            bC = aD(bE);
            bz = bw.clientTop || bB.clientTop || 0;
            bD = bw.clientLeft || bB.clientLeft || 0;
            bv = bC.pageYOffset || bw.scrollTop;
            by = bC.pageXOffset || bw.scrollLeft;
            return {
                top: bA.top + bv - bz,
                left: bA.left + by - bD
            }
        };
        D.offset = {
            bodyOffset: function(bv) {
                var bx = bv.offsetTop,
                    bw = bv.offsetLeft;
                if (D.support.doesNotIncludeMarginInBodyOffset) {
                    bx += parseFloat(D.css(bv, "marginTop")) || 0;
                    bw += parseFloat(D.css(bv, "marginLeft")) || 0
                }
                return {
                    top: bx,
                    left: bw
                }
            },
            setOffset: function(by, bH, bB) {
                var bC = D.css(by, "position");
                if (bC === "static") {
                    by.style.position = "relative"
                }
                var bA = D(by),
                    bw = bA.offset(),
                    bv = D.css(by, "top"),
                    bF = D.css(by, "left"),
                    bG = (bC === "absolute" || bC === "fixed") && D.inArray("auto", [bv, bF]) > -1,
                    bE = {},
                    bD = {},
                    bx, bz;
                if (bG) {
                    bD = bA.position();
                    bx = bD.top;
                    bz = bD.left
                } else {
                    bx = parseFloat(bv) || 0;
                    bz = parseFloat(bF) || 0
                }
                if (D.isFunction(bH)) {
                    bH = bH.call(by, bB, bw)
                }
                if (bH.top != null) {
                    bE.top = (bH.top - bw.top) + bx
                }
                if (bH.left != null) {
                    bE.left = (bH.left - bw.left) + bz
                }
                if ("using" in bH) {
                    bH.using.call(by, bE)
                } else {
                    bA.css(bE)
                }
            }
        };
        D.fn.extend({
            isRendered: function() {
                var bw = this;
                var bv = this[0];
                if (bv.parentNode == null || (bv.offsetWidth === 0 || bv.offsetHeight === 0)) {
                    return false
                }
                return true
            },
            getSizeFromStyle: function() {
                var bz = this;
                var by = null;
                var bv = null;
                var bx = this[0];
                var bw;
                if (bx.style.width) {
                    by = bx.style.width
                }
                if (bx.style.height) {
                    bv = bx.style.height
                }
                if (be.getComputedStyle) {
                    bw = getComputedStyle(bx, null)
                } else {
                    bw = bx.currentStyle
                }
                if (bw) {
                    if (bw.width) {
                        by = bw.width
                    }
                    if (bw.height) {
                        bv = bw.height
                    }
                }
                if (by === "0px") {
                    by = 0
                }
                if (bv === "0px") {
                    bv = 0
                }
                if (by === null) {
                    by = 0
                }
                if (bv === null) {
                    bv = 0
                }
                return {
                    width: by,
                    height: bv
                }
            },
            initAnimate: function() {},
            sizeStyleChanged: function(by) {
                var bx = this;
                var bz;
                var bv = function(bA) {
                    var bB = bz;
                    if (bA && bA[0] && bA[0].attributeName === "style" && bA[0].type === "attributes") {
                        if (bB.element.offsetWidth !== bB.offsetWidth || bB.element.offsetHeight !== bB.offsetHeight) {
                            bB.offsetWidth = bB.element.offsetWidth;
                            bB.offsetHeight = bB.element.offsetHeight;
                            if (bx.isRendered()) {
                                bB.callback()
                            }
                        }
                    }
                };
                bz = {
                    element: bx[0],
                    offsetWidth: bx[0].offsetWidth,
                    offsetHeight: bx[0].offsetHeight,
                    callback: by
                };
                try {
                    if (!bx.elementStyleObserver) {
                        bx.elementStyleObserver = new MutationObserver(bv);
                        bx.elementStyleObserver.observe(bx[0], {
                            attributes: true,
                            childList: false,
                            characterData: false
                        })
                    }
                } catch (bw) {}
            },
            position: function() {
                if (!this[0]) {
                    return
                }
                var bx = this[0],
                    bw = this.offsetParent(),
                    by = this.offset(),
                    bv = W.test(bw[0].nodeName) ? {
                        top: 0,
                        left: 0
                    } : bw.offset();
                by.top -= parseFloat(D.css(bx, "marginTop")) || 0;
                by.left -= parseFloat(D.css(bx, "marginLeft")) || 0;
                bv.top += parseFloat(D.css(bw[0], "borderTopWidth")) || 0;
                bv.left += parseFloat(D.css(bw[0], "borderLeftWidth")) || 0;
                return {
                    top: by.top - bv.top,
                    left: by.left - bv.left
                }
            },
            offsetParent: function() {
                return this.map(function() {
                    var bv = this.offsetParent || al.body;
                    while (bv && (!W.test(bv.nodeName) && D.css(bv, "position") === "static")) {
                        bv = bv.offsetParent
                    }
                    return bv || al.body
                })
            }
        });
        D.each({
            scrollLeft: "pageXOffset",
            scrollTop: "pageYOffset"
        }, function(bx, bw) {
            var bv = /Y/.test(bw);
            D.fn[bx] = function(by) {
                return D.access(this, function(bz, bC, bB) {
                    var bA = aD(bz);
                    if (bB === H) {
                        return bA ? (bw in bA) ? bA[bw] : bA.document.documentElement[bC] : bz[bC]
                    }
                    if (bA) {
                        bA.scrollTo(!bv ? bB : D(bA).scrollLeft(), bv ? bB : D(bA).scrollTop())
                    } else {
                        bz[bC] = bB
                    }
                }, bx, by, arguments.length, null)
            }
        });

        function aD(bv) {
            return D.isWindow(bv) ? bv : bv.nodeType === 9 ? bv.defaultView || bv.parentWindow : false
        }
        D.each({
            Height: "height",
            Width: "width"
        }, function(bv, bw) {
            D.each({
                padding: "inner" + bv,
                content: bw,
                "": "outer" + bv
            }, function(bx, by) {
                D.fn[by] = function(bC, bB) {
                    var bA = arguments.length && (bx || typeof bC !== "boolean"),
                        bz = bx || (bC === true || bB === true ? "margin" : "border");
                    return D.access(this, function(bE, bD, bF) {
                        var bG;
                        if (D.isWindow(bE)) {
                            return bE.document.documentElement["client" + bv]
                        }
                        if (bE.nodeType === 9) {
                            bG = bE.documentElement;
                            return Math.max(bE.body["scroll" + bv], bG["scroll" + bv], bE.body["offset" + bv], bG["offset" + bv], bG["client" + bv])
                        }
                        return bF === H ? D.css(bE, bD, bF, bz) : D.style(bE, bD, bF, bz)
                    }, bw, bA ? bC : H, bA, null)
                }
            })
        });
        be.JQXLite = be.jqxHelper = D;
        if (typeof define === "function" && define.amd && define.amd.JQXLite) {
            define("jqx", [], function() {
                return D
            })
        }
    })(window)
}(function(a) {
    if (a.jQuery) {
        a.minQuery = a.JQXLite = a.jQuery;
        return
    }
    if (!a.$) {
        a.$ = a.minQuery = a.JQXLite
    } else {
        a.minQuery = a.JQXLite = a.$
    }
})(window);
JQXLite.generateID = function() {
    var a = function() {
        return (((1 + Math.random()) * 65536) | 0).toString(16).substring(1)
    };
    var b = "";
    do {
        b = "jqx" + a() + a() + a()
    } while ($("#" + b).length > 0);
    return b
};
var jqxBaseFramework = window.jqxBaseFramework = window.minQuery || window.jQuery;
(function(a) {
    a.jqx = a.jqx || {};
    window.jqx = a.jqx;
    jqwidgets = {
        createInstance: function(b, d, f) {
            if (d == "jqxDataAdapter") {
                var e = f[0];
                var c = f[1] || {};
                return new a.jqx.dataAdapter(e, c)
            }
            a(b)[d](f || {});
            return a(b)[d]("getInstance")
        }
    };
    a.jqx.define = function(b, c, d) {
        b[c] = function() {
            if (this.baseType) {
                this.base = new b[this.baseType]();
                this.base.defineInstance()
            }
            this.defineInstance();
            this.metaInfo()
        };
        b[c].prototype.defineInstance = function() {};
        b[c].prototype.metaInfo = function() {};
        b[c].prototype.base = null;
        b[c].prototype.baseType = undefined;
        if (d && b[d]) {
            b[c].prototype.baseType = d
        }
    };
    a.jqx.invoke = function(e, d) {
        if (d.length == 0) {
            return
        }
        var f = typeof(d) == Array || d.length > 0 ? d[0] : d;
        var c = typeof(d) == Array || d.length > 1 ? Array.prototype.slice.call(d, 1) : a({}).toArray();
        while (e[f] == undefined && e.base != null) {
            if (e[f] != undefined && a.isFunction(e[f])) {
                return e[f].apply(e, c)
            }
            if (typeof f == "string") {
                var b = f.toLowerCase();
                if (e[b] != undefined && a.isFunction(e[b])) {
                    return e[b].apply(e, c)
                }
            }
            e = e.base
        }
        if (e[f] != undefined && a.isFunction(e[f])) {
            return e[f].apply(e, c)
        }
        if (typeof f == "string") {
            var b = f.toLowerCase();
            if (e[b] != undefined && a.isFunction(e[b])) {
                return e[b].apply(e, c)
            }
        }
        return
    };
    a.jqx.getByPriority = function(b) {
        var d = undefined;
        for (var c = 0; c < b.length && d == undefined; c++) {
            if (d == undefined && b[c] != undefined) {
                d = b[c]
            }
        }
        return d
    };
    a.jqx.hasProperty = function(c, b) {
        if (typeof(b) == "object") {
            for (var e in b) {
                var d = c;
                while (d) {
                    if (d.hasOwnProperty(e)) {
                        return true
                    }
                    if (d.hasOwnProperty(e.toLowerCase())) {
                        return true
                    }
                    d = d.base
                }
                return false
            }
        } else {
            while (c) {
                if (c.hasOwnProperty(b)) {
                    return true
                }
                if (c.hasOwnProperty(b.toLowerCase())) {
                    return true
                }
                c = c.base
            }
        }
        return false
    };
    a.jqx.hasFunction = function(e, d) {
        if (d.length == 0) {
            return false
        }
        if (e == undefined) {
            return false
        }
        var f = typeof(d) == Array || d.length > 0 ? d[0] : d;
        var c = typeof(d) == Array || d.length > 1 ? Array.prototype.slice.call(d, 1) : {};
        while (e[f] == undefined && e.base != null) {
            if (e[f] && a.isFunction(e[f])) {
                return true
            }
            if (typeof f == "string") {
                var b = f.toLowerCase();
                if (e[b] && a.isFunction(e[b])) {
                    return true
                }
            }
            e = e.base
        }
        if (e[f] && a.isFunction(e[f])) {
            return true
        }
        if (typeof f == "string") {
            var b = f.toLowerCase();
            if (e[b] && a.isFunction(e[b])) {
                return true
            }
        }
        return false
    };
    a.jqx.isPropertySetter = function(c, b) {
        if (b.length == 1 && typeof(b[0]) == "object") {
            return true
        }
        if (b.length == 2 && typeof(b[0]) == "string" && !a.jqx.hasFunction(c, b)) {
            return true
        }
        return false
    };
    a.jqx.validatePropertySetter = function(f, d, b) {
        if (!a.jqx.propertySetterValidation) {
            return true
        }
        if (d.length == 1 && typeof(d[0]) == "object") {
            for (var e in d[0]) {
                var g = f;
                while (!g.hasOwnProperty(e) && g.base) {
                    g = g.base
                }
                if (!g || !g.hasOwnProperty(e)) {
                    if (!b) {
                        var c = g.hasOwnProperty(e.toString().toLowerCase());
                        if (!c) {
                            throw "Invalid property: " + e
                        } else {
                            return true
                        }
                    }
                    return false
                }
            }
            return true
        }
        if (d.length != 2) {
            if (!b) {
                throw "Invalid property: " + d.length >= 0 ? d[0] : ""
            }
            return false
        }
        while (!f.hasOwnProperty(d[0]) && f.base) {
            f = f.base
        }
        if (!f || !f.hasOwnProperty(d[0])) {
            if (!b) {
                throw "Invalid property: " + d[0]
            }
            return false
        }
        return true
    };
    if (!Object.keys) {
        Object.keys = (function() {
            var d = Object.prototype.hasOwnProperty,
                e = !({
                    toString: null
                }).propertyIsEnumerable("toString"),
                c = ["toString", "toLocaleString", "valueOf", "hasOwnProperty", "isPrototypeOf", "propertyIsEnumerable", "constructor"],
                b = c.length;
            return function(h) {
                if (typeof h !== "object" && (typeof h !== "function" || h === null)) {
                    throw new TypeError("Object.keys called on non-object")
                }
                var f = [],
                    j, g;
                for (j in h) {
                    if (d.call(h, j)) {
                        f.push(j)
                    }
                }
                if (e) {
                    for (g = 0; g < b; g++) {
                        if (d.call(h, c[g])) {
                            f.push(c[g])
                        }
                    }
                }
                return f
            }
        }())
    }
    a.jqx.set = function(e, h) {
        var c = 0;
        if (h.length == 1 && typeof(h[0]) == "object") {
            if (e.isInitialized && Object.keys && Object.keys(h[0]).length > 1) {
                var f = !e.base ? e.element : e.base.element;
                var b = a.data(f, e.widgetName).initArgs;
                if (b && JSON && JSON.stringify && h[0] && b[0]) {
                    try {
                        if (JSON.stringify(h[0]) == JSON.stringify(b[0])) {
                            var g = true;
                            a.each(h[0], function(l, m) {
                                if (e[l] != m) {
                                    g = false;
                                    return false
                                }
                            });
                            if (g) {
                                return
                            }
                        }
                    } catch (d) {}
                }
                e.batchUpdate = h[0];
                var j = {};
                var k = {};
                a.each(h[0], function(l, m) {
                    var n = e;
                    while (!n.hasOwnProperty(l) && n.base != null) {
                        n = n.base
                    }
                    if (n.hasOwnProperty(l)) {
                        if (e[l] != m) {
                            j[l] = e[l];
                            k[l] = m;
                            c++
                        }
                    } else {
                        if (n.hasOwnProperty(l.toLowerCase())) {
                            if (e[l.toLowerCase()] != m) {
                                j[l.toLowerCase()] = e[l.toLowerCase()];
                                k[l.toLowerCase()] = m;
                                c++
                            }
                        }
                    }
                });
                if (c < 2) {
                    e.batchUpdate = null
                }
            }
            a.each(h[0], function(l, m) {
                var n = e;
                while (!n.hasOwnProperty(l) && n.base != null) {
                    n = n.base
                }
                if (n.hasOwnProperty(l)) {
                    a.jqx.setvalueraiseevent(n, l, m)
                } else {
                    if (n.hasOwnProperty(l.toLowerCase())) {
                        a.jqx.setvalueraiseevent(n, l.toLowerCase(), m)
                    } else {
                        if (a.jqx.propertySetterValidation) {
                            throw "jqxCore: invalid property '" + l + "'"
                        }
                    }
                }
            });
            if (e.batchUpdate != null) {
                e.batchUpdate = null;
                if (e.propertiesChangedHandler && c > 1) {
                    e.propertiesChangedHandler(e, j, k)
                }
            }
        } else {
            if (h.length == 2) {
                while (!e.hasOwnProperty(h[0]) && e.base) {
                    e = e.base
                }
                if (e.hasOwnProperty(h[0])) {
                    a.jqx.setvalueraiseevent(e, h[0], h[1])
                } else {
                    if (e.hasOwnProperty(h[0].toLowerCase())) {
                        a.jqx.setvalueraiseevent(e, h[0].toLowerCase(), h[1])
                    } else {
                        if (a.jqx.propertySetterValidation) {
                            throw "jqxCore: invalid property '" + h[0] + "'"
                        }
                    }
                }
            }
        }
    };
    a.jqx.setvalueraiseevent = function(c, d, e) {
        var b = c[d];
        c[d] = e;
        if (!c.isInitialized) {
            return
        }
        if (c.propertyChangedHandler != undefined) {
            c.propertyChangedHandler(c, d, b, e)
        }
        if (c.propertyChangeMap != undefined && c.propertyChangeMap[d] != undefined) {
            c.propertyChangeMap[d](c, d, b, e)
        }
    };
    a.jqx.get = function(e, d) {
        if (d == undefined || d == null) {
            return undefined
        }
        if (e.propertyMap) {
            var c = e.propertyMap(d);
            if (c != null) {
                return c
            }
        }
        if (e.hasOwnProperty(d)) {
            return e[d]
        }
        if (e.hasOwnProperty(d.toLowerCase())) {
            return e[d.toLowerCase()]
        }
        var b = undefined;
        if (typeof(d) == Array) {
            if (d.length != 1) {
                return undefined
            }
            b = d[0]
        } else {
            if (typeof(d) == "string") {
                b = d
            }
        }
        while (!e.hasOwnProperty(b) && e.base) {
            e = e.base
        }
        if (e) {
            return e[b]
        }
        return undefined
    };
    a.jqx.serialize = function(e) {
        var b = "";
        if (a.isArray(e)) {
            b = "[";
            for (var d = 0; d < e.length; d++) {
                if (d > 0) {
                    b += ", "
                }
                b += a.jqx.serialize(e[d])
            }
            b += "]"
        } else {
            if (typeof(e) == "object") {
                b = "{";
                var c = 0;
                for (var d in e) {
                    if (c++ > 0) {
                        b += ", "
                    }
                    b += d + ": " + a.jqx.serialize(e[d])
                }
                b += "}"
            } else {
                b = e.toString()
            }
        }
        return b
    };
    a.jqx.propertySetterValidation = true;
    a.jqx.jqxWidgetProxy = function(g, c, b) {
        var d = a(c);
        var f = a.data(c, g);
        if (f == undefined) {
            return undefined
        }
        var e = f.instance;
        if (a.jqx.hasFunction(e, b)) {
            return a.jqx.invoke(e, b)
        }
        if (a.jqx.isPropertySetter(e, b)) {
            if (a.jqx.validatePropertySetter(e, b)) {
                a.jqx.set(e, b);
                return undefined
            }
        } else {
            if (typeof(b) == "object" && b.length == 0) {
                return
            } else {
                if (typeof(b) == "object" && b.length == 1 && a.jqx.hasProperty(e, b[0])) {
                    return a.jqx.get(e, b[0])
                } else {
                    if (typeof(b) == "string" && a.jqx.hasProperty(e, b[0])) {
                        return a.jqx.get(e, b)
                    }
                }
            }
        }
        throw "jqxCore: Invalid parameter '" + a.jqx.serialize(b) + "' does not exist."
    };
    a.jqx.applyWidget = function(c, d, k, l) {
        var g = false;
        try {
            g = window.MSApp != undefined
        } catch (f) {}
        var m = a(c);
        if (!l) {
            l = new a.jqx["_" + d]()
        } else {
            l.host = m;
            l.element = c
        }
        if (c.id == "") {
            c.id = a.jqx.utilities.createId()
        }
        var j = {
            host: m,
            element: c,
            instance: l,
            initArgs: k
        };
        l.widgetName = d;
        a.data(c, d, j);
        a.data(c, "jqxWidget", j.instance);
        var h = new Array();
        var l = j.instance;
        while (l) {
            l.isInitialized = false;
            h.push(l);
            l = l.base
        }
        h.reverse();
        h[0].theme = a.jqx.theme || "";
        a.jqx.jqxWidgetProxy(d, c, k);
        for (var b in h) {
            l = h[b];
            if (b == 0) {
                l.host = m;
                l.element = c;
                l.WinJS = g
            }
            if (l != undefined) {
                if (l.definedInstance) {
                    l.definedInstance()
                }
                if (l.createInstance != null) {
                    if (g) {
                        MSApp.execUnsafeLocalFunction(function() {
                            l.createInstance(k)
                        })
                    } else {
                        l.createInstance(k)
                    }
                }
            }
        }
        for (var b in h) {
            if (h[b] != undefined) {
                h[b].isInitialized = true
            }
        }
        if (g) {
            MSApp.execUnsafeLocalFunction(function() {
                j.instance.refresh(true)
            })
        } else {
            j.instance.refresh(true)
        }
    };
    a.jqx.jqxWidget = function(b, c, f) {
        var j = false;
        try {
            jqxArgs = Array.prototype.slice.call(f, 0)
        } catch (h) {
            jqxArgs = ""
        }
        try {
            j = window.MSApp != undefined
        } catch (h) {}
        var g = b;
        var l = "";
        if (c) {
            l = "_" + c
        }
        a.jqx.define(a.jqx, "_" + g, l);
        var k = new Array();
        if (!window[g]) {
            var d = function(m) {
                if (m == null) {
                    return ""
                }
                var e = a.type(m);
                switch (e) {
                    case "string":
                    case "number":
                    case "date":
                    case "boolean":
                    case "bool":
                        if (m === null) {
                            return ""
                        }
                        return m.toString()
                }
                var n = "";
                a.each(m, function(p, q) {
                    var s = q;
                    if (p > 0) {
                        n += ", "
                    }
                    n += "[";
                    var o = 0;
                    if (a.type(s) == "object") {
                        for (var r in s) {
                            if (o > 0) {
                                n += ", "
                            }
                            n += "{" + r + ":" + s[r] + "}";
                            o++
                        }
                    } else {
                        if (o > 0) {
                            n += ", "
                        }
                        n += "{" + p + ":" + s + "}";
                        o++
                    }
                    n += "]"
                });
                return n
            };
            jqwidgets[g] = window[g] = function(e, r) {
                var m = [];
                if (!r) {
                    r = {}
                }
                m.push(r);
                var n = e;
                if (a.type(n) === "object" && e[0]) {
                    n = e[0].id;
                    if (n === "") {
                        n = e[0].id = a.jqx.utilities.createId()
                    }
                } else {
                    if (a.type(e) === "object" && e && e.nodeName) {
                        n = e.id;
                        if (n === "") {
                            n = e.id = a.jqx.utilities.createId()
                        }
                    }
                }
                if (window.jqxWidgets && window.jqxWidgets[n]) {
                    if (r) {
                        a.each(window.jqxWidgets[n], function(s) {
                            var t = a(this.element).data();
                            if (t && t.jqxWidget) {
                                a(this.element)[g](r)
                            }
                        })
                    }
                    if (window.jqxWidgets[n].length == 1) {
                        var p = a(window.jqxWidgets[n][0].widgetInstance.element).data();
                        if (p && p.jqxWidget) {
                            return window.jqxWidgets[n][0]
                        }
                    }
                    var p = a(window.jqxWidgets[n][0].widgetInstance.element).data();
                    if (p && p.jqxWidget) {
                        return window.jqxWidgets[n]
                    }
                }
                var o = a(e);
                if (o.length === 0) {
                    o = a("<div></div>");
                    if (g === "jqxInput" || g === "jqxPasswordInput" || g === "jqxMaskedInput") {
                        o = a("<input/>")
                    }
                    if (g === "jqxTextArea") {
                        o = a("<textarea></textarea>")
                    }
                    if (g === "jqxButton" || g === "jqxRepeatButton" || g === "jqxToggleButton") {
                        o = a("<button/>")
                    }
                    if (g === "jqxSplitter") {
                        o = a("<div><div>Panel 1</div><div>Panel 2</div></div>")
                    }
                    if (g === "jqxTabs") {
                        o = a("<div><ul><li>Tab 1</li><li>Tab 2</li></ul><div>Content 1</div><div>Content 2</div></div>")
                    }
                    if (g === "jqxRibbon") {
                        o = a("<div><ul><li>Tab 1</li><li>Tab 2</li></ul><div><div>Content 1</div><div>Content 2</div></div></div>")
                    }
                    if (g === "jqxDocking") {
                        o = a("<div><div><div><div>Title 1</div><div>Content 1</div></div></div></div>")
                    }
                    if (g === "jqxWindow") {
                        o = a("<div><div>Title 1</div><div>Content 1</div></div>")
                    }
                }
                var q = [];
                a.each(o, function(v) {
                    var x = o[v];
                    a.jqx.applyWidget(x, g, m, undefined);
                    if (!k[g]) {
                        var t = a.data(x, "jqxWidget");
                        var w = a.jqx["_" + g].prototype.defineInstance();
                        var u = {};
                        if (a.jqx["_" + g].prototype.metaInfo) {
                            u = a.jqx["_" + g].prototype.metaInfo()
                        }
                        if (g == "jqxDockingLayout") {
                            w = a.extend(w, a.jqx._jqxLayout.prototype.defineInstance())
                        }
                        if (g == "jqxToggleButton" || g == "jqxRepeatButton") {
                            w = a.extend(w, a.jqx._jqxButton.prototype.defineInstance())
                        }
                        if (g == "jqxTreeGrid") {
                            w = a.extend(w, a.jqx._jqxDataTable.prototype.defineInstance())
                        }
                        var s = function(z) {
                            var y = a.data(z, "jqxWidget");
                            this.widgetInstance = y;
                            var A = a.extend(this, y);
                            A.on = A.addEventListener = function(C, D) {
                                A.addHandler(!A.base ? A.host : A.base.host, C, D)
                            };
                            A.off = A.removeEventListener = function(C) {
                                A.removeHandler(!A.base ? A.host : A.base.host, C)
                            };
                            for (var B in y) {
                                if (a.type(y[B]) == "function") {
                                    A[B] = a.proxy(y[B], y)
                                }
                            }
                            return A
                        };
                        k[g] = s;
                        a.each(w, function(z, y) {
                            Object.defineProperty(s.prototype, z, {
                                get: function() {
                                    if (this.widgetInstance) {
                                        return this.widgetInstance[z]
                                    }
                                    return y
                                },
                                set: function(G) {
                                    if (this.widgetInstance && (this.widgetInstance[z] != G || z === "width" || z === "height")) {
                                        var E = this.widgetInstance[z];
                                        var D = G;
                                        var C = a.type(E);
                                        var A = a.type(D);
                                        var F = false;
                                        if (C != A || z === "source" || z === "width" || z === "height") {
                                            F = true
                                        }
                                        if (F || (d(E) != d(D))) {
                                            var B = {};
                                            B[z] = G;
                                            if (this.widgetInstance.host) {
                                                this.widgetInstance.host[g](B)
                                            } else {
                                                this.widgetInstance.base.host[g](B)
                                            }
                                            this.widgetInstance[z] = G;
                                            if (this.widgetInstance.propertyUpdated) {
                                                this.widgetInstance.propertyUpdated(z, E, G)
                                            }
                                        }
                                    }
                                }
                            })
                        })
                    }
                    var t = new k[g](x);
                    q.push(t);
                    if (!window.jqxWidgets) {
                        window.jqxWidgets = new Array()
                    }
                    if (!window.jqxWidgets[n]) {
                        window.jqxWidgets[n] = new Array()
                    }
                    window.jqxWidgets[n].push(t)
                });
                if (q.length === 1) {
                    return q[0]
                }
                return q
            }
        }
        a.fn[g] = function() {
            var e = Array.prototype.slice.call(arguments, 0);
            if (e.length == 0 || (e.length == 1 && typeof(e[0]) == "object")) {
                if (this.length == 0) {
                    if (this.selector) {
                        throw new Error("Invalid Selector - " + this.selector + "! Please, check whether the used ID or CSS Class name is correct.")
                    } else {
                        throw new Error("Invalid Selector! Please, check whether the used ID or CSS Class name is correct.")
                    }
                }
                return this.each(function() {
                    var p = a(this);
                    var o = this;
                    var q = a.data(o, g);
                    if (q == null) {
                        a.jqx.applyWidget(o, g, e, undefined)
                    } else {
                        a.jqx.jqxWidgetProxy(g, this, e)
                    }
                })
            } else {
                if (this.length == 0) {
                    if (this.selector) {
                        throw new Error("Invalid Selector - " + this.selector + "! Please, check whether the used ID or CSS Class name is correct.")
                    } else {
                        throw new Error("Invalid Selector! Please, check whether the used ID or CSS Class name is correct.")
                    }
                }
                var n = null;
                var m = 0;
                this.each(function() {
                    var o = a.jqx.jqxWidgetProxy(g, this, e);
                    if (m == 0) {
                        n = o;
                        m++
                    } else {
                        if (m == 1) {
                            var p = [];
                            p.push(n);
                            n = p
                        }
                        n.push(o)
                    }
                })
            }
            return n
        };
        try {
            a.extend(a.jqx["_" + g].prototype, Array.prototype.slice.call(f, 0)[0])
        } catch (h) {}
        a.extend(a.jqx["_" + g].prototype, {
            toThemeProperty: function(e, m) {
                return a.jqx.toThemeProperty(this, e, m)
            }
        });
        a.jqx["_" + g].prototype.refresh = function() {
            if (this.base) {
                this.base.refresh(true)
            }
        };
        a.jqx["_" + g].prototype.createInstance = function() {};
        a.jqx["_" + g].prototype.addEventHandler = function(m, e) {
            this.host.on(m, e)
        };
        a.jqx["_" + g].prototype.removeEventHandler = function(m, e) {
            this.host.off(m)
        };
        a.jqx["_" + g].prototype.applyTo = function(n, m) {
            if (!(m instanceof Array)) {
                var e = [];
                e.push(m);
                m = e
            }
            a.jqx.applyWidget(n, g, m, this)
        };
        a.jqx["_" + g].prototype.getInstance = function() {
            return this
        };
        a.jqx["_" + g].prototype.propertyChangeMap = {};
        a.jqx["_" + g].prototype.addHandler = function(o, e, m, n) {
            a.jqx.addHandler(a(o), e, m, n)
        };
        a.jqx["_" + g].prototype.removeHandler = function(n, e, m) {
            a.jqx.removeHandler(a(n), e, m)
        };
        a.jqx["_" + g].prototype.setOptions = function() {
            if (!this.host || !this.host.length || this.host.length != 1) {
                return
            }
            return a.jqx.jqxWidgetProxy(g, this.host[0], arguments)
        }
    };
    a.jqx.toThemeProperty = function(c, d, h) {
        if (c.theme == "") {
            return d
        }
        var g = d.split(" ");
        var b = "";
        for (var f = 0; f < g.length; f++) {
            if (f > 0) {
                b += " "
            }
            var e = g[f];
            if (h != null && h) {
                b += e + "-" + c.theme
            } else {
                b += e + " " + e + "-" + c.theme
            }
        }
        return b
    };
    a.jqx.addHandler = function(g, h, e, f) {
        var c = h.split(" ");
        for (var b = 0; b < c.length; b++) {
            var d = c[b];
            if (window.addEventListener) {
                switch (d) {
                    case "mousewheel":
                        if (a.jqx.browser.mozilla) {
                            g[0].addEventListener("DOMMouseScroll", e, false)
                        } else {
                            g[0].addEventListener("mousewheel", e, false)
                        }
                        continue;
                    case "mousemove":
                        if (!f) {
                            g[0].addEventListener("mousemove", e, false);
                            continue
                        }
                        break
                }
            }
            if (f == undefined || f == null) {
                if (g.on) {
                    g.on(d, e)
                } else {
                    g.bind(d, e)
                }
            } else {
                if (g.on) {
                    g.on(d, f, e)
                } else {
                    g.bind(d, f, e)
                }
            }
        }
    };
    a.jqx.removeHandler = function(f, g, e) {
        if (!g) {
            if (f.off) {
                f.off()
            } else {
                f.unbind()
            }
            return
        }
        var c = g.split(" ");
        for (var b = 0; b < c.length; b++) {
            var d = c[b];
            if (window.removeEventListener) {
                switch (d) {
                    case "mousewheel":
                        if (a.jqx.browser.mozilla) {
                            f[0].removeEventListener("DOMMouseScroll", e, false)
                        } else {
                            f[0].removeEventListener("mousewheel", e, false)
                        }
                        continue;
                    case "mousemove":
                        if (e) {
                            f[0].removeEventListener("mousemove", e, false);
                            continue
                        }
                        break
                }
            }
            if (d == undefined) {
                if (f.off) {
                    f.off()
                } else {
                    f.unbind()
                }
                continue
            }
            if (e == undefined) {
                if (f.off) {
                    f.off(d)
                } else {
                    f.unbind(d)
                }
            } else {
                if (f.off) {
                    f.off(d, e)
                } else {
                    f.unbind(d, e)
                }
            }
        }
    };
    a.jqx.theme = a.jqx.theme || "";
    a.jqx.scrollAnimation = a.jqx.scrollAnimation || false;
    a.jqx.resizeDelay = a.jqx.resizeDelay || 10;
    a.jqx.ready = function() {
        a(window).trigger("jqxReady")
    };
    a.jqx.init = function() {
        a.each(arguments[0], function(b, c) {
            if (b == "theme") {
                a.jqx.theme = c
            }
            if (b == "scrollBarSize") {
                a.jqx.utilities.scrollBarSize = c
            }
            if (b == "touchScrollBarSize") {
                a.jqx.utilities.touchScrollBarSize = c
            }
            if (b == "scrollBarButtonsVisibility") {
                a.jqx.utilities.scrollBarButtonsVisibility = c
            }
        })
    };
    a.jqx.utilities = a.jqx.utilities || {};
    a.extend(a.jqx.utilities, {
        scrollBarSize: 13,
        touchScrollBarSize: 8,
        scrollBarButtonsVisibility: "visible",
        createId: function() {
            var b = function() {
                return (((1 + Math.random()) * 65536) | 0).toString(16).substring(1)
            };
            return "jqxWidget" + b() + b() + b()
        },
        setTheme: function(f, g, e) {
            if (typeof e === "undefined") {
                return
            }
            if (!e[0].className.split) {
                return
            }
            var h = e[0].className.split(" "),
                b = [],
                j = [],
                d = e.children();
            for (var c = 0; c < h.length; c += 1) {
                if (h[c].indexOf(f) >= 0) {
                    if (f.length > 0) {
                        b.push(h[c]);
                        j.push(h[c].replace(f, g))
                    } else {
                        j.push(h[c].replace("-" + g, "") + "-" + g)
                    }
                }
            }
            this._removeOldClasses(b, e);
            this._addNewClasses(j, e);
            for (var c = 0; c < d.length; c += 1) {
                this.setTheme(f, g, a(d[c]))
            }
        },
        _removeOldClasses: function(d, c) {
            for (var b = 0; b < d.length; b += 1) {
                c.removeClass(d[b])
            }
        },
        _addNewClasses: function(d, c) {
            for (var b = 0; b < d.length; b += 1) {
                c.addClass(d[b])
            }
        },
        getOffset: function(b) {
            var d = a.jqx.mobile.getLeftPos(b[0]);
            var c = a.jqx.mobile.getTopPos(b[0]);
            return {
                top: c,
                left: d
            }
        },
        resize: function(g, s, p, o) {
            if (o === undefined) {
                o = true
            }
            var l = -1;
            var k = this;
            var d = function(u) {
                if (!k.hiddenWidgets) {
                    return -1
                }
                var v = -1;
                for (var t = 0; t < k.hiddenWidgets.length; t++) {
                    if (u.id) {
                        if (k.hiddenWidgets[t].id == u.id) {
                            v = t;
                            break
                        }
                    } else {
                        if (k.hiddenWidgets[t].id == u[0].id) {
                            v = t;
                            break
                        }
                    }
                }
                return v
            };
            if (this.resizeHandlers) {
                for (var h = 0; h < this.resizeHandlers.length; h++) {
                    if (g.id) {
                        if (this.resizeHandlers[h].id == g.id) {
                            l = h;
                            break
                        }
                    } else {
                        if (this.resizeHandlers[h].id == g[0].id) {
                            l = h;
                            break
                        }
                    }
                }
                if (p === true) {
                    if (l != -1) {
                        this.resizeHandlers.splice(l, 1);
                        if (this.watchedElementData && this.watchedElementData.length > 0) {
                            this.watchedElementData.splice(l, 1)
                        }
                    }
                    if (this.resizeHandlers.length == 0) {
                        var n = a(window);
                        if (n.off) {
                            n.off("resize.jqx");
                            n.off("orientationchange.jqx");
                            n.off("orientationchanged.jqx")
                        } else {
                            n.unbind("resize.jqx");
                            n.unbind("orientationchange.jqx");
                            n.unbind("orientationchanged.jqx")
                        }
                        this.resizeHandlers = null
                    }
                    var b = d(g);
                    if (b != -1 && this.hiddenWidgets) {
                        this.hiddenWidgets.splice(b, 1)
                    }
                    return
                }
            } else {
                if (p === true) {
                    var b = d(g);
                    if (b != -1 && this.hiddenWidgets) {
                        this.hiddenWidgets.splice(b, 1)
                    }
                    return
                }
            }
            var k = this;
            var m = function(v, E) {
                if (!k.resizeHandlers) {
                    return
                }
                var F = function(J) {
                    var I = -1;
                    var K = J.parentNode;
                    while (K) {
                        I++;
                        K = K.parentNode
                    }
                    return I
                };
                var u = function(L, J) {
                    if (!L.widget || !J.widget) {
                        return 0
                    }
                    var K = F(L.widget[0]);
                    var I = F(J.widget[0]);
                    try {
                        if (K < I) {
                            return -1
                        }
                        if (K > I) {
                            return 1
                        }
                    } catch (M) {
                        var N = M
                    }
                    return 0
                };
                var w = function(J) {
                    if (k.hiddenWidgets.length > 0) {
                        k.hiddenWidgets.sort(u);
                        var I = function() {
                            var L = false;
                            var N = new Array();
                            for (var M = 0; M < k.hiddenWidgets.length; M++) {
                                var K = k.hiddenWidgets[M];
                                if (a.jqx.isHidden(K.widget)) {
                                    L = true;
                                    N.push(K)
                                } else {
                                    if (K.callback) {
                                        K.callback(E)
                                    }
                                }
                            }
                            k.hiddenWidgets = N;
                            if (!L) {
                                clearInterval(k.__resizeInterval)
                            }
                        };
                        if (J == false) {
                            I();
                            if (k.__resizeInterval) {
                                clearInterval(k.__resizeInterval)
                            }
                            return
                        }
                        if (k.__resizeInterval) {
                            clearInterval(k.__resizeInterval)
                        }
                        k.__resizeInterval = setInterval(function() {
                            I()
                        }, 100)
                    }
                };
                if (k.hiddenWidgets && k.hiddenWidgets.length > 0) {
                    w(false)
                }
                k.hiddenWidgets = new Array();
                k.resizeHandlers.sort(u);
                for (var B = 0; B < k.resizeHandlers.length; B++) {
                    var H = k.resizeHandlers[B];
                    var D = H.widget;
                    var A = H.data;
                    if (!A) {
                        continue
                    }
                    if (!A.jqxWidget) {
                        continue
                    }
                    var t = A.jqxWidget.width;
                    var G = A.jqxWidget.height;
                    if (A.jqxWidget.base) {
                        if (t == undefined) {
                            t = A.jqxWidget.base.width
                        }
                        if (G == undefined) {
                            G = A.jqxWidget.base.height
                        }
                    }
                    if (t === undefined && G === undefined) {
                        t = A.jqxWidget.element.style.width;
                        G = A.jqxWidget.element.style.height
                    }
                    var C = false;
                    if (t != null && t.toString().indexOf("%") != -1) {
                        C = true
                    }
                    if (G != null && G.toString().indexOf("%") != -1) {
                        C = true
                    }
                    if (a.jqx.isHidden(D)) {
                        if (d(D) === -1) {
                            if (C || v === true) {
                                if (H.data.nestedWidget !== true) {
                                    k.hiddenWidgets.push(H)
                                }
                            }
                        }
                    } else {
                        if (v === undefined || v !== true) {
                            if (C) {
                                H.callback(E);
                                if (k.watchedElementData) {
                                    for (var y = 0; y < k.watchedElementData.length; y++) {
                                        if (k.watchedElementData[y].element == A.jqxWidget.element) {
                                            k.watchedElementData[y].offsetWidth = A.jqxWidget.element.offsetWidth;
                                            k.watchedElementData[y].offsetHeight = A.jqxWidget.element.offsetHeight;
                                            break
                                        }
                                    }
                                }
                                if (k.hiddenWidgets.indexOf(H) >= 0) {
                                    k.hiddenWidgets.splice(k.hiddenWidgets.indexOf(H), 1)
                                }
                            }
                            if (A.jqxWidget.element) {
                                var x = A.jqxWidget.element.className;
                                if (x.indexOf("dropdownlist") >= 0 || x.indexOf("datetimeinput") >= 0 || x.indexOf("combobox") >= 0 || x.indexOf("menu") >= 0) {
                                    if (A.jqxWidget.isOpened) {
                                        var z = A.jqxWidget.isOpened();
                                        if (z) {
                                            if (E && E == "resize" && a.jqx.mobile.isTouchDevice()) {
                                                continue
                                            }
                                            A.jqxWidget.close()
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                w()
            };
            if (!this.resizeHandlers) {
                this.resizeHandlers = new Array();
                var n = a(window);
                if (n.on) {
                    this._resizeTimer = null;
                    this._initResize = null;
                    n.on("resize.jqx", function(t) {
                        if (k._resizeTimer != undefined) {
                            clearTimeout(k._resizeTimer)
                        }
                        if (!k._initResize) {
                            k._initResize = true;
                            m(null, "resize")
                        } else {
                            k._resizeTimer = setTimeout(function() {
                                m(null, "resize")
                            }, a.jqx.resizeDelay)
                        }
                    });
                    n.on("orientationchange.jqx", function(t) {
                        m(null, "orientationchange")
                    });
                    n.on("orientationchanged.jqx", function(t) {
                        m(null, "orientationchange")
                    })
                } else {
                    n.bind("resize.jqx", function(t) {
                        m(null, "orientationchange")
                    });
                    n.bind("orientationchange.jqx", function(t) {
                        m(null, "orientationchange")
                    });
                    n.bind("orientationchanged.jqx", function(t) {
                        m(null, "orientationchange")
                    })
                }
            }
            var e = g.data();
            if (o) {
                if (l === -1) {
                    this.resizeHandlers.push({
                        id: g[0].id,
                        widget: g,
                        callback: s,
                        data: e
                    })
                }
            }
            try {
                var c = e.jqxWidget.width;
                var r = e.jqxWidget.height;
                if (e.jqxWidget.base) {
                    if (c == undefined) {
                        c = e.jqxWidget.base.width
                    }
                    if (r == undefined) {
                        r = e.jqxWidget.base.height
                    }
                }
                if (c === undefined && r === undefined) {
                    c = e.jqxWidget.element.style.width;
                    r = e.jqxWidget.element.style.height
                }
                var j = false;
                if (c != null && c.toString().indexOf("%") != -1) {
                    j = true
                }
                if (r != null && r.toString().indexOf("%") != -1) {
                    j = true
                }
                if (j) {
                    if (!this.watchedElementData) {
                        this.watchedElementData = []
                    }
                    var k = this;
                    var f = function(t) {
                        if (k.watchedElementData.forEach) {
                            k.watchedElementData.forEach(function(u) {
                                if (u.element.offsetWidth !== u.offsetWidth || u.element.offsetHeight !== u.offsetHeight) {
                                    u.offsetWidth = u.element.offsetWidth;
                                    u.offsetHeight = u.element.offsetHeight;
                                    if (u.timer) {
                                        clearTimeout(u.timer)
                                    }
                                    u.timer = setTimeout(function() {
                                        if (!a.jqx.isHidden(a(u.element))) {
                                            u.callback()
                                        } else {
                                            u.timer = setInterval(function() {
                                                if (!a.jqx.isHidden(a(u.element))) {
                                                    clearInterval(u.timer);
                                                    u.callback()
                                                }
                                            }, 100)
                                        }
                                    })
                                }
                            })
                        }
                    };
                    k.watchedElementData.push({
                        element: g[0],
                        offsetWidth: g[0].offsetWidth,
                        offsetHeight: g[0].offsetHeight,
                        callback: s
                    });
                    if (!k.observer) {
                        k.observer = new MutationObserver(f);
                        k.observer.observe(document.body, {
                            attributes: true,
                            childList: true,
                            characterData: true
                        })
                    }
                }
            } catch (q) {}
            if (a.jqx.isHidden(g) && o === true) {
                m(true)
            }
            a.jqx.resize = function() {
                m(null, "resize")
            }
        },
        parseJSON: function(d) {
            if (!d || typeof d !== "string") {
                return null
            }
            var b = /^[\],:{}\s]*$/,
                f = /(?:^|:|,)(?:\s*\[)+/g,
                c = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g,
                e = /"[^"\\\r\n]*"|true|false|null|-?(?:\d\d*\.|)\d+(?:[eE][\-+]?\d+|)/g;
            d = a.trim(d);
            if (window.JSON && window.JSON.parse) {
                return window.JSON.parse(d)
            }
            if (b.test(d.replace(c, "@").replace(e, "]").replace(f, ""))) {
                return (new Function("return " + d))()
            }
            throw new Error("Invalid JSON: " + d)
        },
        html: function(c, d) {
            if (!a(c).on) {
                return a(c).html(d)
            }
            try {
                return a.access(c, function(s) {
                    var f = c[0] || {},
                        m = 0,
                        j = c.length;
                    if (s === undefined) {
                        return f.nodeType === 1 ? f.innerHTML.replace(rinlinejQuery, "") : undefined
                    }
                    var r = /<(?:script|style|link)/i,
                        n = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
                        h = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,
                        p = /<([\w:]+)/,
                        g = /<(?:script|object|embed|option|style)/i,
                        k = new RegExp("<(?:" + n + ")[\\s/>]", "i"),
                        q = /^\s+/,
                        t = {
                            option: [1, "<select multiple='multiple'>", "</select>"],
                            legend: [1, "<fieldset>", "</fieldset>"],
                            thead: [1, "<table>", "</table>"],
                            tr: [2, "<table><tbody>", "</tbody></table>"],
                            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
                            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
                            area: [1, "<map>", "</map>"],
                            _default: [0, "", ""]
                        };
                    if (typeof s === "string" && !r.test(s) && (a.support.htmlSerialize || !k.test(s)) && (a.support.leadingWhitespace || !q.test(s)) && !t[(p.exec(s) || ["", ""])[1].toLowerCase()]) {
                        s = s.replace(h, "<$1></$2>");
                        try {
                            for (; m < j; m++) {
                                f = this[m] || {};
                                if (f.nodeType === 1) {
                                    a.cleanData(f.getElementsByTagName("*"));
                                    f.innerHTML = s
                                }
                            }
                            f = 0
                        } catch (o) {}
                    }
                    if (f) {
                        c.empty().append(s)
                    }
                }, null, d, arguments.length)
            } catch (b) {
                return a(c).html(d)
            }
        },
        hasTransform: function(d) {
            var c = "";
            c = d.css("transform");
            if (c == "" || c == "none") {
                c = d.parents().css("transform");
                if (c == "" || c == "none") {
                    var b = a.jqx.utilities.getBrowser();
                    if (b.browser == "msie") {
                        c = d.css("-ms-transform");
                        if (c == "" || c == "none") {
                            c = d.parents().css("-ms-transform")
                        }
                    } else {
                        if (b.browser == "chrome") {
                            c = d.css("-webkit-transform");
                            if (c == "" || c == "none") {
                                c = d.parents().css("-webkit-transform")
                            }
                        } else {
                            if (b.browser == "opera") {
                                c = d.css("-o-transform");
                                if (c == "" || c == "none") {
                                    c = d.parents().css("-o-transform")
                                }
                            } else {
                                if (b.browser == "mozilla") {
                                    c = d.css("-moz-transform");
                                    if (c == "" || c == "none") {
                                        c = d.parents().css("-moz-transform")
                                    }
                                }
                            }
                        }
                    }
                } else {
                    return c != "" && c != "none"
                }
            }
            if (c == "" || c == "none") {
                c = a(document.body).css("transform")
            }
            return c != "" && c != "none" && c != null
        },
        getBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = /(chrome)[ \/]([\w.]+)/.exec(c) || /(webkit)[ \/]([\w.]+)/.exec(c) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(c) || /(msie) ([\w.]+)/.exec(c) || c.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(c) || [];
            var d = {
                browser: b[1] || "",
                version: b[2] || "0"
            };
            if (c.indexOf("rv:11.0") >= 0 && c.indexOf(".net4.0c") >= 0) {
                d.browser = "msie";
                d.version = "11";
                b[1] = "msie"
            }
            if (c.indexOf("edge") >= 0) {
                d.browser = "msie";
                d.version = "12";
                b[1] = "msie"
            }
            d[b[1]] = b[1];
            return d
        }
    });
    a.jqx.browser = a.jqx.utilities.getBrowser();
    a.jqx.isHidden = function(c) {
        if (!c || !c[0]) {
            return false
        }
        var b = c[0].offsetWidth,
            d = c[0].offsetHeight;
        if (b === 0 || d === 0) {
            return true
        } else {
            return false
        }
    };
    a.jqx.ariaEnabled = true;
    a.jqx.aria = function(c, e, d) {
        if (!a.jqx.ariaEnabled) {
            return
        }
        if (e == undefined) {
            a.each(c.aria, function(g, h) {
                var k = !c.base ? c.host.attr(g) : c.base.host.attr(g);
                if (k != undefined && !a.isFunction(k)) {
                    var j = k;
                    switch (h.type) {
                        case "number":
                            j = new Number(k);
                            if (isNaN(j)) {
                                j = k
                            }
                            break;
                        case "boolean":
                            j = k == "true" ? true : false;
                            break;
                        case "date":
                            j = new Date(k);
                            if (j == "Invalid Date" || isNaN(j)) {
                                j = k
                            }
                            break
                    }
                    c[h.name] = j
                } else {
                    var k = c[h.name];
                    if (a.isFunction(k)) {
                        k = c[h.name]()
                    }
                    if (k == undefined) {
                        k = ""
                    }
                    try {
                        !c.base ? c.host.attr(g, k.toString()) : c.base.host.attr(g, k.toString())
                    } catch (f) {}
                }
            })
        } else {
            try {
                if (c.host) {
                    if (!c.base) {
                        if (c.host) {
                            if (c.element.setAttribute) {
                                c.element.setAttribute(e, d.toString())
                            } else {
                                c.host.attr(e, d.toString())
                            }
                        } else {
                            c.attr(e, d.toString())
                        }
                    } else {
                        if (c.base.host) {
                            c.base.host.attr(e, d.toString())
                        } else {
                            c.attr(e, d.toString())
                        }
                    }
                } else {
                    if (c.setAttribute) {
                        c.setAttribute(e, d.toString())
                    }
                }
            } catch (b) {}
        }
    };
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function(c) {
            var b = this.length;
            var d = Number(arguments[1]) || 0;
            d = (d < 0) ? Math.ceil(d) : Math.floor(d);
            if (d < 0) {
                d += b
            }
            for (; d < b; d++) {
                if (d in this && this[d] === c) {
                    return d
                }
            }
            return -1
        }
    }
    a.jqx.mobile = a.jqx.mobile || {};
    a.jqx.position = function(b) {
        var e = parseInt(b.pageX);
        var d = parseInt(b.pageY);
        if (a.jqx.mobile.isTouchDevice()) {
            var c = a.jqx.mobile.getTouches(b);
            var f = c[0];
            e = parseInt(f.pageX);
            d = parseInt(f.pageY)
        }
        return {
            left: e,
            top: d
        }
    };
    a.extend(a.jqx.mobile, {
        _touchListener: function(h, f) {
            var b = function(j, l) {
                var k = document.createEvent("MouseEvents");
                k.initMouseEvent(j, l.bubbles, l.cancelable, l.view, l.detail, l.screenX, l.screenY, l.clientX, l.clientY, l.ctrlKey, l.altKey, l.shiftKey, l.metaKey, l.button, l.relatedTarget);
                k._pageX = l.pageX;
                k._pageY = l.pageY;
                return k
            };
            var g = {
                mousedown: "touchstart",
                mouseup: "touchend",
                mousemove: "touchmove"
            };
            var d = b(g[h.type], h);
            h.target.dispatchEvent(d);
            var c = h.target["on" + g[h.type]];
            if (typeof c === "function") {
                c(h)
            }
        },
        setMobileSimulator: function(c, e) {
            if (this.isTouchDevice()) {
                return
            }
            this.simulatetouches = true;
            if (e == false) {
                this.simulatetouches = false
            }
            var d = {
                mousedown: "touchstart",
                mouseup: "touchend",
                mousemove: "touchmove"
            };
            var b = this;
            if (window.addEventListener) {
                var f = function() {
                    for (var g in d) {
                        if (c.addEventListener) {
                            c.removeEventListener(g, b._touchListener);
                            c.addEventListener(g, b._touchListener, false)
                        }
                    }
                };
                if (a.jqx.browser.msie) {
                    f()
                } else {
                    f()
                }
            }
        },
        isTouchDevice: function() {
            if (this.touchDevice != undefined) {
                return this.touchDevice
            }
            var c = "Browser CodeName: " + navigator.appCodeName + "";
            c += "Browser Name: " + navigator.appName + "";
            c += "Browser Version: " + navigator.appVersion + "";
            c += "Platform: " + navigator.platform + "";
            c += "User-agent header: " + navigator.userAgent + "";
            if (c.indexOf("Android") != -1) {
                return true
            }
            if (c.indexOf("IEMobile") != -1) {
                return true
            }
            if (c.indexOf("Windows Phone") != -1) {
                return true
            }
            if (c.indexOf("WPDesktop") != -1) {
                return true
            }
            if (c.indexOf("ZuneWP7") != -1) {
                return true
            }
            if (c.indexOf("BlackBerry") != -1 && c.indexOf("Mobile Safari") != -1) {
                return true
            }
            if (c.indexOf("ipod") != -1) {
                return true
            }
            if (c.indexOf("nokia") != -1 || c.indexOf("Nokia") != -1) {
                return true
            }
            if (c.indexOf("Chrome/17") != -1) {
                return false
            }
            if (c.indexOf("CrOS") != -1) {
                return false
            }
            if (c.indexOf("Opera") != -1 && c.indexOf("Mobi") == -1 && c.indexOf("Mini") == -1 && c.indexOf("Platform: Win") != -1) {
                return false
            }
            if (c.indexOf("Opera") != -1 && c.indexOf("Mobi") != -1 && c.indexOf("Opera Mobi") != -1) {
                return true
            }
            var d = {
                ios: "i(?:Pad|Phone|Pod)(?:.*)CPU(?: iPhone)? OS ",
                android: "(Android |HTC_|Silk/)",
                blackberry: "BlackBerry(?:.*)Version/",
                rimTablet: "RIM Tablet OS ",
                webos: "(?:webOS|hpwOS)/",
                bada: "Bada/"
            };
            try {
                if (this.touchDevice != undefined) {
                    return this.touchDevice
                }
                this.touchDevice = false;
                for (i in d) {
                    if (d.hasOwnProperty(i)) {
                        prefix = d[i];
                        match = c.match(new RegExp("(?:" + prefix + ")([^\\s;]+)"));
                        if (match) {
                            if (i.toString() == "blackberry") {
                                this.touchDevice = false;
                                return false
                            }
                            this.touchDevice = true;
                            return true
                        }
                    }
                }
                var f = navigator.userAgent;
                if (navigator.platform.toLowerCase().indexOf("win") != -1) {
                    if (f.indexOf("Windows Phone") >= 0 || f.indexOf("WPDesktop") >= 0 || f.indexOf("IEMobile") >= 0 || f.indexOf("ZuneWP7") >= 0) {
                        this.touchDevice = true;
                        return true
                    } else {
                        if (f.indexOf("Touch") >= 0) {
                            var b = ("MSPointerDown" in window) || ("pointerdown" in window);
                            if (b) {
                                this.touchDevice = true;
                                return true
                            }
                            if (f.indexOf("ARM") >= 0) {
                                this.touchDevice = true;
                                return true
                            }
                            this.touchDevice = false;
                            return false
                        }
                    }
                }
                if (navigator.platform.toLowerCase().indexOf("win") != -1) {
                    this.touchDevice = false;
                    return false
                }
                if (("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch) {
                    this.touchDevice = true
                }
                return this.touchDevice
            } catch (g) {
                this.touchDevice = false;
                return false
            }
        },
        getLeftPos: function(b) {
            var c = b.offsetLeft;
            while ((b = b.offsetParent) != null) {
                if (b.tagName != "HTML") {
                    c += b.offsetLeft;
                    if (document.all) {
                        c += b.clientLeft
                    }
                }
            }
            return c
        },
        getTopPos: function(c) {
            var e = c.offsetTop;
            var b = a(c).coord();
            while ((c = c.offsetParent) != null) {
                if (c.tagName != "HTML") {
                    e += (c.offsetTop - c.scrollTop);
                    if (document.all) {
                        e += c.clientTop
                    }
                }
            }
            var d = navigator.userAgent.toLowerCase();
            var f = (d.indexOf("windows phone") != -1 || d.indexOf("WPDesktop") != -1 || d.indexOf("ZuneWP7") != -1 || d.indexOf("msie 9") != -1 || d.indexOf("msie 11") != -1 || d.indexOf("msie 10") != -1) && d.indexOf("touch") != -1;
            if (f) {
                return b.top
            }
            if (this.isSafariMobileBrowser()) {
                if (this.isSafari4MobileBrowser() && this.isIPadSafariMobileBrowser()) {
                    return e
                }
                if (d.indexOf("version/7") != -1) {
                    return b.top
                }
                if (d.indexOf("version/6") != -1 || d.indexOf("version/5") != -1) {
                    e = e + a(window).scrollTop()
                }
                if (/(Android.*Chrome\/[.0-9]* (!?Mobile))/.exec(navigator.userAgent)) {
                    return e + a(window).scrollTop()
                }
                if (/(Android.*Chrome\/[.0-9]* Mobile)/.exec(navigator.userAgent)) {
                    return e + a(window).scrollTop()
                }
                return b.top
            }
            return e
        },
        isChromeMobileBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = c.indexOf("android") != -1;
            return b
        },
        isOperaMiniMobileBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = c.indexOf("opera mini") != -1 || c.indexOf("opera mobi") != -1;
            return b
        },
        isOperaMiniBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = c.indexOf("opera mini") != -1;
            return b
        },
        isNewSafariMobileBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = c.indexOf("ipad") != -1 || c.indexOf("iphone") != -1 || c.indexOf("ipod") != -1;
            b = b && (c.indexOf("version/5") != -1);
            return b
        },
        isSafari4MobileBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = c.indexOf("ipad") != -1 || c.indexOf("iphone") != -1 || c.indexOf("ipod") != -1;
            b = b && (c.indexOf("version/4") != -1);
            return b
        },
        isWindowsPhone: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = (c.indexOf("windows phone") != -1 || c.indexOf("WPDesktop") != -1 || c.indexOf("ZuneWP7") != -1 || c.indexOf("msie 9") != -1 || c.indexOf("msie 11") != -1 || c.indexOf("msie 10") != -1 && c.indexOf("touch") != -1);
            return b
        },
        isSafariMobileBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            if (/(Android.*Chrome\/[.0-9]* (!?Mobile))/.exec(navigator.userAgent)) {
                return true
            }
            if (/(Android.*Chrome\/[.0-9]* Mobile)/.exec(navigator.userAgent)) {
                return true
            }
            var b = c.indexOf("ipad") != -1 || c.indexOf("iphone") != -1 || c.indexOf("ipod") != -1 || c.indexOf("mobile safari") != -1;
            return b
        },
        isIPadSafariMobileBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = c.indexOf("ipad") != -1;
            return b
        },
        isMobileBrowser: function() {
            var c = navigator.userAgent.toLowerCase();
            var b = c.indexOf("ipad") != -1 || c.indexOf("iphone") != -1 || c.indexOf("android") != -1;
            return b
        },
        getTouches: function(b) {
            if (b.originalEvent) {
                if (b.originalEvent.touches && b.originalEvent.touches.length) {
                    return b.originalEvent.touches
                } else {
                    if (b.originalEvent.changedTouches && b.originalEvent.changedTouches.length) {
                        return b.originalEvent.changedTouches
                    }
                }
            }
            if (!b.touches) {
                b.touches = new Array();
                b.touches[0] = b.originalEvent != undefined ? b.originalEvent : b;
                if (b.originalEvent != undefined && b.pageX) {
                    b.touches[0] = b
                }
                if (b.type == "mousemove") {
                    b.touches[0] = b
                }
            }
            return b.touches
        },
        getTouchEventName: function(b) {
            if (this.isWindowsPhone()) {
                var c = navigator.userAgent.toLowerCase();
                if (c.indexOf("windows phone 7") != -1) {
                    if (b.toLowerCase().indexOf("start") != -1) {
                        return "MSPointerDown"
                    }
                    if (b.toLowerCase().indexOf("move") != -1) {
                        return "MSPointerMove"
                    }
                    if (b.toLowerCase().indexOf("end") != -1) {
                        return "MSPointerUp"
                    }
                }
                if (b.toLowerCase().indexOf("start") != -1) {
                    return "pointerdown"
                }
                if (b.toLowerCase().indexOf("move") != -1) {
                    return "pointermove"
                }
                if (b.toLowerCase().indexOf("end") != -1) {
                    return "pointerup"
                }
            } else {
                return b
            }
        },
        dispatchMouseEvent: function(b, f, d) {
            if (this.simulatetouches) {
                return
            }
            var c = document.createEvent("MouseEvent");
            c.initMouseEvent(b, true, true, f.view, 1, f.screenX, f.screenY, f.clientX, f.clientY, false, false, false, false, 0, null);
            if (d != null) {
                d.dispatchEvent(c)
            }
        },
        getRootNode: function(b) {
            while (b.nodeType !== 1) {
                b = b.parentNode
            }
            return b
        },
        setTouchScroll: function(b, c) {
            if (!this.enableScrolling) {
                this.enableScrolling = []
            }
            this.enableScrolling[c] = b
        },
        touchScroll: function(A, L, V, G, w, m) {
            if (A == null) {
                return
            }
            var F = this;
            var e = 0;
            var q = 0;
            var f = 0;
            var g = 0;
            var s = 0;
            var h = 0;
            if (!this.scrolling) {
                this.scrolling = []
            }
            this.scrolling[G] = false;
            var j = false;
            var o = a(A);
            var P = ["select", "input", "textarea"];
            var T = 0;
            var I = 0;
            if (!this.enableScrolling) {
                this.enableScrolling = []
            }
            this.enableScrolling[G] = true;
            var G = G;
            var t = this.getTouchEventName("touchstart") + ".touchScroll";
            var C = this.getTouchEventName("touchend") + ".touchScroll";
            var X = this.getTouchEventName("touchmove") + ".touchScroll";
            var k, S, y, U, ad, O, W, c, E, Z, ab, d, v, u, Q, b, D, ac, n;
            O = L;
            ad = 0;
            W = 0;
            xoffset = 0;
            initialOffset = 0;
            initialXOffset = 0;
            U = w.jqxScrollBar("max");
            n = 325;

            function z(ag) {
                if (ag.targetTouches && (ag.targetTouches.length >= 1)) {
                    return ag.targetTouches[0].clientY
                } else {
                    if (ag.originalEvent && ag.originalEvent.clientY !== undefined) {
                        return ag.originalEvent.clientY
                    } else {
                        var af = F.getTouches(ag);
                        return af[0].clientY
                    }
                }
            }

            function aa(ag) {
                if (ag.targetTouches && (ag.targetTouches.length >= 1)) {
                    return ag.targetTouches[0].clientX
                } else {
                    if (ag.originalEvent && ag.originalEvent.clientX !== undefined) {
                        return ag.originalEvent.clientX
                    } else {
                        var af = F.getTouches(ag);
                        return af[0].clientX
                    }
                }
            }
            var H = function() {
                var ah, af, ai, ag;
                ah = Date.now();
                af = ah - v;
                v = ah;
                ai = W - d;
                xdelta = xoffset - xframe;
                d = W;
                xframe = xoffset;
                E = true;
                ag = 1000 * ai / (1 + af);
                xv = 1000 * xdelta / (1 + af);
                ab = 0.8 * ag + 0.2 * ab;
                xjqxAnimations = 0.8 * xv + 0.2 * xjqxAnimations
            };
            var B = false;
            var T = function(ag) {
                if (!F.enableScrolling[G]) {
                    return true
                }
                if (a.inArray(ag.target.tagName.toLowerCase(), P) !== -1) {
                    return
                }
                W = m.jqxScrollBar("value");
                xoffset = w.jqxScrollBar("value");
                var ah = F.getTouches(ag);
                var ai = ah[0];
                if (ah.length == 1) {
                    F.dispatchMouseEvent("mousedown", ai, F.getRootNode(ai.target))
                }
                U = w.jqxScrollBar("max");
                O = m.jqxScrollBar("max");

                function af(aj) {
                    B = false;
                    E = true;
                    c = z(aj);
                    ac = aa(aj);
                    ab = Q = xjqxAnimations = 0;
                    d = W;
                    xframe = xoffset;
                    v = Date.now();
                    clearInterval(u);
                    u = setInterval(H, 100);
                    initialOffset = W;
                    initialXOffset = xoffset;
                    if (W > 0 && W < O && m[0].style.visibility != "hidden") {}
                }
                af(ag);
                j = false;
                q = ai.pageY;
                s = ai.pageX;
                if (F.simulatetouches) {
                    if (ai._pageY != undefined) {
                        q = ai._pageY;
                        s = ai._pageX
                    }
                }
                F.scrolling[G] = true;
                e = 0;
                g = 0;
                return true
            };
            if (o.on) {
                o.on(t, T)
            } else {
                o.bind(t, T)
            }
            var Y = function(ag, af) {
                W = (ag > O) ? O : (ag < ad) ? ad : ag;
                V(null, ag, 0, 0, af);
                return (ag > O) ? "max" : (ag < ad) ? "min" : "value"
            };
            var l = function(ag, af) {
                xoffset = (ag > U) ? U : (ag < ad) ? ad : ag;
                V(ag, null, 0, 0, af);
                return (ag > U) ? "max" : (ag < ad) ? "min" : "value"
            };

            function R() {
                var af, ag;
                if (Q) {
                    af = Date.now() - v;
                    ag = -Q * Math.exp(-af / n);
                    if (ag > 0.5 || ag < -0.5) {
                        Y(b + ag);
                        requestAnimationFrame(R)
                    } else {
                        Y(b)
                    }
                }
            }

            function M() {
                var af, ag;
                if (Q) {
                    af = Date.now() - v;
                    ag = -Q * Math.exp(-af / n);
                    if (ag > 0.5 || ag < -0.5) {
                        l(D + ag);
                        requestAnimationFrame(M)
                    } else {
                        l(D)
                    }
                }
            }
            var x = function(af) {
                if (!F.enableScrolling[G]) {
                    return true
                }
                if (!F.scrolling[G]) {
                    return true
                }
                if (B) {
                    af.preventDefault();
                    af.stopPropagation()
                }
                var ak = F.getTouches(af);
                if (ak.length > 1) {
                    return true
                }
                var ag = ak[0].pageY;
                var ai = ak[0].pageX;
                if (F.simulatetouches) {
                    if (ak[0]._pageY != undefined) {
                        ag = ak[0]._pageY;
                        ai = ak[0]._pageX
                    }
                }
                var am = ag - q;
                var an = ai - s;
                I = ag;
                touchHorizontalEnd = ai;
                f = am - e;
                h = an - g;
                j = true;
                e = am;
                g = an;
                var ah = w != null ? w[0].style.visibility != "hidden" : true;
                var al = m != null ? m[0].style.visibility != "hidden" : true;

                function aj(aq) {
                    var at, ar, ap;
                    if (E) {
                        at = z(aq);
                        ap = aa(aq);
                        ar = c - at;
                        xdelta = ac - ap;
                        var ao = "value";
                        if (ar > 2 || ar < -2) {
                            c = at;
                            ao = Y(W + ar, aq);
                            H();
                            if (ao == "min" && initialOffset === 0) {
                                return true
                            }
                            if (ao == "max" && initialOffset === O) {
                                return true
                            }
                            if (!al) {
                                return true
                            }
                            aq.preventDefault();
                            aq.stopPropagation();
                            B = true;
                            return false
                        } else {
                            if (xdelta > 2 || xdelta < -2) {
                                ac = ap;
                                ao = l(xoffset + xdelta, aq);
                                H();
                                if (ao == "min" && initialXOffset === 0) {
                                    return true
                                }
                                if (ao == "max" && initialXOffset === U) {
                                    return true
                                }
                                if (!ah) {
                                    return true
                                }
                                B = true;
                                aq.preventDefault();
                                aq.stopPropagation();
                                return false
                            }
                        }
                        aq.preventDefault()
                    }
                }
                if (ah || al) {
                    if ((ah) || (al)) {
                        aj(af)
                    }
                }
            };
            if (o.on) {
                o.on(X, x)
            } else {
                o.bind(X, x)
            }
            var r = function(ag) {
                if (!F.enableScrolling[G]) {
                    return true
                }
                var ah = F.getTouches(ag)[0];
                if (!F.scrolling[G]) {
                    return true
                }
                E = false;
                clearInterval(u);
                if (ab > 10 || ab < -10) {
                    Q = 0.8 * ab;
                    b = Math.round(W + Q);
                    v = Date.now();
                    requestAnimationFrame(R)
                } else {
                    if (xjqxAnimations > 10 || xjqxAnimations < -10) {
                        Q = 0.8 * xjqxAnimations;
                        D = Math.round(xoffset + Q);
                        v = Date.now();
                        requestAnimationFrame(M)
                    } else {}
                }
                F.scrolling[G] = false;
                if (j) {
                    F.dispatchMouseEvent("mouseup", ah, ag.target)
                } else {
                    var ah = F.getTouches(ag)[0],
                        af = F.getRootNode(ah.target);
                    F.dispatchMouseEvent("mouseup", ah, af);
                    F.dispatchMouseEvent("click", ah, af);
                    return true
                }
            };
            if (this.simulatetouches) {
                var p = a(window).on != undefined || a(window).bind;
                var N = function(af) {
                    try {
                        r(af)
                    } catch (ag) {}
                    F.scrolling[G] = false
                };
                a(window).on != undefined ? a(document).on("mouseup.touchScroll", N) : a(document).bind("mouseup.touchScroll", N);
                if (window.frameElement) {
                    if (window.top != null) {
                        var K = function(af) {
                            try {
                                r(af)
                            } catch (ag) {}
                            F.scrolling[G] = false
                        };
                        if (window.top.document) {
                            a(window.top.document).on ? a(window.top.document).on("mouseup", K) : a(window.top.document).bind("mouseup", K)
                        }
                    }
                }
                var ae = a(document).on != undefined || a(document).bind;
                var J = function(af) {
                    if (!F.scrolling[G]) {
                        return true
                    }
                    F.scrolling[G] = false;
                    var ah = F.getTouches(af)[0],
                        ag = F.getRootNode(ah.target);
                    F.dispatchMouseEvent("mouseup", ah, ag);
                    F.dispatchMouseEvent("click", ah, ag)
                };
                a(document).on != undefined ? a(document).on("touchend", J) : a(document).bind("touchend", J)
            }
            if (o.on) {
                o.on("dragstart", function(af) {
                    af.preventDefault()
                });
                o.on("selectstart", function(af) {
                    af.preventDefault()
                })
            }
            o.on ? o.on(C + " touchcancel.touchScroll", r) : o.bind(C + " touchcancel.touchScroll", r)
        }
    });
    a.jqx.cookie = a.jqx.cookie || {};
    a.extend(a.jqx.cookie, {
        cookie: function(e, f, c) {
            if (arguments.length > 1 && String(f) !== "[object Object]") {
                c = a.extend({}, c);
                if (f === null || f === undefined) {
                    c.expires = -1
                }
                if (typeof c.expires === "number") {
                    var h = c.expires,
                        d = c.expires = new Date();
                    d.setDate(d.getDate() + h)
                }
                f = String(f);
                return (document.cookie = [encodeURIComponent(e), "=", c.raw ? f : encodeURIComponent(f), c.expires ? "; expires=" + c.expires.toUTCString() : "", c.path ? "; path=" + c.path : "", c.domain ? "; domain=" + c.domain : "", c.secure ? "; secure" : ""].join(""))
            }
            c = f || {};
            var b, g = c.raw ? function(j) {
                return j
            } : decodeURIComponent;
            return (b = new RegExp("(?:^|; )" + encodeURIComponent(e) + "=([^;]*)").exec(document.cookie)) ? g(b[1]) : null
        }
    });
    a.jqx.string = a.jqx.string || {};
    a.extend(a.jqx.string, {
        replace: function(f, d, e) {
            if (d === e) {
                return this
            }
            var b = f;
            var c = b.indexOf(d);
            while (c != -1) {
                b = b.replace(d, e);
                c = b.indexOf(d)
            }
            return b
        },
        contains: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            return b.indexOf(c) != -1
        },
        containsIgnoreCase: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            return b.toString().toUpperCase().indexOf(c.toString().toUpperCase()) != -1
        },
        equals: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            b = this.normalize(b);
            if (c.length == b.length) {
                return b.slice(0, c.length) == c
            }
            return false
        },
        equalsIgnoreCase: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            b = this.normalize(b);
            if (c.length == b.length) {
                return b.toUpperCase().slice(0, c.length) == c.toUpperCase()
            }
            return false
        },
        startsWith: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            return b.slice(0, c.length) == c
        },
        startsWithIgnoreCase: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            return b.toUpperCase().slice(0, c.length) == c.toUpperCase()
        },
        normalize: function(b) {
            if (b.charCodeAt(b.length - 1) == 65279) {
                b = b.substring(0, b.length - 1)
            }
            return b
        },
        endsWith: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            b = this.normalize(b);
            return b.slice(-c.length) == c
        },
        endsWithIgnoreCase: function(b, c) {
            if (b == null || c == null) {
                return false
            }
            b = this.normalize(b);
            return b.toUpperCase().slice(-c.length) == c.toUpperCase()
        }
    });
    a.extend(a.easing, {
        easeOutBack: function(f, g, e, k, j, h) {
            if (h == undefined) {
                h = 1.70158
            }
            return k * ((g = g / j - 1) * g * ((h + 1) * g + h) + 1) + e
        },
        easeInQuad: function(f, g, e, j, h) {
            return j * (g /= h) * g + e
        },
        easeInOutCirc: function(f, g, e, j, h) {
            if ((g /= h / 2) < 1) {
                return -j / 2 * (Math.sqrt(1 - g * g) - 1) + e
            }
            return j / 2 * (Math.sqrt(1 - (g -= 2) * g) + 1) + e
        },
        easeInOutSine: function(f, g, e, j, h) {
            return -j / 2 * (Math.cos(Math.PI * g / h) - 1) + e
        },
        easeInCubic: function(f, g, e, j, h) {
            return j * (g /= h) * g * g + e
        },
        easeOutCubic: function(f, g, e, j, h) {
            return j * ((g = g / h - 1) * g * g + 1) + e
        },
        easeInOutCubic: function(f, g, e, j, h) {
            if ((g /= h / 2) < 1) {
                return j / 2 * g * g * g + e
            }
            return j / 2 * ((g -= 2) * g * g + 2) + e
        },
        easeInSine: function(f, g, e, j, h) {
            return -j * Math.cos(g / h * (Math.PI / 2)) + j + e
        },
        easeOutSine: function(f, g, e, j, h) {
            return j * Math.sin(g / h * (Math.PI / 2)) + e
        },
        easeInOutSine: function(f, g, e, j, h) {
            return -j / 2 * (Math.cos(Math.PI * g / h) - 1) + e
        }
    })
})(jqxBaseFramework);
(function(b) {
    if (b.event && b.event.special) {
        b.extend(b.event.special, {
            close: {
                noBubble: true
            },
            open: {
                noBubble: true
            },
            cellclick: {
                noBubble: true
            },
            rowclick: {
                noBubble: true
            },
            tabclick: {
                noBubble: true
            },
            selected: {
                noBubble: true
            },
            expanded: {
                noBubble: true
            },
            collapsed: {
                noBubble: true
            },
            valuechanged: {
                noBubble: true
            },
            expandedItem: {
                noBubble: true
            },
            collapsedItem: {
                noBubble: true
            },
            expandingItem: {
                noBubble: true
            },
            collapsingItem: {
                noBubble: true
            }
        })
    }
    if (b.fn.extend) {
        b.fn.extend({
            ischildof: function(g) {
                if (!b(this).parents) {
                    var c = g.element.contains(this.element);
                    return c
                }
                var e = b(this).parents().get();
                for (var d = 0; d < e.length; d++) {
                    if (typeof g != "string") {
                        var f = e[d];
                        if (g !== undefined) {
                            if (f == g[0]) {
                                return true
                            }
                        }
                    } else {
                        if (g !== undefined) {
                            if (b(e[d]).is(g)) {
                                return true
                            }
                        }
                    }
                }
                return false
            }
        })
    }
    b.fn.jqxProxy = function() {
        var e = b(this).data().jqxWidget;
        var c = Array.prototype.slice.call(arguments, 0);
        var d = e.element;
        if (!d) {
            d = e.base.element
        }
        return b.jqx.jqxWidgetProxy(e.widgetName, d, c)
    };
    var a = this.originalVal = b.fn.val;
    b.fn.val = function(d) {
        if (typeof d == "undefined") {
            if (b(this).hasClass("jqx-widget")) {
                var c = b(this).data().jqxWidget;
                if (c && c.val) {
                    return c.val()
                }
            }
            if (this[0] && this[0].tagName.toLowerCase().indexOf("angular") >= 0) {
                var c = b(this).find(".jqx-widget").data().jqxWidget;
                if (c && c.val) {
                    return c.val()
                }
            }
            return a.call(this)
        } else {
            if (b(this).hasClass("jqx-widget")) {
                var c = b(this).data().jqxWidget;
                if (c && c.val) {
                    if (arguments.length != 2) {
                        return c.val(d)
                    } else {
                        return c.val(d, arguments[1])
                    }
                }
            }
            if (this[0] && this[0].tagName.toLowerCase().indexOf("angular") >= 0) {
                var c = b(this).find(".jqx-widget").data().jqxWidget;
                if (c && c.val) {
                    if (arguments.length != 2) {
                        return c.val(d)
                    } else {
                        return c.val(d, arguments[1])
                    }
                }
            }
            return a.call(this, d)
        }
    };
    if (b.fn.modal && b.fn.modal.Constructor) {
        b.fn.modal.Constructor.prototype.enforceFocus = function() {
            b(document).off("focusin.bs.modal").on("focusin.bs.modal", b.proxy(function(c) {
                if (this.$element[0] !== c.target && !this.$element.has(c.target).length) {
                    if (b(c.target).parents().hasClass("jqx-popup")) {
                        return true
                    }
                    this.$element.trigger("focus")
                }
            }, this))
        }
    }
    b.fn.coord = function(o) {
        var e, k, j = {
                top: 0,
                left: 0
            },
            f = this[0],
            m = f && f.ownerDocument;
        if (!m) {
            return
        }
        e = m.documentElement;
        if (!b.contains(e, f)) {
            return j
        }
        if (typeof f.getBoundingClientRect !== undefined) {
            j = f.getBoundingClientRect()
        }
        var d = function(p) {
            return b.isWindow(p) ? p : p.nodeType === 9 ? p.defaultView || p.parentWindow : false
        };
        k = d(m);
        var h = 0;
        var c = 0;
        var g = navigator.userAgent.toLowerCase();
        var n = g.indexOf("ipad") != -1 || g.indexOf("iphone") != -1;
        if (n) {
            h = 2
        }
        if (true == o) {
            if (document.body.style.position != "static" && document.body.style.position != "") {
                var l = b(document.body).coord();
                h = -l.left;
                c = -l.top
            }
        }
        return {
            top: c + j.top + (k.pageYOffset || e.scrollTop) - (e.clientTop || 0),
            left: h + j.left + (k.pageXOffset || e.scrollLeft) - (e.clientLeft || 0)
        }
    }
})(jqxBaseFramework);
