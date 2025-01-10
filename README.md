### Relations: 

| Model       | Type of relations | Related model |
|-------------|-------------------|---------------|
| Poll        | hasMany           | Options       |
| Option      | belongsTo         | Poll          |
| Option      | hasMany           | Votes         |
| Vote        | BelongsTo         | Option        |

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

### Validation

```php
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
<p class="mt-2 text-sm text-red-600 dark:text-red-500">@error('title') {{ $message }} @enderror</p>
```