$("input.currency").numeric().keydown(function(){$(this).val($(this).val().replace(/\./g,""))}).keyup(function(){$(this).val().length>0?$(this).attr("data-value",$(this).val()).val($(this).val().replace(/(?!^)(?=(?:\d{3})+(?:\.|$))/gm,".")):$(this).attr("data-value",0)}),$("input.percentage").numeric().keyup(function(){$(this).val().length>0?$(this).attr("data-value",parseFloat($(this).val())/100):$(this).attr("data-value",0)}),$('input[name="topupRadio"]').click(function(){$(this).parent().is(":first-child")?$("input#starting-balance").attr("disabled",!0).removeAttr("required"):$("input#starting-balance").removeAttr("disabled").attr("required",!0)}),$('input[name="billingRadio"]').click(function(){var a=$(this).parent().index()<1?"Bulan":"Tahun";$(".billing label").text("Iuran Per "+a),$(".billing input").attr("placeholder","Masukkan Iuran Per "+a).removeAttr("disabled"),$("#billing-increment").removeAttr("disabled")}),$("input, select").focus(function(){$(this).closest(".form-group").children(".validation-warning").remove()}),$('[data-toggle="tooltip"]').tooltip();var ctx=$("canvas#simulation"),getYAxes=function(){return[{ticks:{beginAtZero:!0,callback:function(a){var t=parseInt(a);return"Rp"+(t>=1e3?t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,"."):t)}}}]},getTooltips=function(){return{callbacks:{label:function(a){var t=parseInt(a.yLabel);return"Rp"+(t>=1e3?t.toString().replace(/\B(?=(\d{3})+(?!\d))/g,"."):t)}}}},getDatasets=function(a,t,e,n,i,l){return{label:a,backgroundColor:t,borderColor:e,pointBackgroundColor:n,pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:i,data:l}},getChart=function(a){return{type:"line",data:{labels:a[0],datasets:[getDatasets("Dana Awal","rgba(49,133,156,.2)","rgba(49,133,156,1)","rgba(49,133,156,1)","rgba(49,133,156,1)",a[1]),getDatasets("Iuran","rgba(192,80,77,.2)","rgba(192,80,77,1)","rgba(192,80,77,1)","rgba(192,80,77,1)",a[2]),getDatasets("Pengembangan","rgba(119,147,60,.2)","rgba(119,147,60,1)","rgba(119,147,60,1)","rgba(119,147,60,1)",a[3]),getDatasets("Saldo Akhir","rgba(179,181,198,.2)","rgba(179,181,198,1)","rgba(179,181,198,1)","rgba(179,181,198,1)",a[4])]},options:{scales:{xAxes:[{scaleLabel:{display:!0,labelString:"Usia (dalam tahun)"}}],yAxes:getYAxes()},tooltips:getTooltips()}}},myChart=new Chart(ctx,getChart([[40,45,50,55,60],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0],[0,0,0,0,0]]));$(".calculate").click(function(){var a=$(this).closest("form");$(".date-control > *");if(a.validate()){var t=parseInt($("#age option:selected").attr("data-value")),e=parseInt($("#retirement-age option:selected").attr("data-value")),n=12*(e-t),i=[[],[],[],[],[]];countlast=n/60,countlast=countlast>4?4:countlast-1,isannualstartingbalance=$('input[name="topupRadio"]:checked').parent().is(":last-child"),startingbalance=parseFloat($("#starting-balance").attr("data-value")),accumulatedstartingbalance=startingbalance,isannualbilling=$('input[name="billingRadio"]:checked').parent().is(":last-child"),billing=parseFloat($(".billing input.currency").attr("data-value")),accumulatedbilling=billing,billingincrement=parseFloat($("#billing-increment").attr("data-value")),interestrate=parseFloat($("#interest-rate option:selected").attr("data-value")),monthlyinterestrate=interestrate/12,administrationfee=parseFloat($("#administration-fee").attr("data-value")),managementfee=parseFloat($("#management-fee").attr("data-value")),accumulatedfund=startingbalance+billing+(startingbalance+billing)*monthlyinterestrate,isnewyear=!1;for(var l=2;l<=n;l++){accumulatedstartingbalance=isannualstartingbalance&&isnewyear?accumulatedstartingbalance+startingbalance:accumulatedstartingbalance,accumulatedbilling=isannualbilling?isnewyear?accumulatedbilling+billing:accumulatedbilling:accumulatedbilling+billing,accumulatedfund=isannualstartingbalance&&isnewyear?accumulatedfund+startingbalance:accumulatedfund;var r=accumulatedfund+billing;if(accumulatedfund=isannualbilling?isnewyear?r+r*monthlyinterestrate:accumulatedfund+accumulatedfund*monthlyinterestrate:r+r*monthlyinterestrate,isnewyear=l%12==0,isnewyear){accumulatedfund-=administrationfee+accumulatedfund*managementfee,billing+=billing*billingincrement;var s=countlast-i[0].length;l==n-60*s&&(i[0].push(e-5*s),i[1].push(accumulatedstartingbalance),i[2].push(accumulatedbilling),i[3].push(accumulatedfund-(accumulatedstartingbalance+accumulatedbilling)),i[4].push(accumulatedfund),startingbalance=isannualstartingbalance?startingbalance:0)}}var c=function(a){return{number:a,numberStep:$.animateNumber.numberStepFactories.separator(".")}};$("#total-funding span").text("Rp").siblings("b").animateNumber(c(parseInt(accumulatedstartingbalance+accumulatedbilling)),1800),$("#total-development span").text("Rp").siblings("b").animateNumber(c(parseInt(i[3][i[3].length-1])),1800),$("#total-fund span").text("Rp").siblings("b").animateNumber(c(parseInt(accumulatedfund)),1800),$("iframe.chartjs-hidden-iframe").remove(),ctx.after('<canvas id="simulation" class="col-xs-12" height="250"></canvas>').remove(),ctx=$("canvas#simulation"),setTimeout(function(){myChart=new Chart(ctx,getChart(i))},500),$('[href="#simulation"]').click()}else $('[href="#simulation-form"]').click()}),$.fn.validate=function(){var a=!0;return this.find("[required]").each(function(){var t=$(this).closest(".form-group"),e=t.children(".validation-warning");if(existingwarning=e.length>0,$(this).is("select")){var n=$(this).children("option:selected").index()>0;a=a&&n,n?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Opsi di atas harus dipilih</small>')}else if($(this).is("input"))if($(this).is('[type="radio"]')||$(this).is('[type="checkbox"]')){var n=$(this).is(":checked")||$(this).closest("label").siblings().find(":checked").length>0;a=a&&n,n?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Pilihan tidak boleh kosong</small>')}else{var n=$(this).val().length>0;if(a=a&&n,n&&$(this).is('[type="email"]')){var i=$(this).split("@"),l=i.length>1&&i[1].indexOf(".")>=0;a=a&&l,l?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Email tidak valid</small>')}n?existingwarning&&e.remove():!existingwarning&&t.append('<small class="validation-warning">Kolom tidak boleh kosong</small>')}}),a};