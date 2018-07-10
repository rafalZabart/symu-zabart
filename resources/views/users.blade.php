@include('header')
<div id="page">
    <h1>Witaj Świecie!</h1>
    
    @foreach ($users as $user) 
        {{ $user->id }}  {{ $user->mail }}  {{ $user->password }}
    @endforeach
    
</div>
@include('footer')