<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\Api\User\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admins = Admin::with(['key.user','photo'])
            ->when($request->has('username'), function ($query) use ($request) {
            $query->where('username', 'like', '%' . $request->username . '%');
            })
            ->when(auth()->check(), function ($query) {
            $query->where('id', '!=', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        return response()->json($admins);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'last' => 'required|string|max:255',
            'is_super' => 'nullable|in:no,yes',
        ]);
        $validated['username'] = $validated['name'] . '' . $validated['last'] . '' . str()->random(5);
        $admin = Admin::create($validated);
        return response()->json($admin->load(['key.user']), 201);
    }



    public function show(Admin $admin)
    {
        return response()->json([
            'message' => 'Admin fetched successfully',
            'admin' => $admin->load('key.user','photo')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'last' => 'sometimes|required|string',
            'is_super' => 'sometimes|nullable|in:no,yes',
        ]);
        $validated['username'] = $validated['name'] . '_' . $validated['last'] . '_' . str()->random(6);
        $admin->update($validated);
        return response()->json([
            'message' => 'Admin updated successfully',
            'admin' => $admin->load('key.user')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->photo()->delete();
        $admin->key()->delete();
        $admin->delete();
        return response()->json([
            'message' => 'Admin deleted successfully'
        ], 200);
    }
}
