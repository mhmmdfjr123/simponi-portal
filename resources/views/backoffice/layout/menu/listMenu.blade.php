@if(count($listMenu) > 0)
<div class="dd" id="dd-{{ $catId }}">

    <ol class="dd-list">
        @foreach($listMenu as $row)
            <!-- Level 1 -->
            <li class="dd-item" data-id="{{ $row['data']->id }}">
                <div class="dd-handle">
                    {{ $row['data']->menu_name }} {{ '('.menuTypeText($row['data']->menu_type).')' }}
                </div>

                <div class="btn-nestable btn-group">
                    <a href="javascript:void(0)" class="btn btn-xs" onclick="loadIntoBox('{{ url('backoffice/layout/menu/edit/'.$row['data']->id) }}')">Ubah</a>
                    <a href="javascript:void(0)" class="btn btn-xs" data-id="{{ $row['data']->id }}" onclick="confirmPopUp(this, deleteMenu, 'Konfirmasi', 'Apakah anda yakin?', 'Ya', 'Tidak')">Hapus</a>
                </div>

                <!-- Level 2 -->
                @if(count($row['children']) > 0)
                    <ol class="dd-list">
                        @foreach($row['children'] as $row2)
                            <li class="dd-item" data-id="{{ $row2['data']->id }}">
                                <div class="dd-handle">{{ $row2['data']->menu_name }} {{ '('.menuTypeText($row2['data']->menu_type).')' }}</div>
                                <div class="btn-nestable btn-group">
                                    <a href="javascript:void(0)" class="btn btn-xs" onclick="loadIntoBox('{{ url('backoffice/layout/menu/edit/'.$row2['data']->id) }}')">Ubah</a>
                                    <a href="javascript:void(0)" class="btn btn-xs" data-id="{{ $row2['data']->id }}" onclick="confirmPopUp(this, deleteMenu, 'Konfirmasi', 'Apakah anda yakin?', 'Ya', 'Tidak')">Hapus</a>
                                </div>

                                <!-- Level 3 -->
                                @if(count($row2['children']) > 0)
                                    <ol class="dd-list">
                                        @foreach($row2['children'] as $row3)
                                            <li class="dd-item" data-id="{{ $row3['data']->id }}">
                                                <div class="dd-handle">{{ $row3['data']->menu_name }} {{ '('.menuTypeText($row3['data']->menu_type).')' }}</div>
                                                <div class="btn-nestable btn-group">
                                                    <a href="javascript:void(0)" class="btn btn-xs" onclick="loadIntoBox('{{ url('backoffice/layout/menu/edit/'.$row3['data']->id) }}')">Ubah</a>
                                                    <a href="javascript:void(0)" class="btn btn-xs" data-id="{{ $row3['data']->id }}" onclick="confirmPopUp(this, deleteMenu, 'Konfirmasi', 'Apakah anda yakin?', 'Ya', 'Tidak')">Hapus</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                @endif

                            </li>
                        @endforeach
                    </ol>
                @endif

            </li>
        @endforeach
    </ol>
</div>

<script type="text/javascript">
    require(['jquery', 'px-libs/toastr', 'nestable'], function($, toastr) {
        $('#dd-<?php echo $catId ?>').nestable({
            maxDepth    : 3,
            dropCallback: function(details) {
                var order = new Array();

                if(details.parentId != null && details.parentId != ''){
                    $("li[data-id='"+details.parentId +"']").find('ol:first').children().each(function(index,elem) {
                        order[index] = $(elem).attr('data-id');
                    });
                }else{
                    $('div#dd-<?php echo $catId ?>').find('ol:first').children().each(function(index,elem) {
                        order[index] = $(elem).attr('data-id');
                    });
                }

                var csrf = '{{ csrf_token() }}';

                console.log(JSON.stringify(order));

                $.ajax({
                    url: '{{ url('backoffice/layout/menu/menu-index')  }}',
                    data: {
                        '_token'    : csrf,
                        'parentId'  : details.parentId,
                        'itemId'    : details.itemId,
                        'children'  : JSON.stringify(order)
                    },
                    beforeSend: function(){
                        jQuery.facebox('<div class="loader">Loading...</div>');
                    },
                    success: function(response, statusText, xhr, $form){
                        if (statusText == "success") {
                            if(response.status == 'ok'){
                                toastr.success(response.message, 'Sukses.');
                            }else{
                                toastr.error(response.message, 'Oppss.');
                            }

                            jQuery.facebox.close();
                        } else {
                            alertError();
                        }
                    },
                    type:"post",
                    dataType:"json"
                });
            }
        });
    });
</script>

    <div id="test-canvas"></div>
@else
<div class="note note-warning">
    <h4 class="note-title">Info</h4>
    Anda belum memiliki menu pada kategori ini.
</div>
@endif