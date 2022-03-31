$.fn.validate=function(){var a=!0;return this.find("[required]").each(function(){var t=$(this).closest(".form-group"),e=t.children(".validation-warning");if(existingwarning=e.length>0,$(this).is("select")){var n=$(this).children("option:selected").index()>0;a=a&&n,n?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Opsi di atas harus dipilih</small>')}else if($(this).is("input"))if($(this).is('[type="radio"]')||$(this).is('[type="checkbox"]')){var n=$(this).is(":checked")||$(this).closest("label").siblings().find(":checked").length>0;a=a&&n,n?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Pilihan tidak boleh kosong</small>')}else{var n=$(this).val().length>0;if(a=a&&n,n?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Kolom tidak boleh kosong</small>'),e=t.children(".validation-warning"),existingwarning=e.length>0,n&&$(this).is('[type="email"]')){var i=$(this).split("@"),r=i.length>1&&i[1].indexOf(".")>=0;a=a&&r,r?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Email tidak valid</small>')}if(n&&$(this).is(".numstart")){var l=$($(this).data("numstart-target")).val(),s=parseInt($(this).val())<parseInt(l),u=$(this).data("numstart-message");a=a&&s,s?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">'+u+"</small>")}if(n&&$(this).is("[data-min-value]")){var l=parseInt($(this).data("min-value")),c=$(this).val()>=l,u=$(this).data("message");a=a&&c,c?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">'+u+"</small>")}if(n&&$(this).is("[data-max-value]")){var l=parseInt($(this).data("max-value")),o=$(this).val()<=l,u=$(this).data("message");a=a&&o,o?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">'+u+"</small>")}}}),a},$.fn.validateNow=function(){this.each(function(){var a=null;$(this).keydown(function(){$(this).closest(".form-group").children(".validation-warning").remove(),a=$(this).val()}).keyup(function(){var a=$(this).val(),t=$(this).data("min-value"),t="undefined"==typeof t?0:parseInt(t),e=$(this).data("max-value"),e="undefined"==typeof e?0:parseInt(e),n=a>=t&&(!(e>0)||a<=e);if(!n&&a.length>0){var i=$(this).data("message"),r=$(this).closest(".form-group"),l=r.children(".validation-warning"),s=l.length>0;s?l.text(i):r.append('<small class="validation-warning">'+i+"</small>")}}).blur(function(){var a=$(this).val(),t=$(this).data("min-value"),t="undefined"==typeof t?0:parseInt(t),e=$(this).data("max-value"),e="undefined"==typeof e?0:parseInt(e),n=a>=t&&(!(e>0)||a<=e),i=$(this).closest(".form-group"),r=i.children(".validation-warning"),l=r.length>0;if(!n&&a.length>0){var s=$(this).data("message");l?r.text(s):i.append('<small class="validation-warning">'+s+"</small>")}else r.remove()})})};var formatCurrency=function(a){return a.replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm,".")},presentValue=function(a,t,e,n){return t<1?0:a>0?-(Math.pow(1+a,-t)*(n*a-e+Math.pow(1+a,t)*e))/a:-(n+e*t)},periodicPayment=function(a,t,e,n,i){if(a>0){var r=Math.pow(1+a,t);return-(a*(n+r*e))/((-1+r)*(1+a*i))}return t>0?-(n+e)/t:0};$("input.numeric").keyup(function(){$(this).val().length>0?$(this).attr("data-value",$(this).val()):$(this).attr("data-value",0)}),$("input.percentage").keyup(function(){$(this).val().length>0?$(this).attr("data-value",parseFloat($(this).val())/100):$(this).attr("data-value",0)}),$('input[name="topupRadio"]').click(function(){$(this).parent().is(":first-child")?$("input#starting-balance").attr("disabled",!0).removeAttr("required"):$("input#starting-balance").removeAttr("disabled").attr("required",!0)}),$('input[name="billingRadio"]').click(function(){var a=$(this).parent().index()<1?"Bulan":"Tahun";$(".billing label").text("Iuran Per "+a),$(".billing input").attr("placeholder","Masukkan Iuran Per "+a).removeAttr("disabled"),$("#billing-increment").removeAttr("disabled")}),$("input, select").focus(function(){$(this).closest(".form-group").children(".validation-warning").remove()}),$("input.numeric").numeric(),$(".validatenow").validateNow(),$("input[data-target]").keyup(function(){var a=$(this).data("target").split(",");for(var t in a)$(a[t]).click()}),$("select[data-target]").change(function(){var a=$(this).data("target").split(",");for(var t in a)$(a[t]).click()}),$("#duration").click(function(){var a=parseInt($("#retirement-age").attr("data-value")),t=parseInt($("#age").attr("data-value")),e=a-t;$(this).val(e+" tahun").attr("data-value",e)}),$("#duration-after").click(function(){var a=parseInt($("#life-expectancy").attr("data-value")),t=parseInt($("#retirement-age").attr("data-value")),e=a-t;$(this).val(e+" tahun").attr("data-value",e)}),$("#living-cost-after").click(function(){for(var a=parseInt($("#living-cost").attr("data-value")),t=parseFloat($("#inflation-rate").attr("data-value")),e=parseInt($("#duration").attr("data-value")),n=1;n<=e;n++)a+=a*t;$(this).val(formatCurrency(parseInt(a).toString())).attr("data-value",a)}),$("#living-cost-total").click(function(){var a=parseFloat($("#living-cost-after").attr("data-value")),t=parseFloat($("#inflation-rate").attr("data-value")),e=1.075/(1+t)-1;durationafter=parseInt($("#duration-after").attr("data-value")),pv=presentValue(e/12,12*durationafter,-a,0),$(this).val(formatCurrency(parseInt(pv).toString())).attr("data-value",pv)}),$('[data-toggle="tooltip"]').tooltip();var ctx=$("canvas#simulation"),getYAxes=function(){return[{ticks:{beginAtZero:!0,callback:function(a){var t=parseInt(a);return"Rp"+(t>=1e3?t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,"."):t)}}}]},getTooltips=function(){return{callbacks:{label:function(a){var t=parseInt(a.yLabel);return"Rp"+(t>=1e3?t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,"."):t)}}}},getDatasets=function(a,t,e,n,i,r){return{label:a,backgroundColor:t,borderColor:e,pointBackgroundColor:n,pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:i,data:r}},getChart=function(a){return{type:"line",data:{labels:a[0],datasets:[getDatasets("Dana Awal","rgba(49,133,156,.2)","rgba(49,133,156,1)","rgba(49,133,156,1)","rgba(49,133,156,1)",a[1]),getDatasets("Iuran","rgba(192,80,77,.2)","rgba(192,80,77,1)","rgba(192,80,77,1)","rgba(192,80,77,1)",a[2]),getDatasets("Pengembangan","rgba(119,147,60,.2)","rgba(119,147,60,1)","rgba(119,147,60,1)","rgba(119,147,60,1)",a[3]),getDatasets("Saldo Akhir","rgba(179,181,198,.2)","rgba(179,181,198,1)","rgba(179,181,198,1)","rgba(179,181,198,1)",a[4])]},options:{scales:{xAxes:[{scaleLabel:{display:!0,labelString:"Usia (dalam tahun)"}}],yAxes:getYAxes()},tooltips:getTooltips()}}},myChart=ctx.length>0?new Chart(ctx,getChart([[40,45,50,55,60],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]])):null;$(".calculate").click(function(){var a=$(this).closest("form");$(".date-control > *");if(a.validate()){if(a.hasClass("rev")){var t=parseFloat($("#investation-rate").attr("data-value")),e=parseInt($("#duration").attr("data-value")),n=parseInt($("#living-cost-total").attr("data-value")),i=periodicPayment(t/12,12*e,0,-n,0),r=periodicPayment(t,e,0,-n,0),l=presentValue(t,e,0,-n);console.log(t/12),$(".narration").addClass("active").find("[data-info]").each(function(){var a=$($(this).data("info")),t=a.is("select")?a.find("option:selected").data("value"):a.attr("data-value"),t="#inflation-rate"==$(this).data("info")?parseInt(100*parseFloat(t)):$(this).data("info").indexOf("cost")>=0?formatCurrency(parseInt(t).toString()):t;$(this).text(t)});var s=function(a){return{number:a,numberStep:$.animateNumber.numberStepFactories.separator(".")}};$("#monthly-investation span").text("Rp").siblings("b").animateNumber(s(i),1800),$("#annual-investation span").text("Rp").siblings("b").animateNumber(s(r),1800),$("#lumpsum span").text("Rp").siblings("b").animateNumber(s(l),1800)}else{var u=parseInt($("#age").attr("data-value")),c=parseInt($("#retirement-age").attr("data-value")),o=12*(c-u),d=[[],[],[],[],[]];datachartperiod=o<120?12:60,countlast=o/datachartperiod,countlast=countlast>(o<120?9:4)?o<120?9:4:countlast-1,isannualstartingbalance=$('input[name="topupRadio"]:checked').parent().is(":last-child"),startingbalance=parseFloat($("#starting-balance").attr("data-value")),accumulatedstartingbalance=startingbalance,isannualbilling=$('input[name="billingRadio"]:checked').parent().is(":last-child"),billing=parseFloat($(".billing input.currency").attr("data-value")),accumulatedbilling=billing,billingincrement=parseFloat($("#billing-increment").attr("data-value")),interestrate=parseFloat($("#interest-rate").attr("data-value")),monthlyinterestrate=interestrate/12,administrationfee=parseFloat($("#administration-fee").attr("data-value")),managementfee=parseFloat($("#management-fee").attr("data-value")),accumulatedfund=startingbalance+billing+(startingbalance+billing)*monthlyinterestrate,isnewyear=!1;for(var g=2;g<=o;g++){accumulatedstartingbalance=isannualstartingbalance&&isnewyear?accumulatedstartingbalance+startingbalance:accumulatedstartingbalance,accumulatedbilling=isannualbilling?isnewyear?accumulatedbilling+billing:accumulatedbilling:accumulatedbilling+billing,accumulatedfund=isannualstartingbalance&&isnewyear?accumulatedfund+startingbalance:accumulatedfund;var m=accumulatedfund+billing;if(accumulatedfund=isannualbilling?isnewyear?m+m*monthlyinterestrate:accumulatedfund+accumulatedfund*monthlyinterestrate:m+m*monthlyinterestrate,isnewyear=g%12==0,isnewyear){accumulatedfund-=administrationfee+accumulatedfund*managementfee,billing+=billing*billingincrement;var p=countlast-d[0].length;g==o-p*datachartperiod&&(d[0].push(c-p*(o<120?1:5)),d[1].push(accumulatedstartingbalance),d[2].push(accumulatedbilling),d[3].push(accumulatedfund-(accumulatedstartingbalance+accumulatedbilling)),d[4].push(accumulatedfund),startingbalance=isannualstartingbalance?startingbalance:0)}}var s=function(a){return{number:a,numberStep:$.animateNumber.numberStepFactories.separator(".")}};$("#total-funding span").text("Rp").siblings("b").animateNumber(s(parseInt(accumulatedstartingbalance+accumulatedbilling)),1800),$("#total-development span").text("Rp").siblings("b").animateNumber(s(parseInt(accumulatedfund-(accumulatedstartingbalance+accumulatedbilling)),1800)),$("#total-fund span").text("Rp").siblings("b").animateNumber(s(parseInt(accumulatedfund)),1800),$("iframe.chartjs-hidden-iframe").remove(),ctx.after('<canvas id="simulation" class="col-xs-12" height="250"></canvas>').remove(),ctx=$("canvas#simulation"),setTimeout(function(){myChart=new Chart(ctx,getChart(d))},500)}$('[href="#simulation"]').click()}else $('[href="#simulation-form"]').click()});