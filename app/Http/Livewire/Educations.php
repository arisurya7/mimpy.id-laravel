<?php

namespace App\Http\Livewire;

use App\Models\Education;
use Livewire\Component;

class Educations extends Component
{
    public $name;
    public $statusUpdate = false;
    
    protected $listeners = [
        'educationStored' => 'handleStored',
        'educationUpdated' => 'handleUpdated'
    ];
    
    public function render()
    {
        return view('livewire.educations', [
            'educations' => Education::orderBy('id', 'DESC')->get()
        ]);
    }

    public function getEducation($id){
        $this->statusUpdate = true;
        $education = Education::find($id);
        $this->emit('getEducation', $education);
    }

    public function destroy($id){
        if($id){
            $data = Education::find($id);
            $data->delete();
            session()->flash('message', 'education has been deleted!');
        }
    }

    public function handleStored($education){
        session()->flash('message', 'New education has been added!');
    }

    public function handleUpdated($education){
        session()->flash('message', 'Education has been updated!');
    }
}
