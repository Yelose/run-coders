<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Banner;

class Banners extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $imagen;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.banners.view', [
            'banners' => Banner::latest()
						->orWhere('imagen', 'LIKE', $keyWord)
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
		$this->imagen = null;
    }

    public function store()
    {
        $this->validate([
		'imagen' => 'required',
        ]);

        Banner::create([ 
			'imagen' => $this-> imagen
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Banner Successfully created.');
    }

    public function edit($id)
    {
        $record = Banner::findOrFail($id);

        $this->selected_id = $id; 
		$this->imagen = $record-> imagen;
		
        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'imagen' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Banner::find($this->selected_id);
            $record->update([ 
			'imagen' => $this-> imagen
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Banner Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Banner::where('id', $id);
            $record->delete();
        }
    }
}
