@component('components.modal')

@slot('id')
{{$id}}
@endslot


@slot('modal_body')
The score is calculated by the sum of the absolute value of difference between the chosen values by the user 
and the correct values, divided by the number of questions.
@endslot

@endcomponent

