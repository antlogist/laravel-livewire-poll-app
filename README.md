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