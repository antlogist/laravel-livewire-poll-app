### Relations: 

| Model       | Type of relations | Related model |
|-------------|-------------------|---------------|
| Poll        | hasMany           | Options       |
| Option      | belongsTo         | Poll          |
| Option      | hasMany           | Votes         |
| Vote        | BelongsTo         | Option        |

---

### Polls table structure

| Field      | Type            | Null | Key | Default | Extra          |
|------------|-----------------|------|-----|---------|----------------|
| id         | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| title      | varchar(255)    | NO   |     | NULL    |                |
| created_at | timestamp       | YES  |     | NULL    |                |
| updated_at | timestamp       | YES  |     | NULL    |                |

### Options table structure

| Field      | Type            | Null | Key | Default | Extra          |
|------------|-----------------|------|-----|---------|----------------|
| id         | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| name       | varchar(255)    | NO   |     | NULL    |                |
| poll_id    | bigint unsigned | NO   | MUL | NULL    |                |
| created_at | timestamp       | YES  |     | NULL    |                |
| updated_at | timestamp       | YES  |     | NULL    |                |

### Votes table structure

| Field      | Type            | Null | Key | Default | Extra          |
|------------|-----------------|------|-----|---------|----------------|
| id         | bigint unsigned | NO   | PRI | NULL    | auto_increment |
| option_id  | bigint unsigned | NO   | MUL | NULL    |                |
| created_at | timestamp       | YES  |     | NULL    |                |
| updated_at | timestamp       | YES  |     | NULL    |                |

---

### An sql query that can be used for testing

```sql
SELECT p.id as poll_id, 
       p.title as poll_title, 
       o.id as option_id, 
       o.name as option_name 
    FROM polls AS p
         LEFT JOIN options as o ON p.id = o.poll_id 
            ORDER BY p.id, o.id;
```

---

### Livewire generator command

```
php artisan make:livewire CreatePoll
php artisan make:livewire Polls
```

---

### Validation

```php
// app/Livewire/CreatePoll.php

public $title;
public $options = [''];

protected function rules()
{
    return [
        'title' => 'required|min:3|max:255',
        'options' => 'required|min:1|max:10',
        'options.*' => 'required|min:1|max:255',
    ];
}
```

```blade
// resources/views/livewire/create-poll.blade.php

<p class="mt-2 text-sm text-red-600 dark:text-red-500">@error('title') {{ $message }} @enderror</p>
```

---

### Sorting at the database level

```php
// app/Livewire/Poll.php

public function render()
{
    $polls = Poll::select(['id', 'title', 'updated_at'])
        ->with(['options' => fn($query) => $query->select(['id', 'poll_id', 'name'])])
        ->orderByDesc('updated_at')
        ->get();

    return view('livewire.polls', ['polls' => $polls]);
}
```

The name **poll_id** is due to the naming convention for foreign keys in relational databases, which is accepted in Laravel. By default, when you have a one-to-many relationship (for example, one survey has many options), the foreign key in the child table (in our case, the options table) is called the name of the parent entity (poll) plus the suffix _id. This convention helps maintain consistency and makes the code easier to read.

😍 <u>***One of the convenient features of Livewire is accessing related models directly in the Blade templates without having to load them additionally in the controller or component.***</u>
```php
// app/Livewire/Poll.php

public function render()
{
    $polls = Poll::orderByDesc('updated_at')->get();

    return view('livewire.polls', ['polls' => $polls]);
}
```

```blade
// resources/views/livewire/polls.blade.php

<p>{{ $option->name }} {{ $option->votes->count() }}</p>
```

---

### Triggering an Event

To initiate an event, use the dispatch method:
```php
$this->dispatch('poll-created');
```

The #[On('poll-created')] attribute is used to handle the event. This attribute indicates that the class is a listener for the poll-created event.
```php
use App\Models\Poll;
use Livewire\Attributes\On;
use Livewire\Component;

class Polls extends Component
{
    #[On('poll-created')] 
    public function render()
    {
        $polls = Poll::orderByDesc('updated_at')->get();

        return view('livewire.polls', ['polls' => $polls]);
    }
}
```