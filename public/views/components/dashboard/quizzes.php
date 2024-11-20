<section>
    <h1>Hello, {{ username }}</h1>

    <h4>Your Info</h4>
    <ul>
        {{ @for: field => :user }}
        <li><b>{{ field }}</b>: {{ user.field }}</li>
        {{ @endfor }}
    </ul>
</section>