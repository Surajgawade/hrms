/*
jQWidgets v5.5.0 (2017-Dec)
Copyright (c) 2011-2017 jQWidgets.
License: https://jqwidgets.com/license/
*/
(function(i) {
    i.jqx.observableArray = function(e, J) {
        if (typeof(e) == "string") {
            e = i.parseJSON(e)
        }
        if (!Object.defineProperty || !(function() {
                try {
                    Object.defineProperty({}, "x", {});
                    return true
                } catch (M) {
                    return false
                }
            }())) {
            var L = Object.defineProperty;
            Object.defineProperty = function(O, P, N) {
                if (L) {
                    try {
                        return L(O, P, N)
                    } catch (M) {}
                }
                if (O !== Object(O)) {
                    throw TypeError("Object.defineProperty called on non-object")
                }
                if (Object.prototype.__defineGetter__ && ("get" in N)) {
                    Object.prototype.__defineGetter__.call(O, P, N.get)
                }
                if (Object.prototype.__defineSetter__ && ("set" in N)) {
                    Object.prototype.__defineSetter__.call(O, P, N.set)
                }
                if ("value" in N) {
                    O[P] = N.value
                } else {
                    if (!O[P]) {
                        O[P] = N
                    }
                }
                return O
            }
        }
        if (!Array.prototype.forEach) {
            Array.prototype.forEach = function(N) {
                if (this === void 0 || this === null) {
                    throw TypeError()
                }
                var Q = Object(this);
                var M = Q.length >>> 0;
                if (typeof N !== "function") {
                    throw TypeError()
                }
                var P = arguments[1],
                    O;
                for (O = 0; O < M; O++) {
                    if (O in Q) {
                        N.call(P, Q[O], O, Q)
                    }
                }
            }
        }
        if (typeof Object.getOwnPropertyNames !== "function") {
            Object.getOwnPropertyNames = function(O) {
                if (O !== Object(O)) {
                    throw TypeError("Object.getOwnPropertyNames called on non-object")
                }
                var M = [],
                    N;
                for (N in O) {
                    if (Object.prototype.hasOwnProperty.call(O, N)) {
                        M.push(N)
                    }
                }
                return M
            }
        }
        var I = this,
            H, K = [];
        I.notifier = null;
        I.name = "observableArray";
        I.observing = true;
        I.changes = new Array();
        var J = J;
        I.observe = function() {
            I.observing = true;
            if (arguments.length == 1) {
                J = arguments[0]
            }
        };
        I.unobserve = function() {
            I.observing = false
        };
        I.toArray = function() {
            return K.slice(0)
        };
        I.toJSON = function(X, O) {
            var U = K;
            if (O) {
                U = O
            }
            var T = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
                W = {
                    "\b": "\\b",
                    "\t": "\\t",
                    "\n": "\\n",
                    "\f": "\\f",
                    "\r": "\\r",
                    '"': '\\"',
                    "\\": "\\\\"
                };

            function M(Z) {
                return '"' + Z.replace(T, function(aa) {
                    var ab = W[aa];
                    return typeof ab === "string" ? ab : "\\u" + ("0000" + aa.charCodeAt(0).toString(16)).slice(-4)
                }) + '"'
            }

            function N(Z) {
                return Z < 10 ? "0" + Z : Z
            }

            function P(aa) {
                var Z;
                if (isFinite(aa.valueOf())) {
                    Z = aa.getUTCFullYear() + "-" + N(aa.getUTCMonth() + 1) + "-" + N(aa.getUTCDate()) + "T" + N(aa.getUTCHours()) + ":" + N(aa.getUTCMinutes()) + ":" + N(aa.getUTCSeconds()) + 'Z"'
                } else {
                    Z = "null"
                }
                return Z
            }

            function Q(ac) {
                var Z = ac.length,
                    aa = [],
                    ab;
                for (ab = 0; ab < Z; ab++) {
                    aa.push(R(ab, ac) || "null")
                }
                return "[" + aa.join(",") + "]"
            }

            function Y(ac) {
                var aa = [],
                    ab, Z;
                for (ab in ac) {
                    if (Object.prototype.hasOwnProperty.call(ac, ab)) {
                        if (ab != "" && X && X.indexOf(ab) === -1) {
                            continue
                        }
                        Z = R(ab, ac);
                        if (Z) {
                            aa.push(M(ab) + ":" + Z)
                        }
                    }
                }
                return "{" + aa.join(",") + "}"
            }

            function S(Z) {
                switch (Object.prototype.toString.call(Z)) {
                    case "[object Date]":
                        return P(Z);
                    case "[object Array]":
                        return Q(Z)
                }
                return Y(Z)
            }

            function V(aa, Z) {
                switch (Z) {
                    case "string":
                        return M(aa);
                    case "number":
                    case "float":
                    case "integer":
                    case "int":
                        return isFinite(aa) ? aa : "null";
                    case "boolean":
                        return aa
                }
                return "null"
            }

            function R(aa, Z) {
                var ac = Z[aa],
                    ab = typeof ac;
                if (ac && typeof ac === "object" && typeof ac.toJSON === "function") {
                    ac = ac.toJSON(aa);
                    ab = typeof ac
                }
                if (/(number|float|int|integer|string|boolean)/.test(ab) || (!ac && ab === "object")) {
                    return V(ac, ab)
                } else {
                    return S(ac)
                }
            }
            if (!X && window.JSON && typeof window.JSON.stringify === "function") {
                return window.JSON.stringify(U)
            }
            return R("", {
                "": U
            })
        };
        I.defineIndexProperty = function(O) {
            if (!(O in I)) {
                var M = function(V, S, U, R) {
                    var T = V[S];
                    var Q = T;
                    var P = function() {
                        return Q
                    };
                    var W = function(ab) {
                        T = ab;
                        if (Q !== T) {
                            var aa = Q;
                            Q = T;
                            if (typeof H === "function") {
                                var Y = K.indexOf(R);
                                var Z = "";
                                var X = function(ad, ac) {
                                    Object.getOwnPropertyNames(ad).forEach(function(ae) {
                                        var af = i.type(ad[ae]);
                                        if (af == "array" || af == "object") {
                                            X(ad[ae], ac + "." + ae)
                                        } else {
                                            if (S === ae) {
                                                Z = ac + "." + ae
                                            }
                                        }
                                    })
                                };
                                X(R, Y);
                                H({
                                    object: I,
                                    type: "update",
                                    path: Z,
                                    index: Y,
                                    name: S,
                                    newValue: T,
                                    oldValue: aa
                                })
                            }
                        }
                        Q = T;
                        return T
                    };
                    if (V[S] != undefined && S != "length") {
                        if (Object.defineProperty) {
                            Object.defineProperty(V, S, {
                                get: P,
                                set: W
                            })
                        } else {
                            if (Object.prototype.__defineGetter__ && Object.prototype.__defineSetter__) {
                                Object.prototype.__defineGetter__.call(V, S, P);
                                Object.prototype.__defineSetter__.call(V, S, W)
                            }
                        }
                    }
                };
                var N = function(S, R, P) {
                    var Q = i.type(S);
                    if (/(number|float|int|integer|string|boolean)/.test(Q)) {
                        return
                    }
                    if (S === undefined) {
                        return
                    }
                    Object.getOwnPropertyNames(S).forEach(function(T) {
                        var U = i.type(S[T]);
                        if (U == "array" || U == "object") {
                            M(S, T, R + "." + T, P);
                            N(S[T], R + "." + T, P)
                        } else {
                            M(S, T, R + "." + T, P)
                        }
                    })
                };
                Object.defineProperty(I, O, {
                    configurable: true,
                    enumerable: true,
                    get: function() {
                        return K[O]
                    },
                    set: function(Q) {
                        var P = K[O];
                        if (I.toJSON(null, P) != I.toJSON(null, Q)) {
                            K[O] = Q;
                            if (typeof H === "function") {
                                H({
                                    object: I,
                                    type: "update",
                                    path: O.toString(),
                                    index: O,
                                    name: "index",
                                    newValue: Q,
                                    oldValue: P
                                })
                            }
                            N(Q, O, Q)
                        }
                    }
                });
                N(I[O], O, I[O])
            }
        };
        I.push = function() {
            var M;
            for (var N = 0, O = arguments.length; N < O; N++) {
                M = K.length;
                K.push(arguments[N]);
                I.defineIndexProperty(M);
                if (typeof H === "function") {
                    H({
                        object: I,
                        type: "add",
                        name: "length",
                        index: M,
                        newValue: K.length,
                        oldValue: M
                    })
                }
            }
            return K.length
        };
        I.pop = function() {
            if (~K.length) {
                var M = K.length - 1,
                    N = K.pop();
                delete I[M];
                if (typeof H === "function") {
                    H({
                        object: I,
                        type: "delete",
                        name: "length",
                        index: M,
                        newValue: K.length,
                        oldValue: M
                    })
                }
                return N
            }
        };
        I.unshift = function() {
            var M = K.length;
            for (var N = 0, O = arguments.length; N < O; N++) {
                K.splice(N, 0, arguments[N]);
                I.defineIndexProperty(K.length - 1)
            }
            if (typeof H === "function") {
                H({
                    object: I,
                    type: "add",
                    index: 0,
                    name: "length",
                    newValue: K.length,
                    oldValue: M
                })
            }
            return K.length
        };
        I.shift = function() {
            var M = K.length;
            if (~K.length) {
                var N = K.shift();
                K.length === 0 && delete I[M];
                if (typeof H === "function") {
                    H({
                        object: I,
                        type: "delete",
                        index: M,
                        name: "length",
                        newValue: K.length,
                        oldValue: M
                    })
                }
                return N
            }
        };
        I.slice = function(Q, N, P) {
            var M = K.slice(Q, N);
            var O = new i.jqx.observableArray(M, P);
            return O
        };
        I.splice = function(Q, R, M) {
            var P = [],
                U, T;
            Q = !~Q ? K.length - Q : Q;
            R = (R == null ? K.length - Q : R) || 0;
            while (R--) {
                U = K.splice(Q, 1)[0];
                P.push(U);
                delete I[K.length];
                if (typeof H === "function") {
                    H({
                        object: I,
                        type: "delete",
                        index: Q,
                        name: "length",
                        newValue: -1,
                        oldValue: Q
                    })
                }
            }
            for (var N = 2, S = arguments.length; N < S; N++) {
                K.splice(Q, 0, arguments[N]);
                defineIndexProperty(K.length - 1);
                if (typeof H === "function") {
                    H({
                        object: I,
                        type: "add",
                        index: Q,
                        name: "length",
                        newValue: K.length - 1,
                        oldValue: Q
                    })
                }
                Q++
            }
            var O = new i.jqx.observableArray(P, M);
            return O
        };
        Object.defineProperty(I, "length", {
            configurable: false,
            enumerable: true,
            get: function() {
                return K.length
            },
            set: function(M) {
                var N = Number(M);
                if (N % 1 === 0 && N >= 0) {
                    if (N < K.length) {
                        I.splice(N)
                    } else {
                        if (N > K.length) {
                            I.push.apply(I, new Array(N - K.length))
                        }
                    }
                } else {
                    throw new RangeError("Invalid array length")
                }
                return M
            }
        });
        i.jqx.observableArray.prototype.fromArray = function(O, N) {
            var M = new i.jqx.observableArray(O, N);
            return M
        };
        i.jqx.observableArray.prototype.clone = function() {
            var M = new i.jqx.observableArray(K, J);
            M.observing = I.observing;
            M.changes = I.changes;
            M.notifier = I.notifier;
            return M
        };
        I.remove = function(N) {
            if (N < 0 || N >= I.length) {
                throw new Error("Invalid index : " + N)
            }
            if (I.hasOwnProperty(N)) {
                var M = I[N];
                I[N] = undefined;
                K[N] = undefined;
                if (typeof H === "function") {
                    H({
                        object: I,
                        type: "delete",
                        index: N,
                        name: "index",
                        newValue: undefined,
                        oldValue: M
                    })
                }
                return true
            }
            return false
        };
        I.concat = function(N, P) {
            var M = K.concat(N);
            var O = new i.jqx.observableArray(M, P);
            return O
        };
        Object.getOwnPropertyNames(Array.prototype).forEach(function(M) {
            if (!(M in I)) {
                var N = function() {
                    var Q = I.observing;
                    I.observing = false;
                    var P = K[M];
                    var O = P.apply(K, arguments);
                    I.observing = Q;
                    return O
                };
                Object.defineProperty(I, M, {
                    configurable: false,
                    enumerable: true,
                    writeable: false,
                    value: N
                })
            }
        });
        I.set = function(N, P) {
            if (i.type(N) == "string" && N.split(".").length > 1) {
                var M = N.split(".");
                var Q = I;
                for (var O = 0; O < M.length; O++) {
                    if (O === 0) {
                        if (M[O] >= I.length) {
                            throw new Error("Invalid Index: " + N)
                        }
                    }
                    if (O < M.length - 1) {
                        Q = Q[M[O]]
                    } else {
                        Q[M[O]] = P
                    }
                }
                return true
            }
            if (N >= I.length) {
                I.push(P)
            } else {
                I[N] = P
            }
            return true
        };
        I.get = function(M) {
            return I[M]
        };
        if (e instanceof Array) {
            I.push.apply(I, e)
        }
        H = function() {
            if (!I.observing) {
                return
            }
            if (arguments && arguments[0]) {
                I.changes.push(arguments[0])
            }
            if (J) {
                J.apply(I, arguments)
            }
            if (I.notifier) {
                I.notifier.apply(I, arguments)
            }
        };
        return I
    };
    i.jqx.formatDate = function(H, J, I) {
        var e = i.jqx.dataFormat.formatdate(H, J, I);
        return e
    };
    i.jqx.formatNumber = function(H, J, I) {
        var e = i.jqx.dataFormat.formatnumber(H, J, I);
        return e
    };
    i.jqx.dataAdapter = function(J, e) {
        if (J != undefined) {
            if (J.dataFields !== undefined) {
                J.datafields = J.dataFields
            }
            if (J.dataType !== undefined) {
                J.datatype = J.dataType
            }
            if (J.localData !== undefined) {
                J.localdata = J.localData
            }
            if (J.sortColumn !== undefined) {
                J.sortcolumn = J.sortColumn
            }
            if (J.sortDirection !== undefined) {
                J.sortdirection = J.sortDirection
            }
            if (J.sortOrder !== undefined) {
                J.sortdirection = J.sortOrder
            }
            if (J.formatData !== undefined) {
                J.formatdata = J.formatData
            }
            if (J.processData !== undefined) {
                J.processdata = J.processData
            }
            if (J.pageSize !== undefined) {
                J.pagesize = J.pageSize
            }
            if (J.pageNum !== undefined) {
                J.pagenum = J.pageNum
            }
            if (J.updateRow !== undefined) {
                J.updaterow = J.updateRow
            }
            if (J.addRow !== undefined) {
                J.addrow = J.addRow
            }
            if (J.deleteRow !== undefined) {
                J.deleterow = J.deleteRow
            }
            if (J.contentType !== undefined) {
                J.contenttype = J.contentType
            }
            if (J.totalRecords != undefined) {
                J.totalrecords = J.totalRecords
            }
            if (J.loadError != undefined) {
                J.loadError = J.loadError
            }
            if (J.sortComparer != undefined) {
                J.sortcomparer = J.sortComparer
            }
        }
        this._source = J;
        this._options = e || {};
        if (J.beforeLoadComplete != undefined) {
            this._options.beforeLoadComplete = this._source.beforeLoadComplete
        }
        if (J.downloadComplete != undefined) {
            this._options.downloadComplete = this._source.downloadComplete
        }
        if (J.loadComplete != undefined) {
            this._options.loadComplete = this._source.loadComplete
        }
        if (J.autoBind != undefined) {
            this._options.downloadComplete = this._source.autoBind
        }
        if (J.formatData != undefined) {
            this._options.formatData = this._source.formatData
        }
        if (J.loadError != undefined) {
            this._options.loadError = this._source.loadError
        }
        if (J.beforeSend != undefined) {
            this._options.beforeSend = this._source.beforeSend
        }
        if (J.contentType != undefined) {
            this._options.contentType = this._source.contentType
        }
        if (J.async != undefined) {
            this._options.async = this._source.async
        }
        if (J.loadServerData != undefined) {
            this._options.loadServerData = this._source.loadServerData
        }
        if (J.uniqueDataFields != undefined) {
            this._options.uniqueDataFields = this._source.uniqueDataFields
        }
        this.records = new Array();
        this._downloadComplete = new Array();
        this._bindingUpdate = new Array();
        if (J != undefined && J.localdata != null && typeof J.localdata == "function") {
            var I = J.localdata();
            if (I != null) {
                J._localdata = J.localdata;
                var H = this;
                if (J._localdata.subscribe) {
                    H._oldlocaldata = [];
                    J._localdata.subscribe(function(K) {
                        var L = function(M) {
                            if (i.isArray(M)) {
                                return i.makeArray(L(i(M)))
                            }
                            return i.extend(true, {}, M)
                        };
                        if (H.suspendKO == false || H.suspendKO == undefined || H._oldlocaldata.length == 0) {
                            H._oldlocaldata = L(K)
                        }
                    }, J._localdata, "beforeChange");
                    J._localdata.subscribe(function(L) {
                        if (H.suspendKO == false || H.suspendKO == undefined) {
                            var K = "";
                            H._oldrecords = H.records;
                            if (H._oldlocaldata.length == 0) {
                                J.localdata = J._localdata()
                            }
                            if (H._oldlocaldata.length == 0) {
                                K = "change"
                            } else {
                                if (L) {
                                    if (H._oldlocaldata.length == L.length) {
                                        K = "update"
                                    }
                                    if (H._oldlocaldata.length > L.length) {
                                        K = "remove"
                                    }
                                    if (H._oldlocaldata.length < L.length) {
                                        K = "add"
                                    }
                                }
                            }
                            H.dataBind(null, K)
                        }
                    }, J._localdata, "change");
                    H._knockoutdatasource = true
                }
                J.localdata = I
            }
        }
        if (this._options.autoBind == true) {
            this.dataBind()
        }
    };
    i.jqx.dataAdapter.prototype = {
        getrecords: function() {
            return this.records
        },
        beginUpdate: function() {
            this.isUpdating = true
        },
        endUpdate: function(e) {
            this.isUpdating = false;
            if (e != false) {
                if (this._changedrecords && this._changedrecords.length > 0) {
                    this.callBindingUpdate("update");
                    this._changedrecords = []
                } else {
                    this.dataBind(null, "")
                }
            }
        },
        formatDate: function(H, J, I) {
            var e = i.jqx.dataFormat.formatdate(H, J, I);
            return e
        },
        formatNumber: function(H, J, I) {
            var e = i.jqx.dataFormat.formatnumber(H, J, I);
            return e
        },
        dataBind: function(R, aa) {
            if (this.isUpdating == true) {
                return
            }
            var W = this._source;
            if (!W) {
                return
            }
            if (W.generatedfields) {
                W.datafields = null;
                W.generatedfields = null
            }
            i.jqx.dataFormat.datescache = new Array();
            if (W.dataFields != null) {
                W.datafields = W.dataFields
            }
            if (W.recordstartindex == undefined) {
                W.recordstartindex = 0
            }
            if (W.recordendindex == undefined) {
                W.recordendindex = 0
            }
            if (W.loadallrecords == undefined) {
                W.loadallrecords = true
            }
            if (W.root == undefined) {
                W.root = ""
            }
            if (W.record == undefined) {
                W.record = ""
            }
            if (W.sort != undefined) {
                this.sort = W.sort
            }
            if (W.filter != undefined) {
                this.filter = W.filter
            } else {
                this.filter = null
            }
            if (W.sortcolumn != undefined) {
                this.sortcolumn = W.sortcolumn
            }
            if (W.sortdirection != undefined) {
                this.sortdirection = W.sortdirection
            }
            if (W.sortcomparer != undefined) {
                this.sortcomparer = W.sortcomparer
            }
            this.records = new Array();
            var K = this._options || {};
            this.virtualmode = K.virtualmode != undefined ? K.virtualmode : false;
            this.totalrecords = K.totalrecords != undefined ? K.totalrecords : 0;
            this.pageable = K.pageable != undefined ? K.pageable : false;
            this.pagesize = K.pagesize != undefined ? K.pagesize : 0;
            this.pagenum = K.pagenum != undefined ? K.pagenum : 0;
            this.cachedrecords = K.cachedrecords != undefined ? K.cachedrecords : new Array();
            this.originaldata = new Array();
            this.recordids = new Array();
            this.updaterow = K.updaterow != undefined ? K.updaterow : null;
            this.addrow = K.addrow != undefined ? K.addrow : null;
            this.deleterow = K.deleterow != undefined ? K.deleterow : null;
            this.cache = K.cache != undefined ? K.cache : false;
            this.unboundmode = false;
            if (W.formatdata != undefined) {
                K.formatData = W.formatdata
            }
            if (W.data != undefined) {
                if (K.data == undefined) {
                    K.data = {}
                }
                i.extend(K.data, W.data)
            }
            if (W.mapChar != undefined) {
                W.mapchar = W.maxChar
            }
            if (W.mapchar != undefined) {
                this.mapChar = W.mapchar ? W.mapchar : ">"
            } else {
                this.mapChar = K.mapChar ? K.mapChar : ">"
            }
            if (K.unboundmode || W.unboundmode) {
                this.unboundmode = K.unboundmode || W.unboundmode
            }
            if (W.cache != undefined) {
                this.cache = W.cache
            }
            if (this.koSubscriptions) {
                for (var ac = 0; ac < this.koSubscriptions.length; ac++) {
                    this.koSubscriptions[ac].dispose()
                }
            }
            this.koSubscriptions = new Array();
            if (this.pagenum < 0) {
                this.pagenum = 0
            }
            var ah = this;
            var Q = W.datatype;
            if (W.datatype === "csv" || W.datatype === "tab" || W.datatype === "tsv" || W.datatype == "text") {
                Q = "text"
            }
            var N = K.async != undefined ? K.async : true;
            if (W.async != undefined) {
                N = W.async
            }
            switch (Q) {
                case "local":
                case "array":
                case "observablearray":
                case "observableArray":
                default:
                    if (W.localdata == undefined && W.length) {
                        W.localdata = new Array();
                        for (var Z = 0; Z < W.length; Z++) {
                            W.localdata[W.localdata.length] = W[Z];
                            W[Z].uid = Z
                        }
                    }
                    if (W.beforeprocessing && i.isFunction(W.beforeprocessing)) {
                        W.beforeprocessing(W.localdata)
                    }
                    var M = W.localdata.length;
                    this.totalrecords = this.virtualmode ? (W.totalrecords || M) : M;
                    if (this.unboundmode) {
                        this.totalrecords = this.unboundmode ? (W.totalrecords || M) : M;
                        var ad = W.datafields ? W.datafields.length : 0;
                        if (ad > 0) {
                            for (var Z = 0; Z < this.totalrecords; Z++) {
                                var I = {};
                                for (var Y = 0; Y < ad; Y++) {
                                    I[W.datafields[Y].name] = ""
                                }
                                I.uid = Z;
                                W.localdata[W.localdata.length] = I
                            }
                        }
                    }
                    if (this.totalrecords == undefined) {
                        this.totalrecords = 0
                    }
                    var ad = W.datafields ? W.datafields.length : 0;
                    var H = function(ao, aq) {
                        var ap = {};
                        for (var am = 0; am < aq; am++) {
                            var al = W.datafields ? W.datafields[am] : {};
                            var ar = "";
                            if (undefined == al || al == null) {
                                continue
                            }
                            if (al.map) {
                                if (i.isFunction(al.map)) {
                                    ar = al.map(ao)
                                } else {
                                    var aj = al.map.split(ah.mapChar);
                                    if (aj.length > 0) {
                                        var an = ao;
                                        for (var ak = 0; ak < aj.length; ak++) {
                                            if (!an) {
                                                continue
                                            }
                                            an = an[aj[ak]]
                                        }
                                        ar = an
                                    } else {
                                        ar = ao[al.map]
                                    }
                                }
                                if (ar != undefined && ar != null) {
                                    ar = ar.toString()
                                } else {
                                    if (ar == undefined && ar != null) {
                                        ar = ""
                                    }
                                }
                            }
                            var at = false;
                            if (ar == "") {
                                at = true;
                                ar = ao[al.name];
                                if (ar != undefined && ar != null) {
                                    if (W._localdata && ar.subscribe) {
                                        ar = ar()
                                    } else {
                                        if (al.type != "array") {
                                            if (al.type === "date") {
                                                if (ar && ar instanceof Date) {
                                                    ar = ar
                                                }
                                            } else {
                                                ar = ar.toString()
                                            }
                                        }
                                    }
                                }
                            }
                            if (ar == "[object Object]" && al.map && at) {
                                ar = ""
                            }
                            ar = ah.getvaluebytype(ar, al);
                            if (al.displayname != undefined) {
                                ap[al.displayname] = ar
                            } else {
                                ap[al.name] = ar
                            }
                        }
                        return ap
                    };
                    if (W._localdata) {
                        this._changedrecords = [];
                        this.records = new Array();
                        var ag = W._localdata();
                        i.each(ag, function(am, ap) {
                            if (typeof ap === "string") {
                                ah.records.push(ap)
                            } else {
                                var ak = {};
                                var ao = 0;
                                var an = this;
                                i.each(this, function(ay, aD) {
                                    var at = null;
                                    var aE = "string";
                                    var aC = ay;
                                    if (ad > 0) {
                                        var aG = false;
                                        var aB = false;
                                        for (var ax = 0; ax < ad; ax++) {
                                            var aw = W.datafields[ax];
                                            if (aw != undefined && (aw.name == ay)) {
                                                aG = true;
                                                at = aw.map;
                                                aE = aw.type;
                                                aC = aw.name;
                                                break
                                            } else {
                                                if (aw != undefined && aw.map && (aw.map.indexOf(ay) >= 0)) {
                                                    aG = true;
                                                    at = aw.map;
                                                    aE = aw.type;
                                                    aC = aw.name;
                                                    aB = true;
                                                    var aF = an[ay];
                                                    if (at != null) {
                                                        var ar = at.split(ah.mapChar);
                                                        if (ar.length > 0) {
                                                            var az = an;
                                                            for (var au = 0; au < ar.length; au++) {
                                                                az = az[ar[au]]
                                                            }
                                                            aF = az
                                                        } else {
                                                            aF = an[at]
                                                        }
                                                    }
                                                    if (aE != "string") {
                                                        aF = ah.getvaluebytype(aF, {
                                                            type: aE
                                                        })
                                                    }
                                                    ak[aC] = aF;
                                                    if (ak[aC] != undefined) {
                                                        ao += ak[aC].toString().length + ak[aC].toString().substr(0, 1)
                                                    }
                                                }
                                            }
                                        }
                                        if (!aG) {
                                            return true
                                        }
                                        if (aB) {
                                            return true
                                        }
                                    }
                                    var av = i.isFunction(an[ay]);
                                    if (av) {
                                        var aF = an[ay]();
                                        if (aE != "string") {
                                            aF = ah.getvaluebytype(aF, {
                                                type: aE
                                            })
                                        }
                                        ak[ay] = aF;
                                        if (an[ay].subscribe) {
                                            var aA = am;
                                            ah.koSubscriptions[ah.koSubscriptions.length] = an[ay].subscribe(function(aI) {
                                                var aH = aA;
                                                ak[ay] = aI;
                                                var aJ = {
                                                    index: aH,
                                                    oldrecord: ak,
                                                    record: ak
                                                };
                                                ah._changedrecords.push(aJ);
                                                if (ah.isUpdating) {
                                                    return
                                                }
                                                ah.callBindingUpdate("update");
                                                ah._changedrecords = [];
                                                return false
                                            })
                                        }
                                    } else {
                                        var aF = an[ay];
                                        if (at != null) {
                                            var ar = at.split(ah.mapChar);
                                            if (ar.length > 0) {
                                                var az = an;
                                                for (var au = 0; au < ar.length; au++) {
                                                    az = az[ar[au]]
                                                }
                                                aF = az
                                            } else {
                                                aF = an[at]
                                            }
                                        }
                                        if (aE != "string") {
                                            aF = ah.getvaluebytype(aF, {
                                                type: aE
                                            })
                                        }
                                        ak[aC] = aF;
                                        if (ak[aC] != undefined) {
                                            ao += ak[aC].toString().length + ak[aC].toString().substr(0, 1)
                                        }
                                    }
                                });
                                var al = ah.getid(W.id, an, am);
                                ak.uid = al;
                                ah.records.push(ak);
                                ak._koindex = ao;
                                if (ah._oldrecords) {
                                    var aj = ah.records.length - 1;
                                    if (aa == "update") {
                                        if (ah._oldrecords[aj]._koindex != ao) {
                                            var aq = {
                                                index: aj,
                                                oldrecord: ah._oldrecords[aj],
                                                record: ak
                                            };
                                            ah._changedrecords.push(aq)
                                        }
                                    }
                                }
                            }
                        });
                        if (aa == "add") {
                            var M = ah.records.length;
                            for (var Z = 0; Z < M; Z++) {
                                var I = ah.records[Z];
                                var L = false;
                                for (var U = 0; U < ah._oldrecords.length; U++) {
                                    if (ah._oldrecords[U]._koindex === I._koindex) {
                                        L = true;
                                        break
                                    }
                                }
                                if (!L) {
                                    ah._changedrecords.push({
                                        index: Z,
                                        oldrecord: null,
                                        record: I,
                                        position: (Z != 0 ? "last" : "first")
                                    })
                                }
                            }
                        } else {
                            if (aa == "remove") {
                                var M = ah._oldrecords.length;
                                for (var Z = 0; Z < M; Z++) {
                                    var P = ah._oldrecords[Z];
                                    if (!ah.records[Z]) {
                                        ah._changedrecords.push({
                                            index: Z,
                                            oldrecord: P,
                                            record: null
                                        })
                                    } else {
                                        if (ah.records[Z]._koindex != P._koindex) {
                                            ah._changedrecords.push({
                                                index: Z,
                                                oldrecord: P,
                                                record: null
                                            })
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        if (!i.isArray(W.localdata)) {
                            this.records = new Array();
                            var V = 0;
                            var T = new Array();
                            i.each(W.localdata, function(al) {
                                var ak = ah.getid(W.id, this, al);
                                if (ad == 0) {
                                    if (!(typeof this === "string" || this instanceof String)) {
                                        for (var an in this) {
                                            V++;
                                            var ao = i.type(this[an]);
                                            T.push({
                                                name: an,
                                                type: ao
                                            })
                                        }
                                        ad = V;
                                        W.datafields = T;
                                        W.generatedfields = T
                                    }
                                }
                                if (ad > 0) {
                                    var aj = this;
                                    var am = H(aj, ad);
                                    am.uid = ak;
                                    ah.records[ah.records.length] = am
                                } else {
                                    this.uid = ak;
                                    ah.records[ah.records.length] = this
                                }
                            })
                        } else {
                            if (ad == 0) {
                                var V = 0;
                                var T = new Array();
                                i.each(W.localdata, function(al, an) {
                                    var aj = new Object(this);
                                    if (typeof an === "string") {
                                        ah.records = W.localdata;
                                        return false
                                    } else {
                                        var ak = ah.getid(W.id, aj, al);
                                        if (typeof(ak) === "object") {
                                            ak = al
                                        }
                                        aj.uid = ak;
                                        if (al == 0) {
                                            for (var ao in this) {
                                                V++;
                                                var ap = i.type(this[ao]);
                                                T.push({
                                                    name: ao,
                                                    type: ap
                                                })
                                            }
                                            ad = V;
                                            W.datafields = T;
                                            W.generatedfields = T
                                        }
                                        if (ad > 0) {
                                            var am = H(aj, ad);
                                            am.uid = ak;
                                            ah.records[ah.records.length] = am
                                        } else {
                                            ah.records[ah.records.length] = aj
                                        }
                                    }
                                })
                            } else {
                                i.each(W.localdata, function(al) {
                                    var aj = this;
                                    var am = H(aj, ad);
                                    var ak = ah.getid(W.id, am, al);
                                    if (typeof(ak) === "object") {
                                        ak = al
                                    }
                                    var aj = new Object(am);
                                    aj.uid = ak;
                                    ah.records[ah.records.length] = aj
                                })
                            }
                        }
                    }
                    this.originaldata = W.localdata;
                    this.cachedrecords = this.records;
                    this.addForeignValues(W);
                    if (K.uniqueDataFields) {
                        var S = this.getUniqueRecords(this.records, K.uniqueDataFields);
                        this.records = S;
                        this.cachedrecords = S
                    }
                    if (K.beforeLoadComplete) {
                        var ae = K.beforeLoadComplete(ah.records, this.originaldata);
                        if (ae != undefined) {
                            ah.records = ae;
                            ah.cachedrecords = ae
                        }
                    }
                    if (K.autoSort && K.autoSortField) {
                        var O = Object.prototype.toString;
                        Object.prototype.toString = (typeof field == "function") ? field : function() {
                            return this[K.autoSortField]
                        };
                        ah.records.sort(function(ak, aj) {
                            if (ak === undefined) {
                                ak = null
                            }
                            if (aj === undefined) {
                                aj = null
                            }
                            if (ak === null && aj === null) {
                                return 0
                            }
                            if (ak === null && aj !== null) {
                                return 1
                            }
                            if (ak !== null && aj === null) {
                                return -1
                            }
                            ak = ak.toString();
                            aj = aj.toString();
                            if (ak === null && aj === null) {
                                return 0
                            }
                            if (ak === null && aj !== null) {
                                return 1
                            }
                            if (ak !== null && aj === null) {
                                return -1
                            }
                            if (i.jqx.dataFormat.isNumber(ak) && i.jqx.dataFormat.isNumber(aj)) {
                                if (ak < aj) {
                                    return -1
                                }
                                if (ak > aj) {
                                    return 1
                                }
                                return 0
                            } else {
                                if (i.jqx.dataFormat.isDate(ak) && i.jqx.dataFormat.isDate(aj)) {
                                    if (ak < aj) {
                                        return -1
                                    }
                                    if (ak > aj) {
                                        return 1
                                    }
                                    return 0
                                } else {
                                    if (!i.jqx.dataFormat.isNumber(ak) && !i.jqx.dataFormat.isNumber(aj)) {
                                        ak = String(ak).toLowerCase();
                                        aj = String(aj).toLowerCase()
                                    }
                                }
                            }
                            try {
                                if (ak < aj) {
                                    return -1
                                }
                                if (ak > aj) {
                                    return 1
                                }
                            } catch (al) {
                                var am = al
                            }
                            return 0
                        });
                        Object.prototype.toString = O
                    }
                    ah.loadedData = W.localdata;
                    ah.buildHierarchy();
                    if (i.isFunction(K.loadComplete)) {
                        K.loadComplete(W.localdata, ah.records)
                    }
                    break;
                case "json":
                case "jsonp":
                case "xml":
                case "xhtml":
                case "script":
                case "text":
                case "ics":
                    if (W.localdata != null && !W.url) {
                        if (i.isFunction(W.beforeprocessing)) {
                            W.beforeprocessing(W.localdata)
                        }
                        if (W.datatype === "xml") {
                            ah.loadxml(W.localdata, W.localdata, W)
                        } else {
                            if (Q === "text") {
                                ah.loadtext(W.localdata, W)
                            } else {
                                if (Q === "ics") {
                                    ah.loadics(W.localdata, W)
                                } else {
                                    ah.loadjson(W.localdata, W.localdata, W)
                                }
                            }
                        }
                        ah.addForeignValues(W);
                        if (K.uniqueDataFields) {
                            var S = ah.getUniqueRecords(ah.records, K.uniqueDataFields);
                            ah.records = S;
                            ah.cachedrecords = S
                        }
                        if (K.beforeLoadComplete) {
                            var ae = K.beforeLoadComplete(ah.records, this.originaldata);
                            if (ae != undefined) {
                                ah.records = ae;
                                ah.cachedrecords = ae
                            }
                        }
                        ah.loadedData = W.localdata;
                        ah.buildHierarchy.call(ah);
                        if (i.isFunction(K.loadComplete)) {
                            K.loadComplete(W.localdata, ah.records)
                        }
                        ah.callBindingUpdate(aa);
                        return
                    }
                    var af = K.data != undefined ? K.data : {};
                    if (W.processdata) {
                        W.processdata(af)
                    }
                    if (i.isFunction(K.processData)) {
                        K.processData(af)
                    }
                    if (i.isFunction(K.formatData)) {
                        var e = K.formatData(af);
                        if (e != undefined) {
                            af = e
                        }
                    }
                    var ab = "application/x-www-form-urlencoded";
                    if (K.contentType) {
                        ab = K.contentType
                    }
                    var J = "GET";
                    if (W.type) {
                        J = W.type
                    }
                    if (K.type) {
                        J = K.type
                    }
                    var X = Q;
                    if (Q == "ics") {
                        X = "text"
                    }
                    if (W.url && W.url.length > 0) {
                        if (i.isFunction(K.loadServerData)) {
                            ah._requestData(af, W, K)
                        } else {
                            this.xhr = i.jqx.data.ajax({
                                dataType: X,
                                cache: this.cache,
                                type: J,
                                url: W.url,
                                async: N,
                                timeout: W.timeout,
                                contentType: ab,
                                data: af,
                                success: function(am, aj, ap) {
                                    if (i.isFunction(W.beforeprocessing)) {
                                        var ao = W.beforeprocessing(am, aj, ap);
                                        if (ao != undefined) {
                                            am = ao
                                        }
                                    }
                                    if (i.isFunction(K.downloadComplete)) {
                                        var ao = K.downloadComplete(am, aj, ap);
                                        if (ao != undefined) {
                                            am = ao
                                        }
                                    }
                                    if (am == null) {
                                        ah.records = new Array();
                                        ah.cachedrecords = new Array();
                                        ah.originaldata = new Array();
                                        ah.callDownloadComplete();
                                        if (i.isFunction(K.loadComplete)) {
                                            K.loadComplete(new Array())
                                        }
                                        return
                                    }
                                    var ak = am;
                                    if (am.records) {
                                        ak = am.records
                                    }
                                    if (am.totalrecords != undefined) {
                                        W.totalrecords = am.totalrecords
                                    } else {
                                        if (am.totalRecords != undefined) {
                                            W.totalrecords = am.totalRecords
                                        }
                                    }
                                    if (W.datatype === "xml") {
                                        ah.loadxml(null, ak, W)
                                    } else {
                                        if (Q === "text") {
                                            ah.loadtext(ak, W)
                                        } else {
                                            if (Q === "ics") {
                                                ah.loadics(ak, W)
                                            } else {
                                                ah.loadjson(null, ak, W)
                                            }
                                        }
                                    }
                                    ah.addForeignValues(W);
                                    if (K.uniqueDataFields) {
                                        var al = ah.getUniqueRecords(ah.records, K.uniqueDataFields);
                                        ah.records = al;
                                        ah.cachedrecords = al
                                    }
                                    if (K.beforeLoadComplete) {
                                        var an = K.beforeLoadComplete(ah.records, am);
                                        if (an != undefined) {
                                            ah.records = an;
                                            ah.cachedrecords = an
                                        }
                                    }
                                    ah.loadedData = am;
                                    ah.buildHierarchy.call(ah);
                                    ah.callDownloadComplete();
                                    if (i.isFunction(K.loadComplete)) {
                                        K.loadComplete(am, aj, ap, ah.records)
                                    }
                                },
                                error: function(al, aj, ak) {
                                    if (i.isFunction(W.loaderror)) {
                                        W.loaderror(al, aj, ak)
                                    }
                                    if (i.isFunction(K.loadError)) {
                                        K.loadError(al, aj, ak)
                                    }
                                    al = null;
                                    ah.callDownloadComplete()
                                },
                                beforeSend: function(ak, aj) {
                                    if (i.isFunction(K.beforeSend)) {
                                        K.beforeSend(ak, aj)
                                    }
                                    if (i.isFunction(W.beforesend)) {
                                        W.beforesend(ak, aj)
                                    }
                                }
                            })
                        }
                    } else {
                        ah.buildHierarchy(new Array());
                        ah.callDownloadComplete();
                        if (i.isFunction(K.loadComplete)) {
                            if (!ai) {
                                var ai = {}
                            }
                            K.loadComplete(ai)
                        }
                    }
                    break
            }
            this.callBindingUpdate(aa)
        },
        buildHierarchy: function(K) {
            var e = this._source;
            var P = new Array();
            if (!e.datafields) {
                return
            }
            if (e.hierarchy && !e.hierarchy.reservedNames) {
                e.hierarchy.reservedNames = {
                    leaf: "leaf",
                    parent: "parent",
                    expanded: "expanded",
                    checked: "checked",
                    selected: "selected",
                    level: "level",
                    icon: "icon",
                    data: "data"
                }
            } else {
                if (e.hierarchy) {
                    var O = e.hierarchy.reservedNames;
                    if (!O.leaf) {
                        O.leaf = "leaf"
                    }
                    if (!O.parent) {
                        O.parent = "parent"
                    }
                    if (!O.expanded) {
                        O.expanded = "expanded"
                    }
                    if (!O.checked) {
                        O.checked = "checked"
                    }
                    if (!O.selected) {
                        O.selected = "selected"
                    }
                    if (!O.level) {
                        O.level = "level"
                    }
                    if (!O.data) {
                        O.data = "data"
                    }
                }
            }
            if (!e.hierarchy) {
                return
            }
            var N = this;
            var O = e.hierarchy.reservedNames;
            if (e.hierarchy.root) {
                if (e.dataType == "xml") {
                    var P = this.getRecordsHierarchy("uid", "parentuid", "records", null, K);
                    this.hierarchy = P;
                    return P
                } else {
                    this.hierarchy = this.records;
                    var R = e.hierarchy.root;
                    for (var L = 0; L < this.records.length; L++) {
                        var M = this.records[L];
                        if (!M) {
                            continue
                        }
                        var H = function(S) {
                            if (e.hierarchy.record) {
                                S.records = S[R][e.hierarchy.record]
                            } else {
                                var U = R.split(N.mapChar);
                                var T = null;
                                if (U.length > 1) {
                                    var W = S;
                                    for (var V = 0; V < U.length; V++) {
                                        if (W != undefined) {
                                            W = W[U[V]]
                                        }
                                    }
                                    T = W
                                } else {
                                    T = S[R]
                                }
                                S.records = T
                            }
                            if (S.records == null || (S.records && S.records.length == 0)) {
                                S[O.leaf] = true
                            }
                        };
                        H(M);
                        M[O.level] = 0;
                        var I = this.getid(e.id, M, L);
                        M.uid = I;
                        M[O.parent] = null;
                        M[O.data] = M;
                        if (M[O.expanded] === undefined) {
                            M[O.expanded] = false
                        }
                        var Q = function(W, U) {
                            if (!U) {
                                W.records = new Array();
                                return
                            }
                            for (var V = 0; V < U.length; V++) {
                                var S = U[V];
                                if (!S) {
                                    continue
                                }
                                H(S);
                                S[O.level] = W[O.level] + 1;
                                S[O.parent] = W;
                                S[O.data] = S;
                                var T = N.getid(e.id, S, V);
                                if (T == V && e.id == null) {
                                    S.uid = W.uid + "_" + T
                                } else {
                                    S.uid = T
                                }
                                if (S[O.expanded] === undefined) {
                                    S[O.expanded] = false
                                }
                                Q(S, S.records)
                            }
                        };
                        Q(M, M.records)
                    }
                }
                return this.hierarchy
            }
            if (e.hierarchy.keyDataField && e.hierarchy.parentDataField) {
                var P = this.getRecordsHierarchy(e.hierarchy.keyDataField.name, e.hierarchy.parentDataField.name, "records", null, K);
                this.hierarchy = P;
                return P
            }
            if (e.hierarchy.groupingDataFields) {
                var J = new Array();
                for (var L = 0; L < e.hierarchy.groupingDataFields.length; L++) {
                    J.push(e.hierarchy.groupingDataFields[L].name)
                }
                var P = this.getGroupedRecords(J, "records", "label", null, "data", null, "parent", K);
                this.hierarchy = P;
                return P
            }
        },
        addRecord: function(H, e, M, I) {
            var J = this;
            var N = function() {
                return {
                    leaf: "leaf",
                    parent: "parent",
                    expanded: "expanded",
                    checked: "checked",
                    selected: "selected",
                    level: "level",
                    icon: "icon",
                    data: "data"
                }
            };
            if (H != undefined) {
                if (M != undefined) {
                    if (this.hierarchy.length > 0) {
                        var K = function(O) {
                            if (O) {
                                for (var P = 0; P < O.length; P++) {
                                    var Q = O[P];
                                    if (Q.uid == M) {
                                        var R = (J._source && J._source.hierarchy) ? J._source.hierarchy.reservedNames : null;
                                        if (R == null) {
                                            R = N()
                                        }
                                        H[R.parent] = Q;
                                        H[R.level] = Q[R.level] + 1;
                                        if (!Q.records) {
                                            Q.records = new Array();
                                            Q[R.leaf] = false
                                        } else {
                                            Q[R.leaf] = false
                                        }
                                        if (e == "last") {
                                            Q.records.push(H)
                                        } else {
                                            if (typeof e === "number" && isFinite(e)) {
                                                Q.records.splice(e, 0, H)
                                            } else {
                                                Q.records.splice(0, 0, H)
                                            }
                                        }
                                        return true
                                    }
                                    if (Q.records) {
                                        K(Q.records)
                                    }
                                }
                            }
                        };
                        K(this.hierarchy)
                    }
                } else {
                    if (this.hierarchy && this.hierarchy.length >= 0 && (this._source.hierarchy || I)) {
                        var L = (J._source && J._source.hierarchy) ? J._source.hierarchy.reservedNames : null;
                        if (L == null) {
                            L = N()
                        }
                        H[L.level] = 0;
                        if (e == "last") {
                            this.hierarchy.push(H)
                        } else {
                            if (typeof e === "number" && isFinite(e)) {
                                this.hierarchy.splice(e, 0, H)
                            } else {
                                this.hierarchy.splice(0, 0, H)
                            }
                        }
                    } else {
                        if (e == "last") {
                            this.records.push(H)
                        } else {
                            if (typeof e === "number" && isFinite(e)) {
                                this.records.splice(e, 0, H)
                            } else {
                                this.records.splice(0, 0, H)
                            }
                        }
                    }
                    return true
                }
            }
            return false
        },
        deleteRecord: function(H) {
            var J = this;
            if (this.hierarchy.length > 0) {
                var K = function(L) {
                    if (L) {
                        for (var O = 0; O < L.length; O++) {
                            var P = L[O];
                            if (P.uid == H) {
                                L.splice(O, 1);
                                if (J.recordids[H]) {
                                    delete J.recordids[H]
                                }
                                var N = function(T) {
                                    for (var Q = 0; Q < T.length; Q++) {
                                        var S = T[Q].uid;
                                        for (var R = 0; R < J.records.length; R++) {
                                            var U = J.records[R];
                                            if (U.uid == S) {
                                                J.records.splice(R, 1);
                                                break
                                            }
                                        }
                                        if (T[Q].records) {
                                            N(T[Q].records)
                                        }
                                    }
                                };
                                if (P.records) {
                                    N(P.records)
                                }
                                for (var M = 0; M < J.records.length; M++) {
                                    var P = J.records[M];
                                    if (P.uid == H) {
                                        J.records.splice(M, 1);
                                        break
                                    }
                                }
                                return true
                            }
                            if (P.records) {
                                K(P.records)
                            }
                        }
                    }
                };
                K(this.hierarchy)
            } else {
                for (var e = 0; e < this.records.length; e++) {
                    var I = this.records[e];
                    if (I.uid == H) {
                        this.records.splice(e, 1);
                        return true
                    }
                }
            }
            return false
        },
        addForeignValues: function(H) {
            var Q = this;
            var V = H.datafields ? H.datafields.length : 0;
            for (var N = 0; N < V; N++) {
                var L = H.datafields[N];
                if (L != undefined) {
                    if (L.values != undefined) {
                        if (L.value == undefined) {
                            L.value = L.name
                        }
                        if (L.values.value == undefined) {
                            L.values.value = L.value
                        }
                        var T = new Array();
                        var K, M;
                        if (Q.pageable && Q.virtualmode) {
                            K = Q.pagenum * Q.pagesize;
                            M = K + Q.pagesize;
                            if (M > Q.totalrecords) {
                                M = Q.totalrecords
                            }
                        } else {
                            if (Q.virtualmode) {
                                K = H.recordstartindex;
                                M = H.recordendindex;
                                if (M > Q.totalrecords) {
                                    M = Q.totalrecords
                                }
                            } else {
                                K = 0;
                                M = Q.records.length
                            }
                        }
                        for (var O = K; O < M; O++) {
                            var P = Q.records[O];
                            var I = L.name;
                            var U = P[L.value];
                            if (T[U] != undefined) {
                                P[I] = T[U]
                            } else {
                                for (var J = 0; J < L.values.source.length; J++) {
                                    var S = L.values.source[J];
                                    var e = S[L.values.value];
                                    if (e == undefined) {
                                        e = S.uid
                                    }
                                    if (e == U) {
                                        var R = S[L.values.name];
                                        P[I] = R;
                                        T[U] = R;
                                        break
                                    }
                                }
                            }
                        }
                    } else {
                        if (L.value != undefined) {
                            for (var O = 0; O < Q.records.length; O++) {
                                var P = Q.records[O];
                                P[L.name] = P[L.value]
                            }
                        }
                    }
                }
            }
        },
        abort: function() {
            if (this.xhr && this.xhr.readyState != 4) {
                this.xhr.abort();
                me.callDownloadComplete()
            }
        },
        _requestData: function(H, J, e) {
            var I = this;
            var K = function(P) {
                if (P.totalrecords) {
                    J.totalrecords = P.totalrecords;
                    I.totalrecords = P.totalrecords
                }
                if (P.records) {
                    I.records = P.records;
                    I.cachedrecords = P.records
                }
                I.addForeignValues(J);
                if (e.uniqueDataFields) {
                    var N = I.getUniqueRecords(I.records, e.uniqueDataFields);
                    I.records = N;
                    I.cachedrecords = N
                }
                if (e.beforeLoadComplete) {
                    var O = e.beforeLoadComplete(I.records, data);
                    if (O != undefined) {
                        I.records = O;
                        I.cachedrecords = O
                    }
                }
                for (var M = 0; M < I.records.length; M++) {
                    var L = I.records[M];
                    if (undefined == L) {
                        continue
                    }
                    if (undefined == L.uid) {
                        L.uid = I.getid(J.id, L, M)
                    }
                }
                I.buildHierarchy.call(I);
                if (i.isFunction(e.loadComplete)) {
                    e.loadComplete(P)
                }
                I.callDownloadComplete()
            };
            e.loadServerData(H, J, K)
        },
        getUniqueRecords: function(I, L) {
            if (I && L) {
                var e = I.length;
                var Q = L.length;
                var N = new Array();
                var O = new Array();
                for (var P = 0; P < e; P++) {
                    var M = I[P];
                    var J = "";
                    if (M == undefined) {
                        continue
                    }
                    for (var K = 0; K < Q; K++) {
                        var H = L[K];
                        J += M[H] + "_"
                    }
                    if (!O[J]) {
                        N[N.length] = M
                    }
                    O[J] = true
                }
            }
            return N
        },
        getAggregatedData: function(S, P, M, H) {
            var L = M;
            if (!L) {
                L = this.records
            }
            var Q = {};
            var K = new Array();
            var J = L.length;
            if (J == 0) {
                return
            }
            if (J == undefined) {
                return
            }
            for (var O = 0; O < J; O++) {
                var R = L[O];
                for (var N = 0; N < S.length; N++) {
                    var I = S[N];
                    var U = R[I.name];
                    if (I.aggregates) {
                        Q[I.name] = Q[I.name] || {};
                        K[I.name] = K[I.name] || 0;
                        K[I.name]++;
                        var e = function(W) {
                            for (obj in W) {
                                var X = Q[I.name][obj];
                                if (X == null) {
                                    Q[I.name][obj] = 0;
                                    X = 0
                                }
                                if (i.isFunction(W[obj])) {
                                    X = W[obj](X, U, I.name, R, H)
                                }
                                Q[I.name][obj] = X
                            }
                        };
                        var T = parseFloat(U);
                        if (isNaN(T)) {
                            T = false
                        } else {
                            T = true
                        }
                        if (T) {
                            U = parseFloat(U)
                        }
                        if (typeof U === "number" && isFinite(U)) {
                            i.each(I.aggregates, function() {
                                var W = Q[I.name][this];
                                if (W == null) {
                                    W = 0;
                                    if (this == "min") {
                                        W = 9999999999999
                                    }
                                    if (this == "max") {
                                        W = -9999999999999
                                    }
                                }
                                if (this == "sum" || this == "avg" || this == "stdev" || this == "stdevp" || this == "var" || this == "varp") {
                                    W += parseFloat(U)
                                } else {
                                    if (this == "product") {
                                        if (O == 0) {
                                            W = parseFloat(U)
                                        } else {
                                            W *= parseFloat(U)
                                        }
                                    } else {
                                        if (this == "min") {
                                            W = Math.min(W, parseFloat(U))
                                        } else {
                                            if (this == "max") {
                                                W = Math.max(W, parseFloat(U))
                                            } else {
                                                if (this == "count") {
                                                    W++
                                                } else {
                                                    if (typeof(this) == "object") {
                                                        e(this);
                                                        return
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                Q[I.name][this] = W
                            })
                        } else {
                            i.each(I.aggregates, function() {
                                if (this == "min" || this == "max" || this == "count" || this == "product" || this == "sum" || this == "avg" || this == "stdev" || this == "stdevp" || this == "var" || this == "varp") {
                                    if (U === null) {
                                        return true
                                    }
                                    var W = Q[I.name][this];
                                    if (W == null) {
                                        W = 0
                                    }
                                    Q[I.name][this] = W;
                                    return true
                                }
                                if (typeof(this) == "object") {
                                    e(this)
                                }
                            })
                        }
                    }
                }
            }
            for (var N = 0; N < S.length; N++) {
                var I = S[N];
                if (!Q[I.name]) {
                    Q[I.name] = {};
                    i.each(I.aggregates, function(W) {
                        Q[I.name][this] = 0
                    })
                }
                if (Q[I.name]["avg"] != undefined) {
                    var U = Q[I.name]["avg"];
                    var V = K[I.name];
                    if (V === 0 || V == undefined) {
                        Q[I.name]["avg"] = 0
                    } else {
                        Q[I.name]["avg"] = U / V
                    }
                } else {
                    if (Q[I.name]["count"] != undefined) {
                        Q[I.name]["count"] = J
                    }
                }
                if (Q[I.name]["stdev"] || Q[I.name]["stdevp"] || Q[I.name]["var"] || Q[I.name]["varp"]) {
                    i.each(I.aggregates, function(ac) {
                        if (this == "stdev" || this == "var" || this == "varp" || this == "stdevp") {
                            var ad = Q[I.name][this];
                            var ab = J;
                            var W = (ad / J);
                            var Y = 0;
                            for (var Z = 0; Z < J; Z++) {
                                var aa = L[Z];
                                var ae = aa[I.name];
                                Y += (ae - W) * (ae - W)
                            }
                            var X = (this == "stdevp" || this == "varp") ? ab : ab - 1;
                            if (X == 0) {
                                X = 1
                            }
                            if (this == "var" || this == "varp") {
                                Q[I.name][this] = Y / X
                            } else {
                                if (this == "stdevp" || this == "stdev") {
                                    Q[I.name][this] = Math.sqrt(Y / X)
                                }
                            }
                        }
                    })
                }
                if (I.formatStrings) {
                    i.each(I.aggregates, function(X) {
                        var W = I.formatStrings[X];
                        if (W) {
                            if (this == "min" || this == "max" || this == "count" || this == "product" || this == "sum" || this == "avg" || this == "stdev" || this == "stdevp" || this == "var" || this == "varp") {
                                var Y = Q[I.name][this];
                                Q[I.name][this] = i.jqx.dataFormat.formatnumber(Y, W, P)
                            } else {
                                if (typeof this == "object") {
                                    for (obj in this) {
                                        var Y = Q[I.name][obj];
                                        Q[I.name][obj] = i.jqx.dataFormat.formatnumber(Y, W, P)
                                    }
                                }
                            }
                        }
                    })
                }
            }
            return Q
        },
        bindDownloadComplete: function(H, e) {
            this._downloadComplete[this._downloadComplete.length] = {
                id: H,
                func: e
            }
        },
        unbindDownloadComplete: function(H) {
            for (var e = 0; e < this._downloadComplete.length; e++) {
                if (this._downloadComplete[e].id == H) {
                    this._downloadComplete[e].func = null;
                    this._downloadComplete.splice(e, 1);
                    break
                }
            }
        },
        callDownloadComplete: function() {
            for (var e = 0; e < this._downloadComplete.length; e++) {
                var H = this._downloadComplete[e];
                if (H.func != null) {
                    H.func()
                }
            }
        },
        setSource: function(e) {
            this._source = e
        },
        generatekey: function() {
            var e = function() {
                return (((1 + Math.random()) * 65536) | 0).toString(16).substring(1)
            };
            return (e() + e() + "-" + e() + "-" + e() + "-" + e() + "-" + e() + e() + e())
        },
        getGroupedRecords: function(aj, am, W, ae, ak, ab, ad, an, K) {
            var ag = 0;
            var aa = this;
            if (!K) {
                K = 0
            }
            var I = new Array();
            for (var N = 0; N < aj.length; N++) {
                I[N] = aa.generatekey()
            }
            if (!am) {
                am = "items"
            }
            if (!W) {
                W = "group"
            }
            if (!ak) {
                ak = "record"
            }
            if (!ad) {
                ad = "parentItem"
            }
            if (undefined === ab) {
                ab = "value"
            }
            var S = new Array();
            var L = 0;
            var J = new Array();
            var R = aj.length;
            var al = new Array();
            if (!an) {
                var an = this.records
            }
            var P = an.length;
            var af = function(ao) {
                var ap = ao;
                if (ae) {
                    i.each(ae, function() {
                        if (this.name && this.map) {
                            ap[this.map] = ap[this.name]
                        }
                    })
                }
                return ap
            };
            for (var V = 0; V < P; V++) {
                var ai = af(an[V]);
                id = ai[aa.uniqueId];
                var H = new Array();
                var X = 0;
                for (N = 0; N < R; N++) {
                    var Q = aj[N];
                    var ac = ai[Q];
                    if (null == ac) {
                        continue
                    }
                    H[X++] = {
                        value: ac,
                        hash: I[N]
                    }
                }
                if (H.length != R) {
                    break
                }
                var Y = null;
                var T = "";
                var e = -1;
                for (var Z = 0; Z < H.length; Z++) {
                    e++;
                    var ah = H[Z].value;
                    var M = H[Z].hash;
                    T = T + "_" + M + "_" + ah;
                    if (J[T] != undefined && J[T] != null) {
                        Y = J[T];
                        continue
                    }
                    if (Y == null) {
                        Y = {
                            level: 0
                        };
                        Y[ad] = null;
                        Y[W] = ah;
                        Y[ak] = ai;
                        if (ai.expanded !== undefined) {
                            Y.expanded = ai.expanded
                        } else {
                            Y.expanded = false
                        }
                        if (ab) {
                            Y[ab] = ai[ab]
                        }
                        Y[am] = new Array();
                        var O = S.length + K;
                        if (!this._source.id || typeof ai.uid === "number" || isFinite(ai.uid)) {
                            O = "Row" + O
                        }
                        Y.uid = O;
                        S[L++] = Y
                    } else {
                        var U = {
                            level: Y.level + 1
                        };
                        U[ad] = Y;
                        U[W] = ah;
                        U[am] = new Array();
                        U[ak] = ai;
                        if (ai.expanded !== undefined) {
                            U.expanded = ai.expanded
                        } else {
                            U.expanded = false
                        }
                        if (ab) {
                            U[ab] = ai[ab]
                        }
                        U.uid = Y.uid + "_" + Y[am].length;
                        Y[am][Y[am].length] = U;
                        Y = U
                    }
                    J[T] = Y
                }
                if (ai) {
                    ai.leaf = true
                }
                if (Y != null) {
                    if (this._source.id == null) {
                        if (undefined == ai.uid) {
                            ai.uid = Y.uid + "_" + Y[am].length
                        } else {
                            if (ai.uid.toString().indexOf(Y.uid) == -1) {
                                ai.uid = Y.uid + "_" + ai.uid
                            }
                        }
                    }
                    ai[ad] = Y;
                    ai.level = Y.level + 1;
                    Y[am][Y[am].length] = ai
                } else {
                    if (undefined == ai.uid) {
                        ai.uid = this.generatekey()
                    }
                }
            }
            return S
        },
        getRecordsHierarchy: function(L, J, aa, U, H) {
            var e = new Array();
            var I = this.records;
            if (H) {
                I = H
            }
            if (this.records.length == 0) {
                return null
            }
            var Y = aa != null ? aa : "items";
            var R = [];
            var ab = I;
            var O = ab.length;
            var P = (this._source && this._source.hierarchy) ? this._source.hierarchy.reservedNames : null;
            var W = function(ac) {
                var ad = ac;
                if (U) {
                    i.each(U, function() {
                        if (this.name && this.map) {
                            ad[this.map] = ad[this.name]
                        }
                    })
                }
                return ad
            };
            for (var X = 0; X < O; X++) {
                var Z = i.extend({}, ab[X]);
                var T = Z[J];
                var S = Z[L];
                R[S] = {
                    parentid: T,
                    item: Z
                }
            }
            for (var X = 0; X < O; X++) {
                var Z = i.extend({}, ab[X]);
                var T = Z[J];
                var S = Z[L];
                if (R[T] != undefined) {
                    var Z = {
                        parentid: T,
                        item: R[S].item
                    };
                    var Q = R[T].item;
                    if (!Q[Y]) {
                        Q[Y] = []
                    }
                    var M = Q[Y].length;
                    var K = Z.item;
                    if (!P) {
                        if (K.parent == undefined) {
                            K.parent = Q
                        }
                    } else {
                        if (K[P.parent] == undefined) {
                            K[P.parent] = Q
                        }
                    }
                    var N = W(K);
                    Q[Y][M] = N;
                    R[T].item = Q;
                    R[S] = Z
                } else {
                    var K = R[S].item;
                    if (!P) {
                        if (K.parent == undefined) {
                            K.parent = null
                        }
                    } else {
                        if (K[P.parent] == undefined) {
                            K[P.parent] = null
                        }
                    }
                    var N = W(K);
                    if (!P) {
                        N.level = 0
                    } else {
                        N[P.level] = 0
                    }
                    e[e.length] = N
                }
            }
            if (e.length != 0) {
                var V = function(af, ac) {
                    for (var ad = 0; ad < ac.length; ad++) {
                        if (!P) {
                            ac[ad].level = af
                        } else {
                            ac[ad][P.level] = af
                        }
                        var ae = ac[ad][Y];
                        if (ae) {
                            if (ae.length > 0) {
                                V(af + 1, ae)
                            } else {
                                if (!P) {
                                    ac[ad].leaf = true
                                } else {
                                    ac[ad][P.leaf] = true
                                }
                            }
                        } else {
                            if (!P) {
                                ac[ad].leaf = true
                            } else {
                                ac[ad][P.leaf] = true
                            }
                        }
                    }
                };
                V(0, e)
            }
            return e
        },
        bindBindingUpdate: function(H, e) {
            this._bindingUpdate[this._bindingUpdate.length] = {
                id: H,
                func: e
            }
        },
        unbindBindingUpdate: function(H) {
            for (var e = 0; e < this._bindingUpdate.length; e++) {
                if (this._bindingUpdate[e].id == H) {
                    this._bindingUpdate[e].func = null;
                    this._bindingUpdate.splice(e, 1);
                    break
                }
            }
        },
        callBindingUpdate: function(e) {
            for (var I = 0; I < this._bindingUpdate.length; I++) {
                var H = this._bindingUpdate[I];
                if (H.func != null) {
                    H.func(e)
                }
            }
        },
        getid: function(N, H, K) {
            if (N != null && N.name != undefined) {
                if (N.name) {
                    var e = i(H).attr(N.name);
                    if (e != null && e.toString().length > 0) {
                        return e
                    } else {
                        if (N.map) {
                            try {
                                var e = i(H).attr(N.map);
                                if (e != null && e.toString().length > 0) {
                                    return e
                                } else {
                                    if (i(N.map, H).length > 0) {
                                        return i(N.map, H).text()
                                    } else {
                                        if (i(N.name, H).length > 0) {
                                            return i(N.name, H).text()
                                        }
                                    }
                                }
                            } catch (J) {
                                return K
                            }
                        }
                    }
                    return
                }
            }
            if (i(N, H).length > 0) {
                return i(N, H).text()
            }
            if (N) {
                if (N.toString().length > 0) {
                    var e = i(H).attr(N);
                    if (e != null && e.toString().length > 0) {
                        return i.trim(e).split(" ").join("").replace(/([ #;?%&,.+*~\':"!^$[\]()=>|\/@])/g, "")
                    } else {
                        var I = N.split(this.mapChar);
                        if (I.length > 1) {
                            var M = H;
                            for (var L = 0; L < I.length; L++) {
                                if (M != undefined) {
                                    M = M[I[L]]
                                }
                            }
                            if (M != undefined) {
                                return M
                            }
                        } else {
                            if (H[N] != undefined) {
                                return H[N]
                            }
                        }
                    }
                }
            }
            return K
        },
        loadjson: function(ae, af, R) {
            if (typeof(ae) == "string") {
                ae = i.parseJSON(ae)
            }
            if (R.root == undefined) {
                R.root = ""
            }
            if (R.record == undefined) {
                R.record = ""
            }
            var ae = ae || af;
            if (!ae) {
                ae = []
            }
            var ad = this;
            if (R.root != "") {
                var K = R.root.split(ad.mapChar);
                if (K.length > 1) {
                    var aa = ae;
                    for (var Q = 0; Q < K.length; Q++) {
                        if (aa != undefined) {
                            aa = aa[K[Q]]
                        }
                    }
                    ae = aa
                } else {
                    if (ae[R.root] !== undefined) {
                        ae = ae[R.root]
                    } else {
                        if (ae[0] && ae[0][R.root] !== undefined) {
                            ae = ae[0][R.root]
                        } else {
                            i.each(ae, function(ah) {
                                var ag = this;
                                if (this == R.root) {
                                    ae = this;
                                    return false
                                } else {
                                    if (this[R.root] != undefined) {
                                        ae = this[R.root]
                                    }
                                }
                            })
                        }
                    }
                    if (!ae) {
                        var K = R.root.split(ad.mapChar);
                        if (K.length > 0) {
                            var aa = ae;
                            for (var Q = 0; Q < K.length; Q++) {
                                if (aa != undefined) {
                                    aa = aa[K[Q]]
                                }
                            }
                            ae = aa
                        }
                    }
                }
            } else {
                if (!ae.length) {
                    for (obj in ae) {
                        if (i.isArray(ae[obj])) {
                            ae = ae[obj];
                            break
                        }
                    }
                }
            }
            if (ae != null && ae.length == undefined) {
                ae = i.makeArray(ae)
            }
            if (ae == null || ae == undefined || ae == "undefined" || ae.length == undefined) {
                throw new Error("jqxDataAdapter: JSON Parse error! Invalid JSON. Please, check your JSON or your jqxDataAdapter initialization!");
                return
            }
            if (ae.length == 0) {
                this.totalrecords = 0;
                return
            }
            var J = ae.length;
            this.totalrecords = this.virtualmode ? (R.totalrecords || J) : J;
            this.records = new Array();
            this.originaldata = new Array();
            var W = this.records;
            var T = !this.pageable ? R.recordstartindex : this.pagesize * this.pagenum;
            this.recordids = new Array();
            if (R.loadallrecords) {
                T = 0;
                J = this.totalrecords
            }
            var P = 0;
            if (this.virtualmode) {
                T = !this.pageable ? R.recordstartindex : this.pagesize * this.pagenum;
                P = T;
                T = 0;
                J = this.totalrecords
            }
            var Y = R.datafields ? R.datafields.length : 0;
            if (Y == 0) {
                var e = ae[0];
                var ab = new Array();
                for (obj in e) {
                    var H = obj;
                    ab[ab.length] = {
                        name: H
                    }
                }
                R.datafields = ab;
                R.generatedfields = R.datafields;
                Y = ab.length
            }
            var M = T;
            for (var V = T; V < J; V++) {
                var I = ae[V];
                if (I == undefined) {
                    break
                }
                if (R.record && R.record != "") {
                    I = I[R.record];
                    if (I == undefined) {
                        continue
                    }
                }
                var ac = this.getid(R.id, I, V);
                if (typeof(ac) === "object") {
                    ac = V
                }
                if (!this.recordids[ac]) {
                    this.recordids[ac] = I;
                    var L = {};
                    for (var U = 0; U < Y; U++) {
                        var N = R.datafields[U];
                        var S = "";
                        if (undefined == N || N == null) {
                            continue
                        }
                        if (N.map) {
                            if (i.isFunction(N.map)) {
                                S = N.map(I)
                            } else {
                                var K = N.map.split(ad.mapChar);
                                if (K.length > 0) {
                                    var Z = I;
                                    for (var Q = 0; Q < K.length; Q++) {
                                        if (Z != undefined) {
                                            Z = Z[K[Q]]
                                        }
                                    }
                                    S = Z
                                } else {
                                    S = I[N.map]
                                }
                            }
                            if (S != undefined && S != null) {
                                S = this.getvaluebytype(S, N)
                            } else {
                                if (S == undefined && S != null) {
                                    S = ""
                                }
                            }
                        }
                        if (S == "" && !N.map) {
                            S = I[N.name];
                            if (S == undefined && S != null) {
                                S = ""
                            }
                            if (N.value != undefined) {
                                if (S != undefined) {
                                    var X = S[N.value];
                                    if (X != undefined) {
                                        S = X
                                    }
                                }
                            }
                        }
                        S = this.getvaluebytype(S, N);
                        if (N.displayname != undefined) {
                            L[N.displayname] = S
                        } else {
                            L[N.name] = S
                        }
                        if (N.type === "array") {
                            var O = function(aj) {
                                if (!aj) {
                                    return
                                }
                                for (var ap = 0; ap < aj.length; ap++) {
                                    var am = aj[ap];
                                    if (!am) {
                                        continue
                                    }
                                    for (var an = 0; an < Y; an++) {
                                        var ai = R.datafields[an];
                                        var ao = "";
                                        if (undefined == ai || ai == null) {
                                            continue
                                        }
                                        if (ai.map) {
                                            if (i.isFunction(ai.map)) {
                                                ao = ai.map(am)
                                            } else {
                                                var ag = ai.map.split(ad.mapChar);
                                                if (ag.length > 0) {
                                                    var al = am;
                                                    for (var ah = 0; ah < ag.length; ah++) {
                                                        if (al != undefined) {
                                                            al = al[ag[ah]]
                                                        }
                                                    }
                                                    ao = al
                                                } else {
                                                    ao = am[ai.map]
                                                }
                                            }
                                            if (ao != undefined && ao != null) {
                                                ao = this.getvaluebytype(ao, ai)
                                            } else {
                                                if (ao == undefined && ao != null) {
                                                    ao = ""
                                                }
                                            }
                                        }
                                        if (ao == "" && !ai.map) {
                                            ao = am[ai.name];
                                            if (ao == undefined && ao != null) {
                                                ao = ""
                                            }
                                            if (ai.value != undefined) {
                                                if (ao != undefined) {
                                                    var ak = ao[ai.value];
                                                    if (ak != undefined) {
                                                        ao = ak
                                                    }
                                                }
                                            }
                                        }
                                        ao = this.getvaluebytype(ao, ai);
                                        if (ai.displayname != undefined) {
                                            am[ai.displayname] = ao
                                        } else {
                                            am[ai.name] = ao
                                        }
                                        if (ai.type === "array") {
                                            O.call(this, ao)
                                        }
                                    }
                                }
                            };
                            O.call(this, S)
                        }
                    }
                    if (R.recordendindex <= 0 || T < R.recordendindex) {
                        W[P + M] = new Object(L);
                        W[P + M].uid = ac;
                        this.originaldata[P + M] = new Object(W[V]);
                        M++
                    }
                }
            }
            this.records = W;
            this.cachedrecords = this.records
        },
        loadxml: function(K, ai, U) {
            if (typeof(K) == "string") {
                K = ai = i(i.parseXML(K));
                K = null
            }
            if (U.root == undefined) {
                U.root = ""
            }
            if (U.record == undefined) {
                U.record = ""
            }
            var K;
            if (i.jqx.browser.msie && ai) {
                if (ai.xml != undefined) {
                    K = i(U.root + " " + U.record, i.parseXML(ai.xml))
                } else {
                    K = K || i(U.root + " " + U.record, ai)
                }
            } else {
                K = K || i(U.root + " " + U.record, ai)
            }
            if (!K) {
                K = []
            }
            var J = K.length;
            if (K.length == 0) {
                return
            }
            this.totalrecords = this.virtualmode ? (U.totalrecords || J) : J;
            this.records = new Array();
            this.originaldata = new Array();
            var aa = this.records;
            var X = !this.pageable ? U.recordstartindex : this.pagesize * this.pagenum;
            this.recordids = new Array();
            if (U.loadallrecords) {
                X = 0;
                J = this.totalrecords
            }
            var S = 0;
            if (this.virtualmode) {
                X = !this.pageable ? U.recordstartindex : this.pagesize * this.pagenum;
                S = X;
                X = 0;
                J = this.totalrecords
            }
            var ac = U.datafields ? U.datafields.length : 0;
            if (ac == 0) {
                var e = K[0];
                var af = new Array();
                for (obj in e) {
                    var H = obj;
                    af[af.length] = {
                        name: H
                    }
                }
                U.datafields = af;
                U.generatedfields = U.datafields;
                ac = af.length
            }
            var T = X;
            var ae = false;
            for (var Z = X; Z < J; Z++) {
                var I = K[Z];
                if (I == undefined) {
                    break
                }
                var ah = this.getid(U.id, I, Z);
                if (!this.recordids[ah]) {
                    this.recordids[ah] = I;
                    var L = {};
                    var P = false;
                    if (U.hierarchy && U.hierarchy.root) {
                        P = true
                    }
                    for (var Y = 0; Y < ac; Y++) {
                        var Q = U.datafields[Y];
                        var W = "";
                        if (undefined == Q || Q == null) {
                            continue
                        }
                        if (Q.map) {
                            if (i.isFunction(Q.map)) {
                                W = Q.map(I)
                            } else {
                                var M = Q.map.indexOf("[");
                                if (M < 0) {
                                    W = i(Q.map, I);
                                    if (W.length == 1) {
                                        W = W.text()
                                    } else {
                                        ae = true;
                                        var ag = new Array();
                                        for (var ab = 0; ab < W.length; ab++) {
                                            ag.push(i(W[ab]).text())
                                        }
                                        W = ag;
                                        if (P && ag.length > 0) {
                                            W = ag[0]
                                        }
                                    }
                                } else {
                                    var ad = Q.map.substring(0, M - 1);
                                    var O = Q.map.indexOf("]");
                                    var R = Q.map.substring(M + 1, O);
                                    W = i(ad, I).attr(R);
                                    if (W == undefined) {
                                        W = i(I).attr(R)
                                    }
                                    if (W == undefined) {
                                        W = ""
                                    }
                                }
                                if (W == "") {
                                    W = i(I).attr(Q.map);
                                    if (W == undefined) {
                                        W = ""
                                    }
                                }
                            }
                        }
                        if (W == "") {
                            W = i(Q.name, I);
                            if (W.length == 1) {
                                W = W.text()
                            } else {
                                var ag = new Array();
                                for (var ab = 0; ab < W.length; ab++) {
                                    ag.push(i(W[ab]).text())
                                }
                                W = ag;
                                if (P && ag.length > 0) {
                                    W = ag[0]
                                }
                            }
                            if (W == "") {
                                W = i(I).attr(Q.name);
                                if (W == undefined) {
                                    W = ""
                                }
                            }
                            if (W == "") {
                                if (I.nodeName && I.nodeName == Q.name && I.firstChild) {
                                    W = i(I.firstChild).text()
                                }
                            }
                        }
                        var V = W;
                        W = this.getvaluebytype(W, Q);
                        if (Q.displayname != undefined) {
                            L[Q.displayname] = W
                        } else {
                            L[Q.name] = W
                        }
                    }
                    if (U.recordendindex <= 0 || X < U.recordendindex) {
                        aa[S + T] = i.extend({}, L);
                        aa[S + T].uid = ah;
                        this.originaldata[S + T] = i.extend({}, aa[Z]);
                        T++
                    }
                }
            }
            if (U.hierarchy && U.hierarchy.root) {
                for (var Z = X; Z < J; Z++) {
                    var I = K[Z];
                    var N = aa[Z];
                    if (i(I).parent().length > 0) {
                        var ah = this.getid(U.id, i(I).parents(U.hierarchy.record + ":first"));
                        N.parentuid = ah
                    } else {
                        N.parentuid = null
                    }
                }
            }
            this.records = aa;
            this.cachedrecords = this.records
        },
        loadics: function(N, H) {
            if (N == null) {
                return
            }
            var S = H.rowDelimiter || this.rowDelimiter || "\n";
            var R = N.split(S);
            var K = R.length;
            var Q = N.split("\r");
            if (K == 1 && Q.length > 1) {
                R = Q;
                K = R.length
            }
            this.records = new Array();
            this.originaldata = new Array();
            var L = this.records;
            this.recordids = new Array();
            var I = 0;
            var P = function(V) {
                var T = /^(\d{4})(\d{2})(\d{2})(T(\d{2})(\d{2})(\d{2})Z)?$/;
                var U = T.exec(V);
                if (!U) {
                    throw new Error("Invalid UNTIL value: " + V)
                }
                return new Date(Date.UTC(U[1], U[2] - 1, U[3], U[5] || 0, U[6] || 0, U[7] || 0))
            };
            for (var M = 0; M < K; M++) {
                var O = R[M];
                if (O == "BEGIN:VEVENT") {
                    var e = {};
                    continue
                }
                if (O.indexOf("SUMMARY") >= 0) {
                    e.SUMMARY = O.substring(O.indexOf("SUMMARY") + 8);
                    continue
                }
                if (O.indexOf("LOCATION") >= 0) {
                    e.LOCATION = O.substring(O.indexOf("LOCATION") + 9);
                    continue
                }
                if (O.indexOf("DESCRIPTION") >= 0) {
                    e.DESCRIPTION = O.substring(O.indexOf("DESCRIPTION") + 12);
                    continue
                }
                if (O.indexOf("RRULE") >= 0) {
                    e.RRULE = O.substring(O.indexOf("RRULE") + 6);
                    continue
                }
                if (O.indexOf("EXDATE") >= 0) {
                    var J = O.substring(O.indexOf("EXDATE") + 7);
                    e.EXDATE = J;
                    continue
                }
                if (O.indexOf("DTEND") >= 0) {
                    e.DTEND = P(O.substring(O.indexOf("DTEND") + 6));
                    continue
                }
                if (O.indexOf("DTSTART") >= 0) {
                    e.DTSTART = P(O.substring(O.indexOf("DTSTART") + 8));
                    continue
                }
                if (O.indexOf("UID") >= 0) {
                    e.uid = e.UID = O.substring(O.indexOf("UID") + 4);
                    continue
                }
                if (O.indexOf("STATUS") >= 0) {
                    e.STATUS = O.substring(O.indexOf("STATUS") + 7);
                    continue
                }
                if (O == "END:VEVENT") {
                    L.push(e);
                    continue
                }
            }
            this.records = L;
            this.cachedrecords = this.records
        },
        loadtext: function(Y, P) {
            if (Y == null) {
                return
            }
            var e = P.rowDelimiter || this.rowDelimiter || "\n";
            var L = Y.split(e);
            var J = L.length;
            var X = Y.split("\r");
            if (J == 1 && X.length > 1) {
                L = X;
                J = L.length
            }
            this.totalrecords = this.virtualmode ? (P.totalrecords || J) : J;
            this.records = new Array();
            this.originaldata = new Array();
            var U = this.records;
            var R = !this.pageable ? P.recordstartindex : this.pagesize * this.pagenum;
            this.recordids = new Array();
            if (P.loadallrecords) {
                R = 0;
                J = this.totalrecords
            }
            var N = 0;
            if (this.virtualmode) {
                R = !this.pageable ? P.recordstartindex : this.pagesize * this.pagenum;
                N = R;
                R = 0;
                J = this.totalrecords
            }
            var V = P.datafields.length;
            var O = P.columnDelimiter || this.columnDelimiter;
            if (!O) {
                O = (P.datatype === "tab" || P.datatype === "tsv") ? "\t" : ","
            }
            for (var T = R; T < J; T++) {
                var I = L[T];
                var W = null;
                if (!this.recordids[W]) {
                    if (P.id == null) {
                        W = T;
                        this.recordids[W] = I
                    }
                    var K = {};
                    var H = L[T].split(O);
                    for (var S = 0; S < V; S++) {
                        if (S >= H.length) {
                            continue
                        }
                        var M = P.datafields[S];
                        var Q = H[S];
                        if (M.map && i.isFunction(M.map)) {
                            Q = M.map(I)
                        }
                        if (M.type) {
                            Q = this.getvaluebytype(Q, M)
                        }
                        var Z = M.map || M.name || S.toString();
                        K[Z] = Q;
                        if (P.id != null) {
                            if (P.id === M.name) {
                                W = Q;
                                this.recordids[W] = I
                            }
                        }
                    }
                    if (W == null) {
                        W = T
                    }
                    U[N + T] = i.extend({}, K);
                    U[N + T].uid = W;
                    this.originaldata[N + T] = i.extend({}, U[T])
                }
            }
            this.records = U;
            this.cachedrecords = this.records
        },
        getvaluebytype: function(L, H) {
            var J = L;
            if (L == null) {
                return L
            }
            if (i.isArray(L) && H.type != "array") {
                for (var I = 0; I < L.length; I++) {
                    L[I] = this.getvaluebytype(L[I], H)
                }
                return L
            }
            if (H.type == "date") {
                if (L == "NaN") {
                    L = ""
                } else {
                    if (L && L instanceof Date) {
                        return L
                    }
                    var K = new Date(L);
                    if (typeof L == "string") {
                        if (H.format) {
                            var e = i.jqx.dataFormat.parsedate(L, H.format);
                            if (e != null) {
                                K = e
                            }
                        }
                    }
                    if (K.toString() == "NaN" || K.toString() == "Invalid Date") {
                        if (i.jqx.dataFormat) {
                            L = i.jqx.dataFormat.tryparsedate(L)
                        } else {
                            L = K
                        }
                    } else {
                        L = K
                    }
                    if (L == null) {
                        L = J
                    }
                }
            } else {
                if (H.type == "float" || H.type == "number" || H.type == "decimal") {
                    if (L == "NaN") {
                        L = ""
                    } else {
                        var L = parseFloat(L);
                        if (isNaN(L)) {
                            L = J
                        }
                    }
                } else {
                    if (H.type == "int" || H.type == "integer") {
                        var L = parseInt(L);
                        if (isNaN(L)) {
                            L = J
                        }
                    } else {
                        if (H.type == "bool" || H.type == "boolean") {
                            if (L != null) {
                                if (L.toLowerCase != undefined) {
                                    if (L.toLowerCase() == "false") {
                                        L = false
                                    } else {
                                        if (L.toLowerCase() == "true") {
                                            L = true
                                        }
                                    }
                                }
                            }
                            if (L == 1) {
                                L = true
                            } else {
                                if (L == 0 && L !== "") {
                                    L = false
                                } else {
                                    L = ""
                                }
                            }
                        }
                    }
                }
            }
            return L
        }
    };
    i.jqx.dataFormat = {};
    i.extend(i.jqx.dataFormat, {
        regexTrim: /^\s+|\s+$/g,
        regexInfinity: /^[+-]?infinity$/i,
        regexHex: /^0x[a-f0-9]+$/i,
        regexParseFloat: /^[+-]?\d*\.?\d*(e[+-]?\d+)?$/,
        toString: Object.prototype.toString,
        isBoolean: function(e) {
            return typeof e === "boolean"
        },
        isObject: function(e) {
            return (e && (typeof e === "object" || i.isFunction(e))) || false
        },
        isDate: function(e) {
            return e instanceof Date
        },
        arrayIndexOf: function(J, I) {
            if (J.indexOf) {
                return J.indexOf(I)
            }
            for (var e = 0, H = J.length; e < H; e++) {
                if (J[e] === I) {
                    return e
                }
            }
            return -1
        },
        isString: function(e) {
            return typeof e === "string"
        },
        isNumber: function(e) {
            return typeof e === "number" && isFinite(e)
        },
        isNull: function(e) {
            return e === null
        },
        isUndefined: function(e) {
            return typeof e === "undefined"
        },
        isValue: function(e) {
            return (this.isObject(e) || this.isString(e) || this.isNumber(e) || this.isBoolean(e))
        },
        isEmpty: function(e) {
            if (!this.isString(e) && this.isValue(e)) {
                return false
            } else {
                if (!this.isValue(e)) {
                    return true
                }
            }
            e = i.trim(e).replace(/\&nbsp\;/ig, "").replace(/\&#160\;/ig, "");
            return e === ""
        },
        startsWith: function(H, e) {
            return H.indexOf(e) === 0
        },
        endsWith: function(H, e) {
            return H.substr(H.length - e.length) === e
        },
        trim: function(e) {
            return (e + "").replace(this.regexTrim, "")
        },
        isArray: function(e) {
            return this.toString.call(e) === "[object Array]"
        },
        defaultcalendar: function() {
            var e = {
                "/": "/",
                ":": ":",
                firstDay: 0,
                days: {
                    names: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                    namesAbbr: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                    namesShort: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"]
                },
                months: {
                    names: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ""],
                    namesAbbr: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec", ""]
                },
                AM: ["AM", "am", "AM"],
                PM: ["PM", "pm", "PM"],
                eras: [{
                    name: "A.D.",
                    start: null,
                    offset: 0
                }],
                twoDigitYearMax: 2029,
                patterns: {
                    d: "M/d/yyyy",
                    D: "dddd, MMMM dd, yyyy",
                    t: "h:mm tt",
                    T: "h:mm:ss tt",
                    f: "dddd, MMMM dd, yyyy h:mm tt",
                    F: "dddd, MMMM dd, yyyy h:mm:ss tt",
                    M: "MMMM dd",
                    Y: "yyyy MMMM",
                    S: "yyyy\u0027-\u0027MM\u0027-\u0027dd\u0027T\u0027HH\u0027:\u0027mm\u0027:\u0027ss",
                    ISO: "yyyy-MM-dd hh:mm:ss",
                    ISO2: "yyyy-MM-dd HH:mm:ss",
                    d1: "dd.MM.yyyy",
                    d2: "dd-MM-yyyy",
                    d3: "MM-dd-yyyy",
                    zone1: "yyyy-MM-ddTHH:mm:ss-HH:mm",
                    zone2: "yyyy-MM-ddTHH:mm:ss+HH:mm",
                    custom: "yyyy-MM-ddTHH:mm:ss.fff",
                    custom2: "yyyy-MM-dd HH:mm:ss.fff"
                },
                percentsymbol: "%",
                currencysymbol: "$",
                currencysymbolposition: "before",
                decimalseparator: ".",
                thousandsseparator: ","
            };
            return e
        },
        expandFormat: function(K, J) {
            J = J || "F";
            var I, H = K.patterns,
                e = J.length;
            if (e === 1) {
                I = H[J];
                if (!I) {
                    throw "Invalid date format string '" + J + "'."
                }
                J = I
            } else {
                if (e === 2 && J.charAt(0) === "%") {
                    J = J.charAt(1)
                }
            }
            return J
        },
        getEra: function(I, H) {
            if (!H) {
                return 0
            }
            if (typeof I === "string") {
                return 0
            }
            var L, K = I.getTime();
            for (var J = 0, e = H.length; J < e; J++) {
                L = H[J].start;
                if (L === null || K >= L) {
                    return J
                }
            }
            return 0
        },
        toUpper: function(e) {
            return e.split("\u00A0").join(" ").toUpperCase()
        },
        toUpperArray: function(e) {
            var J = [];
            for (var I = 0, H = e.length; I < H; I++) {
                J[I] = this.toUpper(e[I])
            }
            return J
        },
        getEraYear: function(H, J, e, K) {
            var I = H.getFullYear();
            if (!K && J.eras) {
                I -= J.eras[e].offset
            }
            return I
        },
        toUpper: function(e) {
            if (e) {
                return e.toUpperCase()
            }
            return ""
        },
        getDayIndex: function(K, J, H) {
            var e, L = K.days,
                I = K._upperDays;
            if (!I) {
                K._upperDays = I = [this.toUpperArray(L.names), this.toUpperArray(L.namesAbbr), this.toUpperArray(L.namesShort)]
            }
            J = J.toUpperCase();
            if (H) {
                e = this.arrayIndexOf(I[1], J);
                if (e === -1) {
                    e = this.arrayIndexOf(I[2], J)
                }
            } else {
                e = this.arrayIndexOf(I[0], J)
            }
            return e
        },
        getMonthIndex: function(N, M, I) {
            var e = N.months,
                H = N.monthsGenitive || N.months,
                K = N._upperMonths,
                L = N._upperMonthsGen;
            if (!K) {
                N._upperMonths = K = [this.toUpperArray(e.names), this.toUpperArray(e.namesAbbr)];
                N._upperMonthsGen = L = [this.toUpperArray(H.names), this.toUpperArray(H.namesAbbr)]
            }
            M = this.toUpper(M);
            var J = this.arrayIndexOf(I ? K[1] : K[0], M);
            if (J < 0) {
                J = this.arrayIndexOf(I ? L[1] : L[0], M)
            }
            return J
        },
        appendPreOrPostMatch: function(J, e) {
            var I = 0,
                L = false;
            for (var K = 0, H = J.length; K < H; K++) {
                var M = J.charAt(K);
                switch (M) {
                    case "'":
                        if (L) {
                            e.push("'")
                        } else {
                            I++
                        }
                        L = false;
                        break;
                    case "\\":
                        if (L) {
                            e.push("\\")
                        }
                        L = !L;
                        break;
                    default:
                        e.push(M);
                        L = false;
                        break
                }
            }
            return I
        },
        getTokenRegExp: function() {
            return /\/|dddd|ddd|dd|d|MMMM|MMM|MM|M|yyyy|yy|y|hh|h|HH|H|mm|m|ss|s|tt|t|fff|ff|f|zzz|zz|z|gg|g/g
        },
        formatlink: function(e, I) {
            var H = "";
            if (I && I.target) {
                H = "target=" + I.target
            }
            if (H != "") {
                return "<a " + H + ' href="' + e + '">' + e + "</a>"
            }
            return '<a href="' + e + '">' + e + "</a>"
        },
        formatemail: function(e) {
            return '<a href="mailto:' + e + '">' + e + "</a>"
        },
        formatNumber: function(e, I, H) {
            return this.formatnumber(e, I, H)
        },
        formatnumber: function(T, S, O) {
            if (O == undefined || O == null || O == "") {
                O = this.defaultcalendar()
            }
            if (S === "" || S === null) {
                return T
            }
            if (!this.isNumber(T)) {
                T *= 1
            }
            var P;
            if (S.length > 1) {
                P = parseInt(S.slice(1), 10)
            }
            var V = {};
            var Q = S.charAt(0).toUpperCase();
            V.thousandsSeparator = O.thousandsseparator;
            V.decimalSeparator = O.decimalseparator;
            switch (Q) {
                case "D":
                case "d":
                case "F":
                case "f":
                    V.decimalPlaces = P;
                    break;
                case "N":
                case "n":
                    V.decimalPlaces = 0;
                    break;
                case "C":
                case "c":
                    V.decimalPlaces = P;
                    if (O.currencysymbolposition == "before") {
                        V.prefix = O.currencysymbol
                    } else {
                        V.suffix = O.currencysymbol
                    }
                    break;
                case "P":
                case "p":
                    V.suffix = O.percentsymbol;
                    V.decimalPlaces = P;
                    break;
                default:
                    throw "Bad number format specifier: " + Q
            }
            if (this.isNumber(T)) {
                var K = (T < 0);
                var I = T + "";
                var R = (V.decimalSeparator) ? V.decimalSeparator : ".";
                var e;
                if (this.isNumber(V.decimalPlaces)) {
                    var L = V.decimalPlaces;
                    var N = Math.pow(10, L);
                    I = (T * N).toFixed(0) / N + "";
                    e = I.lastIndexOf(".");
                    if (L > 0) {
                        if (e < 0) {
                            I += R;
                            e = I.length - 1
                        } else {
                            if (R !== ".") {
                                I = I.replace(".", R)
                            }
                        }
                        while ((I.length - 1 - e) < L) {
                            I += "0"
                        }
                    }
                } else {
                    var I = T + "";
                    e = I.lastIndexOf(".");
                    if (e > 0 && L == undefined) {
                        if (R !== ".") {
                            I = I.replace(".", R)
                        }
                    }
                }
                if (V.thousandsSeparator) {
                    var U = V.thousandsSeparator;
                    e = I.lastIndexOf(R);
                    e = (e > -1) ? e : I.length;
                    var J = I.substring(e);
                    var H = -1;
                    for (var M = e; M > 0; M--) {
                        H++;
                        if ((H % 3 === 0) && (M !== e) && (!K || (M > 1))) {
                            J = U + J
                        }
                        J = I.charAt(M - 1) + J
                    }
                    I = J
                }
                I = (V.prefix) ? V.prefix + I : I;
                I = (V.suffix) ? I + V.suffix : I;
                return I
            } else {
                return T
            }
        },
        tryparsedate: function(ai, aj) {
            if (aj == undefined || aj == null) {
                aj = this.defaultcalendar()
            }
            var O = this;
            if (ai == "") {
                return null
            }
            if (ai != null && !ai.substring) {
                ai = ai.toString()
            }
            if (ai != null && ai.substring(0, 6) == "/Date(") {
                var ar = /^\/Date\((-?\d+)(\+|-)?(\d+)?\)\/$/;
                var ap = new Date(+ai.replace(/\/Date\((\d+)\)\//, "$1"));
                if (ap == "Invalid Date") {
                    var al = ai.match(/^\/Date\((\d+)([-+]\d\d)(\d\d)\)\/$/);
                    var ap = null;
                    if (al) {
                        ap = new Date(1 * al[1] + 3600000 * al[2] + 60000 * al[3])
                    }
                }
                if (ap == null || ap == "Invalid Date" || isNaN(ap)) {
                    var P = ar.exec(ai);
                    if (P) {
                        var R = new Date(parseInt(P[1]));
                        if (P[2]) {
                            var X = parseInt(P[3]);
                            if (P[2] === "-") {
                                X = -X
                            }
                            var T = R.getUTCMinutes();
                            R.setUTCMinutes(T - X)
                        }
                        if (!isNaN(R.valueOf())) {
                            return R
                        }
                    }
                }
                return ap
            }
            patterns = aj.patterns;
            for (prop in patterns) {
                ap = O.parsedate(ai, patterns[prop], aj);
                if (ap) {
                    if (prop == "ISO") {
                        var aa = O.parsedate(ai, patterns.ISO2, aj);
                        if (aa) {
                            return aa
                        }
                    }
                    return ap
                }
            }
            if (ai != null) {
                var aa = null;
                var L = [":", "/", "-"];
                var an = true;
                for (var N = 0; N < L.length; N++) {
                    if (ai.indexOf(L[N]) != -1) {
                        an = false
                    }
                }
                if (an) {
                    var at = new Number(ai);
                    if (!isNaN(at)) {
                        return new Date(at)
                    }
                }
            }
            if (i.type(ai) === "string") {
                var ae = O;
                ai = ae.trim(ai);
                var ak = [":", "/", "-", " ", ","];
                var M = function(ax, av, aw) {
                    return aw.replace(new RegExp(ax, "g"), av)
                };
                ai = M(", ", ",", ai);
                var I = "";
                var W = ai;
                if (ai.indexOf(":") >= 0) {
                    I = ai.substring(ai.indexOf(":") - 2);
                    I = ae.trim(I);
                    W = ai.substring(0, ai.indexOf(":") - 2)
                } else {
                    if (ai.toUpperCase().indexOf("AM") >= 0) {
                        I = ai.substring(ai.toUpperCase().indexOf("AM") - 2);
                        I = ae.trim(I);
                        W = ai.substring(0, ai.toUpperCase().indexOf("AM") - 2)
                    } else {
                        if (ai.toUpperCase().indexOf("PM") >= 0) {
                            I = ai.substring(ai.toUpperCase().indexOf("PM") - 2);
                            I = ae.trim(I);
                            W = ai.substring(0, ai.toUpperCase().indexOf("PM") - 2)
                        }
                    }
                }
                var e = new Date();
                var ag = false;
                if (W) {
                    for (var ao = 0; ao < ak.length; ao++) {
                        if (W.indexOf(ak[ao]) >= 0) {
                            L = W.split(ak[ao]);
                            break
                        }
                    }
                    var H = new Array();
                    var U = new Array();
                    var ac = new Array();
                    var Q = null;
                    var au = null;
                    for (var ao = 0; ao < L.length; ao++) {
                        var N = L[ao];
                        var ab = ae.parsedate(N, "d", aj) || ae.parsedate(N, "dd", aj) || ae.parsedate(N, "ddd", aj) || ae.parsedate(N, "dddd", aj);
                        if (ab) {
                            if (N.length <= 2) {
                                Q = ao;
                                H.push(ab.getDate());
                                break
                            }
                        }
                    }
                    for (var ao = 0; ao < L.length; ao++) {
                        var N = L[ao];
                        var S = ae.parsedate(N, "M", aj) || ae.parsedate(N, "MM", aj) || ae.parsedate(N, "MMM", aj) || ae.parsedate(N, "MMMM", aj);
                        if (S) {
                            if (Q != undefined && Q == ao) {
                                continue
                            }
                            U.push(S.getMonth());
                            if (N.length > 2) {
                                au = ao;
                                break
                            }
                        }
                    }
                    for (var ao = 0; ao < L.length; ao++) {
                        var N = L[ao];
                        var ad = ae.parsedate(N, "yyyy", aj);
                        if (ad) {
                            if (Q != undefined && Q == ao) {
                                continue
                            }
                            if (au != undefined && au == ao) {
                                continue
                            }
                            ac.push(ad.getFullYear())
                        }
                    }
                    var am = new Array();
                    for (var aq = 0; aq < H.length; aq++) {
                        for (var al = 0; al < U.length; al++) {
                            for (var ah = 0; ah < ac.length; ah++) {
                                var R = new Date(ac[ah], U[al], H[aq]);
                                if (ac[ah] < 1970) {
                                    R.setFullYear(ac[ah])
                                }
                                if (R.getTime() != NaN) {
                                    am.push(R)
                                }
                            }
                        }
                    }
                    if (am.length > 0) {
                        e = am[0];
                        ag = true
                    }
                }
                if (I) {
                    var af = I.indexOf(":") >= 0 ? I.split(":") : I;
                    var K = ae.parsedate(I, "h:mm tt", aj) || ae.parsedate(I, "h:mm:ss tt", aj) || ae.parsedate(I, "HH:mm:ss.fff", aj) || ae.parsedate(I, "HH:mm:ss.ff", aj) || ae.parsedate(I, "HH:mm:ss.tttt", aj) || ae.parsedate(I, "HH:mm:ss", aj) || ae.parsedate(I, "HH:mm", aj) || ae.parsedate(I, "HH", aj);
                    var V = 0,
                        J = 0,
                        Y = 0,
                        Z = 0;
                    if (K && K.getTime() != NaN) {
                        V = K.getHours();
                        J = K.getMinutes();
                        Y = K.getSeconds();
                        Z = K.getMilliseconds()
                    } else {
                        if (af.length == 1) {
                            V = parseInt(af[0])
                        }
                        if (af.length == 2) {
                            V = parseInt(af[0]);
                            J = parseInt(af[1])
                        }
                        if (af.length == 3) {
                            V = parseInt(af[0]);
                            J = parseInt(af[1]);
                            if (af[2].indexOf(".") >= 0) {
                                Y = parseInt(af[2].toString().split(".")[0]);
                                Z = parseInt(af[2].toString().split(".")[1])
                            } else {
                                Y = parseInt(af[2])
                            }
                        }
                        if (af.length == 4) {
                            V = parseInt(af[0]);
                            J = parseInt(af[1]);
                            Y = parseInt(af[2]);
                            Z = parseInt(af[3])
                        }
                    }
                    if (e && !isNaN(V) && !isNaN(J) && !isNaN(Y) && !isNaN(Z)) {
                        e.setHours(V, J, Y, Z);
                        ag = true
                    }
                }
                if (ag) {
                    return e
                }
            }
            return null
        },
        getparseregexp: function(e, R) {
            var T = e._parseRegExp;
            if (!T) {
                e._parseRegExp = T = {}
            } else {
                var K = T[R];
                if (K) {
                    return K
                }
            }
            var Q = this.expandFormat(e, R).replace(/([\^\$\.\*\+\?\|\[\]\(\)\{\}])/g, "\\\\$1"),
                O = ["^"],
                H = [],
                N = 0,
                J = 0,
                W = this.getTokenRegExp(),
                L;
            while ((L = W.exec(Q)) !== null) {
                var V = Q.slice(N, L.index);
                N = W.lastIndex;
                J += this.appendPreOrPostMatch(V, O);
                if (J % 2) {
                    O.push(L[0]);
                    continue
                }
                var I = L[0],
                    M = I.length,
                    S;
                switch (I) {
                    case "dddd":
                    case "ddd":
                    case "MMMM":
                    case "MMM":
                    case "gg":
                    case "g":
                        S = "(\\D+)";
                        break;
                    case "tt":
                    case "t":
                        S = "(\\D*)";
                        break;
                    case "yyyy":
                    case "fff":
                    case "ff":
                    case "f":
                        S = "(\\d{" + M + "})";
                        break;
                    case "dd":
                    case "d":
                    case "MM":
                    case "M":
                    case "yy":
                    case "y":
                    case "HH":
                    case "H":
                    case "hh":
                    case "h":
                    case "mm":
                    case "m":
                    case "ss":
                    case "s":
                        S = "(\\d\\d?)";
                        break;
                    case "zzz":
                        S = "([+-]?\\d\\d?:\\d{2})";
                        break;
                    case "zz":
                    case "z":
                        S = "([+-]?\\d\\d?)";
                        break;
                    case "/":
                        S = "(\\" + e["/"] + ")";
                        break;
                    default:
                        throw "Invalid date format pattern '" + I + "'.";
                        break
                }
                if (S) {
                    O.push(S)
                }
                H.push(L[0])
            }
            this.appendPreOrPostMatch(Q.slice(N), O);
            O.push("$");
            var U = O.join("").replace(/\s+/g, "\\s+"),
                P = {
                    regExp: U,
                    groups: H
                };
            return T[R] = P
        },
        outOfRange: function(I, e, H) {
            return I < e || I > H
        },
        expandYear: function(L, J) {
            var H = new Date(),
                e = this.getEra(H);
            if (J < 100) {
                var I = L.twoDigitYearMax;
                I = typeof I === "string" ? new Date().getFullYear() % 100 + parseInt(I, 10) : I;
                var K = this.getEraYear(H, L, e);
                J += K - (K % 100);
                if (J > I) {
                    J -= 100
                }
            }
            return J
        },
        parsedate: function(ab, ai, W) {
            if (W == undefined || W == null) {
                W = this.defaultcalendar()
            }
            ab = this.trim(ab);
            var T = W,
                an = this.getparseregexp(T, ai),
                N = new RegExp(an.regExp).exec(ab);
            if (N === null) {
                return null
            }
            var aj = an.groups,
                Z = null,
                R = null,
                am = null,
                al = null,
                S = null,
                L = 0,
                ae, ad = 0,
                ak = 0,
                e = 0,
                I = null,
                U = false;
            for (var af = 0, ah = aj.length; af < ah; af++) {
                var H = N[af + 1];
                if (H) {
                    var aa = aj[af],
                        K = aa.length,
                        M = parseInt(H, 10);
                    switch (aa) {
                        case "dd":
                        case "d":
                            al = M;
                            if (this.outOfRange(al, 1, 31)) {
                                return null
                            }
                            break;
                        case "MMM":
                        case "MMMM":
                            am = this.getMonthIndex(T, H, K === 3);
                            if (this.outOfRange(am, 0, 11)) {
                                return null
                            }
                            break;
                        case "M":
                        case "MM":
                            am = M - 1;
                            if (this.outOfRange(am, 0, 11)) {
                                return null
                            }
                            break;
                        case "y":
                        case "yy":
                        case "yyyy":
                            R = K < 4 ? this.expandYear(T, M) : M;
                            if (this.outOfRange(R, 0, 9999)) {
                                return null
                            }
                            break;
                        case "h":
                        case "hh":
                            L = M;
                            if (L === 12) {
                                L = 0
                            }
                            if (this.outOfRange(L, 0, 11)) {
                                return null
                            }
                            break;
                        case "H":
                        case "HH":
                            L = M;
                            if (this.outOfRange(L, 0, 23)) {
                                return null
                            }
                            break;
                        case "m":
                        case "mm":
                            ad = M;
                            if (this.outOfRange(ad, 0, 59)) {
                                return null
                            }
                            break;
                        case "s":
                        case "ss":
                            ak = M;
                            if (this.outOfRange(ak, 0, 59)) {
                                return null
                            }
                            break;
                        case "tt":
                        case "t":
                            U = T.PM && (H === T.PM[0] || H === T.PM[1] || H === T.PM[2]);
                            if (!U && (!T.AM || (H !== T.AM[0] && H !== T.AM[1] && H !== T.AM[2]))) {
                                return null
                            }
                            break;
                        case "f":
                        case "ff":
                        case "fff":
                            e = M * Math.pow(10, 3 - K);
                            if (this.outOfRange(e, 0, 999)) {
                                return null
                            }
                            break;
                        case "ddd":
                        case "dddd":
                            S = this.getDayIndex(T, H, K === 3);
                            if (this.outOfRange(S, 0, 6)) {
                                return null
                            }
                            break;
                        case "zzz":
                            var J = H.split(/:/);
                            if (J.length !== 2) {
                                return null
                            }
                            ae = parseInt(J[0], 10);
                            if (this.outOfRange(ae, -12, 13)) {
                                return null
                            }
                            var P = parseInt(J[1], 10);
                            if (this.outOfRange(P, 0, 59)) {
                                return null
                            }
                            I = (ae * 60) + (this.startsWith(H, "-") ? -P : P);
                            break;
                        case "z":
                        case "zz":
                            ae = M;
                            if (this.outOfRange(ae, -12, 13)) {
                                return null
                            }
                            I = ae * 60;
                            break;
                        case "g":
                        case "gg":
                            var V = H;
                            if (!V || !T.eras) {
                                return null
                            }
                            V = trim(V.toLowerCase());
                            for (var ag = 0, ac = T.eras.length; ag < ac; ag++) {
                                if (V === T.eras[ag].name.toLowerCase()) {
                                    Z = ag;
                                    break
                                }
                            }
                            if (Z === null) {
                                return null
                            }
                            break
                    }
                }
            }
            var Q = new Date(),
                Y, O = T.convert;
            Y = Q.getFullYear();
            if (R === null) {
                R = Y
            } else {
                if (T.eras) {
                    R += T.eras[(Z || 0)].offset
                }
            }
            if (am === null) {
                am = 0
            }
            if (al === null) {
                al = 1
            }
            if (O) {
                Q = O.toGregorian(R, am, al);
                if (Q === null) {
                    return null
                }
            } else {
                Q.setFullYear(R, am, al);
                if (Q.getDate() !== al) {
                    return null
                }
                if (S !== null && Q.getDay() !== S) {
                    return null
                }
            }
            if (U && L < 12) {
                L += 12
            }
            Q.setHours(L, ad, ak, e);
            if (I !== null) {
                var X = Q.getMinutes() - (I + Q.getTimezoneOffset());
                Q.setHours(Q.getHours() + parseInt(X / 60, 10), X % 60)
            }
            return Q
        },
        cleardatescache: function() {
            this.datescache = new Array()
        },
        formatDate: function(e, I, H) {
            return this.formatdate(e, I, H)
        },
        formatdate: function(Z, ad, U) {
            if (U == undefined || U == null) {
                U = this.defaultcalendar()
            }
            if (typeof Z === "string") {
                return Z
            }
            var J = Z.toString() + "_" + ad;
            if (this.datescache && this.datescache[J]) {
                if (ad.indexOf("f") == -1) {
                    return this.datescache[J]
                }
            }
            if (!ad || !ad.length || ad === "i") {
                var af;
                af = this.formatDate(Z, U.patterns.F, U);
                return af
            }
            var aa = U.eras,
                H = ad === "s";
            ad = this.expandFormat(U, ad);
            af = [];
            var M, ab = ["0", "00", "000"],
                Q, R, e = /([^d]|^)(d|dd)([^d]|$)/g,
                ae = 0,
                W = this.getTokenRegExp(),
                I;

            function O(ag, aj) {
                var ai, ah = ag + "";
                if (aj > 1 && ah.length < aj) {
                    ai = (ab[aj - 2] + ah);
                    return ai.substr(ai.length - aj, aj)
                } else {
                    ai = ah
                }
                return ai
            }

            function ac() {
                if (Q || R) {
                    return Q
                }
                Q = e.test(ad);
                R = true;
                return Q
            }

            function K(ah, ag) {
                if (I) {
                    return I[ag]
                }
                if (ah.getMonth != undefined) {
                    switch (ag) {
                        case 0:
                            return ah.getFullYear();
                        case 1:
                            return ah.getMonth();
                        case 2:
                            return ah.getDate()
                    }
                }
            }
            for (;;) {
                var N = W.lastIndex,
                    V = W.exec(ad);
                var S = ad.slice(N, V ? V.index : ad.length);
                ae += this.appendPreOrPostMatch(S, af);
                if (!V) {
                    break
                }
                if (ae % 2) {
                    af.push(V[0]);
                    continue
                }
                var X = V[0],
                    L = X.length;
                switch (X) {
                    case "ddd":
                    case "dddd":
                        var T = (L === 3) ? U.days.namesAbbr : U.days.names;
                        af.push(T[Z.getDay()]);
                        break;
                    case "d":
                    case "dd":
                        Q = true;
                        af.push(O(K(Z, 2), L));
                        break;
                    case "MMM":
                    case "MMMM":
                        var Y = K(Z, 1);
                        af.push(U.months[L === 3 ? "namesAbbr" : "names"][Y]);
                        break;
                    case "M":
                    case "MM":
                        af.push(O(K(Z, 1) + 1, L));
                        break;
                    case "y":
                    case "yy":
                    case "yyyy":
                        Y = this.getEraYear(Z, U, this.getEra(Z, aa), H);
                        if (L < 4) {
                            Y = Y % 100
                        }
                        af.push(O(Y, L));
                        break;
                    case "h":
                    case "hh":
                        M = Z.getHours() % 12;
                        if (M === 0) {
                            M = 12
                        }
                        af.push(O(M, L));
                        break;
                    case "H":
                    case "HH":
                        af.push(O(Z.getHours(), L));
                        break;
                    case "m":
                    case "mm":
                        af.push(O(Z.getMinutes(), L));
                        break;
                    case "s":
                    case "ss":
                        af.push(O(Z.getSeconds(), L));
                        break;
                    case "t":
                    case "tt":
                        Y = Z.getHours() < 12 ? (U.AM ? U.AM[0] : " ") : (U.PM ? U.PM[0] : " ");
                        af.push(L === 1 ? Y.charAt(0) : Y);
                        break;
                    case "f":
                    case "ff":
                    case "fff":
                        af.push(O(Z.getMilliseconds(), 3).substr(0, L));
                        break;
                    case "z":
                    case "zz":
                        M = Z.getTimezoneOffset() / 60;
                        af.push((M <= 0 ? "+" : "-") + O(Math.floor(Math.abs(M)), L));
                        break;
                    case "zzz":
                        M = Z.getTimezoneOffset() / 60;
                        af.push((M <= 0 ? "+" : "-") + O(Math.floor(Math.abs(M)), 2) + ":" + O(Math.abs(Z.getTimezoneOffset() % 60), 2));
                        break;
                    case "g":
                    case "gg":
                        if (U.eras) {
                            af.push(U.eras[this.getEra(Z, aa)].name)
                        }
                        break;
                    case "/":
                        af.push(U["/"]);
                        break;
                    default:
                        throw "Invalid date format pattern '" + X + "'.";
                        break
                }
            }
            var P = af.join("");
            if (!this.datescache) {
                this.datescache = new Array()
            }
            this.datescache[J] = P;
            return P
        }
    });
    i.jqx.data = {};
    var l, E, p = /#.*$/,
        a = /^(.*?):[ \t]*([^\r\n]*)\r?$/mg,
        f = /^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/,
        j = /^(?:GET|HEAD)$/,
        o = /^\/\//,
        k = /\?/,
        b = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
        d = /([?&])_=[^&]*/,
        h = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/,
        t = /\s+/,
        F = i.fn.load,
        G = {},
        C = {},
        q = ["*/"] + ["*"];
    try {
        E = location.href
    } catch (A) {
        E = document.createElement("a");
        E.href = "";
        E = E.href
    }
    l = h.exec(E.toLowerCase()) || [];

    function r(e) {
        return function(K, M) {
            if (typeof K !== "string") {
                M = K;
                K = "*"
            }
            var H, N, O, J = K.toLowerCase().split(t),
                I = 0,
                L = J.length;
            if (i.isFunction(M)) {
                for (; I < L; I++) {
                    H = J[I];
                    O = /^\+/.test(H);
                    if (O) {
                        H = H.substr(1) || "*"
                    }
                    N = e[H] = e[H] || [];
                    N[O ? "unshift" : "push"](M)
                }
            }
        }
    }

    function v(H, Q, L, O, N, J) {
        N = N || Q.dataTypes[0];
        J = J || {};
        J[N] = true;
        var P, M = H[N],
            I = 0,
            e = M ? M.length : 0,
            K = (H === G);
        for (; I < e && (K || !P); I++) {
            P = M[I](Q, L, O);
            if (typeof P === "string") {
                if (!K || J[P]) {
                    P = undefined
                } else {
                    Q.dataTypes.unshift(P);
                    P = v(H, Q, L, O, P, J)
                }
            }
        }
        if ((K || !P) && !J["*"]) {
            P = v(H, Q, L, O, "*", J)
        }
        return P
    }

    function u(I, J) {
        var H, e, K = i.jqx.data.ajaxSettings.flatOptions || {};
        for (H in J) {
            if (J[H] !== undefined) {
                (K[H] ? I : (e || (e = {})))[H] = J[H]
            }
        }
        if (e) {
            i.extend(true, I, e)
        }
    }
    i.extend(i.jqx.data, {
        ajaxSetup: function(H, e) {
            if (e) {
                u(H, i.jqx.data.ajaxSettings)
            } else {
                e = H;
                H = i.jqx.data.ajaxSettings
            }
            u(H, e);
            return H
        },
        ajaxSettings: {
            url: E,
            isLocal: f.test(l[1]),
            global: true,
            type: "GET",
            contentType: "application/x-www-form-urlencoded; charset=UTF-8",
            processData: true,
            async: true,
            accepts: {
                xml: "application/xml, text/xml",
                html: "text/html",
                text: "text/plain",
                json: "application/json, text/javascript",
                "*": q
            },
            contents: {
                xml: /xml/,
                html: /html/,
                json: /json/
            },
            responseFields: {
                xml: "responseXML",
                text: "responseText"
            },
            converters: {
                "* text": window.String,
                "text html": true,
                "text json": i.parseJSON,
                "text xml": i.parseXML
            },
            flatOptions: {
                context: true,
                url: true
            }
        },
        ajaxPrefilter: r(G),
        ajaxTransport: r(C),
        ajax: function(M, J) {
            if (typeof M === "object") {
                J = M;
                M = undefined
            }
            J = J || {};
            var P, ad, K, Y, R, V, I, X, Q = i.jqx.data.ajaxSetup({}, J),
                af = Q.context || Q,
                T = af !== Q && (af.nodeType || af instanceof i) ? i(af) : i.event,
                ae = i.Deferred(),
                aa = i.Callbacks("once memory"),
                N = Q.statusCode || {},
                U = {},
                ab = {},
                L = 0,
                O = "canceled",
                W = {
                    readyState: 0,
                    setRequestHeader: function(ag, ah) {
                        if (!L) {
                            var e = ag.toLowerCase();
                            ag = ab[e] = ab[e] || ag;
                            U[ag] = ah
                        }
                        return this
                    },
                    getAllResponseHeaders: function() {
                        return L === 2 ? ad : null
                    },
                    getResponseHeader: function(ag) {
                        var e;
                        if (L === 2) {
                            if (!K) {
                                K = {};
                                while ((e = a.exec(ad))) {
                                    K[e[1].toLowerCase()] = e[2]
                                }
                            }
                            e = K[ag.toLowerCase()]
                        }
                        return e === undefined ? null : e
                    },
                    overrideMimeType: function(e) {
                        if (!L) {
                            Q.mimeType = e
                        }
                        return this
                    },
                    abort: function(e) {
                        e = e || O;
                        if (Y) {
                            Y.abort(e)
                        }
                        S(0, e);
                        return this
                    }
                };

            function S(ak, ag, al, ai) {
                var e, ao, am, aj, an, ah = ag;
                if (L === 2) {
                    return
                }
                L = 2;
                if (R) {
                    clearTimeout(R)
                }
                Y = undefined;
                ad = ai || "";
                W.readyState = ak > 0 ? 4 : 0;
                if (al) {
                    aj = B(Q, W, al)
                }
                if (ak >= 200 && ak < 300 || ak === 304) {
                    if (Q.ifModified) {
                        an = W.getResponseHeader("Last-Modified");
                        if (an) {
                            i.lastModified[P] = an
                        }
                        an = W.getResponseHeader("Etag");
                        if (an) {
                            i.etag[P] = an
                        }
                    }
                    if (ak === 304) {
                        ah = "notmodified";
                        e = true
                    } else {
                        e = c(Q, aj);
                        ah = e.state;
                        ao = e.data;
                        am = e.error;
                        e = !am
                    }
                } else {
                    am = ah;
                    if (!ah || ak) {
                        ah = "error";
                        if (ak < 0) {
                            ak = 0
                        }
                    }
                }
                W.status = ak;
                W.statusText = (ag || ah) + "";
                if (e) {
                    ae.resolveWith(af, [ao, ah, W])
                } else {
                    ae.rejectWith(af, [W, ah, am])
                }
                W.statusCode(N);
                N = undefined;
                if (I) {
                    T.trigger("ajax" + (e ? "Success" : "Error"), [W, Q, e ? ao : am])
                }
                aa.fireWith(af, [W, ah]);
                if (I) {
                    T.trigger("ajaxComplete", [W, Q]);
                    if (!(--i.active)) {
                        i.event.trigger("ajaxStop")
                    }
                }
            }
            ae.promise(W);
            W.success = W.done;
            W.error = W.fail;
            W.complete = aa.add;
            W.statusCode = function(ag) {
                if (ag) {
                    var e;
                    if (L < 2) {
                        for (e in ag) {
                            N[e] = [N[e], ag[e]]
                        }
                    } else {
                        e = ag[W.status];
                        W.always(e)
                    }
                }
                return this
            };
            Q.url = ((M || Q.url) + "").replace(p, "").replace(o, l[1] + "//");
            Q.dataTypes = i.trim(Q.dataType || "*").toLowerCase().split(t);
            if (Q.crossDomain == null) {
                V = h.exec(Q.url.toLowerCase());
                Q.crossDomain = !!(V && (V[1] !== l[1] || V[2] !== l[2] || (V[3] || (V[1] === "http:" ? 80 : 443)) != (l[3] || (l[1] === "http:" ? 80 : 443))))
            }
            if (Q.data && Q.processData && typeof Q.data !== "string") {
                Q.data = i.param(Q.data, Q.traditional)
            }
            v(G, Q, J, W);
            if (L === 2) {
                return W
            }
            I = Q.global;
            Q.type = Q.type.toUpperCase();
            Q.hasContent = !j.test(Q.type);
            if (I && i.active++ === 0) {
                i.event.trigger("ajaxStart")
            }
            if (!Q.hasContent) {
                if (Q.data) {
                    Q.url += (k.test(Q.url) ? "&" : "?") + Q.data;
                    delete Q.data
                }
                P = Q.url;
                if (Q.cache === false) {
                    var H = (new Date()).getTime(),
                        ac = Q.url.replace(d, "$1_=" + H);
                    Q.url = ac + ((ac === Q.url) ? (k.test(Q.url) ? "&" : "?") + "_=" + H : "")
                }
            }
            if (Q.data && Q.hasContent && Q.contentType !== false || J.contentType) {
                W.setRequestHeader("Content-Type", Q.contentType)
            }
            if (Q.ifModified) {
                P = P || Q.url;
                if (i.lastModified[P]) {
                    W.setRequestHeader("If-Modified-Since", i.lastModified[P])
                }
                if (i.etag[P]) {
                    W.setRequestHeader("If-None-Match", i.etag[P])
                }
            }
            W.setRequestHeader("Accept", Q.dataTypes[0] && Q.accepts[Q.dataTypes[0]] ? Q.accepts[Q.dataTypes[0]] + (Q.dataTypes[0] !== "*" ? ", " + q + "; q=0.01" : "") : Q.accepts["*"]);
            for (X in Q.headers) {
                W.setRequestHeader(X, Q.headers[X])
            }
            if (Q.beforeSend && (Q.beforeSend.call(af, W, Q) === false || L === 2)) {
                return W.abort()
            }
            O = "abort";
            for (X in {
                    success: 1,
                    error: 1,
                    complete: 1
                }) {
                W[X](Q[X])
            }
            Y = v(C, Q, J, W);
            if (!Y) {
                S(-1, "No Transport")
            } else {
                W.readyState = 1;
                if (I) {
                    T.trigger("ajaxSend", [W, Q])
                }
                if (Q.async && Q.timeout > 0) {
                    R = setTimeout(function() {
                        W.abort("timeout")
                    }, Q.timeout)
                }
                try {
                    L = 1;
                    Y.send(U, S)
                } catch (Z) {
                    if (L < 2) {
                        S(-1, Z)
                    } else {
                        throw Z
                    }
                }
            }
            return W
        },
        active: 0,
        lastModified: {},
        etag: {}
    });

    function B(P, O, L) {
        var K, M, J, e, H = P.contents,
            N = P.dataTypes,
            I = P.responseFields;
        for (M in I) {
            if (M in L) {
                O[I[M]] = L[M]
            }
        }
        while (N[0] === "*") {
            N.shift();
            if (K === undefined) {
                K = P.mimeType || O.getResponseHeader("content-type")
            }
        }
        if (K) {
            for (M in H) {
                if (H[M] && H[M].test(K)) {
                    N.unshift(M);
                    break
                }
            }
        }
        if (N[0] in L) {
            J = N[0]
        } else {
            for (M in L) {
                if (!N[0] || P.converters[M + " " + N[0]]) {
                    J = M;
                    break
                }
                if (!e) {
                    e = M
                }
            }
            J = J || e
        }
        if (J) {
            if (J !== N[0]) {
                N.unshift(J)
            }
            return L[J]
        }
    }

    function c(R, J) {
        var P, H, N, L, O = R.dataTypes.slice(),
            I = O[0],
            Q = {},
            K = 0;
        if (R.dataFilter) {
            J = R.dataFilter(J, R.dataType)
        }
        if (O[1]) {
            for (P in R.converters) {
                Q[P.toLowerCase()] = R.converters[P]
            }
        }
        for (;
            (N = O[++K]);) {
            if (N !== "*") {
                if (I !== "*" && I !== N) {
                    P = Q[I + " " + N] || Q["* " + N];
                    if (!P) {
                        for (H in Q) {
                            L = H.split(" ");
                            if (L[1] === N) {
                                P = Q[I + " " + L[0]] || Q["* " + L[0]];
                                if (P) {
                                    if (P === true) {
                                        P = Q[H]
                                    } else {
                                        if (Q[H] !== true) {
                                            N = L[0];
                                            O.splice(K--, 0, N)
                                        }
                                    }
                                    break
                                }
                            }
                        }
                    }
                    if (P !== true) {
                        if (P && R["throws"]) {
                            J = P(J)
                        } else {
                            try {
                                J = P(J)
                            } catch (M) {
                                return {
                                    state: "parsererror",
                                    error: P ? M : "No conversion from " + I + " to " + N
                                }
                            }
                        }
                    }
                }
                I = N
            }
        }
        return {
            state: "success",
            data: J
        }
    }
    var y = [],
        n = /\?/,
        D = /(=)\?(?=&|$)|\?\?/,
        z = (new Date()).getTime();
    i.jqx.data.ajaxSetup({
        jsonp: "callback",
        jsonpCallback: function() {
            var e = y.pop() || (i.expando + "_" + (z++));
            this[e] = true;
            return e
        }
    });
    i.jqx.data.ajaxPrefilter("json jsonp", function(Q, L, P) {
        var O, e, N, J = Q.data,
            H = Q.url,
            I = Q.jsonp !== false,
            M = I && D.test(H),
            K = I && !M && typeof J === "string" && !(Q.contentType || "").indexOf("application/x-www-form-urlencoded") && D.test(J);
        if (Q.dataTypes[0] === "jsonp" || M || K) {
            O = Q.jsonpCallback = i.isFunction(Q.jsonpCallback) ? Q.jsonpCallback() : Q.jsonpCallback;
            e = window[O];
            if (M) {
                Q.url = H.replace(D, "$1" + O)
            } else {
                if (K) {
                    Q.data = J.replace(D, "$1" + O)
                } else {
                    if (I) {
                        Q.url += (n.test(H) ? "&" : "?") + Q.jsonp + "=" + O
                    }
                }
            }
            Q.converters["script json"] = function() {
                if (!N) {
                    i.error(O + " was not called")
                }
                return N[0]
            };
            Q.dataTypes[0] = "json";
            window[O] = function() {
                N = arguments
            };
            P.always(function() {
                window[O] = e;
                if (Q[O]) {
                    Q.jsonpCallback = L.jsonpCallback;
                    y.push(O)
                }
                if (N && i.isFunction(e)) {
                    e(N[0])
                }
                N = e = undefined
            });
            return "script"
        }
    });
    i.jqx.data.ajaxSetup({
        accepts: {
            script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
        },
        contents: {
            script: /javascript|ecmascript/
        },
        converters: {
            "text script": function(e) {
                i.globalEval(e);
                return e
            }
        }
    });
    i.jqx.data.ajaxPrefilter("script", function(e) {
        if (e.cache === undefined) {
            e.cache = false
        }
        if (e.crossDomain) {
            e.type = "GET";
            e.global = false
        }
    });
    i.jqx.data.ajaxTransport("script", function(I) {
        if (I.crossDomain) {
            var e, H = document.head || document.getElementsByTagName("head")[0] || document.documentElement;
            return {
                send: function(J, K) {
                    e = document.createElement("script");
                    e.async = "async";
                    if (I.scriptCharset) {
                        e.charset = I.scriptCharset
                    }
                    e.src = I.url;
                    e.onload = e.onreadystatechange = function(M, L) {
                        if (L || !e.readyState || /loaded|complete/.test(e.readyState)) {
                            e.onload = e.onreadystatechange = null;
                            if (H && e.parentNode) {
                                H.removeChild(e)
                            }
                            e = undefined;
                            if (!L) {
                                K(200, "success")
                            }
                        }
                    };
                    H.insertBefore(e, H.firstChild)
                },
                abort: function() {
                    if (e) {
                        e.onload(0, 1)
                    }
                }
            }
        }
    });
    var w, x = window.ActiveXObject ? function() {
            for (var e in w) {
                w[e](0, 1)
            }
        } : false,
        m = 0;

    function g() {
        try {
            return new window.XMLHttpRequest()
        } catch (H) {}
    }

    function s() {
        try {
            return new window.ActiveXObject("Microsoft.XMLHTTP")
        } catch (H) {}
    }
    i.jqx.data.ajaxSettings.xhr = window.ActiveXObject ? function() {
        return !this.isLocal && g() || s()
    } : g;
    (function(e) {
        i.extend(i.support, {
            ajax: !!e,
            cors: !!e && ("withCredentials" in e)
        })
    })(i.jqx.data.ajaxSettings.xhr());
    if (!i.support) {
        i.support = {
            ajax: true
        }
    }
    if (i.support.ajax) {
        i.jqx.data.ajaxTransport(function(e) {
            if (!e.crossDomain || i.support.cors) {
                var H;
                return {
                    send: function(N, I) {
                        var L, K, M = e.xhr();
                        if (e.username) {
                            M.open(e.type, e.url, e.async, e.username, e.password)
                        } else {
                            M.open(e.type, e.url, e.async)
                        }
                        if (e.xhrFields) {
                            for (K in e.xhrFields) {
                                M[K] = e.xhrFields[K]
                            }
                        }
                        if (e.mimeType && M.overrideMimeType) {
                            M.overrideMimeType(e.mimeType)
                        }
                        if (!e.crossDomain && !N["X-Requested-With"]) {
                            N["X-Requested-With"] = "XMLHttpRequest"
                        }
                        try {
                            for (K in N) {
                                M.setRequestHeader(K, N[K])
                            }
                        } catch (J) {}
                        M.send((e.hasContent && e.data) || null);
                        H = function(W, Q) {
                            var R, P, O, U, T;
                            try {
                                if (H && (Q || M.readyState === 4)) {
                                    H = undefined;
                                    if (L) {
                                        M.onreadystatechange = function() {};
                                        if (x) {
                                            delete w[L]
                                        }
                                    }
                                    if (Q) {
                                        if (M.readyState !== 4) {
                                            M.abort()
                                        }
                                    } else {
                                        R = M.status;
                                        O = M.getAllResponseHeaders();
                                        U = {};
                                        T = M.responseXML;
                                        if (T && T.documentElement) {
                                            U.xml = T
                                        }
                                        try {
                                            U.text = M.responseText
                                        } catch (V) {}
                                        try {
                                            P = M.statusText
                                        } catch (V) {
                                            P = ""
                                        }
                                        if (!R && e.isLocal && !e.crossDomain) {
                                            R = U.text ? 200 : 404
                                        } else {
                                            if (R === 1223) {
                                                R = 204
                                            }
                                        }
                                    }
                                }
                            } catch (S) {
                                if (!Q) {
                                    I(-1, S)
                                }
                            }
                            if (U) {
                                I(R, P, U, O)
                            }
                        };
                        if (!e.async) {
                            H()
                        } else {
                            if (M.readyState === 4) {
                                setTimeout(H, 0)
                            } else {
                                L = ++m;
                                if (x) {
                                    if (!w) {
                                        w = {};
                                        i(window).unload(x)
                                    }
                                    w[L] = H
                                }
                                M.onreadystatechange = H
                            }
                        }
                    },
                    abort: function() {
                        if (H) {
                            H(0, 1)
                        }
                    }
                }
            }
        })
    }
    i.jqx.filter = function() {
        this.operator = "and";
        var M = 0;
        var J = 1;
        var P = ["EMPTY", "NOT_EMPTY", "CONTAINS", "CONTAINS_CASE_SENSITIVE", "DOES_NOT_CONTAIN", "DOES_NOT_CONTAIN_CASE_SENSITIVE", "STARTS_WITH", "STARTS_WITH_CASE_SENSITIVE", "ENDS_WITH", "ENDS_WITH_CASE_SENSITIVE", "EQUAL", "EQUAL_CASE_SENSITIVE", "NULL", "NOT_NULL"];
        var R = ["EQUAL", "NOT_EQUAL", "LESS_THAN", "LESS_THAN_OR_EQUAL", "GREATER_THAN", "GREATER_THAN_OR_EQUAL", "NULL", "NOT_NULL"];
        var S = ["EQUAL", "NOT_EQUAL", "LESS_THAN", "LESS_THAN_OR_EQUAL", "GREATER_THAN", "GREATER_THAN_OR_EQUAL", "NULL", "NOT_NULL"];
        var L = ["EQUAL", "NOT_EQUAL"];
        var K = new Array();
        var Q = new Array();
        this.evaluate = function(X) {
            var V = true;
            for (var W = 0; W < K.length; W++) {
                var U = K[W].evaluate(X);
                if (W == 0) {
                    V = U
                } else {
                    if (Q[W] == J || Q[W] == "or") {
                        V = V || U
                    } else {
                        V = V && U
                    }
                }
            }
            return V
        };
        this.getfilterscount = function() {
            return K.length
        };
        this.setoperatorsbyfiltertype = function(U, V) {
            switch (U) {
                case "numericfilter":
                    R = V;
                    break;
                case "stringfilter":
                    P = V;
                    break;
                case "datefilter":
                    S = V;
                    break;
                case "booleanfilter":
                    L = V;
                    break
            }
        };
        this.getoperatorsbyfiltertype = function(U) {
            var V = new Array();
            switch (U) {
                case "numericfilter":
                    V = R.slice(0);
                    break;
                case "stringfilter":
                    V = P.slice(0);
                    break;
                case "datefilter":
                    V = S.slice(0);
                    break;
                case "booleanfilter":
                    V = L.slice(0);
                    break
            }
            return V
        };
        var O = function() {
            var U = function() {
                return (((1 + Math.random()) * 65536) | 0).toString(16).substring(1)
            };
            return (U() + "-" + U() + "-" + U())
        };
        this.createfilter = function(Y, V, X, W, U, Z) {
            if (Y == null || Y == undefined) {
                return null
            }
            switch (Y) {
                case "numericfilter":
                    return new N(V, X.toUpperCase());
                case "stringfilter":
                    return new T(V, X.toUpperCase());
                case "datefilter":
                    return new H(V, X.toUpperCase(), U, Z);
                case "booleanfilter":
                    return new I(V, X.toUpperCase());
                case "custom":
                    return new e(V, X.toUpperCase(), W)
            }
            throw new Error("jqxGrid: There is no such filter type. The available filter types are: 'numericfilter', 'stringfilter', 'datefilter' and 'booleanfilter'");
            return null
        };
        this.getfilters = function() {
            var U = new Array();
            for (var V = 0; V < K.length; V++) {
                var W = {
                    value: K[V].filtervalue,
                    condition: K[V].comparisonoperator,
                    operator: Q[V],
                    type: K[V].type
                };
                if (K[V].data) {
                    W.id = K[V].data
                }
                U[V] = W
            }
            return U
        };
        this.addfilter = function(U, V) {
            K[K.length] = V;
            V.key = O();
            Q[Q.length] = U
        };
        this.removefilter = function(V) {
            for (var U = 0; U < K.length; U++) {
                if (K[U].key == V.key) {
                    K.splice(U, 1);
                    Q.splice(U, 1);
                    break
                }
            }
        };
        this.getoperatorat = function(U) {
            if (U == undefined || U == null) {
                return null
            }
            if (U < 0 || U > K.length) {
                return null
            }
            return Q[U]
        };
        this.setoperatorat = function(V, U) {
            if (V == undefined || V == null) {
                return null
            }
            if (V < 0 || V > K.length) {
                return null
            }
            Q[U] = U
        };
        this.getfilterat = function(U) {
            if (U == undefined || U == null) {
                return null
            }
            if (U < 0 || U > K.length) {
                return null
            }
            return K[U]
        };
        this.setfilterat = function(U, V) {
            if (U == undefined || U == null) {
                return null
            }
            if (U < 0 || U > K.length) {
                return null
            }
            V.key = O();
            K[U] = V
        };
        this.clear = function() {
            K = new Array();
            Q = new Array()
        };
        var T = function(V, U) {
            this.filtervalue = V;
            this.comparisonoperator = U;
            this.type = "stringfilter";
            this.evaluate = function(af) {
                var ae = this.filtervalue;
                var al = this.comparisonoperator;
                if (af == null || af == undefined || af == "") {
                    if (al == "NULL") {
                        return true
                    }
                    if (al == "EQUAL" && af == ae) {
                        return true
                    }
                    if (al == "NOT_EQUAL" && af != ae) {
                        return true
                    }
                    if (al != "EMPTY") {
                        return false
                    } else {
                        if (af == "") {
                            return true
                        }
                    }
                }
                var an = "";
                try {
                    an = af.toString()
                } catch (ag) {
                    return true
                }
                var am = function(ap, ao) {
                    switch (al) {
                        case "EQUAL":
                            return i.jqx.string.equalsIgnoreCase(ap, ao);
                        case "EQUAL_CASE_SENSITIVE":
                            return i.jqx.string.equals(ap, ao);
                        case "NOT_EQUAL":
                            return !i.jqx.string.equalsIgnoreCase(ap, ao);
                        case "NOT_EQUAL_CASE_SENSITIVE":
                            return !i.jqx.string.equals(ap, ao);
                        case "CONTAINS":
                            return i.jqx.string.containsIgnoreCase(ap, ao);
                        case "CONTAINS_CASE_SENSITIVE":
                            return i.jqx.string.contains(ap, ao);
                        case "DOES_NOT_CONTAIN":
                            return !i.jqx.string.containsIgnoreCase(ap, ao);
                        case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                            return !i.jqx.string.contains(ap, ao);
                        case "EMPTY":
                            return ap == "";
                        case "NOT_EMPTY":
                            return ap != "";
                        case "NOT_NULL":
                            return ap != null;
                        case "STARTS_WITH":
                            return i.jqx.string.startsWithIgnoreCase(ap, ao);
                        case "ENDS_WITH":
                            return i.jqx.string.endsWithIgnoreCase(ap, ao);
                        case "ENDS_WITH_CASE_SENSITIVE":
                            return i.jqx.string.endsWith(ap, ao);
                        case "STARTS_WITH_CASE_SENSITIVE":
                            return i.jqx.string.startsWith(ap, ao);
                        default:
                            return false
                    }
                };
                var Z = new Array();
                if (ae && ae.indexOf) {
                    if (ae.indexOf("|") >= 0 || ae.indexOf(" AND ") >= 0 || ae.indexOf(" OR ") >= 0 || ae.indexOf(" and ") >= 0 || ae.indexOf(" or ") >= 0) {
                        var aa = am(an, ae);
                        if (aa) {
                            return aa
                        }
                        var ab = ae.indexOf(" AND ") >= 0 ? ae.split(" AND ") : new Array();
                        var Y = ae.indexOf(" OR ") >= 0 ? ae.split(" OR ") : new Array();
                        var X = ae.indexOf(" and ") >= 0 ? ae.split(" and ") : new Array();
                        var ac = ae.indexOf(" or ") >= 0 ? ae.split(" or ") : new Array();
                        var W = ae.indexOf("|") >= 0 ? ae.split("|") : new Array();
                        if (W.length > 0) {
                            for (var ak = 0; ak < W.length; ak++) {
                                W[ak] = i.trim(W[ak])
                            }
                        }
                        var aj = ae.indexOf(" ") >= 0 ? ae.split(" ") : new Array();
                        if (aj.length > 0) {
                            for (var ak = 0; ak < aj.length; ak++) {
                                aj[ak] = i.trim(aj[ak])
                            }
                        }
                        ab = ab.concat(aj);
                        ab = ab.concat(X);
                        Y = Y.concat(W);
                        Y = Y.concat(ac);
                        if (ab.length > 0) {
                            for (var ak = 0; ak < ab.length; ak++) {
                                if (!ab[ak].indexOf(" OR ") >= 0) {
                                    Z.push(ab[ak])
                                }
                            }
                        }
                        if (Y.length > 0) {
                            for (var ak = 0; ak < Y.length; ak++) {
                                if (!Y[ak].indexOf(" AND ") >= 0) {
                                    Z.push(Y[ak])
                                }
                            }
                        }
                        var ai = undefined;
                        for (var ah = 0; ah < Z.length; ah++) {
                            var af = Z[ah];
                            var aa = am(an, af);
                            var ad = ah < ab.length ? "and" : "or";
                            if (ai == undefined) {
                                ai = aa
                            } else {
                                if (ad == "or") {
                                    ai = ai || aa
                                } else {
                                    ai = ai && aa
                                }
                            }
                        }
                        return ai
                    }
                }
                return am(an, ae)
            }
        };
        var I = function(V, U) {
            this.filtervalue = V;
            this.comparisonoperator = U;
            this.type = "booleanfilter";
            this.evaluate = function(Y) {
                var X = this.filtervalue;
                var W = this.comparisonoperator;
                if (Y == null || Y == undefined) {
                    if (W == "NULL") {
                        return true
                    }
                    return false
                }
                var Z = Y;
                switch (W) {
                    case "EQUAL":
                        return Z == X || Z.toString() == X.toString();
                    case "NOT_EQUAL":
                        return Z != X && Z.toString() != X.toString();
                    default:
                        return false
                }
            }
        };
        var N = function(V, U) {
            this.filtervalue = V;
            this.comparisonoperator = U;
            this.type = "numericfilter";
            this.evaluate = function(ag) {
                var af = this.filtervalue;
                var al = this.comparisonoperator;
                if (ag === null || ag === undefined || ag === "") {
                    if (al == "NOT_NULL") {
                        return false
                    }
                    if (al == "NULL") {
                        return true
                    } else {
                        switch (al) {
                            case "EQUAL":
                                return ag == af;
                            case "NOT_EQUAL":
                                return ag != af
                        }
                        return false
                    }
                } else {
                    if (al == "NULL") {
                        return false
                    }
                    if (al == "NOT_NULL") {
                        return true
                    }
                }
                var an = ag;
                try {
                    an = parseFloat(an)
                } catch (ah) {
                    if (ag.toString() != "") {
                        return false
                    }
                }
                var am = function(ap, ao) {
                    switch (al) {
                        case "EQUAL":
                            return ap == ao;
                        case "NOT_EQUAL":
                            return ap != ao;
                        case "GREATER_THAN":
                            return ap > ao;
                        case "GREATER_THAN_OR_EQUAL":
                            return ap >= ao;
                        case "LESS_THAN":
                            return ap < ao;
                        case "LESS_THAN_OR_EQUAL":
                            return ap <= ao;
                        case "STARTS_WITH":
                            return i.jqx.string.startsWithIgnoreCase(ap.toString(), ao.toString());
                        case "ENDS_WITH":
                            return i.jqx.string.endsWithIgnoreCase(ap.toString(), ao.toString());
                        case "ENDS_WITH_CASE_SENSITIVE":
                            return i.jqx.string.endsWith(ap.toString(), ao.toString());
                        case "STARTS_WITH_CASE_SENSITIVE":
                            return i.jqx.string.startsWith(ap.toString(), ao.toString());
                        case "CONTAINS":
                            return i.jqx.string.containsIgnoreCase(ap.toString(), ao.toString());
                        case "CONTAINS_CASE_SENSITIVE":
                            return i.jqx.string.contains(ap.toString(), ao.toString());
                        case "DOES_NOT_CONTAIN":
                            return !i.jqx.string.containsIgnoreCase(ap.toString(), ao.toString());
                        case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                            return !i.jqx.string.contains(ap.toString(), ao.toString());
                        default:
                            return true
                    }
                };
                var aa = new Array();
                if (af && af.indexOf) {
                    if (af.indexOf("|") >= 0 || af.indexOf(" AND ") >= 0 || af.indexOf(" OR ") >= 0 || af.indexOf(" and ") >= 0 || af.indexOf(" or ") >= 0) {
                        var ab = am(an, af);
                        if (ab) {
                            return ab
                        }
                        af = af.toString();
                        var ac = af.indexOf(" AND ") >= 0 ? af.split(" AND ") : new Array();
                        var Z = af.indexOf(" OR ") >= 0 ? af.split(" OR ") : new Array();
                        var Y = af.indexOf(" and ") >= 0 ? af.split(" and ") : new Array();
                        var ad = af.indexOf(" or ") >= 0 ? af.split(" or ") : new Array();
                        ac = ac.concat(Y);
                        Z = Z.concat(ad);
                        var X = af.indexOf("|") >= 0 ? af.split("|") : new Array();
                        if (X.length > 0) {
                            for (var ak = 0; ak < X.length; ak++) {
                                X[ak] = i.trim(X[ak])
                            }
                        }
                        Z = Z.concat(X);
                        if (ac.length > 0) {
                            for (var ak = 0; ak < ac.length; ak++) {
                                if (!ac[ak].indexOf(" OR ") >= 0) {
                                    aa.push(ac[ak])
                                }
                            }
                        }
                        if (Z.length > 0) {
                            for (var ak = 0; ak < Z.length; ak++) {
                                if (!Z[ak].indexOf(" AND ") >= 0) {
                                    aa.push(Z[ak])
                                }
                            }
                        }
                        var aj = undefined;
                        for (var ai = 0; ai < aa.length; ai++) {
                            var ag = aa[ai];
                            if (ag && ag.indexOf && ag.indexOf("..") >= 0) {
                                var W = ag.toString().split("..");
                                if (W.length == 2) {
                                    ab = an >= W[0] && an <= W[1]
                                }
                            } else {
                                var ab = am(an, ag)
                            }
                            var ae = ai < ac.length ? "and" : "or";
                            if (aj == undefined) {
                                aj = ab
                            } else {
                                if (ae == "or") {
                                    aj = aj || ab
                                } else {
                                    aj = aj && ab
                                }
                            }
                        }
                        return aj
                    }
                }
                if (af && af.indexOf && af.indexOf("..") >= 0) {
                    aa = af.toString().split("..");
                    if (aa.length == 2) {
                        return an >= aa[0] && an <= aa[1]
                    }
                }
                return am(an, af)
            }
        };
        var H = function(X, V, W, ab) {
            this.filtervalue = X;
            this.type = "datefilter";
            var Z = this;
            if (W != undefined && ab != undefined) {
                var Y = i.jqx.dataFormat.parsedate(X, W, ab);
                if (Y != null) {
                    this.filterdate = Y
                } else {
                    var U = i.jqx.dataFormat.tryparsedate(X, ab);
                    if (U != null) {
                        this.filterdate = U
                    }
                }
            } else {
                var aa = new Date(X);
                if (aa.toString() == "NaN" || aa.toString() == "Invalid Date") {
                    this.filterdate = i.jqx.dataFormat.tryparsedate(X)
                } else {
                    this.filterdate = aa
                }
            }
            if (!this.filterdate) {
                var aa = new Date(X);
                if (aa.toString() == "NaN" || aa.toString() == "Invalid Date") {
                    this.filterdate = i.jqx.dataFormat.tryparsedate(X)
                } else {
                    this.filterdate = aa
                }
            }
            this.comparisonoperator = V;
            this.evaluate = function(ao) {
                var an = this.filtervalue;
                var aw = this.comparisonoperator;
                if (ao == null || ao == undefined || ao == "") {
                    if (aw == "NOT_NULL") {
                        return false
                    }
                    if (aw == "NULL") {
                        return true
                    } else {
                        switch (aw) {
                            case "EQUAL":
                                return ao == an;
                            case "NOT_EQUAL":
                                return ao != an
                        }
                        return false
                    }
                } else {
                    if (aw == "NULL") {
                        return false
                    }
                    if (aw == "NOT_NULL") {
                        return true
                    }
                }
                var ay = new Date();
                ay.setFullYear(1900, 0, 1);
                ay.setHours(12, 0, 0, 0);
                try {
                    var av = new Date(ao);
                    if (av.toString() == "NaN" || av.toString() == "Invalid Date") {
                        ao = i.jqx.dataFormat.tryparsedate(ao)
                    } else {
                        ao = av
                    }
                    ay = ao;
                    var at = false;
                    if (W != undefined && ab != undefined) {
                        if (W.indexOf("t") >= 0 || W.indexOf("T") >= 0 || W.indexOf(":") >= 0 || W.indexOf("f") >= 0) {
                            at = true;
                            if (an && an.toString().indexOf(":") == -1) {
                                var aj = i.jqx.dataFormat.tryparsedate(an.toString() + ":00", ab);
                                if (aj != null) {
                                    Z.filterdate = aj
                                }
                            }
                        }
                    }
                    if (!at) {
                        ay.setHours(0);
                        ay.setMinutes(0);
                        ay.setSeconds(0)
                    }
                } catch (ap) {
                    if (ao.toString() != "") {
                        return false
                    }
                }
                if (Z.filterdate != null) {
                    an = Z.filterdate
                } else {
                    if (an && an.indexOf) {
                        if (an.indexOf(":") != -1 || !isNaN(parseInt(an))) {
                            var ai = new Date(ay);
                            ai.setHours(12, 0, 0, 0);
                            var ah = an.split(":");
                            for (var au = 0; au < ah.length; au++) {
                                if (au == 0) {
                                    ai.setHours(ah[au])
                                }
                                if (au == 1) {
                                    ai.setMinutes(ah[au])
                                }
                                if (au == 2) {
                                    ai.setSeconds(ah[au])
                                }
                            }
                            an = ai
                        }
                    }
                }
                if (at) {
                    if (an && an.setFullYear) {
                        if (ay && ay.getFullYear) {
                            if (W.indexOf("d") == -1 && W.indexOf("M") == -1 && W.indexOf("y") == -1) {
                                an.setFullYear(ay.getFullYear(), ay.getMonth(), ay.getDate())
                            }
                        }
                    }
                }
                var ax = function(aA, az) {
                    if (aA == null) {
                        aA = ""
                    }
                    switch (aw) {
                        case "EQUAL":
                            return aA.toString() == az.toString();
                        case "NOT_EQUAL":
                            return aA.toString() != az.toString();
                        case "GREATER_THAN":
                            return aA > az;
                        case "GREATER_THAN_OR_EQUAL":
                            return aA >= az;
                        case "LESS_THAN":
                            return aA < az;
                        case "LESS_THAN_OR_EQUAL":
                            return aA <= az;
                        case "STARTS_WITH":
                            return i.jqx.string.startsWithIgnoreCase(aA.toString(), az.toString());
                        case "ENDS_WITH":
                            return i.jqx.string.endsWithIgnoreCase(aA.toString(), az.toString());
                        case "ENDS_WITH_CASE_SENSITIVE":
                            return i.jqx.string.endsWith(aA.toString(), az.toString());
                        case "STARTS_WITH_CASE_SENSITIVE":
                            return i.jqx.string.startsWith(aA.toString(), az.toString());
                        case "CONTAINS":
                            return i.jqx.string.containsIgnoreCase(aA.toString(), az.toString());
                        case "CONTAINS_CASE_SENSITIVE":
                            return i.jqx.string.contains(aA.toString(), az.toString());
                        case "DOES_NOT_CONTAIN":
                            return !i.jqx.string.containsIgnoreCase(aA.toString(), az.toString());
                        case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                            return !i.jqx.string.contains(aA.toString(), az.toString());
                        default:
                            return true
                    }
                };
                var ag = new Array();
                if (an && an.indexOf) {
                    if (an.indexOf("|") >= 0 || an.indexOf(" AND ") >= 0 || an.indexOf(" OR ") >= 0 || an.indexOf(" and ") >= 0 || an.indexOf(" or ") >= 0) {
                        var aj = ax(ay, an);
                        if (aj) {
                            return aj
                        }
                        var ak = an.indexOf(" AND ") >= 0 ? an.split(" AND ") : new Array();
                        var af = an.indexOf(" OR ") >= 0 ? an.split(" OR ") : new Array();
                        var ae = an.indexOf(" and ") >= 0 ? an.split(" and ") : new Array();
                        var al = an.indexOf(" or ") >= 0 ? an.split(" or ") : new Array();
                        ak = ak.concat(ae);
                        af = af.concat(al);
                        var ad = an.indexOf("|") >= 0 ? an.split("|") : new Array();
                        if (ad.length > 0) {
                            for (var au = 0; au < ad.length; au++) {
                                ad[au] = i.trim(ad[au])
                            }
                        }
                        af = af.concat(ad);
                        if (ak.length > 0) {
                            for (var au = 0; au < ak.length; au++) {
                                if (!ak[au].indexOf(" OR ") >= 0) {
                                    ag.push(ak[au])
                                }
                            }
                        }
                        if (af.length > 0) {
                            for (var au = 0; au < af.length; au++) {
                                if (!af[au].indexOf(" AND ") >= 0) {
                                    ag.push(af[au])
                                }
                            }
                        }
                        var ar = undefined;
                        for (var aq = 0; aq < ag.length; aq++) {
                            var ao = ag[aq];
                            if (ao && ao.indexOf && ao.indexOf("..") >= 0) {
                                var ac = ao.toString().split("..");
                                if (ac.length == 2) {
                                    aj = ay >= ac[0] && ay <= ac[1]
                                }
                            } else {
                                var aj = ax(ay, ao)
                            }
                            var am = aq < ak.length ? "and" : "or";
                            if (ar == undefined) {
                                ar = aj
                            } else {
                                if (am == "or") {
                                    ar = ar || aj
                                } else {
                                    ar = ar && aj
                                }
                            }
                        }
                        return ar
                    }
                }
                if (an && an.indexOf && an.indexOf("..") >= 0) {
                    ag = an.toString().split("..");
                    if (ag.length == 2) {
                        return ay >= ag[0] && ay <= ag[1]
                    }
                }
                return ax(ay, an)
            }
        };
        var e = function(V, U, W) {
            this.filtervalue = V;
            this.comparisonoperator = U;
            this.evaluate = function(Y, X) {
                return W(this.filtervalue, Y, this.comparisonoperator)
            }
        }
    }
})(jqxBaseFramework);
