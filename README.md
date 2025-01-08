## Relations: 

| Model       | Type of relations | Related model |
|-------------|-------------------|---------------|
| Poll        | hasMany           | Options       |
| Option      | belongsTo         | Poll          |
| Option      | hasMany           | Votes         |
| Vote        | BelongsTo         | Options       |
