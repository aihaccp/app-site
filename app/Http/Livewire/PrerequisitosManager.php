<?php

namespace App\Http\Livewire;

use App\Models\FolderPrerequisito;
use Livewire\Component;
use Illuminate\Support\Str;

class PrerequisitosManager extends Component
{
    public $name, $slug, $icon;
    public $disabled = 1;

    public function mount()
    {
        $this->disabled = 1;
    }
    public function render()
    {
        $folders = FolderPrerequisito::all();
        return view('livewire.prerequisitos-manager', [
            'folders' => $folders
        ]);
    }

    public function addFolder()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:150',
            'disabled' => 'required',
        ]);

        $slug = Str::lower(Str::slug($this->name, '-'));

        FolderPrerequisito::create([
            'name' => $this->name,
            'slug' => $slug,
            'icon' => $this->icon,
            'disabled' => $this->disabled
        ]);

        // Clear input fields after creation
        $this->name = '';
        $this->icon = '';
        $this->disabled = '';
    }

}
