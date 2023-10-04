@include('admin.super_admin.partials.head')
@include('admin.super_admin.partials.sidemenu')
<div class="mainwrapper">
<div class="mainwrapper-inner-container">
<div class="container-fluid">
<div class="row clearfix">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h3>View Note</h3>
</div>
<div class="card-body">
<p class="text-center">{!!$note->notes!!}</p><br><br>

    <form method ="POST" action="{{route('note_reply')}}" enctype="multipart/form-data" name="registration">
        @csrf
        <div class="row clearfix">
        <div class="col-md-6">
        <div class="form-group">
            <input type="hidden" class="form-control" name="note_id" value="{{$note->id}}">
            <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->id}}">
        </div>
        <div class="form-group">
            <textarea name="note_reply" id="ckeditor_1" class="form-control" placeholder="Type a message..." rows="6" cols="50"></textarea>
        </div>
        </div>
        <script>CKEDITOR.replace("ckeditor_1"); </script>
        </div>
        <button type="submit" class="btn btn-primary">Reply</button>       
    </form><br><br><br>

    <div class="row">
    @foreach($note_reply as $replynote)
        <div class="col-md-12">
            <div class="m-note note-abt">
                <p class="nt_date"><strong>{{$replynote->user->first_name}}{{$replynote->user->last_name}}</strong></p>
                <p>{!!$replynote->note_reply!!}</p>
                <p class="text-right"><strong class="note_date">{{$replynote->date}}</strong></p>
            </div>
        </div>
    @endforeach
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

@include('admin.super_admin.partials.footer')