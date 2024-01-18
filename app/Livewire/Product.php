<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Product extends Component
{
    use WithFileUploads;
    public $fileTitle, $fileName;

    protected $rules = [
        'fileTitle' => 'required',
        'fileName' => 'required|mimes:jpg,jpeg,png,svg,gif|max:2048',
    ];


    public function submit()
    {
        $dataValid = $this->validate();

        try {
            $dataValid['fileName'] = $this->fileName->store('products', 'public');
            Product::create($dataValid);
            session()->flash('message', 'File Uploaded');
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    public function render()
    {
        return view('livewire.product');
    }
}
