@component('components.modal')

@slot('id')
{{$id}}
@endslot


@slot('modal_body')
The score is calculated by the sum of the difference between the values chosen by the user 
and the correct values, divided by the number of questions.
@endslot

@endcomponent

