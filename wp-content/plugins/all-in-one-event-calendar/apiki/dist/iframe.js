!function(e){var t={};function n(o){if(t[o])return t[o].exports;var a=t[o]={i:o,l:!1,exports:{}};return e[o].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(o,a,function(t){return e[t]}.bind(null,a));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=274)}({107:function(e,t){e.exports=jQuery},274:function(e,t,n){"use strict";n.r(t),function(e,t){n(280);e(document).ready((function(){function n(t){var n=t.substring(t.indexOf("page=")+"page=".length),o=e("#".concat(n)).val();return o||"/"}function o(e){return/^\/([a-z0-9-_]+(\/[a-z0-9-_]+)?)?$/gm.test(e)?e:"/"}var a,r=document.createElement("iframe"),i=document.getElementById("timely-iframe-container");if(i){var l=n(window.location.href);if("loaded"===a){var u=new URL(l);r.contentWindow.postMessage({source:"wp",action:"navigate",route:o(u.pathname)},"*")}else a="loading",r.id="timely-iframe",r.src=l,r.style.display="none",r.onload=function(){r.style.display="block",a="loaded"};i.appendChild(r);var c=e(document).height();e(r).height()+32<c&&(e(r).height(c),e("#timely-iframe-container").height(c)),window.addEventListener("message",(function(e){var n=document.getElementById("timely-loader"),o=e.data.timely_external,a=o.data,r=null,i=null;a&&(r=a["X-Auth-Token"],i=a.expiryDate);var l=o.action,u={action:"auth_token",auth_token_nonce:ajax_object.auth_token_nonce,timely_token:r,expiry_date:i,timely_action:l};n.style.zIndex=9999,t.post(ajax_object.xhr_url,u,(function(e){"logged out"!==e?(document.getElementById("timely-iframe").style.display="none",location.reload()):n.style.zIndex=0}))}),!1);var d=e("a[href*='page=timely']").not("a[href*='#timely']");d.each((function(t){var i=d[t],l=i.href;i.addEventListener("click",(function(t){if("loading"!==a){var i=n(l);if("loaded"===a){var u=new URL(i);r.contentWindow.postMessage({source:"wp",action:"navigate",route:o(u.pathname)},"*"),window.history.pushState(null,"Time.ly",l)}else{a="loading";var c=document.getElementById("timely-loader");c.style.zIndex=9999,r.src=i,r.onload=function(){setTimeout((function(){c.style.zIndex=0}),1e3)}}e("#toplevel_page_timely>ul>li.current").removeClass("current"),t.target.parentNode.classList.add("current"),t.preventDefault()}else t.preventDefault()}))}))}var s=e("ul.wp-submenu a[href*='#timely']");s.attr("target","_blank"),s.each((function(e){var t=s[e],n=t.href;t.href="https://".concat(n.substring(n.indexOf("#timely=")+"#timely=".length))}));var f=document.getElementById("timely-update-message-button");f&&f.addEventListener("click",(function(){document.getElementById("timely-update-message").style.display="none"}))}))}.call(this,n(107),n(107))},280:function(e,t){}});