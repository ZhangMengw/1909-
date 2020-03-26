<h2>控制器</h2><hr>
<form action='{{url("/add")}}' method='post'>
{{csrf_field()}}
@csrf
<input name='name'>
<input type='submit'>
</form>