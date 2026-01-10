# 🛒 Laravel POS System
> **A modern, feature-rich Point of Sale application built with Laravel, Livewire, and Filament**

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://www.php.net)
[![Livewire](https://img.shields.io/badge/Livewire-3.x-FB70A9?style=for-the-badge&logo=livewire)](https://livewire.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

---

## 📸 Screenshots

> **Add your application screenshots here**
> - Dashboard overview
> - POS checkout interface
> - Sales reports
> - Product management

---

## 📖 Overview

**Laravel POS System** is a comprehensive, modern Point of Sale solution designed for retail businesses. Built on top of Laravel 12 with Livewire for reactive components and Filament for powerful admin interfaces, this application provides a seamless experience for managing sales, inventory, customers, and generating detailed analytics.

### 💡 Problem It Solves

Traditional POS systems are often expensive, complicated, or require proprietary hardware. This open-source solution provides:
- **Cost-effective alternative** to commercial POS software
- **Web-based accessibility** from any device with a browser
- **Real-time inventory tracking** to prevent overselling
- **Comprehensive sales analytics** for business insights
- **Flexible and customizable** to meet specific business needs

---

## ✨ Key Features

### 🛍️ Point of Sale (POS)
- **Intuitive checkout interface** with real-time cart management
- **Product search and filtering** for quick item selection
- **Dynamic pricing calculations** including tax (15%) and discounts
- **Receipt preview and printing** with one-click generation
- **Customer and payment method selection** during checkout
- **Stock validation** to prevent overselling

### 📊 Sales Management
- **Complete sales history** with detailed transaction records
- **Sales analytics dashboard** with interactive charts
- **Receipt generation** in printable PDF format
- **Sales items tracking** with itemized details

### 📦 Inventory Management
- **Product/Item management** with CRUD operations
- **Image upload support** for product visuals
- **SKU auto-generation** using UUID
- **Stock quantity tracking** with low-stock alerts
- **Price management** with decimal precision
- **Status controls** (active/inactive products)

### 👥 Customer Management
- **Customer database** with detailed profiles
- **Customer creation and editing** with validation
- **Sales history** per customer
- **Quick customer selection** in POS

### 💳 Payment Methods
- **Multiple payment options** (Cash, Card, Mobile, etc.)
- **Flexible payment method management**
- **Payment tracking** in sales records

### 🔐 User Management & Security
- **Role-based user management**
- **Two-factor authentication (2FA)** for enhanced security
- **Profile customization** with appearance settings
- **Secure password management**
- **Email verification** support

### 📈 Dashboard & Analytics
- **Sales charts** with visual insights
- **Sales items analytics** for product performance
- **Real-time data widgets**
- **Customizable dashboard** components

---

## 🛠️ Tech Stack

### Backend
| Technology | Version | Purpose |
|------------|---------|---------|
| **PHP** | 8.2+ | Server-side language |
| **Laravel** | 12.x | Backend framework |
| **Livewire** | 3.x | Reactive components |
| **Filament** | 4.x | Admin panel components |
| **Laravel Fortify** | 1.30+ | Authentication backend |

### Frontend
| Technology | Version | Purpose |
|------------|---------|---------|
| **Livewire Flux** | 2.9+ | UI components library |
| **TailwindCSS** | 4.x | Utility-first CSS framework |
| **Vite** | 7.x | Frontend build tool |
| **Axios** | 1.7+ | HTTP client |

### Development Tools
- **Laravel Pint** - Code style fixer
- **Pest PHP** - Testing framework
- **Laravel Sail** - Docker development environment
- **Concurrently** - Run multiple dev servers

---

## 🚀 Installation & Setup

### Prerequisites

Before you begin, ensure you have the following installed:
- **PHP** >= 8.2
- **Composer** (latest version)
- **Node.js** >= 18.x and **npm**
- **MySQL** >= 8.0 or **PostgreSQL** >= 13
- **Git**

### Step-by-Step Installation

#### 1️⃣ Clone the Repository
```bash
git clone https://github.com/your-username/laravel-pos.git
cd laravel-pos
```

#### 2️⃣ Install PHP Dependencies
```bash
composer install
```

#### 3️⃣ Install Node Dependencies
```bash
npm install
```

#### 4️⃣ Environment Configuration
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 5️⃣ Database Setup

Edit your `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_pos
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Create the database:
```bash
# For MySQL
mysql -u root -p -e "CREATE DATABASE laravel_pos;"
```

#### 6️⃣ Run Migrations
```bash
php artisan migrate
```

#### 7️⃣ Seed Database (Optional)
```bash
php artisan db:seed
```

#### 8️⃣ Create Storage Link
```bash
php artisan storage:link
```

#### 9️⃣ Build Frontend Assets
```bash
# For development
npm run dev

# For production
npm run build
```

#### 🔟 Start Development Server
```bash
# Option 1: Using the built-in script (recommended)
composer dev

# Option 2: Manual approach
php artisan serve
```

The application will be available at: **http://localhost:8000**

---

## 🎯 Usage

### First-Time Setup

1. **Register an Account**
   - Navigate to `/register`
   - Create your admin account
   - Verify email (if enabled)

2. **Configure Settings**
   - Access **Settings** from the dashboard
   - Set up your profile
   - Enable 2FA for security (optional)

3. **Add Payment Methods**
   - Go to **Admin > Payment Methods**
   - Create methods: Cash, Card, Mobile Payment, etc.

4. **Add Products/Items**
   - Navigate to **Admin > Items**
   - Click **Create Item**
   - Upload product image, set price, and quantity

5. **Add Customers**
   - Go to **Admin > Customers**
   - Add customer details

### Using the POS

#### Making a Sale

```php
// Navigate to POS Management
1. Click "POS Management" in the sidebar

// Add items to cart
2. Search or browse products
3. Click on products to add to cart

// Adjust quantities
4. Update quantities directly in the cart

// Complete the sale
5. Select customer from dropdown
6. Choose payment method
7. Enter paid amount
8. Apply discount (if needed)
9. Click "Checkout"

// Print receipt
10. Choose "Yes, Print Receipt" from notification
```

#### Viewing Sales History

```php
// Access sales records
Admin > Manage Sales

// View individual receipt
Click on any sale > Print Receipt
```

### Code Examples

#### Adding a Custom Widget

```php
// app/Livewire/Widgets/CustomWidget.php
namespace App\Livewire\Widgets;

use Livewire\Component;

class CustomWidget extends Component
{
    public function render()
    {
        return view('livewire.widgets.custom-widget');
    }
}
```

#### Creating a New Payment Method Programmatically

```php
use App\Models\PaymentMethod;

PaymentMethod::create([
    'name' => 'Credit Card',
    'description' => 'Visa/Mastercard payment'
]);
```

---

## 📁 Project Structure

```
laravel-pos/
│
├── app/
│   ├── Actions/              # Fortify actions for authentication
│   │   └── Fortify/
│   ├── Http/
│   │   └── Controllers/      # HTTP controllers
│   ├── Livewire/            # Livewire components
│   │   ├── Actions/         # Action components (Logout)
│   │   ├── Customers/       # Customer CRUD
│   │   ├── Items/           # Product/Item CRUD
│   │   ├── PaymentMethods/  # Payment method management
│   │   ├── Sales/           # Sales listing
│   │   ├── Settings/        # User settings (Profile, 2FA, etc.)
│   │   ├── Users/           # User management
│   │   ├── Widgets/         # Dashboard widgets
│   │   └── Pos.php          # Main POS component
│   ├── Models/              # Eloquent models
│   │   ├── Customer.php
│   │   ├── Item.php
│   │   ├── PaymentMethod.php
│   │   ├── Sale.php
│   │   ├── SaleItem.php
│   │   └── User.php
│   └── Providers/           # Service providers
│
├── bootstrap/               # Framework bootstrap files
│
├── config/                  # Configuration files
│
├── database/
│   ├── factories/          # Model factories for testing
│   ├── migrations/         # Database migrations
│   │   ├── *_create_users_table.php
│   │   ├── *_create_items_table.php
│   │   ├── *_create_customers_table.php
│   │   ├── *_create_payment_methods_table.php
│   │   ├── *_create_sales_table.php
│   │   └── *_create_sale_items_table.php
│   └── seeders/            # Database seeders
│
├── public/                 # Public assets
│   └── storage/           # Symlinked storage (images, uploads)
│
├── resources/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   └── views/             # Blade templates
│       ├── components/    # Reusable components
│       ├── livewire/      # Livewire views
│       │   ├── auth/
│       │   ├── customers/
│       │   ├── items/
│       │   ├── payment-methods/
│       │   ├── sales/
│       │   ├── settings/
│       │   ├── users/
│       │   └── pos.blade.php
│       ├── dashboard.blade.php
│       ├── pdf.blade.php  # Receipt template
│       └── welcome.blade.php
│
├── routes/
│   ├── web.php            # Web routes
│   └── console.php        # Console routes
│
├── storage/               # Application storage
│   ├── app/              # Application files
│   ├── framework/        # Framework files
│   └── logs/             # Log files
│
├── tests/                # Test files
│   ├── Feature/         # Feature tests
│   └── Unit/            # Unit tests
│
├── .env.example         # Environment template
├── composer.json        # PHP dependencies
├── package.json         # Node dependencies
├── phpunit.xml          # PHPUnit configuration
├── vite.config.js       # Vite configuration
└── artisan              # Artisan CLI
```

---

## 🤝 Contributing

We welcome contributions from the community! Here's how you can help:

### How to Contribute

1. **Fork the Repository**
   ```bash
   # Click the 'Fork' button on GitHub
   ```

2. **Clone Your Fork**
   ```bash
   git clone https://github.com/your-username/laravel-pos.git
   cd laravel-pos
   ```

3. **Create a Feature Branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```

4. **Make Your Changes**
   - Write clean, documented code
   - Follow Laravel coding standards
   - Add tests for new features

5. **Commit Your Changes**
   ```bash
   git commit -m "feat: Add amazing feature"
   ```

6. **Push to Your Fork**
   ```bash
   git push origin feature/amazing-feature
   ```

7. **Open a Pull Request**
   - Go to the original repository
   - Click "New Pull Request"
   - Describe your changes

### Coding Standards

- Follow **PSR-12** coding standards
- Use **Laravel Pint** for code formatting: `./vendor/bin/pint`
- Write **tests** for new features: `php artisan test`
- Update documentation as needed

### Reporting Bugs

If you find a bug, please create an issue with:
- Clear title and description
- Steps to reproduce
- Expected vs actual behavior
- Screenshots (if applicable)

---

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/PosTest.php

# Run with coverage
php artisan test --coverage
```

---

## 📜 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

### MIT License Summary
- ✅ Commercial use
- ✅ Modification
- ✅ Distribution
- ✅ Private use

---

## 📞 Contact & Support

### Author
**Your Name**

### Get in Touch
- 🌐 **Website**: [yourwebsite.com](https://yourwebsite.com)
- 💼 **LinkedIn**: [linkedin.com/in/yourprofile](https://linkedin.com/in/yourprofile)
- 🐦 **Twitter**: [@yourhandle](https://twitter.com/yourhandle)
- 📧 **Email**: your.email@example.com
- 💬 **GitHub Issues**: [Report a bug or request a feature](https://github.com/your-username/laravel-pos/issues)

### Support This Project

If you find this project helpful, please consider:
- ⭐ **Starring** the repository
- 🍴 **Forking** and contributing
- 📢 **Sharing** with others
- ☕ **Buying me a coffee**: [Your donation link]

---

## 🙏 Acknowledgments

- **Laravel Team** - For the amazing framework
- **Livewire Team** - For reactive components
- **Filament Team** - For beautiful admin components
- **All Contributors** - Thank you for your contributions!

---

## 🗺️ Roadmap

### Upcoming Features
- [ ] 📱 Mobile responsive improvements
- [ ] 📊 Advanced reporting and analytics
- [ ] 🔔 Low stock notifications
- [ ] 📧 Email receipts to customers
- [ ] 🌍 Multi-language support
- [ ] 💰 Multiple currency support
- [ ] 📦 Barcode scanning integration
- [ ] 🏪 Multi-store support
- [ ] 📱 Progressive Web App (PWA)
- [ ] 🔌 API for third-party integrations

---

## ❓ FAQ

**Q: Can I use this for my business?**
A: Yes! This is open-source software licensed under MIT. You can use it for commercial purposes.

**Q: Is there a demo available?**
A: Check the repository for a live demo link or install it locally to test.

**Q: How do I update the tax rate?**
A: Edit the tax calculation in `app/Livewire/Pos.php` line 51.

**Q: Can I customize the receipt template?**
A: Yes! Edit `resources/views/pdf.blade.php` to customize the receipt layout.

**Q: How do I add more user roles?**
A: You can extend the User model and add role-based permissions using Laravel's authorization features.

---

<div align="center">

**Made with ❤️ using Laravel**

⭐ **Star this repo if you find it useful!** ⭐

[Report Bug](https://github.com/your-username/laravel-pos/issues) · [Request Feature](https://github.com/your-username/laravel-pos/issues) · [Documentation](https://github.com/your-username/laravel-pos/wiki)

</div>
