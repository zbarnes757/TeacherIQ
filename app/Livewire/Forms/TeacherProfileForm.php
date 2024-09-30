<?php

namespace App\Livewire\Forms;

use App\Models\TeacherProfile;
use Livewire\Form;

class TeacherProfileForm extends Form
{
    public ?TeacherProfile $profile;

    public $bio = '';

    public $can_be_remote = false;

    public $grades = [];

    public $subjects = [];

    public function setProfile(TeacherProfile $profile): void
    {
        $this->profile = $profile;
        $this->bio = $profile->bio;
        $this->can_be_remote = $profile->can_be_remote;
        $this->grades = $profile->grades->pluck('id')->toArray();
        $this->subjects = $profile->subjects->pluck('id')->toArray();
    }

    public function store(): void
    {
        $this->profile->update($this->only(['bio', 'can_be_remote']));

        $this->profile->grades()->sync($this->grades);
        $this->profile->subjects()->sync($this->subjects);
    }
}
