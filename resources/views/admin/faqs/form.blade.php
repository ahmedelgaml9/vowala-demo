<div class="row">
    <div class="input-field col s6">
        {!!Form::text('question', null,array('class'=>'validate','id'=>'question'))!!}
        <label for="question">Question</label>
    </div>
    <div class="input-field col s6">
        {!!Form::text('answer', null,array('class'=>'validate','id'=>'answer'))!!}
        <label for="answer">Answer</label>
    </div>
     <div class="input-field col s6">
        {!!Form::text('ar_question', null,array('class'=>'validate','id'=>'ar_question'))!!}
        <label for="question">Arabic Question</label>
    </div>
    <div class="input-field col s6">
        {!!Form::text('ar_answer', null,array('class'=>'validate','id'=>'ar_answer'))!!}
        <label for="answer">Arabic Answer</label>
    </div>
  
</div>

{!! Form::submit($submitButton, array('class'=>'btn btn-primary text-center','id' => 'submit')) !!}
