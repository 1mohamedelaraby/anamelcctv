<?php

namespace App\Http\Livewire;

use App\Testimonial as Testimonials;
use Livewire\Component;

class Testimonial extends Component
{
    public $testimonials;
    public $testimonial;
    public $testimonial_id;

    protected $updatesQueryString = ['testimonial_id'];

    public function mount()
    {
        $this->testimonials = Testimonials::all();
        $this->testimonial = $this->testimonials->first();
        $this->testimonial_id = @$this->testimonial->id;

        $this->testimonial_id = request()->query('testimonial_id', $this->testimonial_id);
        $this->testimonial = $this->testimonials->find($this->testimonial_id);
    }

    public function changeTestimonial($id)
    {
        $this->testimonial = $this->testimonials->where('id', $id)->first();
        $this->testimonial_id = $this->testimonial->id;
    }

    public function render()
    {
        return view('livewire.testimonial');
    }
}
