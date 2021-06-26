<table class="table table_sp ">
    <thead class="heading-table">
        <tr>
            <th style="border-left: 1px solid rgba(197, 197, 197, 0.1); width:2%;">STT</th>
            <th style="width: 25%;">Mã loại TSCĐ</th>
            <th style="width: 25%;">Tên Loại TSCĐ</th>
            <th style="width: 25%;">Thuộc loại</th>
            <th style="width: 15%">Hoạt động</th>
        </tr>
    </thead>
    <tbody>
        @php
        $page =$loaiTSCD->currentPage();
        $prepage = $page -1;
            if($page>1){
                $count = $prepage*8+1;
            }else {
                $count = 1;
            }
        @endphp
        @foreach ($loaiTSCD as $item)
            <tr class="body-table">
                <td >{{$count}}</td>
                <td>{{$item->ma_loai}}</td>
                <td >{{$item->ten_loai}}</td>
                <td >{{$item->loai}}</td>
                <td >
                    <button style="width:40px; height:40px; margin-left: 10%; border:none; background-color: transparent;" title="Sửa loại" ><i class='bx bx-edit' style="font-size: 30px; color:#5bc0de;"></i></button>
                    <button style="width:40px; height:40px; margin-left: 10%; border:none; background-color: transparent;" title="Xóa loại" ><i class='bx bxs-trash' style="font-size: 30px; color:#FF3300;"></i></button>
                </td>
            </tr>
            @php
                $count++;
            @endphp
        @endforeach
    </tbody>
</table>
<div style="position: absolute; right: 0;">
    {{$loaiTSCD->onEachSide(2)->links()}}
</div>