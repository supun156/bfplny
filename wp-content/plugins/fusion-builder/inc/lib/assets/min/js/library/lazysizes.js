!function(a,b){var c=function(a,b){"use strict";if(b.getElementsByClassName){var c,d,e=b.documentElement,f=a.Date,g=a.HTMLPictureElement,h=a.addEventListener,i=a.setTimeout,j=a.requestAnimationFrame||i,k=a.requestIdleCallback,l=/^picture$/i,m=["load","error","lazyincluded","_lazyloaded"],n={},o=Array.prototype.forEach,p=function(a,b){return n[b]||(n[b]=new RegExp("(\\s|^)"+b+"(\\s|$)")),n[b].test(a.getAttribute("class")||"")&&n[b]},q=function(a,b){p(a,b)||a.setAttribute("class",(a.getAttribute("class")||"").trim()+" "+b)},r=function(a,b){var c;(c=p(a,b))&&a.setAttribute("class",(a.getAttribute("class")||"").replace(c," "))},s=function(a,b,c){var d=c?"addEventListener":"removeEventListener";c&&s(a,b),m.forEach(function(c){a[d](c,b)})},t=function(a,d,e,f,g){var h=b.createEvent("Event");return e||(e={}),e.instance=c,h.initEvent(d,!f,!g),h.detail=e,a.dispatchEvent(h),h},u=function(b,c){var e;!g&&(e=a.picturefill||d.pf)?(c&&c.src&&!b.getAttribute("srcset")&&b.setAttribute("srcset",c.src),e({reevaluate:!0,elements:[b]})):c&&c.src&&(b.src=c.src)},v=function(a,b){return(getComputedStyle(a,null)||{})[b]},w=function(a,b,c){for(c=c||a.offsetWidth;c<d.minSize&&b&&!a._lazysizesWidth;)c=b.offsetWidth,b=b.parentNode;return c},x=function(){var a,c,d=[],e=[],f=d,g=function(){var b=f;for(f=d.length?e:d,a=!0,c=!1;b.length;)b.shift()();a=!1},h=function(d,e){a&&!e?d.apply(this,arguments):(f.push(d),c||(c=!0,(b.hidden?i:j)(g)))};return h._lsFlush=g,h}(),y=function(a,b){return b?function(){x(a)}:function(){var b=this,c=arguments;x(function(){a.apply(b,c)})}},z=function(a){var b,c=0,e=d.throttleDelay,g=d.ricTimeout,h=function(){b=!1,c=f.now(),a()},j=k&&g>49?function(){k(h,{timeout:g}),g!==d.ricTimeout&&(g=d.ricTimeout)}:y(function(){i(h)},!0);return function(a){var d;(a=!0===a)&&(g=33),b||(b=!0,d=e-(f.now()-c),d<0&&(d=0),a||d<9?j():i(j,d))}},A=function(a){var b,c,d=function(){b=null,a()},e=function(){var a=f.now()-c;a<99?i(e,99-a):(k||d)(d)};return function(){c=f.now(),b||(b=i(e,99))}};!function(){var b,c={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",srcAttr:"data-orig-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:!0,expFactor:1.5,hFac:.8,loadMode:2,loadHidden:!0,ricTimeout:0,throttleDelay:125};d=a.lazySizesConfig||a.lazysizesConfig||{};for(b in c)b in d||(d[b]=c[b]);a.lazySizesConfig=d,i(function(){d.init&&D()})}();var B=function(){var g,j,k,m,n,w,B,D,E,F,G,H,I,J,K=/^img$/i,L=/^iframe$/i,M="onscroll"in a&&!/(gle|ing)bot/.test(navigator.userAgent),N=0,O=0,P=-1,Q=function(a){O--,a&&a.target&&s(a.target,Q),(!a||O<0||!a.target)&&(O=0)},R=function(a,c){var d,f=a,g="hidden"==v(b.body,"visibility")||"hidden"!=v(a.parentNode,"visibility")&&"hidden"!=v(a,"visibility");for(D-=c,G+=c,E-=c,F+=c;g&&(f=f.offsetParent)&&f!=b.body&&f!=e;)(g=(v(f,"opacity")||1)>0)&&"visible"!=v(f,"overflow")&&(d=f.getBoundingClientRect(),g=F>d.left&&E<d.right&&G>d.top-1&&D<d.bottom+1);return g},S=function(){var a,f,h,i,k,l,n,o,p,q=c.elements;if((m=d.loadMode)&&O<8&&(a=q.length)){f=0,P++,null==I&&("expand"in d||(d.expand=e.clientHeight>500&&e.clientWidth>500?500:370),H=d.expand,I=H*d.expFactor),N<I&&O<1&&P>2&&m>2&&!b.hidden?(N=I,P=0):N=m>1&&P>1&&O<6?H:0;for(;f<a;f++)if(q[f]&&!q[f]._lazyRace)if(M)if((o=q[f].getAttribute("data-expand"))&&(l=1*o)||(l=N),p!==l&&(w=innerWidth+l*J,B=innerHeight+l,n=-1*l,p=l),h=q[f].getBoundingClientRect(),(G=h.bottom)>=n&&(D=h.top)<=B&&(F=h.right)>=n*J&&(E=h.left)<=w&&(G||F||E||D)&&(d.loadHidden||"hidden"!=v(q[f],"visibility"))&&(j&&O<3&&!o&&(m<3||P<4)||R(q[f],l))){if($(q[f]),k=!0,O>9)break}else!k&&j&&!i&&O<4&&P<4&&m>2&&(g[0]||d.preloadAfterLoad)&&(g[0]||!o&&(G||F||E||D||"auto"!=q[f].getAttribute(d.sizesAttr)))&&(i=g[0]||q[f]);else $(q[f]);i&&!k&&$(i)}},T=z(S),U=function(a){q(a.target,d.loadedClass),r(a.target,d.loadingClass),s(a.target,W),t(a.target,"lazyloaded")},V=y(U),W=function(a){V({target:a.target})},X=function(a,b){try{a.contentWindow.location.replace(b)}catch(c){a.src=b}},Y=function(a){var b,c=a.getAttribute(d.srcsetAttr);(b=d.customMedia[a.getAttribute("data-media")||a.getAttribute("media")])&&a.setAttribute("media",b),c&&a.setAttribute("srcset",c)},Z=y(function(a,b,c,e,f){var g,h,j,m,n,p;(n=t(a,"lazybeforeunveil",b)).defaultPrevented||(e&&(c?q(a,d.autosizesClass):a.setAttribute("sizes",e)),h=a.getAttribute(d.srcsetAttr),g=a.getAttribute(d.srcAttr),f&&(j=a.parentNode,m=j&&l.test(j.nodeName||"")),p=b.firesLoad||"src"in a&&(h||g||m),n={target:a},p&&(s(a,Q,!0),clearTimeout(k),k=i(Q,2500),q(a,d.loadingClass),s(a,W,!0)),m&&o.call(j.getElementsByTagName("source"),Y),h?a.setAttribute("srcset",h):g&&!m&&(L.test(a.nodeName)?X(a,g):a.src=g),f&&(h||m)&&u(a,{src:g})),a._lazyRace&&delete a._lazyRace,r(a,d.lazyClass),x(function(){(!p||a.complete&&a.naturalWidth>1)&&(p?Q(n):O--,U(n))},!0)}),$=function(a){var b,c=K.test(a.nodeName),e=c&&(a.getAttribute(d.sizesAttr)||a.getAttribute("sizes")),f="auto"==e;(!f&&j||!c||!a.getAttribute("src")&&!a.srcset||a.complete||p(a,d.errorClass)||!p(a,d.lazyClass))&&(b=t(a,"lazyunveilread").detail,f&&C.updateElem(a,!0,a.offsetWidth),a._lazyRace=!0,O++,Z(a,b,f,e,c))},_=function(){if(!j){if(f.now()-n<999)return void i(_,999);var a=A(function(){d.loadMode=3,T()});j=!0,d.loadMode=3,T(),h("scroll",function(){3==d.loadMode&&(d.loadMode=2),a()},!0)}};return{_:function(){n=f.now(),c.elements=b.getElementsByClassName(d.lazyClass),g=b.getElementsByClassName(d.lazyClass+" "+d.preloadClass),J=d.hFac,h("scroll",T,!0),h("resize",T,!0),a.MutationObserver?new MutationObserver(T).observe(e,{childList:!0,subtree:!0,attributes:!0}):(e.addEventListener("DOMNodeInserted",T,!0),e.addEventListener("DOMAttrModified",T,!0),setInterval(T,999)),h("hashchange",T,!0),["focus","mouseover","click","load","transitionend","animationend","webkitAnimationEnd"].forEach(function(a){b.addEventListener(a,T,!0)}),/d$|^c/.test(b.readyState)?_():(h("load",_),b.addEventListener("DOMContentLoaded",T),i(_,2e4)),c.elements.length?(S(),x._lsFlush()):T()},checkElems:T,unveil:$}}(),C=function(){var a,c=y(function(a,b,c,d){var e,f,g;if(a._lazysizesWidth=d,d+="px",a.setAttribute("sizes",d),l.test(b.nodeName||""))for(e=b.getElementsByTagName("source"),f=0,g=e.length;f<g;f++)e[f].setAttribute("sizes",d);c.detail.dataAttr||u(a,c.detail)}),e=function(a,b,d){var e,f=a.parentNode;f&&(d=w(a,f,d),e=t(a,"lazybeforesizes",{width:d,dataAttr:!!b}),e.defaultPrevented||(d=e.detail.width)&&d!==a._lazysizesWidth&&c(a,f,e,d))},f=function(){var b,c=a.length;if(c)for(b=0;b<c;b++)e(a[b])},g=A(f);return{_:function(){a=b.getElementsByClassName(d.autosizesClass),h("resize",g)},checkElems:g,updateElem:e}}(),D=function(){D.i||(D.i=!0,C._(),B._())};return c={cfg:d,autoSizer:C,loader:B,init:D,uP:u,aC:q,rC:r,hC:p,fire:t,gW:w,rAF:x}}}(a,a.document);a.lazySizes=c,"object"==typeof module&&module.exports&&(module.exports=c)}(window),document.addEventListener("lazybeforeunveil",function(a){var b=a.target.getAttribute("data-bg");b&&(a.target.style.backgroundImage="url("+b+")")});