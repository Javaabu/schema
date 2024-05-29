---
title: Schema Facade Methods
sidebar_position: 2
---

:::warning

This feature is not supported on Laravel 9

:::

This package adds these additional methods to `Illuminate\Support\Facades\Schema`:

- `getColumnComment(string $table, string $column, bool $fail_on_missing = false)`: Returns the comment from the given table column
- `getTableComment(string $table, bool $fail_on_missing = false)`: Returns the comment from the given table
