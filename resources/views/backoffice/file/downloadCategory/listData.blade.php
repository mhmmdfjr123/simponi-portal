<table class="table table-hover">
    <thead>
        <tr>
            <th style="width: 460px">Nama</th>
            <th>Desc</th>
            <th style="width: 80px">Status</th>
            <th style="width: 80px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
    @foreach($listData as $category)
        <tr>
            <td>
                <div style="padding-left: {{ ($category['level'] - 1) * 40 }}px">{{ $category->name }}</div>
            </td>
            <td>{{ $category->desc }}</td>
            <td>{!! postCategoryStatusTextWithStyle($category->status) !!}</td>
            <td>
                <div class="btn-group">
                    <a href="javascript:void(0)" onclick="loadIntoBox('{{ url('backoffice/file/download/category/'.$category->id.'/edit') }}')" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>

                    @if(!in_array($category->id, $protectedID))
                        <a href="javascript:void(0)" onclick="confirmDirectPopUp('{{ url('backoffice/file/download/category/'.$category->id.'/delete') }}', 'Konfirmasi', 'Apakah anda yakin ingin menghapus?', 'Ya, Hapus Data', 'Tidak')" title="Hapus" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                    @else
                        <a href="javascript:void(0)" title="Hapus" class="btn btn-xs btn-default" disabled="true"><i class="fa fa-trash"></i></a>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>