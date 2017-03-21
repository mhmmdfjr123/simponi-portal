<!-- ITEM -->
@foreach($faqCategories as $faqCategory)
<div class="panel panel-faq" id="faq-category-{{ $faqCategory->id }}" data-id="{{ $faqCategory->id }}">
    <div class="panel-heading">
        <span class="panel-title">{{ $faqCategory->name }}</span>
        @if($faqCategory->status != 'Y')
            <span class="label label-danger">Tidak Aktif</span>
        @endif
        <div class="panel-heading-controls">
            <a href="{{ url('backoffice/support/faq/add/with-category/'.$faqCategory->id) }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Tambah Item</a>
            <a href="javascript:void(0)" onclick="loadIntoBox('{{ url('backoffice/support/faq/category/'.$faqCategory->id.'/edit') }}')" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Ubah Kategori</a>
        </div>
    </div>
    <div class="panel-body faq-list">
        @if($faqCategory->faqs->count() > 0)
            @foreach($faqCategory->faqs as $faq)
                <div class="faq-list-item" data-id="{{ $faq->id }}">
                    {{ $faq->question }}
                    @if($faq->status != 'Y')
                        <span class="label label-danger">Tidak Aktif</span>
                    @endif

                    <div class="pull-right">
                        <a href="{{ url('backoffice/support/faq/'.$faq->id.'/edit') }}" class="btn btn-xs btn-default"><i class="fa fa-plus"></i> Ubah</a>
                        <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ url('backoffice/support/faq/'.$faq->id.'/delete') }}', 'Hapus FAQ', 'Anda yakin akan menghapus item ini?', 'Hapus', 'Batal')" class="btn btn-xs btn-default"><i class="fa fa-edit"></i> Hapus</a>
                    </div>
                </div>
            @endforeach
        @endif

        <div class="text-center ignore-dragging" id="faq-action-{{ $faqCategory->id }}" style="{{ $faqCategory->faqs->count() > 0 ? 'display: none' : '' }}">
            Tidak ada FAQ Item yang tersedia pada kategori ini.<br>
            Silahkan <a href="{{ url('backoffice/support/faq/add/with-category/'.$faqCategory->id) }}" class="btn btn-xs btn-success"><i class="fa fa-plus"></i>  Tambah Item</a>
            atau <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ url('backoffice/support/faq/category/'.$faqCategory->id.'/delete') }}', 'Hapus Kategori FAQ', 'Anda yakin akan menghapus kategori ini?', 'Hapus', 'Batal')" class="btn btn-xs btn-danger">Hapus</a> kategori ini
        </div>
    </div>
</div>
@endforeach

<script type="text/javascript">
    require(['jquery', 'px-libs/Sortable', 'px-libs/toastr', 'px-libs/jquery.facebox'], function($, Sortable, toastr) {
        var container = document.getElementById('faq-container');
        var csrfToken = '{{ csrf_token() }}';

        Sortable.create(container, {
            animation: 150,
            draggable: '.panel-faq',
            handle: '.panel-heading',
            ghostClass: 'faq-zone-target',
            onSort: function (evt) {
                var faqCategoriesID = [];

                [].forEach.call(evt.to.children, function (el){
                    if($(el).data('id'))
                        faqCategoriesID.push($(el).data('id'));
                });

                reOrdering('{{ url('backoffice/support/faq/category/re-order') }}', faqCategoriesID, null);
            },
        });

        [].forEach.call(container.getElementsByClassName('faq-list'), function (el){
            Sortable.create(el, {
                group: 'faq',
                animation: 150,
                ghostClass: 'faq-zone-target',
                filter: ".ignore-dragging",
                onAdd: function (evt) {
                    onItemChanged(evt);
                    setFaqActionState(evt.from);
                    setFaqActionState(evt.to);
                },
                onUpdate: function (evt) {
                    onItemChanged(evt);
                },
            });
        });

        function onItemChanged(evt) {
            var faqCategoryId = $(evt.to).parent().data('id');
            var faqsID = [];

            [].forEach.call(evt.to.children, function (el){
                if($(el).data('id'))
                    faqsID.push($(el).data('id'));
            });
            reOrdering('{{ url('backoffice/support/faq/re-order') }}', faqsID, faqCategoryId);
        }

        function setFaqActionState(obj) {
            var $faqAction = $('#faq-action-' + $(obj).parent().data('id'));
            if (obj.children.length-1 > 0)
                $faqAction.css('display', 'none');
            else
                $faqAction.css('display', 'block');
        }
        
        function reOrdering(url, items, parentId) {
            var requestBody = {
                '_token' : csrfToken,
                'items'  : items,
                'parentId': parentId
            };

            $.ajax({
                url: url,
                data: requestBody,
                beforeSend: function(){
                    popUpLoader();
                },
                success: function(response){
                    if(response.status == 'ok'){
                        toastr.success(response.message, 'Sukses.');
                    }else{
                        toastr.error(response.message, 'Oppss.');
                    }

                    jQuery.facebox.close();
                },
                type: "post",
                dataType: "json"
            });
        }
    });
</script>