<?php

namespace common\components;

class SBHelpers
{
    /**
     * Get Tanggal return formatted date in bahasa
     * @param string $date
     * @return string
     */
    public static function getTanggal($date)
    {
        $month = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $dates = explode('-', date('Y-m-d', strtotime($date)));

        return $dates[2] . ' ' . $month[(int) $dates[1]] . ' ' . $dates[0];
    }
}
