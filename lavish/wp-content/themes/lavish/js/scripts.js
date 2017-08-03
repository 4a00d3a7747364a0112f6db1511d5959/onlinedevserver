+ function(a) {
    "use strict";

    function b() {
        var a = document.createElement("bootstrap"),
            b = {
                WebkitTransition: "webkitTransitionEnd",
                MozTransition: "transitionend",
                OTransition: "oTransitionEnd otransitionend",
                transition: "transitionend"
            };
        for (var c in b)
            if (void 0 !== a.style[c]) return {
                end: b[c]
            };
        return !1
    }
    a.fn.emulateTransitionEnd = function(b) {
        var c = !1,
            d = this;
        a(this).one("bsTransitionEnd", function() {
            c = !0
        });
        var e = function() {
            c || a(d).trigger(a.support.transition.end)
        };
        return setTimeout(e, b), this
    }, a(function() {
        a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
            bindType: a.support.transition.end,
            delegateType: a.support.transition.end,
            handle: function(b) {
                if (a(b.target).is(this)) return b.handleObj.handler.apply(this, arguments)
            }
        })
    })
}(jQuery), + function(a) {
    "use strict";

    function b(b) {
        return this.each(function() {
            var c = a(this),
                e = c.data("bs.alert");
            e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c)
        })
    }
    var c = '[data-dismiss="alert"]',
        d = function(b) {
            a(b).on("click", c, this.close)
        };
    d.VERSION = "3.3.1", d.TRANSITION_DURATION = 150, d.prototype.close = function(b) {
        function c() {
            g.detach().trigger("closed.bs.alert").remove()
        }
        var e = a(this),
            f = e.attr("data-target");
        f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
        var g = a(f);
        b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c())
    };
    var e = a.fn.alert;
    a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function() {
        return a.fn.alert = e, this
    }, a(document).on("click.bs.alert.data-api", c, d.prototype.close)
}(jQuery), + function(a) {
    "use strict";

    function b(b) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.button"),
                f = "object" == typeof b && b;
            e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b)
        })
    }
    var c = function(b, d) {
        this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1
    };
    c.VERSION = "3.3.1", c.DEFAULTS = {
        loadingText: "loading..."
    }, c.prototype.setState = function(b) {
        var c = "disabled",
            d = this.$element,
            e = d.is("input") ? "val" : "html",
            f = d.data();
        b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function() {
            d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c))
        }, this), 0)
    }, c.prototype.toggle = function() {
        var a = !0,
            b = this.$element.closest('[data-toggle="buttons"]');
        if (b.length) {
            var c = this.$element.find("input");
            "radio" == c.prop("type") && (c.prop("checked") && this.$element.hasClass("active") ? a = !1 : b.find(".active").removeClass("active")), a && c.prop("checked", !this.$element.hasClass("active")).trigger("change")
        } else this.$element.attr("aria-pressed", !this.$element.hasClass("active"));
        a && this.$element.toggleClass("active")
    };
    var d = a.fn.button;
    a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function() {
        return a.fn.button = d, this
    }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function(c) {
        var d = a(c.target);
        d.hasClass("btn") || (d = d.closest(".btn")), b.call(d, "toggle"), c.preventDefault()
    }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function(b) {
        a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type))
    })
}(jQuery), + function(a) {
    "use strict";

    function b(b) {
        var c, d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");
        return a(d)
    }

    function c(b) {
        return this.each(function() {
            var c = a(this),
                e = c.data("bs.collapse"),
                f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
            !e && f.toggle && "show" == b && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]()
        })
    }
    var d = function(b, c) {
        this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a(this.options.trigger).filter('[href="#' + b.id + '"], [data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
    };
    d.VERSION = "3.3.1", d.TRANSITION_DURATION = 350, d.DEFAULTS = {
        toggle: !0,
        trigger: '[data-toggle="collapse"]'
    }, d.prototype.dimension = function() {
        var a = this.$element.hasClass("width");
        return a ? "width" : "height"
    }, d.prototype.show = function() {
        if (!this.transitioning && !this.$element.hasClass("in")) {
            var b, e = this.$parent && this.$parent.find("> .panel").children(".in, .collapsing");
            if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
                var f = a.Event("show.bs.collapse");
                if (this.$element.trigger(f), !f.isDefaultPrevented()) {
                    e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));
                    var g = this.dimension();
                    this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                    var h = function() {
                        this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                    };
                    if (!a.support.transition) return h.call(this);
                    var i = a.camelCase(["scroll", g].join("-"));
                    this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])
                }
            }
        }
    }, d.prototype.hide = function() {
        if (!this.transitioning && this.$element.hasClass("in")) {
            var b = a.Event("hide.bs.collapse");
            if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                var c = this.dimension();
                this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                var e = function() {
                    this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                };
                return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this)
            }
        }
    }, d.prototype.toggle = function() {
        this[this.$element.hasClass("in") ? "hide" : "show"]()
    }, d.prototype.getParent = function() {
        return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function(c, d) {
            var e = a(d);
            this.addAriaAndCollapsedClass(b(e), e)
        }, this)).end()
    }, d.prototype.addAriaAndCollapsedClass = function(a, b) {
        var c = a.hasClass("in");
        a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c)
    };
    var e = a.fn.collapse;
    a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function() {
        return a.fn.collapse = e, this
    }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(d) {
        var e = a(this);
        e.attr("data-target") || d.preventDefault();
        var f = b(e),
            g = f.data("bs.collapse"),
            h = g ? "toggle" : a.extend({}, e.data(), {
                trigger: this
            });
        c.call(f, h)
    })
}(jQuery), + function(a) {
    "use strict";

    function b(b) {
        b && 3 === b.which || (a(e).remove(), a(f).each(function() {
            var d = a(this),
                e = c(d),
                f = {
                    relatedTarget: this
                };
            e.hasClass("open") && (e.trigger(b = a.Event("hide.bs.dropdown", f)), b.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger("hidden.bs.dropdown", f)))
        }))
    }

    function c(b) {
        var c = b.attr("data-target");
        c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));
        var d = c && a(c);
        return d && d.length ? d : b.parent()
    }

    function d(b) {
        return this.each(function() {
            var c = a(this),
                d = c.data("bs.dropdown");
            d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c)
        })
    }
    var e = ".dropdown-backdrop",
        f = '[data-toggle="dropdown"]',
        g = function(b) {
            a(b).on("click.bs.dropdown", this.toggle)
        };
    g.VERSION = "3.3.1", g.prototype.toggle = function(d) {
        var e = a(this);
        if (!e.is(".disabled, :disabled")) {
            var f = c(e),
                g = f.hasClass("open");
            if (b(), !g) {
                "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click", b);
                var h = {
                    relatedTarget: this
                };
                if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;
                e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger("shown.bs.dropdown", h)
            }
            return !1
        }
    }, g.prototype.keydown = function(b) {
        if (/(38|40|27|32)/.test(b.which) && !/input|textarea/i.test(b.target.tagName)) {
            var d = a(this);
            if (b.preventDefault(), b.stopPropagation(), !d.is(".disabled, :disabled")) {
                var e = c(d),
                    g = e.hasClass("open");
                if (!g && 27 != b.which || g && 27 == b.which) return 27 == b.which && e.find(f).trigger("focus"), d.trigger("click");
                var h = " li:not(.divider):visible a",
                    i = e.find('[role="menu"]' + h + ', [role="listbox"]' + h);
                if (i.length) {
                    var j = i.index(b.target);
                    38 == b.which && j > 0 && j--, 40 == b.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus")
                }
            }
        }
    };
    var h = a.fn.dropdown;
    a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function() {
        return a.fn.dropdown = h, this
    }, a(document).on("click.bs.dropdown.data-api", b).on("click.bs.dropdown.data-api", ".dropdown form", function(a) {
        a.stopPropagation()
    }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="menu"]', g.prototype.keydown).on("keydown.bs.dropdown.data-api", '[role="listbox"]', g.prototype.keydown)
}(jQuery), + function(a) {
    "use strict";

    function b(b) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.tooltip"),
                f = "object" == typeof b && b,
                g = f && f.selector;
            (e || "destroy" != b) && (g ? (e || d.data("bs.tooltip", e = {}), e[g] || (e[g] = new c(this, f))) : e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }
    var c = function(a, b) {
        this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", a, b)
    };
    c.VERSION = "3.3.1", c.TRANSITION_DURATION = 150, c.DEFAULTS = {
        animation: !0,
        placement: "top",
        selector: !1,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: "hover focus",
        title: "",
        delay: 0,
        html: !1,
        container: !1,
        viewport: {
            selector: "body",
            padding: 0
        }
    }, c.prototype.init = function(b, c, d) {
        this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(this.options.viewport.selector || this.options.viewport);
        for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
            var g = e[f];
            if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));
            else if ("manual" != g) {
                var h = "hover" == g ? "mouseenter" : "focusin",
                    i = "hover" == g ? "mouseleave" : "focusout";
                this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this))
            }
        }
        this.options.selector ? this._options = a.extend({}, this.options, {
            trigger: "manual",
            selector: ""
        }) : this.fixTitle()
    }, c.prototype.getDefaults = function() {
        return c.DEFAULTS
    }, c.prototype.getOptions = function(b) {
        return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
            show: b.delay,
            hide: b.delay
        }), b
    }, c.prototype.getDelegateOptions = function() {
        var b = {},
            c = this.getDefaults();
        return this._options && a.each(this._options, function(a, d) {
            c[a] != d && (b[a] = d)
        }), b
    }, c.prototype.enter = function(b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c && c.$tip && c.$tip.is(":visible") ? void(c.hoverState = "in") : (c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void(c.timeout = setTimeout(function() {
            "in" == c.hoverState && c.show()
        }, c.options.delay.show)) : c.show())
    }, c.prototype.leave = function(b) {
        var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
        return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void(c.timeout = setTimeout(function() {
            "out" == c.hoverState && c.hide()
        }, c.options.delay.hide)) : c.hide()
    }, c.prototype.show = function() {
        var b = a.Event("show.bs." + this.type);
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(b);
            var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
            if (b.isDefaultPrevented() || !d) return;
            var e = this,
                f = this.tip(),
                g = this.getUID(this.type);
            this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");
            var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement,
                i = /\s?auto?\s?/i,
                j = i.test(h);
            j && (h = h.replace(i, "") || "top"), f.detach().css({
                top: 0,
                left: 0,
                display: "block"
            }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element);
            var k = this.getPosition(),
                l = f[0].offsetWidth,
                m = f[0].offsetHeight;
            if (j) {
                var n = h,
                    o = this.options.container ? a(this.options.container) : this.$element.parent(),
                    p = this.getPosition(o);
                h = "bottom" == h && k.bottom + m > p.bottom ? "top" : "top" == h && k.top - m < p.top ? "bottom" : "right" == h && k.right + l > p.width ? "left" : "left" == h && k.left - l < p.left ? "right" : h, f.removeClass(n).addClass(h)
            }
            var q = this.getCalculatedOffset(h, k, l, m);
            this.applyPlacement(q, h);
            var r = function() {
                var a = e.hoverState;
                e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e)
            };
            a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", r).emulateTransitionEnd(c.TRANSITION_DURATION) : r()
        }
    }, c.prototype.applyPlacement = function(b, c) {
        var d = this.tip(),
            e = d[0].offsetWidth,
            f = d[0].offsetHeight,
            g = parseInt(d.css("margin-top"), 10),
            h = parseInt(d.css("margin-left"), 10);
        isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top = b.top + g, b.left = b.left + h, a.offset.setOffset(d[0], a.extend({
            using: function(a) {
                d.css({
                    top: Math.round(a.top),
                    left: Math.round(a.left)
                })
            }
        }, b), 0), d.addClass("in");
        var i = d[0].offsetWidth,
            j = d[0].offsetHeight;
        "top" == c && j != f && (b.top = b.top + f - j);
        var k = this.getViewportAdjustedDelta(c, b, i, j);
        k.left ? b.left += k.left : b.top += k.top;
        var l = /top|bottom/.test(c),
            m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
            n = l ? "offsetWidth" : "offsetHeight";
        d.offset(b), this.replaceArrow(m, d[0][n], l)
    }, c.prototype.replaceArrow = function(a, b, c) {
        this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "")
    }, c.prototype.setContent = function() {
        var a = this.tip(),
            b = this.getTitle();
        a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right")
    }, c.prototype.hide = function(b) {
        function d() {
            "in" != e.hoverState && f.detach(), e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b()
        }
        var e = this,
            f = this.tip(),
            g = a.Event("hide.bs." + this.type);
        if (this.$element.trigger(g), !g.isDefaultPrevented()) return f.removeClass("in"), a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this
    }, c.prototype.fixTitle = function() {
        var a = this.$element;
        (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
    }, c.prototype.hasContent = function() {
        return this.getTitle()
    }, c.prototype.getPosition = function(b) {
        b = b || this.$element;
        var c = b[0],
            d = "BODY" == c.tagName,
            e = c.getBoundingClientRect();
        null == e.width && (e = a.extend({}, e, {
            width: e.right - e.left,
            height: e.bottom - e.top
        }));
        var f = d ? {
                top: 0,
                left: 0
            } : b.offset(),
            g = {
                scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop()
            },
            h = d ? {
                width: a(window).width(),
                height: a(window).height()
            } : null;
        return a.extend({}, e, g, h, f)
    }, c.prototype.getCalculatedOffset = function(a, b, c, d) {
        return "bottom" == a ? {
            top: b.top + b.height,
            left: b.left + b.width / 2 - c / 2
        } : "top" == a ? {
            top: b.top - d,
            left: b.left + b.width / 2 - c / 2
        } : "left" == a ? {
            top: b.top + b.height / 2 - d / 2,
            left: b.left - c
        } : {
            top: b.top + b.height / 2 - d / 2,
            left: b.left + b.width
        }
    }, c.prototype.getViewportAdjustedDelta = function(a, b, c, d) {
        var e = {
            top: 0,
            left: 0
        };
        if (!this.$viewport) return e;
        var f = this.options.viewport && this.options.viewport.padding || 0,
            g = this.getPosition(this.$viewport);
        if (/right|left/.test(a)) {
            var h = b.top - f - g.scroll,
                i = b.top + f - g.scroll + d;
            h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i)
        } else {
            var j = b.left - f,
                k = b.left + f + c;
            j < g.left ? e.left = g.left - j : k > g.width && (e.left = g.left + g.width - k)
        }
        return e
    }, c.prototype.getTitle = function() {
        var a, b = this.$element,
            c = this.options;
        return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title)
    }, c.prototype.getUID = function(a) {
        do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
        return a
    }, c.prototype.tip = function() {
        return this.$tip = this.$tip || a(this.options.template)
    }, c.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
    }, c.prototype.enable = function() {
        this.enabled = !0
    }, c.prototype.disable = function() {
        this.enabled = !1
    }, c.prototype.toggleEnabled = function() {
        this.enabled = !this.enabled
    }, c.prototype.toggle = function(b) {
        var c = this;
        b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
    }, c.prototype.destroy = function() {
        var a = this;
        clearTimeout(this.timeout), this.hide(function() {
            a.$element.off("." + a.type).removeData("bs." + a.type)
        })
    };
    var d = a.fn.tooltip;
    a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function() {
        return a.fn.tooltip = d, this
    }
}(jQuery), + function(a) {
    "use strict";

    function b(b) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.popover"),
                f = "object" == typeof b && b,
                g = f && f.selector;
            (e || "destroy" != b) && (g ? (e || d.data("bs.popover", e = {}), e[g] || (e[g] = new c(this, f))) : e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]())
        })
    }
    var c = function(a, b) {
        this.init("popover", a, b)
    };
    if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
    c.VERSION = "3.3.1", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
        placement: "right",
        trigger: "click",
        content: "",
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function() {
        return c.DEFAULTS
    }, c.prototype.setContent = function() {
        var a = this.tip(),
            b = this.getTitle(),
            c = this.getContent();
        a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide()
    }, c.prototype.hasContent = function() {
        return this.getTitle() || this.getContent()
    }, c.prototype.getContent = function() {
        var a = this.$element,
            b = this.options;
        return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
    }, c.prototype.arrow = function() {
        return this.$arrow = this.$arrow || this.tip().find(".arrow")
    }, c.prototype.tip = function() {
        return this.$tip || (this.$tip = a(this.options.template)), this.$tip
    };
    var d = a.fn.popover;
    a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function() {
        return a.fn.popover = d, this
    }
}(jQuery),
function(a, b) {
    var c, d = "superslides";
    c = function(c, d) {
        this.options = b.extend({
            play: !1,
            animation_speed: 600,
            animation_easing: "swing",
            animation: "slide",
            inherit_width_from: a,
            inherit_height_from: a,
            pagination: !0,
            hashchange: !1,
            scrollable: !0,
            elements: {
                preserve: ".preserve",
                nav: ".slides-navigation",
                container: ".slides-container",
                pagination: ".slides-pagination"
            }
        }, d);
        var e = this,
            f = b("<div>", {
                class: "slides-control"
            }),
            g = 1;
        this.$el = b(c), this.$container = this.$el.find(this.options.elements.container);
        var h = function() {
                return g = e._findMultiplier(), e.$el.on("click", e.options.elements.nav + " a", function(a) {
                    a.preventDefault(), e.stop(), b(this).hasClass("next") ? e.animate("next", function() {
                        e.start()
                    }) : e.animate("prev", function() {
                        e.start()
                    })
                }), b(document).on("keyup", function(a) {
                    37 === a.keyCode && e.animate("prev"), 39 === a.keyCode && e.animate("next")
                }), b(a).on("resize", function() {
                    setTimeout(function() {
                        var a = e.$container.children();
                        e.width = e._findWidth(), e.height = e._findHeight(), a.css({
                            width: e.width,
                            left: e.width
                        }), e.css.containers(), e.css.images()
                    }, 10)
                }), b(a).on("hashchange", function() {
                    var a, b = e._parseHash();
                    a = b && !isNaN(b) ? e._upcomingSlide(b - 1) : e._upcomingSlide(b), a >= 0 && a !== e.current && e.animate(a)
                }), e.pagination._events(), e.start(), e
            },
            i = {
                containers: function() {
                    e.init ? (e.$el.css({
                        height: e.height
                    }), e.$control.css({
                        width: e.width * g,
                        left: -e.width
                    }), e.$container.css({})) : (b("body").css({
                        margin: 0
                    }), e.$el.css({
                        position: "relative",
                        overflow: "hidden",
                        width: "100%",
                        height: e.height
                    }), e.$control.css({
                        position: "relative",
                        transform: "translate3d(0)",
                        height: "100%",
                        width: e.width * g,
                        left: -e.width
                    }), e.$container.css({
                        display: "none",
                        margin: "0",
                        padding: "0",
                        listStyle: "none",
                        position: "relative",
                        height: "100%"
                    })), 1 === e.size() && e.$el.find(e.options.elements.nav).hide()
                },
                images: function() {
                    var a = e.$container.find("img").not(e.options.elements.preserve);
                    a.removeAttr("width").removeAttr("height").css({
                        "-webkit-backface-visibility": "hidden",
                        "-ms-interpolation-mode": "bicubic",
                        position: "absolute",
                        left: "0",
                        top: "0",
                        "z-index": "-1",
                        "max-width": "none"
                    }), a.each(function() {
                        var a = e.image._aspectRatio(this),
                            c = this;
                        if (b.data(this, "processed")) e.image._scale(c, a), e.image._center(c, a);
                        else {
                            var d = new Image;
                            d.onload = function() {
                                e.image._scale(c, a), e.image._center(c, a), b.data(c, "processed", !0)
                            }, d.src = this.src
                        }
                    })
                },
                children: function() {
                    var a = e.$container.children();
                    a.is("img") && (a.each(function() {
                        if (b(this).is("img")) {
                            b(this).wrap("<div>");
                            var a = b(this).attr("id");
                            b(this).removeAttr("id"), b(this).parent().attr("id", a)
                        }
                    }), a = e.$container.children()), e.init || a.css({
                        display: "none",
                        left: 2 * e.width
                    }), a.css({
                        position: "absolute",
                        overflow: "hidden",
                        height: "100%",
                        width: e.width,
                        top: 0,
                        zIndex: 0
                    })
                }
            },
            j = {
                slide: function(a, b) {
                    var c = e.$container.children(),
                        d = c.eq(a.upcoming_slide);
                    d.css({
                        left: a.upcoming_position,
                        display: "block"
                    }), e.$control.animate({
                        left: a.offset
                    }, e.options.animation_speed, e.options.animation_easing, function() {
                        e.size() > 1 && (e.$control.css({
                            left: -e.width
                        }), c.eq(a.upcoming_slide).css({
                            left: e.width,
                            zIndex: 2
                        }), a.outgoing_slide >= 0 && c.eq(a.outgoing_slide).css({
                            left: e.width,
                            display: "none",
                            zIndex: 0
                        })), b()
                    })
                },
                fade: function(a, b) {
                    var c = this,
                        d = c.$container.children(),
                        e = d.eq(a.outgoing_slide),
                        f = d.eq(a.upcoming_slide);
                    f.css({
                        left: this.width,
                        opacity: 1,
                        display: "block"
                    }), a.outgoing_slide >= 0 ? e.animate({
                        opacity: 0
                    }, c.options.animation_speed, c.options.animation_easing, function() {
                        c.size() > 1 && (d.eq(a.upcoming_slide).css({
                            zIndex: 2
                        }), a.outgoing_slide >= 0 && d.eq(a.outgoing_slide).css({
                            opacity: 1,
                            display: "none",
                            zIndex: 0
                        })), b()
                    }) : (f.css({
                        zIndex: 2
                    }), b())
                }
            };
        j = b.extend(j, b.fn.superslides.fx);
        var k = {
                _centerY: function(a) {
                    var c = b(a);
                    c.css({
                        top: (e.height - c.height()) / 2
                    })
                },
                _centerX: function(a) {
                    var c = b(a);
                    c.css({
                        left: (e.width - c.width()) / 2
                    })
                },
                _center: function(a) {
                    e.image._centerX(a), e.image._centerY(a)
                },
                _aspectRatio: function(a) {
                    if (!a.naturalHeight && !a.naturalWidth) {
                        var b = new Image;
                        b.src = a.src, a.naturalHeight = b.height, a.naturalWidth = b.width
                    }
                    return a.naturalHeight / a.naturalWidth
                },
                _scale: function(a, c) {
                    c = c || e.image._aspectRatio(a);
                    var d = e.height / e.width,
                        f = b(a);
                    d > c ? f.css({
                        height: e.height,
                        width: e.height / c
                    }) : f.css({
                        height: e.width * c,
                        width: e.width
                    })
                }
            },
            l = {
                _setCurrent: function(a) {
                    if (e.$pagination) {
                        var b = e.$pagination.children();
                        b.removeClass("current"), b.eq(a).addClass("current")
                    }
                },
                _addItem: function(a) {
                    var c = a + 1,
                        d = c,
                        f = e.$container.children().eq(a),
                        g = f.attr("id");
                    g && (d = g);
                    var h = b("<a>", {
                        href: "#" + d,
                        text: d
                    });
                    h.appendTo(e.$pagination)
                },
                _setup: function() {
                    if (e.options.pagination && 1 !== e.size()) {
                        var a = b("<nav>", {
                            class: e.options.elements.pagination.replace(/^\./, "")
                        });
                        e.$pagination = a.appendTo(e.$el);
                        for (var c = 0; c < e.size(); c++) e.pagination._addItem(c)

                    }
                },
                _events: function() {
                    e.$el.on("click", e.options.elements.pagination + " a", function(a) {
                        a.preventDefault();
                        var b = e._parseHash(this.hash),
                            c = e._upcomingSlide(b - 1);
                        c !== e.current && e.animate(c, function() {
                            e.start()
                        })
                    })
                }
            };
        return this.css = i, this.image = k, this.pagination = l, this.fx = j, this.animation = this.fx[this.options.animation], this.$control = this.$container.wrap(f).parent(".slides-control"), e._findPositions(), e.width = e._findWidth(), e.height = e._findHeight(), this.css.children(), this.css.containers(), this.css.images(), this.pagination._setup(), h()
    }, c.prototype = {
        _findWidth: function() {
            return b(this.options.inherit_width_from).width()
        },
        _findHeight: function() {
            return b(this.options.inherit_height_from).height()
        },
        _findMultiplier: function() {
            return 1 === this.size() ? 1 : 3
        },
        _upcomingSlide: function(a) {
            if (/next/.test(a)) return this._nextInDom();
            if (/prev/.test(a)) return this._prevInDom();
            if (/\d/.test(a)) return +a;
            if (a && /\w/.test(a)) {
                var b = this._findSlideById(a);
                return b >= 0 ? b : 0
            }
            return 0
        },
        _findSlideById: function(a) {
            return this.$container.find("#" + a).index()
        },
        _findPositions: function(a, b) {
            b = b || this, void 0 === a && (a = -1), b.current = a, b.next = b._nextInDom(), b.prev = b._prevInDom()
        },
        _nextInDom: function() {
            var a = this.current + 1;
            return a === this.size() && (a = 0), a
        },
        _prevInDom: function() {
            var a = this.current - 1;
            return a < 0 && (a = this.size() - 1), a
        },
        _parseHash: function(b) {
            return b = b || a.location.hash, b = b.replace(/^#/, ""), b && !isNaN(+b) && (b = +b), b
        },
        size: function() {
            return this.$container.children().length
        },
        destroy: function() {
            return this.$el.removeData()
        },
        update: function() {
            this.css.children(), this.css.containers(), this.css.images(), this.pagination._addItem(this.size()), this._findPositions(this.current), this.$el.trigger("updated.slides")
        },
        stop: function() {
            clearInterval(this.play_id), delete this.play_id, this.$el.trigger("stopped.slides")
        },
        start: function() {
            var c = this;
            c.options.hashchange ? b(a).trigger("hashchange") : this.animate(), this.options.play && (this.play_id && this.stop(), this.play_id = setInterval(function() {
                c.animate()
            }, this.options.play)), this.$el.trigger("started.slides")
        },
        animate: function(b, c) {
            var d = this,
                e = {};
            if (!(this.animating || (this.animating = !0, void 0 === b && (b = "next"), e.upcoming_slide = this._upcomingSlide(b), e.upcoming_slide >= this.size()))) {
                if (e.outgoing_slide = this.current, e.upcoming_position = 2 * this.width, e.offset = -e.upcoming_position, ("prev" === b || b < e.outgoing_slide) && (e.upcoming_position = 0, e.offset = 0), d.size() > 1 && d.pagination._setCurrent(e.upcoming_slide), d.options.hashchange) {
                    var f = e.upcoming_slide + 1,
                        g = d.$container.children(":eq(" + e.upcoming_slide + ")").attr("id");
                    g ? a.location.hash = g : a.location.hash = f
                }
                d.$el.trigger("animating.slides", [e]), d.animation(e, function() {
                    d._findPositions(e.upcoming_slide, d), "function" == typeof c && c(), d.animating = !1, d.$el.trigger("animated.slides"), d.init || (d.$el.trigger("init.slides"), d.init = !0, d.$container.fadeIn("fast"))
                })
            }
        }
    }, b.fn[d] = function(a, e) {
        var f = [];
        return this.each(function() {
            var g, h, i;
            if (g = b(this), h = g.data(d), i = "object" == typeof a && a, h || (f = g.data(d, h = new c(this, i))), "string" == typeof a && (f = h[a], "function" == typeof f)) return f = f.call(h, e)
        }), f
    }, b.fn[d].fx = {}
}(this, jQuery),
function(a, b, c, d) {
    "use strict";

    function e(a, b, c) {
        return setTimeout(j(a, c), b)
    }

    function f(a, b, c) {
        return !!Array.isArray(a) && (g(a, c[b], c), !0)
    }

    function g(a, b, c) {
        var e;
        if (a)
            if (a.forEach) a.forEach(b, c);
            else if (a.length !== d)
            for (e = 0; e < a.length;) b.call(c, a[e], e, a), e++;
        else
            for (e in a) a.hasOwnProperty(e) && b.call(c, a[e], e, a)
    }

    function h(b, c, d) {
        var e = "DEPRECATED METHOD: " + c + "\n" + d + " AT \n";
        return function() {
            var c = new Error("get-stack-trace"),
                d = c && c.stack ? c.stack.replace(/^[^\(]+?[\n$]/gm, "").replace(/^\s+at\s+/gm, "").replace(/^Object.<anonymous>\s*\(/gm, "{anonymous}()@") : "Unknown Stack Trace",
                f = a.console && (a.console.warn || a.console.log);
            return f && f.call(a.console, e, d), b.apply(this, arguments)
        }
    }

    function i(a, b, c) {
        var d, e = b.prototype;
        d = a.prototype = Object.create(e), d.constructor = a, d._super = e, c && la(d, c)
    }

    function j(a, b) {
        return function() {
            return a.apply(b, arguments)
        }
    }

    function k(a, b) {
        return typeof a == oa ? a.apply(b ? b[0] || d : d, b) : a
    }

    function l(a, b) {
        return a === d ? b : a
    }

    function m(a, b, c) {
        g(q(b), function(b) {
            a.addEventListener(b, c, !1)
        })
    }

    function n(a, b, c) {
        g(q(b), function(b) {
            a.removeEventListener(b, c, !1)
        })
    }

    function o(a, b) {
        for (; a;) {
            if (a == b) return !0;
            a = a.parentNode
        }
        return !1
    }

    function p(a, b) {
        return a.indexOf(b) > -1
    }

    function q(a) {
        return a.trim().split(/\s+/g)
    }

    function r(a, b, c) {
        if (a.indexOf && !c) return a.indexOf(b);
        for (var d = 0; d < a.length;) {
            if (c && a[d][c] == b || !c && a[d] === b) return d;
            d++
        }
        return -1
    }

    function s(a) {
        return Array.prototype.slice.call(a, 0)
    }

    function t(a, b, c) {
        for (var d = [], e = [], f = 0; f < a.length;) {
            var g = b ? a[f][b] : a[f];
            r(e, g) < 0 && d.push(a[f]), e[f] = g, f++
        }
        return c && (d = b ? d.sort(function(a, c) {
            return a[b] > c[b]
        }) : d.sort()), d
    }

    function u(a, b) {
        for (var c, e, f = b[0].toUpperCase() + b.slice(1), g = 0; g < ma.length;) {
            if (c = ma[g], e = c ? c + f : b, e in a) return e;
            g++
        }
        return d
    }

    function v() {
        return ua++
    }

    function w(b) {
        var c = b.ownerDocument || b;
        return c.defaultView || c.parentWindow || a
    }

    function x(a, b) {
        var c = this;
        this.manager = a, this.callback = b, this.element = a.element, this.target = a.options.inputTarget, this.domHandler = function(b) {
            k(a.options.enable, [a]) && c.handler(b)
        }, this.init()
    }

    function y(a) {
        var b, c = a.options.inputClass;
        return new(b = c ? c : xa ? M : ya ? P : wa ? R : L)(a, z)
    }

    function z(a, b, c) {
        var d = c.pointers.length,
            e = c.changedPointers.length,
            f = b & Ea && d - e === 0,
            g = b & (Ga | Ha) && d - e === 0;
        c.isFirst = !!f, c.isFinal = !!g, f && (a.session = {}), c.eventType = b, A(a, c), a.emit("hammer.input", c), a.recognize(c), a.session.prevInput = c
    }

    function A(a, b) {
        var c = a.session,
            d = b.pointers,
            e = d.length;
        c.firstInput || (c.firstInput = D(b)), e > 1 && !c.firstMultiple ? c.firstMultiple = D(b) : 1 === e && (c.firstMultiple = !1);
        var f = c.firstInput,
            g = c.firstMultiple,
            h = g ? g.center : f.center,
            i = b.center = E(d);
        b.timeStamp = ra(), b.deltaTime = b.timeStamp - f.timeStamp, b.angle = I(h, i), b.distance = H(h, i), B(c, b), b.offsetDirection = G(b.deltaX, b.deltaY);
        var j = F(b.deltaTime, b.deltaX, b.deltaY);
        b.overallVelocityX = j.x, b.overallVelocityY = j.y, b.overallVelocity = qa(j.x) > qa(j.y) ? j.x : j.y, b.scale = g ? K(g.pointers, d) : 1, b.rotation = g ? J(g.pointers, d) : 0, b.maxPointers = c.prevInput ? b.pointers.length > c.prevInput.maxPointers ? b.pointers.length : c.prevInput.maxPointers : b.pointers.length, C(c, b);
        var k = a.element;
        o(b.srcEvent.target, k) && (k = b.srcEvent.target), b.target = k
    }

    function B(a, b) {
        var c = b.center,
            d = a.offsetDelta || {},
            e = a.prevDelta || {},
            f = a.prevInput || {};
        b.eventType !== Ea && f.eventType !== Ga || (e = a.prevDelta = {
            x: f.deltaX || 0,
            y: f.deltaY || 0
        }, d = a.offsetDelta = {
            x: c.x,
            y: c.y
        }), b.deltaX = e.x + (c.x - d.x), b.deltaY = e.y + (c.y - d.y)
    }

    function C(a, b) {
        var c, e, f, g, h = a.lastInterval || b,
            i = b.timeStamp - h.timeStamp;
        if (b.eventType != Ha && (i > Da || h.velocity === d)) {
            var j = b.deltaX - h.deltaX,
                k = b.deltaY - h.deltaY,
                l = F(i, j, k);
            e = l.x, f = l.y, c = qa(l.x) > qa(l.y) ? l.x : l.y, g = G(j, k), a.lastInterval = b
        } else c = h.velocity, e = h.velocityX, f = h.velocityY, g = h.direction;
        b.velocity = c, b.velocityX = e, b.velocityY = f, b.direction = g
    }

    function D(a) {
        for (var b = [], c = 0; c < a.pointers.length;) b[c] = {
            clientX: pa(a.pointers[c].clientX),
            clientY: pa(a.pointers[c].clientY)
        }, c++;
        return {
            timeStamp: ra(),
            pointers: b,
            center: E(b),
            deltaX: a.deltaX,
            deltaY: a.deltaY
        }
    }

    function E(a) {
        var b = a.length;
        if (1 === b) return {
            x: pa(a[0].clientX),
            y: pa(a[0].clientY)
        };
        for (var c = 0, d = 0, e = 0; e < b;) c += a[e].clientX, d += a[e].clientY, e++;
        return {
            x: pa(c / b),
            y: pa(d / b)
        }
    }

    function F(a, b, c) {
        return {
            x: b / a || 0,
            y: c / a || 0
        }
    }

    function G(a, b) {
        return a === b ? Ia : qa(a) >= qa(b) ? a < 0 ? Ja : Ka : b < 0 ? La : Ma
    }

    function H(a, b, c) {
        c || (c = Qa);
        var d = b[c[0]] - a[c[0]],
            e = b[c[1]] - a[c[1]];
        return Math.sqrt(d * d + e * e)
    }

    function I(a, b, c) {
        c || (c = Qa);
        var d = b[c[0]] - a[c[0]],
            e = b[c[1]] - a[c[1]];
        return 180 * Math.atan2(e, d) / Math.PI
    }

    function J(a, b) {
        return I(b[1], b[0], Ra) + I(a[1], a[0], Ra)
    }

    function K(a, b) {
        return H(b[0], b[1], Ra) / H(a[0], a[1], Ra)
    }

    function L() {
        this.evEl = Ta, this.evWin = Ua, this.pressed = !1, x.apply(this, arguments)
    }

    function M() {
        this.evEl = Xa, this.evWin = Ya, x.apply(this, arguments), this.store = this.manager.session.pointerEvents = []
    }

    function N() {
        this.evTarget = $a, this.evWin = _a, this.started = !1, x.apply(this, arguments)
    }

    function O(a, b) {
        var c = s(a.touches),
            d = s(a.changedTouches);
        return b & (Ga | Ha) && (c = t(c.concat(d), "identifier", !0)), [c, d]
    }

    function P() {
        this.evTarget = bb, this.targetIds = {}, x.apply(this, arguments)
    }

    function Q(a, b) {
        var c = s(a.touches),
            d = this.targetIds;
        if (b & (Ea | Fa) && 1 === c.length) return d[c[0].identifier] = !0, [c, c];
        var e, f, g = s(a.changedTouches),
            h = [],
            i = this.target;
        if (f = c.filter(function(a) {
                return o(a.target, i)
            }), b === Ea)
            for (e = 0; e < f.length;) d[f[e].identifier] = !0, e++;
        for (e = 0; e < g.length;) d[g[e].identifier] && h.push(g[e]), b & (Ga | Ha) && delete d[g[e].identifier], e++;
        return h.length ? [t(f.concat(h), "identifier", !0), h] : void 0
    }

    function R() {
        x.apply(this, arguments);
        var a = j(this.handler, this);
        this.touch = new P(this.manager, a), this.mouse = new L(this.manager, a), this.primaryTouch = null, this.lastTouches = []
    }

    function S(a, b) {
        a & Ea ? (this.primaryTouch = b.changedPointers[0].identifier, T.call(this, b)) : a & (Ga | Ha) && T.call(this, b)
    }

    function T(a) {
        var b = a.changedPointers[0];
        if (b.identifier === this.primaryTouch) {
            var c = {
                x: b.clientX,
                y: b.clientY
            };
            this.lastTouches.push(c);
            var d = this.lastTouches,
                e = function() {
                    var a = d.indexOf(c);
                    a > -1 && d.splice(a, 1)
                };
            setTimeout(e, cb)
        }
    }

    function U(a) {
        for (var b = a.srcEvent.clientX, c = a.srcEvent.clientY, d = 0; d < this.lastTouches.length; d++) {
            var e = this.lastTouches[d],
                f = Math.abs(b - e.x),
                g = Math.abs(c - e.y);
            if (f <= db && g <= db) return !0
        }
        return !1
    }

    function V(a, b) {
        this.manager = a, this.set(b)
    }

    function W(a) {
        if (p(a, jb)) return jb;
        var b = p(a, kb),
            c = p(a, lb);
        return b && c ? jb : b || c ? b ? kb : lb : p(a, ib) ? ib : hb
    }

    function X() {
        if (!fb) return !1;
        var b = {},
            c = a.CSS && a.CSS.supports;
        return ["auto", "manipulation", "pan-y", "pan-x", "pan-x pan-y", "none"].forEach(function(d) {
            b[d] = !c || a.CSS.supports("touch-action", d)
        }), b
    }

    function Y(a) {
        this.options = la({}, this.defaults, a || {}), this.id = v(), this.manager = null, this.options.enable = l(this.options.enable, !0), this.state = nb, this.simultaneous = {}, this.requireFail = []
    }

    function Z(a) {
        return a & sb ? "cancel" : a & qb ? "end" : a & pb ? "move" : a & ob ? "start" : ""
    }

    function $(a) {
        return a == Ma ? "down" : a == La ? "up" : a == Ja ? "left" : a == Ka ? "right" : ""
    }

    function _(a, b) {
        var c = b.manager;
        return c ? c.get(a) : a
    }

    function aa() {
        Y.apply(this, arguments)
    }

    function ba() {
        aa.apply(this, arguments), this.pX = null, this.pY = null
    }

    function ca() {
        aa.apply(this, arguments)
    }

    function da() {
        Y.apply(this, arguments), this._timer = null, this._input = null
    }

    function ea() {
        aa.apply(this, arguments)
    }

    function fa() {
        aa.apply(this, arguments)
    }

    function ga() {
        Y.apply(this, arguments), this.pTime = !1, this.pCenter = !1, this._timer = null, this._input = null, this.count = 0
    }

    function ha(a, b) {
        return b = b || {}, b.recognizers = l(b.recognizers, ha.defaults.preset), new ia(a, b)
    }

    function ia(a, b) {
        this.options = la({}, ha.defaults, b || {}), this.options.inputTarget = this.options.inputTarget || a, this.handlers = {}, this.session = {}, this.recognizers = [], this.oldCssProps = {}, this.element = a, this.input = y(this), this.touchAction = new V(this, this.options.touchAction), ja(this, !0), g(this.options.recognizers, function(a) {
            var b = this.add(new a[0](a[1]));
            a[2] && b.recognizeWith(a[2]), a[3] && b.requireFailure(a[3])
        }, this)
    }

    function ja(a, b) {
        var c = a.element;
        if (c.style) {
            var d;
            g(a.options.cssProps, function(e, f) {
                d = u(c.style, f), b ? (a.oldCssProps[d] = c.style[d], c.style[d] = e) : c.style[d] = a.oldCssProps[d] || ""
            }), b || (a.oldCssProps = {})
        }
    }

    function ka(a, c) {
        var d = b.createEvent("Event");
        d.initEvent(a, !0, !0), d.gesture = c, c.target.dispatchEvent(d)
    }
    var la, ma = ["", "webkit", "Moz", "MS", "ms", "o"],
        na = b.createElement("div"),
        oa = "function",
        pa = Math.round,
        qa = Math.abs,
        ra = Date.now;
    la = "function" != typeof Object.assign ? function(a) {
        if (a === d || null === a) throw new TypeError("Cannot convert undefined or null to object");
        for (var b = Object(a), c = 1; c < arguments.length; c++) {
            var e = arguments[c];
            if (e !== d && null !== e)
                for (var f in e) e.hasOwnProperty(f) && (b[f] = e[f])
        }
        return b
    } : Object.assign;
    var sa = h(function(a, b, c) {
            for (var e = Object.keys(b), f = 0; f < e.length;)(!c || c && a[e[f]] === d) && (a[e[f]] = b[e[f]]), f++;
            return a
        }, "extend", "Use `assign`."),
        ta = h(function(a, b) {
            return sa(a, b, !0)
        }, "merge", "Use `assign`."),
        ua = 1,
        va = /mobile|tablet|ip(ad|hone|od)|android/i,
        wa = "ontouchstart" in a,
        xa = u(a, "PointerEvent") !== d,
        ya = wa && va.test(navigator.userAgent),
        za = "touch",
        Aa = "pen",
        Ba = "mouse",
        Ca = "kinect",
        Da = 25,
        Ea = 1,
        Fa = 2,
        Ga = 4,
        Ha = 8,
        Ia = 1,
        Ja = 2,
        Ka = 4,
        La = 8,
        Ma = 16,
        Na = Ja | Ka,
        Oa = La | Ma,
        Pa = Na | Oa,
        Qa = ["x", "y"],
        Ra = ["clientX", "clientY"];
    x.prototype = {
        handler: function() {},
        init: function() {
            this.evEl && m(this.element, this.evEl, this.domHandler), this.evTarget && m(this.target, this.evTarget, this.domHandler), this.evWin && m(w(this.element), this.evWin, this.domHandler)
        },
        destroy: function() {
            this.evEl && n(this.element, this.evEl, this.domHandler), this.evTarget && n(this.target, this.evTarget, this.domHandler), this.evWin && n(w(this.element), this.evWin, this.domHandler)
        }
    };
    var Sa = {
            mousedown: Ea,
            mousemove: Fa,
            mouseup: Ga
        },
        Ta = "mousedown",
        Ua = "mousemove mouseup";
    i(L, x, {
        handler: function(a) {
            var b = Sa[a.type];
            b & Ea && 0 === a.button && (this.pressed = !0), b & Fa && 1 !== a.which && (b = Ga), this.pressed && (b & Ga && (this.pressed = !1), this.callback(this.manager, b, {
                pointers: [a],
                changedPointers: [a],
                pointerType: Ba,
                srcEvent: a
            }))
        }
    });
    var Va = {
            pointerdown: Ea,
            pointermove: Fa,
            pointerup: Ga,
            pointercancel: Ha,
            pointerout: Ha
        },
        Wa = {
            2: za,
            3: Aa,
            4: Ba,
            5: Ca

        },
        Xa = "pointerdown",
        Ya = "pointermove pointerup pointercancel";
    a.MSPointerEvent && !a.PointerEvent && (Xa = "MSPointerDown", Ya = "MSPointerMove MSPointerUp MSPointerCancel"), i(M, x, {
        handler: function(a) {
            var b = this.store,
                c = !1,
                d = a.type.toLowerCase().replace("ms", ""),
                e = Va[d],
                f = Wa[a.pointerType] || a.pointerType,
                g = f == za,
                h = r(b, a.pointerId, "pointerId");
            e & Ea && (0 === a.button || g) ? h < 0 && (b.push(a), h = b.length - 1) : e & (Ga | Ha) && (c = !0), h < 0 || (b[h] = a, this.callback(this.manager, e, {
                pointers: b,
                changedPointers: [a],
                pointerType: f,
                srcEvent: a
            }), c && b.splice(h, 1))
        }
    });
    var Za = {
            touchstart: Ea,
            touchmove: Fa,
            touchend: Ga,
            touchcancel: Ha
        },
        $a = "touchstart",
        _a = "touchstart touchmove touchend touchcancel";
    i(N, x, {
        handler: function(a) {
            var b = Za[a.type];
            if (b === Ea && (this.started = !0), this.started) {
                var c = O.call(this, a, b);
                b & (Ga | Ha) && c[0].length - c[1].length === 0 && (this.started = !1), this.callback(this.manager, b, {
                    pointers: c[0],
                    changedPointers: c[1],
                    pointerType: za,
                    srcEvent: a
                })
            }
        }
    });
    var ab = {
            touchstart: Ea,
            touchmove: Fa,
            touchend: Ga,
            touchcancel: Ha
        },
        bb = "touchstart touchmove touchend touchcancel";
    i(P, x, {
        handler: function(a) {
            var b = ab[a.type],
                c = Q.call(this, a, b);
            c && this.callback(this.manager, b, {
                pointers: c[0],
                changedPointers: c[1],
                pointerType: za,
                srcEvent: a
            })
        }
    });
    var cb = 2500,
        db = 25;
    i(R, x, {
        handler: function(a, b, c) {
            var d = c.pointerType == za,
                e = c.pointerType == Ba;
            if (!(e && c.sourceCapabilities && c.sourceCapabilities.firesTouchEvents)) {
                if (d) S.call(this, b, c);
                else if (e && U.call(this, c)) return;
                this.callback(a, b, c)
            }
        },
        destroy: function() {
            this.touch.destroy(), this.mouse.destroy()
        }
    });
    var eb = u(na.style, "touchAction"),
        fb = eb !== d,
        gb = "compute",
        hb = "auto",
        ib = "manipulation",
        jb = "none",
        kb = "pan-x",
        lb = "pan-y",
        mb = X();
    V.prototype = {
        set: function(a) {
            a == gb && (a = this.compute()), fb && this.manager.element.style && mb[a] && (this.manager.element.style[eb] = a), this.actions = a.toLowerCase().trim()
        },
        update: function() {
            this.set(this.manager.options.touchAction)
        },
        compute: function() {
            var a = [];
            return g(this.manager.recognizers, function(b) {
                k(b.options.enable, [b]) && (a = a.concat(b.getTouchAction()))
            }), W(a.join(" "))
        },
        preventDefaults: function(a) {
            var b = a.srcEvent,
                c = a.offsetDirection;
            if (this.manager.session.prevented) return void b.preventDefault();
            var d = this.actions,
                e = p(d, jb) && !mb[jb],
                f = p(d, lb) && !mb[lb],
                g = p(d, kb) && !mb[kb];
            if (e) {
                var h = 1 === a.pointers.length,
                    i = a.distance < 2,
                    j = a.deltaTime < 250;
                if (h && i && j) return
            }

            return g && f ? void 0 : e || f && c & Na || g && c & Oa ? this.preventSrc(b) : void 0
        },
        preventSrc: function(a) {
            this.manager.session.prevented = !0, a.preventDefault()
        }
    };
    var nb = 1,
        ob = 2,
        pb = 4,
        qb = 8,
        rb = qb,
        sb = 16,
        tb = 32;
    Y.prototype = {
        defaults: {},
        set: function(a) {
            return la(this.options, a), this.manager && this.manager.touchAction.update(), this
        },
        recognizeWith: function(a) {
            if (f(a, "recognizeWith", this)) return this;
            var b = this.simultaneous;
            return a = _(a, this), b[a.id] || (b[a.id] = a, a.recognizeWith(this)), this
        },
        dropRecognizeWith: function(a) {
            return f(a, "dropRecognizeWith", this) ? this : (a = _(a, this), delete this.simultaneous[a.id], this)
        },
        requireFailure: function(a) {
            if (f(a, "requireFailure", this)) return this;
            var b = this.requireFail;
            return a = _(a, this), r(b, a) === -1 && (b.push(a), a.requireFailure(this)), this
        },
        dropRequireFailure: function(a) {
            if (f(a, "dropRequireFailure", this)) return this;
            a = _(a, this);
            var b = r(this.requireFail, a);
            return b > -1 && this.requireFail.splice(b, 1), this
        },
        hasRequireFailures: function() {
            return this.requireFail.length > 0
        },
        canRecognizeWith: function(a) {
            return !!this.simultaneous[a.id]
        },
        emit: function(a) {
            function b(b) {
                c.manager.emit(b, a)
            }
            var c = this,
                d = this.state;
            d < qb && b(c.options.event + Z(d)), b(c.options.event), a.additionalEvent && b(a.additionalEvent), d >= qb && b(c.options.event + Z(d))
        },
        tryEmit: function(a) {
            return this.canEmit() ? this.emit(a) : void(this.state = tb)
        },
        canEmit: function() {
            for (var a = 0; a < this.requireFail.length;) {
                if (!(this.requireFail[a].state & (tb | nb))) return !1;
                a++
            }
            return !0
        },
        recognize: function(a) {
            var b = la({}, a);
            return k(this.options.enable, [this, b]) ? (this.state & (rb | sb | tb) && (this.state = nb), this.state = this.process(b), void(this.state & (ob | pb | qb | sb) && this.tryEmit(b))) : (this.reset(), void(this.state = tb))
        },
        process: function(a) {},
        getTouchAction: function() {},
        reset: function() {}
    }, i(aa, Y, {
        defaults: {
            pointers: 1
        },
        attrTest: function(a) {
            var b = this.options.pointers;
            return 0 === b || a.pointers.length === b
        },
        process: function(a) {
            var b = this.state,
                c = a.eventType,
                d = b & (ob | pb),
                e = this.attrTest(a);
            return d && (c & Ha || !e) ? b | sb : d || e ? c & Ga ? b | qb : b & ob ? b | pb : ob : tb
        }
    }), i(ba, aa, {
        defaults: {
            event: "pan",
            threshold: 10,
            pointers: 1,
            direction: Pa
        },
        getTouchAction: function() {
            var a = this.options.direction,
                b = [];
            return a & Na && b.push(lb), a & Oa && b.push(kb), b
        },
        directionTest: function(a) {
            var b = this.options,
                c = !0,
                d = a.distance,
                e = a.direction,
                f = a.deltaX,
                g = a.deltaY;
            return e & b.direction || (b.direction & Na ? (e = 0 === f ? Ia : f < 0 ? Ja : Ka, c = f != this.pX, d = Math.abs(a.deltaX)) : (e = 0 === g ? Ia : g < 0 ? La : Ma, c = g != this.pY, d = Math.abs(a.deltaY))), a.direction = e, c && d > b.threshold && e & b.direction
        },
        attrTest: function(a) {
            return aa.prototype.attrTest.call(this, a) && (this.state & ob || !(this.state & ob) && this.directionTest(a))
        },
        emit: function(a) {
            this.pX = a.deltaX, this.pY = a.deltaY;
            var b = $(a.direction);
            b && (a.additionalEvent = this.options.event + b), this._super.emit.call(this, a)
        }
    }), i(ca, aa, {
        defaults: {
            event: "pinch",
            threshold: 0,
            pointers: 2
        },
        getTouchAction: function() {
            return [jb]
        },
        attrTest: function(a) {
            return this._super.attrTest.call(this, a) && (Math.abs(a.scale - 1) > this.options.threshold || this.state & ob)
        },
        emit: function(a) {
            if (1 !== a.scale) {
                var b = a.scale < 1 ? "in" : "out";
                a.additionalEvent = this.options.event + b
            }
            this._super.emit.call(this, a)
        }
    }), i(da, Y, {
        defaults: {
            event: "press",
            pointers: 1,
            time: 251,
            threshold: 9
        },
        getTouchAction: function() {
            return [hb]
        },
        process: function(a) {
            var b = this.options,
                c = a.pointers.length === b.pointers,
                d = a.distance < b.threshold,
                f = a.deltaTime > b.time;
            if (this._input = a, !d || !c || a.eventType & (Ga | Ha) && !f) this.reset();
            else if (a.eventType & Ea) this.reset(), this._timer = e(function() {
                this.state = rb, this.tryEmit()
            }, b.time, this);
            else if (a.eventType & Ga) return rb;
            return tb
        },
        reset: function() {
            clearTimeout(this._timer)
        },
        emit: function(a) {
            this.state === rb && (a && a.eventType & Ga ? this.manager.emit(this.options.event + "up", a) : (this._input.timeStamp = ra(), this.manager.emit(this.options.event, this._input)))
        }
    }), i(ea, aa, {
        defaults: {
            event: "rotate",
            threshold: 0,
            pointers: 2
        },
        getTouchAction: function() {
            return [jb]
        },
        attrTest: function(a) {
            return this._super.attrTest.call(this, a) && (Math.abs(a.rotation) > this.options.threshold || this.state & ob)
        }
    }), i(fa, aa, {
        defaults: {
            event: "swipe",
            threshold: 10,
            velocity: .3,
            direction: Na | Oa,
            pointers: 1
        },
        getTouchAction: function() {
            return ba.prototype.getTouchAction.call(this)
        },
        attrTest: function(a) {
            var b, c = this.options.direction;
            return c & (Na | Oa) ? b = a.overallVelocity : c & Na ? b = a.overallVelocityX : c & Oa && (b = a.overallVelocityY), this._super.attrTest.call(this, a) && c & a.offsetDirection && a.distance > this.options.threshold && a.maxPointers == this.options.pointers && qa(b) > this.options.velocity && a.eventType & Ga
        },
        emit: function(a) {
            var b = $(a.offsetDirection);
            b && this.manager.emit(this.options.event + b, a), this.manager.emit(this.options.event, a)
        }
    }), i(ga, Y, {
        defaults: {
            event: "tap",
            pointers: 1,
            taps: 1,
            interval: 300,
            time: 250,
            threshold: 9,
            posThreshold: 10
        },
        getTouchAction: function() {
            return [ib]
        },
        process: function(a) {
            var b = this.options,
                c = a.pointers.length === b.pointers,
                d = a.distance < b.threshold,
                f = a.deltaTime < b.time;
            if (this.reset(), a.eventType & Ea && 0 === this.count) return this.failTimeout();
            if (d && f && c) {
                if (a.eventType != Ga) return this.failTimeout();
                var g = !this.pTime || a.timeStamp - this.pTime < b.interval,
                    h = !this.pCenter || H(this.pCenter, a.center) < b.posThreshold;
                this.pTime = a.timeStamp, this.pCenter = a.center, h && g ? this.count += 1 : this.count = 1, this._input = a;
                var i = this.count % b.taps;
                if (0 === i) return this.hasRequireFailures() ? (this._timer = e(function() {
                    this.state = rb, this.tryEmit()
                }, b.interval, this), ob) : rb
            }
            return tb
        },
        failTimeout: function() {
            return this._timer = e(function() {
                this.state = tb
            }, this.options.interval, this), tb
        },
        reset: function() {
            clearTimeout(this._timer)
        },
        emit: function() {
            this.state == rb && (this._input.tapCount = this.count, this.manager.emit(this.options.event, this._input))
        }
    }), ha.VERSION = "2.0.7", ha.defaults = {
        domEvents: !1,
        touchAction: gb,
        enable: !0,
        inputTarget: null,
        inputClass: null,
        preset: [
            [ea, {
                enable: !1
            }],
            [ca, {
                    enable: !1
                },
                ["rotate"]
            ],
            [fa, {
                direction: Na
            }],
            [ba, {
                    direction: Na
                },
                ["swipe"]
            ],
            [ga],
            [ga, {
                    event: "doubletap",
                    taps: 2
                },
                ["tap"]
            ],
            [da]
        ],
        cssProps: {
            userSelect: "none",
            touchSelect: "none",
            touchCallout: "none",
            contentZooming: "none",
            userDrag: "none",
            tapHighlightColor: "rgba(0,0,0,0)"
        }
    };
    var ub = 1,
        vb = 2;
    ia.prototype = {
        set: function(a) {
            return la(this.options, a), a.touchAction && this.touchAction.update(), a.inputTarget && (this.input.destroy(), this.input.target = a.inputTarget, this.input.init()), this
        },
        stop: function(a) {
            this.session.stopped = a ? vb : ub
        },
        recognize: function(a) {
            var b = this.session;
            if (!b.stopped) {
                this.touchAction.preventDefaults(a);
                var c, d = this.recognizers,
                    e = b.curRecognizer;
                (!e || e && e.state & rb) && (e = b.curRecognizer = null);
                for (var f = 0; f < d.length;) c = d[f], b.stopped === vb || e && c != e && !c.canRecognizeWith(e) ? c.reset() : c.recognize(a), !e && c.state & (ob | pb | qb) && (e = b.curRecognizer = c), f++
            }
        },
        get: function(a) {
            if (a instanceof Y) return a;
            for (var b = this.recognizers, c = 0; c < b.length; c++)
                if (b[c].options.event == a) return b[c];
            return null
        },
        add: function(a) {
            if (f(a, "add", this)) return this;
            var b = this.get(a.options.event);
            return b && this.remove(b), this.recognizers.push(a), a.manager = this, this.touchAction.update(), a
        },
        remove: function(a) {
            if (f(a, "remove", this)) return this;
            if (a = this.get(a)) {
                var b = this.recognizers,
                    c = r(b, a);
                c !== -1 && (b.splice(c, 1), this.touchAction.update())
            }
            return this
        },
        on: function(a, b) {
            if (a !== d && b !== d) {
                var c = this.handlers;
                return g(q(a), function(a) {
                    c[a] = c[a] || [], c[a].push(b)
                }), this
            }
        },
        off: function(a, b) {
            if (a !== d) {
                var c = this.handlers;
                return g(q(a), function(a) {
                    b ? c[a] && c[a].splice(r(c[a], b), 1) : delete c[a]
                }), this
            }
        },
        emit: function(a, b) {
            this.options.domEvents && ka(a, b);
            var c = this.handlers[a] && this.handlers[a].slice();
            if (c && c.length) {
                b.type = a, b.preventDefault = function() {
                    b.srcEvent.preventDefault()
                };
                for (var d = 0; d < c.length;) c[d](b), d++
            }
        },
        destroy: function() {
            this.element && ja(this, !1), this.handlers = {}, this.session = {}, this.input.destroy(), this.element = null
        }
    }, la(ha, {
        INPUT_START: Ea,
        INPUT_MOVE: Fa,
        INPUT_END: Ga,
        INPUT_CANCEL: Ha,
        STATE_POSSIBLE: nb,
        STATE_BEGAN: ob,
        STATE_CHANGED: pb,
        STATE_ENDED: qb,
        STATE_RECOGNIZED: rb,
        STATE_CANCELLED: sb,
        STATE_FAILED: tb,
        DIRECTION_NONE: Ia,
        DIRECTION_LEFT: Ja,
        DIRECTION_RIGHT: Ka,
        DIRECTION_UP: La,
        DIRECTION_DOWN: Ma,
        DIRECTION_HORIZONTAL: Na,
        DIRECTION_VERTICAL: Oa,
        DIRECTION_ALL: Pa,
        Manager: ia,
        Input: x,
        TouchAction: V,
        TouchInput: P,
        MouseInput: L,
        PointerEventInput: M,
        TouchMouseInput: R,
        SingleTouchInput: N,
        Recognizer: Y,
        AttrRecognizer: aa,
        Tap: ga,
        Pan: ba,
        Swipe: fa,
        Pinch: ca,
        Rotate: ea,
        Press: da,
        on: m,
        off: n,
        each: g,
        merge: ta,
        extend: sa,
        assign: la,
        inherit: i,
        bindFn: j,
        prefixed: u
    });
    var wb = "undefined" != typeof a ? a : "undefined" != typeof self ? self : {};
    wb.Hammer = ha, "function" == typeof define && define.amd ? define(function() {
        return ha
    }) : "undefined" != typeof module && module.exports ? module.exports = ha : a[c] = ha
}(window, document, "Hammer"),
function(a, b, c, d) {
    "use strict";
    var e = c("html"),
        f = c(a),
        g = c(b),
        h = c.fancybox = function() {
            h.open.apply(this, arguments)
        },
        i = navigator.userAgent.match(/msie/i),
        j = null,
        k = b.createTouch !== d,
        l = function(a) {
            return a && a.hasOwnProperty && a instanceof c
        },
        m = function(a) {
            return a && "string" === c.type(a)
        },
        n = function(a) {
            return m(a) && a.indexOf("%") > 0
        },
        o = function(a) {
            return a && !(a.style.overflow && "hidden" === a.style.overflow) && (a.clientWidth && a.scrollWidth > a.clientWidth || a.clientHeight && a.scrollHeight > a.clientHeight)
        },
        p = function(a, b) {
            var c = parseInt(a, 10) || 0;
            return b && n(a) && (c = h.getViewport()[b] / 100 * c), Math.ceil(c)
        },
        q = function(a, b) {
            return p(a, b) + "px"
        };
    c.extend(h, {
        version: "2.1.5",
        defaults: {
            padding: 15,
            margin: 20,
            width: 1000,
            height: 600,
            minWidth: 100,
            minHeight: 100,
            maxWidth: 9999,
            maxHeight: 9999,
            pixelRatio: 1,
            autoSize: !0,
            autoHeight: !1,
            autoWidth: !1,
            autoResize: !0,
            autoCenter: !k,
            fitToView: !0,
            aspectRatio: !1,
            topRatio: .5,
            leftRatio: .5,
            scrolling: "auto",
            wrapCSS: "",
            arrows: !0,
            closeBtn: !0,
            closeClick: !1,
            nextClick: !1,
            mouseWheel: !0,
            autoPlay: !1,
            playSpeed: 3e3,
            preload: 3,
            modal: !1,
            loop: !0,
            ajax: {
               // dataType: "html",
               // headers: {
                 //   "X-fancyBox": !0
                //}
          //  },
           // iframe: {
           //     scrolling: "auto",
           //     preload: !0
           // },
          //swf: {
               // wmode: "transparent",
//allowfullscreen: "true",
               // allowscriptaccess: "always"
            },
            keys: {
                next: {
                    13: "left",
                    34: "up",
                    39: "left",
                    40: "up"
                },
                prev: {
                    8: "right",
                    33: "down",
                    37: "right",
                    38: "down"
                },
                close: [27],
                play: [32],
                toggle: [70]
            },
            direction: {
                next: "left",
                prev: "right"
            },
            scrollOutside: !0,
            index: 0,
            type: null,
            href: null,
            content: null,
            title: null,
            tpl: {
                wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                image: '<img class="fancybox-image" src="{href}" alt="" />',
                iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (i ? ' allowtransparency="true"' : "") + "></iframe>",
                error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
            },
            openEffect: "fade",
            openSpeed: 250,
            openEasing: "swing",
            openOpacity: !0,
            openMethod: "zoomIn",
            closeEffect: "fade",
            closeSpeed: 250,
            closeEasing: "swing",
            closeOpacity: !0,
            closeMethod: "zoomOut",
            nextEffect: "elastic",
            nextSpeed: 250,
            nextEasing: "swing",
            nextMethod: "changeIn",
            prevEffect: "elastic",
            prevSpeed: 250,
            prevEasing: "swing",
            prevMethod: "changeOut",
            helpers: {
                overlay: !0,
                title: !0
            },
            onCancel: c.noop,
            beforeLoad: c.noop,
            afterLoad: c.noop,
            beforeShow: c.noop,
            afterShow: c.noop,
            beforeChange: c.noop,
            beforeClose: c.noop,
            afterClose: c.noop
        },
        group: {},
        opts: {},
        previous: null,
        coming: null,
        current: null,
        isActive: !1,
        isOpen: !1,
        isOpened: !1,
        wrap: null,
        skin: null,
        outer: null,
        inner: null,
        player: {
            timer: null,
            isActive: !1
        },
        ajaxLoad: null,
        imgPreload: null,
        transitions: {},
        helpers: {},
        open: function(a, b) {
            if (a && (c.isPlainObject(b) || (b = {}), !1 !== h.close(!0))) return c.isArray(a) || (a = l(a) ? c(a).get() : [a]), c.each(a, function(e, f) {
                var g, i, j, k, n, o, p, q = {};
                "object" === c.type(f) && (f.nodeType && (f = c(f)), l(f) ? (q = {
                    href: f.data("fancybox-href") || f.attr("href"),
                    title: f.data("fancybox-title") || f.attr("title"),
                    isDom: !0,
                    element: f
                }, c.metadata && c.extend(!0, q, f.metadata())) : q = f), g = b.href || q.href || (m(f) ? f : null), i = b.title !== d ? b.title : q.title || "", j = b.content || q.content, k = j ? "html" : b.type || q.type, !k && q.isDom && (k = f.data("fancybox-type"), k || (n = f.prop("class").match(/fancybox\.(\w+)/), k = n ? n[1] : null)), m(g) && (k || (h.isImage(g) ? k = "image" : h.isSWF(g) ? k = "swf" : "#" === g.charAt(0) ? k = "inline" : m(f) && (k = "html", j = f)), "ajax" === k && (o = g.split(/\s+/, 2), g = o.shift(), p = o.shift())), j || ("inline" === k ? g ? j = c(m(g) ? g.replace(/.*(?=#[^\s]+$)/, "") : g) : q.isDom && (j = f) : "html" === k ? j = g : k || g || !q.isDom || (k = "inline", j = f)), c.extend(q, {
                    href: g,
                    type: k,
                    content: j,
                    title: i,
                    selector: p
                }), a[e] = q
            }), h.opts = c.extend(!0, {}, h.defaults, b), b.keys !== d && (h.opts.keys = !!b.keys && c.extend({}, h.defaults.keys, b.keys)), h.group = a, h._start(h.opts.index)
        },
        cancel: function() {
            var a = h.coming;
            a && !1 !== h.trigger("onCancel") && (h.hideLoading(), h.ajaxLoad && h.ajaxLoad.abort(), h.ajaxLoad = null, h.imgPreload && (h.imgPreload.onload = h.imgPreload.onerror = null), a.wrap && a.wrap.stop(!0, !0).trigger("onReset").remove(), h.coming = null, h.current || h._afterZoomOut(a))
        },
        close: function(a) {
            h.cancel(), !1 !== h.trigger("beforeClose") && (h.unbindEvents(), h.isActive && (h.isOpen && a !== !0 ? (h.isOpen = h.isOpened = !1, h.isClosing = !0, c(".fancybox-item, .fancybox-nav").remove(), h.wrap.stop(!0, !0).removeClass("fancybox-opened"), h.transitions[h.current.closeMethod]()) : (c(".fancybox-wrap").stop(!0).trigger("onReset").remove(), h._afterZoomOut())))
        },
        play: function(a) {
            var b = function() {
                    clearTimeout(h.player.timer)
                },
                c = function() {
                    b(), h.current && h.player.isActive && (h.player.timer = setTimeout(h.next, h.current.playSpeed))
                },
                d = function() {
                    b(), g.unbind(".player"), h.player.isActive = !1, h.trigger("onPlayEnd")
                },
                e = function() {
                    h.current && (h.current.loop || h.current.index < h.group.length - 1) && (h.player.isActive = !0, g.bind({
                        "onCancel.player beforeClose.player": d,
                        "onUpdate.player": c,
                        "beforeLoad.player": b
                    }), c(), h.trigger("onPlayStart"))
                };
            a === !0 || !h.player.isActive && a !== !1 ? e() : d()
        },
        next: function(a) {
            var b = h.current;
            b && (m(a) || (a = b.direction.next), h.jumpto(b.index + 1, a, "next"))
        },
        prev: function(a) {
            var b = h.current;
            b && (m(a) || (a = b.direction.prev), h.jumpto(b.index - 1, a, "prev"))
        },
        jumpto: function(a, b, c) {
            var e = h.current;
            e && (a = p(a), h.direction = b || e.direction[a >= e.index ? "next" : "prev"], h.router = c || "jumpto", e.loop && (a < 0 && (a = e.group.length + a % e.group.length), a %= e.group.length), e.group[a] !== d && (h.cancel(), h._start(a)))
        },
        reposition: function(a, b) {
            var d, e = h.current,
                f = e ? e.wrap : null;
            f && (d = h._getPosition(b), a && "scroll" === a.type ? (delete d.position, f.stop(!0, !0).animate(d, 200)) : (f.css(d), e.pos = c.extend({}, e.dim, d)))
        },
        update: function(a) {
            var b = a && a.type,
                c = !b || "orientationchange" === b;
            c && (clearTimeout(j), j = null), h.isOpen && !j && (j = setTimeout(function() {
                var d = h.current;
                d && !h.isClosing && (h.wrap.removeClass("fancybox-tmp"), (c || "load" === b || "resize" === b && d.autoResize) && h._setDimension(), "scroll" === b && d.canShrink || h.reposition(a), h.trigger("onUpdate"), j = null)
            }, c && !k ? 0 : 300))
        },
        toggle: function(a) {
            h.isOpen && (h.current.fitToView = "boolean" === c.type(a) ? a : !h.current.fitToView, k && (h.wrap.removeAttr("style").addClass("fancybox-tmp"), h.trigger("onUpdate")), h.update())
        },
        hideLoading: function() {
            g.unbind(".loading"), c("#fancybox-loading").remove()
        },
        showLoading: function() {
            var a, b;
            h.hideLoading(), a = c('<div id="fancybox-loading"><div></div></div>').click(h.cancel).appendTo("body"), g.bind("keydown.loading", function(a) {
                27 === (a.which || a.keyCode) && (a.preventDefault(), h.cancel())
            }), h.defaults.fixed || (b = h.getViewport(), a.css({
                position: "absolute",
                top: .5 * b.h + b.y,
                left: .5 * b.w + b.x
            }))
        },
        getViewport: function() {
            var b = h.current && h.current.locked || !1,
                c = {
                    x: f.scrollLeft(),
                    y: f.scrollTop()
                };
            return b ? (c.w = b[0].clientWidth, c.h = b[0].clientHeight) : (c.w = k && a.innerWidth ? a.innerWidth : f.width(), c.h = k && a.innerHeight ? a.innerHeight : f.height()), c
        },
        unbindEvents: function() {
            h.wrap && l(h.wrap) && h.wrap.unbind(".fb"), g.unbind(".fb"), f.unbind(".fb")
        },
        bindEvents: function() {
            var a, b = h.current;
            b && (f.bind("orientationchange.fb" + (k ? "" : " resize.fb") + (b.autoCenter && !b.locked ? " scroll.fb" : ""), h.update), a = b.keys, a && g.bind("keydown.fb", function(e) {
                var f = e.which || e.keyCode,
                    g = e.target || e.srcElement;
                return (27 !== f || !h.coming) && void(e.ctrlKey || e.altKey || e.shiftKey || e.metaKey || g && (g.type || c(g).is("[contenteditable]")) || c.each(a, function(a, g) {
                    return b.group.length > 1 && g[f] !== d ? (h[a](g[f]), e.preventDefault(), !1) : c.inArray(f, g) > -1 ? (h[a](), e.preventDefault(), !1) : void 0
                }))
            }), c.fn.mousewheel && b.mouseWheel && h.wrap.bind("mousewheel.fb", function(a, d, e, f) {
                for (var g = a.target || null, i = c(g), j = !1; i.length && !(j || i.is(".fancybox-skin") || i.is(".fancybox-wrap"));) j = o(i[0]), i = c(i).parent();
                0 === d || j || h.group.length > 1 && !b.canShrink && (f > 0 || e > 0 ? h.prev(f > 0 ? "down" : "left") : (f < 0 || e < 0) && h.next(f < 0 ? "up" : "right"), a.preventDefault())
            }))
        },
        trigger: function(a, b) {
            var d, e = b || h.coming || h.current;
            if (e) {
                if (c.isFunction(e[a]) && (d = e[a].apply(e, Array.prototype.slice.call(arguments, 1))), d === !1) return !1;
                e.helpers && c.each(e.helpers, function(b, d) {
                    d && h.helpers[b] && c.isFunction(h.helpers[b][a]) && h.helpers[b][a](c.extend(!0, {}, h.helpers[b].defaults, d), e)
                }), g.trigger(a)
            }
        },
        isImage: function(a) {
            return m(a) && a.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
        },
        isSWF: function(a) {
            return m(a) && a.match(/\.(swf)((\?|#).*)?$/i)
        },
        _start: function(a) {
            var b, d, e, f, g, i = {};
            if (a = p(a), b = h.group[a] || null, !b) return !1;
            if (i = c.extend(!0, {}, h.opts, b), f = i.margin, g = i.padding, "number" === c.type(f) && (i.margin = [f, f, f, f]), "number" === c.type(g) && (i.padding = [g, g, g, g]), i.modal && c.extend(!0, i, {
                    closeBtn: !1,
                    closeClick: !1,
                    nextClick: !1,
                    arrows: !1,
                    mouseWheel: !1,
                    keys: null,
                    helpers: {
                        overlay: {
                            closeClick: !1
                        }
                    }
                }), i.autoSize && (i.autoWidth = i.autoHeight = !0), "auto" === i.width && (i.autoWidth = !0), "auto" === i.height && (i.autoHeight = !0), i.group = h.group, i.index = a, h.coming = i, !1 === h.trigger("beforeLoad")) return void(h.coming = null);
            if (e = i.type, d = i.href, !e) return h.coming = null, !(!h.current || !h.router || "jumpto" === h.router) && (h.current.index = a, h[h.router](h.direction));
            if (h.isActive = !0, "image" !== e && "swf" !== e || (i.autoHeight = i.autoWidth = !1, i.scrolling = "visible"), "image" === e && (i.aspectRatio = !0), "iframe" === e && k && (i.scrolling = "scroll"), i.wrap = c(i.tpl.wrap).addClass("fancybox-" + (k ? "mobile" : "desktop") + " fancybox-type-" + e + " fancybox-tmp " + i.wrapCSS).appendTo(i.parent || "body"), c.extend(i, {
                    skin: c(".fancybox-skin", i.wrap),
                    outer: c(".fancybox-outer", i.wrap),
                    inner: c(".fancybox-inner", i.wrap)
                }), c.each(["Top", "Right", "Bottom", "Left"], function(a, b) {
                    i.skin.css("padding" + b, q(i.padding[a]))
                }), h.trigger("onReady"), "inline" === e || "html" === e) {
                if (!i.content || !i.content.length) return h._error("content")
            } else if (!d) return h._error("href");
            "image" === e ? h._loadImage() : "ajax" === e ? h._loadAjax() : "iframe" === e ? h._loadIframe() : h._afterLoad()
        },
        _error: function(a) {
            c.extend(h.coming, {
                type: "html",
                autoWidth: !0,
                autoHeight: !0,
                minWidth: 0,
                minHeight: 0,
                scrolling: "no",
                hasError: a,
                content: h.coming.tpl.error
            }), h._afterLoad()
        },
        _loadImage: function() {
            var a = h.imgPreload = new Image;
            a.onload = function() {
                this.onload = this.onerror = null, h.coming.width = this.width / h.opts.pixelRatio, h.coming.height = this.height / h.opts.pixelRatio, h._afterLoad()
            }, a.onerror = function() {
                this.onload = this.onerror = null, h._error("image")
            }, a.src = h.coming.href, a.complete !== !0 && h.showLoading()
        },
        _loadAjax: function() {
            var a = h.coming;
            h.showLoading(), h.ajaxLoad = c.ajax(c.extend({}, a.ajax, {
                url: a.href,
                error: function(a, b) {
                    h.coming && "abort" !== b ? h._error("ajax", a) : h.hideLoading()
                },
                success: function(b, c) {
                    "success" === c && (a.content = b, h._afterLoad())
                }
            }))
        },
        _loadIframe: function() {
            var a = h.coming,
                b = c(a.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", k ? "auto" : a.iframe.scrolling).attr("src", a.href);
            c(a.wrap).bind("onReset", function() {
                try {
                    c(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                } catch (a) {}
            }), a.iframe.preload && (h.showLoading(), b.one("load", function() {
                c(this).data("ready", 1), k || c(this).bind("load.fb", h.update), c(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), h._afterLoad()
            })), a.content = b.appendTo(a.inner), a.iframe.preload || h._afterLoad()
        },
        _preloadImages: function() {
            var a, b, c = h.group,
                d = h.current,
                e = c.length,
                f = d.preload ? Math.min(d.preload, e - 1) : 0;
            for (b = 1; b <= f; b += 1) a = c[(d.index + b) % e], "image" === a.type && a.href && ((new Image).src = a.href)
        },
        _afterLoad: function() {
            var a, b, d, e, f, g, i = h.coming,
                j = h.current,
                k = "fancybox-placeholder";
            if (h.hideLoading(), i && h.isActive !== !1) {
                if (!1 === h.trigger("afterLoad", i, j)) return i.wrap.stop(!0).trigger("onReset").remove(), void(h.coming = null);
                switch (j && (h.trigger("beforeChange", j), j.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), h.unbindEvents(), a = i, b = i.content, d = i.type, e = i.scrolling, c.extend(h, {
                    wrap: a.wrap,
                    skin: a.skin,
                    outer: a.outer,
                    inner: a.inner,
                    current: a,
                    previous: j
                }), f = a.href, d) {
                    case "inline":
                    case "ajax":
                    case "html":
                        a.selector ? b = c("<div>").html(b).find(a.selector) : l(b) && (b.data(k) || b.data(k, c('<div class="' + k + '"></div>').insertAfter(b).hide()), b = b.show().detach(), a.wrap.bind("onReset", function() {
                            c(this).find(b).length && b.hide().replaceAll(b.data(k)).data(k, !1)
                        }));
                        break;
                    case "image":
                        b = a.tpl.image.replace("{href}", f);
                        break;
                    case "swf":
                        b = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + f + '"></param>', g = "", c.each(a.swf, function(a, c) {
                            b += '<param name="' + a + '" value="' + c + '"></param>', g += " " + a + '="' + c + '"'
                        }), b += '<embed src="' + f + '" type="application/x-shockwave-flash" width="100%" height="100%"' + g + "></embed></object>"
                }
                l(b) && b.parent().is(a.inner) || a.inner.append(b), h.trigger("beforeShow"), a.inner.css("overflow", "yes" === e ? "scroll" : "no" === e ? "hidden" : e), h._setDimension(), h.reposition(), h.isOpen = !1, h.coming = null, h.bindEvents(), h.isOpened ? j.prevMethod && h.transitions[j.prevMethod]() : c(".fancybox-wrap").not(a.wrap).stop(!0).trigger("onReset").remove(), h.transitions[h.isOpened ? a.nextMethod : a.openMethod](), h._preloadImages()
            }
        },
        _setDimension: function() {
            var a, b, d, e, f, g, i, j, k, l, m, o, r, s, t, u = h.getViewport(),
                v = 0,
                w = !1,
                x = !1,
                y = h.wrap,
                z = h.skin,
                A = h.inner,
                B = h.current,
                C = B.width,
                D = B.height,
                E = B.minWidth,
                F = B.minHeight,
                G = B.maxWidth,
                H = B.maxHeight,
                I = B.scrolling,
                J = B.scrollOutside ? B.scrollbarWidth : 0,
                K = B.margin,
                L = p(K[1] + K[3]),
                M = p(K[0] + K[2]);
            if (y.add(z).add(A).width("auto").height("auto").removeClass("fancybox-tmp"), a = p(z.outerWidth(!0) - z.width()), b = p(z.outerHeight(!0) - z.height()), d = L + a, e = M + b, f = n(C) ? (u.w - d) * p(C) / 100 : C, g = n(D) ? (u.h - e) * p(D) / 100 : D, "iframe" === B.type) {
                if (s = B.content, B.autoHeight && 1 === s.data("ready")) try {
                    s[0].contentWindow.document.location && (A.width(f).height(9999), t = s.contents().find("body"), J && t.css("overflow-x", "hidden"), g = t.outerHeight(!0))
                } catch (a) {}
            } else(B.autoWidth || B.autoHeight) && (A.addClass("fancybox-tmp"), B.autoWidth || A.width(f), B.autoHeight || A.height(g), B.autoWidth && (f = A.width()), B.autoHeight && (g = A.height()), A.removeClass("fancybox-tmp"));
            if (C = p(f), D = p(g), k = f / g, E = p(n(E) ? p(E, "w") - d : E), G = p(n(G) ? p(G, "w") - d : G), F = p(n(F) ? p(F, "h") - e : F), H = p(n(H) ? p(H, "h") - e : H), i = G, j = H, B.fitToView && (G = Math.min(u.w - d, G), H = Math.min(u.h - e, H)), o = u.w - L, r = u.h - M, B.aspectRatio ? (C > G && (C = G, D = p(C / k)), D > H && (D = H, C = p(D * k)), C < E && (C = E, D = p(C / k)), D < F && (D = F, C = p(D * k))) : (C = Math.max(E, Math.min(C, G)), B.autoHeight && "iframe" !== B.type && (A.width(C), D = A.height()), D = Math.max(F, Math.min(D, H))), B.fitToView)
                if (A.width(C).height(D), y.width(C + a), l = y.width(), m = y.height(), B.aspectRatio)
                    for (;
                        (l > o || m > r) && C > E && D > F && !(v++ > 19);) D = Math.max(F, Math.min(H, D - 10)), C = p(D * k), C < E && (C = E, D = p(C / k)), C > G && (C = G, D = p(C / k)), A.width(C).height(D), y.width(C + a), l = y.width(), m = y.height();
                else C = Math.max(E, Math.min(C, C - (l - o))), D = Math.max(F, Math.min(D, D - (m - r)));
            J && "auto" === I && D < g && C + a + J < o && (C += J), A.width(C).height(D), y.width(C + a), l = y.width(), m = y.height(), w = (l > o || m > r) && C > E && D > F, x = B.aspectRatio ? C < i && D < j && C < f && D < g : (C < i || D < j) && (C < f || D < g), c.extend(B, {
                dim: {
                    width: q(l),
                    height: q(m)
                },
                origWidth: f,
                origHeight: g,
                canShrink: w,
                canExpand: x,
                wPadding: a,
                hPadding: b,
                wrapSpace: m - z.outerHeight(!0),
                skinSpace: z.height() - D
            }), !s && B.autoHeight && D > F && D < H && !x && A.height("auto")
        },
        _getPosition: function(a) {
            var b = h.current,
                c = h.getViewport(),
                d = b.margin,
                e = h.wrap.width() + d[1] + d[3],
                f = h.wrap.height() + d[0] + d[2],
                g = {
                    position: "absolute",
                    top: d[0],
                    left: d[3]
                };
            return b.autoCenter && b.fixed && !a && f <= c.h && e <= c.w ? g.position = "fixed" : b.locked || (g.top += c.y, g.left += c.x), g.top = q(Math.max(g.top, g.top + (c.h - f) * b.topRatio)), g.left = q(Math.max(g.left, g.left + (c.w - e) * b.leftRatio)), g
        },
        _afterZoomIn: function() {
            var a = h.current;
            a && (h.isOpen = h.isOpened = !0, h.wrap.css("overflow", "visible").addClass("fancybox-opened"), h.update(), (a.closeClick || a.nextClick && h.group.length > 1) && h.inner.css("cursor", "pointer").bind("click.fb", function(b) {
                c(b.target).is("a") || c(b.target).parent().is("a") || (b.preventDefault(), h[a.closeClick ? "close" : "next"]())
            }), a.closeBtn && c(a.tpl.closeBtn).appendTo(h.skin).bind("click.fb", function(a) {
                a.preventDefault(), h.close()
            }), a.arrows && h.group.length > 1 && ((a.loop || a.index > 0) && c(a.tpl.prev).appendTo(h.outer).bind("click.fb", h.prev), (a.loop || a.index < h.group.length - 1) && c(a.tpl.next).appendTo(h.outer).bind("click.fb", h.next)), h.trigger("afterShow"), a.loop || a.index !== a.group.length - 1 ? h.opts.autoPlay && !h.player.isActive && (h.opts.autoPlay = !1, h.play()) : h.play(!1))
        },
        _afterZoomOut: function(a) {
            a = a || h.current, c(".fancybox-wrap").trigger("onReset").remove(), c.extend(h, {
                group: {},
                opts: {},
                router: !1,
                current: null,
                isActive: !1,
                isOpened: !1,
                isOpen: !1,
                isClosing: !1,
                wrap: null,
                skin: null,
                outer: null,
                inner: null
            }), h.trigger("afterClose", a)
        }
    }), h.transitions = {
        getOrigPosition: function() {
            var a = h.current,
                b = a.element,
                c = a.orig,
                d = {},
                e = 50,
                f = 50,
                g = a.hPadding,
                i = a.wPadding,
                j = h.getViewport();
            return !c && a.isDom && b.is(":visible") && (c = b.find("img:first"), c.length || (c = b)), l(c) ? (d = c.offset(), c.is("img") && (e = c.outerWidth(), f = c.outerHeight())) : (d.top = j.y + (j.h - f) * a.topRatio, d.left = j.x + (j.w - e) * a.leftRatio), ("fixed" === h.wrap.css("position") || a.locked) && (d.top -= j.y, d.left -= j.x), d = {
                top: q(d.top - g * a.topRatio),
                left: q(d.left - i * a.leftRatio),
                width: q(e + i),
                height: q(f + g)
            }
        },
        step: function(a, b) {
            var c, d, e, f = b.prop,
                g = h.current,
                i = g.wrapSpace,
                j = g.skinSpace;
            "width" !== f && "height" !== f || (c = b.end === b.start ? 1 : (a - b.start) / (b.end - b.start), h.isClosing && (c = 1 - c), d = "width" === f ? g.wPadding : g.hPadding, e = a - d, h.skin[f](p("width" === f ? e : e - i * c)), h.inner[f](p("width" === f ? e : e - i * c - j * c)))
        },
        zoomIn: function() {
            var a = h.current,
                b = a.pos,
                d = a.openEffect,
                e = "elastic" === d,
                f = c.extend({
                    opacity: 1
                }, b);
            delete f.position, e ? (b = this.getOrigPosition(), a.openOpacity && (b.opacity = .1)) : "fade" === d && (b.opacity = .1), h.wrap.css(b).animate(f, {
                duration: "none" === d ? 0 : a.openSpeed,
                easing: a.openEasing,
                step: e ? this.step : null,
                complete: h._afterZoomIn
            })
        },
        zoomOut: function() {
            var a = h.current,
                b = a.closeEffect,
                c = "elastic" === b,
                d = {
                    opacity: .1
                };
            c && (d = this.getOrigPosition(), a.closeOpacity && (d.opacity = .1)), h.wrap.animate(d, {
                duration: "none" === b ? 0 : a.closeSpeed,
                easing: a.closeEasing,
                step: c ? this.step : null,
                complete: h._afterZoomOut
            })
        },
        changeIn: function() {
            var a, b = h.current,
                c = b.nextEffect,
                d = b.pos,
                e = {
                    opacity: 1
                },
                f = h.direction,
                g = 200;
            d.opacity = .1, "elastic" === c && (a = "down" === f || "up" === f ? "top" : "left", "down" === f || "right" === f ? (d[a] = q(p(d[a]) - g), e[a] = "+=" + g + "px") : (d[a] = q(p(d[a]) + g), e[a] = "-=" + g + "px")), "none" === c ? h._afterZoomIn() : h.wrap.css(d).animate(e, {
                duration: b.nextSpeed,
                easing: b.nextEasing,
                complete: h._afterZoomIn
            })
        },
        changeOut: function() {
            var a = h.previous,
                b = a.prevEffect,
                d = {
                    opacity: .1
                },
                e = h.direction,
                f = 200;
            "elastic" === b && (d["down" === e || "up" === e ? "top" : "left"] = ("up" === e || "left" === e ? "-" : "+") + "=" + f + "px"), a.wrap.animate(d, {
                duration: "none" === b ? 0 : a.prevSpeed,
                easing: a.prevEasing,
                complete: function() {
                    c(this).trigger("onReset").remove()
                }
            })
        }
    }, h.helpers.overlay = {
        defaults: {
            closeClick: !0,
            speedOut: 200,
            showEarly: !0,
            css: {},
            locked: !k,
            fixed: !0
        },
        overlay: null,
        fixed: !1,
        el: c("html"),
        create: function(a) {
            a = c.extend({}, this.defaults, a), this.overlay && this.close(), this.overlay = c('<div class="fancybox-overlay"></div>').appendTo(h.coming ? h.coming.parent : a.parent), this.fixed = !1, a.fixed && h.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
        },
        open: function(a) {
            var b = this;
            a = c.extend({}, this.defaults, a), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(a), this.fixed || (f.bind("resize.overlay", c.proxy(this.update, this)), this.update()), a.closeClick && this.overlay.bind("click.overlay", function(a) {
                if (c(a.target).hasClass("fancybox-overlay")) return h.isActive ? h.close() : b.close(), !1
            }), this.overlay.css(a.css).show()
        },
        close: function() {
            var a, b;
            f.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (c(".fancybox-margin").removeClass("fancybox-margin"), a = f.scrollTop(), b = f.scrollLeft(), this.el.removeClass("fancybox-lock"), f.scrollTop(a).scrollLeft(b)), c(".fancybox-overlay").remove().hide(), c.extend(this, {
                overlay: null,
                fixed: !1
            })
        },
        update: function() {
            var a, c = "100%";
            this.overlay.width(c).height("100%"), i ? (a = Math.max(b.documentElement.offsetWidth, b.body.offsetWidth), g.width() > a && (c = g.width())) : g.width() > f.width() && (c = g.width()), this.overlay.width(c).height(g.height())
        },
        onReady: function(a, b) {
            var d = this.overlay;
            c(".fancybox-overlay").stop(!0, !0), d || this.create(a), a.locked && this.fixed && b.fixed && (d || (this.margin = g.height() > f.height() && c("html").css("margin-right").replace("px", "")), b.locked = this.overlay.append(b.wrap), b.fixed = !1), a.showEarly === !0 && this.beforeShow.apply(this, arguments)
        },
        beforeShow: function(a, b) {
            var d, e;
            b.locked && (this.margin !== !1 && (c("*").filter(function() {
                return "fixed" === c(this).css("position") && !c(this).hasClass("fancybox-overlay") && !c(this).hasClass("fancybox-wrap")
            }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin")), d = f.scrollTop(), e = f.scrollLeft(), this.el.addClass("fancybox-lock"), f.scrollTop(d).scrollLeft(e)), this.open(a)
        },
        onUpdate: function() {
            this.fixed || this.update()
        },
        afterClose: function(a) {
            this.overlay && !h.coming && this.overlay.fadeOut(a.speedOut, c.proxy(this.close, this))
        }
    }, h.helpers.title = {
        defaults: {
            type: "float",
            position: "bottom"
        },
        beforeShow: function(a) {
            var b, d, e = h.current,
                f = e.title,
                g = a.type;
            if (c.isFunction(f) && (f = f.call(e.element, e)), m(f) && "" !== c.trim(f)) {
                switch (b = c('<div class="fancybox-title fancybox-title-' + g + '-wrap">' + f + "</div>"), g) {
                    case "inside":
                        d = h.skin;
                        break;
                    case "outside":
                        d = h.wrap;
                        break;
                    case "over":
                        d = h.inner;
                        break;
                    default:
                        d = h.skin, b.appendTo("body"), i && b.width(b.width()), b.wrapInner('<span class="child"></span>'), h.current.margin[2] += Math.abs(p(b.css("margin-bottom")))
                }
                b["top" === a.position ? "prependTo" : "appendTo"](d)
            }
        }
    }, c.fn.fancybox = function(a) {
        var b, d = c(this),
            e = this.selector || "",
            f = function(f) {
                var g, i, j = c(this).blur(),
                    k = b;
                f.ctrlKey || f.altKey || f.shiftKey || f.metaKey || j.is(".fancybox-wrap") || (g = a.groupAttr || "data-fancybox-group", i = j.attr(g), i || (g = "rel", i = j.get(0)[g]), i && "" !== i && "nofollow" !== i && (j = e.length ? c(e) : d, j = j.filter("[" + g + '="' + i + '"]'), k = j.index(this)), a.index = k, h.open(j, a) !== !1 && f.preventDefault())
            };
        return a = a || {}, b = a.index || 0, e && a.live !== !1 ? g.undelegate(e, "click.fb-start").delegate(e + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", f) : d.unbind("click.fb-start").bind("click.fb-start", f), this.filter("[data-fancybox-start=1]").trigger("click"), this
    }, g.ready(function() {
        var b, f;
        c.scrollbarWidth === d && (c.scrollbarWidth = function() {
            var a = c('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),
                b = a.children(),
                d = b.innerWidth() - b.height(99).innerWidth();
            return a.remove(), d
        }), c.support.fixedPosition === d && (c.support.fixedPosition = function() {
            var a = c('<div style="position:fixed;top:20px;"></div>').appendTo("body"),
                b = 20 === a[0].offsetTop || 15 === a[0].offsetTop;
            return a.remove(), b
        }()), c.extend(h.defaults, {
            scrollbarWidth: c.scrollbarWidth(),
            fixed: c.support.fixedPosition,
            parent: c("body")
        }), b = c(a).width(), e.addClass("fancybox-lock-test"), f = c(a).width(), e.removeClass("fancybox-lock-test"), c("<style type='text/css'>.fancybox-margin{margin-right:" + (f - b) + "px;}</style>").appendTo("head")
    })
}(window, document, jQuery),
function(a, b) {
    "function" == typeof define && define.amd ? define(["jquery"], function() {
        return b.apply(a, arguments)
    }) : "object" == typeof module && module.exports ? module.exports = b.call(a, require("jquery")) : b.call(a, a.jQuery)
}("object" == typeof global ? global : this, function(a) {
    function b(b, c, d, e) {
        if ("d" != d && i(b)) {
            var f = q.exec(c),
                j = "auto" === b.css(d) ? 0 : b.css(d),
                j = "string" == typeof j ? h(j) : j;
            "string" == typeof c && h(c), e = !0 === e ? 0 : j;
            var k = b.is(":hidden"),
                l = b.translation();
            return "left" == d && (e = parseInt(j, 10) + l.x), "right" == d && (e = parseInt(j, 10) + l.x), "top" == d && (e = parseInt(j, 10) + l.y), "bottom" == d && (e = parseInt(j, 10) + l.y), f || "show" != c ? f || "hide" != c || (e = 0) : (e = 1, k && (elem = b[0], elem.style && (display = elem.style.display, a._data(elem, "olddisplay") || "none" !== display || (display = elem.style.display = ""), "" === display && "none" === a.css(elem, "display") && a._data(elem, "olddisplay", g(elem.tagName)), "" === display || "none" === display) && (elem.style.display = a._data(elem, "olddisplay") || ""), b.css("opacity", 0))), f ? (b = parseFloat(f[2]), f[1] && (b = ("-=" === f[1] ? -1 : 1) * b + parseInt(e, 10)), f[3] && "px" != f[3] && (b += f[3]), b) : e
        }
    }

    function c(b, c, e, g, i, j, k, l) {
        var m = b.data(t),
            m = m && !f(m) ? m : a.extend(!0, {}, s),
            o = i;
        if (-1 < a.inArray(c, n)) {
            var p = m.meta,
                q = h(b.css(c)) || 0,
                r = c + "_o",
                o = i - q;
            p[c] = o, p[r] = "auto" == b.css(c) ? 0 + o : q + o || 0, m.meta = p, k && 0 === o && (o = 0 - p[r], p[c] = o, p[r] = 0)
        }
        return b.data(t, d(b, m, c, e, g, o, j, k, l))
    }

    function d(a, b, c, d, e, f, g, h, i) {
        var j = !1;
        g = !0 === g && !0 === h, b = b || {}, b.original || (b.original = {}, j = !0), b.properties = b.properties || {}, b.secondary = b.secondary || {}, h = b.meta;
        for (var k = b.original, l = b.properties, m = b.secondary, n = o.length - 1; 0 <= n; n--) {
            var p = o[n] + "transition-property",
                q = o[n] + "transition-duration",
                r = o[n] + "transition-timing-function";
            c = g ? o[n] + "transform" : c, j && (k[p] = a.css(p) || "", k[q] = a.css(q) || "", k[r] = a.css(r) || "");
            var s, t = m,
                u = c;
            if (g) {
                s = h.left;
                var v = h.top;
                s = !0 === i || !0 === z && !1 !== i && y ? "translate3d(" + s + "px, " + v + "px, 0)" : "translate(" + s + "px," + v + "px)"
            } else s = f;
            t[u] = s, l[p] = (l[p] ? l[p] + "," : "") + c, l[q] = (l[q] ? l[q] + "," : "") + d + "ms", l[r] = (l[r] ? l[r] + "," : "") + e
        }
        return b
    }

    function e(a) {
        for (var b in a)
            if (!("width" != b && "height" != b || "show" != a[b] && "hide" != a[b] && "toggle" != a[b])) return !0;
        return !1
    }

    function f(a) {
        for (var b in a) return !1;
        return !0
    }

    function g(a) {
        a = a.toUpperCase();
        var b = {
            LI: "list-item",
            TR: "table-row",
            TD: "table-cell",
            TH: "table-cell",
            CAPTION: "table-caption",
            COL: "table-column",
            COLGROUP: "table-column-group",
            TFOOT: "table-footer-group",
            THEAD: "table-header-group",
            TBODY: "table-row-group"
        };
        return "string" == typeof b[a] ? b[a] : "block"
    }

    function h(a) {
        return parseFloat(a.replace(a.match(/\D+$/), ""))
    }

    function i(a) {
        var b = !0;
        return a.each(function(a, c) {
            return b = b && c.ownerDocument
        }), b
    }

    function j(b, c, d) {
        if (!i(d)) return !1;
        var e = -1 < a.inArray(b, m);
        return "width" != b && "height" != b && "opacity" != b || parseFloat(c) !== parseFloat(d.css(b)) || (e = !1), e
    }
    var k = a.fn.animate,
        l = a.fn.stop,
        m = "top right bottom left opacity height width".split(" "),
        n = ["top", "right", "bottom", "left"],
        o = ["-webkit-", "-moz-", "-o-", ""],
        p = ["avoidTransforms", "useTranslate3d", "leaveTransforms"],
        q = /^([+-]=)?([\d+-.]+)(.*)$/,
        r = /([A-Z])/g,
        s = {
            secondary: {},
            meta: {
                top: 0,
                right: 0,
                bottom: 0,
                left: 0
            }
        },
        t = "jQe",
        u = null,
        v = !1,
        w = (document.body || document.documentElement).style,
        x = void 0 !== w.WebkitTransition || void 0 !== w.MozTransition || void 0 !== w.OTransition || void 0 !== w.transition,
        y = "WebKitCSSMatrix" in window && "m11" in new WebKitCSSMatrix,
        z = y;
    a.expr && a.expr.filters && (u = a.expr.filters.animated, a.expr.filters.animated = function(b) {
        return !(!a(b).data("events") || !a(b).data("events")["webkitTransitionEnd oTransitionEnd transitionend"]) || u.call(this, b)
    }), a.extend({
        toggle3DByDefault: function() {
            return z = !z
        },
        toggleDisabledByDefault: function() {
            return v = !v
        },
        setDisabledByDefault: function(a) {
            return v = a
        }
    }), a.fn.translation = function() {
        if (!this[0]) return null;
        var a = window.getComputedStyle(this[0], null),
            b = {
                x: 0,
                y: 0
            };
        if (a)
            for (var c = o.length - 1; 0 <= c; c--) {
                var d = a.getPropertyValue(o[c] + "transform");
                if (d && /matrix/i.test(d)) {
                    a = d.replace(/^matrix\(/i, "").split(/, |\)$/g), b = {
                        x: parseInt(a[4], 10),
                        y: parseInt(a[5], 10)
                    };
                    break
                }
            }
        return b
    }, a.fn.animate = function(d, g, h, i) {
        d = d || {};
        var l = !("undefined" != typeof d.bottom || "undefined" != typeof d.right),
            m = a.speed(g, h, i),
            q = 0,
            r = function() {
                q--, 0 === q && "function" == typeof m.complete && m.complete.apply(this, arguments)
            };
        return !0 === ("undefined" != typeof d.avoidCSSTransitions ? d.avoidCSSTransitions : v) || !x || f(d) || e(d) || 0 >= m.duration || m.step ? k.apply(this, arguments) : this[!0 === m.queue ? "queue" : "each"](function() {
            var e, g = a(this),
                h = a.extend({}, m),
                i = function(b) {
                    var c = g.data(t) || {
                            original: {}
                        },
                        e = {};
                    if (2 == b.eventPhase) {
                        if (!0 !== d.leaveTransforms) {
                            for (b = o.length - 1; 0 <= b; b--) e[o[b] + "transform"] = "";
                            if (l && "undefined" != typeof c.meta) {
                                b = 0;
                                for (var f; f = n[b]; ++b) {
                                    var h = c.meta[f + "_o"];
                                    h && (e[f] = h + "px", a(this).css(f, e[f]))
                                }
                            }
                        }
                        g.unbind("webkitTransitionEnd oTransitionEnd transitionend").css(c.original).css(e).data(t, null), "hide" === d.opacity && (elem = g[0], elem.style && (display = a.css(elem, "display"), "none" === display || a._data(elem, "olddisplay") || a._data(elem, "olddisplay", display), elem.style.display = "none"), g.css("opacity", "")), r.call(this)
                    }
                },
                s = {
                    bounce: "cubic-bezier(0.0, 0.35, .5, 1.3)",
                    linear: "linear",
                    swing: "ease-in-out",
                    easeInQuad: "cubic-bezier(0.550, 0.085, 0.680, 0.530)",
                    easeInCubic: "cubic-bezier(0.550, 0.055, 0.675, 0.190)",
                    easeInQuart: "cubic-bezier(0.895, 0.030, 0.685, 0.220)",
                    easeInQuint: "cubic-bezier(0.755, 0.050, 0.855, 0.060)",
                    easeInSine: "cubic-bezier(0.470, 0.000, 0.745, 0.715)",
                    easeInExpo: "cubic-bezier(0.950, 0.050, 0.795, 0.035)",
                    easeInCirc: "cubic-bezier(0.600, 0.040, 0.980, 0.335)",
                    easeInBack: "cubic-bezier(0.600, -0.280, 0.735, 0.045)",
                    easeOutQuad: "cubic-bezier(0.250, 0.460, 0.450, 0.940)",
                    easeOutCubic: "cubic-bezier(0.215, 0.610, 0.355, 1.000)",
                    easeOutQuart: "cubic-bezier(0.165, 0.840, 0.440, 1.000)",
                    easeOutQuint: "cubic-bezier(0.230, 1.000, 0.320, 1.000)",
                    easeOutSine: "cubic-bezier(0.390, 0.575, 0.565, 1.000)",
                    easeOutExpo: "cubic-bezier(0.190, 1.000, 0.220, 1.000)",
                    easeOutCirc: "cubic-bezier(0.075, 0.820, 0.165, 1.000)",
                    easeOutBack: "cubic-bezier(0.175, 0.885, 0.320, 1.275)",
                    easeInOutQuad: "cubic-bezier(0.455, 0.030, 0.515, 0.955)",
                    easeInOutCubic: "cubic-bezier(0.645, 0.045, 0.355, 1.000)",
                    easeInOutQuart: "cubic-bezier(0.770, 0.000, 0.175, 1.000)",
                    easeInOutQuint: "cubic-bezier(0.860, 0.000, 0.070, 1.000)",
                    easeInOutSine: "cubic-bezier(0.445, 0.050, 0.550, 0.950)",
                    easeInOutExpo: "cubic-bezier(1.000, 0.000, 0.000, 1.000)",
                    easeInOutCirc: "cubic-bezier(0.785, 0.135, 0.150, 0.860)",
                    easeInOutBack: "cubic-bezier(0.680, -0.550, 0.265, 1.550)"
                },
                u = {},
                s = s[h.easing || "swing"] ? s[h.easing || "swing"] : h.easing || "swing";
            for (e in d)
                if (-1 === a.inArray(e, p)) {
                    var v = -1 < a.inArray(e, n),
                        w = b(g, d[e], e, v && !0 !== d.avoidTransforms);
                    j(e, w, g) ? c(g, e, h.duration, s, w, v && !0 !== d.avoidTransforms, l, d.useTranslate3d) : u[e] = d[e]
                }
            if (g.unbind("webkitTransitionEnd oTransitionEnd transitionend"), e = g.data(t), !e || f(e) || f(e.secondary)) h.queue = !1;
            else {
                q++, g.css(e.properties);
                var x = e.secondary;
                setTimeout(function() {
                    g.bind("webkitTransitionEnd oTransitionEnd transitionend", i).css(x)
                })
            }
            return f(u) || (q++, k.apply(g, [u, {
                duration: h.duration,
                easing: a.easing[h.easing] ? h.easing : a.easing.swing ? "swing" : "linear",
                complete: r,
                queue: h.queue
            }])), !0
        })
    }, a.fn.animate.defaults = {}, a.fn.stop = function(b, c, d) {
        return x ? (b && this.queue([]), this.each(function() {
            var e = a(this),
                g = e.data(t);
            if (g && !f(g)) {
                var h, i = {};
                if (c) {
                    if (i = g.secondary, !d && void 0 !== typeof g.meta.left_o || void 0 !== typeof g.meta.top_o)
                        for (i.left = void 0 !== typeof g.meta.left_o ? g.meta.left_o : "auto", i.top = void 0 !== typeof g.meta.top_o ? g.meta.top_o : "auto", h = o.length - 1; 0 <= h; h--) i[o[h] + "transform"] = ""
                } else if (!f(g.secondary)) {
                    var j = window.getComputedStyle(e[0], null);
                    if (j)
                        for (var k in g.secondary)
                            if (g.secondary.hasOwnProperty(k) && (k = k.replace(r, "-$1").toLowerCase(), i[k] = j.getPropertyValue(k), !d && /matrix/i.test(i[k])))
                                for (h = i[k].replace(/^matrix\(/i, "").split(/, |\)$/g), i.left = parseFloat(h[4]) + parseFloat(e.css("left")) + "px" || "auto", i.top = parseFloat(h[5]) + parseFloat(e.css("top")) + "px" || "auto", h = o.length - 1; 0 <= h; h--) i[o[h] + "transform"] = ""
                }
                e.unbind("webkitTransitionEnd oTransitionEnd transitionend"), e.css(g.original).css(i).data(t, null)
            } else l.apply(e, [b, c])
        }), this) : l.apply(this, [b, c])
    }
}),
function() {
    function a() {}

    function b(a, b) {
        for (var c = a.length; c--;)
            if (a[c].listener === b) return c;
        return -1
    }

    function c(a) {
        return function() {
            return this[a].apply(this, arguments)
        }
    }
    var d = a.prototype,
        e = this,
        f = e.EventEmitter;
    d.getListeners = function(a) {
        var b, c, d = this._getEvents();
        if ("object" == typeof a) {
            b = {};
            for (c in d) d.hasOwnProperty(c) && a.test(c) && (b[c] = d[c])
        } else b = d[a] || (d[a] = []);
        return b
    }, d.flattenListeners = function(a) {
        var b, c = [];
        for (b = 0; b < a.length; b += 1) c.push(a[b].listener);
        return c
    }, d.getListenersAsObject = function(a) {
        var b, c = this.getListeners(a);
        return c instanceof Array && (b = {}, b[a] = c), b || c
    }, d.addListener = function(a, c) {
        var d, e = this.getListenersAsObject(a),
            f = "object" == typeof c;
        for (d in e) e.hasOwnProperty(d) && b(e[d], c) === -1 && e[d].push(f ? c : {
            listener: c,
            once: !1
        });
        return this
    }, d.on = c("addListener"), d.addOnceListener = function(a, b) {
        return this.addListener(a, {
            listener: b,
            once: !0
        })
    }, d.once = c("addOnceListener"), d.defineEvent = function(a) {
        return this.getListeners(a), this
    }, d.defineEvents = function(a) {
        for (var b = 0; b < a.length; b += 1) this.defineEvent(a[b]);
        return this
    }, d.removeListener = function(a, c) {
        var d, e, f = this.getListenersAsObject(a);
        for (e in f) f.hasOwnProperty(e) && (d = b(f[e], c), d !== -1 && f[e].splice(d, 1));
        return this
    }, d.off = c("removeListener"), d.addListeners = function(a, b) {
        return this.manipulateListeners(!1, a, b)
    }, d.removeListeners = function(a, b) {
        return this.manipulateListeners(!0, a, b)
    }, d.manipulateListeners = function(a, b, c) {
        var d, e, f = a ? this.removeListener : this.addListener,
            g = a ? this.removeListeners : this.addListeners;
        if ("object" != typeof b || b instanceof RegExp)
            for (d = c.length; d--;) f.call(this, b, c[d]);
        else
            for (d in b) b.hasOwnProperty(d) && (e = b[d]) && ("function" == typeof e ? f.call(this, d, e) : g.call(this, d, e));
        return this
    }, d.removeEvent = function(a) {
        var b, c = typeof a,
            d = this._getEvents();
        if ("string" === c) delete d[a];
        else if ("object" === c)
            for (b in d) d.hasOwnProperty(b) && a.test(b) && delete d[b];
        else delete this._events;
        return this
    }, d.removeAllListeners = c("removeEvent"), d.emitEvent = function(a, b) {
        var c, d, e, f, g = this.getListenersAsObject(a);
        for (e in g)
            if (g.hasOwnProperty(e))
                for (d = g[e].length; d--;) c = g[e][d], c.once === !0 && this.removeListener(a, c.listener), f = c.listener.apply(this, b || []), f === this._getOnceReturnValue() && this.removeListener(a, c.listener);
        return this
    }, d.trigger = c("emitEvent"), d.emit = function(a) {
        var b = Array.prototype.slice.call(arguments, 1);
        return this.emitEvent(a, b)
    }, d.setOnceReturnValue = function(a) {
        return this._onceReturnValue = a, this
    }, d._getOnceReturnValue = function() {
        return !this.hasOwnProperty("_onceReturnValue") || this._onceReturnValue
    }, d._getEvents = function() {
        return this._events || (this._events = {})
    }, a.noConflict = function() {
        return e.EventEmitter = f, a
    }, "function" == typeof define && define.amd ? define("eventEmitter/EventEmitter", [], function() {
        return a
    }) : "object" == typeof module && module.exports ? module.exports = a : this.EventEmitter = a
}.call(this),
    function(a) {
        function b(b) {
            var c = a.event;
            return c.target = c.target || c.srcElement || b, c
        }
        var c = document.documentElement,
            d = function() {};
        c.addEventListener ? d = function(a, b, c) {
            a.addEventListener(b, c, !1)
        } : c.attachEvent && (d = function(a, c, d) {
            a[c + d] = d.handleEvent ? function() {
                var c = b(a);
                d.handleEvent.call(d, c)
            } : function() {
                var c = b(a);
                d.call(a, c)
            }, a.attachEvent("on" + c, a[c + d])
        });
        var e = function() {};
        c.removeEventListener ? e = function(a, b, c) {
            a.removeEventListener(b, c, !1)
        } : c.detachEvent && (e = function(a, b, c) {
            a.detachEvent("on" + b, a[b + c]);
            try {
                delete a[b + c]
            } catch (d) {
                a[b + c] = void 0
            }
        });
        var f = {
            bind: d,
            unbind: e
        };
        "function" == typeof define && define.amd ? define("eventie/eventie", f) : a.eventie = f
    }(this),
    function(a, b) {
        "function" == typeof define && define.amd ? define(["eventEmitter/EventEmitter", "eventie/eventie"], function(c, d) {
            return b(a, c, d)
        }) : "object" == typeof exports ? module.exports = b(a, require("wolfy87-eventemitter"), require("eventie")) : a.imagesLoaded = b(a, a.EventEmitter, a.eventie)
    }(window, function(a, b, c) {
        function d(a, b) {
            for (var c in b) a[c] = b[c];
            return a
        }

        function e(a) {
            return "[object Array]" === m.call(a)
        }

        function f(a) {
            var b = [];
            if (e(a)) b = a;
            else if ("number" == typeof a.length)
                for (var c = 0, d = a.length; c < d; c++) b.push(a[c]);
            else b.push(a);
            return b
        }

        function g(a, b, c) {
            if (!(this instanceof g)) return new g(a, b);
            "string" == typeof a && (a = document.querySelectorAll(a)), this.elements = f(a), this.options = d({}, this.options), "function" == typeof b ? c = b : d(this.options, b), c && this.on("always", c), this.getImages(), j && (this.jqDeferred = new j.Deferred);
            var e = this;
            setTimeout(function() {
                e.check()
            })
        }

        function h(a) {
            this.img = a
        }

        function i(a) {
            this.src = a, n[a] = this
        }
        var j = a.jQuery,
            k = a.console,
            l = "undefined" != typeof k,
            m = Object.prototype.toString;
        g.prototype = new b, g.prototype.options = {}, g.prototype.getImages = function() {
            this.images = [];
            for (var a = 0, b = this.elements.length; a < b; a++) {
                var c = this.elements[a];
                "IMG" === c.nodeName && this.addImage(c);
                var d = c.nodeType;
                if (d && (1 === d || 9 === d || 11 === d))
                    for (var e = c.querySelectorAll("img"), f = 0, g = e.length; f < g; f++) {
                        var h = e[f];
                        this.addImage(h)
                    }
            }
        }, g.prototype.addImage = function(a) {
            var b = new h(a);
            this.images.push(b)
        }, g.prototype.check = function() {
            function a(a, e) {
                return b.options.debug && l && k.log("confirm", a, e), b.progress(a), c++, c === d && b.complete(), !0
            }
            var b = this,
                c = 0,
                d = this.images.length;
            if (this.hasAnyBroken = !1, !d) return void this.complete();
            for (var e = 0; e < d; e++) {
                var f = this.images[e];
                f.on("confirm", a), f.check()
            }
        }, g.prototype.progress = function(a) {
            this.hasAnyBroken = this.hasAnyBroken || !a.isLoaded;
            var b = this;
            setTimeout(function() {
                b.emit("progress", b, a), b.jqDeferred && b.jqDeferred.notify && b.jqDeferred.notify(b, a)
            })
        }, g.prototype.complete = function() {
            var a = this.hasAnyBroken ? "fail" : "done";
            this.isComplete = !0;
            var b = this;
            setTimeout(function() {
                if (b.emit(a, b), b.emit("always", b), b.jqDeferred) {
                    var c = b.hasAnyBroken ? "reject" : "resolve";
                    b.jqDeferred[c](b)
                }
            })
        }, j && (j.fn.imagesLoaded = function(a, b) {
            var c = new g(this, a, b);
            return c.jqDeferred.promise(j(this))
        }), h.prototype = new b, h.prototype.check = function() {
            var a = n[this.img.src] || new i(this.img.src);
            if (a.isConfirmed) return void this.confirm(a.isLoaded, "cached was confirmed");
            if (this.img.complete && void 0 !== this.img.naturalWidth) return void this.confirm(0 !== this.img.naturalWidth, "naturalWidth");
            var b = this;
            a.on("confirm", function(a, c) {
                return b.confirm(a.isLoaded, c), !0
            }), a.check()
        }, h.prototype.confirm = function(a, b) {
            this.isLoaded = a, this.emit("confirm", this, b)
        };
        var n = {};
        return i.prototype = new b, i.prototype.check = function() {
            if (!this.isChecked) {
                var a = new Image;
                c.bind(a, "load", this), c.bind(a, "error", this), a.src = this.src, this.isChecked = !0
            }
        }, i.prototype.handleEvent = function(a) {
            var b = "on" + a.type;
            this[b] && this[b](a)
        }, i.prototype.onload = function(a) {
            this.confirm(!0, "onload"), this.unbindProxyEvents(a)
        }, i.prototype.onerror = function(a) {
            this.confirm(!1, "onerror"), this.unbindProxyEvents(a)
        }, i.prototype.confirm = function(a, b) {
            this.isConfirmed = !0, this.isLoaded = a, this.emit("confirm", this, b)
        }, i.prototype.unbindProxyEvents = function(a) {
            c.unbind(a.target, "load", this), c.unbind(a.target, "error", this)
        }, g
    }),
    function(a) {
        "undefined" == typeof a.fn.each2 && a.extend(a.fn, {
            each2: function(b) {
                for (var c = a([0]), d = -1, e = this.length; ++d < e && (c.context = c[0] = this[d]) && b.call(c[0], d, c) !== !1;);
                return this
            }
        })
    }(jQuery),
    function(a, b) {
        "use strict";

        function c(b) {
            var c = a(document.createTextNode(""));
            b.before(c), c.before(b), c.remove()
        }

        function d(a) {
            function b(a) {
                return O[a] || a
            }
            return a.replace(/[^\u0000-\u007E]/g, b)
        }

        function e(a, b) {
            for (var c = 0, d = b.length; c < d; c += 1)
                if (g(a, b[c])) return c;
            return -1
        }

        function f() {
            var b = a(N);
            b.appendTo(document.body);
            var c = {
                width: b.width() - b[0].clientWidth,
                height: b.height() - b[0].clientHeight
            };
            return b.remove(), c
        }

        function g(a, c) {
            return a === c || a !== b && c !== b && (null !== a && null !== c && (a.constructor === String ? a + "" == c + "" : c.constructor === String && c + "" == a + ""))
        }

        function h(a, b, c) {
            var d, e, f;
            if (null === a || a.length < 1) return [];
            for (d = a.split(b), e = 0, f = d.length; e < f; e += 1) d[e] = c(d[e]);
            return d
        }

        function i(a) {
            return a.outerWidth(!1) - a.width()
        }

        function j(c) {
            var d = "keyup-change-value";
            c.on("keydown", function() {
                a.data(c, d) === b && a.data(c, d, c.val())
            }), c.on("keyup", function() {
                var e = a.data(c, d);
                e !== b && c.val() !== e && (a.removeData(c, d), c.trigger("keyup-change"))
            })
        }

        function k(c) {
            c.on("mousemove", function(c) {
                var d = L;
                d !== b && d.x === c.pageX && d.y === c.pageY || a(c.target).trigger("mousemove-filtered", c)
            })
        }

        function l(a, c, d) {
            d = d || b;
            var e;
            return function() {
                var b = arguments;
                window.clearTimeout(e), e = window.setTimeout(function() {
                    c.apply(d, b)
                }, a)
            }
        }

        function m(a, b) {
            var c = l(a, function(a) {
                b.trigger("scroll-debounced", a)
            });
            b.on("scroll", function(a) {
                e(a.target, b.get()) >= 0 && c(a)
            })
        }

        function n(a) {
            a[0] !== document.activeElement && window.setTimeout(function() {
                var b, c = a[0],
                    d = a.val().length;
                a.focus();
                var e = c.offsetWidth > 0 || c.offsetHeight > 0;
                e && c === document.activeElement && (c.setSelectionRange ? c.setSelectionRange(d, d) : c.createTextRange && (b = c.createTextRange(), b.collapse(!1), b.select()))
            }, 0)
        }

        function o(b) {
            b = a(b)[0];
            var c = 0,
                d = 0;
            if ("selectionStart" in b) c = b.selectionStart, d = b.selectionEnd - c;
            else if ("selection" in document) {
                b.focus();
                var e = document.selection.createRange();
                d = document.selection.createRange().text.length, e.moveStart("character", -b.value.length), c = e.text.length - d
            }
            return {
                offset: c,
                length: d
            }
        }

        function p(a) {
            a.preventDefault(), a.stopPropagation()
        }

        function q(a) {
            a.preventDefault(), a.stopImmediatePropagation()
        }

        function r(b) {
            if (!I) {
                var c = b[0].currentStyle || window.getComputedStyle(b[0], null);
                I = a(document.createElement("div")).css({
                    position: "absolute",
                    left: "-10000px",
                    top: "-10000px",
                    display: "none",
                    fontSize: c.fontSize,
                    fontFamily: c.fontFamily,
                    fontStyle: c.fontStyle,
                    fontWeight: c.fontWeight,
                    letterSpacing: c.letterSpacing,
                    textTransform: c.textTransform,
                    whiteSpace: "nowrap"
                }), I.attr("class", "select2-sizer"), a(document.body).append(I)
            }
            return I.text(b.val()), I.width()
        }

        function s(b, c, d) {
            var e, f, g = [];
            e = a.trim(b.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each2(function() {
                0 === this.indexOf("select2-") && g.push(this)
            })), e = a.trim(c.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each2(function() {
                0 !== this.indexOf("select2-") && (f = d(this), f && g.push(f))
            })), b.attr("class", g.join(" "))
        }

        function t(a, b, c, e) {
            var f = d(a.toUpperCase()).indexOf(d(b.toUpperCase())),
                g = b.length;
            return f < 0 ? void c.push(e(a)) : (c.push(e(a.substring(0, f))), c.push("<span class='select2-match'>"), c.push(e(a.substring(f, f + g))), c.push("</span>"), void c.push(e(a.substring(f + g, a.length))))
        }

        function u(a) {
            var b = {
                "\\": "&#92;",
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#47;"
            };
            return String(a).replace(/[&<>"'\/\\]/g, function(a) {
                return b[a]
            })
        }

        function v(c) {
            var d, e = null,
                f = c.quietMillis || 100,
                g = c.url,
                h = this;
            return function(i) {
                window.clearTimeout(d), d = window.setTimeout(function() {
                    var d = c.data,
                        f = g,
                        j = c.transport || a.fn.select2.ajaxDefaults.transport,
                        k = {
                            type: c.type || "GET",
                            cache: c.cache || !1,
                            jsonpCallback: c.jsonpCallback || b,
                            dataType: c.dataType || "json"
                        },
                        l = a.extend({}, a.fn.select2.ajaxDefaults.params, k);
                    d = d ? d.call(h, i.term, i.page, i.context) : null, f = "function" == typeof f ? f.call(h, i.term, i.page, i.context) : f, e && "function" == typeof e.abort && e.abort(), c.params && (a.isFunction(c.params) ? a.extend(l, c.params.call(h)) : a.extend(l, c.params)), a.extend(l, {
                        url: f,
                        dataType: c.dataType,
                        data: d,
                        success: function(a) {
                            var b = c.results(a, i.page, i);
                            i.callback(b)
                        },
                        error: function(a, b, c) {
                            var d = {
                                hasError: !0,
                                jqXHR: a,
                                textStatus: b,
                                errorThrown: c
                            };
                            i.callback(d)
                        }
                    }), e = j.call(h, l)
                }, f)
            }
        }

        function w(b) {
            var c, d, e = b,
                f = function(a) {
                    return "" + a.text
                };
            a.isArray(e) && (d = e, e = {
                results: d
            }), a.isFunction(e) === !1 && (d = e, e = function() {
                return d
            });
            var g = e();
            return g.text && (f = g.text, a.isFunction(f) || (c = g.text, f = function(a) {
                    return a[c]
                })),
                function(b) {
                    var c, d = b.term,
                        g = {
                            results: []
                        };
                    return "" === d ? void b.callback(e()) : (c = function(e, g) {
                        var h, i;
                        if (e = e[0], e.children) {
                            h = {};
                            for (i in e) e.hasOwnProperty(i) && (h[i] = e[i]);
                            h.children = [], a(e.children).each2(function(a, b) {
                                c(b, h.children)
                            }), (h.children.length || b.matcher(d, f(h), e)) && g.push(h)
                        } else b.matcher(d, f(e), e) && g.push(e)
                    }, a(e().results).each2(function(a, b) {
                        c(b, g.results)
                    }), void b.callback(g))
                }
        }

        function x(c) {
            var d = a.isFunction(c);
            return function(e) {
                var f = e.term,
                    g = {
                        results: []
                    },
                    h = d ? c(e) : c;
                a.isArray(h) && (a(h).each(function() {
                    var a = this.text !== b,
                        c = a ? this.text : this;
                    ("" === f || e.matcher(f, c)) && g.results.push(a ? this : {
                        id: this,
                        text: this
                    })
                }), e.callback(g))
            }
        }

        function y(b, c) {
            if (a.isFunction(b)) return !0;
            if (!b) return !1;
            if ("string" == typeof b) return !0;
            throw new Error(c + " must be a string, function, or falsy value")
        }

        function z(b, c) {
            if (a.isFunction(b)) {
                var d = Array.prototype.slice.call(arguments, 2);
                return b.apply(c, d)
            }
            return b
        }

        function A(b) {
            var c = 0;
            return a.each(b, function(a, b) {
                b.children ? c += A(b.children) : c++
            }), c
        }

        function B(a, c, d, e) {
            var f, h, i, j, k, l = a,
                m = !1;
            if (!e.createSearchChoice || !e.tokenSeparators || e.tokenSeparators.length < 1) return b;
            for (;;) {
                for (h = -1, i = 0, j = e.tokenSeparators.length; i < j && (k = e.tokenSeparators[i], h = a.indexOf(k), !(h >= 0)); i++);
                if (h < 0) break;
                if (f = a.substring(0, h), a = a.substring(h + k.length), f.length > 0 && (f = e.createSearchChoice.call(this, f, c), f !== b && null !== f && e.id(f) !== b && null !== e.id(f))) {
                    for (m = !1, i = 0, j = c.length; i < j; i++)
                        if (g(e.id(f), e.id(c[i]))) {
                            m = !0;
                            break
                        }
                    m || d(f)
                }
            }
            return l !== a ? a : void 0
        }

        function C() {
            var b = this;
            a.each(arguments, function(a, c) {
                b[c].remove(), b[c] = null
            })
        }

        function D(b, c) {
            var d = function() {};
            return d.prototype = new b, d.prototype.constructor = d, d.prototype.parent = b.prototype, d.prototype = a.extend(d.prototype, c), d
        }
        if (window.Select2 === b) {
            var E, F, G, H, I, J, K, L = {
                    x: 0,
                    y: 0
                },
                M = {
                    TAB: 9,
                    ENTER: 13,
                    ESC: 27,
                    SPACE: 32,
                    LEFT: 37,
                    UP: 38,
                    RIGHT: 39,
                    DOWN: 40,
                    SHIFT: 16,
                    CTRL: 17,
                    ALT: 18,
                    PAGE_UP: 33,
                    PAGE_DOWN: 34,
                    HOME: 36,
                    END: 35,
                    BACKSPACE: 8,
                    DELETE: 46,
                    isArrow: function(a) {
                        switch (a = a.which ? a.which : a) {
                            case M.LEFT:
                            case M.RIGHT:
                            case M.UP:
                            case M.DOWN:
                                return !0
                        }
                        return !1
                    },
                    isControl: function(a) {
                        var b = a.which;
                        switch (b) {
                            case M.SHIFT:
                            case M.CTRL:
                            case M.ALT:
                                return !0
                        }
                        return !!a.metaKey
                    },
                    isFunctionKey: function(a) {
                        return a = a.which ? a.which : a, a >= 112 && a <= 123
                    }
                },
                N = "<div class='select2-measure-scrollbar'></div>",
                O = {
                    "Ⓐ": "A",
                    "Ａ": "A",
                    "À": "A",
                    "Á": "A",
                    "Â": "A",
                    "Ầ": "A",
                    "Ấ": "A",
                    "Ẫ": "A",
                    "Ẩ": "A",
                    "Ã": "A",
                    "Ā": "A",
                    "Ă": "A",
                    "Ằ": "A",
                    "Ắ": "A",
                    "Ẵ": "A",
                    "Ẳ": "A",
                    "Ȧ": "A",
                    "Ǡ": "A",
                    "Ä": "A",
                    "Ǟ": "A",
                    "Ả": "A",
                    "Å": "A",
                    "Ǻ": "A",
                    "Ǎ": "A",
                    "Ȁ": "A",
                    "Ȃ": "A",
                    "Ạ": "A",
                    "Ậ": "A",
                    "Ặ": "A",
                    "Ḁ": "A",
                    "Ą": "A",
                    "Ⱥ": "A",
                    "Ɐ": "A",
                    "Ꜳ": "AA",
                    "Æ": "AE",
                    "Ǽ": "AE",
                    "Ǣ": "AE",
                    "Ꜵ": "AO",
                    "Ꜷ": "AU",
                    "Ꜹ": "AV",
                    "Ꜻ": "AV",
                    "Ꜽ": "AY",
                    "Ⓑ": "B",
                    "Ｂ": "B",
                    "Ḃ": "B",
                    "Ḅ": "B",
                    "Ḇ": "B",
                    "Ƀ": "B",
                    "Ƃ": "B",
                    "Ɓ": "B",
                    "Ⓒ": "C",
                    "Ｃ": "C",
                    "Ć": "C",
                    "Ĉ": "C",
                    "Ċ": "C",
                    "Č": "C",
                    "Ç": "C",
                    "Ḉ": "C",
                    "Ƈ": "C",
                    "Ȼ": "C",
                    "Ꜿ": "C",
                    "Ⓓ": "D",
                    "Ｄ": "D",
                    "Ḋ": "D",
                    "Ď": "D",
                    "Ḍ": "D",
                    "Ḑ": "D",
                    "Ḓ": "D",
                    "Ḏ": "D",
                    "Đ": "D",
                    "Ƌ": "D",
                    "Ɗ": "D",
                    "Ɖ": "D",
                    "Ꝺ": "D",
                    "Ǳ": "DZ",
                    "Ǆ": "DZ",
                    "ǲ": "Dz",
                    "ǅ": "Dz",
                    "Ⓔ": "E",
                    "Ｅ": "E",
                    "È": "E",
                    "É": "E",
                    "Ê": "E",
                    "Ề": "E",
                    "Ế": "E",
                    "Ễ": "E",
                    "Ể": "E",
                    "Ẽ": "E",
                    "Ē": "E",
                    "Ḕ": "E",
                    "Ḗ": "E",
                    "Ĕ": "E",
                    "Ė": "E",
                    "Ë": "E",
                    "Ẻ": "E",
                    "Ě": "E",
                    "Ȅ": "E",
                    "Ȇ": "E",
                    "Ẹ": "E",
                    "Ệ": "E",
                    "Ȩ": "E",
                    "Ḝ": "E",
                    "Ę": "E",
                    "Ḙ": "E",
                    "Ḛ": "E",
                    "Ɛ": "E",
                    "Ǝ": "E",
                    "Ⓕ": "F",
                    "Ｆ": "F",
                    "Ḟ": "F",
                    "Ƒ": "F",
                    "Ꝼ": "F",
                    "Ⓖ": "G",
                    "Ｇ": "G",
                    "Ǵ": "G",
                    "Ĝ": "G",
                    "Ḡ": "G",
                    "Ğ": "G",
                    "Ġ": "G",
                    "Ǧ": "G",
                    "Ģ": "G",
                    "Ǥ": "G",
                    "Ɠ": "G",
                    "Ꞡ": "G",
                    "Ᵹ": "G",
                    "Ꝿ": "G",
                    "Ⓗ": "H",
                    "Ｈ": "H",
                    "Ĥ": "H",
                    "Ḣ": "H",
                    "Ḧ": "H",
                    "Ȟ": "H",
                    "Ḥ": "H",
                    "Ḩ": "H",
                    "Ḫ": "H",
                    "Ħ": "H",
                    "Ⱨ": "H",
                    "Ⱶ": "H",
                    "Ɥ": "H",
                    "Ⓘ": "I",
                    "Ｉ": "I",
                    "Ì": "I",
                    "Í": "I",
                    "Î": "I",
                    "Ĩ": "I",
                    "Ī": "I",
                    "Ĭ": "I",
                    "İ": "I",
                    "Ï": "I",
                    "Ḯ": "I",
                    "Ỉ": "I",
                    "Ǐ": "I",
                    "Ȉ": "I",
                    "Ȋ": "I",
                    "Ị": "I",
                    "Į": "I",
                    "Ḭ": "I",
                    "Ɨ": "I",
                    "Ⓙ": "J",
                    "Ｊ": "J",
                    "Ĵ": "J",
                    "Ɉ": "J",
                    "Ⓚ": "K",
                    "Ｋ": "K",
                    "Ḱ": "K",
                    "Ǩ": "K",
                    "Ḳ": "K",
                    "Ķ": "K",
                    "Ḵ": "K",
                    "Ƙ": "K",
                    "Ⱪ": "K",
                    "Ꝁ": "K",
                    "Ꝃ": "K",
                    "Ꝅ": "K",
                    "Ꞣ": "K",
                    "Ⓛ": "L",
                    "Ｌ": "L",
                    "Ŀ": "L",
                    "Ĺ": "L",
                    "Ľ": "L",
                    "Ḷ": "L",
                    "Ḹ": "L",
                    "Ļ": "L",
                    "Ḽ": "L",
                    "Ḻ": "L",
                    "Ł": "L",
                    "Ƚ": "L",
                    "Ɫ": "L",
                    "Ⱡ": "L",
                    "Ꝉ": "L",
                    "Ꝇ": "L",
                    "Ꞁ": "L",
                    "Ǉ": "LJ",
                    "ǈ": "Lj",
                    "Ⓜ": "M",
                    "Ｍ": "M",
                    "Ḿ": "M",
                    "Ṁ": "M",
                    "Ṃ": "M",
                    "Ɱ": "M",
                    "Ɯ": "M",
                    "Ⓝ": "N",
                    "Ｎ": "N",
                    "Ǹ": "N",
                    "Ń": "N",
                    "Ñ": "N",
                    "Ṅ": "N",
                    "Ň": "N",
                    "Ṇ": "N",
                    "Ņ": "N",
                    "Ṋ": "N",
                    "Ṉ": "N",
                    "Ƞ": "N",
                    "Ɲ": "N",
                    "Ꞑ": "N",
                    "Ꞥ": "N",
                    "Ǌ": "NJ",
                    "ǋ": "Nj",
                    "Ⓞ": "O",
                    "Ｏ": "O",
                    "Ò": "O",
                    "Ó": "O",
                    "Ô": "O",
                    "Ồ": "O",
                    "Ố": "O",
                    "Ỗ": "O",
                    "Ổ": "O",
                    "Õ": "O",
                    "Ṍ": "O",
                    "Ȭ": "O",
                    "Ṏ": "O",
                    "Ō": "O",
                    "Ṑ": "O",
                    "Ṓ": "O",
                    "Ŏ": "O",
                    "Ȯ": "O",
                    "Ȱ": "O",
                    "Ö": "O",
                    "Ȫ": "O",
                    "Ỏ": "O",
                    "Ő": "O",
                    "Ǒ": "O",
                    "Ȍ": "O",
                    "Ȏ": "O",
                    "Ơ": "O",
                    "Ờ": "O",
                    "Ớ": "O",
                    "Ỡ": "O",
                    "Ở": "O",
                    "Ợ": "O",
                    "Ọ": "O",
                    "Ộ": "O",
                    "Ǫ": "O",
                    "Ǭ": "O",
                    "Ø": "O",
                    "Ǿ": "O",
                    "Ɔ": "O",
                    "Ɵ": "O",
                    "Ꝋ": "O",
                    "Ꝍ": "O",
                    "Ƣ": "OI",
                    "Ꝏ": "OO",
                    "Ȣ": "OU",
                    "Ⓟ": "P",
                    "Ｐ": "P",
                    "Ṕ": "P",
                    "Ṗ": "P",
                    "Ƥ": "P",
                    "Ᵽ": "P",
                    "Ꝑ": "P",
                    "Ꝓ": "P",
                    "Ꝕ": "P",
                    "Ⓠ": "Q",
                    "Ｑ": "Q",
                    "Ꝗ": "Q",
                    "Ꝙ": "Q",
                    "Ɋ": "Q",
                    "Ⓡ": "R",
                    "Ｒ": "R",
                    "Ŕ": "R",
                    "Ṙ": "R",
                    "Ř": "R",
                    "Ȑ": "R",
                    "Ȓ": "R",
                    "Ṛ": "R",
                    "Ṝ": "R",
                    "Ŗ": "R",
                    "Ṟ": "R",
                    "Ɍ": "R",
                    "Ɽ": "R",
                    "Ꝛ": "R",
                    "Ꞧ": "R",
                    "Ꞃ": "R",
                    "Ⓢ": "S",
                    "Ｓ": "S",
                    "ẞ": "S",
                    "Ś": "S",
                    "Ṥ": "S",
                    "Ŝ": "S",
                    "Ṡ": "S",
                    "Š": "S",
                    "Ṧ": "S",
                    "Ṣ": "S",
                    "Ṩ": "S",
                    "Ș": "S",
                    "Ş": "S",
                    "Ȿ": "S",
                    "Ꞩ": "S",
                    "Ꞅ": "S",
                    "Ⓣ": "T",
                    "Ｔ": "T",
                    "Ṫ": "T",
                    "Ť": "T",
                    "Ṭ": "T",
                    "Ț": "T",
                    "Ţ": "T",
                    "Ṱ": "T",
                    "Ṯ": "T",
                    "Ŧ": "T",
                    "Ƭ": "T",
                    "Ʈ": "T",
                    "Ⱦ": "T",
                    "Ꞇ": "T",
                    "Ꜩ": "TZ",
                    "Ⓤ": "U",
                    "Ｕ": "U",
                    "Ù": "U",
                    "Ú": "U",
                    "Û": "U",
                    "Ũ": "U",
                    "Ṹ": "U",
                    "Ū": "U",
                    "Ṻ": "U",
                    "Ŭ": "U",
                    "Ü": "U",
                    "Ǜ": "U",
                    "Ǘ": "U",
                    "Ǖ": "U",
                    "Ǚ": "U",
                    "Ủ": "U",
                    "Ů": "U",
                    "Ű": "U",
                    "Ǔ": "U",
                    "Ȕ": "U",
                    "Ȗ": "U",
                    "Ư": "U",
                    "Ừ": "U",
                    "Ứ": "U",
                    "Ữ": "U",
                    "Ử": "U",
                    "Ự": "U",
                    "Ụ": "U",
                    "Ṳ": "U",
                    "Ų": "U",
                    "Ṷ": "U",
                    "Ṵ": "U",
                    "Ʉ": "U",
                    "Ⓥ": "V",
                    "Ｖ": "V",
                    "Ṽ": "V",
                    "Ṿ": "V",
                    "Ʋ": "V",
                    "Ꝟ": "V",
                    "Ʌ": "V",
                    "Ꝡ": "VY",
                    "Ⓦ": "W",
                    "Ｗ": "W",
                    "Ẁ": "W",
                    "Ẃ": "W",
                    "Ŵ": "W",
                    "Ẇ": "W",
                    "Ẅ": "W",
                    "Ẉ": "W",
                    "Ⱳ": "W",
                    "Ⓧ": "X",
                    "Ｘ": "X",
                    "Ẋ": "X",
                    "Ẍ": "X",
                    "Ⓨ": "Y",
                    "Ｙ": "Y",
                    "Ỳ": "Y",
                    "Ý": "Y",
                    "Ŷ": "Y",
                    "Ỹ": "Y",
                    "Ȳ": "Y",
                    "Ẏ": "Y",
                    "Ÿ": "Y",
                    "Ỷ": "Y",
                    "Ỵ": "Y",
                    "Ƴ": "Y",
                    "Ɏ": "Y",
                    "Ỿ": "Y",
                    "Ⓩ": "Z",
                    "Ｚ": "Z",
                    "Ź": "Z",
                    "Ẑ": "Z",
                    "Ż": "Z",
                    "Ž": "Z",
                    "Ẓ": "Z",
                    "Ẕ": "Z",
                    "Ƶ": "Z",
                    "Ȥ": "Z",
                    "Ɀ": "Z",
                    "Ⱬ": "Z",
                    "Ꝣ": "Z",
                    "ⓐ": "a",
                    "ａ": "a",
                    "ẚ": "a",
                    "à": "a",
                    "á": "a",
                    "â": "a",
                    "ầ": "a",
                    "ấ": "a",
                    "ẫ": "a",
                    "ẩ": "a",
                    "ã": "a",
                    "ā": "a",
                    "ă": "a",
                    "ằ": "a",
                    "ắ": "a",
                    "ẵ": "a",
                    "ẳ": "a",
                    "ȧ": "a",
                    "ǡ": "a",
                    "ä": "a",
                    "ǟ": "a",
                    "ả": "a",
                    "å": "a",
                    "ǻ": "a",
                    "ǎ": "a",
                    "ȁ": "a",
                    "ȃ": "a",
                    "ạ": "a",
                    "ậ": "a",
                    "ặ": "a",
                    "ḁ": "a",
                    "ą": "a",
                    "ⱥ": "a",
                    "ɐ": "a",
                    "ꜳ": "aa",
                    "æ": "ae",
                    "ǽ": "ae",
                    "ǣ": "ae",
                    "ꜵ": "ao",
                    "ꜷ": "au",
                    "ꜹ": "av",
                    "ꜻ": "av",
                    "ꜽ": "ay",
                    "ⓑ": "b",
                    "ｂ": "b",
                    "ḃ": "b",
                    "ḅ": "b",
                    "ḇ": "b",
                    "ƀ": "b",
                    "ƃ": "b",
                    "ɓ": "b",
                    "ⓒ": "c",
                    "ｃ": "c",
                    "ć": "c",
                    "ĉ": "c",
                    "ċ": "c",
                    "č": "c",
                    "ç": "c",
                    "ḉ": "c",
                    "ƈ": "c",
                    "ȼ": "c",
                    "ꜿ": "c",
                    "ↄ": "c",
                    "ⓓ": "d",
                    "ｄ": "d",
                    "ḋ": "d",
                    "ď": "d",
                    "ḍ": "d",
                    "ḑ": "d",
                    "ḓ": "d",
                    "ḏ": "d",
                    "đ": "d",
                    "ƌ": "d",
                    "ɖ": "d",
                    "ɗ": "d",
                    "ꝺ": "d",
                    "ǳ": "dz",
                    "ǆ": "dz",
                    "ⓔ": "e",
                    "ｅ": "e",
                    "è": "e",
                    "é": "e",
                    "ê": "e",
                    "ề": "e",
                    "ế": "e",
                    "ễ": "e",
                    "ể": "e",
                    "ẽ": "e",
                    "ē": "e",
                    "ḕ": "e",
                    "ḗ": "e",
                    "ĕ": "e",
                    "ė": "e",
                    "ë": "e",
                    "ẻ": "e",
                    "ě": "e",
                    "ȅ": "e",
                    "ȇ": "e",
                    "ẹ": "e",
                    "ệ": "e",
                    "ȩ": "e",
                    "ḝ": "e",
                    "ę": "e",
                    "ḙ": "e",
                    "ḛ": "e",
                    "ɇ": "e",
                    "ɛ": "e",
                    "ǝ": "e",
                    "ⓕ": "f",
                    "ｆ": "f",
                    "ḟ": "f",
                    "ƒ": "f",
                    "ꝼ": "f",
                    "ⓖ": "g",
                    "ｇ": "g",
                    "ǵ": "g",
                    "ĝ": "g",
                    "ḡ": "g",
                    "ğ": "g",
                    "ġ": "g",
                    "ǧ": "g",
                    "ģ": "g",
                    "ǥ": "g",
                    "ɠ": "g",
                    "ꞡ": "g",
                    "ᵹ": "g",
                    "ꝿ": "g",
                    "ⓗ": "h",
                    "ｈ": "h",
                    "ĥ": "h",
                    "ḣ": "h",
                    "ḧ": "h",
                    "ȟ": "h",
                    "ḥ": "h",
                    "ḩ": "h",
                    "ḫ": "h",
                    "ẖ": "h",
                    "ħ": "h",
                    "ⱨ": "h",
                    "ⱶ": "h",
                    "ɥ": "h",
                    "ƕ": "hv",
                    "ⓘ": "i",
                    "ｉ": "i",
                    "ì": "i",
                    "í": "i",
                    "î": "i",
                    "ĩ": "i",
                    "ī": "i",
                    "ĭ": "i",
                    "ï": "i",
                    "ḯ": "i",
                    "ỉ": "i",
                    "ǐ": "i",
                    "ȉ": "i",
                    "ȋ": "i",
                    "ị": "i",
                    "į": "i",
                    "ḭ": "i",
                    "ɨ": "i",
                    "ı": "i",
                    "ⓙ": "j",
                    "ｊ": "j",
                    "ĵ": "j",
                    "ǰ": "j",
                    "ɉ": "j",
                    "ⓚ": "k",
                    "ｋ": "k",
                    "ḱ": "k",
                    "ǩ": "k",
                    "ḳ": "k",
                    "ķ": "k",
                    "ḵ": "k",
                    "ƙ": "k",
                    "ⱪ": "k",
                    "ꝁ": "k",
                    "ꝃ": "k",
                    "ꝅ": "k",
                    "ꞣ": "k",
                    "ⓛ": "l",
                    "ｌ": "l",
                    "ŀ": "l",
                    "ĺ": "l",
                    "ľ": "l",
                    "ḷ": "l",
                    "ḹ": "l",
                    "ļ": "l",
                    "ḽ": "l",
                    "ḻ": "l",
                    "ſ": "l",
                    "ł": "l",
                    "ƚ": "l",
                    "ɫ": "l",
                    "ⱡ": "l",
                    "ꝉ": "l",
                    "ꞁ": "l",
                    "ꝇ": "l",
                    "ǉ": "lj",
                    "ⓜ": "m",
                    "ｍ": "m",
                    "ḿ": "m",
                    "ṁ": "m",
                    "ṃ": "m",
                    "ɱ": "m",
                    "ɯ": "m",
                    "ⓝ": "n",
                    "ｎ": "n",
                    "ǹ": "n",
                    "ń": "n",
                    "ñ": "n",
                    "ṅ": "n",
                    "ň": "n",
                    "ṇ": "n",
                    "ņ": "n",
                    "ṋ": "n",
                    "ṉ": "n",
                    "ƞ": "n",
                    "ɲ": "n",
                    "ŉ": "n",
                    "ꞑ": "n",
                    "ꞥ": "n",
                    "ǌ": "nj",
                    "ⓞ": "o",
                    "ｏ": "o",
                    "ò": "o",
                    "ó": "o",
                    "ô": "o",
                    "ồ": "o",
                    "ố": "o",
                    "ỗ": "o",
                    "ổ": "o",
                    "õ": "o",
                    "ṍ": "o",
                    "ȭ": "o",
                    "ṏ": "o",
                    "ō": "o",
                    "ṑ": "o",
                    "ṓ": "o",
                    "ŏ": "o",
                    "ȯ": "o",
                    "ȱ": "o",
                    "ö": "o",
                    "ȫ": "o",
                    "ỏ": "o",
                    "ő": "o",
                    "ǒ": "o",
                    "ȍ": "o",
                    "ȏ": "o",
                    "ơ": "o",
                    "ờ": "o",
                    "ớ": "o",
                    "ỡ": "o",
                    "ở": "o",
                    "ợ": "o",
                    "ọ": "o",
                    "ộ": "o",
                    "ǫ": "o",
                    "ǭ": "o",
                    "ø": "o",
                    "ǿ": "o",
                    "ɔ": "o",
                    "ꝋ": "o",
                    "ꝍ": "o",
                    "ɵ": "o",
                    "ƣ": "oi",
                    "ȣ": "ou",
                    "ꝏ": "oo",
                    "ⓟ": "p",
                    "ｐ": "p",
                    "ṕ": "p",
                    "ṗ": "p",
                    "ƥ": "p",
                    "ᵽ": "p",
                    "ꝑ": "p",
                    "ꝓ": "p",
                    "ꝕ": "p",
                    "ⓠ": "q",
                    "ｑ": "q",
                    "ɋ": "q",
                    "ꝗ": "q",
                    "ꝙ": "q",
                    "ⓡ": "r",
                    "ｒ": "r",
                    "ŕ": "r",
                    "ṙ": "r",
                    "ř": "r",
                    "ȑ": "r",
                    "ȓ": "r",
                    "ṛ": "r",
                    "ṝ": "r",
                    "ŗ": "r",
                    "ṟ": "r",
                    "ɍ": "r",
                    "ɽ": "r",
                    "ꝛ": "r",
                    "ꞧ": "r",
                    "ꞃ": "r",
                    "ⓢ": "s",
                    "ｓ": "s",
                    "ß": "s",
                    "ś": "s",
                    "ṥ": "s",
                    "ŝ": "s",
                    "ṡ": "s",
                    "š": "s",
                    "ṧ": "s",
                    "ṣ": "s",
                    "ṩ": "s",
                    "ș": "s",
                    "ş": "s",
                    "ȿ": "s",
                    "ꞩ": "s",
                    "ꞅ": "s",
                    "ẛ": "s",
                    "ⓣ": "t",
                    "ｔ": "t",
                    "ṫ": "t",
                    "ẗ": "t",
                    "ť": "t",
                    "ṭ": "t",
                    "ț": "t",
                    "ţ": "t",
                    "ṱ": "t",
                    "ṯ": "t",
                    "ŧ": "t",
                    "ƭ": "t",
                    "ʈ": "t",
                    "ⱦ": "t",
                    "ꞇ": "t",
                    "ꜩ": "tz",
                    "ⓤ": "u",
                    "ｕ": "u",
                    "ù": "u",
                    "ú": "u",
                    "û": "u",
                    "ũ": "u",
                    "ṹ": "u",
                    "ū": "u",
                    "ṻ": "u",
                    "ŭ": "u",
                    "ü": "u",
                    "ǜ": "u",
                    "ǘ": "u",
                    "ǖ": "u",
                    "ǚ": "u",
                    "ủ": "u",
                    "ů": "u",
                    "ű": "u",
                    "ǔ": "u",
                    "ȕ": "u",
                    "ȗ": "u",
                    "ư": "u",
                    "ừ": "u",
                    "ứ": "u",
                    "ữ": "u",
                    "ử": "u",
                    "ự": "u",
                    "ụ": "u",
                    "ṳ": "u",
                    "ų": "u",
                    "ṷ": "u",
                    "ṵ": "u",
                    "ʉ": "u",
                    "ⓥ": "v",
                    "ｖ": "v",
                    "ṽ": "v",
                    "ṿ": "v",
                    "ʋ": "v",
                    "ꝟ": "v",
                    "ʌ": "v",
                    "ꝡ": "vy",
                    "ⓦ": "w",
                    "ｗ": "w",
                    "ẁ": "w",
                    "ẃ": "w",
                    "ŵ": "w",
                    "ẇ": "w",
                    "ẅ": "w",
                    "ẘ": "w",
                    "ẉ": "w",
                    "ⱳ": "w",
                    "ⓧ": "x",
                    "ｘ": "x",
                    "ẋ": "x",
                    "ẍ": "x",
                    "ⓨ": "y",
                    "ｙ": "y",
                    "ỳ": "y",
                    "ý": "y",
                    "ŷ": "y",
                    "ỹ": "y",
                    "ȳ": "y",
                    "ẏ": "y",
                    "ÿ": "y",
                    "ỷ": "y",
                    "ẙ": "y",
                    "ỵ": "y",
                    "ƴ": "y",
                    "ɏ": "y",
                    "ỿ": "y",
                    "ⓩ": "z",
                    "ｚ": "z",
                    "ź": "z",
                    "ẑ": "z",
                    "ż": "z",
                    "ž": "z",
                    "ẓ": "z",
                    "ẕ": "z",
                    "ƶ": "z",
                    "ȥ": "z",
                    "ɀ": "z",
                    "ⱬ": "z",
                    "ꝣ": "z",
                    "Ά": "Α",
                    "Έ": "Ε",
                    "Ή": "Η",
                    "Ί": "Ι",
                    "Ϊ": "Ι",
                    "Ό": "Ο",
                    "Ύ": "Υ",
                    "Ϋ": "Υ",
                    "Ώ": "Ω",
                    "ά": "α",
                    "έ": "ε",
                    "ή": "η",
                    "ί": "ι",
                    "ϊ": "ι",
                    "ΐ": "ι",
                    "ό": "ο",
                    "ύ": "υ",
                    "ϋ": "υ",
                    "ΰ": "υ",
                    "ω": "ω",
                    "ς": "σ"
                };
            J = a(document), H = function() {
                var a = 1;
                return function() {
                    return a++
                }

            }(), E = D(Object, {
                bind: function(a) {
                    var b = this;
                    return function() {
                        a.apply(b, arguments)
                    }
                },
                init: function(c) {
                    var d, e, g = ".select2-results";
                    this.opts = c = this.prepareOpts(c), this.id = c.id, c.element.data("select2") !== b && null !== c.element.data("select2") && c.element.data("select2").destroy(), this.container = this.createContainer(), this.liveRegion = a(".select2-hidden-accessible"), 0 == this.liveRegion.length && (this.liveRegion = a("<span>", {
                        role: "status",
                        "aria-live": "polite"
                    }).addClass("select2-hidden-accessible").appendTo(document.body)), this.containerId = "s2id_" + (c.element.attr("id") || "autogen" + H()), this.containerEventName = this.containerId.replace(/([.])/g, "_").replace(/([;&,\-\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, "\\$1"), this.container.attr("id", this.containerId), this.container.attr("title", c.element.attr("title")), this.body = a(document.body), s(this.container, this.opts.element, this.opts.adaptContainerCssClass), this.container.attr("style", c.element.attr("style")), this.container.css(z(c.containerCss, this.opts.element)), this.container.addClass(z(c.containerCssClass, this.opts.element)), this.elementTabIndex = this.opts.element.attr("tabindex"), this.opts.element.data("select2", this).attr("tabindex", "-1").before(this.container).on("click.select2", p), this.container.data("select2", this), this.dropdown = this.container.find(".select2-drop"), s(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass), this.dropdown.addClass(z(c.dropdownCssClass, this.opts.element)), this.dropdown.data("select2", this), this.dropdown.on("click", p), this.results = d = this.container.find(g), this.search = e = this.container.find("input.select2-input"), this.queryCount = 0, this.resultsPage = 0, this.context = null, this.initContainer(), this.container.on("click", p), k(this.results), this.dropdown.on("mousemove-filtered", g, this.bind(this.highlightUnderEvent)), this.dropdown.on("touchstart touchmove touchend", g, this.bind(function(a) {
                        this._touchEvent = !0, this.highlightUnderEvent(a)
                    })), this.dropdown.on("touchmove", g, this.bind(this.touchMoved)), this.dropdown.on("touchstart touchend", g, this.bind(this.clearTouchMoved)), this.dropdown.on("click", this.bind(function(a) {
                        this._touchEvent && (this._touchEvent = !1, this.selectHighlighted())
                    })), m(80, this.results), this.dropdown.on("scroll-debounced", g, this.bind(this.loadMoreIfNeeded)), a(this.container).on("change", ".select2-input", function(a) {
                        a.stopPropagation()
                    }), a(this.dropdown).on("change", ".select2-input", function(a) {
                        a.stopPropagation()
                    }), a.fn.mousewheel && d.mousewheel(function(a, b, c, e) {
                        var f = d.scrollTop();
                        e > 0 && f - e <= 0 ? (d.scrollTop(0), p(a)) : e < 0 && d.get(0).scrollHeight - d.scrollTop() + e <= d.height() && (d.scrollTop(d.get(0).scrollHeight - d.height()), p(a))
                    }), j(e), e.on("keyup-change input paste", this.bind(this.updateResults)), e.on("focus", function() {
                        e.addClass("select2-focused")
                    }), e.on("blur", function() {
                        e.removeClass("select2-focused")
                    }), this.dropdown.on("mouseup", g, this.bind(function(b) {
                        a(b.target).closest(".select2-result-selectable").length > 0 && (this.highlightUnderEvent(b), this.selectHighlighted(b))
                    })), this.dropdown.on("click mouseup mousedown touchstart touchend focusin", function(a) {
                        a.stopPropagation()
                    }), this.lastSearchTerm = b, a.isFunction(this.opts.initSelection) && (this.initSelection(), this.monitorSource()), null !== c.maximumInputLength && this.search.attr("maxlength", c.maximumInputLength);
                    var h = c.element.prop("disabled");
                    h === b && (h = !1), this.enable(!h);
                    var i = c.element.prop("readonly");
                    i === b && (i = !1), this.readonly(i), K = K || f(), this.autofocus = c.element.prop("autofocus"), c.element.prop("autofocus", !1), this.autofocus && this.focus(), this.search.attr("placeholder", c.searchInputPlaceholder)
                },
                destroy: function() {
                    var a = this.opts.element,
                        c = a.data("select2"),
                        d = this;
                    this.close(), a.length && a[0].detachEvent && d._sync && a.each(function() {
                        d._sync && this.detachEvent("onpropertychange", d._sync)
                    }), this.propertyObserver && (this.propertyObserver.disconnect(), this.propertyObserver = null), this._sync = null, c !== b && (c.container.remove(), c.liveRegion.remove(), c.dropdown.remove(), a.removeData("select2").off(".select2"), a.is("input[type='hidden']") ? a.css("display", "") : (a.show().prop("autofocus", this.autofocus || !1), this.elementTabIndex ? a.attr({
                        tabindex: this.elementTabIndex
                    }) : a.removeAttr("tabindex"), a.show())), C.call(this, "container", "liveRegion", "dropdown", "results", "search")
                },
                optionToData: function(a) {
                    return a.is("option") ? {
                        id: a.prop("value"),
                        text: a.text(),
                        element: a.get(),
                        css: a.attr("class"),
                        disabled: a.prop("disabled"),
                        locked: g(a.attr("locked"), "locked") || g(a.data("locked"), !0)
                    } : a.is("optgroup") ? {
                        text: a.attr("label"),
                        children: [],
                        element: a.get(),
                        css: a.attr("class")
                    } : void 0
                },
                prepareOpts: function(c) {
                    var d, e, f, i, j = this;
                    if (d = c.element, "select" === d.get(0).tagName.toLowerCase() && (this.select = e = c.element), e && a.each(["id", "multiple", "ajax", "query", "createSearchChoice", "initSelection", "data", "tags"], function() {
                            if (this in c) throw new Error("Option '" + this + "' is not allowed for Select2 when attached to a <select> element.")
                        }), c.debug = c.debug || a.fn.select2.defaults.debug, c.debug && console && console.warn && (null != c.id && console.warn("Select2: The `id` option has been removed in Select2 4.0.0, consider renaming your `id` property or mapping the property before your data makes it to Select2. You can read more at https://select2.github.io/announcements-4.0.html#changed-id"), null != c.text && console.warn("Select2: The `text` option has been removed in Select2 4.0.0, consider renaming your `text` property or mapping the property before your data makes it to Select2. You can read more at https://select2.github.io/announcements-4.0.html#changed-id"), null != c.sortResults && console.warn("Select2: the `sortResults` option has been renamed to `sorter` in Select2 4.0.0. "), null != c.selectOnBlur && console.warn("Select2: The `selectOnBlur` option has been renamed to `selectOnClose` in Select2 4.0.0."), null != c.ajax && null != c.ajax.results && console.warn("Select2: The `ajax.results` option has been renamed to `ajax.processResults` in Select2 4.0.0."), null != c.formatNoResults && console.warn("Select2: The `formatNoResults` option has been renamed to `language.noResults` in Select2 4.0.0."), null != c.formatSearching && console.warn("Select2: The `formatSearching` option has been renamed to `language.searching` in Select2 4.0.0."), null != c.formatInputTooShort && console.warn("Select2: The `formatInputTooShort` option has been renamed to `language.inputTooShort` in Select2 4.0.0."), null != c.formatInputTooLong && console.warn("Select2: The `formatInputTooLong` option has been renamed to `language.inputTooLong` in Select2 4.0.0."), null != c.formatLoading && console.warn("Select2: The `formatLoading` option has been renamed to `language.loadingMore` in Select2 4.0.0."), null != c.formatSelectionTooBig && console.warn("Select2: The `formatSelectionTooBig` option has been renamed to `language.maximumSelected` in Select2 4.0.0."), c.element.data("select2Tags") && console.warn("Select2: The `data-select2-tags` attribute has been renamed to `data-tags` in Select2 4.0.0.")), null != c.element.data("tags")) {
                        var k = c.element.data("tags");
                        a.isArray(k) || (k = []), c.element.data("select2Tags", k)
                    }
                    if (null != c.sorter && (c.sortResults = c.sorter), null != c.selectOnClose && (c.selectOnBlur = c.selectOnClose), null != c.ajax && a.isFunction(c.ajax.processResults) && (c.ajax.results = c.ajax.processResults), null != c.language) {
                        var l = c.language;
                        a.isFunction(l.noMatches) && (c.formatNoMatches = l.noMatches), a.isFunction(l.searching) && (c.formatSearching = l.searching), a.isFunction(l.inputTooShort) && (c.formatInputTooShort = l.inputTooShort), a.isFunction(l.inputTooLong) && (c.formatInputTooLong = l.inputTooLong), a.isFunction(l.loadingMore) && (c.formatLoading = l.loadingMore), a.isFunction(l.maximumSelected) && (c.formatSelectionTooBig = l.maximumSelected)
                    }
                    if (c = a.extend({}, {
                            populateResults: function(d, e, f) {
                                var g, h = this.opts.id,
                                    i = this.liveRegion;
                                (g = function(d, e, k) {
                                    var l, m, n, o, p, q, r, s, t, u;
                                    d = c.sortResults(d, e, f);
                                    var v = [];
                                    for (l = 0, m = d.length; l < m; l += 1) n = d[l], p = n.disabled === !0, o = !p && h(n) !== b, q = n.children && n.children.length > 0, r = a("<li></li>"), r.addClass("select2-results-dept-" + k), r.addClass("select2-result"), r.addClass(o ? "select2-result-selectable" : "select2-result-unselectable"), p && r.addClass("select2-disabled"), q && r.addClass("select2-result-with-children"), r.addClass(j.opts.formatResultCssClass(n)), r.attr("role", "presentation"), s = a(document.createElement("div")), s.addClass("select2-result-label"), s.attr("id", "select2-result-label-" + H()), s.attr("role", "option"), u = c.formatResult(n, s, f, j.opts.escapeMarkup), u !== b && (s.html(u), r.append(s)), q && (t = a("<ul></ul>"), t.addClass("select2-result-sub"), g(n.children, t, k + 1), r.append(t)), r.data("select2-data", n), v.push(r[0]);
                                    e.append(v), i.text(c.formatMatches(d.length))
                                })(e, d, 0)
                            }
                        }, a.fn.select2.defaults, c), "function" != typeof c.id && (f = c.id, c.id = function(a) {
                            return a[f]
                        }), a.isArray(c.element.data("select2Tags"))) {
                        if ("tags" in c) throw "tags specified as both an attribute 'data-select2-tags' and in options of Select2 " + c.element.attr("id");
                        c.tags = c.element.data("select2Tags")
                    }
                    if (e ? (c.query = this.bind(function(a) {
                            var c, e, f, g = {
                                    results: [],
                                    more: !1
                                },
                                h = a.term;
                            f = function(b, c) {
                                var d;
                                b.is("option") ? a.matcher(h, b.text(), b) && c.push(j.optionToData(b)) : b.is("optgroup") && (d = j.optionToData(b), b.children().each2(function(a, b) {
                                    f(b, d.children)
                                }), d.children.length > 0 && c.push(d))
                            }, c = d.children(), this.getPlaceholder() !== b && c.length > 0 && (e = this.getPlaceholderOption(), e && (c = c.not(e))), c.each2(function(a, b) {
                                f(b, g.results)
                            }), a.callback(g)
                        }), c.id = function(a) {
                            return a.id
                        }) : "query" in c || ("ajax" in c ? (i = c.element.data("ajax-url"), i && i.length > 0 && (c.ajax.url = i), c.query = v.call(c.element, c.ajax)) : "data" in c ? c.query = w(c.data) : "tags" in c && (c.query = x(c.tags), c.createSearchChoice === b && (c.createSearchChoice = function(b) {
                            return {
                                id: a.trim(b),
                                text: a.trim(b)
                            }
                        }), c.initSelection === b && (c.initSelection = function(b, d) {
                            var e = [];
                            a(h(b.val(), c.separator, c.transformVal)).each(function() {
                                var b = {
                                        id: this,
                                        text: this
                                    },
                                    d = c.tags;
                                a.isFunction(d) && (d = d()), a(d).each(function() {
                                    if (g(this.id, b.id)) return b = this, !1
                                }), e.push(b)
                            }), d(e)
                        }))), "function" != typeof c.query) throw "query function not defined for Select2 " + c.element.attr("id");
                    if ("top" === c.createSearchChoicePosition) c.createSearchChoicePosition = function(a, b) {
                        a.unshift(b)
                    };
                    else if ("bottom" === c.createSearchChoicePosition) c.createSearchChoicePosition = function(a, b) {
                        a.push(b)
                    };
                    else if ("function" != typeof c.createSearchChoicePosition) throw "invalid createSearchChoicePosition option must be 'top', 'bottom' or a custom function";
                    return c
                },
                monitorSource: function() {
                    var c, d = this.opts.element,
                        e = this;
                    d.on("change.select2", this.bind(function(a) {
                        this.opts.element.data("select2-change-triggered") !== !0 && this.initSelection()
                    })), this._sync = this.bind(function() {
                        var a = d.prop("disabled");
                        a === b && (a = !1), this.enable(!a);
                        var c = d.prop("readonly");
                        c === b && (c = !1), this.readonly(c), this.container && (s(this.container, this.opts.element, this.opts.adaptContainerCssClass), this.container.addClass(z(this.opts.containerCssClass, this.opts.element))), this.dropdown && (s(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass), this.dropdown.addClass(z(this.opts.dropdownCssClass, this.opts.element)))
                    }), d.length && d[0].attachEvent && d.each(function() {
                        this.attachEvent("onpropertychange", e._sync)
                    }), c = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver, c !== b && (this.propertyObserver && (delete this.propertyObserver, this.propertyObserver = null), this.propertyObserver = new c(function(b) {
                        a.each(b, e._sync)
                    }), this.propertyObserver.observe(d.get(0), {
                        attributes: !0,
                        subtree: !1
                    }))
                },
                triggerSelect: function(b) {
                    var c = a.Event("select2-selecting", {
                        val: this.id(b),
                        object: b,
                        choice: b
                    });
                    return this.opts.element.trigger(c), !c.isDefaultPrevented()
                },
                triggerChange: function(b) {
                    b = b || {}, b = a.extend({}, b, {
                        type: "change",
                        val: this.val()
                    }), this.opts.element.data("select2-change-triggered", !0), this.opts.element.trigger(b), this.opts.element.data("select2-change-triggered", !1), this.opts.element.click(), this.opts.blurOnChange && this.opts.element.blur()
                },
                isInterfaceEnabled: function() {
                    return this.enabledInterface === !0
                },
                enableInterface: function() {
                    var a = this._enabled && !this._readonly,
                        b = !a;
                    return a !== this.enabledInterface && (this.container.toggleClass("select2-container-disabled", b), this.close(), this.enabledInterface = a, !0)
                },
                enable: function(a) {
                    a === b && (a = !0), this._enabled !== a && (this._enabled = a, this.opts.element.prop("disabled", !a), this.enableInterface())
                },
                disable: function() {
                    this.enable(!1)
                },
                readonly: function(a) {
                    a === b && (a = !1), this._readonly !== a && (this._readonly = a, this.opts.element.prop("readonly", a), this.enableInterface())
                },
                opened: function() {
                    return !!this.container && this.container.hasClass("select2-dropdown-open")
                },
                positionDropdown: function() {
                    var b, c, d, e, f, g = this.dropdown,
                        h = this.container,
                        i = h.offset(),
                        j = h.outerHeight(!1),
                        k = h.outerWidth(!1),
                        l = g.outerHeight(!1),
                        m = a(window),
                        n = m.width(),
                        o = m.height(),
                        p = m.scrollLeft() + n,
                        q = m.scrollTop() + o,
                        r = i.top + j,
                        s = i.left,
                        t = r + l <= q,
                        u = i.top - l >= m.scrollTop(),
                        v = g.outerWidth(!1),
                        w = function() {
                            return s + v <= p
                        },
                        x = function() {
                            return i.left + p + h.outerWidth(!1) > v
                        },
                        y = g.hasClass("select2-drop-above");
                    y ? (c = !0, !u && t && (d = !0, c = !1)) : (c = !1, !t && u && (d = !0, c = !0)), d && (g.hide(), i = this.container.offset(), j = this.container.outerHeight(!1), k = this.container.outerWidth(!1), l = g.outerHeight(!1), p = m.scrollLeft() + n, q = m.scrollTop() + o, r = i.top + j, s = i.left, v = g.outerWidth(!1), g.show(), this.focusSearch()), this.opts.dropdownAutoWidth ? (f = a(".select2-results", g)[0], g.addClass("select2-drop-auto-width"), g.css("width", ""), v = g.outerWidth(!1) + (f.scrollHeight === f.clientHeight ? 0 : K.width), v > k ? k = v : v = k, l = g.outerHeight(!1)) : this.container.removeClass("select2-drop-auto-width"), "static" !== this.body.css("position") && (b = this.body.offset(), r -= b.top, s -= b.left), !w() && x() && (s = i.left + this.container.outerWidth(!1) - v), e = {
                        left: s,
                        width: k
                    }, c ? (this.container.addClass("select2-drop-above"), g.addClass("select2-drop-above"), l = g.outerHeight(!1), e.top = i.top - l, e.bottom = "auto") : (e.top = r, e.bottom = "auto", this.container.removeClass("select2-drop-above"), g.removeClass("select2-drop-above")), e = a.extend(e, z(this.opts.dropdownCss, this.opts.element)), g.css(e)
                },
                shouldOpen: function() {
                    var b;
                    return !this.opened() && (this._enabled !== !1 && this._readonly !== !0 && (b = a.Event("select2-opening"), this.opts.element.trigger(b), !b.isDefaultPrevented()))
                },
                clearDropdownAlignmentPreference: function() {
                    this.container.removeClass("select2-drop-above"), this.dropdown.removeClass("select2-drop-above")
                },
                open: function() {
                    return !!this.shouldOpen() && (this.opening(), J.on("mousemove.select2Event", function(a) {
                        L.x = a.pageX, L.y = a.pageY
                    }), !0)
                },
                opening: function() {
                    var b, d = this.containerEventName,
                        e = "scroll." + d,
                        f = "resize." + d,
                        g = "orientationchange." + d;
                    this.container.addClass("select2-dropdown-open").addClass("select2-container-active"), this.clearDropdownAlignmentPreference(), this.dropdown[0] !== this.body.children().last()[0] && this.dropdown.detach().appendTo(this.body), b = a("#select2-drop-mask"), 0 === b.length && (b = a(document.createElement("div")), b.attr("id", "select2-drop-mask").attr("class", "select2-drop-mask"), b.hide(), b.appendTo(this.body), b.on("mousedown touchstart click", function(d) {
                        c(b);
                        var e, f = a("#select2-drop");
                        f.length > 0 && (e = f.data("select2"), e.opts.selectOnBlur && e.selectHighlighted({
                            noFocus: !0
                        }), e.close(), d.preventDefault(), d.stopPropagation())
                    })), this.dropdown.prev()[0] !== b[0] && this.dropdown.before(b), a("#select2-drop").removeAttr("id"), this.dropdown.attr("id", "select2-drop"), b.show(), this.positionDropdown(), this.dropdown.show(), this.positionDropdown(), this.dropdown.addClass("select2-drop-active");
                    var h = this;
                    this.container.parents().add(window).each(function() {
                        a(this).on(f + " " + e + " " + g, function(a) {
                            h.opened() && h.positionDropdown()
                        })
                    })
                },
                close: function() {
                    if (this.opened()) {
                        var b = this.containerEventName,
                            c = "scroll." + b,
                            d = "resize." + b,
                            e = "orientationchange." + b;
                        this.container.parents().add(window).each(function() {
                            a(this).off(c).off(d).off(e)
                        }), this.clearDropdownAlignmentPreference(), a("#select2-drop-mask").hide(), this.dropdown.removeAttr("id"), this.dropdown.hide(), this.container.removeClass("select2-dropdown-open").removeClass("select2-container-active"), this.results.empty(), J.off("mousemove.select2Event"), this.clearSearch(), this.search.removeClass("select2-active"), this.search.removeAttr("aria-activedescendant"), this.opts.element.trigger(a.Event("select2-close"))
                    }
                },
                externalSearch: function(a) {
                    this.open(), this.search.val(a), this.updateResults(!1)
                },
                clearSearch: function() {},
                prefillNextSearchTerm: function() {
                    if ("" !== this.search.val()) return !1;
                    var a = this.opts.nextSearchTerm(this.data(), this.lastSearchTerm);
                    return a !== b && (this.search.val(a), this.search.select(), !0)
                },
                getMaximumSelectionSize: function() {
                    return z(this.opts.maximumSelectionSize, this.opts.element)
                },
                ensureHighlightVisible: function() {
                    var b, c, d, e, f, g, h, i, j = this.results;
                    if (c = this.highlight(), !(c < 0)) {
                        if (0 == c) return void j.scrollTop(0);
                        b = this.findHighlightableChoices().find(".select2-result-label"), d = a(b[c]), i = (d.offset() || {}).top || 0, e = i + d.outerHeight(!0), c === b.length - 1 && (h = j.find("li.select2-more-results"), h.length > 0 && (e = h.offset().top + h.outerHeight(!0))), f = j.offset().top + j.outerHeight(!1), e > f && j.scrollTop(j.scrollTop() + (e - f)), g = i - j.offset().top, g < 0 && "none" != d.css("display") && j.scrollTop(j.scrollTop() + g)
                    }
                },
                findHighlightableChoices: function() {
                    return this.results.find(".select2-result-selectable:not(.select2-disabled):not(.select2-selected)")
                },
                moveHighlight: function(b) {
                    for (var c = this.findHighlightableChoices(), d = this.highlight(); d > -1 && d < c.length;) {
                        d += b;
                        var e = a(c[d]);
                        if (e.hasClass("select2-result-selectable") && !e.hasClass("select2-disabled") && !e.hasClass("select2-selected")) {
                            this.highlight(d);
                            break
                        }
                    }
                },
                highlight: function(b) {
                    var c, d, f = this.findHighlightableChoices();
                    return 0 === arguments.length ? e(f.filter(".select2-highlighted")[0], f.get()) : (b >= f.length && (b = f.length - 1), b < 0 && (b = 0), this.removeHighlight(), c = a(f[b]), c.addClass("select2-highlighted"), this.search.attr("aria-activedescendant", c.find(".select2-result-label").attr("id")), this.ensureHighlightVisible(), this.liveRegion.text(c.text()), d = c.data("select2-data"), void(d && this.opts.element.trigger({
                        type: "select2-highlight",
                        val: this.id(d),
                        choice: d
                    })))
                },
                removeHighlight: function() {
                    this.results.find(".select2-highlighted").removeClass("select2-highlighted")
                },
                touchMoved: function() {
                    this._touchMoved = !0
                },
                clearTouchMoved: function() {
                    this._touchMoved = !1
                },
                countSelectableResults: function() {
                    return this.findHighlightableChoices().length
                },
                highlightUnderEvent: function(b) {
                    var c = a(b.target).closest(".select2-result-selectable");
                    if (c.length > 0 && !c.is(".select2-highlighted")) {
                        var d = this.findHighlightableChoices();
                        this.highlight(d.index(c))
                    } else 0 == c.length && this.removeHighlight()
                },
                loadMoreIfNeeded: function() {
                    var a, b = this.results,
                        c = b.find("li.select2-more-results"),
                        d = this.resultsPage + 1,
                        e = this,
                        f = this.search.val(),
                        g = this.context;
                    0 !== c.length && (a = c.offset().top - b.offset().top - b.height(), a <= this.opts.loadMorePadding && (c.addClass("select2-active"), this.opts.query({
                        element: this.opts.element,
                        term: f,
                        page: d,
                        context: g,
                        matcher: this.opts.matcher,
                        callback: this.bind(function(a) {
                            e.opened() && (e.opts.populateResults.call(this, b, a.results, {
                                term: f,
                                page: d,
                                context: g
                            }), e.postprocessResults(a, !1, !1), a.more === !0 ? (c.detach().appendTo(b).html(e.opts.escapeMarkup(z(e.opts.formatLoadMore, e.opts.element, d + 1))), window.setTimeout(function() {
                                e.loadMoreIfNeeded()
                            }, 10)) : c.remove(), e.positionDropdown(), e.resultsPage = d, e.context = a.context, this.opts.element.trigger({
                                type: "select2-loaded",
                                items: a
                            }))
                        })
                    })))
                },
                tokenize: function() {},
                updateResults: function(c) {
                    function d() {
                        j.removeClass("select2-active"), m.positionDropdown(), k.find(".select2-no-results,.select2-selection-limit,.select2-searching").length ? m.liveRegion.text(k.text()) : m.liveRegion.text(m.opts.formatMatches(k.find('.select2-result-selectable:not(".select2-selected")').length))
                    }

                    function e(a) {
                        k.html(a), d()
                    }
                    var f, h, i, j = this.search,
                        k = this.results,
                        l = this.opts,
                        m = this,
                        n = j.val(),
                        o = a.data(this.container, "select2-last-term");
                    if ((c === !0 || !o || !g(n, o)) && (a.data(this.container, "select2-last-term", n), c === !0 || this.showSearchInput !== !1 && this.opened())) {
                        i = ++this.queryCount;
                        var p = this.getMaximumSelectionSize();
                        if (p >= 1 && (f = this.data(), a.isArray(f) && f.length >= p && y(l.formatSelectionTooBig, "formatSelectionTooBig"))) return void e("<li class='select2-selection-limit'>" + z(l.formatSelectionTooBig, l.element, p) + "</li>");
                        if (j.val().length < l.minimumInputLength) return e(y(l.formatInputTooShort, "formatInputTooShort") ? "<li class='select2-no-results'>" + z(l.formatInputTooShort, l.element, j.val(), l.minimumInputLength) + "</li>" : ""), void(c && this.showSearch && this.showSearch(!0));
                        if (l.maximumInputLength && j.val().length > l.maximumInputLength) return void e(y(l.formatInputTooLong, "formatInputTooLong") ? "<li class='select2-no-results'>" + z(l.formatInputTooLong, l.element, j.val(), l.maximumInputLength) + "</li>" : "");
                        l.formatSearching && 0 === this.findHighlightableChoices().length && e("<li class='select2-searching'>" + z(l.formatSearching, l.element) + "</li>"), j.addClass("select2-active"), this.removeHighlight(), h = this.tokenize(), h != b && null != h && j.val(h), this.resultsPage = 1, l.query({
                            element: l.element,
                            term: j.val(),
                            page: this.resultsPage,
                            context: null,
                            matcher: l.matcher,
                            callback: this.bind(function(f) {
                                var h;
                                if (i == this.queryCount) {
                                    if (!this.opened()) return void this.search.removeClass("select2-active");
                                    if (f.hasError !== b && y(l.formatAjaxError, "formatAjaxError")) return void e("<li class='select2-ajax-error'>" + z(l.formatAjaxError, l.element, f.jqXHR, f.textStatus, f.errorThrown) + "</li>");
                                    if (this.context = f.context === b ? null : f.context, this.opts.createSearchChoice && "" !== j.val() && (h = this.opts.createSearchChoice.call(m, j.val(), f.results), h !== b && null !== h && m.id(h) !== b && null !== m.id(h) && 0 === a(f.results).filter(function() {
                                            return g(m.id(this), m.id(h))
                                        }).length && this.opts.createSearchChoicePosition(f.results, h)), 0 === f.results.length && y(l.formatNoMatches, "formatNoMatches")) return e("<li class='select2-no-results'>" + z(l.formatNoMatches, l.element, j.val()) + "</li>"), void(this.showSearch && this.showSearch(j.val()));
                                    k.empty(), m.opts.populateResults.call(this, k, f.results, {
                                        term: j.val(),
                                        page: this.resultsPage,
                                        context: null
                                    }), f.more === !0 && y(l.formatLoadMore, "formatLoadMore") && (k.append("<li class='select2-more-results'>" + l.escapeMarkup(z(l.formatLoadMore, l.element, this.resultsPage)) + "</li>"), window.setTimeout(function() {
                                        m.loadMoreIfNeeded()
                                    }, 10)), this.postprocessResults(f, c), d(), this.opts.element.trigger({
                                        type: "select2-loaded",
                                        items: f
                                    })
                                }
                            })
                        })
                    }
                },
                cancel: function() {
                    this.close()
                },
                blur: function() {
                    this.opts.selectOnBlur && this.selectHighlighted({
                        noFocus: !0
                    }), this.close(), this.container.removeClass("select2-container-active"), this.search[0] === document.activeElement && this.search.blur(), this.clearSearch(), this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus")
                },
                focusSearch: function() {
                    n(this.search)
                },
                selectHighlighted: function(a) {
                    if (this._touchMoved) return void this.clearTouchMoved();
                    var b = this.highlight(),
                        c = this.results.find(".select2-highlighted"),
                        d = c.closest(".select2-result").data("select2-data");
                    d ? (this.highlight(b), this.onSelect(d, a)) : a && a.noFocus && this.close()
                },
                getPlaceholder: function() {
                    var a;
                    return this.opts.element.attr("placeholder") || this.opts.element.attr("data-placeholder") || this.opts.element.data("placeholder") || this.opts.placeholder || ((a = this.getPlaceholderOption()) !== b ? a.text() : b)
                },
                getPlaceholderOption: function() {
                    if (this.select) {
                        var c = this.select.children("option").first();
                        if (this.opts.placeholderOption !== b) return "first" === this.opts.placeholderOption && c || "function" == typeof this.opts.placeholderOption && this.opts.placeholderOption(this.select);
                        if ("" === a.trim(c.text()) && "" === c.val()) return c
                    }
                },
                initContainerWidth: function() {
                    function b() {
                        var b, c, d, e, f, g;
                        if ("off" === this.opts.width) return null;
                        if ("element" === this.opts.width) return 0 === this.opts.element.outerWidth(!1) ? "auto" : this.opts.element.outerWidth(!1) + "px";
                        if ("copy" === this.opts.width || "resolve" === this.opts.width) {
                            if (b = this.opts.element.attr("style"), "string" == typeof b)
                                for (c = b.split(";"), e = 0, f = c.length; e < f; e += 1)
                                    if (g = c[e].replace(/\s/g, ""), d = g.match(/^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i), null !== d && d.length >= 1) return d[1];
                            return "resolve" === this.opts.width ? (b = this.opts.element.css("width"), b.indexOf("%") > 0 ? b : 0 === this.opts.element.outerWidth(!1) ? "auto" : this.opts.element.outerWidth(!1) + "px") : null
                        }
                        return a.isFunction(this.opts.width) ? this.opts.width() : this.opts.width
                    }
                    var c = b.call(this);
                    null !== c && this.container.css("width", c)
                }
            }), F = D(E, {
                createContainer: function() {
                    var b = a(document.createElement("div")).attr({
                        class: "select2-container"
                    }).html(["<a href='javascript:void(0)' class='select2-choice' tabindex='-1'>", "   <span class='select2-chosen'>&#160;</span><abbr class='select2-search-choice-close'></abbr>", "   <span class='select2-arrow' role='presentation'><b role='presentation'></b></span>", "</a>", "<label for='' class='select2-offscreen'></label>", "<input class='select2-focusser select2-offscreen' type='text' aria-haspopup='true' role='button' />", "<div class='select2-drop select2-display-none'>", "   <div class='select2-search'>", "       <label for='' class='select2-offscreen'></label>", "       <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input' role='combobox' aria-expanded='true'", "       aria-autocomplete='list' />", "   </div>", "   <ul class='select2-results' role='listbox'>", "   </ul>", "</div>"].join(""));
                    return b
                },
                enableInterface: function() {
                    this.parent.enableInterface.apply(this, arguments) && this.focusser.prop("disabled", !this.isInterfaceEnabled())
                },
                opening: function() {
                    var b, c, d;
                    this.opts.minimumResultsForSearch >= 0 && this.showSearch(!0), this.parent.opening.apply(this, arguments), this.showSearchInput !== !1 && this.search.val(this.focusser.val()), this.opts.shouldFocusInput(this) && (this.search.focus(), b = this.search.get(0), b.createTextRange ? (c = b.createTextRange(), c.collapse(!1), c.select()) : b.setSelectionRange && (d = this.search.val().length, b.setSelectionRange(d, d))), this.prefillNextSearchTerm(), this.focusser.prop("disabled", !0).val(""), this.updateResults(!0), this.opts.element.trigger(a.Event("select2-open"))
                },
                close: function() {
                    this.opened() && (this.parent.close.apply(this, arguments), this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus())
                },
                focus: function() {
                    this.opened() ? this.close() : (this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus())
                },
                isFocused: function() {
                    return this.container.hasClass("select2-container-active")
                },
                cancel: function() {
                    this.parent.cancel.apply(this, arguments), this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus()
                },
                destroy: function() {
                    a("label[for='" + this.focusser.attr("id") + "']").attr("for", this.opts.element.attr("id")), this.parent.destroy.apply(this, arguments), C.call(this, "selection", "focusser")
                },
                initContainer: function() {
                    var b, d, e = this.container,
                        f = this.dropdown,
                        g = H();
                    this.opts.minimumResultsForSearch < 0 ? this.showSearch(!1) : this.showSearch(!0), this.selection = b = e.find(".select2-choice"), this.focusser = e.find(".select2-focusser"), b.find(".select2-chosen").attr("id", "select2-chosen-" + g), this.focusser.attr("aria-labelledby", "select2-chosen-" + g), this.results.attr("id", "select2-results-" + g), this.search.attr("aria-owns", "select2-results-" + g), this.focusser.attr("id", "s2id_autogen" + g), d = a("label[for='" + this.opts.element.attr("id") + "']"), this.opts.element.on("focus.select2", this.bind(function() {
                        this.focus()
                    })), this.focusser.prev().text(d.text()).attr("for", this.focusser.attr("id"));
                    var h = this.opts.element.attr("title");
                    this.opts.element.attr("title", h || d.text()), this.focusser.attr("tabindex", this.elementTabIndex), this.search.attr("id", this.focusser.attr("id") + "_search"), this.search.prev().text(a("label[for='" + this.focusser.attr("id") + "']").text()).attr("for", this.search.attr("id")), this.search.on("keydown", this.bind(function(a) {
                        if (this.isInterfaceEnabled() && 229 != a.keyCode) {
                            if (a.which === M.PAGE_UP || a.which === M.PAGE_DOWN) return void p(a);
                            switch (a.which) {
                                case M.UP:
                                case M.DOWN:
                                    return this.moveHighlight(a.which === M.UP ? -1 : 1), void p(a);
                                case M.ENTER:
                                    return this.selectHighlighted(), void p(a);
                                case M.TAB:
                                    return void this.selectHighlighted({
                                        noFocus: !0
                                    });
                                case M.ESC:
                                    return this.cancel(a), void p(a)
                            }
                        }
                    })), this.search.on("blur", this.bind(function(a) {
                        document.activeElement === this.body.get(0) && window.setTimeout(this.bind(function() {
                            this.opened() && this.results && this.results.length > 1 && this.search.focus()
                        }), 0)
                    })), this.focusser.on("keydown", this.bind(function(a) {
                        if (this.isInterfaceEnabled() && a.which !== M.TAB && !M.isControl(a) && !M.isFunctionKey(a) && a.which !== M.ESC) {
                            if (this.opts.openOnEnter === !1 && a.which === M.ENTER) return void p(a);
                            if (a.which == M.DOWN || a.which == M.UP || a.which == M.ENTER && this.opts.openOnEnter) {
                                if (a.altKey || a.ctrlKey || a.shiftKey || a.metaKey) return;
                                return this.open(), void p(a)
                            }
                            return a.which == M.DELETE || a.which == M.BACKSPACE ? (this.opts.allowClear && this.clear(), void p(a)) : void 0
                        }
                    })), j(this.focusser), this.focusser.on("keyup-change input", this.bind(function(a) {
                        if (this.opts.minimumResultsForSearch >= 0) {
                            if (a.stopPropagation(), this.opened()) return;
                            this.open()
                        }
                    })), b.on("mousedown touchstart", "abbr", this.bind(function(a) {
                        this.isInterfaceEnabled() && (this.clear(), q(a), this.close(), this.selection && this.selection.focus())
                    })), b.on("mousedown touchstart", this.bind(function(d) {
                        c(b), this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.opened() ? this.close() : this.isInterfaceEnabled() && this.open(), p(d)
                    })), f.on("mousedown touchstart", this.bind(function() {
                        this.opts.shouldFocusInput(this) && this.search.focus()
                    })), b.on("focus", this.bind(function(a) {
                        p(a)
                    })), this.focusser.on("focus", this.bind(function() {
                        this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.container.addClass("select2-container-active")
                    })).on("blur", this.bind(function() {
                        this.opened() || (this.container.removeClass("select2-container-active"), this.opts.element.trigger(a.Event("select2-blur")))
                    })), this.search.on("focus", this.bind(function() {
                        this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.container.addClass("select2-container-active")
                    })), this.initContainerWidth(), this.opts.element.hide(), this.setPlaceholder()
                },
                clear: function(b) {
                    var c = this.selection.data("select2-data");
                    if (c) {
                        var d = a.Event("select2-clearing");
                        if (this.opts.element.trigger(d), d.isDefaultPrevented()) return;
                        var e = this.getPlaceholderOption();
                        this.opts.element.val(e ? e.val() : ""), this.selection.find(".select2-chosen").empty(), this.selection.removeData("select2-data"), this.setPlaceholder(), b !== !1 && (this.opts.element.trigger({
                            type: "select2-removed",
                            val: this.id(c),
                            choice: c
                        }), this.triggerChange({
                            removed: c
                        }))
                    }
                },
                initSelection: function() {
                    if (this.isPlaceholderOptionSelected()) this.updateSelection(null), this.close(), this.setPlaceholder();
                    else {
                        var a = this;
                        this.opts.initSelection.call(null, this.opts.element, function(c) {
                            c !== b && null !== c && (a.updateSelection(c), a.close(), a.setPlaceholder(), a.lastSearchTerm = a.search.val())
                        })
                    }
                },
                isPlaceholderOptionSelected: function() {
                    var a;
                    return this.getPlaceholder() !== b && ((a = this.getPlaceholderOption()) !== b && a.prop("selected") || "" === this.opts.element.val() || this.opts.element.val() === b || null === this.opts.element.val())
                },
                prepareOpts: function() {
                    var b = this.parent.prepareOpts.apply(this, arguments),
                        c = this;
                    return "select" === b.element.get(0).tagName.toLowerCase() ? b.initSelection = function(a, b) {
                        var d = a.find("option").filter(function() {
                            return this.selected && !this.disabled
                        });
                        b(c.optionToData(d))
                    } : "data" in b && (b.initSelection = b.initSelection || function(c, d) {
                        var e = c.val(),
                            f = null;
                        b.query({
                            matcher: function(a, c, d) {
                                var h = g(e, b.id(d));
                                return h && (f = d), h
                            },
                            callback: a.isFunction(d) ? function() {
                                d(f)
                            } : a.noop
                        })
                    }), b
                },
                getPlaceholder: function() {
                    return this.select && this.getPlaceholderOption() === b ? b : this.parent.getPlaceholder.apply(this, arguments)
                },
                setPlaceholder: function() {
                    var a = this.getPlaceholder();
                    if (this.isPlaceholderOptionSelected() && a !== b) {
                        if (this.select && this.getPlaceholderOption() === b) return;
                        this.selection.find(".select2-chosen").html(this.opts.escapeMarkup(a)), this.selection.addClass("select2-default"), this.container.removeClass("select2-allowclear")
                    }
                },
                postprocessResults: function(a, b, c) {
                    var d = 0,
                        e = this;
                    if (this.findHighlightableChoices().each2(function(a, b) {
                            if (g(e.id(b.data("select2-data")), e.opts.element.val())) return d = a, !1
                        }), c !== !1 && (b === !0 && d >= 0 ? this.highlight(d) : this.highlight(0)), b === !0) {
                        var f = this.opts.minimumResultsForSearch;
                        f >= 0 && this.showSearch(A(a.results) >= f)
                    }
                },
                showSearch: function(b) {
                    this.showSearchInput !== b && (this.showSearchInput = b, this.dropdown.find(".select2-search").toggleClass("select2-search-hidden", !b), this.dropdown.find(".select2-search").toggleClass("select2-offscreen", !b), a(this.dropdown, this.container).toggleClass("select2-with-searchbox", b))
                },
                onSelect: function(a, b) {
                    if (this.triggerSelect(a)) {
                        var c = this.opts.element.val(),
                            d = this.data();
                        this.opts.element.val(this.id(a)), this.updateSelection(a), this.opts.element.trigger({
                            type: "select2-selected",
                            val: this.id(a),
                            choice: a
                        }), this.lastSearchTerm = this.search.val(), this.close(), b && b.noFocus || !this.opts.shouldFocusInput(this) || this.focusser.focus(), g(c, this.id(a)) || this.triggerChange({
                            added: a,
                            removed: d
                        })
                    }
                },
                updateSelection: function(a) {
                    var c, d, e = this.selection.find(".select2-chosen");
                    this.selection.data("select2-data", a), e.empty(), null !== a && (c = this.opts.formatSelection(a, e, this.opts.escapeMarkup)), c !== b && e.append(c), d = this.opts.formatSelectionCssClass(a, e), d !== b && e.addClass(d), this.selection.removeClass("select2-default"), this.opts.allowClear && this.getPlaceholder() !== b && this.container.addClass("select2-allowclear")
                },
                val: function() {
                    var a, c = !1,
                        d = null,
                        e = this,
                        f = this.data();
                    if (0 === arguments.length) return this.opts.element.val();
                    if (a = arguments[0], arguments.length > 1 && (c = arguments[1], this.opts.debug && console && console.warn && console.warn('Select2: The second option to `select2("val")` is not supported in Select2 4.0.0. The `change` event will always be triggered in 4.0.0.')), this.select) this.opts.debug && console && console.warn && console.warn('Select2: Setting the value on a <select> using `select2("val")` is no longer supported in 4.0.0. You can use the `.val(newValue).trigger("change")` method provided by jQuery instead.'), this.select.val(a).find("option").filter(function() {
                        return this.selected
                    }).each2(function(a, b) {
                        return d = e.optionToData(b), !1
                    }), this.updateSelection(d), this.setPlaceholder(), c && this.triggerChange({
                        added: d,
                        removed: f
                    });
                    else {
                        if (!a && 0 !== a) return void this.clear(c);
                        if (this.opts.initSelection === b) throw new Error("cannot call val() if initSelection() is not defined");
                        this.opts.element.val(a), this.opts.initSelection(this.opts.element, function(a) {
                            e.opts.element.val(a ? e.id(a) : ""), e.updateSelection(a), e.setPlaceholder(), c && e.triggerChange({
                                added: a,
                                removed: f
                            })
                        })
                    }
                },
                clearSearch: function() {
                    this.search.val(""), this.focusser.val("")
                },
                data: function(a) {
                    var c, d = !1;
                    return 0 === arguments.length ? (c = this.selection.data("select2-data"), c == b && (c = null), c) : (this.opts.debug && console && console.warn && console.warn('Select2: The `select2("data")` method can no longer set selected values in 4.0.0, consider using the `.val()` method instead.'), arguments.length > 1 && (d = arguments[1]), a ? (c = this.data(), this.opts.element.val(a ? this.id(a) : ""), this.updateSelection(a), d && this.triggerChange({
                        added: a,
                        removed: c
                    })) : this.clear(d), void 0)
                }
            }), G = D(E, {
                createContainer: function() {
                    var b = a(document.createElement("div")).attr({
                        class: "select2-container select2-container-multi"
                    }).html(["<ul class='select2-choices'>", "  <li class='select2-search-field'>", "    <label for='' class='select2-offscreen'></label>", "    <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input'>", "  </li>", "</ul>", "<div class='select2-drop select2-drop-multi select2-display-none'>", "   <ul class='select2-results'>", "   </ul>", "</div>"].join(""));
                    return b
                },
                prepareOpts: function() {
                    var b = this.parent.prepareOpts.apply(this, arguments),
                        c = this;
                    return "select" === b.element.get(0).tagName.toLowerCase() ? b.initSelection = function(a, b) {
                        var d = [];
                        a.find("option").filter(function() {
                            return this.selected && !this.disabled
                        }).each2(function(a, b) {
                            d.push(c.optionToData(b))
                        }), b(d)
                    } : "data" in b && (b.initSelection = b.initSelection || function(c, d) {
                        var e = h(c.val(), b.separator, b.transformVal),
                            f = [];
                        b.query({
                            matcher: function(c, d, h) {
                                var i = a.grep(e, function(a) {
                                    return g(a, b.id(h))
                                }).length;
                                return i && f.push(h), i
                            },
                            callback: a.isFunction(d) ? function() {
                                for (var a = [], c = 0; c < e.length; c++)
                                    for (var h = e[c], i = 0; i < f.length; i++) {
                                        var j = f[i];
                                        if (g(h, b.id(j))) {
                                            a.push(j), f.splice(i, 1);
                                            break
                                        }
                                    }
                                d(a)
                            } : a.noop
                        })
                    }), b
                },
                selectChoice: function(a) {
                    var b = this.container.find(".select2-search-choice-focus");
                    b.length && a && a[0] == b[0] || (b.length && this.opts.element.trigger("choice-deselected", b), b.removeClass("select2-search-choice-focus"), a && a.length && (this.close(), a.addClass("select2-search-choice-focus"), this.opts.element.trigger("choice-selected", a)))
                },
                destroy: function() {
                    a("label[for='" + this.search.attr("id") + "']").attr("for", this.opts.element.attr("id")), this.parent.destroy.apply(this, arguments), C.call(this, "searchContainer", "selection")
                },
                initContainer: function() {
                    var b, c = ".select2-choices";
                    this.searchContainer = this.container.find(".select2-search-field"), this.selection = b = this.container.find(c);
                    var d = this;
                    this.selection.on("click", ".select2-container:not(.select2-container-disabled) .select2-search-choice:not(.select2-locked)", function(b) {
                        d.search[0].focus(), d.selectChoice(a(this))
                    }), this.search.attr("id", "s2id_autogen" + H()), this.search.prev().text(a("label[for='" + this.opts.element.attr("id") + "']").text()).attr("for", this.search.attr("id")), this.opts.element.on("focus.select2", this.bind(function() {
                        this.focus()
                    })), this.search.on("input paste", this.bind(function() {
                        this.search.attr("placeholder") && 0 == this.search.val().length || this.isInterfaceEnabled() && (this.opened() || this.open())
                    })), this.search.attr("tabindex", this.elementTabIndex), this.keydowns = 0, this.search.on("keydown", this.bind(function(a) {
                        if (this.isInterfaceEnabled()) {
                            ++this.keydowns;
                            var c = b.find(".select2-search-choice-focus"),
                                d = c.prev(".select2-search-choice:not(.select2-locked)"),
                                e = c.next(".select2-search-choice:not(.select2-locked)"),
                                f = o(this.search);
                            if (c.length && (a.which == M.LEFT || a.which == M.RIGHT || a.which == M.BACKSPACE || a.which == M.DELETE || a.which == M.ENTER)) {
                                var g = c;
                                return a.which == M.LEFT && d.length ? g = d : a.which == M.RIGHT ? g = e.length ? e : null : a.which === M.BACKSPACE ? this.unselect(c.first()) && (this.search.width(10), g = d.length ? d : e) : a.which == M.DELETE ? this.unselect(c.first()) && (this.search.width(10), g = e.length ? e : null) : a.which == M.ENTER && (g = null), this.selectChoice(g), p(a), void(g && g.length || this.open())
                            }
                            if ((a.which === M.BACKSPACE && 1 == this.keydowns || a.which == M.LEFT) && 0 == f.offset && !f.length) return this.selectChoice(b.find(".select2-search-choice:not(.select2-locked)").last()), void p(a);
                            if (this.selectChoice(null), this.opened()) switch (a.which) {
                                case M.UP:
                                case M.DOWN:
                                    return this.moveHighlight(a.which === M.UP ? -1 : 1), void p(a);
                                case M.ENTER:
                                    return this.selectHighlighted(), void p(a);
                                case M.TAB:
                                    return this.selectHighlighted({
                                        noFocus: !0
                                    }), void this.close();
                                case M.ESC:
                                    return this.cancel(a), void p(a)
                            }
                            if (a.which !== M.TAB && !M.isControl(a) && !M.isFunctionKey(a) && a.which !== M.BACKSPACE && a.which !== M.ESC) {
                                if (a.which === M.ENTER) {
                                    if (this.opts.openOnEnter === !1) return;
                                    if (a.altKey || a.ctrlKey || a.shiftKey || a.metaKey) return
                                }
                                this.open(), a.which !== M.PAGE_UP && a.which !== M.PAGE_DOWN || p(a), a.which === M.ENTER && p(a)
                            }
                        }
                    })), this.search.on("keyup", this.bind(function(a) {
                        this.keydowns = 0, this.resizeSearch()
                    })), this.search.on("blur", this.bind(function(b) {
                        this.container.removeClass("select2-container-active"), this.search.removeClass("select2-focused"), this.selectChoice(null), this.opened() || this.clearSearch(), b.stopImmediatePropagation(), this.opts.element.trigger(a.Event("select2-blur"))
                    })), this.container.on("click", c, this.bind(function(b) {
                        this.isInterfaceEnabled() && (a(b.target).closest(".select2-search-choice").length > 0 || (this.selectChoice(null), this.clearPlaceholder(), this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.open(), this.focusSearch(), b.preventDefault()))
                    })), this.container.on("focus", c, this.bind(function() {
                        this.isInterfaceEnabled() && (this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"), this.clearPlaceholder())
                    })), this.initContainerWidth(), this.opts.element.hide(), this.clearSearch()
                },
                enableInterface: function() {
                    this.parent.enableInterface.apply(this, arguments) && this.search.prop("disabled", !this.isInterfaceEnabled())
                },
                initSelection: function() {
                    if ("" === this.opts.element.val() && "" === this.opts.element.text() && (this.updateSelection([]), this.close(), this.clearSearch()), this.select || "" !== this.opts.element.val()) {
                        var a = this;
                        this.opts.initSelection.call(null, this.opts.element, function(c) {
                            c !== b && null !== c && (a.updateSelection(c), a.close(), a.clearSearch())
                        })
                    }
                },
                clearSearch: function() {
                    var a = this.getPlaceholder(),
                        c = this.getMaxSearchWidth();
                    a !== b && 0 === this.getVal().length && this.search.hasClass("select2-focused") === !1 ? (this.search.val(a).addClass("select2-default"), this.search.width(c > 0 ? c : this.container.css("width"))) : this.search.val("").width(10)
                },
                clearPlaceholder: function() {
                    this.search.hasClass("select2-default") && this.search.val("").removeClass("select2-default")
                },
                opening: function() {
                    this.clearPlaceholder(), this.resizeSearch(), this.parent.opening.apply(this, arguments), this.focusSearch(), this.prefillNextSearchTerm(), this.updateResults(!0), this.opts.shouldFocusInput(this) && this.search.focus(), this.opts.element.trigger(a.Event("select2-open"))
                },
                close: function() {
                    this.opened() && this.parent.close.apply(this, arguments)
                },
                focus: function() {
                    this.close(), this.search.focus()
                },
                isFocused: function() {
                    return this.search.hasClass("select2-focused")
                },
                updateSelection: function(b) {
                    var c = {},
                        d = [],
                        e = this;
                    a(b).each(function() {
                        e.id(this) in c || (c[e.id(this)] = 0, d.push(this))
                    }), this.selection.find(".select2-search-choice").remove(), this.addSelectedChoice(d), e.postprocessResults()
                },
                tokenize: function() {
                    var a = this.search.val();
                    a = this.opts.tokenizer.call(this, a, this.data(), this.bind(this.onSelect), this.opts), null != a && a != b && (this.search.val(a), a.length > 0 && this.open())
                },
                onSelect: function(a, b) {
                    this.triggerSelect(a) && "" !== a.text && (this.addSelectedChoice(a), this.opts.element.trigger({
                        type: "selected",
                        val: this.id(a),
                        choice: a
                    }), this.lastSearchTerm = this.search.val(), this.clearSearch(), this.updateResults(), !this.select && this.opts.closeOnSelect || this.postprocessResults(a, !1, this.opts.closeOnSelect === !0), this.opts.closeOnSelect ? (this.close(), this.search.width(10)) : this.countSelectableResults() > 0 ? (this.search.width(10), this.resizeSearch(), this.getMaximumSelectionSize() > 0 && this.val().length >= this.getMaximumSelectionSize() ? this.updateResults(!0) : this.prefillNextSearchTerm() && this.updateResults(), this.positionDropdown()) : (this.close(), this.search.width(10)), this.triggerChange({
                        added: a
                    }), b && b.noFocus || this.focusSearch())
                },
                cancel: function() {
                    this.close(), this.focusSearch()
                },
                addSelectedChoice: function(b) {
                    var c = this.getVal(),
                        d = this;
                    a(b).each(function() {
                        c.push(d.createChoice(this))
                    }), this.setVal(c)
                },
                createChoice: function(c) {
                    var d, e, f = !c.locked,
                        g = a("<li class='select2-search-choice'>    <div></div>    <a href='#' class='select2-search-choice-close' tabindex='-1'></a></li>"),
                        h = a("<li class='select2-search-choice select2-locked'><div></div></li>"),
                        i = f ? g : h,
                        j = this.id(c);
                    return d = this.opts.formatSelection(c, i.find("div"), this.opts.escapeMarkup), d != b && i.find("div").replaceWith(a("<div></div>").html(d)), e = this.opts.formatSelectionCssClass(c, i.find("div")), e != b && i.addClass(e), f && i.find(".select2-search-choice-close").on("mousedown", p).on("click dblclick", this.bind(function(b) {
                        this.isInterfaceEnabled() && (this.unselect(a(b.target)), this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus"), p(b), this.close(), this.focusSearch())
                    })).on("focus", this.bind(function() {
                        this.isInterfaceEnabled() && (this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"))
                    })), i.data("select2-data", c), i.insertBefore(this.searchContainer), j
                },
                unselect: function(b) {
                    var c, d, f = this.getVal();
                    if (b = b.closest(".select2-search-choice"), 0 === b.length) throw "Invalid argument: " + b + ". Must be .select2-search-choice";
                    if (c = b.data("select2-data")) {
                        var g = a.Event("select2-removing");
                        if (g.val = this.id(c), g.choice = c, this.opts.element.trigger(g), g.isDefaultPrevented()) return !1;
                        for (;
                            (d = e(this.id(c), f)) >= 0;) f.splice(d, 1), this.setVal(f), this.select && this.postprocessResults();
                        return b.remove(), this.opts.element.trigger({
                            type: "select2-removed",
                            val: this.id(c),
                            choice: c
                        }), this.triggerChange({
                            removed: c
                        }), !0
                    }
                },
                postprocessResults: function(a, b, c) {
                    var d = this.getVal(),
                        f = this.results.find(".select2-result"),
                        g = this.results.find(".select2-result-with-children"),
                        h = this;
                    f.each2(function(a, b) {
                        var c = h.id(b.data("select2-data"));
                        e(c, d) >= 0 && (b.addClass("select2-selected"), b.find(".select2-result-selectable").addClass("select2-selected"))
                    }), g.each2(function(a, b) {
                        b.is(".select2-result-selectable") || 0 !== b.find(".select2-result-selectable:not(.select2-selected)").length || b.addClass("select2-selected")
                    }), this.highlight() == -1 && c !== !1 && this.opts.closeOnSelect === !0 && h.highlight(0), !this.opts.createSearchChoice && !f.filter(".select2-result:not(.select2-selected)").length > 0 && (!a || a && !a.more && 0 === this.results.find(".select2-no-results").length) && y(h.opts.formatNoMatches, "formatNoMatches") && this.results.append("<li class='select2-no-results'>" + z(h.opts.formatNoMatches, h.opts.element, h.search.val()) + "</li>")
                },
                getMaxSearchWidth: function() {
                    return this.selection.width() - i(this.search)
                },
                resizeSearch: function() {
                    var a, b, c, d, e, f = i(this.search);
                    a = r(this.search) + 10, b = this.search.offset().left, c = this.selection.width(), d = this.selection.offset().left, e = c - (b - d) - f, e < a && (e = c - f), e < 40 && (e = c - f), e <= 0 && (e = a), this.search.width(Math.floor(e))
                },
                getVal: function() {
                    var a;
                    return this.select ? (a = this.select.val(), null === a ? [] : a) : (a = this.opts.element.val(), h(a, this.opts.separator, this.opts.transformVal))
                },
                setVal: function(b) {
                    if (this.select) this.select.val(b);
                    else {
                        var c = [],
                            d = {};
                        a(b).each(function() {
                            this in d || (c.push(this), d[this] = 0)
                        }), this.opts.element.val(0 === c.length ? "" : c.join(this.opts.separator))
                    }
                },
                buildChangeDetails: function(a, b) {
                    for (var b = b.slice(0), a = a.slice(0), c = 0; c < b.length; c++)
                        for (var d = 0; d < a.length; d++)
                            if (g(this.opts.id(b[c]), this.opts.id(a[d]))) {
                                b.splice(c, 1), c--, a.splice(d, 1);
                                break
                            }
                    return {
                        added: b,
                        removed: a
                    }
                },
                val: function(c, d) {
                    var e, f = this;
                    if (0 === arguments.length) return this.getVal();
                    if (e = this.data(), e.length || (e = []), !c && 0 !== c) return this.opts.element.val(""), this.updateSelection([]), this.clearSearch(), void(d && this.triggerChange({
                        added: this.data(),
                        removed: e
                    }));
                    if (this.setVal(c), this.select) this.opts.initSelection(this.select, this.bind(this.updateSelection)), d && this.triggerChange(this.buildChangeDetails(e, this.data()));
                    else {
                        if (this.opts.initSelection === b) throw new Error("val() cannot be called if initSelection() is not defined");
                        this.opts.initSelection(this.opts.element, function(b) {
                            var c = a.map(b, f.id);
                            f.setVal(c), f.updateSelection(b), f.clearSearch(), d && f.triggerChange(f.buildChangeDetails(e, f.data()))
                        })
                    }
                    this.clearSearch()
                },
                onSortStart: function() {
                    if (this.select) throw new Error("Sorting of elements is not supported when attached to <select>. Attach to <input type='hidden'/> instead.");
                    this.search.width(0), this.searchContainer.hide()
                },
                onSortEnd: function() {
                    var b = [],
                        c = this;
                    this.searchContainer.show(), this.searchContainer.appendTo(this.searchContainer.parent()), this.resizeSearch(), this.selection.find(".select2-search-choice").each(function() {
                        b.push(c.opts.id(a(this).data("select2-data")))
                    }), this.setVal(b), this.triggerChange()
                },
                data: function(b, c) {
                    var d, e, f = this;
                    return 0 === arguments.length ? this.selection.children(".select2-search-choice").map(function() {
                        return a(this).data("select2-data")
                    }).get() : (e = this.data(), b || (b = []), d = a.map(b, function(a) {
                        return f.opts.id(a)
                    }), this.setVal(d), this.updateSelection(b), this.clearSearch(), c && this.triggerChange(this.buildChangeDetails(e, this.data())), void 0)
                }
            }), a.fn.select2 = function() {
                var c, d, f, g, h, i = Array.prototype.slice.call(arguments, 0),
                    j = ["val", "destroy", "opened", "open", "close", "focus", "isFocused", "container", "dropdown", "onSortStart", "onSortEnd", "enable", "disable", "readonly", "positionDropdown", "data", "search"],
                    k = ["opened", "isFocused", "container", "dropdown"],
                    l = ["val", "data"],
                    m = {
                        search: "externalSearch"
                    };
                return this.each(function() {
                    if (0 === i.length || "object" == typeof i[0]) c = 0 === i.length ? {} : a.extend({}, i[0]), c.element = a(this), "select" === c.element.get(0).tagName.toLowerCase() ? h = c.element.prop("multiple") : (h = c.multiple || !1, "tags" in c && (c.multiple = h = !0)), d = h ? new window.Select2.class.multi : new window.Select2.class.single, d.init(c);
                    else {
                        if ("string" != typeof i[0]) throw "Invalid arguments to select2 plugin: " + i;
                        if (e(i[0], j) < 0) throw "Unknown method: " + i[0];
                        if (g = b, d = a(this).data("select2"), d === b) return;
                        if (f = i[0], "container" === f ? g = d.container : "dropdown" === f ? g = d.dropdown : (m[f] && (f = m[f]), g = d[f].apply(d, i.slice(1))), e(i[0], k) >= 0 || e(i[0], l) >= 0 && 1 == i.length) return !1
                    }
                }), g === b ? this : g
            }, a.fn.select2.defaults = {
                debug: !1,
                width: "copy",
                loadMorePadding: 0,
                closeOnSelect: !0,
                openOnEnter: !0,
                containerCss: {},
                dropdownCss: {},
                containerCssClass: "",
                dropdownCssClass: "",
                formatResult: function(a, b, c, d) {
                    var e = [];
                    return t(this.text(a), c.term, e, d), e.join("")
                },
                transformVal: function(b) {
                    return a.trim(b)
                },
                formatSelection: function(a, c, d) {
                    return a ? d(this.text(a)) : b
                },
                sortResults: function(a, b, c) {
                    return a
                },
                formatResultCssClass: function(a) {
                    return a.css
                },
                formatSelectionCssClass: function(a, c) {
                    return b
                },
                minimumResultsForSearch: 0,
                minimumInputLength: 0,
                maximumInputLength: null,
                maximumSelectionSize: 0,
                id: function(a) {
                    return a == b ? null : a.id
                },
                text: function(b) {
                    return b && this.data && this.data.text ? a.isFunction(this.data.text) ? this.data.text(b) : b[this.data.text] : b.text
                },
                matcher: function(a, b) {
                    return d("" + b).toUpperCase().indexOf(d("" + a).toUpperCase()) >= 0
                },
                separator: ",",
                tokenSeparators: [],
                tokenizer: B,
                escapeMarkup: u,
                blurOnChange: !1,
                selectOnBlur: !1,
                adaptContainerCssClass: function(a) {
                    return a
                },
                adaptDropdownCssClass: function(a) {
                    return null
                },
                nextSearchTerm: function(a, c) {
                    return b
                },
                searchInputPlaceholder: "",
                createSearchChoicePosition: "top",
                shouldFocusInput: function(a) {
                    var b = "ontouchstart" in window || navigator.msMaxTouchPoints > 0;
                    return !b || !(a.opts.minimumResultsForSearch < 0)
                }
            }, a.fn.select2.locales = [], a.fn.select2.locales.en = {
                formatMatches: function(a) {
                    return 1 === a ? "One result is available, press enter to select it." : a + " results are available, use up and down arrow keys to navigate."
                },
                formatNoMatches: function() {
                    return "No matches found"
                },
                formatAjaxError: function(a, b, c) {
                    return "Loading failed"
                },
                formatInputTooShort: function(a, b) {
                    var c = b - a.length;
                    return "Please enter " + c + " or more character" + (1 == c ? "" : "s")
                },
                formatInputTooLong: function(a, b) {
                    var c = a.length - b;
                    return "Please delete " + c + " character" + (1 == c ? "" : "s")
                },
                formatSelectionTooBig: function(a) {
                    return "You can only select " + a + " item" + (1 == a ? "" : "s")
                },
                formatLoadMore: function(a) {
                    return "Loading more results…"
                },
                formatSearching: function() {
                    return "Searching…"
                }
            }, a.extend(a.fn.select2.defaults, a.fn.select2.locales.en), a.fn.select2.ajaxDefaults = {
                transport: a.ajax,
                params: {
                    type: "GET",
                    cache: !1,
                    dataType: "json"
                }
            }, window.Select2 = {
                query: {
                    ajax: v,
                    local: w,
                    tags: x
                },
                util: {
                    debounce: l,
                    markMatch: t,
                    escapeMarkup: u,
                    stripDiacritics: d
                },
                class: {
                    abstract: E, single: F, multi: G
                }
            }
        }
    }(jQuery),
    function() {
        var a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X = [].slice,
            Y = {}.hasOwnProperty,
            Z = function(a, b) {
                function c() {
                    this.constructor = a
                }
                for (var d in b) Y.call(b, d) && (a[d] = b[d]);
                return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
            },
            $ = [].indexOf || function(a) {
                for (var b = 0, c = this.length; b < c; b++)
                    if (b in this && this[b] === a) return b;
                return -1
            };
        for (u = {
                catchupTime: 100,
                initialRate: .03,
                minTime: 250,
                ghostTime: 100,
                maxProgressPerFrame: 20,
                easeFactor: 1.25,
                startOnPageLoad: !0,
                restartOnPushState: !0,
                restartOnRequestAfter: 500,
                target: "body",
                elements: {
                    checkInterval: 100,
                    selectors: ["body"]
                },
                eventLag: {
                    minSamples: 10,
                    sampleCount: 3,
                    lagThreshold: 3
                },
                ajax: {
                    trackMethods: ["GET"],
                    trackWebSockets: !0,
                    ignoreURLs: []
                }
            }, C = function() {
                var a;
                return null != (a = "undefined" != typeof performance && null !== performance && "function" == typeof performance.now ? performance.now() : void 0) ? a : +new Date
            }, E = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame, t = window.cancelAnimationFrame || window.mozCancelAnimationFrame, null == E && (E = function(a) {
                return setTimeout(a, 50)
            }, t = function(a) {
                return clearTimeout(a)
            }), G = function(a) {
                var b, c;
                return b = C(), (c = function() {
                    var d;
                    return d = C() - b, d >= 33 ? (b = C(), a(d, function() {
                        return E(c)
                    })) : setTimeout(c, 33 - d)
                })()
            }, F = function() {
                var a, b, c;
                return c = arguments[0], b = arguments[1], a = 3 <= arguments.length ? X.call(arguments, 2) : [], "function" == typeof c[b] ? c[b].apply(c, a) : c[b]
            }, v = function() {
                var a, b, c, d, e, f, g;
                for (b = arguments[0], d = 2 <= arguments.length ? X.call(arguments, 1) : [], f = 0, g = d.length; f < g; f++)
                    if (c = d[f])
                        for (a in c) Y.call(c, a) && (e = c[a], null != b[a] && "object" == typeof b[a] && null != e && "object" == typeof e ? v(b[a], e) : b[a] = e);
                return b
            }, q = function(a) {
                var b, c, d, e, f;
                for (c = b = 0, e = 0, f = a.length; e < f; e++) d = a[e], c += Math.abs(d), b++;
                return c / b
            }, x = function(a, b) {
                var c, d, e;
                if (null == a && (a = "options"), null == b && (b = !0), e = document.querySelector("[data-pace-" + a + "]")) {
                    if (c = e.getAttribute("data-pace-" + a), !b) return c;
                    try {
                        return JSON.parse(c)
                    } catch (a) {
                        return d = a, "undefined" != typeof console && null !== console ? console.error("Error parsing inline pace options", d) : void 0
                    }
                }
            }, g = function() {
                function a() {}
                return a.prototype.on = function(a, b, c, d) {
                    var e;
                    return null == d && (d = !1), null == this.bindings && (this.bindings = {}), null == (e = this.bindings)[a] && (e[a] = []), this.bindings[a].push({
                        handler: b,
                        ctx: c,
                        once: d
                    })
                }, a.prototype.once = function(a, b, c) {
                    return this.on(a, b, c, !0)
                }, a.prototype.off = function(a, b) {
                    var c, d, e;
                    if (null != (null != (d = this.bindings) ? d[a] : void 0)) {
                        if (null == b) return delete this.bindings[a];
                        for (c = 0, e = []; c < this.bindings[a].length;) this.bindings[a][c].handler === b ? e.push(this.bindings[a].splice(c, 1)) : e.push(c++);
                        return e
                    }
                }, a.prototype.trigger = function() {
                    var a, b, c, d, e, f, g, h, i;
                    if (c = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], null != (g = this.bindings) ? g[c] : void 0) {
                        for (e = 0, i = []; e < this.bindings[c].length;) h = this.bindings[c][e], d = h.handler, b = h.ctx, f = h.once, d.apply(null != b ? b : this, a), f ? i.push(this.bindings[c].splice(e, 1)) : i.push(e++);
                        return i
                    }
                }, a
            }(), j = window.Pace || {}, window.Pace = j, v(j, g.prototype), D = j.options = v({}, u, window.paceOptions, x()), U = ["ajax", "document", "eventLag", "elements"], Q = 0, S = U.length; Q < S; Q++) K = U[Q], D[K] === !0 && (D[K] = u[K]);
        i = function(a) {
            function b() {
                return V = b.__super__.constructor.apply(this, arguments)
            }
            return Z(b, a), b
        }(Error), b = function() {
            function a() {
                this.progress = 0
            }
            return a.prototype.getElement = function() {
                var a;
                if (null == this.el) {
                    if (a = document.querySelector(D.target), !a) throw new i;
                    this.el = document.createElement("div"), this.el.className = "pace pace-active", document.body.className = document.body.className.replace(/pace-done/g, ""), document.body.className += " pace-running", this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>', null != a.firstChild ? a.insertBefore(this.el, a.firstChild) : a.appendChild(this.el)
                }
                return this.el
            }, a.prototype.finish = function() {
                var a;
                return a = this.getElement(), a.className = a.className.replace("pace-active", ""), a.className += " pace-inactive", document.body.className = document.body.className.replace("pace-running", ""), document.body.className += " pace-done"
            }, a.prototype.update = function(a) {
                return this.progress = a, this.render()
            }, a.prototype.destroy = function() {
                try {
                    this.getElement().parentNode.removeChild(this.getElement())
                } catch (a) {
                    i = a
                }
                return this.el = void 0
            }, a.prototype.render = function() {
                var a, b, c, d, e, f, g;
                if (null == document.querySelector(D.target)) return !1;
                for (a = this.getElement(), d = "translate3d(" + this.progress + "%, 0, 0)", g = ["webkitTransform", "msTransform", "transform"], e = 0, f = g.length; e < f; e++) b = g[e], a.children[0].style[b] = d;
                return (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) && (a.children[0].setAttribute("data-progress-text", "" + (0 | this.progress) + "%"), this.progress >= 100 ? c = "99" : (c = this.progress < 10 ? "0" : "", c += 0 | this.progress), a.children[0].setAttribute("data-progress", "" + c)), this.lastRenderedProgress = this.progress
            }, a.prototype.done = function() {
                return this.progress >= 100
            }, a
        }(), h = function() {
            function a() {
                this.bindings = {}
            }
            return a.prototype.trigger = function(a, b) {
                var c, d, e, f, g;
                if (null != this.bindings[a]) {
                    for (f = this.bindings[a], g = [], d = 0, e = f.length; d < e; d++) c = f[d], g.push(c.call(this, b));
                    return g
                }
            }, a.prototype.on = function(a, b) {
                var c;
                return null == (c = this.bindings)[a] && (c[a] = []), this.bindings[a].push(b)
            }, a
        }(), P = window.XMLHttpRequest, O = window.XDomainRequest, N = window.WebSocket, w = function(a, b) {
            var c, d, e;
            e = [];
            for (d in b.prototype) try {
                null == a[d] && "function" != typeof b[d] ? "function" == typeof Object.defineProperty ? e.push(Object.defineProperty(a, d, {
                    get: function() {
                        return b.prototype[d]
                    },
                    configurable: !0,
                    enumerable: !0
                })) : e.push(a[d] = b.prototype[d]) : e.push(void 0)
            } catch (a) {
                c = a
            }
            return e
        }, A = [], j.ignore = function() {
            var a, b, c;
            return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("ignore"), c = b.apply(null, a), A.shift(), c
        }, j.track = function() {
            var a, b, c;
            return b = arguments[0], a = 2 <= arguments.length ? X.call(arguments, 1) : [], A.unshift("track"), c = b.apply(null, a), A.shift(), c
        }, J = function(a) {
            var b;
            if (null == a && (a = "GET"), "track" === A[0]) return "force";
            if (!A.length && D.ajax) {
                if ("socket" === a && D.ajax.trackWebSockets) return !0;
                if (b = a.toUpperCase(), $.call(D.ajax.trackMethods, b) >= 0) return !0
            }
            return !1
        }, k = function(a) {
            function b() {
                var a, c = this;
                b.__super__.constructor.apply(this, arguments), a = function(a) {
                    var b;
                    return b = a.open, a.open = function(d, e, f) {
                        return J(d) && c.trigger("request", {
                            type: d,
                            url: e,
                            request: a
                        }), b.apply(a, arguments)
                    }
                }, window.XMLHttpRequest = function(b) {
                    var c;
                    return c = new P(b), a(c), c
                };
                try {
                    w(window.XMLHttpRequest, P)
                } catch (a) {}
                if (null != O) {
                    window.XDomainRequest = function() {
                        var b;
                        return b = new O, a(b), b
                    };
                    try {
                        w(window.XDomainRequest, O)
                    } catch (a) {}
                }
                if (null != N && D.ajax.trackWebSockets) {
                    window.WebSocket = function(a, b) {
                        var d;
                        return d = null != b ? new N(a, b) : new N(a), J("socket") && c.trigger("request", {
                            type: "socket",
                            url: a,
                            protocols: b,
                            request: d
                        }), d
                    };
                    try {
                        w(window.WebSocket, N)
                    } catch (a) {}
                }
            }
            return Z(b, a), b
        }(h), R = null, y = function() {
            return null == R && (R = new k), R
        }, I = function(a) {
            var b, c, d, e;
            for (e = D.ajax.ignoreURLs, c = 0, d = e.length; c < d; c++)
                if (b = e[c], "string" == typeof b) {
                    if (a.indexOf(b) !== -1) return !0
                } else if (b.test(a)) return !0;
            return !1
        }, y().on("request", function(b) {
            var c, d, e, f, g;
            if (f = b.type, e = b.request, g = b.url, !I(g)) return j.running || D.restartOnRequestAfter === !1 && "force" !== J(f) ? void 0 : (d = arguments, c = D.restartOnRequestAfter || 0, "boolean" == typeof c && (c = 0), setTimeout(function() {
                var b, c, g, h, i, k;
                if (b = "socket" === f ? e.readyState < 2 : 0 < (h = e.readyState) && h < 4) {
                    for (j.restart(), i = j.sources, k = [], c = 0, g = i.length; c < g; c++) {
                        if (K = i[c], K instanceof a) {
                            K.watch.apply(K, d);
                            break
                        }
                        k.push(void 0)
                    }
                    return k
                }
            }, c))
        }), a = function() {
            function a() {
                var a = this;
                this.elements = [], y().on("request", function() {
                    return a.watch.apply(a, arguments)
                })
            }
            return a.prototype.watch = function(a) {
                var b, c, d, e;
                if (d = a.type, b = a.request, e = a.url, !I(e)) return c = "socket" === d ? new n(b) : new o(b), this.elements.push(c)
            }, a
        }(), o = function() {
            function a(a) {
                var b, c, d, e, f, g, h = this;
                if (this.progress = 0, null != window.ProgressEvent)
                    for (c = null, a.addEventListener("progress", function(a) {
                            return a.lengthComputable ? h.progress = 100 * a.loaded / a.total : h.progress = h.progress + (100 - h.progress) / 2
                        }, !1), g = ["load", "abort", "timeout", "error"], d = 0, e = g.length; d < e; d++) b = g[d], a.addEventListener(b, function() {
                        return h.progress = 100
                    }, !1);
                else f = a.onreadystatechange, a.onreadystatechange = function() {
                    var b;
                    return 0 === (b = a.readyState) || 4 === b ? h.progress = 100 : 3 === a.readyState && (h.progress = 50), "function" == typeof f ? f.apply(null, arguments) : void 0
                }
            }
            return a
        }(), n = function() {
            function a(a) {
                var b, c, d, e, f = this;
                for (this.progress = 0, e = ["error", "open"], c = 0, d = e.length; c < d; c++) b = e[c], a.addEventListener(b, function() {
                    return f.progress = 100
                }, !1)
            }
            return a
        }(), d = function() {
            function a(a) {
                var b, c, d, f;
                for (null == a && (a = {}), this.elements = [], null == a.selectors && (a.selectors = []), f = a.selectors, c = 0, d = f.length; c < d; c++) b = f[c], this.elements.push(new e(b))
            }
            return a
        }(), e = function() {
            function a(a) {
                this.selector = a, this.progress = 0, this.check()
            }
            return a.prototype.check = function() {
                var a = this;
                return document.querySelector(this.selector) ? this.done() : setTimeout(function() {
                    return a.check()
                }, D.elements.checkInterval)
            }, a.prototype.done = function() {
                return this.progress = 100
            }, a
        }(), c = function() {
            function a() {
                var a, b, c = this;
                this.progress = null != (b = this.states[document.readyState]) ? b : 100, a = document.onreadystatechange, document.onreadystatechange = function() {
                    return null != c.states[document.readyState] && (c.progress = c.states[document.readyState]), "function" == typeof a ? a.apply(null, arguments) : void 0
                }
            }
            return a.prototype.states = {
                loading: 0,
                interactive: 50,
                complete: 100
            }, a
        }(), f = function() {
            function a() {
                var a, b, c, d, e, f = this;
                this.progress = 0, a = 0, e = [], d = 0, c = C(), b = setInterval(function() {
                    var g;
                    return g = C() - c - 50, c = C(), e.push(g), e.length > D.eventLag.sampleCount && e.shift(), a = q(e), ++d >= D.eventLag.minSamples && a < D.eventLag.lagThreshold ? (f.progress = 100, clearInterval(b)) : f.progress = 100 * (3 / (a + 3))
                }, 50)
            }
            return a
        }(), m = function() {
            function a(a) {
                this.source = a, this.last = this.sinceLastUpdate = 0, this.rate = D.initialRate, this.catchup = 0, this.progress = this.lastProgress = 0, null != this.source && (this.progress = F(this.source, "progress"))
            }
            return a.prototype.tick = function(a, b) {
                var c;
                return null == b && (b = F(this.source, "progress")), b >= 100 && (this.done = !0), b === this.last ? this.sinceLastUpdate += a : (this.sinceLastUpdate && (this.rate = (b - this.last) / this.sinceLastUpdate), this.catchup = (b - this.progress) / D.catchupTime, this.sinceLastUpdate = 0, this.last = b), b > this.progress && (this.progress += this.catchup * a), c = 1 - Math.pow(this.progress / 100, D.easeFactor), this.progress += c * this.rate * a, this.progress = Math.min(this.lastProgress + D.maxProgressPerFrame, this.progress), this.progress = Math.max(0, this.progress), this.progress = Math.min(100, this.progress), this.lastProgress = this.progress, this.progress
            }, a
        }(), L = null, H = null, r = null, M = null, p = null, s = null, j.running = !1, z = function() {
            if (D.restartOnPushState) return j.restart()
        }, null != window.history.pushState && (T = window.history.pushState, window.history.pushState = function() {
            return z(), T.apply(window.history, arguments)
        }), null != window.history.replaceState && (W = window.history.replaceState, window.history.replaceState = function() {
            return z(), W.apply(window.history, arguments)
        }), l = {
            ajax: a,
            elements: d,
            document: c,
            eventLag: f
        }, (B = function() {
            var a, c, d, e, f, g, h, i;
            for (j.sources = L = [], g = ["ajax", "elements", "document", "eventLag"], c = 0, e = g.length; c < e; c++) a = g[c], D[a] !== !1 && L.push(new l[a](D[a]));
            for (i = null != (h = D.extraSources) ? h : [], d = 0, f = i.length; d < f; d++) K = i[d], L.push(new K(D));
            return j.bar = r = new b, H = [], M = new m
        })(), j.stop = function() {
            return j.trigger("stop"), j.running = !1, r.destroy(), s = !0, null != p && ("function" == typeof t && t(p), p = null), B()
        }, j.restart = function() {
            return j.trigger("restart"), j.stop(), j.start()
        }, j.go = function() {
            var a;
            return j.running = !0, r.render(), a = C(), s = !1, p = G(function(b, c) {
                var d, e, f, g, h, i, k, l, n, o, p, q, t, u, v, w;
                for (l = 100 - r.progress, e = p = 0, f = !0, i = q = 0, u = L.length; q < u; i = ++q)
                    for (K = L[i], o = null != H[i] ? H[i] : H[i] = [], h = null != (w = K.elements) ? w : [K], k = t = 0, v = h.length; t < v; k = ++t) g = h[k], n = null != o[k] ? o[k] : o[k] = new m(g), f &= n.done, n.done || (e++, p += n.tick(b));
                return d = p / e, r.update(M.tick(b, d)), r.done() || f || s ? (r.update(100), j.trigger("done"), setTimeout(function() {
                    return r.finish(), j.running = !1, j.trigger("hide")
                }, Math.max(D.ghostTime, Math.max(D.minTime - (C() - a), 0)))) : c()
            })
        }, j.start = function(a) {
            v(D, a), j.running = !0;
            try {
                r.render()
            } catch (a) {
                i = a
            }
            return document.querySelector(".pace") ? (j.trigger("start"), j.go()) : setTimeout(j.start, 50)
        }, "function" == typeof define && define.amd ? define(["pace"], function() {
            return j
        }) : "object" == typeof exports ? module.exports = j : D.startOnPageLoad && j.start()
    }.call(this),
    function(a) {
        "use strict";
        a(["jquery"], function(a) {
            function b(b) {
                return a.isFunction(b) || a.isPlainObject(b) ? b : {
                    top: b,
                    left: b
                }
            }
            var c = a.scrollTo = function(b, c, d) {
                return a(window).scrollTo(b, c, d)
            };
            return c.defaults = {
                axis: "xy",
                duration: 0,
                limit: !0
            }, c.window = function(b) {
                return a(window)._scrollable()
            }, a.fn._scrollable = function() {
                return this.map(function() {
                    var b = this,
                        c = !b.nodeName || a.inArray(b.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]) != -1;
                    if (!c) return b;
                    var d = (b.contentWindow || b).document || b.ownerDocument || b;
                    return /webkit/i.test(navigator.userAgent) || "BackCompat" == d.compatMode ? d.body : d.documentElement
                })
            }, a.fn.scrollTo = function(d, e, f) {
                return "object" == typeof e && (f = e, e = 0), "function" == typeof f && (f = {
                    onAfter: f
                }), "max" == d && (d = 9e9), f = a.extend({}, c.defaults, f), e = e || f.duration, f.queue = f.queue && f.axis.length > 1, f.queue && (e /= 2), f.offset = b(f.offset), f.over = b(f.over), this._scrollable().each(function() {
                    function g(a) {
                        j.animate(l, e, f.easing, a && function() {
                            a.call(this, k, f)
                        })
                    }
                    if (null != d) {
                        var h, i = this,
                            j = a(i),
                            k = d,
                            l = {},
                            m = j.is("html,body");
                        switch (typeof k) {
                            case "number":
                            case "string":
                                if (/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(k)) {
                                    k = b(k);
                                    break
                                }
                                if (k = m ? a(k) : a(k, this), !k.length) return;
                            case "object":
                                (k.is || k.style) && (h = (k = a(k)).offset())
                        }
                        var n = a.isFunction(f.offset) && f.offset(i, k) || f.offset;
                        a.each(f.axis.split(""), function(a, b) {
                            var d = "x" == b ? "Left" : "Top",
                                e = d.toLowerCase(),
                                o = "scroll" + d,
                                p = i[o],
                                q = c.max(i, b);
                            if (h) l[o] = h[e] + (m ? 0 : p - j.offset()[e]), f.margin && (l[o] -= parseInt(k.css("margin" + d)) || 0, l[o] -= parseInt(k.css("border" + d + "Width")) || 0), l[o] += n[e] || 0, f.over[e] && (l[o] += k["x" == b ? "width" : "height"]() * f.over[e]);
                            else {
                                var r = k[e];
                                l[o] = r.slice && "%" == r.slice(-1) ? parseFloat(r) / 100 * q : r
                            }
                            f.limit && /^\d+$/.test(l[o]) && (l[o] = l[o] <= 0 ? 0 : Math.min(l[o], q)), !a && f.queue && (p != l[o] && g(f.onAfterFirst), delete l[o])
                        }), g(f.onAfter)
                    }
                }).end()
            }, c.max = function(b, c) {
                var d = "x" == c ? "Width" : "Height",
                    e = "scroll" + d;
                if (!a(b).is("html,body")) return b[e] - a(b)[d.toLowerCase()]();
                var f = "client" + d,
                    g = b.ownerDocument.documentElement,
                    h = b.ownerDocument.body;
                return Math.max(g[e], h[e]) - Math.min(g[f], h[f])
            }, c
        })
    }("function" == typeof define && define.amd ? define : function(a, b) {
        "undefined" != typeof module && module.exports ? module.exports = b(require("jquery")) : b(jQuery)
    }),
    function(a) {
        "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
    }(function(a) {
        var b = "ui-effects-",
            c = a;
        a.effects = {
                effect: {}
            },
            function(a, b) {
                function c(a, b, c) {
                    var d = l[b.type] || {};
                    return null == a ? c || !b.def ? null : b.def : (a = d.floor ? ~~a : parseFloat(a), isNaN(a) ? b.def : d.mod ? (a + d.mod) % d.mod : 0 > a ? 0 : a > d.max ? d.max : a)
                }

                function d(c) {
                    var d = j(),
                        e = d._rgba = [];
                    return c = c.toLowerCase(), o(i, function(a, f) {
                        var g, h = f.re.exec(c),
                            i = h && f.parse(h),
                            j = f.space || "rgba";
                        return i ? (g = d[j](i), d[k[j].cache] = g[k[j].cache], e = d._rgba = g._rgba, !1) : b
                    }), e.length ? ("0,0,0,0" === e.join() && a.extend(e, f.transparent), d) : f[c]
                }

                function e(a, b, c) {
                    return c = (c + 1) % 1, 1 > 6 * c ? a + 6 * (b - a) * c : 1 > 2 * c ? b : 2 > 3 * c ? a + 6 * (b - a) * (2 / 3 - c) : a
                }
                var f, g = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
                    h = /^([\-+])=\s*(\d+\.?\d*)/,
                    i = [{
                        re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                        parse: function(a) {
                            return [a[1], a[2], a[3], a[4]]
                        }
                    }, {
                        re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                        parse: function(a) {
                            return [2.55 * a[1], 2.55 * a[2], 2.55 * a[3], a[4]]
                        }
                    }, {
                        re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
                        parse: function(a) {
                            return [parseInt(a[1], 16), parseInt(a[2], 16), parseInt(a[3], 16)]
                        }
                    }, {
                        re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
                        parse: function(a) {
                            return [parseInt(a[1] + a[1], 16), parseInt(a[2] + a[2], 16), parseInt(a[3] + a[3], 16)]
                        }
                    }, {
                        re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                        space: "hsla",
                        parse: function(a) {
                            return [a[1], a[2] / 100, a[3] / 100, a[4]]
                        }
                    }],
                    j = a.Color = function(b, c, d, e) {
                        return new a.Color.fn.parse(b, c, d, e)
                    },
                    k = {
                        rgba: {
                            props: {
                                red: {
                                    idx: 0,
                                    type: "byte"
                                },
                                green: {
                                    idx: 1,
                                    type: "byte"
                                },
                                blue: {
                                    idx: 2,
                                    type: "byte"
                                }
                            }
                        },
                        hsla: {
                            props: {
                                hue: {
                                    idx: 0,
                                    type: "degrees"
                                },
                                saturation: {
                                    idx: 1,
                                    type: "percent"
                                },
                                lightness: {
                                    idx: 2,
                                    type: "percent"
                                }
                            }
                        }
                    },
                    l = {
                        byte: {
                            floor: !0,
                            max: 255
                        },
                        percent: {
                            max: 1
                        },
                        degrees: {
                            mod: 360,
                            floor: !0
                        }
                    },
                    m = j.support = {},
                    n = a("<p>")[0],
                    o = a.each;
                n.style.cssText = "background-color:rgba(1,1,1,.5)", m.rgba = n.style.backgroundColor.indexOf("rgba") > -1, o(k, function(a, b) {
                    b.cache = "_" + a, b.props.alpha = {
                        idx: 3,
                        type: "percent",
                        def: 1
                    }
                }), j.fn = a.extend(j.prototype, {
                    parse: function(e, g, h, i) {
                        if (e === b) return this._rgba = [null, null, null, null], this;
                        (e.jquery || e.nodeType) && (e = a(e).css(g), g = b);
                        var l = this,
                            m = a.type(e),
                            n = this._rgba = [];
                        return g !== b && (e = [e, g, h, i], m = "array"), "string" === m ? this.parse(d(e) || f._default) : "array" === m ? (o(k.rgba.props, function(a, b) {
                            n[b.idx] = c(e[b.idx], b)
                        }), this) : "object" === m ? (e instanceof j ? o(k, function(a, b) {
                            e[b.cache] && (l[b.cache] = e[b.cache].slice())
                        }) : o(k, function(b, d) {
                            var f = d.cache;
                            o(d.props, function(a, b) {
                                if (!l[f] && d.to) {
                                    if ("alpha" === a || null == e[a]) return;
                                    l[f] = d.to(l._rgba)
                                }
                                l[f][b.idx] = c(e[a], b, !0)
                            }), l[f] && 0 > a.inArray(null, l[f].slice(0, 3)) && (l[f][3] = 1, d.from && (l._rgba = d.from(l[f])))
                        }), this) : b
                    },
                    is: function(a) {
                        var c = j(a),
                            d = !0,
                            e = this;
                        return o(k, function(a, f) {
                            var g, h = c[f.cache];
                            return h && (g = e[f.cache] || f.to && f.to(e._rgba) || [], o(f.props, function(a, c) {
                                return null != h[c.idx] ? d = h[c.idx] === g[c.idx] : b
                            })), d
                        }), d
                    },
                    _space: function() {
                        var a = [],
                            b = this;
                        return o(k, function(c, d) {
                            b[d.cache] && a.push(c)
                        }), a.pop()
                    },
                    transition: function(a, b) {
                        var d = j(a),
                            e = d._space(),
                            f = k[e],
                            g = 0 === this.alpha() ? j("transparent") : this,
                            h = g[f.cache] || f.to(g._rgba),
                            i = h.slice();
                        return d = d[f.cache], o(f.props, function(a, e) {
                            var f = e.idx,
                                g = h[f],
                                j = d[f],
                                k = l[e.type] || {};
                            null !== j && (null === g ? i[f] = j : (k.mod && (j - g > k.mod / 2 ? g += k.mod : g - j > k.mod / 2 && (g -= k.mod)), i[f] = c((j - g) * b + g, e)))
                        }), this[e](i)
                    },
                    blend: function(b) {
                        if (1 === this._rgba[3]) return this;
                        var c = this._rgba.slice(),
                            d = c.pop(),
                            e = j(b)._rgba;
                        return j(a.map(c, function(a, b) {
                            return (1 - d) * e[b] + d * a
                        }))
                    },
                    toRgbaString: function() {
                        var b = "rgba(",
                            c = a.map(this._rgba, function(a, b) {
                                return null == a ? b > 2 ? 1 : 0 : a
                            });
                        return 1 === c[3] && (c.pop(), b = "rgb("), b + c.join() + ")"
                    },
                    toHslaString: function() {
                        var b = "hsla(",
                            c = a.map(this.hsla(), function(a, b) {
                                return null == a && (a = b > 2 ? 1 : 0), b && 3 > b && (a = Math.round(100 * a) + "%"), a
                            });
                        return 1 === c[3] && (c.pop(), b = "hsl("), b + c.join() + ")"
                    },
                    toHexString: function(b) {
                        var c = this._rgba.slice(),
                            d = c.pop();
                        return b && c.push(~~(255 * d)), "#" + a.map(c, function(a) {
                            return a = (a || 0).toString(16), 1 === a.length ? "0" + a : a
                        }).join("")
                    },
                    toString: function() {
                        return 0 === this._rgba[3] ? "transparent" : this.toRgbaString()
                    }
                }), j.fn.parse.prototype = j.fn, k.hsla.to = function(a) {
                    if (null == a[0] || null == a[1] || null == a[2]) return [null, null, null, a[3]];
                    var b, c, d = a[0] / 255,
                        e = a[1] / 255,
                        f = a[2] / 255,
                        g = a[3],
                        h = Math.max(d, e, f),
                        i = Math.min(d, e, f),
                        j = h - i,
                        k = h + i,
                        l = .5 * k;
                    return b = i === h ? 0 : d === h ? 60 * (e - f) / j + 360 : e === h ? 60 * (f - d) / j + 120 : 60 * (d - e) / j + 240, c = 0 === j ? 0 : .5 >= l ? j / k : j / (2 - k), [Math.round(b) % 360, c, l, null == g ? 1 : g]
                }, k.hsla.from = function(a) {
                    if (null == a[0] || null == a[1] || null == a[2]) return [null, null, null, a[3]];
                    var b = a[0] / 360,
                        c = a[1],
                        d = a[2],
                        f = a[3],
                        g = .5 >= d ? d * (1 + c) : d + c - d * c,
                        h = 2 * d - g;
                    return [Math.round(255 * e(h, g, b + 1 / 3)), Math.round(255 * e(h, g, b)), Math.round(255 * e(h, g, b - 1 / 3)), f]
                }, o(k, function(d, e) {
                    var f = e.props,
                        g = e.cache,
                        i = e.to,
                        k = e.from;
                    j.fn[d] = function(d) {
                        if (i && !this[g] && (this[g] = i(this._rgba)), d === b) return this[g].slice();
                        var e, h = a.type(d),
                            l = "array" === h || "object" === h ? d : arguments,
                            m = this[g].slice();
                        return o(f, function(a, b) {
                            var d = l["object" === h ? a : b.idx];
                            null == d && (d = m[b.idx]), m[b.idx] = c(d, b)
                        }), k ? (e = j(k(m)), e[g] = m, e) : j(m)
                    }, o(f, function(b, c) {
                        j.fn[b] || (j.fn[b] = function(e) {
                            var f, g = a.type(e),
                                i = "alpha" === b ? this._hsla ? "hsla" : "rgba" : d,
                                j = this[i](),
                                k = j[c.idx];
                            return "undefined" === g ? k : ("function" === g && (e = e.call(this, k), g = a.type(e)), null == e && c.empty ? this : ("string" === g && (f = h.exec(e), f && (e = k + parseFloat(f[2]) * ("+" === f[1] ? 1 : -1))), j[c.idx] = e, this[i](j)))
                        })
                    })
                }), j.hook = function(b) {
                    var c = b.split(" ");
                    o(c, function(b, c) {
                        a.cssHooks[c] = {
                            set: function(b, e) {
                                var f, g, h = "";
                                if ("transparent" !== e && ("string" !== a.type(e) || (f = d(e)))) {
                                    if (e = j(f || e), !m.rgba && 1 !== e._rgba[3]) {
                                        for (g = "backgroundColor" === c ? b.parentNode : b;
                                            ("" === h || "transparent" === h) && g && g.style;) try {
                                            h = a.css(g, "backgroundColor"), g = g.parentNode
                                        } catch (a) {}
                                        e = e.blend(h && "transparent" !== h ? h : "_default")
                                    }
                                    e = e.toRgbaString()
                                }
                                try {
                                    b.style[c] = e
                                } catch (a) {}
                            }
                        }, a.fx.step[c] = function(b) {
                            b.colorInit || (b.start = j(b.elem, c), b.end = j(b.end), b.colorInit = !0), a.cssHooks[c].set(b.elem, b.start.transition(b.end, b.pos))
                        }
                    })
                }, j.hook(g), a.cssHooks.borderColor = {
                    expand: function(a) {
                        var b = {};
                        return o(["Top", "Right", "Bottom", "Left"], function(c, d) {
                            b["border" + d + "Color"] = a
                        }), b
                    }
                }, f = a.Color.names = {
                    aqua: "#00ffff",
                    black: "#000000",
                    blue: "#0000ff",
                    fuchsia: "#ff00ff",
                    gray: "#808080",
                    green: "#008000",
                    lime: "#00ff00",
                    maroon: "#800000",
                    navy: "#000080",
                    olive: "#808000",
                    purple: "#800080",
                    red: "#ff0000",
                    silver: "#c0c0c0",
                    teal: "#008080",
                    white: "#ffffff",
                    yellow: "#ffff00",
                    transparent: [null, null, null, 0],
                    _default: "#ffffff"
                }
            }(c),
            function() {
                function b(b) {
                    var c, d, e = b.ownerDocument.defaultView ? b.ownerDocument.defaultView.getComputedStyle(b, null) : b.currentStyle,
                        f = {};
                    if (e && e.length && e[0] && e[e[0]])
                        for (d = e.length; d--;) c = e[d], "string" == typeof e[c] && (f[a.camelCase(c)] = e[c]);
                    else
                        for (c in e) "string" == typeof e[c] && (f[c] = e[c]);
                    return f
                }

                function d(b, c) {
                    var d, e, g = {};
                    for (d in c) e = c[d], b[d] !== e && (f[d] || (a.fx.step[d] || !isNaN(parseFloat(e))) && (g[d] = e));
                    return g
                }
                var e = ["add", "remove", "toggle"],
                    f = {
                        border: 1,
                        borderBottom: 1,
                        borderColor: 1,
                        borderLeft: 1,
                        borderRight: 1,
                        borderTop: 1,
                        borderWidth: 1,
                        margin: 1,
                        padding: 1
                    };
                a.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function(b, d) {
                    a.fx.step[d] = function(a) {
                        ("none" !== a.end && !a.setAttr || 1 === a.pos && !a.setAttr) && (c.style(a.elem, d, a.end), a.setAttr = !0)
                    }
                }), a.fn.addBack || (a.fn.addBack = function(a) {
                    return this.add(null == a ? this.prevObject : this.prevObject.filter(a))
                }), a.effects.animateClass = function(c, f, g, h) {
                    var i = a.speed(f, g, h);
                    return this.queue(function() {
                        var f, g = a(this),
                            h = g.attr("class") || "",
                            j = i.children ? g.find("*").addBack() : g;
                        j = j.map(function() {
                            var c = a(this);
                            return {
                                el: c,
                                start: b(this)
                            }
                        }), f = function() {
                            a.each(e, function(a, b) {
                                c[b] && g[b + "Class"](c[b])
                            })
                        }, f(), j = j.map(function() {
                            return this.end = b(this.el[0]), this.diff = d(this.start, this.end), this
                        }), g.attr("class", h), j = j.map(function() {
                            var b = this,
                                c = a.Deferred(),
                                d = a.extend({}, i, {
                                    queue: !1,
                                    complete: function() {
                                        c.resolve(b)
                                    }
                                });
                            return this.el.animate(this.diff, d), c.promise()
                        }), a.when.apply(a, j.get()).done(function() {
                            f(), a.each(arguments, function() {
                                var b = this.el;
                                a.each(this.diff, function(a) {
                                    b.css(a, "")
                                })
                            }), i.complete.call(g[0])
                        })
                    })
                }, a.fn.extend({
                    addClass: function(b) {
                        return function(c, d, e, f) {
                            return d ? a.effects.animateClass.call(this, {
                                add: c
                            }, d, e, f) : b.apply(this, arguments)
                        }
                    }(a.fn.addClass),
                    removeClass: function(b) {
                        return function(c, d, e, f) {
                            return arguments.length > 1 ? a.effects.animateClass.call(this, {
                                remove: c
                            }, d, e, f) : b.apply(this, arguments)
                        }
                    }(a.fn.removeClass),
                    toggleClass: function(b) {
                        return function(c, d, e, f, g) {
                            return "boolean" == typeof d || void 0 === d ? e ? a.effects.animateClass.call(this, d ? {
                                add: c
                            } : {
                                remove: c
                            }, e, f, g) : b.apply(this, arguments) : a.effects.animateClass.call(this, {
                                toggle: c
                            }, d, e, f)
                        }
                    }(a.fn.toggleClass),
                    switchClass: function(b, c, d, e, f) {
                        return a.effects.animateClass.call(this, {
                            add: c,
                            remove: b
                        }, d, e, f)
                    }
                })
            }(),
            function() {
                function c(b, c, d, e) {
                    return a.isPlainObject(b) && (c = b, b = b.effect), b = {
                        effect: b
                    }, null == c && (c = {}), a.isFunction(c) && (e = c, d = null, c = {}), ("number" == typeof c || a.fx.speeds[c]) && (e = d, d = c, c = {}), a.isFunction(d) && (e = d, d = null), c && a.extend(b, c), d = d || c.duration, b.duration = a.fx.off ? 0 : "number" == typeof d ? d : d in a.fx.speeds ? a.fx.speeds[d] : a.fx.speeds._default, b.complete = e || c.complete, b
                }

                function d(b) {
                    return !(b && "number" != typeof b && !a.fx.speeds[b]) || ("string" == typeof b && !a.effects.effect[b] || (!!a.isFunction(b) || "object" == typeof b && !b.effect))
                }
                a.extend(a.effects, {
                    version: "1.11.2",
                    save: function(a, c) {
                        for (var d = 0; c.length > d; d++) null !== c[d] && a.data(b + c[d], a[0].style[c[d]])
                    },
                    restore: function(a, c) {
                        var d, e;
                        for (e = 0; c.length > e; e++) null !== c[e] && (d = a.data(b + c[e]), void 0 === d && (d = ""), a.css(c[e], d))
                    },
                    setMode: function(a, b) {
                        return "toggle" === b && (b = a.is(":hidden") ? "show" : "hide"), b
                    },
                    getBaseline: function(a, b) {
                        var c, d;
                        switch (a[0]) {
                            case "top":
                                c = 0;
                                break;
                            case "middle":
                                c = .5;
                                break;
                            case "bottom":
                                c = 1;
                                break;
                            default:
                                c = a[0] / b.height
                        }
                        switch (a[1]) {
                            case "left":
                                d = 0;
                                break;
                            case "center":
                                d = .5;
                                break;
                            case "right":
                                d = 1;
                                break;
                            default:
                                d = a[1] / b.width
                        }
                        return {
                            x: d,
                            y: c
                        }
                    },
                    createWrapper: function(b) {
                        if (b.parent().is(".ui-effects-wrapper")) return b.parent();
                        var c = {
                                width: b.outerWidth(!0),
                                height: b.outerHeight(!0),
                                float: b.css("float")
                            },
                            d = a("<div></div>").addClass("ui-effects-wrapper").css({
                                fontSize: "100%",
                                background: "transparent",
                                border: "none",
                                margin: 0,
                                padding: 0
                            }),
                            e = {
                                width: b.width(),
                                height: b.height()
                            },
                            f = document.activeElement;
                        try {
                            f.id
                        } catch (a) {
                            f = document.body
                        }
                        return b.wrap(d), (b[0] === f || a.contains(b[0], f)) && a(f).focus(), d = b.parent(), "static" === b.css("position") ? (d.css({
                            position: "relative"
                        }), b.css({
                            position: "relative"
                        })) : (a.extend(c, {
                            position: b.css("position"),
                            zIndex: b.css("z-index")
                        }), a.each(["top", "left", "bottom", "right"], function(a, d) {
                            c[d] = b.css(d), isNaN(parseInt(c[d], 10)) && (c[d] = "auto")
                        }), b.css({
                            position: "relative",
                            top: 0,
                            left: 0,
                            right: "auto",
                            bottom: "auto"
                        })), b.css(e), d.css(c).show()
                    },
                    removeWrapper: function(b) {
                        var c = document.activeElement;
                        return b.parent().is(".ui-effects-wrapper") && (b.parent().replaceWith(b), (b[0] === c || a.contains(b[0], c)) && a(c).focus()), b
                    },
                    setTransition: function(b, c, d, e) {
                        return e = e || {}, a.each(c, function(a, c) {
                            var f = b.cssUnit(c);
                            f[0] > 0 && (e[c] = f[0] * d + f[1])
                        }), e
                    }
                }), a.fn.extend({
                    effect: function() {
                        function b(b) {
                            function c() {
                                a.isFunction(f) && f.call(e[0]), a.isFunction(b) && b()
                            }
                            var e = a(this),
                                f = d.complete,
                                h = d.mode;
                            (e.is(":hidden") ? "hide" === h : "show" === h) ? (e[h](), c()) : g.call(e[0], d, c)
                        }
                        var d = c.apply(this, arguments),
                            e = d.mode,
                            f = d.queue,
                            g = a.effects.effect[d.effect];
                        return a.fx.off || !g ? e ? this[e](d.duration, d.complete) : this.each(function() {
                            d.complete && d.complete.call(this)
                        }) : f === !1 ? this.each(b) : this.queue(f || "fx", b)
                    },
                    show: function(a) {
                        return function(b) {
                            if (d(b)) return a.apply(this, arguments);
                            var e = c.apply(this, arguments);
                            return e.mode = "show", this.effect.call(this, e)
                        }
                    }(a.fn.show),
                    hide: function(a) {
                        return function(b) {
                            if (d(b)) return a.apply(this, arguments);
                            var e = c.apply(this, arguments);
                            return e.mode = "hide", this.effect.call(this, e)
                        }
                    }(a.fn.hide),
                    toggle: function(a) {
                        return function(b) {
                            if (d(b) || "boolean" == typeof b) return a.apply(this, arguments);
                            var e = c.apply(this, arguments);
                            return e.mode = "toggle", this.effect.call(this, e)
                        }
                    }(a.fn.toggle),
                    cssUnit: function(b) {
                        var c = this.css(b),
                            d = [];
                        return a.each(["em", "px", "%", "pt"], function(a, b) {
                            c.indexOf(b) > 0 && (d = [parseFloat(c), b])
                        }), d
                    }
                })
            }(),
            function() {
                var b = {};
                a.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], function(a, c) {
                    b[c] = function(b) {
                        return Math.pow(b, a + 2)
                    }
                }), a.extend(b, {
                    Sine: function(a) {
                        return 1 - Math.cos(a * Math.PI / 2)
                    },
                    Circ: function(a) {
                        return 1 - Math.sqrt(1 - a * a)
                    },
                    Elastic: function(a) {
                        return 0 === a || 1 === a ? a : -Math.pow(2, 8 * (a - 1)) * Math.sin((80 * (a - 1) - 7.5) * Math.PI / 15)
                    },
                    Back: function(a) {
                        return a * a * (3 * a - 2)
                    },
                    Bounce: function(a) {
                        for (var b, c = 4;
                            ((b = Math.pow(2, --c)) - 1) / 11 > a;);
                        return 1 / Math.pow(4, 3 - c) - 7.5625 * Math.pow((3 * b - 2) / 22 - a, 2)
                    }
                }), a.each(b, function(b, c) {
                    a.easing["easeIn" + b] = c, a.easing["easeOut" + b] = function(a) {
                        return 1 - c(1 - a)
                    }, a.easing["easeInOut" + b] = function(a) {
                        return .5 > a ? c(2 * a) / 2 : 1 - c(-2 * a + 2) / 2
                    }
                })
            }(), a.effects
    }),
    function(a) {
        function b() {
            return window.isMobile
        }
        var c = 0,
            d = {
                common: {
                    init: function() {
                        function c(b) {
                            var c = a(window).width() > 768 ? 3 : 1;
                            b.find("article").length > c ? (b.find(".btn-next").removeClass("hidden"), b.find(".btn-prev").removeClass("hidden")) : (b.find(".btn-next").addClass("hidden"), b.find(".btn-prev").addClass("hidden")), 1 === b.find("article").length && b.find("article").addClass("article-center")
                        }

                        function d() {
                            a(".posts-container.more").each(function(b, d) {
                                var e = a(d),
                                    f = e.find(".article-container"),
                                    g = e.find("article"),
                                    h = a(window).width() < 768 ? 1 : 3,
                                    i = 0,
                                    j = e.width() / h - (h - 1) * i;
                                g.css("width", j);
                                var k = f.find("article").length,
                                    l = k * (f.find("article").width() + 31);
                                f.width(Math.ceil(l)), e.css("height", e.find("article.more-visible").height());
                                var m = 0;
                                if (g.length < 3 && a(window).width() > 768 && h > 1) m = (e.width() - f.width()) / 2, e.attr("data-index", 0);
                                else {
                                    e.attr("data-index") > g.length - h && e.attr("data-index", g.length - h);
                                    var n = e.find("article:eq(" + e.attr("data-index") + ")").position();
                                    m = -n.left
                                }
                                f.css("transform", "translateX(" + m + "px)"), c(e), e.hasClass("invisible") && (e.removeClass("invisible"), e.hide(), e.fadeIn("slow"))
                            })
                        }

                        function e() {
                            var b = a(".validation_error");
                            if (b.length > 0) {
                                var c = b.offset().top - 30;
                                k.animate({
                                    scrollTop: c
                                }, 400, "easeInQuart", function() {
                                    var b, c = !1;
                                    a(".gform_body li").each(function(d, e) {
                                        var f = a(e);
                                        f.hasClass("gsection") ? (c && !b.hasClass("open") && b.click(), b = f, c = !1) : f.hasClass("gfield_error") && (c = !0)
                                    }), c && b && !b.hasClass("open") && b.click()
                                })
                            }
                        }

                        function f(a, b) {
                            var c = a.text.toLowerCase(),
                                d = b.text.toLowerCase();
                            return c < d ? -1 : c > d ? 1 : 0
                        }

                        function g(b) {
                            var c = b.attr("data-index"),
                                e = a(window).width() < 768 ? 1 : 3;
                            c < b.find("article").length - e && (c = parseInt(c) + 1, b.attr("data-index", c)), d()
                        }

                        function h(a) {
                            var b = a.attr("data-index");
                            b > 0 && (b = parseInt(b) - 1, a.attr("data-index", b)), d()
                        }

                        function i() {
                            a(".posts-container.more").each(function(b, d) {
                                var e = a(d);
                                e.attr("data-index", 0), e.find(".btn-next").addClass("hidden"), e.find(".btn-prev").addClass("hidden"), c(e);
                                var f = new Hammer(e.get(0));
                                f.on("swipeleft swiperight", function(a) {
                                    switch (a.type) {
                                        case "swipeleft":
                                            g(e);
                                            break;
                                        case "swiperight":
                                            h(e)
                                    }
                                }), e.find(".btn-next").on("click", function() {
                                    g(a(this).parent())
                                }), e.find(".btn-prev").on("click", function() {
                                    h(a(this).parent())
                                })
                            })
                        }
                        var j, k, l, m = !1;
                        l = a(".loader-overlay"), j = a(".gallery-container"), k = a("body");
                        var n = function() {
                                var b = a(".gallery-container ul").width() - a(window).width();
                                j.scrollLeft < 173 ? a(".gallery-nav .btn-prev").fadeOut("fast") : a(".gallery-nav .btn-prev").fadeIn("fast"), j.scrollLeft > b - 173 ? a(".gallery-nav .btn-next").fadeOut("fast") : a(".gallery-nav .btn-next").fadeIn("fast")
                            },
                            o = function() {
                                k.removeClass("preloading"), k.addClass("preloaded"), l.addClass("hide-out"), a(".rev_slider_wrapper").css("visibility", "visible")
                            };
                        if (Pace.options = {
                                ajax: !1,
                                document: !1,
                                eventLag: !1,
                                elements: {
                                    selectors: ["#superslides"]
                                }
                            }, Pace.on("done", function() {
                                e()
                            }), m) {
                            var p;
                            k.addClass("preloading"), k.css("overflow", "auto"), a(".loader-content").removeClass("hide-out"), Pace.on("done", function() {
                                a(".loader-content img.preloader").css("clip", "rect(0px, 400px, 172px, 0px)"), setTimeout(o, 600), setTimeout(function() {
                                    a(".loader-content").addClass("hide-out")
                                }, 200), clearInterval(p)
                            }), Pace.on("start", function() {
                                a(".pace-progress-inner").width(a("img.preloader")), a(".loader-content img").css("clip", "rect(0px, 0px, 172px, 0px)")
                            }), p = setInterval(function() {
                                var b = a(".pace-progress").attr("data-progress"),
                                    c = Math.round(2 * b);
                                a(".loader-content img.preloader").css("clip", "rect(0px, " + Math.round(c) + "px, 172px, 0px)")
                            }, 10)
                        } else k.css("overflow", "auto"), l.hide(), l.removeClass("hide-out"), o();
                        a(".fancybox").fancybox({
                            scrolling: "no",
                            openSpeed: 400,
                            openEffect: "fade"
                        }), 0 === a("body.blog").length && a(".menu-news").removeClass("active"), 0 !== a("body.single-post").length && a(".menu-news").addClass("active"), 0 === a("body.single-model").length && 0 === a("body.tax-city").length || a(".menu-models").addClass("active");
                        var q = a("meta[name='viewport']");
                        a("input, select, textarea").bind("focus blur", function(a) {
                            q.attr("content", "width=device-width,initial-scale=1,maximum-scale=" + ("blur" === a.type ? 10 : 1))
                        }), b() || a("selectds").select2({
                            sortResults: function(a) {
                                return a.sort(f)
                            }
                        }), a("b[role='presentation']").hide(), a(".select2-arrow").append("<i class='icon icon-angle-down'></i>"), a(".btn-feedback").click(function() {
                            a(".feedback-form").slideToggle({
                                duration: 1e3,
                                easing: "easeInOutQuart"
                            })
                        }), a(".gallery-nav .btn-next").click(function() {
                            var b = a("#model-pic-0").width() + 6;
                            j.animate({
                                scrollLeft: "+=" + b
                            }, 500, "easeInOutQuart", n)
                        }), a(".gallery-nav .btn-prev").click(function() {
                            var b = a("#model-pic-0").width();
                            j.animate({
                                scrollLeft: "-=" + b
                            }, 500, "easeInOutQuart", n)
                        }), j.scroll(function() {
                            n()
                        }), n(), i(), a(window).resize(function() {
                            d()
                        }), setTimeout(d, 1e3), a(".btn-more").click(function() {
                            a(".entry-content.more").toggleClass("closed"), a(this).toggleClass("closed")
                        })
                    }
                },
                home: {
                    init: function() {
                        function b() {
                            var b = a(".slideshow .scroll"),
                                d = a(".banner");
                            e.width() > c && a(".front-sections").css("margin-top", e.height()), e.scrollTop() > 0 ? b.fadeOut(400) : b.fadeIn(600);
                            var f = e.height() > e.scrollTop() + 91;
                            f ? e.width() > c && d.addClass("bottom") : d.removeClass("bottom"), d.css("opacity", 1)
                        }
                        var d, e;
                        d = a("#superslides"), e = a(window), d.superslides({
                            animation: "fade",
                            animation_speed: 2e3,
                            animation_easing: "linear",
                            play: 6e3
                        }), d.click(function() {
                            d.superslides("animate", "next")
                        }), e.load(function() {
                            b()
                        }), e.scroll(function() {
                            b()
                        }), a(".btn-more").click(function() {
                            var b = a("html, body"),
                                c = a(".slideshow").height() - 90;
                            b.animate({
                                scrollTop: c
                            }, 1e3, "easeInOutQuart", function() {})
                        }), b()
                    }
                },
                about_us: {
                    init: function() {}
                },
                archive: {
                    init: function() {
                        imagesLoaded("#pack-container", function() {
                            a("#pack-container .element").removeClass("hide-element")
                        })
                    }
                },
                single: {
                    init: function() {}
                },
                category: {
                    init: function() {}
                },
                page_template_template_forms: {
                    init: function() {
                        a("#gform_9 .gfield:not(#field_9_48,#field_9_49,#field_9_50,#field_9_51)").hide(), a("#gform_9 .gfield:not(#field_9_47).gsection").append("<div class='btn-nextarrow arrow-sm'><span class='icon icon-angle-right'></span></div>"), a("#gform_9 .gfield.gsection").show(), a("#gform_9 .gfield:not(#field_9_47).gsection").bind("click", function() {
                            a(this).toggleClass("open"), a(this).nextUntil("#gform_9  .gfield.gsection").slideToggle({
                                duration: 600,
                                easing: "easeOutQuart"
                            }), a(".gform_rcwdupload input[type='text']").hide()
                        }), a("#gform_9 .gfield.gsection").first().click()
                    }
                }
            },
            e = {
                fire: function(a, b, c) {
                    var e = d;
                    b = void 0 === b ? "init" : b, "" !== a && e[a] && "function" == typeof e[a][b] && e[a][b](c)
                },
                loadEvents: function() {
                    e.fire("common"), a.each(document.body.className.replace(/-/g, "_").split(/\s+/), function(a, b) {
                        e.fire(b)
                    })
                }
            };
        a(document).ready(e.loadEvents)
    }(jQuery),
    function(a) {
        a.fn.offsetRelative = function(b) {
            var c = a(this),
                d = c.offsetParent(),
                e = c.position();
            if (b) {
                if ("BODY" === d.get(0).tagName) return e;
                if (a(b, d).length) return e;
                if (d[0] === a(b)[0]) return e;
                var f = d.offsetRelative(b);
                return e.top += f.top, e.left += f.left, e
            }
            return e
        }, a.fn.positionRelative = function(b) {
            return a(this).offsetRelative(b)
        }
    }(jQuery);