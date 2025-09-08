<?php

namespace App\Services;

use App\Models\FlashSale;
use App\Models\BookFlashSale;

class FlashSaleService
{
    public function getFlashSale() {
        return FlashSale::with('books')->published()->latest()->first();
    }

}
