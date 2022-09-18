<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Testimonio;

class Testimonios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $testimonio;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.testimonios.view', [
            'testimonios' => Testimonio::latest()
						->orWhere('nombre', 'LIKE', $keyWord)
						->orWhere('testimonio', 'LIKE', $keyWord)
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
		$this->nombre = null;
		$this->testimonio = null;
    }

    public function store()
    {
        $this->validate([
		'nombre' => 'required',
		'testimonio' => 'required',
        ]);

        Testimonio::create([ 
			'nombre' => $this-> nombre,
			'testimonio' => $this-> testimonio
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Testimonio Successfully created.');
    }

    public function edit($id)
    {
        $record = Testimonio::findOrFail($id);

        $this->selected_id = $id; 
		$this->nombre = $record-> nombre;
		$this->testimonio = $record-> testimonio;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'nombre' => 'required',
		'testimonio' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Testimonio::find($this->selected_id);
            $record->update([ 
			'nombre' => $this-> nombre,
			'testimonio' => $this-> testimonio
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Testimonio Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Testimonio::where('id', $id);
            $record->delete();
        }
    }
}
