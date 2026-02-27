<?php

namespace App\Services;

use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MemberService
{
    /**
     * Create a new member and its associated user account.
     */
    public function createMemberWithUser(array $data): Member
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
                'parish_id' => $data['parish_id'] ?? null,
            ]);

            $member = Member::create([
                'user_id' => $user->id,
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'date_of_birth' => $data['date_of_birth'] ?? null,
                'gender' => $data['gender'] ?? null,
                'marital_status' => $data['marital_status'] ?? null,
                'baptism_date' => $data['baptism_date'] ?? null,
                'confirmation_date' => $data['confirmation_date'] ?? null,
                'home_congregation' => $data['home_congregation'] ?? null,
                'emergency_contact_name' => $data['emergency_contact_name'] ?? null,
                'emergency_contact_phone' => $data['emergency_contact_phone'] ?? null,
                'parish_id' => $data['parish_id'] ?? null,
                'is_active' => true,
                'joined_at' => now(),
            ]);

            // Membership number generation logic
            $member->membership_number = 'M' . str_pad($member->id, 5, '0', STR_PAD_LEFT);
            $member->save();

            return $member;
        });
    }

    /**
     * Update a member and its associated user account.
     */
    public function updateMember(Member $member, array $data): Member
    {
        return DB::transaction(function () use ($member, $data) {
            $member->update($data);

            if ($member->user) {
                $member->user->update([
                    'name' => $data['first_name'] . ' ' . $data['last_name'],
                    'email' => $data['email'],
                    'parish_id' => $data['parish_id'] ?? $member->user->parish_id,
                ]);
            }

            return $member;
        });
    }

    /**
     * Delete a member and its associated user account.
     */
    public function deleteMember(Member $member): void
    {
        DB::transaction(function () use ($member) {
            if ($member->user) {
                $member->user->delete();
            }
            $member->delete();
        });
    }
}
