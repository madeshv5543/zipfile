var Particler = function(i) {
    function t(o) {
        if (e[o])
            return e[o].exports;
        var s = e[o] = {
            exports: {},
            id: o,
            loaded: !1
        };
        return i[o].call(s.exports, s, s.exports, t),
        s.loaded = !0,
        s.exports
    }
    var e = {};
    return t.m = i,
    t.c = e,
    t.p = "",
    t(0)
}([function(i, t, e) {
    "use strict";
    function o(i) {
        return i && i.__esModule ? i : {
            default: i
        }
    }
    function s(i, t) {
        if (!(i instanceof t))
            throw new TypeError("Cannot call a class as a function")
    }
    var n = function() {
        function i(i, t) {
            for (var e = 0; e < t.length; e++) {
                var o = t[e];
                o.enumerable = o.enumerable || !1,
                o.configurable = !0,
                "value"in o && (o.writable = !0),
                Object.defineProperty(i, o.key, o)
            }
        }
        return function(t, e, o) {
            return e && i(t.prototype, e),
            o && i(t, o),
            t
        }
    }()
      , r = e(1)
      , a = o(r)
      , h = e(2)
      , l = o(h);
    e(3);
    var u = function() {
        function i(t, e) {
            var o = this;
            s(this, i),
            this.rafid = !1,
            this.el = t,
            this.options = {
                sizeMin: 4,
                sizeMax: 7,
                sizeChangeStep: .1,
                shape: "circle",
                fullScreen: !1,
                fullScreenStretch: !1,
                gridSize: 7,
                gridStartZoomEnabled: !1,
                gridStartZoom: 1,
                gridStartZoomSpeed: 10,
                circleMotionSpeedMin: 1,
                circleMotionSpeedMax: 5,
                circleMotionRadiusMin: 10,
                circleMotionRadiusMax: 15,
                offset: {
                    left: 10,
                    top: 10
                },
                ignoreWhite: !0,
                mousemoveBehavior: !1,
                mouseoverRadius: 200,
                mouseoverPointRandomDistance: 120,
                mouseoverRadiusMaxDelta: 10,
                fps: 20,
                randomizeGrid: !1
            },
            Object.assign(this.options, e),
            this.checkOptions(),
            this.stopped = !0,
            this.gridStartZoom = 1,
            this.options.gridStartZoomEnabled && (this.gridStartZoom = this.options.gridStartZoom),
            this._boundOnScroll = function() {
                o.getWindowSize(),
                o.getScrollTop(),
                o.getElRect()
            }
            ,
            this.getWindowSize(),
            this.getElRect(),
            this.getScrollTop(),
            this.enableBehaviors(),
            this.loadImage(),
            this.refresh = (0,
            l.default)(function() {
                o.loadImage(),
                o.getWindowSize(),
                o.getScrollTop(),
                o.getElRect()
            }, 50),
            this._boundRefresh = function() {
                o.refresh()
            }
            ,
            window.addEventListener("resize", this._boundRefresh),
            this._boundMLeaveHandler = function() {
                this.mx = -1e3,
                this.my = -1e3,
                this.disableMouseOver = !0
            }
            .bind(this)
        }
        return n(i, [{
            key: "getElRect",
            value: function() {
                this.elRect = this.el.getBoundingClientRect()
            }
        }, {
            key: "getScrollTop",
            value: function() {
                this.scrollTop = window.pageYOffset
            }
        }, {
            key: "enableBehaviors",
            value: function() {
                (this.options.mousemoveBehavior || this.options.zoomOnHover) && this.mouseMoveHandler()
            }
        }, {
            key: "mouseMoveHandler",
            value: function() {
                var i = this;
                window.removeEventListener("mousemove", this._boundMouseMoveHandler),
                window.removeEventListener("scroll", this._boundOnScroll),
                this.options.fullScreen ? (this._boundMouseMoveHandler = this._mouseMoveHandlerFullScreen.bind(this),
                requestAnimationFrame(function() {
                    window.addEventListener("mousemove", i._boundMouseMoveHandler)
                })) : (this.el.removeEventListener("mousemove", this._boundMouseMoveHandler),
                this.el.removeEventListener("mouseout", this._boundMLeaveHandler),
                this._boundMouseMoveHandler = this._mouseMoveHandler.bind(this),
                requestAnimationFrame(function() {
                    i.el.addEventListener("mousemove", i._boundMouseMoveHandler),
                    i.el.addEventListener("mouseout", i._boundMLeaveHandler)
                })),
                requestAnimationFrame(function() {
                    window.addEventListener("scroll", i._boundOnScroll)
                })
            }
        }, {
            key: "_mouseMoveHandler",
            value: function(i) {
                this.disableMouseOver = !1,
                this.mx = i.clientX - this.elRect.left,
                this.my = i.clientY - this.elRect.top
            }
        }, {
            key: "_mouseMoveHandlerFullScreen",
            value: function(i) {
                this.disableMouseOver = !1,
                this.mx = i.clientX,
                this.my = i.clientY
            }
        }, {
            key: "run",
            value: function() {
                var i = this;
                if (!this.rafid) {
                    var t = (new Date).getTime()
                      , e = 0
                      , o = 0
                      , s = 1e3 / this.options.fps;
                    this.refresh();
                    var n = function n() {
                        i.rafid = requestAnimationFrame(n),
                        e = (new Date).getTime(),
                        o = e - t,
                        !i.stopped && o > s && (i.recalculatePoints(),
                        i.clearCanvas(),
                        i.renderPoints(),
                        t = e - o % s)
                    };
                    n()
                }
            }
        }, {
            key: "destroy",
            value: function() {
                this.rafid && (cancelAnimationFrame(this.rafid),
                this.rafid = !1),
                window.removeEventListener("resize", this._boundRefresh),
                window.removeEventListener("scroll", this._boundOnScroll),
                this.el.removeEventListener("mouseout", this._boundMLeaveHandler),
                this._boundMouseMoveHandler && (window.removeEventListener("mousemove", this._boundMouseMoveHandler),
                this.el.removeEventListener("mousemove", this._boundMouseMoveHandler)),
                this.clearCanvas(),
                this.points = []
            }
        }, {
            key: "restart",
            value: function() {
                this.clearCanvas(),
                this.gridStartZoom = this.options.gridStartZoom
            }
        }, {
            key: "buildGrid",
            value: function() {
                var i = this.gridStartZoom * this.options.gridSize;
                this.points = [];
                for (var t = this.imageData.length, e = 0; e < this.canvasWidth; e++)
                    for (var o = 0; o < this.canvasHeight; o++)
                        if (this.isNextGridElement(e, o, i)) {
                            var s = 4 * e + 4 * o * this.canvasWidth;
                            if (s + 3 >= t)
                                continue;
                            var n = this.imageData[s]
                              , r = this.imageData[s + 1]
                              , h = this.imageData[s + 2]
                              , l = this.imageData[s + 3];
                            if (this.isAGoodPixel(n, r, h, l)) {
                                var u = e
                                  , c = o;
                                this.options.randomizeGrid && (u += Math.random() * i,
                                c += Math.random() * i);
                                var d = new a.default(n,r,h,l / 255,u,c,this.options);
                                this.points.push(d)
                            }
                        }
            }
        }, {
            key: "setupLines",
            value: function() {
                var i = this.points.length
                  , t = 4;
                this.lines = [];
                for (var e = t / this.options.linesDesity, o = 0; o < i; o += e) {
                    var s = this.points[o];
                    this._isLinePair(s, o + 1)
                }
            }
        }, {
            key: "_isLinePair",
            value: function(i, t) {
                var e = this.points[t];
                e && e.isNear(i) && this.lines.push([i, e])
            }
        }, {
            key: "drawImage",
            value: function() {
                var i = 0;
                if (this.options.fullScreen) {
                    if (this.options.fullScreenStretch)
                        this.imgWidth = this.windowSize.w,
                        this.imgHeight = this.windowSize.h;
                    else {
                        var t = this.windowSize.w / this.img.width
                          , e = this.windowSize.h / this.img.height;
                        t * this.img.height > this.windowSize.h ? (this.imgWidth = e * this.img.width,
                        this.imgHeight = e * this.img.height) : (this.imgWidth = t * this.img.width,
                        this.imgHeight = t * this.img.height)
                    }
                    i = (this.windowSize.w - this.imgWidth) / 2
                } else
                    this.imgWidth = this.img.width,
                    this.imgHeight = this.img.height;
                    console.log(this.imgHeight);
                this.canvasWidth = this.imgWidth,
                this.canvasHeight = this.imgHeight,
                this.setupCanvas(),
                this.ctx.drawImage(this.img, i, this.options.offset.top, this.imgWidth, this.imgHeight),
                this.imageData = this.ctx.getImageData(0, 0, this.canvasWidth, this.canvasHeight).data
            }
        }, {
            key: "recalculatePoints",
            value: function() {
                if (this.gridStartZoom > 1 && (this.gridStartZoom = this.gridStartZoom * (1 - this.options.gridStartZoomSpeed / 100),
                this.buildGrid()),
                this.gridStartZoom < 1 && (this.gridStartZoom = 1,
                this.buildGrid()),
                this.points)
                    for (var i = 0; i < this.points.length; i++) {
                        var t = this.points[i]
                          , e = 0;
                        if (this.options.zoomOnHover) {
                            t.rx = 0,
                            t.ry = 0;
                            var o = this.getMouse2PointDist(t.x, t.y);
                            if (o < this.options.mouseoverRadius) {
                                var s = (this.options.mouseoverRadius - o) / this.options.mouseoverRadius;
                                t.rSize = this.options.zoomOnHoverDelta * s
                            } else
                                t.rSize = 0
                        }
                        if (this.options.mousemoveBehavior && !this.disableMouseOver) {
                            var o = this.getMouse2PointDist(t.x, t.y);
                            if (o < this.options.mouseoverRadius) {
                                var n = (this.options.mouseoverRadius - o) / this.options.mouseoverRadius;
                                e = this.options.mouseoverRadiusMaxDelta * n,
                                t.rx = Math.min(this.options.mouseoverPointRandomDistance, t.randomDX * n),
                                t.ry = Math.min(this.options.mouseoverPointRandomDistance, t.randomDY * n)
                            } else
                                t.rx = 0,
                                t.ry = 0
                        }
                        if (this.options.mousemoveBehavior || this.options.zoomOnHover || (t.rx = 0,
                        t.ry = 0,
                        t.rSize = 0),
                        t.circleMotionSpeed && t.circleMotionRadius > 0) {
                            var r = Math.cos(t.angle) * (t.circleMotionRadius + e)
                              , a = Math.sin(t.angle) * (t.circleMotionRadius + e);
                            t.angle += t.circleMotionSpeed,
                            t.x = t.ox + r + t.rx,
                            t.y = t.oy + a + t.ry
                        }
                    }
            }
        }, {
            key: "getMouse2PointDist",
            value: function(i, t) {
                var e = Math.pow(this.mx - i, 2)
                  , o = Math.pow(this.my - t, 2);
                return Math.sqrt(e + o)
            }
        }, {
            key: "renderPoints",
            value: function() {
                if (this.points)
                    for (var i = 0; i < this.points.length; i++) {
                        var t = this.points[i];
                        this.renderPoint(t)
                    }
            }
        }, {
            key: "renderPoint",
            value: function(i) {
                this.ctx.fillStyle = i.getRgba(),
                i.size += i.sizeChangeStep;
                var t = this.options.sizeMax + i.rSize
                  , e = this.options.sizeMin + i.rSize;
                i.size > t && (i.sizeChangeStep = -i.sizeChangeStep),
                i.size < e && (i.sizeChangeStep = -i.sizeChangeStep);
                var o = i.size * this.gridStartZoom + i.rSize;
                this[this.options.shape + "Renderer"](i, o)
            }
        }, {
            key: "circleRenderer",
            value: function(i, t) {
                var e = (t - i.rSize) / 2;
                this.ctx.beginPath(),
                this.ctx.arc(i.x - e, i.y - e, t / 2, 0, 2 * Math.PI, !1),
                this.ctx.fill(),
                this.ctx.closePath()
            }
        }, {
            key: "heartRenderer",
            value: function(i, t) {
                var e = (t - i.rSize) / 2
                  , o = i.x - e
                  , s = i.y - e
                  , n = t / 2
                  , r = t / 4
                  , a = 3 * r
                  , h = o + t
                  , l = o + n
                  , u = o + r
                  , c = o + a
                  , d = s + n
                  , m = s + r
                  , v = s + a;
                this.ctx.beginPath(),
                this.ctx.moveTo(o, m),
                this.ctx.quadraticCurveTo(o, s, u, s),
                this.ctx.quadraticCurveTo(l, s, l, m),
                this.ctx.quadraticCurveTo(l, s, c, s),
                this.ctx.quadraticCurveTo(h, s, h, m),
                this.ctx.quadraticCurveTo(h, d, c, v),
                this.ctx.lineTo(l, s + t),
                this.ctx.lineTo(u, v),
                this.ctx.quadraticCurveTo(o, d, o, m),
                this.ctx.fill(),
                this.ctx.closePath()
            }
        }, {
            key: "squareRenderer",
            value: function(i, t) {
                var e = i.rSize / 2;
                this.ctx.fillRect(i.x - e, i.y - e, t, t)
            }
        }, {
            key: "crossRenderer",
            value: function(i, t) {
                var e = t / 2
                  , o = t / 6
                  , s = 0;
                this.ctx.fillRect(i.x - s, i.y - e - s, o, t),
                this.ctx.fillRect(i.x - e - s, i.y - s, t, o)
            }
        }, {
            key: "starRenderer",
            value: function(i, t) {
                var e = 5
                  , o = .8 * t
                  , s = .4 * t
                  , n = Math.PI / 2 * 3
                  , r = i.x
                  , a = i.y
                  , h = Math.PI / e;
                this.ctx.beginPath(),
                this.ctx.moveTo(i.x, i.y - o);
                for (var l = 0; l < e; l++)
                    r = i.x + Math.cos(n) * o,
                    a = i.y + Math.sin(n) * o,
                    this.ctx.lineTo(r, a),
                    n += h,
                    r = i.x + Math.cos(n) * s,
                    a = i.y + Math.sin(n) * s,
                    this.ctx.lineTo(r, a),
                    n += h;
                this.ctx.lineTo(i.x, i.y - o),
                this.ctx.closePath(),
                this.ctx.fill()
            }
        }, {
            key: "clearCanvas",
            value: function() {
                this.ctx.clearRect(0, 0, this.canvasWidth, this.canvasHeight)
            }
        }, {
            key: "loadImage",
            value: function() {
                var i = this;
                this.pause(),
                this.el.style.display = "block",
                this.el.style.visibility = "hidden",
                this.img = new Image,
                this.img.onload = function() {
                    i.drawImage(),
                    i.buildGrid(),
                    i.clearCanvas(),
                    i.el.style.visibility = "visible",
                    i.continue()
                }
                ,
                this.img.onerror = function(i) {
                    console.error(i)
                }
                ,
                this.img.src = this.options.img
            }
        }, {
            key: "pause",
            value: function() {
                this.stopped = !0
            }
        }, {
            key: "continue",
            value: function() {
                this.stopped = !1
            }
        }, {
            key: "isNextGridElement",
            value: function(i, t, e) {
                return e = Math.round(e),
                (i - 1) % e == 0 && (t - 1) % e == 0
            }
        }, {
            key: "isAGoodPixel",
            value: function(i, t, e, o) {
                return this.options.ignoreWhite ? o > .5 && i + t + e < 750 : o > .5
            }
        }, {
            key: "getWindowSize",
            value: function() {
                this.windowSize = {
                    w: window.innerWidth,
                    h: window.innerHeight
                }
            }
        }, {
            key: "setupCanvas",
            value: function() {
                this.ctx = this.el.getContext("2d"),
                this.options.fullScreen ? (this.el.width = this.windowSize.w,
                this.el.height = this.windowSize.h,
                this.canvasWidth = this.windowSize.w,
                this.canvasHeight = this.windowSize.h,
                this.el.style.position = "fixed",
                this.el.style.top = 0,
                this.el.style.left = 0,
                this.el.style.right = 0,
                this.el.style.bottom = 0,
                this.el.style.zIndex = -1) : (this.el.style.position = "static",
                this.el.height = this.imgHeight,
                this.el.width = this.imgWidth,
                this.canvasWidth = this.el.width,
                this.canvasHeight = this.el.height)
            }
        }, {
            key: "checkOptions",
            value: function() {
                if (!this.options.img)
                    throw new Error('No "img" property!');
                if (this.options.gridStartZoomSpeed > 30 || this.options.gridStartZoomSpeed < 1)
                    throw new Error('Option "gridStartZoomSpeed" must be between 1 and 30!');
                if (this.options.sizeMin > this.options.sizeMax && (console.error('Option "sizeMax" must be greather or equal than "sizeMin"!'),
                this.options.sizeMin = this.options.sizeMax),
                this.options.circleMotionSpeedMin > this.options.circleMotionSpeedMax && (console.error('Option "circleMotionSpeedMax" must be greather or equal than "circleMotionSpeedMin"!'),
                this.options.circleMotionSpeedMin = this.options.circleMotionSpeedMax),
                "undefined" == typeof this[this.options.shape + "Renderer"])
                    throw new Error('Invalid option "shape"!')
            }
        }]),
        i
    }();
    i.exports = u
}
, function(i, t) {
    "use strict";
    function e(i, t) {
        if (!(i instanceof t))
            throw new TypeError("Cannot call a class as a function")
    }
    var o = function() {
        function i(i, t) {
            for (var e = 0; e < t.length; e++) {
                var o = t[e];
                o.enumerable = o.enumerable || !1,
                o.configurable = !0,
                "value"in o && (o.writable = !0),
                Object.defineProperty(i, o.key, o)
            }
        }
        return function(t, e, o) {
            return e && i(t.prototype, e),
            o && i(t, o),
            t
        }
    }();
    i.exports = function() {
        function i(t, o, s, n, r, a, h) {
            e(this, i),
            this.r = t,
            this.g = o,
            this.b = s,
            this.a = n,
            this.x = r,
            this.y = a,
            this.oa = n,
            this.ox = r,
            this.oy = a,
            this.rx = 0,
            this.ry = 0,
            this.randomDX = this.getRandomArbitrary(-h.mouseoverPointRandomDistance, h.mouseoverPointRandomDistance),
            this.randomDY = this.getRandomArbitrary(-h.mouseoverPointRandomDistance, h.mouseoverPointRandomDistance),
            h.sizeMin == h.sizeMax ? this.size = h.sizeMin : this.size = h.sizeMin + Math.random() * (h.sizeMax - h.sizeMin),
            this.oSize = this.size,
            this.sizeChangeStep = (Math.random() > .5 ? 1 : -1) * h.sizeChangeStep,
            this.rSize = 0,
            this.angle = 360 * Math.random();
            var l = h.circleMotionSpeedMin / 10
              , u = h.circleMotionSpeedMax / 10;
            this.circleMotionSpeed = l,
            u > l && (this.circleMotionSpeed = l + Math.random() * (u - l)),
            l = h.circleMotionRadiusMin / 10,
            u = h.circleMotionRadiusMax / 10,
            this.circleMotionRadius = l,
            u > l && (this.circleMotionRadius = l + Math.random() * (u - l))
        }
        return o(i, [{
            key: "getRandomArbitrary",
            value: function(i, t) {
                return Math.random() * (t - i) + i
            }
        }, {
            key: "getRgba",
            value: function() {
                return "rgba(" + this.r + "," + this.g + "," + this.b + "," + this.a + ")"
            }
        }, {
            key: "isNear",
            value: function(i) {
                var t = 100;
                return Math.abs(this.x - i.x) < t && Math.abs(this.y - i.y) < t
            }
        }]),
        i
    }()
}
, function(i, t) {
    "use strict";
    i.exports = function(i, t, e) {
        var o;
        return function() {
            var s = this
              , n = arguments
              , r = function() {
                o = null,
                e || i.apply(s, n)
            }
              , a = e && !o;
            clearTimeout(o),
            o = setTimeout(r, t),
            a && i.apply(s, n)
        }
    }
}
, function(i, t) {
    "use strict";
    for (var e = 0, o = ["webkit", "moz"], s = 0; s < o.length && !window.requestAnimationFrame; ++s)
        window.requestAnimationFrame = window[o[s] + "RequestAnimationFrame"],
        window.cancelAnimationFrame = window[o[s] + "CancelAnimationFrame"] || window[o[s] + "CancelRequestAnimationFrame"];
    window.requestAnimationFrame || (window.requestAnimationFrame = function(i, t) {
        var o = (new Date).getTime()
          , s = Math.max(0, 16 - (o - e))
          , n = window.setTimeout(function() {
            i(o + s)
        }, s);
        return e = o + s,
        n
    }
    ),
    window.cancelAnimationFrame || (window.cancelAnimationFrame = function(i) {
        clearTimeout(i)
    }
    ),
    Object.assign || Object.defineProperty(Object, "assign", {
        enumerable: !1,
        configurable: !0,
        writable: !0,
        value: function(i, t) {
            if (void 0 === i || null === i)
                throw new TypeError("Cannot convert first argument to object");
            for (var e = Object(i), o = 1; o < arguments.length; o++) {
                var s = arguments[o];
                if (void 0 !== s && null !== s)
                    for (var n = Object.keys(Object(s)), r = 0, a = n.length; r < a; r++) {
                        var h = n[r]
                          , l = Object.getOwnPropertyDescriptor(s, h);
                        void 0 !== l && l.enumerable && (e[h] = s[h])
                    }
            }
            return e
        }
    })
}
]);
