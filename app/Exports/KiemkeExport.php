<?php

namespace App\Exports;

use App\Models\Phongban;
use App\Models\Taisan;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Excel;
Use \Maatwebsite\Excel\Sheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KiemkeExport implements FromView,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function __construct($taisan,$kiemke,$ngay,$chitiet,$phong)
    {
        $this->taisan = $taisan;
        $this->kiemke = $kiemke;
        $this->ngay = $ngay;
        $this->chitiet = $chitiet;
        $this->phong =$phong;
    }
    
    public function view(): View
    {
        return view('kiemke.baocao_kiemke', [
            'taisan' => $this->taisan,
            'kiemke' =>$this->kiemke,
            'ngay' =>$this->ngay,
            'chitiet'=>$this->chitiet,
            'phong' =>$this->phong
        ]);
    }
    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('A1:N1')->getFont()->setBold(true);
        // $sheet->getStyle('A1:N1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM);
    }
    // public function registerEvents(): array
    // {
    //     Sheet::macro('styleCells', function (Sheet $sheet, string $cellRange, array $style) {
    //         $sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style);
    //     });
    //   return [
        
    //      BeforeExport::class => function(BeforeExport $event){
    //         $event->writer->reopen(new \Maatwebsite\Excel\Files\LocalTemporaryFile('phieukiemke/kiemke.xlsx'),Excel::XLSX);
    //         $styleArray = array(
    //             'borders' => array(
    //                 'outline' => array(
    //                     'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
    //                     'color' => array('argb' => 'FFFF0000'),
    //                 ),
    //             ),
    //         );
    //         $event->writer->getSheetByIndex(0);
    //         $event->getWriter()->getSheetByIndex(0)->setCellValue('A8',"Thời điểm kiểm kê: ".Carbon::create($this->ngay)->format('d-m-Y'));
    //         $b =10;
    //         foreach($this->kiemke as $item){
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('B'.$b,$item->ten_nv);
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('C'.$b,"Chức vụ: ".$item->ten_chucvu);
    //             $b++;
    //         }
    //         $i=17;
    //         $n =1;
    //         foreach($this->taisan as $val){
    //             foreach($this->chitiet as $item){
    //                 if($item->ma_ts == $val->ma_ts){
    //                     $soluong = $item->soluong;
    //                 }
    //             }
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('A'.$i,$n);
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('B'.$i,$val->ten_ts);
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('C'.$i,$val->ten_phong);
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('D'.$i,$val->soluong);
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('E'.$i,$val->nguyengia);
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('F'.$i,$soluong);
    //             $event->getWriter()->getSheetByIndex(0)->setCellValue('G'.$i,$val->nguyengia);
                
    //             $event->writer->getActiveSheet(0)->getStyle('A'.$i.':H'.$i)->applyFromArray($styleArray);
    //             $i++;
    //             $n++;
    //         }
            
    //         $event->getWriter()->getSheetByIndex(0)->setCellValue('B'.($i+2),'Thủ trưởng đơn vị (Ký, họ tên, đóng dấu)');
    //         $event->getWriter()->getSheetByIndex(0)->setCellValue('C'.($i+2),'Các tổ  viên (Ký, họ tên)');
    //         $event->getWriter()->getSheetByIndex(0)->setCellValue('E'.($i+2),'Tổ trưởng (Ký, họ tên)');
    //      },
        
         
    //   ];
    // }
}
