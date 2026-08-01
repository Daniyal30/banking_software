<?php

namespace App\Http\Controllers;

use App\Models\Lender;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        try {
            $lendersCount = Lender::count();
            return view('admin.dashboard', compact('lendersCount'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error Occur')->withInput();
        }
    }
}
