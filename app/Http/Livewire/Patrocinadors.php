<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Patrocinador;

class Patrocinadors extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $logo, $enlace;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.patrocinadors.view', [
            'patrocinadors' => Patrocinador::latest()
						->orWhere('logo', 'LIKE', $keyWord)
						->orWhere('enlace', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->logo = null;
		$this->enlace = null;
    }

    public function store()
    {
        $this->validate([
		'logo' => 'required',
		'enlace' => 'required',
        ]);

        Patrocinador::create([ 
			'logo' => $this-> logo,
			'enlace' => $this-> enlace
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Patrocinador Successfully created.');
    }

    public function edit($id)
    {
        $record = Patrocinador::findOrFail($id);

        $this->selected_id = $id; 
		$this->logo = $record-> logo;
		$this->enlace = $record-> enlace;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'logo' => 'required',
		'enlace' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Patrocinador::find($this->selected_id);
            $record->update([ 
			'logo' => $this-> logo,
			'enlace' => $this-> enlace
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Patrocinador Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Patrocinador::where('id', $id);
            $record->delete();
        }
    }
}
