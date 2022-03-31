!function(e,i){"function"==typeof define&&define.amd?define(["jquery","px-libs/jquery.flot"],i):"object"==typeof exports?module.exports=i(require("jquery"),require("px-libs/jquery.flot")):e.Jquery_flot_pie=i(e.jQuery,e._flot_)}(this,function(e,i){!function(e){function i(i){function r(i,s,t){A||(A=!0,b=i.getCanvas(),w=e(b).parent(),y=i.getOptions(),i.setData(a(i.getData())))}function a(i){for(var s=0,t=0,r=0,a=y.series.pie.combine.color,l=[],n=0;n<i.length;++n){var o=i[n].data;e.isArray(o)&&1==o.length&&(o=o[0]),e.isArray(o)?!isNaN(parseFloat(o[1]))&&isFinite(o[1])?o[1]=+o[1]:o[1]=0:o=!isNaN(parseFloat(o))&&isFinite(o)?[1,+o]:[1,0],i[n].data=[o]}for(var n=0;n<i.length;++n)s+=i[n].data[0][1];for(var n=0;n<i.length;++n){var o=i[n].data[0][1];o/s<=y.series.pie.combine.threshold&&(t+=o,r++,a||(a=i[n].color))}for(var n=0;n<i.length;++n){var o=i[n].data[0][1];(r<2||o/s>y.series.pie.combine.threshold)&&l.push(e.extend(i[n],{data:[[1,o]],color:i[n].color,label:i[n].label,angle:o*Math.PI*2/s,percent:o/(s/100)}))}return r>1&&l.push({data:[[1,t]],color:a,label:y.series.pie.combine.label,angle:t*Math.PI*2/s,percent:t/(s/100)}),l}function l(i,r){function a(){m.clearRect(0,0,l,o),w.children().filter(".pieLabel, .pieLabelBackground").remove()}if(w){var l=i.getPlaceholder().width(),o=i.getPlaceholder().height(),p=w.children().filter(".legend").children().width()||0;m=r,A=!1,k=Math.min(l,o/y.series.pie.tilt)/2,P=o/2+y.series.pie.offset.top,M=l/2,"auto"==y.series.pie.offset.left?(y.legend.position.match("w")?M+=p/2:M-=p/2,M<k?M=k:M>l-k&&(M=l-k)):M+=y.series.pie.offset.left;var h=i.getData(),u=0;do{u>0&&(k*=t),u+=1,a(),y.series.pie.tilt<=.8&&function(){var e=y.series.pie.shadow.left,i=y.series.pie.shadow.top,s=y.series.pie.shadow.alpha,t=y.series.pie.radius>1?y.series.pie.radius:k*y.series.pie.radius;if(!(t>=l/2-e||t*y.series.pie.tilt>=o/2-i||t<=10)){m.save(),m.translate(e,i),m.globalAlpha=s,m.fillStyle="#000",m.translate(M,P),m.scale(1,y.series.pie.tilt);for(var r=1;r<=10;r++)m.beginPath(),m.arc(0,0,t,0,2*Math.PI,!1),m.fill(),t-=r;m.restore()}}()}while(!function(){function i(e,i,s){e<=0||isNaN(e)||(s?m.fillStyle=i:(m.strokeStyle=i,m.lineJoin="round"),m.beginPath(),Math.abs(e-2*Math.PI)>1e-9&&m.moveTo(0,0),m.arc(0,0,t,r,r+e/2,!1),m.arc(0,0,t,r+e/2,r+e,!1),m.closePath(),r+=e,s?m.fill():m.stroke())}var s=Math.PI*y.series.pie.startAngle,t=y.series.pie.radius>1?y.series.pie.radius:k*y.series.pie.radius;m.save(),m.translate(M,P),m.scale(1,y.series.pie.tilt),m.save();for(var r=s,a=0;a<h.length;++a)h[a].startAngle=r,i(h[a].angle,h[a].color,!0);if(m.restore(),y.series.pie.stroke.width>0){m.save(),m.lineWidth=y.series.pie.stroke.width,r=s;for(var a=0;a<h.length;++a)i(h[a].angle,y.series.pie.stroke.color,!1);m.restore()}return n(m),m.restore(),!y.series.pie.label.show||function(){for(var i=s,t=y.series.pie.label.radius>1?y.series.pie.label.radius:k*y.series.pie.label.radius,r=0;r<h.length;++r){if(h[r].percent>=100*y.series.pie.label.threshold&&!function(i,s,r){if(0==i.data[0][1])return!0;var a,n=y.legend.labelFormatter,p=y.series.pie.label.formatter;a=n?n(i.label,i):i.label,p&&(a=p(a,i));var h=(s+i.angle+s)/2,u=M+Math.round(Math.cos(h)*t),c=P+Math.round(Math.sin(h)*t)*y.series.pie.tilt,g="<span class='pieLabel' id='pieLabel"+r+"' style='position:absolute;top:"+c+"px;left:"+u+"px;'>"+a+"</span>";w.append(g);var d=w.children("#pieLabel"+r),f=c-d.height()/2,v=u-d.width()/2;if(d.css("top",f),d.css("left",v),0-f>0||0-v>0||o-(f+d.height())<0||l-(v+d.width())<0)return!1;if(0!=y.series.pie.label.background.opacity){var b=y.series.pie.label.background.color;null==b&&(b=i.color);var k="top:"+f+"px;left:"+v+"px;";e("<div class='pieLabelBackground' style='position:absolute;width:"+d.width()+"px;height:"+d.height()+"px;"+k+"background-color:"+b+";'></div>").css("opacity",y.series.pie.label.background.opacity).insertBefore(d)}return!0}(h[r],i,r))return!1;i+=h[r].angle}return!0}()}()&&u<s);u>=s&&(a(),w.prepend("<div class='error'>Could not draw pie with labels contained inside canvas</div>")),i.setSeries&&i.insertLegend&&(i.setSeries(h),i.insertLegend())}}function n(e){if(y.series.pie.innerRadius>0){e.save();var i=y.series.pie.innerRadius>1?y.series.pie.innerRadius:k*y.series.pie.innerRadius;e.globalCompositeOperation="destination-out",e.beginPath(),e.fillStyle=y.series.pie.stroke.color,e.arc(0,0,i,0,2*Math.PI,!1),e.fill(),e.closePath(),e.restore(),e.save(),e.beginPath(),e.strokeStyle=y.series.pie.stroke.color,e.arc(0,0,i,0,2*Math.PI,!1),e.stroke(),e.closePath(),e.restore()}}function o(e,i){for(var s=!1,t=-1,r=e.length,a=r-1;++t<r;a=t)(e[t][1]<=i[1]&&i[1]<e[a][1]||e[a][1]<=i[1]&&i[1]<e[t][1])&&i[0]<(e[a][0]-e[t][0])*(i[1]-e[t][1])/(e[a][1]-e[t][1])+e[t][0]&&(s=!s);return s}function p(e,s){for(var t,r,a=i.getData(),l=i.getOptions(),n=l.series.pie.radius>1?l.series.pie.radius:k*l.series.pie.radius,p=0;p<a.length;++p){var h=a[p];if(h.pie.show){if(m.save(),m.beginPath(),m.moveTo(0,0),m.arc(0,0,n,h.startAngle,h.startAngle+h.angle/2,!1),m.arc(0,0,n,h.startAngle+h.angle/2,h.startAngle+h.angle,!1),m.closePath(),t=e-M,r=s-P,m.isPointInPath){if(m.isPointInPath(e-M,s-P))return m.restore(),{datapoint:[h.percent,h.data],dataIndex:0,series:h,seriesIndex:p}}else{if(o([[0,0],[n*Math.cos(h.startAngle),n*Math.sin(h.startAngle)],[n*Math.cos(h.startAngle+h.angle/4),n*Math.sin(h.startAngle+h.angle/4)],[n*Math.cos(h.startAngle+h.angle/2),n*Math.sin(h.startAngle+h.angle/2)],[n*Math.cos(h.startAngle+h.angle/1.5),n*Math.sin(h.startAngle+h.angle/1.5)],[n*Math.cos(h.startAngle+h.angle),n*Math.sin(h.startAngle+h.angle)]],[t,r]))return m.restore(),{datapoint:[h.percent,h.data],dataIndex:0,series:h,seriesIndex:p}}m.restore()}}return null}function h(e){c("plothover",e)}function u(e){c("plotclick",e)}function c(e,s){var t=i.offset(),r=parseInt(s.pageX-t.left),a=parseInt(s.pageY-t.top),l=p(r,a);if(y.grid.autoHighlight)for(var n=0;n<x.length;++n){var o=x[n];o.auto!=e||l&&o.series==l.series||d(o.series)}l&&g(l.series,e);var h={pageX:s.pageX,pageY:s.pageY};w.trigger(e,[h,l])}function g(e,s){var t=f(e);-1==t?(x.push({series:e,auto:s}),i.triggerRedrawOverlay()):s||(x[t].auto=!1)}function d(e){null==e&&(x=[],i.triggerRedrawOverlay());var s=f(e);-1!=s&&(x.splice(s,1),i.triggerRedrawOverlay())}function f(e){for(var i=0;i<x.length;++i){if(x[i].series==e)return i}return-1}function v(e,i){var s=e.getOptions(),t=s.series.pie.radius>1?s.series.pie.radius:k*s.series.pie.radius;i.save(),i.translate(M,P),i.scale(1,s.series.pie.tilt);for(var r=0;r<x.length;++r)!function(e){e.angle<=0||isNaN(e.angle)||(i.fillStyle="rgba(255, 255, 255, "+s.series.pie.highlight.opacity+")",i.beginPath(),Math.abs(e.angle-2*Math.PI)>1e-9&&i.moveTo(0,0),i.arc(0,0,t,e.startAngle,e.startAngle+e.angle/2,!1),i.arc(0,0,t,e.startAngle+e.angle/2,e.startAngle+e.angle,!1),i.closePath(),i.fill())}(x[r].series);n(i),i.restore()}var b=null,w=null,y=null,k=null,M=null,P=null,A=!1,m=null,x=[];i.hooks.processOptions.push(function(e,i){i.series.pie.show&&(i.grid.show=!1,"auto"==i.series.pie.label.show&&(i.legend.show?i.series.pie.label.show=!1:i.series.pie.label.show=!0),"auto"==i.series.pie.radius&&(i.series.pie.label.show?i.series.pie.radius=.75:i.series.pie.radius=1),i.series.pie.tilt>1?i.series.pie.tilt=1:i.series.pie.tilt<0&&(i.series.pie.tilt=0))}),i.hooks.bindEvents.push(function(e,i){var s=e.getOptions();s.series.pie.show&&(s.grid.hoverable&&i.unbind("mousemove").mousemove(h),s.grid.clickable&&i.unbind("click").click(u))}),i.hooks.processDatapoints.push(function(e,i,s,t){e.getOptions().series.pie.show&&r(e,i,s)}),i.hooks.drawOverlay.push(function(e,i){e.getOptions().series.pie.show&&v(e,i)}),i.hooks.draw.push(function(e,i){e.getOptions().series.pie.show&&l(e,i)})}var s=10,t=.95,r={series:{pie:{show:!1,radius:"auto",innerRadius:0,startAngle:1.5,tilt:1,shadow:{left:5,top:15,alpha:.02},offset:{top:0,left:"auto"},stroke:{color:"#fff",width:1},label:{show:"auto",formatter:function(e,i){return"<div style='font-size:x-small;text-align:center;padding:2px;color:"+i.color+";'>"+e+"<br/>"+Math.round(i.percent)+"%</div>"},radius:1,background:{color:null,opacity:0},threshold:0},combine:{threshold:-1,color:null,label:"Other"},highlight:{opacity:.5}}}};e.plot.plugins.push({init:i,options:r,name:"pie",version:"1.1"})}(e)});