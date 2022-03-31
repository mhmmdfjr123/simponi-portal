!function(e,t){"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?module.exports=t():e.Markdown=t()}(this,function(){!function(e){function t(){return"Markdown.mk_block( "+uneval(this.toString())+", "+uneval(this.trailing)+", "+uneval(this.lineNumber)+" )"}function n(){var e=require("util");return"Markdown.mk_block( "+e.inspect(this.toString())+", "+e.inspect(this.trailing)+", "+e.inspect(this.lineNumber)+" )"}function r(e){for(var t=0,n=-1;-1!==(n=e.indexOf("\n",n+1));)t++;return t}function i(e,t){function n(e){this.len_after=e,this.name="close_"+t}var r=e+"_state",i="strong"==e?"em_state":"strong_state";return function(l,s){if(this[r][0]==t)return this[r].shift(),[l.length,new n(l.length-t.length)];var a=this[i].slice(),c=this[r].slice();this[r].unshift(t);var o=this.processInline(l.substr(t.length)),h=o[o.length-1];this[r].shift();if(h instanceof n){o.pop();return[l.length-h.len_after,[e].concat(o)]}return this[i]=a,this[r]=c,[t.length,t]}}function l(e){for(var t=e.split(""),n=[""],r=!1;t.length;){var i=t.shift();switch(i){case" ":r?n[n.length-1]+=i:n.push("");break;case"'":case'"':r=!r;break;case"\\":i=t.shift();default:n[n.length-1]+=i}}return n}function s(e){return v(e)&&e.length>1&&"object"==typeof e[1]&&!v(e[1])?e[1]:void 0}function c(e){return e.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#39;")}function o(e){if("string"==typeof e)return c(e);var t=e.shift(),n={},r=[];for(!e.length||"object"!=typeof e[0]||e[0]instanceof Array||(n=e.shift());e.length;)r.push(o(e.shift()));var i="";for(var l in n)i+=" "+l+'="'+c(n[l])+'"';return"img"==t||"br"==t||"hr"==t?"<"+t+i+"/>":"<"+t+i+">"+r.join("")+"</"+t+">"}function h(e,t,n){var r;n=n||{};var i=e.slice(0);"function"==typeof n.preprocessTreeNode&&(i=n.preprocessTreeNode(i,t));var l=s(i);if(l){i[1]={};for(r in l)i[1][r]=l[r];l=i[1]}if("string"==typeof i)return i;switch(i[0]){case"header":i[0]="h"+i[1].level,delete i[1].level;break;case"bulletlist":i[0]="ul";break;case"numberlist":i[0]="ol";break;case"listitem":i[0]="li";break;case"para":i[0]="p";break;case"markdown":i[0]="html",l&&delete l.references;break;case"code_block":i[0]="pre",r=l?2:1;var a=["code"];a.push.apply(a,i.splice(r,i.length-r)),i[r]=a;break;case"inlinecode":i[0]="code";break;case"img":i[1].src=i[1].href,delete i[1].href;break;case"linebreak":i[0]="br";break;case"link":i[0]="a";break;case"link_ref":i[0]="a";var c=t[l.ref];if(!c)return l.original;delete l.ref,l.href=c.href,c.title&&(l.title=c.title),delete l.original;break;case"img_ref":i[0]="img";var c=t[l.ref];if(!c)return l.original;delete l.ref,l.src=c.href,c.title&&(l.title=c.title),delete l.original}if(r=1,l){for(var o in i[1]){r=2;break}1===r&&i.splice(r,1)}for(;r<i.length;++r)i[r]=h(i[r],t,n);return i}function u(e){for(var t=s(e)?2:1;t<e.length;)"string"==typeof e[t]?t+1<e.length&&"string"==typeof e[t+1]?e[t]+=e.splice(t+1,1)[0]:++t:(u(e[t]),++t)}var f=e.Markdown=function(e){switch(typeof e){case"undefined":this.dialect=f.dialects.Gruber;break;case"object":this.dialect=e;break;default:if(!(e in f.dialects))throw new Error("Unknown Markdown dialect '"+String(e)+"'");this.dialect=f.dialects[e]}this.em_state=[],this.strong_state=[],this.debug_indent=""};e.parse=function(e,t){return new f(t).toTree(e)},e.toHTML=function(t,n,r){var i=e.toHTMLTree(t,n,r);return e.renderJsonML(i)},e.toHTMLTree=function(e,t,n){"string"==typeof e&&(e=this.parse(e,t));var r=s(e),i={};r&&r.references&&(i=r.references);var l=h(e,i,n);return u(l),l};var g=f.mk_block=function(e,r,i){1==arguments.length&&(r="\n\n");var l=new String(e);return l.trailing=r,l.inspect=n,l.toSource=t,void 0!=i&&(l.lineNumber=i),l};f.prototype.split_blocks=function(e,t){e=e.replace(/(\r\n|\n|\r)/g,"\n");var n,i=/([\s\S]+?)($|\n#|\n(?:\s*\n|$)+)/g,l=[],s=1;for(null!=(n=/^(\s*\n)/.exec(e))&&(s+=r(n[0]),i.lastIndex=n[0].length);null!==(n=i.exec(e));)"\n#"==n[2]&&(n[2]="\n",i.lastIndex--),l.push(g(n[1],n[2],s)),s+=r(n[0]);return l},f.prototype.processBlock=function(e,t){var n=this.dialect.block,r=n.__order__;if("__call__"in n)return n.__call__.call(this,e,t);for(var i=0;i<r.length;i++){var l=n[r[i]].call(this,e,t);if(l)return(!v(l)||l.length>0&&!v(l[0]))&&this.debug(r[i],"didn't return a proper array"),l}return[]},f.prototype.processInline=function(e){return this.dialect.inline.__call__.call(this,String(e))},f.prototype.toTree=function(e,t){var n=e instanceof Array?e:this.split_blocks(e),r=this.tree;try{for(this.tree=t||this.tree||["markdown"];n.length;){var i=this.processBlock(n.shift(),n);i.length&&this.tree.push.apply(this.tree,i)}return this.tree}finally{t&&(this.tree=r)}},f.prototype.debug=function(){var e=Array.prototype.slice.call(arguments);e.unshift(this.debug_indent),"undefined"!=typeof print&&print.apply(print,e),"undefined"!=typeof console&&void 0!==console.log&&console.log.apply(null,e)},f.prototype.loop_re_over_block=function(e,t,n){for(var r,i=t.valueOf();i.length&&null!=(r=e.exec(i));)i=i.substr(r[0].length),n.call(this,r);return i},f.dialects={},f.dialects.Gruber={block:{atxHeader:function(e,t){var n=e.match(/^(#{1,6})\s*(.*?)\s*#*\s*(?:\n|$)/);if(n){var r=["header",{level:n[1].length}];return Array.prototype.push.apply(r,this.processInline(n[2])),n[0].length<e.length&&t.unshift(g(e.substr(n[0].length),e.trailing,e.lineNumber+2)),[r]}},setextHeader:function(e,t){var n=e.match(/^(.*)\n([-=])\2\2+(?:\n|$)/);if(n){var r="="===n[2]?1:2,i=["header",{level:r},n[1]];return n[0].length<e.length&&t.unshift(g(e.substr(n[0].length),e.trailing,e.lineNumber+2)),[i]}},code:function(e,t){var n=[],r=/^(?: {0,3}\t| {4})(.*)\n?/;if(e.match(r)){e:for(;;){var i=this.loop_re_over_block(r,e.valueOf(),function(e){n.push(e[1])});if(i.length){t.unshift(g(i,e.trailing));break e}if(!t.length)break e;if(!t[0].match(r))break e;n.push(e.trailing.replace(/[^\n]/g,"").substring(2)),e=t.shift()}return[["code_block",n.join("\n")]]}},horizRule:function(e,t){var n=e.match(/^(?:([\s\S]*?)\n)?[ \t]*([-_*])(?:[ \t]*\2){2,}[ \t]*(?:\n([\s\S]*))?$/);if(n){var r=[["hr"]];return n[1]&&r.unshift.apply(r,this.processBlock(n[1],[])),n[3]&&t.unshift(g(n[3])),r}},lists:function(){function e(e){return new RegExp("(?:^("+c+"{0,"+e+"} {0,3})("+l+")\\s+)|(^"+c+"{0,"+(e-1)+"}[ ]{0,4})")}function t(e){return e.replace(/ {0,3}\t/g,"    ")}function n(e,t,n,r){if(t)return void e.push(["para"].concat(n));var i=e[e.length-1]instanceof Array&&"para"==e[e.length-1][0]?e[e.length-1]:e;r&&e.length>1&&n.unshift(r);for(var l=0;l<n.length;l++){var s=n[l];"string"==typeof s&&i.length>1&&"string"==typeof i[i.length-1]?i[i.length-1]+=s:i.push(s)}}function r(e,t){for(var n=new RegExp("^("+c+"{"+e+"}.*?\\n?)*$"),r=new RegExp("^"+c+"{"+e+"}","gm"),i=[];t.length>0&&n.exec(t[0]);){var l=t.shift(),s=l.replace(r,"");i.push(g(s,l.trailing,l.lineNumber))}return i}function i(e,t,n){var r=e.list,i=r[r.length-1];if(!(i[1]instanceof Array&&"para"==i[1][0]))if(t+1==n.length)i.push(["para"].concat(i.splice(1,i.length-1)));else{var l=i.pop();i.push(["para"].concat(i.splice(1,i.length-1)),l)}}var l="[*+-]|\\d+\\.",s=/[*+-]/,a=new RegExp("^( {0,3})("+l+")[ \t]+"),c="(?: {0,3}\\t| {4})";return function(l,c){function o(e){var t=s.exec(e[2])?["bulletlist"]:["numberlist"];return p.push({list:t,indent:e[1]}),t}var h=l.match(a);if(h){for(var u,f,p=[],g=o(h),v=!1,_=[p[0].list];;){for(var b=l.split(/(?=\n)/),k="",m=0;m<b.length;m++){var y="",w=b[m].replace(/^\n/,function(e){return y=e,""}),$=e(p.length);if(h=w.match($),void 0!==h[1]){k.length&&(n(u,v,this.processInline(k),y),v=!1,k=""),h[1]=t(h[1]);var x=Math.floor(h[1].length/4)+1;if(x>p.length)g=o(h),u.push(g),u=g[1]=["listitem"];else{var M=!1;for(f=0;f<p.length;f++)if(p[f].indent==h[1]){g=p[f].list,p.splice(f+1,p.length-(f+1)),M=!0;break}M||(x++,x<=p.length?(p.splice(x,p.length-x),g=p[x-1].list):(g=o(h),u.push(g))),u=["listitem"],g.push(u)}y=""}w.length>h[0].length&&(k+=y+w.substr(h[0].length))}k.length&&(n(u,v,this.processInline(k),y),v=!1,k="");var S=r(p.length,c);S.length>0&&(d(p,i,this),u.push.apply(u,this.toTree(S,[])));var A=c[0]&&c[0].valueOf()||"";if(!A.match(a)&&!A.match(/^ /))break;l=c.shift();var I=this.dialect.block.horizRule(l,c);if(I){_.push.apply(_,I);break}d(p,i,this),v=!0}return _}}}(),blockquote:function(e,t){if(e.match(/^>/m)){var n=[];if(">"!=e[0]){for(var r=e.split(/\n/),i=[],l=e.lineNumber;r.length&&">"!=r[0][0];)i.push(r.shift()),l++;var a=g(i.join("\n"),"\n",e.lineNumber);n.push.apply(n,this.processBlock(a,[])),e=g(r.join("\n"),e.trailing,l)}for(;t.length&&">"==t[0][0];){var c=t.shift();e=g(e+e.trailing+c,c.trailing,e.lineNumber)}var o=e.replace(/^> ?/gm,""),h=(this.tree,this.toTree(o,["blockquote"])),u=s(h);return u&&u.references&&(delete u.references,_(u)&&h.splice(1,1)),n.push(h),n}},referenceDefn:function(e,t){var n=/^\s*\[(.*?)\]:\s*(\S+)(?:\s+(?:(['"])(.*?)\3|\((.*?)\)))?\n?/;if(e.match(n)){s(this.tree)||this.tree.splice(1,0,{});var r=s(this.tree);void 0===r.references&&(r.references={});var i=this.loop_re_over_block(n,e,function(e){e[2]&&"<"==e[2][0]&&">"==e[2][e[2].length-1]&&(e[2]=e[2].substring(1,e[2].length-1));var t=r.references[e[1].toLowerCase()]={href:e[2]};void 0!==e[4]?t.title=e[4]:void 0!==e[5]&&(t.title=e[5])});return i.length&&t.unshift(g(i,e.trailing)),[]}},para:function(e,t){return[["para"].concat(this.processInline(e))]}}},f.dialects.Gruber.inline={__oneElement__:function(e,t,n){var r,i;if(t=t||this.dialect.inline.__patterns__,!(r=new RegExp("([\\s\\S]*?)("+(t.source||t)+")").exec(e)))return[e.length,e];if(r[1])return[r[1].length,r[1]];var i;return r[2]in this.dialect.inline&&(i=this.dialect.inline[r[2]].call(this,e.substr(r.index),r,n||[])),i=i||[r[2].length,r[2]]},__call__:function(e,t){function n(e){"string"==typeof e&&"string"==typeof i[i.length-1]?i[i.length-1]+=e:i.push(e)}for(var r,i=[];e.length>0;)r=this.dialect.inline.__oneElement__.call(this,e,t,i),e=e.substr(r.shift()),d(r,n);return i},"]":function(){},"}":function(){},__escape__:/^\\[\\`\*_{}\[\]()#\+.!\-]/,"\\":function(e){return this.dialect.inline.__escape__.exec(e)?[2,e.charAt(1)]:[1,"\\"]},"![":function(e){var t=e.match(/^!\[(.*?)\][ \t]*\([ \t]*([^")]*?)(?:[ \t]+(["'])(.*?)\3)?[ \t]*\)/);if(t){t[2]&&"<"==t[2][0]&&">"==t[2][t[2].length-1]&&(t[2]=t[2].substring(1,t[2].length-1)),t[2]=this.dialect.inline.__call__.call(this,t[2],/\\/)[0];var n={alt:t[1],href:t[2]||""};return void 0!==t[4]&&(n.title=t[4]),[t[0].length,["img",n]]}return t=e.match(/^!\[(.*?)\][ \t]*\[(.*?)\]/),t?[t[0].length,["img_ref",{alt:t[1],ref:t[2].toLowerCase(),original:t[0]}]]:[2,"!["]},"[":function(e){var t=String(e),n=f.DialectHelpers.inline_until_char.call(this,e.substr(1),"]");if(!n)return[1,"["];var r,i,l=1+n[0],s=n[1];e=e.substr(l);var a=e.match(/^\s*\([ \t]*([^"']*)(?:[ \t]+(["'])(.*?)\2)?[ \t]*\)/);if(a){var c=a[1];if(l+=a[0].length,c&&"<"==c[0]&&">"==c[c.length-1]&&(c=c.substring(1,c.length-1)),!a[3])for(var o=1,h=0;h<c.length;h++)switch(c[h]){case"(":o++;break;case")":0==--o&&(l-=c.length-h,c=c.substring(0,h))}return c=this.dialect.inline.__call__.call(this,c,/\\/)[0],i={href:c||""},void 0!==a[3]&&(i.title=a[3]),r=["link",i].concat(s),[l,r]}return a=e.match(/^\s*\[(.*?)\]/),a?(l+=a[0].length,i={ref:(a[1]||String(s)).toLowerCase(),original:t.substr(0,l)},r=["link_ref",i].concat(s),[l,r]):1==s.length&&"string"==typeof s[0]?(i={ref:s[0].toLowerCase(),original:t.substr(0,l)},r=["link_ref",i,s[0]],[l,r]):[1,"["]},"<":function(e){var t;return null!=(t=e.match(/^<(?:((https?|ftp|mailto):[^>]+)|(.*?@.*?\.[a-zA-Z]+))>/))?t[3]?[t[0].length,["link",{href:"mailto:"+t[3]},t[3]]]:"mailto"==t[2]?[t[0].length,["link",{href:t[1]},t[1].substr("mailto:".length)]]:[t[0].length,["link",{href:t[1]},t[1]]]:[1,"<"]},"`":function(e){var t=e.match(/(`+)(([\s\S]*?)\1)/);return t&&t[2]?[t[1].length+t[2].length,["inlinecode",t[3]]]:[1,"`"]},"  \n":function(e){return[3,["linebreak"]]}},f.dialects.Gruber.inline["**"]=i("strong","**"),f.dialects.Gruber.inline.__=i("strong","__"),f.dialects.Gruber.inline["*"]=i("em","*"),f.dialects.Gruber.inline._=i("em","_"),f.buildBlockOrder=function(e){var t=[];for(var n in e)"__order__"!=n&&"__call__"!=n&&t.push(n);e.__order__=t},f.buildInlinePatterns=function(e){var t=[];for(var n in e)if(!n.match(/^__.*__$/)){var r=n.replace(/([\\.*+?|()\[\]{}])/g,"\\$1").replace(/\n/,"\\n");t.push(1==n.length?r:"(?:"+r+")")}t=t.join("|"),e.__patterns__=t;var i=e.__call__;e.__call__=function(e,n){return void 0!=n?i.call(this,e,n):i.call(this,e,t)}},f.DialectHelpers={},f.DialectHelpers.inline_until_char=function(e,t){for(var n=0,r=[];;){if(e.charAt(n)==t)return n++,[n,r];if(n>=e.length)return null;var i=this.dialect.inline.__oneElement__.call(this,e.substr(n));n+=i[0],r.push.apply(r,i.slice(1))}},f.subclassDialect=function(e){function t(){}function n(){}return t.prototype=e.block,n.prototype=e.inline,{block:new t,inline:new n}},f.buildBlockOrder(f.dialects.Gruber.block),f.buildInlinePatterns(f.dialects.Gruber.inline),f.dialects.Maruku=f.subclassDialect(f.dialects.Gruber),f.dialects.Maruku.processMetaHash=function(e){for(var t=l(e),n={},r=0;r<t.length;++r)if(/^#/.test(t[r]))n.id=t[r].substring(1);else if(/^\./.test(t[r]))n.class?n.class=n.class+t[r].replace(/./," "):n.class=t[r].substring(1);else if(/\=/.test(t[r])){var i=t[r].split(/\=/);n[i[0]]=i[1]}return n},f.dialects.Maruku.block.document_meta=function(e,t){if(!(e.lineNumber>1)&&e.match(/^(?:\w+:.*\n)*\w+:.*$/)){s(this.tree)||this.tree.splice(1,0,{});var n=e.split(/\n/);for(p in n){var r=n[p].match(/(\w+):\s*(.*)$/),i=r[1].toLowerCase(),l=r[2];this.tree[1][i]=l}return[]}},f.dialects.Maruku.block.block_meta=function(e,t){var n=e.match(/(^|\n) {0,3}\{:\s*((?:\\\}|[^\}])*)\s*\}$/);if(n){var r,i=this.dialect.processMetaHash(n[2]);if(""===n[1]){var l=this.tree[this.tree.length-1];if(r=s(l),"string"==typeof l)return;r||(r={},l.splice(1,0,r));for(a in i)r[a]=i[a];return[]}var c=e.replace(/\n.*$/,""),o=this.processBlock(c,[]);r=s(o[0]),r||(r={},o[0].splice(1,0,r));for(a in i)r[a]=i[a];return o}},f.dialects.Maruku.block.definition_list=function(e,t){var n,r,i=/^((?:[^\s:].*\n)+):\s+([\s\S]+)$/,l=["dl"];if(r=e.match(i)){for(var s=[e];t.length&&i.exec(t[0]);)s.push(t.shift());for(var a=0;a<s.length;++a){var r=s[a].match(i),c=r[1].replace(/\n$/,"").split(/\n/),o=r[2].split(/\n:\s+/);for(n=0;n<c.length;++n)l.push(["dt",c[n]]);for(n=0;n<o.length;++n)l.push(["dd"].concat(this.processInline(o[n].replace(/(\n)\s+/,"$1"))))}return[l]}},f.dialects.Maruku.block.table=function(e,t){var n,r,i=function(e,t){t=t||"\\s",t.match(/^[\\|\[\]{}?*.+^$]$/)&&(t="\\"+t);for(var n,r=[],i=new RegExp("^((?:\\\\.|[^\\\\"+t+"])*)"+t+"(.*)");n=e.match(i);)r.push(n[1]),e=n[2];return r.push(e),r};if(r=e.match(/^ {0,3}\|(.+)\n {0,3}\|\s*([\-:]+[\-| :]*)\n((?:\s*\|.*(?:\n|$))*)(?=\n|$)/))r[3]=r[3].replace(/^\s*\|/gm,"");else if(!(r=e.match(/^ {0,3}(\S(?:\\.|[^\\|])*\|.*)\n {0,3}([\-:]+\s*\|[\-| :]*)\n((?:(?:\\.|[^\\|])*\|.*(?:\n|$))*)(?=\n|$)/)))return;var l=["table",["thead",["tr"]],["tbody"]];r[2]=r[2].replace(/\|\s*$/,"").split("|");var s=[];for(d(r[2],function(e){e.match(/^\s*-+:\s*$/)?s.push({align:"right"}):e.match(/^\s*:-+\s*$/)?s.push({align:"left"}):e.match(/^\s*:-+:\s*$/)?s.push({align:"center"}):s.push({})}),r[1]=i(r[1].replace(/\|\s*$/,""),"|"),n=0;n<r[1].length;n++)l[1][1].push(["th",s[n]||{}].concat(this.processInline(r[1][n].trim())));return d(r[3].replace(/\|\s*$/gm,"").split("\n"),function(e){var t=["tr"];for(e=i(e,"|"),n=0;n<e.length;n++)t.push(["td",s[n]||{}].concat(this.processInline(e[n].trim())));l[2].push(t)},this),[l]},f.dialects.Maruku.inline["{:"]=function(e,t,n){if(!n.length)return[2,"{:"];var r=n[n.length-1];if("string"==typeof r)return[2,"{:"];var i=e.match(/^\{:\s*((?:\\\}|[^\}])*)\s*\}/);if(!i)return[2,"{:"];var l=this.dialect.processMetaHash(i[1]),a=s(r);a||(a={},r.splice(1,0,a));for(var c in l)a[c]=l[c];return[i[0].length,""]},f.dialects.Maruku.inline.__escape__=/^\\[\\`\*_{}\[\]()#\+.!\-|:]/,f.buildBlockOrder(f.dialects.Maruku.block),f.buildInlinePatterns(f.dialects.Maruku.inline);var d,v=Array.isArray||function(e){return"[object Array]"==Object.prototype.toString.call(e)};d=Array.prototype.forEach?function(e,t,n){return e.forEach(t,n)}:function(e,t,n){for(var r=0;r<e.length;r++)t.call(n||e,e[r],r,e)};var _=function(e){for(var t in e)if(hasOwnProperty.call(e,t))return!1;return!0};e.renderJsonML=function(e,t){t=t||{},t.root=t.root||!1;var n=[];if(t.root)n.push(o(e));else for(e.shift(),!e.length||"object"!=typeof e[0]||e[0]instanceof Array||e.shift();e.length;)n.push(o(e.shift()));return n.join("\n\n")}}(function(){return"undefined"==typeof exports?(window.markdown={},window.markdown):exports}())});