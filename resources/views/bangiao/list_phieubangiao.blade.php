<table class="table table_sp ">
    <thead class="heading-table">
        <tr>
            <th style="border-left: 1px solid rgba(0,0,0,.1); width:5%;">STT</th>
            <th >Mã Phiếu</th>
            <th >Tên người giao</th>
            <th >Phòng giao</th>
            <th >Tên người nhận</th>
            <th >Phòng nhận</th>
            <th >Ngày giao</th>
            <th style="width: 15%;">Lý do</th>
            <th style="width: 5%;">In phiếu</th>
        </tr>
    </thead>
    <tbody >
        @php
            $page =$bangiao->currentPage();
            $prepage = $page -1;
                if($page>1){
                    $count = $prepage*8+1;
                }else {
                    $count = 1;
                }
            

            @endphp
        @foreach ($bangiao as $item)
            @php
                $nv_giao='';
                $phonggiao ='';
                $nv_nhan ='';
                $phongnhan ='';
                foreach ($nhanvien as $val) {
                    if($item->nguoi_giao == $val->ma_nv){
                        $nv_giao = $val->ten_nv;
                        $phonggiao = $val->ten_phong;
                    }
                    if($item->nguoi_nhan == $val->ma_nv){
                        $nv_nhan = $val->ten_nv;
                        $phongnhan = $val->ten_phong;
                    }
                }
                
            @endphp
            <tr class="body-table" >
                <td>{{$count}}</td>
                <td><a href="{{route('bangiao.show',$item->ma_bangiao)}}">{{$item->ma_bangiao}}</a></td>
                <td>{{$nv_giao}}</td>
                <td>{{$phonggiao}}</td>
                <td>{{$nv_nhan}}</td>
                <td>{{$phongnhan}}</td>
                <td>{{date('m-d-Y', strtotime($item->ngay_nhan))}}</td>
                <td>{{$item->ghichu}}</td>
                <td>
                    <button onclick="location.href='/bangiao/phieu/{{$item->phieu}}'" style="width:40px; height:40px; margin-left: 10%; border:none; background-color: transparent;" title="In phiếu" ><i class='bx bx-file-blank' style="font-size: 30px; color:#3c97ff;"></i></button>
                </td>
            </tr>
            @php
                $count++;
            @endphp
        @endforeach
    </tbody>
</table>
<div style="display: flex;justify-content: flex-end">
    {{$bangiao->onEachSide(2)->links()}}
</div>