(()=>{"use strict";(()=>{function t(e){return t="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},t(e)}function e(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,r(i.key),i)}}function r(e){var r=function(e,r){if("object"!=t(e)||!e)return e;var n=e[Symbol.toPrimitive];if(void 0!==n){var i=n.call(e,"string");if("object"!=t(i))return i;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(e)}(e);return"symbol"==t(r)?r:r+""}new(function(){return t=function t(){var e,n,i;!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),e=this,i=void 0,(n=r(n="l"))in e?Object.defineProperty(e,n,{value:i,enumerable:!0,configurable:!0,writable:!0}):e[n]=i,this.tabItems=document.querySelectorAll(".tab__item"),this.tabs=Array.from(this.tabItems),this.id=document.getElementById("tab-1"),this.events()},(n=[{key:"events",value:function(){var t=this;this.tabs.forEach((function(e){console.log(e),e.addEventListener("click",t.switchTabsHandler)}))}},{key:"switchTabsHandler",value:function(t){t.preventDefault();var e=document.querySelector(".tab__item_link--active");document.querySelector(".tab__paine--active").classList.remove("tab__paine--active"),e.classList.remove("tab__item_link--active");var r=t.target,n=r.getAttribute("href");console.log(n),r.classList.add("tab__item_link--active");var i=document.getElementById(n);console.log(i),i.classList.add("tab__paine--active")}}])&&e(t.prototype,n),Object.defineProperty(t,"prototype",{writable:!1}),t;var t,n}())})()})();
//# sourceMappingURL=advThemeMang-compiled.js.map