<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlockedIp;
class IPBlockController extends Controller
{
    
  public function index(){
      $AllIp = BlockedIp::all();
        return view('admin.reports.ipblock.ipblock', compact('AllIp'));
 
    }

    public function IPBlockSubmit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'ip_address' => 'required|ip',
            'reason' => 'required|string',
        ]);

        $ipAddress = $request->input('ip_address');
        $reason = $request->input('reason');

        // Check if the IP address is already blocked
        if (BlockedIp::where('ip_address', $ipAddress)->exists()) {
            return redirect()->back()->with('error', 'IP address is already blocked.');
        }

        // Block the IP address
        BlockedIp::create([
            'ip_address' => $ipAddress,
            'reason' => $reason,
        ]);

        return redirect()->back()->with('success', 'IP address blocked successfully.');
    }
  
  	public function delete($id)
    {
        // Find the blocked IP by ID
        $blockedIp = BlockedIp::find($id);

        if ($blockedIp) {
            $blockedIp->delete();
            return redirect()->route('admin.ipblock')->with('success', 'IP address has been unblocked successfully.');
        } else {
            return redirect()->route('admin.ipblock')->with('error', 'IP address not found in blocked list.');
        }
    }	
  
  public function edit($id)
{
    $ipBlock = BlockedIp::findOrFail($id);
    return view('backend.reports.ipblock.edit', compact('ipBlock'));
}


 public function update(Request $request, $id)
{
    $ipBlock = BlockedIp::findOrFail($id);
    
    $data = $request->validate([
        'ip_address' => 'required|ip',
        'reason' => 'required',
    ]);
    
    $ipBlock->update($data);
    
    return redirect()->route('admin.ipblock')->with('success', 'IP Block updated successfully.');
}
  
}
