<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Ministry;
use App\Models\MinistryMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MinistryService
{
    /**
     * Add a member to a ministry or update existing membership.
     */
    public function addMemberToMinistry(Member $member, Ministry $ministry, array $data): MinistryMember
    {
        return DB::transaction(function () use ($member, $ministry, $data) {
            $membership = MinistryMember::updateOrCreate(
                [
                    'ministry_id' => $ministry->id,
                    'member_id'   => $member->id,
                ],
                [
                    'role'      => $data['role'] ?? 'Member',
                    'joined_at' => $data['joined_at'] ?? now(),
                    'is_active' => true,
                ]
            );

            if (isset($data['notes'])) {
                $notes = is_array($data['notes']) ? json_encode($data['notes']) : $data['notes'];
                $membership->notes = $notes;
                $membership->save();
            }

            return $membership;
        });
    }

    /**
     * Process subscription from public form.
     */
    public function handleSubscription(Ministry $ministry, array $validated)
    {
        return DB::transaction(function () use ($ministry, $validated) {
            $member = Member::updateOrCreate(
                ['email' => $validated['email']],
                [
                    'first_name' => $validated['first_name'],
                    'last_name'  => $validated['last_name'],
                    'phone'      => $validated['phone'] ?? null,
                    'joined_at'  => now(),
                    'is_active'  => true,
                    'gender'     => $this->detectGender($ministry, $validated),
                ]
            );

            // Create membership with notes
            $membershipData = [
                'role'      => $validated['role'] ?? 'Member',
                'joined_at' => now(),
                'notes'     => $this->prepareMembershipNotes($ministry, $validated),
            ];

            return $this->addMemberToMinistry($member, $ministry, $membershipData);
        });
    }

    protected function detectGender(Ministry $ministry, array $validated): string
    {
        if ($ministry->slug === 'womens-ministry') {
            return 'Female';
        }
        if ($ministry->slug === 'mens-ministry') {
            return 'Male';
        }
        return 'Unknown';
    }

    protected function prepareMembershipNotes(Ministry $ministry, array $validated): array
    {
        $notes = ['joined_at' => now()->toDateTimeString()];

        // Common fields to exclude from notes if they're in $validated
        $exclude = ['first_name', 'last_name', 'email', 'phone', 'role', '_token'];

        foreach ($validated as $key => $value) {
            if (!in_array($key, $exclude) && !empty($value)) {
                $notes[$key] = $value;
            }
        }

        return $notes;
    }
}
