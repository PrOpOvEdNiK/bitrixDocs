/*
 * jScrollPane - v2.0.0beta12 - 2012-07-24
 * http://jscrollpane.kelvinluck.com/
 *
 * Copyright (c) 2010 Kelvin Luck
 * Dual licensed under the MIT and GPL licenses.
 */
(function ($, window, undefined) {
    $.fn.jScrollPane = function (e) {
        function JScrollPane(D, O) {
            var settings, Q = this, pane, paneWidth, paneHeight, al, contentWidth, contentHeight, percentInViewH, percentInViewV, isScrollableV, isScrollableH, au, i, I, h, j, aa, U, ap, X, t, A, aq, af, am, G, l, at, ax, x, av, aH, f, L,
                ai = true, P = true, aG = false, k = false,
                ao = D.clone(false, false).empty(),
                ac = $.fn.mwheelIntent ? "mwheelIntent.jsp" : "mousewheel.jsp";
            aH = D.css("paddingTop") + " " + D.css("paddingRight") + " " + D.css("paddingBottom") + " " + D.css("paddingLeft");
            f = (parseInt(D.css("paddingLeft"), 10) || 0) + (parseInt(D.css("paddingRight"), 10) || 0);

            function initialise(aQ) {
                aQ.preventScrollEvent = true;
                var aL, aN, aM, aJ, aI, aP, aO = false, aK = false;
                settings = aQ;
                if (pane === undefined) {
                    aI = D.scrollTop();
                    aP = D.scrollLeft();
                    D.css({overflow: "hidden", padding: 0});
                    paneWidth = D.innerWidth() + f;
                    paneHeight = D.innerHeight();
                    D.width(paneWidth);
                    pane = $('<div class="jspPane" />').css("padding", aH).append(D.children());
                    al = $('<div class="jspContainer" />').css({width: paneWidth + "px", height: paneHeight + "px"}).append(pane).appendTo(D)
                } else {
                    D.css("width", "");
                    aO = settings.stickToBottom && K();
                    aK = settings.stickToRight && B();
                    aJ = D.innerWidth() + f != paneWidth || D.outerHeight() != paneHeight;
                    if (aJ) {
                        paneWidth = D.innerWidth() + f;
                        paneHeight = D.innerHeight();
                        al.css({width: paneWidth + "px", height: paneHeight + "px"})
                    }
                    if (!aJ && L == contentWidth && pane.outerHeight() == contentHeight) {
                        D.width(paneWidth);
                        return
                    }
                    L = contentWidth;
                    pane.css("width", "");
                    D.width(paneWidth);
                    al.find(">.jspVerticalBar,>.jspHorizontalBar").remove().end()
                }
                pane.css("overflow", "auto");
                if (aQ.contentWidth) {
                    contentWidth = aQ.contentWidth
                } else {
                    contentWidth = pane[0].scrollWidth
                }
                contentHeight = pane[0].scrollHeight;
                pane.css("overflow", "");
                percentInViewH = contentWidth / paneWidth;
                percentInViewV = contentHeight / paneHeight;
                isScrollableV = (percentInViewV > 1) && settings.allowedVerticalScroll;
                isScrollableH = (percentInViewH > 1) && settings.allowedHorizontalScroll;

                if (!(isScrollableH || isScrollableV)) {
                    D.removeClass("jspScrollable");
                    pane.css({top: 0, width: al.width() - f});
                    n();
                    E();
                    R();
                    w()
                } else {
                    D.addClass("jspScrollable");
                    aL = settings.maintainPosition && (I || aa);
                    if (aL) {
                        aN = aC();
                        aM = aA()
                    }
                    aF();
                    z();
                    F();
                    if (aL) {
                        N(aK ? (contentWidth - paneWidth) : aN, false);
                        M(aO ? (contentHeight - paneHeight) : aM, false)
                    }
                    J();
                    ag();
                    an();
                    if (settings.enableKeyboardNavigation) {
                        S()
                    }
                    if (settings.clickOnTrack) {
                        p()
                    }
                    C();
                    if (settings.hijackInternalLinks) {
                        m()
                    }
                }
                if (settings.autoReinitialise && !av) {
                    av = setInterval(function () {
                        initialise(settings)
                    }, settings.autoReinitialiseDelay)
                } else {
                    if (!settings.autoReinitialise && av) {
                        clearInterval(av)
                    }
                }
                // aI && D.scrollTop(0) && M(aI, false);
                // aP && D.scrollLeft(0) && N(aP, false);
                D.trigger("jsp-initialised", [isScrollableH || isScrollableV]);
                aQ.preventScrollEvent = false;
            }

            function aF() {
                if (isScrollableV) {
                    al.append($('<div class="jspVerticalBar" />').append($('<div class="jspCap jspCapTop" />'), $('<div class="jspTrack" />').append($('<div class="jspDrag" />').append($('<div class="jspDragTop" />'), $('<div class="jspDragBottom" />'))), $('<div class="jspCap jspCapBottom" />')));
                    U = al.find(">.jspVerticalBar");
                    ap = U.find(">.jspTrack");
                    au = ap.find(">.jspDrag");
                    if (settings.showArrows) {
                        aq = $('<a class="jspArrow jspArrowUp" />').bind("mousedown.jsp", aD(0, -1)).bind("click.jsp", aB);
                        af = $('<a class="jspArrow jspArrowDown" />').bind("mousedown.jsp", aD(0, 1)).bind("click.jsp", aB);
                        if (settings.arrowScrollOnHover) {
                            aq.bind("mouseover.jsp", aD(0, -1, aq));
                            af.bind("mouseover.jsp", aD(0, 1, af))
                        }
                        ak(ap, settings.verticalArrowPositions, aq, af)
                    }
                    t = paneHeight;
                    al.find(">.jspVerticalBar>.jspCap:visible,>.jspVerticalBar>.jspArrow").each(function () {
                        t -= $(this).outerHeight()
                    });
                    au.hover(function () {
                        au.addClass("jspHover")
                    },function () {
                        au.removeClass("jspHover")
                    }).bind("mousedown.jsp", function (aI) {
                        $("html").bind("dragstart.jsp selectstart.jsp", aB);
                        au.addClass("jspActive");
                        var s = aI.pageY - au.position().top;
                        $("html").bind("mousemove.jsp",function (aJ) {
                            V(aJ.pageY - s, false)
                        }).bind("mouseup.jsp mouseleave.jsp", aw);
                        return false
                    });
                    o()
                }
            }

            function o() {
                ap.height(t + "px");
                I = 0;
                X = settings.verticalGutter + ap.outerWidth();
                pane.width(paneWidth - X - f);
                try {
                    if (U.position().left === 0) {
                        pane.css("margin-left", X + "px")
                    }
                } catch (s) {
                }
            }

            function z() {
                if (isScrollableH) {
                    al.append($('<div class="jspHorizontalBar" />').append($('<div class="jspCap jspCapLeft" />'), $('<div class="jspTrack" />').append($('<div class="jspDrag" />').append($('<div class="jspDragLeft" />'), $('<div class="jspDragRight" />'))), $('<div class="jspCap jspCapRight" />')));
                    am = al.find(">.jspHorizontalBar");
                    G = am.find(">.jspTrack");
                    h = G.find(">.jspDrag");
                    if (settings.showArrows) {
                        ax = $('<a class="jspArrow jspArrowLeft" />').bind("mousedown.jsp", aD(-1, 0)).bind("click.jsp", aB);
                        x = $('<a class="jspArrow jspArrowRight" />').bind("mousedown.jsp", aD(1, 0)).bind("click.jsp", aB);
                        if (settings.arrowScrollOnHover) {
                            ax.bind("mouseover.jsp", aD(-1, 0, ax));
                            x.bind("mouseover.jsp", aD(1, 0, x))
                        }
                        ak(G, settings.horizontalArrowPositions, ax, x)
                    }
                    h.hover(function () {
                        h.addClass("jspHover")
                    },function () {
                        h.removeClass("jspHover")
                    }).bind("mousedown.jsp", function (aI) {
                        $("html").bind("dragstart.jsp selectstart.jsp", aB);
                        h.addClass("jspActive");
                        var s = aI.pageX - h.position().left;
                        $("html").bind("mousemove.jsp",function (aJ) {
                            W(aJ.pageX - s, false)
                        }).bind("mouseup.jsp mouseleave.jsp", aw);
                        return false
                    });
                    l = al.innerWidth();
                    ah()
                }
            }

            function ah() {
                al.find(">.jspHorizontalBar>.jspCap:visible,>.jspHorizontalBar>.jspArrow").each(function () {
                    l -= $(this).outerWidth()
                });
                G.width(l + "px");
                aa = 0
            }

            function F() {
                if (isScrollableH && isScrollableV) {
                    var aI = G.outerHeight(), s = ap.outerWidth();
                    t -= aI;
                    $(am).find(">.jspCap:visible,>.jspArrow").each(function () {
                        l += $(this).outerWidth()
                    });
                    l -= s;
                    paneHeight -= s;
                    paneWidth -= aI;
                    G.parent().append($('<div class="jspCorner" />').css("width", aI + "px"));
                    o();
                    ah()
                }
                if (isScrollableH) {
                    pane.width((al.outerWidth() - f) + "px")
                }
                contentHeight = pane.outerHeight();
                percentInViewV = contentHeight / paneHeight;
                if (isScrollableH) {
                    at = Math.ceil(1 / percentInViewH * l);
                    if (at > settings.horizontalDragMaxWidth) {
                        at = settings.horizontalDragMaxWidth
                    } else {
                        if (at < settings.horizontalDragMinWidth) {
                            at = settings.horizontalDragMinWidth
                        }
                    }
                    h.width(at + "px");
                    j = l - at;
                    ae(aa)
                }
                if (isScrollableV) {
                    A = Math.ceil(1 / percentInViewV * t);
                    if (A > settings.verticalDragMaxHeight) {
                        A = settings.verticalDragMaxHeight
                    } else {
                        if (A < settings.verticalDragMinHeight) {
                            A = settings.verticalDragMinHeight
                        }
                    }
                    au.height(A + "px");
                    i = t - A;
                    ad(I)
                }
            }

            function ak(aJ, aL, aI, s) {
                var aN = "before", aK = "after", aM;
                if (aL == "os") {
                    aL = /Mac/.test(navigator.platform) ? "after" : "split"
                }
                if (aL == aN) {
                    aK = aL
                } else {
                    if (aL == aK) {
                        aN = aL;
                        aM = aI;
                        aI = s;
                        s = aM
                    }
                }
                aJ[aN](aI)[aK](s)
            }

            function aD(aI, s, aJ) {
                return function () {
                    H(aI, s, this, aJ);
                    this.blur();
                    return false
                }
            }

            function H(aL, aK, aO, aN) {
                aO = $(aO).addClass("jspActive");
                var aM, aJ, aI = true, s = function () {
                    if (aL !== 0) {
                        Q.scrollByX(aL * settings.arrowButtonSpeed)
                    }
                    if (aK !== 0) {
                        Q.scrollByY(aK * settings.arrowButtonSpeed)
                    }
                    aJ = setTimeout(s, aI ? settings.initialDelay : settings.arrowRepeatFreq);
                    aI = false
                };
                s();
                aM = aN ? "mouseout.jsp" : "mouseup.jsp";
                aN = aN || $("html");
                aN.bind(aM, function () {
                    aO.removeClass("jspActive");
                    aJ && clearTimeout(aJ);
                    aJ = null;
                    aN.unbind(aM)
                })
            }

            function p() {
                w();
                if (isScrollableV) {
                    ap.bind("mousedown.jsp", function (aN) {
                        if (aN.originalTarget === undefined || aN.originalTarget == aN.currentTarget) {
                            var aL = $(this), aO = aL.offset(), aM = aN.pageY - aO.top - I, aJ, aI = true, s = function () {
                                var aR = aL.offset(), aS = aN.pageY - aR.top - A / 2, aP = paneHeight * settings.scrollPagePercent, aQ = i * aP / (contentHeight - paneHeight);
                                if (aM < 0) {
                                    if (I - aQ > aS) {
                                        Q.scrollByY(-aP)
                                    } else {
                                        V(aS)
                                    }
                                } else {
                                    if (aM > 0) {
                                        if (I + aQ < aS) {
                                            Q.scrollByY(aP)
                                        } else {
                                            V(aS)
                                        }
                                    } else {
                                        aK();
                                        return
                                    }
                                }
                                aJ = setTimeout(s, aI ? settings.initialDelay : settings.trackClickRepeatFreq);
                                aI = false
                            }, aK = function () {
                                aJ && clearTimeout(aJ);
                                aJ = null;
                                $(document).unbind("mouseup.jsp", aK)
                            };
                            s();
                            $(document).bind("mouseup.jsp", aK);
                            return false
                        }
                    })
                }
                if (isScrollableH) {
                    G.bind("mousedown.jsp", function (aN) {
                        if (aN.originalTarget === undefined || aN.originalTarget == aN.currentTarget) {
                            var aL = $(this), aO = aL.offset(), aM = aN.pageX - aO.left - aa, aJ, aI = true, s = function () {
                                var aR = aL.offset(), aS = aN.pageX - aR.left - at / 2, aP = paneWidth * settings.scrollPagePercent, aQ = j * aP / (contentWidth - paneWidth);
                                if (aM < 0) {
                                    if (aa - aQ > aS) {
                                        Q.scrollByX(-aP)
                                    } else {
                                        W(aS)
                                    }
                                } else {
                                    if (aM > 0) {
                                        if (aa + aQ < aS) {
                                            Q.scrollByX(aP)
                                        } else {
                                            W(aS)
                                        }
                                    } else {
                                        aK();
                                        return
                                    }
                                }
                                aJ = setTimeout(s, aI ? settings.initialDelay : settings.trackClickRepeatFreq);
                                aI = false
                            }, aK = function () {
                                aJ && clearTimeout(aJ);
                                aJ = null;
                                $(document).unbind("mouseup.jsp", aK)
                            };
                            s();
                            $(document).bind("mouseup.jsp", aK);
                            return false
                        }
                    })
                }
            }

            function w() {
                if (G) {
                    G.unbind("mousedown.jsp")
                }
                if (ap) {
                    ap.unbind("mousedown.jsp")
                }
            }

            function aw() {
                $("html").unbind("dragstart.jsp selectstart.jsp mousemove.jsp mouseup.jsp mouseleave.jsp");
                if (au) {
                    au.removeClass("jspActive")
                }
                if (h) {
                    h.removeClass("jspActive")
                }
            }

            function V(s, aI) {
                if (!isScrollableV) {
                    return
                }
                if (s < 0) {
                    s = 0
                } else {
                    if (s > i) {
                        s = i
                    }
                }
                if (aI === undefined) {
                    aI = settings.animateScroll
                }
                if (aI) {
                    Q.animate(au, "top", s, ad)
                } else {
                    au.css("top", s);
                    ad(s)
                }
            }

            function ad(aI) {
                if (aI === undefined) {
                    aI = au.position().top
                }
                al.scrollTop(0);
                I = aI;
                var aL = I === 0, aJ = I == i, aK = aI / i, s = -aK * (contentHeight - paneHeight);
                if (ai != aL || aG != aJ) {
                    ai = aL;
                    aG = aJ;
                    D.trigger("jsp-arrow-change", [ai, aG, P, k])
                }
                u(aL, aJ);
                pane.css("top", s);
                D.trigger("jsp-scroll-y", [-s, aL, aJ]);
                if (!e.preventScrollEvent) {
                    D.trigger("scroll");
                }
                if (e.scrollCallback) {
                    e.scrollCallback("y", this, e, e.preventScrollEvent);
                }
            }

            function W(aI, s, _c) {
                if (!isScrollableH) {
                    return
                }
                if (aI < 0) {
                    aI = 0
                } else {
                    if (aI > j) {
                        aI = j
                    }
                }
                if (s === undefined) {
                    s = settings.animateScroll
                }
                if (s) {
                    if (_c) {
                        Q.animate(h, "left", aI, function(_p1, _p2) {
                            ae.apply(this, [_p1, _p2]);
                            if (_p1 == aI) {
                                _c();
                            }
                        });
                    } else {
                        Q.animate(h, "left", aI, ae)
                    }
                    Q.animate(h, "left", aI, ae)
                } else {
                    h.css("left", aI);
                    ae(aI)
                }
            }

            function ae(aI) {
                if (aI === undefined) {
                    aI = h.position().left
                }
                al.scrollTop(0);
                aa = aI;
                var aL = aa === 0, aK = aa == j, aJ = aI / j, s = -aJ * (contentWidth - paneWidth);
                if (P != aL || k != aK) {
                    P = aL;
                    k = aK;
                    D.trigger("jsp-arrow-change", [ai, aG, P, k])
                }
                r(aL, aK);
                pane.css("left", s);
                D.trigger("jsp-scroll-x", [-s, aL, aK]);
                if (!e.preventScrollEvent) {
                    D.trigger("scroll");
                }
                if (e.scrollCallback) {
                    e.scrollCallback("x", this, e, e.preventScrollEvent);
                }
            }

            function u(aI, s) {
                if (settings.showArrows) {
                    aq[aI ? "addClass" : "removeClass"]("jspDisabled");
                    af[s ? "addClass" : "removeClass"]("jspDisabled")
                }
            }

            function r(aI, s) {
                if (settings.showArrows) {
                    ax[aI ? "addClass" : "removeClass"]("jspDisabled");
                    x[s ? "addClass" : "removeClass"]("jspDisabled")
                }
            }

            function M(s, aI) {
                var aJ = s / (contentHeight - paneHeight);
                V(aJ * i, aI)
            }

            function N(aI, s, _c) {
                var aJ = aI / (contentWidth - paneWidth);
                W(aJ * j, s, _c)
            }

            function ab(aV, aQ, aJ) {
                var aN, aK, aL, s = 0, aU = 0, aI, aP, aO, aS, aR, aT;
                try {
                    aN = $(aV)
                } catch (aM) {
                    return
                }
                aK = aN.outerHeight();
                aL = aN.outerWidth();
                al.scrollTop(0);
                al.scrollLeft(0);
                while (!aN.is(".jspPane")) {
                    s += aN.position().top;
                    aU += aN.position().left;
                    aN = aN.offsetParent();
                    if (/^body|html$/i.test(aN[0].nodeName)) {
                        return
                    }
                }
                aI = aA();
                aO = aI + paneHeight;
                if (s < aI || aQ) {
                    aR = s - settings.verticalGutter
                } else {
                    if (s + aK > aO) {
                        aR = s - paneHeight + aK + settings.verticalGutter
                    }
                }
                if (aR) {
                    M(aR, aJ)
                }
                aP = aC();
                aS = aP + paneWidth;
                if (aU < aP || aQ) {
                    aT = aU - settings.horizontalGutter
                } else {
                    if (aU + aL > aS) {
                        aT = aU - paneWidth + aL + settings.horizontalGutter
                    }
                }
                if (aT) {
                    N(aT, aJ)
                }
            }

            function aC() {
                return -pane.position().left
            }

            function aA() {
                return -pane.position().top
            }

            function K() {
                var s = contentHeight - paneHeight;
                return(s > 20) && (s - aA() < 10)
            }

            function B() {
                var s = contentWidth - paneWidth;
                return(s > 20) && (s - aC() < 10)
            }

            function ag() {
                al.unbind(ac).bind(ac, function (aL, aM, aK, aI) {
                    var aJ = aa, s = I;
                    Q.scrollBy(aK * settings.mouseWheelSpeed, -aI * settings.mouseWheelSpeed, false);
                    return (O.allowScrollEventBubble) ? (aJ == aa && s == I) : false;
                })
            }

            function n() {
                al.unbind(ac)
            }

            function aB() {
                return false
            }

            function J() {
                pane.find(":input,a").unbind("focus.jsp").bind("focus.jsp", function (s) {
                    ab(s.target, false)
                })
            }

            function E() {
                pane.find(":input,a").unbind("focus.jsp")
            }

            function S() {
                var s, aI, aK = [];
                isScrollableH && aK.push(am[0]);
                isScrollableV && aK.push(U[0]);
                pane.focus(function () {
                    D.focus()
                });
                D.attr("tabindex", 0).unbind("keydown.jsp keypress.jsp").bind("keydown.jsp",function (aN) {
                    if (aN.target !== this && !(aK.length && $(aN.target).closest(aK).length)) {
                        return
                    }
                    var aM = aa, aL = I;
                    switch (aN.keyCode) {
                        case 40:
                        case 38:
                        case 34:
                        case 32:
                        case 33:
                        case 39:
                        case 37:
                            s = aN.keyCode;
                            aJ();
                            break;
                        case 35:
                            M(contentHeight - paneHeight);
                            s = null;
                            break;
                        case 36:
                            M(0);
                            s = null;
                            break
                    }
                    aI = aN.keyCode == s && aM != aa || aL != I;
                    return !aI
                }).bind("keypress.jsp", function (aL) {
                    if (aL.keyCode == s) {
                        aJ()
                    }
                    return !aI
                });
                if (settings.hideFocus) {
                    D.css("outline", "none");
                    if ("hideFocus" in al[0]) {
                        D.attr("hideFocus", true)
                    }
                } else {
                    D.css("outline", "");
                    if ("hideFocus" in al[0]) {
                        D.attr("hideFocus", false)
                    }
                }
                function aJ() {
                    var aM = aa, aL = I;
                    switch (s) {
                        case 40:
                            Q.scrollByY(settings.keyboardSpeed, false);
                            break;
                        case 38:
                            Q.scrollByY(-settings.keyboardSpeed, false);
                            break;
                        case 34:
                        case 32:
                            Q.scrollByY(paneHeight * settings.scrollPagePercent, false);
                            break;
                        case 33:
                            Q.scrollByY(-paneHeight * settings.scrollPagePercent, false);
                            break;
                        case 39:
                            Q.scrollByX(settings.keyboardSpeed, false);
                            break;
                        case 37:
                            Q.scrollByX(-settings.keyboardSpeed, false);
                            break
                    }
                    aI = aM != aa || aL != I;
                    return aI
                }
            }

            function R() {
                D.attr("tabindex", "-1").removeAttr("tabindex").unbind("keydown.jsp keypress.jsp")
            }

            function C() {
                if (location.hash && location.hash.length > 1) {
                    var aK, aI, aJ = escape(location.hash.substr(1));
                    try {
                        aK = $("#" + aJ + ', a[name="' + aJ + '"]')
                    } catch (s) {
                        return
                    }
                    if (aK.length && pane.find(aJ)) {
                        if (al.scrollTop() === 0) {
                            aI = setInterval(function () {
                                if (al.scrollTop() > 0) {
                                    ab(aK, true);
                                    $(document).scrollTop(al.position().top);
                                    clearInterval(aI)
                                }
                            }, 50)
                        } else {
                            ab(aK, true);
                            $(document).scrollTop(al.position().top)
                        }
                    }
                }
            }

            function m() {
                if ($(document.body).data("jspHijack")) {
                    return
                }
                $(document.body).data("jspHijack", true);
                $(document.body).delegate("a[href*=#]", "click", function (s) {
                    var aI = this.href.substr(0, this.href.indexOf("#")), aK = location.href, aO, aP, aJ, aM, aL, aN;
                    if (location.href.indexOf("#") !== -1) {
                        aK = location.href.substr(0, location.href.indexOf("#"))
                    }
                    if (aI !== aK) {
                        return
                    }
                    aO = escape(this.href.substr(this.href.indexOf("#") + 1));
                    aP;
                    try {
                        aP = $("#" + aO + ', a[name="' + aO + '"]')
                    } catch (aQ) {
                        return
                    }
                    if (!aP.length) {
                        return
                    }
                    aJ = aP.closest(".jspScrollable");
                    aM = aJ.data("jsp");
                    aM.scrollToElement(aP, true);
                    if (aJ[0].scrollIntoView) {
                        aL = $(window).scrollTop();
                        aN = aP.offset().top;
                        if (aN < aL || aN > aL + $(window).height()) {
                            aJ[0].scrollIntoView()
                        }
                    }
                    s.preventDefault()
                })
            }

            function an() {
                var aJ, aI, aL, aK, aM, s = false;
                al.unbind("touchstart.jsp touchmove.jsp touchend.jsp click.jsp-touchclick").bind("touchstart.jsp",function (aN) {
                    var aO = aN.originalEvent.touches[0];
                    aJ = aC();
                    aI = aA();
                    aL = aO.pageX;
                    aK = aO.pageY;
                    aM = false;
                    s = true
                }).bind("touchmove.jsp",function (aQ) {
                    if (!s) {
                        return
                    }
                    var aP = aQ.originalEvent.touches[0], aO = aa, aN = I;
                    Q.scrollTo(aJ + aL - aP.pageX, aI + aK - aP.pageY);
                    aM = aM || Math.abs(aL - aP.pageX) > 5 || Math.abs(aK - aP.pageY) > 5;
                    return aO == aa && aN == I
                }).bind("touchend.jsp",function (aN) {
                    s = false
                }).bind("click.jsp-touchclick", function (aN) {
                    if (aM) {
                        aM = false;
                        return false
                    }
                })
            }

            function g() {
                var s = aA(), aI = aC();
                D.removeClass("jspScrollable").unbind(".jsp");
                D.replaceWith(ao.append(pane.children()));
                ao.scrollTop(s);
                ao.scrollLeft(aI);
                if (av) {
                    clearInterval(av)
                }
            }

            $.extend(Q, {reinitialise: function (aI) {
                aI = $.extend({}, settings, aI);
                initialise(aI)
            }, scrollToElement: function (aJ, aI, s) {
                ab(aJ, aI, s)
            }, scrollTo: function (aJ, s, aI) {
                N(aJ, aI);
                M(s, aI)
            }, scrollToX: function (aI, s) {
                N(aI, s)
            }, scrollToY: function (s, aI) {
                M(s, aI)
            }, scrollToPercentX: function (aI, s, _c) {
                N(aI * (contentWidth - paneWidth), s, _c)
            }, scrollToPercentY: function (aI, s) {
                M(aI * (contentHeight - paneHeight), s)
            }, scrollBy: function (aI, s, aJ) {
                Q.scrollByX(aI, aJ);
                Q.scrollByY(s, aJ)
            }, scrollByX: function (s, aJ) {
                var aI = aC() + Math[s < 0 ? "floor" : "ceil"](s), aK = aI / (contentWidth - paneWidth);
                W(aK * j, aJ)
            }, scrollByY: function (s, aJ) {
                var aI = aA() + Math[s < 0 ? "floor" : "ceil"](s), aK = aI / (contentHeight - paneHeight);
                V(aK * i, aJ)
            }, positionDragX: function (s, aI) {
                W(s, aI)
            }, positionDragY: function (aI, s) {
                V(aI, s)
            }, animate: function (aI, aL, s, aK) {
                var aJ = {};
                aJ[aL] = s;
                aI.animate(aJ, {duration: settings.animateDuration, easing: settings.animateEase, queue: false, step: aK})
            }, getContentPositionX: function () {
                return aC()
            }, getContentPositionY: function () {
                return aA()
            }, getContentWidth: function () {
                return contentWidth
            }, getContentHeight: function () {
                return contentHeight
            }, getPercentScrolledX: function () {
                return aC() / (contentWidth - paneWidth)
            }, getPercentScrolledY: function () {
                return aA() / (contentHeight - paneHeight)
            }, getIsScrollableH: function () {
                return isScrollableH
            }, getIsScrollableV: function () {
                return isScrollableV
            }, getContentPane: function () {
                return pane
            }, scrollToBottom: function (s) {
                V(i, s)
            }, hijackInternalLinks: $.noop, destroy: function () {
                g()
            }});
            initialise(O)
        }

        e = $.extend({}, $.fn.jScrollPane.defaults, e);
        $.each(["mouseWheelSpeed", "arrowButtonSpeed", "trackClickSpeed", "keyboardSpeed"], function () {
            e[this] = e[this] || e.speed
        });
        return this.each(function () {
            var f = $(this), g = f.data("jsp");
            if (g) {
                g.reinitialise(e)
            } else {
                var s = $("script", f);
                s.filter('[type="text/javascript"]').remove();
                s.filter('[type=""]').remove();
                g = new JScrollPane(f, e);
                f.data("jsp", g)
            }
        })
    };
    $.fn.jScrollPane.defaults = {
        showArrows: false,
        maintainPosition: true,
        stickToBottom: false,
        stickToRight: false,
        allowScrollEventBubble: false,
        clickOnTrack: true,
        autoReinitialise: false,
        autoReinitialiseDelay: 500,
        verticalDragMinHeight: 0,
        verticalDragMaxHeight: 99999,
        horizontalDragMinWidth: 0,
        horizontalDragMaxWidth: 99999,
        contentWidth: undefined,
        animateScroll: false,
        animateDuration: 300,
        animateEase: "linear",
        hijackInternalLinks: false,
        verticalGutter: 4,
        horizontalGutter: 4,
        mouseWheelSpeed: 0,
        arrowButtonSpeed: 0,
        arrowRepeatFreq: 50,
        arrowScrollOnHover: false,
        trackClickSpeed: 0,
        trackClickRepeatFreq: 70,
        verticalArrowPositions: "split",
        horizontalArrowPositions: "split",
        enableKeyboardNavigation: true,
        hideFocus: false,
        keyboardSpeed: 0,
        initialDelay: 300,
        speed: 30,
        scrollPagePercent: 0.8,
        scrollCallback: false,
        allowedHorizontalScroll: true,
        allowedVerticalScroll: true
    }
})(jQuery, this);