<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MinistrySubscribeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $ministry = $this->route('ministry');
        $slug = $ministry ? $ministry->slug : null;

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:20',
            'role'       => 'nullable|string|max:50',
            'interests'  => 'nullable|array',
            'interests.*'=> 'string|max:100',
            'message'    => 'nullable|string|max:1000',
        ];

        switch ($slug) {
            case 'womens-ministry':
                $rules['life_stage'] = 'required|string|in:Young Adult (18-30),Mother & Family (31-50),Seasoned & Senior (51+)';
                break;
            case 'worship-and-liturgy-ministry':
                $rules['voice_instrument'] = 'required|string|in:soprano,alto,tenor,bass,piano,guitar,drums,bass_guitar,other_instrument';
                $rules['choir_group'] = 'required|string|in:adult_choir,youth_choir,praise_band,children_choir';
                $rules['experience'] = 'nullable|string|max:1000';
                break;
            case 'childrens-ministry':
            case 'mens-ministry':
            case 'youth-ministry':
                $rules['age_group'] = 'required|string';
                if ($slug === 'mens-ministry') {
                    $rules['marital_status'] = 'nullable|string|in:Single,Married,Divorced,Widowed';
                    $rules['occupation'] = 'nullable|string|max:100';
                }
                break;
            case 'evangelism-and-tree-planting-ministry':
                $rules['experience_level'] = 'required|string|in:Beginner,Some Experience,Experienced,Leader';
                break;
            case 'hiv-and-aids-ministry':
                $rules['phone'] = 'required|string|max:20';
                $rules['participation_type'] = 'required|string|in:Volunteer,Supporter,Advocate,Educator,Donor';
                $rules['confidentiality'] = 'required|accepted';
                break;
            case 'elck-malaria-campaign':
                $rules['involvement_type'] = 'required|string|in:Volunteer,Health Worker,Educator,Donor,Advocate,Coordinator';
                $rules['availability'] = 'nullable|string|max:50';
                break;
            case 'relief-and-development-ministry':
                $rules['phone'] = 'required|string|max:20';
                $rules['area_of_focus'] = 'required|string|in:Emergency Relief,Food Security,WASH,Livelihoods,Health,All Areas';
                $rules['availability'] = 'required|string|in:Emergency Only,Regular,Seasonal,On-call';
                $rules['experience'] = 'nullable|string|max:50';
                break;
            case 'clergy-and-lay-leader-training':
                $rules['phone'] = 'required|string|max:20';
                $rules['program'] = 'required|string|in:Diploma in Theology (DTh),Certificate in Evangelistic Training (CET),Continuing Education,Undecided';
                $rules['education'] = 'required|string|in:High School,Certificate,Diploma,Bachelor\'s Degree,Master\'s Degree,Other';
                $rules['denomination'] = 'required|string|max:100';
                $rules['calling_testimony'] = 'required|string|min:100|max:2000';
                $rules['financial_assistance'] = 'required|string|in:Yes,No,Undecided';
                break;
        }

        return $rules;
    }
}
