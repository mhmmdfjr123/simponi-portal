<?php

if (!function_exists('pageStatusText')){
    /**
     * Change status code to text
     *
     * @param $status
     * @return string
     */
    function pageStatusText($status){
        $status = strtoupper($status);

        switch ($status) {
            case 'P':
                return 'Publish';
                break;
            case 'D':
                return 'Draft';
                break;
            default:
                return 'Tidak diketahui';
        }
    }
}

if (!function_exists('pageStatusTextWithStyle')){

    /**
     * Change status code to text with bootstrap style
     *
     * @param string $status
     * @param string $start
     * @param string $end
     * @return string
     */
    function pageStatusTextWithStyle($status, $start = '', $end = ''){
        $status = strtoupper($status);

        if($status == 'D'){
            return '<span class="label label-default">Draft</span>';
        }else if($status == 'P'){
            if($start != '' && $start > \Carbon\Carbon::now())
                return '<span class="label label-warning">Belum Dipublish</span>';
            else if($end != '' && $end < \Carbon\Carbon::now())
                return '<span class="label label-info">Telah Dipublish</span>';
            else
                return '<span class="label label-success">Publish</span>';
        }else{
            return '<span class="label label-danger">Tidak diketahui</span>';
        }
    }
}

if (!function_exists('postCategoryStatusTextWithStyle')){

    /**
     * Post Category Status with style
     *
     * @param $status
     * @return string
     */
    function postCategoryStatusTextWithStyle($status){
        $status = strtoupper($status);

        switch ($status) {
            case 'Y':
                return '<span class="label label-success">Aktif</span>';
                break;
            case 'N':
                return '<span class="label label-default">Tidak Aktif</span>';
                break;
            default:
                return '<span class="label label-danger">Tidak diketahui</span>';
        }
    }
}