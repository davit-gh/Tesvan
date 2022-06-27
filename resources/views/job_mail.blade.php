<h2>Hello</h2>

<h4>You have got an email from : {{ $name }}</h4>

<hr>

<h4> User details: </h4>
<code><b>Name:</b> {{ $name }}</code>
<br>
<code><b>Surname:</b> {{ $surname }}</code>
<br>
<code><b>Email:</b> {{ $email }}</code>
<br>
<code><b>Phone:</b> {{ $phone }}</code>
<br>
<code><b>City:</b>  {{ $city }}</code>
<br>
<code><b>Experience Level:</b>  {{ $experience }}</code>
<br>
@if(\Illuminate\Support\Str::contains($experience, 'No experience'))
    <code><b>The course you have passed the test:</b>  {{ $course }}</code>
    <br>
@else
    <code><b>The most 3 experienced frameworks:</b>  {{ implode(', ', $frameworks) }}</code>
    <br>
    <code><b>The most 3 experienced tools:</b>  {{ implode(', ', $tools) }}</code>
    <br>
@endif
<code><b>What is the salary you will be excited about:</b>  {{ $salary }}</code>
<br>
<code><b>English level:</b>  {{ $level }}</code>
<br>

<h4>Thanks</h4>
