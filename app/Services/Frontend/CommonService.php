<?php

namespace App\Services\Frontend;

use Carbon\Carbon;

class CommonService
{

    /**
     * Get log work
     *
     * @param string|null $time Time
     *
     * @return array
     */
    public function validateYearMonth($time)
    {
        $data = explode('-', $time);

        if (count($data) == 2 && $data[0] >= 1 && $data[0] <= 12 && $data[1] >= 2019 && $data[1] <= 2090) {
            return [
                'year' => (int)$data[1],
                'month' => (int)$data[0]
            ];
        }

        return [
            'year' => Carbon::today()->year,
            'month' => Carbon::today()->month
        ];
    }

    /**
     * Get day of month
     *
     * @param array $time Time
     *
     * @return array
     */
    public function getDayOfMonth(array $time)
    {
        $date = Carbon::create($time['year'], $time['month'], 1);
        $start = $date->startOfMonth()->day;
        $end = $date->endOfMonth()->day;

        for ($i = $start; $i <= $end; $i++) {
            $data[] = $i;
        }

        return $data;
    }
}
