<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Parish;
use App\Http\Requests\Admin\MemberRequest;
use App\Services\MemberService;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index()
    {
        $members = Member::with(['user:id,name,email', 'parish:id,name'])
            ->latest()
            ->paginate(15);
            
        $stats = [
            'total_members' => Member::count(),
            'active_members' => Member::where('is_active', true)->count(),
            'new_this_month' => Member::whereMonth('created_at', now()->month)->count(),
        ];
        
        return view('admin.members.index', compact('members', 'stats'));
    }

    public function create()
    {
        $parishes = Parish::active()->get();
        return view('admin.members.create', compact('parishes'));
    }

    public function store(MemberRequest $request)
    {
        $member = $this->memberService->createMemberWithUser($request->validated());

        if (class_exists('App\Models\Activity')) {
            \App\Models\Activity::log('member_added', "New member {$member->first_name} {$member->last_name} was added", $member);
        }

        return redirect()->route('admin.members.show', $member->id)
            ->with('success', "Member {$member->first_name} {$member->last_name} was created successfully!");
    }

    public function show(Member $member)
    {
        $member->load(['user', 'parish']);
        return view('admin.members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $member->load(['user', 'parish']);
        $parishes = Parish::active()->get();
        return view('admin.members.edit', compact('member', 'parishes'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        $this->memberService->updateMember($member, $request->validated());
        
        return redirect()->route('admin.members.show', $member->id)
            ->with('success', 'Member updated successfully!');
    }

    public function destroy(Member $member)
    {
        $this->memberService->deleteMember($member);
        
        return redirect()->route('admin.members.index')
            ->with('success', 'Member deleted successfully!');
    }
}