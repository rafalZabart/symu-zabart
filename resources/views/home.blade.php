@include('header')
<div class="container">
    <div class="row">
        <div class="login-form">
            <h1 class="text-center">Symu</h1>
            @php echo Form::open(array('url' => '/panel', 'method' => 'post')); @endphp @php echo Form::label('email', 'E-Mail'); @endphp
            <br> @php echo Form::email('email'); @endphp
            <br> @php echo Form::label('password', 'Password'); @endphp
            <br> @php echo Form::password('password'); @endphp
            <br> @php echo Form::submit('Zaloguj', ['class' => 'btn submit-button']); @endphp @php echo Form::close(); @endphp
        </div>
    </div>
</div>
<script>
$(document).ready(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("input[type=submit]").click(function (e) {
        e.preventDefault();
        var password = $("input[name=password]").val();
        var email = $("input[name=email]").val();
        $.ajax({
            type: 'POST',
            url: '/panel',
            data: {
                password: password,
                email: email
            },
            success: function (data) {
                if (data.logged) {
                    $(location).attr("href", "/panel");
                } else {
                    alert("Błędne dane logowania");
                }
            }
        });
    });
})
</script>
@include('footer')
