---
title: Blueprint Methods
sidebar_position: 1
---

This package adds these additional methods to `Illuminate\Database\Schema\Blueprint`:

- `nativeEnum(string $column, string $enum_class, ?int $length = null)`: Creates a native string enum column that `javaabu/generators` can recognize.
