<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\HistoryTransaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $dataTransaction = HistoryTransaction::where('user_id', Auth::user()->id)->latest()->take(10)->get();
        return view('dashboard', compact('dataTransaction'));
    }
    public function fetchNotifications()
    {
        $data = HistoryTransaction::where('user_id', Auth::user()->id)->latest()->take(10)->get();
        return response()->json($data);
    }
}
