<?php

if (!function_exists('menuUrl')){
    /**
     * Generate Menu URL
     *
     * @param $data
     * @param $related
     * @return string
     */
    function menuUrl($data, $related = ''){
        if($data->menu_type == 'S')
            return url($data->menu_type_param);
        else if($data->menu_type == 'PA' && !is_null($related))
            return url($related->alias);
        else if($data->menu_type == 'PO' && !is_null($related))
            return url('category/'.$related->alias);
        else if($data->menu_type == 'GA' && !is_null($related))
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

if (!function_exists('userStatusTextWithStyle')){
    /**
     * Change user status code to text with bootstrap style
     *
     * @param $status
     * @return string
     */
    function userStatusTextWithStyle($status){
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

if (!function_exists('userStatusText')){
    /**
     * Change user status code without style
     *
     * @param $status
     * @return string
     */
    function userStatusText($status){
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

if (!function_exists('humanFileSize')){
	function humanFileSize($size, $unit="") {
		if( (!$unit && $size >= 1<<30) || $unit == "GB")
			return number_format($size/(1<<30),2)." GB";
		if( (!$unit && $size >= 1<<20) || $unit == "MB")
			return number_format($size/(1<<20),2)." MB";
		if( (!$unit && $size >= 1<<10) || $unit == "KB")
			return number_format($size/(1<<10),2)." KB";
		return number_format($size)." bytes";
	}
}