@extends('home')
@section('chitiettaisan')
<div class="col-sm-12" style="min-height: 665px; background-color: white;">
    <div class="main_ward">
        <div class="main-name">
            <h3 class="main-text">Chi tiết tài sản</h3>
            <div >
                <button class="btn_cus btn-addsp" onclick="location.href='/chitiettaisan/create'" ><i class='bx bx-plus' style="font-weight: 600; "></i>Thêm chi tiết</button>
                <button class="btn_cus btn-addsp" style="background-color:#009900;"><i class='bx bx-export' style="font-weight: 600;"></i>Xuất excel</button>
                <button class="btn_cus btn-addsp" style="background-color:#FF3300;"><i class='bx bx-import' style="font-weight: 600;"></i>Nhập dữ liệu</button>
                <button class="btn_cus btn-addsp" style="background-color:#999999"><i class='bx bx-cog' style="font-weight: 600;"></i>Quản lý</button>
                <button class="btn_cus btn-addsp" style="background-color:#33CCFF"><i class='bx bxs-report' style="font-weight: 600;"></i>Báo Cáo</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="admin_search">
                    <div class="admin_search--input  col-md-5">
                        <input type="text" value="" class="search_input" id='search' placeholder="Nhập mã tài sản hoặc tên tài sản">
                    </div>
                    <div class="select_wrap">
                        <select class=" select select-loaisp form-control" id="loaisp" data-dropup-auto="false" title="Danh mục" data-size='5' data-live-search="true">
                            <option value="" selected>--Chọn loại tài sản--</option>
                            @foreach ($taisan as $item)
                                <option value="{{$item->ma_ts}}">{{$item->ten_ts}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="select_wrap">
                        <select class=" select select-nsx  form-control" id="nsx" data-dropup-auto="false" title="Nhà sản xuất" data-size='5' data-live-search="true">
                            <option value="" selected>--Chọn nhà cung cấp--</option>
                            @foreach ($nhacungcap as $item)
                                <option value="{{$item->ma_ncc}}">{{$item->ten_ncc}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 ">
                <table class="table table_sp ">
                    <thead class="heading-table">
                        <tr>
                            <th style="border-left: 1px solid rgba(0,0,0,.1); width:10px;">STT</th>
                            <th >Mã tài sản</th>
                            <th >Tên tài sản</th>
                            <th >Loại tài sản</th>
                            <th >Số serial</th>
                            <th >Nguyên giá</th>
                            <th>Số lượng</th>
                            <th>Tiêu hao</th>
                            <th >Nhà cung cấp</th>
                            <th >Ngày mua</th>
                            <th >Năm sản xuất</th>
                            <th >Nước Sản Xuất</th>
                            <th style="width: 80px;border-right: none;">Phòng ban</th>
                        </tr>
                    </thead>
                    <tbody id="list_product">
                        @foreach ($chitiettaisan as $key => $item)
                            <tr class="body-table">
                                <td>{{$key+1}}</td>
                                <td>{{$item->id_chitiet}}</td>
                                <td>{{$item->ten_chitiet}}</td>
                                <td>{{$item->ten_ts}}</td>
                                <td>{{$item->so_serial}}</td>
                                <td>{{$item->nguyen_gia.'đ'}}</td>
                                <td>{{$item->soluong}}</td>
                                <td>{{$item->muc_tieuhao}}</td>
                                <td>{{$item->ten_ncc}}</td>
                                <td>{{$item->ngay_mua}}</td>
                                <td>{{$item->nam_san_xuat}}</td>
                                <td>{{$item->nuoc_san_xuat}}</td>
                                <td style="width: 150px">{{$item->ten_phong}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
