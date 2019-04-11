!function(t, e) {
    "object" == typeof exports && "undefined" != typeof module ? e(require("jquery")) : "function" == typeof define && define.amd ? define(["jquery"], e) : e(t.jQuery)
} (this,
    function(t) {
        function e(t) {
            return "number" == typeof t && !isNaN(t)
        }
        function a(t) {
            return "undefined" == typeof t
        }
        function i(t, a) {
            var i = [];
            return e(a) && i.push(a),
                i.slice.apply(t, i)
        }
        function o(t, e) {
            for (var a = arguments.length,
                     o = Array(a > 2 ? a - 2 : 0), n = 2; n < a; n++) o[n - 2] = arguments[n];
            return function() {
                for (var a = arguments.length,
                         n = Array(a), r = 0; r < a; r++) n[r] = arguments[r];
                return t.apply(e, o.concat(i(n)))
            }
        }
        function n(e) {
            var a = [];
            return t.each(e,
                function(t) {
                    a.push(t)
                }),
                a
        }
        function r(t) {
            var e = t.match(/^(https?:)\/\/([^:\/?#]+):?(\d*)/i);
            return e && (e[1] !== location.protocol || e[2] !== location.hostname || e[3] !== location.port)
        }
        function h(t) {
            var e = "timestamp=" + (new Date).getTime();
            return t + (t.indexOf("?") === -1 ? "?": "&") + e
        }
        function s(t, e) {
            if (t.naturalWidth && !$) return void e(t.naturalWidth, t.naturalHeight);
            var a = document.createElement("img");
            a.onload = function() {
                e(this.width, this.height)
            },
                a.src = t.src
        }
        function d(t) {
            var a = [],
                i = t.translateX,
                o = t.translateY,
                n = t.rotate,
                r = t.scaleX,
                h = t.scaleY;
            return e(i) && 0 !== i && a.push("translateX(" + i + "px)"),
            e(o) && 0 !== o && a.push("translateY(" + o + "px)"),
            e(n) && 0 !== n && a.push("rotate(" + n + "deg)"),
            e(r) && 1 !== r && a.push("scaleX(" + r + ")"),
            e(h) && 1 !== h && a.push("scaleY(" + h + ")"),
                a.length ? a.join(" ") : "none"
        }
        function c(t, e) {
            var a = Math.abs(t.degree) % 180,
                i = (a > 90 ? 180 - a: a) * Math.PI / 180,
                o = Math.sin(i),
                n = Math.cos(i),
                r = t.width,
                h = t.height,
                s = t.aspectRatio,
                d = void 0,
                c = void 0;
            return e ? (d = r / (n + o / s), c = d / s) : (d = r * n + h * o, c = r * o + h * n),
                {
                    width: d,
                    height: c
                }
        }
        function p(a, i) {
            var o = t("<canvas>")[0],
                n = o.getContext("2d"),
                r = 0,
                h = 0,
                s = i.naturalWidth,
                d = i.naturalHeight,
                p = i.rotate,
                l = i.scaleX,
                m = i.scaleY,
                g = e(l) && e(m) && (1 !== l || 1 !== m),
                f = e(p) && 0 !== p,
                u = f || g,
                v = s * Math.abs(l || 1),
                w = d * Math.abs(m || 1),
                x = void 0,
                b = void 0,
                y = void 0;
            return g && (x = v / 2, b = w / 2),
            f && (y = c({
                width: v,
                height: w,
                degree: p
            }), v = y.width, w = y.height, x = v / 2, b = w / 2),
                o.width = v,
                o.height = w,
            u && (r = -s / 2, h = -d / 2, n.save(), n.translate(x, b)),
            f && n.rotate(p * Math.PI / 180),
            g && n.scale(l, m),
                n.drawImage(a, Math.floor(r), Math.floor(h), Math.floor(s), Math.floor(d)),
            u && n.restore(),
                o
        }
        function l(t, e, a) {
            var i = "",
                o = void 0;
            for (o = e, a += e; o < a; o++) i += B(t.getUint8(o));
            return i
        }
        function m(t) {
            var e = new DataView(t),
                a = e.byteLength,
                i = void 0,
                o = void 0,
                n = void 0,
                r = void 0,
                h = void 0,
                s = void 0,
                d = void 0,
                c = void 0,
                p = void 0,
                m = void 0;
            if (255 === e.getUint8(0) && 216 === e.getUint8(1)) for (p = 2; p < a;) {
                if (255 === e.getUint8(p) && 225 === e.getUint8(p + 1)) {
                    d = p;
                    break
                }
                p++
            }
            if (d && (o = d + 4, n = d + 10, "Exif" === l(e, o, 4) && (s = e.getUint16(n), h = 18761 === s, (h || 19789 === s) && 42 === e.getUint16(n + 2, h) && (r = e.getUint32(n + 4, h), r >= 8 && (c = n + r)))), c) for (a = e.getUint16(c, h), m = 0; m < a; m++) if (p = c + 12 * m + 2, 274 === e.getUint16(p, h)) {
                p += 8,
                    i = e.getUint16(p, h),
                $ && e.setUint16(p, 1, h);
                break
            }
            return i
        }
        function g(t) {
            var e = t.replace(y, ""),
                a = atob(e),
                i = a.length,
                o = new ArrayBuffer(i),
                n = new Uint8Array(o),
                r = void 0;
            for (r = 0; r < i; r++) n[r] = a.charCodeAt(r);
            return o
        }
        function f(t) {
            var e = new Uint8Array(t),
                a = e.length,
                i = "",
                o = void 0;
            for (o = 0; o < a; o++) i += B(e[o]);
            return "data:image/jpeg;base64," + btoa(i)
        }
        function u(e, a) {
            var i = e.pageX,
                o = e.pageY,
                n = {
                    endX: i,
                    endY: o
                };
            return a ? n: t.extend({
                    startX: i,
                    startY: o
                },
                n)
        }
        function v(e) {
            var a = t.extend({},
                e),
                i = [];
            return t.each(e,
                function(e, o) {
                    delete a[e],
                        t.each(a,
                            function(t, e) {
                                var a = Math.abs(o.startX - e.startX),
                                    n = Math.abs(o.startY - e.startY),
                                    r = Math.abs(o.endX - e.endX),
                                    h = Math.abs(o.endY - e.endY),
                                    s = Math.sqrt(a * a + n * n),
                                    d = Math.sqrt(r * r + h * h),
                                    c = (d - s) / s;
                                i.push(c)
                            })
                }),
                i.sort(function(t, e) {
                    return Math.abs(t) < Math.abs(e)
                }),
                i[0]
        }
        function w(e) {
            var a = 0,
                i = 0,
                o = 0;
            return t.each(e,
                function(t, e) {
                    var n = e.startX,
                        r = e.startY;
                    a += n,
                        i += r,
                        o += 1
                }),
                a /= o,
                i /= o,
                {
                    pageX: a,
                    pageY: i
                }
        }
        t = "default" in t ? t.
                default:
            t;
        var x = {
                viewMode: 0,
                dragMode: "crop",
                aspectRatio: NaN,
                data: null,
                preview: "",
                responsive: !0,
                restore: !0,
                checkCrossOrigin: !0,
                checkOrientation: !0,
                modal: !0,
                guides: !0,
                center: !0,
                highlight: !0,
                background: !0,
                autoCrop: !0,
                autoCropArea: .8,
                movable: !0,
                rotatable: !0,
                scalable: !0,
                zoomable: !0,
                zoomOnTouch: !0,
                zoomOnWheel: !0,
                wheelZoomRatio: .1,
                cropBoxMovable: !0,
                cropBoxResizable: !0,
                toggleDragModeOnDblclick: !0,
                minCanvasWidth: 0,
                minCanvasHeight: 0,
                minCropBoxWidth: 0,
                minCropBoxHeight: 0,
                minContainerWidth: 200,
                minContainerHeight: 100,
                ready: null,
                cropstart: null,
                cropmove: null,
                cropend: null,
                crop: null,
                zoom: null
            },
            b = '<div class="cropper-container"><div class="cropper-wrap-box"><div class="cropper-canvas"></div></div><div class="cropper-drag-box"></div><div class="cropper-crop-box"><span class="cropper-view-box"></span><span class="cropper-dashed dashed-h"></span><span class="cropper-dashed dashed-v"></span><span class="cropper-center"></span><span class="cropper-face"></span><span class="cropper-line line-e" data-action="e"></span><span class="cropper-line line-n" data-action="n"></span><span class="cropper-line line-w" data-action="w"></span><span class="cropper-line line-s" data-action="s"></span><span class="cropper-point point-e" data-action="e"></span><span class="cropper-point point-n" data-action="n"></span><span class="cropper-point point-w" data-action="w"></span><span class="cropper-point point-s" data-action="s"></span><span class="cropper-point point-ne" data-action="ne"></span><span class="cropper-point point-nw" data-action="nw"></span><span class="cropper-point point-sw" data-action="sw"></span><span class="cropper-point point-se" data-action="se"></span></div></div>',
            y = /^data:.*,/,
            C = /(Macintosh|iPhone|iPod|iPad).*AppleWebKit/i,
            M = "undefined" != typeof window ? window.navigator: null,
            $ = M && C.test(M.userAgent),
            B = String.fromCharCode,
            k = {
                render: function() {
                    var t = this;
                    t.initContainer(),
                        t.initCanvas(),
                        t.initCropBox(),
                        t.renderCanvas(),
                    t.cropped && t.renderCropBox()
                },
                initContainer: function() {
                    var t = this,
                        e = t.options,
                        a = t.$element,
                        i = t.$container,
                        o = t.$cropper,
                        n = "cropper-hidden";
                    o.addClass(n),
                        a.removeClass(n),
                        o.css(t.container = {
                            width: Math.max(i.width(), Number(e.minContainerWidth) || 200),
                            height: Math.max(i.height(), Number(e.minContainerHeight) || 100)
                        }),
                        a.addClass(n),
                        o.removeClass(n)
                },
                initCanvas: function() {
                    var e = this,
                        a = e.options.viewMode,
                        i = e.container,
                        o = i.width,
                        n = i.height,
                        r = e.image,
                        h = r.naturalWidth,
                        s = r.naturalHeight,
                        d = Math.abs(r.rotate) % 180 === 90,
                        c = d ? s: h,
                        p = d ? h: s,
                        l = c / p,
                        m = o,
                        g = n;
                    n * l > o ? 3 === a ? m = n * l: g = o / l: 3 === a ? g = o / l: m = n * l;
                    var f = {
                        naturalWidth: c,
                        naturalHeight: p,
                        aspectRatio: l,
                        width: m,
                        height: g
                    };
                    f.oldLeft = f.left = (o - m) / 2,
                        f.oldTop = f.top = (n - g) / 2,
                        e.canvas = f,
                        e.limited = 1 === a || 2 === a,
                        e.limitCanvas(!0, !0),
                        e.initialImage = t.extend({},
                            r),
                        e.initialCanvas = t.extend({},
                            f)
                },
                limitCanvas: function(t, e) {
                    var a = this,
                        i = a.options,
                        o = i.viewMode,
                        n = a.container,
                        r = n.width,
                        h = n.height,
                        s = a.canvas,
                        d = s.aspectRatio,
                        c = a.cropBox,
                        p = a.cropped && c;
                    if (t) {
                        var l = Number(i.minCanvasWidth) || 0,
                            m = Number(i.minCanvasHeight) || 0;
                        o && (o > 1 ? (l = Math.max(l, r), m = Math.max(m, h), 3 === o && (m * d > l ? l = m * d: m = l / d)) : l ? l = Math.max(l, p ? c.width: 0) : m ? m = Math.max(m, p ? c.height: 0) : p && (l = c.width, m = c.height, m * d > l ? l = m * d: m = l / d)),
                            l && m ? m * d > l ? m = l / d: l = m * d: l ? m = l / d: m && (l = m * d),
                            s.minWidth = l,
                            s.minHeight = m,
                            s.maxWidth = 1 / 0,
                            s.maxHeight = 1 / 0
                    }
                    if (e) if (o) {
                        var g = r - s.width,
                            f = h - s.height;
                        s.minLeft = Math.min(0, g),
                            s.minTop = Math.min(0, f),
                            s.maxLeft = Math.max(0, g),
                            s.maxTop = Math.max(0, f),
                        p && a.limited && (s.minLeft = Math.min(c.left, c.left + c.width - s.width), s.minTop = Math.min(c.top, c.top + c.height - s.height), s.maxLeft = c.left, s.maxTop = c.top, 2 === o && (s.width >= r && (s.minLeft = Math.min(0, g), s.maxLeft = Math.max(0, g)), s.height >= h && (s.minTop = Math.min(0, f), s.maxTop = Math.max(0, f))))
                    } else s.minLeft = -s.width,
                        s.minTop = -s.height,
                        s.maxLeft = r,
                        s.maxTop = h
                },
                renderCanvas: function(t) {
                    var e = this,
                        a = e.canvas,
                        i = e.image,
                        o = i.rotate,
                        n = i.naturalWidth,
                        r = i.naturalHeight;
                    if (e.rotated) {
                        e.rotated = !1;
                        var h = c({
                                width: i.width,
                                height: i.height,
                                degree: o
                            }),
                            s = h.width / h.height,
                            p = 1 === i.aspectRatio;
                        if (p || s !== a.aspectRatio) {
                            if (a.left -= (h.width - a.width) / 2, a.top -= (h.height - a.height) / 2, a.width = h.width, a.height = h.height, a.aspectRatio = s, a.naturalWidth = n, a.naturalHeight = r, p && o % 90 || o % 180) {
                                var l = c({
                                    width: n,
                                    height: r,
                                    degree: o
                                });
                                a.naturalWidth = l.width,
                                    a.naturalHeight = l.height
                            }
                            e.limitCanvas(!0, !1)
                        }
                    } (a.width > a.maxWidth || a.width < a.minWidth) && (a.left = a.oldLeft),
                    (a.height > a.maxHeight || a.height < a.minHeight) && (a.top = a.oldTop),
                        a.width = Math.min(Math.max(a.width, a.minWidth), a.maxWidth),
                        a.heiclearRectght = Math.min(Math.max(a.height, a.minHeight), a.maxHeight),
                        e.limitCanvas(!1, !0),
                        a.oldLeft = a.left = Math.min(Math.max(a.left, a.minLeft), a.maxLeft),
                        a.oldTop = a.top = Math.min(Math.max(a.top, a.minTop), a.maxTop),
                        e.$canvas.css({
                            width: a.width,
                            height: a.height,
                            transform: d({
                                translateX: a.left,
                                translateY: a.top
                            })
                        }),
                        e.renderImage(),
                    e.cropped && e.limited && e.limitCropBox(!0, !0),
                    t && e.output()
                },
                renderImage: function(e) {
                    var a = this,
                        i = a.canvas,
                        o = a.image,
                        n = void 0;
                    o.rotate && (n = c({
                            width: i.width,
                            height: i.height,
                            degree: o.rotate,
                            aspectRatio: o.aspectRatio
                        },
                        !0)),
                        t.extend(o, n ? {
                            width: n.width,
                            height: n.height,
                            left: (i.width - n.width) / 2,
                            top: (i.height - n.height) / 2
                        }: {
                            width: i.width,
                            height: i.height,
                            left: 0,
                            top: 0
                        }),
                        a.$clone.css({
                            width: o.width,
                            height: o.height,
                            transform: d(t.extend({
                                    translateX: o.left,
                                    translateY: o.top
                                },
                                o))
                        }),
                    e && a.output()
                },
                initCropBox: function() {
                    var e = this,
                        a = e.options,
                        i = e.canvas,
                        o = a.aspectRatio,
                        n = Number(a.autoCropArea) || .8,
                        r = {
                            width: i.width,
                            height: i.height
                        };
                    o && (i.height * o > i.width ? r.height = r.width / o: r.width = r.height * o),
                        e.cropBox = r,
                        e.limitCropBox(!0, !0),
                        r.width = Math.min(Math.max(r.width, r.minWidth), r.maxWidth),
                        r.height = Math.min(Math.max(r.height, r.minHeight), r.maxHeight),
                        r.width = Math.max(r.minWidth, r.width * n),
                        r.height = Math.max(r.minHeight, r.height * n),
                        r.oldLeft = r.left = i.left + (i.width - r.width) / 2,
                        r.oldTop = r.top = i.top + (i.height - r.height) / 2,
                        e.initialCropBox = t.extend({},
                            r)
                },
                limitCropBox: function(t, e) {
                    var a = this,
                        i = a.options,
                        o = i.aspectRatio,
                        n = a.container,
                        r = n.width,
                        h = n.height,
                        s = a.canvas,
                        d = a.cropBox,
                        c = a.limited;
                    if (t) {
                        var p = Number(i.minCropBoxWidth) || 0,
                            l = Number(i.minCropBoxHeight) || 0,
                            m = Math.min(r, c ? s.width: r),
                            g = Math.min(h, c ? s.height: h);
                        p = Math.min(p, r),
                            l = Math.min(l, h),
                        o && (p && l ? l * o > p ? l = p / o: p = l * o: p ? l = p / o: l && (p = l * o), g * o > m ? g = m / o: m = g * o),
                            d.minWidth = Math.min(p, m),
                            d.minHeight = Math.min(l, g),
                            d.maxWidth = m,
                            d.maxHeight = g
                    }
                    e && (c ? (d.minLeft = Math.max(0, s.left), d.minTop = Math.max(0, s.top), d.maxLeft = Math.min(r, s.left + s.width) - d.width, d.maxTop = Math.min(h, s.top + s.height) - d.height) : (d.minLeft = 0, d.minTop = 0, d.maxLeft = r - d.width, d.maxTop = h - d.height))
                },
                renderCropBox: function() {
                    var t = this,
                        e = t.options,
                        a = t.container,
                        i = a.width,
                        o = a.height,
                        n = t.cropBox; (n.width > n.maxWidth || n.width < n.minWidth) && (n.left = n.oldLeft),
                    (n.height > n.maxHeight || n.height < n.minHeight) && (n.top = n.oldTop),
                        n.width = Math.min(Math.max(n.width, n.minWidth), n.maxWidth),
                        n.height = Math.min(Math.max(n.height, n.minHeight), n.maxHeight),
                        t.limitCropBox(!1, !0),
                        n.oldLeft = n.left = Math.min(Math.max(n.left, n.minLeft), n.maxLeft),
                        n.oldTop = n.top = Math.min(Math.max(n.top, n.minTop), n.maxTop),
                    e.movable && e.cropBoxMovable && t.$face.data("action", n.width === i && n.height === o ? "move": "all"),
                        t.$cropBox.css({
                            width: n.width,
                            height: n.height,
                            transform: d({
                                translateX: n.left,
                                translateY: n.top
                            })
                        }),
                    t.cropped && t.limited && t.limitCanvas(!0, !0),
                    t.disabled || t.output()
                },
                output: function() {
                    var t = this;
                    t.preview(),
                    t.completed && t.trigger("crop", t.getData())
                }
            },
            T = "preview",
            D = {
                initPreview: function() {
                    var e = this,
                        a = e.crossOrigin,
                        i = a ? e.crossOriginUrl: e.url,
                        o = document.createElement("img");
                    a && (o.crossOrigin = a),
                        o.src = i;
                    var n = t(o);
                    e.$preview = t(e.options.preview),
                        e.$clone2 = n,
                        e.$viewBox.html(n),
                        e.$preview.each(function(e, o) {
                            var n = t(o),
                                r = document.createElement("img");
                            n.data(T, {
                                width: n.width(),
                                height: n.height(),
                                html: n.html()
                            }),
                            a && (r.crossOrigin = a),
                                r.src = i,
                                r.style.cssText = 'display:block;width:100%;height:auto;min-width:0!important;min-height:0!important;max-width:none!important;max-height:none!important;image-orientation:0deg!important;"',
                                n.html(r)
                        })
                },
                resetPreview: function() {
                    this.$preview.each(function(e, a) {
                        var i = t(a),
                            o = i.data(T);
                        i.css({
                            width: o.width,
                            height: o.height
                        }).html(o.html).removeData(T)
                    })
                },
                preview: function() {
                    var e = this,
                        a = e.image,
                        i = e.canvas,
                        o = e.cropBox,
                        n = o.width,
                        r = o.height,
                        h = a.width,
                        s = a.height,
                        c = o.left - i.left - a.left,
                        p = o.top - i.top - a.top;
                    e.cropped && !e.disabled && (e.$clone2.css({
                        width: h,
                        height: s,
                        transform: d(t.extend({
                                translateX: -c,
                                translateY: -p
                            },
                            a))
                    }), e.$preview.each(function(e, i) {
                        var o = t(i),
                            l = o.data(T),
                            m = l.width,
                            g = l.height,
                            f = m,
                            u = g,
                            v = 1;
                        n && (v = m / n, u = r * v),
                        r && u > g && (v = g / r, f = n * v, u = g),
                            o.css({
                                width: f,
                                height: u
                            }).find("img").css({
                                width: h * v,
                                height: s * v,
                                transform: d(t.extend({
                                        translateX: -c * v,
                                        translateY: -p * v
                                    },
                                    a))
                            })
                    }))
                }
            },
            X = "undefined" != typeof window ? window.PointerEvent: null,
            Y = X ? "pointerdown": "touchstart mousedown",
            W = X ? "pointermove": "touchmove mousemove",
            H = X ? " pointerup pointercancel": "touchend touchcancel mouseup",
            O = "wheel mousewheel DOMMouseScroll",
            z = "dblclick",
            R = "resize",
            L = "cropstart",
            N = "cropmove",
            E = "cropend",
            I = "crop",
            P = "zoom",
            U = {
                bind: function() {
                    var e = this,
                        a = e.options,
                        i = e.$element,
                        n = e.$cropper;
                    t.isFunction(a.cropstart) && i.on(L, a.cropstart),
                    t.isFunction(a.cropmove) && i.on(N, a.cropmove),
                    t.isFunction(a.cropend) && i.on(E, a.cropend),
                    t.isFunction(a.crop) && i.on(I, a.crop),
                    t.isFunction(a.zoom) && i.on(P, a.zoom),
                        n.on(Y, o(e.cropStart, this)),
                    a.zoomable && a.zoomOnWheel && n.on(O, o(e.wheel, this)),
                    a.toggleDragModeOnDblclick && n.on(z, o(e.dblclick, this)),
                        t(document).on(W, e.onCropMove = o(e.cropMove, this)).on(H, e.onCropEnd = o(e.cropEnd, this)),
                    a.responsive && t(window).on(R, e.onResize = o(e.resize, this))
                },
                unbind: function() {
                    var e = this,
                        a = e.options,
                        i = e.$element,
                        o = e.$cropper;
                    t.isFunction(a.cropstart) && i.off(L, a.cropstart),
                    t.isFunction(a.cropmove) && i.off(N, a.cropmove),
                    t.isFunction(a.cropend) && i.off(E, a.cropend),
                    t.isFunction(a.crop) && i.off(I, a.crop),
                    t.isFunction(a.zoom) && i.off(P, a.zoom),
                        o.off(Y, e.cropStart),
                    a.zoomable && a.zoomOnWheel && o.off(O, e.wheel),
                    a.toggleDragModeOnDblclick && o.off(z, e.dblclick),
                        t(document).off(W, e.onCropMove).off(H, e.onCropEnd),
                    a.responsive && t(window).off(R, e.onResize)
                }
            },
            A = /^(e|w|s|n|se|sw|ne|nw|all|crop|move|zoom)$/,
            j = {
                resize: function() {
                    var e = this,
                        a = e.options,
                        i = e.$container,
                        o = e.container,
                        n = Number(a.minContainerWidth) || 200,
                        r = Number(a.minContainerHeight) || 100;
                    if (!e.disabled && o.width !== n && o.height !== r) {
                        var h = i.width() / o.width;
                        1 === h && i.height() === o.height || !
                            function() {
                                var i = void 0,
                                    o = void 0;
                                a.restore && (i = e.getCanvasData(), o = e.getCropBoxData()),
                                    e.render(),
                                a.restore && (e.setCanvasData(t.each(i,
                                    function(t, e) {
                                        i[t] = e * h
                                    })), e.setCropBoxData(t.each(o,
                                    function(t, e) {
                                        o[t] = e * h
                                    })))
                            } ()
                    }
                },
                dblclick: function() {
                    var t = this;
                    t.disabled || "none" === t.options.dragMode || t.setDragMode(t.$dragBox.hasClass("cropper-crop") ? "move": "crop")
                },
                wheel: function(t) {
                    var e = this,
                        a = t.originalEvent || t,
                        i = Number(e.options.wheelZoomRatio) || .1;
                    if (!e.disabled && (t.preventDefault(), !e.wheeling)) {
                        e.wheeling = !0,
                            setTimeout(function() {
                                    e.wheeling = !1
                                },
                                50);
                        var o = 1;
                        a.deltaY ? o = a.deltaY > 0 ? 1 : -1 : a.wheelDelta ? o = -a.wheelDelta / 120 : a.detail && (o = a.detail > 0 ? 1 : -1),
                            e.zoom( - o * i, t)
                    }
                },
                cropStart: function(e) {
                    var a = this;
                    if (!a.disabled) {
                        var i = a.options,
                            o = a.pointers,
                            r = e.originalEvent,
                            h = void 0;
                        r && r.changedTouches ? t.each(r.changedTouches,
                            function(t, e) {
                                o[e.identifier] = u(e)
                            }) : o[r && r.pointerId || 0] = u(r || e),
                            h = n(o).length > 1 && i.zoomable && i.zoomOnTouch ? "zoom": t(e.target).data("action"),
                        A.test(h) && (a.trigger("cropstart", {
                            originalEvent: r,
                            action: h
                        }).isDefaultPrevented() || (e.preventDefault(), a.action = h, a.cropping = !1, "crop" === h && (a.cropping = !0, a.$dragBox.addClass("cropper-modal"))))
                    }
                },
                cropMove: function(e) {
                    var a = this,
                        i = a.action;
                    if (!a.disabled && i) {
                        var o = a.pointers,
                            n = e.originalEvent;
                        e.preventDefault(),
                        a.trigger("cropmove", {
                            originalEvent: n,
                            action: i
                        }).isDefaultPrevented() || (n && n.changedTouches ? t.each(n.changedTouches,
                            function(e, a) {
                                t.extend(o[a.identifier], u(a, !0))
                            }) : t.extend(o[n && n.pointerId || 0], u(n || e, !0)), a.change(e))
                    }
                },
                cropEnd: function(e) {
                    var a = this;
                    if (!a.disabled) {
                        var i = a.action,
                            o = a.pointers,
                            r = e.originalEvent;
                        r && r.changedTouches ? t.each(r.changedTouches,
                            function(t, e) {
                                delete o[e.identifier]
                            }) : delete o[r && r.pointerId || 0],
                        i && (e.preventDefault(), n(o).length || (a.action = ""), a.cropping && (a.cropping = !1, a.$dragBox.toggleClass("cropper-modal", a.cropped && a.options.modal)), a.trigger("cropend", {
                            originalEvent: r,
                            action: i
                        }))
                    }
                }
            },
            F = "e",
            q = "w",
            S = "s",
            K = "n",
            Z = "se",
            Q = "sw",
            V = "ne",
            G = "nw",
            J = {
                change: function(e) {
                    var a = this,
                        i = a.options,
                        o = a.pointers,
                        r = o[n(o)[0]],
                        h = a.container,
                        s = a.canvas,
                        d = a.cropBox,
                        c = a.action,
                        p = i.aspectRatio,
                        l = d.width,
                        m = d.height,
                        g = d.left,
                        f = d.top,
                        u = g + l,
                        w = f + m,
                        x = 0,
                        b = 0,
                        y = h.width,
                        C = h.height,
                        M = !0,
                        $ = void 0; ! p && e.shiftKey && (p = l && m ? l / m: 1),
                    a.limited && (x = d.minLeft, b = d.minTop, y = x + Math.min(h.width, s.width, s.left + s.width), C = b + Math.min(h.height, s.height, s.top + s.height));
                    var B = {
                        x: r.endX - r.startX,
                        y: r.endY - r.startY
                    };
                    switch (p && (B.X = B.y * p, B.Y = B.x / p), c) {
                        case "all":
                            g += B.x,
                                f += B.y;
                            break;
                        case F:
                            if (B.x >= 0 && (u >= y || p && (f <= b || w >= C))) {
                                M = !1;
                                break
                            }
                            l += B.x,
                            p && (m = l / p, f -= B.Y / 2),
                            l < 0 && (c = q, l = 0);
                            break;
                        case K:
                            if (B.y <= 0 && (f <= b || p && (g <= x || u >= y))) {
                                M = !1;
                                break
                            }
                            m -= B.y,
                                f += B.y,
                            p && (l = m * p, g += B.X / 2),
                            m < 0 && (c = S, m = 0);
                            break;
                        case q:
                            if (B.x <= 0 && (g <= x || p && (f <= b || w >= C))) {
                                M = !1;
                                break
                            }
                            l -= B.x,
                                g += B.x,
                            p && (m = l / p, f += B.Y / 2),
                            l < 0 && (c = F, l = 0);
                            break;
                        case S:
                            if (B.y >= 0 && (w >= C || p && (g <= x || u >= y))) {
                                M = !1;
                                break
                            }
                            m += B.y,
                            p && (l = m * p, g -= B.X / 2),
                            m < 0 && (c = K, m = 0);
                            break;
                        case V:
                            if (p) {
                                if (B.y <= 0 && (f <= b || u >= y)) {
                                    M = !1;
                                    break
                                }
                                m -= B.y,
                                    f += B.y,
                                    l = m * p
                            } else B.x >= 0 ? u < y ? l += B.x: B.y <= 0 && f <= b && (M = !1) : l += B.x,
                                B.y <= 0 ? f > b && (m -= B.y, f += B.y) : (m -= B.y, f += B.y);
                            l < 0 && m < 0 ? (c = Q, m = 0, l = 0) : l < 0 ? (c = G, l = 0) : m < 0 && (c = Z, m = 0);
                            break;
                        case G:
                            if (p) {
                                if (B.y <= 0 && (f <= b || g <= x)) {
                                    M = !1;
                                    break
                                }
                                m -= B.y,
                                    f += B.y,
                                    l = m * p,
                                    g += B.X
                            } else B.x <= 0 ? g > x ? (l -= B.x, g += B.x) : B.y <= 0 && f <= b && (M = !1) : (l -= B.x, g += B.x),
                                B.y <= 0 ? f > b && (m -= B.y, f += B.y) : (m -= B.y, f += B.y);
                            l < 0 && m < 0 ? (c = Z, m = 0, l = 0) : l < 0 ? (c = V, l = 0) : m < 0 && (c = Q, m = 0);
                            break;
                        case Q:
                            if (p) {
                                if (B.x <= 0 && (g <= x || w >= C)) {
                                    M = !1;
                                    break
                                }
                                l -= B.x,
                                    g += B.x,
                                    m = l / p
                            } else B.x <= 0 ? g > x ? (l -= B.x, g += B.x) : B.y >= 0 && w >= C && (M = !1) : (l -= B.x, g += B.x),
                                B.y >= 0 ? w < C && (m += B.y) : m += B.y;
                            l < 0 && m < 0 ? (c = V, m = 0, l = 0) : l < 0 ? (c = Z, l = 0) : m < 0 && (c = G, m = 0);
                            break;
                        case Z:
                            if (p) {
                                if (B.x >= 0 && (u >= y || w >= C)) {
                                    M = !1;
                                    break
                                }
                                l += B.x,
                                    m = l / p
                            } else B.x >= 0 ? u < y ? l += B.x: B.y >= 0 && w >= C && (M = !1) : l += B.x,
                                B.y >= 0 ? w < C && (m += B.y) : m += B.y;
                            l < 0 && m < 0 ? (c = G, m = 0, l = 0) : l < 0 ? (c = Q, l = 0) : m < 0 && (c = V, m = 0);
                            break;
                        case "move":
                            a.move(B.x, B.y),
                                M = !1;
                            break;
                        case "zoom":
                            a.zoom(v(o), e.originalEvent),
                                M = !1;
                            break;
                        case "crop":
                            if (!B.x || !B.y) {
                                M = !1;
                                break
                            }
                            $ = a.$cropper.offset(),
                                g = r.startX - $.left,
                                f = r.startY - $.top,
                                l = d.minWidth,
                                m = d.minHeight,
                                B.x > 0 ? c = B.y > 0 ? Z: V: B.x < 0 && (g -= l, c = B.y > 0 ? Q: G),
                            B.y < 0 && (f -= m),
                            a.cropped || (a.$cropBox.removeClass("cropper-hidden"), a.cropped = !0, a.limited && a.limitCropBox(!0, !0))
                    }
                    M && (d.width = l, d.height = m, d.left = g, d.top = f, a.action = c, a.renderCropBox()),
                        t.each(o,
                            function(t, e) {
                                e.startX = e.endX,
                                    e.startY = e.endY
                            })
                }
            },
            _ = function(t, e) {
                if (! (t instanceof e)) throw new TypeError("Cannot call a class as a function")
            },
            tt = function() {
                function t(t, e) {
                    for (var a = 0; a < e.length; a++) {
                        var i = e[a];
                        i.enumerable = i.enumerable || !1,
                            i.configurable = !0,
                        "value" in i && (i.writable = !0),
                            Object.defineProperty(t, i.key, i)
                    }
                }
                return function(e, a, i) {
                    return a && t(e.prototype, a),
                    i && t(e, i),
                        e
                }
            } (),
            et = function(t) {
                if (Array.isArray(t)) {
                    for (var e = 0,
                             a = Array(t.length); e < t.length; e++) a[e] = t[e];
                    return a
                }
                return Array.from(t)
            },
            at = {
                crop: function() {
                    var t = this;
                    t.ready && !t.disabled && (t.cropped || (t.cropped = !0, t.limitCropBox(!0, !0), t.options.modal && t.$dragBox.addClass("cropper-modal"), t.$cropBox.removeClass("cropper-hidden")), t.setCropBoxData(t.initialCropBox))
                },
                reset: function() {
                    var e = this;
                    e.ready && !e.disabled && (e.image = t.extend({},
                        e.initialImage), e.canvas = t.extend({},
                        e.initialCanvas), e.cropBox = t.extend({},
                        e.initialCropBox), e.renderCanvas(), e.cropped && e.renderCropBox())
                },
                clear: function() {
                    var e = this;
                    e.cropped && !e.disabled && (t.extend(e.cropBox, {
                        left: 0,
                        top: 0,
                        width: 0,
                        height: 0
                    }), e.cropped = !1, e.renderCropBox(), e.limitCanvas(!0, !0), e.renderCanvas(), e.$dragBox.removeClass("cropper-modal"), e.$cropBox.addClass("cropper-hidden"))
                },
                replace: function(t, e) {
                    var a = this; ! a.disabled && t && (a.isImg && a.$element.attr("src", t), e ? (a.url = t, a.$clone.attr("src", t), a.ready && a.$preview.find("img").add(a.$clone2).attr("src", t)) : (a.isImg && (a.replaced = !0), a.options.data = null, a.load(t)))
                },
                enable: function() {
                    var t = this;
                    t.ready && (t.disabled = !1, t.$cropper.removeClass("cropper-disabled"))
                },
                disable: function() {
                    var t = this;
                    t.ready && (t.disabled = !0, t.$cropper.addClass("cropper-disabled"))
                },
                destroy: function() {
                    var t = this,
                        e = t.$element;
                    t.loaded ? (t.isImg && t.replaced && e.attr("src", t.originalUrl), t.unbuild(), e.removeClass("cropper-hidden")) : t.isImg ? e.off("load", t.start) : t.$clone && t.$clone.remove(),
                        e.removeData("cropper")
                },
                move: function(t, e) {
                    var i = this,
                        o = i.canvas;
                    i.moveTo(a(t) ? t: o.left + Number(t), a(e) ? e: o.top + Number(e))
                },
                moveTo: function(t, i) {
                    var o = this,
                        n = o.canvas,
                        r = !1;
                    a(i) && (i = t),
                        t = Number(t),
                        i = Number(i),
                    o.ready && !o.disabled && o.options.movable && (e(t) && (n.left = t, r = !0), e(i) && (n.top = i, r = !0), r && o.renderCanvas(!0))
                },
                zoom: function(t, e) {
                    var a = this,
                        i = a.canvas;
                    t = Number(t),
                        t = t < 0 ? 1 / (1 - t) : 1 + t,
                        a.zoomTo(i.width * t / i.naturalWidth, e)
                },
                zoomTo: function(t, e) {
                    var a = this,
                        i = a.options,
                        o = a.pointers,
                        r = a.canvas,
                        h = r.width,
                        s = r.height,
                        d = r.naturalWidth,
                        c = r.naturalHeight;
                    if (t = Number(t), t >= 0 && a.ready && !a.disabled && i.zoomable) {
                        var p = d * t,
                            l = c * t,
                            m = void 0;
                        if (e && (m = e.originalEvent), a.trigger("zoom", {
                            originalEvent: m,
                            oldRatio: h / d,
                            ratio: p / d
                        }).isDefaultPrevented()) return;
                        if (m) {
                            var g = a.$cropper.offset(),
                                f = o && n(o).length ? w(o) : {
                                    pageX: e.pageX || m.pageX || 0,
                                    pageY: e.pageY || m.pageY || 0
                                };
                            r.left -= (p - h) * ((f.pageX - g.left - r.left) / h),
                                r.top -= (l - s) * ((f.pageY - g.top - r.top) / s)
                        } else r.left -= (p - h) / 2,
                            r.top -= (l - s) / 2;
                        r.width = p,
                            r.height = l,
                            a.renderCanvas(!0)
                    }
                },
                rotate: function(t) {
                    var e = this;
                    e.rotateTo((e.image.rotate || 0) + Number(t))
                },
                rotateTo: function(t) {
                    var a = this;
                    t = Number(t),
                    e(t) && a.ready && !a.disabled && a.options.rotatable && (a.image.rotate = t % 360, a.rotated = !0, a.renderCanvas(!0))
                },
                scale: function(t, i) {
                    var o = this,
                        n = o.image,
                        r = !1;
                    a(i) && (i = t),
                        t = Number(t),
                        i = Number(i),
                    o.ready && !o.disabled && o.options.scalable && (e(t) && (n.scaleX = t, r = !0), e(i) && (n.scaleY = i, r = !0), r && o.renderImage(!0))
                },
                scaleX: function(t) {
                    var a = this,
                        i = a.image.scaleY;
                    a.scale(t, e(i) ? i: 1)
                },
                scaleY: function(t) {
                    var a = this,
                        i = a.image.scaleX;
                    a.scale(e(i) ? i: 1, t)
                },
                getData: function(e) {
                    var a = this,
                        i = a.options,
                        o = a.image,
                        n = a.canvas,
                        r = a.cropBox,
                        h = void 0,
                        s = void 0;
                    return a.ready && a.cropped ? (s = {
                        x: r.left - n.left,
                        y: r.top - n.top,
                        width: r.width,
                        height: r.height
                    },
                        h = o.width / o.naturalWidth, t.each(s,
                        function(t, a) {
                            a /= h,
                                s[t] = e ? Math.round(a) : a
                        })) : s = {
                        x: 0,
                        y: 0,
                        width: 0,
                        height: 0
                    },
                    i.rotatable && (s.rotate = o.rotate || 0),
                    i.scalable && (s.scaleX = o.scaleX || 1, s.scaleY = o.scaleY || 1),
                        s
                },
                setData: function(a) {
                    var i = this,
                        o = i.options,
                        n = i.image,
                        r = i.canvas,
                        h = {},
                        s = void 0,
                        d = void 0,
                        c = void 0;
                    t.isFunction(a) && (a = a.call(i.element)),
                    i.ready && !i.disabled && t.isPlainObject(a) && (o.rotatable && e(a.rotate) && a.rotate !== n.rotate && (n.rotate = a.rotate, i.rotated = s = !0), o.scalable && (e(a.scaleX) && a.scaleX !== n.scaleX && (n.scaleX = a.scaleX, d = !0), e(a.scaleY) && a.scaleY !== n.scaleY && (n.scaleY = a.scaleY, d = !0)), s ? i.renderCanvas() : d && i.renderImage(), c = n.width / n.naturalWidth, e(a.x) && (h.left = a.x * c + r.left), e(a.y) && (h.top = a.y * c + r.top), e(a.width) && (h.width = a.width * c), e(a.height) && (h.height = a.height * c), i.setCropBoxData(h))
                },
                getContainerData: function() {
                    return this.ready ? this.container: {}
                },
                getImageData: function() {
                    return this.loaded ? this.image: {}
                },
                getCanvasData: function() {
                    var e = this,
                        a = e.canvas,
                        i = {};
                    return e.ready && t.each(["left", "top", "width", "height", "naturalWidth", "naturalHeight"],
                        function(t, e) {
                            i[e] = a[e]
                        }),
                        i
                },
                setCanvasData: function(a) {
                    var i = this,
                        o = i.canvas,
                        n = o.aspectRatio;
                    t.isFunction(a) && (a = a.call(i.$element)),
                    i.ready && !i.disabled && t.isPlainObject(a) && (e(a.left) && (o.left = a.left), e(a.top) && (o.top = a.top), e(a.width) ? (o.width = a.width, o.height = a.width / n) : e(a.height) && (o.height = a.height, o.width = a.height * n), i.renderCanvas(!0))
                },
                getCropBoxData: function() {
                    var t = this,
                        e = t.cropBox;
                    return t.ready && t.cropped ? {
                        left: e.left,
                        top: e.top,
                        width: e.width,
                        height: e.height
                    }: {}
                },
                setCropBoxData: function(a) {
                    var i = this,
                        o = i.cropBox,
                        n = i.options.aspectRatio,
                        r = void 0,
                        h = void 0;
                    t.isFunction(a) && (a = a.call(i.$element)),
                    i.ready && i.cropped && !i.disabled && t.isPlainObject(a) && (e(a.left) && (o.left = a.left), e(a.top) && (o.top = a.top), e(a.width) && a.width !== o.width && (r = !0, o.width = a.width), e(a.height) && a.height !== o.height && (h = !0, o.height = a.height), n && (r ? o.height = o.width / n: h && (o.width = o.height * n)), i.renderCropBox())
                },
                getCroppedCanvas: function(e) {
                    var a = this;
                    if (!a.ready || !window.HTMLCanvasElement) return null;
                    if (!a.cropped) return p(a.$clone[0], a.image);
                    t.isPlainObject(e) || (e = {});
                    var i = a.getData(),
                        o = i.width,
                        n = i.height,
                        r = o / n,
                        h = void 0,
                        s = void 0,
                        d = void 0;
                    t.isPlainObject(e) && (h = e.width, s = e.height, h ? (s = h / r, d = h / o) : s && (h = s * r, d = s / n));
                    var c = Math.floor(h || o),
                        l = Math.floor(s || n),
                        m = t("<canvas>")[0],
                        g = m.getContext("2d");
                    m.width = c,
                        m.height = l,
                    e.fillColor && (g.fillStyle = e.fillColor, g.fillRect(0, 0, c, l));
                    var f = function() {
                        var t = p(a.$clone[0], a.image),
                            e = t.width,
                            r = t.height,
                            h = a.canvas,
                            s = [t],
                            c = i.x + h.naturalWidth * (Math.abs(i.scaleX || 1) - 1) / 2,
                            l = i.y + h.naturalHeight * (Math.abs(i.scaleY || 1) - 1) / 2,
                            m = void 0,
                            g = void 0,
                            f = void 0,
                            u = void 0,
                            v = void 0,
                            w = void 0;
                        return c <= -o || c > e ? c = m = f = v = 0 : c <= 0 ? (f = -c, c = 0, m = v = Math.min(e, o + c)) : c <= e && (f = 0, m = v = Math.min(o, e - c)),
                            m <= 0 || l <= -n || l > r ? l = g = u = w = 0 : l <= 0 ? (u = -l, l = 0, g = w = Math.min(r, n + l)) : l <= r && (u = 0, g = w = Math.min(n, r - l)),
                            s.push(Math.floor(c), Math.floor(l), Math.floor(m), Math.floor(g)),
                        d && (f *= d, u *= d, v *= d, w *= d),
                        v > 0 && w > 0 && s.push(Math.floor(f), Math.floor(u), Math.floor(v), Math.floor(w)),
                            s
                    } ();
                    return g.drawImage.apply(g, et(f)),
                        m
                },
                setAspectRatio: function(t) {
                    var e = this,
                        i = e.options;
                    e.disabled || a(t) || (i.aspectRatio = Math.max(0, t) || NaN, e.ready && (e.initCropBox(), e.cropped && e.renderCropBox()))
                },
                setDragMode: function(t) {
                    var e = this,
                        a = e.options,
                        i = void 0,
                        o = void 0;
                    e.loaded && !e.disabled && (i = "crop" === t, o = a.movable && "move" === t, t = i || o ? t: "none", e.$dragBox.data("action", t).toggleClass("cropper-crop", i).toggleClass("cropper-move", o), a.cropBoxMovable || e.$face.data("action", t).toggleClass("cropper-crop", i).toggleClass("cropper-move", o))
                }
            },
            it = "cropper-hidden",
            ot = /^data:/,
            nt = /^data:image\/jpeg;base64,/,
            rt = function() {
                function e(a, i) {
                    _(this, e);
                    var o = this;
                    o.$element = t(a),
                        o.options = t.extend({},
                            x, t.isPlainObject(i) && i),
                        o.loaded = !1,
                        o.ready = !1,
                        o.completed = !1,
                        o.rotated = !1,
                        o.cropped = !1,
                        o.disabled = !1,
                        o.replaced = !1,
                        o.limited = !1,
                        o.wheeling = !1,
                        o.isImg = !1,
                        o.originalUrl = "",
                        o.canvas = null,
                        o.cropBox = null,
                        o.pointers = {},
                        o.init()
                }
                return tt(e, [{
                    key: "init",
                    value: function() {
                        var t = this,
                            e = t.$element,
                            a = void 0;
                        if (e.is("img")) {
                            if (t.isImg = !0, t.originalUrl = a = e.attr("src"), !a) return;
                            a = e.prop("src")
                        } else e.is("canvas") && window.HTMLCanvasElement && (a = e[0].toDataURL());
                        t.load(a)
                    }
                },
                    {
                        key: "trigger",
                        value: function(e, a) {
                            var i = t.Event(e, a);
                            return this.$element.trigger(i),
                                i
                        }
                    },
                    {
                        key: "load",
                        value: function(e) {
                            var a = this,
                                i = a.options,
                                o = a.$element;
                            if (e) {
                                if (a.url = e, a.image = {},
                                !i.checkOrientation || !window.ArrayBuffer) return void a.clone();
                                if (ot.test(e)) return void(nt.test(e) ? a.read(g(e)) : a.clone());
                                var n = new XMLHttpRequest;
                                n.onerror = n.onabort = t.proxy(function() {
                                        a.clone()
                                    },
                                    this),
                                    n.onload = function() {
                                        a.read(this.response)
                                    },
                                i.checkCrossOrigin && r(e) && o.prop("crossOrigin") && (e = h(e)),
                                    n.open("get", e),
                                    n.responseType = "arraybuffer",
                                    n.withCredentials = "use-credentials" === o.prop("crossOrigin"),
                                    n.send()
                            }
                        }
                    },
                    {
                        key: "read",
                        value: function(t) {
                            var e = this,
                                a = e.options,
                                i = m(t),
                                o = e.image,
                                n = 0,
                                r = 1,
                                h = 1;
                            if (i > 1) switch (e.url = f(t), i) {
                                case 2:
                                    r = -1;
                                    break;
                                case 3:
                                    n = -180;
                                    break;
                                case 4:
                                    h = -1;
                                    break;
                                case 5:
                                    n = 90,
                                        h = -1;
                                    break;
                                case 6:
                                    n = 90;
                                    break;
                                case 7:
                                    n = 90,
                                        r = -1;
                                    break;
                                case 8:
                                    n = -90
                            }
                            a.rotatable && (o.rotate = n),
                            a.scalable && (o.scaleX = r, o.scaleY = h),
                                e.clone()
                        }
                    },
                    {
                        key: "clone",
                        value: function() {
                            var e = this,
                                a = e.options,
                                i = e.$element,
                                o = e.url,
                                n = "",
                                s = void 0;
                            a.checkCrossOrigin && r(o) && (n = i.prop("crossOrigin"), n ? s = o: (n = "anonymous", s = h(o))),
                                e.crossOrigin = n,
                                e.crossOriginUrl = s;
                            var d = document.createElement("img");
                            n && (d.crossOrigin = n),
                                d.src = s || o;
                            var c = t(d);
                            e.$clone = c,
                                e.isImg ? i[0].complete ? e.start() : i.one("load", t.proxy(e.start, this)) : c.one("load", t.proxy(e.start, this)).one("error", t.proxy(e.stop, this)).addClass("cropper-hide").insertAfter(i)
                        }
                    },
                    {
                        key: "start",
                        value: function() {
                            var e = this,
                                a = e.$clone,
                                i = e.$element;
                            e.isImg || (a.off("error", e.stop), i = a),
                                s(i[0],
                                    function(a, i) {
                                        t.extend(e.image, {
                                            naturalWidth: a,
                                            naturalHeight: i,
                                            aspectRatio: a / i
                                        }),
                                            e.loaded = !0,
                                            e.build()
                                    })
                        }
                    },
                    {
                        key: "stop",
                        value: function() {
                            var t = this;
                            t.$clone.remove(),
                                t.$clone = null
                        }
                    },
                    {
                        key: "build",
                        value: function() {
                            var e = this,
                                a = e.options,
                                i = e.$element,
                                o = e.$clone,
                                n = void 0,
                                r = void 0,
                                h = void 0;
                            e.loaded && (e.ready && e.unbuild(), e.$container = i.parent(), e.$cropper = n = t(b), e.$canvas = n.find(".cropper-canvas").append(o), e.$dragBox = n.find(".cropper-drag-box"), e.$cropBox = r = n.find(".cropper-crop-box"), e.$viewBox = n.find(".cropper-view-box"), e.$face = h = r.find(".cropper-face"), i.addClass(it).after(n), e.isImg || o.removeClass("cropper-hide"), e.initPreview(), e.bind(), a.aspectRatio = Math.max(0, a.aspectRatio) || NaN, a.viewMode = Math.max(0, Math.min(3, Math.round(a.viewMode))) || 0, e.cropped = a.autoCrop, a.autoCrop ? a.modal && e.$dragBox.addClass("cropper-modal") : r.addClass(it), a.guides || r.find(".cropper-dashed").addClass(it), a.center || r.find(".cropper-center").addClass(it), a.cropBoxMovable && h.addClass("cropper-move").data("action", "all"), a.highlight || h.addClass("cropper-invisible"), a.background && n.addClass("cropper-bg"), a.cropBoxResizable || r.find(".cropper-line, .cropper-point").addClass(it), e.setDragMode(a.dragMode), e.render(), e.ready = !0, e.setData(a.data), e.completing = setTimeout(function() {
                                    t.isFunction(a.ready) && i.one("ready", a.ready),
                                        e.trigger("ready"),
                                        e.trigger("crop", e.getData()),
                                        e.completed = !0
                                },
                                0))
                        }
                    },
                    {
                        key: "unbuild",
                        value: function() {
                            var t = this;
                            t.ready && (t.completed || clearTimeout(t.completing), t.ready = !1, t.completed = !1, t.initialImage = null, t.initialCanvas = null, t.initialCropBox = null, t.container = null, t.canvas = null, t.cropBox = null, t.unbind(), t.resetPreview(), t.$preview = null, t.$viewBox = null, t.$cropBox = null, t.$dragBox = null, t.$canvas = null, t.$container = null, t.$cropper.remove(), t.$cropper = null)
                        }
                    }], [{
                    key: "setDefaults",
                    value: function(e) {
                        t.extend(x, t.isPlainObject(e) && e)
                    }
                }]),
                    e
            } ();
        t.extend(rt.prototype, k),
            t.extend(rt.prototype, D),
            t.extend(rt.prototype, U),
            t.extend(rt.prototype, j),
            t.extend(rt.prototype, J),
            t.extend(rt.prototype, at);
        var ht = "cropper",
            st = t.fn.cropper;
        t.fn.cropper = function(e) {
            for (var a = arguments.length,
                     i = Array(a > 1 ? a - 1 : 0), o = 1; o < a; o++) i[o - 1] = arguments[o];
            var n = void 0;
            return this.each(function(a, o) {
                var r = t(o),
                    h = r.data(ht);
                if (!h) {
                    if (/destroy/.test(e)) return;
                    var s = t.extend({},
                        r.data(), t.isPlainObject(e) && e);
                    r.data(ht, h = new rt(o, s))
                }
                if ("string" == typeof e) {
                    var d = h[e];
                    t.isFunction(d) && (n = d.apply(h, i))
                }
            }),
                "undefined" != typeof n ? n: this
        },
            t.fn.cropper.Constructor = rt,
            t.fn.cropper.setDefaults = rt.setDefaults,
            t.fn.cropper.noConflict = function() {
                return t.fn.cropper = st,
                    this
            }
    });

