<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LogsImport;

class LogController extends Controller
{
    // view the index page
    public function viewLogs()
    {
        $logs = Log::all();
        return view('logs', ['logs' => $logs]);
    }

    // insert or create function
    public function insertLog(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $newLog = Log::create($data);
        return redirect(route('log'))->with('success', 'Log Created Successfully');
    }

    //view  edit page
    public function editLog(Log $log)
    {
        return view('edit', ['log' => $log]);
    }

    // update function
    public function updatelog(Log $log, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $log->update($data);
        return redirect(route('log'))->with('success', 'Log Updated Successfully');
    }

    // delete function
    public function trashLog(Log $log)
    {
        $log->delete();
        return redirect(route('log'))->with('deleted', 'Log Deleted Successfully. <a href="' . route('restoreLog', $log->id) . '">Undo</a>');
    }

    // restore function
    public function restoreLog($logId)
    {
        $log = Log::withTrashed()->find($logId);

        if ($log && $log->trashed()) {
            $log->restore();
            return redirect(route('log'))->with('success', 'Log Successfully Restored');
        }
    }

    // export excel function
    public function importLog(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);
        Excel::import(new logsImport, request()->file('file'));
        return back()->with('success', 'Contacts imported successfully.');
    }
}
