!function(e,r){if("function"==typeof define&&define.amd)define(["jquery","px-libs/jquery.growl"],r);else if("undefined"!=typeof exports)r(require("jquery"),require("px-libs/jquery.growl"));else{var u={exports:{}};r(e.jquery,e.jquery),e.growl=u.exports}}(this,function(e){"use strict";var r=function(e){return e&&e.__esModule?e:{default:e}}(e);!function(e){if(!e.growl)throw new Error("jquery.growl.js required.");e.growl.success=function(r){return e.growl(e.extend({title:"Success!",style:"success"},r||{}))}}(r.default)});