<div>
@if (count($userList) > 0)
    <p>The list of users registered today are given below:</p>
@foreach($userList as $user)
{{$user->name}} <br/>
@endforeach
@else
    No user is registered today yet.
@endif
</div>