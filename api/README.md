# SocialDeal Demo

A modern Symfony 8 application demonstrating a product management system with a REST API and interactive web interface.

## Overview

This project showcases a typical Symfony application structure with:
- **RESTful API** for product management
- **Database layer** using Doctrine ORM
- **Frontend interactivity** with Stimulus and Turbo
- **Asset management** with Symfony AssetMapper

## Prerequisites

- PHP >= 8.4
- Composer
- SQLite (default, configured in `.env.local`)
- Node.js & npm (for JavaScript bundling)

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd socialdeal-demo
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```
   This will automatically run `importmap:install` and install JavaScript dependencies.

3. **Set up the database**
   ```bash
   bin/console doctrine:database:create
   bin/console doctrine:migrations:migrate
   ```

4. **Load sample data**
   ```bash
   bin/console doctrine:fixtures:load
   ```

## Project Structure

```
src/
├── Controller/          # HTTP controllers (routing)
├── Entity/            # Doctrine entities
├── Repository/        # Database queries
├── Service/           # Business logic
├── Dto/               # Data Transfer Objects
└── DataFixtures/      # Sample data for development

config/
├── routes.yaml        # Route configuration
├── services.yaml      # Service container configuration
└── packages/          # Bundle configurations

assets/
├── app.js            # Main JavaScript entry point
├── controllers/      # Stimulus controllers
└── styles/           # CSS stylesheets

templates/            # Twig templates

tests/               # PHPUnit tests
```

## Running the Application

### Development Server

Start the Symfony development server:
```bash
symfony server:start
```

The application will be available at `http://localhost:8000`

### API Endpoints

#### Get All Products
```bash
GET /api/products
```

**Query Parameters:**
- `minPrice` (optional): Filter products by minimum price

**Example:**
```bash
curl http://localhost:8000/api/products?minPrice=10
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Product Name",
    "price": 19.99,
    "description": "Product description"
  }
]
```

## Key Features

### Product Management
- List all products via REST API
- Filter products by minimum price
- Store product information (name, price, description)

### Database
- SQLite database (development)
- Doctrine ORM for data persistence
- Migration support for schema versioning

### Frontend
- **Stimulus** controllers for JavaScript interactivity
- **Turbo** for seamless page navigation
- **AssetMapper** for modern asset handling
- CSRF protection for forms

## Development

### Running Tests
```bash
bin/phpunit
```

### Database Migrations
Create a new migration:
```bash
bin/console make:migration
```

Apply migrations:
```bash
bin/console doctrine:migrations:migrate
```

### Debugging
Enable debug mode in `.env.local`:
```
APP_ENV=dev
APP_DEBUG=1
```

Access the Symfony Web Profiler at `http://localhost:8000/_profiler`

### Useful Commands
```bash
# List all routes
bin/console debug:router

# Clear cache
bin/console cache:clear

# Check .env configuration
bin/console debug:config

# Access database shell
bin/console doctrine:query:sql

# Load fixtures
bin/console doctrine:fixtures:load
```

## Dependencies

### Core Framework
- **Symfony 8.0** - Full-stack PHP framework
- **Doctrine ORM** - Object-relational mapping
- **Twig** - Template engine

### Frontend
- **Stimulus Bundle** - Modest JavaScript framework
- **UX Turbo** - Seamless page navigation
- **AssetMapper** - Modern asset handling

### Development
- **PHPUnit** - Testing framework
- **PHPStan** - Static analysis
- **DoctrineFixturesBundle** - Sample data loading

See [composer.json](composer.json) for the complete dependency list.

## Configuration

Key configuration files:
- `.env` - Environment variables (tracked)
- `.env.local` - Local overrides (not tracked)
- `config/services.yaml` - Service container
- `config/packages/` - Individual bundle configs

## Docker Support

The project includes Docker Compose configuration:
```bash
docker-compose up -d
```

## Troubleshooting

### Database Issues
```bash
# Recreate database from scratch
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
bin/console doctrine:fixtures:load
```

### Cache Issues
```bash
bin/console cache:clear
```

### Missing Assets
```bash
bin/console importmap:install
```

## Contributing

When contributing:
1. Follow PSR-12 coding standards
2. Write tests for new features
3. Run `phpstan` before committing
4. Update this README for significant changes

## License

This project is proprietary. See LICENSE for details.

## Support

For issues or questions, please create an issue in the repository.
