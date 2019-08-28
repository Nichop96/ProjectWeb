@component('components.modal')

@slot('id')
{{$id}}
@endslot


@slot('modal_body')
{{__('indexes.score_modal')}}
@endslot

@endcomponent

