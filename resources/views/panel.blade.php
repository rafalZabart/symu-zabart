@include('header')
<div class="container">
   <div class="row">
            <div class="panel-header">
                <div></div>
                <div></div>
                <div class="login-info">
                <p>test</p>
                    @foreach ($users as $user) 
                        <p>Zalogowany jako: {{ $user->mail }}</p>
                    @endforeach
                    <button class="logout-button">Wyloguj</button>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="project-form">
            @php echo Form::open(array('url' => '/addProject', 'method' => 'post', 'enctype'=> "multipart/form-data")); @endphp @php
            echo Form::label('File', 'Plik jpg, png, psd'); @endphp
            <br> @php echo Form::file('file'); @endphp
            <br> @php echo Form::label('name', 'Nazwa projektu'); @endphp
            <br> @php echo Form::text('name'); @endphp
            <br> @php echo Form::submit('Zatwierdź', ['class' => 'btn submit-button']); @endphp @php echo Form::close(); @endphp
        </div>
    </div>
    <div class="row">
        <div class="projects">
            @foreach($projects as $project)
            <div class="project">
                <a href="project" class="get-project" data-project-id="<?php echo $project->id; ?>"><img src="<?php echo asset($project->image_url); ?>"></a>
                <button class="btn delete-button" data-project-id="<?php echo $project->id; ?>">Usuń projekt</button>
            </div>
            @endforeach
            <img>
        </div>
    </div>
</div>
@include('footer')