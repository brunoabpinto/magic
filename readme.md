<!-- @format -->

# Laravel Magic

Editable inline content with automatic database persistence using Livewire.

![Demo](demo.gif)

## Installation

1. Install via Composer:

```bash
composer require brunoabpinto/magic
```

2. Publish and run migrations:

```bash
php artisan vendor:publish --tag=magic-migrations
php artisan migrate
```

3. (Optional) Publish config:

```bash
php artisan vendor:publish --tag=magic-config
```

## Usage

In your Blade views:

```blade
@magic('Editable text')
```

## Features

- ✅ Inline editing with contenteditable
- ✅ Automatic database persistence
- ✅ Cache layer for performance
- ✅ Reset to original value
- ✅ Configurable cache and table names

## Configuration

After publishing the config file, you can customize:

- Cache driver
- Cache prefix
- Database table name

## Requirements

- PHP 8.1+
- Laravel 10.0+ or 11.0+
- Livewire 4.0+

## License

MIT
