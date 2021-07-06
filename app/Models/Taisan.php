<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Taisan extends Model
{
    // protected $fillable =[
    //     'ma_ts',
    //     'ten_ts',
    //     'soluong',
    //     'ma_loai',
    // ];
    public $table ="taisan";
    
    
    public function table_join(){
        $temp_sl = DB::table($this->table)
                ->select('taisan.ma_ts',DB::raw('count(chitiettaisan.ma_ts) as soluong'))
                ->join('chitiettaisan','taisan.ma_ts','=','chitiettaisan.ma_ts')
                ->groupBy('taisan.ma_ts');
        $data = DB::table($this->table)
            ->select('taisan.*','soluong','nhacungcap.ten_ncc','loaitaisancodinh.ten_loai','tieuhaotaisan.muc_tieuhao','tieuhaotaisan.thoi_gian_sd')
            ->join('loaitaisancodinh','taisan.ma_loai','=','loaitaisancodinh.ma_loai')
            ->join('nhacungcap','taisan.ma_ncc','=','nhacungcap.ma_ncc')
            ->join('tieuhaotaisan','tieuhaotaisan.ma_loai','=','taisan.ma_loai')
            ->joinSub($temp_sl,'temp_sl',function($join){
                $join->on('taisan.ma_ts','=','temp_sl.ma_ts');
            });
        return $data;
    }

    public function select($dieukien='',$all=''){
       
        $data =$this->table_join();
        if($dieukien !=''){
            $data =$data->where('taisan.ma_loai','=',''.$dieukien.'');
        }
        if($all !=''){
            $data = $data->get();
        }else{
            $data= $data->paginate(8);
        }   
         
        return $data;
    }

    public function max_id($col,$str){
        $kq = DB::table($this->table)->selectRaw("max($col) as ma_ts")
                                    ->where("ma_ts","like",'%' . $str . '%')
                                    ->first();
        return $kq;
    }

    public function insert($ma_ts,$ten_ts,$ma_loai,$nguyen_gia,$ma_ncc,$ngay_mua,$nam_sx,$nuoc_sx,$ngay_sd,$ngay_ghitang){
        $kq = DB::table($this->table)->insert([
            'ma_ts'=>$ma_ts,
            'ten_ts' =>$ten_ts,
            'nguyengia'=>$nguyen_gia,
            'ma_ncc'=> $ma_ncc,
            'ngay_mua' =>$ngay_mua,
            'nam_sx'=>$nam_sx,
            'nuoc_sx'=>$nuoc_sx,
            'ma_loai' =>$ma_loai,
            'ngay_sd' =>$ngay_sd,
            'ngay_ghi_tang' =>$ngay_ghitang,
        ]);
        return $kq;
    }

    public function search_taisan( $text,$selected,$ma_phong){
        $kq = $this->table_join()
        ->join('chitiettaisan','chitiettaisan.ma_ts','=','taisan.ma_ts')
        ->join('phongban','phongban.ma_phong','=','chitiettaisan.ma_phong');
        if($text !=''){
            $kq = $kq->where(function($res) use($text){
                    $res->where('taisan.ten_ts','like','%'.$text.'%')
                        ->orwhere('taisan.ma_ts','like','%'.$text.'%');
            });
        }
        if($selected !=''){
            $kq = $kq->where('loaitaisancodinh.ma_loai',$selected);
        }
        if($ma_phong !=''){
            $kq = $kq->where('phongban.ma_phong',$ma_phong);
        }
        $kq =$kq->distinct()->paginate(8);
        return $kq;
    }

    public function show_ts($ma_ts){
        $table = $this->table_join()
            ->where('taisan.ma_ts','=',''.$ma_ts.'')
            ->first();
        return $table;
    }

    public function update_ts($ma_ts,$ten_ts,$ma_loai,$nguyen_gia,$ma_ncc,$ngay_mua,$nam_sx,$nuoc_sx,$ngay_sd,$ngay_ghitang){
        $kq = DB::table($this->table)
                ->where('ma_ts','=',''.$ma_ts.'')
                ->update([
                    'ten_ts' =>$ten_ts,
                    'nguyengia'=>$nguyen_gia,
                    'ma_ncc'=> $ma_ncc,
                    'ngay_mua' =>$ngay_mua,
                    'nam_sx'=>$nam_sx,
                    'nuoc_sx'=>$nuoc_sx,
                    'ma_loai' =>$ma_loai,
                    'ngay_sd' =>$ngay_sd,
                    'ngay_ghi_tang' =>$ngay_ghitang,
                ]);
        return $kq;
    }

    public function tsOfphong($ma_phong){
        $data = $this->table_join()->where('taisan.ma_phong','=',''.$ma_phong.'')->get();
        return $data;
    }
    
    

    public function phong_taisan(){
        $data =DB::table($this->table)
        ->join('chitiettaisan','taisan.ma_ts','=','chitiettaisan.ma_ts')
        ->join('phongban','phongban.ma_phong','=','chitiettaisan.ma_phong')
        ->select('taisan.ma_ts','phongban.ten_phong')
        ->distinct()
        ->get();
        return $data;
    }

    public function export_tsOfphong($ma_phong){
        $temp_sl = DB::table($this->table)
        ->select('taisan.ma_ts',DB::raw('count(chitiettaisan.ma_ts) as soluong'))
        ->join('chitiettaisan','taisan.ma_ts','=','chitiettaisan.ma_ts')
        ->join('phongban','phongban.ma_phong','=','chitiettaisan.ma_phong')
        ->where('phongban.ma_phong',$ma_phong)
        ->groupBy('taisan.ma_ts');
        $data = DB::table($this->table)
            ->select('taisan.*','soluong','nhacungcap.ten_ncc','loaitaisancodinh.ten_loai','tieuhaotaisan.muc_tieuhao','tieuhaotaisan.thoi_gian_sd','phongban.ten_phong')
            ->join('loaitaisancodinh','taisan.ma_loai','=','loaitaisancodinh.ma_loai')
            ->join('nhacungcap','taisan.ma_ncc','=','nhacungcap.ma_ncc')
            ->join('tieuhaotaisan','tieuhaotaisan.ma_loai','=','taisan.ma_loai')
            ->join('chitiettaisan','chitiettaisan.ma_ts','=','taisan.ma_ts')
            ->join('phongban','phongban.ma_phong','=','chitiettaisan.ma_phong')
            ->joinSub($temp_sl,'temp_sl',function($join){
                $join->on('taisan.ma_ts','=','temp_sl.ma_ts');
            })->where('phongban.ma_phong',$ma_phong)->distinct()->get();
        return $data;
    }
}
