<?php

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

function fEn2Bn($BDDate)
{
    /*Convert a English date to Bangla date*/
    $en = array("AM", "PM", "am", "pm", "Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $bn = array("এএম", "পিএম", "এএম", "পিএম", "শনিবার", "রোববার", "সোমবার", "মঙ্গলবার", "বুধবার", "বৃহস্পতিবার", "শুক্রবার", "শনি", "রোব", "সোম", "মঙ্গল", "বুধ", "বৃহস্পতি", "শুক্র", "জানুয়ারি", "ফেব্রুয়ারি", "মার্চ", "এপ্রিল", "মে", "জুন", "জুলাই", "আগস্ট", "সেপ্টেম্বর", "অক্টোবর", "নভেম্বর", "ডিসেম্বর", "০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯");
    $BDDate = str_replace($en, $bn, $BDDate);
    return $BDDate;
}

function adminUser()
{
    return Auth::guard('admin')->user();
}

function pendingOrderCount()
{
    return Order::where('order_status', 1)->count();
}