!function(a){"use strict";a("a.page-scroll").bind("click",function(n){var r=a(this);a("html, body").stop().animate({scrollTop:a(r.attr("href")).offset().top-50},1250,"easeInOutExpo"),n.preventDefault()});var n=150;a("#main-nav").affix({offset:{top:n}}),window.sr=ScrollReveal(),sr.reveal(".sr-icons",{duration:600,scale:.3,distance:"0px"},200),sr.reveal(".sr-button",{duration:1e3,delay:200}),sr.reveal(".sr-contact",{duration:600,scale:.3,distance:"0px"},300),a.validator.setDefaults({errorPlacement:function(a,n){n.parent().hasClass("input-prepend")||n.parent().hasClass("input-append")?a.insertAfter(n.parent()):a.insertAfter(n)},errorElement:"span",highlight:function(n){a(n).closest(".form-group").removeClass("has-success").addClass("has-error")},unhighlight:function(n){a(n).closest(".form-group").removeClass("has-error").addClass("has-success")}}),a.extend(a.validator.messages,{required:"Kolom ini diperlukan.",remote:"Harap perbaiki kolom ini.",email:"Silakan masukkan format email yang benar.",url:"Silakan masukkan format URL yang benar.",date:"Silakan masukkan format tanggal yang benar.",dateISO:"Silakan masukkan format tanggal(ISO) yang benar.",number:"Silakan masukkan angka yang benar.",digits:"Harap masukan angka saja.",creditcard:"Harap masukkan format kartu kredit yang benar.",equalTo:"Harap masukkan nilai yg sama dengan sebelumnya.",maxlength:a.validator.format("Input dibatasi hanya {0} karakter."),minlength:a.validator.format("Input tidak kurang dari {0} karakter."),rangelength:a.validator.format("Panjang karakter yg diizinkan antara {0} dan {1} karakter."),range:a.validator.format("Harap masukkan nilai antara {0} dan {1}."),max:a.validator.format("Harap masukkan nilai lebih kecil atau sama dengan {0}."),min:a.validator.format("Harap masukkan nilai lebih besar atau sama dengan {0}.")});var r=a(".form-validate"),t=a(".btn-submit");t.button({loadingText:"Mohon Tunggu..."}),r.validate(),r.submit(function(){r.valid()&&t.button("loading")})}(jQuery);