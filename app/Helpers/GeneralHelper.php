<?php

if (!function_exists('menuUrl')){
    /**
     * Generate Menu URL
     *
     * @param $data
     * @param array $related
     * @return string
     */
    function menuUrl($data, $related = array()){
        if($data->menu_type == 'S')
            return url($data->menu_type_param);
        else if($data->menu_type == 'PA' && count($related) > 0)
            return url($related->alias);
        else if($data->menu_type == 'PO' && count($related) > 0)
            return url('category/'.$related->alias);
        else if($data->menu_type == 'GA' && count($related) > 0)
            return url('gallery/'.$related->alias);
        else
            return $data->menu_type_param;
    }
}

if (!function_exists('menuTypeText')){
    /**
     * Change status code to text
     *
     * @param $status
     * @return string
     */
    function menuTypeText($status){
        $status = strtoupper($status);

        switch ($status) {
            case 'URL':
                return 'Hyperlink';
                break;
            case 'PA':
                return 'Halaman';
                break;
            case 'PO':
                return 'Artikel';
                break;
            case 'S':
                return 'Spesial';
                break;
            default:
                return 'Tidak diketahui';
        }
    }
}

if (!function_exists('accountStatusTextWithStyle')){
    /**
     * Change account status code to text with bootstrap style
     *
     * @param $status
     * @return string
     */
    function accountStatusTextWithStyle($status){
        $status = strtoupper($status);

        switch ($status) {
            case 'Y':
                return '<span class="label label-success">Aktif</span>';
                break;
            case 'N':
                return '<span class="label label-danger">Tidak Aktif</span>';
                break;
            case 'WE':
                return '<span class="label label-warning">Menunggu Konfirmasi Email</span>';
                break;
            default:
                return '<span class="label label-default">Tidak diketahui</span>';
        }
    }
}

if (!function_exists('accountStatusText')){
    /**
     * Change account status code without style
     *
     * @param $status
     * @return string
     */
    function accountStatusText($status){
        $status = strtoupper($status);

        switch ($status) {
            case 'Y':
                return 'Aktif';
                break;
            case 'N':
                return 'Tidak Aktif';
                break;
            case 'WE':
                return 'Menunggu Konfirmasi Email';
                break;
            default:
                return 'Tidak diketahui';
        }
    }
}