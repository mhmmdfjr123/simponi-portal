!function(e,a){if("function"==typeof define&&define.amd)define(["jquery","px-libs/dataTables.bootstrap"],a);else if("undefined"!=typeof exports)a(require("jquery"),require("px-libs/dataTables.bootstrap"));else{var t={exports:{}};a(e.jquery,e.dataTables),e.datatables=t.exports}}(this,function(e){"use strict";function a(e){return e&&e.__esModule?e:{default:e}}var t=a(e);!function(e){if(!e.fn.dataTable)throw new Error("jquery.dataTables.js required.");e.extend(!0,e.fn.dataTable.ext.classes,{sProcessing:"dataTables_processing"})}(t.default)});